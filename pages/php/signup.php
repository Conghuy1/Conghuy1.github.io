<?php
session_start();
include"db_users_conn.php";


//Hàm lấy ID ngẫu nhiên
function generateUUID() {
    return sprintf('%04d%04d%04d%04d',
        mt_rand(0, 9999), mt_rand(0, 9999),
        mt_rand(0, 9999), mt_rand(0, 9999)
    );
}


// Lấy dữ liệu từ form đăng ký
$new_id = generateUUID();
$new_username = $_POST['uname']; // Lấy giá trị của uname từ form
$new_name = $_POST['name']; // Lấy giá trị của name từ form
$new_password1 = $_POST['password1']; // Lấy giá trị của password1 từ form
$new_password2 = $_POST['password2']; // Lấy giá trị của password2 từ form

//Kiểm tra 2 lần nhập mật khẩu có trùng nhau hay không
if ($new_password1 !== $new_password2) {
    header("Location: ../index_signup.php?error=Hai lần nhập mật khẩu không trùng nhau, vui lòng nhập lại !");
} else {
    //Kiểm tra tên tài khoản duy nhất
    $sql_check_user = "SELECT * FROM users WHERE user_name = '$new_username'";
    $result = $conn->query($sql_check_user);

    if ($result->num_rows > 0) {
        // Tên người dùng đã tồn tại trong cơ sở dữ liệu
        header("Location: ../index_signup.php?error=Tên tài khoản đã tồn tại, vui lòng chọn tên đăng nhập khác");
    } else {

        //Băm mật khẩu
        $hashed_password = password_hash($new_password1, PASSWORD_DEFAULT);
        // Chuẩn bị truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO users (id, user_name, name, password) VALUES ('$new_id','$new_username', '$new_name', '$hashed_password')";

        // Thực hiện truy vấn
        if ($conn->query($sql) === TRUE) {
            header("Location: ../index_signin.php?noti=Đăng kí thành công, hãy đăng nhập vào tài khoản mới của bạn !");
            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
}
// Đóng kết nối
$conn->close();
