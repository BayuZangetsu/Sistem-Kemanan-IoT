<?php
function check_access(){
    $instance=get_instance();
    if(!$instance->session->userdata('email')){
        redirect('auth');
    }
    else{
        $status=$instance->session->userdata('status_id');
        $url_accessed=$instance->uri->segment(1);
        $querymenu=$instance->db->get_where('menu_user',['menu'=>$url_accessed])->row_array();
        $menu_id=$querymenu['id'];
        $user_access=$instance->db->get_where('user_access_menu',[
            'status_id'=>$status,
            'menu_id'=>$menu_id
            ]);
            if($user_access->num_rows()<1){
                redirect('Block_access/block403');
            }
    }
}
function cek_akses($status_id,$id_menu)
{
    $ci=get_instance();
    $ci->db->where('status_id',$status_id);
    $ci->db->where('menu_id',$id_menu);
    $result=$ci->db->get('user_access_menu');
    if($result->num_rows()>0){
        return "checked='checked'";
    }
}
