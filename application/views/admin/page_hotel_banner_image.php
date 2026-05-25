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
</style>
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row">
					<div class="col-6">
						<h3>จัดการรูปภาพ Banner — <?= htmlspecialchars($hotelData['title_th'] ?? ''); ?></h3>
					</div>
					<div class="col-6 text-end d-flex justify-content-end gap-2">
						<!-- ปุ่มแก้ไขลิงก์ Check-in ระดับ hotel -->
						<button type="button" class="btn btn-info text-white"
							data-bs-toggle="modal" data-bs-target="#modalEditUrl"
							data-hotel-id="<?= $hotelData['hotel_id'] ?? ''; ?>"
							data-url-checkin="<?= htmlspecialchars($url_check_in ?? ''); ?>">
							<i class="fas fa-link"></i> ลิงก์ Check-in
						</button>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddBanner">
							<i class="fas fa-plus"></i> เพิ่มรูปภาพ
						</button>
					</div>
				</div>
			</div>

			<div class="page-content">
				<form action="<?= admin_url('hotelbannnerimage/order/' . ($hotelData['hotel_id'] ?? '')); ?>" method="post">
					<input type="hidden" name="do_action" value="submit-order">

					<div class="card shadow-sm">
						<div class="card-body px-4">
							<div class="table-responsive">
								<table class="table table-bordered table-striped dataTable">
									<thead>
										<tr class="<?= $banner['status'] == 0 ? 'row-disabled' : ''; ?>">
											<th class="text-center" width="5%">ลำดับ</th>
											<th class="text-center">รูปภาพ Banner</th>
											<th class="text-center" width="20%">ลำดับ / สถานะ</th>
											<th class="text-center" width="15%">แก้ไข / ลบ</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($banners)): ?>
											<?php $num = 0;
											foreach ($banners as $banner): $num++; ?>
												<tr>
													<td class="text-center align-middle"><?= $num; ?></td>

													<td class="text-center align-middle">
														<?php if (!empty($banner['banner_image'])): ?>
															<a href="<?= base_url($banner['banner_image']); ?>" class="img-link">
																<img src="<?= base_url($banner['banner_image']); ?>" width="200" class="img-thumbnail rounded <?= $banner['status'] == 0 ? 'img-disabled' : ''; ?>">
															</a>
														<?php else: ?>
															<span class="text-muted">ไม่มีรูปภาพ</span>
														<?php endif; ?>
													</td>

													<td class="align-middle">
														<div class="d-flex justify-content-center input-group px-2">
															<input type="hidden" name="id[]" value="<?= $banner['id']; ?>">
															<input type="text" class="form-control form-control-sm input-order" name="order_data[]" value="<?= $banner['sort_order']; ?>" inputmode="numeric">
															<?php if ($banner['status'] == 1): ?>
																<a href="<?= admin_url('hotelbannnerimage/status/' . $banner['id'] . '/0'); ?>" class="form-control btn btn-info btn-sm pt-2" title="Show"><i class="fa fa-desktop"></i></a>
															<?php else: ?>
																<a href="<?= admin_url('hotelbannnerimage/status/' . $banner['id'] . '/1'); ?>" class="form-control btn btn-danger btn-sm pt-2" title="Not Show"><i class="fa fa-eye-slash"></i></a>
															<?php endif; ?>
														</div>
													</td>

													<td class="align-middle">
														<div class="d-flex justify-content-center input-group input-group-edit px-2">
															<!-- ปุ่มแก้ไขรูปภาพ -->
															<button type="button" class="btn btn-warning btn-sm px-3"
																data-bs-toggle="modal" data-bs-target="#modalEditBanner"
																data-id="<?= $banner['id']; ?>"
																data-img="<?= base_url($banner['banner_image']); ?>"
																title="แก้ไขรูปภาพ">
																<i class="fas fa-edit"></i>
															</button>

															<!-- ปุ่มลบ -->
															<a type="button" class="btn btn-danger btn-sm px-3"
																data-bs-toggle="modal" data-bs-target="#modalDel"
																data-id="<?= $banner['id']; ?>"
																data-url="<?= admin_url('hotelbannnerimage/delete/' . $banner['id']); ?>">
																<i class="far fa-trash-alt"></i>
															</a>
														</div>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php else: ?>
											<tr>
												<td colspan="4" class="text-center text-muted py-4">ยังไม่มีรูปภาพ Banner</td>
											</tr>
										<?php endif; ?>
									</tbody>
									<tr>
										<td colspan="4" align="right">
											<div class="py-2">
												<button type="submit" class="btn btn-success btn-sm px-3 py-2">เรียงข้อมูล / Sort</button>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- Modal เพิ่มรูปภาพ -->
<div class="modal fade" id="modalAddBanner" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form action="<?= admin_url('hotelbannnerimage/create/' . ($hotelData['hotel_id'] ?? '')); ?>" method="post" enctype="multipart/form-data" novalidate>
				<div class="modal-header">
					<h5 class="modal-title"><i class="fas fa-plus-circle me-2 text-primary"></i> เพิ่มรูปภาพ Banner</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="fw-bold">รูปภาพ Banner
							<small class="text-muted fw-normal">(ขนาดแนะนำ 1920 × 920 px)</small>
						</label>
						<input type="file" name="banner_image" id="banner_image_add" class="image-crop-filepond mt-2" required>
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

<!-- Modal แก้ไขรูปภาพ -->
<div class="modal fade" id="modalEditBanner" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="formEditBanner" action="" method="post" enctype="multipart/form-data" novalidate>
				<div class="modal-header">
					<h5 class="modal-title"><i class="fas fa-edit me-2 text-warning"></i> แก้ไขรูปภาพ Banner</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="fw-bold">รูปภาพปัจจุบัน:</label><br>
						<img id="editBannerPreview" src="" width="200" class="mt-2 rounded border img-link">
					</div>
					<div class="form-group">
						<label class="fw-bold">เปลี่ยนรูปภาพใหม่
							<small class="text-muted fw-normal">(ขนาดแนะนำ 1920 × 920 px)</small>
						</label>
						<input type="file" name="banner_image" id="banner_image_edit" class="image-crop-filepond mt-2" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-warning px-4"><i class="fas fa-save me-1"></i> อัปเดต</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal แก้ไขลิงก์ Check-in (ระดับ hotel) -->
<div class="modal fade" id="modalEditUrl" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="formEditUrl" action="" method="post" novalidate>
				<div class="modal-header">
					<h5 class="modal-title"><i class="fas fa-link me-2 text-info"></i> ลิงก์ Check-in</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="fw-bold">URL ลิงก์ Check-in</label>
						<input type="text" name="url_check_in" id="inputUrlCheckin" class="form-control mt-2"
							placeholder="https://..." required>
						<small class="text-muted">ถ้าต้องการลบลิงก์ให้เว้นว่างไว้แล้วกดบันทึก</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-info px-4 text-white"><i class="fas fa-save me-1"></i> บันทึกลิงก์</button>
				</div>
			</form>
		</div>
	</div>
</div>
