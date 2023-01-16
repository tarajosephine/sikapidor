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
				<h4 class="page-title">Data Bobot</h4>
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
						Menu ini digunakan untuk data Bobot
					</p>
					<?php if ($user['role_id'] == 1) : ?>
						<button type="button" class="btn btn-primary mb-3" data-toggle="modal" onclick="inputDataBaruBobot()" data-target="#inputModal">Tambah Bobot</button>
					<?php endif; ?>
					<table id="datatable" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">Kode Bobot</th>
								<th scope="col">Nilai Bobot</th>
								<th scope="col">Nama Bobot</th>
								<th scope="col">Status</th>
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
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="InputModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="InputModalLabel">Tambah Bobot</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<form method="post" id="formData">
				<input type="hidden" id="validasi" name="validasi">
				<div class="modal-body">
					<div class="form-floating mb-2">
						<input type="text" class="form-control" id="kd_bobot" name="kd_bobot" placeholder="Kode Bobot" readonly />
						<label for="floatingInput">Kode Bobot</label>
					</div>

					<div class="form-floating mb-2">
						<input type="number" class="form-control input inputktr" id="nilai_bobot" name="nilai_bobot" placeholder="Masukkan Nilai Bobot" />
						<label for="floatingInput">Nilai Bobot</label>
					</div>

					<div class="form-floating mb-2">
						<select class="form-select input inputatr" name="bobot" id="bobot" aria-label="Floating label select">
							<option value="">Select Bobot</option>
							<option value="sb">Sangat Baik</option>
							<option value="b">Baik</option>
							<option value="cb">Cukup Baik</option>
							<option value="kb">Kurang Baik</option>
							<option value="skb">Sangat Kurang Baik</option>
						</select>
						<label for="floatingJenisUsaha">Pilih Bobot</label>
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
					<button type="submit" class="btn btn-success" id="submit-data-bobot">Tambahkan</button>
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
				"url": "<?= base_url('management/tableBobot') ?>",
				"type": "GET"
			},
			columns: [{
					data: 'kd_bobot',
					name: 'kd_bobot'
				},
				{
					data: 'nilai_bobot',
					name: 'nilai_bobot'
				},
				{
					data: 'bobot',
					name: 'bobot'
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
				<?php if ($user['role_id'] == 1) : ?> {
						data: 'kd_bobot',
						render: function(data, type, row, meta) {
							return `
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical font-18"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<button class="dropdown-item" data-toggle="modal" data-target="#inputModal"
										data-id="${row.kd_bobot}" onclick="showBobot('${row.kd_bobot}')"><i
											class="mdi mdi-pencil me-1"></i> Edit </button>
									<!-- item-->
									<button class="dropdown-item" data-id="${row.kd_bobot}" id="delete-data-bobot"><i
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
