<!--
=======================================================
* Sinh vien thuc hien: Nguyen Minh Hieu, Nguyen Cong Huy
* Lop: K65CNTTA
* De tai: Xay dung trang web ban ve xem phim
* GV huong dan: Le Thi Minh Thuy
* Thoi gian thuc hien: 15/8/2023 - 25/11/2023
=======================================================
                    -----TRANG DANG KY TAI KHOAN-----
TRANG WEB NAY CHO PHEP NGUOI DUNG DANG KY TAI KHOAN MOI DE SU DUNG CAC CHUC NANG CUA HE THONG NEU NHU CHUA CO TAI KHOAN
* Hien thi 1 form dien thong tin gom : Ten tai khoan, Ten nguoi dung, Mat khau va Mat khau lan 2 de tranh truong hop dang ky sai sot o mat khau
* Su dung php de so sanh voi thong tin trong database neu thong tin tai khoan chua ton tai thi truyen thong bao `Dang nhap thanh cong`
    `Dang ky khong thanh cong` neu da ton tai thong tin ma nguoi dung dang ky trong database
* Thong bao cho nguoi dung chi tiet xem da co thong tin nao bi trung
* Thong bao `Dang ky thanh cong` va chuyen nguoi dung toi trang dang nhap tai khoan
* Tien hanh bam mat khau nguoi dung truoc khi luu vao database
-->
<!DOCTYPE html>
<html lang="vi">
<head>
<title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
</head>
<!-- NOI DUNG TRANG WEB
======================================== -->
<body>
<header>
    <!-- NAVBAR
    =========================================-->
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
</header>
<div class="background"></div>
<section class="home">
    <div class="container">
        <div class="content text-center">
            <h2>XIN CHÀO !</h2>
            <h3>HÃY NHẬP THÔNG TIN TÀI KHOẢN CỦA BẠN</h3>
        </div>
        <div class="login container">
            <h2  class="text-center">Đăng ký</h2>
            <form action="../pages/php/signup.php" method="post">
            <!--PHP NHAN THONG BAO TU DIA CHI WEB-->
            <?php if (isset($_GET["error"])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <!--FORM DANG NHAP-->
            <div class="form-group input">
                <input type="text" name="uname" class="input1" placeholder="Tên đăng nhập" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="form-group input">
                <input type="text" name="name" class="input1" placeholder="Tên tài khoản" required>
                <i class="fa-solid fa-font"></i>
            </div>
            <div class="form-group input">
                <input type="password" name="password1" class="input1" placeholder="Mật khẩu" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="form-group input">
                <input type="password" name="password2" class="input1" placeholder="Nhập lại mật khẩu" required>
                <i class="fa-solid fa-key"></i>
            </div>
            <div class="button">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </div>
            </form>
            <div class="sign-up">
                <a href="../pages/index_signin.php">Tôi đã có tài khoản, đăng nhập ngay !</a>
            </div>
        </div> 
    </div>   
</section>
<!--FOOTER
========================================= -->
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
<!--SCRIPT
============================================ -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
</body>
</html>