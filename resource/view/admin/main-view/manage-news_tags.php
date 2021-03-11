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
$sql = "SELECT * FROM `news_tags`";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Quản lý tags tin tức - SuperFood Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body class="sb-nav-fixed">
<!-- Modal Add -->
<div class="modal fade" id="newsTagAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../news_tags/add_news_tag.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newsTagNameAdd">Tên:</label>
                        <input type="text" name="newsTagNameAdd" class="form-control" id="newsTagNameAdd">
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
<div class="modal fade" id="newsTagEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../news_tags/edit_news_tag.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="newsTagIdUpdate" class="form-control" id="newsTagIdUpdate">
                    </div>
                    <div class="form-group">
                        <label for="newsTagNameUpdate">Tên:</label>
                        <input type="text" name="newsTagNameUpdate" class="form-control" id="newsTagNameUpdate">
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
<div class="modal fade" id="newsTagDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../news_tags/delete_news_tag.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="newsTagDelete_id" id="newsTagDelete_id">
                    Bạn muốn xóa Tag này?
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
                <h1 class="mt-4">Quản lý Tag tin tức</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Quản lý Tag tin tức</li>
                </ol>
                <button data-toggle="modal" data-target="#newsTagAddModal"
                        class="btn btn-primary addBtn">Thêm Tag
                </button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Bảng Tag tin tức
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#newsTagEditModal"
                                                        class="btn btn-primary btn-sm newsTagEditBtn">Sửa
                                                </button>
                                                <button class="btn btn-danger btn-sm newsTagDeleteBtn"
                                                        data-toggle="modal"
                                                        data-target="#newsTagDeleteModal">Xóa
                                                </button>
                                            </td>
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

