<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['productTagDelete_id'];
$sql = "DELETE FROM product_tags WHERE id ='$id'";
if ($conn->query($sql) === TRUE) {
    echo "<script>window.location = '../main-view/manage-product_tags.php';</script>";
} else {
    echo $conn->error;
}
