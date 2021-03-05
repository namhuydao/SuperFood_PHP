<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';

//  dầu vào : thời gian đăng ký
//  đầu ra : sau  1 giờ ko cho kich hoạt nữa
//  xử lý : xử lý kiểm tra thời gian kick hoạt ở bước active tài khoản


$email = $_GET['email'];

//  Thời gian tạo tài khoản
$time = $_GET['time'];
//  Kiểm tra tối đa 1 giờ để hết hạn link active
$now = time();

$tg_hop_le = $now - (60 * 60 * 24 * 3);

if (strtotime($time) > $tg_hop_le) {
    $sql = "UPDATE users SET status = 1, is_active = 1 WHERE email='$email' and created_at = '$time'";
//  Kiểm tra nếu chưa active lần nào thì mới cho active
    $sql .= " and is_active = 0";

    $query = mysqli_query($conn, $sql);
}

header("Location: login.php");



