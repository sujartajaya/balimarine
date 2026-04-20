@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-blue-900/50 p-6 rounded-xl">

    <h2 class="text-xl mb-4">Login</h2>

    <form method="POST">
        @csrf

        <input name="username" placeholder="Username"
            class="w-full mb-3 p-2 rounded text-black">

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-3 p-2 rounded text-black">

        <button class="bg-cyan-500 w-full p-2 rounded">
            Login
        </button>
    </form>

</div>
@endsection