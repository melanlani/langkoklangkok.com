<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct() {
		parent::__construct();

		//load model -> model_products
        $this->load->library('m_db');   

        $this->load->model('produk_model');
	}

    public function index()
    {
    
    }

	public function kategoris()
	{
        $d["title"] = "Kategori";
		$d['data']=$this->produk_model->kategori_data();
		$this->load->view('toko/kategoriview',$d);
	}

    function add()
    {
        $this->form_validation->set_rules('nama','Nama Kategori Produk','required');
        if($this->form_validation->run()==TRUE)
        {
            $nama=$this->input->post('nama',TRUE);
            
            if($this->produk_model->kategori_add($nama)==TRUE)
            {
                set_header_message('success','Tambah Kategori Produk','Berhasil menambahkan Kategori Produk');
                redirect(site_url('kategori/kategoris'),'refresh',301);
            }else{
                set_header_message('danger','Tambah Kategori Produk','Gagal menambahkan Kategori Produk');
                redirect(site_url('kategori/kategoris'),'refresh',301);
            }           
        }else{
            redirect(site_url('kategori/kategoris'),'refresh',301);
        }
    }

   function edit()
    {
        $this->form_validation->set_rules('kategoriid','ID Kategori Produk','required');
        $this->form_validation->set_rules('nama','Nama Kategori Produk','required');
        if($this->form_validation->run()==TRUE)
        {
            $kategoriid=$this->input->post('kategoriid',TRUE);
            $nama=$this->input->post('nama',TRUE);
            
            if($this->produk_model->kategori_edit($kategoriid,$nama)==TRUE)
            {
                set_header_message('success','Ubah Kategori Produk','Berhasil mengubah Kategori Produk');
                redirect(site_url('kategori/kategoris'),'refresh',301);
            }else{
                set_header_message('danger','Ubah Kategori Produk','Gagal mengubah Kategori Produk');
                redirect(site_url('kategori/kategoris'),'refresh',301);
            }           
        }else{
            $id=$this->input->get('id',TRUE);
            $d['title']="Ubah Kategori Produk";
            $d['data']=$this->produk_model->kategori_data(array('kategori_id'=>$id));
            $this->load->view('toko/kategoriedit',$d);
        }
    }
	function delete()
    {
        $id=$this->input->get('id',TRUE);
        if($this->produk_model->kategori_delete($id)==TRUE)
        {
            set_header_message('success','Hapus Kategori Produk','Berhasil menghapus Kategori Produk');
            redirect(site_url('kategori/kategoris'),'refresh',301);
        }else{
            set_header_message('danger','Hapus Kategori Produk','Gagal menghapus Kategori Produk');
            redirect(site_url('kategori/kategoris'),'refresh',301);
        }
    }

}

