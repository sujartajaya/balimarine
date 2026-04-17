<h1>Dashboard Hotspot</h1>

<div class="grid grid-cols-3 gap-4">
    <div>Total Online: {{ $totalOnline }}</div>
    <div>Traffic Today: {{ number_format($trafficToday / 1024 / 1024, 2) }} MB</div>
</div>

<table>
    <thead>
        <tr>
            <th>User</th>
            <th>IP</th>
            <th>MAC</th>
            <th>Login</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        @foreach($onlineUsers as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->framedipaddress }}</td>
            <td>{{ $user->callingstationid }}</td>
            <td>{{ $user->acctstarttime }}</td>
            <td>{{ now()->diffInMinutes($user->acctstarttime) }} min</td>
        </tr>
        @endforeach
    </tbody>
</table>