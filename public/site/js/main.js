$(function () {
// Preloader
    $(window).on("load", function (event) {
        $(".preLoader").delay(300).fadeOut(300);
    });

//===== Scroll Sticky Menu =====//
    window.addEventListener('scroll', function () {
        var header = document.querySelector('.header');
        header.classList.toggle('sticky', window.scrollY > 0);
    });

    var cururl = window.location.pathname;
    var curpage = cururl.substr(cururl.lastIndexOf('/') + 1);
    var hash = window.location.hash.substr(1);
    if ((curpage == "" || curpage == "/" || curpage == "admin") && hash == "") {
        //$("nav .navbar-nav > li:first-child").addClass("active");
    } else {
        $(".header__menu-list li").each(function () {
            $(this).removeClass("active");
        });
        if (hash != "")
            $(".header__menu-list li a[href*='" + hash + "']").parents("li").addClass("active");
        else
            $(".header__menu-list li a[href*='" + curpage + "']").parents("li").addClass("active");
    }

//===== Click Toggle Menu =====//
    let body = document.querySelector("body")
    let menuList = document.querySelector(".header__menu-list")
    let logo = document.querySelector(".header__menu-logo")
    let overlay = document.querySelector(".overlay-header")
    let button = document.querySelector(".header__menu-button")
    let closeButton = document.querySelector(".close-overlay")
    let iconSearch = document.querySelector(".icon__search")
    let header = document.querySelector(".header")
    button.addEventListener("click", () => {
        body.classList.add('overflow-hidden')
        menuList.classList.add('show')
        overlay.classList.add('active')
        header.classList.add('absolute')
    })
    closeButton.addEventListener("click", () => {
        body.classList.remove('overflow-hidden')
        menuList.classList.remove('show')
        overlay.classList.remove('active')
        header.classList.remove('absolute')
    })
    overlay.addEventListener("click", () => {
        body.classList.remove('overflow-hidden')
        menuList.classList.remove('show')
        overlay.classList.remove('active')
        header.classList.remove('absolute')
    })

//===== Modal =====//
    let modal = document.querySelector(".modal")
    let closeModal = document.querySelector(".close-modal")
    let overlayModal = document.querySelector(".modal__content-caption")
    iconSearch.addEventListener("click", () => {
        modal.classList.add('show')
    })
    closeModal.addEventListener("click", () => {
        modal.classList.remove('show')
    })
    closeModal.addEventListener("click", () => {
        modal.classList.remove('show')
    })

//===== WOW JS =====//
    new WOW().init();

//===== Owl Carousel =====//
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel();
    });
    $(".owl-slider").owlCarousel({
        loop: true,
        items: 1,
        dots: false,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
    });
    $(".owl-testimonials").owlCarousel({
        loop: true,
        items: 1,
        dots: true,
        margin: 0,
        center: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            768: {
                items: 2,
                dots: true,
            },
            1200: {
                items: 3,
                dots: true,
            }
        },
    });
    $(".owl-partners").owlCarousel({
        loop: true,
        items: 1,
        dots: false,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            576: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
            1200: {
                items: 6,
            },
        },
    });
    $(".owl-blogDetails").owlCarousel({
        loop: true,
        items: 1,
        dots: false,
        margin: 15,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            768: {
                items: 2,
            },
            1200: {
                items: 3,
            },
        },
    });


//===== Number Auto Run =====/
    const counters = document.querySelectorAll(".counters");
    const speed = 100; // The lower the slower
    counters.forEach((counter) => {
        const updateCount = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;
            // Lower inc to slow and higher to slow
            const inc = target / speed;
            // Check if target is reached
            if (count < target) {
                // Add inc to count and output in counter
                counter.innerText = Math.ceil(count + inc);
                // Call function every ms
                setTimeout(updateCount, 100);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });

//===== Back to Top =====//
// Show or hide the sticky footer button
    $(window).on("scroll", function (event) {
        if ($(this).scrollTop() > 600) {
            $(".back-to-top").fadeIn(200);
        } else {
            $(".back-to-top").fadeOut(200);
        }
    });
// Animate the scroll to top
    $(".back-to-top").on("click", function (event) {
        event.preventDefault();
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            400
        );
    });
});