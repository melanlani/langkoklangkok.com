<?php $this->load->view('layout/header')?>

		<section id="cart_items">
	        <div class="container">	
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Historis Belanja</h2>
					</div>
					<div class="breadcrumbs">
		                <ol class="breadcrumb">
		                  <li><a href="<?=base_url(); ?>">Home</a></li>
		                  <li class="active">Historis Belanja</li>
		                </ol>
		            </div>
				<div class="table-responsive cart_info">
                <table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
						<td>Tanggal</td>
						<td>Invoice</td>
						<td>Total Belanja</td>
						<td>Ongkos Kirim</td>
						<td>Total Bayar</td>
						<td>Status Pemesanan</td>
					</thead>
					<tbody>
					<?php
					if(!empty($data))
					{
						foreach($data as $row){
						?>
						<tr>
							<td><?=date("d-m-Y",strtotime($row->tanggal));?></td>
							<td><?=$row->invoice;?></td>
							<td><?=number_format($row->total,0);?></td>
							<td><?=number_format($row->ongkir,0);?></td>
							<td><?=number_format($row->total,0);?></td>
							<td>
								<?php
								if($row->status=="draft")
								{
									?>
									<a href="<?=site_url();?>/pembayaran/detailpembayaran/<?=$row->penjualan_id;?>" class="btn btn-success btn-xs btn-flat">Bayar</a>
									<?php
								}elseif($row->status=="konfirmasi"){
									?>
									Tahap Verifikasi Pembayaran
									<?php
								}elseif($row->status=="lunas"){
									?>
									Packing Item
									<?php
								}elseif($row->status=="kirim"){
									?>
									Telah Dikirim
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
			</section>

<?php $this->load->view('layout/footer')?>