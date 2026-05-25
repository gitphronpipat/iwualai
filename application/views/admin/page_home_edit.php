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

<script>
	const STORAGE_KEY = "currentHomeStepTabEdit";

	function goToStep(step) {
		let tabElement = document.querySelector('#stepTabs a[href="#step' + step + '"]');
		if (tabElement) new bootstrap.Tab(tabElement).show();
	}

	$(function () {
		let savedTab = sessionStorage.getItem(STORAGE_KEY);
		if (savedTab && $('#stepTabs a[href="' + savedTab + '"]').length) {
			new bootstrap.Tab($('#stepTabs a[href="' + savedTab + '"]')[0]).show();
			$('#currentStep').text(savedTab.replace('#step', ''));
		} else {
			let firstTab = $('#stepTabs a[href="#step1"]');
			if (firstTab.length) {
				new bootstrap.Tab(firstTab[0]).show();
				sessionStorage.setItem(STORAGE_KEY, "#step1");
				$('#currentStep').text('1');
			}
		}
		$('#stepTabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
			let targetHref = $(e.target).attr("href");
			sessionStorage.setItem(STORAGE_KEY, targetHref);
			$('#currentStep').text(targetHref.replace('#step', ''));
		});

		// Preview รูปภาพ Banner
		const bannerInput = document.getElementById('banner_img');
		if (bannerInput) {
			bannerInput.addEventListener('change', function () {
				const file = this.files[0];
				if (!file) return;
				const reader = new FileReader();
				reader.onload = function (e) {
					const preview = document.getElementById('bannerImgPreview');
					const placeholder = document.getElementById('bannerImgPlaceholder');
					if (preview) {
						preview.src = e.target.result;
						preview.style.display = 'block';
					}
					if (placeholder) placeholder.style.display = 'none';
				};
				reader.readAsDataURL(file);
			});
		}
	});
</script>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>แก้ไขหน้าหลัก — <?= htmlspecialchars($hotelData['title_th'] ?? ''); ?></h3>
					</div>
					<div class="col-6 text-end">
						<a href="<?= admin_url('hotel_home'); ?>" class="btn btn-secondary">
							<i class="fas fa-arrow-left me-1"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="card shadow-sm mb-3">
					<div class="card-body px-4">

						<form action="<?= admin_url('hotel_home/update/' . ($hotelData['hotel_id'] ?? '')); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>

							<!-- Tab TH / EN -->
							<div class="d-flex justify-content-between align-items-center mb-3">
								<ul class="nav nav-tabs" id="stepTabs">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#step1">
											🇹🇭 ข้อมูลภาษาไทย (TH)
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#step2">
											🇬🇧 English Information (EN)
										</a>
									</li>
								</ul>
								<div class="ms-3 text-end text-muted">
									หน้า <span id="currentStep">1</span>/<span id="totalSteps">2</span>
								</div>
							</div>

							<div class="tab-content border rounded p-4 bg-white mt-2">

								<!-- ===== STEP 1: ภาษาไทย ===== -->
								<div class="tab-pane fade show active" id="step1">
									<h5 class="mb-4 text-primary"><i class="fas fa-home me-2"></i>ข้อมูลหน้าหลัก (ภาษาไทย)</h5>

									<!-- BOX 1: Banner -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">1</span> Banner หน้าหลัก
										</div>

										<!-- รูปปัจจุบัน -->
										<div class="form-group mb-3">
											<label class="fw-bold">รูปภาพปัจจุบัน:</label><br>
											<?php if (!empty($homeData['banner_image'])): ?>
												<img id="bannerImgPreview" src="<?= base_url('uploads/hotel_home/' . $homeData['banner_image']); ?>" width="200" class="mt-2 mb-3 rounded border">
											<?php else: ?>
												<img id="bannerImgPreview" src="" width="200" class="mt-2 mb-3 rounded border" style="display:none;">
												<small id="bannerImgPlaceholder" class="text-muted d-block mb-2">ยังไม่มีรูปภาพ</small>
											<?php endif; ?>
										</div>

										<div class="row bg-light p-3 rounded border mb-3">
											<div class="form-group col-12">
												<label class="fw-bold">อัปโหลดรูปภาพ Banner ใหม่
													<small class="text-muted fw-normal">(ขนาดแนะนำ 2000 × 1000 px)</small>
												</label>
												<input type="file" name="banner_img" id="banner_img" class="image-crop-filepond">
											</div>
										</div>

										<div class="row">
											<div class="form-group col-lg-12 mb-3">
												<label>ชื่อ / Title (ภาษาไทย)<sup class="text-danger">*</sup></label>
												<input type="text" name="banner_title_th" class="form-control"
													value="<?= htmlspecialchars($homeData['banner_title_th'] ?? ''); ?>"
													placeholder="เช่น ยินดีต้อนรับสู่โรงแรม">
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (ภาษาไทย)</label>
												<textarea name="banner_desc_th" class="form-control" rows="3"
													placeholder="คำอธิบายสั้นๆ สำหรับ Banner หน้าหลัก"><?= htmlspecialchars($homeData['banner_desc_th'] ?? ''); ?></textarea>
											</div>
										</div>
									</div>

									<!-- BOX 2: About Us -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">2</span> About Us — เกี่ยวกับโรงแรม
										</div>
										<div class="row">
											<div class="form-group col-lg-6 mb-3">
												<label>Title (ภาษาไทย)<sup class="text-danger">*</sup></label>
												<input type="text" name="about_title_th" class="form-control"
													value="<?= htmlspecialchars($homeData['about_title_th'] ?? ''); ?>"
													placeholder="เช่น เกี่ยวกับเรา">
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (ภาษาไทย)</label>
												<input type="text" name="about_subtitle_th" class="form-control"
													value="<?= htmlspecialchars($homeData['about_subtitle_th'] ?? ''); ?>"
													placeholder="เช่น ประสบการณ์การพักผ่อนที่ไม่เหมือนใคร">
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (ภาษาไทย)</label>
												<textarea name="about_desc_th" class="form-control" rows="5"
													placeholder="รายละเอียดเกี่ยวกับโรงแรม ที่ตั้ง ความโดดเด่น ฯลฯ"><?= htmlspecialchars($homeData['about_desc_th'] ?? ''); ?></textarea>
											</div>
										</div>
									</div>

									<!-- BOX 3: Rooms -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">3</span> Our Rooms — ห้องพัก
										</div>
										<div class="row">
											<div class="form-group col-lg-12 mb-3">
												<label>คำอธิบายส่วน Rooms (ภาษาไทย)</label>
												<textarea name="rooms_desc_th" class="form-control" rows="4"
													placeholder="คำอธิบายภาพรวมของห้องพักที่นำเสนอในหน้าหลัก"><?= htmlspecialchars($homeData['rooms_desc_th'] ?? ''); ?></textarea>
											</div>
											<div class="form-group col-lg-6 mb-0">
												<label>จำนวน Gallery ที่แสดงใน Rooms<sup class="text-danger">*</sup></label>
												<select name="rooms_gallery_count" class="form-select">
													<?php foreach ([2, 3, 4, 6] as $count): ?>
														<option value="<?= $count; ?>" <?= (isset($homeData['rooms_gallery_count']) && $homeData['rooms_gallery_count'] == $count) ? 'selected' : ''; ?>>
															<?= $count; ?> รูป
														</option>
													<?php endforeach; ?>
												</select>
												<small class="text-muted"><i class="fas fa-info-circle me-1"></i>จำนวนรูปห้องพักที่แสดงบนสไลด์หน้าหลัก</small>
											</div>
										</div>
									</div>

									<!-- BOX 4: Facilities -->
									<div class="section-box mb-0">
										<div class="section-box-title">
											<span class="box-number">4</span> Our Facilities — สิ่งอำนวยความสะดวก
										</div>
										<div class="row">
											<div class="form-group col-lg-6 mb-3">
												<label>Title (ภาษาไทย)<sup class="text-danger">*</sup></label>
												<input type="text" name="facilities_title_th" class="form-control"
													value="<?= htmlspecialchars($homeData['facilities_title_th'] ?? ''); ?>"
													placeholder="เช่น สิ่งอำนวยความสะดวก">
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (ภาษาไทย)</label>
												<input type="text" name="facilities_subtitle_th" class="form-control"
													value="<?= htmlspecialchars($homeData['facilities_subtitle_th'] ?? ''); ?>"
													placeholder="เช่น ทำไมต้องเลือกเรา">
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>คำอธิบาย / Description (ภาษาไทย)</label>
												<textarea name="facilities_desc_th" class="form-control" rows="4"
													placeholder="รายละเอียดสิ่งอำนวยความสะดวกที่โรงแรมมีให้"><?= htmlspecialchars($homeData['facilities_desc_th'] ?? ''); ?></textarea>
											</div>
										</div>
									</div>

									<hr class="mt-4">
									<div class="d-flex justify-content-end mt-3">
										<button type="button" class="btn btn-primary px-4 me-2" onclick="goToStep(2)">
											ถัดไป <i class="fas fa-arrow-right ms-1"></i>
										</button>
										<button type="submit" class="btn btn-warning px-4">
											<i class="fas fa-save me-1"></i> อัปเดตข้อมูล
										</button>
									</div>
								</div>

								<!-- ===== STEP 2: English ===== -->
								<div class="tab-pane fade" id="step2">
									<h5 class="mb-4 text-primary"><i class="fas fa-home me-2"></i>Home Page Information (English)</h5>

									<!-- BOX 1: Banner EN -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">1</span> Banner
										</div>
										<div class="row">
											<div class="form-group col-lg-12 mb-3">
												<label>Title (English)<sup class="text-danger">*</sup></label>
												<input type="text" name="banner_title_en" class="form-control"
													value="<?= htmlspecialchars($homeData['banner_title_en'] ?? ''); ?>"
													placeholder="e.g. Welcome to our Hotel">
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>Description (English)</label>
												<textarea name="banner_desc_en" class="form-control" rows="3"
													placeholder="Short description for the main banner"><?= htmlspecialchars($homeData['banner_desc_en'] ?? ''); ?></textarea>
											</div>
										</div>
									</div>

									<!-- BOX 2: About Us EN -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">2</span> About Us
										</div>
										<div class="row">
											<div class="form-group col-lg-6 mb-3">
												<label>Title (English)<sup class="text-danger">*</sup></label>
												<input type="text" name="about_title_en" class="form-control"
													value="<?= htmlspecialchars($homeData['about_title_en'] ?? ''); ?>"
													placeholder="e.g. About Us">
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (English)</label>
												<input type="text" name="about_subtitle_en" class="form-control"
													value="<?= htmlspecialchars($homeData['about_subtitle_en'] ?? ''); ?>"
													placeholder="e.g. A Unique Stay Experience">
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>Description (English)</label>
												<textarea name="about_desc_en" class="form-control" rows="5"
													placeholder="Hotel description, location highlights, etc."><?= htmlspecialchars($homeData['about_desc_en'] ?? ''); ?></textarea>
											</div>
										</div>
									</div>

									<!-- BOX 3: Rooms EN -->
									<div class="section-box">
										<div class="section-box-title">
											<span class="box-number">3</span> Our Rooms
										</div>
										<div class="row">
											<div class="form-group col-lg-12 mb-0">
												<label>Description (English)</label>
												<textarea name="rooms_desc_en" class="form-control" rows="4"
													placeholder="Overview description of the rooms shown on the home page"><?= htmlspecialchars($homeData['rooms_desc_en'] ?? ''); ?></textarea>
											</div>
										</div>
										<small class="text-muted mt-2 d-block">
											<i class="fas fa-info-circle me-1"></i>Gallery count is shared with TH settings (Box 3 in Thai tab)
										</small>
									</div>

									<!-- BOX 4: Facilities EN -->
									<div class="section-box mb-0">
										<div class="section-box-title">
											<span class="box-number">4</span> Our Facilities
										</div>
										<div class="row">
											<div class="form-group col-lg-6 mb-3">
												<label>Title (English)<sup class="text-danger">*</sup></label>
												<input type="text" name="facilities_title_en" class="form-control"
													value="<?= htmlspecialchars($homeData['facilities_title_en'] ?? ''); ?>"
													placeholder="e.g. Our Facilities">
											</div>
											<div class="form-group col-lg-6 mb-3">
												<label>Subtitle (English)</label>
												<input type="text" name="facilities_subtitle_en" class="form-control"
													value="<?= htmlspecialchars($homeData['facilities_subtitle_en'] ?? ''); ?>"
													placeholder="e.g. Why Choose Us">
											</div>
											<div class="form-group col-lg-12 mb-0">
												<label>Description (English)</label>
												<textarea name="facilities_desc_en" class="form-control" rows="4"
													placeholder="Describe the facilities available at the hotel"><?= htmlspecialchars($homeData['facilities_desc_en'] ?? ''); ?></textarea>
											</div>
										</div>
									</div>

									<hr class="mt-4">
									<div class="d-flex justify-content-between mt-3">
										<button type="button" class="btn btn-outline-secondary px-4" onclick="goToStep(1)">
											<i class="fas fa-arrow-left me-1"></i> ย้อนกลับ
										</button>
										<button type="submit" class="btn btn-warning px-4">
											<i class="fas fa-save me-1"></i> อัปเดตข้อมูล
										</button>
									</div>
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
