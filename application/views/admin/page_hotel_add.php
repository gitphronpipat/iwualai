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
					<div class="col-6">
						<h3>ตั้งค่าข้อมูลโปรไฟล์โรงแรม</h3>
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
						<!-- <form action="<?= admin_url('hotel/edit/' . ($hotelData['hotel_id'] ?? '')); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate> -->
						<form action="<?= admin_url('hotel/create'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
							<div class="form-group mb-3">
								<div class="col-6 col-md-4 col-lg-3">
									<label class="mt-2 fw-bold">สีโรงแรม:</label>
									<div class="input-group">
										<input type="color" class="form-control form-control-color"
											name="hotel_color"
											value="<?= htmlspecialchars($hotelData['color'] ?? ''); ?>"
											oninput="document.getElementById('preview_hotel_color').value = this.value">
										<input type="text" class="form-control form-control-sm"
											id="preview_hotel_color"
											value="<?= htmlspecialchars($hotelData['color'] ?? ''); ?>"
											oninput="this.previousElementSibling.value = this.value">
									</div>
								</div>
							</div>
							<!-- รูปภาพ -->
							<div class="row bg-light p-4 rounded border mb-4">
								<div class="form-group col-12">
									<label for="hotel_img" class="fw-bold">รูปภาพโรงแรม</label>
									<small class="text-muted">(ขนาด 1920 * 920 px)</small>
									<input type="file" name="hotel_img" id="hotel_img" class="image-crop-filepond">
								</div>
							</div>
							<div class="tab-content border rounded p-4 bg-white mt-2">
								<!-- ✅ กำหนด Admin ที่ดูแลโรงแรมนี้ -->
								<div class="form-group mb-3">
									<label for="admin" class="fw-bold mb-2">
										<i class="fas fa-user-shield me-2 text-primary"></i>กำหนด Admin ที่ดูแลโรงแรมนี้
									</label>
									<select class="choices form-select multiple-remove" name="admin_ids[]" multiple="multiple">
										<?php if (!empty($all_admins)): ?>
											<?php foreach ($all_admins as $admin):
												$isSelected = (isset($permitted_admin_ids) && in_array($admin['admin_id'], $permitted_admin_ids)) ? 'selected' : '';
											?>
												<option value="<?= $admin['admin_id']; ?>" <?= $isSelected; ?>>
													<?= htmlspecialchars($admin['admin_name']); ?> (<?= htmlspecialchars($admin['admin_user']); ?>)
												</option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
									<?php if (empty($all_admins)): ?>
										<small class="text-muted"><i class="fas fa-info-circle me-1"></i>ยังไม่มี Admin ทั่วไปในระบบ</small>
									<?php endif; ?>
								</div>

							</div>
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

								<div class="tab-pane fade show active" id="step1">
									<h5 class="mb-4 text-primary"><i class="fas fa-building me-2"></i>รายละเอียดโรงแรม (ภาษาไทย)</h5>
									<div class="row">
										<div class="form-group col-lg-12 mb-3">
											<label>ชื่อโรงแรม (ภาษาไทย)<sup class="text-danger">*</sup></label>
											<input type="text" name="hotel_name_th" class="form-control" placeholder="ระบุชื่อโรงแรมภาษาไทย" required>
										</div>
										<div class="form-group col-lg-12 mb-3">
											<label>รายละเอียดโรงแรม (ภาษาไทย)</label>
											<textarea name="hotel_desc_th" class="form-control" rows="6" placeholder="รายละเอียดของโรงแรมภาษาไทย" required></textarea>
										</div>
									</div>
									<hr>
									<div class="d-flex justify-content-end mt-3">
										<button type="button" class="btn btn-primary px-4 me-2" onclick="goToStep(2)">ถัดไป <i class="fas fa-arrow-right ms-1"></i></button>
									</div>
								</div>

								<div class="tab-pane fade" id="step2">
									<h5 class="mb-4 text-primary"><i class="fas fa-building me-2"></i>Hotel Details (English)</h5>
									<div class="row">
										<div class="form-group col-lg-12 mb-3">
											<label>Hotel Name (English)<sup class="text-danger">*</sup></label>
											<input type="text" name="hotel_name_en" class="form-control" placeholder="Enter Hotel Name" required>
										</div>
										<div class="form-group col-lg-12 mb-3">
											<label>Hotel Description (English)</label>
											<textarea name="hotel_desc_en" class="form-control" rows="6" placeholder="Hotel description in English" required></textarea>
										</div>
									</div>
									<hr>

								</div>

							</div>
							<div class="d-flex justify-content-between mt-3">
								<button type="button" class="btn btn-outline-secondary px-4" onclick="goToStep(1)"><i class="fas fa-arrow-left me-1"></i> ย้อนกลับ</button>
								<button type="submit" class="btn btn-success px-4"><i class="fas fa-save me-1"></i> บันทึกข้อมูล</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	// JS ที่ควรมีอยู่แล้วในระบบ (theme-color-picker)
	document.querySelectorAll('.theme-color-picker').forEach(function(picker) {
		picker.addEventListener('input', function() {
			const targetId = this.getAttribute('data-target');
			document.getElementById(targetId).value = this.value;
		});
	});

	document.querySelectorAll('.theme-color-text').forEach(function(input) {
		input.addEventListener('input', function() {
			const picker = document.querySelector('[data-target="' + this.id + '"]');
			if (picker) picker.value = this.value;
		});
	});
</script>
