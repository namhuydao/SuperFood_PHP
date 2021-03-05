<div class="row">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="blog__item animate__animated animate__fadeIn wow"
                     data-wow-delay="0.5s">
                    <div class="blog__item-image">
                        <?php
                        echo "<a href=blog-details.php?id=" . $row['id'] . "><img
                                                            src=" . $row['images'] . "></a>"
                        ?>
                        <div class="image__date">
                                                    <span class="date"><?php
                                                        $date = new DateTime($row['date']);
                                                        echo $date->format('d') ?></span>
                            <span class="month"><?php echo $date->format('M') ?></span>
                        </div>
                    </div>
                    <div class="blog__item-info">
                        <div class="info__subtitle">
                            <?php
                            $cat = getNewsCategory($row['category_id']);
                            echo $cat['name'];
                            ?>
                        </div>
                        <div class="info__title">
                            <?php
                            echo "<a title='" . $row['title'] . "' href=blog-details.php?id=" . $row['id'] .
                                "><span>" . $row['title'] . "</span></a>"
                            ?>
                        </div>
                        <div class="info__text"><?php echo $row['description'] ?>
                        </div>
                        <?php
                        echo "<a class=info__readmore 
                                                   href=blog-details.php?id=" . $row['id'] . "><span>Read More</span></a>"
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }else{
        echo "<h3 style='margin: auto'>Không tìm thấy kết quả nào!</h3>";
    }
    ?>
</div>
