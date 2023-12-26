<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Tên máy chủ của cơ sở dữ liệu, thường là localhost
$username = "root"; // Tên người dùng của cơ sở dữ liệu
$password = ""; // Mật khẩu của cơ sở dữ liệu, để trống nếu không có mật khẩu
$dbname = "db_cnow1"; // Tên cơ sở dữ liệu

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối có thành công không
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn để lấy danh sách các rạp chiếu phim từ cơ sở dữ liệu
$sql = "SELECT * FROM movie"; // Thay 'ten_bang_rap' bằng tên bảng chứa thông tin rạp
$result = $conn->query($sql);

// Tạo dropdown menu
echo '<select name="rap-dropdown">'; // Tên dropdown có thể là 'rapchieuphim'
echo '<option value="">Chọn rạp chiếu phim</option>'; // Tùy chọn mặc định

// Hiển thị danh sách rạp chiếu phim dưới dạng các tùy chọn trong dropdown
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['cinema_name'] . '</option>';
        // Thay 'id' và 'ten_rap' bằng tên cột trong bảng của bạn
    }
}

echo '</select>';

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
