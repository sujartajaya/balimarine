<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RadacctRepository
{
    public function getOnlineUsers()
    {
        return DB::table('radacct')
            ->whereNull('acctstoptime')
            ->orderBy('acctstarttime', 'desc')
            ->limit(100)
            ->get();
    }

    public function countOnlineUsers()
    {
        return DB::table('radacct')
            ->whereNull('acctstoptime')
            ->count();
    }

    public function trafficToday()
    {
        return DB::table('radacct')
            ->whereDate('acctstarttime', now())
            ->sum(DB::raw('acctinputoctets + acctoutputoctets'));
    }
}