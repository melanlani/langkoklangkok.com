<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
    public function __construct() {
        parent::__construct();

    

        //load model -> model_products
        $this->load->library('m_db');   
        $this->load->library('cart');
        $this->load->model('transaksi_model');
        $this->load->model('model_users');
    }

    public function index()
    {
        $this->load->view('show_cart');
    }

    function selesai()
    {
        if($this->session->userdata('roleid') != '2'){
            redirect(site_url('tamu'));
        }else{
            $this->form_validation->set_rules('pelangganid','ID Pelanggan','required');
            $this->form_validation->set_rules('total','Total Belanja','required');
            $this->form_validation->set_rules('ongkir','Ongkos Kirim','required');
            $this->form_validation->set_rules('berat','Berat Produk','required');
            if($this->form_validation->run()==TRUE)
            {
                $pelanggan=$this->input->post('pelangganid');
                $belanja=$this->input->post('belanja');
                $kodepos=$this->input->post('kodepos');
                $total=$this->input->post('total');
                $kurir=$this->input->post('kurir');
                $ongkir=$this->input->post('ongkir');
                $service=$this->input->post('service');
                $berat=$this->input->post('berat');
                $produk=$this->input->post('produk');
                //var_dump($_POST);
                $ext=$this->transaksi_model->penjualan_add($pelanggan,$belanja,$kodepos,$total,$kurir,$service,$ongkir,$produk,$berat);
                if($ext['status']==TRUE)
                {                   
                    $penjualanID=$ext['penjualanid'];
                    $this->cart->destroy();
                    redirect(site_url().'/pembayaran/detailpembayaran/'.$penjualanID);
                }else{
                    redirect(site_url().'/produk/keranjang');
                }
            }else{
                $user = $this->session->userdata('username');
                $data['history'] = $this->model_users->akun_member($user);
                $this->load->view('member/selesaiview',$data);
            }           
        }
    }

    function city()
    {
        $provinsi_id = $_GET['prov_id'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key:804bbf505c417df9f0572d77cfeb31a2"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
          echo '<option value="" selected disable>Kota/ Kabupaten</option>';

          for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
            
            echo '<option value="'.$data['rajaongkir']['results'][$i]['city_id'].','.$data['rajaongkir']['results'][$i]['city_name'].'">'.$data['rajaongkir']['results'][$i]['city_name'].'</option>';
        }
        }
    }

    function getcost()
    {
        $asal = 318;
        $dest = $this->input->post('dest',TRUE);
        $kurir = $this->input->post('kurir',TRUE);
        $berat = 0;

        foreach ($this->cart->contents() as $key) {
            $berat += ($key['weight'] * $key['qty']);
        }
        $curl = curl_init();

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$dest."&weight=".$berat."&courier=".$kurir."",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key:804bbf505c417df9f0572d77cfeb31a2"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, true);
              echo '<option value="" selected disable>Layanan yang tersedia</option>';

              for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {

                for ($l=0; $l < count($data['rajaongkir']['results'][$i]['costs']); $l++) {
                
                echo '<option value="'.$data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'].','
                .$data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')'
                .$data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'].'">';

                      echo $data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')'
                      .$data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'].'</option>';

                      echo $data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')'
                      .$data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'].'</option>';
                      }        
                }
            }
    }     

    function cost()
    {
        $biaya = explode(',', $this->input->post('layanan', TRUE));
        $belanja = $this->cart->total();
        if ( $belanja >= 90000)
        {
            $biaya=0;
            $bayar = ($belanja + 0);
            echo $biaya.','.$belanja.','.$bayar;
        }
        
        else {
        $biaya = explode(',', $this->input->post('layanan', TRUE));  
        $bayar = ($belanja + $biaya[0]);
        
    }
        echo $biaya[0].','.$belanja.','.$bayar;
    }

    function transaksi()
    {
        
        $status=$this->input->get('status')?$this->input->get('status'):"draft";
        $s=array(
        'status'=>$status,
        );
        $d["title"] = "Data Order";
        $d['data']=$this->m_db->get_data('penjualan',$s);
        $this->load->view('toko/transaksi/orderview',$d);
            
    }

    function transaksi_pelapak()
    {
        
        $status=$this->input->get('status')?$this->input->get('status'):"lunas";
        $d["title"] = "Data Order";
        $user = $this->session->userdata('userid');
        $d['data'] = $this->transaksi_model->transaksi_user($user,$status);
        $this->load->view('toko/transaksi/orderview_pelapak',$d);
            
    }

    function transaksi_gudang()
    {
        
        $d["title"] = "Data Produk di Gudang";
        $d['data'] = $this->transaksi_model->transaksi_gudang();
        $this->load->view('toko/transaksi/orderview_gudang',$d);
            
    }

    function detail()
    {
        $id=$this->input->get('id');
        $s=array(
        'penjualan_id'=>$id,
        );
        $d["title"] = "Detail Order";
        $d['data']=$this->m_db->get_data('penjualan',$s);
        $this->load->view('toko/transaksi/detailview',$d);
    }

    function approve()
    {
        $id=$this->input->get('id');
        $s=array(
        'penjualan_id'=>$id,
        'status'=>'konfirmasi',
        );
        $this->form_validation->set_rules('penjualanid','ID Penjualan','required');
        $this->form_validation->set_rules('invoice','Invoice Penjualan','required');
        if($this->form_validation->run()==TRUE)
        {
            $penjualanid=$this->input->post('penjualanid');
            $invoice=$this->input->post('invoice');
            if($this->transaksi_model->konfirmasi_pembayaran($penjualanid,$invoice)==TRUE)
            {
                set_header_message('success',"Konfirmasi Pembayaran",'Berhasil menerima pembayaran order');
                redirect(site_url('order/transaksi'));
            }else{
                set_header_message('danger',"Konfirmasi Pembayaran",'Gagal menerima pembayaran order');
                redirect(site_url('order/transaksi'));
            }
        }else{
            $d["title"] ="Konfirmasi Pembayaran";
            $d['data']=$this->m_db->get_data('penjualan',$s);
            $this->load->view('toko/transaksi/approveview',$d);
        }       
    }
    
    function shipping()
    {
        $id=$this->input->get('id');
        $s=array(
        'penjualan_id'=>$id,
        'status'=>'lunas',
        );
        $this->form_validation->set_rules('penjualanid','ID Penjualan','required');
        $this->form_validation->set_rules('invoice','Invoice Penjualan','required');
        if($this->form_validation->run()==TRUE)
        {
            $penjualanid=$this->input->post('penjualanid');
            $invoice=$this->input->post('invoice');
            if($this->transaksi_model->konfirmasi_pengiriman($penjualanid,$invoice)==TRUE)
            {
                set_header_message('success',"Konfirmasi Pembayaran",'Berhasil menerima pembayaran order');
                redirect(site_url('order/transaksi'));
            }else{
                set_header_message('danger',"Konfirmasi Pembayaran",'Gagal menerima pembayaran order');
                redirect(site_url('order/transaksi'));
            }
        }else{
            $d["title"] ="Konfirmasi Pembayaran";
            $d['data']=$this->m_db->get_data('penjualan',$s);
            $this->load->view('toko/transaksi/shippingview',$d);
        }       
    }

    function gudang_produk()
    {
        $id=$this->uri->segment(3);
        $jual=$this->uri->segment(4);
        $s=$this->input->get('gudang')?$this->input->get('gudang'):"belum";
        $status=$this->input->get('status')?$this->input->get('status'):"lunas";
        $this->form_validation->set_rules('penjualan_id','ID Penjualan','required');
        $this->form_validation->set_rules('produk_id','ID Produk','required');
        $this->form_validation->set_rules('userid','ID User','required');
        if($this->form_validation->run()==TRUE)
        {
            $penjualan_id=$this->input->post('penjualan_id');
            $produk_id=$this->input->post('produk_id');
            $userid=$this->input->post('userid');
            if($this->transaksi_model->konfirmasi_pengumpulan($penjualan_id,$produk_id,$userid)==TRUE)
            {
                set_header_message('success',"Konfirmasi Pembayaran",'Berhasil menerima pembayaran order');
                redirect(site_url('order/transaksi_pelapak'));
            }else{
                set_header_message('danger',"Konfirmasi Pembayaran",'Gagal menerima pembayaran order');
                redirect(site_url('order/transaksi_pelapak'));
            }
        }else{
            $d["title"] ="Konfirmasi Pengumpulan";
            $user = $this->session->userdata('userid');
            $d['data'] = $this->transaksi_model->pengumpulan($user,$s,$status,$id,$jual);
            $this->load->view('toko/transaksi/gudangview',$d);
        }       
    }

     function shipping_pelapak()
    {
        $id=$this->input->get('id');
        $s=array(
        'penjualan_id'=>$id,
        'status'=>'lunas',
        );
        $this->form_validation->set_rules('penjualanid','ID Penjualan','required');
        $this->form_validation->set_rules('invoice','Invoice Penjualan','required');
        if($this->form_validation->run()==TRUE)
        {
            $penjualanid=$this->input->post('penjualanid');
            $invoice=$this->input->post('invoice');
            if($this->transaksi_model->konfirmasi_pengiriman($penjualanid,$invoice)==TRUE)
            {
                set_header_message('success',"Konfirmasi Pembayaran",'Berhasil menerima pembayaran order');
                redirect(site_url('order/transaksi'));
            }else{
                set_header_message('danger',"Konfirmasi Pembayaran",'Gagal menerima pembayaran order');
                redirect(site_url('order/transaksi'));
            }
        }else{
            $d["title"] ="Konfirmasi Pembayaran";
            $user = $this->session->userdata('userid');
            $d['data'] = $this->transaksi_model->transaksi_user($user,$status);
            $this->load->view('toko/transaksi/shippingview',$d);
        }       
    }


    function delete()
    {
        $id=$this->input->get('id');
        $s=array(
        'penjualan_id'=>$id,
        'status'=>'draft',
        );
        if($this->m_db->delete_row('penjualan',$s)==TRUE)
        {
            set_header_message('success',"Hapus Order",'Berhasil Hapus Order');
            redirect(site_url('order/transaksi'));
        }else{
            set_header_message('danger',"Hapus Order",'Gagal Hapus Order');
            redirect(site_url('order/transaksi'));
        }
    }
}

