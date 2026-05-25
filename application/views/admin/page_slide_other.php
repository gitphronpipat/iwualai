<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>สไลด์อื่น ๆ</h3>
					</div>
				</div>
			</div>

			<div class="page-content">

				<!-- Super Admin: เลือกโรงแรม -->
				<?php if ($my_permission === 1 && !empty($hotels)): ?>
					<div class="card mb-4">
						<div class="card-body px-4">
							<label class="fw-bold mb-2">
								<i class="fas fa-hotel me-2 text-primary"></i>เลือกโรงแรม
							</label>
							<select class="form-select" onchange="location.href='<?= admin_url('slideother/index/') ?>'+this.value">
								<?php foreach ($hotels as $h): ?>
									<option value="<?= $h['hotel_id'] ?>" <?= ($hotel_id == $h['hotel_id']) ? 'selected' : '' ?>>
										<?= htmlspecialchars($h['title_th']) ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				<?php endif; ?>

				<!-- ← form action ใช้ URI แทน query string -->
				<form method="post" action="<?= admin_url('slideother/index/' . $hotel_id) ?>"
					enctype="multipart/form-data">

					<div class="card mb-4">
						<div class="card-body px-4">

							<!-- Banner ห้องพัก -->
							<!-- Banner ห้องพัก -->
							<div class="form-group mb-4">
								<label class="fw-bold">รูปภาพหน้า banner ห้องพัก</label>
								<small class="text-muted d-block mb-2">แนะนำขนาด 1920x600 พิกเซล</small>
								<?php if (!empty($SlideotherData['img_room'])): ?>
									<div class="mb-2">
										<a href="<?= base_url('uploads/slide_other/' . $SlideotherData['img_room']); ?>" class="img-link">
											<img src="<?= base_url('uploads/slide_other/' . $SlideotherData['img_room']); ?>"
												width="200" class="img-thumbnail rounded">
										</a>
									</div>
								<?php else: ?>
									<small class="text-danger d-block mb-2">ยังไม่มีรูปภาพ</small>
								<?php endif; ?>
								<input type="file" name="img_room" id="img_room" class="image-crop-filepond">
							</div>

							<!-- Banner สิ่งอำนวยความสะดวก -->
							<div class="form-group mb-4">
								<label class="fw-bold">รูปภาพหน้า banner สิ่งอำนวยความสะดวก</label>
								<small class="text-muted d-block mb-2">แนะนำขนาด 1920x600 พิกเซล</small>
								<?php if (!empty($SlideotherData['img_facilities'])): ?>
									<div class="mb-2">
										<a href="<?= base_url('uploads/slide_other/' . $SlideotherData['img_facilities']); ?>" class="img-link">
											<img src="<?= base_url('uploads/slide_other/' . $SlideotherData['img_facilities']); ?>"
												width="200" class="img-thumbnail rounded">
										</a>
									</div>
								<?php else: ?>
									<small class="text-danger d-block mb-2">ยังไม่มีรูปภาพ</small>
								<?php endif; ?>
								<input type="file" name="img_facilities" id="img_facilities" class="image-crop-filepond">
							</div>

							<!-- Banner แกลเลอรี่ -->
							<div class="form-group mb-4">
								<label class="fw-bold">รูปภาพหน้า banner แกลเลอรี่</label>
								<small class="text-muted d-block mb-2">แนะนำขนาด 1920x600 พิกเซล</small>
								<?php if (!empty($SlideotherData['img_gallery'])): ?>
									<div class="mb-2">
										<a href="<?= base_url('uploads/slide_other/' . $SlideotherData['img_gallery']); ?>" class="img-link">
											<img src="<?= base_url('uploads/slide_other/' . $SlideotherData['img_gallery']); ?>"
												width="200" class="img-thumbnail rounded">
										</a>
									</div>
								<?php else: ?>
									<small class="text-danger d-block mb-2">ยังไม่มีรูปภาพ</small>
								<?php endif; ?>
								<input type="file" name="img_gallery" id="img_gallery" class="image-crop-filepond">
							</div>

							<!-- Banner คอนแทค -->
							<div class="form-group mb-4">
								<label class="fw-bold">รูปภาพหน้า banner คอนแทค</label>
								<small class="text-muted d-block mb-2">แนะนำขนาด 1920x600 พิกเซล</small>
								<?php if (!empty($SlideotherData['img_contact'])): ?>
									<div class="mb-2">
										<a href="<?= base_url('uploads/slide_other/' . $SlideotherData['img_contact']); ?>" class="img-link">
											<img src="<?= base_url('uploads/slide_other/' . $SlideotherData['img_contact']); ?>"
												width="200" class="img-thumbnail rounded">
										</a>
									</div>
								<?php else: ?>
									<small class="text-danger d-block mb-2">ยังไม่มีรูปภาพ</small>
								<?php endif; ?>
								<input type="file" name="img_contact" id="img_contact" class="image-crop-filepond">
							</div>

						</div>
					</div>

					<div class="d-flex justify-content-end mb-4">
						<button class="btn btn-success px-5" type="submit">
							<i class="fas fa-save me-2"></i>บันทึก
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>
