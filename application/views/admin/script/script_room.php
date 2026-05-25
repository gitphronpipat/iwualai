<script>
	(function() {
		'use strict';

		/* ─────────────────────────────────────────────
		 * 1. Preview รูปภาพก่อนอัปโหลด
		 * ───────────────────────────────────────────── */
		const hotelImageInput = document.getElementById('hotel_img');
		if (hotelImageInput) {
			hotelImageInput.addEventListener('change', function() {
				const file = this.files[0];
				if (!file) return;
				const reader = new FileReader();
				reader.onload = function(e) {
					const preview = document.getElementById('hotelImgPreview');
					const link = document.getElementById('hotelImgLink');
					const placeholder = document.getElementById('hotelImgPlaceholder');
					if (preview) {
						preview.src = e.target.result;
						preview.style.display = 'block';
					}
					if (link) {
						link.href = e.target.result;
						link.style.display = 'inline-block';
					}
					if (placeholder) {
						placeholder.style.display = 'none';
					}
				};
				reader.readAsDataURL(file);
			});
		}

		/* ─────────────────────────────────────────────
		 * 2. Modal ยืนยันการลบ
		 * ───────────────────────────────────────────── */
		const modalDel = document.getElementById('modalDel');
		if (modalDel) {
			modalDel.addEventListener('show.bs.modal', function(event) {
				const button = event.relatedTarget;
				const url = button ? button.getAttribute('data-url') : null;
				const btnConfirm = document.getElementById('btnConfirmDel');
				if (btnConfirm && url) {
					btnConfirm.setAttribute('href', url);
				}
			});
		}

		/* ─────────────────────────────────────────────
		 * 3. Input รับเฉพาะตัวเลข
		 * ───────────────────────────────────────────── */
		document.querySelectorAll('.input-order').forEach(function(input) {
			input.addEventListener('input', function() {
				this.value = this.value.replace(/[^0-9]/g, '');
			});
			input.addEventListener('keypress', function(e) {
				if (e.key === 'Enter' || e.keyCode === 13) {
					e.preventDefault();
					this.closest('form').submit();
				}
			});
		});

		/* ─────────────────────────────────────────────
		 * 4. Tab Step (hotel_add / hotel_edit)
		 * ───────────────────────────────────────────── */
		const stepTabs = document.getElementById('stepTabs');
		if (stepTabs) {
			sessionStorage.removeItem('currentHotelStepTab');
			sessionStorage.removeItem('currentHotelStepTabEdit');

			const firstTab = stepTabs.querySelector('a[href="#step1"]');
			if (firstTab) {
				new bootstrap.Tab(firstTab).show();
				const el = document.getElementById('currentStep');
				if (el) el.innerText = '1';
			}

			stepTabs.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function(tab) {
				tab.addEventListener('shown.bs.tab', function(e) {
					const href = e.target.getAttribute('href');
					const el = document.getElementById('currentStep');
					if (el) el.innerText = href.replace('#step', '');
				});
			});
		}

		/* ─────────────────────────────────────────────
		 * 5. goToStep (global — ใช้ใน onclick ของ HTML)
		 * ───────────────────────────────────────────── */
		window.goToStep = function(step) {
			const tabElement = document.querySelector('#stepTabs a[href="#step' + step + '"]');
			if (tabElement) new bootstrap.Tab(tabElement).show();
		};

	})();
</script>

<script>
	/* ─────────────────────────────────────────────
	 * 6. Room Step Tab (page_room_add / page_room_edit)
	 * ───────────────────────────────────────────── */
	const ROOM_STORAGE_KEY = "currentRoomStepTab";

	window.goToRoomStep = function(step) {
		const tabElement = document.querySelector('#roomStepTabs a[href="#roomStep' + step + '"]');
		if (tabElement) new bootstrap.Tab(tabElement).show();
	};

	$(function() {
		const savedTab = sessionStorage.getItem(ROOM_STORAGE_KEY);
		if (savedTab && $('#roomStepTabs a[href="' + savedTab + '"]').length) {
			new bootstrap.Tab($('#roomStepTabs a[href="' + savedTab + '"]')[0]).show();
			$('#roomCurrentStep').text(savedTab.replace('#roomStep', ''));
		} else {
			const firstTab = $('#roomStepTabs a[href="#roomStep1"]');
			if (firstTab.length) {
				new bootstrap.Tab(firstTab[0]).show();
				sessionStorage.setItem(ROOM_STORAGE_KEY, "#roomStep1");
				$('#roomCurrentStep').text('1');
			}
		}

		$('#roomStepTabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
			const targetHref = $(e.target).attr("href");
			sessionStorage.setItem(ROOM_STORAGE_KEY, targetHref);
			$('#roomCurrentStep').text(targetHref.replace('#roomStep', ''));
		});
	});

	/* ─────────────────────────────────────────────
	 * 7. Add / Remove Amenity Rows
	 * ───────────────────────────────────────────── */
	document.addEventListener('DOMContentLoaded', function() {
		const addBtn = document.getElementById('add-amenity');
		const container = document.getElementById('amenity-container');

		if (addBtn && container) {
			addBtn.addEventListener('click', function() {
				const newRow = document.createElement('div');
				newRow.className = 'reason-row mb-3';
				newRow.innerHTML = `
					<div class="row">
						<input type="hidden" name="amenity_id[]" value="">
						<div class="col-11">
							<input type="text" name="amenity_name[]" class="form-control" placeholder="สิ่งอำนวยความสะดวก">
						</div>
						<div class="col-1">
							<button type="button" class="btn btn-danger btn-md remove-reason">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				`;
				container.appendChild(newRow);
			});

			container.addEventListener('click', function(e) {
				const btn = e.target.classList.contains('remove-reason') ?
					e.target :
					e.target.closest('.remove-reason');
				if (btn) {
					const row = btn.closest('.reason-row');
					if (row) row.remove();
				}
			});
		}
	});

	/* ─────────────────────────────────────────────
	 * 8. Delete Room Gallery (AJAX — page_room_edit)
	 * ───────────────────────────────────────────── */
	function deleteRoomGallery(id) {
		Swal.fire({
			title: 'ยืนยันการลบ?',
			text: "คุณต้องการลบรูปภาพนี้ใช่หรือไม่!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'ใช่, ลบเลย!',
			cancelButtonText: 'ยกเลิก'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= admin_url('room/delete_gallery/') ?>' + id,
					type: 'GET',
					dataType: 'json',
					success: function(res) {
						if (res.success == 1) {
							$('#gal-' + id).fadeOut(400, function() {
								$(this).remove();
							});
							Swal.fire({
								icon: 'success',
								title: 'สำเร็จ',
								text: res.msg || 'ลบรูปภาพเรียบร้อยแล้ว',
								confirmButtonColor: '#198754'
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'ไม่สำเร็จ',
								text: res.msg || 'ไม่สามารถลบรูปได้',
								confirmButtonColor: '#198754'
							});
						}
					},
					error: function() {
						Swal.fire({
							icon: 'error',
							title: 'ไม่สำเร็จ',
							text: 'ไม่สามารถติดต่อเซิร์ฟเวอร์ได้',
							confirmButtonColor: '#198754'
						});
					}
				});
			}
		});
	}
</script>
