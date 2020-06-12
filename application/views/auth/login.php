<div class="container">
	<!-- Outer Row -->
	<div class="row justify-content-center">
		<div class="col-lg-7">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Login Untuk Mengakses</h1>
								</div>
								<?= $this->session->flashdata('message'); ?>
								<?= $this->session->flashdata('sandi_ganti'); ?>
								<form class="user" method="post" action="<?= base_url('auth') ?>">
									<div class="form-group">
										<input type="text" value="<?= set_value('email'); ?>" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
										<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<input type="password" value="<?= set_value('password'); ?>" class="form-control form-control-user" id="password" name="password" placeholder="Password">
										<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">
										Login
									</button>
								</form>
								<hr>
								<div class="text-center">
									<a href="#!" class="small" onclick="lupa()">Lupa Password?</a>
								</div>
								<div class="text-center">
									<a class="small" href="<?= base_url('auth/registration'); ?>">Registrasi Akun</a>
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
	function lupa() {
		Swal.fire({
			title: 'Lupa Password',
			html: `<p>Masukan Alamat email yang terdafatar</p>
			<input type="email" id="lupa_email" class="form-control">`,
			confirmButtontext: 'Next',
			focusConfirm: true,
			preConfirm: () => {
				var email = document.getElementById('lupa_email').value;
				$.ajax({
					type: "post",
					url: "<?= base_url('auth/cek_email') ?>",
					data: {
						email: email
					},
					dataType: "text",
					success: function(response) {
						var json = $.parseJSON(response);
						var p1 = "Siapa Nama Guru SD Pertama mu?";
						var p2 = "Dimana Tempat Tinggal Ibumu";
						var p3 = "Siapa Nama Hewan Peliharaan Pertama mu?";
						if (json['key_pertanyaan'] == 1)
							var selected = p1;
						else if (json['key_pertanyaan'] == 2)
							var selected = p2;
						else var selected = p3;
						Swal.fire({
							title: 'Konfirmasi Pertanyaan',
							html: `${selected}<br>Jawab
							<input type="text" id="jawaban" class="form-control">`,
							preConfirm:()=>{
								var jawaban=document.getElementById('jawaban').value;
								if(jawaban===json['value_pertanyaan']){
									Swal.fire({
										title:'Reset Password',
										html:`<h4>Masukan Password Baru</h4>
										<input type="password" class="form-control" id="password1">
										<h4>Masukan Password Lagi</h4>
										<input type="password" class="form-control" id="password2">`,
										preConfirm:()=>{
											var pass1=document.getElementById('password1').value;
											var pass2=document.getElementById('password2').value;
											if(pass1!==pass2){
												Swal.fire('Password Tidak Sama !');
											}
											else{
												$.ajax({
													type: "post",
													url: "<?=base_url('auth/ganti_password')?>",
													data: {
														id:json['id'],
														pass:pass1
													},
													dataType: "text",
													success: function (response) {
														Swal.fire('Berhasil','Berhasil Merubah Sandi','success');
														document.location.href="<?=base_url('auth')?>"
													}
												});
											}
										}
									});
								}
								else{
									Swal.fire('Jawaban Salah !');
								}
							}
						})
					}
				});
			}
		});
	}
</script>
