<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller {
	public function __construct() {
		parent::__construct();

    

		//load model -> model_products
        $this->load->library('m_db');   

        $this->load->model('resep_model');
	}

    public function index()
    {
    
    }

	public function reseps()
	{
        $d["title"] = "Resep";
        $d['editor'] = $this->editor_tinymce();
		$d['recipes'] = $this->resep_model->produk_data();
		$this->load->view('toko/mvresep',$d);
	}

    function editor_tinymce(){
        return '<script type="text/javascript" src="'.base_url().'tinymce/tinymce.min.js"></script>
            <script type="text/javascript"> tinymce.init({
                selector: "textarea#yenda_editor",
                theme: "modern", width: 580, height:200,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"]
            });
            </script>';

    }

    function kategori()
    {
        $id=$this->uri->segment(3);
        $nama=field_value('masakan','id_masakan',$id,'negara');
        
        
       
        $d['kategoriid']=$id;
        $this->load->view('publik/kategoriview2',$d);
        
    }

    function detailresep()
    {
        $data['data_resep'] = $this->resep_model->getresep($this->uri->segment(3));
        $this->load->view('publik/resepview',$data);
        
    }

    function bumburesep()
    {
        $data['bumbu_resep'] = $this->resep_model->getbumbu($this->uri->segment(3));
        $data['data_resep'] = $this->resep_model->getresep($this->uri->segment(3));
        $this->load->view('publik/bumbuview',$data);
        
    }

    function add()
    {
        $this->form_validation->set_rules('nama','Judul Resep','required');
        $this->form_validation->set_rules('bahan','Bahan','required');
        $this->form_validation->set_rules('bumbu','Bumbu','required');
        $this->form_validation->set_rules('resep','Cara','required');
        $this->form_validation->set_rules('kategori','kategori Resep','required');
        
        if($this->form_validation->run()==TRUE)
        {
            $nama=$this->input->post('nama',TRUE);
            $bahan=$this->input->post('bahan',TRUE);
            $bumbu=$this->input->post('bumbu',TRUE);
            $resep=$this->input->post('resep',TRUE);
            $kategori=$this->input->post('kategori',TRUE);
            $photo='upload';
            if($this->resep_model->produk_add_single($nama,$bahan,$bumbu,$resep,$kategori,$photo)==TRUE)
            {
                $resepid=$this->m_db->last_insert_id();
                set_header_message('success','Tambah Resep','Berhasil menambah resep');
                redirect(site_url('resep/reseps'),'refresh',301);
            }else{
                set_header_message('danger','Tambah Resep','Gagal menambah resep');
                redirect(site_url('resep/reseps'),'refresh',301);
            }
        }
    }

    function add_bumbu()
    {
        $this->form_validation->set_rules('resepbumbu','Resep Bumbu','required');
        $this->form_validation->set_rules('bumburesep','Produk Bumbu','required');
        if($this->form_validation->run()==TRUE)
        {
            $resepbumbu=$this->input->post('resepbumbu',TRUE);
            $bumburesep=$this->input->post('bumburesep',TRUE);

            if($this->resep_model->resep_add_single($resepbumbu,$bumburesep)==TRUE)
            {               
                set_header_message('success','Tambah Bumbu Resep','Berhasil mengubah bumbu');
                redirect(site_url('resep/add_bumbu'),'refresh',301);
            }else{
                set_header_message('danger','Tambah Bumbu Resep','Gagal mengubah bumbu');
                redirect(site_url('resep/add_bumbu'),'refresh',301);
            }
        }else{
            $this->load->model('produk_model');
            $d['title']="Tambah Bumbu";    
            $user = $this->session->userdata('username');
            $d['paket'] = $this->resep_model->paket_resep($user);
            $d['produk'] = $this->produk_model->get_shopping_history($user);
            $d['resep']=$this->m_db->get_data('resep_masakan',array(),'jdl_resep ASC');
            $this->load->view('toko/addbumbu',$d);
        
        }       
    }

    function edit()
    {
        $this->form_validation->set_rules('resepid','ID Resep','required');
        $this->form_validation->set_rules('nama','Judul Resep','required');
        $this->form_validation->set_rules('bahan','Bahan','required');
        $this->form_validation->set_rules('bumbu','Bumbu','required');
        $this->form_validation->set_rules('resep','Cara','required');
        $this->form_validation->set_rules('kategori','kategori Resep','required');
        if($this->form_validation->run()==TRUE)
        {
            $resepid=$this->input->post('resepid',TRUE);
            $nama=$this->input->post('nama',TRUE);
            $bahan=$this->input->post('bahan',TRUE);
            $bumbu=$this->input->post('bumbu',TRUE);
            $resep=$this->input->post('resep',TRUE);
            $kategori=$this->input->post('kategori',TRUE);
            $photo='upload';
            if($this->resep_model->produk_edit($resepid,$nama,$bahan,$bumbu,$resep,$kategori,$photo)==TRUE)
            {               
                set_header_message('success','Ubah Resep','Berhasil mengubah resep');
                redirect(site_url('resep/reseps'),'refresh',301);
            }else{
                set_header_message('danger','Ubah Resep','Gagal mengubah resep');
                redirect(site_url('resep/reseps'),'refresh',301);
            }
        }else{
            $id=$this->input->get('id',TRUE);
            $d['title']="Ubah Resep";
            $d['editor'] = $this->editor_tinymce();
            $d['data']=$this->resep_model->produk_data(array('id_resep'=>$id));
            $this->load->view('toko/editresep',$d);
        }       
    }

    function editbumres()
    {
        $this->form_validation->set_rules('paketid','ID Paket Resep','required');
        $this->form_validation->set_rules('resepbumbu','Resep Bumbu','required');
        $this->form_validation->set_rules('bumburesep','Produk Bumbu','required');
        
        if($this->form_validation->run()==TRUE)
        {
            $paketid=$this->input->post('paketid',TRUE);
            $resepbumbu=$this->input->post('resepbumbu',TRUE);
            $bumburesep=$this->input->post('bumburesep',TRUE);
            if($this->resep_model->resep_edit($paketid,$resepbumbu,$bumburesep)==TRUE)
            {               
                set_header_message('success','Ubah Resep','Berhasil mengubah resep');
                redirect(site_url('resep/add_bumbu'),'refresh',301);
            }else{
                set_header_message('danger','Ubah Resep','Gagal mengubah resep');
                redirect(site_url('resep/add_bumbu'),'refresh',301);
            }
        }else{
            $id=$this->input->get('id',TRUE);
            $d['title']="Ubah Bumbu Resep";
            $d['data']=$this->resep_model->paket_data(array('id_paket'=>$id));
            $this->load->view('toko/editbumres',$d);
        }       
    }

	function delete()
    {
        $produkid=$this->input->get('id',TRUE);
        if($this->resep_model->produk_delete($produkid)==TRUE)
        {           
            set_header_message('success','Hapus resep','Berhasil menghapus resep');
            redirect(site_url('resep/reseps'),'refresh',301);
        }else{
            set_header_message('danger','Hapus resep','Gagal menghapus resep');
            redirect(site_url('resep/reseps'),'refresh',301);
        }
    }

    function deletebumres()
    {
        $paketid=$this->input->get('id',TRUE);
        if($this->resep_model->resep_delete($paketid)==TRUE)
        {           
            set_header_message('success','Hapus resep','Berhasil menghapus resep');
            redirect(site_url('resep/add_bumbu'),'refresh',301);
        }else{
            set_header_message('danger','Hapus resep','Gagal menghapus resep');
            redirect(site_url('resep/add_bumbu'),'refresh',301);
        }
    }

    function getdata()
    {
        $tipe=$this->input->get('tipe');
        if(!empty($tipe))
        {
            $tb=$tipe;
            
            $d=$this->m_db->get_data($tb);
            echo json_encode($d);
        }else{
            echo json_encode(array());
        }
    }

    function add_comment(){
        $this->load->helper('form');
        $this->load->helper('url');
        $data['url'] = $this->uri->segment(3);
        if($this->input->post('comment')=='comment'){
            $data = $this->input->post('data'); // mengambil data dari inputan
            if($this->db->insert('komentar',$data)){
                redirect('publik/resepview/', 'refresh');
             }else{
                echo "maaf, anda gagal membuat komentar";
             }            
        }        
        $this->load->view('publik/resepview',$data);        
    }

    public function komentar()
    {
        $query = $this->db->get('resep'); //query untuk mengambil data dari table posts
        $data['result']= $query->result_array(); // mengambil result $query dalam bentuk array
        foreach($data['result'] as $idx => $item){
            $query_comment= $this->db->get_where('komentar', array('id_resep' => $item['id_resep']));
            $data['result'][$idx]['komentar']= $query_comment->result_array();
        }
        $this->load->view('publik/resepview', $data); // memanggil view resep dan menyertakan variable $data
    }
}