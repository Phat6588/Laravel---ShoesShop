<aside style="width: 20%; padding-right: 20px;">
    <h3 style="margin-top: 0; border-bottom: 2px solid #eee; padding-bottom: 10px;">DANH MỤC</h3>
    <nav>
        {{-- 
            Logic active menu:
            - Dùng helper `request()->routeIs('ten-route')` để kiểm tra route hiện tại.
            - Nếu đúng, thêm class 'active' (hoặc inline style) để làm nổi bật.
        --}}
        <style>
            .main-menu a {
                display: block;
                padding: 10px 15px;
                text-decoration: none;
                color: #333;
                border-radius: 5px;
                margin-bottom: 5px;
                font-weight: bold;
            }
            .main-menu a.active, .main-menu a:hover {
                background-color: #d9534f;
                color: white;
            }
        </style>

        <ul class="main-menu" style="list-style: none; padding: 0;">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Trang Chủ</a></li>
            <li><a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}">Sản Phẩm</a></li>
            <li><a href="#" class="">Về Biti's</a></li>
            <li><a href="#" class="">Liên Hệ</a></li>
        </ul>
    </nav>
</aside>