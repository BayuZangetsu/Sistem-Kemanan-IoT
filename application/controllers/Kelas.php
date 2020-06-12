<?php
defined('BASEPATH') or exit('no another script allowed');
class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_access();
	}
	public function index()
	{
		$data['title'] = 'Manajemen Lab';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $query="SELECT `kelas`.*,`user`.`id`,`user`.`nama`from `kelas`,`user` where `kelas`.`id_guru`=`user`.`id`";
		// $data['list']=$this->db->query($query)->result_array();
		$data['list'] = $this->db->get('lab')->result_array();
		$data['userguru'] = $this->db->get_where('user', ['status_id' => 2])->result_array();
		// echo json_encode($data['list']);die;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('kelas/lab', $data);
		$this->load->view('templates/footer', $data);
	}
	public function tambah_lab()
	{
		$namakelas = $this->input->post('namalab');
		$keterangan = $this->input->post('keterangan');
		$data = [
			'nama_lab' => $namakelas,
			'Keterangan' => $keterangan
		];
		$this->db->insert('lab', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Menambah Lab</div>');
		redirect('kelas');
	}
	public function hapus_lab()
	{
		$id = $this->input->post('id_kelas');
		$this->db->delete('lab', ['id_lab' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Menghapus Lab</div>');
		redirect('kelas');
	}
	public function edit_lab()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$ket = $this->input->post('ket');
		$data = [
			'nama_lab' => $nama,
			'Keterangan' => $ket
		];
		$this->db->where('id_lab',$id);
		$this->db->update('lab',$data);
	}
	public function kelas_index()
	{
		$data['title'] = 'Manajemen Kelas';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['list'] = $this->db->get('kelas')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('kelas/kelas', $data);
		$this->load->view('templates/footer', $data);
	}
	public function tambah_kelas()
	{
		$namakelas = $this->input->post('namakelas');
		$this->db->insert('kelas', ['nama_kelas' => $namakelas]);
		$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Menambah Kelas</div>');
		redirect('kelas/kelas_index');
	}
	public function hapus_kelas()
	{
		$id = $this->input->post('id');
		$this->db->delete('kelas', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Menghapus Kelas</div>');
		redirect('kelas/kelas_index');
	}
	public function edit_kelas()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_kelas');
		$this->db->where('id',$id);
		$this->db->update('kelas', ['nama_kelas' => $nama]);
	}
}
