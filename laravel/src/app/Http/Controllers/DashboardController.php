<?php

namespace App\Http\Controllers;

use App\Models\Radacct;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Repositories\RadacctRepository;

class DashboardController extends Controller
{
    public function index(RadacctRepository $repo)
    {
        // return view('dashboard.index', [
        //     'onlineUsers' => $repo->getOnlineUsers(),
        //     'totalOnline' => $repo->countOnlineUsers(),
        //     'trafficToday' => $repo->trafficToday(),
        // ]);

        // Ambil user online (acctstoptime = NULL)
        $onlineUsers = Radacct::with('guest')
            ->whereNull('acctstoptime')
            ->orderBy('acctstarttime', 'desc')
            ->paginate(15);

        // Total online
        $totalOnline = Radacct::whereNull('acctstoptime')->count();

        // Traffic hari ini
        $trafficToday = Radacct::whereDate('acctstarttime', Carbon::today())
            ->sum(\DB::raw('acctinputoctets + acctoutputoctets'));

        return view('dashboard.index', compact(
            'onlineUsers',
            'totalOnline',
            'trafficToday'
        ));

    }
}