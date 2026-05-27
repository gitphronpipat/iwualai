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

.section_gallery .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background: <?php echo $hotel['color'] ?>;
    color: #ffffff !important;
}
	</style>
    <body class="dark_bg">
        <?php $this->load->view('hotel/cls/cls_hotel_menu'); ?>
        <section class="page-title" style="background-image: url(<?php echo base_url('uploads/slide_other/' . $slide_other['img_gallery']) ?>);">
            <div class="container">
                <div class="title-outer text-center">
                    <h1 class="title">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'gallery' ?? ''; ?>
								<? else: ?>
									<?php echo 'แกลเลอรี' ?? ''; ?>
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
									<?php echo 'gallery' ?? ''; ?>
								<? else: ?>
									<?php echo 'แกลเลอรี' ?? ''; ?>
								<? endif; ?>
						</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section_gallery">
            <div class="container pt-110 pb-70">
                <div class="row">
                    <div class="col-lg-6 mx-auto wow fadeIn" data-wow-delay="0.1s">
						<ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
							<?php foreach ($gallerycategory as $key => $cat): ?>
							<li class="nav-item" role="presentation">
								<button class="nav-link <?= $key == 0 ? 'active' : '' ?>" 
									id="pills-<?= $cat['category_id'] ?>-tab" 
									data-bs-toggle="pill" 
									data-bs-target="#pills-<?= $cat['category_id'] ?>" 
									type="button" role="tab"
									aria-selected="<?= $key == 0 ? 'true' : 'false' ?>">
									<?= $this->session->userdata('lang') == 'en' ? $cat['name_en'] : $cat['name_th'] ?>
								</button>
							</li>
							<?php endforeach; ?>
						</ul>
                        <!-- <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"> Rooms</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Breakfast</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact1-tab" data-bs-toggle="pill" data-bs-target="#pills-contact1" type="button" role="tab" aria-controls="pills-contact1" aria-selected="false">Facilities</button>
                            </li>
                        </ul> -->
                    </div>
                    <div class="col-lg-12 mt-5 wow fadeIn" data-wow-delay="0.2s">
					<div class="tab-content" id="pills-tabContent">
						<?php foreach ($gallerycategory as $key => $cat): ?>
						<div class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>" 
							id="pills-<?= $cat['category_id'] ?>" 
							role="tabpanel" tabindex="0">
							<div class="col-lg-12">
								<div class="masonry">
									<?php foreach ($gallery as $img): ?>
										<?php if ($img['category_id'] == $cat['category_id']): ?>
										<div class="mItem">
											<div class="service-thumb">
												<a href="<?= base_url('uploads/gallery/' . $img['image']) ?>" class="img-link">
													<img src="<?= base_url('uploads/gallery/' . $img['image']) ?>" alt="" class="img-responsive" width="100%">
												</a>
											</div>
										</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
                        <!-- <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="col-lg-12">
                                    <div class="masonry">
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/1.jpg" class="img-link">
                                                    <img src="images/gallery/1.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/2.jpg" class="img-link">
                                                    <img src="images/gallery/2.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/3.jpg" class="img-link">
                                                    <img src="images/gallery/3.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/4.jpg" class="img-link">
                                                    <img src="images/gallery/4.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/5.jpg" class="img-link">
                                                    <img src="images/gallery/5.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/6.jpg" class="img-link">
                                                    <img src="images/gallery/6.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/7.jpg" class="img-link">
                                                    <img src="images/gallery/7.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/8.jpg" class="img-link">
                                                    <img src="images/gallery/8.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/9.jpg" class="img-link">
                                                    <img src="images/gallery/9.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/10.jpg" class="img-link">
                                                    <img src="images/gallery/10.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/11.jpg" class="img-link">
                                                    <img src="images/gallery/11.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/12.jpg" class="img-link">
                                                    <img src="images/gallery/12.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/13.jpg" class="img-link">
                                                    <img src="images/gallery/13.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/14.jpg" class="img-link">
                                                    <img src="images/gallery/14.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/15.jpg" class="img-link">
                                                    <img src="images/gallery/15.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/16.jpg" class="img-link">
                                                    <img src="images/gallery/16.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="col-lg-12">
                                    <div class="masonry">
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/1.jpg" class="img-link">
                                                    <img src="images/gallery/1.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/2.jpg" class="img-link">
                                                    <img src="images/gallery/2.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/3.jpg" class="img-link">
                                                    <img src="images/gallery/3.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/4.jpg" class="img-link">
                                                    <img src="images/gallery/4.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/5.jpg" class="img-link">
                                                    <img src="images/gallery/5.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/6.jpg" class="img-link">
                                                    <img src="images/gallery/6.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/7.jpg" class="img-link">
                                                    <img src="images/gallery/7.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/8.jpg" class="img-link">
                                                    <img src="images/gallery/8.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/9.jpg" class="img-link">
                                                    <img src="images/gallery/9.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/10.jpg" class="img-link">
                                                    <img src="images/gallery/10.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/11.jpg" class="img-link">
                                                    <img src="images/gallery/11.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/12.jpg" class="img-link">
                                                    <img src="images/gallery/12.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="col-lg-12">
                                    <div class="masonry">
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/1.jpg" class="img-link">
                                                    <img src="images/gallery/1.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/2.jpg" class="img-link">
                                                    <img src="images/gallery/2.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/3.jpg" class="img-link">
                                                    <img src="images/gallery/3.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/4.jpg" class="img-link">
                                                    <img src="images/gallery/4.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/5.jpg" class="img-link">
                                                    <img src="images/gallery/5.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/6.jpg" class="img-link">
                                                    <img src="images/gallery/6.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/7.jpg" class="img-link">
                                                    <img src="images/gallery/7.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/8.jpg" class="img-link">
                                                    <img src="images/gallery/8.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/9.jpg" class="img-link">
                                                    <img src="images/gallery/9.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact1" role="tabpanel" aria-labelledby="pills-contact1-tab" tabindex="0">
                                <div class="col-lg-12">
                                    <div class="masonry">
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/1.jpg" class="img-link">
                                                    <img src="images/gallery/1.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/2.jpg" class="img-link">
                                                    <img src="images/gallery/2.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/3.jpg" class="img-link">
                                                    <img src="images/gallery/3.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/4.jpg" class="img-link">
                                                    <img src="images/gallery/4.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/5.jpg" class="img-link">
                                                    <img src="images/gallery/5.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/6.jpg" class="img-link">
                                                    <img src="images/gallery/6.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/7.jpg" class="img-link">
                                                    <img src="images/gallery/7.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/8.jpg" class="img-link">
                                                    <img src="images/gallery/8.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mItem">
                                            <div class="service-thumb">
                                                <a href="images/gallery/9.jpg" class="img-link">
                                                    <img src="images/gallery/9.jpg" alt="" class="img-responsive" width="100%">
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </section>
        <?php $this->load->view('hotel/cls/cls_hotel_footer'); ?>
        <?php script_function(); ?>
        <script src="<?php echo base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js');?>"></script>
        

    </body>
</html>

