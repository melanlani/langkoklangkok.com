<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_resep extends CI_Controller {
	public function __construct() {
		parent::__construct();

		//load model -> model_products
        $this->load->library('m_db');   

        $this->load->model('resep_model');
	}

    public function index()
    {
    
    }

	public function kategoris()
	{
        $d["title"] = "Kategori Resep";
		$d['data']=$this->resep_model->kategori_data();
		$this->load->view('toko/kategoriview2',$d);
	}

    function add()
    {
        $this->form_validation->set_rules('nama','Nama Kategori Produk','required');
        if($this->form_validation->run()==TRUE)
        {
            $nama=$this->input->post('nama',TRUE);
            
            if($this->resep_model->kategori_add($nama)==TRUE)
            {
                set_header_message('success','Tambah Kategori Resep','Berhasil menambahkan Kategori Resep');
                redirect(site_url('kategori_resep/kategoris'),'refresh',301);
            }else{
                set_header_message('danger','Tambah Kategori Resep','Gagal menambahkan Kategori Resep');
                redirect(site_url('kategori_resep/kategoris'),'refresh',301);
            }           
        }else{
            redirect(site_url('kategori/kategoris'),'refresh',301);
        }
    }

   function edit()
    {
        $this->form_validation->set_rules('kategoriid','ID Kategori Resep','required');
        $this->form_validation->set_rules('nama','Nama Kategori Resep','required');
        if($this->form_validation->run()==TRUE)
        {
            $kategoriid=$this->input->post('kategoriid',TRUE);
            $nama=$this->input->post('nama',TRUE);
            
            if($this->resep_model->kategori_edit($kategoriid,$nama)==TRUE)
            {
                set_header_message('success','Ubah Kategori Resep','Berhasil mengubah Kategori Resep');
                redirect(site_url('kategori_resep/kategoris'),'refresh',301);
            }else{
                set_header_message('danger','Ubah Kategori Resep','Gagal mengubah Kategori Resep');
                redirect(site_url('kategori_resep/kategoris'),'refresh',301);
            }           
        }else{
            $id=$this->input->get('id',TRUE);
            $d['title']="Ubah Kategori Resep";
            $d['data']=$this->resep_model->kategori_data(array('id_masakan'=>$id));
            $this->load->view('toko/kategoriedit2',$d);
        }
    }
	function delete()
    {
        $id=$this->input->get('id',TRUE);
        if($this->resep_model->kategori_delete($id)==TRUE)
        {
            set_header_message('success','Hapus Kategori Resep','Berhasil menghapus Kategori Resep');
            redirect(site_url('kategori_resep/kategoris'),'refresh',301);
        }else{
            set_header_message('danger','Hapus Kategori Resep','Gagal menghapus Kategori Resep');
            redirect(site_url('kategori_resep/kategoris'),'refresh',301);
        }
    }

}

