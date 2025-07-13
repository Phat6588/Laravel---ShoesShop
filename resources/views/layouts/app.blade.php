<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShoesShop - @yield('title', 'Trang chủ')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    {{-- Sửa lỗi: Sử dụng Vite để tải CSS và JS một cách chính xác. --}}
    {{-- Điều này sẽ sửa các lỗi hiển thị layout, bao gồm cả việc "mất" menu. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="antialiased">

    {{-- Cấu trúc layout chuẩn với các partials --}}
    @include('partials.header')

    @include('partials.menu')

    {{-- Phần nội dung chính của từng trang sẽ được hiển thị ở đây --}}
    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
