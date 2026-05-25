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
        <section class="page-title" style="background-image: url(<?=base_url('images/home/page-title-bg.png')?>)">
            <div class="container">
                <div class="title-outer text-center">
                    <h1 class="title">Contact Us</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="<?=base_url('index.php')?>">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="contact-details">
            <div class="container pt-110 pb-70">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="sec-title">
                            <span class="sub-title before-none">Send us email</span>
                            <h2>Your email address will not be published. Required fields are marked</h2>
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
                                <button type="submit" class="theme-btn btn-style-one" data-loading-text="Please wait..."><span class="btn-title">Send message</span></button>
                                <button type="reset" class="theme-btn btn-style-one bg-theme-color5"><span class="btn-title">Reset</span></button>
                            </div>
                        </form>
                        <!-- Contact Form Validation-->
                    </div>
                    <div class="col-xl-5 col-lg-6 wow fadeIn" data-wow-delay="0.2s">
                        <div class="contact-details__right">
                            <div class="sec-title">
                                <span class="sub-title before-none">Need any help?</span>
                                <h2>Get in touch with us</h2>
                                <div class="text">Welcome to our Website. We are glad to have you around.</div>
                            </div>
                            <ul class="list-unstyled contact-details__info">
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-phone-volume"></i>
                                    </div>
                                    <div class="text">
                                        <h6 class="mb-1">Have any question?</h6>
                                        <a href="tel:980089850"> 053-271-800</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <h6 class="mb-1">Write email</h6>
                                        <a href="mailto:info@iwualai.com">info@iwualai.com</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-earth-europe"></i>
                                    </div>
                                    <div class="text">
                                        <h6 class="mb-1">Visit anytime</h6>
                                        <span>84 Wualai Road. Tambon Haiya, Amphoe Muang Chiang Mai</span>
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
        <script src="<?=base_url('assets/dist/js/bootstrap.bundle.min.js')?>"></script>
        
    </body>
</html>
