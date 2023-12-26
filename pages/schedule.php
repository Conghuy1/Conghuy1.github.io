<?php
// Bắt đầu phiên làm việc (session)
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name']) || $_SESSION['admin'] != 1) {
    // Nếu không có phiên đăng nhập hoặc không phải là admin, chuyển hướng về trang đăng nhập
    header("Location: ../index_signin.php");
    exit();
}

// Kết nối tới database để xem lịch chiếu
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" type="text/css" href="../css/schedule.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
</head>

<body>
    <header>
    <div class="sidebar">
        <div class="ad">
            <p class="ad-name"><?php echo $_SESSION['name']; ?></p>
            <img src="../images/logo3.png" alt="">
        </div>
        <div class="sidebar-icons">
        <div class="icon">
            <a href="../pages/admin.php">
                <i class="fa-solid fa-bars"></i>
                <span>Tổng quan</span>
            </a>
        </div>
        <div class="icon">
                <a href="../pages/edit_movie.php">
                    <i class="fa-solid fa-film"></i>
                    <span>Phim</span>
                </a>
        </div>
        <div class="icon1">
            <a href="../pages/schedule.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Xếp lịch chiếu</span>
            </a>
        </div>
        <div class="icon">
            <a href="../pages/user_adm.php">
            <i class="fa-solid fa-user-gear"></i>
                <span>Tài khoản</span>
            </a>
        </div>
        <div class="icon">
            <a href="../pages/index_homepage.php">
            <i class="fa-solid fa-house"></i>
                <span>Xem web</span>
            </a>
        </div>
        <div class="icon">
            <a href="../pages/index_signin.php">
            <i class="fa-solid fa-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
    </header>
    <h2 class="tieu-de">XẾP LỊCH CHIẾU</h2>

<!--Xem lich chieu-->
<div class="tieude">
    <h3>Lịch chiếu hiện tại</h3>
    <div class="line"></div>
</div>
<div class="select-date">
    <label for="selectDate" class="select-date-label">Chọn ngày xem lịch chiếu: </label>
    <select name="selectDate" id="selectDate">
        <option value="<?php echo date('Y-m-d'); ?>"><?php echo date('Y-m-d'); ?></option>
        <?php
        for ($i = 1; $i <= 7; $i++) {
            $nextDate = date('Y-m-d', strtotime("+" . $i . " day"));
            echo '<option value="' . $nextDate . '">' . $nextDate . '</option>';
        }
        ?>
    </select>
    
    <button type="button" id="xemButton" class="view-button">Xem</button>
</div>
<div id="scheduleResult" class="scheduleResult"></div>

<!--Tao lich chieu moi-->
<div class="tieude">
    <h3>Tạo lịch chiếu mới</h3>
    <div class="line"></div>
</div>
<!--Truc thoi gian-->
    <div class="cell time-markers" id="timeMarkersCell" dis></div>

<!--form chon phim-->
<div class="form-add-schedule" id="scheduleForm">
    <form id="addScheduleForm">
        <label for="movieToAdd">Chọn phim để thêm lịch: </label>
        <select id="movieToAdd" name="movieToAdd" required>
            <option value=""></option>
            <?php
            // Kết nối đến CSDL để lấy danh sách tên phim từ bảng "movie"
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_cnow1";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
            }

            // Truy vấn để lấy danh sách tên phim từ bảng "movie"
            $sql = "SELECT id, movie_name FROM movie";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Hiển thị các tên phim trong dropdown list
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['movie_name'] . '</option>';
                }
            }
            $conn->close();
        ?>
        </select><br><br>

        <label for="cinemaToAdd">Chọn rạp chiếu: </label>
        <select id="cinemaToAdd" name="cinemaToAdd" required>
            <option value=""></option>
            <?php
                // Kết nối đến CSDL để lấy danh sách rạp chiếu từ bảng "cinemas"
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_cnow1";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
                }

                // Truy vấn để lấy danh sách rạp chiếu từ bảng "cinemas"
                $sql = "SELECT cinema_id, cinema_name FROM cinemas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Hiển thị các rạp chiếu trong dropdown list
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['cinema_id'] . '">' . $row['cinema_name'] . '</option>';
                    }
                }
                $conn->close();
            ?>
        </select><br><br>

        <label for="startDate">Ngày Chiếu: </label>
        <input type="date" id="startDate" name="startDate" required><br><br>

        <label for="startTime">Thời Gian Bắt Đầu: </label>
        <input type="time" id="startTime" name="startTime" required><br><br>

        <input type="submit" value="Xác nhận">
    </form>
</div>
<div id="notification" class="notification" style="display: none;">
    Phim đã được thêm thành công!
</div>




    <script src="https://kit.fontawesome.com/54aec0924d.js" crossorigin="anonymous"></script>
    <script>

    //Chia thuoc tinh gio/thang
    function submitDateTime() {
    var startDate = document.getElementById('startDate').value;
    var startTime = document.getElementById('startTime').value;
    }
    //Thong bao khi them phim thanh cong
    $(document).ready(function() {
    $('#addScheduleForm').submit(function(e) {
        e.preventDefault(); // Ngăn chặn gửi form một cách tự động

        // Lấy dữ liệu từ form
        var formData = $(this).serialize();

        // Gửi dữ liệu form bằng AJAX đến process_schedule.php
        $.ajax({
            type: 'POST',
            url: '../pages/process_schedule.php',
            data: formData,
            dataType: 'json', // Chỉ định định dạng dữ liệu trả về là JSON
            success: function(response) {
                if (response.success) {
                    // Hiển thị thông báo thành công
                    $('#notification').text(response.message).fadeIn();
                } else {
                    // Hiển thị thông báo lỗi
                    $('#notification').text(response.message).fadeIn();
                }
                setTimeout(function() {
                    $('#notification').fadeOut();
                }, 5000); // Hiển thị thông báo trong 2 giây và sau đó ẩn nó đi
            },
            error: function(xhr, status, error) {
                console.error(error);
                }
            });
        });
    });


    //Script ajax lay thong tin lich chieu phim
    document.getElementById('xemButton').addEventListener('click', function() {
        var selectedDate = document.getElementById('selectDate').value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('scheduleResult').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "view_schedule.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("selectDate=" + selectedDate);
    });

    //Script xoa lich chieu
    function showNotification(message) {
        var notification = document.createElement('div');
        notification.classList.add('notification');
        notification.textContent = message;
        document.body.appendChild(notification);

        // Hiển thị thông báo trong 2 giây và sau đó ẩn đi
        setTimeout(function() {
            notification.style.display = 'block';
            setTimeout(function() {
                notification.style.display = 'none';
                notification.remove(); // Loại bỏ thông báo khỏi DOM
            }, 5000);
        }, 100);
    }

    function deleteSchedule(id) {
        $.ajax({
            type: 'POST',
            url: 'delete_schedule.php',
            data: { id: id },
            success: function(response) {
                showNotification("Đã xóa lịch chiếu");
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    </script>

</html>