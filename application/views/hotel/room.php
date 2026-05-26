<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $this->load->view('hotel/cls/cls_hotel_function');
        css_function();
        ?>
    </head>
    <body class="dark_bg">
        <?php $this->load->view('hotel/cls/cls_hotel_menu'); ?>
        <section class="page-title" style="background-image: url(<?php echo base_url('uploads/slide_other/' . $slide_other['img_room']) ?>);">
            <div class="container">
                <div class="title-outer text-center">
                    <h1 class="title">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Rooms' ?? ''; ?>
								<? else: ?>
									<?php echo 'ห้องพัก' ?? ''; ?>
								<? endif; ?>
					</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Home' ?? ''; ?>
								<? else: ?>
									<?php echo 'หน้าหลัก' ?? ''; ?>
								<? endif; ?>
						</a></li>
                        <li>
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Rooms' ?? ''; ?>
								<? else: ?>
									<?php echo 'ห้องพัก' ?? ''; ?>
								<? endif; ?>
						</li>
                    </ul>
                </div>
            </div>
        </section>

   
   <style type="text/css">
    .hr-text h2 {
    color: #f62b0a;
    font-weight: 700;
    font-size: 20px;
}
.hr-text h2 span{
    color: #000;
    font-weight: 400;
    font-size: 20px;
}
   </style>
    <section class="section_accommodation">
        <div class="container parallax_scroll" style="transform: translate3d(0px, 58.2px, 0px);">
            <div class="row">
                <div class="col-lg-5 order-lg-1 order-2 pe-lg-5">
                    <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="title-box ">
                            <div class="sub-title wow fadeIn" data-wow-delay="0.1s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Rooms' ?? ''; ?>
								<? else: ?>
									<?php echo 'ห้องพัก' ?? ''; ?>
								<? endif; ?>
							</div>
                            <div class="hr-text">
                                        <h3>
											Standard Double Room
										</h3>
                                    </div>
                        </div>
                        <a href="room-details.php" class="wow fadeIn" data-wow-delay="0.4s">
                            <button class="btn_moredetails">View Details</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 order-lg-2 order-1 wow fadeIn" data-wow-delay="0.2s">
                    <div class="hp-room-item set-bg" style="background-image: url(assets_hotel/images/home/r2.png);"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="feature-section-apartment-1 " style="background-image:url(assets_hotel/images/home/carousel.png); width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 pe-lg-5 wow fadeIn" data-wow-delay="0.2s">
                    <div class="hp-room-item set-bg" style="background-image: url(assets_hotel/images/home/r3.png);"></div>
                </div>
                <div class="col-lg-5">
                    <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="title-box ">
                            <div class="sub-title wow fadeIn" data-wow-delay="0.1s">Rooms</div>
                            <div class="hr-text">
                                        <h3>Standard Family Room</h3>
                                    </div>
                        </div>
                        <a href="room-details.php" class="wow fadeIn" data-wow-delay="0.4s">
                            <button class="btn_moredetails">View Details</button>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="section_facilities ">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-lg-1 order-2 pe-lg-5">
                    <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="title-box ">
                            <div class="sub-title wow fadeIn" data-wow-delay="0.1s">Rooms</div>
                            <div class="hr-text">
                                        <h3>Standard Quadruple Room</h3>
                                    </div>
                        </div>
                        <a href="room-details.php" class="wow fadeIn" data-wow-delay="0.4s">
                            <button class="btn_moredetails">View Details</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 order-lg-2 order-1 wow fadeIn" data-wow-delay="0.2s">
                    <div class="hp-room-item set-bg" style="background-image: url(assets_hotel/images/home/r2.png);"></div>
                </div>
            </div>
        </div>
    </section>
     <section class="feature-section-apartment-1 " style="background-image:url(assets_hotel/images/home/carousel.png); width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 pe-lg-5 wow fadeIn" data-wow-delay="0.2s">
                    <div class="hp-room-item set-bg" style="background-image: url(assets_hotel/images/home/r3.png);"></div>
                </div>
                <div class="col-lg-5">
                    <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="title-box ">
                            <div class="sub-title wow fadeIn" data-wow-delay="0.1s">Rooms</div>
                            <div class="hr-text">
                                        <h3>Standard Triple Room</h3>
                                    </div>
                        </div>
                        <a href="room-details.php" class="wow fadeIn" data-wow-delay="0.4s">
                            <button class="btn_moredetails">View Details</button>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="section_facilities ">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-lg-1 order-2 pe-lg-5">
                    <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="title-box ">
                            <div class="sub-title wow fadeIn" data-wow-delay="0.1s">Rooms</div>
                            <div class="hr-text">
                                        <h3>Standard Twin Room</h3>
                                    </div>
                        </div>
                        <a href="room-details.php" class="wow fadeIn" data-wow-delay="0.4s">
                            <button class="btn_moredetails">View Details</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 order-lg-2 order-1 wow fadeIn" data-wow-delay="0.2s">
                    <div class="hp-room-item set-bg" style="background-image: url(assets_hotel/images/home/r2.png);"></div>
                </div>
            </div>
        </div>
    </section>






        <?php $this->load->view('hotel/cls/cls_hotel_footer'); ?>
        <?php script_function(); ?>
        <script src="<?php echo base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js')?>"></script>
         <script>
    document.addEventListener("DOMContentLoaded", () => {
        const hero = document.querySelector('.hero-parallax');
        if (!hero) return;

        const img = hero.querySelector('img');

        /* fade in */
        setTimeout(() => {
            hero.classList.add('loaded');
        }, 150);

        /* mouse parallax ทั้งหน้าจอ */
        if (window.innerWidth > 992) {
            window.addEventListener('mousemove', (e) => {
                const xPercent = e.clientX / window.innerWidth - 0.5;
                const yPercent = e.clientY / window.innerHeight - 0.5;

                const moveX = xPercent * 18; // ปรับความแรง
                const moveY = yPercent * 18;

                img.style.transform = `
        translate(-50%, -50%)
        translate(${moveX}px, ${moveY}px)
      `;
            });
        }
    });
    </script>
        
    </body>
</html>
