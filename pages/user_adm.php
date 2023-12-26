<?php
// Bắt đầu phiên làm việc (session)
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name']) || $_SESSION['admin'] != 1) {
    // Nếu không có phiên đăng nhập hoặc không phải là admin, chuyển hướng về trang đăng nhập
    header("Location: ../index_signin.php");
    exit();
}

// Kết nối tới database để xem lịch chiếu
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" type="text/css" href="../css/user_adm.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
        <div class="icon1">
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

<!--Tieu de-->
    <h2 class="tieu-de">Quản Lý Tài Khoản</h2>

    <div class="user-sum-container">
        <div class="user-sum">
            <div class="user-total">
                <p>Số người dùng :</p>
            </div>
            <div class="admin-total">
                <p>Số tài khoản admin: </p>
            </div>
        </div>
    </div>
<!--Cap quyen admin-->
    <div class="tieude">
        <h3>Cấp quyền quản trị</h3>
        <div class="line"></div>
    </div>
<!-- Form cấp quyền admin -->
<form id="grantAdminForm" class="add_admin_form">
    <label for="add_user_id">Nhập ID người dùng:</label>
    <input type="text" id="add_user_id" name="user_id" class="add_admin">
    <input type="submit" value="Cấp quyền admin" class="add_admin_button">
</form>
<div id="add_notification" class="add-notification" style="display: none;">Cấp quyền quản trị thành công !</div>

<!-- Form xóa quyền admin -->
<div class="tieude">
    <h3>Xóa quyền quản trị</h3>
    <div class="line"></div>
</div>
<form id="deleteAdminForm" class="del_admin_form">
    <label for="delete_user_id">Nhập ID người dùng:</label>
    <input type="text" id="delete_user_id" name="user_id" class="del_admin">
    <input type="submit" value="Xóa quyền admin" class="del_admin_button">
</form>
<div id="delete_notification" class="delete-notification" style="display: none;">Xóa quyền quản trị thành công !</div>

    <script src="https://kit.fontawesome.com/54aec0924d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        // Xử lý sự kiện khi form cấp quyền admin được submit
        $("#grantAdminForm").submit(function(event) {
            event.preventDefault();

            var userId = $("#add_user_id").val();

            $.ajax({
                url: 'grant_admin.php',
                type: 'POST',
                data: { user_id: userId, grant_admin: true },
                success: function(response) {
                    if (response.success) {
                        if ($("#grantAdminForm").length) {
                            $('#add_notification').text(response.message);
                            $('#add_notification').fadeIn();

                            setTimeout(function() {
                                $('#add_notification').fadeOut();
                            }, 5000);
                        }

                        updateUserInfo();
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        });

        // Xử lý sự kiện khi form xóa quyền admin được submit
        $("#deleteAdminForm").submit(function(event) {
            event.preventDefault();

            var userId = $("#delete_user_id").val();

            $.ajax({
                url: 'grant_admin.php',
                type: 'POST',
                data: { user_id: userId, delete_admin: true },
                success: function(response) {
                    if (response.success) {
                        if ($("#deleteAdminForm").length) {
                            $('#delete_notification').text(response.message);
                            $('#delete_notification').fadeIn();

                            setTimeout(function() {
                                $('#delete_notification').fadeOut();
                            }, 5000);
                        }

                        updateUserInfo();
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        });

        // Hàm cập nhật thông tin người dùng
        function updateUserInfo() {
            $.ajax({
                url: 'grant_admin.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('.user-total p').text('Số người dùng: ' + response.total_users);
                    $('.admin-total p').text('Số tài khoản admin: ' + response.total_admin);
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        }

        // Cập nhật thông tin người dùng khi trang được tải
        updateUserInfo();
    });

    </script>
</html>