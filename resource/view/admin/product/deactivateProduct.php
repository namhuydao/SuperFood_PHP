<?php
include '../../../../database/database.php';
include '../../../../function/function.php';#

$id = $_GET['id'];
$sql = "UPDATE  products SET status = '0' WHERE id ='$id'";
if ($conn->query($sql) === TRUE) {
    header("location:../main-view/manage-products.php");
} else {
    echo 'Lỗi';
}
