<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	$this->load->view('cls/cls_front_function');
	css_function();
	?>
</head>

<body>
	<?php $this->load->view('cls/cls_front_menu'); ?>
	<?php $this->load->view('cls/cls_front_slide'); ?>
	<section class="section_description"
		style="background-image:url(<?= base_url("uploads/big_image/" . $bigTitle['image']) ?>);">
		<div class="container">
			<div class="row">

				<div class="col-lg-8 mx-auto text-center">
					<div class="content-block1 ">
						<div class="title-box wow fadeIn animated" data-wow-delay="0.2s"
							style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;">
							<div class="sub-title">
								<? if ($this->session->userdata('lang') == 'en'): ?>
									<?= $bigTitle['title_en'] ?? 'Discover iHotels Collection'; ?>
								<? else: ?>
									<?= $bigTitle['title_th'] ?? 'ค้นหา iHotels Collection'; ?>
								<? endif; ?>

							</div>
							<h2 class="sec-title">
							<? if ($this->session->userdata('lang') == 'en'): ?>
									<?= $bigTitle['subtitle_en'] ?? 'Discover iHotels Collection'; ?>
								<? else: ?>
									<?= $bigTitle['subtitle_th'] ?? 'ค้นหา iHotels Collection'; ?>
								<? endif; ?>	
							</h2>
						</div>
						<div class="text wow fadeIn animated" data-wow-delay="0.3s"
							style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
							<? if ($this->session->userdata('lang') == 'en'): ?>
									<?= $bigTitle['description_en'] ?? 'Discover iHotels Collection'; ?>
								<? else: ?>
									<?= $bigTitle['description_th'] ?? 'ค้นหา iHotels Collection'; ?>
								<? endif; ?>
						</div>
				</div>
			</div>
		</div>
	</section>
	<?php foreach ($hotels as $i => $hotel): ?>

    <?php
    $title = $this->session->userdata('lang') == 'en'
        ? ($hotel['title_en'] ?? '')
        : ($hotel['title_th'] ?? '');

    $desc = $this->session->userdata('lang') == 'en'
        ? ($hotel['description_en'] ?? '')
        : ($hotel['description_th'] ?? '');

	$parts        = explode(' ', $title);
	$firstChar    = mb_substr($parts[0], 0, 1,);        
	$restOfFirst  = mb_substr($parts[0], 1, null,);     
	$firstColored = '<span style="color:#f62a0a;">' . $firstChar . '</span>' . $restOfFirst;
	$rest         = count($parts) > 1 ? ' ' . implode(' ', array_slice($parts, 1)) : '';
	$image        = base_url('uploads/hotel/' . $hotel['image']);

		$title = $hotel['title_en'] ?? '-';           // ถ้า null → '-'
	$title = str_replace(' ', '-', $title);        // แทนช่องว่างด้วย -
	$title = urlencode($title);                    // encode ให้ปลอดภัยใน URL

	// ผลลัพธ์: 'iWualai Hotel' → 'iwualai-hotel'
	$url = base_url('/' . $title);
    ?>
<?php if ($i % 2 == 0): ?>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-650a8f4 elementor-section-full_width elementor-section-content-middle resort-img-right elementor-section-height-default elementor-section-height-default"
    data-id="650a8f4" data-element_type="section" id="cthr-sec">
    <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-5056092">
            <div class="elementor-widget-wrap elementor-element-populated align-items-center">
                <div class="elementor-element elementor-element-1703d1b elementor-widget elementor-widget-text-editor" data-id="1703d1b" data-element_type="widget" data-widget_type="text-editor.default">
                    <div class="elementor-widget-container t-r">
                        <h3><?= $firstColored ?><br><?= $rest ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-ea58afb" data-id="ea58afb" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-4e5e441 elementor-widget elementor-widget-text-editor" data-id="4e5e441" data-element_type="widget" data-widget_type="text-editor.default">
                    <div class="elementor-widget-container">
                        <?= $desc ?>
                    </div>
                </div>
                <div class="elementor-element elementor-element-b60dc24 elementor-button-success elementor-widget elementor-widget-button" data-id="b60dc24" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-button-link elementor-size-sm" href="<?= $url ?>">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas fa-angle-right"></i></span>
                                    <span class="elementor-button-text">
										<? if ($this->session->userdata('lang') == 'en'): ?>
													<?= 'Read More' ?? ''; ?>
												<? else: ?>
													<?= 'อ่านเพิ่มเติม' ?? ''; ?>
												<? endif; ?>
									</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-5a19c4e" data-id="5a19c4e" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-eaeca8d elementor-widget elementor-widget-image" data-id="eaeca8d" data-element_type="widget" data-widget_type="image.default">
                    <div class="elementor-widget-container">
                        <img src="<?= $image ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php else: ?>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-02cd84f elementor-section-full_width elementor-section-content-middle resort-img-left elementor-section-height-default elementor-section-height-default"
    data-id="02cd84f" data-element_type="section" id="ptpr-sec">
    <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-6d2727d" data-id="6d2727d" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-c477f66 elementor-widget elementor-widget-image" data-id="c477f66" data-element_type="widget" data-widget_type="image.default">
                    <div class="elementor-widget-container">
                        <img src="<?= $image ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-d4e7c01" data-id="d4e7c01" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-30c2b9f elementor-widget elementor-widget-text-editor" data-id="30c2b9f" data-element_type="widget" data-widget_type="text-editor.default">
                    <div class="elementor-widget-container">
                        <?= $desc ?>
                    </div>
                </div>
                <div class="elementor-element elementor-element-25ae3a1 elementor-button-success elementor-align-right elementor-widget elementor-widget-button" data-id="25ae3a1" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-button-link elementor-size-sm" href="<?= $url ?>">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas fa-angle-right"></i></span>
                                    <span class="elementor-button-text">
										<? if ($this->session->userdata('lang') == 'en'): ?>
													<?= 'Read More' ?? ''; ?>
												<? else: ?>
													<?= 'อ่านเพิ่มเติม' ?? ''; ?>
												<? endif; ?>
									</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-a582093" data-id="a582093" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated align-items-center">
                <div class="elementor-element elementor-element-550fa87 elementor-widget elementor-widget-text-editor" data-id="550fa87" data-element_type="widget" data-widget_type="text-editor.default">
                    <div class="elementor-widget-container">
                        <h3><?= $firstColored ?><br><?= $rest ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endforeach; ?>
	<!-- <style>
		.resort-img-left:hover>.elementor-container>.elementor-column1:nth-child(1) {
			width: 0% !important;
			margin-right: 0;
		}
	</style>
	<section
		class="elementor-section elementor-inner-section elementor-element elementor-element-02cd84f elementor-section-full_width elementor-section-content-middle resort-img-left elementor-section-height-default elementor-section-height-default"
		data-id="02cd84f" data-element_type="section" id="ptpr-sec">
		<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-column1 elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-6d2727d"
				data-id="6d2727d" data-element_type="column">
				<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-element elementor-element-c477f66 elementor-widget elementor-widget-image"
						data-id="c477f66" data-element_type="widget" data-widget_type="image.default">
						<div class="elementor-widget-container">
							<img src="images/22xx.jpg">
						</div>
					</div>
				</div>
			</div>
			<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-d4e7c01"
				data-id="d4e7c01" data-element_type="column">
				<div class="elementor-widget-wrap elementor-element-populated">

					<div class="elementor-element elementor-element-30c2b9f -desktop elementor-hidden-mobile elementor-widget elementor-widget-text-editor"
						data-id="30c2b9f" data-element_type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container">
							<h1>Welcoming you soon</h1>
						</div>
					</div>
					<div class="elementor-element elementor-element-25ae3a1 elementor-button-success elementor-align-right elementor-widget elementor-widget-button"
						data-id="25ae3a1" data-element_type="widget" data-widget_type="button.default">
						<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-a582093"
				data-id="a582093" data-element_type="column">
				<div class="elementor-widget-wrap elementor-element-populated align-items-center">
					<div class="elementor-element elementor-element-550fa87 elementor-widget elementor-widget-text-editor"
						data-id="550fa87" data-element_type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container">
							<h3><span style="color: #f62a0a;">i</span>Green Hotel <br>@Thaphae</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->


	<?php $this->load->view('cls/cls_front_footer'); ?>
	<?php script_function(); ?>
	<script src="<?= base_url('assets_front/assets/dist/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>
