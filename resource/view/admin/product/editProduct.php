<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST["productIdUpdate"];
$name = test_input($_POST["productNameUpdate"]);
$desc = test_input($_POST["productDescUpdate"]);
$price = test_input($_POST["productPriceUpdate"]);
$category = test_input($_POST["productCategoryUpdate"]);

$file_store = editImages("productImages",'../main-view/manage-products.php','products',$id);
if ($name === "" || $price === "" || $category === "") {
    echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-products.php';</script>";
}else{
    $update = "UPDATE products SET name='$name', description ='$desc', price='$price', category_id = '$category', images ='$file_store' WHERE id='$id'";
    if ($conn->query($update) === true) {
        //  Gắn tags cho sản phẩm
        $tags = $_POST["tags"];
        if (!empty($tags)) {
            //  Lấy tag đã chọn
            $sql = "SELECT * FROM `link_product_tag` WHERE product_id = " . $id;
            $result = $conn->query($sql);
            $tag_da_chon = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tag_da_chon[$row['tag_id']] = $row['tag_id'];
                }
            }
            foreach ($tags as $tag_id) {
                //  Kiểm tra nếu có rồi thì bỏ qua
                $sql = "SELECT * FROM `link_product_tag` WHERE product_id = " . $id . " AND tag_id = " . $tag_id;

                $result = $conn->query($sql);
                if ($result->num_rows == 0) {
                    //  Insert thêm vào nếu chưa có
                    $sql = "INSERT INTO link_product_tag (product_id, tag_id) VALUES ('$id', '$tag_id')";
                    $conn->query($sql);
                }
                unset($tag_da_chon[$tag_id]);
            }
            //  Loại bỏ tag thừa
            if (!empty($tag_da_chon)) {
                $sql = "DELETE FROM link_product_tag WHERE product_id = ". $id . " AND tag_id in (";

                $arr = [];
                foreach ($tag_da_chon as $v) {
                    $arr[] = $v;
                }
                foreach ($arr as $k => $tag_id) {
                    if ($k == 0) {
                        $sql .= $tag_id ;
                    } else {
                        $sql .= ',' . $tag_id ;
                    }
                }
                $sql .= ')';
                $conn->query($sql);
            }
        } else {
            //  trường hợp mà không chọn tag nào thì xóa hết các liên kết product_tag
            $sql = "DELETE FROM link_product_tag WHERE product_id = ". $id;
            $conn->query($sql);
        }
        echo "<script>window.location = '../main-view/manage-products.php';</script>";
    } else {
        echo "Lỗi";
    }
}
