<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';

$name = test_input($_POST["newsCategoryNameAdd"]);
$category = test_input($_POST['newsCategoryCategoryAdd']);
$ok = 1;
if ($name === "") {
    echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-news_categories.php';</script>";
    $ok = 0;
} else {
    $query = mysqli_query($conn, "SELECT * FROM news_categories where name='$name'");
    if ($query->num_rows > 0) {
        echo "<script>alert('Danh mục đã tồn tại!'); window.location = '../main-view/manage-news_categories.php';</script>";
        $ok = 0;
    }
}
if($ok === 1){
    $add = "INSERT INTO news_categories (name,parent_id) VALUES ('$name', '$category')";

    if ($conn->query($add) === true) {
        echo "<script>window.location = '../main-view/manage-news_categories.php';</script>";
    } else {
        echo "<script>alert('Lỗi!')</script>";
    }

}

