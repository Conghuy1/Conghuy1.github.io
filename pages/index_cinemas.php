<!--
=======================================================
* Sinh vien thuc hien: Nguyen Minh Hieu, Nguyen Cong Huy
* Lop: K65CNTTA
* De tai: Xay dung trang web ban ve xem phim
* GV huong dan: Le Thi Minh Thuy
* Thoi gian thuc hien: 15/8/2023 - 25/11/2023
=======================================================
                    ----- TRANG THONG TIN PHONG CHIEU-----
TRANG NAY HIEN THI CAC PHONG CHIEU DANG CO TRONG DATABASE, CHO PHEP NGUOI DUNG XEM DUOC LICH CHIEU PHIM CUA PHONG CHIEU DO TRONG NGAY HIEN TAI
* Kiem tra xem da co session hay chua de hien thi
* Su dung php de truy van tu database de hien thi danh sach cac phong chieu hien tai
* Khi nguoi dung click va nut `Xem lich chieu` thi se mo rong container cua cac phong chieu va hien thi lich chieu phim tuong ung cua phong chieu do
* Chuyen huong nguoi dung den trang thong tin cua bo phim khi nguoi dung click vao 1 lich chieu bat ki
* Nguoi dung bat buoc phai xem thong tin cua bo phim truoc khi tien hanh dat ve
-->
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION["user_name"])) {
?>
<!-- MAY DA DANG NHAP
=========================================== -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_cinemas.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
</head>
<!-- NOI DUNG TRANG WEB
========================================== -->
<body>
    <header>
        <!-- NAVBAR
        ====================================== -->
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
                        <a class="nav-link-active" href="../pages/index_cinemas.php">Rạp chiếu</a>
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
        <!--PROFILE-->
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
    <div class="tieuDe">
        <h2>HỆ THỐNG PHÒNG CHIẾU</h2>
        <p class="line"></p>
    </div>
    <!--HE THONG PHONG CHIEU 
    ============================================= -->
    <div class="cinema-container">
        <!-- LAY THONG TIN TU DATABASE -->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_cnow1";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }
        $currentDate = date("Y-m-d");
        //Truy van tu 2 bang `cinemas` va `screening`
        $sql = "SELECT cinemas.cinema_id, cinemas.cinema_name, cinemas.link, screening.movie_id, screening.start_time 
                FROM cinemas
                LEFT JOIN screening ON cinemas.cinema_id = screening.cinema_id
                WHERE DATE(screening.start_time) = '$currentDate'
                ORDER BY screening.start_time";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cinemaId = $row['cinema_id'];
                if (!isset($screeningsData[$cinemaId])) {
                    $screeningsData[$cinemaId] = [
                        'cinema_name' => $row['cinema_name'],
                        'link' => $row['link'],
                        'screenings' => []
                    ];
                }
                if (!empty($row['movie_id']) && !empty($row['start_time'])) {
                    $screeningsData[$cinemaId]['screenings'][] = [
                        'movie_id' => $row['movie_id'],
                        'start_time' => $row['start_time']
                    ];
                }
            }
            $delay = 1.0;
            $increment = 0.2;
            foreach ($screeningsData as $cinemaId => $cinemaData) {
                $name = $cinemaData['cinema_name'];
                $imageLink = $cinemaData['link'];
                $screenings = $cinemaData['screenings'];

                echo "<div cin-container-$cinemaId' class='cin-container' style='animation: slideIn1 " . $delay . "s ease-in-out;'>
                    <h2>$name</h2>
                    <img src='$imageLink' alt='Hình ảnh'>
                    <div class='lichchieu'>";

                // Hiển thị dữ liệu từ bảng screening và movie
                if (!empty($screenings)) {
                    echo "<ul> Lịch chiếu hôm nay";

                    foreach ($screenings as $screening) {
                        $movieId = $screening['movie_id'];
                        $startTime = $screening['start_time'];

                        // Truy vấn để lấy tên phim từ bảng movie dựa trên movie_id
                        $movieQuery = "SELECT movie_name FROM movie WHERE id = $movieId";
                        $movieResult = $conn->query($movieQuery);
                        if ($movieResult && $movieResult->num_rows > 0) {
                            $movieRow = $movieResult->fetch_assoc();
                            $movieName = $movieRow['movie_name'];

                            // Hiển thị tên phim và thời gian bắt đầu
                            $formattedTime = date("H:i", strtotime($startTime));
                            echo "<li><a href=../pages/index_movies_info.php?id=$movieId>$movieName </a>, thời gian: $formattedTime</li>";
                        }
                    }
                    echo "</ul>";
                }
                echo "</div>
                    <button onclick='expandAndHide(event)'><span>Xem lịch chiếu</span></button>
                    </div>";
                $delay += $increment;
            }
        } else {
            echo "Chưa có lịch chiếu hôm nay";
        }
        $conn->close();
        ?>
    </div>
    <!--FOOTER
    ============================================= -->
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
    ========================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c9f5871d83.js" crossorigin="anonymous"></script>
    <script src="../js/scripts_cinemas.js"></script>
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
        function expandAndHide(event) {
            var button = event.target;
            if (button.innerText === 'Xem lịch chiếu') {
                button.innerText = 'Ẩn lịch chiếu';
            } else {
                button.innerText = 'Xem lịch chiếu';
            }
                var clickedContainer = event.target.closest('.cin-container');

                // Nếu div đã được mở rộng, đảo ngược trạng thái
                if (clickedContainer.classList.contains('expanded')) {
                    // Xóa class 'expanded' khỏi div
                    clickedContainer.classList.remove('expanded');
                    clickedContainer.classList.add('no-animation');

                    // Hiển thị lại các div 'cin-container' khác
                    var allContainers = document.querySelectorAll('.cin-container');
                    allContainers.forEach(function(container) {
                        if (container !== clickedContainer) {
                            container.classList.remove('hide');
                            container.classList.add('no-animation')
                        }
                    });
                } else {
                    // Nếu div chưa được mở rộng, thực hiện mở rộng và ẩn đi
                    clickedContainer.classList.add('expanded');

                    // Ẩn đi các div 'cin-container' khác
                    var allContainers = document.querySelectorAll('.cin-container');
                    allContainers.forEach(function(container) {
                        if (container !== clickedContainer) {
                            container.classList.add('hide');
                            container.classList.add('no-animation'); // Loại bỏ lớp no-animation
                        }
                    });
                }
            }
    </script>
</body>
</html>
<?php
    exit();
}else{
?>
<!--MAY KHACH-->
<html lang="vi">
<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_cinemas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
</head>
<!-- NOI DUNG TRANG WEB
=========================================== -->
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
                        <a class="nav-link" href="../pages/index_homepage.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-active" href="../pages/index_cinemas.php">Rạp chiếu</a>
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
    <!--TIEU DE
    ====================================== -->
    <div class="tieuDe">
        <h2>HỆ THỐNG RẠP CHIẾU</h2>
        <p class="line"></p>
    </div>
    <!--HE THONG PHONG CHIEU
    ====================================== -->
    <div class="cinema-container">
        <!-- PHP THUC HIEN TRUY VAN TU DATABASE LAY THONG TIN CAC PHONG CHIEU VA LICH CHIEU PHIM TRONG NGAY-->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_cnow1";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        $currentDate = date("Y-m-d");
        // TRUY VAN TU 2 BANG `SCREENING` VA `CINEMAS`
        $sql = "SELECT cinemas.cinema_id, cinemas.cinema_name, cinemas.link, screening.movie_id, screening.start_time 
                FROM cinemas
                LEFT JOIN screening ON cinemas.cinema_id = screening.cinema_id
                WHERE DATE(screening.start_time) = '$currentDate'
                ORDER BY screening.start_time"; // Sắp xếp theo start_time tăng dần
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cinemaId = $row['cinema_id'];
                if (!isset($screeningsData[$cinemaId])) {
                    $screeningsData[$cinemaId] = [
                        'cinema_name' => $row['cinema_name'],
                        'link' => $row['link'],
                        'screenings' => []
                    ];
                }
                if (!empty($row['movie_id']) && !empty($row['start_time'])) {
                    $screeningsData[$cinemaId]['screenings'][] = [
                        'movie_id' => $row['movie_id'],
                        'start_time' => $row['start_time']
                    ];
                }
            }
            $delay = 1.0;
            $increment = 0.2;
            foreach ($screeningsData as $cinemaId => $cinemaData) {
                $name = $cinemaData['cinema_name'];
                $imageLink = $cinemaData['link'];
                $screenings = $cinemaData['screenings'];
                echo "<div cin-container-$cinemaId' class='cin-container' style='animation: slideIn1 " . $delay . "s ease-in-out;'>
                    <h2>$name</h2>
                    <img src='$imageLink' alt='Hình ảnh'>
                    <div class='lichchieu'>";

                if (!empty($screenings)) {
                    echo "<ul> Lịch chiếu hôm nay";

                    foreach ($screenings as $screening) {
                        $movieId = $screening['movie_id'];
                        $startTime = $screening['start_time'];

                        // Truy vấn để lấy tên phim từ bảng movie dựa trên movie_id
                        $movieQuery = "SELECT movie_name FROM movie WHERE id = $movieId";
                        $movieResult = $conn->query($movieQuery);
                        if ($movieResult && $movieResult->num_rows > 0) {
                            $movieRow = $movieResult->fetch_assoc();
                            $movieName = $movieRow['movie_name'];

                            // Hiển thị tên phim và thời gian bắt đầu
                            $formattedTime = date("H:i", strtotime($startTime));
                            echo "<li><a href=../pages/index_movies_info.php?id=$movieId>$movieName </a>, thời gian: $formattedTime</li>";
                        }
                    }

                    echo "</ul>"; // Kết thúc danh sách ul
                }
                echo "</div>
                    <button onclick='expandAndHide(event)'><span>Xem lịch chiếu</span></button>
                    </div>";
                $delay += $increment;
            }
        } else {
            echo "Chưa có lịch chiếu hôm nay";
        }
        $conn->close();
        ?>
    </div>
    <!--FOOTER
    ====================================== -->
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
    </footer>
    <!-- SCRIPTS 
    ============================================ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c9f5871d83.js" crossorigin="anonymous"></script>
    <script src="../js/scripts_cinemas.js"></script>
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
        function expandAndHide(event) {
            var button = event.target;
            if (button.innerText === 'Xem lịch chiếu') {
                button.innerText = 'Ẩn lịch chiếu';
            } else {
                button.innerText = 'Xem lịch chiếu';
            }
                var clickedContainer = event.target.closest('.cin-container');

                // Nếu div đã được mở rộng, đảo ngược trạng thái
                if (clickedContainer.classList.contains('expanded')) {
                    // Xóa class 'expanded' khỏi div
                    clickedContainer.classList.remove('expanded');
                    clickedContainer.classList.add('no-animation');

                    // Hiển thị lại các div 'cin-container' khác
                    var allContainers = document.querySelectorAll('.cin-container');
                    allContainers.forEach(function(container) {
                        if (container !== clickedContainer) {
                            container.classList.remove('hide');
                            container.classList.add('no-animation')
                        }
                    });
                } else {
                    // Nếu div chưa được mở rộng, thực hiện mở rộng và ẩn đi
                    clickedContainer.classList.add('expanded');

                    // Ẩn đi các div 'cin-container' khác
                    var allContainers = document.querySelectorAll('.cin-container');
                    allContainers.forEach(function(container) {
                        if (container !== clickedContainer) {
                            container.classList.add('hide');
                            container.classList.add('no-animation'); // Loại bỏ lớp no-animation
                        }
                    });
                }
            }
    </script>
</body>
</html>
<?php
}
?>
