<?php
$auth          = $this->session->userdata('_auth');
$my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
$admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

$hotels = [];
if ($my_permission === 1) {
} else {
	$CI = &get_instance();
	$CI->load->model('admin/HotelModel', 'hotel_model');
	$CI->load->model('admin/GalleryModel', 'gallery_model');
	$permitted = $CI->hotel_model->getPermittedHotelIds($admin_id);
	if (!empty($permitted)) {
		$hotels = $CI->hotel_model->getHotelsByIds($permitted);
	}
}
if ($my_permission !== 1 && !empty($hotels)) {
	foreach ($hotels as $hotel) {
		$hid = $hotel['hotel_id'];
		$menuArr[] = [
			'slug'       => 'hotel_' . $hid,
			'label'      => htmlspecialchars($hotel['title_th']),
			'icon'       => '<i class="fas fa-hotel"></i>',
			'url'        => '#',
			'permission' => [2],
			'submenu'    => [
				[
					'slug' => 'slide_other_' . $hid,
					'label' => 'แบนเนอร์',
					'icon'  => '<i class="fas fa-images me-1"></i>',
					'url'   => admin_url('slideother/index/' . $hid),
				],
				[
					'slug'    => 'home_' . $hid,
					'label'   => 'Home',
					'icon'    => '<i class="fas fa-home me-1"></i>',
					'url'     => '#',
					'submenu' => [
						[
							'slug'  => 'hotelhomeimage_' . $hid,
							'label' => 'Hotel Banner Img',
							'icon'  => '<i class="fas fa-window-restore me-1"></i>',
							'url'   => admin_url('hotelbannnerimage/index/' . $hid),
						],
						[
							'slug'  => 'hotelhomebanner_' . $hid,
							'label' => 'Hotel Banner',
							'icon'  => '<i class="fas fa-window-restore me-1"></i>',
							'url'   => admin_url('hotelhomebanner/index/' . $hid),
						],
						[
							'slug'  => 'hotelhomerooms_' . $hid,
							'label' => 'Hotel Rooms',
							'icon'  => '<i class="fas fa-window-restore me-1"></i>',
							'url'   => admin_url('hotelhomerooms/index/' . $hid),
						],
						[
							'slug'  => 'hotelhomefacilities_' . $hid,
							'label' => 'Hotel Gallery & Facilities',
							'icon'  => '<i class="fas fa-concierge-bell me-1"></i>',
							'url'   => admin_url('hotelhomefacilities/index/' . $hid),
						],
					],
				],
				[
					'slug'  => 'footer' . $hid,
					'label' => 'เนื้อหา Footer',
					'icon'  => '<i class="fa-solid fa-address-book"></i>',
					'url'   => admin_url('footer/index/' . $hid),
				],
				[
					'slug'  => 'room_' . $hid,
					'label' => 'ห้องพัก',
					'icon'  => '<i class="fas fa-bed me-1"></i>',
					'url'   => admin_url('room/index/' . $hid),
				],

				[
					'slug' => 'facility_' . $hid,
					'label' => 'สิ่งอำนวยความสะดวก',
					'icon'  => '<i class="fas fa-concierge-bell me-1"></i>',
					'url'   => admin_url('facility/index/' . $hid),
				],
				(function () use ($CI, $hid) {
					$cats = $CI->gallery_model->getCategoriesByHotel($hid);
					$sub  = [];
					foreach ($cats as $cat) {
						$label = htmlspecialchars($cat['name_th'] ?? '');
						if (!empty($cat['name_en'])) {
							$label .= ' (' . htmlspecialchars($cat['name_en']) . ')';
						}
						$sub[] = [
							'slug'  => 'gallery_cat_' . $cat['category_id'],
							'label' => $label,
							'icon'  => '<i class="fas fa-folder me-1"></i>',
							'url'   => admin_url('gallery/category/' . $hid . '/' . $cat['category_id']),
						];
					}
					return [
						'slug'    => 'gallery_' . $hid,
						'label'   => 'แกลลอรี่',
						'icon'    => '<i class="fas fa-images me-1"></i>',
						// ถ้าไม่มี category → ไปหน้า gallery ตรงๆ, ถ้ามี → toggle dropdown
						'url'     => empty($sub) ? admin_url('gallery/index/' . $hid) : '#',
						'submenu' => $sub,
					];
				})(),
				[
					'slug' => 'contact' . $hid,
					'label' => 'คอนแทค',
					'icon'  => '<i class="fas fa-envelope me-1"></i>',
					'url'   => admin_url('contact/index/' . $hid),
				],

			],
		];
	}
} else {
	// Super Admin เห็นแบบเดิม
	$menuArr = [
		[
			'slug'       => 'dashboard',
			'label'      => 'หน้าหลัก',
			'icon'       => '<i class="fas fa-chart-bar"></i>',
			'url'        => admin_url(),
			'permission' => [1, 2]
		],
		[
			'slug'       => 'admin',
			'label'      => 'แอดมิน',
			'icon'       => '<i class="fas fa-users-cog"></i>',
			'url'        => admin_url('admin'),
			'permission' => [1]
		],
		[
			'slug'       => 'banner',
			'label'      => 'แบนเนอร์',
			'icon'       => '<i class="fas fa-images"></i>',
			'url'        => admin_url('banner'),
			'permission' => [1]
		],
		[
			'slug'       => 'hotel',
			'label'      => 'โรงแรม',
			'icon'       => '<i class="fas fa-hotel"></i>',
			'url'        => admin_url('hotel'),
			'permission' => [1]
		],
		[
			'slug'       => 'title',
			'label'      => 'คำอธิบายหน้าแรก',
			'icon'       => '<i class="fas fa-heading"></i>',
			'url'        => '#',
			'permission' => [1],
			'submenu'    => [
				[
					'slug'  => 'title_big',
					'label' => 'เนื้อหาใต้แบนเนอร์',
					'icon'  => '<i class="fas fa-align-left me-1"></i>',
					'url'   => admin_url('title'),
				],
				[
					'slug'  => 'title_sub',
					'label' => 'เนื้อหาส่วนท้าย',
					'icon'  => '<i class="fas fa-align-left me-1"></i>',
					'url'   => admin_url('title/subtitle'),
				],
			],
		],
	];
}
?>

<style>
	/* active menu main */
	.sidebar-wrapper .menu .sidebar-item.active .sidebar-link {
		background-color: #d1d1d1;
	}

	.sidebar-wrapper .menu .sidebar-item.active .sidebar-link span {
		color: #000;
	}

	.sidebar-wrapper .menu .sidebar-item.active .sidebar-link i,
	.sidebar-wrapper .menu .sidebar-item.active .sidebar-link svg {
		color: #000;
	}

	/* underline color */
	.sidebar-link::after {
		background-color: #4f4f4f;
	}

	/* active sub menu */
	.sidebar-wrapper .menu .submenu .submenu-item.active>a {
		background-color: #ffffff;
		border: 1px solid #48484826;
	}

	/* indent ชั้น 3 */
	.submenu .submenu-item .submenu {
		padding-left: 15px;
	}

	/* submenu ชั้น 2 ที่มี sub ซ้อน */
	.submenu .submenu-item.has-sub>a {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	/* active ชั้น 3 */
	.submenu .submenu-item .submenu .submenu-item.active>a {
		background-color: #ffffff;
		border: 1px solid #48484826;
		border-radius: 4px;
	}

	/* hover ชั้น 3 */
	.submenu .submenu-item .submenu .submenu-item>a:hover {
		background-color: #f0f0f0;
		border-radius: 4px;
	}

	/* ให้ Home (has-sub) ค้างเปิดเมื่อ active ชั้น 3 */
	.submenu .submenu-item.has-sub.open>ul.submenu,
	.submenu .submenu-item.has-sub>ul.submenu.active {
		display: block;
	}

	/* เพิ่มใน <style> ที่มีอยู่แล้ว */

	/* ให้ submenu ชั้น 3 animate แบบเดียวกับชั้น 1→2 */
	.submenu .submenu-item.has-sub>ul.submenu {
		display: block;
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.6s ease;
		/* ← smooth */
	}

	.submenu .submenu-item.has-sub.open>ul.submenu {
		max-height: 500px;
	}
</style>

<?php
// helper เช็ค active ลึกถึงชั้น 3
function hasActiveDeep($submenuArr, $menu_slug)
{
	foreach ($submenuArr as $sub) {
		if ($sub['slug'] == $menu_slug) return true;
		if (!empty($sub['submenu'])) {
			foreach ($sub['submenu'] as $sub2) {
				if ($sub2['slug'] == $menu_slug) return true;
			}
		}
	}
	return false;
}
?>

<div id="sidebar" class="active">
	<div class="toggler">
		<a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
	</div>
	<div class="sidebar-wrapper active">
		<div class="sidebar-header">
			<div class="d-flex justify-content-center">
				<div class="logo text-center">
					<a href="<?= admin_url(); ?>">
						<img src="<?= base_url('assets/images/logo/logo.png') ?>" class="img-fluid" style="width: 70%;" alt="Logo" srcset="">
					</a>
				</div>
			</div>
		</div>
		<div class="sidebar-menu">
			<ul class="menu">
				<hr>
				<?php foreach ($menuArr as $menu): ?>

					<?php if (isset($menu['permission']) && in_array($my_permission, $menu['permission'])): ?>

						<?php $menuActive = $menu_slug == $menu['slug'] || (!empty($menu['submenu']) && hasActiveDeep($menu['submenu'], $menu_slug)); ?>

						<li class="sidebar-item <?= $menuActive ? 'active' : '' ?> <?= !empty($menu['submenu']) ? 'has-sub' : '' ?>">
							<a href="<?= isset($menu['url']) ? $menu['url'] : '#' ?>" class='sidebar-link'>
								<?= $menu['icon'] ?>
								<span><?= $menu['label'] ?></span>
								<?php if (!empty($menu['submenu'])): ?>
									<i class="submenu-arrow fas fa-chevron-down"></i>
								<?php endif; ?>
							</a>

							<?php if (!empty($menu['submenu'])): ?>
								<?php $submenuOpen = hasActiveDeep($menu['submenu'], $menu_slug); ?>
								<ul class="submenu <?= $submenuOpen ? 'active' : '' ?>">
									<?php foreach ($menu['submenu'] as $submenu): ?>

										<?php $subActive = $menu_slug == $submenu['slug'] || (!empty($submenu['submenu']) && in_array($menu_slug, array_column($submenu['submenu'], 'slug'))); ?>

										<li class="submenu-item <?= $subActive ? 'active' : '' ?> <?= !empty($submenu['submenu']) ? 'has-sub' : '' ?> <?= $subActive && !empty($submenu['submenu']) ? 'open' : '' ?>">
											<a href="<?= isset($submenu['url']) ? $submenu['url'] : '#' ?>">
												<span>
													<?php if (!empty($submenu['icon'])): ?>
														<?= $submenu['icon'] ?>
													<?php endif; ?>
													<?= $submenu['label'] ?>
												</span>
												<?php if (!empty($submenu['submenu'])): ?>
													<i class="fas fa-chevron-down ms-auto"></i>
												<?php endif; ?>
											</a>

											<?php if (!empty($submenu['submenu'])): ?>
												<!-- <ul class="submenu <?= in_array($menu_slug, array_column($submenu['submenu'], 'slug')) ? 'active' : '' ?>"> -->
													<ul class="submenu">
													<?php foreach ($submenu['submenu'] as $submenu2): ?>
														<li class="submenu-item <?= ($menu_slug == $submenu2['slug']) ? 'active' : '' ?>">
															<a href="<?= $submenu2['url'] ?>">
																<span>
																	<?php if (!empty($submenu2['icon'])): ?>
																		<?= $submenu2['icon'] ?>
																	<?php endif; ?>
																	<?= $submenu2['label'] ?>
																</span>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>

										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</li>

					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
	</div>

	<script>
		document.querySelectorAll('.submenu .submenu-item.has-sub > a').forEach(function(el) {
			el.addEventListener('click', function(e) {
				var href = this.getAttribute('href') || '';
				if (href !== '#' && href !== '' && href !== 'javascript:void(0)') {
					return;
				}
				e.preventDefault();
				e.stopPropagation();

				var li = this.closest('.submenu-item.has-sub');
				var isOpen = li.classList.contains('open');

				// ปิด sibling ทุกตัวในระดับเดียวกันก่อน
				var siblings = li.parentElement.querySelectorAll(':scope > .submenu-item.has-sub');
				siblings.forEach(function(sib) {
					if (sib !== li) {
						sib.classList.remove('open');
					}
				});

				// แล้วค่อย toggle ตัวเอง
				li.classList.toggle('open', !isOpen);
			});
		});
	</script>

</div>
