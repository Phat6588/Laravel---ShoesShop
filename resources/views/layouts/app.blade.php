<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', "Biti's"))</title>
    @vite('resources/css/app.css')
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f9f9f9; }
        .container { max-width: 1200px; margin: 0 auto; padding: 1rem; }
    </style>
</head>
<body class="antialiased">

    @include('partials.header')

    <main class="container" style="display: flex; padding-top: 2rem;">
        {{-- Nhúng Menu vào cột bên trái --}}
        @include('partials.menu')

        {{-- Cột bên phải chứa nội dung chính của từng trang --}}
        <div class="content-area" style="width: 80%;">
            @yield('content')
        </div>
    </main>

    @include('partials.footer')
    
    @vite('resources/js/app.js')
</body>
</html>