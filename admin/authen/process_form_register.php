<?php
// Khởi tạo các biến để lưu trữ thông tin từ biểu mẫu
$fullname = $email = $msg = '';

// Kiểm tra nếu có dữ liệu POST gửi lên
if(!empty($_POST)) {
    // Lấy giá trị từ biểu mẫu
    $fullname = getPost('fullname');
    $email = getPost('email');
    $pwd = getPost('password');

    // Xác minh dữ liệu
    if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) < 6) {
        // Nếu một trong các trường dữ liệu bị thiếu hoặc mật khẩu dưới 6 ký tự, không làm gì cả
    } else {
        // Xác minh thành công
        // Kiểm tra xem email đã tồn tại trong hệ thống chưa
        $userExist = executeResult("select * from User where email = '$email'", true);
        if($userExist != null) {
            // Nếu email đã tồn tại, gán thông báo lỗi vào biến $msg
            $msg = 'Email đã được đăng ký trên hệ thống';
        } else {
            // Nếu email chưa tồn tại, tiến hành đăng ký
            $created_at = $updated_at = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
            // Sử dụng mã hóa một chiều (md5) để mã hóa mật khẩu
            $pwd = getSecurityMD5($pwd);

            // Chèn dữ liệu người dùng mới vào cơ sở dữ liệu
            $sql = "insert into User (fullname, email, password, role_id, created_at, updated_at, deleted) values ('$fullname', '$email', '$pwd', 2, '$created_at', '$updated_at', 0)";
            execute($sql);
            // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
            header('Location: login.php');
            die();
        }
    }
}
?>
