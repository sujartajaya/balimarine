<?php

namespace App\Http\Controllers;

use App\Models\Radacct;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Repositories\RadacctRepository;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // return view('dashboard.index', [
        //     'onlineUsers' => $repo->getOnlineUsers(),
        //     'totalOnline' => $repo->countOnlineUsers(),
        //     'trafficToday' => $repo->trafficToday(),
        // ]);

        // Ambil user online (acctstoptime = NULL)
        // $onlineUsers = Radacct::with('guest')
        //     ->whereNull('acctstoptime')
        //     ->orderBy('acctstarttime', 'desc')
        //     ->paginate(15);

        // // Total online
        // $totalOnline = Radacct::whereNull('acctstoptime')->count();

        // // Traffic hari ini
        // $trafficToday = Radacct::whereDate('acctstarttime', Carbon::today())
        //     ->sum(\DB::raw('acctinputoctets + acctoutputoctets'));

        // return view('dashboard.index', compact(
        //     'onlineUsers',
        //     'totalOnline',
        //     'trafficToday'
        // ));

         $query = Radacct::with('guest')
        ->whereNull('acctstoptime');

        // 🔍 SEARCH
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                ->orWhere('callingstationid', 'like', "%$search%")
                ->orWhereHas('guest', function ($q2) use ($search) {
                    $q2->where('email', 'like', "%$search%");
                });
            });
        }

        // 📊 DATA
        $onlineUsers = $query
            ->orderBy('acctstarttime', 'desc')
            ->paginate(15)
            ->withQueryString(); // penting untuk pagination + search

        $totalOnline = Radacct::whereNull('acctstoptime')->count();

        $trafficToday = Radacct::whereDate('acctstarttime', Carbon::today())
            ->sum(\DB::raw('acctinputoctets + acctoutputoctets'));

        return view('dashboard.index', compact(
            'onlineUsers',
            'totalOnline',
            'trafficToday'
        ));

    }

    public function export(Request $request)
    {
        $query = Radacct::with('guest')
            ->whereNull('acctstoptime');

        // ikutkan filter search
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                ->orWhere('callingstationid', 'like', "%$search%")
                ->orWhereHas('guest', function ($q2) use ($search) {
                    $q2->where('email', 'like', "%$search%");
                });
            });
        }

        $data = $query->get();

        $filename = "hotspot_users_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // header csv
            fputcsv($file, [
                'Username',
                'Email',
                'OS',
                'Browser',
                'IP',
                'MAC',
                'Start Time',
                'Traffic (MB)'
            ]);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->username,
                    $row->guest->email ?? '-',
                    $row->guest->os_client ?? '-',
                    $row->guest->browser_client ?? '-',
                    $row->framedipaddress,
                    $row->callingstationid,
                    $row->acctstarttime,
                    number_format(($row->acctinputoctets + $row->acctoutputoctets)/1024/1024,2)
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}