<!--
=======================================================
* Sinh vien thuc hien: Nguyen Minh Hieu, Nguyen Cong Huy
* Lop: K65CNTTA
* De tai: Xay dung trang web ban ve xem phim
* GV huong dan: Le Thi Minh Thuy
* Thoi gian thuc hien: 15/8/2023 - 25/11/2023
=======================================================
                    -----TRANG HIEN THI LICH CHIEU THEO PHIM------
TRANG WEB NAY LAY GIA TRI CUA PHIM TU `id` TREN DIA CHI WEB VA THUC HIEN TRUY VAN VAO DATABASE DE HIEN THI LICH CHIEU TUNG NGAY THEO PHIM TUONG UNG
* Kiem tra xem da co session hay chua de hien thi
* Neu da co session thi nguoi dung moi duoc truy cap trang web nay
* Su dung flatpickr de hien thi bang chon ngay
* Khi nguoi dung chon ngay thi se hien thi cac lich chieu phim theo ngay tuong ung va chia thanh tung cum theo phong chieu
* Su dung ajax de hien thi muot ma
* Chuyen nguoi dung den trang dat ghe va thanh toan khi nguoi dung chon duoc phim theo lich minh muon
-->
<?php
session_start();
if(isset($_GET['id'])) {
    $selected_movie_id = $_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_cnow1";
    // Tạo kết nối đến CSDL
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
    }

    $sql = "SELECT movie_name FROM movie WHERE id = $selected_movie_id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $movie_name = $row['movie_name'];
    } else {
        $movie_name = "Không tìm thấy thông tin về phim";
    }

    $conn->close();
    
?>

<!DOCTYPE html>
<html lang="vi">

<head>
<title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_dat_ve.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> 
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
</head>
<!--NOI DUNG TRANG WEB
==================================== -->
<body>
<header>
<!-- NAVBAR
==================================== -->
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="#">
            <img src="../images/logo1.png" alt="Logo Trang Web">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m1-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../pages/index_homepage.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/index_cinemas.php">Rạp chiếu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/index_signin.php">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--PROFILE
    ============================================ -->
    <div class="user-prof">
        <div class="user-btn" id="userBtn">
            <p class="user-name"><?php echo $_SESSION['name']; ?></p>
            <i class="fas fa-user"></i>
        </div>
        <ul class="opt" id="userOptions">
            <li class="opt2">Thông tin tài khoản</li>
            <li class="opt2">Đóng góp ý kiến</li>
            <li class="opt1 logout">
                <a href="../pages/index_logout.php">Đăng xuất</a>
        </ul>
    </div>
</header>

<!--HIEN THI BANG CHON NGAY VA LICH CHIEU
======================================== -->
<div class="chonngay-con">
    <div class="lichchieu">
        <div class="container mt-4">
                <div class="header1">
                    <h1><?php echo $movie_name; ?></h1>
                    <div class="line">
                </div>
        </div>
    </div>
    <!--CHON NGAY DE XEM LICH
    ======================================== -->
    <div class= "xemlich">
        <div class="chon-ngay">
            <input class="input-day" type="text" id="datepicker" placeholder="Chọn ngày xem">
            <button id="xemButton" onclick="getXem()">Xem</button>
        </div>
        <div 
            id="lichChieu" class= "lichChieu">
        </div>
    </div>
</div>
<!--FOOTER
====================================== -->
<footer class="footer mt-4">
    <div class="container container2">
        <div class="d-flex">
            <div class="col-md-4">
                <img src="../images/logo2.png" alt="Company Logo" class="img-fluid">
            </div>
            <div class="col-md-4">
                <ul class="list-unstyled">
                    <li><a href="#">Về CNow</a></li>
                    <li><a href="#">Dịch vụ</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="#">Chăm sóc khách hàng</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <p>Hotline: 1900 xxxx</p>
                <p>Kết nối với CNow trên</p>
                <div class="social-icons">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- SCRIPTS
=============================== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/c9f5871d83.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var userProf = document.querySelector('.user-prof');
        var opt = document.querySelector('.opt');

        userProf.addEventListener('click', function () {
            opt.classList.toggle('active');
            userProf.classList.toggle('active');
        });

        // Menu
        // Đóng dropdown khi click bên ngoài
        document.addEventListener('click', function (event) {
            if (!userProf.contains(event.target)) {
                opt.classList.remove('active');
                userProf.classList.remove('active');
            }
        });
    });
</script>
<script>
    // jQuery script to toggle user options visibility
    $(document).ready(function(){
        $("#userBtn").click(function(){
            $("#userOptions").toggle();
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('.user-prof').length) {
                $("#userOptions").hide();
            }
        });
    });
</script>
<script>
    function getXem() {
        var selectedDate = document.getElementById('datepicker').value;
        var urlParams = new URLSearchParams(window.location.search);
        var movieID = urlParams.get('id'); // Lấy movie_id từ URL

        // Gửi dữ liệu ngày đã chọn và movie_id đến PHP để xử lý và hiển thị lịch chiếu
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('lichChieu').innerHTML = this.responseText;
        }
        };
        xhr.open("POST", "get_screening.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("selectDate=" + selectedDate + "&movieID=" + movieID); // Truyền cả selectedDate và movieID
    }

    flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        minDate: "today",
        maxDate: new Date().fp_incr(7), // Tối đa 7 ngày từ ngày hôm nay
    });
</script>
<script>
    function redirectToIndexChonghe(screeningID) {
        // Chuyển hướng người dùng đến trang index_chonghe.php với tham số screeningID
        window.location.href = '../pages/index_chonghe.php?screening_id=' + screeningID;
    }
</script>
</body>
</html>
<?php
    exit();
} else {
    echo "Không có thông tin về ID phim được truyền qua URL";
}
?>
