<?php 
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Repositories\RadacctRepository;

class DashboardApiController extends Controller
{
    public function online(RadacctRepository $repo)
    {
        return response()->json(
            $repo->getOnlineUsers()
        );
    }
}