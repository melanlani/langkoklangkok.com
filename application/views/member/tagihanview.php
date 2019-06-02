<?php
if(empty($data))
{
	redirect(base_url());
}
foreach($data as $row){	
}
$pelangganid=$row->pelanggan_id;
$total=$row->total;
$s=array(
'penjualan_id'=>$row->penjualan_id,
);
$pembelian=$this->m_db->get_data('penjualan_detail',$s);
?>
<style>
	.form-horizontal .control-label
	{
		font-weight: lighter;
	}
	#header, #footer, #nav, .noprint
	{
	display: none;
	}
</style>
	<section id="cart_items">
        <div class="container">		
        <br>

				<a href="javascript:;" class="btn btn-default btn-md hidden-print" onclick="window.print();"><i class="fa fa-print"></i> Cetak Invoice</a>

				<div class="form-horizontal visible-print">
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Tagihan Order</h2>
					</div>
				</div>
					<div class="">
					<div class="col-xs-4">
						<div class="form-group">
							<label class="col-xs-3 control-label" for="">Tanggal</label>
							<div class="col-xs-9">
								<p class="form-control-static"><?=date("d-m-Y",strtotime($row->tanggal));?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label" for="">Kepada</label>
							<div class="col-xs-9">
								<p class="form-control-static"><?=pelanggan_info_custom($pelangganid,'nama_pelanggan');?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label" for="">Alamat</label>
							<div class="col-xs-9">
								<p class="form-control-static"><?=$row->alamat;?></p>
							</div>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group">
							<label class="col-xs-3 control-label" for="">Handphone</label>
							<div class="col-xs-9">
								<p class="form-control-static"><?=pelanggan_info_custom($pelangganid,'notelp');?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label" for="">Kota</label>
							<div class="col-xs-9">
								<p class="form-control-static"><?=field_value('lokasi_kota','kota_id',$row->kota,'nama_kota');?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-3 control-label" for="">Invoice</label>
							<div class="col-xs-9">
								<p class="form-control-static">#<?=$row->invoice;?></p>
							</div>
						</div>	
					</div>	
					<div class="col-xs-4">
						<b>Total Bayar : </b>
						<h3 id="totalbayar">Rp <?=number_format($total,0);?></h3>
						<h4>
							<?="(".$row->pelayanan.") ".strtoupper($row->kurir);?> Rp <?=number_format($row->ongkir,0);?><br/>
						</h4>
						<?php
						if($row->status=="draft")
						{
							?>
							<div class="alert alert-warning">Belum dibayarkan</div>
							<?php
						}elseif($row->status=="konfirmasi"){
							?>
							<div class="alert alert-info">Tahap Verifikasi Pembayaran</div>
							<?php
						}elseif($row->status=="lunas"){
							?>
							<div class="alert alert-primary">Packing Item</div>
							<?php
						}elseif($row->status=="kirim"){
							?>
							<div class="alert alert-success">Telah Dikirim</div>
							<?php
						}
						?>
					</div>
					</div>
						<table class="table table-bordered">
						<thead>
							<th>Nama Produk</th>
							<th width="10%">Jumlah</th>
							<th width="20%">Harga</th>
							<th width="20%">Sub Total</th>
						</thead>
						<tbody>
							<?php
							$i=0;	
							if(!empty($pembelian))
							{
								foreach($pembelian as $item)
								{
									$produkid=$item->produk_id;
									$berat_tmp=produk_info($produkid,'berat');
								?>
								<tr>
									<td>
										<?=produk_info($produkid,'kode_produk');?>-<?=produk_info($produkid,'nama_produk');?><br/>
										Berat : <?=$berat_tmp;?> gram
									</td>
									<td>
										<?=$item->qty;?>
									</td>
									<td>
										Rp <?=number_format($item->harga,0);?>
									</td>
									<td>
										Rp <?=number_format($item->subtotal,0);?>
									</td>			
								</tr>				
								<?php
								}
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3">Total</td>
								<td>
									Rp <?=number_format($row->belanja,0);?>
								</td>
							</tr>
						</tfoot>
						</table>

				</div>
			</div>
		</section>
<?php
$v['total']="Rp ".number_format($total,0);
$this->load->view('member/bankview',$v);
?>