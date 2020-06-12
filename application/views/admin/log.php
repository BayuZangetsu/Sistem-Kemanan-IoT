<div class="container-fluid">
	<?= $this->session->flashdata('message') ?>
	<h1><span><i class="fas fa-history"></i></span> Log Device</h1>
	<div class="row">
		<div class="col-md-6">
			<div class="card border-left-primary">
				<table class="m-2">
					<h5 class="text-center">Filter Daftar</h5>
					<tr>
						<td>Hari</td>
						<td><input type="text" name="hari" id="hari" class="form-control" onchange="coba(this)"></td>
					</tr>
					<tr>
						<td>Ruangan</td>
						<td><input type="text" name="lab" id="lab" class="form-control" onchange="coba(this)"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card border-left-danger">
				<table class="m-2">
					<h5 class="text-center">Hapus Log</h5>
					<tr>
						<td>Dari Hari</td>
						<td><input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control"></td>
					</tr>
					<tr>
						<td>Sampai Hari</td>
						<td><input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control"></td>
					</tr>
				</table>
				<Button class="btn btn-danger ml-5 mr-5 mt-2 mb-2" onclick="hapus_log()"><i class="fas-fa-trash"></i> Hapus</Button>
			</div>
		</div>
	</div>
	<div class="col m-2">
		<table class="table table2 table-striped table-bordered">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">User</th>
					<th scope="col">Ruangan</th>
					<th scope="col">Hari, Tanggal</th>
					<th scope="col">Jam</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				$this->load->helper('tanggal_indonesia_helper');
				foreach ($log as $l) :
					switch ($l['status_code']) {
						case '0':
							$warna = 'red';
							$text = 'white';
							break;
						case '1':
							$warna = 'green';
							$text = 'white';
							break;
						case '2':
							$warna = 'orange';
							$text = 'white';
							break;
						case '3':
							$warna = 'purple';
							$text = 'white';
							break;
					}
				?>
					<tr style="background: <?= $warna ?>">
						<th style="color:<?= $text ?>"><?= $i ?></th>
						<td style="color:<?= $text ?>"><?= $l['nama'] ?></td>
						<td style="color:<?= $text ?>"><?= $l['nama_lab'] ?></td>
						<td style="color:<?= $text ?>"><?= tgl_indonesia($l['jam_login']) ?></td>
						<td style="color:<?= $text ?>"><?= date('H:i', strtotime($l['jam_login'])) ?> WIB</td>
						<td style="color:<?= $text ?>"><?= $l['status'] ?></td>
					</tr>
				<?php $i++;
				endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	function coba(e) {
		var table = $('.table').DataTable();
		var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		var id = e.id;
		var isi = e.value;
		switch (id) {
			case 'hari':
				table
					.columns(3)
					.search(isi)
					.draw();
				break;
			case 'lab':
				table
					.columns(2)
					.search(isi)
					.draw();
				break;
		}

	}
	function hapus_log(){
		var mulai=document.getElementById('tgl_mulai').value;
		var akhir=document.getElementById('tgl_akhir').value;
		$.ajax({
			url: "<?=base_url('admin/hapus_log/')?>"+mulai+"/"+akhir,
			success: function (response) {
				// alert(response);
				if(response == 0){
					//error
					swal('Kesalahan','Tanggal Tidak tercatat pada database, Periksa kembali data Anda !','warning');
				}
				else{
					//success
				swal('Berhasil','Berhasil Menghapus Log','success');
				setTimeout(location.reload(),3000);
				}
			}
		});
		
	}
</script>
