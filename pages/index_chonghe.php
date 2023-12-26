<!--
=======================================================
* Sinh vien thuc hien: Nguyen Minh Hieu, Nguyen Cong Huy
* Lop: K65CNTTA
* De tai: Xay dung trang web ban ve xem phim
* GV huong dan: Le Thi Minh Thuy
* Thoi gian thuc hien: 15/8/2023 - 25/11/2023
=======================================================
                    -----TRANG CHON GHE VA THANH TOAN-----
TRANG NAY HIEN THI TOAN BO THONG TIN GIAO DICH CHO NGUOI DUNG VE CHI TIET GIAO DICH DAT VE, CHO NGUOI DUNG CHON GHE, XEM GIA TIEN PHAI THANH TOAN
VA GUI MA DAT VE CHO NGUOI DUNG
* Kiem tra xem da co session hay chua de hien thi
* Lay ma lich chieu tu gia tri `screening_id` tren dia chi web
* Hien thi toan bo lai thong tin cua suat chieu: Ten phim, Thoi gian, Dia diem, Gia tien, Vi tri ghe
* Thuc hien truy van tu database de lay thong tin trang thai ghe tuong ung voi suat chieu da chon
* Thuc hien chuc nang thanh toan va hien thi ma dat ve tuong ung
* Hien thi chinh xac gia tien tuong ung voi so luon ghe da chon (100.000 VND/ve)
* Gan id cho tung ghe voi 2 thanh phan gom chu va so
* Gui du lieu ve database de cap nhat trang thai ghe
-->
<?php
  session_start();
      // Kiểm tra xem có thông tin về bộ phim được truyền qua URL không
      if (isset($_GET['screening_id'])) {
      $selected_screening_id = $_GET['screening_id'];

      // Kết nối đến CSDL (đây là các thông số bạn cần thay đổi để kết nối đúng với CSDL của bạn)
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "db_cnow1";

      // Tạo kết nối đến CSDL
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Kiểm tra kết nối có thành công không
      if ($conn->connect_error) {
          die("Kết nối đến CSDL thất bại: " . $conn->connect_error);
      }

      // Chuẩn bị truy vấn SQL để lấy thông tin về tên phim từ CSDL
      $sql = "SELECT movie_id FROM screening WHERE id = $selected_screening_id";

      // Thực hiện truy vấn
      $result = $conn->query($sql);

      // Kiểm tra và hiển thị thông tin về tên phim nếu truy vấn thành công
      if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $movie_name = $row['movie_id'];

          // Chuẩn bị truy vấn SQL để lấy thông tin về trạng thái ghế từ CSDL
          $sql_seats = "SELECT seat_name, status FROM seat_status WHERE screening_id = $selected_screening_id";

          // Thực hiện truy vấn
          $result_seats = $conn->query($sql_seats);

          // Kiểm tra và hiển thị trạng thái ghế nếu truy vấn thành công
          if ($result_seats && $result_seats->num_rows > 0) {
              $seat_status = array();
              while ($row_seat = $result_seats->fetch_assoc()) {
                  $seat_status[$row_seat['seat_name']] = $row_seat['status'];
              }
          }
      } else {
          $movie_name = "Không tìm thấy thông tin về phim";
          echo "Không có thông tin về screening ID phim được truyền qua URL";
      }

      // Đóng kết nối CSDL
      $conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<title>CNow-Đặt vé xem phim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_chonghe.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
  </head>
<!--NOI DUNG TRANG WEB
============================================= -->
<body>
<!--NAVBAR
============================================= -->
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
  <div class="user-prof">
      <div class="user-btn" id="userBtn">
          <p class="user-name"><?php echo $_SESSION['name']; ?></p>
          <i class="fas fa-user"></i>
          <a href=""></a>
      </div>
      <ul class="opt" id="userOptions">
          <li class="opt2">Thông tin tài khoản</li>
          <li class="opt2">Đóng góp ý kiến</li>
          <li class="opt1 logout">
              <a href="../pages/index_signin.php">Đăng xuất</a>
      </ul>
  </div>
</header>
<!--NOI DUNG GIAO DICH VA CHON GHE
=============================================== -->
  <div class= "pay-choose-container">
  <!--BANG THONG TIN GIAO DICH
  =============================================== -->
    <div class="pay-container">
      <div class="pay"> <!--Ban dau la col-md-6-->
          <?php
            // Kết nối đến cơ sở dữ liệu
            $servername = "localhost";
            $username = "root"; // Thay username bằng tên người dùng MySQL của bạn
            $password = ""; // Thay password bằng mật khẩu của bạn
            $dbname = "db_cnow1";

            // Tạo kết nối
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
            }

            // Lấy giá trị của screening_id từ URL
            if (isset($_GET['screening_id'])) {
              $screening_id = $_GET['screening_id'];

              // Truy vấn để lấy thông tin từ bảng 'screening' dựa trên screening_id
              $sql = "SELECT date, duration, movie_id, cinema_id, start_time FROM screening WHERE id = $screening_id";
              $result = $conn->query($sql);
          
              if ($result->num_rows > 0) {
                // Hiển thị thông tin lấy được từ bảng 'screening'
                $row = $result->fetch_assoc();
                $screening_date = $row['date'];
                $screening_duration = $row['duration'];
                $start_time = $row['start_time']; 
                $start_hour_minute = date('H:i', strtotime($start_time));
                $movie_id = $row['movie_id'];
                $cinema_id = $row['cinema_id'];
        
                // Truy vấn để lấy tên phim từ bảng 'movie' dựa trên movie_id
                $sql_movie = "SELECT movie_name, phan_loai FROM movie WHERE id = $movie_id";
                $sql_cinema = "SELECT cinema_name FROM cinemas WHERE cinema_id = $cinema_id";
                $result_movie = $conn->query($sql_movie);
                $result_cinema = $conn-> query($sql_cinema);
        
                if ($result_movie->num_rows > 0 || $result_cinema->num_rows > 0) {
                  // Hiển thị thông tin lấy được từ bảng 'movie'
                  $row_movie = $result_movie->fetch_assoc();
                  $movie_name = $row_movie['movie_name'];
                  $movie_age = $row_movie['phan_loai'];
                  //Hiển thị thông tin lấy từ bảng cinemas
                  $row_cinema = $result_cinema->fetch_assoc();
                  $cinema_name = $row_cinema['cinema_name'];

                // Hiển thị ngày chiếu trong HTML
                echo '<div class="pay"> <!--Ban dau la col-md-6-->
                  <h1>THÔNG TIN VÉ</h1>
                  <ul>
                      <li>Vé xem phim: ' . $movie_name . ' </li>
                      <li>Ngày chiếu: ' . $screening_date . '</li>
                      <li>Giờ chiếu: '.$start_hour_minute.' </li>
                      <li>Thời lượng: '.$screening_duration. ' phút</li>
                      <li>Giới hạn độ tuổi: '.$movie_age.'  </li>
                      <li>Rạp: '.$cinema_name.'</li>
                      <li>Các ghế được chọn: <span id="selectedSeatIds"></span></li>
                      <li id="totalPrice">Giá: <span id="total">0</span></li>
                  </ul>
              </div>';
              }
          }
        }
      ?>
        <button class="btn">Xác nhận</button>
      </div>
    </div>
  <!--BANG CHON GHE
  =============================================== -->
    <div class="choose-container">    
      <h1>Chọn ghế bạn muốn</h1>
      <ul class="showcase">
        <li>
        <div class="seat_empty"></div>
        <small>Còn trống</small>
        </li>
        <li>
          <div class="seat_selected"></div>
          <small>Đang chọn</small>
        </li>
        <li>
          <div class="seat_occupied"></div>
          <small>Đã chọn</small>
        </li>
      </ul>
      <div class="container">
        <div class="screen"></div>
        <p class="text">
          <span>Màn hình</span>
        </p>
        <div class="row-container">
          <!--60 GHE-->
            <div class="row">
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
            </div>
            <div class="row">
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
            </div>
            <div class="row">
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
            </div>
            <div class="row">
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
            </div>
            <div class="row">
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
            </div>
            <div class="row">
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
              <div class="seat"></div>
            </div>
        </div>            
        <p class="text">
          Bạn đã chọn <span id="count">0</span> ghế với giá <span id="total">0</span>
        </p>
      </div>
    </div>
  </div>
  <!--THONG BAO NOI VE MA DAT VE
  ============================================== -->
  <div class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Đặt vé thành công</p>
      <p>Mã đặt vé của bạn là</p>
      <p id="randomNumber"></p>
      <h4>Giữ mã này bí mật, CNow không chịu trách nhiệm trong trường hợp mã đặt vé của khách hàng bị lộ !</h4>
      <a href="../pages/index_information.php">Xem vé trong thông tin tài khoản</a>
    </div>
  </div>
  <!--FOOTER-->
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
  ============================================== -->
  <script>//Script doi mau ghe, tinh gia tien
    document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.seat:not(.occupied)');

    // Lặp qua mỗi ghế và thêm sự kiện click
    seats.forEach(seat => {
      seat.addEventListener('click', function () {
        // Nếu ghế chưa được chọn, thêm hoặc xóa lớp 'selected'
        if (!this.classList.contains('selected')) {
          this.classList.add('selected');
        } else {
          this.classList.remove('selected');
        }
        // Cập nhật số lượng ghế được chọn trước khi gọi hàm updateSelectedCount
        const selectedSeats = document.querySelectorAll('.seat.selected');
        const count = selectedSeats.length;

        // Hiển thị số lượng ghế được chọn và tính tổng giá ở đây (nếu có)
        const countElement = document.getElementById('count');
        const totalElement = document.getElementById('total');

        countElement.innerText = count;
        const formattedTotal = (count * 100000).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        totalElement.innerText = formattedTotal;
        // Hiển thị ID của các ghế được chọn
        displaySelectedSeatIds();
        });
      });

      // Hàm hiển thị ID của các ghế được chọn
      function displaySelectedSeatIds() {
        const selectedSeats = document.querySelectorAll('.seat.selected');
        const selectedSeatIds = [];

        // Lặp qua các ghế được chọn và lấy ID của chúng
        selectedSeats.forEach(seat => {
          selectedSeatIds.push(seat.getAttribute('id'));
        });

        // Hiển thị ID của các ghế được chọn ra màn hình
        const selectedSeatIdsElement = document.getElementById('selectedSeatIds');
        selectedSeatIdsElement.innerText = `${selectedSeatIds.join(', ')}`;
        }
      });
    // Lấy tất cả các ghế có class là "seat"
    const seats = document.querySelectorAll('.seat');

    const rowLetters = ['A', 'B', 'C', 'D', 'E', 'F'];

    let seatID = 1;

    // Duyệt qua mỗi ghế và gán ID
    for (let row = 0; row < rowLetters.length; row++) {
      for (let column = 1; column <= 10; column++) {
        const seat = seats[seatID - 1];

        // Gán ID dựa trên hàng và cột
        const seatLetter = rowLetters[row];
        const seatNumber = column;
        const seatId = seatLetter + seatNumber;

        seat.setAttribute('id', seatId);

        seatID++;

        if (seatID > seats.length) {
          break;
        }
      }
    } 
  </script>
  <script>//Script gui thong tin ve database
      document.addEventListener('DOMContentLoaded', function () {
      const seatStatus = <?php echo json_encode($seat_status); ?>;
      console.log(seatStatus);

      // Lặp qua mỗi ghế và cập nhật trạng thái dựa trên dữ liệu từ CSDL
      const seats = document.querySelectorAll('.seat');

      seats.forEach(seat => {
          const seatId = seat.getAttribute('id');
          if (seatStatus[seatId] == 1) {
            seat.classList.replace('seat', 'seat_occupied');
          }
      });
    });
  </script>
  <script>// Code JavaScript để xử lý khi người dùng ấn nút xác nhận
    document.addEventListener('DOMContentLoaded', function() {
    const confirmButton = document.querySelector('.btn');

    confirmButton.addEventListener('click', function() {
      const selectedSeats = document.querySelectorAll('.seat.selected');
      const selectedSeatIds = Array.from(selectedSeats).map(seat => seat.getAttribute('id'));

      // Gửi thông tin về các ghế đã chọn đến server bằng một Ajax request
      // Ví dụ sử dụng fetch
      fetch('cap_nhat_ghe.php', {
        method: 'POST',
        body: JSON.stringify({ selectedSeats: selectedSeatIds, screening_id: <?php echo $selected_screening_id; ?> }), 
        headers: {
          'Content-Type': 'application/json'
          }
        });
      });
    });
  </script>
  <script>//Script tạo thong bao va ma dat ve
    // Lấy các phần tử cần thiết
    document.addEventListener('DOMContentLoaded', function() {
    const modal = document.querySelector('.modal');
    const btn = document.querySelector('.btn');
    const closeBtn = document.querySelector('.close');
    const content = document.querySelector('.content');
    const randomNumberDisplay = document.getElementById('randomNumber');

    // Function để tạo chuỗi số ngẫu nhiên
    function generateRandomNumber() {
      const randomNum = Math.floor(Math.random() * 10000000000); // Tạo số ngẫu nhiên gồm 10 chữ số
      return randomNum.toString().padStart(10, '0'); // Chuyển số thành chuỗi và đảm bảo có đủ 10 chữ số
    }

    // Function để gửi dữ liệu đến máy chủ
    function sendDataToServer(randomNumber) {
      fetch('cap_nhat_ghe.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ user_code: randomNumber }) // Gửi dữ liệu ngẫu nhiên lên máy chủ
      })
      .then(response => {
        // Xử lý phản hồi từ máy chủ nếu cần
        console.log('Dữ liệu đã được gửi thành công.');
      })
      .catch(error => {
        // Xử lý lỗi nếu có
        console.error('Có lỗi xảy ra khi gửi dữ liệu:', error);
      });
    }

    // Khi nút được nhấp
    btn.addEventListener('click', function() {
      const randomNum = generateRandomNumber();
      randomNumberDisplay.textContent = randomNum; // Hiển thị số ngẫu nhiên trong modal
      modal.style.display = 'block'; // Hiển thị modal
      content.classList.add('modal-active'); // Làm mờ nền

      // Gửi dữ liệu ngẫu nhiên lên máy chủ khi modal được hiển thị
      sendDataToServer(randomNum);
    });

    // Khi nút đóng được nhấp
    closeBtn.addEventListener('click', function() {
      modal.style.display = 'none'; // Ẩn modal
      content.classList.remove('modal-active'); // Loại bỏ hiệu ứng làm mờ nền
      });
    });
  </script>
  <!-- CAC SCRIPT KHAC
  ============================================== -->
  <script src="https://kit.fontawesome.com/c9f5871d83.js"> crossorigin="anonymous"</script>
  <script src="../js/scripts_movies_info.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
} else {
    echo "Không có thông tin về screening ID phim được truyền qua URL";
}
?>