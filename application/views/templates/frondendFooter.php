<!-- Modal Tambah Keluhan -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalLabel">Form Pelanggan</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close"></button>
			</div>
			<form method="post" id="formData">
				<input type="hidden" name="kd_responden" id="kd_responden">
				<input type="hidden" id="validasi" name="validasi">
				<div class="card-body">
					<div id="progressbarwizard">

						<ul class="nav nav-pills nav-justified form-wizard-header mb-3">
							<li class="nav-item">
								<a href="#pelanggan" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-account me-1"></i>
									<span class="d-none d-sm-inline">Pelanggan</span>
								</a>
							</li>
							<?php
							foreach ($tes as $t) : ?>
								<li class="nav-item">
									<a href="#kriteria<?= $t['kd_tes']; ?>" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-file-document me-1"></i>
										<span class="d-none d-sm-inline"><?= $t['kriteria']; ?></span>
									</a>
								</li>
							<?php
							endforeach; ?>
							<li class="nav-item">
								<a href="#finish" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success"></i>
									<span class="d-none d-sm-inline">Finish</span>
								</a>
							</li>
						</ul>

						<div class="tab-content b-0 mb-0">

							<div id="bar" class="progress mb-3" style="height: 7px;">
								<div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success">
								</div>
							</div>

							<!-- DATA 1 -->
							<!-- ################################################################################################################################# -->
							<div class="tab-pane" id="pelanggan">
								<div class="row">
									<div class="col-12">

										<div class="form-floating mb-2">
											<div class="row">
												<div class="col-6">
													<label for="form-control">Nama Depan</label>
													<input type="text" class="form-control input input1" name="namad" id="namad" placeholder="Masukan Nama Depan" />
												</div>
												<div class="col-6">
													<label for="form-control">Nama Belakang</label>
													<input type="text" class="form-control input input2" name="namab" id="namab" placeholder="Masukan Nama Belakang" />
												</div>
											</div>
										</div>

										<div class="form-floating mb-2">
											<label for="form-control">No HP</label>
											<input type="number" class="form-control input input3" name="nohp" id="nohp" min="0" placeholder="Masukan Nomer HP" />
										</div>

										<div class="form-floating mb-2">
											<label for="form-control">Email</label>
											<input type="email" class="form-control input input4" name="email" id="email" placeholder="Masukan Email" />
										</div>

										<div class="form-floating mb-2">
											<label for="form-control">Alamat</label>
											<textarea class="form-control input input5" name="alamat" id="alamat" cols="30" rows="5" placeholder="Masukan Almat"></textarea>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

							<!-- DATA 2 -->
							<!-- ################################################################################################################################# -->
							<?php
							foreach ($tes as $t) : ?>
								<div class=" tab-pane" id="kriteria<?= $t['kd_tes']; ?>">
									<div class="row">
										<div class="col-12">

											<?php
											$n = 1;
											foreach ($soal as $s) :
												if ($t['kd_tes'] == $s['kd_tes']) :
													if ($s['status'] == 1) : ?>
														<div class="form-floating mb-3">
															<label for="form-control">
																<h4><?= $n; ?>. <?= $s['soal']; ?></h4>
															</label>

															<?php foreach ($bobot as $b) :
																if ($b['status'] == 1) : ?>
																	<div class="form-check">
																		<input class="form-check-input" type="radio" name="1<?= $s['kd_soal']; ?><?= $s['kd_tes']; ?>" id="<?= $s['kd_soal']; ?><?= $s['kd_tes']; ?>" value="<?= $b['nilai_bobot']; ?>">
																		<label class="form-check-label" for="<?= $b['nilai_bobot']; ?>">
																			<?= $b['bobot']; ?>
																		</label>
																	</div>
															<?php
																endif;
															endforeach; ?>

														</div>
											<?php
														$n++;
													endif;
												endif;
											endforeach; ?>

										</div> <!-- end col -->
									</div> <!-- end row -->
								</div>
							<?php endforeach; ?>

							<div class="tab-pane" id="finish">
								<div class="row">
									<div class="col-12">
										<div class="text-center">
											<h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
											<h3 class="mt-0">Terima Kasih !</h3>

											<p class="w-75 mb-2 mx-auto">Jika ada data belum yakin mohon dichek kembali dan jika data masih kosong anda Harus di
												isi data tersebut.</p>

											<div class="mb-3">
												<div class="form-check d-inline-block">
													<input type="checkbox" class="form-check-input" id="customCheck3">
													<label class="form-check-label" for="customCheck3">Saya setuju
														upload data ini selesai</label>
												</div>
											</div>
										</div>
									</div> <!-- end col -->
									<div class="col-9"></div>
									<div class="col-3 mb-3">
										<button type="button" class="btn btn-secondary align-items-end" data-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-primary align-items-end" id="submit-data-form-pelanggan">Kirim</button>
									</div>
								</div> <!-- end row -->
							</div>

							<ul class="list-inline mb-0 wizard modal-footer">
								<li class="previous list-inline-item">
									<a href="#" class="btn btn-info">Previous</a>
								</li>
								<li class="next list-inline-item float-end">
									<a href="#" class="btn btn-info">Next</a>
								</li>
							</ul>

						</div> <!-- tab-content -->
					</div> <!-- end #progressbarwizard-->
				</div>
			</form>
		</div>
	</div>
</div>

<!-- ======= Footer ======= -->
<footer id="footer">
	<div class="container footer-bottom clearfix">
		<div class="copyright">
			&copy; Copyright <strong><span><a href="https://msha.ke/infolebih" class="text-white">SIKAPIDOR</a> 2020</span></strong> <br>
			<i class="mdi mdi-instagram"><a href="https://www.instagram.com/sayaka.eo/?hl=en" class="text-white">&nbsp;𝐒𝐀𝐘𝐀𝐊𝐀 𝐓𝐇𝐄 𝐎𝐑𝐆𝐀𝐍𝐈𝐙𝐄𝐑 </a></i> &nbsp;
			<i class="mdi mdi-earth"></i><a href="https://msha.ke/infolebih" class="text-white">&nbsp;𝐒𝐀𝐘𝐀𝐊𝐀 𝐓𝐇𝐄 𝐎𝐑𝐆𝐀𝐍𝐈𝐙𝐄𝐑</a>
		</div>
		<div class="credits">
			Created by <Strong><b>TARA JOSEPHINE</b></Strong>
		</div>
	</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?= base_url(); ?>assets/frontend/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/venobox/venobox.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/frontend/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url(); ?>assets/frontend/js/main.js"></script>

<!-- bundle -->
<script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>

<!-- Typehead -->
<script src="<?= base_url(); ?>assets/js/vendor/handlebars.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/typeahead.bundle.min.js"></script>

<!-- Demo -->
<script src="<?= base_url(); ?>assets/js/pages/demo.typehead.js"></script>

<!-- Timepicker -->
<script src="<?= base_url(); ?>assets/js/pages/demo.timepicker.js"></script>

<!-- third party js -->
<script src="<?= base_url(); ?>assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.bootstrap5.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.keyTable.min.js"></script>
<script src="<?= base_url(); ?>assets/js/vendor/dataTables.select.min.js"></script>

<!-- sweetalert -->
<script src="<?= base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

<!-- demo app -->
<script src="<?= base_url(); ?>assets/js/pages/demo.form-wizard.js"></script>
<!-- end demo js-->

<!-- demo app -->
<script src="<?= base_url(); ?>assets/js/pages/demo.datatable-init.js"></script>
<!-- end demo js-->

<script src="<?= base_url(); ?>assets/js/script.js"></script>

</body>

</html>
