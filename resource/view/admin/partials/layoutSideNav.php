<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <?php
                $xem_sp = checkPer($user['id'], 'user_view');
                if ($xem_sp == true):
                    ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fal fa-user-circle"></i></div>
                        Người dùng
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-users.php"">Quản lý người dùng</a>
                        </nav>
                    </div>
                <?php
                endif;
                ?>
                <?php
                $xem_sp = checkPer($user['id'], 'product_view');
                if ($xem_sp == true):
                    ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Sản phẩm
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-products.php"">Quản lý sản phẩm</a>
                        </nav>
                    </div>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-product_categories.php"">Quản lý danh mục sản phẩm</a>
                        </nav>
                    </div>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-product_tags.php"">Quản lý Tag sản phẩm</a>
                        </nav>
                    </div>
                <?php
                endif;
                ?>
                <?php
                $xem_sp = checkPer($user['id'], 'post_view');
                if ($xem_sp == true):
                    ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Tin tức
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-news.php"">Quản lý tin tức</a>
                        </nav>
                    </div>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-news_categories.php"">Quản lý danh mục tin tức</a>
                        </nav>
                    </div>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-news_tags.php"">Quản lý Tag tin tức</a>
                        </nav>
                    </div>
                <?php
                endif;
                ?>
                <?php
                $xem_sp = checkPer($user['id'], 'role_view');
                if ($xem_sp == true):
                    ?>
                    <div class="sb-sidenav-menu-heading">Admin</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts4"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="far fa-user-tie"></i></div>
                        Phân quyền
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="manage-roles.php">Quản lý quyền</a>
                        </nav>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Đăng nhập với:</div>
            <?php
            echo $user["email"];
            ?>
        </div>
    </nav>
</div>
