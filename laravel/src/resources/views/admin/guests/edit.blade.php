@extends('layouts.admin')

@section('title', 'Edit Guest')

@section('content')

<div class="flex justify-center">

    <div class="w-full max-w-xl bg-blue-900/60 backdrop-blur p-8 rounded-2xl shadow-2xl">

        <!-- TITLE -->
        <h2 class="text-xl font-bold mb-6 text-center">
            ✏️ Edit Guest
        </h2>

        <form method="POST"
              action="{{ route('admin.guests.update', $guest) }}"
              class="space-y-5">

            @csrf
            @method('PUT')

            <!-- ================= -->
            <!-- BASIC INFO -->
            <!-- ================= -->
            <div>
                <h3 class="text-sm text-gray-300 mb-2">Basic Information</h3>

                <div class="space-y-3">

                    <div>
                        <label class="text-sm text-gray-300">Name</label>
                        <input name="name"
                               value="{{ $guest->name }}"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">Email</label>
                        <input name="email"
                               value="{{ $guest->email }}"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">Username</label>
                        <input name="username"
                               value="{{ $guest->username }}"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">Password</label>
                        <input name="password"
                               placeholder="Kosongkan jika tidak diubah"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">MAC Address</label>
                        <input name="mac_add"
                               value="{{ $guest->mac_add }}"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                </div>
            </div>

            <!-- ================= -->
            <!-- RADIUS PROFILE -->
            <!-- ================= -->
            <div>
                <h3 class="text-sm text-gray-300 mb-2">Radius Profile</h3>

                <div class="space-y-3">

                    <div>
                        <label class="text-sm text-gray-300">Expiration</label>
                        <input type="date"
                               name="expired"
                               value="{{ optional($expire_date)->value }}"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">Rate Limit</label>
                        <input name="rate_limit"
                               placeholder="Contoh: 2M/2M"
                               value="{{ optional($limit_rate)->value }}"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">Quota (MB) ex: 10240 (10G)</label>
                        <input name="quota"
                               placeholder="Contoh: 10240 (10GB)"
                               value="{{ (optional($quota)->value/1024)/1024  }}"
                               class="w-full mt-1 p-2 rounded-lg text-black">
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <div class="text-center pt-4">
                <button class="bg-yellow-500 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition">
                    Update Guest
                </button>
            </div>

        </form>

    </div>

</div>

@endsection