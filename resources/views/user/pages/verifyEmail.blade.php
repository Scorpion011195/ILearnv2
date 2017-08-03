<h2>XÁC THỰC TÀI KHOẢN</h2>
	Chào {!! $username !!},<b>
    <div>
        Bạn vừa gửi yêu cầu xác thực email trên <strong>ILEARN</strong><b>.
        Vui lòng nhấn vào liên kết bên dưới để hoàn thành quá trình đăng kí.<b>
        {{ route ('confirm', $confirmation_code)}}
    </div>