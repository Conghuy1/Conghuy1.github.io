<?php
session_start();

// Xác định trạng thái ghế cần cập nhật (ví dụ: từ 0 thành 1)
$newSeatStatus = 1; // Trạng thái mới của ghế sau khi người dùng chọn

// Nhận dữ liệu từ JavaScript
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['selectedSeats']) && isset($data['screening_id'])) {
  $selectedSeatIds = $data['selectedSeats'];
  $screening_id = $data['screening_id']; // Lấy giá trị screening_id từ dữ liệu gửi đi

  // Tiến hành cập nhật trạng thái các ghế đã chọn trong cơ sở dữ liệu
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "db_cnow1";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
  }

  // Cập nhật trạng thái của từng ghế đã chọn trong CSDL
  foreach ($selectedSeatIds as $seatId) {
    $sql = "UPDATE seat_status SET status = $newSeatStatus WHERE seat_name = '$seatId' AND screening_id = '$screening_id'";
    $result = $conn->query($sql);
    if (!$result) {
      // Xử lý lỗi nếu có
    }
  }

  // Đóng kết nối CSDL
  $conn->close();
}
?>
