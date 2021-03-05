<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['newsCategoryDelete_id'];
$sql = "DELETE FROM news_categories WHERE id ='$id'";
deleteNewsCategory($id);
if ($conn->query($sql) === TRUE) {
    echo "<script>window.location = '../main-view/manage-news_categories.php';</script>";
} else {
    echo $conn->error;
}
