<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST["productTagIdUpdate"];
$name = test_input($_POST["productTagNameUpdate"]);

if ($name === "") {
    echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-product_tags.php';</script>";
}
else {
    $update = "UPDATE product_tags SET name='$name' WHERE id='$id'";

    if ($conn->query($update) === true) {
        echo "<script>window.location = '../main-view/manage-product_tags.php';</script>";
    } else {
        echo "Lỗi";
    }
}
