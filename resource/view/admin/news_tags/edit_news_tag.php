<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST["newsTagIdUpdate"];
$name = test_input($_POST["newsTagNameUpdate"]);

if ($name === "") {
    echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-news_tags.php';</script>";
}

$update = "UPDATE news_tags SET name='$name' WHERE id='$id'";

if ($conn->query($update) === true) {
    echo "<script>window.location = '../main-view/manage-news_tags.php';</script>";
} else {
    echo "Lỗi";
}