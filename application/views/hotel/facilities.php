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
        <section class="page-title" style="background-image: url(images/home/page-title-bg.png);">
            <div class="container">
                <div class="title-outer text-center">
                    <h1 class="title">facilities</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li>facilities</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section_gallery">
            <div class="container pt-110 pb-70">
                <div class="row">
                    <div class="col-lg-4 col-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="room-block">
                            <div class="inner-box">
                                <div class="image"><img src="images/home/11.jpg" alt="" width="100%"></div>
                                <div class="content">
                                    <h3><a href="#">sunbathing chair</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6 wow fadeIn" data-wow-delay="0.2s">
                        <div class="room-block">
                            <div class="inner-box">
                                <div class="image"><img src="images/home/22.jpg" alt="" width="100%"></div>
                                <div class="content">
                                    <h3><a href="#">key card access</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6 wow fadeIn" data-wow-delay="0.3s">
                        <div class="room-block">
                            <div class="inner-box">
                                <div class="image"><img src="images/home/33.jpg" alt="" width="100%"></div>
                                <div class="content">
                                    <h3><a href="#">water dispenser</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <?php include("include/footer.php"); ?>
        <?php script_function(); ?>
        <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>
</html>
