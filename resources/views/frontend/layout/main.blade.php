<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/goat.png') }}" type="image/x-icon">
    <title>Tour Pelosok | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="font-filter">
    @include('frontend.layout.navbar')
    @yield('content')
    @include('frontend.layout.footer')

    <script src="{{ asset('js/scrcipt.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
