<!--
=======================================================
* Sinh vien thuc hien: Nguyen Minh Hieu, Nguyen Cong Huy
* Lop: K65CNTTA
* De tai: Xay dung trang web ban ve xem phim
* GV huong dan: Le Thi Minh Thuy
* Thoi gian thuc hien: 15/8/2023 - 25/11/2023
=======================================================
                    -----TRANG THONG TIN BO PHIM-----
TRANG NAY HIEN THI CAC THONG TIN VE BO PHIM MA NGUOI DUNG CHON TU TRANG CHU HOAC TU LICH PHIM
* Su dung php de lay thong tin session xem nguoi dung da dang nhap vao tai khoan cua minh hay chua
* Su dung php de lay thong tin ve phim trong database dua theo gia tri cua `id` trong dia chi trang
* Hien thi ra man hinh cac thong tin tuong ung voi bo phim da chon
* Neu nguoi dung da co tai khoan thi co the xem duoc lich chieu phim cua phim khi click vao nut `Dat ve`
* Neu nguoi dung chua co tai khoan thi se chuyen huong nguoi dung den trang dang nhap khi click vao nut `Dat ve`
-->
<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION["user_name"])) {

?>
<!--HIEN THI O MAY DA DANG NHAP
=========================================================== -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_movies_info.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> 
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
</head>
<!-- NOI DUNG TRANG WEB
=========================================================== -->
<body>
<header>
    <!--NAVBAR
    =========================================================== -->
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
    <!--PROFILE NGUOI DUNG
    =========================================================== -->
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
            </li>
        </ul>
    </div>
</header>
<!-- THONG TIN PHIM HIEN TAI
=========================================================== -->
    <!--TIEU DE
    =========================================================== -->
<div class="container mt-4">
    <div class="header1 text-center">
        <h1>THÔNG TIN PHIM</h1>
        <div class="line"></div>
    </div>
</div>
<div class="info" id="<?php echo $selected_movie['id']; ?>">
    <!-- DOAN PHP DE LAY THONG TIN CUA PHIM TU DATABASE
    =========================================================== -->
    <?php
        $movies = include('movie.php');
        if(isset($_GET['id'])) {
        $selected_movie_id = $_GET['id'];
        $selected_movie = null;
        foreach ($movies as $movie) {
        if ($movie['id'] == $selected_movie_id) {
            $selected_movie = $movie;
            break;
        }
    }
        if ($selected_movie !== null) {
    ?>
    <!-- THONG TIN PHIM
    =========================================================== -->
    <!-- HINH ANH PHIM
    =========================================================== -->
    <div class="movie-image-container">
        <img id="selected-image" src="<?php echo $selected_movie['banner'];?>" alt="Hình ảnh phim">
    </div>
    <!-- THONG TIN CU THE
    =========================================================== -->
    <div class="info-container">
        <h1><?php echo $selected_movie['movie_name']; ?></h1>
        <ul>
            <li>Thời lượng: <?php echo $selected_movie['timen']; ?> phút</li>
            <li>Giới hạn độ tuổi: <?php echo $selected_movie['phan_loai']; ?></li>
            <li>Đạo diễn: <?php echo $selected_movie['director']; ?></li>
            <li>Thể loại: <?php echo $selected_movie['type']; ?></li>
            <li>Ngôn ngữ: <?php echo $selected_movie['ngon_ngu']; ?></li>              
        </ul>
    </div>
    <!-- NUT XEM TRAILER - DAT VE
    =========================================================== -->
    <div class="button">
        <form class="trailer" method="get" action="<?php echo $selected_movie['trailer']; ?>">
            <button type="submit">Trailer</button>
        </form>
        <form class="trailer1" method="get" action="dat_ve.php">
            <input type="hidden" name="id" value="<?php echo $selected_movie['id']; ?>">
            <button type="submit">Đặt vé</button>
        </form>
    </div>
</div>
        <?php
    } 
} 
?>
<!--FOOTER
=========================================================== -->
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
=========================================================== -->
    <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/scripts_movies_info.js"></script>
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
</body>
</html>
<?php
    exit();
}else{
?>
<!--HIEN THI O MAY KHACH
=========================================================== -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_movies_info.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> 
</head>
<!-- NOI DUNG TRANG WEB
=========================================================== -->
<body>
<header>
    <!-- NAVBAR
    =========================================================== -->
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
                    <a class="nav-link" href="../pages/index_logout.php">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
    <!--THONG TIN PHIM HIEN TAI
    =========================================================== -->
        <!-- TIEU DE
        =========================================================== -->
    <div class="container mt-4">
        <div class="header1 text-center">
            <h1>THÔNG TIN PHIM</h1>
            <div class="line"></div>
        </div>
    </div>

    <!--HINH ANH PHIM
    =========================================================== -->
    <div class="info" id="<?php echo $selected_movie['id']; ?>">
        <!-- DOAN MA PHP DE LAY THONG TIN PHIM TU DATABASE -->
        <?php
            $movies = include('movie.php');
            if(isset($_GET['id'])) {
            $selected_movie_id = $_GET['id'];
            $selected_movie = null;
            foreach ($movies as $movie) {
            if ($movie['id'] == $selected_movie_id) {
                $selected_movie = $movie;
                break;
            }
        }
            if ($selected_movie !== null) {
        ?>
        <div class="movie-image-container">
            <img id="selected-image" src="<?php echo $selected_movie['banner'];?>" alt="Hình ảnh phim">
        </div>
        <div class="info-container">
            <h1><?php echo $selected_movie['movie_name']; ?></h1>
            <ul>
                <li>Thời lượng: <?php echo $selected_movie['timen']; ?> phút</li>
                <li>Giới hạn độ tuổi: <?php echo $selected_movie['phan_loai']; ?></li>
                <li>Đạo diễn: <?php echo $selected_movie['director']; ?></li>
                <li>Thể loại: <?php echo $selected_movie['type']; ?></li>
                <li>Ngôn ngữ: <?php echo $selected_movie['ngon_ngu']; ?></li>              
            </ul>
        </div>
        <div class="button">
            <form class="trailer" method="get" action="<?php echo $selected_movie['trailer']; ?>">
                <button type="submit">Trailer</button>
            </form>
            <form class="trailer1" method="get" action="index_signin.php"> <!-- Neu nguoi dung co tai khoan thi moi cho phep chuc nang dat ve -->
                <input type="hidden" name="id" value="<?php echo $selected_movie['id']; ?>">
                <button type="submit">Đặt vé</button>
            </form>
        </div>
    </div>
        <?php
    } 
} 
?>
<!--FOOTER
=========================================================== -->
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
=========================================================== -->
    <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
    <script src="../js/scripts_movies_info.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</body>
</html>
<?php
}
?>