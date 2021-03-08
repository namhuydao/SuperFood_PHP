<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';

if(isset($_GET['submit_search'])) {
    $search = $_GET['blog_search'];

//  cấu hinh số sản phẩm trong 1 trang
    $per_page = 2;

    $sql = "SELECT * FROM `news_categories`";
    $categories = $conn->query($sql);

    $sql = "SELECT * FROM `news_tags` ORDER BY name ASC";
    $tags = $conn->query($sql);

    $count_sql = "SELECT COUNT(id) AS total FROM news";
    $count_sql .= " WHERE content LIKE '%" . $search . "%'";
    $count_sql .= " OR title LIKE '%" . $search . "%'";
    $count_sql .= " OR description LIKE '%" . $search . "%'";
    $count_sql .= " OR author LIKE '%" . $search . "%' ORDER BY id DESC LIMIT $per_page";
    $count = $conn->query($count_sql);
    $count = $count->fetch_assoc();
    $total = $count['total'];

    $sql = "SELECT * FROM news";
    $sql .= " WHERE content LIKE '%" . $search . "%'";
    $sql .= " OR title LIKE '%" . $search . "%'";
    $sql .= " OR description LIKE '%" . $search . "%'";
    $sql .= " OR author LIKE '%" . $search . "%' ORDER BY id DESC LIMIT $per_page";

    $result = $conn->query($sql);
}
include "partials/header.php";
?>

<!-- Start Banner-->
<div class="banner animate__animated animate__fadeIn wow">
    <div class="banner__background"><img src="../../../../public/site/images/layout/banner.webp" alt=""></div>
    <div class="banner__content text-center my-auto">
        <div class="banner__content-title">Tin tức</div>
        <div class="banner__content-subtitle">Trang Chủ<i class="fal fa-angle-right"></i><span>Tin tức</span>
        </div>
    </div>
</div>
<!-- End Banner-->
<!-- Start Blog-->
<div class="blog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="blog__content">
                    <?php
                    include 'partials/blog_item.php';
                    ?>
                </div>
                <div class="pagination">
                    <?php
                    //  Tính ra số nút phân trang
                    $so_du = $total % $per_page;
                    $count_page = (int)($total / $per_page);
                    if ($so_du != 0) {
                        $count_page++;
                    }
                    ?>
                    <?php
                    for ($i = 1; $i <= $count_page; $i++) {
                        ?>
                        <span class="<?php if ($i == 1) echo 'current'; ?>">
                                <a data-count="<?php echo $i; ?>"><?php echo $i; ?></a>
                            </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
    </div>
</div>
<!-- End Blog-->
<!-- Start Footer-->
<?php include 'partials/footer.php' ?>
<!-- End Footer-->

<script>
    $('.pagination span a').click(function () {
        $('.pagination span').removeClass('current');
        $(this).parents('span').addClass('current');

        var nut_phan_trang = $(this).data('count');
        $.ajax({
            url: 'blog_search_pagination.php',
            type: 'GET',
            data: {
                search: '<?php echo $_GET['blog_search'];?>',
                page: nut_phan_trang,
                per_page: '<?php echo $per_page;?>',
                total: '<?php echo $total;?>',
            },
            success: function (resp) {
                $('.blog__content').html(resp);
            },
            error: function () {
                alert('goi ajax that bai');
            }
        });
    })
</script>
