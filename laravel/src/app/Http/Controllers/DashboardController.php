<?php

namespace App\Http\Controllers;

use App\Models\Radacct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
// use App\Repositories\RadacctRepository;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('http://python-api:9000/api/mikrotik/health');

        if ($response->failed()) {
            return view('dashboard.index', [
                'uptime' => '-',
                'cpu' => 0,
                'memory' => 0,
                'temperature' => '-',
                'totalOnline' => 0,
                'trafficToday' => 0,
                'identity' => 'Disconnected',
                'version' => '-'
            ]);
        }

        $data = $response->json();

        return view('dashboard.index', [
            'uptime' => $data['uptime'],
            'cpu' => $data['cpu'],
            'memory' => $data['memory'],
            'temperature' => $data['temperature'] ?? '-',
            'totalOnline' => $data['active_users'],
            'trafficToday' => $data['traffic_today'],
            'identity' => $data['identity'],
            'version' => $data['version']
        ]);
    }

   

    public function export(Request $request)
    {
        return Excel::download(
            new UsersExport($request->search),
            'hotspot_users.xlsx'
        );
    }


}