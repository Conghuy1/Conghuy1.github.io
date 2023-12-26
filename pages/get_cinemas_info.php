<?php
$servername="localhost";
$username = "root";
$password = "";

$db_name = "db_cnow1";

$conn = mysqli_connect($servername,$username,$password, $db_name);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT cinema_name, link FROM cinemas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tạo mảng để lưu trữ thông tin của các rạp chiếu phim
    $cinemas = array();

    // Lặp qua các dòng dữ liệu từ truy vấn và thêm vào mảng
    while ($row = $result->fetch_assoc()) {
        $cinema = array(
            'cinema_name' => $row['cinema_name'],
            'link' => $row['link']
        );
        array_push($cinemas, $cinema);
    }

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($cinemas);
} else {
    echo "Không có dữ liệu về rạp chiếu phim";
}

// Đóng kết nối CSDL
$conn->close();
?>
