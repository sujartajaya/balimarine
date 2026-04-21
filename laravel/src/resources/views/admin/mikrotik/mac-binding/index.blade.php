@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6 text-white">🔗 MAC Binding</h1>

    {{-- FORM --}}
    <div class="bg-blue-900 p-4 rounded-xl mb-6 shadow">
        <form method="POST" action="/admin/mac-binding">
            @csrf
            <div class="flex flex-col md:flex-row gap-3">

                <input type="text" name="mac"
                    placeholder="MAC Address (AA:BB:CC:DD:EE:FF)"
                    class="px-3 py-2 rounded bg-blue-800 text-white border border-blue-700 w-full md:w-1/3">

                <input type="text" name="comment"
                    placeholder="Comment (optional)"
                    class="px-3 py-2 rounded bg-blue-800 text-white border border-blue-700 w-full md:w-1/3">

                <button class="bg-cyan-500 hover:bg-cyan-400 text-black px-4 py-2 rounded font-semibold">
                    + Tambah
                </button>

            </div>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="bg-blue-900 rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm text-left text-gray-200">

            <thead class="bg-blue-800 text-gray-300 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">MAC Address</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Comment</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($bindings as $b)
                <tr class="border-b border-blue-800 hover:bg-blue-800 transition">

                    <td class="px-4 py-3 font-mono">
                        {{ $b['mac-address'] }}
                    </td>

                    <td class="px-4 py-3">
                        @if($b['type'] === 'bypassed')
                            <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded text-xs">
                                BYPASSED
                            </span>
                        @elseif($b['type'] === 'blocked')
                            <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded text-xs">
                                BLOCKED
                            </span>
                        @else
                            <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded text-xs">
                                {{ strtoupper($b['type']) }}
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3">
                        {{ $b['comment'] ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-center">
                        <form method="POST" action="/admin/mac-binding"
                              onsubmit="return confirm('Hapus MAC ini?')">
                            @csrf
                            @method('DELETE')

                            <input type="hidden" name="id" value="{{ $b['.id'] }}">

                            <button class="bg-red-500 hover:bg-red-400 px-3 py-1 rounded text-xs font-semibold">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-400">
                        Belum ada MAC Binding
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection