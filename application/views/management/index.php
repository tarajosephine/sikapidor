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
				<h4 class="page-title">Data Pelanggan</h4>
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
						Menu ini digunakan untuk data Pelanggan
					</p>
					<table id="datatable" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">Kode Pelanggan</th>
								<th scope="col">Nama Pelanggan</th>
								<th scope="col">No HP</th>
								<th scope="col">Email</th>
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
				"url": "<?= base_url('management/tablePelanggan') ?>",
				"type": "GET"
			},
			columns: [{
					data: 'kd_pelanggan',
					name: 'kd_pelanggan'
				},
				{
					data: 'nama',
					name: 'nama'
				},
				{
					data: 'no_hp',
					name: 'no_hp'
				},
				{
					data: 'email',
					name: 'email'
				},
				{
					data: 'kd_pelanggan',
					render: function(data, type, row, meta) {
						return `
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical font-18"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<a class="dropdown-item" href="<?= base_url(); ?>management/showPelanggan/${row.kd_pelanggan}"><i
											class="mdi mdi-clipboard-text me-1"></i> Detail </a>
									<!-- item-->
									<?php if ($user['role_id'] == 1) : ?>
									<button class="dropdown-item" data-id="${row.kd_pelanggan}" id="delete-data-pelanggan"><i
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
