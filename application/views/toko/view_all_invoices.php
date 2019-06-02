<?php $this->load->view('layout/pelapak_header')?>
	<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <h1>Invoices Table</h1>
    <table id="myTable" class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th>Invoice ID</th>
          <th>Date</th>
          <th>Due Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($invoices as $invoice ) : ?>
        <tr>
          <td><?= $invoice->id ?></td>
          <td><?= $invoice->date ?></td>
          <td><?= $invoice->due_date ?></td>
          <td><?= $invoice->status ?></td>
          <td>
            <?=anchor('toko/invoices/detail/'. $invoice->id,'Details', ['class'=>'btn btn-success btn-sm']) ?>
            
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
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
  
    
       
