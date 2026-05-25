<section>
	<div class="container-fluid">
		<div class="row">
			<div class="page-heading">
				<div class="row">
					<h3>เพิ่มข้อมูลแอดมิน</h3>
				</div>
			</div>
			<div class="page-content">
				<form class="form-validator" action="<?= admin_url('admin/create'); ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="permission" value="2">
					<div class="card shadow-sm">
						<div class="card-body px-4">

							<div class="form-group">
								<label for="name">ชื่อ <sup class="text-danger">*</sup></label>
								<input type="text" id="name" name="name" class="form-control" value="<?= set_value('name') ?>" required>
							</div>

							<div class="form-group">
								<label for="user">ชื่อผู้ใช้งาน <sup class="text-danger">*</sup></label>
								<input type="text" id="user" name="username" class="form-control" value="<?= set_value('username') ?>" required>
							</div>

							<div class="form-group">
								<label for="password">รหัสผ่าน <sup class="text-danger">*</sup></label>
								<input type="password" id="password" name="password" class="form-control" required minlength="6">
							</div>

							<div class="form-group">
								<label for="passwordCF">ยืนยันรหัสผ่าน <sup class="text-danger">*</sup></label>
								<input type="password" id="passwordCF" name="password_cf" class="form-control" required>
							</div>

						</div>
						<div class="card-footer border-0">
							<button class="btn btn-success px-4" type="submit">บันทึกข้อมูล</button>
							<a href="<?= admin_url('admin'); ?>" class="btn btn-light px-4 ms-2">กลับหน้าหลัก</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
