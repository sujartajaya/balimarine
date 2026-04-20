@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="flex justify-between mb-6">
    <h1 class="text-xl font-bold">Dashboard</h1>
    <div id="clock"></div>
</div>

<!-- CARDS -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    @include('components.card', [
        'title' => 'Online Users',
        'value' => $totalOnline
    ])

    @include('components.card', [
        'title' => 'Traffic Today',
        'value' => number_format($trafficToday / 1024 / 1024, 2) . ' MB'
    ])

</div>

@include('components.table')

@endsection