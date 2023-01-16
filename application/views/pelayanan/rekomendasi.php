<!-- ======= Skills Section ======= -->
<section id="skills" class="skills mt-5">
	<div class="container" data-aos="fade-up">

		<div class="row">
			<div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
				<img src="<?= base_url(); ?>assets/frontend/img/skills.png" class="img-fluid" alt="">
			</div>
			<div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
				<h3>Rekomendasi Pilihan Paket Yang Cocok Untuk Kamu</h3>
				<p class="font-italic">
					Hasil rekomendasi ini hanya untuk membantu kamu agar tidak bingung dalam mengambil keputusan paket
					yang akan kamu ambil, selebihnya semua ada dikeputusan kamu
				</p>

				<div class="skills-content">

					<?php foreach ($spk as $s) :
						foreach ($paket as $p) :
							if ($s['kd_paket'] == $p['kd_paket']) :
							$nilai = $s['totalNilai'] / count($spk);
							?>
							<?php if($nilai <= 100 ): ?>
								<div class="progress">
									<span class="skill"><?= $p['paket']; ?> <i class="val"></i></span>
									<div class="progress-bar-wrap">
										<div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?= $nilai; ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							<?php elseif($nilai >= 50): ?>
								<div class="progress">
									<span class="skill"><?= $p['paket']; ?> <i class="val"></i></span>
									<div class="progress-bar-wrap">
										<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="<?= $nilai; ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							<?php endif; ?>

								<div class="col-lg-12 mt-4">
									<div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
										<div class="member-info">
											<h4><?= $p['paket']; ?></h4>
											<div class="row">
												<p class="col-lg-6 mb-2"><strong><?= rupiah($p['harga']); ?></strong></p>
												<p class="col-lg-6 mb-2">Harga Pervendor</p>
											</div>
											<div class="row">
												<p class="col-lg-6">Jumlah Kru : <strong><?= $p['kru']; ?></strong></p>
												<p class="col-lg-6"><strong><?= rupiah($p['harga_wo']); ?></strong></p>
											</div>
											<div class="row">
												<p class="col-lg-6"><?= $p['dekorasi']; ?></p>
												<p class="col-lg-6"><strong><?= rupiah($p['harga_dekorasi']); ?></strong></p>
											</div>
											<div class="row">
												<p class="col-lg-6"><?= $p['brp']; ?></p>
												<p class="col-lg-6"><strong><?= rupiah($p['harga_brp']); ?></strong></p>
											</div>
											<div class="row">
												<p class="col-lg-6"><?= $p['catering']; ?></p>
												<p class="col-lg-6"><strong><?= rupiah($p['harga_catering']); ?></strong></p>
											</div>
											<div class="row">
												<p class="col-lg-6"><?= $p['dokumentasi']; ?></p>
												<p class="col-lg-6"><strong><?= rupiah($p['harga_dokumentasi']); ?></strong></p>
											</div>
											<div class="row">
												<p class="col-lg-6"><?= $p['ah']; ?></p>
												<p class="col-lg-6"><strong><?= rupiah($p['harga_ah']); ?></strong></p>
											</div>
											<div class="row">
												<p class="col-lg-6">Jumalah Tamu</p>
												<p class="col-lg-2"><strong><?= angkaa($p['jumlah_tamu']); ?></strong></p>
												<p class="col-lg-1">-</p>
												<p class="col-lg-2"><strong><?= angkaa($p['jumlah_tamu2']); ?></strong></p>
											</div>
										</div>
									</div>
								</div>
					<?php endif;
						endforeach;
					endforeach; ?>
				</div>

			</div>
		</div>

	</div>
</section><!-- End Skills Section -->
