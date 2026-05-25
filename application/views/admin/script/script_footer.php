<script>
	/* ─────────────────────────────────────────────
	 * 1. Footer Step Tab
	 * ───────────────────────────────────────────── */
	const FOOTER_STORAGE_KEY = "currentFooterStepTab";

	window.goToFooterStep = function (step) {
		const tabElement = document.querySelector('#footerStepTabs a[href="#footerStep' + step + '"]');
		if (tabElement) new bootstrap.Tab(tabElement).show();
	};

	$(function () {
		const savedTab = sessionStorage.getItem(FOOTER_STORAGE_KEY);
		if (savedTab && $('#footerStepTabs a[href="' + savedTab + '"]').length) {
			new bootstrap.Tab($('#footerStepTabs a[href="' + savedTab + '"]')[0]).show();
			$('#footerCurrentStep').text(savedTab.replace('#footerStep', ''));
		} else {
			const firstTab = $('#footerStepTabs a[href="#footerStep1"]');
			if (firstTab.length) {
				new bootstrap.Tab(firstTab[0]).show();
				sessionStorage.setItem(FOOTER_STORAGE_KEY, "#footerStep1");
				$('#footerCurrentStep').text('1');
			}
		}

		$('#footerStepTabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
			const targetHref = $(e.target).attr("href");
			sessionStorage.setItem(FOOTER_STORAGE_KEY, targetHref);
			$('#footerCurrentStep').text(targetHref.replace('#footerStep', ''));
		});
	});

	/* ─────────────────────────────────────────────
	 * 2. Clear session on load
	 * ───────────────────────────────────────────── */
	sessionStorage.removeItem("currentFooterStepTab");

	/* ─────────────────────────────────────────────
	 * 3. Dynamic Rows (Phone / Email) + Map Preview
	 * ───────────────────────────────────────────── */
	document.addEventListener('DOMContentLoaded', function () {

		// Phone — add
		const addPhoneBtn = document.getElementById('add-phone');
		if (addPhoneBtn) {
			addPhoneBtn.addEventListener('click', function () {
				const container = document.getElementById('phone-container');
				const newRow    = document.createElement('div');
				newRow.className = 'reason-row mb-3';
				newRow.innerHTML = `
					<div class="row">
						<div class="col-11">
							<input type="text" name="phone[]" class="form-control" placeholder="เบอร์โทรศัพท์">
						</div>
						<div class="col-1">
							<button type="button" class="btn btn-danger btn-md remove-reason">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>`;
				container.appendChild(newRow);
			});
		}

		// Phone — remove
		const phoneContainer = document.getElementById('phone-container');
		if (phoneContainer) {
			phoneContainer.addEventListener('click', function (e) {
				const btn = e.target.closest('.remove-reason');
				if (btn) btn.closest('.reason-row').remove();
			});
		}

		// Email — add
		const addEmailBtn = document.getElementById('add-email');
		if (addEmailBtn) {
			addEmailBtn.addEventListener('click', function () {
				const container = document.getElementById('email-container');
				const newRow    = document.createElement('div');
				newRow.className = 'reason-row mb-3';
				newRow.innerHTML = `
					<div class="row">
						<div class="col-11">
							<input type="text" name="email[]" class="form-control" placeholder="อีเมล">
						</div>
						<div class="col-1">
							<button type="button" class="btn btn-danger btn-md remove-reason">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>`;
				container.appendChild(newRow);
			});
		}

		// Email — remove
		const emailContainer = document.getElementById('email-container');
		if (emailContainer) {
			emailContainer.addEventListener('click', function (e) {
				const btn = e.target.closest('.remove-reason');
				if (btn) btn.closest('.reason-row').remove();
			});
		}

		/* ─────────────────────────────────────────────
		 * 4. Map Preview
		 * ───────────────────────────────────────────── */
		const mapInput   = document.getElementById('map-embed-input');
		const mapPreview = document.getElementById('map-preview');

		function updateMapPreview(raw) {
			raw = (raw || '').trim();
			if (!raw) {
				mapPreview.innerHTML = `
					<div class="d-flex align-items-center justify-content-center h-100 text-muted" style="min-height:300px;">
						<div class="text-center">
							<i class="fas fa-map-marked-alt fa-3x mb-2"></i>
							<p>กรุณาใส่ embed code เพื่อดูตัวอย่างแผนที่</p>
						</div>
					</div>`;
				return;
			}
			const match = raw.match(/src=["']([^"']+)["']/i);
			if (match && match[1]) {
				mapPreview.innerHTML = `<iframe src="${match[1]}" width="100%" height="300" style="border:0;" allowfullscreen loading="lazy"></iframe>`;
			}
		}

		if (mapInput) {
			updateMapPreview(mapInput.value);

			mapInput.addEventListener('paste', function () {
				setTimeout(() => updateMapPreview(this.value), 50);
			});
			mapInput.addEventListener('input', function () {
				updateMapPreview(this.value);
			});
		}

	});
</script>
