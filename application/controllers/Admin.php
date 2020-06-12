<?php
defined('BASEPATH') or exit('no another script allowed');
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_access();
		$this->load->model('Model_guru', 'guru');
		cek_kelengkapan();
	}
	public function index()
	{
		$data['title'] = 'Dashboard Admin';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $data['data']=$this->db->get('agenda')->result();
		$data['total_guru'] = $this->db->get('daftar_guru')->result_array();
		$query = "CREATE TABLE IF NOT EXISTS `#rfid_temp`(`id` int primary key not null AUTO_INCREMENT,`id_kartu` text,`status` text)";
		$this->db->query($query);
		$data['staf'] = $this->db->get_where('user', ['status_id' => 3])->result_array();
		$data['admin'] = $this->db->get_where('user', ['status_id' => 1])->result_array();
		$data['mapel'] = $this->db->get('daftar_mapel')->result_array();
		$data['kelas'] = $this->db->get('kelas')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}
	public function manajemen_akun()
	{
		$data['title'] = 'Manajemen Akun';
		$this->db->where('status_id !=', 1);
		$data['daftar_user'] = $this->db->get('user')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/manajemen_akun', $data);
		$this->load->view('templates/footer');
	}
	public function manajemen_akses()
	{
		$data['title'] = 'Manajemen Akses';
		$id = $this->input->post('access');
		// $data['accessList']=$this->db->get_where('user_access_menu',['status_id'=>$id]);
		$data['user'] = $this->db->get('user')->row_array();
		$data['status_user'] = $this->db->get('status_user')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/manajemen_akses', $data);
		$this->load->view('templates/footer');


		//tangkap menu tambah
		// $datainput=$this->input->post('newrole');
		// $this->db->insert('status_user',$datainput);
	}
	public function hapus_akses()
	{
		//tangkap menu hapus
		$id_status = $this->input->post('id_status');
		$this->db->delete('status_user', ['id' => $id_status]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Menghapus Role</div>');
		redirect('admin/manajemen_akses');
	}
	public function tambah_role()
	{
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get('status_user')->row_array();
		$urutan = $result['id'] + 1;
		$data = $this->input->post('newrole');
		$this->db->insert('status_user', ['id' => $urutan, 'status' => $data]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Menambah Role</div>');
		redirect('admin/manajemen_akses');
	}
	public function edit_nama_role()
	{
		$id_status = $this->input->post('id_status');
		$namabaru = $this->input->post('newstatusname');
		$this->db->where('id', $id_status);
		$this->db->update('status_user', ['status' => $namabaru]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Merubah Role</div>');
		redirect('admin/manajemen_akses');
	}
	// ini untuk masuk tampilan
	public function edit_akses($id)
	{
		$data['title'] = 'Edit Akses';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['status'] = $this->db->get_where('status_user', ['id' => $id])->row_array();

		$this->db->where('id!=', 1); //akses admin tidak dapat di off kan, bisa kacau nanti
		$data['menu'] = $this->db->get('menu_user')->result_array();


		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/edit_akses', $data);
		$this->load->view('templates/footer');
	}
	// ini untuk akses checklist
	public function ubah_akses()
	{
		$statusId = $this->input->post('statusId');
		$menuId = $this->input->post('menuId');
		$data = [
			'menu_id' => $menuId,
			'status_id' => $statusId
		];
		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success">Akses Berhasil Diubah</div>');
	}
	// buat edit akun by admin
	public function view_akun()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('user', ['id' => $id])->row_array();
		echo json_encode($data);
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
	public function daftar_guru()
	{
		$data['title'] = 'Manajemen Guru';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $this->db->where('id',"1");
		// $this->db->where('id',"2");

		// $this->db->where_in('status_id',["1","2"]);
		// $this->db->where('is_active',"1");
		$data['userguru'] = $this->db->get_where('user', ['status_id' => '2', 'is_active' => '1'])->result_array();
		// $data['userguru']=$this->db->get('user')->result_array();
		// $data['userguru']=$this->db->get_where('user',['status_id'=>"1"])->result_array();
		$data['listmapel'] = $this->db->get('daftar_mapel')->result_array();
		// $query="SELECT * from user inner join guru on id=id_guru order by id";
		// $data['hasil']=$this->db->query($query)->result_array();
		// echo json_encode($data['hasil']);
		// die;
		$data['guru'] = $this->guru->get_guru();

		// $data['guru']=$this->db->get('daftar_guru')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/info_guru', $data);
		$this->load->view('templates/footer');
	}
	public function tambah_guru()
	{
		$id_user = $this->input->post('listuser');
		$id_mapel = $this->input->post('listmapel');
		$this->db->insert('daftar_guru', ['id_user' => $id_user, 'id_mapel' => $id_mapel]);
		$this->session->set_flashdata('message', '<div class="alert alert-success mt-4">Berhasil Menambah Guru</div>');
		redirect('admin/daftar_guru');
	}

	public function hapus_akun()
	{
		$id = $this->input->post('id');
		$this->db->delete('user', ['id' => $id]);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo $this->db->trans_status();
		} else {
			echo $this->db->trans_status();
		}
	}
	public function edit_guru()
	{
		$id_user = $this->input->post('id_user');
		$id_guru = $this->input->post('id_guru');
		$id_mapel = $this->input->post('id_mapel');
		$this->db->where('id_guru', $id_guru);
		$this->db->update('daftar_guru', ['id_user' => $id_user, 'id_mapel' => $id_mapel]);
	}
	public function hapus_guru($id)
	{
		$this->db->delete('daftar_guru', ['id_guru' => $id]);
	}
	public function log()
	{
		$data['title'] = 'Log Device';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$query = "SELECT user.*,lab.*,log_device.* from user,lab,log_device where log_device.id_user=user.id and lab.id_lab=log_device.id_device";
		$data['log'] = $this->db->query($query)->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/log', $data);
		$this->load->view('templates/footer');
	}
	public function agenda()
	{
		$data['title'] = 'Agenda Kegiatan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['agenda'] = $this->db->get('agenda')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/manajemen_agenda', $data);
		$this->load->view('templates/footer');
	}
	public function edit_agenda()
	{
		$id = $this->input->post('id');
		$judul = $this->input->post('judul');
		$tipe = $this->input->post('tipe');
		$mulai = $this->input->post('mulai');
		$akhir = $this->input->post('akhir');
		$data = [
			'title' => $judul,
			'tipe' => $tipe,
			'waktu_mulai' => $mulai,
			'waktu_berakhir' => $akhir
		];
		$this->db->where('id', $id);
		$this->db->update('agenda', $data);
	}
	public function hapus_agenda()
	{
		$id = $this->input->post('id');
		$this->db->delete('agenda', ['id' => $id]);
	}
	public function tambah_agenda()
	{
		$judul = $this->input->post('judul');
		$tipe = $this->input->post('tipe');
		$mulai = $this->input->post('mulai');
		$akhir = $this->input->post('akhir');
		$data = [
			'title' => $judul,
			'tipe' => $tipe,
			'waktu_mulai' => $mulai,
			'waktu_berakhir' => $akhir
		];
		$this->db->insert('agenda', $data);
	}
	public function kelola()
	{
		$data['title'] = 'Kelola Admin';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['admin'] = $this->db->get_where('user', ['status_id' => 1])->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/kelola_admin', $data);
		$this->load->view('templates/footer');
	}
	public function tambahadmin()
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$password = password_hash('12345678', PASSWORD_DEFAULT);
		$data = [
			'nama' => $nama,
			'email' => $email,
			'alamat' => $alamat,
			'password' => $password,
			'is_active' => 1,
			'status_id' => 1
		];
		$this->db->insert('user', $data);
		mkdir("./assets/img/profile/" . $nama);
		copy("./assets/img/profile/default.png", "./assets/img/profile/" . $nama . "/default.png");
	}
	public function hapus_log($mulai = null, $akhir = null)
	{
		$cek = "SELECT * from log_device where DATE(jam_login) BETWEEN DATE('" . $mulai . "') AND DATE('" . $akhir . "')";
		$cek_tanggal = $this->db->query($cek)->num_rows();
		// echo $cek_tanggal;
		if ($cek_tanggal < 1) {
			echo 0;
		} else {
			$q = "DELETE from log_device where DATE(jam_login) BETWEEN DATE('" . $mulai . "') AND DATE('" . $akhir . "')";
			$this->db->query($q);
				
			echo 1;
		}
	}
}
