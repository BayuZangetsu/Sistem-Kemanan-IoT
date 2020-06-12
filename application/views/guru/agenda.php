<div class="container-fluid">
	<?=$this->session->flashdata('message');?>
	<div class="card-body">
		<div id='calendar'></div>
	</div>
</div>
<script>
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
				url: "<?= base_url('guru/cek_agenda'); ?>"
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
