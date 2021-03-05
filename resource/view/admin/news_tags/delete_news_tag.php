<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['newsTagDelete_id'];
$sql = "DELETE FROM news_tags WHERE id ='$id'";
if ($conn->query($sql) === TRUE) {
    echo "<script>window.location = '../main-view/manage-news_tags.php';</script>";
} else {
    echo $conn->error;
}
