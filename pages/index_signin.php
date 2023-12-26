<!--
=======================================================
* Sinh vien thuc hien: Nguyen Minh Hieu, Nguyen Cong Huy
* Lop: K65CNTTA
* De tai: Xay dung trang web ban ve xem phim
* GV huong dan: Le Thi Minh Thuy
* Thoi gian thuc hien: 15/8/2023 - 25/11/2023
=======================================================
                    -----TRANG DANG NHAP TAI KHOAN-----
TRANG WEB NAY HIEN THI 1 FORM GOM TEN DANG NHAP VA TAI KHOAN NGUOI DUNG
* Hien thi form dang nhap cho nguoi dung gom ten dang nhap va mat khau
* Su dung php va sql de so sanh voi thong tin trong database va cho phep nguoi dung dang nhap neu dung thong tin
* Bat dau 1 session neu dang nhap thanh cong
* Co cac link de dan nguoi dung den trang dang ky neu chua co tai khoan hoac ca noi dung khac cua he thong
-->
<!DOCTYPE html>
<html lang="vi">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_signin.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
</head>
<!--NOI DUNG TRANG WEB
================================================== -->
<body>
<header>
    <!-- NAVBAR
    ================================================== -->
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
                    <a class="nav-link-active" href="../pages/index_signin.php">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="background"></div>
<!-- FORM DANG KY
===================================================== -->
    <section class="home">
    <div class="container">
        <div class="content text-center">
            <h2>XIN CHÀO !</h2>
            <h3>HÃY ĐĂNG NHẬP TÀI KHOẢN CỦA BẠN</h3>
        </div>
        <form action="../pages/php/signin.php" method="post">
            <div class="login container">
                <h2 class="text-center">Đăng nhập</h2>
                <!--CAC THONG BAO TRANG THAI-->
                <?php
                if (isset($_GET['error'])) {
                    $message = $_GET['error']; ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php
                } elseif (isset($_GET['noti'])) {
                    $message = $_GET['noti']; ?>
                    <p class="noti"><?php echo $_GET['noti']; ?></p>
                <?php }
                ?>
                <div class="form-group input">
                    <input type="text" name="uname" class="input1" placeholder="Email" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="form-group input">
                    <input type="password" name="password" class="input1" placeholder="Mật khẩu" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="forgot">
                    <a href="#">Quên mật khẩu ?</a>
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
                <div class="sign-up">
                    <a href="../pages/index_signup.php">Tôi chưa có tài khoản, đăng ký tài khoản mới ?</a>
                </div>
            </div>
        </form>
    </div>
</section>
<!--FOOTER
================================================-->
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
</body>
</html>