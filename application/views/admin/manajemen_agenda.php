<div class="container-fluid">
	<?=$this->session->flashdata('message')?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<button class="btn btn-success m-3 p-2" onclick="tambah()"><span class="fas fa-plus"></span>&nbsp;Tambah Baru</button>
				<div class="card-header text-center bg-white">
					<h5>List Agenda</h5>
				</div>
				<div class="card-body">
					<h5 class="card-title">Daftar Agenda Kegiatan</h5>
					<table class="table table2 table-striped">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Nama Acara</th>
								<th scope="col">Tipe</th>
								<th scope="col">Waktu Mulai</th>
								<th scope="col">Waktu Selesai</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							$this->load->helper('tanggal_indonesia_helper');
							foreach ($agenda as $a) :
								if ($a['tipe'] == 1) {
									$tipe = 'badge-danger badge-pill';
									$teks = 'Rapat Khusus';
								} else {
									$tipe = 'badge-primary badge-pill';
									$teks = 'Rapat Umum';
								}
							?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $a['title'] ?></td>
									<td><span class="badge <?= $tipe ?>"><?= $teks ?></span></td>
									<td>
										<?= tgl_indonesia($a['waktu_mulai']); ?>
										<br><?= date('H:i', strtotime($a['waktu_mulai'])); ?>&nbsp;WIB
									</td>
									<td>
										<?= tgl_indonesia($a['waktu_berakhir']); ?>
										<br><?= date('H:i', strtotime($a['waktu_berakhir'])); ?>&nbsp;WIB
									</td>
									<td>
										<button class="btn btn-success" data-judul="<?= $a['title'] ?>" data-id="<?= $a['id'] ?>" data-tipe="<?= $a['tipe'] ?>" data-mulai="<?= date('Y-m-d\TH:i', strtotime($a['waktu_mulai'])) ?>" data-akhir="<?= date('Y-m-d\TH:i', strtotime($a['waktu_berakhir'])) ?>" onclick="edit(this)">
											<i class="fas fa-pen"></i> Edit</button>
										<button class="btn btn-danger" data-judul="<?= $a['title'] ?>" data-id="<?= $a['id'] ?>" data-tipe="<?= $a['tipe'] ?>" data-mulai="<?= date('Y-m-d\TH:i', strtotime($a['waktu_mulai'])) ?>" data-akhir="<?= date('Y-m-d\TH:i', strtotime($a['waktu_berakhir'])) ?>" onclick="hapus(this)"><i class="fas fa-trash"></i> Hapus</button>
									</td>
								</tr>
							<?php $i++;
							endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function hapus(e) {
		var id = $(e).data('id');
		var nama = $(e).data('judul');
		Swal.fire({
			title: 'Hapus Agenda',
			icon: 'warning',
			html: `<h4>Yakin Akan Menghapus Agenda <br><strong>${nama}</strong> ?</br></h4> \n Data Yang Terhapus Tidak Dapat Dikembalikan !`,
			showCancelButton: true,
			cancelButtonText: 'Batal',
			confirmButtonText: 'Hapus',
			confirmButtonColor: 'red'
		}).then((hasil) => {
			if (hasil.value) {
				$.ajax({
					type: "post",
					url: "<?= base_url('admin/hapus_agenda') ?>",
					data: {
						id: id
					},
					dataType: "text",
					success: function(response) {
						swal('Berhasil', 'Data Terhapus', 'success');
						document.location.href = "<?= base_url('admin/agenda') ?>";
					}
				});
			}
		})
	}

	function tambah() {
		Swal.fire({
			title: 'Tambah Agenda Baru',
			html: `<div class="col">
					<div class="card text-left">
						<div class="card-header bg-white text-center">
							<h5 class="card-title">Tambah Pengumuman Agenda Baru</h5>
						</div>
						<div class="card-body">
							<form action="" method="post">
								<div class="form-group">
									<p>Masukan Judul Acara</p>
									<input type="text" name="judul" id="judul" class="form-control">
								</div>
								<div class="form-group">
									<p>Tipe Acara</p>
									<div class="form-check">
										<input type="radio" name="acara" id="khusus" class="form-check-input" value="1">
										<label for="khusus" class="form-check-label">Rapat Khusus</label>
									</div>
									<div class="form-check">
										<input type="radio" name="acara" id="umum" class="form-check-input" value="2">
										<label for="umum" class="form-check-label">Rapat Umum</label>
									</div>
								</div>
								<div class="form-group">
									<p>Masukan Tanggal dan Jam Mulai</p>
									<input type="datetime-local" name="tgl_mulai" id="tgl_mulai" class="form-control">
								</div>
								<div class="form-group">
									<p>Masukan Tanggal dan Jam Selesai</p>
									<input type="datetime-local" name="tgl_selesai" id="tgl_selesai" class="form-control">
								</div>
							</form>
						</div>
					</div>
				</div>`,
			focusConfirm: true,
			preConfirm: () => {
				var judul_baru = document.getElementById('judul').value;
				var tipe_baru = $("input[name=acara]:checked").val();
				var tgl_mulaibaru = document.getElementById('tgl_mulai').value;
				var tgl_akhirbaru = document.getElementById('tgl_selesai').value;
				// alert(judul_baru + tipe_baru+tgl_mulaibaru+tgl_akhirbaru);
				$.ajax({
					type: "post",
					url: "<?= base_url('admin/tambah_agenda') ?>",
					data: {
						judul: judul_baru,
						tipe: tipe_baru,
						mulai: tgl_mulaibaru,
						akhir: tgl_akhirbaru
					},
					dataType: "text",
					success: function(response) {
						swal('Berhasil Menambah data', 'Berhasil', 'success');
						document.location.href = "<?= base_url('Admin/agenda') ?>";
					}
				});
			}
		})
	}

	function edit(e) {
		var id = $(e).data('id');
		var judul = $(e).data('judul');
		var tipe = $(e).data('tipe');
		var mulai = $(e).data('mulai');
		var akhir = $(e).data('akhir');
		if (tipe == 1) {
			var rad1 = 'checked';
			var rad2 = '';
		} else {
			var rad1 = '';
			var rad2 = 'checked';
		}
		Swal.fire({
			title: 'Edit Agenda',
			html: `<div class="col">
					<div class="card text-left">
						<div class="card-header bg-white text-center">
							<h5 class="card-title">Edit Pengumuman Agenda</h5>
						</div>
						<div class="card-body">
							<form action="" method="post">
								<div class="form-group">
									<p>Masukan Judul Acara</p>
									<input type="text" name="judul" id="judul" class="form-control" value="${judul}">
								</div>
								<div class="form-group">
									<p>Tipe Acara</p>
									<div class="form-check">
										<input type="radio" name="acara" id="khusus" class="form-check-input" value="1" ${rad1}>
										<label for="khusus" class="form-check-label">Rapat Khusus</label>
									</div>
									<div class="form-check">
										<input type="radio" name="acara" id="umum" class="form-check-input" value="2" ${rad2}>
										<label for="umum" class="form-check-label">Rapat Umum</label>
									</div>
								</div>
								<div class="form-group">
									<p>Masukan Tanggal dan Jam Mulai</p>
									<input type="datetime-local" name="tgl_mulai" id="tgl_mulai" class="form-control" value="${mulai}">
								</div>
								<div class="form-group">
									<p>Masukan Tanggal dan Jam Selesai</p>
									<input type="datetime-local" name="tgl_selesai" id="tgl_selesai" class="form-control" value="${akhir}">
								</div>
							</form>
						</div>
					</div>
				</div>`,
			focusConfirm: true,
			preConfirm: () => {
				var judul_baru = document.getElementById('judul').value;
				var tipe_baru = $("input[name=acara]:checked").val();
				var tgl_mulaibaru = document.getElementById('tgl_mulai').value;
				var tgl_akhirbaru = document.getElementById('tgl_selesai').value;
				// alert(judul_baru + tipe_baru+tgl_mulaibaru+tgl_akhirbaru);
				$.ajax({
					type: "post",
					url: "<?= base_url('admin/edit_agenda') ?>",
					data: {
						id: id,
						judul: judul_baru,
						tipe: tipe_baru,
						mulai: tgl_mulaibaru,
						akhir: tgl_akhirbaru
					},
					dataType: "text",
					success: function(response) {
						swal('Berhasil merubah data', 'Berhasil', 'success');
						document.location.href = "<?= base_url('Admin/agenda') ?>";
					}
				});
			}
		})
	}
</script>
