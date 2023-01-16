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
				<h4 class="page-title">Data Tes Minat</h4>
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
						Menu ini digunakan untuk data Tes Minat
					</p>
					<?php if ($user['role_id'] == 1) : ?>
						<button type="button" class="btn btn-primary mb-3" data-toggle="modal" onclick="inputDataBaruTesMinat()" data-target="#inputModal">Tambah Tes Minat</button>
					<?php endif; ?>
					<table id="datatable" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">Kode Tes Minat</th>
								<th scope="col">Kriteria</th>
								<th scope="col">Atribut</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
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
					<div class="form-floating mb-2">
						<input type="text" class="form-control" id="kd_tes" name="kd_tes" placeholder="Kode Tes Minat" readonly />
						<label for="floatingInput">Kode Tes Minat</label>
					</div>

					<div class="form-floating mb-2">
						<input type="text" class="form-control input input1" id="kriteria" name="kriteria" placeholder="Masukkan Nama Kriteria" />
						<label for="floatingInput">Nama Kriteria</label>
					</div>

					<div class="form-floating mb-2">
						<select class="form-select input input2" name="atribut" id="atribut" aria-label="Floating label select">
							<option value="">Select Atribut</option>
							<option value="Benefit">Benefit</option>
							<option value="Cost">Cost</option>
						</select>
						<label for="floatingJenisUsaha">Pilih Atribut</label>
					</div>

					<div class="form-floating mb-2">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active?
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success" id="submit-data-tes-minat">Tambahkan</button>
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
				"url": "<?= base_url('management/tableTesMinat') ?>",
				"type": "GET"
			},
			columns: [{
					data: 'kd_tes',
					name: 'kd_tes'
				},
				{
					data: 'kriteria',
					name: 'kriteria'
				},
				{
					data: 'atribut',
					name: 'atribut'
				},
				{
					data: 'status',
					render: function(data, type, row, meta) {
						if (row.status == '1') {
							return `<h5 class="text-success">Active</h5>`;
						} else if (row.status == '0') {
							return `<h5 class="text-danger">Non - Active</h5>`;
						}
					}
				},
				{
					data: 'kd_tes',
					render: function(data, type, row, meta) {
						return `
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical font-18"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<a class="dropdown-item" href="<?= base_url(); ?>management/showSoalTes/${row.kd_tes}"><i class="mdi mdi-clipboard-text me-1"></i> Soal Tes </a>
									<?php if ($user['role_id'] == 1) : ?>
									<!-- item-->
									<button class="dropdown-item" data-toggle="modal" data-target="#inputModal"
										data-id="${row.kd_tes}" onclick="showTesMinat('${row.kd_tes}')"><i
											class="mdi mdi-pencil me-1"></i> Edit </button>
									<!-- item-->
									<button class="dropdown-item" data-id="${row.kd_tes}" id="delete-data-tes-minat"><i
											class="mdi mdi-delete me-1"></i> Hapus </button>
									<?php endif; ?>
								</div>
							</div>
						`;
					}
				}
			]
		});
	}
</script>
