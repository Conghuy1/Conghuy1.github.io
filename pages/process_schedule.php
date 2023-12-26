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

// Lấy ID của rạp chiếu và phim từ form hoặc từ dữ liệu khác
$cinemaID = $_POST['cinemaToAdd']; // ID rạp chiếu
$movieID = $_POST['movieToAdd'];   // ID của phim

// Định dạng lại ID rạp chiếu và ID của phim thành 2 ký tự
$formattedCinemaID = str_pad($cinemaID, 2, '0', STR_PAD_LEFT);
$formattedMovieID = str_pad($movieID, 2, '0', STR_PAD_LEFT);

// Tạo một chuỗi ngẫu nhiên 4 ký tự cho phần xxxxxx
$randomPart = mt_rand(100000, 999999);

// Tạo ID theo quy tắc aabbxxxxxx
$newID = $formattedCinemaID . $formattedMovieID . $randomPart;

// Lấy dữ liệu từ form
$startDate = $_POST['startDate']; // Dữ liệu từ trường input date
$startTime = $_POST['startTime']; // Dữ liệu từ trường input time

// Ghép ngày và giờ thành một chuỗi datetime
$dateTime = $startDate . ' ' . $startTime;

// Truy vấn để lấy giá trị timen từ bảng "movie" dựa vào movieID
$sql_get_timen = "SELECT timen FROM movie WHERE id = '$movieID'";
$result_timen = $conn->query($sql_get_timen);

if ($result_timen->num_rows > 0) {
    $row_timen = $result_timen->fetch_assoc();
    $timen = $row_timen["timen"];

    // Kiểm tra trùng lịch
    $sql_existing = "SELECT start_time, duration FROM screening WHERE cinema_id = '$cinemaID'";
    $result_existing = $conn->query($sql_existing);

    $existingStartTime = '';
    $existingEndTime = '';

    if ($result_existing->num_rows > 0) {
        while ($row_existing = $result_existing->fetch_assoc()) {
            $existingStartTime = strtotime($row_existing['start_time']);
            $existingEndTime = strtotime('+' . $row_existing['duration'] . ' minutes', $existingStartTime);

            // Kiểm tra trùng thời gian
            $proposedStartTime = strtotime($dateTime);
            $proposedEndTime = strtotime('+' . $timen . ' minutes', $proposedStartTime);

            if ($existingStartTime <= $proposedStartTime && $proposedStartTime <= $existingEndTime) {
                echo json_encode(array("success" => false, "message" => "Không thể thêm lịch chiếu mới vì trùng lịch."));
                exit();
            }
        }
    }

    // Thêm lịch chiếu vào bảng "screening" với ID mới và duration từ giá trị timen
    $sql_insert_screening = "INSERT INTO screening (id, movie_id, cinema_id, start_time, date, duration) 
            VALUES ('$newID', '$movieID', '$cinemaID', '$dateTime', '$startDate', '$timen')";

    if ($conn->query($sql_insert_screening) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Thêm lịch chiếu thành công!"));
    } else {
        echo json_encode(array("success" => false, "message" => "Lỗi khi thêm lịch chiếu."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Không tìm thấy thời lượng phim."));
}

$conn->close();

?>
