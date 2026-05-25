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

	#footerStepTabs .nav-item::after {
		content: "|";
		color: #ccc;
		position: absolute;
		right: -9px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 16px;
		line-height: 1;
	}

	#footerStepTabs .nav-item:last-child::after {
		display: none;
	}
</style>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<h3>ส่วนท้าย</h3>
			</div>
			<div class="page-content">
				<form id="formFooter" class="form-validator" method="post"
					action="<?= admin_url('footer/index/' . $hotel_id); ?>"
					enctype="multipart/form-data">

					<!-- Tab Navigation -->
					<div class="d-flex justify-content-between align-items-center mb-3">
						<ul class="nav nav-tabs" id="footerStepTabs">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#footerStep1">
									<i class="fas fa-image me-1"></i> โลโก้ & คำอธิบาย & Social Media
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#footerStep2">
									<i class="fas fa-address-card me-1"></i> ข้อมูลการติดต่อ & ที่อยู่
								</a>
							</li>
						</ul>
						<div class="ms-3 text-end text-muted">
							หน้า <span id="footerCurrentStep">1</span>/<span id="footerTotalSteps">2</span>
						</div>
					</div>

					<div class="tab-content border rounded p-4 bg-white mt-2">

						<!-- ===== STEP 1 ===== -->
						<div class="tab-pane fade show active" id="footerStep1">

							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-3 text-primary col-12">
									<i class="fas fa-image me-2"></i>โลโก้
								</h5>

								<div class="col-md-12 form-group mb-3">
									<label class="mt-2">รูปภาพปัจจุบัน:</label><br>
									<?php if (!empty($footerData['logo'])): ?>
										<a href="<?= base_url('uploads/footer/' . $footerData['logo']); ?>"
											class="img-link" target="_blank">
											<img src="<?= base_url('uploads/footer/' . $footerData['logo']); ?>"
												width="150" class="mt-2 mb-3">
										</a>
									<?php endif; ?>
									<br>
									<label>รูปโลโก้ <small class="text-muted">แนะนำขนาด 135x55 พิกเซล</small></label>
									<input type="file" id="footer_logo" name="logo"
										class="image-crop-filepond form-control" accept="image/*">
								</div>
							</div>

							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-3 text-primary col-12">
									<i class="fas fa-align-left me-2"></i>คำอธิบายใต้โลโก้
								</h5>

								<div class="col-md-6 form-group mb-3">
									<label>คำอธิบาย (ภาษาไทย)</label>
									<textarea class="tiny-editor form-control" name="description_th" rows="4"><?= $footerData['description_th'] ?? ''; ?></textarea>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label>คำอธิบาย (English)</label>
									<textarea class="tiny-editor form-control" name="description_en" rows="4"><?= $footerData['description_en'] ?? ''; ?></textarea>
								</div>
							</div>

							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-3 text-primary col-12">
									<i class="fas fa-share-alt me-2"></i>Social Media
								</h5>

								<div class="col-md-12 form-group mb-3">
									<label>Facebook URL</label>
									<input type="text" name="facebook_url" class="form-control"
										placeholder="https://facebook.com/..."
										value="<?= $footerData['facebook_url'] ?? ''; ?>">
								</div>
								<div class="col-md-12 form-group mb-3">
									<label>Instagram URL</label>
									<input type="text" name="instagram_url" class="form-control"
										placeholder="https://instagram.com/..."
										value="<?= $footerData['instagram_url'] ?? ''; ?>">
								</div>
								<div class="col-md-12 form-group mb-3">
									<label>Line URL</label>
									<input type="text" name="line_url" class="form-control"
										placeholder="https://line.me/R/ti/p/@..."
										value="<?= $footerData['line_url'] ?? ''; ?>">
								</div>
							</div>

							<hr>
							<div class="d-flex justify-content-end mt-3">
								<button type="button" class="btn btn-primary px-4" onclick="goToFooterStep(2)">
									ถัดไป <i class="fas fa-arrow-right ms-1"></i>
								</button>
							</div>

						</div>

						<!-- ===== STEP 2 ===== -->
						<div class="tab-pane fade" id="footerStep2">

							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-4 text-primary col-12">
									<i class="fas fa-phone me-2"></i>ข้อมูลการติดต่อ
								</h5>

								<!-- เบอร์โทรศัพท์ -->
								<div class="col-md-12">
									<div class="form-group mb-3">
										<label>เบอร์โทรศัพท์</label>
										<div class="mb-3">
											<button type="button" id="add-phone" class="btn btn-sm btn-primary">
												<i class="fa fa-plus"></i> เพิ่มเบอร์โทรศัพท์
											</button>
										</div>
										<div id="phone-container">
											<?php if (!empty($footerData['phone']) && is_array($footerData['phone'])): ?>
												<?php foreach ($footerData['phone'] as $phone): ?>
													<div class="reason-row mb-3">
														<div class="row">
															<div class="col-11">
																<input type="text" name="phone[]" class="form-control"
																	placeholder="เบอร์โทรศัพท์"
																	value="<?= htmlspecialchars($phone, ENT_QUOTES); ?>">
															</div>
															<div class="col-1">
																<button type="button" class="btn btn-danger btn-md remove-reason">
																	<i class="fa fa-minus"></i>
																</button>
															</div>
														</div>
													</div>
												<?php endforeach; ?>
											<?php else: ?>
												<div class="reason-row mb-3">
													<div class="row">
														<div class="col-11">
															<input type="text" name="phone[]" class="form-control" placeholder="เบอร์โทรศัพท์">
														</div>
														<div class="col-1">
															<button type="button" class="btn btn-danger btn-md remove-reason">
																<i class="fa fa-minus"></i>
															</button>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>

								<!-- อีเมล -->
								<div class="col-md-12">
									<div class="form-group mb-3">
										<label>อีเมล</label>
										<div class="mb-3">
											<button type="button" id="add-email" class="btn btn-sm btn-primary">
												<i class="fa fa-plus"></i> เพิ่มอีเมล
											</button>
										</div>
										<div id="email-container">
											<?php if (!empty($footerData['email']) && is_array($footerData['email'])): ?>
												<?php foreach ($footerData['email'] as $email): ?>
													<div class="reason-row mb-3">
														<div class="row">
															<div class="col-11">
																<input type="text" name="email[]" class="form-control"
																	placeholder="อีเมล"
																	value="<?= htmlspecialchars($email, ENT_QUOTES); ?>">
															</div>
															<div class="col-1">
																<button type="button" class="btn btn-danger btn-md remove-reason">
																	<i class="fa fa-minus"></i>
																</button>
															</div>
														</div>
													</div>
												<?php endforeach; ?>
											<?php else: ?>
												<div class="reason-row mb-3">
													<div class="row">
														<div class="col-11">
															<input type="text" name="email[]" class="form-control" placeholder="อีเมล">
														</div>
														<div class="col-1">
															<button type="button" class="btn btn-danger btn-md remove-reason">
																<i class="fa fa-minus"></i>
															</button>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>

							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-4 text-primary col-12">
									<i class="fas fa-map-marker-alt me-2"></i>ที่อยู่
								</h5>

								<div class="col-md-6 form-group mb-3">
									<label>ที่อยู่ (ภาษาไทย)</label>
									<textarea class="tiny-editor form-control" name="address_th" rows="4"><?= $footerData['address_th'] ?? ''; ?></textarea>
								</div>
								<div class="col-md-6 form-group mb-3">
									<label>ที่อยู่ (English)</label>
									<textarea class="tiny-editor form-control" name="address_en" rows="4"><?= $footerData['address_en'] ?? ''; ?></textarea>
								</div>
							</div>
							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-3 text-primary col-12">
									<i class="fas fa-map me-2"></i>แผนที่ (Google Map)
								</h5>

								<div class="col-md-12 form-group mb-3">
									<label class="form-label">ลิงก์ Google Maps Embed</label>
									<small class="text-muted d-block mb-2">
										วิธีการ: ไปที่ Google Maps → ค้นหาสถานที่ → คลิก Share → Embed a map → Copy HTML
									</small>

									<!-- Preview -->
									<div id="map-preview" class="border rounded mb-3"
										style="min-height: 300px; background-color: #f8f9fa; width: 100%; overflow: hidden;">
										<?php if (!empty($footerData['map_url'])): ?>
											<?= $footerData['map_url']; ?>
										<?php else: ?>
											<div id="map-placeholder"
												class="d-flex align-items-center justify-content-center h-100 text-muted"
												style="min-height: 300px;">
												<div class="text-center">
													<i class="fas fa-map-marked-alt fa-3x mb-2"></i>
													<p>กรุณาใส่ embed code เพื่อดูตัวอย่างแผนที่</p>
												</div>
											</div>
										<?php endif; ?>
									</div>

									<!-- Input -->
									<textarea id="map-embed-input" name="map_url" class="form-control" rows="4"
										placeholder='วาง <iframe> embed code จาก Google Maps ที่นี่'><?= $footerData['map_url'] ?? ''; ?></textarea>
								</div>
							</div>
							<hr>
							<div class="d-flex justify-content-between mt-3">
								<button type="button" class="btn btn-outline-secondary px-4" onclick="goToFooterStep(1)">
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
</section>
