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

// Xử lý dữ liệu ngày chọn từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST['selectDate'];

    // Truy vấn dữ liệu lịch chiếu dựa trên ngày đã chọn và join các bảng để lấy thông tin chi tiết
    $sql = "SELECT screening.id, movie.movie_name, cinemas.cinema_name, screening.start_time, screening.duration 
        FROM screening 
        INNER JOIN movie ON screening.movie_id = movie.id 
        INNER JOIN cinemas ON screening.cinema_id = cinemas.cinema_id
        WHERE DATE(screening.start_time) = '$selectedDate'
        ORDER BY cinemas.cinema_id ASC, screening.start_time ASC"; // Sắp xếp theo ID của cụm (rạp chiếu) tăng dần, sau đó sắp xếp theo thời gian bắt đầu tăng dần
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Lịch chiếu phim ngày " . $selectedDate . "</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Tên Phim</th>
                    <th>Rạp Chiếu</th>
                    <th>Thời Gian Bắt Đầu</th>
                    <th>Thời Gian Kết Thúc</th>
                    <th>Xóa lịch</th?
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    $startTime = strtotime($row["start_time"]); // Chuyển đổi thời gian bắt đầu thành định dạng unix timestamp
                    $endTime = $startTime + ($row["duration"] * 60); // Tính thời gian kết thúc dựa trên thời lượng
                
                    $formattedStartTime = date("H:i", $startTime); // Định dạng lại thời gian bắt đầu thành giờ:phút
                    $formattedEndTime = date("H:i", $endTime); // Định dạng lại thời gian kết thúc thành giờ:phút
                
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["movie_name"] . "</td>
                            <td>" . $row["cinema_name"] . "</td>
                            <td>" . $formattedStartTime . "</td>
                            <td>" . $formattedEndTime . "</td>
                            <td>
                                <button class='del-button' onclick='deleteSchedule(" . $row["id"] . ")'>Xóa</button>
                            </td>
                        </tr>";
                }
                
        echo "</table>";
    } else {
        echo "Không có lịch chiếu cho ngày đã chọn.";
    }
}

$conn->close();
?>
