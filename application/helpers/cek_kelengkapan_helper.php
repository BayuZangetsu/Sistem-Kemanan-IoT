<?php
function cek_kelengkapan()
{
	$instance = get_instance();
	$email_user = $instance->session->userdata('email');
	$user = $instance->db->get_where('user', ['email' => $email_user])->row_array();
	if ($user['key_pertanyaan'] == null && $user['value_pertanyaan'] == null) {
		$instance->session->set_flashdata(
			'message',
			'<div class="card">
		<div class="card-body bg-white text-danger">
		<h4>Mohon Lengkapi Profil Sebelum Melanjutkan Aktifitas !</h4>
		<h6>Anda belum mengisi pertanyaan keamanan !</h6>
		<h6>Mohon di isi pada menu <strong>Akun Saya</strong></h6>
		</div>
		</div>'
		);
	} else $instance->session->set_flashdata('message', null);
}
function cek_mapel()
{
	$instance = get_instance();
	$email_user = $instance->session->userdata('email');
	$user = $instance->db->get_where('user', ['email' => $email_user])->row_array();
	if($user['status_id']!=1){
		$mapel = $instance->db->get_where('daftar_guru', ['id_user' => $user['id']])->row_array();
		if ($mapel == null) {
			$instance->session->set_flashdata(
				'message',
				'<div class="card p-2">
			<div class="card-body bg-white text-danger">
			<h4>Mohon Lengkapi Profil Sebelum Melanjutkan Aktifitas !</h4>
			<h6>Anda belum mengisi Mata Pelajaran Yang Anda Ampu !</h6>
			<h6>Mohon di isi pada menu <strong>Akun Saya</strong></h6>
			</div>
			</div>'
			);
		} else $instance->session->set_flashdata('message', null);
	}
}
