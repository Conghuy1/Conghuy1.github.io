<!DOCTYPE html>
<html lang="vi">

<head>
    <title>CNow-Đặt vé xem phim</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_thanhtoan.css">
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
                        <a class="nav-link-active" href="../pages/index_cinemas.php">Rạp chiếu</a>
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
      <!--Tieu de-->
    <div class="container container1 mt-4">
        <div class="header1 text-center">
            <h1>THANH TOÁN</h1>
            <div class="line"></div>
        </div>
    </div>
    <!--Container tt -->
<div class="container container1 mt-5">
    <div class="row">
        <!-- Container cho ảnh phim -->
        <div class="col-md-6">
            <img src="../images/movie1.jpg" alt="Movie Poster" class="img-fluid">
        </div>

        <!-- Container cho thông tin phim -->
        <div class= "inf">
            <div class="col-md-6">
                <h1>Tên phim:</h1>
                <ul>
                    <li>Ngày chiếu: ;</li>
                    <li>Thời lượng: ; phút</li>
                    <li>Giới hạn độ tuổi: ; </li>
                    <li>Rạp: ;</li>
                    <li>Số ghế: ; </li>
                    <li id="totalPrice">Thành tiền: ; </li>
                </ul>
            </div>
            <!-- Nút thanh toán -->
                <button class= "btn" id="paymentButton">Thanh toán</button>
        </div>
        <div class="qrcode">
            <img src="QR.jpg" alt="Qr thanh toan">
        </div>
    </div>
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
    </footer>
    <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
    <script src="../js/scripts_thanhtoan.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<!--SCrript-->

<!-- Navbar -->
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
<!--Thanh tien-->
<script>
    // Số cần nhân với 100,000 VNĐ
    var a = 5; // Đây là ví dụ, bạn có thể thay đổi giá trị của a theo nhu cầu

    // Thực hiện phép nhân
    var totalPrice = a * 100000;

    // Hiển thị kết quả trong thẻ li có id="totalPrice"
    document.getElementById("totalPrice").innerHTML = "Thành tiền: " + totalPrice.toLocaleString() + " VNĐ";
  </script>

<script>
    document.getElementById("paymentButton").addEventListener("click", function() {
    // Thêm logic xử lý thanh toán ở đây
    alert("Chuyển đến trang thanh toán...");
    // Hoặc chuyển hướng đến trang thanh toán
    // window.location.href = "trang-thanh-toan.html";
});
</script>
</html>


