<style>
	.nav-tabs .nav-item {
		border-radius: 8px;
	}

	.nav-tabs .nav-link.active {
		font-weight: bold;
	}

	.nav-tabs .nav-item.show .nav-link,
	.nav-tabs .nav-link.active {
		background-color: transparent !important;
	}

	.nav-tabs .nav-link {
		position: relative;
		border: none;
		background: transparent;
		color: #6c757d;
		font-weight: 500;
		padding: 0.75rem 1.5rem;
		transition: all 0.3s ease;
	}

	.nav-tabs .nav-link.active:after {
		left: 50%;
	}

	.nav-tabs .nav-link::after {
		content: "";
		position: absolute;
		bottom: 0;
		left: 50%;
		height: 2px;
		width: 0;
		background: #00337e;
		transition: all 0.3s ease;
		transform: translateX(-50%);
	}

	.nav-tabs .nav-link:hover {
		color: #00337e;
	}

	.nav-tabs .nav-link:hover::after {
		width: 85%;
	}

	.nav-tabs .nav-link.active {
		color: #00337e;
		font-weight: 600;
	}

	.nav-tabs .nav-link.active::after {
		width: 95%;
		background: #00337e;
	}

	.nav-link {
		padding: 12px 15px !important;
	}

	.nav-item {
		position: relative !important;
		margin: 0 5px !important;
	}

	#stepTabs .nav-item::after {
		content: "|";
		color: #ccc;
		position: absolute;
		right: -9px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 16px;
		line-height: 1;
	}

	#stepTabs .nav-item:last-child::after {
		display: none;
	}

	#homeLangTabs .nav-item::after {
		display: none;
	}

	.section-box {
		background: #fff;
		border: 1px solid #dee2e6;
		border-radius: 10px;
		padding: 1.5rem;
		margin-bottom: 1.5rem;
	}

	.section-box-title {
		font-size: 1rem;
		font-weight: 700;
		color: #00337e;
		margin-bottom: 1.25rem;
		padding-bottom: 0.6rem;
		border-bottom: 2px solid #e9ecef;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}

	.box-number {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 26px;
		height: 26px;
		background: #00337e;
		color: #fff;
		border-radius: 50%;
		font-size: 0.8rem;
		font-weight: 700;
		flex-shrink: 0;
	}
</style>
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>ตั้งค่าหน้าหลัก (Home)</h3>
					</div>
					<div class="col-6 text-end">
						<a href="<?= admin_url('hotel'); ?>" class="btn btn-secondary">
							<i class="fas fa-arrow-left me-1"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="card shadow-sm mb-3">
					<div class="card-body px-4">

						<form class="form-validator" action="<?= admin_url('hotel/home/save'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
							<div class="form-group col-12 mb-3">
								<label class="fw-bold">รูปภาพ Banner
									<small class="text-muted fw-normal">(ขนาดแนะนำ 2000 × 1000 px)</small>
								</label>
								<input type="file" name="banner_img" id="banner_img" class="image-crop-filepond">
							</div>
							<!-- Tab TH / EN -->
							<div class="tab-content border rounded p-4 bg-white mt-2">

								<!-- ===== STEP 1: ภาษาไทย ===== -->
								<div class="tab-pane fade show active" id="homeStep1">
									<h5 class="mb-4 text-primary"><i class="fas fa-home me-2"></i>ข้อมูลหน้าหลัก (ภาษาไทย)</h5>

									<!-- BOX 1: Banner -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">1</span> Banner หน้าหลัก
										</div>
										<div class="row">
											<div class="row bg-light p-4 rounded border mb-4">
												<h5 class="mb-3 text-primary col-12">
													<i class="fas fa-images me-2"></i>จัดการรูปภาพและข้อมูลหลัก
												</h5>

												<div class="form-group col-md-6 mb-3">
													<label for="banner_image" class="fw-bold">รูปภาพโรงแรม</label>
													<small class="text-muted d-block">(ขนาดแนะนํา 1920 * 600 px)</small>
													<input type="file" name="banner_image" id="banner_image" class="image-crop-filepond mt-2">
												</div>

												<div class="form-group col-md-6 mb-3">
													<label for="image" class="fw-bold">รูปภาพพื้นหลังรูปภาพโรงแรม</label>
													<small class="text-muted d-block">(ขนาดแนะนํา 1000 * 800 px)</small>
													<input type="file" name="image" id="image" class="image-crop-filepond mt-2">
												</div>
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (ภาษาไทย)</label>
												<textarea name="banner_desc_th" class="form-control" rows="3" placeholder="คำอธิบายสั้นๆ สำหรับ Banner หน้าหลัก"></textarea>
											</div>
										</div>
									</div>

									<!-- BOX 2: About Us -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">2</span> About Us — เกี่ยวกับโรงแรม
										</div>
										<div class="row">
											<div class="row bg-light p-4 rounded border mb-4">
												<h5 class="mb-3 text-primary col-12">
													<i class="fas fa-images me-2"></i>จัดการรูปภาพและข้อมูลหลัก
												</h5>

												<div class="form-group col-md-6 mb-3">
													<label for="banner_image" class="fw-bold">รูปภาพโรงแรม</label>
													<small class="text-muted d-block">(ขนาดแนะนํา 1920 * 600 px)</small>
													<input type="file" name="banner_image" id="banner_image" class="image-crop-filepond mt-2">
												</div>

												<div class="form-group col-md-6 mb-3">
													<label for="image" class="fw-bold">รูปภาพพื้นหลังรูปภาพโรงแรม</label>
													<small class="text-muted d-block">(ขนาดแนะนํา 1000 * 800 px)</small>
													<input type="file" name="image" id="image" class="image-crop-filepond mt-2">
												</div>
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Title (ภาษาไทย)<sup class="text-danger">*</sup></label>
												<input type="text" name="about_title_th" class="form-control" placeholder="เช่น เกี่ยวกับเรา" required>
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (ภาษาไทย)</label>
												<input type="text" name="about_subtitle_th" class="form-control" placeholder="เช่น ประสบการณ์การพักผ่อนที่ไม่เหมือนใคร" required>
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Title (English)<sup class="text-danger">*</sup></label>
												<input type="text" name="about_title_en" class="form-control" placeholder="e.g. About Us" required>
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (English)</label>
												<input type="text" name="about_subtitle_en" class="form-control" placeholder="e.g. An Unforgettable Experience" required>
											</div>

											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (ภาษาไทย)</label>
												<textarea name="about_desc_th" class="form-control" rows="5" placeholder="รายละเอียดเกี่ยวกับโรงแรม ที่ตั้ง ความโดดเด่น ฯลฯ" required></textarea>
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (English)</label>
												<textarea name="about_desc_en" class="form-control" rows="5" placeholder="Detailed information about the hotel, its location, and unique features" required></textarea>
											</div>

										</div>
									</div>

									<!-- BOX 3: Rooms -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">3</span> Our Rooms — ห้องพัก
										</div>
										<div class="row">
											<div class="form-group col-12 mb-3">
												<label class="fw-bold">รูปภาพ Background Gallery
													<small class="text-muted fw-normal">(ขนาดแนะนำ 2000 × 1000 px)</small>
												</label>
												<input type="file" name="banner_img" id="banner_img" class="image-crop-filepond">
											</div>
											<div class="form-group col-lg-12 mb-3">
												<label>คำอธิบายส่วน Rooms (ภาษาไทย)</label>
												<textarea name="rooms_desc_th" class="form-control" rows="4" placeholder="คำอธิบายภาพรวมของห้องพักที่นำเสนอในหน้าหลัก" required></textarea>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-lg-12 mb-3">
												<label>คำอธิบายส่วน Rooms (English)</label>
												<textarea name="rooms_desc_en" class="form-control" rows="4" placeholder="Overall description of the rooms presented on the main page" required></textarea>
											</div>
										</div>
									</div>

									<!-- BOX 4: Facilities -->
									<div class="section-box mb-0">
										<div class="section-box-title">
											<span class="box-number">4</span> Our Facilities — สิ่งอำนวยความสะดวก
										</div>
										<div class="row">
											<div class="form-group col-12 mb-3">
												<label class="fw-bold">รูปภาพ Background Facilities
													<small class="text-muted fw-normal">(ขนาดแนะนำ 2000 × 1000 px)</small>
												</label>
												<input type="file" name="banner_img" id="banner_img" class="image-crop-filepond">
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Title (ภาษาไทย)<sup class="text-danger">*</sup></label>
												<input type="text" name="facilities_title_th" class="form-control" placeholder="เช่น สิ่งอำนวยความสะดวก" required>
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (ภาษาไทย)</label>
												<input type="text" name="facilities_subtitle_th" class="form-control" placeholder="เช่น ทำไมต้องเลือกเรา" required>
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Title (English)<sup class="text-danger">*</sup></label>
												<input type="text" name="facilities_title_en" class="form-control" placeholder="e.g. Facilities" required>
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (English)</label>
												<input type="text" name="facilities_subtitle_en" class="form-control" placeholder="e.g. Why Choose Us" required>
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (ภาษาไทย)</label>
												<textarea name="facilities_desc_th" class="form-control" rows="4" placeholder="รายละเอียดสิ่งอำนวยความสะดวกที่โรงแรมมีให้" required></textarea>
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (English)</label>
												<textarea name="facilities_desc_en" class="form-control" rows="4" placeholder="Detailed information about the hotel's facilities" required></textarea>
											</div>
										</div>
									</div>

									<hr class="mt-4">
									<div class="d-flex justify-content-end mt-3">
										<button type="button" class="btn btn-primary px-4 me-2" onclick="goToHomeStep(2)">
											ถัดไป <i class="fas fa-arrow-right ms-1"></i>
										</button>
										<button type="submit" class="btn btn-success px-4">
											<i class="fas fa-save me-1"></i> บันทึกข้อมูล
										</button>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	sessionStorage.removeItem("currentHotelStepTab");
</script>
