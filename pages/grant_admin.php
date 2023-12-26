<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost"; // Tên máy chủ
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "db_cnow1"; // Tên cơ sở dữ liệu

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xử lý chức năng cấp quyền admin
if(isset($_POST['grant_admin'])) {
    $user_id = $_POST['user_id'];

    // Thực hiện truy vấn cấp quyền admin cho người dùng cần chỉ định
    $sql = "UPDATE users SET admin = 1 WHERE id = $user_id"; // Giả sử ID của người dùng cần cấp quyền admin là $user_id
    $result = $conn->query($sql);

    if ($result === TRUE) {
        $response['success'] = true;
        $response['message'] = "Cấp quyền admin thành công cho người dùng có ID: " . $user_id;
    } else {
        $response['success'] = false;
        $response['message'] = "Có lỗi xảy ra khi cấp quyền admin: " . $conn->error;
    }
}

// Xử lý chức năng xóa quyền admin
if(isset($_POST['delete_admin'])) {
    $user_id = $_POST['user_id'];

    // Thực hiện truy vấn xóa quyền admin của người dùng cần chỉ định
    $sql = "UPDATE users SET admin = 0 WHERE id = $user_id"; // Giả sử ID của người dùng cần xóa quyền admin là $user_id
    $result = $conn->query($sql);

    if ($result === TRUE) {
        $response['success'] = true;
        $response['message'] = "Xóa quyền quản trị thành công!";
    } else {
        $response['success'] = false;
        $response['message'] = "Có lỗi xảy ra khi xóa quyền quản trị: " . $conn->error;
    }
}

// Truy vấn để lấy số người dùng từ bảng user
$sqlUsers = "SELECT COUNT(id) as total_users FROM users";
$resultUsers = $conn->query($sqlUsers);

// Truy vấn để lấy số tài khoản admin từ bảng user
$sqlAdmin = "SELECT COUNT(admin) as total_admin FROM users WHERE admin = 1"; // Giả sử thuộc tính admin = 1 cho tài khoản admin
$resultAdmin = $conn->query($sqlAdmin);

// Mảng để lưu thông tin về số người dùng và số tài khoản admin
$response = array();

if ($resultUsers->num_rows > 0) {
    $rowUsers = $resultUsers->fetch_assoc();
    $totalUsers = $rowUsers["total_users"];
    $response['total_users'] = $totalUsers;
} else {
    $response['total_users'] = 0;
}

if ($resultAdmin->num_rows > 0) {
    $rowAdmin = $resultAdmin->fetch_assoc();
    $totalAdmin = $rowAdmin["total_admin"];
    $response['total_admin'] = $totalAdmin;
} else {
    $response['total_admin'] = 0;
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
