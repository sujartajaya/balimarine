<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radacct;
use Carbon\Carbon;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date 
            ? Carbon::parse($request->start_date)
            : now()->startOfMonth();

        $end = $request->end_date 
            ? Carbon::parse($request->end_date)->endOfDay()
            : now();

        $logs = Radacct::with('guest')
            ->whereBetween('acctstarttime', [$start, $end])
            ->orderBy('acctstarttime', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.reports.index', compact('logs', 'start', 'end'));
    }

    public function export(Request $request)
    {
        return Excel::download(
            new UsersExport($request->start_date, $request->end_date),
            'logs.xlsx'
        );
    }
}