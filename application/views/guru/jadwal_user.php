<div class="container-fluid">
	<h1 class="h3 mb-1 text-gray-800"><?= $title; ?></h1>
	<h8 class="text-secondary">User Saat ini : <?= $user['nama'] ?></h8>
	<?= $this->session->flashdata('message'); ?>
	<?= $pesan ?>
	<div class="row">
		<div class="col-lg-4 mb-4">

		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card border-left-dark shadow">
				<h5 class="text-center pt-3 text-dark">Jadwal Mengajar</h5>
				<div class="col-lg mt-4 mb-4">
					<button class="btn btn-info btn-sm mb-4" id="btn_tambah" onclick="tampilkan()"><i class="fas fa-plus fa-fw"></i>&nbsp;Tampilkan Field Tambah</button>
					<table id="jd_guru" class="table table2 table-striped table-bordered" style="width: 100%">
						<thead>
							<tr>
								<th scope="col">No</th>
								<!-- <th scope="col">Guru</th> -->
								<th scope="col">Kelas</th>
								<th scope="col">Hari</th>
								<th scope="col">R Lab</th>
								<th scope="col">Jam Mulai</th>
								<th scope="col">Jam Selesai</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $p = 1;
							foreach ($jd_guru as $j) : ?>
								<tr>
									<th><?= $p; ?></th>
									<!-- <td contenteditable="true" data-id1="<?= $j['id_jadwal'] ?>"><?= $j['nama']; ?></td> -->
									<td id="kelas_jadwal" contenteditable="true" data-id2="<?= $j['id_jadwal'] ?>"><?= $j['nama_kelas']; ?></td>
									<td id="hari_jadwal" contenteditable="true" data-id3="<?= $j['id_jadwal'] ?>"><?= $j['hari']; ?></td>
									<td id="lab_jadwal" contenteditable="true" data-id4="<?= $j['id_jadwal'] ?>"><?= $j['nama_lab']; ?></td>
									<td id="jam_jadwal" contenteditable="true" data-id5="<?= $j['id_jadwal'] ?>"><?= $j['jam']; ?>&nbsp;WIB</td>
									<td id="jamselesai_jadwal" contenteditable="true" data-id6="<?= $j['id_jadwal'] ?>"><?= $j['jamselesai']; ?>&nbsp;WIB</td>
									<td contenteditable="true">
										<button id="btn_delete" data-id7="<?= $j['id_jadwal'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></button>
									</td>
								</tr>
							<?php $p++;
							endforeach; ?>
							<tr id="tambah_jadwal" style="display: none">
								<th></th>
								<!-- <td id="nama" contenteditable="true"><?= $user['nama'] ?></td> -->
								<input type="hidden" id="id_user" value="<?= $user['id']; ?>">
								<td id="kelas" contenteditable="true">
									<select class="form-control" name="kelas_mapel" id="kelas_mapel">
										<option>Pilih Satu</option>
										<?php foreach ($listkelas as $lk) : ?>
											<option value="<?= $lk['id'] ?>"><?= $lk['nama_kelas']; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td id="hari" contenteditable="true">
									<select class="form-control" name="hari_mapel" id="hari_mapel">
										<option>Pilih Satu</option>
										<option value="Senin">Senin</option>
										<option value="Selasa">Selasa</option>
										<option value="Rabu">Rabu</option>
										<option value="Kamis">Kamis</option>
										<option value="Jumat">Jumat</option>
										<option value="Sabtu">Sabtu</option>
									</select>
								</td>
								<td id="lab" contenteditable="true">
									<select class="form-control" name="lab_mapel" id="lab_mapel">
										<option>Pilih Satu</option>
										<?php foreach ($listlab as $lb) : ?>
											<option value="<?= $lb['id_lab'] ?>"><?= $lb['nama_lab'] ?></option>
										<?php endforeach ?>
									</select>
								</td>
								<td id="jam" contenteditable="true">
									<input id="jam_mapel" name="jam_mapel" type="time" class="form-control">
								</td>
								<td id="jamselesai" contenteditable="true">
									<input type="time" class="form-control" id="jamselesai_mapel" name="jamselesai_mapel">
								</td>
								<td>
									<button id="add_jadwal" class="btn btn-success btn-sm"><i class="fas fa-plus fa-fw"></i></button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function tampilkan() {
		var tambah = document.getElementById("tambah_jadwal");
		var tombol = document.getElementById("btn_tambah");
		if (tambah.style.display == "none") {
			tambah.style.display = "contents";
			tombol.innerText = "Sembunyikan Field Tambah";
		} else {
			tambah.style.display = "none";
			tombol.innerText = 'Tampilkan Field Tambah';
		}
	}
</script>
