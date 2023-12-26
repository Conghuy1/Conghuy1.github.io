<?php
// Bắt đầu phiên làm việc (session)
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name']) || $_SESSION['admin'] != 1) {
    // Nếu không có phiên đăng nhập hoặc không phải là admin, chuyển hướng về trang đăng nhập
    header("Location: ../index_signin.php");
    exit();
}

// Nếu đăng nhập thành công và là admin, hiển thị nội dung của trang quản trị
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" type="text/css" href="../css/edit_movie.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
    <!-- Các tài nguyên CSS hoặc các thẻ khác có thể được thêm vào đây -->
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
        <div class="icon1">
                <a href="../pages/edit_movie.php">
                    <i class="fa-solid fa-film"></i>
                    <span>Phim</span>
                </a>
        </div>
        <div class="icon">
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
<?php
        if (isset($_GET['noti'])) {
            $message = $_GET['noti']; ?>
<p class="noti"><?php echo $_GET['noti'];
        }
?>
</p>
    <!--Hien thi danh sach cac phim dang co-->
<div class="h2-header">
    <h2>Danh sách các bộ phim</h2>
</div>
<div class="movie-container">
    <?php
        $movies = include('movie.php'); // Sử dụng file PHP để lấy thông tin phim
        foreach ($movies as $movie) {
    ?>
    <div class="movie" id="<?php echo $movie['id']; ?>">
        <div class="image" data-image="<?php echo $movie['banner']; ?>" data-text="<?php echo $movie['movie_name']; ?>">
            <img src="<?php echo $movie['banner']; ?>">
        </a>
    </div>
</div>
    <?php
        }
    ?>
</div>
    <!--Chuyen danh sach-->
<div class="pagination">
    <button class="prev"><</button>
    <button class="next">></button>
</div>

<!--Chinh sua danh sach-->
<!--Them phim-->
<div class="add" onclick="toggleForm1()">
    <span class="add-text">Thêm phim</span>
    <i class="fa-solid fa-caret-down"></i>
</div>
<div class="form-container" id="movieForm" style="display: none;">
    <form id="addMovieForm" action="put_movie.php" method="post">
        <!-- Các trường nhập thông tin phim mới -->
        <label for="movieName">Tên phim:</label>
        <input type="text" id="movieName" name="movieName" required><br><br>
        <label for="banner">Link banner:</label>
        <input type="text" id="banner" name="banner" required><br><br>
        <label for="type">Phân loại độ tuổi:</label>
        <select id="type" name="type">
            <option value="P">P</option>
            <option value="K">K</option>
            <option value="T13">T13</option>
            <option value="T16">T16</option>
            <option value="T18">T18</option>
        </select><br><br>
        <label for="trailer">Link Trailer:</label>
        <input type="text" id="trailer" name="trailer" required><br><br>
        <label for="timen">Thời lượng:</label>
        <input type="number" id="timen" name="timen" required><br><br>
        <label for="director">Đạo diễn:</label>
        <input type="text" id="director" name="director" required><br><br>
        <!--Form nhan gia tri ngon ngu cua phim-->
        <label for="languageDubSub">Ngôn ngữ, Lồng tiếng, Phụ đề:</label>
        <select id="language" name="language">
            <option value="Tiếng Việt">Tiếng Việt</option>
            <option value="Tiếng Anh">Tiếng Anh</option>
            <option value="Tiếng Hàn">Tiếng Hàn</option>
            <option value="Tiếng Trung">Tiếng Trung</option>
            <option value="Tiếng Tây Ban Nha">Tiếng Tây Ban Nha</option>
            <option value="Khác">Khác</option>
        </select>
        <select id="dubbed" name="dubbed">
            <option value=""></option>
            <option value="VIE-DUB">VIE-DUB</option>
        </select>
        <select id="subtitles" name="subtitles">
            <option value=""></option>
            <option value="VIESUB">VIESUB</option>
            <option value="ENGSUB">ENGSUB</option>
            <option value="KORSUB">KORSUB</option>
            <option value="CHNSUB">CHNSUB</option>
            <option value="ESPSUB">ESPSUB</option>
            <option value="Khác">Khác</option>
        </select>
        <br><br>
        <input type="submit" value="Thêm">
    </form>
</div>
<!--Xoa phim-->
<div class="del" onclick="toggleDeleteForm()">
    <span class="del-text">Xóa phim</span>
    <i class="fa-solid fa-caret-down"></i>
</div>

<!-- Form HTML sử dụng dropdown list để chọn tên phim cần xóa -->
<div class="form-container-delete" id="deleteMovieForm" style="display: none;">
    <form action="delete_movie.php" method="post">
        <label for="movieToDelete">Chọn phim cần xóa:</label>
        <select id="movieToDelete" name="movieToDelete" required>
            <!-- Option 1 -->
            <option value=""></option>
            <!-- Option 2, Option 3, ... -->
            <!-- Tạo các option từ dữ liệu trong CSDL -->
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
                $sql = "SELECT movie_name FROM movie";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Hiển thị các tên phim trong dropdown list
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['movie_name'] . '">' . $row['movie_name'] . '</option>';
                    }
                }

                // Đóng kết nối CSDL
                $conn->close();
            ?>
        </select><br><br>
        <input type="submit" value="Xác nhận">
    </form>
</div>


    <!--Script-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/54aec0924d.js" crossorigin="anonymous"></script>
    <script>
        const movieContainer = document.querySelector('.movie-container');
        const movies = document.querySelectorAll('.movie');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');
        const itemsPerPage = 10;
        let currentPage = 1;
        function showMovies(page) {
            movies.forEach((movie, index) => {
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                if (index >= startIndex && index < endIndex) {
                    movie.classList.remove('hidden');
                } else {
                    movie.classList.add('hidden');
                }
            });
        }
        showMovies(currentPage);
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showMovies(currentPage);
            }
        });
        nextButton.addEventListener('click', () => {
            if (currentPage < Math.ceil(movies.length / itemsPerPage)) {
                currentPage++;
                showMovies(currentPage);
            }
        });
        function showMovies(page) {
            movies.forEach((movie, index) => {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
        
            if (index >= startIndex && index < endIndex) {
                movie.classList.remove('hidden');
                movie.style.pointerEvents = 'auto'; // Hiển thị và cho phép sự kiện chuột
            } else {
                movie.classList.add('hidden');
                movie.style.pointerEvents = 'none'; // Ẩn và vô hiệu hóa sự kiện chuột
            }
            });
        }
        //Script hien thi form them phim
        $(document).ready(function() {
        // Xử lý sự kiện click vào tiêu đề "Thêm phim"
        $('#addMovieHeader').on('click', function() {
            // Hiển thị hoặc ẩn biểu mẫu thêm phim khi click vào tiêu đề
            $('#addMovieForm').slideToggle();
        });
    });

    //Script hien form
    function toggleForm1() {
    var form = document.getElementById("movieForm");
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }

    //script hien form xoa phim
    function toggleDeleteForm() {
    var form = document.getElementById("deleteMovieForm");
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }

    </script>

</html>