<script>
document.addEventListener('DOMContentLoaded', function() {

    // ── ลบส่วน filterByCategory และ hash ออกแล้ว
    // เพราะตอนนี้ใช้ URL จริง /gallery/category/{hotel}/{cat} แทน

    // เปิด Modal แก้ไขรูปภาพ
    var modalEditImage = document.getElementById('modalEditImage');
    if (modalEditImage) {
        modalEditImage.addEventListener('show.bs.modal', function(event) {
            var btn = event.relatedTarget;
            var id = btn.getAttribute('data-id');
            var img = btn.getAttribute('data-img');
            var catId = btn.getAttribute('data-category');
            var form = document.getElementById('formEditImage');
            var preview = document.getElementById('editImagePreview');
            var catSel = document.getElementById('editImageCategory');

            form.action = '<?= admin_url('gallery/edit/'); ?>' + id;
            preview.src = '<?= base_url(); ?>' + img;
            if (catSel) catSel.value = catId;
        });
    }

    // เพิ่มแถวหมวดหมู่ใหม่
    var addBtn = document.getElementById('add-category-row');
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            var container = document.getElementById('category-container');
            var row = document.createElement('div');
            row.className = 'category-row mb-2';
            row.innerHTML = [
                '<div class="row align-items-center g-2">',
                '<input type="hidden" name="category_id[]" value="">',
                '<div class="col-5"><input type="text" name="name_th[]" class="form-control" placeholder="ชื่อหมวดหมู่ (TH) เช่น ภาพรวม"></div>',
                '<div class="col-5"><input type="text" name="name_en[]" class="form-control" placeholder="Category name (EN) e.g. Overview"></div>',
                '<div class="col-2"><button type="button" class="btn btn-danger btn-sm w-100 remove-category-row"><i class="fa fa-trash"></i></button></div>',
                '</div>'
            ].join('');
            container.appendChild(row);
        });
    }

    // ลบแถวหมวดหมู่ (event delegation)
    var container = document.getElementById('category-container');
    if (container) {
        container.addEventListener('click', function(e) {
            var btn = e.target.closest('.remove-category-row');
            if (btn) btn.closest('.category-row').remove();
        });
    }

});
</script>
