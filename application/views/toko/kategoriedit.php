<?php
	$this->load->view('admin/admin_header.php');
?>

	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Form Input</div>
					<div class="panel-body">
					<br>
						<?php
						foreach($data as $row){ 	
						}
						echo form_open(site_url('kategori/edit'));
						?>
						<input type="hidden" name="kategoriid" value="<?=$row->kategori_id;?>" required=""/>
						<div class="form-group row">
									<p class="col-sm-4 form-control-label">Nama Kategori *</p>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="nama" placeholder="Nama Kategori" value="<?=set_value('nama',$row->nama_kategori);?>"/>
									</div>
								</div>	
						<div class="form-group row">
									<div class="col-sm-4">
									</div>
									<div class="col-sm-8">
										<div class="form-inline">
											<button type="submit" class="btn btn-primary btn-flat">Ubah</button>
											<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
										</div>
									</div>	
								</div>
						<?php echo form_close();?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php $this->load->view("admin/admin_footer"); ?>