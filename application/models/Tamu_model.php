<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tamu_model extends CI_Model
{
	function __construct()
	{
		$this->load->library('m_db');
	}
	

	function penjualan_add($nama,$email,$notelp,$kodepos,$kota,$alamat,$belanja,$total,$kurir,$pelayanan,$ongkir,$produk=array(),$berat)
	{
		$dx=array();
		if(!empty($produk))
		{
			$tgl=date("Y-m-d H:i:s");
			$invoice=strtotime($tgl);
			$d=array(
			'tamu'=>$nama,
			'invoice'=>$invoice,
			'tanggal'=>$tgl,
			'belanja'=>$belanja,
			'total'=>$total,
			'kurir'=>$kurir,
			'pelayanan'=>$pelayanan,
			'ongkir'=>$ongkir,
			'berat'=>$berat,
			'status'=>'draft',
			'email'=>$email,
			'notelp'=>$notelp,
			'kodepos'=>$kodepos,
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