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
if (!checkPer($user['id'], 'user_view')) {
    header('Location:../main-view/dashboard.php');
}
$sql = "SELECT * FROM `users`";

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
    <title>Quản lý người dùng - Web Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body class="sb-nav-fixed">
<!-- Modal Add -->
<div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm người dùng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../user/addUser.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userFirstNameAdd">Tên:</label>
                        <input type="text" name="userFirstNameAdd" class="form-control" id="userFirstNameAdd">
                    </div>
                    <div class="form-group">
                        <label for="userLastNameAdd">Họ:</label>
                        <input type="text" name="userLastNameAdd" class="form-control" id="userLastNameAdd">
                    </div>
                    <div class="form-group">
                        <label for="userEmailAdd">Email:</label>
                        <input type="text" name="userEmailAdd" class="form-control" id="userEmailAdd">
                    </div>
                    <div class="form-group">
                        <label for="userPasswordAdd">Mật khẩu:</label>
                        <input type="password" name="userPasswordAdd" class="form-control" id="userPasswordAdd">
                    </div>
                    <div class="form-group">
                        <label for="userRepasswordAdd">Nhập lại mật khẩu:</label>
                        <input type="password" name="userRepasswordAdd" class="form-control" id="userRepasswordAdd">
                    </div>
                    <div class="form-group">
                        <label for="userRoleAdd">Nhóm quyền:</label>
                        <?php
                            $sql = "SELECT * FROM roles ORDER BY name ASC";
                            $results = $conn->query($sql);
                        ?>
                        <select name="role_id" class="form-control" id="userRoleAdd">
                            <option value=""></option>
                            <?php
                            if ($results->num_rows > 0) {
                                while ($row = $results->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group position-relative text-center">
                            <img class="imagesForm" width="100" src="../../../../public/admin/assets/images/userImages/defaultImage.png"/>
                            <label class="formLabel" for="fileToAddUser"><i class="fas fa-pen"></i><input
                                        style="display: none" type="file" id="fileToAddUser"
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
<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../user/editUser.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="userIdUpdate" class="form-control" id="userIdUpdate">
                    </div>
                    <div class="form-group">
                        <label for="userFirstNameUpdate">Tên:</label>
                        <input type="text" name="userFirstNameUpdate" class="form-control" id="userFirstNameUpdate">
                    </div>
                    <div class="form-group">
                        <label for="userLastNameUpdate">Họ:</label>
                        <input type="text" name="userLastNameUpdate" class="form-control" id="userLastNameUpdate">
                    </div>
                    <div class="form-group">
                        <label for="userEmailUpdate">Email:</label>
                        <input type="text" name="userEmailUpdate" class="form-control" id="userEmailUpdate">
                    </div>
                    <div class="form-group">
                        <label for="userPasswordUpdate">Mật khẩu:</label>
                        <input type="password" name="userPasswordUpdate" class="form-control" id="userPasswordUpdate">
                    </div>
                    <div class="form-group">
                        <label for="userRepasswordUpdate">Nhập lại mật khẩu:</label>
                        <input type="password" name="userRepasswordUpdate" class="form-control" id="userRepasswordUpdate">
                    </div>
                    <div class="form-group">
                        <label for="userRoleUpdate">Nhóm quyền:</label>
                        <?php
                        $sql = "SELECT * FROM roles ORDER BY name ASC";
                        $results = $conn->query($sql);
                        ?>
                        <select name="role_id" class="form-control" id="userRoleUpdate">
                            <option value=""></option>
                            <?php
                            if ($results->num_rows > 0) {
                                while ($row = $results->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group position-relative text-center">
                        <img class="imagesForm" width="100" height="100" id="userImgUpdateId"/>
                        <label class="formLabel" for="fileToEditUser"><i class="fas fa-pen"></i><input
                                    style="display: none" type="file" id="fileToEditUser"
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
<div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../user/deleteUser.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userDelete_id" id="userDelete_id">
                    Bạn muốn xóa người dùng này?
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
                <h1 class="mt-4">Quản lý người dùng</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Quản lý người dùng</li>
                </ol>
                <button data-toggle="modal" data-target="#userAddModal"
                        class="btn btn-primary addBtn">Thêm người dùng
                </button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Bảng người dùng
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="display: none">ID</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Tên</th>
                                    <th>Họ</th>
                                    <th>Email</th>
                                    <th>Nhóm quyền</th>
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
                                            <td class="userImgtd text-center"><img width="100" src="<?php
                                                if ($row['images']) {
                                                    echo $row['images'];
                                                } else {
                                                    echo '../../../../public/admin/assets/images/userImages/defaultImage.png';
                                                }?>"/></td>
                                            <td><?php echo $row['firstname']; ?></td>
                                            <td><?php echo $row['lastname']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <?php
                                            $role = getRole($row['role_id']);
                                            ?>
                                            <td class="field-role" data-role_id="<?php echo $row['role_id']; ?>">
                                                <?php echo $role['name']; ?>
                                            </td>
                                            <?php
                                            $status = $row['status'];
                                            if ($status == 0) {
                                                $strStatus = "<a class='btn btn-danger btn-sm' href=../user/activateUser.php?id=" . $row['id'] . ">Không hoạt động</a>";
                                            }
                                            if ($status == 1) {
                                                $strStatus = "<a class='btn btn-primary btn-sm' href=../user/deactivateUser.php?id=" . $row['id'] . ">Hoạt động</a>";
                                            }
                                            ?>
                                            <td><?php echo $strStatus ?></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#userEditModal"
                                                        class="btn btn-primary btn-sm userEditBtn">Sửa
                                                </button>
                                                <button class="btn btn-danger btn-sm userDeleteBtn" data-toggle="modal"
                                                        data-target="#userDeleteModal">Xóa
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

