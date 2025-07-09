<footer style="background-color: #2c3e50; color: white; padding: 40px 0; margin-top: 40px;">
    <div class="container" style="display: flex; justify-content: space-between; text-align: left;">
        {{-- Thông tin liên hệ --}}
        <div>
            <h4 style="margin-top: 0;">VỀ BITI'S</h4>
            <p style="margin: 5px 0;">Công ty TNHH Sản xuất Hàng tiêu dùng Bình Tiên (Biti's)</p>
            <p style="margin: 5px 0;">Địa chỉ: 22 Lý Chiêu Hoàng, P.10, Q.6, TP. HCM</p>
            <p style="margin: 5px 0;">Điện thoại: (028) 38 753 443</p>
        </div>

        {{-- Hỗ trợ khách hàng --}}
        <div>
            <h4 style="margin-top: 0;">HỖ TRỢ KHÁCH HÀNG</h4>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 8px;"><a href="#" style="color: white; text-decoration: none;">Chính sách đổi trả</a></li>
                <li style="margin-bottom: 8px;"><a href="#" style="color: white; text-decoration: none;">Chính sách bảo hành</a></li>
                <li style="margin-bottom: 8px;"><a href="#" style="color: white; text-decoration: none;">Chính sách bảo mật</a></li>
            </ul>
        </div>

        {{-- Đăng ký nhận tin --}}
        <div>
            <h4 style="margin-top: 0;">ĐĂNG KÝ NHẬN TIN</h4>
            <p>Nhận thông tin sản phẩm mới và khuyến mãi</p>
            <form action="/subscribe" method="POST" style="display: flex;">
                @csrf
                <input type="email" name="email" placeholder="Email của bạn" style="padding: 8px; border: none; border-radius: 4px 0 0 4px;">
                <button type="submit" style="padding: 8px 15px; border: none; background-color: #d9534f; color: white; border-radius: 0 4px 4px 0; cursor: pointer;">Gửi</button>
            </form>
        </div>
    </div>
    <div style="text-align: center; margin-top: 30px; border-top: 1px solid #444; padding-top: 20px;">
        <p>&copy; {{ date('Y') }} Biti's. All rights reserved.</p>
    </div>
</footer>