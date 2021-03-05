<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';

$title = test_input($_POST["newsTitleAdd"]);
$desc = test_input($_POST["newsDescAdd"]);
$content = mysqli_real_escape_string($conn, $_POST["newsContentAdd"]);
$author = test_input($_POST["newsAuthorAdd"]);
$category = test_input($_POST["newsCategoryAdd"]);
$file_store = uploadImages("newsImages",'../main-view/manage-news.php');
if ($title === "" || $desc === "" || $content === "" || $category === "") {
    echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-news.php';</script>";
}
else{
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $time = date('Y-m-d H:i:s');
    $add = "INSERT INTO news (title, description, content, author, category_id, date, images) VALUES ('$title', '$desc', '$content','$author', '$category', '$time', '$file_store')";

    if ($conn->query($add) === true) {
        //  Lấy product_id của bản ghi vừa tạo mới
        $sql = "SELECT * FROM `news` ORDER BY id DESC LIMIT 1";
        $news = $conn->query($sql);
        $news = $news->fetch_array();

        $news_id = $news['id'];

        //  Gắn tags cho sản phẩm
        $tags = $_POST["tags"];
        if (!empty($tags)) {
            foreach ($tags as $tag_id) {
                $sql = "INSERT INTO link_news_tag (news_id, tag_id) VALUES ('$news_id', '$tag_id')";
                $conn->query($sql);
            }
        }

        echo "<script>window.location = '../main-view/manage-news.php';</script>";
    } else {
        echo "<script>alert('Lỗi!')</script>";
    }
}
