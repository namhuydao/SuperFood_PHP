<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['userIdUpdate'];
$firstname = $_POST['userFirstNameUpdate'];
$lastname = $_POST['userLastNameUpdate'];
$email = $_POST['userEmailUpdate'];
$role_id = $_POST['role_id'];
if ($role_id == '') {
    $role_id = null;
}
$password = $_POST['userPasswordUpdate'];
$repassword = $_POST['userRepasswordUpdate'];
$file_store = editImages("userImages",'../main-view/manage-users.php','users',$id);
if ($firstname === "" || $lastname === "" || $email === "") {
    echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-users.php';</script>";
}
if ($password !== $repassword) {
    echo "<script>alert('Mật khẩu không giống nhau!'); window.location = '../main-view/manage-users.php';</script>";
}
else {
    if($password === ""){
        $update = "UPDATE users SET firstname='$firstname', lastname ='$lastname', email='$email', images='$file_store', role_id ='$role_id'  WHERE id='$id'";
        if ($conn->query($update) === true) {
            echo "<script>window.location = '../main-view/manage-users.php';</script>";
        } else {
            echo "Lỗi";
        }
    }
    else{
        $password = md5($password);
        $update = "UPDATE users SET firstname='$firstname', lastname ='$lastname', email='$email', password = '$password', images='$file_store', role_id ='$role_id'  WHERE id='$id'";

        if ($conn->query($update) === true) {
            echo "<script>window.location = '../main-view/manage-users.php';</script>";
        } else {
            echo "Lỗi";
        }
    }

}

