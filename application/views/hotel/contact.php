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
        <section class="page-title" style="background-image: url(<?php echo base_url('uploads/slide_other/' . $slide_other['img_contact']) ?>);">
            <div class="container">
                <div class="title-outer text-center">
                    <h1 class="title">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Contact Us' ?? ''; ?>
								<? else: ?>
									<?php echo 'ติดต่อเรา' ?? ''; ?>
								<? endif; ?>
						
					</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="<?=base_url('index.php')?>">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Home' ?? ''; ?>
								<? else: ?>
									<?php echo 'หน้าหลัก' ?? ''; ?>
								<? endif; ?>
						</a></li>
                        <li>
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Contact' ?? ''; ?>
								<? else: ?>
									<?php echo 'ติดต่อ' ?? ''; ?>
								<? endif; ?>
						</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="contact-details">
            <div class="container pt-110 pb-70">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="sec-title">
                            <span class="sub-title before-none">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Send us email' ?? ''; ?>
								<? else: ?>
									<?php echo 'ส่งอีเมลถึงเรา' ?? ''; ?>
								<? endif; ?>
							</span>
                            <h2>
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $contact['mail_des_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $contact['mail_des_th']?? ''; ?>
								<? endif; ?>	
							</h2>
                        </div>
                        <!-- Contact Form -->
                        <form id="contact_form" name="contact_form" action="includes/sendmail.php" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <input name="form_name" class="form-control" type="text" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <input name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea name="form_message" class="form-control required" rows="7" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="mb-5">
                                <input name="form_botcheck" class="form-control" type="hidden" value="">
                                <button type="submit" class="theme-btn btn-style-one" data-loading-text="Please wait..."><span class="btn-title">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Send message' ?? ''; ?>
								<? else: ?>
									<?php echo 'ส่งข้อความ' ?? ''; ?>
								<? endif; ?>
									
								</span></button>
                                <button type="reset" class="theme-btn btn-style-one bg-theme-color5"><span class="btn-title">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Reset' ?? ''; ?>
								<? else: ?>
									<?php echo 'รีเซ็ต' ?? ''; ?>
								<? endif; ?>
									
								</span></button>
                            </div>
                        </form>
                        <!-- Contact Form Validation-->
                    </div>
                    <div class="col-xl-5 col-lg-6 wow fadeIn" data-wow-delay="0.2s">
                        <div class="contact-details__right">
                            <div class="sec-title">
                                <span class="sub-title before-none">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Need any help?' ?? ''; ?>
								<? else: ?>
									<?php echo 'ต้องการความช่วยเหลือไหม?' ?? ''; ?>
								<? endif; ?>
								</span>
                                <h2>
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Get in touch with us' ?? ''; ?>
								<? else: ?>
									<?php echo 'ติดต่อเรา' ?? ''; ?>
								<? endif; ?>
								</h2>
                                <div class="text">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo $contact['contact_des_en'] ?? ''; ?>
								<? else: ?>
									<?php echo $contact['contact_des_th']?? ''; ?>
								<? endif; ?>	
									
								</div>
                            </div>
                            <ul class="list-unstyled contact-details__info">
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-phone-volume"></i>
                                    </div>
                                    <div class="text">
                                        <h6 class="mb-1">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Have any question?' ?? ''; ?>
								<? else: ?>
									<?php echo 'มีคำถามอะไรไหม?' ?? ''; ?>
								<? endif; ?>
											
										</h6>
                                        <a href="tel:980089850"> 
											<?= str_replace(['["', '"]', '","'], ['', '', ' , '], $footer['phone']); ?>
											053-271-800
										</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <h6 class="mb-1">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Write email' ?? ''; ?>
								<? else: ?>
									<?php echo 'เขียนอีเมล' ?? ''; ?>
								<? endif; ?>
											
										</h6>
                                        <a href="mailto:info@iwualai.com">
											<?= str_replace(['["', '"]', '","'], ['', '', ' , '], $footer['email']); ?>
										</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-earth-europe"></i>
                                    </div>
                                    <div class="text">
                                        <h6 class="mb-1">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?php echo 'Visit anytime' ?? ''; ?>
								<? else: ?>
									<?php echo 'เชิญมาได้ทุกเมื่อ' ?? ''; ?>
								<? endif; ?>
											
										</h6>
                                        <span>
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?= $footer['address_en'] ?? ''; ?>
								<? else: ?>
									<?= $footer['address_th'] ?? ''; ?>
								<? endif; ?>
										</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="map-section">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d30219.40282074838!2d98.97133824195862!3d18.779188169763184!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3075e1c001ed%3A0x384cd95f645a1010!2siWualai%20Hotel!5e0!3m2!1sth!2sth!4v1767845720335!5m2!1sth!2sth" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        <?php $this->load->view('hotel/cls/cls_hotel_footer'); ?>
        <?php script_function(); ?>
        <script src="<?=base_url('assets_hotel/assets/dist/js/bootstrap.bundle.min.js')?>"></script>
        
    </body>
</html>
