<div class="container-fluid">
	<?= $this->session->flashdata('message') ?>
	<h3><?= $title ?></h3>
	<button class="btn btn-success m-3" onclick="tambahadmin()"><i class="fas fa-plus"> Tambah Admin</i></button>
	<table class="table">
		<thead>
			<tr>
				<td>No</td>
				<td>Nama</td>
				<td>Alamat</td>
				<td>Email</td>
				<td>Status</td>
				<td>Opsi</td>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;
			foreach ($admin as $a) :
				if ($a['is_active'] == "1") {
					$status_akun = "Teraktivasi";
					$warna_teks = "green";
					$tombolaktivasi = '<a href="#!" data-id="' . $a['id'] . '"class="badge badge-danger nonaktifkan" onclick="deaktivasi(this)">Nonaktifkan</a>';
				} else {
					$status_akun = "Belum Aktif";
					$warna_teks = "red";
					$tombolaktivasi = '<a href="#!" data-id="' . $a['id'] . '"class="badge badge-info aktifkan" onclick="aktivasi(this)">Aktifkan</a>';
				}
			?>
				<tr>
					<td><?= $i ?></td>
					<td><?= $a['nama'] ?></td>
					<td><?= $a['alamat'] ?></td>
					<td><?= $a['email'] ?></td>
					<td class="text-center" style="color:<?= $warna_teks; ?>">
						<?= $status_akun; ?>
						<?= $tombolaktivasi; ?>

					</td>
					<td>
						<button data-id="<?= $a['id']; ?>" data-nama="<?= $a['nama'] ?>" class="btn btn-danger mb-3" onclick="hapus(this)"><i class="fa fa-fw fa-trash"></i></button>
					</td>
				</tr>
			<?php $i++;
			endforeach; ?>
		</tbody>
	</table>
</div>
<script>
	function hapus(e) {
		var id = $(e).data('id');
		var nama = $(e).data('nama');
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
							(result) => document.location.href = "<?= base_url('admin/kelola') ?>");
					}
				});
			}
		});
	}

	function tambahadmin() {
		Swal.fire({
			title: 'Tambah Admin',
			html: `<div class="text-left">
				<p>Masukan Nama</p>
				<input class="form-control" type="text" id="nama">
				<p>Email</p>
				<input type="email" class="form-control" id="email">
				<p>Masukan Alamat</p>
				<textarea class="form-control" id="alamat"></textarea>
				<div class="card mt-5">
					<div class="card-header">
						<h5>Informasi</h5>
					</div>
					<div class="card-body">
						<ul>
							<li>Setelah akun dibuat silahkan Lengkapi Profil Di menu Akun Saya</li>
							<li>Password default adalah 12345678 silahkan ganti di menu Akun saya</li>
						</ul>
					</div>
				</div>
			</div>`,
			focusConfirm: true,
			preConfirm: () => {
				var nama = document.getElementById('nama').value;
				var email = document.getElementById('email').value;
				var alamat = document.getElementById('alamat').value;
				$.ajax({
					type: "post",
					url: "<?= base_url('admin/tambahadmin') ?>",
					data: {
						nama: nama,
						email: email,
						alamat: alamat
					},
					dataType: "text",
					success: function(response) {
						swal('Berhasil', 'Akun Admin Berhasil Dibuat', 'success');
						document.location.href = "<?= base_url('admin/kelola') ?>"
					}
				});
			}
		})
	}

	function aktivasi(e) {
		var id=$(e).data('id');
		$.ajax({
			type: "post",
			url: "<?=base_url('akun/aktivasi')?>",
			data: {id:id},
			dataType: "text",
			success: function (response) {
				swal('Berhasil','Berhasil Mengaktivasi','success');
				location.reload();
			}
		});
	}

	function deaktivasi(e) {
		var id=$(e).data('id');
		$.ajax({
			type: "post",
			url: "<?=base_url('akun/deaktivasi')?>",
			data: {id:id},
			dataType: "text",
			success: function (response) {
				swal('Berhasil','Berhasil Menonaktifkan','success');
				location.reload();
			}
		});
	}
</script>
