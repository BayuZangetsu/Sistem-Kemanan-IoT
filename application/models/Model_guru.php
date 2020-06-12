<?php
defined('BASEPATH')or exit('No direct script allowed');
class Model_guru extends CI_Model{
	public function get_guru()
	{
		$query2="SELECT `user`.*,`daftar_mapel`.*,`daftar_guru`.* from `user`,`daftar_mapel`,`daftar_guru`
		where `user`.`id`=`daftar_guru`.`id_user` and `daftar_mapel`.`id`=`daftar_guru`.`id_mapel`";
		return $this->db->query($query2)->result_array();
	}
}
