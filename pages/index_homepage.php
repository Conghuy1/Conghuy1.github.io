<!--
=======================================================
* Sinh vien thuc hien: Nguyen Minh Hieu, Nguyen Cong Huy
* Lop: K65CNTTA
* De tai: Xay dung trang web ban ve xem phim
* GV huong dan: Le Thi Minh Thuy
* Thoi gian thuc hien: 15/8/2023 - 25/11/2023
=======================================================
                    -----TRANG CHU-----
TRANG WEB NAY HIEN THI CAC BO PHIM NOI BAT VA DANH SACH CAC BO PHIM DANG CHIEU VA CUNG DONG THOI LA TRANG CHU
* Su dung php de lay thong tin session xem nguoi dung da dang nhap vao tai khoan cua minh hay chua
* Su dung Swiper de hien thi danh sach cac bo phim noi bat va tu dong chuyen sang slider khac sau 5s
* Thuc hien chuyen huong nguoi dung den cac trang khac cua he thong
* Su dung php de hien thi danh sach toan bo cac bo phim hien dang co lich chieu
* Hien thi cac thong tin quan trong: Ten phim, banner, thoi luong, gioi han do tuoi
* Su dung dung quy dinh cua Luat Dien Anh 2023 ve hien thi gioi han do tuoi
-->
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION["user_name"])) {
?>
<!--HIEN THI O MAY DA DANG NHAP
====================================================== -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_homepage.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">

</head>
<!-- NOI DUNG TRANG WEB
====================================================== -->
<body>
<header>
    <!--THANH NAVBAR
    ====================================================== -->
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="../pages/index_homepage.php">
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
    <!--PROFILE NGUOI DUNG
    ====================================================== -->
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
    <!--TIEU DE CUA SLIDER TRUOT
    ======================================================-->
<div class="header1">
    <div class="line"></div>
    <h1>PHIM HAY XEM NGAY</h1>
    <div class="line"></div>
</div>
    <!--SLIDER TRUOT CAC PHIM
    ======================================================-->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="../images/Banner1.jpg" alt="Image 1">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner2.jpg" alt="Image 2">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner3.jpg" alt="Image 3">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner4.jpg" alt="Image 4">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner5.jpg" alt="Image 5">
        </div>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
    <!--PHIM DANG CHIEU
    ====================================================== -->
<div class="header2">
    <div class="line"></div>
    <h1>PHIM ĐANG CHIẾU</h1>
    <div class="line"></div>
</div>

    <!-- DANH SACH CAC PHIM HIEN TAI
    ====================================================== -->
<div class="movie-container">
    <div class="mov-con">
        <!-- PHP DE LAY THONG TIN TU DATABASE
        ====================================================== -->
        <?php
            $movies = include('movie.php');

            foreach ($movies as $movie) {
                ?>
                <div class="movie" id="<?php echo $movie['id']; ?>">
                    <div class="image" data-image="<?php echo $movie['banner']; ?>" data-text="<?php echo $movie['movie_name']; ?>">
                        <a href="../pages/index_movies_info.php?id=<?php echo $movie['id'];?>">
                                <img src="<?php echo $movie['banner']; ?>">
                                <h2><?php echo $movie['movie_name']; ?></h2>
                        </a>
                    </div>
                    <div class="info">
                        <p>Thời lượng: <?php echo $movie['timen']; ?> phút</p>
                        <p>Phân loại độ tuổi: <?php echo $movie['phan_loai']; ?></p>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    <!--NUT CHUYEN DANH SACH-->
    <div class="pagination">
        <button class="prev"><</button>
        <button class="next">></button>
    </div>
</div>
    <!--FOOTER
    ====================================================== -->
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
====================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
    <script src="../js/scripts_homepage.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
            document.addEventListener('click', function (event) {
                if (!userProf.contains(event.target)) {
                    opt.classList.remove('active');
                    userProf.classList.remove('active');
                }
            });
        });
    </script>
    <script>
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
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000, // Đặt thời gian chuyển đổi giữa các slide (đơn vị: miligiây)
                disableOnInteraction: false, // Không tắt autoplay khi người dùng tương tác với slider
            },
        });
    </script>
</body>
</html>

<?php
    exit();
}else{
?>
<!--HIEN THI O MAY KHACH
====================================================== -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_homepage.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
</head>
<!--NOI DUNG TRANG WEB
====================================================== -->
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="../pages/index_homepage.php">
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
                    <a class="nav-link" href="../pages/index_cinemas.php">Rạp chiếu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/index_signin.php" id="login-button">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--SLIDER CAC PHIM
====================================================== -->
    <!-- TIEU DE -->
<div class="header1">
    <div class="line"></div>
    <h1>PHIM HAY XEM NGAY</h1>
    <div class="line"></div>
</div>
    <!--SLIDER CAC PHIM HIEN TAI-->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="../images/Banner1.jpg" alt="Image 1">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner2.jpg" alt="Image 2">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner3.jpg" alt="Image 3">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner4.jpg" alt="Image 4">
        </div>
        <div class="swiper-slide">
            <img src="../images/Banner5.jpg" alt="Image 5">
        </div>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
    <!--PHIM DANG CHIEU
    ====================================================== -->
    <!-- TIEU DE -->
<div class="header2">
    <div class="line"></div>
    <h1>PHIM ĐANG CHIẾU</h1>
    <div class="line"></div>
</div>
    <!-- HIEN THI CAC PHIM DANG CHIEU -->
<div class="movie-container">
    <div class="mov-con">
        <!-- PHP DE LAY DANH SACH TU DATABASE -->
        <?php
            $movies = include('movie.php');

            foreach ($movies as $movie) {
                ?>
                <div class="movie" id="<?php echo $movie['id']; ?>">
                    <div class="image" data-image="<?php echo $movie['banner']; ?>" data-text="<?php echo $movie['movie_name']; ?>">
                        <a href="../pages/index_movies_info.php?id=<?php echo $movie['id'];?>">
                                <img src="<?php echo $movie['banner']; ?>">
                                <h2><?php echo $movie['movie_name']; ?></h2>
                        </a>
                    </div>
                    <div class="info">
                        <p>Thời lượng: <?php echo $movie['timen']; ?> phút</p>
                        <p>Phân loại độ tuổi: <?php echo $movie['phan_loai']; ?></p>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    <div class="pagination">
        <button class="prev"><</button>
        <button class="next">></button>
    </div>
</div>
    <!--FOOTER 
    ====================================================== -->
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
    <!-- SCRIPT 
    ====================================================== -->
    <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
    <script src="../js/scripts_homepage.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
            document.addEventListener('click', function (event) {
                if (!userProf.contains(event.target)) {
                    opt.classList.remove('active');
                    userProf.classList.remove('active');
                }
            });
        });
    </script>
    <script>
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
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    </script>
</body>
</html>
<?php
}
?>