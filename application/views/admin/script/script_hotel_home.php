<script>
    (function() {
        'use strict';

        /* ─────────────────────────────────────────────
         * 1. Preview รูปภาพก่อนอัปโหลด
         * สำหรับหน้า Add และ Edit (ถ้ามีการเปลี่ยนรูป)
         * ───────────────────────────────────────────── */
        const hotelImageInput = document.getElementById('hotel_img');
        if (hotelImageInput) {
            hotelImageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('hotelImgPreview');
                    const placeholder = document.getElementById('hotelImgPlaceholder');
                    if (preview) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            });
        }

        /* ─────────────────────────────────────────────
         * 2. Modal ยืนยันการลบ (สำหรับหน้า List)
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
         * 3. Input รับเฉพาะตัวเลข (สำหรับฟิลด์ลำดับ หรือจำนวนรูป)
         * ───────────────────────────────────────────── */
        document.querySelectorAll('.input-order, input[name="rooms_gallery_count"]').forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        /* ─────────────────────────────────────────────
         * 4. จัดการ Tabs และ Step (หน้า Add/Edit)
         * ───────────────────────────────────────────── */
        const STORAGE_KEY = "currentHotelStepTab";

        // ฟังก์ชันย้าย Step (Global เพื่อให้ปุ่มใน HTML เรียกได้)
        window.goToStep = function(step) {
            let tabElement = document.querySelector('#stepTabs a[href="#step' + step + '"]');
            if (tabElement) {
                // ใช้ bootstrap framework ในการสลับ tab
                let tabTrigger = new bootstrap.Tab(tabElement);
                tabTrigger.show();
                
                // เลื่อนหน้าจอขึ้นไปด้านบนของฟอร์มเพื่อให้เห็นความเปลี่ยนแปลง
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        };

        // เมื่อโหลดหน้าเว็บเสร็จ
        document.addEventListener('DOMContentLoaded', function() {
            const stepTabs = document.getElementById('stepTabs');
            
            if (stepTabs) {
                // ล้างค่าใน SessionStorage ทุกครั้งที่โหลดหน้าใหม่ (Refresh) 
                // เพื่อให้กลับไปเริ่มต้นที่ Step 1 (ภาษาไทย) เสมอตามเงื่อนไข
                sessionStorage.removeItem(STORAGE_KEY);

                // เซ็ตค่าเริ่มต้นแสดง Step 1
                let firstTab = document.querySelector('#stepTabs a[href="#step1"]');
                if (firstTab) {
                    new bootstrap.Tab(firstTab).show();
                    const currentStepText = document.getElementById('currentStep');
                    if (currentStepText) currentStepText.innerText = '1';
                }

                // บันทึกสถานะเมื่อมีการเปลี่ยน Tab (คลิกที่ Tab โดยตรง)
                const tabLinks = stepTabs.querySelectorAll('a[data-bs-toggle="tab"]');
                tabLinks.forEach(tab => {
                    tab.addEventListener('shown.bs.tab', function(e) {
                        let targetHref = e.target.getAttribute("href");
                        let stepNumber = targetHref.replace('#step', '');
                        
                        // อัปเดตตัวเลข Step ที่แสดงบน UI
                        const currentStepText = document.getElementById('currentStep');
                        if (currentStepText) {
                            currentStepText.innerText = stepNumber;
                        }
                        
                        // เก็บค่าลง Storage ชั่วคราว (เผื่อกรณีต้องการใช้)
                        sessionStorage.setItem(STORAGE_KEY, targetHref);
                    });
                });
            }
        });

    })();
</script>
