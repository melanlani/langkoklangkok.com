<?php $this->load->view('layout/pelapak_header')?>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
		<h3>Item Ordered in Invoice #<?=$invoice->id ?></h3>
		<table id="myTable" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Product ID</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$total = 0;
				foreach ($orders as $order ) : 
				$subtotal = $order->qty * $order->harga;
				$total+= $subtotal;

			?>
				<tr>
				<td><?=$order->product_id ?></td>
				<td><?=$order->product_name ?></td>
				<td><?=$order->qty ?></td>
				<td><?=$order->harga ?></td>
				<td><?=$subtotal ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" align="right">Total</td>
					<td><?=$total ?></td>
				</tr>
			</tfoot>
		</table>	
		</div>
		<div class="col-md-1"></div>
	</div>
	
		<script >
			$(document).ready(function(){
    		$('#myTable').DataTable();
			});
		</script>
</body>
</html>
	
		
       
