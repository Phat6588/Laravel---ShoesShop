<header style="background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 10px 0;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        {{-- Logo --}}
        <a href="{{ url('/') }}">
            <img src="https://file.hstatic.net/1000230642/file/logo-bitis_24a2c536ce4448239e443194a9d20c33.png" alt="Biti's Logo" style="height: 50px;">
        </a>

        {{-- Đăng nhập / Đăng ký --}}
        <div>
            <a href="/login" style="margin-right: 15px; text-decoration: none; color: #555;">Đăng Nhập</a>
            <a href="/register" style="padding: 8px 15px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 4px;">Đăng Ký</a>
        </div>
    </div>
</header>