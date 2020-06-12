<?php
// defined('basepath')or exit('do direct access allowed');
class Upload extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function tambahKartuBaru()
	{
		$id_kartu = $this->input->get('CardID');
		$cari_user = $this->db->get_where('user', ['no_kartu' => $id_kartu])->row_array();
		$cek_temp = $this->db->get_where('#rfid_temp', ['id_kartu' => $id_kartu])->row_array();
		if ($cek_temp) {
			if ($cari_user) {
				echo 'Kartu Terdaftar';
				// exit();
			} else {
				echo 'Kartu Tersedia';
				// exit();
			}
		} else {
			if ($cari_user) {
				$this->db->insert('#rfid_temp', ['id_kartu' => $id_kartu, 'status' => 'Kartu Terdaftar']);
				echo 'Kartu Terdaftar';
			} else {
				$this->db->insert('#rfid_temp', ['id_kartu' => $id_kartu, 'status' => 'Kartu Tersedia']);
				echo 'Kartu Tersedia';
			}
		}
	}
	public function masuk()
	{
		$jamsekarang = strtotime(date('H:i', time()));
		$harisekarang = date('w');
		$Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",);
		$hari = $Hari[$harisekarang];
		$id_kartu = $this->input->get('CardID');
		$id_device = $this->input->get('deviceID');
		$cari_user = $this->db->get_where('user', ['no_kartu' => $id_kartu])->row_array();
		if ($cari_user) {
			$getjadwal = $this->db->get_where('jadwal_ajar', ['id_guru' => $cari_user['id'], 'id_lab' => $id_device,'hari'=>$hari])->result_array();
			if ($getjadwal) {
				foreach ($getjadwal as $jadwal) :
					$mulai = strtotime($jadwal['jam']);
					$selesai = strtotime($jadwal['jamselesai']);
					$ruang = $jadwal['id_lab'];
					if ($hari == $jadwal['hari']) {
						if ($id_device == $ruang) {
							if ($jamsekarang >= $mulai && $jamsekarang <= $selesai) {
								echo "login";
								$data = [
									'id_user' => $cari_user['id'],
									'id_device' => $id_device,
									'status' => 'Berhasil Login',
									'status_code' => '1'
								];
								$this->db->insert('log_device', $data);
							} else {
								echo "gagal";
								$data = [
									'id_user' => $cari_user['id'],
									'id_device' => $id_device,
									'status' => 'Gagal, Telat',
									'status_code' => '0'
								];
								$this->db->insert('log_device', $data);
							}
						} else {
							echo "gagal";
							$data = [
								'id_user' => $cari_user['id'],
								'id_device' => $id_device,
								'status' => 'Anda Tidak Ada Jadwal Praktikum Hari Ini',
								'status_code' => '2'
							];
							$this->db->insert('log_device', $data);
						}
					} else {
						echo "gagal";
						$data = [
							'id_user' => $cari_user['id'],
							'id_device' => $id_device,
							'status' => 'Tidak Ada Jadwal Hari Ini',
							'status_code' => '3'
						];
						$this->db->insert('log_device', $data);
					}
				endforeach;
			} else {
				echo "gagal";
				$data = [
					'id_user' => $cari_user['id'],
					'id_device' => $id_device,
					'status' => 'Tidak Ada Jadwal Mengajar Hari Ini',
					'status_code' => '3'
				];
				$this->db->insert('log_device', $data);
			}
		} else {
			echo "gagal";
			$data = [
				'id_user' => 1,
				'id_device' => $id_device,
				'status' => 'User Tidak Dikenal',
				'status_code' => '0'
			];
			$this->db->insert('log_device', $data);
		}
	}

	function updateUser()
	{
		$kartu = $this->input->post('no_kartu');
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->update('user', ['no_kartu' => $kartu]);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">BERHASIL MENAMBAHKAN INFO KARTU</div>');
			redirect('Admin/manajemen_akun');
			// echo "success";
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">GAGAL MENAMBAHKAN INFO KARTU</div>');
			// echo "gagal";
			redirect('Admin/manajemen_akun');
		}
	}
	public function getuser()
	{
		$id = $this->input->post('id');
		$result = $this->db->get_where('user', ['id' => $id])->row_array();
		return json_encode($result);
	}
	public function index()
	{
		$this->load->view('heheboi');
	}
}
