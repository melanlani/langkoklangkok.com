</div>
		<div class="footer-laporan text-center">
			<div class="row">
			<div class="col-md-5 pull-left">
					<?php
					$userID=field_value('users','userid',$this->session->userdata('userid'),'fullname');
					?>
					<p>&nbsp;</p>
					<b>Penjual</b>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>(<?=$userID;?>)</p>
				</div>
				<div class="col-md-5 pull-right">
					Padang, <?=date("d-m-Y");?><br/>
					<b>Diketahui oleh</b>
					<br>
					<img src="<?=base_url('asset/images/ttd.jpeg');?>" style="width:120px; height:70px;"><br><br>
					<p>Administrator</p>
				</div>
			</div>
		</div>
	</div>
    
  </body>
</html>