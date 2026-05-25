<style>
    tr.row-disabled {
        background-color: #f0f0f0 !important;
        opacity: 0.7;
    }

    tr.row-disabled td {
        color: #999 !important;
    }

    img.img-disabled {
        filter: grayscale(100%);
        opacity: 0.5;
    }

    a.img-link {
        display: inline-block;
        transition: opacity 0.2s ease-in-out;
    }

    a.img-link:hover {
        opacity: 0.8;
    }

    a.img-link img {
        cursor: pointer;
    }

    /* จัดการ z-index ให้ plugin ดูรูปภาพอยู่หน้า Modal */
    .fancybox-container,
    .fancybox__container {
        z-index: 9999 !important;
    }

    #lightboxOverlay {
        z-index: 9998 !important;
    }

    #lightbox {
        z-index: 9999 !important;
    }

    .mfp-bg {
        z-index: 9998 !important;
    }

    .mfp-wrap {
        z-index: 9999 !important;
    }
</style>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="page-heading">
                <div class="row">
                    <div class="col-6">
                        <h3>ตั้งค่า Banner</h3>
                    </div>
                    <div class="col-6 text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddBanner">
                            <i class="fas fa-plus"></i> เพิ่ม Banner
                        </button>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <form action="<?= admin_url('banner'); ?>" method="post">

                    <input type="hidden" name="order" value="submit-order">

                    <div class="card shadow-sm">
                        <div class="card-body px-4">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center" width="10%">ลำดับ</th>
                                            <th scope="col" class="text-center">รูปภาพ Banner</th>
                                            <th scope="col" class="text-center" width="20%">ลำดับ / สถานะ</th>
                                            <th scope="col" class="text-center" width="15%">แก้ไข / ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($banners)):
                                            $num = 0;
                                            foreach ($banners as $banner):
                                                $num++;
                                        ?>
                                                <tr class="<?= $banner['status'] == 0 ? 'row-disabled' : ''; ?>">
                                                    <td class="text-center align-middle"><?= $num; ?></td>
                                                    <td class="text-center align-middle">
                                                        <?php if (!empty($banner['image'])): ?>
                                                            <a href="<?= base_url($banner['image']); ?>" class="img-link" data-fancybox="gallery">
                                                                <img src="<?= base_url($banner['image']); ?>" width="150" alt="Banner Image"
                                                                    class="<?= $banner['status'] == 0 ? 'img-disabled' : ''; ?>">
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-muted">ไม่มีรูปภาพ</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center input-group px-2">
                                                            <input type="hidden" name="id[]" value="<?= $banner['banner_id']; ?>">
                                                            <input type="text" class="form-control form-control-sm input-order" name="order_data[]" value="<?= $banner['sort_order']; ?>" inputmode="numeric">
                                                            <?php if ($banner['status'] == 1): ?>
                                                                <a href="<?= admin_url('banner/status/') . $banner['banner_id']; ?>/0" class="form-control btn btn-info btn-sm pt-2" title="Show"><i class="fa fa-desktop"></i></a>
                                                            <?php else: ?>
                                                                <a href="<?= admin_url('banner/status/') . $banner['banner_id']; ?>/1" class="form-control btn btn-danger btn-sm pt-2" title="Not Show"><i class="fa fa-eye-slash"></i></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="d-flex justify-content-center input-group input-group-edit px-2">
                                                            <button type="button" class="btn btn-warning btn-sm px-3"
                                                                data-bs-toggle="modal" data-bs-target="#modalEditBanner"
                                                                data-id="<?= $banner['banner_id']; ?>"
                                                                data-img="<?= base_url($banner['image']); ?>"
                                                                title="แก้ไข">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <a type="button" class="btn btn-danger btn-sm px-3"
                                                                data-bs-toggle="modal" data-bs-target="#modalDel"
                                                                data-id="<?= $banner['banner_id']; ?>"
                                                                data-url="<?= admin_url('banner/del/') . $banner['banner_id']; ?>">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        else:
                                            ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">ยังไม่มีข้อมูล Banner</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <td colspan="11" align="right">
                                                <div class="py-2">
                                                    <button class="btn btn-success btn-sm px-3 py-2" name="order"
                                                        value="submit-order">เรียงข้อมูล / Sort</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalAddBanner" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= admin_url('banner/create'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2 text-primary"></i> เพิ่ม Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="fw-bold">รูปภาพ Banner
                            <small class="text-muted fw-normal">(ขนาด 1920 × 920 px)</small>
                        </label>
                        <input type="file" name="banner_img" id="banner_img_add" class="image-crop-filepond mt-2" required>
                        <img id="addBannerPreview" src="" width="200" class="mt-2 rounded border" style="display:none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success px-4"><i class="fas fa-save me-1"></i> บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditBanner" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEditBanner" action="" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2 text-warning"></i> แก้ไข Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">รูปภาพปัจจุบัน:</label><br>
                        <a href="#" class="img-link" id="editBannerLink" data-fancybox="gallery">
                            <img id="editBannerPreview" src="" width="200" class="mt-2 rounded border shadow-sm">
                        </a>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">เลือกรูปภาพใหม่
                            <small class="text-muted fw-normal">(ขนาด 1920 × 920 px)</small>
                        </label>
                        <input type="file" name="banner_img" id="banner_img_edit" class="image-crop-filepond mt-2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-warning px-4"><i class="fas fa-save me-1"></i> อัปเดต</button>
                </div>
            </form>
        </div>
    </div>
</div>

