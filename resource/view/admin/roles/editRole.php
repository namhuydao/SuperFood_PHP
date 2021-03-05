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
if (!checkPer($user['id'], 'role_edit')) {
    header('Location:../main-view/dashboard.php');
}
$query = mysqli_query($conn, "SELECT * FROM roles where id=" . $_GET['id']);
$role = $query->fetch_assoc();

$sql = "SELECT * FROM `permissions` ORDER BY code ASC";
$permissions = $conn->query($sql);


if ($_POST) {
    $roleNameUpdate = test_input($_POST['roleNameUpdate']);
    //  Xóa các quyền cũ của nhóm quyền
    $sql = "DELETE FROM `link_role_permission` WHERE role_id = $role[id]";
    $conn->query($sql);
    foreach ($_POST['pers'] as $per_id) {
        //  Gán các quyền mới chọn vào nhóm quyền
        $sql = "INSERT INTO `link_role_permission` (role_id, permission_id) VALUES ( $role[id]  , $per_id)";
        $conn->query($sql);
    }
    $sql2 = "UPDATE roles SET name = '$roleNameUpdate' WHERE id = $role[id] ";
    $conn->query($sql2);
    echo "<script>window.location = '../main-view/manage-roles.php';</script>";
}


$sql = "SELECT * FROM `link_role_permission` WHERE role_id = $role[id]";
$permissions_checked = $conn->query($sql);
$pers_checked = [];
if ($permissions->num_rows > 0) {
    while ($row = $permissions_checked->fetch_assoc()) {
        $pers_checked[] = $row['permission_id'];
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
    <title>Thêm quyền</title>
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
    <div id="layoutSidenav_content" style="background: #f2f3f8">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Sửa quyền: <?php echo $role['name']; ?></h1>
                <ol class="breadcrumb mb-4" style="background: white">
                    <li class="breadcrumb-item"><a href="../main-view/dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sửa quyền: <?php echo $role['name']; ?></li>
                </ol>
                <form action="" method="POST">
                    <div class="role__content row">
                        <div class="col-md-4">
                            <div class="role__left">
                                <div class="form-group">
                                    <label for="roleNameUpdate">Tên quyền:</label>
                                    <input value="<?php echo $role['name']; ?>" type="text" name="roleNameUpdate"
                                           class="form-control" id="roleNameUpdate">
                                </div>
                                <button type="submit"
                                        class="btn btn-primary addBtn">Lưu
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="role__right">
                                <?php
                                $code = '';
                                if ($permissions->num_rows > 0) {
                                    while ($row = $permissions->fetch_assoc()) {
                                        $module_name = @explode('_', $row['code'])[0];
                                        if ($module_name != $code) {
                                            $code = $module_name;
                                            if ($module_name === "post") {
                                                $module_name = "Bài viết";
                                            } elseif ($module_name === "product") {
                                                $module_name = "Sản phẩm";
                                            } elseif ($module_name === "role") {
                                                $module_name = "Quyền";
                                            } elseif ($module_name === "user") {
                                                $module_name = "Người dùng";
                                            }
                                            ?>
                                            <br><br><label><input id='perChecked' style='margin-right: 5px;'
                                                                  name='inputPers'
                                                                  type='checkbox' checked
                                                                  value=value="<?php echo $row['id']; ?>"><?php echo $module_name; ?>
                                            </label>
                                            <?php
                                        }
                                        ?>
                                        <label style="display: inline-block; width: 100%; margin-left: 20px">
                                            <input  style="margin-right: 5px;" name="pers[]"
                                                    type="checkbox" <?php if (in_array($row['id'], $pers_checked)) echo 'checked'; ?>
                                                    value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
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


