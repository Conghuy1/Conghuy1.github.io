<?php
// Kết nối đến CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_cnow1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idToDelete = $_POST['id'];

// Trước hết, thực hiện xóa dữ liệu từ bảng seat_status với screening_id tương ứng
$sqlDeleteSeatStatus = "DELETE FROM seat_status WHERE screening_id IN (SELECT id FROM screening WHERE id = '$idToDelete')";

if ($conn->query($sqlDeleteSeatStatus) === TRUE) {
    echo "Xóa dữ liệu trong seat_status thành công!";
} else {
    echo "Lỗi khi xóa dữ liệu từ seat_status: " . $conn->error;
}

// Tiếp theo, thực hiện xóa lịch chiếu từ bảng screening
$sqlDeleteScreening = "DELETE FROM screening WHERE id = '$idToDelete'";

if ($conn->query($sqlDeleteScreening) === TRUE) {
    echo "Xóa lịch chiếu thành công!";
} else {
    echo "Lỗi khi xóa lịch chiếu: " . $conn->error;
}
}

$conn->close();
?>
