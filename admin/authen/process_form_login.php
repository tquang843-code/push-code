<?php
$fullname = $email = $msg = ''; // Khởi tạo các biến để lưu trữ thông tin

if(!empty($_POST)) { // Kiểm tra nếu có dữ liệu POST gửi lên
	$email = getPost('email'); // Lấy giá trị email từ biểu mẫu
	$pwd = getPost('password'); // Lấy giá trị mật khẩu từ biểu mẫu
	$pwd = getSecurityMD5($pwd); // Mã hóa mật khẩu bằng hàm bảo mật MD5

	$sql = "select * from User where email = '$email' and password = '$pwd' and deleted = 0"; // Tạo câu lệnh SQL để kiểm tra người dùng
	$userExist = executeResult($sql, true); // Thực thi câu lệnh SQL và lấy kết quả

	if($userExist == null) { // Nếu người dùng không tồn tại
		$msg = 'Đăng nhập không thành công, vui lòng kiểm tra email hoặc mật khẩu!!!'; // Gán thông báo lỗi vào biến $msg
	} else {
		// Đăng nhập thành công
		$token = getSecurityMD5($userExist['email'].time()); // Tạo token bảo mật bằng cách kết hợp email và thời gian hiện tại, sau đó mã hóa bằng MD5
		setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/'); // Đặt cookie token với thời hạn 7 ngày
		$created_at = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

		$_SESSION['user'] = $userExist; // Lưu thông tin người dùng vào session

		$userId = $userExist['id']; // Lấy ID người dùng
		$sql = "insert into Tokens (user_id, token, created_at) values ('$userId', '$token', '$created_at')"; // Tạo câu lệnh SQL để chèn token vào bảng Tokens
		execute($sql); // Thực thi câu lệnh SQL

		header('Location: ../'); // Chuyển hướng đến trang chủ
		die(); // Dừng thực thi mã
	}
}
?>
