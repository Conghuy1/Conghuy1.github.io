<?php
session_start();
include "db_users_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

        $sql = "SELECT * FROM users WHERE user_name = '$uname'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Sử dụng password_verify để kiểm tra mật khẩu
            if (password_verify($pass, $row['password'])) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['admin'] = $row['admin'];
                if ($_SESSION['admin'] == 1) {
                    header("Location: ../admin.php"); // Chuyển hướng đến trang quản trị
                    exit(); // Đảm bảo không có mã HTML/PHP khác được thực thi sau khi chuyển hướng
                } else{
                    header("Location: ../index_homepage.php");
                    exit();
                }
            } else {
                header("Location: ../index_signin.php?error=Tên đăng nhập hoặc mật khẩu không đúng");
                exit();
            }
        } else {
            header("Location: ../index_signin.php?error=Tên đăng nhập hoặc mật khẩu không đúng");
            exit();
        }
    
}else {
    header("Location: ../index_signin.php");
    exit();
}
