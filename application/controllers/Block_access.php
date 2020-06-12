<?php
defined('BASEPATH') or exit('no another script allowed');
class Block_access extends CI_Controller{
	public function __construct()
    {
		parent::__construct();
		// check_access();
	}
	public function block403()
	{ 
		$data['title']="Access Forbidden";
        $this->load->view('templates/header',$data);
        $this->load->view('errors/block');
        $this->load->view('templates/footer');
	}
	public function block404()
	{ 
		$data['title']="Access Forbidden";
        $this->load->view('templates/header',$data);
        $this->load->view('errors/block_2');
        $this->load->view('templates/footer');
	}
	
}
