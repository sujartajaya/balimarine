<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MikrotikService;
use App\Models\Guest;

class MacBindingController extends Controller
{
    protected $mikrotik;

    public function __construct(MikrotikService $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }

    public function index()
    {
        $bindings = $this->mikrotik->getIpBindings();
        $guests = Guest::latest()->get();

        return view('admin.mikrotik.mac-binding.index', compact('bindings', 'guests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mac' => 'required'
        ]);

        $this->mikrotik->addMacBinding(
            $request->mac,
            $request->comment ?? ''
        );

        return back()->with('success', 'MAC Binding berhasil ditambahkan');
    }

    public function destroy(Request $request)
    {
        $this->mikrotik->removeMacBinding($request->id);

        return back()->with('success', 'MAC Binding dihapus');
    }

    
}
