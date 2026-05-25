<div id="carouselExampleFade" class="carousel slide " data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
		
        <?php foreach ($banner_img as $index => $banner) : ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="super_container1 " style="background-image:url(<?= base_url($banner['banner_image'])?>); width: 100%">
                <div class="room-section1">
                    <div class="container-fluid fluid">
                        <div class="row align-items-center">
                            
                            <div class="col-lg-3 mx-auto text-center ">
                                <h1 class="text-white" >Book <span class="typewriter"></span></h1>
                               <script src="https://hotels.cloudbeds.com/widget/load/DLSe72/horiz?newWindow=1"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php endforeach; ?>
        <!-- <div class="carousel-item">
            <div class="super_container1" style="background-image:url(<?= base_url("assets_hotel/images/home/carousel.png")?>); width: 100%">
                <div class="room-section1">
                    <div class="container-fluid fluid">
                        <div class="row align-items-center">
                           
                            <div class="col-lg-3 mx-auto text-center ">
                                <h1 class="text-white">Book <span class="typewriter"></span></h1>
                               <script src="https://hotels.cloudbeds.com/widget/load/DLSe72/horiz?newWindow=1"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<style>
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
    background: <?= $hotel['color'] ?> !important;
    border: #f62b0a !important;
    padding: 13px;
    color: #fff !important;
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
