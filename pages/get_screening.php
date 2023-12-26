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
    $movieID = $_POST['movieID'];

    // Truy vấn dữ liệu lịch chiếu dựa trên ngày đã chọn và movie_id từ URL
    $sql = $conn->prepare("SELECT screening.id, movie.movie_name, cinemas.cinema_name, cinemas.cinema_id, screening.start_time, screening.duration 
        FROM screening 
        INNER JOIN movie ON screening.movie_id = movie.id 
        INNER JOIN cinemas ON screening.cinema_id = cinemas.cinema_id
        WHERE DATE(screening.start_time) = ? AND screening.movie_id = ?
        ORDER BY cinemas.cinema_id ASC, screening.start_time ASC"); 

    $sql->bind_param("si", $selectedDate, $movieID);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $current_cinema_id = null;
    
        while ($row = $result->fetch_assoc()) {
            if ($row["cinema_id"] !== $current_cinema_id) {
                // Bắt đầu một bảng mới cho cinema_id khác
                if ($current_cinema_id !== null) {
                    echo "</table>"; // Kết thúc bảng trước nếu không phải bảng đầu tiên
                }
                echo "<h2 style='font-size: 24px; color: white;  margin-left: 15%; margin-top: 2%;'>Lịch chiếu phim tại " . $row["cinema_name"] . "</h2>";
                echo "<table border='1' style='color: black;', 'padding-top: 20px; width: 85%;'>
                        <tr>
                            <th style='font-size: 16px; width: 30%;'>Rạp Chiếu</th>
                            <th style='font-size: 16px; width: 30%;'>Thời Gian Bắt Đầu</th>
                            <th style='font-size: 16px; width: 30%;'>Thời Gian Kết Thúc</th>
                            <th style='font-size: 16px; width: 30%;'>Chọn</th>
                        </tr>";
                $current_cinema_id = $row["cinema_id"];
            }
    
            $startTime = date("H:i", strtotime($row["start_time"])); // Lấy thời gian bắt đầu chỉ với giờ:phút
            $duration = $row["duration"]; // Lấy giá trị duration hiện tại
    
            // Tính toán thời gian kết thúc
            $endTime = date("H:i", strtotime($startTime . " + " . $duration . " minutes"));
    
            // Hiển thị thông tin lịch chiếu cho từng cinema_id
            echo "<tr>
                    <td style='font-size: 15px; width: 30%;'>" . $row["cinema_name"] . "</td>
                    <td style='font-size: 15px; width: 30%;'>" . $startTime . "</td>
                    <td style='font-size: 15px; width: 30%;'>" . $endTime . "</td>
                    <td><button class='choose' onclick='redirectToIndexChonghe(" . $row["id"] . ")'>Chọn ghế</button></td>
                </tr>";
        }
    }
        echo "</table>"; // Kết thúc bảng cuối cùng
    } else {
        echo "<p>Không có lịch chiếu cho ngày đã chọn.</p>";
    }

$conn->close();
?>
