<!-- Menu -->
<div class="menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            {{-- Sửa lỗi: route('products') thành route('products.index') --}}
                            <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a class="{{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">Sản phẩm</a></li>
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Giới thiệu</a></li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End-menu -->
