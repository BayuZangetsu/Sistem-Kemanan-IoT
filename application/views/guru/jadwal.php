<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8">
			<h1 class="h3 mb-1 text-gray-800"><?=$title;?></h1>
			<h8 class="text-secondary">User Saat ini : <?=$user['nama']?></h8>
		</div>
		<div class="col-lg-4 text-center">
			<button id="toggle_form" class="btn btn-dark" onclick="tampil_form()">Tampilkan Form Tambah Data</button>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 mb-4">
			<?=$this->session->flashdata('message');?>
		</div>
	</div>
	<div class="row">
        <div class="col-lg-12" id="tabel_jadwal">
            <div class="card border-left-dark shadow mx-auto">
				<h5 class="text-center pt-3 text-dark">Jadwal Mengajar</h5>
                <div class="col-lg mt-4 mb-4">
                    <table id="jadwal" class="table table2 table-striped table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Guru</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Lab</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php $p=1;
							$this->load->helper('tanggal_indonesia_helper');
							foreach ($jadwal as $j):
							// $hari=tgl_indonesia($j['hari'])?>
                            <tr>
                                <th><?=$p;?></th>
                                <td data-id1="<?=$j['id']?>"><?=$j['nama'];?></td>
                                <td data-id2="<?=$j['id']?>"><?=$j['nama_kelas'];?></td>
                                <td data-id3="<?=$j['id']?>"><?=$j['hari'];?></td>
                                <td data-id4="<?=$j['id']?>"><?=$j['nama_lab'];?></td>
                                <td data-id5="<?=$j['id']?>"><?=date('H:i',strtotime($j['jam']));?> WIB</td>
                                <td data-id6="<?=$j['id']?>"><?=date('H:i',strtotime($j['jamselesai']));?> WIB</td>
								<td class="text-center">
									<button class="btn btn-success btn-sm m-1"data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-fw fa-pen"></i>&nbsp; Edit</button>
									<button class="btn btn-danger btn-sm m-1"><i class="fas fa-fw fa-trash"></i>&nbsp;Hapus</button>
								</td>
                                </tr>
                            <?php $p++; endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
		<div class="col-lg-4" id="form_tambah" style="display: none">
            <div class="card border-left-danger shadow">
                <h5 class="text-danger text-center pt-3">Tambah Jadwal Baru</h5>
                <div class="col mr-2">
                    <form action="<?=base_url('guru/tambah_jadwal_admin');?>" method="post">
                    <div class="text-xs font-weight-bold text-dark text-uppercase m-2">Pilih
                            User
                        </div>
                    <select id="listuser" name="listuser" class="form-control">
                            <option value="" class="text-dark">Pilih satu</option>
                            <?php foreach($userguru as $ug):?>
                            <option value="<?=$ug['id'];?>"><?=$ug['nama'];?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="text-xs font-weight-bold text-dark text-uppercase m-2">
                           Pilih Kelas
                        </div>
                        <select class="form-control" name="listkelas" id="listkelas">
                                        <option value="">Pilih satu</option>
                                        <?php foreach($listkelas as $lm):?>
                                        <option value="<?=$lm['id'];?>"><?=$lm['nama_kelas'];?></option>
                                        <?php endforeach;?>
                                    </select>
                        <div class="text-xs font-weight-bold text-dark text-uppercase m-2">
                            Masukan Hari
						</div>
						<select class="form-control" name="hari" id="hari">
                                        <option value="">Pilih satu</option>
							<option value="Senin">Senin</option>
							<option value="Selasa">Selasa</option>
							<option value="Rabu">Rabu</option>
							<option value="Kamis">Kamis</option>
							<option value="Jumat">Jum'at</option>
							<option value="Sabtu">Sabtu</option>
						</select>
						<!-- <input type="text" id="datepicker" name="hari" class="form-control datepicker"> -->
                        <!-- <input type="text" class="form-control"id="datepicker" name="hari"> -->
                        <div class="text-xs font-weight-bold text-dark text-uppercase m-2">
                            Masukan lab
                        </div>
                        <select name="lab" id="lab"class="form-control">
                            <option value="">Pilih satu</option>
							<?php foreach($listlab as $lb):?>
							<option value="<?=$lb['id_lab']?>"><?=$lb['nama_lab']?></option>
							<?php endforeach?>
						</select>
						<div class="text-xs font-weight-bold text-dark text-uppercase m-2">
                            Masukan Jam mulai
                        </div>
                        <input type="time" class="form-control" name="jam">
                        <div class="text-xs font-weight-bold text-dark text-uppercase m-2">
                            Masukan Jam selesai
                        </div>
                        <input type="time" class="form-control" name="jamselesai">
						<div class="card-footer">
							<div class="text-center pt-3 mx-auto">
								<input type="submit" class="btn btn-danger align-items-center">
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	function tampil_form() { 
		var form=document.getElementById("form_tambah");
		var tabel=document.getElementById("tabel_jadwal");
		var tombol=document.getElementById("toggle_form");
		if(form.style.display==="none"){
			form.style.display="block";
			tabel.className="col-lg-8";
			tombol.innerText="Sembunyikan Form Tambah Jadwal";
		}
		else{
			form.style.display="none";
			tabel.className="col-lg-12";
			tombol.innerText="Tampilkan Form Tambah Jadwal";
		}
	 }
</script>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
	<div class="modal-header">Edit Jadwal</div>
    <div class="modal-content">
      ...
    </div>
  </div>
</div>
