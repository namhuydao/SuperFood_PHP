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
            <div class="banner__content-title">Dịch vụ</div>
            <div class="banner__content-subtitle">Trang Chủ<i class="fal fa-angle-right"></i><span>Dịch vụ</span>
            </div>
        </div>
    </div>
</div>
<!-- End Banner-->
<!-- Start Services-->
<div class="services">
    <div class="services__background"><img src="../../../../public/site/images/layout/item-3.png" alt=""></div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto text-center animate__animated animate__zoomIn wow"
                 data-wow-delay="0.5s">
                <h2 class="title__heading">Our Services</h2>
                <div class="divider mx-auto"></div>
                <p class="title__text">Flagfin featherback, duckbill eel lightfish, “earthworm eel,
                    humuhumunukunukuapua’a piranha,” amago</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="services__box">
                    <div class="services__box-image mx-auto animate__animated animate__zoomIn wow"
                         data-wow-delay="0.5s"><span>
                    <svg class="fill-1" version="1.1" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                      <path d="M488.468,188.384H373.643L292.925,32.747c-2.894-5.58-7.787-9.699-13.779-11.599c-5.993-1.9-12.365-1.352-17.945,1.542                c-1.94,1.006-3.676,2.25-5.201,3.673c-1.526-1.422-3.262-2.667-5.202-3.673c-5.579-2.894-11.953-3.441-17.945-1.542                c-5.992,1.899-10.885,6.019-13.779,11.599l-85.082,164.052c-2.894,5.58-3.442,11.953-1.542,17.945                c0.648,2.045,1.574,3.951,2.71,5.704H23.532c-4.705,0-8.532-3.827-8.532-8.532c0-4.704,3.828-8.532,8.532-8.532h85.505                c4.142,0,7.5-3.357,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5H23.532C10.557,188.384,0,198.941,0,211.916                c0,10.761,7.262,19.851,17.141,22.643l43.439,231.67c2.795,14.912,15.836,25.735,31.008,25.735h328.825                c15.172,0,28.212-10.823,31.008-25.735l43.439-231.671c9.878-2.791,17.14-11.881,17.14-22.642                C512,198.94,501.443,188.384,488.468,188.384z M268.107,36.007c2.023-1.049,4.334-1.248,6.506-0.559                c2.172,0.688,3.947,2.182,4.996,4.205l85.082,164.053c1.049,2.023,1.248,4.334,0.559,6.506c-0.688,2.173-2.182,3.947-4.206,4.996                c-2.022,1.05-4.333,1.248-6.506,0.56c-2.173-0.688-3.947-2.182-4.996-4.205L264.461,47.509                C262.295,43.333,263.931,38.173,268.107,36.007z M367.979,235.449l-7.097,73.178H263.5v-73.178H367.979z M256,63.775                l80.228,154.692c0.354,0.684,0.74,1.344,1.153,1.981H174.619c0.413-0.637,0.799-1.297,1.153-1.98l7.823-15.083H297.75                c4.142,0,7.5-3.357,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5H191.374L256,63.775z M147.308,203.705l85.083-164.053                c1.049-2.023,2.823-3.517,4.996-4.205c0.85-0.27,1.721-0.403,2.588-0.403c1.349,0,2.687,0.324,3.918,0.962                c4.176,2.167,5.812,7.326,3.646,11.502l-85.083,164.053c-1.049,2.023-2.823,3.517-4.996,4.205c-2.171,0.688-4.482,0.49-6.506-0.56                c-2.023-1.049-3.517-2.823-4.205-4.996C146.06,208.039,146.259,205.729,147.308,203.705z M32.569,235.449h96.382l7.097,73.178                H46.29L32.569,235.449z M49.103,323.626h88.4l7.097,73.177H62.823L49.103,323.626z M91.587,476.965                c-7.958,0-14.798-5.677-16.264-13.499l-9.687-51.663h80.418l6.32,65.162H91.587z M248.5,476.965h-81.057l-6.319-65.162H248.5                V476.965z M248.5,396.803h-88.831l-7.097-73.177H248.5V396.803z M248.5,308.627h-97.382l-7.097-73.178H248.5V308.627z                M344.557,476.965H263.5v-65.162h87.376L344.557,476.965z M352.331,396.804H263.5v-73.177h95.928L352.331,396.804z                M436.677,463.466c-1.466,7.822-8.307,13.499-16.265,13.499h-60.786l6.32-65.162h80.418L436.677,463.466z M449.177,396.804                h-81.776l7.097-73.177h88.4L449.177,396.804z M465.71,308.626h-89.757l7.097-73.178h96.381L465.71,308.626z M488.468,220.449                h-0.122c-0.005,0-0.009,0-0.014,0H376.84c1.136-1.753,2.061-3.659,2.71-5.704c1.183-3.733,1.416-7.615,0.724-11.36h108.194                c4.705,0,8.532,3.828,8.532,8.532C497,216.621,493.172,220.449,488.468,220.449z"></path>
                    </svg></span><img src="../../../../public/site/images/layout/circle-1.png" alt=""></div>
                    <div class="services__box-content animate__animated animate__fadeInUp wow" data-wow-delay="1s">
                        <div class="content__title">Shop Online</div>
                        <p class="content__text">Shopping at the store doesn't have to empty your wallet.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="services__box">
                    <div class="services__box-image mx-auto animate__animated animate__zoomIn wow"
                         data-wow-delay="1s"><span>
                    <svg class="fill-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                      <path d="M491.729,112.971L259.261,0.745c-2.061-0.994-4.461-0.994-6.521,0L20.271,112.971c-2.592,1.251-4.239,3.876-4.239,6.754                v272.549c0,2.878,1.647,5.503,4.239,6.754l232.468,112.226c1.03,0.497,2.146,0.746,3.261,0.746s2.23-0.249,3.261-0.746                l232.468-112.226c2.592-1.251,4.239-3.876,4.239-6.754V119.726C495.968,116.846,494.32,114.223,491.729,112.971z M256,15.828                l215.217,103.897l-62.387,30.118c-0.395-0.301-0.812-0.579-1.27-0.8L193.805,45.853L256,15.828z M176.867,54.333l214.904,103.746                l-44.015,21.249L132.941,75.624L176.867,54.333z M396.799,172.307v78.546l-41.113,19.848v-78.546L396.799,172.307z                M480.968,387.568L263.5,492.55V236.658l51.873-25.042c3.73-1.801,5.294-6.284,3.493-10.015                c-1.801-3.729-6.284-5.295-10.015-3.493L256,223.623l-20.796-10.04c-3.731-1.803-8.214-0.237-10.015,3.493                c-1.801,3.73-0.237,8.214,3.493,10.015l19.818,9.567V492.55L31.032,387.566V131.674l165.6,79.945                c1.051,0.508,2.162,0.748,3.255,0.748c2.788,0,5.466-1.562,6.759-4.241c1.801-3.73,0.237-8.214-3.493-10.015l-162.37-78.386                l74.505-35.968L340.582,192.52c0.033,0.046,0.07,0.087,0.104,0.132v89.999c0,2.581,1.327,4.98,3.513,6.353                c1.214,0.762,2.599,1.147,3.988,1.147c1.112,0,2.227-0.247,3.26-0.746l56.113-27.089c2.592-1.251,4.239-3.875,4.239-6.754v-90.495                l69.169-33.392V387.568z"></path>
                      <path d="M92.926,358.479L58.811,342.01c-3.732-1.803-8.214-0.237-10.015,3.493c-1.801,3.73-0.237,8.214,3.493,10.015                l34.115,16.469c1.051,0.508,2.162,0.748,3.255,0.748c2.788,0,5.466-1.562,6.759-4.241                C98.22,364.763,96.656,360.281,92.926,358.479z"></path>
                      <path d="M124.323,338.042l-65.465-31.604c-3.731-1.801-8.214-0.237-10.015,3.494c-1.8,3.73-0.236,8.214,3.494,10.015                l65.465,31.604c1.051,0.507,2.162,0.748,3.255,0.748c2.788,0,5.466-1.562,6.759-4.241                C129.617,344.326,128.053,339.842,124.323,338.042z"></path>
                    </svg></span><img src="../../../../public/site/images/layout/circle-2.png" alt=""></div>
                    <div class="services__box-content animate__animated animate__fadeInUp wow"
                         data-wow-delay="1.5s">
                        <div class="content__title">Free Shipping</div>
                        <p class="content__text">Longnose whiptail catfish; whalefish, bottlenose.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="services__box">
                    <div class="services__box-image mx-auto animate__animated animate__zoomIn wow"
                         data-wow-delay="1.5s"><span>
                    <svg class="fill-3" version="1.1" viewbox="0 0 512 512">
                      <path d="M487.359,146.279c-1.777-3.742-6.254-5.334-9.992-3.556c-3.742,1.777-5.334,6.251-3.557,9.993                C489.198,185.107,497,219.857,497,256c0,64.374-25.068,124.894-70.587,170.413C380.895,471.932,320.374,497,256,497                c-38.177,0-74.687-8.664-108.513-25.751c-28.185-14.238-53.648-34.227-74.324-58.247l29.591,9.864                c3.929,1.31,8.177-0.814,9.487-4.744s-0.814-8.177-4.744-9.487l-53.25-17.75c-2.466-0.821-5.182-0.309-7.177,1.357                c-1.995,1.666-2.986,4.246-2.619,6.819l8.875,62.125c0.535,3.741,3.743,6.44,7.416,6.44c0.353,0,0.71-0.025,1.07-0.076                c4.101-0.586,6.95-4.385,6.364-8.485l-4.952-34.663c21.699,24.78,48.207,45.438,77.501,60.236                C176.667,502.794,215.451,512,256,512c68.38,0,132.668-26.629,181.02-74.98C485.371,388.667,512,324.38,512,256                C512,217.613,503.71,180.698,487.359,146.279z"></path>
                      <path d="M467.55,112.94l-8.875-62.125c-0.586-4.101-4.394-6.948-8.485-6.364c-4.101,0.586-6.95,4.385-6.364,8.485l4.947,34.628                C400.068,31.76,330.538,0,256,0C187.62,0,123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256                c0,38.388,8.291,75.304,24.641,109.721c1.284,2.703,3.974,4.284,6.78,4.284c1.078,0,2.174-0.234,3.213-0.728                c3.741-1.777,5.333-6.251,3.556-9.993C22.802,326.895,15,292.145,15,256c0-64.374,25.068-124.894,70.587-170.413                C131.106,40.068,191.626,15,256,15c70.856,0,136.903,30.494,182.816,83.991l-29.569-9.856c-3.932-1.312-8.178,0.814-9.487,4.744                c-1.309,3.93,0.813,8.177,4.743,9.487l53.25,17.75c0.776,0.258,1.576,0.385,2.371,0.385c1.732,0,3.438-0.6,4.807-1.742                C466.926,118.093,467.917,115.513,467.55,112.94z"></path>
                      <path d="M235.158,336.678h-75.444c3.013-26.25,21.666-43.862,41.316-62.416c20.466-19.324,41.628-39.306,41.628-69.312                c0-24.607-22.064-44.627-49.184-44.627s-49.184,20.02-49.184,44.627c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5                c0-16.336,15.334-29.627,34.184-29.627s34.184,13.291,34.184,29.627c0,23.54-17.937,40.476-36.926,58.406                c-21.769,20.554-46.442,43.851-46.442,80.822c0,4.142,3.358,7.5,7.5,7.5h83.368c4.142,0,7.5-3.358,7.5-7.5                C242.658,340.036,239.3,336.678,235.158,336.678z"></path>
                      <path d="M360.21,288.58h-8.532V167.823c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v120.758h-63.624l22.382-119.375                c0.764-4.071-1.918-7.991-5.989-8.754c-4.067-0.759-7.989,1.918-8.753,5.989l-24.048,128.258c-0.411,2.193,0.175,4.455,1.6,6.172                c1.425,1.717,3.54,2.71,5.771,2.71h72.661v40.597c0,4.141,3.357,7.499,7.5,7.499s7.5-3.358,7.5-7.5V303.58h8.532                c4.143,0,7.5-3.358,7.5-7.5C367.71,291.938,364.353,288.58,360.21,288.58z"></path>
                      <path d="M256,40.081c-4.142,0-7.5,3.358-7.5,7.5v32.064c0,4.142,3.358,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5V47.581                C263.5,43.439,260.143,40.081,256,40.081z"></path>
                      <path d="M256,424.855c-4.142,0-7.5,3.358-7.5,7.5v32.064c0,4.142,3.358,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5v-32.064                C263.5,428.213,260.143,424.855,256,424.855z"></path>
                      <path d="M464.418,248.5h-32.064c-4.143,0-7.5,3.358-7.5,7.5c0,4.142,3.357,7.5,7.5,7.5h32.064c4.143,0,7.5-3.358,7.5-7.5                C471.918,251.858,468.561,248.5,464.418,248.5z"></path>
                      <path d="M79.645,248.5H47.581c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h32.064c4.142,0,7.5-3.358,7.5-7.5                C87.145,251.858,83.787,248.5,79.645,248.5z"></path>
                    </svg></span><img src="../../../../public/site/images/layout/circle-3.png" alt=""></div>
                    <div class="services__box-content animate__animated animate__fadeInUp wow" data-wow-delay="2s">
                        <div class="content__title">Return Policy</div>
                        <p class="content__text">Glassfish, brown trout velvetfish morid cod chub barracuda.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="services__box">
                    <div class="services__box-image mx-auto animate__animated animate__zoomIn wow"
                         data-wow-delay="2s"><span>
                    <svg class="fill-4" version="1.1" viewbox="0 0 511.999 511.999">
                      <path d="M495.968,236.99v-89.927c0-21.815-17.749-39.564-39.564-39.564h-1.635l-2.722-25.409                c-0.441-4.121-2.461-7.823-5.688-10.425c-3.226-2.602-7.275-3.792-11.393-3.35l-8.29,0.888l-4.079-19.995                c-1.711-8.383-9.921-13.815-18.305-12.102L59.206,107.499H39.564C17.748,107.499,0,125.248,0,147.063v288.581                c0,21.815,17.748,39.564,39.564,39.564h416.839c21.815,0,39.564-17.749,39.564-39.564v-89.926                c9.308-3.139,16.032-11.946,16.032-22.3V259.29C512,248.936,505.276,240.13,495.968,236.99z M436.564,83.229                c0.053-0.003,0.211-0.022,0.379,0.111c0.166,0.135,0.184,0.295,0.189,0.347l2.551,23.812H210.006L436.564,83.229z M407.291,51.804                c0.276-0.052,0.553,0.124,0.609,0.402l3.795,18.601L206.223,92.819L407.291,51.804z M480.968,435.644                c0,13.545-11.02,24.565-24.565,24.565H39.564C26.02,460.209,15,449.189,15,435.644v-0.517h385.29c4.143,0,7.5-3.357,7.5-7.5                s-3.357-7.5-7.5-7.5H15V162.58h385.29c4.143,0,7.5-3.357,7.5-7.5s-3.357-7.5-7.5-7.5H15v-0.517                c0-13.545,11.02-24.564,24.564-24.564H448c0.007,0,0.014,0.001,0.021,0.001c0.006,0,0.012-0.001,0.018-0.001h8.365                c13.545,0,24.564,11.02,24.564,24.564v88.694h-25.081V155.08c0-4.143-3.357-7.5-7.5-7.5h-16.034c-4.143,0-7.5,3.357-7.5,7.5                s3.357,7.5,7.5,7.5h8.534v73.178h-64.645c-12.976,0-23.532,10.557-23.532,23.532v64.129c0,12.976,10.557,23.532,23.532,23.532                h64.645v73.177h-8.534c-4.143,0-7.5,3.357-7.5,7.5s3.357,7.5,7.5,7.5h16.034c4.143,0,7.5-3.357,7.5-7.5v-80.677h25.081V435.644z                M497,323.419L497,323.419c0,4.702-3.822,8.526-8.523,8.532c-0.003,0-0.006,0-0.01,0c-0.007,0-0.013,0.001-0.019,0.001H376.242                c-4.705,0-8.532-3.827-8.532-8.532v-64.13c0-4.705,3.827-8.532,8.532-8.532h112.187c0.013,0,0.026,0.002,0.039,0.002                c0.007,0,0.013-0.001,0.019-0.001c4.696,0.011,8.513,3.833,8.513,8.531V323.419z"></path>
                      <path d="M408.307,267.822c-12.976,0-23.532,10.557-23.532,23.532c0,12.975,10.557,23.532,23.532,23.532                c12.975,0,23.532-10.557,23.532-23.532C431.839,278.379,421.282,267.822,408.307,267.822z M408.307,299.886                c-4.705,0-8.532-3.827-8.532-8.532s3.827-8.532,8.532-8.532s8.532,3.827,8.532,8.532S413.012,299.886,408.307,299.886z"></path>
                    </svg></span><img src="../../../../public/site/images/layout/circle-4.png" alt=""></div>
                    <div class="services__box-content animate__animated animate__fadeInUp wow"
                         data-wow-delay="2.5s">
                        <div class="content__title">Payment Methods</div>
                        <p class="content__text">Three spot gourami: cookie-cutter shark yellowtail.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Services-->
<!-- Start Promotion-->
<div class="promotion">
    <div class="promotion__background animate__animated animate__zoomIn wow" data-wow-delay="0.5s"><img
                src="../../../../public/site/images/services/promotion.png" alt=""></div>
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 my-auto">
                <div class="promotion__content ml-auto animate__animated animate__fadeInRight wow"
                     data-wow-delay="1s">
                    <div class="promotion__content-image"><img src="../../../../public/site/images/layout/item-1.png" alt=""></div>
                    <div class="promotion__content-title">Organic Seasonal Veg Box</div>
                    <div class="promotion__content-text">Flagfin featherback, duckbill eel lightfish, “earthworm
                        eel, humuhumunukunukuapua’a piranha,” amago earthworm eel marine.
                    </div>
                    <a class="btn btn-color" href="#">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Promotion-->
<!-- Start Video-->
<div class="video">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 order-lg-2">
                <div class="video__box">
                    <div class="video__box-video animate__animated animate__zoomIn wow" data-wow-delay="0.5s"><img
                                src="../../../../public/site/images/services/video.jpg" alt="">
                        <div class="video__button"><a class="video__button-play" data-fancybox="video"
                                                      href="https://www.youtube.com/watch?v=iTSpmnHMVS4&amp;list=PLZLjCxQxwJSaVlw3jgmleo8PGfOd17QqN&amp;index=207"><span
                                        class="play__icon"></span></a></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 order-lg-1">
                <div class="video__box">
                    <div class="video__box-content animate__animated animate__fadeInLeft wow" data-wow-delay="1s">
                        <div class="content__title">Welcome to Health Care Nutrition</div>
                        <div class="divider"></div>
                        <p class="content__text">Flagfin featherback, duckbill eel lightfish, “earthworm eel,
                            humuhumunukunukuapua’a piranha,” amago earthworm eel marine hatchetfish, pink
                            salmon.<br><br>Northern pearleye sand goby mola mola sunfish, “alewife Atlantic
                            silverside bigscale arowana.” Porbeagle shark thornyhead warmouth Asian carps ground</p>
                        <a class="btn btn-color" href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Video-->
<!-- Start Testimonials-->
<div class="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto text-center animate__animated animate__zoomIn wow"
                 data-wow-delay="0.5s">
                <h2 class="title__heading">Testimonials</h2>
                <div class="divider mx-auto"></div>
                <p class="title__text">At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd
                    gubergren, no sea takimata sanctus est Lorem.</p>
            </div>
        </div>
        <div class="owl-testimonials owl-carousel owl-theme animate__animated animate__zoomIn wow"
             data-wow-delay="1s">
            <div class="testimonials__box">
                <div class="testimonials__box-item">
                    <p class="item__text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        natus error sit volu ptatem omnis. Sed ut perspiciatis unde omnis iste natus errorsit
                        voluptatem accusantium.</p>
                    <div class="item__info">
                        <div class="item__info-image"><img src="../../../../public/site/images/layout/testimonials-1.jpg" alt=""></div>
                        <div class="item__info-content">
                            <div class="content__name">Sara Newman</div>
                            <div class="content__position">Manager</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonials__box">
                <div class="testimonials__box-item">
                    <p class="item__text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        natus error sit volu ptatem omnis. Sed ut perspiciatis unde omnis iste natus errorsit
                        voluptatem accusantium.</p>
                    <div class="item__info">
                        <div class="item__info-image"><img src="../../../../public/site/images/layout/testimonials-2.jpg" alt=""></div>
                        <div class="item__info-content">
                            <div class="content__name">James Newbie</div>
                            <div class="content__position">Docter</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonials__box">
                <div class="testimonials__box-item">
                    <p class="item__text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        natus error sit volu ptatem omnis. Sed ut perspiciatis unde omnis iste natus errorsit
                        voluptatem accusantium.</p>
                    <div class="item__info">
                        <div class="item__info-image"><img src="../../../../public/site/images/layout/testimonials-3.jpg" alt=""></div>
                        <div class="item__info-content">
                            <div class="content__name">David Harrison</div>
                            <div class="content__position">Artist</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonials-->
<!-- Start Footer-->
<?php include 'partials/footer.php' ?>
<!-- End Footer-->
