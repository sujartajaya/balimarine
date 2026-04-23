<?php

namespace App\Exports;

use App\Models\Radacct;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
        $query = Radacct::with('guest')
            ->whereNull('acctstoptime');

        // 🔍 filter search ikut export
        if ($this->search) {
            $search = $this->search;

            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                  ->orWhere('callingstationid', 'like', "%$search%")
                  ->orWhereHas('guest', function ($q2) use ($search) {
                      $q2->where('email', 'like', "%$search%");
                  });
            });
        }

        return $query->get()->map(function ($row) {
            return [
                'Username' => $row->username,
                'Email' => $row->guest->email ?? '-',
                'OS' => $row->guest->os_client ?? '-',
                'Browser' => $row->guest->browser_client ?? '-',
                'IP' => $row->framedipaddress,
                'MAC' => $row->callingstationid,
                'Start Time' => $row->acctstarttime,
                'Traffic (MB)' => number_format(
                    ($row->acctinputoctets + $row->acctoutputoctets)/1024/1024, 2
                ),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Username',
            'Email',
            'OS',
            'Browser',
            'IP',
            'MAC',
            'Start Time',
            'Traffic (MB)',
        ];
    }
}