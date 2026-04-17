<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\RadacctRepository;

class DashboardController extends Controller
{
    public function index(RadacctRepository $repo)
    {
        return view('dashboard.index', [
            'onlineUsers' => $repo->getOnlineUsers(),
            'totalOnline' => $repo->countOnlineUsers(),
            'trafficToday' => $repo->trafficToday(),
        ]);
    }
}