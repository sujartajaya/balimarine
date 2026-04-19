<!DOCTYPE html>
<html>
<head>
    <title>Ocean Hotspot Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-blue-900 via-blue-800 to-blue-700 text-white min-h-screen">

<div class="max-w-7xl mx-auto p-4 sm:p-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
        <h1 class="text-lg sm:text-2xl font-bold">🌊 Ocean Hotspot</h1>
        <div id="clock" class="text-sm sm:text-base"></div>
    </div>

    <!-- HERO -->
    <div class="bg-blue-600/30 backdrop-blur p-4 sm:p-6 rounded-xl mb-6 shadow-lg">
        <h2 class="text-base sm:text-xl font-semibold">Welcome to Ocean Network</h2>
        <p class="text-xs sm:text-sm opacity-80">Hotspot monitoring</p>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <div class="bg-blue-500/40 p-4 rounded-xl">
            🐟 Online Users
            <h2 class="text-xl sm:text-2xl font-bold">{{ $totalOnline }}</h2>
        </div>

        <div class="bg-cyan-500/40 p-4 rounded-xl">
            🌊 Traffic Today
            <h2 class="text-xl sm:text-2xl font-bold">
                {{ number_format($trafficToday / 1024 / 1024, 2) }} MB
            </h2>
        </div>

        <div class="bg-indigo-500/40 p-4 rounded-xl">
            🧭 Routers
            <h2 class="text-xl sm:text-2xl font-bold">
                {{ $onlineUsers->groupBy('nasipaddress')->count() }}
            </h2>
        </div>

        <div class="bg-purple-500/40 p-4 rounded-xl">
            ⚡ Sessions
            <h2 class="text-xl sm:text-2xl font-bold">
                {{ $onlineUsers->count() }}
            </h2>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-blue-900/40 p-4 rounded-xl">
        <h2 class="mb-4 font-bold text-sm sm:text-base">🐠 Active Users</h2>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-xs sm:text-sm">
                <thead class="text-left border-b border-blue-500">
                    <tr>
                        <th>User</th>
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
                    @foreach($onlineUsers as $user)
                    <tr class="border-b border-blue-800">
                        <td>{{ $user->username }}</td>

                        <td>
                            {{ $user->guest->email ?? '-' }}
                        </td>

                        <td>
                            {{ $user->guest->os_client ?? '-' }}
                        </td>

                        <td>
                            {{ $user->guest->browser_client ?? '-' }}
                        </td>

                        <td>{{ $user->framedipaddress }}</td>

                        <td>{{ $user->callingstationid }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($user->acctstarttime)->diffForHumans(null, true) }}
                        </td>

                        <td>
                            {{ number_format(($user->acctinputoctets + $user->acctoutputoctets)/1024/1024,2) }} MB
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $onlineUsers->links() }}
        </div>
    </div>

</div>

<!-- CLOCK -->
<script>
setInterval(() => {
    document.getElementById('clock').innerText =
        new Date().toLocaleTimeString();
}, 1000);
</script>

</body>
</html>