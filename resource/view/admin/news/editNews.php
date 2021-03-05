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
    <title>Quản lý sản phẩm - Web Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="../main-view/dashboard.php">
        <?php
        echo "Xin chào " . $user['firstname'];
        ?>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Tìm kiếm..." aria-label="Search"
                   aria-describedby="basic-addon2"/>
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"><img style="border-radius: 50%" src="<?php
                if ($user['images']) {
                    echo $user['images'];
                } else {
                    echo '../../../../public/admin/assets/images/userImages/defaultImage.png';
                }
                ?>" alt="" width="30" height="30"></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../main-view/userProfile.php">Thông tin cá nhân</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../authentication/logout.php">Đăng xuất</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="../main-view/dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <?php
                    $xem_sp = checkPer($user['id'], 'user_view');
                    if ($xem_sp == true):
                        ?>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                           aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fal fa-user-circle"></i></div>
                            Người dùng
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                             data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../main-view/manage-users.php"">Quản lý người dùng</a>
                            </nav>
                        </div>
                    <?php
                    endif;
                    ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Sản phẩm
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <?php
                        $xem_sp = checkPer($user['id'], 'product_view');
                        if ($xem_sp == true):
                            ?>
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../main-view/manage-products.php"">Quản lý sản phẩm</a>
                            </nav>
                        <?php
                        endif;
                        ?>
                    </div>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../main-view/manage-product_categories.php"">Quản lý danh mục sản
                            phẩm</a>
                        </nav>
                    </div>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../main-view/manage-product_tags.php"">Quản lý Tag sản phẩm</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Tin tức
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <?php
                        $xem_sp = checkPer($user['id'], 'post_view');
                        if ($xem_sp == true):
                            ?>
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../main-view/manage-news.php"">Quản lý tin tức</a>
                            </nav>
                        <?php
                        endif;
                        ?>
                    </div>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../main-view/manage-news_categories.php"">Quản lý danh mục tin
                            tức</a>
                        </nav>
                    </div>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../main-view/manage-news_tags.php"">Quản lý Tag tin tức</a>
                        </nav>
                    </div>
                    <?php
                    $xem_sp = checkPer($user['id'], 'role_view');
                    if ($xem_sp == true):
                        ?>
                        <div class="sb-sidenav-menu-heading">Admin</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts4"
                           aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="far fa-user-tie"></i></div>
                            Phân quyền
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne"
                             data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../main-view/manage-roles.php">Quản lý quyền</a>
                            </nav>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Đăng nhập với:</div>
                <?php
                echo $user["email"];
                ?>
            </div>
        </nav>
    </div>
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
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Bản quyền &copy; Website của bạn 2020</div>
                    <div>
                        <a href="#">Chính sách Bảo mật</a>
                        &middot;
                        <a href="#">Điều khoản & Điều kiện</a>
                    </div>
                </div>
            </div>
        </footer>
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