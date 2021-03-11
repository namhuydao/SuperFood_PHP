<?php
session_start();
include '../../../../database/database.php';
include '../../../../function/function.php';
$id = $_SESSION["user"]["id"];
$query = mysqli_query($conn, "SELECT * FROM users where id='$id'");
$user = $query->fetch_assoc();

$id = $_GET["id"];
$sql = "SELECT * FROM `news` WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql = "SELECT * FROM `news_categories` ORDER BY id DESC";
$categories = $conn->query($sql);

$sql = "SELECT * FROM `news_tags` ORDER BY name ASC";
$tags = $conn->query($sql);

if (isset($_POST['editNews'])) {
    $title = test_input($_POST["newsTitleUpdate"]);
    $desc = test_input($_POST["newsDescUpdate"]);
    $content = mysqli_real_escape_string($conn, $_POST["newsContentUpdate"]);
    $author = test_input($_POST["newsAuthorUpdate"]);
    $category = test_input($_POST["newsCategoryUpdate"]);
    $file_store = editImages("newsImages", '../main-view/manage-news.php', 'news', $id);
    if ($title === "" || $desc === "" || $content === "" || $category === "") {
        echo "<script>alert('Không được để rỗng!'); window.location = '../main-view/manage-news.php';</script>";
    } else {
        $update = "UPDATE news SET title='$title', description ='$desc', content='$content', author = '$author', category_id = '$category', images ='$file_store' WHERE id='$id'";

        if ($conn->query($update) === true) {
            //  Gắn tags cho sản phẩm
            $tags = $_POST["tags"];
            if (!empty($tags)) {
                //  Lấy tag đã chọn
                $sql = "SELECT * FROM `link_news_tag` WHERE news_id = " . $id;
                $result = $conn->query($sql);
                $tag_da_chon = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tag_da_chon[$row['tag_id']] = $row['tag_id'];
                    }
                }
                foreach ($tags as $tag_id) {
                    //  Kiểm tra nếu có rồi thì bỏ qua
                    $sql = "SELECT * FROM `link_news_tag` WHERE news_id = " . $id . " AND tag_id = " . $tag_id;

                    $result = $conn->query($sql);
                    if ($result->num_rows == 0) {
                        //  Inert thêm vào nếu chưa có
                        $sql = "INSERT INTO link_news_tag (news_id, tag_id) VALUES ('$id', '$tag_id')";
                        $conn->query($sql);
                    }
                    unset($tag_da_chon[$tag_id]);
                }
                //  Loại bỏ tag thừa
                if (!empty($tag_da_chon)) {
                    $sql = "DELETE FROM link_news_tag WHERE news_id = " . $id . " AND tag_id in (";

                    $arr = [];
                    foreach ($tag_da_chon as $v) {
                        $arr[] = $v;
                    }
                    foreach ($arr as $k => $tag_id) {
                        if ($k == 0) {
                            $sql .= $tag_id;
                        } else {
                            $sql .= ',' . $tag_id;
                        }
                    }
                    $sql .= ')';
                    $conn->query($sql);
                }
            } else {
                //  trường hợp mà không chọn tag nào thì xóa hết các liên kết product_tag
                $sql = "DELETE FROM link_news_tag WHERE news_id = " . $id;
                $conn->query($sql);
            }
            echo "<script>window.location = '../main-view/manage-news.php';</script>";
        } else {
            echo "Lỗi";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Quản lý sản phẩm - SuperFood Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="sb-nav-fixed">
<?php
include '../partials/header.php';
?>
<div id="layoutSidenav">
    <?php
    include '../partials/layoutSideNav.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="container-fluid">
                    <h1 class="mt-4">Sửa tin tức</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../main-view/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sửa tin tức</li>

                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Sửa tin tức
                        </div>
                        <div class="card-body">
                            <div class="form-group position-relative text-center">
                                <img src="<?php if ($row['images']) {
                                    echo $row['images'];
                                } else {
                                    echo '../../../../public/admin/assets/images/newsImages/default.png';
                                } ?>" class="imagesForm" width="300" height="300" id="newsImgUpdateId"/>
                                <label class="formLabel" for="fileToEditNews"><i class="fas fa-pen"></i><input
                                            style="display: none" type="file" id="fileToEditNews"
                                            name="fileToUpload"></label>
                            </div>
                            <div class="form-group">
                                <label for="newsTitleUpdate">Tiêu đề:</label>
                                <input value="<?php echo $row['title'] ?>" type="text" name="newsTitleUpdate"
                                       class="form-control"
                                       id="newsTitleUpdate">
                            </div>
                            <div class="form-group">
                                <label for="newsDescUpdate">Mô tả:</label>
                                <input value="<?php echo $row['description'] ?>" type="text" name="newsDescUpdate"
                                       class="form-control"
                                       id="newsDescUpdate">
                            </div>
                            <div class="form-group">
                                <label for="newsContentUpdate">Nội dung:</label>
                                <textarea type="text" name="newsContentUpdate" class="form-control"
                                          id="newsContentUpdate"><?php echo $row['content'] ?>
                        </textarea>
                            </div>
                            <div class="form-group">
                                <label for="newsAuthorUpdate">Tác giả:</label>
                                <input value="<?php echo $row['author'] ?>" type="text" name="newsAuthorUpdate"
                                       class="form-control"
                                       id="newsAuthorUpdate">
                            </div>
                            <div class="form-group">
                                <label for="newsCategoryUpdate">Danh mục:</label>
                                <input id="newsCategoryUpdateID" type="hidden" value="<?php
                                echo $row['category_id'] ?>">
                                <select name="newsCategoryUpdate" id="newsCategoryUpdate" class="form-control">
                                    <?php
                                    echo newsCategoryTree();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group form-tag">
                                <p id="newsTags" style="display: none">
                                    <?php
                                    $newsTags = getNewsTags($row['id']);
                                    foreach ($newsTags as $tag) {
                                        if ($tag['id']) {
                                            echo $tag['id'] . ',';
                                        }
                                    }
                                    ?>
                                </p>
                                <label for="newsTagUpdate">Tag:</label>
                                <?php
                                $list_tags = [];
                                if ($tags->num_rows > 0) {
                                    while ($row = $tags->fetch_assoc()) {
                                        $list_tags[] = $row;
                                    }
                                }
                                foreach ($list_tags as $item) {
                                    echo '<label style="display: inline-block; width: 100%;"><input style="margin-right: 5px" name="tags[]" class="tag-' . $item['id'] . '" type="checkbox" value="' . $item['id'] . '">' . $item['name'] . '</label>';
                                }
                                ?>
                            </div>
                            <button type="submit" name="editNews" class="btn btn-primary">Sửa</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <?php
        include '../partials/footer.php';
        ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script src="../../../../public/admin/assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../../../../public/core/assets/js/datatables-demo.js"></script>
</body>
</html>