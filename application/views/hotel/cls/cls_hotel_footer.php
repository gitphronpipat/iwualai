<div class="bg-menu1 d-inline-block d-xl-none">
    <div class="row text-center">
        
        <div class="col pd-menu1">
            <a href="https://hotels.cloudbeds.com/reservation/DLSe72">
                 Book your stay
            </a>
        </div>
        
    </div>
</div>
<style>
	.footer-section .footer-text .ft-about .fa-social a {
    display: inline-block;
    height: 40px;
    width: 40px;
    font-size: 16px;
    line-height: 36px;
    text-align: center;
    color: #ffffff;
    background-color: <?php echo $hotel['color'] ?>;
    border: 1px solid <?php echo $hotel['color'] ?>;
    border-radius: 50%;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
    margin-right: 7px;
}
</style>
<footer class="footer-section">
        <div class="container">
            
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ft-about">
                            <div class="logo d-none d-xl-block">
                                <a href="#">
                                    <img src=" <?=base_url('uploads/footer/' . $footer['logo'])?>">
                                </a>
                            </div>
                            <p>
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?= $footer['description_en'] ?? ''; ?>
								<? else: ?>
									<?= $footer['description_th'] ?? ''; ?>
								<? endif; ?>
							</p>
                            <div class="fa-social">
                                <a href="<?=$footer['facebook_url']?>"><i class="bi bi-facebook"></i></a>
                                
                                <a href="<?=$footer['instagram_url']?>"><i class="bi bi-instagram"></i></a>
                                <a href="<?=$footer['line_url']?>"><i class="bi bi-line"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ft-contact">
                            <h6>Hotel </h6>
                            <ul>
                                <li>ROOMS</li>
                                <li>FACILITIES</li>
                                <li>GALLERY</li>
                                <li>CONTACT US</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ft-contact">
                            <h6>Our hotels </h6>
                            <ul>
                                <li>iWualai Hotel</li>
                                <li>iSilver Hotel</li>
                                <li>iThaphae Hotel</li>
                                <li>iGreen Hotel @Thaphae</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="ft-contact">
                            <h6>Offer </h6>
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ft-contact">
                            <h6>Contact Us</h6>
                            <ul>
                                <li> 
									<?= str_replace(['["', '"]', '","'], ['', '', ' , '], $footer['phone']); ?>
								</li>
                                <li>
									<?= str_replace(['["', '"]', '","'], ['', '', ' , '], $footer['email']); ?>
								</li>
                                <li>
									<? if ($this->session->userdata('lang') == 'en'): ?>
									<?= $footer['address_en'] ?? ''; ?>
								<? else: ?>
									<?= $footer['address_th'] ?? ''; ?>
								<? endif; ?>
								</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-option">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="co-text"><p>Copyright ©<script>document.write(new Date().getFullYear());</script> All rights reserved </p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
