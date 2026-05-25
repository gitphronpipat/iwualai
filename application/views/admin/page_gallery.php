<style>
	.gallery-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
		gap: 12px;
		padding: 8px 0 16px;
	}

	.gallery-item {
		border: 1px solid #dee2e6;
		border-radius: 8px;
		overflow: hidden;
		background: #fff;
		transition: box-shadow 0.2s ease;
	}

	.gallery-item:hover {
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
	}

	/* รูปภาพ */
	.gallery-thumb-wrap {
		position: relative;
		width: 100%;
		aspect-ratio: 4 / 3;
		overflow: hidden;
		background: #f0f0f0;
	}

	.gallery-thumb {
		width: 100%;
		height: 100%;
		object-fit: cover;
		display: block;
		transition: transform 0.25s ease;
	}

	.gallery-item:hover .gallery-thumb {
		transform: scale(1.04);
	}

	/* Badge ลำดับ (มุมซ้ายบน) */
	.gallery-order-badge {
		position: absolute;
		top: 6px;
		left: 6px;
		background: rgba(0, 0, 0, 0.55);
		color: #fff;
		font-size: 11px;
		font-weight: 600;
		padding: 2px 7px;
		border-radius: 20px;
		line-height: 1.4;
	}

	/* Status badge (มุมขวาบน) */
	.gallery-status-badge {
		position: absolute;
		top: 6px;
		right: 6px;
		width: 26px;
		height: 26px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 11px;
		text-decoration: none;
		transition: opacity 0.2s;
	}

	.gallery-status-badge:hover {
		opacity: 0.8;
	}

	.status-on {
		background: #22c55e;
		color: #fff;
	}

	.status-off {
		background: #ef4444;
		color: #fff;
	}

	/* Footer: order input + ปุ่ม */
	.gallery-item-footer {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 6px 8px;
		background: #f8f9fa;
		border-top: 1px solid #dee2e6;
		gap: 6px;
	}

	.gallery-item.item-disabled {
		opacity: 0.5;
	}

	.gallery-item.item-disabled .gallery-thumb {
		filter: grayscale(100%);
	}
</style>
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>จัดการ Gallery — <?= htmlspecialchars($hotelData['title_th'] ?? ''); ?></h3>
					</div>
					<div class="col-6 text-end d-flex justify-content-end gap-2">
						<button type="button" class="btn btn-info text-white"
							data-bs-toggle="modal" data-bs-target="#modalCategory">
							<i class="fas fa-folder"></i> จัดการหมวดหมู่
						</button>
						<button type="button" class="btn btn-primary"
							data-bs-toggle="modal" data-bs-target="#modalAddImage"
							<?= empty($categories) ? 'disabled title="กรุณาเพิ่มหมวดหมู่ก่อน"' : ''; ?>>
							<i class="fas fa-plus"></i> เพิ่มรูปภาพ
						</button>
					</div>
				</div>
			</div>

			<div class="page-content">
				<?php
				$grouped = [];
				foreach ($images as $img) {
					$grouped[$img['category_id']][] = $img;
				}

				// ถ้ามี active_cat → กรองเฉพาะ category นั้น
				// ถ้าไม่มี (หน้า index) → แสดงทั้งหมด
				$displayCategories = !empty($active_cat)
					? array_filter($categories, fn($c) => $c['category_id'] == $active_cat)
					: $categories;
				?>

				<?php if (!empty($categories)): ?>
					<?php foreach ($displayCategories as $cat): ?>
						<div class="card shadow-sm mb-4 category-block"
							id="cat-<?= $cat['category_id']; ?>"
							data-category="<?= $cat['category_id']; ?>">

							<div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
								<h5 class="mb-0 fw-bold text-primary">
									<i class="fas fa-folder-open me-2"></i>
									<?= htmlspecialchars($cat['name_th'] ?? ''); ?>
									<?php if (!empty($cat['name_en'])): ?>
										<small class="text-muted fw-normal ms-1">(<?= htmlspecialchars($cat['name_en']); ?>)</small>
									<?php endif; ?>
								</h5>
								<span class="badge bg-secondary">
									<?= count($grouped[$cat['category_id']] ?? []); ?> รูป
								</span>
							</div>

							<div class="card-body px-4">
								<?php if (!empty($grouped[$cat['category_id']])): ?>
									<form action="<?= admin_url('gallery/order/' . ($hotelData['hotel_id'] ?? '')); ?>" method="post">
										<input type="hidden" name="do_action" value="submit-order">
										<input type="hidden" name="active_cat" value="<?= $cat['category_id']; ?>">
										<div class="gallery-grid" id="gallery-grid-<?= $cat['category_id']; ?>">
											<?php $num = 0;
											foreach ($grouped[$cat['category_id']] as $img):
												$num++; ?>
												<div class="gallery-item <?= $img['status'] == 0 ? 'item-disabled' : ''; ?>" data-id="<?= $img['gallery_id']; ?>">
													<input type="hidden" name="id[]" value="<?= $img['gallery_id']; ?>">
													<input type="hidden" name="order_data[]" class="input-order-hidden" value="<?= $img['sort_order']; ?>">
													<div class="gallery-thumb-wrap">
														<a href="<?= base_url($img['image']); ?>"
															class="img-link"
															data-fancybox="gallery-<?= $cat['category_id']; ?>">
															<img src="<?= base_url($img['image']); ?>"
																class="gallery-thumb"
																alt="Gallery image <?= $num; ?>">
														</a>
														<span class="gallery-order-badge"><?= str_pad($num, 2, '0', STR_PAD_LEFT); ?></span>
													</div>
													<div class="gallery-item-footer">
														<div class="input-group input-group-sm" style="width: auto;">
															<input type="hidden" name="id[]" value="<?= $img['gallery_id']; ?>">
															<input type="text" class="form-control form-control-sm input-order"
																name="order_data[]" value="<?= $img['sort_order']; ?>"
																inputmode="numeric" style="width: 50px;">
															<?php if ($img['status'] == 1): ?>
																<a href="<?= admin_url('gallery/status/' . $img['gallery_id'] . '/0'); ?>"
																	class="btn btn-info btn-sm pt-1" title="Show">
																	<i class="fa fa-desktop"></i>
																</a>
															<?php else: ?>
																<a href="<?= admin_url('gallery/status/' . $img['gallery_id'] . '/1'); ?>"
																	class="btn btn-danger btn-sm pt-1" title="Not Show">
																	<i class="fa fa-eye-slash"></i>
																</a>
															<?php endif; ?>
														</div>
														<div class="d-flex gap-1">
															<a class="btn btn-danger btn-sm"
																data-bs-toggle="modal"
																data-bs-target="#modalDel"
																data-id="<?= $img['gallery_id']; ?>"
																data-url="<?= admin_url('gallery/delete/' . $img['gallery_id']); ?>"
																title="ลบ">
																<i class="far fa-trash-alt"></i>
															</a>
														</div>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
										<div class="text-end mt-3 pb-2">
											<button type="submit" class="btn btn-success btn-sm px-3 py-2">
												เรียงข้อมูล / Sort
											</button>
										</div>
									</form>
								<?php else: ?>
									<p class="text-center text-muted py-4">
										<i class="fas fa-image fa-2x mb-2 d-block opacity-25"></i>
										ยังไม่มีรูปภาพในหมวดหมู่นี้
									</p>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>

				<?php else: ?>
					<div class="alert alert-warning">
						<i class="fas fa-exclamation-triangle me-2"></i>
						ยังไม่มีหมวดหมู่ กรุณากดปุ่ม <strong>"จัดการหมวดหมู่"</strong> เพื่อเพิ่มก่อน
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════════════════════════════
     Modal จัดการหมวดหมู่
══════════════════════════════════════════ -->
<div class="modal fade" id="modalCategory" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<form action="<?= admin_url('gallery/save_categories/' . ($hotelData['hotel_id'] ?? '')); ?>" method="post">
				<input type="hidden" name="active_cat" value="<?= $active_cat ?? ''; ?>">
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fas fa-folder me-2 text-info"></i> จัดการหมวดหมู่ Gallery
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div id="deleted-ids-container"></div>
					<div class="d-flex justify-content-between align-items-center mb-3">
						<span class="fw-bold text-muted">รายการหมวดหมู่</span>
						<button type="button" id="add-category-row" class="btn btn-sm btn-primary">
							<i class="fa fa-plus"></i> เพิ่มแถว
						</button>
					</div>
					<div id="category-container">
						<?php if (!empty($categories)): ?>
							<?php foreach ($categories as $cat): ?>
								<div class="category-row mb-2">
									<div class="row align-items-center g-2">
										<input type="hidden" name="category_id[]" value="<?= $cat['category_id']; ?>">
										<div class="col-5">
											<input type="text" name="name_th[]" class="form-control"
												placeholder="ชื่อหมวดหมู่ (TH) เช่น ภาพรวม"
												value="<?= htmlspecialchars($cat['name_th'] ?? '', ENT_QUOTES); ?>">
										</div>
										<div class="col-5">
											<input type="text" name="name_en[]" class="form-control"
												placeholder="Category name (EN) e.g. Overview"
												value="<?= htmlspecialchars($cat['name_en'] ?? '', ENT_QUOTES); ?>">
										</div>
										<div class="col-2">
											<button type="button" class="btn btn-danger btn-sm w-100 remove-category-row">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="category-row mb-2">
								<div class="row align-items-center g-2">
									<input type="hidden" name="category_id[]" value="">
									<div class="col-5">
										<input type="text" name="name_th[]" class="form-control"
											placeholder="ชื่อหมวดหมู่ (TH) เช่น ภาพรวม">
									</div>
									<div class="col-5">
										<input type="text" name="name_en[]" class="form-control"
											placeholder="Category name (EN) e.g. Overview">
									</div>
									<div class="col-2">
										<button type="button" class="btn btn-danger btn-sm w-100 remove-category-row">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-success px-4">
						<i class="fas fa-save me-1"></i> บันทึกหมวดหมู่
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- ══════════════════════════════════════════
     Modal เพิ่มรูปภาพ (หลายรูป)
══════════════════════════════════════════ -->
<div class="modal fade" id="modalAddImage" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form action="<?= admin_url('gallery/create/' . ($hotelData['hotel_id'] ?? '')); ?>"
				method="post" enctype="multipart/form-data" novalidate>
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fas fa-plus-circle me-2 text-primary"></i> เพิ่มรูปภาพ Gallery
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="form-group mb-3">
						<label class="fw-bold">หมวดหมู่ <span class="text-danger">*</span></label>
						<select name="category_id" class="form-select mt-2" required>
							<option value="">— เลือกหมวดหมู่ —</option>
							<?php foreach ($categories as $cat): ?>
								<option value="<?= $cat['category_id']; ?>"
									<?= (!empty($active_cat) && $active_cat == $cat['category_id']) ? 'selected' : ''; ?>>
									<?= htmlspecialchars($cat['name_th'] ?? ''); ?>
									<?= !empty($cat['name_en']) ? '(' . htmlspecialchars($cat['name_en']) . ')' : ''; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label class="fw-bold">รูปภาพ
							<small class="text-muted fw-normal">(เลือกได้หลายรูป, แนะนำ 1920 × 1080 px)</small>
						</label>
						<input type="file" name="gallery_images[]" id="gallery_images_add"
							class="multiple-preview-files-filepond" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-success px-4">
						<i class="fas fa-save me-1"></i> บันทึก
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- ══════════════════════════════════════════
     Modal แก้ไขรูปภาพ
══════════════════════════════════════════ -->
<div class="modal fade" id="modalEditImage" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="formEditImage" action="" method="post" enctype="multipart/form-data" novalidate>
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fas fa-edit me-2 text-warning"></i> แก้ไขรูปภาพ
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="form-group mb-3">
						<label class="fw-bold">หมวดหมู่</label>
						<select name="category_id" id="editImageCategory" class="form-select mt-2">
							<?php foreach ($categories as $cat): ?>
								<option value="<?= $cat['category_id']; ?>">
									<?= htmlspecialchars($cat['name_th'] ?? ''); ?>
									<?= !empty($cat['name_en']) ? '(' . htmlspecialchars($cat['name_en']) . ')' : ''; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label class="fw-bold">รูปภาพปัจจุบัน:</label><br>
						<img id="editImagePreview" src="" width="200" class="mt-2 rounded border">
					</div>
					<div class="form-group">
						<label class="fw-bold">เปลี่ยนรูปภาพใหม่
							<small class="text-muted fw-normal">(ถ้าไม่เลือก จะใช้รูปเดิม)</small>
						</label>
						<input type="file" name="gallery_image" id="gallery_image_edit"
							class="image-crop-filepond mt-2">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-warning px-4">
						<i class="fas fa-save me-1"></i> อัปเดต
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
