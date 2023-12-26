<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_cnow1";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn cơ sở dữ liệu để lấy thông tin các bộ phim theo id tăng dần
$sql = "SELECT id, movie_name, banner, phan_loai, trailer, timen, director, ngon_ngu, type FROM movie ORDER BY id ASC"; // Sắp xếp theo id tăng dần
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $movies = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $movies = array(); // Nếu không có dữ liệu, gán mảng rỗng
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();

// Trả về mảng chứa thông tin phim đã sắp xếp theo id
return $movies;

//Nhap thong tin vao database:

?>
