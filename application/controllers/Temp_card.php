<?php
defined('BASEPATH')or exit('haram desu !');
class Temp_card extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function show()
	{
		$data['table']=$this->db->get('#rfid_temp')->result_array();
		$this->load->view('admin/table_temp',$data);
		// $this->load->view('templates/footer');
	}
}
