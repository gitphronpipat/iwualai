<style>
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
						<h3>จัดการ Banner — <?= htmlspecialchars($hotelData['title_th'] ?? ''); ?></h3>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="card shadow-sm mb-3">
					<div class="card-body px-4">

						<form class="form-validator" action="<?= admin_url('hotelhomebanner/create/' . ($hotelData['hotel_id'] ?? '')); ?>" method="post" enctype="multipart/form-data">
							<!-- BOX 1: Banner -->
							<div class="section-box">
								<div class="section-box-title">
									<span class="box-number">1</span> Banner หน้าหลัก
								</div>

								<div class="row bg-light p-4 rounded border mb-4">
									<h5 class="mb-3 text-primary col-12">
										<i class="fas fa-images me-2"></i>จัดการรูปภาพ
									</h5>

									<!-- รูปปัจจุบัน: banner_image -->
									<div class="form-group col-md-6 mb-3">
										<label class="fw-bold">
											รูปภาพ Background About Us
											<small class="text-muted fw-normal">(ขนาดแนะนํา 1920 x 600 px)</small>
										</label>

										<?php if (!empty($bannerData['banner_backgroud_1'])) : ?>
											<div class="mb-2">
												<a href="<?= base_url('uploads/hotel_home/' . $bannerData['banner_backgroud_1']); ?>" class="img-link">
													<img src="<?= base_url('uploads/hotel_home/' . $bannerData['banner_backgroud_1']); ?>"
														width="200" class="img-thumbnail rounded">
												</a>
											</div>
										<?php else: ?>
											<span class="text-muted">ไม่มีรูปภาพ</span>
										<?php endif; ?>

										<input type="file" name="banner_backgroud_1" id="banner_backgroud_1" class="image-crop-filepond mt-2">
									</div>

									<!-- รูปพื้นหลัง -->
									<div class="form-group col-md-6 mb-3">
										<label class="fw-bold">
											รูปภาพโรงแรม (Hotel Image)
											<small class="text-muted fw-normal">(ขนาดแนะนํา 570 x 520 px)</small>
										</label>

										<?php if (!empty($bannerData['banner_hotel_image'])) : ?>
											<div class="mb-2">
												<a href="<?= base_url('uploads/hotel_home/' . $bannerData['banner_hotel_image']); ?>" class="img-link">
													<img src="<?= base_url('uploads/hotel_home/' . $bannerData['banner_hotel_image']); ?>"
														width="200" class="img-thumbnail rounded">
												</a>
											</div>
										<?php else: ?>
											<span class="text-muted">ไม่มีรูปภาพ</span>
										<?php endif; ?>

										<input type="file" name="banner_hotel_image" id="banner_hotel_image" class="image-crop-filepond mt-2">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-lg-6 mb-3">
										<label>Title (ภาษาไทย)<sup class="text-danger">*</sup></label>
										<input type="text" name="banner_title_th" class="form-control"
											value="<?= htmlspecialchars($bannerData['banner_title_th'] ?? ''); ?>"
											placeholder="เช่น เกี่ยวกับเรา" required>
									</div>
									<div class="form-group col-lg-6 mb-3">
										<label>Subtitle (ภาษาไทย)</label>
										<input type="text" name="banner_subtitle_th" class="form-control"
											value="<?= htmlspecialchars($bannerData['banner_subtitle_th'] ?? ''); ?>"
											placeholder="เช่น ประสบการณ์การพักผ่อนที่ไม่เหมือนใคร" required>
									</div>
									<div class="form-group col-lg-6 mb-3">
										<label>Title (English)<sup class="text-danger">*</sup></label>
										<input type="text" name="banner_title_en" class="form-control"
											value="<?= htmlspecialchars($bannerData['banner_title_en'] ?? ''); ?>"
											placeholder="e.g. banner Us" required>
									</div>
									<div class="form-group col-lg-6 mb-3">
										<label>Subtitle (English)</label>
										<input type="text" name="banner_subtitle_en" class="form-control"
											value="<?= htmlspecialchars($bannerData['banner_subtitle_en'] ?? ''); ?>"
											placeholder="e.g. An Unforgettable Experience" required>
									</div>
									<div class="col-lg-6">
										<div class="form-group mb-3">
											<label class="fw-bold text-primary">คำอธิบาย / Description (ภาษาไทย)</label>
											<textarea name="banner_desc_th" class="tiny-editor form-control" rows="5"
												placeholder="คำอธิบายสั้นๆ สำหรับ Banner หน้าหลัก" required><?= htmlspecialchars($bannerData['banner_desc_th'] ?? ''); ?></textarea>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group mb-3">
											<label class="fw-bold text-primary">Description (English)</label>
											<textarea name="banner_desc_en" class="tiny-editor form-control" rows="5"
												placeholder="Short description for the main banner" required><?= htmlspecialchars($bannerData['banner_desc_en'] ?? ''); ?></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="d-flex justify-content-end mt-3">
								<button type="submit" class="btn btn-success px-4">
									<i class="fas fa-save me-1"></i> บันทึกข้อมูล
								</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
