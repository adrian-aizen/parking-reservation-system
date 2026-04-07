<!DOCTYPE html>
<html>
<head>
    <title>Parking Reservation</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    @include('partials.header')

    <div class="p-6">
        @yield('content')
    </div>

    @include('partials.footer')

</body>
</html>