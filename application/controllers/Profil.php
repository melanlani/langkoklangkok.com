<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('m_db');
		$this->load->model('model_users');
		$this->load->model('produk_model');
		
	}
	
	function index()
	{		
		$d['title']="Ubah Profil";
		$user = $this->session->userdata('username');
		$d['data'] = $this->model_users->akun_info($user);
		$this->load->view('profilview',$d);
	}
	
	function member()
	{		
		$user = $this->session->userdata('username');
		$d['data'] = $this->model_users->akun_member($user);
		$this->load->view('member/profileview',$d);
	}
	
	function uploadphoto()
    {
		$gambar=$_FILES['file']['name'];		
        $ext=pathinfo($gambar,PATHINFO_EXTENSION);
		$imgname="ava-".md5(user_infoo('userid')).".".$ext;
		$path = FCPATH.'asset/images/avatar/';
		$allow= "jpg|bmp|gif|png|jpeg";
		$maxsize	= 1000;
		$max_filename=0;				
		$config['upload_path']          = $path;
        $config['allowed_types']        = $allow;
        $config['max_size']             = $maxsize;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['file_name'] 			= $imgname;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('file'))
        {
        	$s=array(
			'userid'=>user_infoo('userid'),
			);
			$d=array(
			'foto'=>$imgname,
			);
			$this->m_db->edit_row('users',$d,$s);
			echo json_encode(array(
			'status'=>'ok',
			'message'=>'Avatar berhasil diupload dan diubah',
			'url'=>base_url().'asset/images/avatar/'.$imgname,
			));
        }else{
			echo json_encode(array(
			'status'=>'no',
			'message'=>'Avatar gagal diupload dan diubah.',
			));
		}		
	}
	
	function profilupdate()
	{		
		$this->form_validation->set_rules('nama','Nama','required');
		if($this->form_validation->run())
		{			
			$s=array(
			'userid' => $this->produk_model->get_logged_user_id(),
			);
			$nama=$this->input->post('nama',TRUE);
			$pass=$this->input->post('password',TRUE);
			$fullname=$this->input->post('fullname',TRUE);
			if(!empty($pass))
			{				
				$dPass=array(
					
			'fullname'=>$fullname,
				'password'=>$pass,
				);				
				$this->m_db->edit_row('users',$dPass,$s);
			}
			
			$d=array(
			'username'=>$nama,
			);
			
			if($this->m_db->edit_row('users',$d,$s)==TRUE)
			{
				set_header_message('success','Profil','Berhasil mengubah profil');
				redirect(site_url("profil"),'refresh',301);
			}else{
				set_header_message('danger','Profil','Gagal mengubah profil');
				redirect(site_url("profil"),'refresh',301);
			}
			
		}else{
			redirect(site_url("profil"),'refresh',301);
		}
	}

	function memberupdate()
	{		
		$this->form_validation->set_rules('fullname','Nama','required');
		if($this->form_validation->run())
		{			
			$s=array(
			'userid' => $this->produk_model->get_logged_user_id(),
			);
			$fullname=$this->input->post('fullname',TRUE);
			$email=$this->input->post('email',TRUE);
			$notelp=$this->input->post('notelp',TRUE);
			$alamat=$this->input->post('alamat',TRUE);
			$provinsi=$this->input->post('provinsi',TRUE);
			$kota=$this->input->post('kota',TRUE);
			
			$d=array(
			'nama_pelanggan'=>$fullname,
			'email'=>$email,
			'notelp'=>$notelp,
			'alamat'=>$alamat,
			'provinsi'=>$provinsi,
			'kota'=>$kota,
			);
			
			if($this->m_db->edit_row('pelanggan',$d,$s)==TRUE)
			{
				$this->session->set_flashdata('success','Berhasil mengubah profil');
				redirect(site_url("profil/member"),'refresh',301);
			}else{
				$this->session->set_flashdata('danger','Gagal mengubah profil');
				redirect(site_url("profil/member"),'refresh',301);
			}
			
		}else{
			redirect(site_url("profil/member"),'refresh',301);
		}
	}
}