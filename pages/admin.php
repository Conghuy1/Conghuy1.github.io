<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION["user_name"])) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../images/logo3.png" type="image/x-icon">
    <!--Truy van bang db_cnow1-->
    <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "root"; // Thay username bằng thông tin đăng nhập của bạn
        $password = ""; // Thay password bằng thông tin đăng nhập của bạn
        $dbname = "db_cnow1";

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn SQL để lấy số lượng status = 1 và tổng số lượng dữ liệu
        $sql = "SELECT 
                    SUM(CASE WHEN ss.status = 1 THEN 1 ELSE 0 END) AS occ,
                    (SELECT COUNT(*) FROM seat_status) AS total
                FROM seat_status ss
                LEFT JOIN screening sc ON ss.screening_id = sc.id
                WHERE ss.status = 1 AND DATE(sc.date) = CURDATE()";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Lấy kết quả từ truy vấn
            $row = $result->fetch_assoc();
            $occ = $row['occ']; // Số lượng status = 1
            $total = $row['total']; // Tổng số lượng dữ liệu trong seat_status
            $percentage = ($occ / $total) * 100;
            $revenue = $occ * 100000;
            $revenueFormatted = number_format($revenue, 0, '.', ' ');

            // Đóng kết nối
            $conn->close();
        } else {
            echo "Không có dữ liệu!";
        }
        ?>
    <!--Truy van bang tatistical-->
    <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "root"; // Thay username bằng thông tin đăng nhập của bạn
        $password = ""; // Thay password bằng thông tin đăng nhập của bạn
        $dbname = "dashboard";

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn SQL để lấy dữ liệu 'date' và 'revenue' từ cơ sở dữ liệu
        $sql = "SELECT date, revenue FROM tatistical";

        $result = $conn->query($sql);

        $dataArray = array();

        if ($result->num_rows > 0) {
            // Lặp qua các hàng dữ liệu
            while ($row = $result->fetch_assoc()) {
                // Chuyển đổi định dạng ngày tháng từ 'YYYY-MM-DD' sang 'D'
                $date = date('j/n', strtotime($row["date"])); // Lấy ngày trong tháng

        // Đưa dữ liệu vào mảng với tên cột 'Ngày' và 'Doanh thu'
            $dataArray[] = ['Ngày', 'Doanh thu']; // Tên cột
            $dataArray[] = [$date, intval($row["revenue"])];
            } // Thêm dòng này để đóng vòng lặp
        } else {
            echo "Không có dữ liệu!";
        }

        // Chuyển đổi mảng PHP thành chuỗi JSON để truyền vào JavaScript
        $dataJson = json_encode($dataArray);

        // Đóng kết nối
        $conn->close();
    ?>

    <?php
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root"; // Thay username bằng thông tin đăng nhập của bạn
    $password = ""; // Thay password bằng thông tin đăng nhập của bạn
    $dbname = "dashboard";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn SQL để lấy dữ liệu 'date' và 'useracc' từ cơ sở dữ liệu
    $sqlCusChart = "SELECT date, useracc FROM tatistical";

    $resultCusChart = $conn->query($sqlCusChart);

    $dataArrayCusChart = array();

    if ($resultCusChart->num_rows > 0) {
        $dataArrayCusChart[] = ['Ngày', 'Số lượng tài khoản']; // Tên cột
        while ($row = $resultCusChart->fetch_assoc()) {
            $date = date('j/n', strtotime($row["date"])); // Lấy ngày trong tháng

            // Đưa dữ liệu vào mảng cho biểu đồ cusChart
            $dataArrayCusChart[] = [$date, intval($row["useracc"])];
        }
    }

    // Chuyển đổi mảng PHP thành chuỗi JSON cho cusChart
    $dataJsonCusChart = json_encode($dataArrayCusChart);
    ?>

    <!--Lay du lieu occ-->
    <?php
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root"; // Thay username bằng thông tin đăng nhập của bạn
    $password = ""; // Thay password bằng thông tin đăng nhập của bạn
    $dbname = "dashboard";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn SQL để lấy dữ liệu 'date' và 'occ' từ cơ sở dữ liệu
    $sqlOccChart = "SELECT date, occ FROM tatistical";

    $resultOccChart = $conn->query($sqlOccChart);

    $dataArrayOccChart = array();

    if ($resultOccChart->num_rows > 0) {
        $dataArrayOccChart[] = ['Ngày', 'Tỷ lệ lấp đầy']; // Tên cột
        while ($row = $resultOccChart->fetch_assoc()) {
            $date = date('j/n', strtotime($row["date"])); // Lấy ngày trong tháng
            $Occ = floatval($row["occ"]);

            // Đưa dữ liệu vào mảng cho biểu đồ cusChart
            $dataArrayOccChart[] = [$date, $Occ];
        }
    }

    // Chuyển đổi mảng PHP thành chuỗi JSON cho cusChart
    $dataJsonOccChart = json_encode($dataArrayOccChart);
    ?>

    <!--Gui tong ket ngay-->
    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Kết nối đến cơ sở dữ liệu
            $servername = "localhost";
            $username = "root"; // Thay username bằng thông tin đăng nhập của bạn
            $password = ""; // Thay password bằng thông tin đăng nhập của bạn
            $dbname = "tatistical"; // Thay tên cơ sở dữ liệu của bạn

            // Lấy dữ liệu từ yêu cầu POST
            $date = $_POST['date'];
            $customer = $_POST['customer'];
            $occ = $_POST['occ'];
            $revenue = $_POST['revenue'];
            $user_acc = $_POST['user_acc'];

            // Tạo kết nối đến cơ sở dữ liệu
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Chuẩn bị truy vấn SQL để chèn dữ liệu vào bảng tatistical
            $sql = "INSERT INTO tatistical (date, customer, occ, revenue, user_acc)
                    VALUES ('$date', $customer, $occ, $revenue, $user_acc)";

            if ($conn->query($sql) === TRUE) {
                echo "Dữ liệu đã được lưu trữ thành công";
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }

            // Đóng kết nối
            $conn->close();
        }
?>


    <!--Google Chart-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--Bieu do Occ-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});

        // Vẽ biểu đồ Occ khi thư viện đã được load
        google.charts.setOnLoadCallback(drawChart);

        // Vẽ biểu đồ doanh thu
        google.charts.setOnLoadCallback(drawrevChart);

        //Vẽ biểu đồ số lượng tài khoản
        google.charts.setOnLoadCallback(drawCusChart);

        //Vẽ biểu đồ tỷ lệ lấp đầy
        google.charts.setOnLoadCallback(drawOccChart);

        function drawChart() {
            // Dữ liệu biểu đồ Occ
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Occ'],
                ['Đã đặt', <?php echo $occ; ?>],
                ['Còn trống', <?php echo ($total - $occ); ?>]
            ]);

            // Tùy chọn biểu đồ Occ
            var options = {
                title: 'Tỷ lệ lấp đầy phòng chiếu',
                width: 500,
                height: 300,
                chartArea: { width: '100%', height: '80%' },
                animation: {
                    duration: 5000,
                    startup: true,
                    easing: 'out'
                }
            };
            
            // Vẽ biểu đồ Occ trong div có id là 'occChart'
            var chart = new google.visualization.PieChart(document.getElementById('occChart'));
            chart.draw(data, options);
        }

        function drawrevChart() {
            console.log(<?php echo $dataJson; ?>);
            var data = google.visualization.arrayToDataTable(<?php echo $dataJson; ?>);
            // Tùy chọn biểu đồ doanh thu
            var options = {
                title: 'Doanh thu theo tháng',
                legend: 'none',
                bars: 'vertical',
                hAxis: { textPosition: 'none' },
                chartArea: { width: '80%', height: '80%' },
                series: {
                    0: { color: 'green' }, // Màu của chuỗi dữ liệu thứ nhất (Sales)
                }
            };
            // Vẽ biểu đồ doanh thu trong div có id là 'revenue-chart'
            var chart = new google.visualization.ColumnChart(document.getElementById('revenue-chart'));
            chart.draw(data, options);
        }

        function drawCusChart() {
        // Dữ liệu biểu đồ cusChart từ PHP
        var dataCusChart = google.visualization.arrayToDataTable(<?php echo $dataJsonCusChart; ?>);

        // Tùy chọn biểu đồ cusChart
        var optionsCusChart = {
            title: 'Số lượng tài khoản',
            curveType: 'function',
            legend: { position: 'bottom'},
        };

        // Vẽ biểu đồ cusChart trong div có id là 'cus-chart'
        var chartCus = new google.visualization.LineChart(document.getElementById('cus-chart'));
        chartCus.draw(dataCusChart, optionsCusChart);
    }

            function drawOccChart() {
            console.log(<?php echo $dataJsonOccChart; ?>); 
            var data = new google.visualization.arrayToDataTable(<?php echo $dataJsonOccChart; ?>);

            var options = {
                title: 'Tỷ lệ lấp đầy (%)',
                curveType: 'function',
                legend: { position: 'bottom' },
                chartArea: { width: '80%', height: '70%' },
                series: {
                    0: { color: 'red' }, // Màu của chuỗi dữ liệu thứ nhất (Sales)
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('occ-chart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <header>
    <div class="sidebar">
        <div class="ad">
            <p class="ad-name"><?php echo $_SESSION['name']; ?></p>
            <img src="../images/logo3.png" alt="">
        </div>
        <div class="sidebar-icons">
            <div class="icon1">
                <a href="../pages/admin.php">
                    <i class="fa-solid fa-bars"></i>
                    <span>Tổng quan</span>
                </a>
            </div>
            <div class="icon">
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
    </div>
    </header>
    <!--Tong quan-->
    <div class="summary-container">
        <p>THÔNG TIN HIỆN TẠI</p>
        <div class="summary">
            <div class="sum1">
                <p class="sum-title">Số khách đặt vé hôm nay:</p>
                <p class="sum-data"><?php echo $occ;?></p>
            </div>
            <div class="sum1">
                <p class="sum-title">Doanh thu hôm nay:</p>
                <p class="sum-data"><?php echo $revenueFormatted;?></p>
            </div>
            <div class="sum1">
                <p class="sum-title">Tỉ lệ lấp đầy:</p>
                <p class="sum-data"><?php echo number_format($percentage, 1); ?>%</p>
            </div>
        </div>
        <button id="summary-button">Tổng kết ngày</button>
    </div>
    <!--Bieu do va bang xep hang-->
    <div class="chart-bxh-container">
        <p>THỐNG KÊ NGÀY HÔM NAY</p>
        <!--Bieu do Occ-->
        <div class="chart-bxh">
            <div id="occChart" class="occChart"></div>
            <!--BXH-->
            <div class="bxh-con">
                <p>Top 5 Phim Doanh Thu Cao Nhất Trong Ngày</p>
                <?php
                    // Kết nối đến cơ sở dữ liệu
                    $servername = "localhost";
                    $username = "root"; // Thay username bằng thông tin đăng nhập của bạn
                    $password = ""; // Thay password bằng thông tin đăng nhập của bạn
                    $dbname = "db_cnow1";

                    // Tạo kết nối
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Kiểm tra kết nối
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }

                    // Lấy ngày hiện tại
                    $currentDate = date("Y-m-d");

                    // Truy vấn SQL để lấy danh sách các phim xếp hạng cao nhất trong ngày
                    $sql = "SELECT m.movie_name
                    FROM (
                        SELECT s.id AS screening_id, COUNT(ss.status) AS status_count
                        FROM screening s
                        LEFT JOIN seat_status ss ON s.id = ss.screening_id
                        WHERE DATE(s.date) = '$currentDate' AND ss.status = 1
                        GROUP BY s.id
                        ORDER BY status_count DESC
                        LIMIT 5
                    ) AS top_movies
                    LEFT JOIN screening s ON top_movies.screening_id = s.id
                    LEFT JOIN movie m ON s.movie_id = m.id";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<ul>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<li>" . $row["movie_name"] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Không có dữ liệu xếp hạng phim nào trong ngày!";
                    }

                    // Đóng kết nối
                    $conn->close();
                ?>
            </div>
        </div>
    </div>
    <!--Thong ke trong tuan-->
    <div class="week-dashboard-container">
        <div class="week-dashboard-con">
            <p>THỐNG KÊ GẦN ĐÂY</p>
        </div>
        <div class="week-dashboard-charts">
            <div class="revenue-chart" id="revenue-chart">
            </div>
            <div class="customer-chart" id="cus-chart">
            </div>
            <div class="occ-chart" id="occ-chart">
            </div>
        </div>
    </div>


    <!--Scripts-->
    <script src="https://kit.fontawesome.com/54aec0924d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.querySelector('button').addEventListener('click', function() {
            var customerValue = document.querySelector('.sum-data:nth-child(1)').textContent.trim();
            var revenueValue = document.querySelector('.sum-data:nth-child(2)').textContent.trim();
            var occValue = document.querySelector('.sum-data:nth-child(3)').textContent.trim();

            // Gửi dữ liệu đến server-side PHP
            fetch('insert_data_tatistical.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'customer=' + encodeURIComponent(customerValue) + '&occ=' + encodeURIComponent(occValue) + '&revenue=' + encodeURIComponent(revenueValue)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Log kết quả trả về từ server
                // Thực hiện các hành động khác sau khi dữ liệu được chèn thành công (nếu cần)
            })
            .catch(error => {
                console.error('Lỗi:', error);
            });
        });
    </script>

</html>
<?php
}
?>