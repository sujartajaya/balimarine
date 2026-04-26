<?php

namespace App\Exports;

use App\Models\Radacct;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $start;
    protected $end;

    public function __construct($search = null, $start = null, $end = null)
    {
        $this->search = $search;
        $this->start = $start;
        $this->end = $end;
    }


    public function collection()
    {
        $start = $this->start
            ? $this->start . ' 00:00:00'
            : now()->startOfMonth();

        $end = $this->end
            ? $this->end . ' 23:59:59'
            : now();

        $trafficSub = DB::table('radacct')
            ->selectRaw('username, SUM(acctinputoctets + acctoutputoctets) as total_bytes')
            ->whereBetween('acctstarttime', [$start, $end])
            ->groupBy('username');

        // $query = DB::table('guests')
        //     ->leftJoinSub($trafficSub, 'traffic', function ($join) {
        //         $join->on('guests.username', '=', 'traffic.username');
        //     })
        //     ->select(
        //         'guests.username',
        //         'guests.email',
        //         'guests.mac_add',
        //         'guests.os_client',
        //         'guests.browser_client',
        //         DB::raw('COALESCE(traffic.total_bytes, 0) as total_bytes')
        //     );
        $query = DB::table('guests')
            ->joinSub($trafficSub, 'traffic', function ($join) {
                $join->on('guests.username', '=', 'traffic.username');
            })
            ->where('traffic.total_bytes', '>', 0) // 🔥 ini kunci utama
            ->select(
                'guests.username',
                'guests.email',
                'guests.mac_add',
                'guests.os_client',
                'guests.browser_client',
                DB::raw('traffic.total_bytes as total_bytes')
            );

        // optional search
        if ($this->search) {
            $search = $this->search;

            $query->where(function ($q) use ($search) {
                $q->where('guests.username', 'like', "%$search%")
                ->orWhere('guests.email', 'like', "%$search%");
            });
        }

        return $query->get()->map(function ($row) {
            return [
                'Username' => $row->username,
                'Email' => $row->email,
                'MAC' => $row->mac_add,
                'OS' => $row->os_client,
                'Browser' => $row->browser_client,
                'Traffic (MB)' => number_format($row->total_bytes / 1024 / 1024, 2),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Username',
            'Email',
            'MAC',
            'OS',
            'Browser',
            'Traffic (MB)',
        ];
    }
}