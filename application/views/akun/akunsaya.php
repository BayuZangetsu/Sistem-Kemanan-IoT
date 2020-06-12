<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Manajemen Profile</h1>
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<!-- nyacak -->
		<!-- end nyacak -->
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="card border-dark pt-3 mb-2">
				<div class="col text-right">
					<button type="button" data-toggle="modal" data-target="#logoutModal" class="btn btn-sm btn-outline-secondary mt-3"><i class="fas fa-pen">&nbsp;Ubah Foto</i></button>
					<img src="<?= base_url('assets/img/profile/') . $user['nama'] . "/" . $user['image']; ?>" class="img-rounded d-block mx-auto" style="height:250px; width:250px;">
				</div>
				<div class="col mb-3">
					<div class="card border-0 pt-3">
						<h5 class="card-text">
							<i class="fas fa-user"></i>&ensp;
							<b><?= $user['nama']; ?></b></h5>
						<h6 class="card-text">
							<i class="fas fa-envelope"></i>&ensp;
							<?= $user['email']; ?></h6>
					</div>
				</div>
			</div>
			<?= $this->session->flashdata('message'); ?>
		</div>
		<div class="col-lg-8">
			<div class="card border-primary border-left-dark p-2 m-3">
				<div class="row">
					<div class="col-md-1">
						<i class="fas fa-edit fa-fw fa-3x"></i>
					</div>
					<div class="col-md-11">
						<h5 class="text-primary m-1">Ini merupakan halaman untuk mengedit informasi mengenai data diri Anda</h5>
					</div>
				</div>
			</div>
			<div class="button-group p-2 m-3">
				<?php switch ($user['status_id']) {
					case 1:
						$hide = "hidden";
						break;
					case 2:
						$hide = '';
						break;
				} ?>
				<a href="#collapse_edit" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse_edit" class="btn btn-primary btn-sm">Edit Profile</a>
				<a href="#collapse_sandi" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse_sandi" class="btn btn-sm btn-primary">Ganti Sandi</a>
				<a href="#collapse_pertanyaan" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse_sandi" class="btn btn-sm btn-primary">Atur Pertanyaan Keamanan</a>
				<a href="#collapse_mapel" <?= $hide ?> data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse_sandi" class="btn btn-sm btn-primary">Atur Mapel</a>

			</div>
			<div class="collapse" id="collapse_edit">
				<div class="card mt-4">
					<div class="card-header bg-info text-light">
						<i class="fas fa-edit fa-fw"></i>
						Edit Profile
					</div>
					<form action="<?= base_url('Akun/update_profile') ?>" method="POST">
						<div class="card-body">
							<div class="row">
								<input type="hidden" name="id" value="<?= $user['id'] ?>">
								<input type="hidden" name="nama_awal" value="<?= $user['nama'] ?>">
								<div class="col-md-6">
									<p>Masukan Nama</p>
									<input class="form-control" type="text" name="nama" id="nama" value="<?= $user['nama'] ?>" placeholder="Masukan Nama">
								</div>
								<div class="col-md-6">
									<p>Tanggal Lahir</p>
									<input type="text" placeholder="<?= $user['tanggal_lahir'] ?>" onfocus="this.type='Date'" name="ttl" class="form-control" id="ttl" value="<?= $user['tanggal_lahir'] ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<p>Agama</p>
									<Select name="agama" id="agama" class="form-control">
										<option disabled value="<?= $user['agama'] ?>"><?= $user['agama'] ?></option>
										<option value="Islam">Islam</option>
										<option value="Kristen Protestan">Kristen Protestan</option>
										<option value="Kristen Katolik">Kristen Katolik</option>
										<option value="Hindu">Hindu</option>
										<option value="Budha">Budha</option>
										<option value="Konghucu">Konghucu</option>
									</Select>
								</div>
								<div class="col-md-6">
									<p>No Telepon</p>
									<input type="number" class="form-control" name="notelp" id="notelp" value="<?= $user['notelp'] ?>" placeholder="Masukan No Telp">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<p>Masukan Email</p>
									<input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email" value="<?= $user['email'] ?>">
								</div>
								<div class="col-md-6">
									<p>Alamat Lengkap</p>
									<textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control"><?= $user['alamat'] ?></textarea>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Update Profile</button>
						</div>
					</form>
				</div>
			</div>
			<div class="collapse" id="collapse_sandi">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Ubah Sandi Akun Anda</h5>
						<form action="<?= base_url('akun/ubah_sandi') ?>" method="post">
							<div class="form-group">
								<p>Masukan Sandi Lama</p>
								<input type="password" class="form-control" name="sandi_lama" id="sandi_lama">
								<?= form_error('sandi_lama', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group">
								<p>Masukan Sandi Baru</p>
								<input type="password" class="form-control" name="sandi_baru1" id="sandi_baru1">
								<?= form_error('sandi_baru1', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group">
								<p>Konfirmasi Sandi Baru</p>
								<input type="password" class="form-control" name="sandi_baru2" id="sandi_baru2">
								<?= form_error('sandi_baru2', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary">Ganti Sandi</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="collapse" id="collapse_pertanyaan">
				<div class="card">
					<div class="card-header border-left-info">
						<h5><strong>Pertanyaan Keamanan</strong> </h5>
						<h6><span class="text-danger">*&nbsp;</span>Pertanyaan kemanan wajib di isi untuk keperluan verifikasi ketika Anda lupa sandi akun Anda</h6>
					</div>
					<div class="card-body border-left-info">
						<h6>Pilih Pertanyaan Keamanan</h6>
						<select name="pertanyaan" id="pertanyaan" class="form-control">
							<option>Pilih Satu</option>
							<?php switch ($user['key_pertanyaan']) {
								case 1:
									$a = 'selected';
									$b = '';
									$c = '';
									break;
								case 2:
									$a = '';
									$b = 'selected';
									$c = '';
									break;
								case 3:
									$a = '';
									$b = '';
									$c = 'selected';
									break;
								default:
									$a = '';
									$b = '';
									$c = '';

									break;
							} ?>
							<option value="1" <?= $a ?>>Siapa Nama Guru SD Pertama mu?</option>
							<option value="2" <?= $b ?>>Dimana Tempat Tinggal Ibumu</option>
							<option value="3" <?= $c ?>>Siapa Nama Hewan Peliharaan Pertama mu?</option>
						</select>
						<h6>Jawaban Anda</h6>
						<input type="text" name="jawaban" id="jawaban" required class="form-control" value="<?= $user['value_pertanyaan'] ?>">
					</div>
					<div class="card-footer">
						<button onclick="update_jawaban()" class="btn btn-info">Update Jawaban</button>
					</div>
				</div>
			</div>
			<div class="collapse" id="collapse_mapel">
				<div class="card">
					<div class="card-header bg-white border-left-dark">Atur Mata Pelajaran Yang Diampu</div>
					<div class="card-body border-left-dark bg-white">
						<?php if ($mapel == null) {
							$nama_mapel = 'Belum Ditentukan';
						} else $nama_mapel = $mapel['nama_mapel']; ?>
						<h6 class="text-danger">Mapel Saat Ini : <strong><?= $nama_mapel ?></strong></h6>
						<h6>Pilih Mapel</h6>
						<select name="mapel" id="mapel" class="form-control">
							<option>Pilih Satu</option>
							<?php foreach ($listmapel as $l) : ?>
								<option value="<?= $l['id'] ?>"><?= $l['nama_mapel'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="card-footer border-left-dark bg-white">
						<button class="btn btn-info" onclick="ubah_mapel()">Ubah Mapel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Foto Profile Baru</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body mx-auto">
				<div class="image area mx-auto p-3">
					<img src="#" alt="preview" id="preview" class="img-fluid rounded shadow-sm mx-auto d-block">
				</div>
				<?= form_open_multipart(base_url('akun/upload_foto')) ?>
				<div class="input-group mb-3">
					<div class="custom-file">
						<input type="file" name="gambar" class="custom-file-input" id="upload" onchange="preview_gambar(this)">
						<label class="custom-file-label" for="upload">Choose file</label>
					</div>
					<div class="input-group-append">
						<button type="submit" class="btn btn-primary">Upload</button>
						<!-- <span class="input-group-text" id="">Upload</span> -->
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function update_jawaban() {
		var id = "<?= $user['id'] ?>";
		var key = document.getElementById('pertanyaan').value;
		var value = document.getElementById('jawaban').value;
		$.ajax({
			type: "post",
			url: "<?= base_url('akun/update_pertanyaan') ?>",
			data: {
				id: id,
				key: key,
				value: value
			},
			dataType: "text",
			success: function(response) {
				swal('Berhasil', 'Berhasil Merubah Jawaban', 'success').then((ok) => {
					if (ok.value)
						location.reload()
				});
			}
		});
	}

	function ubah_mapel() {
		var mapel = document.getElementById('mapel').value;
		var id = "<?= $user['id'] ?>";
		$.ajax({
			type: "post",
			url: "<?= base_url('akun/ubah_mapel') ?>",
			data: {
				id: id,
				mapel: mapel
			},
			dataType: "text",
			success: function(response) {
				swal('Berhasil', 'Berhasil Merubah Mapel', 'success')
					.then(setTimeout(location.reload(), 3000));
			}
		});
	}
</script>
<!-- /.container-fluid -->

<!-- End of Main Content -->
