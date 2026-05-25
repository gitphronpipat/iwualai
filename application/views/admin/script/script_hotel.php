<script>
	(function () {
		'use strict';

		/* ─────────────────────────────────────────────
		 * 1. Preview รูปภาพก่อนอัปโหลด
		 * ───────────────────────────────────────────── */
		const hotelImageInput = document.getElementById('hotel_img');
		if (hotelImageInput) {
			hotelImageInput.addEventListener('change', function () {
				const file = this.files[0];
				if (!file) return;
				const reader = new FileReader();
				reader.onload = function (e) {
					const preview     = document.getElementById('hotelImgPreview');
					const link        = document.getElementById('hotelImgLink');
					const placeholder = document.getElementById('hotelImgPlaceholder');
					if (preview) {
						preview.src          = e.target.result;
						preview.style.display = 'block';
					}
					if (link) {
						link.href          = e.target.result;
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
			modalDel.addEventListener('show.bs.modal', function (event) {
				const button    = event.relatedTarget;
				const url       = button ? button.getAttribute('data-url') : null;
				const btnConfirm = document.getElementById('btnConfirmDel');
				if (btnConfirm && url) {
					btnConfirm.setAttribute('href', url);
				}
			});
		}

		/* ─────────────────────────────────────────────
		 * 3. Input รับเฉพาะตัวเลข
		 * ───────────────────────────────────────────── */
		document.querySelectorAll('.input-order').forEach(function (input) {
			input.addEventListener('input', function () {
				this.value = this.value.replace(/[^0-9]/g, '');
			});
			// กด Enter แล้ว submit form
			input.addEventListener('keypress', function (e) {
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
			// ล้างค่าเดิมทุกครั้งที่โหลดหน้า → กลับ Step 1 เสมอ
			sessionStorage.removeItem('currentHotelStepTab');
			sessionStorage.removeItem('currentHotelStepTabEdit');

			// แสดง Step 1 เป็นค่าเริ่มต้น
			const firstTab = stepTabs.querySelector('a[href="#step1"]');
			if (firstTab) {
				new bootstrap.Tab(firstTab).show();
				const el = document.getElementById('currentStep');
				if (el) el.innerText = '1';
			}

			// บันทึก step ปัจจุบันเมื่อเปลี่ยน tab
			stepTabs.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function (tab) {
				tab.addEventListener('shown.bs.tab', function (e) {
					const href = e.target.getAttribute('href');
					const el   = document.getElementById('currentStep');
					if (el) el.innerText = href.replace('#step', '');
				});
			});
		}

		/* ─────────────────────────────────────────────
		 * 5. goToStep (global — ใช้ใน onclick ของ HTML)
		 * ───────────────────────────────────────────── */
		window.goToStep = function (step) {
			const tabElement = document.querySelector('#stepTabs a[href="#step' + step + '"]');
			if (tabElement) new bootstrap.Tab(tabElement).show();
		};

	})();
</script>
