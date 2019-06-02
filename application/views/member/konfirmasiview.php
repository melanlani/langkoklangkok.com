<?php $this->load->view('layout/header') ?>

<section id="cart_items">
		<div class="container">

			<div class="register-req">
				<p>Silahkan masukkan No Invoice anda dan upload bukti pembayaran pada form upload</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-6">
						<div class="shopper-info">
							<h3>Konfirmasi Pembayaran</h3>
							<?php
							echo validation_errors();
							echo form_open_multipart(site_url('pembayaran/konfirmasi'),array('class'=>'form-horizontal'));
							?>
								<input type="text" id="invoice" name="invoice" placeholder="Nomor Invoice" required="">
								<span>
									<button class="btn btn-default" type="button" onclick="getinvoice();"><i class="fa fa-plus"></i></button>
								</span>
								<p class="form-control" id="total">Rp 0</p>
									<input type="hidden" name="total" id="htotal"/>
								<select name="bankid" class="form-control" required="">
									<?php
									$dBank=$this->m_db->get_data('bank');
									if(!empty($dBank))
									{
										foreach($dBank as $rBank)
										{
											$nama=$rBank->nama_bank;
											$pemilik=$rBank->pemilik;
											$norek=$rBank->no_rek;
											$lbl=$nama."-".$norek." (".$pemilik.")";
											echo '<option value="'.$rBank->bank_id.'">'.$lbl.'</option>';
										}
									}
									?>
									</select><br>

								<input type="text" name="pemilik" id="pemilik" autocomplete="off" placeholder="Nama Pengirim Dana" required="" value="<?php echo set_value('pemilik'); ?>"/>
								<input type="text" name="tanggal" id="" autocomplete="off" placeholder="Tanggal Transfer" required="" value="<?php echo set_value('tanggal',date("Y-m-d")); ?>"/>
								<input type="file" name="bukti" id="" class="form-control " autocomplete="off" placeholder="Upload Bukti Transfer"/><br/>
									<small class="text-info" style="color:red;">Untuk konfirmasi di atas jam kerja, harap upload bukti pembayaran. Format file PDF,JPG,BMP,PNG</small>
								<button type="submit" class="btn btn-primary btn-flat">Konfirmasi</button>
								<?php
								echo form_close();
								?>	
								<br>
						</div>
					</div>
				</div>
	</section> <!--/#cart_items-->

<script type='text/javascript'>

 $(document).ready(function(){


});

function getinvoice()
{
	var iv=$("#invoice").val();
	if(iv=="")
	{
		return;
	}
	$.ajax({
	  method: "get",
	  dataType:"json",
	  url: "<?=site_url();?>/pembayaran/getinvoice",
	  data: "invoice="+iv,
	  beforeSend:function(){
	  	$("form input").attr("disabled","disabled");
	  	$("form button").attr("disabled","disabled");
	  	$("#htotal").val(0);
	  	$("#total").html("Rp 0");
		$("#pemilik").val("");
	  }
	})
	.done(function( x ) {
	    if(x.status=="ok")
	    {
			$("#total").html(x.total);
			$("#pemilik").val(x.nama);
			$("#htotal").val(x.total2);
		}else{
			$("#total").html("Rp 0");
			$("#pemilik").val("");
			$("#htotal").val(0);
		}
		$("form input").removeAttr("disabled");
	  	$("form button").removeAttr("disabled");
	})
	.fail(function(  ) {
		$("form input").removeAttr("disabled");
	  	$("form button").removeAttr("disabled");
	  	$("#htotal").val(0);
	  	$("#total").html("Rp 0");
		$("#pemilik").val("");
	});
}
</script>

<?php $this->load->view('layout/footer')?>