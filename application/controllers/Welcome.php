<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
	}

	public function index()
	{
		$data ['products'] = $this->produk_model->all();
		$this->load->view('welcome_message', $data);
	}

	public function add_to_cart($produk_id)
	{
		$product = $this->produk_model->find($produk_id);
		$data = array(
        'produk_id'     => $product->produk_id,
        'qty'     		=> 1,
        'price'   		=> $product->harga,
        'name'   		=> $product->nama_produk
		);

		$this->cart->insert($data);
		redirect(base_url());
	}

	public function cart()
	{
		//display what currently inside the cart
		//print_r($this->cart->contents());
		$this->load->view('show_cart');
	}
	
	public function clear_cart() 
	{
		$this->cart->destroy();
		redirect(site_url('welcome/cart'));
	}

	function hapus()
    {
        $id=$this->uri->segment(3);
        if(!empty($id))
        {
            $this->cart->remove($id);
            redirect(site_url().'/produk/keranjang');
        }else{
            redirect(site_url().'/produk/keranjang');
        }
    }

}
