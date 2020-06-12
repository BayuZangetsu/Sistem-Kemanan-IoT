<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<div class="col-lg-8 mx-auto">
			<h6 class="text-primary">LIST NAMA GURU DAN MATA PELAJARAN YANG DIAMPU</h6>
			<div class="card border-left-primary pt-3 pb-3">
				<div class="container">
					<table id="listguru" class="table table2 table-striped table-bordered">
						<thead>
							<tr class="text-center">
								<th scope="col">No</th>
								<th scope="col">Nama</th>
								<th scope="col">Alamat</th>
								<th scope="col">Mapel</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($guru as $g) : ?>
								<tr>
									<th><?= $i; ?></th>
									<td><?= $g['nama']; ?></td>
									<td><?= $g['alamat']; ?></td>
									<td><?= $g['nama_mapel']; ?></td>
									<td>
										<div class="row">
											<button class="btn btn-info btn-sm m-1" data-id_user="<?= $g['id_user'] ?>" data-mapel="<?= $g['nama_mapel'] ?>" data-id_guru="<?= $g['id_guru'] ?>" data-nama="<?= $g['nama'] ?> " onclick="edit_guru(this)"><span class="fas fa-pen"></span> edit</button>
											<button onclick="hapus_guru(this)" data-id_guru="<?= $g['id_guru'] ?>" class="btn btn-danger btn-sm m-1"><span class="fas fa-trash"></span> Hapus</button>
										</div>
									</td>
								</tr>
							<?php $i++;
							endforeach; ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
		<div class="col-lg-4 mx-auto">
			<h6 class="text-primary">Tambah Guru Dari User Yang Sudah Terdaftar</h6>
			<div class="col mx-auto">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<form action="<?= base_url('admin/tambah_guru'); ?>" method="post">
									<div class="text-xs font-weight-bold text-success text-uppercase m-2">Pilih
										User
									</div>
									<select id="listuser" name="listuser" class="form-control">
										<option value="" class="text-secondary">Pilih satu</option>
										<?php foreach ($userguru as $ug) : ?>
											<option value="<?= $ug['id']; ?>"><?= $ug['nama']; ?></option>
										<?php endforeach; ?>
									</select>
									<div class="text-xs font-weight-bold text-success text-uppercase m-2">Pilih
										Mapel
										Yang Diampu
									</div>
									<select class="form-control" name="listmapel" id="listmapel">
										<option value="">Pilih satu</option>
										<?php foreach ($listmapel as $lm) : ?>
											<option value="<?= $lm['id']; ?>"><?= $lm['nama_mapel']; ?></option>
										<?php endforeach; ?>
									</select>
									<div class="text-center pt-3 mx-auto">
										<input type="submit" class="btn btn-success align-items-center">
									</div>
								</form>
								<div class="text-danger">
									<p>Catatan</p>
									<ul>
										<li>Jika Nama Tidak Ditemukan, Pastikan Akun User Sudah Berstatus Aktif !</li>
										<li>Hanya User Yang Terdaftar Sebagai Guru Yang Dapat Ditambahkan</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function edit_guru(e) {
		var id_guru = $(e).data('id_guru');
		var id_user = $(e).data('id_user');
		var nama = $(e).data('nama');
		var mapel = $(e).data('mapel');
		Swal.fire({
			title: 'Edit Mapel Guru',
			html: `<h5 class="text-left">Nama Guru : ${nama}</h5>
			<h6 class="text-left">Mapel Saat Ini : ${mapel}</h6>
			<h6 class="mt-3 text-center">Pilih Mapel Baru</h6>
			<select id="list" class="form-control">
			<option disabled>Pilih Mapel</option>
			<?php foreach ($listmapel as $l) : ?>
			<option value="<?= $l['id'] ?>"><?= $l['nama_mapel'] ?></option>
			<?php endforeach ?>
			</select>
			`,
			preConfirm: () => {
				mapelbaru = document.getElementById('list').value;
				$.ajax({
					type: "post",
					url: "<?= base_url('admin/edit_guru') ?>",
					data: {
						id_guru: id_guru,
						id_user: id_user,
						id_mapel: mapelbaru
					},
					dataType: "text",
					success: function(response) {
						swal('Berhasil', 'Data Berhasil Diubah', 'success')
							.then((result) => {
								document.location.href = "<?= base_url('admin/daftar_guru') ?>";
							})
					}
				});
			}
		});
	}

	function hapus_guru(e) {
		var id_guru = $(e).data('id_guru');
		Swal.fire({
			title: 'Hapus Data',
			text: 'Yakin akan menghapus data ? Data yang terhapus tidak dapat dikembalikan !',
			showCancelButton: true,
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				$.get("<?= base_url('admin/hapus_guru/') ?>" + id_guru);
				swal('Berhasil', 'Data Terhapus', 'success').then((ok) => {
					document.location.href = "<?= base_url('admin/daftar_guru') ?>";
				});
			}
			else{
				swal('Batal','Aksi Dibatalkan');
			}
		})
	}
</script>
