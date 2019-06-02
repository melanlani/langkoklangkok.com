<?php $this->load->view('layout/header.php');?>

<?php
if(empty($data))
{
?>

	<section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="<?=base_url(); ?>">Home</a></li>
                  <li class="active">Tracking View</li>
                </ol>
            </div>
        </div>
    </section>
			<?php
			echo validation_errors();
			echo form_open(site_url('pembayaran/cektagihan'),array('class'=>'form-horizontal','method'=>'get'));
			?>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="">No Invoice</label>
				<div class="col-md-5">
					<input type="text" name="invoice" id="" class="form-control " autocomplete="" placeholder="Invoice" required="" value="<?php echo set_value('invoice'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">&nbsp;</label>
				<div class="col-md-10">
					<button type="submit" class="btn btn-primary btn-flat">Cek</button>		
				</div>
			</div>	

			<?php
			echo form_close();
			?>
			<?php
			}else{
				foreach($data as $row){		
				}
				$status=$row->status;
				$invoice=$row->invoice;	
				if($status=="draft")
				{
					?>
						<div class="container">
						<div class="register-req">
			                <p class="lead" style="color:red;"><b>Invoice Belum dibayarkan atau belum dikonfirmasi</b></p>
			            </div><!--/register-req-->
			            </div>
					<?php
				}elseif($status=="konfirmasi"){
					?>
						<div class="container">
						<div class="register-req">
			                <p class="lead" style="color:red;"><b>Invoice Tahap Validasi</b></p>
			            </div><!--/register-req-->
			            </div>
					<?php
				}elseif($status=="lunas"){
					?>
						<div class="container">
						<div class="register-req">
			                <p class="lead" style="color:red;"><b>Order telah dikirim</b></p>
			            </div><!--/register-req-->
			            </div>
					<?php
				}
				?>
			<section id="cart_items">
	        <div class="container">	
				<div class="table-responsive cart_info">
                <table class="table table-condensed">
					<thead>
					<tr class="cart_menu">
						<td class="image">Produk</td>
						<td class="description"></td>
						<td class="quantity">Jumlah</td>
						<td class="price">Harga</td>
						<td class="total">Sub Total</td>
					</tr>
					</thead>
					<tbody>
						<?php
						$sItem=array(
						'penjualan_id'=>$row->penjualan_id,
						);
						$dItem=$this->m_db->get_data('penjualan_detail',$sItem);
						if(!empty($dItem))
						{
							foreach($dItem as $rItem)
							{
								$photoBaru=produk_photo($rItem->produk_id,1);
								foreach($photoBaru as $rPhotoBaru)
								{								
								}
								$urlPhotoBaru=base_url().'uploads/'.$rPhotoBaru->photo;
								$pathPhotoBaru=FCPATH.'uploads/'.$rPhotoBaru->photo;
								if(!file_exists($pathPhotoBaru) && !file_exists($pathPhotoBaru))
								{
									$urlPhotoBaru=base_url().'asset/images/avatar/noavatar.jpg';
								}
								$namaProduk=produk_info($rItem->produk_id,'nama_produk')
							?>
							<tr>
								<td class="cart_product">
	                                <a href="#"><img src="<?=$urlPhotoBaru;?>" style="max-width: 100%; max-height: 100%; height: 100px;" alt=""></a>
	                            </td>
	                            <td class="cart_description">
	                                <h4><a href="#"><?=$namaProduk;?></a></h4>
	                                <p>Keterangan: <?=$rItem->keterangan;?></p>
	                            </td>
	                            <td class="cart_quantity">
	                                <div class="cart_quantity_button">
	                                    <input class="cart_quantity_input" type="text" name="qty" disabled value="<?=$rItem->qty;?>" autocomplete="off" size="2">
	                                </div>
	                            </td>
	                            <td class="cart_price">
	                                <p>Rp <?=number_format($rItem->harga,0);?></p>
	                            </td>
	                            <td class="cart_total">
	                                <p class="cart_total_price">Rp. <?=number_format($rItem->subtotal,0);?></p>
	                            </td>
							</tr>
							<?php
							}
						}
						?>
					</tbody>
				</table>
				</div>
			<?php
				}
			?>

		</div>
	</section>

<?php $this->load->view('layout/footer.php');?>