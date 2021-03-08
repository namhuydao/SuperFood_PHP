<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_GET['id'];
//  cấu hinh số sản phẩm trong 1 trang
$per_page = 2;

$sql = "SELECT * FROM `news_categories`";
$categories = $conn->query($sql);

$sql = "SELECT * FROM `news_tags` ORDER BY name ASC";
$tags = $conn->query($sql);

$sql = "SELECT * FROM `link_news_tag` WHERE tag_id = '$id'";
$tags_id = $conn->query($sql);

$news_with_tag = [];
if ($tags_id->num_rows > 0) {
    while ($news_id = $tags_id->fetch_assoc()) {
        $news_with_tag[] = $news_id['news_id'];
    }
}

$total = count((array) $news_with_tag);

$sql = "SELECT * FROM `news` WHERE id IN (" . implode(',', $news_with_tag) . ") ORDER BY id DESC LIMIT $per_page";
$result = $conn->query($sql);

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
            url: 'blog_tags_pagination.php',
            type: 'GET',
            data: {
                total: '<?php echo $total;?>',
                news_with_tag: '<?php echo implode(',', $news_with_tag);?>',
                page: nut_phan_trang,
                per_page: '<?php echo $per_page;?>',
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