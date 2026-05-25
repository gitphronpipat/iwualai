<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row align-items-center">
					<div class="col-6">
						<h3>จัดการ Contact</h3>
					</div>
				</div>
			</div>

			<div class="page-content">
				
				<div class="card shadow-sm">
					<div class="card-body px-4 py-4">
						<form action="<?= admin_url('contact/create/' . ($hotel_id ?? '')); ?>" method="post" novalidate>

							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-4 text-primary col-12">
									<i class="fas fa-envelope me-2"></i> Mail Description
								</h5>
								<div class="form-group col-md-6 mb-3">
									<label class="fw-bold">Mail Description (TH)</label>
									<textarea name="mail_des_th" class="tiny-editor form-control mt-2" rows="4"
										placeholder="คำอธิบาย Mail ภาษาไทย"><?= htmlspecialchars($contact['mail_des_th'] ?? ''); ?></textarea>
								</div>
								<div class="form-group col-md-6 mb-3">
									<label class="fw-bold">Mail Description (EN)</label>
									<textarea name="mail_des_en" class="tiny-editor form-control mt-2" rows="4"
										placeholder="Mail description in English"><?= htmlspecialchars($contact['mail_des_en'] ?? ''); ?></textarea>
								</div>
							</div>

							<div class="row bg-light p-4 rounded border mb-4">
								<h5 class="mb-4 text-primary col-12">
									<i class="fas fa-address-book me-2"></i> Contact Description
								</h5>
								<div class="form-group col-md-6 mb-3">
									<label class="fw-bold">Contact Description (TH)</label>
									<textarea name="contact_des_th" class="tiny-editor form-control mt-2" rows="4"
										placeholder="คำอธิบาย Contact ภาษาไทย"><?= htmlspecialchars($contact['contact_des_th'] ?? ''); ?></textarea>
								</div>
								<div class="form-group col-md-6 mb-3">
									<label class="fw-bold">Contact Description (EN)</label>
									<textarea name="contact_des_en" class="tiny-editor 	form-control mt-2" rows="4"
										placeholder="Contact description in English"><?= htmlspecialchars($contact['contact_des_en'] ?? ''); ?></textarea>
								</div>
							</div>

							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-success px-5">
									<i class="fas fa-save me-2"></i> บันทึกข้อมูล
								</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>