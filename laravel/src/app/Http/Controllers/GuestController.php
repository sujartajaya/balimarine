<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Radreply;
use App\Models\Radcheck;


use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Guest::query();

        // 🔍 SEARCH
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('mac_add', 'like', "%$search%");
            });
        }

        $guests = $query->latest()->paginate(10)->withQueryString();

        return view('admin.guests.index', compact('guests'));
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
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
         $expire_date = Radcheck::where('username', $guest->username)
        ->where('attribute', 'Expiration')
        ->first();

        $limit_rate = Radreply::where('username', $guest->username)
        ->where('attribute', 'Mikrotik-Rate-Limit')
        ->first();

        $quota = Radreply::where('username', $guest->username)
        ->where('attribute', 'Mikrotik-Total-Limit')
        ->first();

        return view('admin.guests.edit', compact('guest','limit_rate','expire_date','quota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $guest->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'mac_add' => $request->mac_add,
        ]);

        // ========================
        // 🔥 RADCHECK (AUTH)
        // ========================

        //Password

        if ($request->password) {
             $guest->update([
                'password' => $request->password,
            ]);
            Radcheck::updateOrCreate(
                [
                    'username' => $request->username,
                    'attribute' => 'Cleartext-Password'
                ],
                [
                    'op' => ':=',
                    'value' => $request->password
                ]
            );
        }
        // Expired
        if ($request->expired) {
            Radcheck::updateOrCreate(
                [
                    'username' => $guest->username,
                    'attribute' => 'Expiration'
                ],
                [
                    'op' => ':=',
                    'value' => $request->expired
                ]
            );
        }

        // ========================
        // 🔥 RADREPLY (PROFILE)
        // ========================

        // Rate Limit
        if ($request->rate_limit) {
            Radreply::updateOrCreate(
                [
                    'username' => $guest->username,
                    'attribute' => 'Mikrotik-Rate-Limit'
                ],
                [
                    'op' => ':=',
                    'value' => $request->rate_limit
                ]
            );
        }

        // Quota (Mikrotik total limit)
        if ($request->quota) {
            Radreply::updateOrCreate(
                [
                    'username' => $guest->username,
                    'attribute' => 'Mikrotik-Total-Limit'
                ],
                [
                    'op' => ':=',
                    'value' => $request->quota * 1024 * 1024 // MB → byte
                ]
            );
        }

        return redirect('/admin/guests')->with('success', 'Profile radius updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        // Hapus data RADIUS dulu
        Radcheck::where('username', $guest->username)->delete();
        Radreply::where('username', $guest->username)->delete();

        // Hapus guest
        $guest->delete();

        return redirect('/admin/guests')
            ->with('success', 'Guest deleted successfully');
        }
}
