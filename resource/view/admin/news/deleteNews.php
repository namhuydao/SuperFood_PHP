<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['newsDelete_id'];
$sql = "DELETE FROM news WHERE id ='$id'";
$sql1 = "SELECT * FROM news WHERE id = '$id'";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
if ($row['images']) {
    unlink($row['images']);
}
if ($conn->query($sql) === TRUE) {
    echo "<script>window.location = '../main-view/manage-news.php';</script>";
} else {
    echo $conn->error;
}
