<?php function css_function(){?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="<?= base_url('assets_hotel/assets/js/color-modes.js') ?>"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iwualai </title>
    <link rel="icon" type="image/png" href="<?=base_url('assets_hotel/images/icons/favicon.png')?>">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="<?= base_url('assets_hotel/assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?=base_url('assets_hotel/assets/css/style.css')?>"rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets_hotel/css/menu.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets_hotel/css/main_styles.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets_hotel/css/responsive.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets_hotel/css/slide.css')?>">
    <link href="<?=base_url('assets_hotel/assets/vendor/bootstrap-icons/bootstrap-icons.css')?>"rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- ************lightbox gallery************* -->

    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


<!-- ************EN************* -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">


<link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">

<!-- ************TH************* -->

<link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <?php }?>
    <!-- ************script_function************* -->
    <?php function script_function(){?>

    <script src="<?= base_url('assets_hotel/js/jquery-vdo.js') ?>"></script>
    <script src="<?= base_url('assets_hotel/js/jquery-vdo1.js') ?>"></script>
    <script src="<?= base_url('assets_hotel/js/jquery-dark.js') ?>"></script>
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('assets_hotel/js/offcanvas-navbar.js') ?>"></script>
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

<script>
    <script>
document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll('.lux-section');
  const isDesktop = window.innerWidth > 992;

  /* ===== FADE IN ON SCROLL ===== */
  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    },
    { threshold: 0.25 }
  );

  sections.forEach(section => observer.observe(section));

  /* ===== SCROLL PARALLAX ===== */
  window.addEventListener('scroll', () => {
    document.querySelectorAll('.lux-media').forEach(media => {
      const img = media.querySelector('img');
      const rect = media.getBoundingClientRect();
      const winH = window.innerHeight;

      if (rect.bottom > 0 && rect.top < winH) {
        const percent = (winH - rect.top) / (winH + rect.height);
        const move = (percent - 0.5) * (isDesktop ? 60 : 25);

        img.style.transform = `
          translate(-50%, -50%)
          translateY(${move}px)
        `;
      }
    });
  });

  /* ===== MOUSE PARALLAX (ทั้งหน้าจอ) ===== */
  if (isDesktop) {
    window.addEventListener('mousemove', (e) => {
      const x = e.clientX / window.innerWidth - 0.5;
      const y = e.clientY / window.innerHeight - 0.5;

      document.querySelectorAll('.lux-media img').forEach(img => {
        img.style.transform += `
          translate(${x * 14}px, ${y * 14}px)
        `;
      });
    });
  }
});
</script>
</script>
<!-- vdo 

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js'></script>
-->

    <!-- ************slider ************* -->
    <script src="<?= base_url('assets_hotel/js/jquery-slider.js')?>"></script>
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 20,
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
                spaceBetween: 20,
            },
            1199: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
    });
    </script>

    <script>
    var swiper = new Swiper(".mySwiper1", {
        slidesPerView: 2,
        spaceBetween: 20,
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
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1199: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
        },
    });
    </script>
    <script>
    var swiper = new Swiper(".mySwiper11", {
        slidesPerView: 2,
        spaceBetween: 20,
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
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1199: {
                slidesPerView: 2,
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript">
(function() {
    var Util,
        __bind = function(fn, me) { return function() { return fn.apply(me, arguments); }; };

    Util = (function() {
        function Util() {}

        Util.prototype.extend = function(custom, defaults) {
            var key, value;
            for (key in custom) {
                value = custom[key];
                if (value != null) {
                    defaults[key] = value;
                }
            }
            return defaults;
        };

        Util.prototype.isMobile = function(agent) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(agent);
        };

        return Util;

    })();

    this.WOW = (function() {
        WOW.prototype.defaults = {
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: true
        };

        function WOW(options) {
            if (options == null) {
                options = {};
            }
            this.scrollCallback = __bind(this.scrollCallback, this);
            this.scrollHandler = __bind(this.scrollHandler, this);
            this.start = __bind(this.start, this);
            this.scrolled = true;
            this.config = this.util().extend(options, this.defaults);
        }

        WOW.prototype.init = function() {
            var _ref;
            this.element = window.document.documentElement;
            if ((_ref = document.readyState) === "interactive" || _ref === "complete") {
                return this.start();
            } else {
                return document.addEventListener('DOMContentLoaded', this.start);
            }
        };

        WOW.prototype.start = function() {
            var box, _i, _len, _ref;
            this.boxes = this.element.getElementsByClassName(this.config.boxClass);
            if (this.boxes.length) {
                if (this.disabled()) {
                    return this.resetStyle();
                } else {
                    _ref = this.boxes;
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        this.applyStyle(box, true);
                    }
                    window.addEventListener('scroll', this.scrollHandler, false);
                    window.addEventListener('resize', this.scrollHandler, false);
                    return this.interval = setInterval(this.scrollCallback, 50);
                }
            }
        };

        WOW.prototype.stop = function() {
            window.removeEventListener('scroll', this.scrollHandler, false);
            window.removeEventListener('resize', this.scrollHandler, false);
            if (this.interval != null) {
                return clearInterval(this.interval);
            }
        };

        WOW.prototype.show = function(box) {
            this.applyStyle(box);
            return box.className = "" + box.className + " " + this.config.animateClass;
        };

        WOW.prototype.applyStyle = function(box, hidden) {
            var delay, duration, iteration;
            duration = box.getAttribute('data-wow-duration');
            delay = box.getAttribute('data-wow-delay');
            iteration = box.getAttribute('data-wow-iteration');
            return box.setAttribute('style', this.customStyle(hidden, duration, delay, iteration));
        };

        WOW.prototype.resetStyle = function() {
            var box, _i, _len, _ref, _results;
            _ref = this.boxes;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                box = _ref[_i];
                _results.push(box.setAttribute('style', 'visibility: visible;'));
            }
            return _results;
        };

        WOW.prototype.customStyle = function(hidden, duration, delay, iteration) {
            var style;
            style = hidden ? "visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;" : "visibility: visible;";
            if (duration) {
                style += "-webkit-animation-duration: " + duration + "; -moz-animation-duration: " + duration + "; animation-duration: " + duration + ";";
            }
            if (delay) {
                style += "-webkit-animation-delay: " + delay + "; -moz-animation-delay: " + delay + "; animation-delay: " + delay + ";";
            }
            if (iteration) {
                style += "-webkit-animation-iteration-count: " + iteration + "; -moz-animation-iteration-count: " + iteration + "; animation-iteration-count: " + iteration + ";";
            }
            return style;
        };

        WOW.prototype.scrollHandler = function() {
            return this.scrolled = true;
        };

        WOW.prototype.scrollCallback = function() {
            var box;
            if (this.scrolled) {
                this.scrolled = false;
                this.boxes = (function() {
                    var _i, _len, _ref, _results;
                    _ref = this.boxes;
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        if (!(box)) {
                            continue;
                        }
                        if (this.isVisible(box)) {
                            this.show(box);
                            continue;
                        }
                        _results.push(box);
                    }
                    return _results;
                }).call(this);
                if (!this.boxes.length) {
                    return this.stop();
                }
            }
        };

        WOW.prototype.offsetTop = function(element) {
            var top;
            top = element.offsetTop;
            while (element = element.offsetParent) {
                top += element.offsetTop;
            }
            return top;
        };

        WOW.prototype.isVisible = function(box) {
            var bottom, offset, top, viewBottom, viewTop;
            offset = box.getAttribute('data-wow-offset') || this.config.offset;
            viewTop = window.pageYOffset;
            viewBottom = viewTop + this.element.clientHeight - offset;
            top = this.offsetTop(box);
            bottom = top + box.clientHeight;
            return top <= viewBottom && bottom >= viewTop;
        };

        WOW.prototype.util = function() {
            return this._util || (this._util = new Util());
        };

        WOW.prototype.disabled = function() {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent);
        };

        return WOW;

    })();

}).call(this);


wow = new WOW({
    animateClass: 'animated',
    offset: 100
});
wow.init();
</script>
    <?php }
