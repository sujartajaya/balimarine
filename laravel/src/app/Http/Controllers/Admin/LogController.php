<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radacct;
use Carbon\Carbon;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{

    public function index(Request $request)
    {
        $start = $request->start_date 
            ? \Carbon\Carbon::parse($request->start_date)
            : now()->startOfMonth(); // 🔥 dari awal bulan

        $end = $request->end_date 
            ? \Carbon\Carbon::parse($request->end_date)->endOfDay()
            : now();

        $trafficSub = DB::table('radacct')
            ->selectRaw('username, SUM(acctinputoctets + acctoutputoctets) as total_bytes')
            ->whereBetween('acctstarttime', [$start, $end])
            ->groupBy('username');

        $logs = DB::table('guests')
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
            )
            ->orderByDesc('total_bytes')
            ->paginate(10)
            ->withQueryString();

        return view('admin.reports.index', compact('logs', 'start', 'end'));
    }

    public function export(Request $request)
    {
        return Excel::download(
            new UsersExport($request->search,$request->start_date, $request->end_date),
            'logs.xlsx'
        );
    }
}