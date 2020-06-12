<?php
defined('BASEPATH')or exit('No direct script allowed');
class Menu_model extends CI_Model{
    public function getusersubmenu()
    {
        return $this->db->get('user_submenu')->result_array();
    }
    public function namamenu(){
        $query="SELECT `user_submenu`.*,`menu_user`.`menu`
        from `user_submenu` join `menu_user`
        on `user_submenu`.`menu_id`=`menu_user`.`id`";
        return $this->db->query($query)->result_array();
    }
    public function get_menu(){
        return $this->db->get('menu_user')->result_array();
    }
}