<?php
  $this->load->view('admin/admin_header.php');
?>

<?php
if(empty($data))
{
	redirect(site_url('order/transaksi'));
}
foreach($data as $row){	
}
$pelangganid=$row->pelanggan_id;
$total=$row->belanja+$row->ongkir;
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
</style>

<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <div class="panel panel-info">
                        <div class="panel-body">

						<a href="javascript:;" class="btn btn-default btn-md hidden-print" onclick="window.print();"><i class="fa fa-print"></i> Cetak Invoice</a>

						<div class="form-horizontal">
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
								$s=array(
								'penjualan_id'=>$row->penjualan_id,
								'invoice'=>$row->invoice,
								);
								if($this->m_db->is_bof('penjualan_konfirmasi',$s)==FALSE)
								{
									$dKon=$this->m_db->get_data('penjualan_konfirmasi',$s);
									foreach($dKon as $rKon){				
									}
									$bukti="";
									$filepath=FCPATH.'assets/uploads/'.$rKon->bukti_transfer;
									if(file_exists($filepath) && is_file($filepath))
									{
										$buktiX=base_url().'assets/uploads/'.$rKon->bukti_transfer;
										$bukti='<a href="'.$buktiX.'" target="_blank">Bukti Transfer</a>';
									}
								?>
									Pembayaran via <b><?=field_value('bank','bank_id',$rKon->bank_id,'nama_bank');?></b><br/>
									Tanggal <b><?=date("d-m-Y",strtotime($rKon->tanggal_transfer));?></b><br/>
									<?=$bukti;?>
								<?php
								}
								?>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
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
						<?php
						echo validation_errors();
						echo form_open(site_url('order/approve'),array('class'=>'form-horizontal'));
						?>
						<input type="hidden" name="penjualanid" value="<?=$row->penjualan_id;?>"/>
						<input type="hidden" name="invoice" value="<?=$row->invoice;?>"/>
						<div class="form-group">
							<label class="col-sm-2 control-label">&nbsp;</label>
							<div class="col-md-10">
								<button type="submit" onclick="return confirm('Yakin telah menerima dana transfer ini?');" class="btn btn-primary btn-flat">Saya telah memeriksa dan menerima pembayaran ini</button>
								<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
							</div>
						</div>
						<?php
						echo form_close();
						?>
						</div>
                    </div>
              	</div>
          	</div>
      	</div>
  	</section>


<?php $this->load->view("admin/admin_footer"); ?>