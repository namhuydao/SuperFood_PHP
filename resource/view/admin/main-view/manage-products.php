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
if (!checkPer($user['id'], 'product_view')) {
    header('Location:../main-view/dashboard.php');
}
$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);

$sql = "SELECT * FROM `product_categories` ORDER BY id DESC";
$categories = $conn->query($sql);

$sql = "SELECT * FROM `product_tags` ORDER BY name ASC";
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
    <title>Quản lý sản phẩm - SuperFood Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="sb-nav-fixed">
<!-- Modal Add -->
<div class="modal fade" id="productAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../product/addProduct.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productNameAdd">Tên:</label>
                        <input type="text" name="productNameAdd" class="form-control" id="productNameAdd">
                    </div>
                    <div class="form-group">
                        <label for="productDescAdd">Mô tả:</label>
                        <input type="text" name="productDescAdd" class="form-control" id="productDescAdd">
                    </div>
                    <div class="form-group">
                        <label for="productPriceAdd">Giá(VND):</label>
                        <input type="number" name="productPriceAdd" class="form-control" id="productPriceAdd">
                    </div>
                    <div class="form-group">
                        <label for="productCategoryAdd">Danh mục:</label>
                        <select name="productCategoryAdd" id="productCategoryAdd" class="form-control">
                            <?php
                            echo productCategoryTree();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productTagAdd">Tags:</label>
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
                        <img class="imagesForm" width="100" height="100"
                             src="../../../../public/admin/assets/images/productImages/default.png"/>
                        <label class="formLabel" for="fileToAddProduct"><i class="fas fa-pen"></i><input
                                    style="display: none" type="file" id="fileToAddProduct"
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
<!-- Modal EDIT -->
<div class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../product/editProduct.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="productIdUpdate" class="form-control" id="productIdUpdate">
                    </div>
                    <div class="form-group">
                        <label for="productNameUpdate">Tên:</label>
                        <input type="text" name="productNameUpdate" class="form-control" id="productNameUpdate">
                    </div>
                    <div class="form-group">
                        <label for="productDescUpdate">Mô tả:</label>
                        <input type="text" name="productDescUpdate" class="form-control" id="productDescUpdate">
                    </div>
                    <div class="form-group">
                        <label for="productPriceUpdate">Giá(VND):</label>
                        <input type="number" name="productPriceUpdate" class="form-control" id="productPriceUpdate">
                    </div>
                    <div class="form-group">
                        <label for="productCategoryUpdate">Danh mục:</label>
                        <select name="productCategoryUpdate" id="productCategoryUpdate" class="form-control">
                            <?php
                            echo productCategoryTree();
                            ?>
                        </select>
                    </div>
                    <div class="form-group form-tag">
                        <label for="productTagUpdate">Tags:</label>
                        <?php
                        foreach ($list_tags as $item) {
                            echo '<label style="display: inline-block; width: 100%;"><input style="margin-right: 5px" name="tags[]" class="tag-' . $item['id'] . '" type="checkbox" value="' . $item['id'] . '">' . $item['name'] . '</label>';
                        }
                        ?>
                    </div>
                    <div class="form-group position-relative text-center">
                        <img class="imagesForm" width="100" height="100" id="productImgUpdateId"/>
                        <label class="formLabel" for="fileToEditProduct"><i class="fas fa-pen"></i><input
                                    style="display: none" type="file" id="fileToEditProduct"
                                    name="fileToUpload"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal DELETE -->
<div class="modal fade" id="productDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../product/deleteProduct.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="productDelete_id" id="productDelete_id">
                    Bạn muốn xóa sản phẩm này?
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
                <h1 class="mt-4">Quản lý sản phẩm</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Quản lý sản phẩm</li>
                </ol>
                <?php
                $xem_sp = checkPer($user['id'], 'product_add');
                if ($xem_sp == true):
                    ?>
                    <button data-toggle="modal" data-target="#productAddModal"
                            class="btn btn-primary addBtn">Thêm sản phẩm
                    </button>
                <?php
                endif;
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Bảng sản phẩm
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="display: none">ID</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th style="display: none">Giá(VND)</th>
                                    <th>Giá(VND)</th>
                                    <th>Danh mục</th>
                                    <th>Tags</th>
                                    <th>Trạng thái</th>
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
                                        <td class="productImgtd text-center"><img src="<?php
                                            if ($row['images']) {
                                                echo $row['images'];
                                            } else {
                                                echo '../../../../public/admin/assets/images/productImages/default.png';
                                            }
                                            ?>" alt="" width="100" height="100"></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td style="display: none"><?php echo $row['price']; ?></td>
                                        <td><?php echo number_format($row['price'], 0); ?></td>
                                        <?php
                                        $cat = getProductCategory($row['category_id']);
                                        ?>
                                        <td class="field-category"
                                            data-category_id="<?php if ($cat['id']) echo $cat['id'] ?>">
                                            <?php if ($cat['name']) echo $cat['name']; ?>
                                        </td>
                                        <?php
                                        $tags = getProductTags($row['id']);
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
                                        <?php
                                        $status = $row['status'];
                                        if ($status == 0) {
                                            $strStatus = "<a class='btn btn-danger btn-sm' href=../product/activateProduct.php?id=" . $row['id'] . ">Không hoạt động</a>";
                                        }
                                        if ($status == 1) {
                                            $strStatus = "<a class='btn btn-primary btn-sm' href=../product/deactivateProduct.php?id=" . $row['id'] . ">Hoạt động</a>";
                                        }
                                        ?>
                                        <td><?php echo $strStatus ?></td>
                                        <td>
                                        <?php
                                        $xem_sp = checkPer($user['id'], 'product_edit');
                                        if ($xem_sp == true):
                                            ?>
                                            <button data-toggle="modal" data-target="#productEditModal"
                                                    class="btn btn-primary btn-sm productEditBtn">Sửa
                                            </button>
                                        <?php
                                        endif;
                                        $xem_sp = checkPer($user['id'], 'product_delete');
                                        if ($xem_sp == true):
                                            ?>
                                            <button class="btn btn-danger btn-sm productDeleteBtn"
                                                    data-toggle="modal"
                                                    data-target="#productDeleteModal">Xóa
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

<script src="../../../../public/admin/assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../../../../public/core/assets/js/datatables-demo.js"></script>
</body>
</html>

