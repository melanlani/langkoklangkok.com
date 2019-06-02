<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('m_db');
	}

	public function index(){
		$this->load->view('form_daftar');
	}

	public function pendaftaran() 
	{
		$this->form_validation->set_rules('fullname','Fullname','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('provinsi','Provinsi','required');
		$this->form_validation->set_rules('kota','Kota','required');
		$this->form_validation->set_rules('notelp','Nohandphone','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run()){

			$fullname=$this->input->post('fullname',TRUE);			
			$email=$this->input->post('email',TRUE);	
			$username=$this->input->post('username',TRUE);			
			$alamat=$this->input->post('alamat',TRUE);	
			$provinsi=$this->input->post('provinsi',TRUE);			
			$kota=$this->input->post('kota',TRUE);		
			$notelp=$this->input->post('notelp',TRUE);
			$password=$this->input->post('password',TRUE);
			$this->load->model('model_users');
			if($this->model_users->user_daftar($fullname,$username,$password,"2")==TRUE)
			{
				$userid=$this->m_db->last_insert_id();
				$d=array(
				'nama_pelanggan'=>$fullname,
				'alamat'=>$alamat,
				'notelp'=>$notelp,
				'email'=>$email,
				'provinsi'=>$provinsi,
				'kota'=>$kota,
				'userid'=>$userid,
				);
				if($this->m_db->add_row('pelanggan',$d)==TRUE)
				{
					$this->session->set_flashdata('success','Silahkan Login');
					redirect(site_url().'/login');
				}else{
					$s=array(
					'userid'=>$userid,
					);
					$this->m_db->delete_row('users',$s);
					redirect(site_url().'/daftar');
				}
			}else{
				redirect(site_url().'/daftar');
			}
		}else{
			$this->load->view('form_login');
		}		
	}

	public function toko() 
	{
		$this->form_validation->set_rules('fullname','Fullname','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('kota','Kota','required');
		$this->form_validation->set_rules('notelp','Nohandphone','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run()){

			$fullname=$this->input->post('fullname',TRUE);			
			$email=$this->input->post('email',TRUE);	
			$username=$this->input->post('username',TRUE);			
			$alamat=$this->input->post('alamat',TRUE);			
			$kota=$this->input->post('kota',TRUE);		
			$notelp=$this->input->post('notelp',TRUE);
			$password=$this->input->post('password',TRUE);
			$this->load->model('model_users');
			if($this->model_users->user_daftar($fullname,$username,$password,"3")==TRUE)
			{
				$userid=$this->m_db->last_insert_id();
				$d=array(
				'nama_supplier'=>$fullname,
				'alamat'=>$alamat,
				'notelp'=>$notelp,
				'email'=>$email,
				'kota'=>$kota,
				'userid'=>$userid,
				);
				if($this->m_db->add_row('supplier',$d)==TRUE)
				{
					redirect(site_url().'/login');
				}else{
					$s=array(
					'userid'=>$userid,
					);
					$this->m_db->delete_row('users',$s);
					redirect(site_url().'/daftar');
				}
			}else{
				redirect(site_url().'/daftar');
			}
		}else{
			$this->load->view('form_toko');
		}		
	}

}