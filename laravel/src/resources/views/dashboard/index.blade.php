<!DOCTYPE html>
<html>
<head>
    <title>Ocean Hotspot Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-blue-900 via-blue-800 to-blue-700 text-white min-h-screen">

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">🌊 Ocean Hotspot</h1>
        <div id="clock"></div>
    </div>

    <!-- HERO -->
    <div class="bg-blue-600/30 backdrop-blur p-6 rounded-xl mb-6 shadow-lg">
        <h2 class="text-xl font-semibold">Welcome to Ocean Network</h2>
        <p class="text-sm opacity-80">Monitoring hotspot seperti kehidupan bawah laut</p>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-4 gap-4 mb-6">

        <div class="bg-blue-500/40 p-4 rounded-xl">
            🐟 Online Users
            <h2 class="text-2xl font-bold">{{ $totalOnline }}</h2>
        </div>

        <div class="bg-cyan-500/40 p-4 rounded-xl">
            🌊 Traffic Today
            <h2 class="text-2xl font-bold">
                {{ number_format($trafficToday / 1024 / 1024, 2) }} MB
            </h2>
        </div>

        <div class="bg-indigo-500/40 p-4 rounded-xl">
            🧭 Routers
            <h2 class="text-2xl font-bold">
                {{ $onlineUsers->groupBy('nasipaddress')->count() }}
            </h2>
        </div>

        <div class="bg-purple-500/40 p-4 rounded-xl">
            ⚡ Sessions
            <h2 class="text-2xl font-bold">
                {{ $onlineUsers->count() }}
            </h2>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-blue-900/40 p-4 rounded-xl">
        <h2 class="mb-4 font-bold">🐠 Active Users</h2>

        <table class="w-full text-sm">
            <thead class="text-left border-b border-blue-500">
                <tr>
                    <th>User</th>
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
                    <td>{{ $user->framedipaddress }}</td>
                    <td>{{ $user->callingstationid }}</td>
                    <td>{{ now()->diffInMinutes($user->acctstarttime) }} min</td>
                    <td>
                        {{ number_format(($user->acctinputoctets + $user->acctoutputoctets)/1024/1024,2) }} MB
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ABOUT SYSTEM -->
    <div class="mt-6 bg-blue-800/40 p-4 rounded-xl">
        <h2 class="font-bold mb-2">🌊 About System</h2>
        <p>Status RADIUS: 🟢 Active</p>
        <p>Total User Registered: {{ $totalUsers ?? '-' }}</p>
        <p>Session Today: {{ $sessionToday ?? '-' }}</p>
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