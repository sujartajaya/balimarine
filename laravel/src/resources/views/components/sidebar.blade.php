<div class="w-64 bg-blue-950 p-4 space-y-4">

    <div class="text-lg font-bold mb-6">
        🌊 Admin Panel
    </div>

    <a href="/admin" class="block hover:text-cyan-400">
        📊 Dashboard
    </a>

    <a href="/admin/guests" class="block hover:text-cyan-400">
        👥 Guests (Radius)
    </a>

    <a href="/admin/mikrotik" class="block hover:text-cyan-400">
        📡 Mikrotik
    </a>

    <a href="#" class="block hover:text-cyan-400">
        📈 Traffic
    </a>

    <a href="#" class="block hover:text-cyan-400">
        📜 Logs
    </a>

    <hr class="border-blue-800">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-red-400">Logout</button>
    </form>

</div>