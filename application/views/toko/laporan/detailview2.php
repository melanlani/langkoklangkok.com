<table class="table table-bordered table-stripped">
<thead>
	<th>Tanggal</th>
	<th>Invoice</th>
	<th>Nama Pembeli</th>
	<th>Item</th>
	<th>Total Jual</th>
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
		<td><?=$row->tanggal;?></td>
		<td><?=$row->invoice;?></td>
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
				echo $nama_produk.' <b>'.$rOrder->qty.' item</b> <br/> Rp '.number_format($rOrder->harga,0);
			}
			}
			?>
        </td>
        <?php $total = $row->harga * $row->qty; ?>
		<td>Rp <?=number_format($total,0);?></td>
	</tr>
	<?php
	}
	}
?>
</tbody>
<tfoot>
	<!-- <tr>
		<td colspan="4" align="center"><b>Total</b></td>
		<td>	
<?php

	if(!empty($data))
	{		foreach($data as $row)
	{	
				$grandtotal = 0;
				$grandtotal+= $row->belanja;
								
	?>
			
			Rp <?=number_format($grandtotal,0);?>
		
		</td>
	</tr>
	<?php
	}
	}
?>-->
</tfoot>
</table>