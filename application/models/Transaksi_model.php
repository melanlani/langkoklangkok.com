<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi_model extends CI_Model
{
	function __construct()
	{
		$this->load->library('m_db');
	}
	

	function get_shopping_history($user)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('*')
							->from('pelanggan, users')
							->where('username',$user)
							->where('pelanggan_id =pelanggan_id')
							->limit(1)
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function transaksi_user($user,$status)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*, p.*')
							->from('penjualan_detail i, users u, penjualan p ')
							->where('u.userid',$user)
							->where('p.status',$status)
							->where('p.penjualan_id = i.penjualan_id')
							->where('u.userid = i.userid')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function transaksi_user1($user1,$status)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*, p.*')
							->from('penjualan_detail i, users u, penjualan p ')
							->where('u.userid',$user1)
							->where('p.status',$status)
							->where('p.penjualan_id = i.penjualan_id')
							->where('u.userid = i.userid')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function transaksi_gudang()
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*, p.*')
							->from('penjualan_detail i, penjualan p')
							->where('p.penjualan_id = i.penjualan_id')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function pengumpulan($user,$s,$status,$id,$jual)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*, p.*')
							->from('penjualan_detail i, users u, penjualan p')
							->where('u.userid',$user)
							->where('i.gudang',$s)
							->where('p.status',$status)
							->where('i.produk_id',$id)
							->where('i.penjualan_id',$jual)
							->where('p.penjualan_id = i.penjualan_id')
							->where('u.userid = i.userid')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

            
	function lap_periode($user,$status,$t1,$t2)
	{
		$sql="Select * FROM penjualan where DATE(tanggal) BETWEEN '$t1' AND '$t2' AND status='kirim' ORDER BY tanggal DESC";
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*, p.*')
							->from('penjualan_detail i, users u, penjualan p ')
							->where('u.userid',$user)
							->where('p.status',$status)
							->where('p.penjualan_id = i.penjualan_id')
							->where('u.userid = i.userid')
							->where('DATE(tanggal) BETWEEN', $t1)
							->where($t2)
							->order_by('tanggal' , 'desc')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function lap_bulan($user,$status,$t1,$t2)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*, p.*')
							->from('penjualan_detail i, users u, penjualan p ')
							->where('u.userid',$user)
							->where('p.status',$status)
							->where('p.penjualan_id = i.penjualan_id')
							->where('u.userid = i.userid')
							->where('MONTH(tanggal)', $t1)
							->where('YEAR(tanggal)', $t2)
							->order_by('tanggal', 'desc')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function lap_tahun($user,$status,$t3)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*, p.*')
							->from('penjualan_detail i, users u, penjualan p ')
							->where('u.userid',$user)
							->where('p.status',$status)
							->where('p.penjualan_id = i.penjualan_id')
							->where('u.userid = i.userid')
							->where('YEAR(tanggal)', $t3)
							->order_by('tanggal', 'desc')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function penjualan_add($pelangganID,$belanja,$kodepos,$total,$kurir,$pelayanan,$ongkir,$produk=array(),$berat)
	{
		$dx=array();
		if(!empty($produk))
		{
			$kota=field_value('pelanggan','pelanggan_id',$pelangganID,'kota');
			$alamat=field_value('pelanggan','pelanggan_id',$pelangganID,'alamat');
			$tgl=date("Y-m-d H:i:s");
			$invoice=strtotime($tgl);
			$d=array(
			'pelanggan_id'=>$pelangganID,
			'invoice'=>$invoice,
			'tanggal'=>$tgl,
			'belanja'=>$belanja,
			'kodepos'=>$kodepos,
			'total'=>$total,
			'kurir'=>$kurir,
			'pelayanan'=>$pelayanan,
			'ongkir'=>$ongkir,
			'berat'=>$berat,
			'status'=>'draft',
			'kota'=>$kota,
			'alamat'=>$alamat,
			);
			if($this->m_db->add_row('penjualan',$d)==TRUE)
			{
				$penjualanID=$this->m_db->last_insert_id();
				$toko=toko_pusat();				
				foreach($produk as $r)
				{
					$produkID=$r['produkid'];
					$qty=$r['qty'];
					$harga=$r['harga'];
					$userid=$r['userid'];
					$subtotal=$r['subtotal'];
					$keterangan=$r['keterangan'];
					$d2=array(
					'penjualan_id'=>$penjualanID,
					'produk_id'=>$produkID,
					'userid'=>$userid,
					'qty'=>$qty,
					'harga'=>$harga,
					'userid'=>$userid,
					'subtotal'=>$subtotal,
					'gudang'=>'belum',
					'keterangan'=>$keterangan,
					);
					$this->m_db->add_row('penjualan_detail',$d2);
					/*
					$sStok=array(
					'produk_id'=>$produkID,
					'toko_id'=>$toko,
					);
					$stokJual=$this->m_db->get_row('produk_stok',$sStok,'stok_jual');
					$stokXX=$stokJual+$qty;
					$dStok=array(
					'stok_jual'=>$stokXX,
					);
					$this->m_db->edit_row('produk_stok',$dStok,$sStok);
					*/
				}
				$dx['status']=TRUE;
				$dx['penjualanid']=$penjualanID;
			}else{
				$dx['status']=FALSE;
			}
		}else{
			$dx['status']=FALSE;
		}
		return $dx;
	}
	
	function konfirmasi_pembayaran($penjualanid,$invoice)
	{
		$s=array(
		'penjualan_id'=>$penjualanid,
		'invoice'=>$invoice,
		);
		if($this->m_db->is_bof('penjualan',$s)==FALSE)
		{
			$s2=array(
			'penjualan_id'=>$penjualanid,
			);
			if($this->m_db->is_bof('penjualan_detail',$s2)==FALSE)
			{
				$Detail=$this->m_db->get_data('penjualan_detail',$s2);
				$toko=toko_pusat();
				foreach($Detail as $row)
				{					
					$produkID=$row->produk_id;
					$qty=$row->qty;
					$s3=array(
					'produk_id'=>$produkID,
					'toko_id'=>$toko,
					);
					$s4=array(
					'produk_id'=>$produkID,
					);
					$stok_jual=$this->m_db->get_row('produk_stok',$s3,'stok_jual');
					$qtybaru=$stok_jual+$qty;
					$d=array(
					'stok_jual'=>$qtybaru,
					);
					$beli=$this->m_db->get_row('produk',$s4,'jumlah_beli');
					$belibaru=$beli+$qty;
					$d3=array(
					'jumlah_beli'=>$belibaru,
					);
					$this->m_db->edit_row('produk_stok',$d,$s3);
					$this->m_db->edit_row('produk',$d3,$s4);
				}
				$d2=array(
				'status'=>'lunas',
				);
				$this->m_db->edit_row('penjualan',$d2,$s);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function konfirmasi_pengumpulan($penjualan_id,$produk_id,$userid)
	{
		$s=array(
		'penjualan_id'=>$penjualan_id,
		'produk_id'=>$produk_id,
		'userid'=>$userid,
		);
				$d2=array(
				'gudang'=>'ok',
				);
				$this->m_db->edit_row('penjualan_detail',$d2,$s);
				return true;
			
	}

	function konfirmasi_pengiriman($penjualanid,$invoice)
	{
		$s=array(
		'penjualan_id'=>$penjualanid,
		'invoice'=>$invoice,
		);
		if($this->m_db->is_bof('penjualan',$s)==FALSE)
		{
			$s2=array(
			'penjualan_id'=>$penjualanid,
			);
			if($this->m_db->is_bof('penjualan_detail',$s2)==FALSE)
			{
				$Detail=$this->m_db->get_data('penjualan_detail',$s2);
				$toko=toko_pusat();
				foreach($Detail as $row)
				{					
					$produkID=$row->produk_id;
					$qty=$row->qty;
					$s3=array(
					'produk_id'=>$produkID,
					'toko_id'=>$toko,
					);
					$s4=array(
					'produk_id'=>$produkID,
					);
					$stok_jual=$this->m_db->get_row('produk_stok',$s3,'stok_jual');
					$qtybaru=$stok_jual+$qty;
					$d=array(
					'stok_jual'=>$qtybaru,
					);
					$beli=$this->m_db->get_row('produk',$s4,'jumlah_beli');
					$belibaru=$beli+$qty;
					$d3=array(
					'jumlah_beli'=>$belibaru,
					);
					$this->m_db->edit_row('produk_stok',$d,$s3);
					$this->m_db->edit_row('produk',$d3,$s4);
				}
				$d2=array(
				'status'=>'kirim',
				);
				$this->m_db->edit_row('penjualan',$d2,$s);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
}