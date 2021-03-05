<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['productDelete_id'];
$sql = "DELETE FROM products WHERE id ='$id'";
$sql1 = "SELECT * FROM products WHERE id = '$id'";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
if ($row['images']) {
    unlink($row['images']);
}
if ($conn->query($sql) === TRUE) {
    echo "<script>window.location = '../main-view/manage-products.php';</script>";
} else {
    echo $conn->error;
}
