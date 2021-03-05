<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';

$page = $_GET['page'];
$per_page = $_GET['per_page'];
$total = $_GET['total'];

$sql = "SELECT * FROM `news` WHERE 1 = 1";

//  Lấy số trang bỏ qua bằng cách lấy số trang mà ấn vào trừ 1
$so_trang_bo_qua = (int)$page - 1;

//  Lấy số bản ghi bỏ qua bằng số trang bỏ qua x số sp trên 1 trang
$so_ban_ghi_bo_qua = $so_trang_bo_qua * (int)$per_page;
$sql .= " ORDER BY id DESC ";
$sql .= " LIMIT " . $so_ban_ghi_bo_qua . ", " . $per_page;
$result = $conn->query($sql);

include 'partials/blog_item.php';
