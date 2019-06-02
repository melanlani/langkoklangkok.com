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

                        <a href="<?=site_url('order/transaksi');?>?status=draft" class="btn btn-md btn-default">Order</a>
						<a href="<?=site_url('order/transaksi');?>?status=konfirmasi" class="btn btn-md btn-info">Konfirmasi</a>
						<a href="<?=site_url('order/transaksi');?>?status=lunas" class="btn btn-md btn-success">Lunas</a>
						<a href="<?=site_url('order/transaksi_gudang');?>" class="btn btn-md btn-success">Gudang</a>
						<a href="<?=site_url('order/transaksi');?>?status=kirim" class="btn btn-md btn-primary">Kirim</a>
                        <br><br>
                          
                        <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>     
                                <th>INVOICE</th>
								<th>Tanggal</th>
								<th>Item</th>
								<th>Total Jual</th>
								<th>Kurir</th>
								<th>Grand Total</th>
								<th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								if(!empty($data))
								{
									foreach($data as $row)
									{
										$total=$row->belanja;
										$ongkir=$row->ongkir;
										$grand=$total+$ongkir;
									?>
									<tr>
										<td><?=$row->invoice;?></td>
										<td><?=date("d-m-Y",strtotime($row->tanggal));?></td>
										<td>
											<?php
											$dOrder=$this->m_db->get_data('penjualan_detail',array('penjualan_id'=>$row->penjualan_id,'userid'=>$row->userid, 'produk_id'=>$row->produk_id));
											if(!empty($dOrder))
											{
												foreach($dOrder as $rOrder)
												{
													$nama_produk=field_value('produk','produk_id',$rOrder->produk_id,'nama_produk');
													echo '<li>'.$nama_produk.' <b>'.$rOrder->qty.' item</b> <br/> Rp '.number_format($rOrder->harga,0).'</li>';
												}
											}
								?>
                                    	</td>
										<td>Rp <?=number_format($total,0);?></td>
										<td>
											<?=strtoupper($row->kurir)."(".$row->pelayanan.") Rp".number_format($ongkir,0);?><br/>
										</td>
										<td>Rp <?=number_format($grand,0);?></td>
										<td>
											<?php
											if($row->gudang=="ok")
											{
												?>
												Sudah berada di gudang
												
											<?php
											}elseif($row->gudang=="belum"){
												?>
												Belum di gudang
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