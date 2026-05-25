<script>
	document.addEventListener('DOMContentLoaded', function() {

				// ── Modal เพิ่ม — jQuery Validate ──
				const modalAdd = document.getElementById('modalAddFacility');
				if (modalAdd) {
					modalAdd.addEventListener('show.bs.modal', function() {
						const $form = $('#formAddFacility');
						if ($form.data('validator')) {
							$form.data('validator').destroy();
						}
						$form.validate({
							ignore: [],
							rules: {
								facility_name: {
									required: true
								},
							},
							messages: {
								facility_name: {
									required: 'โปรดกรอกข้อมูลช่องนี้'
								},
							},
							errorPlacement: function(error, element) {
								error.insertAfter(element);
							},
							highlight: function(element) {
								$(element).addClass('is-invalid').removeClass('is-valid');
							},
							unhighlight: function(element) {
								$(element).removeClass('is-invalid').addClass('is-valid');
							},
						});
					});

					// Reset เมื่อปิด modal เพิ่ม
					modalAdd.addEventListener('hidden.bs.modal', function() {
						const $form = $('#formAddFacility');
						if ($form.data('validator')) {
							$form.validate().resetForm();
						}
						$form.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
						$form.find('label.error').remove();
					});
				}

				// ── Modal แก้ไข — jQuery Validate ──
				const modalEdit = document.getElementById('modalEditFacility');
				if (modalEdit) {
					modalEdit.addEventListener('show.bs.modal', function(e) {
						const btn = e.relatedTarget;
						const id = btn.getAttribute('data-id');
						const name = btn.getAttribute('data-name');
						const hotel = btn.getAttribute('data-hotel');
						const img = btn.getAttribute('data-img');

						// set action
						document.getElementById('formEditFacility').action = '<?= admin_url('facility/edit/'); ?>' + id;

						// set ชื่อ
						document.getElementById('editFacilityName').value = name;

						// set รูปภาพ + href สำหรับ fancybox
						const imgWrap = document.getElementById('editFacilityImgWrap');
						const imgEl = document.getElementById('editFacilityImg');
						const imgLink = document.getElementById('editFacilityImgLink');

						if (img) {
							imgEl.src = img;
							imgLink.href = img;
							imgWrap.style.display = 'block';
						} else {
							imgWrap.style.display = 'none';
						}

						// set โรงแรม (superadmin)
						const hotelSelect = document.getElementById('editHotelSelect');
						if (hotelSelect && hotel) {
							hotelSelect.value = hotel;
						}

						// init jQuery Validate
						const $form = $('#formEditFacility');
						if ($form.data('validator')) {
							$form.data('validator').destroy();
						}
						$form.validate({
							ignore: [],
							rules: {
								facility_name: {
									required: true
								},
							},
							messages: {
								facility_name: {
									required: 'โปรดกรอกข้อมูลช่องนี้'
								},
							},
							errorPlacement: function(error, element) {
								error.insertAfter(element);
							},
							highlight: function(element) {
								$(element).addClass('is-invalid').removeClass('is-valid');
							},
							unhighlight: function(element) {
								$(element).removeClass('is-invalid').addClass('is-valid');
							},
						});
					});

					// Reset เมื่อปิด modal แก้ไข
					modalEdit.addEventListener('hidden.bs.modal', function() {
						const $form = $('#formEditFacility');
						if ($form.data('validator')) {
							$form.validate().resetForm();
						}
						$form.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
						$form.find('label.error').remove();
					});
				}

				// Sort order — กด Enter แต่ไม่ submit form (ปล่อยให้ ajax-update จัดการ)
				document.querySelectorAll('.input-order').forEach(function(input) {
					input.addEventListener('keypress', function(e) {
						if (e.key === 'Enter' || e.keyCode === 13) {
							e.preventDefault();
						}
					});
				});

				// Ajax update sort order
				// Ajax update sort order
				$('.ajax-update').on('keypress', function(e) {
					if (e.which == 13) {
						e.preventDefault();
						e.stopPropagation();
						var $el = $(this);
						var data = {
							id: $el.data('id'),
							field: $el.data('field'),
							value: $el.val()
						};
						$.post("<?= admin_url('facility/update_inline') ?>", data, function(res) {
							if (res.result == 'true' || res.result == true) {
								$el.blur();
								Swal.fire({
									icon: 'success',
									title: 'สำเร็จ',
									text: 'อัพเดทลำดับเรียบร้อยแล้ว',
									confirmButtonColor: '#198754'
								}).then(function() {
									window.location.reload();
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'ไม่สำเร็จ',
									text: res.message || 'ไม่สามารถบันทึกได้',
									confirmButtonColor: '#d33'
								});
							}
						}, 'json');
					}
				});
				sessionStorage.removeItem("currentTitleStepTab");
			});
</script>
