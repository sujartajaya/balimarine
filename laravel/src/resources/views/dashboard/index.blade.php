@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold">MikroTik Monitoring</h1>
        <p class="text-sm text-gray-500">Realtime Router Health</p>
    </div>
    <div id="clock" class="text-sm text-gray-400"></div>
</div>

<!-- HEALTH CARDS -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">

    @include('components.stat-card', [
        'id' => 'card-uptime',
        'title' => 'Uptime',
        'value' => $uptime ?? '0d 0h',
        'icon' => '⏱️',
        'color' => 'bg-blue-500'
    ])

    @include('components.stat-card', [
        'id' => 'card-cpu',
        'title' => 'CPU Load',
        'value' => ($cpu ?? 0) . ' %',
        'icon' => '⚡',
        'color' => 'bg-yellow-500'
    ])

    @include('components.stat-card', [
        'id' => 'card-memory',
        'title' => 'Memory',
        'value' => ($memory ?? 0) . ' %',
        'icon' => '💾',
        'color' => 'bg-purple-500'
    ])

    @include('components.stat-card', [
        'id' => 'card-temp',
        'title' => 'Temperature',
        'value' => ($temperature ?? '-') . ' °C',
        'icon' => '🌡️',
        'color' => 'bg-red-500'
    ])

    @include('components.stat-card', [
        'id' => 'card-users',
        'title' => 'Active Users',
        'value' => $totalOnline ?? 0,
        'icon' => '👥',
        'color' => 'bg-green-500'
    ])

    @include('components.stat-card', [
        'id' => 'card-traffic',
        'title' => 'Traffic Today',
        'value' => number_format($trafficToday ?? 0, 2) . ' MB',
        'icon' => '📡',
        'color' => 'bg-indigo-500'
    ])

</div>

<!-- SYSTEM STATUS -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 mb-6">
    <h2 class="text-lg font-semibold mb-3">System Status</h2>

    <div class="grid md:grid-cols-3 gap-4">

        <div>
            <p class="text-sm text-gray-400">Router Identity</p>
            <p class="font-bold">{{ $identity ?? 'MikroTik-01' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-400">Router OS</p>
            <p class="font-bold">{{ $version ?? 'RouterOS v7' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-400">Last Update</p>
            <p class="font-bold">{{ now() }}</p>
        </div>

    </div>
</div>

<!-- TABLE / LOG -->
<script>
function setValue(cardId, value) {
    const el = document.querySelector(`#${cardId} .value`);
    if (el) el.innerText = value;
}

function setCardColor(cardId, color) {
    const el = document.getElementById(cardId);
    if (!el) return;

    el.classList.remove(
        'bg-blue-500','bg-yellow-500','bg-red-500',
        'bg-green-500','bg-purple-500','bg-indigo-500'
    );

    el.classList.add(color);
}

async function loadRealtime() {
    try {
        const res = await fetch('/api/mikrotik/health');
        const data = await res.json();

        if (data.error) return;

        setValue('card-uptime', data.uptime);
        setValue('card-cpu', data.cpu + ' %');
        setValue('card-memory', data.memory + ' %');
        setValue('card-temp', (data.temperature ?? '-') + ' °C');
        setValue('card-users', data.active_users);
        setValue('card-traffic', data.traffic_today + ' MB');

        // 🔥 CPU color dynamic
        if (data.cpu > 80) setCardColor('card-cpu', 'bg-red-500');
        else if (data.cpu > 50) setCardColor('card-cpu', 'bg-yellow-500');
        else setCardColor('card-cpu', 'bg-green-500');

        // 🌡️ Temperature color
        if (data.temperature > 60) setCardColor('card-temp', 'bg-red-500');
        else if (data.temperature > 40) setCardColor('card-temp', 'bg-yellow-500');
        else setCardColor('card-temp', 'bg-green-500');

    } catch (e) {
        console.log("Realtime error:", e);
    }
}

// first load
loadRealtime();

// refresh tiap 2 detik
setInterval(loadRealtime, 2000);
</script>
@endsection