<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION["user_name"])) {

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_information.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
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
                        <a class="nav-link-active" href="../pages/index_homepage.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-active" href="../pages/index_cinemas.html">Rạp chiếu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-active" href="#">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-active" href="../pages/index_signin.php">Đăng nhập</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Profile-->
        <div class="user-prof">
            <div class="user-btn" id="userBtn">
                <p class="user-name"><?php echo $_SESSION['name']; ?></p>
                <i class="fas fa-user"></i>
            </div>
            <ul class="opt" id="userOptions">
                <li class="opt2">Thông tin tài khoản</li>
                <li class="opt2">Đóng góp ý kiến</li>
                <li class="opt1 logout">
                    <a href="../pages/index_signin.php">Đăng xuất</a>
            </ul>
        </div>
    </header>
        <!--Noi dung chinh-->
        <div class="background"></div>
        <div class="header1 text-center">
            <div class="line"></div>
            <h1>THÔNG TIN TÀI KHOẢN</h1>
            <div class="line"></div>
        </div>

        <!--info_container-->
        <div class="info-container">
            <img id="barcodeDisplay" alt="Barcode">
            <ul>
                <li>Tên tài khoản: <?php echo $_SESSION['name'];?></li>
                <li>Tên đăng nhập: <?php echo $_SESSION['user_name'];?></li>
            </ul>
        </div>
        <!--Footer-->
<footer class="footer mt-4">
    <div class="container">
        <div class="row">
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

<script src="https://kit.fontawesome.com/c9f5871d83.js"></script>
<script src="../js/scripts_information.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

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
<!--Prof-->
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
</html>
<?php
    exit();
}
 ?>
