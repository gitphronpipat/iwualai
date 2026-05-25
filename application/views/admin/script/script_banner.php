<script>
	document.addEventListener('DOMContentLoaded', function () {

		/* ─────────────────────────────────────────────
		 * 1. Modal แก้ไข Banner — รับ data-id และ data-img
		 * ───────────────────────────────────────────── */
	 const modalEditBanner = document.getElementById('modalEditBanner');
        if (modalEditBanner) {
            modalEditBanner.addEventListener('show.bs.modal', function (e) {
                const btn = e.relatedTarget;
                const id  = btn.getAttribute('data-id');
                const img = btn.getAttribute('data-img');

                document.getElementById('formEditBanner').action = '<?= admin_url('banner/edit/'); ?>' + id;
                
                // อัปเดตรูปภาพ Preview
                document.getElementById('editBannerPreview').src  = img;
                // อัปเดตลิงก์ให้กดดูรูปเต็มได้
                document.getElementById('editBannerLink').href = img;
            });
        }
		/* ─────────────────────────────────────────────
		 * 2. Preview รูปใน Modal เพิ่ม
		 * ───────────────────────────────────────────── */
		const addInput = document.getElementById('banner_img_add');
        if (addInput) {
            addInput.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('addBannerPreview');
                    preview.src           = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            });
        }

		/* ─────────────────────────────────────────────
		 * 3. Preview รูปใน Modal แก้ไข
		 * ───────────────────────────────────────────── */
		 const editInput = document.getElementById('banner_img_edit');
        if (editInput) {
            editInput.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    // เปลี่ยนรูป Preview
                    document.getElementById('editBannerPreview').src = e.target.result;
                    // เปลี่ยนลิงก์ให้เป็นรูปที่เลือกใหม่
                    document.getElementById('editBannerLink').href = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }


		/* ─────────────────────────────────────────────
		 * 4. Input Sort Order — กด Enter แล้ว submit
		 * ───────────────────────────────────────────── */
		document.querySelectorAll('.input-order').forEach(function (input) {
            input.addEventListener('keypress', function (e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    e.preventDefault();
                    this.closest('form').submit();
                }
            });
        });

    });
</script>
