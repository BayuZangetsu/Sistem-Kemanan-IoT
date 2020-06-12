<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{public function __construct()
    {
        parent::__construct();
        check_access();
        $this->load->model('Menu_model','Menu');
    
    }
    public function index()
    {
        $data['title'] = 'Manajemen Menu';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
            ])->row_array();
        $data['menu'] = $this->db->get('menu_user')->result_array();
        $this->form_validation->set_rules('newmenu','Menu','required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        }else{
            $this->db->insert('menu_user',['menu'=>$this->input->post('newmenu')]);
            $this->session->set_flashdata('message','<div class="alert alert-success text-center" role="alert">Berhasil Menambahkan Menu</br></div>');
            redirect('menu');
        }
    }
    public function submenu()
    {
        $data['title'] = 'Manajemen Sub Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
     
        $data['menu']=$this->Menu->namamenu();
        $data['jenisMenu']=$this->Menu->get_menu();
        $this->form_validation->set_rules('title','Judul','required');
        $this->form_validation->set_rules('menu_id','Menu','required');
        $this->form_validation->set_rules('urlsub','Url','required');
        $this->form_validation->set_rules('iconsub','Icon','required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
            
        }
        else{
            $data=[
                'judul'=>$this->input->post('title'),
                'menu_id'=>$this->input->post('menu_id'),
                'url'=>$this->input->post('urlsub'),
                'icon'=>$this->input->post('iconsub'),
                'is_active'=>$this->input->post('is_active')
            ];
            $this->db->insert('user_submenu',$data);
            $this->session->set_flashdata('message','<div class="alert alert-success text-center" role="alert">Berhasil Menambah Submenu</div>');
            redirect('menu/submenu');
        }
    }
}