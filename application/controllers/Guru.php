<?php
defined('BASEPATH') or exit('No direct script allowed');
class Guru extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_access();
		cek_kelengkapan();
		cek_mapel();
	}
	public function index()
	{
		$data['title'] = 'Panel Guru';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('guru/index', $data);
		$this->load->view('templates/footer');
	}

	// List Jadwal Mapel oleh Admin
	public function jadwal()
	{
		$data['title'] = 'Manajemen Jadwal';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->where_in('status_id', ["2"]);
		$this->db->where('is_active', "1");
		$data['userguru'] = $this->db->get_where('user', ['status_id' => "2", 'is_active' => "1"])->result_array();
		$data['listkelas'] = $this->db->get('kelas')->result_array();
		if ($data['user']['status_id'] == '2') {
			redirect('guru/jadwal_guru');
		}
		$query = "SELECT user.*,jadwal_ajar.*,kelas.*,lab.* FROM user,jadwal_ajar,kelas,lab WHERE user.id=jadwal_ajar.id_guru and kelas.id=jadwal_ajar.id_kelas AND lab.id_lab=jadwal_ajar.id_lab";
		$data['jadwal'] = $this->db->query($query)->result_array();
		// var_dump($data['jadwal']);die;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('guru/jadwal', $data);
		$this->load->view('templates/footer');
	}
	// Tambah List Jadwal Mapel oleh Admin
	public function tambah_jadwal_admin()
	{
		$id_user = $this->input->post('listuser');
		$id_kelas = $this->input->post('listkelas');
		$hari = $this->input->post('hari');
		$jam = $this->input->post('jam');
		$sesi = $this->input->post('sesi');
		$jamselesai = $this->input->post('jamselesai');
		$result = $this->db->insert('jadwal_ajar', ['id_guru' => $id_user, 'id_kelas' => $id_kelas, 'hari' => $hari, 'jam' => $jam, 'sesi' => $sesi, 'jamselesai' => $jamselesai]);
		if ($result == true) {
			$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Menambah Jadwal Guru</div>');
			redirect('guru/jadwal');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger mt-4">Gagal Menambah Jadwal Guru</div>');
			redirect('guru/jadwal');
		}
	}
	// List Jadwal Mapel oleh Guru
	public function jadwal_guru()
	{
		$data['title'] = 'Manajemen Jadwal';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['listkelas'] = $this->db->get('kelas')->result_array();
		$data['listlab'] = $this->db->get('lab')->result_array();
		// $query="SELECT `user`.*,`jadwal_ajar`.*,`kelas`.* from `user`,`jadwal_ajar`,`kelas` where  `user`.`id`=`jadwal_ajar`.`id_guru` and `kelas`.`id_kelas`=`jadwal_ajar`.`id_kelas` ";
		$query = "SELECT `user`.*,`jadwal_ajar`.*,`kelas`.*,`lab`.* 
			from `user`,`jadwal_ajar`,`kelas`,`lab` 
			where `user`.`id`=" . $data['user']['id'] . " 
			and `user`.`id`=`jadwal_ajar`.`id_guru` and `jadwal_ajar`.`id_kelas`=`kelas`.`id`
			and `jadwal_ajar`.`id_lab`=`lab`.`id_lab`";
		$data['jd_guru'] = $this->db->query($query)->result_array();
		// echo json_encode($data['jd_guru']);
		// die;
		if ($data['user']['no_kartu'] == "") {
			$data['pesan'] = '<div class="alert alert-danger">
			<div class="row">
			<div class="col-lg-1"><i class="fas fa-exclamation-triangle fa-5x"></i></div>
			<div class="col-lg-11">
			<ul>
			<li>Anda Belum mendaftarkan No Kartu</li>
			<li>Anda tidak akan dapat mengakses ruangan tanpa kartu</li>
			<li>Harap segera hubungi admin</li></ul>
			</div></div>
			</div>';
		} else {
			$data['pesan'] = null;
			// '<div class="alert alert-success">Selamat Datang</div>';
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('guru/jadwal_user', $data);
		$this->load->view('templates/footer');
	}
	// Tambah List Jadwal Mapel oleh Guru
	public function tambah_jadwal_guru()
	{
		$user = $this->input->post('id_user');
		$id_kelas = $this->input->post('id_kelas');
		$hari = $this->input->post('hari');
		$lab = $this->input->post('lab');
		$jam = $this->input->post('jam');
		$jamselesai = $this->input->post('jamselesai');
		$this->db->insert('jadwal_ajar', ['id_guru' => $user, 'id_kelas' => $id_kelas, 'hari' => $hari, 'jam' => $jam, 'jamselesai' => $jamselesai, 'id_lab' => $lab]);
		$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Menambah Guru</div>');
		redirect('guru/jadwal_guru');
	}
	public function edit_jadwal_guru()
	{
		$id_jadwal = $this->input->post('id');
		$field = $this->input->post('field');
		$data = $this->input->post('data');
		// $this->db->table('jadwal_ajar');
		$this->db->set([$field => $data]);
		$this->db->where('id_jadwal', $id_jadwal);
		$result = $this->db->update('jadwal_ajar');
		if ($result) {
			$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Mengupdate Jadwal</div>');
			redirect('guru/jadwal_guru');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger mt-4">Gagal Mengupdate Jadwal</div>');
			redirect('guru/jadwal_guru');
		}
	}
	public function hapus_jadwal_user()
	{
		$id_jadwal = $this->input->post('id_jadwal');
		$result = $this->db->delete('jadwal_ajar', ['id_jadwal' => $id_jadwal]);
		if ($result) {
			echo "sukses";
		} else {
			echo "gagal";
		}
	}
	public function agenda()
	{
		$data['title'] = 'Agenda';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('guru/agenda',$data);
		$this->load->view('templates/footer');
	}
	public function cek_agenda()
	{
		$data['data'] = $this->db->get('agenda')->result();
		foreach ($data['data'] as $key => $value) {
			$data['agenda'][$key]['title'] = $value->title;
			$data['agenda'][$key]['start'] = $value->waktu_mulai;
			$data['agenda'][$key]['end'] = $value->waktu_berakhir;
			if ($value->tipe == "1") {
				$data['agenda'][$key]['backgroundColor'] = "red";
				$data['agenda'][$key]['textColor'] = "white";
			} else {
				$data['agenda'][$key]['backgroundColor'] = "blue";
				$data['agenda'][$key]['textColor'] = "white";
			}
		}
		echo json_encode($data['agenda']);
	}
}
