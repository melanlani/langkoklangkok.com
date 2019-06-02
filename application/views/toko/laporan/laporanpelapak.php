<?php
  $this->load->view('admin/admin_header.php');
?>

	<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
						<a href="javascript:;" class="btn btn-default btn-md hidden-print" onclick="window.print();"><i class="fa fa-print"></i> Cetak Laporan</a>
                        <br><br>
                    <div class="panel panel-info">
                        <div class="panel-body">
                        <img src="<?= base_url('assets/images/home/logoo.png');?>" />
                    	<h3>Tabel Laporan</h3>
						<table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>     
                                <th>INVOICE</th>
								<th>Tanggal</th>
								<th>Item</th>
								<th>Total Jual</th>
								<th>Kurir</th>
								<th>Grand Total</th>
								<th>Status</th>
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
											$dOrder=$this->m_db->get_data('penjualan_detail',array('penjualan_id'=>$row->penjualan_id));
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
											if($row->status=="draft")
											{
												?>
												List Pesanan
												<?php
											}elseif($row->status=="konfirmasi"){
												?>
												Sudah Dibayarkan
												<?php
											}elseif($row->status=="lunas"){
												?>
												Lunas
												<?php
											}elseif($row->status=="kirim"){
												?>
												Dikirim
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
					<?php $tgl= date("d-m-Y")?>
						<table cellspacing="0" width="100%">
							<thead>
								<th></th>
                              	<th><b>Padang,<?=$tgl?></b></th>
                              	<th></th>
                            </thead>
                            <tbody>
                            	<td></td>
                            	<td><h5><b>Diketahui Oleh, </b></h5><br>
                            		<h5><b>Pengelola Lapak</b></h5>
                            		<img src="<?=base_url('asset/images/ttd.jpeg');?>" style="width:120px; height:70px;"><br>
                            		<h5>Administrator</h5>
                            	</td>
                            	<td><br><br><br><h5><b>Pelapak</b></h5><br><br><br>
                            		<h5><?php echo $this->session->userdata('username'); ?></h5>
                            	</td>
                            </tbody>
                        </table>

					</div>
				</div>
			</div>
		</div>
	</section>

<?php $this->load->view("admin/admin_footer"); ?>

