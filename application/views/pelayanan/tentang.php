<!-- ======= Tentang Program ======= -->
<section id="team" class="team section-bg mt-5">
	<div class="container" data-aos="fade-up">

		<div class="section-title">
			<h2>Tentang Paket Wedding</h2>
			<p>Pilihlah Dekorasi yang sesuai kamu suka, karena pilahanmu saat ini adalah impianmu di saat acara nanti</p>
		</div>

		<div class="row">

			<?php foreach ($paket as $p) : ?>
				<div class="col-lg-6 mt-4">
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
			<?php endforeach; ?>

		</div>
	</div>
</section><!-- End Team Section -->
