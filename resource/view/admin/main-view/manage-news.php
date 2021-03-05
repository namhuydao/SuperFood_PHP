<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../authentication/login.php');
}

include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_SESSION["user"]["id"];
$query = mysqli_query($conn, "SELECT * FROM users where id='$id'");
$user = $query->fetch_assoc();
if (!checkPer($user['id'], 'post_view')) {
    header('Location:../main-view/dashboard.php');
}
$sql = "SELECT * FROM `news`";
$result = $conn->query($sql);

$sql = "SELECT * FROM `news_categories` ORDER BY id DESC";
$categories = $conn->query($sql);

$sql = "SELECT * FROM `news_tags` ORDER BY name ASC";
$tags = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Quản lý tin tức - Web Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body class="sb-nav-fixed">
<!-- Modal Add -->
<div class="modal fade" id="newsAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../news/addNews.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newsTitleAdd">Tiêu đề:</label>
                        <input type="text" name="newsTitleAdd" class="form-control" id="newsTitleAdd">
                    </div>
                    <div class="form-group">
                        <label for="newsDescAdd">Mô tả:</label>
                        <input type="text" name="newsDescAdd" class="form-control" id="newsDescAdd">
                    </div>
                    <div class="form-group">
                        <label for="newsContentAdd">Nội dung:</label>
                        <textarea type="text" name="newsContentAdd" class="form-control" id="newsContentAdd"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="newsAuthorAdd">Tác giả:</label>
                        <input type="text" name="newsAuthorAdd" class="form-control" id="newsAuthorAdd">
                    </div>
                    <div class="form-group">
                        <label for="newsCategoryAdd">Danh mục:</label>
                        <select name="newsCategoryAdd" id="newsCategoryAdd" class="form-control">
                            <?php
                            echo newsCategoryTree();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tag:</label>
                        <?php
                        $list_tags = [];
                        if ($tags->num_rows > 0) {
                            while ($row = $tags->fetch_assoc()) {
                                echo '<label style="display: inline-block; width: 100%;"><input style="margin-right: 5px" name="tags[]" type="checkbox" value="' . $row['id'] . '">' . $row['name'] . '</label>';
                                $list_tags[] = $row;
                            }
                        }
                        ?>
                    </div>
                    <div class="form-group position-relative text-center">
                        <img class="imagesForm" width="100" height="100" src="../../../../public/admin/assets/images/newsImages/default.png"/>
                        <label class="formLabel" for="fileToAddNews"><i class="fas fa-pen"></i><input
                                    style="display: none" type="file" id="fileToAddNews"
                                    name="fileToUpload"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal DELETE -->
<div class="modal fade" id="newsDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../news/deleteNews.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="newsDelete_id" id="newsDelete_id">
                    Bạn muốn xóa tin này?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include '../partials/header.php';
?>
<div id="layoutSidenav">
    <?php
    include '../partials/layoutSideNav.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Quản lý tin tức</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Quản lý tin tức</li>
                </ol>
                <?php
                $xem_sp = checkPer($user['id'], 'post_add');
                if ($xem_sp == true):
                ?>
                <button data-toggle="modal" data-target="#newsAddModal"
                        class="btn btn-primary addBtn">Thêm tin tức
                </button>
                <?php
                endif;
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Bảng tin tức
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="display: none">ID</th>
                                    <th>Ảnh tin</th>
                                    <th>Tiêu đề</th>
                                    <th>Mô tả</th>
                                    <th>Tác giả</th>
                                    <th>Danh mục</th>
                                    <th>Tags</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td style="display: none"><?php echo $row['id']; ?></td>
                                            <td class="newsImgtd text-center"><img src="<?php
                                                if ($row['images']) {
                                                    echo $row['images'];
                                                } else {
                                                    echo '../../../../public/admin/assets/images/newsImages/default.png';
                                                }
                                                ?>" alt="" width="100" height="100"></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['author']; ?></td>
                                            <?php
                                            $cat = getNewsCategory($row['category_id']);
                                            ?>
                                            <td class="field-category"
                                                data-category_id="<?php if ($cat['id']) echo $cat['id'] ?>">
                                                <?php if ($cat['name']) echo $cat['name']; ?>
                                            </td>
                                            <?php
                                            $tags = getNewsTags($row['id']);
                                            ?>
                                            <td class="field-tag" data-tag_id="<?php
                                            foreach ($tags as $tag) {
                                                if ($tag['id']) {
                                                    echo $tag['id'] . ',';
                                                }
                                            }
                                            ?>">
                                                <?php
                                                foreach ($tags as $tag) {
                                                    if ($tag['name']) {
                                                        echo $tag['name'] . ', ';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                        <?php
                                        $xem_sp = checkPer($user['id'], 'post_edit');
                                        if ($xem_sp == true):
                                            echo "<a class='btn btn-primary btn-sm newsEditBtn' href=../news/editNews.php?id=" . $row['id'] . ">Sửa
                                                </a>"
                                            ?>


                                        <?php
                                        endif;
                                        $xem_sp = checkPer($user['id'], 'post_delete');
                                        if ($xem_sp == true):
                                            ?>
                                                <button class="btn btn-danger btn-sm newsDeleteBtn">Xóa
                                                </button>
                                            </td>
                                        <?php
                                        endif;
                                        ?>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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