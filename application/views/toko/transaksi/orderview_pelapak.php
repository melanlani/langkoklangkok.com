<?php
  $this->load->view('admin/admin_header.php');
?>

	<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <div class="panel panel-info">
                        <div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Daftar Semua Produk</div>
                        <div class="panel-body">

						<a href="<?=site_url('order/transaksi_pelapak');?>?status=lunas" class="btn btn-md btn-success">Gudang</a>
						<a href="<?=site_url('order/transaksi_pelapak');?>?status=kirim" class="btn btn-md btn-primary">Kirim</a>
                        <br><br>
                          
                        <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>     
                                <th>INVOICE</th>
								<th>Tanggal</th>
								<th>Nama Pembeli</th>
								<th>Item</th>
								<th>Total Jual</th>
								<th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								if(!empty($data))
								{
									foreach($data as $row)
									{
										$ongkir=$row->ongkir;
										
									?>
									<tr>
										<td><?=$row->invoice;?></td>
										<td><?=date("d-m-Y",strtotime($row->tanggal));?></td>
										<?php 
										$pelanggan=field_value('pelanggan','pelanggan_id',$row->pelanggan_id,'nama_pelanggan');
										?>
										
										<?php if($row->pelanggan_id == 0){?>
										<td>
											<?=$row->tamu;?>
										</td>
										<?php }else{ ?>
											<td>
											<?=$pelanggan; ?>
										</td>
												<?php 
											} ?>
										<td>
											<?php
											$take=$this->m_db->get_data('penjualan_detail',array('penjualan_id'=>$row->penjualan_id, 
												'userid'=>$row->userid, 'produk_id'=>$row->produk_id));
											if(!empty($take))
											{
												foreach($take as $rOrder)
												{
													$nama_produk=field_value('produk','produk_id',$rOrder->produk_id,'nama_produk');
													echo '<li>'.$nama_produk.' <b>'.$rOrder->qty.' item</b> <br/> Rp '.number_format($rOrder->harga,0).'</li>';
												}
											}
								?>
                                    	</td>
                                    	<?php $total = $row->harga * $row->qty; ?>
										<td>Rp <?=number_format($total,0);?></td>
										<td>
											<a href="<?=site_url();?>/order/detail?id=<?=$row->penjualan_id;?>" class="btn btn-default btn-xs btn-flat"><i class="fa fa-info"></i> Detail</a>
											<?php
											$take=$this->m_db->get_data('penjualan_detail',array('penjualan_id'=>$row->penjualan_id, 
												'userid'=>$row->userid, 'produk_id'=>$row->produk_id));
											if(!empty($take))
											{
												foreach($take as $rOrder)
												{
													$gudang= $rOrder->gudang;
													?>

												<?php
											if($gudang=="belum"){
												?>
												<a href="<?=site_url();?>/order/gudang_produk/<?=$rOrder->produk_id;?>/<?=$rOrder->penjualan_id;?>" class="btn btn-success btn-xs btn-flat"><i class="fa fa-archive"></i> Kirim ke gudang</a>
												
												<?php
											}elseif($gudang=="ok"){
												?>
												Sudah berada digudang
												
											<?php
											}
											}
											}
											?>
											<?php
											if($row->status=="kirim"){
												?>
												dan dikirim ke tujuan
												<?php
											}
											?>
										</td>
									</tr>
									<?php
									}
								}
								?>
							</tbody>
						</table>
                        </div>
                    </div>
              	</div>
          	</div>
      	</div>
  	</section>

<script >
      $(document).ready(function(){
        $('#myTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});
      });
</script>

<?php $this->load->view("admin/admin_footer"); ?>