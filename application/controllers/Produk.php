<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	public function __construct() {
		parent::__construct();

    

		//load model -> model_products
        $this->load->library('m_db');   
        $this->load->library('cart');

        $this->load->model('produk_model');
        $this->load->model('supplier_model');
        $this->load->model('toko_model');
	}

    public function index()
    {
    
    }

	public function produks()
	{
        $d["title"] = "Produk";
        $user = $this->session->userdata('username');
		$d['products'] = $this->produk_model->get_shopping_history($user);
		$this->load->view('toko/mvproduk',$d);
	}

    function detailproduk($a)
    {
        $data['komen'] = $this->produk_model->getkomentar($a);
        $data['data_produk'] = $this->produk_model->getproduk($a);
        $data['data_stok'] = $this->produk_model->getstok($a);
        $data['record'] = $this->produk_model->view('produk');
        $this->load->view('publik/detailproduk',$data);
        
    }

    function kategori()
    {
        $id=$this->uri->segment(3);
        $nama=field_value('produk_kategori','kategori_id',$id,'nama_kategori');
        if(!empty($nama))
        {
                    
        $meta['judul']="$nama | ";
        $meta['judulhalaman']="Kategori Produk ".$nama;
       
        $d['kategoriid']=$id;
        $this->load->view('publik/kategoriview',$d);
        }else{
            redirect(base_url());
        }
    }

    function add_komentar()
    {
            $comment=$this->input->post('comment');
            $produkid=$this->input->post('produkid');
            $userid=$this->input->post('userid');
            $id_produk = $this->uri->segment(3);
            if($this->produk_model->komentar_add($comment, $produkid, $userid)==TRUE)
            {
                set_header_message('success','Tambah Komentar','Berhasil menambah komentar');
                //$this->load->view('publik/detailproduk');
                redirect('produk/detailproduk/'.$id_produk);
                
            }else{
                set_header_message('danger','Tambah Komentar','Gagal menambah komentar');
                //$this->load->view('publik/detailproduk');
                redirect('produk/detailproduk/'.$id_produk);
    
            }
    }

    function add()
    {
        $this->form_validation->set_rules('kode','Kode Produk','required');
        $this->form_validation->set_rules('nama','Nama Produk','required');
        $this->form_validation->set_rules('supplier','Supplier Produk','required');
        $this->form_validation->set_rules('kategori','kategori Produk','required');
        $this->form_validation->set_rules('merek','merek Produk','required');
        $this->form_validation->set_rules('harga','harga Produk','required');
        $this->form_validation->set_rules('berat','berat Produk','required');
        $this->form_validation->set_rules('deskripsi','deskripsi Produk','required');
        $this->form_validation->set_rules('stok','Stok Produk','required');
        if($this->form_validation->run()==TRUE)
        {
            $kode=$this->input->post('kode',TRUE);
            $nama=$this->input->post('nama',TRUE);
            $supplier=$this->input->post('supplier',TRUE);
            $kategori=$this->input->post('kategori',TRUE);
            $merek=$this->input->post('merek',TRUE);
            $harga=$this->input->post('harga',TRUE);
            $stok=$this->input->post('stok',TRUE);
            $berat=$this->input->post('berat',TRUE);
            $deskripsi=$this->input->post('deskripsi',TRUE);
            $toko=$this->toko_model->toko_pusat();
            $photo='upload';
            if($this->produk_model->produk_add_single($toko,$kode,$nama,$supplier,$merek,$kategori,$deskripsi,$stok,$harga,$berat,$photo)==TRUE)
            {
                $produkid=$this->m_db->last_insert_id();
                set_header_message('success','Tambah Produk','Berhasil menambah produk');
                redirect(site_url('produk/produks'),'refresh',301);
            }else{
                set_header_message('danger','Tambah Produk','Gagal menambah produk');
                redirect(site_url('produk/produks'),'refresh',301);
            }
        }
    }

    function edit()
    {
        $this->form_validation->set_rules('produkid','ID Produk','required');
        $this->form_validation->set_rules('kode','Kode Produk','required');
        $this->form_validation->set_rules('nama','Nama Produk','required');
        $this->form_validation->set_rules('supplier','Supplier Produk','required');
        $this->form_validation->set_rules('kategori','kategori Produk','required');
        $this->form_validation->set_rules('merek','merek Produk','required');
        $this->form_validation->set_rules('harga','harga Produk','required');
        $this->form_validation->set_rules('berat','berat Produk','required');
        $this->form_validation->set_rules('deskripsi','deskripsi Produk','required');
        if($this->form_validation->run()==TRUE)
        {
            $produkid=$this->input->post('produkid',TRUE);
            $kode=$this->input->post('kode',TRUE);
            $nama=$this->input->post('nama',TRUE);
            $supplier=$this->input->post('supplier',TRUE);
            $kategori=$this->input->post('kategori',TRUE);
            $merek=$this->input->post('merek',TRUE);
            $harga=$this->input->post('harga',TRUE);
            $berat=$this->input->post('berat',TRUE);
            $deskripsi=$this->input->post('deskripsi',TRUE);
            $photo='upload';
            if($this->produk_model->produk_edit($produkid,$kode,$nama,$supplier,$merek,$kategori,$deskripsi,$harga,$berat,$photo)==TRUE)
            {               
                set_header_message('success','Ubah Produk','Berhasil mengubah produk');
                redirect(site_url('produk/produks'),'refresh',301);
            }else{
                set_header_message('danger','Ubah Produk','Gagal mengubah produk');
                redirect(site_url('produk/produks'),'refresh',301);
            }
        }else{
            $id=$this->input->get('id',TRUE);
            $d['title']="Ubah Produk";
            $d['data']=$this->produk_model->produk_data(array('produk_id'=>$id));
            $this->load->view('toko/editproduk',$d);
        }       
    }

	function delete()
    {
        $produkid=$this->input->get('id',TRUE);
        if($this->produk_model->produk_delete($produkid)==TRUE)
        {           
            set_header_message('success','Hapus Produk','Berhasil menghapus produk');
            redirect(site_url('produk/produks'),'refresh',301);
        }else{
            set_header_message('danger','Hapus Produk','Gagal menghapus produk');
            redirect(site_url('produk/produks'),'refresh',301);
        }
    }

    function getdata()
    {
        $tipe=$this->input->get('tipe');
        if(!empty($tipe))
        {
            $tb="produk_".$tipe;
            if($tipe=="supplier")
            {
                $tb="supplier";
            }
            $d=$this->m_db->get_data($tb);
            echo json_encode($d);
        }else{
            echo json_encode(array());
        }
    }

    function getdata2()
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

    function beli()
    {
        $id=$this->uri->segment(3);
        $s=array(
        'produk_id'=>$id,
        );      
        if($this->m_db->is_bof('produk',$s)==FALSE)
        {
            $this->form_validation->set_rules('produkid','Produk','required');
            $this->form_validation->set_rules('qty','QTY','required');
            if($this->form_validation->run()==TRUE)
            {
                $produkid=$this->input->post('produkid');
                $qty=$this->input->post('qty');
                $nama=field_value('produk','produk_id',$produkid,'nama_produk');
                $kode=field_value('produk','produk_id',$produkid,'kode_produk');
                $berat=field_value('produk','produk_id',$produkid,'berat');
                $harga=field_value('produk','produk_id',$produkid,'harga');
                $userid=field_value('produk','produk_id',$produkid,'userid');
                $keterangan=$this->input->post('keterangan');
                
                $data = array(
                        'id'      => $kode,
                        'qty'     => $qty,
                        'price'   => $harga,
                        'name'    => $nama,
                        'weight'  =>$berat,
                        'produk_id'=>$produkid,
                        'userid'=>$userid,
                        'keterangan'=>$keterangan,
                );
                $this->cart->insert($data);
                redirect(site_url().'/produk/keranjang');
            }else{
                $d['produkid']=$id;
                $d['data']=$this->m_db->get_data('produk',$s);
                $this->load->view('publik/detailproduk',$d);
            }           
        }else{
            redirect(base_url());
        }
    }

    function keranjang()
    {
        $this->form_validation->set_rules('aksi','Aksi','required');
        if($this->form_validation->run()==TRUE)
        {
            $data=$_POST['info'];
            $this->cart->update($data);
            redirect(site_url().'/produk/keranjang');
            //var_dump($_POST);
        }else{
        $this->load->view('Show_cart');
        }
    }

    function cari()
    {
        $id=$this->input->get('cari');
        $sql="Select * from produk Where nama_produk LIKE '%$id%' OR deskripsi LIKE '%$id%'"; 
        $d['keyword']=$id;
        $d['dCariTerbaru']=$this->m_db->get_query_data($sql);
        $this->load->view('publik/cariview',$d);      
    }

    function tambah_rating(){
        if ($this->input->post('rating')!=''){
            $data = array('rating'=>$this->input->post('rating'));
            $where = array('produk_id' => $this->input->post('id'));
        $this->produk_model->update('produk', $data, $where);
        }
    }

}

