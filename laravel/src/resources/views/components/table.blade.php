<div class="bg-blue-900/40 p-4 rounded-xl">

    <h2 class="mb-4 font-bold text-sm sm:text-base">🐠 Active Users</h2>

    <!-- 🔍 SEARCH + EXPORT -->
    <div class="flex flex-col sm:flex-row justify-between gap-3 mb-4">

        <form method="GET" class="flex gap-2 w-full sm:w-auto">
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Search username / email / MAC..."
                class="px-3 py-2 rounded-lg text-black w-full sm:w-64"
            >

            <button class="bg-cyan-500 px-4 py-2 rounded-lg">
                Search
            </button>
        </form>

        <a href="{{ route('dashboard.export', ['search' => request('search')]) }}"
           class="bg-green-500 px-4 py-2 rounded-lg text-center">
            Export Excel
        </a>

    </div>

    <!-- 📊 TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-[900px] text-xs sm:text-sm">

            <thead class="text-left border-b border-blue-500">
                <tr>
                    <th class="py-2">User</th>
                    <th>Email</th>
                    <th>OS</th>
                    <th>Browser</th>
                    <th>IP</th>
                    <th>MAC</th>
                    <th>Duration</th>
                    <th>Traffic</th>
                </tr>
            </thead>

            <tbody>
                @forelse($onlineUsers as $user)
                <tr class="border-b border-blue-800 hover:bg-blue-800/40 transition">

                    <td class="py-2 font-semibold">
                        {{ $user->username }}
                    </td>

                    <td>{{ optional($user->guest)->email ?? '-' }}</td>

                    <td>{{ optional($user->guest)->os_client ?? '-' }}</td>

                    <td>{{ optional($user->guest)->browser_client ?? '-' }}</td>

                    <td>{{ $user->framedipaddress }}</td>

                    <td class="text-xs">
                        {{ $user->callingstationid }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($user->acctstarttime)->diffForHumans(null, true) }}
                    </td>

                    <td>
                        {{ number_format(($user->acctinputoctets + $user->acctoutputoctets)/1024/1024,2) }} MB
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-300">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- 🔢 PAGINATION -->
    <div class="mt-4">
        {{ $onlineUsers->links() }}
    </div>

</div>