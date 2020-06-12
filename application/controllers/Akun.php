<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Akun extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//   check_access();
		$this->load->library('upload');
		if (!$this->session->has_userdata('email')) {
			redirect('auth');
		}
		cek_kelengkapan();
		cek_mapel();
	}
	public function index()
	{
		$data['title'] = 'Akun Saya';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $data['mapel']=$this->db->get_where('daftar_guru',['id_guru'=>$data['user']['id']])->row_array();
		$query = "SELECT * from daftar_guru,user,daftar_mapel where user.id=" . $data['user']['id'] . " and user.id=daftar_guru.id_user and daftar_mapel.id=daftar_guru.id_mapel";
		$data['mapel'] = $this->db->query($query)->row_array();
		$data['listmapel'] = $this->db->get('daftar_mapel')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('akun/akunsaya', $data);
		$this->load->view('templates/footer');
	}
	public function upload_foto()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dir = "./assets/img/profile/" . $data['user']['nama'];
		// echo $dir;die;
		if (!is_dir($dir)) {
			echo mkdir($dir, true);
			// die;
		}
		$config = array(
			'upload_path' => "./assets/img/profile/" . $data['user']['nama'],
			'allowed_types' => "gif|jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "1280",
			'max_width' => "1280"
		);
		$this->upload->initialize($config);
		// $this->load->library('upload', $config);
		if (!$this->upload->do_upload('gambar')) {
			$error = array('error' => $this->upload->display_errors());
			// $this->load->view('v_upload', $error);
			$this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');
			redirect('akun');
		} else {
			// delete_files()
			unlink($dir . "/" . $data['user']['image']);
			// die;
			$hasil_upload = array('upload_data' => $this->upload->data());
			$nama_file = $hasil_upload['upload_data']['file_name'];
			$this->db->set('image', $nama_file);
			$this->db->where('id', $data['user']['id']);
			// echo $data['user']['id'];die;
			$this->db->update('user');
			$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Mengganti Foto Profil</div>');
			redirect('akun');
		}
	}
	public function aktivasi()
	{
		$id = $this->input->post('id');
		$this->db->set('is_active', 1);
		$this->db->where('id', $id);
		$this->db->update('user');
	}
	public function deaktivasi()
	{
		$id = $this->input->post('id');
		$this->db->set('is_active', 0);
		$this->db->where('id', $id);
		$this->db->update('user');
	}
	public function update_profile()
	{
		$nama = $this->input->post('nama');
		$nama_awal = $this->input->post('nama_awal');
		$ttl = $this->input->post('ttl');
		$agama = $this->input->post('agama');
		$alamat = $this->input->post('alamat');
		$notelp = $this->input->post('notelp');
		$email = $this->input->post('email');
		$id = $this->input->post('id');
		$data = [
			'nama' => $nama,
			'tanggal_lahir' => $ttl,
			'alamat' => $alamat,
			'agama' => $agama,
			'email' => $email,
			'notelp' => $notelp
		];
		$this->db->where('id', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Mengupdate Profil</div>');
		// var_dump($result);
		rename("./assets/img/profile/" . $nama_awal, "./assets/img/profile/" . $nama);
		redirect('Akun');
	}
	public function ubah_sandi()
	{
		$this->form_validation->set_rules(
			'sandi_lama',
			'lama',
			'callback_cek_password'
		);
		$this->form_validation->set_rules('sandi_baru1', 'baru1', 'required');
		$this->form_validation->set_rules('sandi_baru2', 'baru2', 'required|matches[sandi_baru1]');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal Merubah Sandi</div>');
			$data['title'] = 'Akun Saya';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('akun/akunsaya', $data);
			$this->load->view('templates/footer');
		} else {
			$this->_katasandi();
		}
	}
	public function cek_password($passlama)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$pass = $data['user']['password'];
		if (password_verify($passlama, $pass) == false) {
			$this->form_validation->set_message('cek_password', 'Sandi Tidak Sama dengan Record Database !');
			return false;
		}
		return true;
	}
	private function _katasandi()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$passbaru = $this->input->post('sandi_baru1');
		$hash = password_hash($passbaru, PASSWORD_DEFAULT);
		$this->db->where('id', $data['user']['id']);
		$this->db->update('user', ['password' => $hash]);
		$this->session->set_flashdata('sandi_ganti', '<div class="alert alert-success">Password Berhasil Diubah, Silahkan Login Ulang</div>');
		redirect('Auth/logout');
	}
	public function update_pertanyaan()
	{
		$id = $this->input->post('id');
		$key = $this->input->post('key');
		$value = $this->input->post('value');
		$this->db->where('id', $id);
		$this->db->update('user', ['key_pertanyaan' => $key, 'value_pertanyaan' => $value]);
	}
	public function ubah_mapel()
	{
		$id = $this->input->post('id');
		$mapel = $this->input->post('mapel');
		$cek_id=$this->db->get_where('daftar_guru',['id_user'=>$id])->row_array();
		if(!$cek_id==null){
			$this->db->where('id_user', $id);
			$this->db->update('daftar_guru',['id_mapel'=>$mapel]);
		}
		else{
			$this->db->insert('daftar_guru',['id_user'=>$id,'id_mapel'=>$mapel]);
		}
	}
}
