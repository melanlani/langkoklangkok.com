<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produk_model extends CI_Model
{
	function __construct()
	{
		$this->load->library('m_db');
		$this->load->model('toko_model','mod_toko');
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
	
	function kategori_data($where=array(),$order="nama_kategori ASC")
	{
		$d=$this->m_db->get_data('produk_kategori',$where,$order);
		return $d;
	}
	
	function kategori_add($nama)
	{
		$d=array(
		'nama_kategori'=>$nama,
		);
		if($this->m_db->add_row('produk_kategori',$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function kategori_edit($kategoriID,$nama)
	{
		$s=array(
		'kategori_id'=>$kategoriID,
		);
		$d=array(
		'nama_kategori'=>$nama
		);
		if($this->m_db->edit_row('produk_kategori',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function kategori_delete($kategoriID)
	{
		$s=array(
		'kategori_id'=>$kategoriID,
		);
		
		if($this->m_db->delete_row('produk_kategori',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	function produk_data($where=array(),$order="nama_produk ASC")
	{
		$d=$this->m_db->get_data('produk',$where,$order);
		return $d;
	}

	function get_shopping_history($user)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*')
							->from('produk i, users u')
							->where('u.username',$user)
							->where('u.userid = i.userid')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}
	
	function produk_add_single($toko,$kode,$nama,$supplierID,$merekID,$kategoriID,$deskripsi,$stok,$harga,$berat='1',$photo='')
	{		
		$d=array(
		'kode_produk'=>$kode,
		'nama_produk'=>$nama,
		'supplier_id'=>$supplierID,
		'userid' => $this->get_logged_user_id(),
		'merek_id'=>$merekID,
		'kategori_id'=>$kategoriID,
		'deskripsi'=>$deskripsi,
		'harga'=>$harga,
		'berat'=>$berat,
		);
		if($this->m_db->add_row('produk',$d)==TRUE)
		{
			$produkID=$this->m_db->last_insert_id();
			$pathupload=FCPATH.'uploads';
			$allowtype="jpg|bmp|png|jpeg";
			$config['upload_path'] = $pathupload;
			$config['allowed_types'] = $allowtype;
			$config['max_size']	= 0;
			$config['max_filename']=0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite']=TRUE;
			$this->produk_add_stok_single($toko,$produkID,$stok);
			if(!empty($photo))
			{
				$this->load->library('upload');
				$this->load->library('m_file');
				$count=4;
				$field="upload";
				for($i=1;$i<=$count;$i++){					
					if (!empty($_FILES[$field.$i]['name'])) {						
						$gambar=$_FILES[$field.$i]['name'];
		        		$ext=pathinfo($gambar,PATHINFO_EXTENSION);
		        		$imgname="produk_".$produkID."-".$i.".".$ext;
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
							'produk_id'=>$produkID,
							'photo'=>$imgname,
							);
							$this->m_db->add_row('produk_photo',$d2);
						}
					}
				}				
			}
			return true;
		}else{
			return false;
		}
	}

	function komentar_add($comment,$produkid,$userid)
	{		
		$d=array(
		'comment'=>$comment,
		'produk_id'=>$produkid,
		'userid'=>$userid,
		);
		$this->m_db->add_row('komentar',$d);
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
	
	function produk_edit($produkID,$kode,$nama,$supplierID,$merekID,$kategoriID,$deskripsi,$harga,$berat='1',$photo='')
	{
		$s=array(
		'produk_id'=>$produkID,
		);
		$d=array(
		'kode_produk'=>$kode,
		'nama_produk'=>$nama,
		'supplier_id'=>$supplierID,
		'merek_id'=>$merekID,
		'kategori_id'=>$kategoriID,
		'deskripsi'=>$deskripsi,
		'harga'=>$harga,
		'berat'=>$berat,
		);
		if($this->m_db->edit_row('produk',$d,$s)==TRUE)
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
				$this->m_db->delete_row('produk_photo',array('produk_id'=>$produkID));
				$this->load->library('upload');
				$this->load->library('m_file');
				$count=4;
				$field="upload";
				for($i=1;$i<=$count;$i++){					
					if (!empty($_FILES[$field.$i]['name'])) {						
						$gambar=$_FILES[$field.$i]['name'];
		        		$ext=pathinfo($gambar,PATHINFO_EXTENSION);
		        		$imgname="produk_".$produkID."-".$i.".".$ext;
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
							'produk_id'=>$produkID,
							'photo'=>$imgname,
							);
							$this->m_db->add_row('produk_photo',$d2);
						}
					}else{
						$last=$this->input->post('fupload'.$i);
						$d2=array(
						'produk_id'=>$produkID,
						'photo'=>$last,
						);
						$this->m_db->add_row('produk_photo',$d2);
					}
				}				
			}
			$this->m_db->delete_row('produk_photo',array('produk_id'=>$produkID,'photo'=>''));
			return true;
		}else{
			return false;
		}
	}
	
	function produk_add_stok_single($toko,$produkID,$stok)
	{
		if(!empty($stok))
		{							
			$d=array(
			'produk_id'=>$produkID,
			'toko_id'=>$toko,
			'stok'=>$stok,
			);
			$this->m_db->add_row('produk_stok',$d);			
			return true;
		}else{
			return false;
		}
	}
		
	function produk_add_stok($toko,$produkID,$stok=array())
	{
		if(!empty($stok))
		{
			foreach($stok as $rstok)
			{				
				$ukuranID=$rstok['ukuran'];
				$warnaID=$rstok['warna'];
				$stok=$rstok['stok'];
												
				$d=array(
				'produk_id'=>$produkID,
				'toko_id'=>$toko,
				'ukuran_id'=>$ukuranID,
				'warna_id'=>$warnaID,
				'stok'=>$stok,
				);
				$this->m_db->add_row('produk_stok',$d);
			}
			return true;
		}else{
			return false;
		}
	}
	
	function produk_delete($id)
	{
		$s=array(
		'produk_id'=>$id,
		);
		if($this->m_db->is_bof('produk_photo',$s)==FALSE)
		{
			$dPhoto=$this->m_db->get_data('produk_photo',$s);
			if(!empty($dPhoto))
			{
				$this->load->library('m_file');
				$pathupload=FCPATH.'assets/images/produk/';
				foreach($dPhoto as $rPhoto)
				{
					$filename=$rPhoto->photo;
					$this->m_file->deleteImage($pathupload,$filename);
				}
			}
			$this->m_db->delete_row('produk_stok',$s);
			$this->m_db->delete_row('produk',$s);
			return true;
		}else{
			return false;
		}
	}

	function getproduk($idproduk)
	{
	  $data = array();
	  $options = array('produk_id' => $idproduk);
	  $Q = $this->db->get_where('produk',$options,1);
	    if ($Q->num_rows() > 0){
	      $data = $Q->row_array();
	    }
	  $Q->free_result();
	  return $data;
	}

	function getstok($idproduk)
	{
	  $data = array();
	  $options = array('produk_id' => $idproduk);
	  $Q = $this->db->get_where('produk_stok',$options,1);
	    if ($Q->num_rows() > 0){
	      $data = $Q->row_array();
	    }
	  $Q->free_result();
	  return $data;
	}

	function getkomentar($idproduk)
	{
	  $data = array();
	  $options = array('produk_id' => $idproduk);
	  $Q = $this->db->get_where('komentar',$options);
	    if ($Q->num_rows() > 0){
	      $data = $Q->row_array();
	    }
	  $Q->free_result();
	  return $data;
	}

	public function view($table){
        return $this->db->get($table);
    }
	
	public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }
		
}