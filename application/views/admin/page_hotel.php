<style>
	.text-truncate-2 {
		display: -webkit-box !important;
		-webkit-line-clamp: 2 !important;
		-webkit-box-orient: vertical !important;
		overflow: hidden !important;
		text-overflow: ellipsis;
		white-space: normal !important;
		font-size: 0.85rem;
		line-height: 1.5;
		max-height: 3em;
		word-break: break-word;
	}

	.hotel-description strong {
		color: #495057;
	}

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
						<h3>จัดการข้อมูลโรงแรม</h3>
					</div>
					<div class="col-6 text-end">
						<a href="<?= admin_url('hotel/add'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มโรงแรม</a>
					</div>
				</div>
			</div>
			<div class="page-content">
				<form action="<?= admin_url('hotel'); ?>" method="post">

					<input type="hidden" name="order" value="submit-order">

					<div class="card shadow-sm">
						<div class="card-body px-4">
							<div class="table-responsive">
								<table class="table table-bordered table-striped dataTable">
									<thead>
										<tr>
											<th scope="col" class="text-center" width="5%">ลำดับ</th>
											<th scope="col" class="text-center" width="5%">สี</th>
											<th scope="col" class="text-center" width="15%">รูปภาพโรงแรม</th>
											<th scope="col" class="text-center" width="22%">ข้อมูลโรงแรม (TH)</th>
											<th scope="col" class="text-center" width="23%">ข้อมูลโรงแรม (EN)</th>
											<th scope="col" class="text-center" width="10%">รายชื่อ Admin</th>
											<th scope="col" class="text-center" width="20%">ลำดับ / สถานะ</th>
											<th scope="col" class="text-center" width="15%">แก้ไข / ลบ</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$auth = $this->session->userdata('_auth');
										$is_superadmin = isset($auth['admin_permission']) && $auth['admin_permission'] == 1;

										if (!empty($hotels)):
											$num = 0;
											foreach ($hotels as $hotel):
												$num++;
										?>
												<tr class="<?= $hotel['status'] == 0 ? 'row-disabled' : ''; ?>">
													<td class="text-center align-middle"><?= $num; ?></td>

													<!-- คอลัมน์สี -->
													<td class="text-center align-middle">
														<?php if (!empty($hotel['color'])): ?>
															<div style="
																background-color: <?= htmlspecialchars($hotel['color']); ?>;
																width: 36px;
																height: 36px;
																border-radius: 50%;
																border: 1px solid #dee2e6;
																margin: 0 auto;
															" title="<?= htmlspecialchars($hotel['color']); ?>"></div>
															<small class="text-muted"><?= htmlspecialchars($hotel['color']); ?></small>
														<?php else: ?>
															<span class="text-muted">-</span>
														<?php endif; ?>
													</td>

													<!-- คอลัมน์รูปภาพ -->
													<td class="text-center align-middle">
														<?php if (!empty($hotel['image'])): ?>
															<a href="<?= base_url($hotel['image']); ?>" class="img-link">
																<img src="<?= base_url($hotel['image']); ?>" width="150" alt="Banner Image" class="<?= $hotel['status'] == 0 ? 'img-disabled' : ''; ?>">
															</a>
														<?php else: ?>
															<span class="text-muted">ไม่มีรูปภาพ</span>
														<?php endif; ?>
													</td>

													<!-- ข้อมูลโรงแรม TH -->
													<td class="align-middle">
														<h6 class="mb-1 fw-bold text-primary"><?= !empty($hotel['title_th']) ? $hotel['title_th'] : '-'; ?></h6>
														<hr class="my-1">
														<div class="hotel-description mt-2">
															<small class="text-muted d-block text-truncate-2" title="<?= htmlspecialchars(strip_tags(!empty($hotel['description_th']) ? $hotel['description_th'] : '')); ?>">
																<strong>รายละเอียด:</strong> <?= !empty($hotel['description_th']) ? strip_tags($hotel['description_th']) : '-'; ?>
															</small>
														</div>
													</td>

													<!-- ข้อมูลโรงแรม EN -->
													<td class="align-middle">
														<h6 class="mb-1 fw-bold text-secondary"><?= !empty($hotel['title_en']) ? $hotel['title_en'] : '-'; ?></h6>
														<hr class="my-1">
														<div class="hotel-description mt-2">
															<small class="text-muted d-block text-truncate-2" title="<?= htmlspecialchars(strip_tags(!empty($hotel['description_en']) ? $hotel['description_en'] : '')); ?>">
																<strong>Description:</strong> <?= !empty($hotel['description_en']) ? strip_tags($hotel['description_en']) : '-'; ?>
															</small>
														</div>
													</td>

													<!-- รายชื่อ Admin -->
													<td class="align-middle">
														<?php if (!empty($hotel['admin_list'])): ?>
															<?php foreach ($hotel['admin_list'] as $i => $adm): ?>
																<div><?= ($i + 1) . '. ' . htmlspecialchars($adm['admin_name']); ?></div>
															<?php endforeach; ?>
														<?php else: ?>
															<span class="text-muted">-</span>
														<?php endif; ?>
													</td>

													<!-- ลำดับ / สถานะ -->
													<td class="align-middle">
														<div class="d-flex justify-content-center input-group px-2">
															<input type="hidden" name="id[]" value="<?= $hotel['hotel_id']; ?>">
															<input type="text" class="form-control form-control-sm input-order" name="order_data[]" value="<?= $hotel['sort_order']; ?>" inputmode="numeric">
															<?php if ($hotel['status'] == 1): ?>
																<a href="<?= admin_url('hotel/status/' . $hotel['hotel_id'] . '/0'); ?>" class="form-control btn btn-info btn-sm pt-2" title="Show"><i class="fa fa-desktop"></i></a>
															<?php else: ?>
																<a href="<?= admin_url('hotel/status/' . $hotel['hotel_id'] . '/1'); ?>" class="form-control btn btn-danger btn-sm pt-2" title="Not Show"><i class="fa fa-eye-slash"></i></a>
															<?php endif; ?>
														</div>
													</td>

													<!-- แก้ไข / ลบ -->
													<td class="align-middle">
														<div class="d-flex justify-content-center input-group input-group-edit px-2">
															<a href="<?= admin_url('hotel/edit/' . $hotel['hotel_id']); ?>" class="btn btn-warning btn-sm px-3" title="แก้ไข">
																<i class="fas fa-edit"></i>
															</a>
															<a type="button" class="btn btn-danger btn-sm px-3"
																data-bs-toggle="modal" data-bs-target="#modalDel"
																data-id="<?= $hotel['hotel_id']; ?>"
																data-url="<?= admin_url('hotel/del/' . $hotel['hotel_id']); ?>">
																<i class="far fa-trash-alt"></i>
															</a>
														</div>
													</td>
												</tr>
											<?php
											endforeach;
										else:
											?>
											<tr>
												<td colspan="8" class="text-center text-muted py-4">ยังไม่มีข้อมูลโรงแรม</td>
											</tr>
										<?php endif; ?>
									</tbody>
									<tfooter>
										<tr>
											<td colspan="8" align="right">
												<div class="py-2">
													<button class="btn btn-success btn-sm px-3 py-2" name="order"
														value="submit-order">เรียงข้อมูล / Sort</button>
												</div>
											</td>
										</tr>
									</tfooter>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
