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
									<?php echo $room_details['title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $room_details['title_th']  ?? ''; ?>
								<? endif; ?>
					</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="feature-section-apartment-1 " style="background-image:url(images/home/carousel.png); width: 100%; padding: 2.5rem 0;">
        <div class="container">
            <div class="row align-items-lg-center">
                <div class="col-xl-5">
                    <div class="title-box">
                        <div class="sub-title wow fadeIn animated" data-wow-delay="0.1s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Rooms' ?? ''; ?>
								<? else: ?>
									<?php echo 'ห้องพัก' ?? ''; ?>
								<? endif; ?>
						</div>
                        <h2 class="sec-title wow fadeIn animated" data-wow-delay="0.2s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $room_details['title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $room_details['title_th']  ?? ''; ?>
								<? endif; ?>
						</h2>
                    </div>
                </div>
                <div class="col-xl-7 text-lg-end">
                    <a href="https://hotels.cloudbeds.com/reservation/DLSe72" class="wow fadeIn animated" data-wow-delay="0.4s">
                            <button class="btn_moredetails"> 
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Book your stay' ?? ''; ?>
								<? else: ?>
									<?php echo 'จองที่พักของคุณ' ?? ''; ?>
								<? endif; ?>
								
							</button>
                        </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section_accommodation">
        <div class="container parallax_scroll" style="transform: translate3d(0px, 58.2px, 0px);">
            <div class="row">
                <div class="col-xl-7 mb-3">
                    <div id="carouselExampleFade2" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="w-100" src="<?=  base_url('uploads/room/' . $room_details['image']) ?>" alt="">
                            </div>
                            <!-- <div class="carousel-item">
                                <img class="w-100" src="images/home/room-2.jpg" alt="">
                            </div> -->
                        </div>
                        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade2" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade2" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button> -->
                    </div>
                </div>
                <div class="col-xl-5 ps-lg-5">
                    <div class="title-box">
                    <div class="sub-title wow fadeIn animated" data-wow-delay="0.1s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $room_details['title_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $room_details['title_th']  ?? ''; ?>
								<? endif; ?>
					</div>
                    <h2 class="sec-title wow fadeIn animated" data-wow-delay="0.2s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Amenities In Rooms' ?? ''; ?>
								<? else: ?>
									<?php echo 'สิ่งอำนวยความสะดวกในห้องพัก'  ?? ''; ?>
								<? endif; ?>
					</h2>
                </div>
                    <div class="row room-facility-list mb-40">
                        <?php foreach ($room_facility as $facility): ?>
						<div class="col-sm-6 col-xl-6">
							<div class="list-one d-flex align-items-center me-sm-4 mb-3">
								<div class="icon text-theme-color1 mr-10 flex-shrink-0">
									<i class="bi bi-patch-check pe-2"></i>
								</div>
								<h6 class="title m-0">
									<? if ($this->session->userdata('lang') == 'en'): ?>
										<?= $facility['name'] ?>
									<? else: ?>
										<?= $facility['name'] ?>	
									<? endif; ?>
								</h6>
							</div>
						</div>
						<?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-details ">
        <div class="container">
            <div class="mt-40 wow fadeIn" data-wow-delay="0.3s">
                <div class="title-box">
                    <div class="sub-title wow fadeIn animated" data-wow-delay="0.1s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Rooms' ?? ''; ?>
								<? else: ?>
									<?php echo 'ห้องพัก' ?? ''; ?>
								<? endif; ?>
					</div>
                    <h2 class="sec-title wow fadeIn animated" data-wow-delay="0.2s">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Room Gallery' ?? ''; ?>
								<? else: ?>
									<?php echo 'ห้องแสดงภาพ' ?? ''; ?>
								<? endif; ?>
						
					</h2>
                </div>
                <div class="row room-facility-list mt-3  mb-40">
                    <div class="col-xl-12 mb-5">
                        <div class="masonry">
							<?php foreach ($room_gallery as $gallery): ?>
							<div class="mItem">
								<div class="service-thumb">
									<a href="<?= base_url('uploads/room/' . $gallery['image']) ?>" class="img-link">
										<img src="<?= base_url('uploads/room/' . $gallery['image']) ?>" alt="" class="img-responsive" width="100%">
									</a>
								</div>
							</div>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
    .booking-form {
        background: #f3f3f3b0;
        width: 100%;
        border-radius: 4px;
        height: 350px;
        position: relative;
    }

    .widgetHotelsForm .acessa_widget_block .widgetHotelsInputText.date,
    .widgetHotelsForm .acessa_widget_block select {
        height: 40px !important;
        margin-bottom: 20px;

    }

    .CloudBedsWidget .horizontal-widget,
    .CloudBedsWidget .vertical-widget {
        font-family: Arial, Helvetica, sans-serif;
        height: 50px;
    }

    .CloudBedsWidget .widgetHotelsForm a.submit_link {
        border-radius: 50px !important;
        background: #f62b0a !important;
        border: #f62b0a !important;
        padding: 13px;
        color: #fff !important;
    }

    .widgetHotelsForm .acessa_widget_block p {
        font-size: 16px !important;
        color: #000 !important;
    }

    .widgetHotelsForm a.submit_link {
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
        color: #333333;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        line-height: 20px;
        margin-bottom: 0;
        margin-top: 20px;
        padding: 4px 12px;
        text-align: center;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
        vertical-align: middle;
        max-width: -webkit-fill-available;
        border: 1px solid #fff;
    }
    </style>
     <?php $this->load->view('hotel/cls/cls_hotel_footer'); ?>
    <?php script_function(); ?>
    <script src="<?=base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js');?>"></script>
</body>

</html>
