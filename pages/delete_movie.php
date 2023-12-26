<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến CSDL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_cnow1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
    }

    // Lấy tên phim cần xóa từ POST request
    $movieToDelete = $_POST['movieToDelete'];

    // Chuẩn bị truy vấn SQL để xóa phim có tên tương ứng
    $sql = "DELETE FROM movie WHERE movie_name = '$movieToDelete'";

    if ($conn->query($sql) === TRUE) {
        // Xóa dữ liệu thành công
        header("Location: ../pages/edit_movie.php?noti=Phim đã xóa thêm thành công");
    } else {
        // Xảy ra lỗi khi xóa dữ liệu
        header("Location: ../pages/edit_movie.php?noti=Xóa phim không thành công");
    }

    // Đóng kết nối CSDL
    $conn->close();
}
?>
