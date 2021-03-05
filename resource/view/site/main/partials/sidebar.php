<div class="blog__sidebar animate__animated animate__fadeInRight wow" data-wow-delay="1s">
    <div class="blog__sidebar-search">
        <div class="search__title">Search</div>
        <form action="blog_search.php" method="GET">
            <input type="text" name="blog_search" value="<?php echo @$_GET['blog_search']?>" placeholder="Search...">
            <button type="submit" name="submit_search"><i class="fal fa-search"></i></button>
        </form>
    </div>
    <div class="blog__sidebar-cate">
        <div class="cate__title">Categories</div>
        <div class="cate__content">
            <ul class="cate__content-list">
                <?php
                if ($categories->num_rows > 0) {
                    while ($row = $categories->fetch_assoc()) {
                        echo "<li class=list__item" . "><a class=list__item-link" .
                            " href=blog_categories.php?id=" . $row['id'] . ">" . $row['name'] . "</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="blog__sidebar-recent">
        <div class="recent__title">RECENT POSTS</div>
        <div class="recent__post">
            <?php
            $sql = "SELECT * FROM `news` ORDER BY id DESC LIMIT 4";
            $recent = $conn->query($sql);
            if ($recent->num_rows > 0) {
                while ($row = $recent->fetch_assoc()) {
                    ?>
                    <div class="recent__post-item">
                        <div class="item__image"><?php
                            echo "<a href=blog-details.php?id=" . $row['id'] . "><img src=" . $row['images'] . "></a>"
                            ?></div>
                        <div class="item__info">
                            <div class="item__info-date"><?php
                                $date = new DateTime($row['date']);
                                echo $date->format('d-M-Y') ?>
                            </div>
                            <?php echo "<a class='item__info-title' title=" . $row['title'] . " href=blog-details.php?id=" . $row['id'] .
                                "><span>" . $row['title'] . "</span></a>"
                            ?>
                            <div class="item__info-comment">0 Comments</div>
                        </div>

                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="blog__sidebar-tags">
        <div class="tags__title">Tags</div>
        <ul class="tags__list">
            <?php
            if ($tags->num_rows > 0) {
                while ($row = $tags->fetch_assoc()) {
                   echo "<li class=tags__list-item" . "><a href=blog_tags.php?id=" . $row['id']  . ">" . $row['name'] . "</a></li>";

                }
            }
            ?>
        </ul>
    </div>
</div>

