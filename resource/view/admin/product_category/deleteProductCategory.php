<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['productCategoryDelete_id'];
$sql = "DELETE FROM product_categories WHERE id ='$id'";
deleteProductCategory($id);
if ($conn->query($sql) === TRUE) {
    echo "<script>window.location = '../main-view/manage-product_categories.php';</script>";
} else {
    echo $conn->error;
}
