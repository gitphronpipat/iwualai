<style>
    .hotel-description strong {
        color: #495057;
    }
    .amenity-badge {
        font-size: 0.75rem;
        padding: 4px 8px;
        margin: 2px;
        display: inline-block;
    }
    .rooms-description strong {
        color: #495057;
    }

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
</style>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="page-heading">
                <div class="row">
                    <div class="col-6">
                        <h3>จัดการข้อมูลห้องพัก</h3>
                    </div>
                    <div class="col-6 text-end">
                        <a href="<?= admin_url('room/add'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มห้องพัก</a>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <form action="<?= admin_url('room'); ?>" method="post">

                    <input type="hidden" name="order" value="submit-order">

                    <div class="card shadow-sm">
                        <div class="card-body px-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center" width="4%">ลำดับ</th>
                                            <th scope="col" class="text-center" width="13%">รูปภาพห้องพัก</th>
                                            <th scope="col" class="text-center" width="17%">ข้อมูลห้องพัก (TH)</th>
                                            <th scope="col" class="text-center" width="17%">ข้อมูลห้องพัก (EN)</th>
                                            <th scope="col" class="text-center" width="22%">สิ่งอำนวยความสะดวก</th>
                                            <th scope="col" class="text-center" width="15%">ลำดับ / สถานะ</th>
                                            <th scope="col" class="text-center" width="12%">แก้ไข / ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($rooms)): ?>
                                            <?php
                                            $num = 0;
                                            foreach ($rooms as $room):
                                                $num++;
                                                $amenities = isset($amenities_map[$room['room_id']]) ? $amenities_map[$room['room_id']] : [];
                                                $isDisabled = $room['status'] == 0;
                                            ?>
                                                <tr <?= $isDisabled ? 'class="row-disabled"' : ''; ?>>
                                                    <td class="text-center align-middle"><?= $num; ?></td>

                                                    <td class="text-center align-middle">
                                                        <?php if (!empty($room['banner_image'])): ?>
                                                            <a href="<?= base_url('uploads/room/' . $room['banner_image']); ?>" class="img-link">
                                                                <img src="<?= base_url('uploads/room/' . $room['banner_image']); ?>"
                                                                    width="120"
                                                                    class="img-thumbnail rounded <?= $isDisabled ? 'img-disabled' : ''; ?>">
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-muted">ไม่มีรูปภาพ</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <h6 class="mb-1 fw-bold text-primary"><?= !empty($room['title_th']) ? htmlspecialchars($room['title_th']) : '-'; ?></h6>
                                                        <?php if (!empty($room['subtitle_th'])): ?>
                                                            <small class="text-muted"><?= htmlspecialchars($room['subtitle_th']); ?></small>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <h6 class="mb-1 fw-bold text-secondary"><?= !empty($room['title_en']) ? htmlspecialchars($room['title_en']) : '-'; ?></h6>
                                                        <?php if (!empty($room['subtitle_en'])): ?>
                                                            <small class="text-muted"><?= htmlspecialchars($room['subtitle_en']); ?></small>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <?php if (!empty($amenities)): ?>
                                                            <ol class="mb-0 ps-3">
                                                                <?php foreach ($amenities as $amenity): ?>
                                                                    <li class="small"><?= htmlspecialchars($amenity['name'] ?? '-'); ?></li>
                                                                <?php endforeach; ?>
                                                            </ol>
                                                        <?php else: ?>
                                                            <span class="text-muted small">ยังไม่มีข้อมูล</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="align-middle">
                                                        <div class="d-flex justify-content-center input-group px-2">
                                                            <input type="hidden" name="id[]" value="<?= $room['room_id']; ?>">
                                                            <input type="text" class="form-control form-control-sm input-order" name="order_data[]" value="<?= $room['sort_order']; ?>" inputmode="numeric">
                                                            <?php if ($room['status'] == 1): ?>
                                                                <a href="<?= admin_url('room/status/') . $room['room_id']; ?>/0" class="form-control btn btn-info btn-sm pt-2" title="Show"><i class="fa fa-desktop"></i></a>
                                                            <?php else: ?>
                                                                <a href="<?= admin_url('room/status/') . $room['room_id']; ?>/1" class="form-control btn btn-danger btn-sm pt-2" title="Not Show"><i class="fa fa-eye-slash"></i></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>

                                                    <td class="align-middle">
                                                        <div class="d-flex justify-content-center input-group input-group-edit px-2">
                                                            <a href="<?= admin_url('room/edit/') . $room['room_id']; ?>" class="btn btn-warning btn-sm px-3" title="แก้ไขข้อมูลหลัก">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a type="button" class="btn btn-danger btn-sm px-3"
                                                                data-bs-toggle="modal" data-bs-target="#modalDel"
                                                                data-id="<?= $room['room_id']; ?>"
                                                                data-url="<?= admin_url('room/delete/') . $room['room_id']; ?>">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">ยังไม่มีข้อมูลห้องพัก</td>
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

