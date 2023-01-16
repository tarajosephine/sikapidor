// var urle = 'http://192.168.1.253/sidatum/';

function base_url() {
	let protocol = window.location.protocol + "//";
	let host = protocol + window.location.host + "/";
	host = host + "sikapidor";

	return host;
}

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
	var number_string = angka.toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
}

// Controll Password
function checkPassword() {
	$(document).ready(function () {
		$('.form-checkbox').click(function () {
			if ($(this).is(':checked')) {
				$('.form-password').attr('type', 'text');
			} else {
				$('.form-password').attr('type', 'password');
			}
		});
	});
}

$('#floatingJenisUsaha').on('change', function () {
	const selectedPackageJU = $('#floatingJenisUsaha').val();
	// $('#selected').text(selectedPackage);
	$(".data_subju").html(``);
	$.ajax({
		url: base_url() + "/jenisusaha/getSubJenisUsahaByidModal",
		data: {
			id: selectedPackageJU,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("<option>").attr("value", "").text("Pilih menu").appendTo("#floatingsubJenisUsaha");
			if (data) {
				for (let index = 0; index < data.length; index++) {
					$("<option>").attr("value", data[index].id_subju).text(data[index].nama_sub).appendTo("#floatingsubJenisUsaha");
				}
			}
		}
	});
});

$('#floatingKecamatan').on('change', function () {
	const selectedPackageDesa = $('#floatingKecamatan').val();
	// $('#selected').text(selectedPackage);
	$(".data_subdes").html(``);
	$.ajax({
		url: base_url() + "/wilayah/getDesaResultModal",
		data: {
			id: selectedPackageDesa,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			console.log(data);
			$("<option>").attr("value", "").text("Pilih menu").appendTo("#floatingDesa");
			if (data) {
				for (let index = 0; index < data.length; index++) {
					$("<option>").attr("value", data[index].id_desa).text(data[index].nama_desa).appendTo("#floatingDesa");
					// console.log(data[index].id_subju);
				}
			}
		}
	});
});

$('#floatingjp').on('change', function () {
	const selectedPackageJP = $('#floatingjp').val();
	// $('#selected').text(selectedPackage);

	if (selectedPackageJP) {
		if (selectedPackageJP == "Dalam Negeri") {
			$(".data-form-jp").html(`
			<input type="hidden" name="id_c" id="id_c" value="1">
			<div class="row g-2 mb-2">
				<div class="col-md">
					<div class="form-floating">
						<input type="text" class="form-control" name="dn_prov" id="floatingDn_prov" min="0" placeholder="Provinsi" />
						<label for="floatingDn_prov">Provinsi</label>
					</div>
				</div>
				<div class="col-md">
					<div class="form-floating">
						<input type="text" class="form-control" name="dn_kab_kot" id="floatingDn_kab_kot" min="0" placeholder="Kabupaten / Kota" />
						<label for="floatingDn_kab_kot">Kabupaten / Kota</label>
					</div>
				</div>
			</div>
			`);
		} else if (selectedPackageJP == "Luar Negeri, Langusng / Forwarder") {
			$(".data-form-jp").html(`
			<input type="hidden" name="id_c" id="id_c" value="2">
			<div class="col-12">
				<div class="form-floating mb-2">
					<select class="form-select" id="floatingBenua" name="benua" aria-label="Floating label select example">
						<option selected>Pilih menu</option>
						<option value="Asia">Asia</option>
						<option value="Afrika">Afrika</option>
						<option value="Eropa">Eropa</option>
						<option value="Amerika">Amerika</option>
						<option value="Australia">Australia</option>
					</select>
					<label for="floatingJangkauanPasar">Jangkauan Pasar</label>
				</div>
			</div>
			<div class="form-floating mb-2">
				<input type="text" class="form-control" name="negara" id="floatingNegara" placeholder="Negara" />
				<label for="floatingNegara">Negara</label>
			</div>
			<div class="form-floating mb-2">
				<input type="text" class="form-control" name="volume" id="floatingVolume" placeholder="Volume" />
				<label for="floatingVolume">Volume</label>
			</div>
			<div class="form-floating mb-2">
				<input type="text" class="form-control" name="satuan_v" id="floatingSatuan_v" placeholder="Satuan v" />
				<label for="floatingSatuan_v">Satuan Volume</label>
			</div>
			<div class="form-floating mb-2">
				<input type="text" class="form-control" name="nilai_ex" id="floatingNilai_ex" placeholder="Nilai ex" />
				<label for="floatingNilai_ex">Nilai Export</label>
			</div>
			`);
		} else {
			$(".data-form-jp").html(``);
		}
	} else {
		$(".data-form-jp").html(``);
	}
});

// #################################################################################################################
// MENU
// ADD
function addMenu() {
	$("#MenuModalLabel").html("Add New Menu");
	$(".modal-footer button[type=submit]").html("Add");
	$(".modal-content form").attr("action", base_url() + "/menu");
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}
// Edit
function editMenu(id) {
	$("#MenuModalLabel").html("Edit Menu");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/menu/editMenuModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/menu/getMenuModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#menu").val(data.menu);
			$("#id").val(data.id);
			// console.log(data);
		},
	});
}
// Delete
function deleteMenu(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/menu/deleteMenuModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/menu/getMenuModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id);
			// console.log(data);
		},
	});
}

// Edit Profile
function profile() {
	let fileName = $("input[type=file]").val().split("\\").pop();
	$("input[type=file]")
		.next(".custom-file-label")
		.addClass("selected")
		.html(fileName);
	// let file = $("input[type=file]").files[0];
	// console.log(file);
}

// #################################################################################################################
// SUB MENU
// ADD
function addSubMenu() {
	$("#SubMenuModalLabel").html("Add New Sub Menu");
	$(".modal-footer button[type=submit]").html("Add");
	$(".modal-content form").attr(
		"action",
		base_url() + "/menu/subMenu"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editSubMenu(id) {
	$("#SubMenuModalLabel").html("Edit Sub Menu");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/menu/editSubMenuModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/menu/getSubMenuModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#title").val(data.title);
			$("#menu_id").val(data.menu_id);
			$("#url").val(data.url);
			$("#icon").val(data.icon);
			if (data.is_active == "0") {
				$("#is_active").prop("checked", false);
			} else if (data.is_active == "1") {
				$("#is_active").prop("checked", true);
			}
			$("#id").val(data.id);
		},
	});
}

// Delete
function deleteSubMenu(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/menu/deleteSubMenuModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/menu/getSubMenuModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id);
			// console.log(data);
		},
	});
}

// #################################################################################################################
// ROLE
// ADD
function addRole() {
	$("#RoleModalLabel").html("Add New Role");
	$(".modal-footer button[type=submit]").html("Add");
	$(".modal-content form").attr(
		"action",
		base_url() + "/admin/role"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editRole(id) {
	$("#RoleModalLabel").html("Edit Role");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/admin/editRoleModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/admin/getRoleModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#role").val(data.role);
			$("#id").val(data.id);
			// console.log(data);
		},
	});
}

// Delete
function deleteRole(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/admin/deleteRoleModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/admin/getRoleModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id);
			// console.log(data);
		},
	});
}

//Role Access
function RoleAccess(role, menu) {
	const idrole = role;
	const idmenu = menu;
	// console.log(idr + " ajmik " + idm + " " + idrole + " dan " + idmenu);
	$.ajax({
		url: base_url() + "/admin/changeAccess",
		data: {
			roleId: idrole,
			menuId: idmenu,
		},
		method: "POST",
		dataType: "json",
		success: function () {
			window.location.href =
				base_url() + "/admin/roleAccess/" + idrole;
		},
	});
}

// #################################################################################################################
// PELANGGAN
// ADD
function addPelanggan() {
	$("#InputModalLabel").html("Tambah Pelanggan");
	$(".modal-footer button[type=submit]").html("Add");
	$("#cid").prop("disabled", false);
	$(".modal-content form").attr(
		"action",
		base_url() + "/management"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editPelanggan(id) {
	$("#InputModalLabel").html("Edit Pelanggan");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/management/editPelangganModal"
	);
	$("#cid").prop("disabled", true);

	const idedit = id;
	$.ajax({
		url: base_url() + "/management/getPelangganModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#cid").val(data.cid);
			$("#nama").val(data.nama);
			$("#alamat").val(data.alamat);
			$("#id").val(data.cid);
		},
	});
}

// Delete
function deletePelanggan(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/management/deletePelangganModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/management/getPelangganModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.cid);
			// console.log(data);
		},
	});
}


























// #################################################################################################################
// PELATIHAN
// ADD
function addPelatihan() {
	$("#PelatihanModalLabel").html("Tambah Baru Pelatihan");
	$(".modal-footer button[type=submit]").html("Tambah");
	$(".modal-content form").attr(
		"action",
		base_url() + "/pemasaran"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editPelatihan(id) {
	$("#PelatihanModalLabel").html("Edit Pelatihan");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/pemasaran/editPelatihanModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/pemasaran/getPelatihanModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#nama_kegiatan").val(data.nama_kegiatan);
			$("#tgl_pelatihan").val(data.tgl_pelatihan);
			$("#tgl_selesai_p").val(data.tgl_selesai_p);
			$("#waktu_pelatihan").val(data.waktu_pelatihan);
			$("#tempat").val(data.tempat);
			$("#kuota").val(data.kuota);
			$("#floatingJenisUsaha").val(data.id_ju);
			$("#id").val(data.id_p);
			// console.log(data);
		},
	});
}

// Delete
function deletePelatihan(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/pemasaran/deletePelatihanModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/pemasaran/getPelatihanModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id_p);
			// console.log(data);
		},
	});
}

// #################################################################################################################
// PENDAFTARAN PELATIHAN
// CREATE
var dataArrayPeserta = [];

function tambahDataPeserta() {
	let id_p = $('#id_peserta').val();
	dataArrayPeserta.push(id_p);
	$.ajax({
		url: base_url() + "/pemasaran/getPeserta",
		data: {
			id: id_p,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			let html = `
			<tr>
				<td>1</td>
				<td>${data.nama_peserta}</td>
				<td>${data.alamat}</td>
				<td>${data.nu_peserta}</td>
				<td>${data.nama_sub}</td>
			</tr>`;
			$('.form-peserta table tbody').append(html)
		},
	});
}

function simpanDataPelatihan($idPelatihan) {
	let idPelatihann = $idPelatihan;
	console.log(dataArrayPeserta.length);
	for (let i = 0; i < dataArrayPeserta.length; i++) {
		console.log(dataArrayPeserta[i]);
		$.ajax({
			url: base_url() + "/pemasaran/insertPelatihan",
			data: {
				id: dataArrayPeserta[i],
				idPelatihan: idPelatihann
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				console.log("sukksess");
			},
		});
	}
	location.href = base_url() + "/pemasaran/pendaftaranPelatihan";
}

// ADD
function addPP() {
	$("#PPModalLabel").html("Tambah Peserta Pelatihan Baru");
	$(".modal-footer button[type=submit]").html("Tambah");
	$(".modal-content form").attr(
		"action",
		base_url() + "/pemasaran/pendaftaranPelatihan"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editPP(id) {
	$("#PPModalLabel").html("Edit Pelatihan");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/pemasaran/editPendaftarPelatihanModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/pemasaran/getPendaftarPelatihanModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#floatingid_peserta").val(data.id_peserta);
			$("#floatingid_pelatihan").val(data.id_pelatihan);
			$("#id").val(data.id_pendaftaran);
			// console.log(data);
		},
	});
}

// Delete
function deletePP(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/pemasaran/deletePendaftarPelatihanModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/pemasaran/getPendaftarPelatihanModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id_pendaftaran);
			// console.log(data);
		},
	});
}

// #################################################################################################################
// JENIS USAHA
// ADD
function addJenisUsaha() {
	$("#JenisUsahaModalLabel").html("Tambah Bidang Usaha");
	$(".modal-footer button[type=submit]").html("Tambah");
	$(".modal-content form").attr(
		"action",
		base_url() + "/jenisusaha"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editJenisUsaha(id) {
	$("#JenisUsahaModalLabel").html("Edit Bidang Usaha");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/jenisusaha/editJenisUsahaModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/jenisusaha/getJenisUsahaModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#floatingInput").val(data.nama_usaha);
			$("#floatingKeterangan").val(data.keterangan);
			$("#id").val(data.id_ju);
			// console.log(data);
		},
	});
}

// Delete
function deleteJenisUsaha(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/jenisusaha/deleteJenisUsahaModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/jenisusaha/getJenisUsahaModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id_ju);
			// console.log(data);
		},
	});
}

// #################################################################################################################
// SUB JENIS USAHA
// ADD
function addSubJenisUsaha() {
	$("#SubJenisUsahaModalLabel").html("Tambah Sub Jenis Usaha");
	$(".modal-footer button[type=submit]").html("Tambah");
	$(".modal-content form").attr(
		"action",
		base_url() + "/jenisusaha/subJenisUsaha"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editSubJenisUsaha(id) {
	$("#SubJenisUsahaModalLabel").html("Edit Sub Jenis Usaha");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/jenisusaha/editSubJenisUsahaModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/jenisusaha/getSubJenisUsahaModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#floatingid_jenis").val(data.id_ju);
			$("#floatingInput").val(data.nama_sub);
			$("#floatingKeterangan").val(data.ket);
			$("#id").val(data.id_subju);
			// console.log(data);
		},
	});
}

// Delete
function deleteSubJenisUsaha(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/jenisusaha/deleteSubJenisUsahaModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/jenisusaha/getSubJenisUsahaModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id_subju);
			// console.log(data);
		},
	});
}

// #################################################################################################################
// Peserta
// ADD
function addPeserta() {
	$("#PesertaModalLabel").html("Tambah Peserta");
	$(".modal-footer button[type=submit]").html("Tambah");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

function uploadData(id) {
	const idedit = id;
	$(".data_info_nib").hide();
	$(".data_info_prit").hide();
	$(".data_info_sertivikat").hide();
	$(".data_info_npwp").hide();
	$(".data_info_ktp").hide();
	$(".data_info_brand").hide();

	$("#PesertaModalLabel").html("Tambah Peserta");
	$(".modal-footer button[type=submit]").html("Tambah");
	$("#id_peserta").val(idedit);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

function editUploadData(id) {
	const idedit = id;
	$("#PesertaModalLabel").html("Tambah Peserta");
	$(".modal-footer button[type=submit]").html("Tambah");

	$.ajax({
		url: base_url() + "/peserta/getUploadDataModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_peserta").val(data.id_peserta);
			if (data.nib) {
				$(".data_info_nib").show();
				$("#img_1").val(data.nib);
				const previewContainer_1 = document.getElementById('imagePreview_1');
				const previewImage_1 = previewContainer_1.querySelector('.input_data_1');
				const previewDefaultText_1 = previewContainer_1.querySelector('.text_input_data_1');

				previewDefaultText_1.style.display = "none";
				previewImage_1.style.display = "block";
				previewImage_1.setAttribute("src", base_url() + "/assets/images/data-peserta/" + data.nib);

			} else {
				$(".data_info_nib").hide();
			}

			if (data.prit) {
				$(".data_info_prit").show();
				$("#img_2").val(data.prit);
				const previewContainer_2 = document.getElementById('imagePreview_2');
				const previewImage_2 = previewContainer_2.querySelector('.input_data_2');
				const previewDefaultText_2 = previewContainer_2.querySelector('.text_input_data_2');

				previewDefaultText_2.style.display = "none";
				previewImage_2.style.display = "block";
				previewImage_2.setAttribute("src", base_url() + "/assets/images/data-peserta/" + data.prit);

			} else {
				$(".data_info_prit").hide();
			}

			if (data.sertivikat) {
				$(".data_info_sertivikat").show();
				$("#img_3").val(data.sertivikat);
				const previewContainer_3 = document.getElementById('imagePreview_3');
				const previewImage_3 = previewContainer_3.querySelector('.input_data_3');
				const previewDefaultText_3 = previewContainer_3.querySelector('.text_input_data_3');

				previewDefaultText_3.style.display = "none";
				previewImage_3.style.display = "block";
				previewImage_3.setAttribute("src", base_url() + "/assets/images/data-peserta/" + data.sertivikat);

			} else {
				$(".data_info_sertivikat").hide();
			}

			if (data.npwp) {
				$(".data_info_npwp").show();
				$("#img_4").val(data.npwp);
				const previewContainer_4 = document.getElementById('imagePreview_4');
				const previewImage_4 = previewContainer_4.querySelector('.input_data_4');
				const previewDefaultText_4 = previewContainer_4.querySelector('.text_input_data_4');

				previewDefaultText_4.style.display = "none";
				previewImage_4.style.display = "block";
				previewImage_4.setAttribute("src", base_url() + "/assets/images/data-peserta/" + data.npwp);

			} else {
				$(".data_info_npwp").hide();
			}

			if (data.ktp) {
				$(".data_info_ktp").show();
				$("#img_5").val(data.ktp);
				const previewContainer_5 = document.getElementById('imagePreview_5');
				const previewImage_5 = previewContainer_5.querySelector('.input_data_5');
				const previewDefaultText_5 = previewContainer_5.querySelector('.text_input_data_5');

				previewDefaultText_5.style.display = "none";
				previewImage_5.style.display = "block";
				previewImage_5.setAttribute("src", base_url() + "/assets/images/data-peserta/" + data.ktp);

			} else {
				$(".data_info_ktp").hide();
			}

			if (data.brand) {
				$(".data_info_brand").show();
				$("#img_6").val(data.brand);
				const previewContainer_6 = document.getElementById('imagePreview_6');
				const previewImage_6 = previewContainer_6.querySelector('.input_data_6');
				const previewDefaultText_6 = previewContainer_6.querySelector('.text_input_data_6');

				previewDefaultText_6.style.display = "none";
				previewImage_6.style.display = "block";
				previewImage_6.setAttribute("src", base_url() + "/assets/images/data-peserta/" + data.brand);

			} else {
				$(".data_info_brand").hide();
			}

		},
	});
}

// #################################################################################################################
// Sosial Media
function sosialMedia(id) {
	const idedit = id;
	$("#id").val(idedit);
	$("#PelatihanModalLabel").html("Tambah Baru Pelatihan");
	$(".modal-footer button[type=submit]").html("Tambah");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta/sosialMedia"
	);
	// $(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editSosialMedia(id) {
	$("#PesertaModalLabel").html("Edit Peserta");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta/editSosialMediaModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/peserta/getSosialMediaModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_peserta").val(data.id_peserta);
			$("#floatingSosmed").val(data.nama_sosmed);
			$("#floatingAkun").val(data.akun);
			$("#floatingURL").val(data.url);
			$("#id").val(data.id_sm);
			// console.log(data);
		},
	});
}

// Delete
function deleteSosialMedia(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta/deleteSosialMediaModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/peserta/getSosialMediaModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_pesertas").val(data.id_peserta);
			$("#id_s").val(data.id_sm);
			// console.log(data);
		},
	});
}

// #################################################################################################################
// Peserta
// Edit
function editPeserta(id) {
	$("#PesertaModalLabel").html("Edit Peserta");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta/editPesertaModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/peserta/getPesertaModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#floatingInput").val(data.nama_peserta);
			$("#floatingAlamat").val(data.alamat);
			$("#id_desa").val(data.id_desa);
			$("#floatingTelp").val(data.no_telpon);
			$("#floatingNKK").val(data.no_kk);
			$("#floatingKTP").val(data.no_ktp);
			$("#floatingLahir").val(data.tempat_lhr);
			$("#floatingTgl_lahir").val(data.tgl_lahir);
			$("#floatingJ_kel").val(data.j_kel);
			$("#id").val(data.id_peserta);
			// console.log(data);
		},
	});
}

// Delete
function deletePeserta(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta/deletePesertaModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/peserta/getPesertaModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id_peserta);
			// console.log(data);
		},
	});
}

// TAMBAH USAHA
function tambahUsahaData(id) {
	const idedit = id;
	$("#id_tu").val(idedit);
	$("#PelatihanModalLabel").html("Tambah Baru Pelatihan");
	$(".modal-footer button[type=submit]").html("Tambah");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta/tambahUsaha"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

function editUsahaData(id) {
	$("#UsahaModalLabel").html("Edit Pelatihan");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/peserta/editUsaha"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/peserta/getDataUsahaModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#floatingNamaUsaha").val(data.nama_usaha);
			$("#floatingAlamat_usaha").val(data.alamat_usaha);
			$("#id_desa_jp").val(data.id_desa_jp);
			$("#floatingJml_pria").val(data.jml_pria);
			$("#floatingJml_wanita").val(data.jml_wanita);
			$("#floatingJenisUsaha").val(data.id_ju);
			$("#floatingsubJenisUsaha").val(data.id_subju);
			$("#floatingAset").val(data.aset);
			$("#floatingOmset").val(data.omset);
			$("#floatingModalMandiri").val(data.modal_mandiri);
			$("#floatingModalLuar").val(data.modal_luar);
			$("#floatingN_kp").val(data.kapasitas_produksi);
			$("#floatingSatuan").val(data.satuan);
			$("#id_tu").val(data.id_usaha);
			// console.log(data);

			const selectedPackage = data.id_ju;
			// $('#selected').text(selectedPackage);
			$(".data_subju").html(``);
			const id_pesertaa = data.id_peserta;

			$.ajax({
				url: base_url() + "/peserta/getJPModal",
				data: {
					id: id_pesertaa,
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					console.log(data);
					if (data) {
						$("#floatingjp").val(data.nama_jp);
						if (data.nama_jp == "Dalam Negeri") {
							$(".data-form-jp").html(`
							<input type="hidden" name="id_c" id="id_c" value="1">
							<input type="hidden" name="id_Pa" id="id_Pa" value="${data.id_jp}">
							<div class="row g-2 mb-2">
								<div class="col-md">
									<div class="form-floating">
										<input type="text" class="form-control" name="dn_prov" id="floatingDn_prov" min="0" placeholder="Provinsi" value="${data.dn_prov}" />
										<label for="floatingDn_prov">Provinsi</label>
									</div>
								</div>
								<div class="col-md">
									<div class="form-floating">
										<input type="text" class="form-control" name="dn_kab_kot" id="floatingDn_kab_kot" min="0" placeholder="Kabupaten / Kota" value="${data.dn_kab_kot}" />
										<label for="floatingDn_kab_kot">Kabupaten / Kota</label>
									</div>
								</div>
							</div>
							`);
						} else if (data.nama_jp == "Luar Negeri, Langusng / Forwarder") {
							$(".data-form-jp").html(`
							<input type="hidden" name="id_c" id="id_c" value="2">
							<input type="hidden" name="id_Pa" id="id_Pa" value="${data.id_jp}">
							<div class="col-12">
								<div class="form-floating mb-2">
									<select class="form-select" id="floatingBenua" name="benua" aria-label="Floating label select example" value="${data.benua}">
										<option selected>Pilih menu</option>
										<option value="Asia">Asia</option>
										<option value="Afrika">Afrika</option>
										<option value="Eropa">Eropa</option>
										<option value="Amerika">Amerika</option>
										<option value="Australia">Australia</option>
									</select>
									<label for="floatingJangkauanPasar">Jangkauan Pasar</label>
								</div>
							</div>
							<div class="form-floating mb-2">
								<input type="text" class="form-control" name="negara" id="floatingNegara" placeholder="Negara" value="${data.negara}" />
								<label for="floatingNegara">Negara</label>
							</div>
							<div class="form-floating mb-2">
								<input type="text" class="form-control" name="volume" id="floatingVolume" placeholder="Volume" value="${data.volume}" />
								<label for="floatingVolume">Volume</label>
							</div>
							<div class="form-floating mb-2">
								<input type="text" class="form-control" name="satuan_v" id="floatingSatuan_v" placeholder="Satuan v" value="${data.satuan_v}" />
								<label for="floatingSatuan_v">Satuan Volume</label>
							</div>
							<div class="form-floating mb-2">
								<input type="text" class="form-control" name="nilai_ex" id="floatingNilai_ex" placeholder="Nilai ex" value="${data.nilai_ex}" />
								<label for="floatingNilai_ex">Nilai Export</label>
							</div>
							`);
						} else {
							$(".data-form-jp").html(``);
						}
					} else {
						$(".data-form-jp").html(``);
					}
				}
			});

			var subjune = data.id_subju;
			console.log(subjune);
			$.ajax({
				url: base_url() + "/jenisusaha/getSubJenisUsahaByidModal",
				data: {
					id: selectedPackage,
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					// $("<option>").attr("value", "").text("Pilih menu").appendTo("#floatingsubJenisUsaha");
					if (data) {
						for (let index = 0; index < data.length; index++) {
							if (subjune == data[index].id_subju) {
								$("<option>")
									.attr("value", subjune)
									.text(data[index].nama_sub)
									.appendTo("#floatingsubJenisUsaha");
							}
							// else{
							// 	$("<option>").attr("value", data[index].id_subju).text(data[index].nama_sub).appendTo("#floatingsubJenisUsaha");
							// }
						}
					}
				}
			});
		},
	});
}

// #################################################################################################################
// USER
// ADD
function addUserAdmin() {
	$("#UserAdminModalLabel").html("Add New User Admin");
	$(".modal-footer button[type=submit]").html("Add");
	$(".modal-content form").attr(
		"action",
		base_url() + "/ManagementUser"
	);
	$(".modal-content form")[0].reset();
	$(".modal-content form").validate().resetForm();
}

// Edit
function editUserAdmin(id) {
	$("#UserAdminModalLabel").html("Edit User Admin");
	$(".modal-footer button[type=submit]").html("Edit");
	$(".modal-content form").attr(
		"action",
		base_url() + "/ManagementUser/editUserAdminModal"
	);

	const idedit = id;
	$.ajax({
		url: base_url() + "/ManagementUser/getUserAdminModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#nama").val(data.name);
			$("#username").val(data.username);
			$("#email").val(data.email);
			$("#role_id").val(data.role_id);
			$("#id").val(data.id);
		},
	});
}

// Delete
function deleteUserAdmin(id) {
	$(".modal-footer button[type=submit]").html("Delete");
	$(".modal-content form").attr(
		"action",
		base_url() + "/ManagementUser/deleteUserAdminModal"
	);

	const iddelete = id;
	$.ajax({
		url: base_url() + "/ManagementUser/getUserAdminModal",
		data: {
			id: iddelete,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#id_s").val(data.id);
			// console.log(data);
		},
	});
}

// #################################################################################################################
// BOBOT
function inputDataBaruBobot() {
	$.ajax({
		url: base_url() + "/Management/cdBobot",
		method: "GET",
		dataType: "json",
		success: function (data) {
			$("#validasi").val("new");
			$(".modal-footer button[type=submit]").html("Tambah");
			$("#kd_bobot").val(data.pengurutanK);
			$("#nilai_bobot").val(null);
			$("#bobot").val(null);
		},
	});
}

// Show Data
function showBobot(id) {
	const idedit = id;
	$.ajax({
		url: base_url() + "/Management/getBobotModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#dataModalLabel").html("Edit Data");
			$("#validasi").val("update");
			$(".modal-footer button[type=submit]").html("Edit");
			$("#kd_bobot").val(data.kd_bobot);
			$("#nilai_bobot").val(data.nilai_bobot);
			$("#bobot").val(data.bobot);
		},
	});
}

// Delete
$(document).on("click", "#delete-data-bobot", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/deleteBobotModal";
	let id_ne = $(this).data("id");
	deleteData(url, id_ne);
});

// ADD & EDIT MODAL
$(document).on("click", "#submit-data-bobot", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/updateBobot";
	let kd_bobot = $("#kd_bobot").val();
	let nilai_bobot = $("#nilai_bobot").val();
	let bobot = $("#bobot").val();
	if (kd_bobot == "" || nilai_bobot == "" || bobot == "") {
		if (nilai_bobot == "") {
			$(".input1").removeClass("is-valid");
			$(".input1").addClass("is-invalid");
		} else {
			$(".input1").removeClass("is-invalid");
			$(".input1").addClass("is-valid");
		}
		if (bobot == "") {
			$(".input2").removeClass("is-valid");
			$(".input2").addClass("is-invalid");
		} else {
			$(".input2").removeClass("is-invalid");
			$(".input2").addClass("is-valid");
		}
		Swal.fire({
			icon: "warning",
			title: "Oops...",
			text: "Harus diinput semua!",
		});
	} else {
		var data = $("#formData").serialize();
		$(".input").removeClass("is-invalid");
		updateData(url, data);
	}
});

// #################################################################################################################
// PAKET WEDDING
function inputDataBaruPaket() {
	$.ajax({
		url: base_url() + "/Management/cdPaket",
		method: "GET",
		dataType: "json",
		success: function (data) {
			$("#validasi").val("new");
			$(".modal-footer button[type=submit]").html("Tambah");
			$("#kd_paket").val(data.pengurutanK);
			$("#paket").val(null);
			$("#kru").val(null);
			$("#harga_wo").val(null);
			$("#dekorasi").val(null);
			$("#harga_dekorasi").val(null);
			$("#brp").val(null);
			$("#harga_brp").val(null);
			$("#catering").val(null);
			$("#harga_catering").val(null);
			$("#dokumentasi").val(null);
			$("#harga_dokumentasi").val(null);
			$("#ah").val(null);
			$("#harga_ah").val(null);
			$("#jumlah_tamu").val(null);
			$("#jumlah_tamu2").val(null);
		},
	});
}

// Show Data
function showPaket(id) {
	const idedit = id;
	$.ajax({
		url: base_url() + "/Management/getPaketModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#dataModalLabel").html("Edit Data");
			$("#validasi").val("update");
			$(".modal-footer button[type=submit]").html("Edit");
			$("#kd_paket").val(data.kd_paket);
			$("#paket").val(data.paket);
			$("#kru").val(data.kru);
			$("#harga_wo").val(data.harga_wo);
			$("#dekorasi").val(data.dekorasi);
			$("#harga_dekorasi").val(data.harga_dekorasi);
			$("#brp").val(data.brp);
			$("#harga_brp").val(data.harga_brp);
			$("#catering").val(data.catering);
			$("#harga_catering").val(data.harga_catering);
			$("#dokumentasi").val(data.dokumentasi);
			$("#harga_dokumentasi").val(data.harga_dokumentasi);
			$("#ah").val(data.ah);
			$("#harga_ah").val(data.harga_ah);
			$("#jumlah_tamu").val(data.jumlah_tamu);
			$("#jumlah_tamu2").val(data.jumlah_tamu2);
			$("#status").val(data.status);
		},
	});
}

// Delete
$(document).on("click", "#delete-data-paket", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/deletePaketModal";
	let id_ne = $(this).data("id");
	deleteData(url, id_ne);
});

// ADD & EDIT MODAL
$(document).on("click", "#submit-data-paket", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/updatePaket";
	let kd_paket = $("#kd_paket").val();
	let paket = $("#paket").val();
	let kru = $("#kru").val();
	let harga_wo = $("#harga_wo").val();
	let dekorasi = $("#dekorasi").val();
	let harga_dekorasi = $("#harga_dekorasi").val();
	let brp = $("#brp").val();
	let harga_brp = $("#harga_brp").val();
	let catering = $("#catering").val();
	let harga_catering = $("#harga_catering").val();
	let dokumentasi = $("#dokumentasi").val();
	let harga_dokumentasi = $("#harga_dokumentasi").val();
	let ah = $("#ah").val();
	let harga_ah = $("#harga_ah").val();
	let jumlah_tamu = $("#jumlah_tamu").val();
	let jumlah_tamu2 = $("#jumlah_tamu").val();

	if (
		kd_paket == "" ||
		paket == "" ||
		kru == "" ||
		harga_wo == "" ||
		dekorasi == "" ||
		harga_dekorasi == "" ||
		brp == "" ||
		harga_brp == "" ||
		catering == "" ||
		harga_catering == "" ||
		dokumentasi == "" ||
		harga_dokumentasi == "" ||
		ah == "" ||
		harga_ah == "" ||
		jumlah_tamu == "" ||
		jumlah_tamu2 == ""
	) {
		if (paket == "") {
			$(".input1").removeClass("is-valid");
			$(".input1").addClass("is-invalid");
		} else {
			$(".input1").removeClass("is-invalid");
			$(".input1").addClass("is-valid");
		}

		if (kru == "") {
			$(".input2").removeClass("is-valid");
			$(".input2").addClass("is-invalid");
		} else {
			$(".input2").removeClass("is-invalid");
			$(".input2").addClass("is-valid");
		}

		if (harga_wo == "") {
			$(".input3").removeClass("is-valid");
			$(".input3").addClass("is-invalid");
		} else {
			$(".input3").removeClass("is-invalid");
			$(".input3").addClass("is-valid");
		}

		if (dekorasi == "") {
			$(".input4").removeClass("is-valid");
			$(".input4").addClass("is-invalid");
		} else {
			$(".input4").removeClass("is-invalid");
			$(".input4").addClass("is-valid");
		}

		if (harga_dekorasi == "") {
			$(".input5").removeClass("is-valid");
			$(".input5").addClass("is-invalid");
		} else {
			$(".input5").removeClass("is-invalid");
			$(".input5").addClass("is-valid");
		}

		if (brp == "") {
			$(".input6").removeClass("is-valid");
			$(".input6").addClass("is-invalid");
		} else {
			$(".input6").removeClass("is-invalid");
			$(".input6").addClass("is-valid");
		}

		if (harga_brp == "") {
			$(".input7").removeClass("is-valid");
			$(".input7").addClass("is-invalid");
		} else {
			$(".input7").removeClass("is-invalid");
			$(".input7").addClass("is-valid");
		}

		if (catering == "") {
			$(".input8").removeClass("is-valid");
			$(".input8").addClass("is-invalid");
		} else {
			$(".input8").removeClass("is-invalid");
			$(".input8").addClass("is-valid");
		}

		if (harga_catering == "") {
			$(".input9").removeClass("is-valid");
			$(".input9").addClass("is-invalid");
		} else {
			$(".input9").removeClass("is-invalid");
			$(".input9").addClass("is-valid");
		}

		if (dokumentasi == "") {
			$(".input10").removeClass("is-valid");
			$(".input10").addClass("is-invalid");
		} else {
			$(".input10").removeClass("is-invalid");
			$(".input10").addClass("is-valid");
		}

		if (harga_dokumentasi == "") {
			$(".input11").removeClass("is-valid");
			$(".input11").addClass("is-invalid");
		} else {
			$(".input11").removeClass("is-invalid");
			$(".input11").addClass("is-valid");
		}

		if (ah == "") {
			$(".input12").removeClass("is-valid");
			$(".input12").addClass("is-invalid");
		} else {
			$(".input12").removeClass("is-invalid");
			$(".input12").addClass("is-valid");
		}

		if (harga_ah == "") {
			$(".input13").removeClass("is-valid");
			$(".input13").addClass("is-invalid");
		} else {
			$(".input13").removeClass("is-invalid");
			$(".input13").addClass("is-valid");
		}

		if (jumlah_tamu == "") {
			$(".input14").removeClass("is-valid");
			$(".input14").addClass("is-invalid");
		} else {
			$(".input14").removeClass("is-invalid");
			$(".input14").addClass("is-valid");
		}

		if (jumlah_tamu2 == "") {
			$(".input15").removeClass("is-valid");
			$(".input15").addClass("is-invalid");
		} else {
			$(".input15").removeClass("is-invalid");
			$(".input15").addClass("is-valid");
		}
		Swal.fire({
			icon: "warning",
			title: "Oops...",
			text: "Harus diinput semua!",
		});
	} else {
		var data = $("#formData").serialize();
		$(".input").removeClass("is-invalid");
		updateData(url, data);
	}
});

// #################################################################################################################
// TES MINAT
function inputDataBaruTesMinat() {
	$.ajax({
		url: base_url() + "/Management/cdTesMinat",
		method: "GET",
		dataType: "json",
		success: function (data) {
			$("#validasi").val("new");
			$(".modal-footer button[type=submit]").html("Tambah");
			$("#kd_tes").val(data.pengurutanK);
			$("#kriteria").val(null);
		},
	});
}

// Show Data
function showTesMinat(id) {
	const idedit = id;
	$.ajax({
		url: base_url() + "/Management/getTesMinatModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#dataModalLabel").html("Edit Data");
			$("#validasi").val("update");
			$(".modal-footer button[type=submit]").html("Edit");
			$("#kd_tes").val(data.kd_tes);
			$("#kriteria").val(data.kriteria);
			$("#atribut").val(data.atribut);
		},
	});
}

// Delete
$(document).on("click", "#delete-data-tes-minat", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/deleteTesMinatModal";
	let id_ne = $(this).data("id");
	deleteData(url, id_ne);
});

// ADD & EDIT MODAL
$(document).on("click", "#submit-data-tes-minat", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/updateTesMinat";
	let kd_tes = $("#kd_tes").val();
	let kriteria = $("#kriteria").val();
	let atribut = $("#atribut").val();
	if (kd_tes == "" || kriteria == "" || atribut == "") {
		if (kriteria == "") {
			$(".input1").removeClass("is-valid");
			$(".input1").addClass("is-invalid");
		} else {
			$(".input1").removeClass("is-invalid");
			$(".input1").addClass("is-valid");
		}
		if (atribut == "") {
			$(".input2").removeClass("is-valid");
			$(".input2").addClass("is-invalid");
		} else {
			$(".input2").removeClass("is-invalid");
			$(".input2").addClass("is-valid");
		}
		Swal.fire({
			icon: "warning",
			title: "Oops...",
			text: "Harus diinput semua!",
		});
	} else {
		var data = $("#formData").serialize();
		$(".input").removeClass("is-invalid");
		updateData(url, data);
	}
});

// #################################################################################################################
// SOAL TES
function inputDataBaruSoalTes() {
	$("#validasi").val("new");
	$(".modal-footer button[type=submit]").html("Tambah");
	$("#kd_soal").val(null);
	$("#soal").val(null);
}

// Show Data
function showSoalTes(id) {
	const idedit = id;
	$.ajax({
		url: base_url() + "/Management/getSoalTesModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#dataModalLabel").html("Edit Data");
			$("#validasi").val("update");
			$(".modal-footer button[type=submit]").html("Edit");
			$("#kd_soal").val(data.kd_soal);
			$("#soal").val(data.soal);
		},
	});
}

// Delete
$(document).on("click", "#delete-data-soal-tes", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/deleteSoalTesModal";
	let id_ne = $(this).data("id");
	deleteData(url, id_ne);
});

// ADD & EDIT MODAL
$(document).on("click", "#submit-data-soal-tes", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/updateSoalTes";
	let soal = $("#soal").val();
	if (soal == "") {
		if (soal == "") {
			$(".input1").removeClass("is-valid");
			$(".input1").addClass("is-invalid");
		} else {
			$(".input1").removeClass("is-invalid");
			$(".input1").addClass("is-valid");
		}

		Swal.fire({
			icon: "warning",
			title: "Oops...",
			text: "Harus diinput semua!",
		});
	} else {
		var data = $("#formData").serialize();
		$(".input").removeClass("is-invalid");
		updateData(url, data);
	}
});

// #################################################################################################################
// NILAI SOAL TES
function inputDataBaruNilaiSoalTes() {
	$("#validasi").val("new");
	$(".modal-footer button[type=submit]").html("Tambah");
	$("#kd_paket").val(null);
	$("#nilai").val(null);
}

// Show Data
function showNilaiSoalTes(id) {
	const idedit = id;
	$.ajax({
		url: base_url() + "/Management/getNilaiSoalTesModal",
		data: {
			id: idedit,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			$("#dataModalLabel").html("Edit Data");
			$("#validasi").val("update");
			$(".modal-footer button[type=submit]").html("Edit");
			$("#kd_nilai").val(data.kd_nilai);
			$("#kd_paket").val(data.kd_paket);
			$("#nilai").val(data.nilai);
		},
	});
}

// Delete
$(document).on("click", "#delete-data-nilai-soal-tes", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/deleteNilaiSoalTesModal";
	let id_ne = $(this).data("id");
	deleteData(url, id_ne);
});

// ADD & EDIT MODAL
$(document).on("click", "#submit-data-nilai-soal-tes", function (e) {
	e.preventDefault();
	let url = base_url() + "/Management/updateNilaiSoalTes";
	let kd_soal = $("#kd_soal").val();
	let kd_paket = $("#kd_paket").val();
	let nilai = $("#nilai").val();
	if (kd_paket == "" || nilai == "") {
		if (kd_paket == "") {
			$(".input1").removeClass("is-valid");
			$(".input1").addClass("is-invalid");
		} else {
			$(".input1").removeClass("is-invalid");
			$(".input1").addClass("is-valid");
		}

		if (nilai == "") {
			$(".input2").removeClass("is-valid");
			$(".input2").addClass("is-invalid");
		} else {
			$(".input2").removeClass("is-invalid");
			$(".input2").addClass("is-valid");
		}
		Swal.fire({
			icon: "warning",
			title: "Oops...",
			text: "Harus diinput semua!",
		});
	} else {
		$.ajax({
		url: base_url() + "/Management/chekPaket",
		data: {
			kd_soal: kd_soal,
			kd_paket: kd_paket,
		},
		method: "POST",
		dataType: "json",
		success: function (data) {
			if (data) {
				Swal.fire({
					icon: "warning",
					title: "Oops...",
					text: "Paket Weding Sudah di gunakan!",
				});
			} else {
				var data = $("#formData").serialize();
				$(".input").removeClass("is-invalid");
				updateData(url, data);
			}
		},
	});
	}
});

// #################################################################################################################
// FORM PELANGGAN
function inputDataBaruFormPelanggan() {
	$.ajax({
		url: base_url() + "/Pelayanan/cdFormPelanggan",
		method: "GET",
		dataType: "json",
		success: function (data) {
			$("#validasi").val("new");
			$(".modal-footer button[type=submit]").html("Kirim");
			$("#kd_responden").val(data.pengurutanK);
			$("#namad").val(null);
			$("#namab").val(null);
			$("#nohp").val(null);
			$("#gmail").val(null);
			$("#alamat").val(null);
		},
	});
}

// ADD MODAL
$(document).on("click", "#submit-data-form-pelanggan", function (e) {
	e.preventDefault();
	let url = base_url() + "/Pelayanan/updateFormPelanggan";
	let kd_pelanggan = $("#kd_responden").val();
	let namad = $("#namad").val();
	let namab = $("#namab").val();
	let nohp = $("#nohp").val();
	let email = $("#email").val();
	let alamat = $("#alamat").val();
	if (namad == "" || namab == "" || nohp == "" || email == "" || alamat == "") {
		if (namad == "") {
			$(".input1").removeClass("is-valid");
			$(".input1").addClass("is-invalid");
		} else {
			$(".input1").removeClass("is-invalid");
			$(".input1").addClass("is-valid");
		}

		if (namab == "") {
			$(".input2").removeClass("is-valid");
			$(".input2").addClass("is-invalid");
		} else {
			$(".input2").removeClass("is-invalid");
			$(".input2").addClass("is-valid");
		}
		
		if (nohp == "") {
			$(".input3").removeClass("is-valid");
			$(".input3").addClass("is-invalid");
		} else {
			$(".input3").removeClass("is-invalid");
			$(".input3").addClass("is-valid");
		}

		if (email == "") {
			$(".input4").removeClass("is-valid");
			$(".input4").addClass("is-invalid");
		} else {
			$(".input4").removeClass("is-invalid");
			$(".input4").addClass("is-valid");
		}

		if (alamat == "") {
			$(".input5").removeClass("is-valid");
			$(".input5").addClass("is-invalid");
		} else {
			$(".input5").removeClass("is-invalid");
			$(".input5").addClass("is-valid");
		}
		Swal.fire({
			icon: "warning",
			title: "Oops...",
			text: "Harus diinput semua!",
		});
	} else {
		var data = $("#formData").serialize();
		$(".input").removeClass("is-invalid");
		updateData(url, data);
		setTimeout(function () {
			window.location.href = base_url() + "/Pelayanan/saw/" + kd_pelanggan;
		}, 1000);
	}
});

// #################################################################################################################
// Control Update and Delete ALL forms
function updateData(url, data) {
	$.ajax({
		url: url,
		type: "POST",
		data: data,
		processData: false,
		cache: false,
		async: false,
		dataType: "json",
		success: function (response) {
			if (response.status == 200) {
				$("#datatable").DataTable().ajax.reload();
				$(".input").addClass("is-valid");
				if (response.pesan == "new") {
					if (!response.url == "") {
						$.ajax({
							url: base_url() + response.url,
							method: "GET",
							dataType: "json",
							success: function (data) {
								$(response.kd_input).val(data.pengurutanK);
								$(".input").val(null);
								Swal.fire({
									icon: "success",
									title: "Selamat",
									text: "Data berhasil ditambah!",
								});
							},
						});
					} else {
						Swal.fire({
							icon: "success",
							title: "Selamat",
							text: "Data berhasil ditambah!",
						});
					}
				} else if (response.pesan == "update") {
					Swal.fire({
						icon: "success",
						title: "Selamat",
						text: "Data berhasil diupdate!",
					});
				}
				// angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
				setTimeout(function () {
					$(".input").removeClass("is-valid");
				}, 3000);
			}
		},
		error: function (response) {
			// do something
			Swal.fire({
				icon: "error",
				title: "Error!",
				text: "Error Data Tidak bisa di masukkan ke Databaseeeeeeee!",
			});
		},
	});
}

function deleteData(url, data) {
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-success",
			cancelButton: "btn btn-danger",
		},
		buttonsStyling: false,
	});

	swalWithBootstrapButtons
		.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel!",
			reverseButtons: true,
		})
		.then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: url,
					data: {
						id: data,
					},
					method: "POST",
					dataType: "json",
					success: function (data) {
						$("#datatable").DataTable().ajax.reload();
						swalWithBootstrapButtons.fire(
							"Deleted!",
							"Datamu sukses dihapus.",
							"success"
						);
					},
					error: function (data) {
						// do something
						Swal.fire({
							icon: "error",
							title: "Error!",
							text: "Error Data Tidak bisa dihapus!",
						});
					},
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire(
					"Cancelled",
					"Your imaginary file is safe :)",
					"error"
				);
			}
		});
}
