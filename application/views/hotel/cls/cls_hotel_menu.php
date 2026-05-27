<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
</svg>

<div class="topbar-one d-none d-xl-block">
    <div class="topbar-one__contaner container-fluid fluid">
        <div class="topbar-one__inner">
            <div class="topbar-one__left">
                <ul class="topbar-one__info">
                    <li class="topbar-one__info-item">
                        <span class="topbar-one__info-icon fa-solid fa-phone-volume pr-2" aria-hidden="true"></span>
                        <a href="tel:053-271800" class="topbar-one__info-text">Telephone : 053-271800</a>
                    </li>
                    <li class="topbar-one__info-item">
                        <span class="topbar-one__info-icon fa-solid fa-envelope pr-2"></span>
                        <a href="mailto:info@iwualai.com" class="topbar-one__info-text">Email : info@iwualai.com</a>
                    </li>
                </ul>
               
            </div>
            <div class="topbar-one__right">
                <div class="header-info-right">
                                <ul class="header-social">
                                    <li>
                                        <small>
											
                                            <div class="header__top__right__language">
											<?php if ($this->session->userdata('lang') == 'en'): ?>
												<div><img src="<?= base_url('assets_hotel/images/icons/en.png') ?>"> English</div>
												<i class="fa fa-angle-down" aria-hidden="true"></i>
												<ul>
													<li>
														<a href="<?= base_url('set_language/th'); ?>" class="font-nav5" style="display: inline;">
															<img src="<?= base_url('assets_hotel/images/icons/th.png') ?>" width="20%"> ไทย
														</a>
													</li>
												</ul>
											<?php else: ?>
												<div><img src="<?= base_url('assets_hotel/images/icons/th.png') ?>"> ไทย</div>
												<i class="fa fa-angle-down" aria-hidden="true"></i>
												<ul>
													<li>
														<a href="<?= base_url('set_language/en'); ?>" class="font-nav5" style="display: inline;">
															<img src="<?= base_url('assets_hotel/images/icons/en.png') ?>" width="20%"> English
														</a>
													</li>
												</ul>
											<?php endif; ?>
										</div>
                                        </small>
                                    </li>
                                </ul>
                            </div>
            </div>
        </div>
    </div>
</div>

<header id="navbar" class="navbar-light navbar-sticky header-static">
    <nav class="navbar  navbar-expand-lg navbar-dark  " aria-label="Offcanvas navbar large">
        <div class="container-fluid fluid ">
            <a class="navbar-brand" href="<?=base_url('index.php')?>">
                <img src="<?=base_url('assets_hotel/images/home/logo.png')?>">
            </a>
            <a class="navbar-brand1" href="<?=base_url('index.php')?>">
                <img src="<?=base_url('assets_hotel/images/home/logo1.png')?>">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="offcanvas offcanvas-end  main-header" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close " data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav align-items-lg-center justify-content-end flex-grow-1 ">
                        <li class="nav-item">
                            <a class="nav-link btn-secondary " href="<?=base_url('iWualai-Hotel')?>">Home</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link btn-secondary" 
							href="<?= base_url(str_replace(' ', '-', $hotel['title_en']) . '/room') ?>">Rooms</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn-secondary " 
							href="<?= base_url(str_replace(' ', '-', $hotel['title_en']) . '/facilities') ?>">FACILITIES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-secondary "  
							href="<?= base_url(str_replace(' ', '-', $hotel['title_en']) . '/gallery') ?>">GALLERY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-secondary " 
							href="<?= base_url(str_replace(' ', '-', $hotel['title_en']) . '/contact') ?>">CONTACT</a>
                        </li>
                        
                    </ul>
                    <div class="d-flex menu-right-content">
                        
                        
                        <div class="btn-box d-none d-lg-block text-center">
                            <a href="https://hotels.cloudbeds.com/reservation/DLSe72" style="background-color: <?= $hotel['color'] ?>;"> 
								Book now 
								</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
