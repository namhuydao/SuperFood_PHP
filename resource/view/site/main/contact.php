<?php
include '../../../../database/database.php';
include '../../../../function/function.php';
include "partials/header.php";
?>

<!-- Start Banner-->
<div class="banner animate__animated animate__fadeIn wow">
    <div class="container">
        <div class="banner__background"><img src="../../../../public/site/images/layout/banner.webp" alt=""></div>
        <div class="banner__content text-center my-auto">
            <div class="banner__content-title">Liên hệ</div>
            <div class="banner__content-subtitle">Trang Chủ<i class="fal fa-angle-right"></i><span>Liên hệ</span>
            </div>
        </div>
    </div>
</div>
<!-- End Banner-->
<!-- Start Contact-->
<div class="contact">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="contact__info">
                    <div class="contact__info-title animate__animated animate__fadeInLeft wow" data-wow-delay="1s">
                        Contact Information
                    </div>
                    <div class="divider animate__animated animate__fadeInLeft wow" data-wow-delay="1s"></div>
                    <div class="row animate__animated animate__fadeInLeft wow" data-wow-delay="2s">
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="contact__info-item">
                                <div class="item__image"><i class="color-1 fas fa-map-marker-alt"></i><img
                                            src="../../../../public/site/images/layout/circle-1.png" alt=""></div>
                                <div class="item__content">
                                    <div class="item__content-title">Address</div>
                                    <div class="item__content-subtitle">103 Reade St, New York NY 10013</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="contact__info-item">
                                <div class="item__image"><i class="color-2 fas fa-phone-alt"></i><img
                                            src="../../../../public/site/images/layout/circle-2.png" alt=""></div>
                                <div class="item__content">
                                    <div class="item__content-title">Phone</div>
                                    <div class="item__content-subtitle">+1 (212) 379 3968</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="contact__info-item">
                                <div class="item__image"><i class="color-3 fas fa-paper-plane"></i><img
                                            src="../../../../public/site/images/layout/circle-3.png" alt=""></div>
                                <div class="item__content">
                                    <div class="item__content-title">Email</div>
                                    <div class="item__content-subtitle">hello123@gmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="contact__info-item">
                                <div class="item__image"><i class="color-4 fas fa-share-alt"></i><img
                                            src="../../../../public/site/images/layout/circle-4.png" alt=""></div>
                                <div class="item__content">
                                    <div class="item__content-title">Social Networks</div>
                                    <div class="item__content-icon"><a class="icon__link" href="#"><i
                                                    class="fab fa-instagram"></i></a><a class="icon__link" href="#"><i
                                                    class="fab fa-twitter"></i></a><a class="icon__link" href="#"><i
                                                    class="fab fa-facebook-f"></i></a><a class="icon__link"
                                                                                         href="#"><i
                                                    class="fab fa-tumblr"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="contact__form">
                    <div class="contact__form-title animate__animated animate__fadeInRight wow" data-wow-delay="1s">
                        Send Message
                    </div>
                    <div class="divider animate__animated animate__fadeInRight wow" data-wow-delay="1s"></div>
                    <form action="">
                        <div class="row animate__animated animate__fadeInRight wow" data-wow-delay="2s">
                            <div class="col-md-12">
                                <div class="contact__form-name">
                                    <input class="form-control" type="text" name="name" placeholder="Your Name*"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact__form-email">
                                    <input class="form-control" type="email" name="email" placeholder="Your Email*"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact__form-subject">
                                    <input class="form-control" type="text" name="subject" placeholder="Subject*"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contact__form-message">
                                        <textarea class="form-control" type="text" name="message"
                                                  placeholder="Write your message..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="contact__form-submit btn btn-color">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact-->
<!-- Start Maps-->
<div class="maps animate__animated animate__fadeInUp wow" data-wow-delay="0.5s">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.613563906854!2d105.86348011541479!3d21.0081220938573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abf849ced337%3A0x14dd09754fa7454d!2zTmfDtSA3NyBMw6NuZyBZw6puLCBUaGFuaCBMxrDGoW5nLCBIYWkgQsOgIFRyxrBuZywgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1604567241277!5m2!1sen!2s"
            width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
</div>
<!-- End Maps-->
<!-- Start Footer-->
<?php include 'partials/footer.php' ?>
<!-- End Footer-->