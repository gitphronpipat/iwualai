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

	#roomStepTabs .nav-item::after {
		content: "|";
		color: #ccc;
		position: absolute;
		right: -9px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 16px;
		line-height: 1;
	}

	#roomStepTabs .nav-item:last-child::after {
		display: none;
	}
</style>


<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>เพิ่มห้องพัก</h3>
					</div>
					<div class="col-6 text-end">
						<a href="<?= admin_url('room'); ?>" class="btn btn-secondary">
							<i class="fas fa-arrow-left me-1"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="card shadow-sm mb-3">
					<div class="card-body px-4">
						<form action="<?= admin_url('room/create'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
							<input type="hidden" name="hotel_id" value="<?= $hotel_id ?? ''; ?>">
							<!-- Tab Navigation -->
							<div class="d-flex align-items-center mb-3">
								<ul class="nav nav-tabs" id="roomStepTabs">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#roomStep1">
											<i class="fas fa-images me-1"></i> รายละเอียดในส่วนของหน้าหลัก
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#roomStep2">
											<i class="fas fa-bed me-1"></i> รายละเอียด & แกลลอรี่ ในส่วนของ Detail
										</a>
									</li>
								</ul>
							</div>

							<div class="tab-content border rounded p-4 bg-white mt-2">

								<div class="text-end text-muted mb-3" style="font-size: 0.85rem;">
									หน้า <span id="roomCurrentStep">1</span> / <span id="roomTotalSteps">2</span>
								</div>

								<!-- ===== STEP 1 ===== -->
								<div class="tab-pane fade show active" id="roomStep1">

									<div class="row bg-light p-4 rounded border mb-4">
										<h5 class="mb-3 text-primary col-12">
											<i class="fas fa-images me-2"></i>จัดการรูปภาพและข้อมูลหลัก
										</h5>

										<div class="form-group col-md-6 mb-3">
											<label for="banner_image" class="fw-bold">รูปภาพประเภทห้อง</label>
											<small class="text-muted d-block">(ขนาดแนะนำ 1920 * 600 px)</small>
											<input type="file" name="banner_image" id="banner_image" class="image-crop-filepond mt-2">
										</div>

										<div class="form-group col-md-6 mb-3">
											<label for="amenity_bg_image" class="fw-bold">รูปภาพใต้แบนเนอร์</label>
											<small class="text-muted d-block">(ขนาดแนะนำ 1000 * 800 px)</small>
											<input type="file" name="amenity_bg_image" id="amenity_bg_image" class="image-crop-filepond mt-2">
										</div>

										<div class="form-group col-md-6 mb-3">
											<label for="image" class="fw-bold">รูปภาพภายในห้อง</label>
											<small class="text-muted d-block">(ขนาดแนะนำ 1000 * 800 px)</small>
											<input type="file" name="image" id="image" class="image-crop-filepond mt-2">
										</div>

										<h5 class="mb-4 text-primary col-12"><i class="fas fa-bed me-2"></i>รายละเอียดห้องพัก (TH / EN)</h5>

										<div class="form-group col-lg-6 mb-3">
											<label>ชื่อประเภทห้อง (ชื่อประเภทห้องภาษาไทย)<sup class="text-danger">*</sup></label>
											<input type="text" name="title_th" class="form-control" placeholder="เช่น ห้องซูพีเรีย, ห้องดีลักซ์">
										</div>
										<div class="form-group col-lg-6 mb-3">
											<label>Room Name (ชื่อห้องพักภาษาอังกฤษ)<sup class="text-danger">*</sup></label>
											<input type="text" name="title_en" class="form-control" placeholder="e.g. Superior Room, Deluxe Room">
										</div>

										<div class="form-group col-lg-6 mb-3">
											<label>หัวข้อรอง (หัวข้อรองภาษาไทย)</label>
											<input type="text" name="subtitle_th" class="form-control" placeholder="เช่น วิวสวนหย่อม, รวมอาหารเช้า">
										</div>
										<div class="form-group col-lg-6 mb-3">
											<label>Subtitle (หัวข้อรองภาษาอังกฤษ)</label>
											<input type="text" name="subtitle_en" class="form-control" placeholder="e.g. Scenic View, Breakfast Included">
										</div>
									</div>

									<hr>
									<div class="d-flex justify-content-end mt-3">
										<button type="button" class="btn btn-primary px-4" onclick="goToRoomStep(2)">
											ถัดไป <i class="fas fa-arrow-right ms-1"></i>
										</button>
									</div>

								</div>

								<!-- ===== STEP 2 ===== -->
								<div class="tab-pane fade" id="roomStep2">

									<div class="row bg-light p-4 rounded border mb-4">
										<h5 class="mb-4 text-primary col-12">
											<i class="fas fa-bed me-2"></i>รายละเอียดห้องพัก (TH / EN)
										</h5>

										<div class="form-group col-lg-6 mb-3">
											<label>ชื่อห้องพัก (ชื่อห้องพักภาษาไทย)</label>
											<input type="text" name="name_th" class="form-control" placeholder="เช่น วิวสวนหย่อม, รวมอาหารเช้า">
										</div>
										<div class="form-group col-lg-6 mb-3">
											<label>Room Name (ชื่อห้องพักภาษาอังกฤษ)</label>
											<input type="text" name="name_en" class="form-control" placeholder="e.g. Scenic View, Breakfast Included">
										</div>

										<div class="col-md-12">
											<div class="form-group mb-3">
												<label>สิ่งอำนวยความสะดวก</label>
												<div class="mb-3">
													<button type="button" id="add-amenity" class="btn btn-sm btn-primary">
														<i class="fa fa-plus"></i> เพิ่มสิ่งอำนวยความสะดวก
													</button>
												</div>
												<div id="amenity-container">
													<div class="reason-row mb-3">
														<div class="row">
															<input type="hidden" name="amenity_id[]" value="">
															<div class="col-11">
																<input type="text" name="amenity_name[]" class="form-control" placeholder="สิ่งอำนวยความสะดวก">
															</div>
															<div class="col-1">
																<button type="button" class="btn btn-danger btn-md remove-reason">
																	<i class="fa fa-minus"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row bg-light p-4 rounded border mb-4">
										<h5 class="mb-4 text-primary">
											<i class="fas fa-images me-2"></i>จัดการแกลลอรี่ (Gallery)
										</h5>
										<div class="form-group">
											<label>รูปภาพแกลเลอรี่เพิ่มเติม</label>
											<small class="text-muted">(สามารถเพิ่มรูปครั้งละหลายๆ รูปได้ ขนาด 800 x 533 px)</small>
											<input type="file" name="gallery_pic[]" class="multiple-files-filepond mt-3">
										</div>
									</div>

									<hr>
									<div class="d-flex justify-content-between mt-3">
										<button type="button" class="btn btn-outline-secondary px-4" onclick="goToRoomStep(1)">
											<i class="fas fa-arrow-left me-1"></i> ย้อนกลับ
										</button>
										<button type="submit" class="btn btn-success px-5">
											<i class="fas fa-save me-2"></i> บันทึกข้อมูล
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
