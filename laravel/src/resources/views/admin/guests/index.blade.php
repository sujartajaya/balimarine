@extends('layouts.admin')

@section('title', 'Guests Management')

@section('content')
@if(session('success'))
    <div class="mb-4 p-3 bg-green-500 text-white rounded-lg shadow">
        {{ session('success') }}
    </div>
@endif
<!-- CARD -->
<div class="bg-blue-900/40 backdrop-blur p-6 rounded-2xl shadow-lg">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">

        <h2 class="text-lg font-semibold">👥 Guests List</h2>

        <div class="flex gap-2 w-full sm:w-auto">

            <!-- SEARCH -->
            <form method="GET" class="flex gap-2 w-full sm:w-auto">
                <input name="search"
                    value="{{ request('search') }}"
                    placeholder="Search username / email..."
                    class="px-3 py-2 rounded-lg text-black w-full sm:w-64">

                <button class="bg-cyan-500 px-4 py-2 rounded-lg">
                    Search
                </button>
            </form>

            <!-- ADD -->
            <!-- <a href="/admin/guests/create"
               class="bg-green-500 px-4 py-2 rounded-lg whitespace-nowrap">
                + Add
            </a> -->

        </div>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead>
                <tr class="text-left border-b border-blue-600">
                    <th class="py-3">Username</th>
                    <th>Email</th>
                    <th>MAC</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($guests as $guest)
                <tr class="border-b border-blue-800 hover:bg-blue-800/40 transition">

                    <td class="flex items-center gap-2">
                        <span class="bg-cyan-500 w-8 h-8 flex items-center justify-center rounded-full">
                            {{ strtoupper(substr($guest->username, 0, 1)) }}
                        </span>
                        {{ $guest->username }}
                    </td>

                    <td class="text-gray-200">
                        {{ $guest->email }}
                    </td>

                    <td class="text-xs text-gray-300">
                        <span class="bg-blue-700 px-2 py-1 rounded text-xs">
                            {{ $guest->mac_add }}
                        </span>
                    </td>

                    <td class="text-right space-x-2">

                        <a href="{{ route('admin.guests.edit', $guest) }}"
                           class="bg-yellow-500 px-3 py-1 rounded text-xs">
                            Edit
                        </a>

                        <form method="POST"
                            action="{{ route('admin.guests.destroy', $guest) }}"
                            class="inline"
                            onsubmit="return confirm('Are you sure you want to delete user {{ $guest->username }}?')">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 px-3 py-1 rounded text-xs hover:bg-red-400">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-300">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $guests->links() }}
    </div>

</div>

@endsection