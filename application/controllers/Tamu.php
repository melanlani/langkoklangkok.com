<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu extends CI_Controller {
    public function __construct() {
        parent::__construct();

    

        //load model -> model_products
        $this->load->library('m_db');   
        $this->load->library('cart');
        $this->load->model('tamu_model');
        $this->load->model('model_users');
    }

    public function index()
    {
        $this->load->view('publik/checkout');
    }

    function selesai()
    {       
            $this->form_validation->set_rules('nama','Nama Tamu','required');
            $this->form_validation->set_rules('total','Total Belanja','required');
            $this->form_validation->set_rules('ongkir','Ongkos Kirim','required');
            $this->form_validation->set_rules('berat','Berat Produk','required');
            if($this->form_validation->run()==TRUE)
            {
                $nama=$this->input->post('nama');
                $email=$this->input->post('email');
                $notelp=$this->input->post('notelp');
                $kodepos=$this->input->post('kodepos');
                $kota=$this->input->post('kota');
                $alamat=$this->input->post('alamat');
                $belanja=$this->input->post('belanja');
                $total=$this->input->post('total');
                $kurir=$this->input->post('kurir');
                $ongkir=$this->input->post('ongkir');
                $service=$this->input->post('service');
                $berat=$this->input->post('berat');
                $produk=$this->input->post('produk');
                //var_dump($_POST);
                $ext=$this->tamu_model->penjualan_add($nama,$email,$notelp,$kodepos,$kota,$alamat,$belanja,$total,$kurir,$service,$ongkir,$produk,$berat);
                if($ext['status']==TRUE)
                {                   
                    $penjualanID=$ext['penjualanid'];
                    $this->cart->destroy();
                    redirect(site_url().'/tamu/carapembayaran/'.$penjualanID);
                }else{
                    redirect(site_url().'/produk/keranjang');
                }
            }else{
                $this->load->view('publik/checkout');
            }           
    }

    function cost()
    {
        $biaya = explode(',', $this->input->post('layanan', TRUE));
        $belanja = $this->cart->total();
        
        $biaya = explode(',', $this->input->post('layanan', TRUE));  
        $bayar = ($belanja + $biaya[0]);
        
        echo $biaya[0].','.$belanja.','.$bayar;
    }

    function carapembayaran()
    {
        $id=$this->uri->segment(3);

        $s=array(
        'penjualan_id'=>$id,
        );

        if($this->m_db->is_bof('penjualan',$s)==FALSE)
        {   
            $this->load->view('layout/header'); 
            $d['data']=$this->m_db->get_data('penjualan',$s);
            $this->load->view('publik/tagihanview',$d);
            $this->load->view('layout/footer');
        }else{
            redirect(base_url());
        }   
    }
        
    function konfirmasi()
    {
        $this->form_validation->set_rules('invoice','Nomor Invoice','required');
        $this->form_validation->set_rules('bankid','Tujuan Bank','required');
        $this->form_validation->set_rules('pemilik','Pemilik Rekening','required');
        $this->form_validation->set_rules('tanggal','Tanggal Transfer','required');
        if($this->form_validation->run()==TRUE)
        {
            $invoice=$this->input->post('invoice');
            $bank=$this->input->post('bankid');
            $pemilik=$this->input->post('pemilik');
            $tanggal=$this->input->post('tanggal');
            $penjualanid=field_value('penjualan','invoice',$invoice,'penjualan_id');
            $d=array();
            $ok=FALSE;
            $bukti=$_FILES['bukti']['name'];
            if(!empty($bukti))
            {
                $ext=pathinfo($bukti,PATHINFO_EXTENSION);
                $imgname="bukti-".$invoice.".".$ext;
                $path = FCPATH.'uploads/bukti/';
                $allow= "jpg|bmp|pdf|png|jpeg";
                $maxsize    = 0;
                $max_filename=0;                
                $config['upload_path']          = $path;
                $config['allowed_types']        = $allow;
                $config['max_size']             = $maxsize;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['file_name']            = $imgname;
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);
                if($this->upload->do_upload('bukti'))
                {
                    $d=array(
                    'invoice'=>$invoice,
                    'bank_id'=>$bank,
                    'pemilik'=>$pemilik,
                    'tanggal'=>date("Y-m-d H:i:s"),
                    'tanggal_transfer'=>$tanggal,
                    'bukti_transfer'=>$imgname,
                    'penjualan_id'=>$penjualanid,
                    );
                }
            }else{
                $d=array(
                'invoice'=>$invoice,
                'bank_id'=>$bank,
                'pemilik'=>$pemilik,
                'tanggal'=>date("Y-m-d H:i:s"),
                'tanggal_transfer'=>$tanggal,
                'penjualan_id'=>$penjualanid,
                );
            }
            $s=array(
            'penjualan_id'=>$penjualanid,
            );
            if($this->m_db->is_bof('penjualan_konfirmasi',$s)==FALSE)
            {
                redirect(base_url().'tracking'.'?invoice='.$invoice);
            }else{
                if($this->m_db->add_row('penjualan_konfirmasi',$d)==TRUE)
                {
                    $d2=array(
                    'status'=>'konfirmasi',
                    );
                    $this->m_db->edit_row('penjualan',$d2,$s);
                    redirect(site_url().'/pembayaran/cektagihan'.'?invoice='.$invoice);
                }else{
                    redirect(site_url().'/tamu/konfirmasi?s=1');
                }
            }
        }else{
            $this->load->view('publik/konfirmasiview_pelapak');
        }
    }
    

    function getinvoice()
    {
        $invoice=$this->input->get('invoice');

        $s=array(
        'invoice'=>$invoice,
        );
        if($this->m_db->is_bof('penjualan',$s)==FALSE)
        {
            $nama=$this->m_db->get_row('penjualan',$s,'tamu');
            $jual=$this->m_db->get_row('penjualan',$s,'total');
            $ongkir=$this->m_db->get_row('penjualan',$s,'ongkir');
            $total=$jual;
            echo json_encode(array(
            'status'=>'ok',
            'total'=>"Rp ".number_format($total,0),
            'nama'=>$nama,
            ));
        }else{
            echo json_encode(array('status'=>'no'));
        }
    }
}

