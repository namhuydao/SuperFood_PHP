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
$sql = "SELECT * FROM `products` WHERE status = 1";
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
    <title>Dashboard - SuperFood Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body"><p style="font-size: 30px; text-align: center">
                                    <?php
                                    $allUser = mysqli_query($conn, "SELECT COUNT(id) FROM users");
                                    $allCount = $allUser->fetch_assoc();
                                    echo $allCount['COUNT(id)'];
                                    ?><i style="padding-left: 10px" class="fas fa-user"></i>
                                </p>
                                </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="manage-users.php">Xem th??ng tin chi ti???t</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body"><p style="font-size: 30px; text-align: center">
                                    <?php
                                    $allNews = mysqli_query($conn, "SELECT COUNT(id) FROM news");
                                    $allCount = $allNews->fetch_assoc();
                                    echo $allCount['COUNT(id)'];
                                    ?><i style="padding-left: 10px" class="fad fa-newspaper"></i>
                                </p></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="manage-news.php">Xem th??ng tin chi ti???t</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body"><p style="font-size: 30px; text-align: center">
                                    <?php
                                    $allProduct = mysqli_query($conn, "SELECT COUNT(id) FROM products");
                                    $allCount = $allProduct->fetch_assoc();
                                    echo $allCount['COUNT(id)'];
                                    ?><i style="padding-left: 10px" class="fad fa-shopping-bag"></i>
                                </p></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="manage-products.php">Xem th??ng tin chi ti???t</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body"><p style="font-size: 30px; text-align: center">
                                    <?php
                                    $allProduct = mysqli_query($conn, "SELECT COUNT(id) FROM products");
                                    $allCount = $allProduct->fetch_assoc();
                                    echo $allCount['COUNT(id)'];
                                    ?><i style="padding-left: 10px" class="fad fa-shopping-bag"></i>
                                </p></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="manage-products.php">Xem th??ng tin chi ti???t</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area mr-1"></i>
                                Area Chart Example
                            </div>
                            <div class="card-body">
                                <canvas id="myAreaChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Bar Chart Example
                            </div>
                            <div class="card-body">
                                <canvas id="myBarChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        B???ng s???n ph???m
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="display: none">ID</th>
                                    <th>???nh s???n ph???m</th>
                                    <th>T??n</th>
                                    <th>M?? t???</th>
                                    <th style="display: none">Gi??(VND)</th>
                                    <th>Gi??(VND)</th>
                                    <th>Danh m???c</th>
                                    <th>Tags</th>
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
                                                    echo '../../../../public/admin/assets/images/productImages/no-image.gif';
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="../../../../public/admin/assets/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="../../../../public/core/assets/js/chart-area-demo.js"></script>
<script src="../../../../public/core/assets/js/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../../../../public/core/assets/js/datatables-demo.js"></script>
</body>
</html>