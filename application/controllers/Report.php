<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();

    

        //load model -> model_products
        $this->load->library('m_db');   
        $this->load->library('cart');
        $this->load->model('transaksi_model');
        $this->load->model('produk_model');
        $this->load->model('model_users');
    }

    function index()
    {       
        $status=$this->input->get('status')?$this->input->get('status'):"kirim";
        $user1 = $this->session->userdata('userid');
        $d['data'] = $this->transaksi_model->transaksi_user1($user1,$status);
        $d['title']="Laporan Penjualan";
        $user = $this->session->userdata('username');
        $d['products'] = $this->produk_model->get_shopping_history($user);
        $this->load->view('toko/laporan/laporanview',$d);
    }

    function periode()
    {
        $this->form_validation->set_rules('t1','Dari Tanggal','required');
        $this->form_validation->set_rules('t2','Hingga Tanggal','required');
        if($this->form_validation->run()==TRUE)
        {
            $t1=$this->input->post('t1');
            $t2=$this->input->post('t2');
            $meta['judul']="Laporan Penjualan Barang";
            $meta['deskripsi']="Periode ".date("d-m-Y",strtotime($t1))." hingga ".date("d-m-Y",strtotime($t2));
            $this->load->view('toko/laporan/template_laporan/header',$meta);
            $user = $this->session->userdata('userid');
            $sql="Select * FROM penjualan where DATE(tanggal) BETWEEN '$t1' AND '$t2' AND status='kirim' ORDER BY tanggal DESC";
            $d['data']=$this->m_db->get_query_data($sql,$user);
            $this->load->view('toko/laporan/detailview',$d);
            $this->load->view('toko/laporan/template_laporan/footer');
        }else{
            redirect(site_url('report'));
        }
    }

    function semua()
    {
        $status=$this->input->get('status')?$this->input->get('status'):"kirim";
        $user1 = $this->session->userdata('userid');
        
            $meta['judul']="Laporan Penjualan Barang";
            $meta['deskripsi']="Data Keseluruhan Penjualan";
            $this->load->view('toko/laporan/template_laporan/header',$meta);
            $d['data'] = $this->transaksi_model->transaksi_user1($user1,$status);
            $this->load->view('toko/laporan/detailview2',$d);
            $this->load->view('toko/laporan/template_laporan/footer');
      
    }
    
    function bulanan()
    {
        $this->form_validation->set_rules('bulan','Bulan','required');
        $this->form_validation->set_rules('tahun','Tahun','required');
        if($this->form_validation->run()==TRUE)
        {
            $t1=$this->input->post('bulan');
            $t2=$this->input->post('tahun');
            $meta['judul']="Laporan Penjualan Barang";
            $namaBulan=date_month_name($t1);
            $meta['deskripsi']="Bulan ".$namaBulan." Tahun ".$t2;
            $this->load->view('toko/laporan/template_laporan/header',$meta);

            $status=$this->input->get('status')?$this->input->get('status'):"kirim";
            $user = $this->session->userdata('userid');
            $d['data']=$this->transaksi_model->lap_bulan($user,$status,$t1,$t2);
            $this->load->view('toko/laporan/detailview',$d);
            $this->load->view('toko/laporan/template_laporan/footer');
        }else{
            redirect(site_url('report'));
        }
    }

    function tahunan()
    {
        $this->form_validation->set_rules('tahun','Tahun','required');
        if($this->form_validation->run()==TRUE)
        {
            $t3=$this->input->post('tahun');
            $meta['judul']="Laporan Penjualan Barang";
            $meta['deskripsi']=" Tahun ".$t3;
            $this->load->view('toko/laporan/template_laporan/header',$meta);

            $status=$this->input->get('status')?$this->input->get('status'):"kirim";
            $user = $this->session->userdata('userid');
            $d['data']=$this->transaksi_model->lap_tahun($user,$status,$t3);
            $this->load->view('toko/laporan/detailview',$d);
            $this->load->view('toko/laporan/template_laporan/footer');
        }else{
            redirect(site_url('report'));
        }
    }
    
    function produk()
    {
        $this->form_validation->set_rules('t1','Dari Tanggal','required');
        $this->form_validation->set_rules('t2','Hingga Tanggal','required');
        $this->form_validation->set_rules('produk','ID Produk','required');
        if($this->form_validation->run()==TRUE)
        {
            $pro=$this->input->post('produk');
            $t1=$this->input->post('t1');
            $t2=$this->input->post('t2');
            $namaProduk=field_value('produk','produk_id',$pro,'nama_produk');
            $meta['judul']="Laporan Penjualan Barang";
            $meta['deskripsi']=$namaProduk."<br/>Periode ".date("d-m-Y",strtotime($t1))." hingga ".date("d-m-Y",strtotime($t2));
            $this->load->view('toko/laporan/template_laporan/header',$meta);
            $sql="Select * FROM penjualan_detail LEFT JOIN penjualan ON penjualan_detail.penjualan_id = penjualan.penjualan_id where DATE(penjualan.tanggal) BETWEEN '$t1' AND '$t2' AND penjualan.status='kirim' AND penjualan_detail.produk_id='$pro' ORDER BY penjualan.tanggal DESC";
            $d['data']=$this->m_db->get_query_data($sql);
            $this->load->view('toko/laporan/detailview',$d);
            $this->load->view('toko/laporan/template_laporan/footer');
        }else{
            redirect(site_url('report'));
        }
    }
    
    function transaksi()
    {
        
        $status=$this->input->get('status')?$this->input->get('status'):"draft";
        $s=array(
        'status'=>$status,
        );
        $d["title"] = "Data Order";
        $d['data']=$this->m_db->get_data('penjualan',$s);
        $this->load->view('toko/laporan/laporanorder',$d);
            
    }

    function konfirmasi()
    {
        
        $status=$this->input->get('status')?$this->input->get('status'):"konfirmasi";
        $s=array(
        'status'=>$status,
        );
        $d["title"] = "Data Order";
        $d['data']=$this->m_db->get_data('penjualan',$s);
        $this->load->view('toko/laporan/laporanorder',$d);
            
    }

    function kirim()
    {
        
        $status=$this->input->get('status')?$this->input->get('status'):"kirim";
        $s=array(
        'status'=>$status,
        );
        $d["title"] = "Data Order";
        $d['data']=$this->m_db->get_data('penjualan',$s);
        $this->load->view('toko/laporan/laporanorder',$d);
            
    }

    function transaksi_pelapak()
    {
        
        $status=$this->input->get('status')?$this->input->get('status'):"lunas";
        $s=array(
        'status'=>$status,
        );
        $d["title"] = "Data Order";
        $d['data']=$this->m_db->get_data('penjualan',$s);
        $this->load->view('toko/laporan/laporanpelapak',$d);
            
    }

    function kirim_pelapak()
    {
        
        $status=$this->input->get('status')?$this->input->get('status'):"kirim";
        $s=array(
        'status'=>$status,
        );
        $d["title"] = "Data Order";
        $d['data']=$this->m_db->get_data('penjualan',$s);
        $this->load->view('toko/laporan/laporanpelapak',$d);
            
    }

    
}

