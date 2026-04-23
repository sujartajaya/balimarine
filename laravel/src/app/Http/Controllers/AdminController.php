<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Radacct;
use App\Services\MikrotikService;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected $mikrotik;

    public function __construct(MikrotikService $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $totalUsers = Guest::count();

        $activeSessions = Radacct::whereNull('acctstoptime')->count();

        // 🔥 TOP 5 USER TRAFFIC
        $topUsers = Radacct::select(
                'username',
                DB::raw('(acctinputoctets + acctoutputoctets) as total')
            )
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeSessions',
            'topUsers'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function routerDashboard()
    {
        $active = $this->mikrotik->getActiveUsers();

        $totalUsers = count($active);

        return view('admin.mikrotik.index', compact('active', 'totalUsers'));
    }
    
    public function disconnect(Request $request)
    {
        $this->mikrotik->disconnectUser($request->username);

        return back()->with('success', 'User berhasil di-disconnect');
    }
}
