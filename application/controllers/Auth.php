<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('form_validation');
	}
	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('Akun');
		}
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			[
				'required' => 'Bagian ini wajib diisi', 'valid_email' => 'Format Email Salah'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim',
			[
				'required' => 'Bagian ini wajib diisi',
			]
		);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('Auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			//user ada
			if ($user['is_active'] == 1) {
				//sudah diaktivasi maka cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'status_id' => $user['status_id'],
						'email' => $user['email']
					];
					$this->session->set_userdata($data);
					if ($data['status_id'] == 1) {
						redirect('Admin');
					} else
						redirect('Akun');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">LOGIN GAGAL !<br>PASSWORD SALAH</br></div>');
					redirect('Auth');
				}
			} else {
				//belum diaktivasi
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">LOGIN GAGAL !<br>AKUN ANDA BELUM DIAKTIVASI</br></div>');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">LOGIN GAGAL !<br>USER TIDAK DIKENAL</br></div>');
			redirect('Auth');
		}
	}
	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('Akun');
		} else {
			$data['title'] = 'Registrasi Akun';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('Auth/registrasi');
			$this->load->view('templates/auth_footer');
		}
	}
	public function logout()
	{
		$query = "DROP TABLE IF EXISTS `#rfid_temp`";
		$this->db->query($query);
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('status_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">ANDA SUDAH LOGOUT</div>');
		redirect('auth');
	}

	public function prosesregistrasi()
	{
		$now = time();
		// $img=getimagesize($this->input->post('image'),get_filenames($this->input->post('image')));
		// $imgcontent=addslashes(file_get_contents($img));
		$data = [
			'nama' => htmlspecialchars($this->input->post('name'), true),
			'email' => htmlspecialchars($this->input->post('email'), true),
			'image' => 'default.png',
			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
			'agama' => $this->input->post('agama'),
			'tanggal_lahir' => $this->input->post('tgllahir'),
			'notelp' => $this->input->post('notelp'),
			'status_id' => $this->input->post('status_id'),
			'is_active' => '0',
			'date_created' => time(),
			'key_pertanyaan' => $this->input->post('key'),
			'value_pertanyaan' => strtolower($this->input->post('value'))

		];
		$result = $this->db->insert('user', $data);
		if ($result) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">BERHASIL REGISTRASI, AKUN ANDA AKAN DI AKTIVASI OLEH ADMIN</div>');
			mkdir("./assets/img/profile/" . $data['nama']);
			copy("./assets/img/profile/default.png", "./assets/img/profile/" . $data['nama'] . "/default.png");
			redirect('Auth');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">REGISTRASI GAGAL, PERIKSA KEMBALI DATA ANDA !</div>');
			redirect('Auth/registration');
		}
	}
	public function cek_email()
	{
		$email=$this->input->post('email');
		$data=$this->db->get_where('user',['email'=>$email])->row_array();
		echo json_encode($data);
	}
	public function ganti_password()
	{
		$id=$this->input->post('id');
		$pass=password_hash($this->input->post('pass'),PASSWORD_DEFAULT);
		$this->db->where('id',$id);
		$this->db->update('user',['password'=>$pass]);
		
	}
}
