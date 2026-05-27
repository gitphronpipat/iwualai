<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $this->load->view('hotel/cls/cls_hotel_function');
        css_function();
        ?>
    </head>
	<style>
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
	</style>
    <body class="dark_bg">
        <?php $this->load->view('hotel/cls/cls_hotel_menu'); ?>
        <section class="page-title" style="background-image: url(<?php echo base_url('uploads/slide_other/' . $slide_other['img_facilities']) ?>);">
            <div class="container">
                <div class="title-outer text-center">
                    <h1 class="title">
						     <? if ($this->session->userdata('lang') == 'en'): ?>
                                <?php echo 'facilities'; ?>
                            <? else: ?>
                                <?php echo 'สิ่งอำนวยความสะดวก'; ?>
                            <? endif; ?>
					</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">
							<? if ($this->session->userdata('lang') == 'en'): ?>
                                <?php echo 'Home'; ?>
                            <? else: ?>
                                <?php echo 'หน้าหลัก'; ?>
                            <? endif; ?>
						</a></li>
                        <li>
							 <? if ($this->session->userdata('lang') == 'en'): ?>
                                <?php echo 'facilities'; ?>
                            <? else: ?>
                                <?php echo 'สิ่งอำนวยความสะดวก'; ?>
                            <? endif; ?>
						</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section_gallery">
            <div class="container pt-110 pb-70">
                <div class="row">
					<?php foreach ($facility as $key => $fac): ?>
						<div class="col-lg-4 col-6 wow fadeIn" data-wow-delay="0.<?= $key + 1 ?>s">
							<div class="room-block">
								<div class="inner-box">
									<div class="image">
										<img src="<?= base_url('uploads/facility/' . $fac['image']) ?>" alt="" width="100%">
									</div>
									<div class="content">
										<h3><a href="#">
											<?php if ($this->session->userdata('lang') == 'en'): ?>
												<?= $fac['facility_name'] ?? '' ?>
											<?php else: ?>
												<?= $fac['facility_name'] ?? '' ?>
											<?php endif; ?>
										</a></h3>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
											<!-- <div class="col-lg-4 col-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="room-block">
                            <div class="inner-box">
                                <div class="image"><img src="images/home/11.jpg" alt="" width="100%"></div>
                                <div class="content">
                                    <h3><a href="#">
										sunbathing chair
									</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6 wow fadeIn" data-wow-delay="0.2s">
                        <div class="room-block">
                            <div class="inner-box">
                                <div class="image"><img src="images/home/22.jpg" alt="" width="100%"></div>
                                <div class="content">
                                    <h3><a href="#">
										key card access
									</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6 wow fadeIn" data-wow-delay="0.3s">
                        <div class="room-block">
                            <div class="inner-box">
                                <div class="image"><img src="images/home/33.jpg" alt="" width="100%"></div>
                                <div class="content">
                                    <h3><a href="#">
										water dispenser
									</a></h3>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                </div>
            </div>
        </section>
        <?php $this->load->view('hotel/cls/cls_hotel_footer'); ?>
        <?php script_function(); ?>
        <script src="<?php echo base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js');?>"></script>
        
    </body>
</html>
