
document.addEventListener("DOMContentLoaded", function () {
    var passwordInputs = document.querySelectorAll('input[type="password"]');
    var registerButton = document.querySelector('.btn');

    registerButton.addEventListener('click', function () {
        var password1 = passwordInputs[0].value;
        var password2 = passwordInputs[1].value;

        if (password1 !== password2) {
            alert("Mật khẩu không trùng nhau");
        } else {
            window.location.href = "../pages/index_signin.php";
        }
    });
});

/*Su kien khi nguoi dung nhan nut dang ky */
