<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('m_db');
		$this->load->model('model_users');
		
		if($this->session->userdata('roleid') != '2')
		{
			redirect(base_url());
		}
	}
	
	function index()
	{

	}
	
	function histori()
	{
		$user = $this->session->userdata('username');
        $data['history'] = $this->model_users->akun_member($user);
        foreach ($data['history'] as $pelanggan) :

		$d['data']=$this->m_db->get_data('penjualan',array('pelanggan_id'=>$pelanggan->pelanggan_id));
		$this->load->view('member/historiview',$d);
		endforeach;
	}	
	
}