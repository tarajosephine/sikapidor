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
				<h4 class="page-title">Data Nilai Soal Tes</h4>
				<div class="clearfix mb-2"><a href="<?= base_url('management/tesMinat') ?>">Tes Minat</a> > <a href="<?= base_url('management/showSoalTes/' . $soaTes['kd_tes']) ?>">Soal Tes</a> > Nilai Soal Tes Minat</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">

					<h4 class="header-title"><?= $title; ?></h4>
					<p class="text-muted font-14">
						Soal Tes : <?= $soaTes['soal']; ?>
					</p>
					<?php if ($user['role_id'] == 1) : ?>
						<button type="button" class="btn btn-primary mb-3" data-toggle="modal" onclick="inputDataBaruNilaiSoalTes()" data-target="#inputModal">Tambah Nilai Soal Tes</button>
					<?php endif; ?>
					<table id="datatable" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">Kode Nilai Soal</th>
								<th scope="col">Paket</th>
								<th scope="col">Nilai</th>
								<?php if ($user['role_id'] == 1) : ?>
									<th scope="col">Action</th>
								<?php endif; ?>
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
<!-- container -->

<!-- Modal -->
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="dataModalLabel">Tambah Data</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<form method="post" id="formData">
				<input type="hidden" id="validasi" name="validasi">
				<div class="modal-body">
					<input type="hidden" name="kd_nilai" id="kd_nilai">

					<div class="form-floating mb-2">
						<input type="text" class="form-control input" id="kd_soal" name="kd_soal" placeholder="Kode Soal Tes" value="<?= $soaTes['kd_soal']; ?>" readonly />
						<label for="floatingInput">Kode Soal Tes</label>
					</div>

					<div class="form-floating mb-2">
						<select class="form-select input input1" id="kd_paket" name="kd_paket" aria-label="Floating label select example">
							<option selected>Pilih Paket</option>
							<?php foreach ($paket as $p) : ?>
								<option value="<?= $p['kd_paket']; ?>"><?= $p['paket']; ?></option>
							<?php endforeach; ?>
						</select>
						<label for="floatingInput">Paket Wedding</label>
					</div>

					<div class="form-floating mb-2">
						<select class="form-select input input2" id="nilai" name="nilai" aria-label="Floating label select example">
							<option selected>Pilih Nilai</option>
							<?php foreach ($nilaiBobot as $nb) : ?>
								<option value="<?= $nb['nilai_bobot']; ?>"><?= $nb['nilai_bobot']; ?> - <?= $nb['bobot']; ?></option>
							<?php endforeach; ?>
						</select>
						<label for="floatingInput">Nilai Soal Paket</label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success" id="submit-data-nilai-soal-tes">Tambahkan</button>
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
				"url": "<?= base_url('management/tableNilaiSoalTes/' . $kd_soalTes) ?>",
				"type": "GET"
			},
			columns: [{
					data: 'kd_nilai',
					name: 'kd_nilai',
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					data: 'paket',
					name: 'paket'
				},
				{
					data: 'nilai',
					name: 'nilai'
				},
				<?php if ($user['role_id'] == 1) : ?> {
						data: 'kd_nilai',
						render: function(data, type, row, meta) {
							return `
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical font-18"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<button class="dropdown-item" data-toggle="modal" data-target="#inputModal"
										data-id="${row.kd_nilai}" onclick="showNilaiSoalTes('${row.kd_nilai}')"><i
											class="mdi mdi-pencil me-1"></i> Edit </button>
									<!-- item-->
									<button class="dropdown-item" data-id="${row.kd_nilai}" id="delete-data-nilai-soal-tes"><i
											class="mdi mdi-delete me-1"></i> Hapus </button>
								</div>
							</div>
						`;
						}
					}
				<?php endif; ?>
			]
		});
	}
</script>
