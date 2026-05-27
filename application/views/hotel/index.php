<!DOCTYPE html>
<html lang="en">

<head>
	<?php
        $this->load->view('hotel/cls/cls_hotel_function');
        css_function();
    ?>
</head>
<style>
	.sub-title:before {
	position: absolute;
	content: '';
	height: 1px;
	width: 45px;
	background: <?php echo $hotel['color'] ?>;
	left: 0;
	bottom: 7px;
	}
	.text-center .sub-title:after {
	position: absolute;
	content: '';
	height: 1px;
	width: 45px;
	background: <?php echo $hotel['color'] ?>;
	right: 0;
	bottom: 7px;
	}
	.sub-title {
    font-size: 14px;
    letter-spacing: 2px;
    line-height: 1.6em;
    color: <?php echo $hotel['color'] ?> ;
    font-weight: 700;
    text-transform: uppercase;
    padding-left: 53px;
    padding-right: 53px;
    position: relative;
    display: inline-block;
    vertical-align: middle;
    margin-bottom: 0px;
	}

	.swiper-button-next, .swiper-button-prev {
    position: absolute;
    top: var(--swiper-navigation-top-offset, 50%);
    width: calc(var(--swiper-navigation-size) / 44* 27);
    height: var(--swiper-navigation-size);
    margin-top: calc(0px -(var(--swiper-navigation-size) / 2));
    z-index: 10;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--swiper-navigation-color, #ffffff);
    width: 40px;
    height: 40px;
    background-color: <?php echo $hotel['color'] ?>;
    border-radius: 50px;
}

</style>

<body class="dark_bg">
    <?php $this->load->view('hotel/cls/cls_hotel_menu'); ?>
	<?php $this->load->view('hotel/cls/cls_hotel_slide'); ?>
		<section class="section_description" style="background-image:url(<?php echo base_url('uploads/hotel_home/' . $about['banner_backgroud_1']) ?>); width: 100%;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="hero-parallax wow fadeIn" data-wow-delay="0.1s">
							<img src="<?php echo base_url('uploads/hotel_home/' . $about['banner_hotel_image']) ?>" class="" alt="iWualai Hotel">
						</div>
					</div>

					<div class="col-lg-6 ps-lg-5">
						<div class="content-block1 "  >
							<div class="title-box wow fadeIn" data-wow-delay="0.2s">
								<div class="sub-title" >
									<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $about['banner_title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $about['banner_title_th'] ?? ''; ?>
								<? endif; ?>
								</div>
								<h2 class="sec-title" >
									<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $about['banner_subtitle_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $about['banner_subtitle_th'] ?? ''; ?>
								<? endif; ?>
								</h2>
							</div>
								<?php
                                    $lang = $this->session->userdata('lang');
                                    $desc = $lang == 'en' ? ($about['banner_desc_en'] ?? '') : ($about['banner_desc_th'] ?? '');

                                    // แยกแต่ละบรรทัดแล้วกรองบรรทัดว่าง
                                    $lines = array_filter(explode("\n", $desc), fn($l) => trim($l) !== '');
                                    $lines = array_values($lines);
                                ?>

									<?php foreach ($lines as $i => $line): ?>
										<div class="text <?php echo $i > 0 ? 'mt-3 mb-3' : '' ?> wow fadeIn"
											data-wow-delay="<?php echo 0.3 + ($i * 0.1) ?>s">
											<?php echo $line ?>
										</div>
									<?php endforeach; ?>
								<!-- <div class="text wow fadeIn" data-wow-delay="0.3s">Welcome to iWualai Hotel, conveniently located on Wualai Road, just 20 meters from the Saturday Walking Street. We are also within 300 meters of Wat Srisupan (the Silver Temple) and only a 10-minute drive from Chiang Mai International Airport.</div>
								<div class="text mt-3 mb-3 wow fadeIn" data-wow-delay="0.4s">We invite you to make iWualai Hotel a part of your Chiang Mai experience and enjoy our warm hospitality.</div> -->
						</div>
					</div>
				</div>
			</div>
		</section>
    <section class="room-section" style=" padding: 8rem 0 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="content-block1 ">
                        <div class="title-box wow fadeIn" data-wow-delay="0.1s">
                            <div class="sub-title" >
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Our Concept and Inspiration' ?? ''; ?>
								<? else: ?>
									<?php echo 'แนวคิดและแรงบันดาลใจของเรา' ?? ''; ?>
								<? endif; ?>

							</div>
                            <h2 class="sec-title" style="color: #000;">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $about['banner_subtitle_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $about['banner_subtitle_th'] ?? ''; ?>
								<? endif; ?>
							</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_accommodation" >
    <style>
        .section_accommodation:before {
            content: '';
            background-image: url(<?php echo base_url('uploads/hotel_home/' . ($room_info['rooms_bg_img'] ?? '')) ?>);
            width: 600px;
            height: 600px;
            position: absolute;
            left: 0;
            top: 0;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: left;
			/* opacity: 0.7; ปรับตรงนี้ 0.0 = หายไปเลย, 1.0 = เต็ม */
        }
    </style>
        <div class="container parallax_scroll" style="transform: translate3d(0px, 58.2px, 0px); ">
            <div class="row">
                <div class="col-lg-4">
                    <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="title-box">
                            <div class="sub-title wow fadeIn"  data-wow-delay="0.1s" >
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $room_info['rooms_title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $room_info['rooms_title_th'] ?? ''; ?>
								<? endif; ?>
							</div>
                            <h2 class="sec-title wow fadeIn" data-wow-delay="0.2s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $room_info['rooms_subtitle_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $room_info['rooms_subtitle_th'] ?? ''; ?>
								<? endif; ?>
							</h2>
                            <p class="wow fadeIn" data-wow-delay="0.3s">
								    <?php
                                        $desc = $this->session->userdata('lang') == 'en'
                                            ? ($room_info['rooms_desc_en'] ?? '')
                                            : ($room_info['rooms_desc_th'] ?? '');
                                        echo strip_tags($desc); // ลบ HTML tag ทั้งหมดออก
                                    ?>

							</p>
                        </div>
                        <a href="#" class="wow fadeIn" data-wow-delay="0.4s" >
                            <button class="btn_moredetails" style="background-color: <?php echo $hotel['color'] ?>;">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Our Rooms' ?? ''; ?>
								<? else: ?>
									<?php echo 'ห้องพักของเรา' ?? ''; ?>
								<? endif; ?>

							</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 wow fadeIn" data-wow-delay="0.2s">
                    <div class="swiper mySwiper11">
                        <div class="swiper-wrapper">
							<?php foreach ($rooms as $room): ?>
								<div class="swiper-slide">
									<div class="hp-room-item set-bg" style="background-image: url(<?php echo base_url('uploads/room/' . $room['banner_image']) ?>);">
										<div class="hr-text">
											<h2 class="text-white"><?php echo $room['title_en'] ?></h2>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
                            <!-- <div class="swiper-slide">
                                <div class="hp-room-item set-bg" style="background-image: url(<?php echo base_url("assets_hotel/images/home/r3.png") ?>);">
                                    <div class="hr-text">

                                        <h2 class="text-white">Standard Double Room</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="hp-room-item set-bg" style="background-image: url(<?php echo base_url("assets_hotel/images/home/r2.png") ?>);">
                                    <div class="hr-text">
                                        <h2 class="text-white">Standard Double Room</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="hp-room-item set-bg" style="background-image: url(<?php echo base_url("assets_hotel/images/home/r3.png") ?>);">
                                    <div class="hr-text">
                                       <h2 class="text-white">Standard Double Room</h2>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <!-- ปุ่มลูกศรพร้อมไอคอน -->
                        <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                        <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feature-section-apartment-1 " style="background-image:url(<?php echo base_url('uploads/hotel_home/' . $facilities['gallery_bg_img']) ?>); width: 100%;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 pe-lg-5">
                    <div class="section_tagline">
                        <ul>

						<!-- <?php foreach ($gallery as $i => $img): ?>
							<li>
								<div class="images_photo wow fadeIn" data-wow-delay="<?php echo 0.1 + ($i * 0.1) ?>s">
									<img src="" width="100%">
								</div>
							</li>
						<?php endforeach; ?> -->
                            <li>
                                <div class="images_photo wow fadeIn" data-wow-delay="0.1s">
                                    <img src="<?php echo base_url('uploads/hotel_home/' . $facilities['pre_gal_one_img']) ?>" width="100%">
                                </div>
                            </li>
                            <li>
                                <div class="images_photo wow fadeIn" data-wow-delay="0.2s">
                                    <img src="<?php echo base_url('uploads/hotel_home/' . $facilities['pre_gal_two_img']) ?>" width="100%">
                                </div>
                            </li>

                            <li>
                                <div class="images_photo wow fadeIn" data-wow-delay="0.4s">
                                    <img src="<?php echo base_url('uploads/hotel_home/' . $facilities['pre_gal_four_img']) ?>" width="100%">
                                </div>
                            </li>
							                            <li>
                                <div class="images_photo wow fadeIn" data-wow-delay="0.3s">
                                    <img src="<?php echo base_url('uploads/hotel_home/' . $facilities['pre_gal_three_img']) ?>" width="100%">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5" >
                    <div class="title-box">
                        <div class="sub-title wow fadeIn" data-wow-delay="0.1s">
							<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $facilities['gallery_title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $facilities['gallery_title_th'] ?? ''; ?>
								<? endif; ?>

						</div>
                        <h2 class="sec-title wow fadeIn" data-wow-delay="0.2s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $facilities['gallery_sub_title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $facilities['gallery_sub_title_th'] ?? ''; ?>
								<? endif; ?>
						</h2>
                        <p class="wow fadeIn" data-wow-delay="0.3s">
							<?php
                                $desc = $this->session->userdata('lang') == 'en'
                                    ? ($facilities['gallery_desc_en'] ?? '')
                                    : ($facilities['gallery_desc_th'] ?? '');
                                echo strip_tags($desc); // ลบ HTML tag ทั้งหมดออก
                            ?>
							<!-- Lorem ipsum dolor sit amet, consectetur adipisic- ing elit, sed do eiusmod tempor inc.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. -->
						</p>
                        <a href="#" class="wow fadeIn" data-wow-delay="0.4s">
                            <button class="btn_moredetails" style="background-color: <?php echo $hotel['color'] ?>;">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Photo Gallery' ?? ''; ?>
								<? else: ?>
									<?php echo 'แกลอรี่ภาพถ่าย' ?? ''; ?>
								<? endif; ?>

							</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_facilities ">
		<style>
			.section_facilities:before {
				content: '';
				background-image: url(<?php echo base_url('uploads/hotel_home/' . ($facilities['facilities_bg_img'] ?? '')) ?>);
				width: 600px;
				height: 600px;
				position: absolute;
				right: 0;
				top: 0;
				background-size: contain;
				background-repeat: no-repeat;
				background-position: right;
			}
		</style>
        <div class="container ">
            <div class="title-box wow fadeIn" data-wow-delay="0.1s">
                <div class="sub-title">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $facilities['facilities_title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $facilities['facilities_title_th'] ?? ''; ?>
								<? endif; ?>

				</div>
                <h2 class="sec-title">
					<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $facilities['facilities_subtitle_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $facilities['facilities_subtitle_th	'] ?? ''; ?>
								<? endif; ?>

				</h2>
            </div>
        </div>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 wow fadeIn" data-wow-delay="0.2s">
                    <div class="swiper mySwiper1 swiper-initialized swiper-horizontal swiper-backface-hidden">
                        <div class="swiper-wrapper" id="swiper-wrapper-798377d76f3561cb" aria-live="off">
                            <?php foreach ($facility as $fac): ?>
							<div class="swiper-slide">
								<div class="room-block">
									<div class="inner-box">
										<div class="image">
											<img src="<?php echo base_url('uploads/facility/' . $fac['image']) ?>" alt="" width="100%">
										</div>
										<div class="content">
											<h3>
												<a href="#">
											<?php if ($this->session->userdata('lang') == 'en'): ?>
												<?= $fac['facility_name'] ?? '' ?>
											<?php else: ?>
												<?= $fac['facility_name'] ?? '' ?>
											<?php endif; ?>
												</a>
											</h3>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('hotel/cls/cls_hotel_footer'); ?>
    <?php script_function(); ?>
    <script src="<?php echo base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js') ?>"></script>
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
