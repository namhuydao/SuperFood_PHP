<?php
include '../../../../database/database.php';
include '../../../../function/function.php';
session_start();
$id = $_SESSION["user"]["id"];
$query = mysqli_query($conn, "SELECT * FROM users where id='$id'");
$user = $query->fetch_assoc();
$confirmPass = test_input($_POST['profileConfirmPass']);
$newPass = test_input($_POST['newPassword']);
$repeatNewPassword = test_input($_POST['repeatNewPassword']);
$editOk = 1;
if($confirmPass == "" || $newPass == "" || $repeatNewPassword == ""){
    echo "<script>alert('Không được để rỗng'); window.location = '../main-view/userProfile.php';</script>";
    $editOk = 0;
}
if($user['password'] != md5($confirmPass)){
    echo "<script>alert('Mật khẩu cũ nhập lại không khớp'); window.location = '../main-view/userProfile.php';</script>";
    $editOk = 0;
}
if($newPass != $repeatNewPassword){
    echo "<script>alert('Mật khẩu mới không giống nhau'); window.location = '../main-view/userProfile.php';</script>";
    $editOk = 0;
}
if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $newPass)) {
    echo "<script>alert('Mật khẩu không hợp lệ! (ít nhất 8 ký tự, có số, chữ hoa, chữ thường)'); window.location = '../main-view/userProfile.php';</script>";
    $editOk = 0;
}
if($editOk != 0){
    $newPass = md5($newPass);
    $update = "UPDATE users SET password ='$newPass' WHERE id='$id'";
    if ($conn->query($update) === true) {
        echo "<script>alert('Mật khẩu đã được thay đổi!'); window.location = '../main-view/userProfile.php';</script>";
    } else {
        echo "Lỗi";
    }
}