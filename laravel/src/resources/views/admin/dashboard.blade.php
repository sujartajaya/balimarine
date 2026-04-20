@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

    <div class="bg-blue-500/40 p-4 rounded-xl">
        Total Users
        <h2 class="text-xl font-bold">{{ $totalUsers ?? 0 }}</h2>
    </div>

    <div class="bg-cyan-500/40 p-4 rounded-xl">
        Active Sessions
        <h2 class="text-xl font-bold">{{ $activeSessions ?? 0 }}</h2>
    </div>

</div>

@endsection