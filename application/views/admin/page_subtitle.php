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
						<h3>เนื้อหาส่วนท้าย</h3>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="card shadow-sm mb-3">
					<div class="card-body px-4">

						<form action="<?= admin_url('title/save'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>

							<!-- รูปภาพ -->
							<div class="form-group mb-3">
								<label class="fw-bold mt-2">รูปภาพปัจจุบัน (คำอธิบาย):</label><br>
								<?php if (!empty($subTitle) && !empty($subTitle['image'])): ?>
									<a href="<?= base_url('uploads/title/' . $subTitle['image']); ?>" class="img-link" target="_blank">
										<img id="subImgPreview" src="<?= base_url('uploads/title/' . $subTitle['image']); ?>" width="200" class="mt-2 mb-3 rounded border">
									</a>
								<?php else: ?>
									<img id="subImgPreview" src="" width="200" class="mt-2 mb-3 rounded border" style="display:none;">
									<small id="subImgPlaceholder" class="text-muted d-block mb-2">ยังไม่มีรูปภาพ</small>
								<?php endif; ?>
							</div>

							<div class="border p-4 rounded bg-light mb-4">
								<label class="fw-bold mb-2">รูปภาพประกอบคำอธิบาย <span class="text-muted fw-normal">(ขนาด 1080 × 720 px)</span></label>
								<input type="file" name="sub_image" id="sub_image" class="image-crop-filepond form-control">
							</div>

							<!-- Tabs TH / EN -->
							<ul class="nav nav-tabs mb-0" id="subInnerTabs">
								<li class="nav-item">
									<a class="nav-link active" data-bs-toggle="tab" href="#descTh">🇹🇭 คำอธิบาย (TH)</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-bs-toggle="tab" href="#descEn">🇬🇧 Description (EN)</a>
								</li>
							</ul>

							<div class="tab-content border p-4 rounded bg-white mb-4">
								<div class="tab-pane fade show active" id="descTh">
									<h5 class="text-primary mb-4"><i class="fas fa-align-left me-2"></i>คำอธิบาย (ภาษาไทย)</h5>
									<div class="form-group col-lg-12 mb-0">
										<label>คำอธิบาย (ภาษาไทย)</label>
										<textarea name="sub_desc_th" class="tiny-editor form-control" rows="6"
											placeholder="ระบุคำอธิบายภาษาไทย"><?= !empty($subTitle['sub_desc_th']) ? htmlspecialchars($subTitle['sub_desc_th']) : ''; ?></textarea>
									</div>
								</div>

								<div class="tab-pane fade" id="descEn">
									<h5 class="text-primary mb-4"><i class="fas fa-align-left me-2"></i>Description (English)</h5>
									<div class="form-group col-lg-12 mb-0">
										<label>Description (English)</label>
										<textarea name="sub_desc_en" class="tiny-editor form-control" rows="6"
											placeholder="Enter description in English"><?= !empty($subTitle['sub_desc_en']) ? htmlspecialchars($subTitle['sub_desc_en']) : ''; ?></textarea>
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
		const subImgInput = document.getElementById('sub_image');
		if (subImgInput) {
			subImgInput.addEventListener('change', function () {
				const file = this.files[0];
				if (!file) return;
				const reader = new FileReader();
				reader.onload = function (e) {
					const preview     = document.getElementById('subImgPreview');
					const placeholder = document.getElementById('subImgPlaceholder');
					if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }
					if (placeholder) placeholder.style.display = 'none';
				};
				reader.readAsDataURL(file);
			});
		}
	})();
</script>
