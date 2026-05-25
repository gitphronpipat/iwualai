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

	#hotelInnerTabs .nav-item::after,
	#titleInnerTabs .nav-item::after {
		display: none;
	}
</style>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-12">
						<h3>เนื้อหาใต้แบนเนอร์</h3>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="card shadow-sm mb-3">
					<div class="card-body px-4">

						<form action="<?= admin_url('title/create'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>

							<!-- รูปภาพ -->
							<div class="form-group mb-3">
								<label class="fw-bold mb-2">รูปภาพปัจจุบัน (หัวข้อหลัก)</label><br>
								<?php if (!empty($bigTitle) && !empty($bigTitle['image'])): ?>
									<a href="<?= base_url('uploads/big_image/' . $bigTitle['image']); ?>" class="img-link" target="_blank">
										<img id="bigImgPreview" src="<?= base_url('uploads/big_image/' . $bigTitle['image']); ?>" width="200" class="mt-2 mb-3 rounded border">
									</a>
								<?php else: ?>
									<img id="bigImgPreview" src="" width="200" class="mt-2 mb-3 rounded border" style="display:none;">
									<small id="bigImgPlaceholder" class="text-muted d-block mb-2">ยังไม่มีรูปภาพ</small>
								<?php endif; ?>
							</div>

							<div class="border p-4 rounded bg-light mb-4">
								<label class="fw-bold mb-2">อัปโหลดรูปภาพใหม่ <span class="text-muted fw-normal">(ขนาด 1920 × 500 px)</span></label>
								<input type="file" name="big_image" id="big_image" class="image-crop-filepond form-control">
							</div>

							<!-- Tabs TH / EN -->
							<ul class="nav nav-tabs mb-0" id="titleInnerTabs">
								<li class="nav-item">
									<a class="nav-link active" data-bs-toggle="tab" href="#titleTh">🇹🇭 ข้อมูลหัวข้อ (TH)</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#titleEn">🇬🇧 Title Info (EN)</a>
								</li>
							</ul>

							<div class="tab-content border p-4 rounded bg-white mb-4">
								<div class="tab-pane fade show active" id="titleTh">
									<h5 class="text-primary mb-4"><i class="fas fa-edit me-2"></i>ข้อมูลหัวข้อ (ภาษาไทย)</h5>
									<div class="row">
										<div class="form-group col-lg-12 mb-3">
											<label>หัวข้อหลัก (ภาษาไทย)<sup class="text-danger">*</sup></label>
											<input type="text" name="title_th" class="form-control"
												value="<?= !empty($bigTitle['title_th']) ? htmlspecialchars($bigTitle['title_th']) : ''; ?>"
												placeholder="ระบุหัวข้อหลักภาษาไทย">
										</div>
										<div class="form-group col-lg-12 mb-3">
											<label>หัวข้อรอง (ภาษาไทย)</label>
											<input type="text" name="subtitle_th" class="form-control"
												value="<?= !empty($bigTitle['subtitle_th']) ? htmlspecialchars($bigTitle['subtitle_th']) : ''; ?>"
												placeholder="ระบุหัวข้อรองภาษาไทย">
										</div>
										<div class="form-group col-lg-12 mb-0">
											<label>รายละเอียด (ภาษาไทย)</label>
											<textarea name="big_desc_th" class="tiny-editor form-control" rows="5"
												placeholder="รายละเอียดภาษาไทย"><?= !empty($bigTitle['description_th']) ? htmlspecialchars($bigTitle['description_th']) : ''; ?></textarea>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="titleEn">
									<h5 class="text-primary mb-4"><i class="fas fa-edit me-2"></i>Title Information (English)</h5>
									<div class="row">
										<div class="form-group col-lg-12 mb-3">
											<label>Title (English)<sup class="text-danger">*</sup></label>
											<input type="text" name="title_en" class="form-control"
												value="<?= !empty($bigTitle['title_en']) ? htmlspecialchars($bigTitle['title_en']) : ''; ?>"
												placeholder="Enter Main Title">
										</div>
										<div class="form-group col-lg-12 mb-3">
											<label>SubTitle (English)</label>
											<input type="text" name="subtitle_en" class="form-control"
												value="<?= !empty($bigTitle['subtitle_en']) ? htmlspecialchars($bigTitle['subtitle_en']) : ''; ?>"
												placeholder="Enter SubTitle">
										</div>
										<div class="form-group col-lg-12 mb-0">
											<label>Description (English)</label>
											<textarea name="big_desc_en" class="tiny-editor form-control" rows="5"
												placeholder="Enter description in English"><?= !empty($bigTitle['description_en']) ? htmlspecialchars($bigTitle['description_en']) : ''; ?></textarea>
										</div>
									</div>
								</div>
							</div>

							<hr>
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

<script>
	(function () {
		const bigImgInput = document.getElementById('big_image');
		if (bigImgInput) {
			bigImgInput.addEventListener('change', function () {
				const file = this.files[0];
				if (!file) return;
				const reader = new FileReader();
				reader.onload = function (e) {
					const preview     = document.getElementById('bigImgPreview');
					const placeholder = document.getElementById('bigImgPlaceholder');
					if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }
					if (placeholder) placeholder.style.display = 'none';
				};
				reader.readAsDataURL(file);
			});
		}
	})();
</script>
