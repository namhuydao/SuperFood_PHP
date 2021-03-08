<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../../../../database/database.php';
include '../../../../function/function.php';
$id = $_GET['id'];

$sql = "SELECT * FROM `news` WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql = "SELECT * FROM `news_categories` ORDER BY id DESC";
$categories = $conn->query($sql);

$sql = "SELECT * FROM `news_tags` ORDER BY name ASC";
$tags = $conn->query($sql);
include "partials/header.php";
?>

<!-- Start Banner-->
<div class="banner animate__animated animate__fadeIn wow">
    <div class="banner__background"><img src="../../../../public/site/images/layout/banner.webp" alt=""></div>
    <div class="banner__content text-center my-auto">
        <div class="banner__content-title">Tin tức</div>
        <div class="banner__content-subtitle">Trang Chủ<i class="fal fa-angle-right"></i><span>Tin tức</span></div>
    </div>
</div>
<!-- End Banner-->
<!-- Start Blog Details-->
<div class="blogDetails">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="blogDetails__content animate__animated animate__zoomIn wow" data-wow-delay="0.5s">
                    <div class="blogDetails__content-title"><?php echo $row['title'] ?></div>
                    <div class="blogDetails__content-subtitle"><span class="subtitle__author">By :<a
                                    href="#"><?php echo $row['author'] ?></a></span><span class="subtitle__comment"><a
                                    href="#">0</a> comments</span>
                    </div>
                    <div class="blogDetails__content-image"><img src="<?php echo $row['images'] ?>" alt=""></div>
                    <div class="blogDetails__content-text">
                        <p><?php echo $row['content'] ?></p>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="blogDetails__content-tags"><span class="tags__title">Tags : </span>
                                <a class="tags__item"
                                   href="#"><?php
                                    $newsTags = getNewsTags($row['id']);
                                    foreach ($newsTags as $tag) {
                                        if ($tag['id']) {
                                            echo $tag['name'] . ',';
                                        }
                                    };
                                    ?></a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="blogDetails__content-categories"><span class="categories__title">categories : <a
                                            href="#"><?php
                                        $category = getNewsCategory($row['category_id']);
                                        echo $category['name'];
                                        ?></a></span></div>
                        </div>
                    </div>
                </div>
                <div class="blogDetails__button">
                    <div class="row">
                        <div class="col-6">
                            <?php
                            $previous = $conn->query("SELECT * FROM news WHERE id < '$id' ORDER BY id DESC");
                            if ($previous->num_rows > 0) {
                                $row = $previous->fetch_assoc();
                                echo "<a href=blog-details.php?id=" . $row['id'] . ">Previous Post</a>";
                            } else {
                                echo "<a>Previous Post</a>";
                            }
                            ?>
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-end">
                            <?php
                            $next = $conn->query("SELECT * FROM news WHERE id > '$id' ORDER BY id ASC");
                            if ($next->num_rows > 0) {
                                $row = $next->fetch_assoc();
                                echo "<a href=blog-details.php?id=" . $row['id'] . ">Next Post</a>";
                            } else {
                                echo "<a>Next Post</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="blogDetails__comment">
                    <div class="blogDetails__comment-title">Leave A Comments</div>
                    <form class="blogDetails__comment-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form__name">
                                    <input type="text" name="name" placeholder="User name*" value required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form__email">
                                    <input type="email" name="email" placeholder="Email*" value required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form__message">
                                        <textarea name="message" placeholder="Your comment*" rows="5" cols="30"
                                                  required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form__submit btn btn-color">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
                <div class="blogDetails__related">
                    <div class="blogDetails__related-title">Related post</div>
                    <div class="owl-blogDetails owl-carousel owl-theme">
                        <?php
                        $news = "SELECT * FROM `news` WHERE category_id = $category[id]";
                        $newsResult = $conn->query($news);
                        if ($newsResult->num_rows > 0) {
                            while ($row = $newsResult->fetch_assoc()) {
                                ?>
                                <div class="blog__item animate__animated animate__zoomIn wow" data-wow-delay="0.5s">
                                    <div class="blog__item-image"><?php
                                        echo "<a href=blog-details.php?id=" . $row['id'] . "><img
                                                            src=" . $row['images'] . "></a>"
                                        ?>
                                        <div class="image__date"><span class="date">
                                            <?php
                                            $date = new DateTime($row['date']);
                                            echo $date->format('d') ?>
                                        </span><span class="month"><?php
                                                echo $date->format('M') ?></span>
                                        </div>
                                    </div>
                                    <div class="blog__item-info">
                                        <div class="info__subtitle"><?php
                                            echo $category['name'];
                                            ?></div>
                                        <div class="info__title"><?php
                                            echo "<a title=" . $row['title'] . " href=blog-details.php?id=" . $row['id'] .
                                                "><span>" . $row['title'] . "</span></a>"
                                            ?>
                                        </div>
                                        <div class="info__text"></div>
                                        <?php
                                        echo "<a class=info__readmore 
                                                   href=blog-details.php?id=" . $row['id'] . "><span>Read More</span></a>"
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
    </div>
</div>
<!-- End Blog Details-->
<!-- Start Footer-->
<?php include 'partials/footer.php' ?>
<!-- End Footer-->
