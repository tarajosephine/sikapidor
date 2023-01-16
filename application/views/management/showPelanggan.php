<!-- Start Content-->
<div class="container-fluid">
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<form class="d-flex">
						<div class="input-group">
							<input type="text" class="form-control form-control-light" id="dash-daterange">
							<span class="input-group-text bg-primary border-primary text-white">
								<i class="mdi mdi-calendar-range font-13"></i>
							</span>
						</div>
					</form>
				</div>
				<h4 class="page-title">Detail Pelanggan</h4>
			</div>
		</div>
	</div>

	<!-- end page title -->
	<div class="row">
		<div class="col-xxl-8 col-xl-7">
			<!-- project card -->
			<div class="card d-block">
				<div class="card-body">

					<div class="clearfix"></div>
					<!-- item-->
					<!-- <button class="btn btn-info" data-toggle="modal" data-target="#inputModal" data-id="<?= $pelanggan['kd_pelanggan']; ?>" onclick="showPaket('<?= $pelanggan['kd_pelanggan']; ?>')"><i class="mdi mdi-pencil me-1"></i> Edit Paket </button> -->

					<h3 class="mt-3">Detail Responden</h3>

					<div class="row">
						<div class="col-6">
							<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Nama Lengkap</p>
							<div class="d-flex">
								<i class='mdi mdi-account font-18 text-info me-1'></i>
								<h5 class="mt-1 font-14">
									<?= $pelanggan['nama']; ?>
								</h5>
							</div>
						</div>

						<div class="col-6">
							<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">No HP</p>
							<div class="d-flex">
								<i class='mdi mdi-cellphone-iphone font-18 text-info me-1'></i>
								<h5 class="mt-1 font-14">
									<?= $pelanggan['no_hp']; ?>
								</h5>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-6">
							<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Email</p>
							<div class="d-flex">
								<i class='mdi mdi-email font-18 text-info me-1'></i>
								<h5 class="mt-1 font-14">
									<?= $pelanggan['email']; ?>
								</h5>
							</div>
						</div>

						<div class="col-6">
							<p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Alamat</p>
							<div class="d-flex">
								<i class='mdi mdi-home font-18 text-info me-1'></i>
								<h5 class="mt-1 font-14">
									<?= $pelanggan['alamat']; ?>
								</h5>
							</div>
						</div>
					</div>

				</div> <!-- end card-body-->

			</div> <!-- end card-->
		</div> <!-- end col -->
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">

					<h4 class="header-title">Pertanyaan Responden Dan Nilai</h4>
					<p class="text-muted font-14">
						Menu ini digunakan untuk data Pertanyaan Responden Dan Nilai
					</p>
					<table id="datatable" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Soal</th>
								<th scope="col">Kriteria</th>
								<th scope="col">Nilai</th>
							</tr>
						</thead>

						<tbody></tbody>
					</table>
				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>
	<!-- end row-->
</div>
<!-- end container -->

<!-- Modal -->
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalLabel">Form Penentuan</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close"></button>
			</div>
			<form method="post" id="formData">
				<input type="hidden" id="validasi" name="validasi">
				<div class="card-body">
					<div id="progressbarwizard">

						<ul class="nav nav-pills nav-justified form-wizard-header mb-3">
							<li class="nav-item">
								<a href="#paket_p" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-file-document me-1"></i>
									<span class="d-none d-sm-inline">P</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#dekorasi_p" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-file-document me-1"></i>
									<span class="d-none d-sm-inline">Dek</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#brp_p" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-file-document me-1"></i>
									<span class="d-none d-sm-inline">BR</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#catering_p" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-file-document me-1"></i>
									<span class="d-none d-sm-inline">C</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#dokumentasi_p" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-file-document me-1"></i>
									<span class="d-none d-sm-inline">Dok</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#ah_p" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-file-document me-1"></i>
									<span class="d-none d-sm-inline">AH</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#tamu_p" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
									<i class="mdi mdi-file-document me-1"></i>
									<span class="d-none d-sm-inline">T</span>
								</a>
							</li>
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
							<div class="tab-pane" id="paket_p">
								<div class="row">
									<div class="col-12">

										<h3 class="mb-2">Paket Wedding</h3>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="kd_paket" name="kd_paket" placeholder="Kode Paket Wedding" readonly />
											<label for="form-control">Kode Paket Wedding</label>
										</div>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="paket" name="paket" placeholder="Masukkan Nama Paket" />
											<label for="form-control">Nama Paket</label>
										</div>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Paket" />
											<label for="form-control">Harga Paket</label>
										</div>

										<div class="form-floating mb-2">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
												<label class="form-check-label" for="is_active">
													Active?
												</label>
											</div>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

							<!-- DATA 2 -->
							<!-- ################################################################################################################################# -->
							<div class="tab-pane" id="dekorasi_p">
								<div class="row">
									<div class="col-12">

										<h3 class="mb-2">Dekoras Wedding</h3>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="dekorasi" name="dekorasi" placeholder="Masukkan Nama Dekorasi" />
											<label for="form-control">Nama Dekorasi</label>
										</div>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="harga_dekorasi" name="harga_dekorasi" placeholder="Masukkan Harga Paket" />
											<label for="form-control">Harga Paket</label>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

							<!-- DATA 3 -->
							<!-- ################################################################################################################################# -->
							<div class="tab-pane" id="brp_p">
								<div class="row">
									<div class="col-12">

										<h3 class="mb-2">Busana & Rias Pengantin Wedding</h3>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="brp" name="brp" placeholder="Masukkan Nama Busana & Rias Pengantin" />
											<label for="form-control">Nama Busana & Rias</label>
										</div>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="harga_brp" name="harga_brp" placeholder="Masukkan Harga Paket" />
											<label for="form-control">Harga Paket</label>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

							<!-- DATA 4 -->
							<!-- ################################################################################################################################# -->
							<div class="tab-pane" id="catering_p">
								<div class="row">
									<div class="col-12">

										<h3 class="mb-2">Catering</h3>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="catering" name="catering" placeholder="Masukkan Nama Catering" />
											<label for="form-control">Nama Catering</label>
										</div>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="harga_catering" name="harga_catering" placeholder="Masukkan Harga Paket" />
											<label for="form-control">Harga Per Orang</label>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

							<!-- DATA 5 -->
							<!-- ################################################################################################################################# -->
							<div class="tab-pane" id="dokumentasi_p">
								<div class="row">
									<div class="col-12">

										<h3 class="mb-2">Dokumentasi</h3>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="dokumentasi" name="dokumentasi" placeholder="Masukkan Nama Dokumentasi" />
											<label for="form-control">Nama Dokumentasi</label>
										</div>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="harga_dokumentasi" name="harga_dokumentasi" placeholder="Masukkan Harga Paket" />
											<label for="form-control">Harga Paket</label>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

							<!-- DATA 6 -->
							<!-- ################################################################################################################################# -->
							<div class="tab-pane" id="ah_p">
								<div class="row">
									<div class="col-12">

										<h3 class="mb-2">Akomodasi & Hiburan</h3>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="ah" name="ah" placeholder="Masukkan Nama Akomodasi & Hiburan" />
											<label for="form-control">Nama Akomodasi & Hiburan</label>
										</div>

										<div class="form-floating mb-2">
											<input type="text" class="form-control" id="harga_ah" name="harga_ah" placeholder="Masukkan Harga Paket" />
											<label for="form-control">Harga Paket</label>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

							<!-- DATA 7 -->
							<!-- ################################################################################################################################# -->
							<div class="tab-pane" id="tamu_p">
								<div class="row">
									<div class="col-12">

										<h3 class="mb-2">Tamu</h3>

										<div class="row">
											<div class="col-6">
												<div class="form-floating mb-2">
													<input type="number" class="form-control" name="jumlah_tamu" id="jumlah_tamu" placeholder="Masukan Jumlah Tamu" />
													<label for="form-control">Jumlah Tamu</label>
												</div>
											</div>
											<div class="col-6">
												<div class="form-floating mb-2">
													<input type="text" class="form-control" name="jumlah_tamu2" id="jumlah_tamu2" placeholder="Masukan Sampai Dengan" />
													<label for="form-control">Sampai Dengan</label>
												</div>
											</div>
										</div>

									</div> <!-- end col -->
								</div> <!-- end row -->
							</div>

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
										<button type="submit" class="btn btn-primary align-items-end" id="submit-data-paket">Kirim</button>
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

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		loaddata();
	});

	function loaddata() {
		$('#datatable').DataTable({
			processing: true,
			responseive: true,
			ajax: {
				"url": "<?= base_url('management/tableDetailPelanggan/' . $kd_pelanggan) ?>",
				"type": "GET"
			},
			columns: [{
					data: 'kd_respon',
					name: 'kd_respon',
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					data: 'soal',
					name: 'soal'
				},
				{
					data: 'kriteria',
					name: 'kriteria'
				},
				{
					data: 'nilai',
					name: 'nilai'
				}
			]
		});
	}
</script>
