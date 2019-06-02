<?php
	$this->load->view('admin/admin_header.php');
?>

	<!-- Content Header (Page header) -->	
	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Form Input</div>
					<div class="panel-body">
						<br>
							<form id="idform" action="<?php echo site_url('kategori/add'); ?>" method="post">	
								<div class="form-group row">
									<p class="col-sm-4 form-control-label">Nama Kategori *</p>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="nama" placeholder="Nama Kategori" value="<?=set_value('nama');?>"/>
									</div>
								</div>								
					
								<div class="form-group row">
									<div class="col-sm-4">
									</div>
									<div class="col-sm-8">
										<div class="form-inline">
											<button type="reset" class="btn btn-success">Reset</button>
											<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
											<!--<a href="#" class="btn btn-primary">Cetak Kartu</a>-->
										</div>
									</div>	
								</div>
							<?php echo form_close();?>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-info">
					<div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Daftar Kategori Produk</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Nama Kategori</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(!empty($data))
									{
										foreach($data as $row)
										{
											$id=$row->kategori_id;
										?>
										<tr>
											<td><?=$row->nama_kategori;?></td>
											<td>
												<center><a href="<?=site_url('kategori/edit').'?id='.$id;?>"><i class="fa fa-edit fa-fw"></i></a></center>
											</td>
											<td>
												<center><a onclick="return confirm('Yakin ingin menghapus Kategori ini?');" href="<?=site_url('kategori/delete').'?id='.$id;?>" ><i class="fa fa-trash fa-fw"></i></a></center>
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
        $('#myTable').DataTable();
      });

</script>

<?php $this->load->view("admin/admin_footer"); ?>