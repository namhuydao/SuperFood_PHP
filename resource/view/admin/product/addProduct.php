<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';

$name = test_input($_POST["productNameAdd"]);
$desc = test_input($_POST["productDescAdd"]);
$price = test_input($_POST["productPriceAdd"]);
$category = test_input($_POST["productCategoryAdd"]);

$file_store = uploadImages("productImages",'../main-view/manage-products.php');

if ($name === "" || $price === "" || $category === "") {
    echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-products.php';</script>";
} else {
    $add = "INSERT INTO products (name, description, price, category_id, images) VALUES ('$name', '$desc', '$price','$category', '$file_store')";
    if ($conn->query($add) === true) {
        //  Lấy product_id của bản ghi vừa tạo mới
        $sql = "SELECT * FROM `products` ORDER BY id DESC LIMIT 1";
        $products = $conn->query($sql);
        $products = $products->fetch_array();

        $product_id = $products['id'];

        //  Gắn tags cho sản phẩm
        $tags = $_POST["tags"];
        if (!empty($tags)) {
            foreach ($tags as $tag_id) {
                $sql = "INSERT INTO link_product_tag (product_id, tag_id) VALUES ('$product_id', '$tag_id')";
                $conn->query($sql);
            }
        }
        echo "<script>window.location = '../main-view/manage-products.php';</script>";
    } else {
        echo "<script>alert('Lỗi!')</script>";
    }
}