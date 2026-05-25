<script>
	document.addEventListener('DOMContentLoaded', function() {

		/* ─────────────────────────────────────────────
		 * 1. Modal เพิ่มรูปภาพ Banner — jQuery Validate
		 * ───────────────────────────────────────────── */
		const modalAddBanner = document.getElementById('modalAddBanner');
		if (modalAddBanner) {
			modalAddBanner.addEventListener('show.bs.modal', function() {
				const $f = $('#modalAddBanner form');
				if ($f.data('validator')) $f.data('validator').destroy();
				$f.validate({
					ignore: [],
					rules:    { banner_image: { required: true } },
					messages: { banner_image: { required: 'โปรดเลือกรูปภาพ' } },
					errorPlacement: function(error, element) {
						error.insertAfter(element.closest('.filepond--root') || element);
					},
					highlight:   function(el) { $(el).addClass('is-invalid').removeClass('is-valid'); },
					unhighlight: function(el) { $(el).removeClass('is-invalid').addClass('is-valid'); },
				});
			});
			modalAddBanner.addEventListener('hidden.bs.modal', function() {
				const $f = $('#modalAddBanner form');
				if ($f.data('validator')) $f.validate().resetForm();
				$f.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
				$f.find('label.error').remove();
			});
		}

		/* ─────────────────────────────────────────────
		 * 2. Modal แก้ไขรูปภาพ Banner
		 * ───────────────────────────────────────────── */
		const modalEditBanner = document.getElementById('modalEditBanner');
		if (modalEditBanner) {
			modalEditBanner.addEventListener('show.bs.modal', function(e) {
				const btn = e.relatedTarget;
				const id  = btn.getAttribute('data-id');
				const img = btn.getAttribute('data-img');

				document.getElementById('formEditBanner').action = '<?= admin_url('hotelbannnerimage/edit/'); ?>' + id;
				document.getElementById('editBannerPreview').src = img;

				const $form = $('#formEditBanner');
				if ($form.data('validator')) $form.data('validator').destroy();
				$form.validate({
					ignore: [],
					errorPlacement: function(error, element) { error.insertAfter(element); },
					highlight:   function(el) { $(el).addClass('is-invalid').removeClass('is-valid'); },
					unhighlight: function(el) { $(el).removeClass('is-invalid').addClass('is-valid'); },
				});
			});
			modalEditBanner.addEventListener('hidden.bs.modal', function() {
				const $form = $('#formEditBanner');
				if ($form.data('validator')) $form.validate().resetForm();
				$form.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
				$form.find('label.error').remove();
			});
		}

		/* ─────────────────────────────────────────────
		 * 3. Modal แก้ไขลิงก์ Check-in (ระดับ hotel)
		 *    รับ data-hotel-id แทน data-id
		 * ───────────────────────────────────────────── */
		const modalEditUrl = document.getElementById('modalEditUrl');
		if (modalEditUrl) {
			modalEditUrl.addEventListener('show.bs.modal', function(e) {
				const btn        = e.relatedTarget;
				const hotelId    = btn.getAttribute('data-hotel-id');
				const urlCheckin = btn.getAttribute('data-url-checkin') || '';

				document.getElementById('formEditUrl').action    = '<?= admin_url('hotelbannnerimage/update_url/'); ?>' + hotelId;
				document.getElementById('inputUrlCheckin').value = urlCheckin;

				const $form = $('#formEditUrl');
				if ($form.data('validator')) $form.data('validator').destroy();
				$form.validate({
					ignore: [],
					rules:    { url_check_in: { url: true } },
					messages: { url_check_in: { url: 'กรุณากรอก URL ให้ถูกต้อง เช่น https://...' } },
					errorPlacement: function(error, element) { error.insertAfter(element); },
					highlight:   function(el) { $(el).addClass('is-invalid').removeClass('is-valid'); },
					unhighlight: function(el) { $(el).removeClass('is-invalid').addClass('is-valid'); },
				});
			});
			modalEditUrl.addEventListener('hidden.bs.modal', function() {
				const $form = $('#formEditUrl');
				if ($form.data('validator')) $form.validate().resetForm();
				$form.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
				$form.find('label.error').remove();
			});
		}

		/* ─────────────────────────────────────────────
		 * 4. Input Sort Order — กด Enter แล้ว submit
		 * ───────────────────────────────────────────── */
		document.querySelectorAll('.input-order').forEach(function(input) {
			input.addEventListener('keypress', function(e) {
				if (e.key === 'Enter' || e.keyCode === 13) {
					e.preventDefault();
					this.closest('form').submit();
				}
			});
		});
	});

	sessionStorage.removeItem("currentTitleStepTab");
</script>