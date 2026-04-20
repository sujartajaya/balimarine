<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-blue-900 text-white">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('components.sidebar')

    <!-- CONTENT -->
    <div class="flex-1 p-6">

        <!-- TOPBAR -->
        <div class="flex justify-between mb-6">
            <h1 class="text-xl font-bold">@yield('title')</h1>

            <div>
                👤 {{ auth()->user()->username }}
            </div>
        </div>

        @yield('content')

    </div>

</div>

</body>
</html>