<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @stack('styles') <!-- For additional styles -->
</head>
<body>
    <nav>
        <!-- Navigation -->
    </nav>
    <div class="container">
        @yield('content')
    </div>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @stack('scripts') <!-- For additional scripts -->
</body>
</html>
