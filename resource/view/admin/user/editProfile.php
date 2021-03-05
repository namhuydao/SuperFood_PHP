<?php
include '../../../../database/database.php';
include '../../../../function/function.php';
session_start();
$id = $_SESSION["user"]["id"];
$firstname = test_input($_POST["profileFirstName"]);
$lastname = test_input($_POST["profileLastName"]);
$email = test_input($_POST["profileEmail"]);

$file_store = editImages("userImages",'../main-view/manage-users.php','users',$id);
if ($firstname === "" || $lastname === "" || $email === "") {
    echo "<script>alert('Không thể để rỗng.'); window.location = '../main-view/userProfile.php';</script>";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Email không đúng định dạng.'); window.location = '../main-view/userProfile.php';</script>";
}else {
    $update = "UPDATE users SET firstname='$firstname', lastname ='$lastname', email ='$email', images ='$file_store'  WHERE id='$id'";
    if ($conn->query($update) === true) {
        echo "<script>window.location = '../main-view/userProfile.php';</script>";
    } else {
        echo "Lỗi";
    }
}
