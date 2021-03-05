<div class="footer">
    <div class="footerTop">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footerTop__logo animate__animated animate__fadeInLeft wow" data-wow-delay="0.5s">
                        <div class="footerTop__logo-image"><img src="../images/layout/logo-white.png" alt=""></div>
                        <div class="footerTop__logo-text">At vero eos et accusam et justo duo dolo res et ea rebum.
                            Stet clita
                            kasd guber gren. Aenean sollici tudin lorem quis biben dum auci elit clita.
                        </div>
                        <ul class="footerTop__logo-contact">
                            <li class="contact__item">
                                <div class="contact__item-icon"><i class="far fa-map-marker-alt"></i></div>
                                <a
                                    class="contact__item-text" href="#">Address: 339 Riverside Drive, New York
                                    NY 10027, United
                                    States</a>
                            </li>
                            <li class="contact__item">
                                <div class="contact__item-icon"><i class="far fa-phone"></i></div>
                                <a class="contact__item-text"
                                   href="#">Phone:<span> +1 (212) 379 3968</span></a>
                            </li>
                            <li class="contact__item">
                                <div class="contact__item-icon"><i class="far fa-envelope"></i></div>
                                <a class="contact__item-text"
                                   href="#">Email: balan@construction.com</a>
                            </li>
                        </ul>
                        <div class="footerTop__logo-icon"><a class="icon__link" href="#"><i
                                    class="fab fa-instagram"></i></a><a
                                class="icon__link" href="#"><i class="fab fa-twitter"></i></a><a
                                class="icon__link" href="#"><i
                                    class="fab fa-facebook-f"></i></a><a class="icon__link" href="#"><i
                                    class="fab fa-tumblr"></i></a><a class="icon__link" href="#"><i
                                    class="fab fa-vimeo-v"></i></a><a
                                class="icon__link" href="#"><i class="fab fa-linkedin-in"></i></a></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footerTop__post d-none-block animate__animated animate__fadeInUp wow"
                         data-wow-delay="1s">
                        <div class="footerTop__post-title">Recent Posts</div>
                        <ul class="footerTop__post-list">
                            <?php
                            $sql = "SELECT * FROM `news` ORDER BY id DESC LIMIT 3";
                            $recent = $conn->query($sql);
                            if ($recent->num_rows > 0) {
                                while ($row = $recent->fetch_assoc()) {
                                    ?>
                                    <li class="list__item">
                                        <div class="list__item-image"><img src="<?php echo $row['images'] ?>"
                                                                           alt="">
                                        </div>
                                        <div class="list__item-content">
                                            <a class="content__title"
                                               href="../blog-details.php"><?php echo $row['title'] ?></a>
                                            <div class="content__date"><?php
                                                $date = new DateTime($row['date']);
                                                echo $date->format('F d, Y') ?></div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footerTop__quote animate__animated animate__fadeInRight wow" data-wow-delay="1.5s">
                        <div class="footerTop__quote-title">Get A quote</div>
                        <div class="footerTop__quote-text">If you got any question please do not hesitate to send us
                            a message.
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="footerTop__quote-form">
                                    <input class="form-control" id="name" type="text" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="footerTop__quote-form">
                                    <input class="form-control" id="email" type="email" placeholder="Your Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="footerTop__quote-form footerTop__quote-textarea">
                                        <textarea class="form-control" id="message" type="message"
                                                  placeholder="Message..."></textarea>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-transparent" href="#">Send Message</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footerBottom">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="footerBottom__content animate__animated animate__zoomIn wow" data-wow-delay="1s">
                        Copyright
                        2020 @ Superfood Elated Themes
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Footer-->
<!-- Start Modal-->
<div class="modal">
    <div class="modal__content">
        <button class="close-modal"><i class="fal fa-times"></i></button>
        <div class="modal__content-caption">
            <div class="modal__content-caption__search">
                <input class="caption__text" type="text" placeholder="Search..." autofocus="">
                <button class="caption__icon"><i class="far fa-search"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal-->
<!-- Start Back-to-top-->
<div class="back-to-top" id="back-to-top"><a href="#"><i class="fal fa-arrow-up"></i></a></div>
<!-- End Back-to-top-->
</div>
</body>
<!-- Jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Owl Carousel-->
<script src="../js/owl.carousel.min.js"></script>
<!-- Fancy Box-->
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<!-- Wow JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<!-- Main JS-->
<script src="../js/main.js"></script>

