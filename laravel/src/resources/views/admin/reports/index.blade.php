@extends('layouts.admin')

@section('content')
<div class="p-6 text-white">

    <h2 class="text-xl font-bold mb-4">📜 Logs User Hotspot</h2>

    <!-- FILTER -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6 items-end">
        <div>
            <label class="block text-sm mb-1">Start Date</label>
            <input type="date" name="start_date"
                value="{{ request('start_date') }}"
                class="p-2 rounded text-black">
        </div>

        <div>
            <label class="block text-sm mb-1">End Date</label>
            <input type="date" name="end_date"
                value="{{ request('end_date') }}"
                class="p-2 rounded text-black">
        </div>

        <button class="bg-cyan-500 px-4 py-2 rounded">
            Filter
        </button>

        <a href="{{ route('admin.logs.export', request()->query()) }}"
           class="bg-green-500 px-4 py-2 rounded">
            Export Excel
        </a>
    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-xl p-4 text-black overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b">
                <tr>
                    <th class="p-2">Username</th>
                    <th>Email</th>
                    <th>MAC</th>
                    <th>OS</th>
                    <th>Browser</th>
                    <th>Traffic (MB)</th>
                </tr>
            </thead>

            <tbody>
            @foreach($logs as $log)
            <tr class="border-b hover:bg-gray-100">
                <td class="p-2">{{ $log->username }}</td>
                <td>{{ $log->email }}</td>
                <td>{{ $log->mac_add }}</td>
                <td>{{ $log->os_client }}</td>
                <td>{{ $log->browser_client }}</td>
                <td>
                    {{ number_format($log->total_bytes / 1024 / 1024, 2) }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <!-- PAGINATION -->
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>

</div>
@endsection