<link rel="stylesheet" href="<?= base_url('assets/css/registrasi.css') ?>">
<div style="height:60px;"></div>
<div class="assessment-container container mx-auto">
	<div class="row">
		<?= $this->session->flashdata('message'); ?>
	</div>
	<div class="row">
		<div class="col-md-6 form-box mx-auto">
			<form role="form" autocomplete="off" class="registration-form" action="<?= base_url('auth/prosesregistrasi'); ?>" method="post">
				<fieldset>
					<div class="form-top pt-2">
						<div class="form-top-left">
							<h3><span>
									<i class="fa fa-calendar-check" aria-hidden="true"></i>
								</span> Registrasi Akun</h3>
						</div>
					</div>
					<div class="form-bottom">
						<!--dari sebelah  -->
						<div class="form-group">
							<input type="text" class="form-control form-control-user" id="name" placeholder="Masukan Nama Kamu" name="name" value="<?= set_value('name'); ?>">
							<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<input type="text" class="form-control form-control-user" autocomplete="new-password" id="email" placeholder="guru@example.com" name="email" value="<?= set_value('email'); ?>">
							<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<input type="password" class="form-control form-control-user" autocomplete="new-password" id="password1" name="password1" value="<?= set_value('password1'); ?>" placeholder="masukan password">
							<?= form_error('password1', '<small class="text-danger pl-4">', '</small>'); ?>
						</div>
						<!-- asli -->
						<button type="button" id="btn-next" class="btn btn-next">Next</button>
					</div>
				</fieldset>
				<fieldset>
					<div class="form-top">
						<div class="form-top-left">
							<h3><span>
									<i class="fa fa-calendar-check" aria-hidden="true"></i>
								</span> Registrasi Akun</h3>
						</div>
					</div>
					<div class="form-bottom">
						<center>
							<label for="status_akun">Pilih Jabatan Anda</label>
						</center>
						<div class="form-group">
							<select class="form-control" name="status_id" id="status_id">
								<option value="2">Guru</option>
								<option value="3">Staf / Pegawai</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" name="agama" id="agama">
								<option value="islam">Islam</option=>
								<option value="kristen protestan">Kristen Protestan</option>
								<option value="kristen katolik">Kristen Katolik</option>
								<option value="hindu">Hindu</option>
								<option value="budha">Budha</option>
								<option value="konghucu">Konghucu</option>
							</select>
						</div>
						<label for="tgllahir" class="text-small ml-2">Tanggal Lahir</label>
						<div class="form-group">
							<input type="date" class="form-control" id="tgllahir" name="tgllahir">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="notelp" id="notelp" placeholder="No Telepon">
						</div>
						<button type="button" id="btn-next" class="btn btn-previous">Sebelumnya</button>
						<button type="button" id="btn-next" class="btn btn-next">Next</button>
					</div>
				</fieldset>
				<fieldset>
						<h4 class="text-dark">Pertanyaan Keamanan</h4>
						<select class="form-control" name="key" id="key">
							<option value="1">Siapa Nama Guru SD Pertama mu?</option>
							<option value="2">Dimana Tempat Tinggal Ibumu</option>
							<option value="3">Siapa Nama Hewan Peliharaan Pertama mu?</option>
						</select>
					
					<div class="form-group p-3">
						<input type="text" class="form-control" name="value">
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-sm btn-previous">Sebelumnya</button>
						<button type="submit" class="btn btn-primary btn-sm">Register Account</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
