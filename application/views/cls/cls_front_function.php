<?php function css_function(){?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="<?= base_url('assets_front/assets/js/color-modes.js'); ?>"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iHotels Collection </title>
    <link rel="icon" type="image/png" href="<?= base_url('images/home/logo.png'); ?>" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="<?= base_url('assets_front/assets/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets_front/assets/css/style.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets_front/css/menu.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets_front/css/main_styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets_front/css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets_front/css/slide.css'); ?>">
    <link href="<?= base_url('assets_front/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- ************lightbox gallery************* -->

    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <?php }?>
    <!-- ************script_function************* -->
    <?php function script_function(){?>

    <script src="<?= base_url('assets_front/js/jquery-vdo.js'); ?>"></script>
    <script src="<?= base_url('assets_front/js/jquery-vdo1.js'); ?>"></script>
    <script src="<?= base_url('assets_front/js/jquery-dark.js'); ?>"></script>
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets_front/assets/dist/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets_front/js/offcanvas-navbar.js'); ?>"></script>
    <script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;

        // แสดง navbar เมื่อเลื่อนขึ้น
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } 
        // ซ่อน navbar เมื่อเลื่อนลง
        else {
            document.getElementById("navbar").style.top = "0px";
        }

        // เปลี่ยนสีพื้นหลังเมื่อเลื่อนลงมากกว่า 50px
        if (window.pageYOffset > 50) {
            document.getElementById("navbar").classList.add("scrolled");
        } else {
            document.getElementById("navbar").classList.remove("scrolled");
        }

        prevScrollpos = currentScrollPos;
    }
</script>

<!-- vdo 

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js'></script>
-->

    <!-- ************slider ************* -->
    <script src="js/jquery-slider.js"></script>
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 40,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1199: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
        },
    });
    </script>
    <!-- ************lightbox gallery************* -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <script type="text/javascript">
    (function() {
        $('.img-link').magnificPopup({

            gallery: {
                enabled: true
            },
            removalDelay: 300, // Delay in milliseconds before popup is removed
            mainClass: 'mfp-with-zoom', // this class is for CSS animation below
            type: 'image'

        });
    }());
    </script>
    <!-- ************back-to-top************* -->
    <script type="text/javascript">
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function() {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function() {
            backToTop();
        });
        $('#back-to-top').on('click', function(e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 1200);
        });
    }
    </script>
    <!-- ************animate************* -->
    <?php }
