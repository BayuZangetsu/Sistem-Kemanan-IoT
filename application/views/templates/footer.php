</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Bayu Zangetsu Project&trade; <?= Date('Y'); ?></span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Anda Akan Logout</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Tekan Tombol Logout Untuk Mengakhiri Sesi Anda</div>
			<div class="modal-footer">
				<button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
				<a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
			</div>
		</div>
	</div>
</div>
<!-- Script untuk ubah akses -->
<!-- Jquery dan ajax -->
<script>
	$(document).ready(function() {
		$('.cekinput').on('click', function() {
			const menuId = $(this).data('menu');
			const statusId = $(this).data('status');
			$.ajax({
				url: "<?= base_url('admin/ubah_akses'); ?>",
				type: 'post',
				data: {
					menuId: menuId,
					statusId: statusId
				},
				success: function() {
					document.location.href = "<?= base_url('admin/edit_akses/'); ?>" + statusId;
				}
			});
		});

		$('.table2').DataTable({
			dom: 'Bfrtip',
			buttons: [{
				extend: 'pdfHtml5',
				orientation: 'potrait',
				pageSize: 'A4'
			}],
			fixedHeader: {
				header: true,
				footer: true
			},
			language: {
				paginate: {
					next: '<i class="fas fa-next"></i>Next'
				}
			}
		});
		$(function() {
			$(".preloader").delay(1000).fadeOut();
		});
	});

	// function buka_edit(){
	// 	var x = document.getElementById("editprofile");
	// 	if (x.style.display === "none") {
	//     	x.style.display = "block";
	//   	} else {
	//     	x.style.display = "none";
	//   	}
	// }
	function preview_gambar(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview')
					.attr('src', e.target.result)
					.width(300).height(300);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#editprofile').on('show', function() {
		$.ajax({
			url: "<?= base_url('Upload/TambahKartuBaru'); ?>",
			method: 'get',
			success: function(data) {
				$('#form_kartu').val(data.result);
			}
		})
	});
</script>
<script>
	//  $(document).ready(function(){
	function load_tempcard() {
		setInterval(function() {
			$.ajax({
				url: "<?= base_url('Temp_card/show') ?>"
			}).done(function(data) {
				$('#table-rfid').html(data);
			});
		}, 1000);
	}
	//   });	
	$(document).on('click', '.tambahkartu', function() {
		var id_user = $(this).attr("id");
		var nama_user = $(this).attr("data-nama_user");
		$('#id_user-kartu').val(id_user);
		$('#nama_user').val(nama_user);
	});
</script>
<script>
	function edit_table(id_jadwal, nama_kolom, isi_kolom) {
		$.ajax({
			type: "post",
			url: "<?= base_url('guru/edit_jadwal_guru') ?>",
			data: {
				id: id_jadwal,
				field: nama_kolom,
				data: isi_kolom
			},
			dataType: "text",
			success: function(response) {
				Swal.fire({
					icon: 'success',
					title: 'Berhasil !',
					text: 'Jadwal Berhasil Di Update'
				});
			}
		});

	}
	$(document).on('click', '#add_jadwal', function() {
		var id_user = $('#id_user').val();
		var id_kelas = $('#kelas_mapel').val();
		var hari = $('#hari_mapel').val();
		var lab = $('#lab_mapel').val();
		var jam = $('#jam_mapel').val();
		var jamselesai = $('#jamselesai_mapel').val();
		$.ajax({
			type: "post",
			url: "<?= base_url('guru/tambah_jadwal_guru') ?>",
			data: {
				id_user: id_user,
				id_kelas: id_kelas,
				hari: hari,
				lab: lab,
				jam: jam,
				jamselesai: jamselesai
			},
			dataType: "text",
			success: function(response) {
				Swal.fire({
					icon: 'success',
					title: 'Berhasil',
					text: 'Berhasil menambah jadwal baru',
				});
				document.location.href = "<?= base_url('Guru/jadwal_guru'); ?>"
			}
		});

	});
	//untuk edit kolom kelas
	$(document).on('click', '#kelas_jadwal', function() {
		if ($(this).find('select').length == 0) {
			$(this).empty();
			$tambah = `<select name="pilihan_kelas" id="pilihan_kelas" class="form-control">
	    <option>Pilih Kelas</option>
		<?php foreach ($listkelas as $lk) : ?>
	    <option value="<?= $lk['id'] ?>"><?= $lk['nama_kelas'] ?></option>
		<?php endforeach; ?>
	    </select>`;
			$(this).append($tambah);
		}
	});
	$(document).on('focusout', '#kelas_jadwal select', function() {
		var id_kelas = $(this).val(); //simpan value dari select ke variabel value
		var parent = $(this).parent();
		var text = $('option:selected', this).text();
		$(this).remove();
		parent.append(text); //tampilkan value ke cell
		var id_jadwal = parent.data('id2');
		// edit_table(id_jadwal,nama_kolom,isi_kolom)
		edit_table(id_jadwal, "id_kelas", id_kelas);
	});
	//end edit kolom kelas
	//edit kolom hari
	$(document).on('click', '#hari_jadwal', function() {
		if ($(this).find('select').length == 0) {
			$(this).empty();
			$tambah = `<select name="pilihan_hari" id="pilihan_hari" class="form-control">
    			<option >Pilih Satu</option>
				<option value="Senin">Senin</option>
				<option value="Selasa">Selasa</option>
				<option value="Rabu">Rabu</option>
				<option value="Kamis">Kamis</option>
				<option value="Jumat">Jumat</option>
				<option value="Sabtu">Sabtu</option>
    		</select>`;
			$(this).append($tambah);
		}
	});
	$(document).on('focusout', '#hari_jadwal select', function() {
		var value = $(this).val();
		var text = $('option:selected', this).text();
		var parent = $(this).parent();
		var id_jadwal = parent.data('id3');
		$(this).remove();
		parent.append(text);
		edit_table(id_jadwal, "hari", value);
	});
	//end edit hari
	//edit sesi
	$(document).on('click', '#lab_jadwal', function() {
		if ($(this).find('select').length == 0) {
			$(this).empty();
			$(this).append(`<select class="form-control">
		<option>Pilih R Lab</option>
		<?php foreach($listlab as $lb):?>
		<option value="<?=$lb['id_lab']?>"><?=$lb['nama_lab']?></option>
		<?php endforeach?>
		</select>`);
		}
	});
	$(document).on('focusout', '#lab_jadwal select', function() {
		var value = $(this).val();
		var text = $('option:selected', this).text();
		var parent = $(this).parent();
		var id_jadwal = parent.data('id4');
		$(this).remove();
		parent.append(text);
		edit_table(id_jadwal, "id_lab", value);
	});
	//end edit sesi
	//edit jam mulai
	$(document).on('click', '#jam_jadwal', function() {
		if ($(this).find('input').length == 0) {
			$(this).empty();
			$(this).append(`<input class="form-control" type="time">`);
		}
	});
	$(document).on('focusout', '#jam_jadwal input', function() {
		var value = $(this).val();
		// var text=$(this).text();
		var parent = $(this).parent();
		var id_jadwal = parent.data('id5');
		$(this).remove();
		parent.append(value + ":00 WIB");
		edit_table(id_jadwal, "jam", value);
	});
	//end edit jam mulai
	//edit jam selesai
	$(document).on('click', '#jamselesai_jadwal', function() {
		if ($(this).find('input').length == 0) {
			$(this).empty();
			$(this).append(`<input class="form-control" type="time">`);
		}
	});
	$(document).on('focusout', '#jamselesai_jadwal input', function() {
		var value = $(this).val();
		// var text=$(this).text();
		var parent = $(this).parent();
		var id_jadwal = parent.data('id6');
		$(this).remove();
		parent.append(value + ":00 WIB");
		edit_table(id_jadwal, "jamselesai", value);
	});
	//end edit jam selesai
	//untuk hapus jadwal
	$(document).on('click', '#btn_delete', function() {
		var id_jadwal = $(this).data('id7');
		// alert(id_jadwal);
		Swal.fire({
			title: 'Yakin Akan Menghapus Jadwal ?',
			text: "Jika sudah terhapus, anda perlu membuat lagi jika menginginkan jadwal yang sama",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) { //tombol hapus di pencet maka
				$.ajax({
					type: "post",
					url: "<?= base_url('guru/hapus_jadwal_user') ?>",
					data: {
						id_jadwal: id_jadwal
					},
					dataType: "text",
					success: function(response) {
						Swal.fire(
							'Terhapus',
							'Jadwal berhasil dihapus',
							'success');
						document.location.href = "<?= base_url('guru/jadwal_guru') ?>";
					}
				});
			}
		});
	});
	//end hapus jadwal
	function logout() {
		Swal.fire({
			title: 'LOGOUT',
			text: "Tekan Tombol Logout Untuk Mengakhiri Sesi Anda",
			icon: 'question',
			showCancelButton: false,
			confirmButtonColor: 'red',
			cancelButtonColor: 'blue',
			confirmButtonText: 'LOGOUT',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) { //tombol hapus di pencet maka
				document.location.href = "<?= base_url('auth/logout') ?>";
			}
		});
	}
</script>
</body>

</html>
