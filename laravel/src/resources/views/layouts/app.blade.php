<!DOCTYPE html>
<html>
<head>
    <title>Ocean Hotspot</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative text-white min-h-screen overflow-x-hidden">

    <!-- 🌊 BACKGROUND LAUT -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900 via-blue-800 to-blue-700"></div>

        <!-- ikan animasi -->
        <div class="absolute w-full h-full overflow-hidden">
            <div class="animate-bounce absolute left-10 top-20">🐟</div>
            <div class="animate-pulse absolute right-20 top-40">🐠</div>
            <div class="animate-bounce absolute left-1/2 bottom-10">🐡</div>
        </div>
    </div>

    <!-- NAVBAR -->
    @include('components.navbar')

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto p-4 sm:p-6">
        @yield('content')
    </div>

</body>
</html>