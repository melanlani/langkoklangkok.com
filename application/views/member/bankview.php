    <section id="cart_items">
        <div class="container">	
        <div class="register-req">
                <p class="lead">Selamat !! invoice anda telah diterbitkan. Silahkan mentransferkan uang dengan total <b><?=$total;?></b> ke salah satu pilihan bank di bawah ini:</p>
            </div><!--/register-req-->
            <br><br><br><br>
			<div class="row">
			<?php
			$dBank=$this->m_db->get_data('bank');
			if(!empty($dBank))
			{
				foreach($dBank as $rBank)
				{
					$logo=base_url().'asset/images/bank/'.$rBank->logo;
				?>	
				<div class="col-xs-6">
					<div class="col-xs-12">
						<div class="col-xs-5">
							<div class="">
								<img src="<?=$logo;?>" class="img-responsive" style="height: 90px;"/>
							</div>
						</div>
						<div class="col-xs-7">
							<strong><?=$rBank->nama_bank;?></strong><br/>
							<strong><?=$rBank->no_rek;?></strong><br/>
							<strong><?=$rBank->pemilik;?></strong>
						</div>
					</div>		
				</div>	
				<?php
				}
			}
			?>
			</div>
			<br><br>
			<div class="register-req">
			<center><p class="lead">
				Setelah mentransferkan dana, silahkan konfirmasi pembayaran <a href="<?=site_url();?>/pembayaran/konfirmasi" style="color:red;"><b>di sini</b></a>
			</p></center>
			</div>
		</div>
	</section>
	<br><br><br><br>