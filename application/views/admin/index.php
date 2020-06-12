<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		// var events = json_encode($agenda);
		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: ['interaction', 'dayGrid', 'list'],
			header: {
				left: 'none',
				center: 'title',
				right: 'listDay,listWeek,dayGridMonth'
			},
			defaultDate: '<?= date(DATE_ISO8601, time()) ?>',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: "<?= base_url('admin/cek_agenda'); ?>"
			},
			footer: {
				left: 'prevYear',
				center: 'prev,today,next',
				right: 'nextYear'
			},
			views: {
				listDay: {
					buttonText: 'Harian'
				},
				listWeek: {
					buttonText: 'Mingguan'
				},
				dayGridMonth: {
					buttonText: 'Bulanan'
				},
			},
			locale: 'id',
			buttonText: {
				today: 'Hari ini',
			},
			icon: {
				prevYear: 'fa-angle-double-left'
			}
		});

		calendar.render();
	});
</script>
<!-- Begin Page Content -->
<div class="container-fluid">
<?=$this->session->flashdata('message')?>
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-dark-800"><?= $title; ?></h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Daftar Total Admin -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Admin</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($admin); ?> Orang</div>
							<a href="<?=base_url('Admin/kelola')?>">Kelola Admin</a>
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-3x text-danger-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Daftar Total Guru -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
								Total Guru</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($total_guru); ?> Orang</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-3x text-danger-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Total Staf -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Staf</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($staf) ?> Orang</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-3x text-warning-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Total Mapel -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">TOTAL MATA PELAJARAN
							</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($mapel) ?> Buah</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-comments fa-3x text-info-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Total Ruangan -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								TOTAL KELAS</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($kelas) ?> Buah</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-3x text-success-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Content Row -->
	<div class="row">
		<!-- Calendar -->
		<div class="col">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Kalender Kegiatan</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div id='calendar'></div>
				</div>
			</div>
		</div>
		<!-- </div> -->



	</div>

	<!-- /.container-fluid -->
	<!-- Modal -->
	<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="ediprofileTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: aqua">
					<h5 class="modal-title" id="ediprofileTitle">Edit Profile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('admin/manajemen_akun'); ?>" method="post">
					<div class="modal-body">
						<!-- <div class="form-group"> -->
						<div class="md-form mb-5">
							<i class="fas prefix fa-fw fa-user"></i>
							<input type="text" class="form-control validate" id="formnama" name="formnama">
							<!-- <label for="#formnama">Nama Lengkap</label> -->
						</div>
						<label for="#formalamat">Alamat Lengkap</label>
						<input type="text" class="form-control" id="formalamat" name="formalamat" placeholder="">
						</!-->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
