<div id="carouselExampleFade2" class="carousel slide " data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner">
						<?php foreach ($banners as $index => $banner) : ?>
									<div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
										<img src="<?= base_url($banner['image']) ?>" alt="" width="100%">
									</div>
								<?php endforeach; ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade2" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade2" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>


