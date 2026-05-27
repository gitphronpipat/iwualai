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
                        <li><a href="index.php" >
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
.page-breadcrumb li a {
    color: <?php echo $hotel['color'] ?>;
    font-weight: 500;
    text-transform: capitalize;
    transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
}

.page-breadcrumb li:after {
    position: absolute;
    content: "/";
    right: -6px;
    top: 1px;
    color: <?php echo $hotel['color'] ?>;
    font-size: 14px;
    font-weight: 900;
}
.sub-title:before {
    position: absolute;
    content: '';
    height: 1px;
    width: 45px;
    background: <?php echo $hotel['color'] ?>;
    left: 0;
    bottom: 7px;
}

.sub-title {
    font-size: 14px;
    letter-spacing: 2px;
    line-height: 1.6em;
    color: <?php echo $hotel['color'] ?>;
    font-weight: 700;
    text-transform: uppercase;
    padding-left: 53px;
    padding-right: 53px;
    position: relative;
    display: inline-block;
    vertical-align: middle;
    margin-bottom: 0px;
}
.btn_moredetails {
    font-family: var(--font-DMSans-Bold) !important;
    background: <?php echo $hotel['color'] ?>;
    color: #ffffff;
    padding: 13px 25px;
    font-size: 14px;
    text-transform: uppercase;
    margin-top: 10px;
    border: none;
    font-weight: inherit;
    letter-spacing: 1px;
    position: relative;
    border-radius: 100px;
    transition: all 0.25s;
}

.section_accommodation:before {
    content: '';
    width: 600px;
    height: 600px;
    position: absolute;
	background-image: var(--before-bg);
    left: 0;
    top: 0;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: left;
}

.section_facilities:before {
    content: '';
    width: 600px;
    height: 600px;
    position: absolute;
	background-image: var(--before-bg);
    right: 0;
    top: 0;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: right;
}


   </style>
<?php foreach ($rooms as $key => $room): ?>

<?php
$section_classes = ['section_accommodation', 'feature-section-apartment-1', 'section_facilities', 'feature-section-apartment-1'];
$current_class = $section_classes[$key % 4];
?>

<?php if ($current_class == 'feature-section-apartment-1'): ?>
<section class="feature-section-apartment-1" style="background-image: url(<?= base_url('uploads/room/' . $room['amenity_bg_image']) ?>); width: 100%;">
    <div class="container">

<?php elseif ($current_class == 'section_accommodation'): ?>
<section class="section_accommodation" style="--before-bg: url('<?= base_url('uploads/room/' . $room['amenity_bg_image']) ?>');">
    <div class="container parallax_scroll" style="transform: translate3d(0px, 58.2px, 0px);">

<?php else: ?>
<section class="section_facilities" style="--before-bg: url('<?= base_url('uploads/room/' . $room['amenity_bg_image']) ?>');">
    <div class="container">

<?php endif; ?>
        <div class="row">

            <?php if ($key % 2 == 0): ?>
            <!-- ข้อความซ้าย รูปขวา -->
            <div class="col-lg-5 order-lg-1 order-2 pe-lg-5">
                <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                    <div class="title-box">
                        <div class="sub-title wow fadeIn" data-wow-delay="0.1s">
                            <? if ($this->session->userdata('lang') == 'en'): ?>
                                <?php echo 'Rooms'; ?>
                            <? else: ?>
                                <?php echo 'ห้องพัก'; ?>
                            <? endif; ?>
                        </div>
                        <div class="hr-text">
                            <h3>
                                <? if ($this->session->userdata('lang') == 'en'): ?>
                                    <?php echo $room['title_en'] ?? ''; ?>
                                <? else: ?>
                                    <?php echo $room['title_th'] ?? ''; ?>
                                <? endif; ?>
                            </h3>
                        </div>
                    </div>
					<a href="<?= base_url(str_replace(' ', '-', $hotel['title_en']) .'/'. 'room_details/' . $room['room_id']) ?>" class="wow fadeIn" data-wow-delay="0.4s">
                        <button class="btn_moredetails">View Details</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 order-lg-2 order-1 wow fadeIn" data-wow-delay="0.2s">
                <div class="hp-room-item set-bg" style="background-image: url(<?php echo base_url('uploads/room/' . $room['banner_image']) ?>);"></div>
            </div>

            <?php else: ?>
            <!-- รูปซ้าย ข้อความขวา -->
            <div class="col-lg-7 pe-lg-5 wow fadeIn" data-wow-delay="0.2s">
                <div class="hp-room-item set-bg" style="background-image: url(<?php echo base_url('uploads/room/' . $room['banner_image']) ?>);"></div>
            </div>
            <div class="col-lg-5">
                <div class="images_accommodation details_accommodation aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                    <div class="title-box">
                        <div class="sub-title wow fadeIn" data-wow-delay="0.1s">
                            <? if ($this->session->userdata('lang') == 'en'): ?>
                                <?php echo 'Rooms'; ?>
                            <? else: ?>
                                <?php echo 'ห้องพัก'; ?>
                            <? endif; ?>
                        </div>
                        <div class="hr-text">
                            <h3>
                                <? if ($this->session->userdata('lang') == 'en'): ?>
                                    <?php echo $room['title_en'] ?? ''; ?>
                                <? else: ?>
                                    <?php echo $room['title_th'] ?? ''; ?>
                                <? endif; ?>
                            </h3>
                        </div>
                    </div>
                    <a href="<?= base_url(str_replace(' ', '-', $hotel['title_en']) .'/'. 'room_details/' . $room['room_id']) ?>" class="wow fadeIn" data-wow-delay="0.4s">
                        <button class="btn_moredetails">View Details</button>
                    </a>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php endforeach; ?>
<!-- 
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
									<? if ($this->session->userdata('lang') == 'en'): ?>
										<?php echo $rooms[0]['title_en'] ?? ''; ?>
									<? else: ?>
										<?php echo $rooms[0]['title_th'] ?? ''; ?>
									<? endif; ?>
												
											</h3>
										</div>
							</div>
							<a href="room-details.php" class="wow fadeIn" data-wow-delay="0.4s">
								<button class="btn_moredetails">View Details</button>
							</a>
						</div>
					</div>
					<div class="col-lg-7 order-lg-2 order-1 wow fadeIn" data-wow-delay="0.2s">
						<div class="hp-room-item set-bg" style="background-image: url(<?php echo base_url('uploads/room/' . $rooms[0]['banner_image']) ?>);"></div>
					</div>
				</div>
			</div>
		</section>
		<section class="feature-section-apartment-1 " style="background-image:url(<?php echo base_url('uploads/room/' . $rooms[1]['amenity_bg_image']) ?>); width: 100%;">
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
											<h3>
												Standard Family Room
											</h3>
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
-->





        <?php $this->load->view('hotel/cls/cls_hotel_footer'); ?>
        <?php script_function(); ?>
        <script src="<?php echo base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js');?>"></script>
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
