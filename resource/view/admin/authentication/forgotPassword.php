<?php
include '../../../../database/database.php';
include '../../../../function/function.php';
session_start();
//  https://github.com/PHPMailer/PHPMailer

//  Gọi các thư viện để gửi email
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//  Gọi file gửi email
// Load Composer's autoloader
require '../../../../vendor/PHPMailer-master/src/Exception.php';
require '../../../../vendor/PHPMailer-master/src/PHPMailer.php';
require '../../../../vendor/PHPMailer-master/src/SMTP.php';


function sendEmail($email, $name, $title, $content)
{

// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'websitetest2005@gmail.com';                     // SMTP username
        //  Mật khẩu ứng dụng chứ không phải mật khẩu của gmail
        $mail->Password = 'tqykvfjxreqclvgi';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        //  Thông tin người gửi
        $mail->setFrom('websitetest2005@gmail.com', 'Web Admin');

        //  Thông tin người nhận
        $mail->addAddress($email, $name);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

        // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body = $content;
        $mail->CharSet = 'UTF-8';
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

$emailErr = $email = "";
if (isset($_POST["forgotBtn"])) {
    if (empty($_POST["emailForgot"])) {
        $emailErr = "Xin hãy nhập Email";
    } else {
        $email = test_input($_POST["emailForgot"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email không đúng định dạng";
        }
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");
        $user = $sql->fetch_assoc();
        if (mysqli_num_rows($sql) === 0) {
            $emailErr = "Email không tồn tại";
        } else {
            $content = 'Đặt lại mật khẩu' . '<br>' .
                'Click vào đây để đặt lại mật khẩu <a href="http://' . $_SERVER['HTTP_HOST'] . '/webadmin/resource/view/admin/authentication/resetPassword.php?email=' . $email . '">Đặt lại mật khẩu</a>';

            //  Gửi email thông báo tạo tài khoản thành công
            sendEmail($email, $user['firstname'], 'Mật khẩu mới của bạn!', $content);

            session_start();
            if ($_SESSION['user']) {
                unset($_SESSION['user']);
            }
            echo "<script>alert('Vui lòng kiểm tra Email của bạn'); window.location = 'forgotPassword.php';</script>";
        }
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
    <title>Quên mật khẩu - SuperFood Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
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
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Lấy lại mật
                                    khẩu</h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Nhập Email và chúng tôi sẽ gửi link để lấy lại mật
                                    khẩu
                                </div>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input value="<?php echo $email; ?>" name="emailForgot"
                                               class="form-control py-4" id="inputEmailAddress"
                                               type="email"
                                               placeholder="Nhập Email"/>
                                        <span class="error"><?php echo $emailErr; ?></span>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="login.php">Trở về Đăng nhập</a>
                                        <button name="forgotBtn" class="btn btn-primary">Đặt lại mật khẩu</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="register.php">Chưa có tài khoản? Đăng kí ngay!</a></div>
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
