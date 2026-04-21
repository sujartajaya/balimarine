@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">📡 Hotspot Router</h1>

    {{-- CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-blue-900 p-5 rounded-xl shadow">
            <div class="text-gray-300 text-sm">Total User Aktif</div>
            <div class="text-3xl font-bold text-white">{{ $totalUsers }}</div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-blue-900 rounded-xl shadow overflow-hidden">

        <table class="w-full text-sm text-left text-gray-200">

            <thead class="bg-blue-800 text-xs uppercase text-gray-300">
                <tr>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">IP</th>
                    <th class="px-4 py-3">MAC</th>
                    <th class="px-4 py-3">Uptime</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($active as $user)
                <tr class="border-b border-blue-800 hover:bg-blue-800 transition">

                    <td class="px-4 py-3 font-semibold">
                        {{ $user['user'] }}
                    </td>

                    <td class="px-4 py-3 font-mono">
                        {{ $user['address'] }}
                    </td>

                    <td class="px-4 py-3 font-mono">
                        {{ $user['mac-address'] }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $user['uptime'] }}
                    </td>

                    <td class="px-4 py-3 text-center">
                        <form method="POST" action="/admin/mikrotik/disconnect"
                              onsubmit="return confirm('Disconnect user ini?')">
                            @csrf
                            <input type="hidden" name="username" value="{{ $user['user'] }}">

                            <button class="bg-red-500 hover:bg-red-400 px-3 py-1 rounded text-xs font-semibold">
                                Disconnect
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-400">
                        Tidak ada user aktif
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>
@endsection