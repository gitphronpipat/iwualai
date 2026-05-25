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
						<h3>จัดการ Facilities — <?= htmlspecialchars($hotelData['title_th'] ?? ''); ?></h3>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="card shadow-sm mb-3">
					<div class="card-body px-4">

						<form class="form-validator" action="<?= admin_url('hotelhomefacilities/create/' . ($hotelData['hotel_id'] ?? '')); ?>"
							method="post" enctype="multipart/form-data" autocomplete="off" novalidate>

							<!-- ============================================================
							     Section 1 : Our Gallery
							     ============================================================ -->
							<div class="section-box">
								<div class="section-box-title">
									<span class="box-number">1</span> Our Gallery — แกลลอรี่
								</div>

								<div class="row bg-light p-4 rounded border mb-3">
									<h5 class="mb-3 text-primary col-12">
										<i class="fas fa-images me-2"></i>รูปภาพ Background Gallery
									</h5>

									<div class="form-group col-12 mb-3">
										<label class="fw-bold">
											รูปภาพ Background Gallery
											<small class="text-muted fw-normal">(ขนาดแนะนำ 1920 × 750 px)</small>
										</label>
										<?php if (!empty($facilitiesData['gallery_bg_img'])) : ?>
											<div class="mb-2">
												<a href="<?= base_url('uploads/hotel_home/' . $facilitiesData['gallery_bg_img']); ?>" class="img-link">
													<img src="<?= base_url('uploads/hotel_home/' . $facilitiesData['gallery_bg_img']); ?>"
														width="200" class="img-thumbnail rounded">
												</a>
											</div>
										<?php else: ?>
											<span class="text-muted">ไม่มีรูปภาพ</span>
										<?php endif; ?>
										<input type="file" name="gallery_bg_img" id="gallery_bg_img"
											class="image-crop-filepond mt-2">
									</div>
									<div class="col-lg-6 mb-3">
										<label class="fw-bold">หัวข้อ (ภาษาไทย)</label>
										<input type="text" name="gallery_title_th" class="form-control"
											placeholder="หัวข้อสิ่งอำนวยความสะดวก" required
											value="<?= htmlspecialchars($facilitiesData['gallery_title_th'] ?? ''); ?>">
									</div>

									<div class="col-lg-6 mb-3">
										<label class="fw-bold">Title (English)</label>
										<input type="text" name="gallery_title_en" class="form-control"
											placeholder="Facilities Title" required
											value="<?= htmlspecialchars($facilitiesData['gallery_title_en'] ?? ''); ?>">
									</div>
									<div class="col-lg-6 mb-3">
										<label class="fw-bold">หัวข้อรอง (ภาษาไทย)</label>
										<input type="text" name="gallery_sub_title_th" class="form-control"
											placeholder="Facilities Subtitle" required
											value="<?= htmlspecialchars($facilitiesData['gallery_sub_title_th'] ?? ''); ?>">
									</div>

									<div class="col-lg-6 mb-3">
										<label class="fw-bold">Subtitle (English)</label>
										<input type="text" name="gallery_sub_title_en" class="form-control"
											placeholder="Facilities Subtitle" required
											value="<?= htmlspecialchars($facilitiesData['gallery_sub_title_en'] ?? ''); ?>">
									</div>

									<div class="col-lg-6">
										<div class="form-group mb-3">
											<label class="fw-bold text-primary">คำอธิบาย / Description (ภาษาไทย)</label>
											<textarea name="gallery_desc_th" class="tiny-editor form-control" rows="5"
												placeholder="คำอธิบายสั้นๆ สำหรับ gallery หน้าหลัก" required><?= htmlspecialchars($facilitiesData['gallery_desc_th'] ?? ''); ?></textarea>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group mb-3">
											<label class="fw-bold text-primary">Description (English)</label>
											<textarea name="gallery_desc_en" class="tiny-editor form-control" rows="5"
												placeholder="Short description for the main gallery" required><?= htmlspecialchars($facilitiesData['gallery_desc_en'] ?? ''); ?></textarea>
										</div>
									</div>
								</div>
							</div>

							<!-- ============================================================
							     Section 2 : Our Facilities
							     ============================================================ -->
							<div class="section-box">
								<div class="section-box-title">
									<span class="box-number">2</span> Our Facilities — สิ่งอำนวยความสะดวก
								</div>

								<!-- รูปภาพ Background -->
								<div class="row bg-light p-4 rounded border mb-4">
									<h5 class="mb-3 text-primary col-12">
										<i class="fas fa-image me-2"></i>รูปภาพ Background Facilities
									</h5>
									<div class="form-group col-12 mb-0">
										<label class="fw-bold">
											รูปภาพ Background
											<small class="text-muted fw-normal">(ขนาดแนะนำ 1080 × 700 px)</small>
										</label>
										<?php if (!empty($facilitiesData['facilities_bg_img'])) : ?>
											<div class="mb-2">
												<a href="<?= base_url('uploads/hotel_home/' . $facilitiesData['facilities_bg_img']); ?>" class="img-link">
													<img src="<?= base_url('uploads/hotel_home/' . $facilitiesData['facilities_bg_img']); ?>"
														width="200" class="img-thumbnail rounded">
												</a>
											</div>
										<?php else: ?>
											<span class="text-muted">ไม่มีรูปภาพ</span>
										<?php endif; ?>
										<input type="file" name="facilities_bg_img" id="facilities_bg_img"
											class="image-crop-filepond mt-2">
									</div>

									<!-- ข้อความ Facilities -->
									<h5 class="mb-3 text-primary col-12">
										<i class="fas fa-font me-2"></i>ข้อความ / Text Content
									</h5>

									<!-- ภาษาไทย -->
									<div class="col-lg-6 mb-3">
										<label class="fw-bold">หัวข้อ (ภาษาไทย)</label>
										<input type="text" name="facilities_title_th" class="form-control"
											placeholder="หัวข้อสิ่งอำนวยความสะดวก"
											value="<?= htmlspecialchars($facilitiesData['facilities_title_th'] ?? ''); ?>" required>
									</div>


									<div class="col-lg-6 mb-3">
										<label class="fw-bold">Title (English)</label>
										<input type="text" name="facilities_title_en" class="form-control"
											placeholder="Facilities Title"
											value="<?= htmlspecialchars($facilitiesData['facilities_title_en'] ?? ''); ?>" required>
									</div>
									<div class="col-lg-6 mb-3">
										<label class="fw-bold">หัวข้อรอง (ภาษาไทย)</label>
										<input type="text" name="facilities_subtitle_th" class="form-control"
											placeholder="หัวข้อรองสิ่งอำนวยความสะดวก" required
										value="<?= htmlspecialchars($facilitiesData['facilities_subtitle_th'] ?? ''); ?>">
									</div>
									<div class="col-lg-6 mb-3">
										<label class="fw-bold">Subtitle (English)</label>
										<input type="text" name="facilities_subtitle_en" class="form-control"
											placeholder="Facilities Subtitle"
											value="<?= htmlspecialchars($facilitiesData['facilities_subtitle_en'] ?? ''); ?>" required>
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
