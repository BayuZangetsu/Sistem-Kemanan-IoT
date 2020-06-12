<div class="container-fluid">
	<p class="text-lg"><?= $title ?></p>
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<div class="col-lg-8">
			<div class="card border-left-primary shadow mx-auto">
				<h5 class="text-center pt-3 text-primary">List Daftar Kelas</h5>
				<div class="col-lg mt-4 mb-4">
					<table class="table table2 table-striped table-bordered" style="width: 100%">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Kelas</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($list as $l) : ?>
								<tr>
									<th><?= $i ?></th>
									<td><?= $l['nama_kelas']; ?></td>
									<td>
										<button class="btn btn-danger" id="<?= $l['id'] ?>" onclick="hapus(this.id)">Hapus</button>
										<button class="btn btn-success" id="edit" data-id="<?= $l['id'] ?>" data-nama="<?= $l['nama_kelas'] ?>" onclick="edit(this)">Edit</button>
									</td>
								</tr>
							<?php $i++;
							endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card border-left-success shadow">
				<h5 class="text-success text-center pt-3">Tambah Ruang Kelas Baru</h5>
				<div class="col mr-2">
					<form action="<?= base_url('kelas/tambah_kelas'); ?>" method="post">
						<div class="text-xs font-weight-bold text-success text-uppercase m-2">
							Masukan Nama Kelas Baru
						</div>
						<input type="text" class="form-control" name="namakelas" placeholder="XII TKJ 5">
						<div class="text-center pt-3 mx-auto">
							<input type="submit" class="btn btn-success align-items-center">
						</div>
					</form>
					<div class="text-danger">
						<p>Catatan</p>
						<ul>
							<li>Isi Format Nama Kelas dengan Format Tingkat Kelas (spasi) Jurusan (spasi) No kelas</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function hapus(id) {
		Swal.fire({
			title: 'Hapus Kelas',
			icon: 'question',
			text: 'Anda yakin ingin menghapus Kelas ini?',
			showCancelButton: true,
			cancelButtonText: 'Batal',
			cancelButtonColor: 'blue',
			confirmButtonText: 'Hapus',
			confirmButtonColor: 'red'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= base_url('Kelas/hapus_kelas') ?>",
					data: {
						id: id
					},
					dataType: "text",
					success: function(response) {
						Swal.fire({
							title: 'Berhasil',
							icon: 'success',
							text: 'Berhasil Menghapus kelas'
						}).then(
							document.location.href = "<?= base_url('kelas/kelas_index') ?>"
						);
					}
				});
			}
		})
	}

	function edit(e) {
		var id = $(e).data('id');
		var nama = $(e).data('nama');
		swal({
			title: 'Ganti Nama Kelas',
			content: {
				element: 'input',
				attributes: {
					placeholder: 'X RPL 1',
					value: nama
				}
			},
			buttons: {
				cancel: 'Batal',
				confirm: 'Ganti Nama',
			},
			dangerMode: true,
			closeOnClickOutside: true
		}).then((result) => {
			if (result == null) {
				swal("Aksi Dibatalkan");
			} else {
				swal({
					title: 'Konfirmasi',
					text: `Yakin Ingin Merubah Nama Kelas Menjadi ${result} ?`,
					icon: 'warning',
					closeOnClickOutside: true
				}).then((hasil) => {
					if (hasil != null)
						$.ajax({
							type: "post",
							url: "<?= base_url('kelas/edit_kelas') ?>",
							data: {
								id: id,
								nama_kelas: result
							},
							dataType: "text",
							success: function(response) {
								swal("Good Job !","Berhasil Merubah Nama Kelas", "success");
								document.location.href = "<?= base_url('kelas/kelas_index') ?>";
							}
						});
				});
			}
		});
	}
</script>
