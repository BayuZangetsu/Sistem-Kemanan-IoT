<div class="container-fluid">
	<p class="text-lg"><?= $title ?></p>
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<div class="col-lg-8">
			<div class="card border-left-primary shadow mx-auto">
				<h5 class="text-center pt-3 text-primary">List Daftar Laboratorium</h5>
				<div class="col-lg mt-4 mb-4">
					<table class="table table2 table-striped table-bordered" style="width: 100%">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Kelas</th>
								<th scope="col">Keterangan</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($list as $l) : ?>
								<tr>
									<th><?= $i ?></th>
									<td><?= $l['nama_lab']; ?></td>
									<td><?= $l['Keterangan']; ?></td>
									<td>
										<button class="btn btn-danger" id="<?= $l['id_lab'] ?>" onclick="hapus(this.id)">Hapus</button>
										<button class="btn btn-success" id="edit" data-ket="<?= $l['Keterangan'] ?>" data-nama="<?= $l['nama_lab'] ?>" data-id="<?= $l['id_lab'] ?>" onclick="edit(this)">Edit</button>
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
				<h5 class="text-success text-center pt-3">Tambah Ruang Lab Baru</h5>
				<div class="col mr-2">
					<form action="<?= base_url('kelas/tambah_lab'); ?>" method="post">
						<div class="text-xs font-weight-bold text-success text-uppercase m-2">
							Masukan Nama Lab Baru
						</div>
						<input type="text" class="form-control" name="namalab" placeholder="Lab Komputer 5">
						<div class="text-xs font-weight-bold text-success text-uppercase m-2">Keterangan</div>

						<textarea name="keterangan" rows="4" cols="30" class="form-control"></textarea>
						<div class="text-center pt-3 mx-auto">
							<input type="submit" class="btn btn-success align-items-center">
						</div>
					</form>
					<div class="text-danger">
						<p>Catatan</p>
						<ul>
							<li>Isi Format Nama Lab dengan Format Lab (spasi) Nama Lab (spasi) No Lab</li>
							<li>Isi Keterangan dengan detail penggunaan Lab</li>
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
			title: 'Hapus Lab',
			icon: 'question',
			text: 'Anda yakin ingin menghapus Lab ini?',
			showCancelButton: true,
			cancelButtonText: 'Batal',
			cancelButtonColor: 'blue',
			confirmButtonText: 'Hapus',
			confirmButtonColor: 'red'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= base_url('Kelas/hapus_lab') ?>",
					data: {
						id_kelas: id
					},
					dataType: "text",
					success: function(response) {
						Swal.fire({
							title: 'Berhasil',
							icon: 'success',
							text: 'Berhasil Menghapus Lab'
						}).then(
							document.location.href = "<?= base_url('kelas') ?>"
						);
					}
				});
			}
		});
	}

	function edit(e) {
		var id = $(e).data('id');
		var nama = $(e).data('nama');
		var ket = $(e).data('ket');
		Swal.fire({
			title: 'Edit Lab',
			text: 'Isi Form Berikut',
			html: `<input id="swal-nama" class="swal2-input" value="${nama}">` +
				`<input id="swal-ket" class="swal2-input" value="${ket}">`,
			focusConfirm: true,
			preConfirm: () => {
				var new_nama=document.getElementById('swal-nama').value;
				var new_ket=document.getElementById('swal-ket').value;
				$.ajax({
					type: "post",
					url: "<?=base_url('kelas/edit_lab')?>",
					data: {
						id:id,
						nama:new_nama,
						ket:new_ket
					},
					dataType: "text",
					success: function (response) {
						swal('Berhasil merubah data','Berhasil','success');
						document.location.href="<?=base_url('kelas')?>";
					}
				});
			}
		})
	}
	// function edit() {
	// 	var id = $('#edit').data('id');
	// 	var nama = $('#edit').data('nama');
	// 	swal({
	// 		text: 'Edit Nama Lab',
	// 		content: {
	// 			element: 'input',
	// 			placeholder: "Lab Comp 5",
	// 			type: "text",
	// 			value: nama,
	// 		}
	// 	}).then((result)=>{
	// 		swal({
	// 			text:`Yakin Mengganti Nama Lab Menjadi ${result}`,
	// 			icon:'warning',
	// 			buttons:{
	// 				cancel:true,
	// 				confirm:true
	// 			} 
	// 		}).then((confirm)=>{
	// 			$.ajax({
	// 				type: "post",
	// 				url: "<?= base_url('kelas/edit_lab') ?>",
	// 				data: {
	// 					nama_kelas:result
	// 				},
	// 				dataType: "text",
	// 				success: function (response) {
	// 					swal('Berhasil Merubah Nama Lab','Berhasil','Success');
	// 					document.location.href="<?= base_url('kelas') ?>";
	// 				}
	// 			});
	// 		})
	// 	})
	// }
</script>
