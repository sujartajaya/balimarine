<div class="bg-blue-900/60 backdrop-blur p-4 flex justify-between items-center">

    <div class="font-bold text-lg">🌊 Ocean Hotspot</div>

    <div class="flex gap-4 items-center">

        <a href="#">About</a>

        @auth

            <a href="/dashboard">Dashboard</a>

            @if(auth()->user()->type === 'admin')
                <a href="/admin" class="text-yellow-300">Admin Panel</a>
            @endif

            <!-- USER DROPDOWN -->
            <div class="relative group">
                <button class="flex items-center gap-1">
                    👤 {{ auth()->user()->username }}
                    ▼
                </button>

                <div class="absolute right-0 mt-2 w-40 bg-blue-800 rounded-lg shadow-lg hidden group-hover:block">

                    <a href="#" class="block px-4 py-2 hover:bg-blue-700">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 hover:bg-blue-700">
                            Logout
                        </button>
                    </form>

                </div>
            </div>

        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth

    </div>
</div>