<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>จัดการแอดมิน</h3>
					</div>
					<div class="col-6 text-end">
						<a href="<?= admin_url('admin/create'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
					</div>
				</div>
			</div>
		</div>
		<div class="page-content">
			<form action="<?= admin_url('admin'); ?>" method="post">
				<div class="card shadow-sm">
					<div class="card-body px-4">
						<div class="table-responsive">
							<table class="table table-bordered table-striped dataTable">
								<thead>
									<tr>
										<th scope="col" class="text-center" width="10%">ลำดับ</th>
										<th scope="col" class="text-center">ชื่อ-นามสกุล</th>
										<th scope="col" class="text-center">ชื่อผู้ใช้งาน</th>
										<th scope="col" class="text-center">สิทธิ์การใช้งาน</th>
										<th scope="col" class="text-center" width="15%">ลำดับ / สถานะ</th>
										<th scope="col" class="text-center" width="15%">แก้ไข / ลบ</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($admins)): foreach ($admins as $i => $a): ?>
											<tr>
												<td class="text-center"><?= $i + 1; ?></td>
												<td><?= htmlspecialchars($a['admin_name']); ?></td>
												<td><?= htmlspecialchars($a['admin_user']); ?></td>
												<td class="text-center">
													<?php
													if ($a['admin_permission'] == 1) echo '<span class="badge bg-primary">แอดมินสูงสุด</span>';
													else if ($a['admin_permission'] == 2) echo '<span class="badge bg-info">แอดมินทั่วไป</span>';
													else echo '-';
													?>
												</td>

												<td>
													<div class="d-flex justify-content-center input-group px-2">
														<input type="hidden" name="id[]" value="<?= $a['admin_id']; ?>">
														<input type="text"
															class="form-control form-control-sm input-order text-center ajax-update"
															name="order_data[]"
															value="<?= $a['admin_sort']; ?>"
															inputmode="numeric"
															data-id="<?= $a['admin_id']; ?>"
															data-field="admin_sort">

														<?php if ($a['admin_status'] == 1) { ?>
															<a href="<?= admin_url('admin/status/') . $a['admin_id'] ?>/0" class="form-control btn btn-info btn-sm pt-2" title="Show"><i class="fa fa-desktop"></i></a>
														<?php  } else { ?>
															<a href="<?= admin_url('admin/status/') . $a['admin_id'] ?>/1" class="form-control btn btn-danger btn-sm pt-2" title="Not Show"><i class="fa fa-eye-slash"></i></a>
														<?php  } ?>
													</div>
												</td>

												<td>
													<div class="d-flex justify-content-center input-group input-group-edit px-2">
														<a href="<?= admin_url('admin/edit/') . $a['admin_id']; ?>" class="btn btn-warning btn-sm px-3">
															<i class="fas fa-edit"></i>
														</a>
														<a type="button" class="btn btn-danger btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalDel" data-id="<?= $a['admin_id']; ?>" data-url="<?= admin_url('admin/del/') . $a['admin_id']; ?>">
															<i class="far fa-trash-alt"></i>
														</a>
													</div>
												</td>
											</tr>
										<?php endforeach;
									else: ?>
										<tr>
											<td colspan="6" class="text-center">ไม่พบข้อมูล</td>
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
<script>
	$(document).ready(function() {
		$('.ajax-update').on('keypress', function(e) {
			if (e.which == 13) { 
				e.preventDefault();
				var $el = $(this);
				var data = {
					id: $el.data('id'),
					field: $el.data('field'),
					value: $el.val()
				};
				$.post("<?= admin_url('admin/update_inline') ?>", data, function(res) {
					if (res.result == 'true' || res.result == true) {
						$el.blur();
						window.location.reload();
					} else {
						alert('เกิดข้อผิดพลาด: ' + (res.message || 'ไม่สามารถบันทึกได้'));
					}
				}, 'json');
			}
		});
	});
</script>
