<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location:../main-view/dashboard.php');
}
if (isset($_POST["login"])) {

    include '../../../../database/database.php';
    include '../../../../function/function.php';
    $email = test_input($_POST["email"]);
    $password = md5(test_input($_POST["password"]));
    $sql = "SELECT * FROM users where email='$email' and password='$password' AND status = 1";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        //  lấy bản ghi tài khoản trong database
        $user = $query->fetch_assoc();

        //  lưu tài khỏan vào session để nhớ
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email']
        ];
        if (isset($_POST['remember_me'])) {
            setcookie('email', $email, time() + (3600 * 24 * 30));
            setcookie('password', $_POST["password"], time() + (3600 * 24 * 30));
        }
        header("Location: ../main-view/dashboard.php");
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu')</script>";
    }
} else {
    $email = '';
    $password = '';
    if (isset($_COOKIE['email'])) {
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Đăng nhập - SuperFood Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input name="email" value="<?php echo $email; ?>" class="form-control py-4"
                                               id="inputEmailAddress" type="email" placeholder="Nhập Email"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Mật khẩu</label>
                                        <input name="password" value="<?php echo $password; ?>"
                                               class="form-control py-4" id="inputPassword" type="password"
                                               placeholder="Nhập mật khẩu"/>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input name="remember_me" class="custom-control-input"
                                                   id="rememberPasswordCheck" type="checkbox"/>
                                            <label class="custom-control-label" for="rememberPasswordCheck">Lưu
                                                mật khẩu</label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="forgotPassword.php">Quên mật khẩu?</a>
                                        <button name="login" class="btn btn-primary">Đăng nhập</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="register.php">Chưa có tài khoản? Đăng ký ngay!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Bản quyền &copy; Website của bạn 2020</div>
                    <div>
                        <a href="#">Chính sách Bảo mật</a>
                        &middot;
                        <a href="#">Điều khoản & Điều kiện</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="../../../../public/admin/assets/js/scripts.js"></script>
</body>
</html>
