<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Resep_model extends CI_Model
{
	function __construct()
	{
		$this->load->library('m_db');
	}
	
	function all() {
		//query semua record di table products
		$hasil = $this->db->get('produk');
		if($hasil->num_rows() > 0){
			return $hasil->result();
		} else{
			return array();
		}
	}

	function find($id) {
		//Query untuk mencari record berdasarkan ID-nya
		$hasil = $this	->db->where('produk_id', $id)
						->limit(1)
						->get('produk');
		if($hasil->num_rows() > 0){
			return $hasil->row();
		} else{
			return array();
		}
	}
	
	
	function kategori_data($where=array(),$order="negara ASC")
	{
		$d=$this->m_db->get_data('masakan',$where,$order);
		return $d;
	}
	
	function kategori_add($nama)
	{
		$d=array(
		'negara'=>$nama,
		);
		if($this->m_db->add_row('masakan',$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function kategori_edit($kategoriID,$nama)
	{
		$s=array(
		'id_masakan'=>$kategoriID,
		);
		$d=array(
		'negara'=>$nama
		);
		if($this->m_db->edit_row('masakan',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function kategori_delete($kategoriID)
	{
		$s=array(
		'id_masakan'=>$kategoriID,
		);
		
		if($this->m_db->delete_row('masakan',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	function produk_data($where=array(),$order="jdl_resep ASC")
	{
		$d=$this->m_db->get_data('resep_masakan',$where,$order);
		return $d;
	}

	function paket_data($where=array(),$order="id_resep ASC")
	{
		$d=$this->m_db->get_data('paket_resep',$where,$order);
		return $d;
	}

	function paket_resep($user)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*')
							->from('paket_resep i, users u')
							->where('u.username',$user)
							->where('u.userid = i.userid')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}
	
	function produk_add_single($nama,$bahan,$bumbu,$resep,$kategoriID,$photo='')
	{		
		
			$resepid=$this->m_db->last_insert_id();
			$pathupload=FCPATH.'uploads';
			$allowtype="jpg|bmp|png|jpeg";
			$config['upload_path'] = $pathupload;
			$config['allowed_types'] = $allowtype;
			$config['max_size']	= 0;
			$config['max_filename']=0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite']=TRUE;
			if(!empty($photo))
			{
				$this->load->library('upload');
				$this->load->library('m_file');
				$count=1;
				$field="upload";
				for($i=1;$i<=$count;$i++){					
					if (!empty($_FILES[$field.$i]['name'])) {						
						$gambar=$_FILES[$field.$i]['name'];
		        		$ext=pathinfo($gambar,PATHINFO_EXTENSION);
		        		$imgname="resep_".$nama."-".$i.".".$ext;
		        		$config['file_name'] = $imgname;
		        		$this->upload->initialize($config);
						if ($this->upload->do_upload($field.$i))
						{							
							$sdata=$this->upload->data();
							$folder=$sdata['file_path'];
							$oripath=$sdata['full_path'];
							$imgname=$sdata['orig_name'];														
							$this->m_file->imageThumbs($pathupload,$oripath,$imgname);
							$d2=array(
							
							'jdl_resep'=>$nama,
							'bahan'=>$bahan,
							'bumbu'=>$bumbu,
							'resep'=>$resep,
							'id_masakan'=>$kategoriID,
							'foto_resep'=>$imgname

							);
							$this->m_db->add_row('resep_masakan',$d2);
						}
					}
				}				
			}
		else{
			return TRUE;
		}
	}
	
	function resep_add_single($resepbumbu,$bumburesep)
	{		
	
		$d=array(
		'id_resep'=>$resepbumbu,
		'produk_id'=>$bumburesep,
		'userid' => $this->get_logged_user_id(),
		);
		$this->m_db->add_row('paket_resep',$d);
				
	}

	function get_logged_user_id()
	{
		$hasil = $this->db
						->select('userid')
						->where('username',$this->session->userdata('username'))
						->limit(1)
						->get('users');
		if($hasil->num_rows() >0){
		return $hasil->row()->userid;
		} else {
			return 0;
		}
	}
	
function produk_edit($resepid,$nama,$bahan,$bumbu,$resep,$kategori,$photo='')
	{
		$s=array(
		'id_resep'=>$resepid,
		);
		$d=array(
		'jdl_resep'=>$nama,
		'bahan'=>$bahan,
		'bumbu'=>$bumbu,
		'resep'=>$resep,
		'id_masakan'=>$kategori,
		);
		if($this->m_db->edit_row('resep_masakan',$d,$s)==TRUE)
		{			
			$pathupload=FCPATH.'uploads';
			$allowtype="jpg|bmp|png|jpeg";
			$config['upload_path'] = $pathupload;
			$config['allowed_types'] = $allowtype;
			$config['max_size']	= 0;
			$config['max_filename']=0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite']=TRUE;
			
			if(!empty($photo))
			{
				
				$this->load->library('upload');
				$this->load->library('m_file');
				$count=1;
				$field="upload";
				for($i=1;$i<=$count;$i++){					
					if (!empty($_FILES[$field.$i]['name'])) {						
						$gambar=$_FILES[$field.$i]['name'];
		        		$ext=pathinfo($gambar,PATHINFO_EXTENSION);
		        		$imgname="resep_".$resepid."-".$i.".".$ext;
		        		$config['file_name'] = $imgname;
		        		$this->upload->initialize($config);
						if ($this->upload->do_upload($field.$i))
						{							
							$sdata=$this->upload->data();
							$folder=$sdata['file_path'];
							$oripath=$sdata['full_path'];
							$imgname=$sdata['orig_name'];														
							$this->m_file->imageThumbs($pathupload,$oripath,$imgname);
							$s=array(
							'id_resep'=>$resepid,
							);
							$d2=array(
							
							'foto_resep'=>$imgname,
							);
							$this->m_db->edit_row('resep_masakan',$d2,$s);
						}
					}
				}				
			}
			
			return true;
		}
	}

	function resep_edit($paketid,$resepbumbu,$bumburesep)
	{
		$s=array(
		'id_paket'=>$paketid,
		);
		$d=array(
		'id_resep'=>$resepbumbu,
		'produk_id'=>$bumburesep,
		);
		
		if($this->m_db->edit_row('paket_resep',$d,$s)==TRUE)
		{
			return true;
		}
	}
	

	function produk_delete($id)
	{
		$s=array(
		'id_resep'=>$id,
		);
		
		if($this->m_db->delete_row('resep_masakan',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	function resep_delete($id)
	{
		$s=array(
		'id_paket'=>$id,
		);
		
		if($this->m_db->delete_row('paket_resep',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	function getresep($idresep)
	{
	  $data = array();
	  $options = array('id_resep' => $idresep);
	  $Q = $this->db->get_where('resep_masakan',$options,1);
	    if ($Q->num_rows() > 0){
	      $data = $Q->row_array();
	    }
	  $Q->free_result();
	  return $data;
	}

	function getbumbu($idbumbu)
	{

	  
	  $options = array('id_resep' => $idbumbu);
	  $data = $this->m_db->get_data('paket_resep',$options,'produk_id DESC',array());
	  
	  return $data;
	}
		

}