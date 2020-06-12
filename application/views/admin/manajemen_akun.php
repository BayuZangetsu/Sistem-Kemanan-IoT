<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


	<div class="table-responsive">
		<div class="col">
			<?= form_error('menu', '<div class="alert alert-danger text-center" role="alert">', '</div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<table class="table table2 table-hover table-bordered table-custom">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama</th>
						<th scope="col">Alamat</th>
						<th scope="col">No Kartu</th>
						<th scope="col">No Telp</th>
						<th scope="col">Status Akun</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($daftar_user as $ds) : ?>
						<?php
						if ($ds['is_active'] == "1") {
							$status_akun = "Teraktivasi";
							$warna_teks = "green";
							$tombolaktivasi = '<a href="#!" data-id="' . $ds['id'] . '"class="badge badge-danger nonaktifkan">Nonaktifkan</a>';
						} else {
							$status_akun = "Belum Aktif";
							$warna_teks = "red";
							$tombolaktivasi = '<a href="#!" data-id="' . $ds['id'] . '"class="badge badge-info aktifkan">Aktifkan</a>';
						}
						if ($ds['no_kartu'] == "") {
							$id = $ds['id'];
							$nama = $ds['nama'];
							$aksi = <<<EOD
								<button class="btn btn-primary btn-sm tambahkartu" id="$id" data-target="#modal_tambahkartu"data-toggle="modal" data-nama_user="$nama">Tambah Kartu</button>
								EOD;
						} else {
							$aksi = $ds['no_kartu'];
						}
						?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $ds['nama']; ?></td>
							<td><?= $ds['alamat']; ?></td>
							<td class="text-center"><?= $aksi ?></td>
							<td><?= $ds['notelp']; ?></td>
							<td class="text-center" style="color:<?= $warna_teks; ?>">
								<?= $status_akun; ?>
								<?= $tombolaktivasi; ?>

							</td>
							<td>
								<button href="" id="<?= $ds['id']; ?>" data-nama="<?= $ds['nama'] ?>" class="btn btn-danger mb-3 hapusbtn"><i class="fa fa-fw fa-trash"></i></button>
							</td>
						</tr>
					<?php $i++;
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="ediprofileTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ediprofileTitle">Edit Profile</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/edit_akun'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<i class="fas prefix fa-fw fa-user"></i>
						<input type="text" class="form-control validate" id="formnama" name="formnama">
					</div>
					<div class="form-group">
						<label for="#formalamat">Alamat Lengkap</label>
						<input type="text" class="form-control" id="formalamat" name="formalamat" placeholder="">
					</div>
					<div class="form-group">
						<input type="text" id="form_kartu" class="form-control" placeholder="Klik Tampilkan Kartu">
					</div>
				</div>
				<!-- <button type="button" data-toggle="collapse" data-target="#content" class="btn btn-primary btn-sm mx-3">Tampilkan kartu</button> -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_tambahkartu" role="dialog" aria-labelledby="title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title">Tambah Kartu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card text-white bg-info card-small">
					<div class="card-body mx-auto">
						<div class="row">
							<div class="col-lg-2"><i class="fas fa-info-circle fa-5x m-2"></i></div>
							<div class="col-lg-10">
								<ul>
									<li>
										<h6>Tempelkan kartu pada RFID Reader</h6>
									</li>
									<li>
										<h6>Buka Tab Tampilkan List untuk melihat daftar kartu yang tersedia</h6>
									</li>
									<li>
										<h6>Klik List kartu yang akan ditambahkan</h6>
									</li>
									<li>
										<h6>Hanya Tambahkan kartu yang berstatus <b>Tersedia</b></h6>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<form action="<?= base_url('Upload/updateUser') ?>" method="POST">
					<div class="form-header">
						<h5 class="text-lg text-center">No Kartu RFID</h5>
					</div>
					<div class="form-group">
						<input type="hidden" id="id_user-kartu" name="id" value="">
						<h6>Nama User</h6>
						<input type="text" id="nama_user" name="nama_user " class="form-control disable">
						<h6>No Kartu (Copy dari daftar)</h6>
						<input type="text" id="id_kartu" name="no_kartu" class="form-control">
					</div>
					<div class="accordion" id="content">
						<div class="card">
							<div class="card-header" id="heading">
								<h6 class="text-secondary">
									<button class="btn btn-link" type="button" data-target="#isi" data-toggle="collapse" aria-expanded="true" aria-controls="isi" onclick="load_tempcard()">
										Tampilkan List Kartu RFID
									</button>
								</h6>
							</div>
							<div class="collapse" id="isi" aria-labelledby="heading" data-parent="#content">
								<div id="table-rfid" class="card-body"></div>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<Button type="submit" class="btn btn-primary">Update Info</Button>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).on('click', '.editbtn', function() {
		var id_user = $(this).attr("id");
		$.ajax({
			url: "<?= base_url('admin/view_akun'); ?>",
			method: 'POST',
			data: {
				id: id_user
			},
			dataType: 'JSON',
			success: function(data) {
				$('#formnama').val(data.nama);
				$('#formalamat').val(data.alamat);
				$('body').append(data);
				$('#editprofile').modal('show');
			}
		});
	});
	$(document).on('click', '.hapusbtn', function() {
		var id = $(this).attr('id');
		var nama = $(this).data('nama');
		Swal.fire({
			icon: 'warning',
			title: 'Hapus Akun ' + nama,
			text: 'Setelah Dihapus , Data Tidak Dapat Dikembalikan',
			showCancelButton: true,
			cancelButtonText: 'Batal',
			confirmButtonText: 'HAPUS',
			confirmButtonColor: 'red'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= base_url('admin/hapus_akun') ?>",
					data: {
						id: id
					},
					dataType: "text",
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: 'BERHASIL',
							text: 'Akun Berhasil Dihapus'
						}).then(
							(result) => document.location.href = "<?= base_url('admin/manajemen_akun') ?>");
					}
				});
			}
		});
	});
	$(document).on('click', '.aktifkan', function() {
		var id = $(this).data('id');
		Swal.fire({
			icon: 'question',
			title: 'Aktivasi',
			text: 'Tekan Tombol Aktifkan Untuk Mengaktifkan User',
			confirmButtonText: 'Aktifkan',
			showCancelButton: true,
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= base_url('Akun/aktivasi') ?>",
					data: {
						id: id
					},
					dataType: "text",
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: 'Akun Teraktivasi'
						});
						document.location.href = "<?= base_url('admin/manajemen_akun') ?>";
					}
				});
			}
		});
	});
	$(document).on('click', '.nonaktifkan', function() {
		var id = $(this).data('id');
		Swal.fire({
			icon: 'info',
			title: 'De Aktivasi',
			text: 'Tekan Tombol Nonaktifkan Untuk Menonaktifkan User',
			confirmButtonText: 'Nonaktifkan',
			confirmButtonColor: 'red',
			showCancelButton: true,
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= base_url('Akun/deaktivasi') ?>",
					data: {
						id: id
					},
					dataType: "text",
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: 'Akun Di Nonaktifkan'
						});
						document.location.href = "<?= base_url('admin/manajemen_akun') ?>";
					}
				});
			}
		});
	});
</script>
