<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = ""; // Mật khẩu của bạn (nếu có)
$dbname = "db_cnow1";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieName = $_POST['movieName'];
    $banner = $_POST['banner'];
    $type = $_POST['type'];
    $trailer = $_POST['trailer'];
    $timen = $_POST['timen'];
    $director = $_POST['director'];
    $language = $_POST['language'];
    $dubbed = $_POST['dubbed'];
    $subtitles = $_POST['subtitles'];
    $type = $_POST['type'];
    $languageDubSub = $language . ', ' . $dubbed . ', ' . $subtitles;

    // Chuẩn bị truy vấn SQL để chèn dữ liệu vào bảng movie
    $sql = "INSERT INTO movie (movie_name, banner, phan_loai, trailer, timen, director, type, Ngon_ngu) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Sử dụng prepared statement để ngăn chống tấn công SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $movieName, $banner, $type, $trailer, $timen, $director, $type, $languageDubSub);

    // Thực thi truy vấn và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Thêm bộ phim thành công!";
        header("Location: ../pages/edit_movie.php?noti=Phim đã được thêm thành công");
    } else {
        echo "Có lỗi xảy ra khi thêm bộ phim: " . $conn->error;
    }

    // Đóng prepared statement và kết nối
    $stmt->close();
    $conn->close();
}
?>
