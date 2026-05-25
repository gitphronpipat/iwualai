<style>
	tr.row-disabled {
		background-color: #f0f0f0 !important;
		opacity: 0.7;
	}

	tr.row-disabled td {
		color: #999 !important;
	}

	img.img-disabled {
		filter: grayscale(100%);
		opacity: 0.5;
	}

	a.img-link {
		display: inline-block;
		transition: opacity 0.2s ease-in-out;
	}

	a.img-link:hover {
		opacity: 0.8;
	}

	a.img-link img {
		cursor: pointer;
	}

	/* จัดการ z-index ให้ fancybox อยู่หน้า Modal */
	.fancybox-container,
	.fancybox__container {
		z-index: 9999 !important;
	}

	#lightboxOverlay {
		z-index: 9998 !important;
	}

	#lightbox {
		z-index: 9999 !important;
	}

	.mfp-bg {
		z-index: 9998 !important;
	}

	.mfp-wrap {
		z-index: 9999 !important;
	}
</style>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>จัดการสิ่งอำนวยความสะดวก</h3>
					</div>
					<div class="col-6 text-end">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddFacility">
							<i class="fas fa-plus"></i> เพิ่มข้อมูล
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="page-content">
			<form action="<?= admin_url('facility'); ?>" method="post">
				<div class="card shadow-sm">
					<div class="card-body px-4">
						<div class="table-responsive">
							<table class="table table-bordered table-striped dataTable">
								<thead>
									<tr>
										<th scope="col" class="text-center" width="5%">ลำดับ</th>
										<?php
										$auth          = $this->session->userdata('_auth');
										$my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
										if ($my_permission === 1): ?>
											<th scope="col" class="text-center" width="8%">โรงแรม</th>
										<?php endif; ?>
										<th scope="col" class="text-center" width="10%">รูปภาพ</th>
										<th scope="col" class="text-center" width="10%">ชื่อ Facility</th>
										<th scope="col" class="text-center" width="8%">ลำดับ / สถานะ</th>
										<th scope="col" class="text-center" width="8%">แก้ไข / ลบ</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($facilities)): foreach ($facilities as $i => $row):
											$isDisabled = $row['status'] == 0;
									?>
											<tr <?= $isDisabled ? 'class="row-disabled"' : ''; ?>>
												<td class="text-center align-middle"><?= $i + 1; ?></td>

												<?php if ($my_permission === 1): ?>
													<td class="text-center align-middle">
														<?php
														$hotel_name = '-';
														foreach ($hotels as $h) {
															if ($h['hotel_id'] == $row['hotel_id']) {
																$hotel_name = htmlspecialchars($h['title_th']);
																break;
															}
														}
														echo $hotel_name;
														?>
													</td>
												<?php endif; ?>

												<td class="text-center align-middle">
													<?php if (!empty($row['image'])): ?>
														<a href="<?= base_url('uploads/facility/' . $row['image']); ?>" class="img-link" data-fancybox="gallery">
															<img src="<?= base_url('uploads/facility/' . $row['image']); ?>"
																width="80"
																class="img-thumbnail rounded <?= $isDisabled ? 'img-disabled' : ''; ?>">
														</a>
													<?php else: ?>
														<span class="text-muted">ไม่มีรูปภาพ</span>
													<?php endif; ?>
												</td>

												<td class="align-middle"><?= htmlspecialchars($row['facility_name']); ?></td>

												<td class="align-middle">
													<div class="d-flex justify-content-center input-group px-2">
														<input type="hidden" name="id[]" value="<?= $row['facility_id']; ?>">
														<input type="text"
															class="form-control form-control-sm input-order text-center ajax-update"
															name="order_data[]"
															value="<?= $row['sort_order']; ?>"
															inputmode="numeric"
															data-id="<?= $row['facility_id']; ?>"
															data-field="sort_order">

														<?php if ($row['status'] == 1): ?>
															<a href="<?= admin_url('facility/status/') . $row['facility_id'] ?>/0"
																class="form-control btn btn-info btn-sm pt-2" title="Show">
																<i class="fa fa-desktop"></i>
															</a>
														<?php else: ?>
															<a href="<?= admin_url('facility/status/') . $row['facility_id'] ?>/1"
																class="form-control btn btn-danger btn-sm pt-2" title="Not Show">
																<i class="fa fa-eye-slash"></i>
															</a>
														<?php endif; ?>
													</div>
												</td>

												<td class="align-middle">
													<div class="d-flex justify-content-center input-group input-group-edit px-2">
														<button type="button" class="btn btn-warning btn-sm px-3"
															data-bs-toggle="modal" data-bs-target="#modalEditFacility"
															data-id="<?= $row['facility_id']; ?>"
															data-name="<?= htmlspecialchars($row['facility_name'], ENT_QUOTES); ?>"
															data-hotel="<?= $row['hotel_id']; ?>"
															data-img="<?= !empty($row['image']) ? base_url('uploads/facility/' . $row['image']) : ''; ?>"
															title="แก้ไข">
															<i class="fas fa-edit"></i>
														</button>

														<a type="button" class="btn btn-danger btn-sm px-3"
															data-bs-toggle="modal" data-bs-target="#modalDel"
															data-id="<?= $row['facility_id']; ?>"
															data-url="<?= admin_url('facility/del/') . $row['facility_id']; ?>">
															<i class="far fa-trash-alt"></i>
														</a>
													</div>
												</td>
											</tr>
										<?php endforeach;
									else: ?>
										<tr>
											<td colspan="7" class="text-center text-muted py-4">ไม่พบข้อมูล</td>
										</tr>
									<?php endif; ?>
								</tbody>
								<tfooter>
									<tr>
										<td colspan="11" align="right">
											<div class="py-2">
												<button class="btn btn-success btn-sm px-3 py-2" name="order"
													value="submit-order">เรียงข้อมูล / Sort</button>
											</div>
										</td>
									</tr>
								</tfooter	>
							</table>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- Modal เพิ่ม -->
<div class="modal fade" id="modalAddFacility" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="formAddFacility" action="<?= admin_url('facility/create'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
				<div class="modal-header">
					<h5 class="modal-title"><i class="fas fa-plus-circle me-2 text-primary"></i> เพิ่มสิ่งอำนวยความสะดวก</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">

					<?php if ($my_permission === 1 && !empty($hotels)): ?>
						<div class="mb-3">
							<label class="fw-bold">เลือกโรงแรม <span class="text-danger">*</span></label>
							<select name="hotel_id" class="form-select mt-1">
								<option value="">-- เลือกโรงแรม --</option>
								<?php foreach ($hotels as $h): ?>
									<option value="<?= $h['hotel_id']; ?>"><?= htmlspecialchars($h['title_th']); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php else: ?>
						<input type="hidden" name="hotel_id" value="<?= $hotel_id; ?>">
					<?php endif; ?>

					<div class="mb-3">
						<label class="fw-bold">รูปภาพ Facility</label>
						<small class="text-muted d-block mb-1">(ขนาดแนะนำ 380 × 400 px)</small>
						<input type="file" name="image" class="image-crop-filepond">
					</div>

					<div class="mb-3">
						<label class="fw-bold">ชื่อ Facility <span class="text-danger">*</span></label>
						<input type="text" name="facility_name" id="addFacilityName" class="form-control mt-1"
							placeholder="เช่น Swimming Pool, Free Wi-Fi">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-success px-4"><i class="fas fa-save me-1"></i> บันทึก</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal แก้ไข -->
<div class="modal fade" id="modalEditFacility" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="formEditFacility" action="" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
				<div class="modal-header">
					<h5 class="modal-title"><i class="fas fa-edit me-2 text-warning"></i> แก้ไขสิ่งอำนวยความสะดวก</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">

					<?php if ($my_permission === 1 && !empty($hotels)): ?>
						<div class="mb-3">
							<label class="fw-bold">เลือกโรงแรม</label>
							<select name="hotel_id" id="editHotelSelect" class="form-select mt-1">
								<option value="">-- เลือกโรงแรม --</option>
								<?php foreach ($hotels as $h): ?>
									<option value="<?= $h['hotel_id']; ?>"><?= htmlspecialchars($h['title_th']); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>

					<div class="mb-3">
						<label class="fw-bold">รูปภาพปัจจุบัน</label>
						<div id="editFacilityImgWrap" class="mb-2" style="display:none;">
							<a id="editFacilityImgLink" href="#" class="img-link" data-fancybox="gallery">
								<img id="editFacilityImg" src=""
									style="width:80px; height:80px; object-fit:cover; cursor:zoom-in;"
									class="img-thumbnail rounded">
							</a>
						</div>
						<label class="fw-bold mt-1">เปลี่ยนรูปภาพใหม่</label>
						<small class="text-muted d-block mb-1">(ขนาดแนะนำ 380 × 400 px)</small>
						<input type="file" name="image" class="image-crop-filepond">
					</div>

					<div class="mb-3">
						<label class="fw-bold">ชื่อ Facility <span class="text-danger">*</span></label>
						<input type="text" name="facility_name" id="editFacilityName" class="form-control mt-1"
							placeholder="เช่น Swimming Pool, Free Wi-Fi">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-warning px-4"><i class="fas fa-save me-1"></i> บันทึก</button>
				</div>
			</form>
		</div>
	</div>
</div>
