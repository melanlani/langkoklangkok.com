<?php
  $this->load->view('admin/admin_header.php');
?>
	<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="row"><br>
                    <div class="col-md-12">
					<div class="panel panel-default">
					  <!--<div class="panel-heading">Penjualan Periode</div>
					  <div class="panel-body">
					  	  <?php
						echo validation_errors();
						echo form_open(site_url('report/periode'),array('class'=>'form-horizontal','target'=>'_blank'));
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Dari</label>
							<div class="col-md-6">
								<input type="text" name="t1" id="tgl" class="form-control" autocomplete="off" placeholder="Dari Tanggal" required="" value="<?php echo set_value('t1',date('Y-m-d')); ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Hingga</label>
							<div class="col-md-6">
								<input type="text" name="t2" id="tgl1" class="form-control" autocomplete="off" placeholder="Hingga Tanggal" required="" value="<?php echo set_value('t2',date('Y-m-d')); ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">&nbsp;</label>
							<div class="col-md-9">
								<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
							</div>
						</div>
						<?php
						echo form_close();
						?>
						  </div>
						</div>
						</div>-->

					  <div class="form-group">
							<label class="col-sm-12 control-label">&nbsp;</label>
							<div class="col-md-9">
								<a href="<?php site_url(); ?>report/semua" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Tampilkan</a><br><br>
							</div>
						</div>

					  <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>     
                                <th>INVOICE</th>
								<th>Tanggal</th>
								<th>Nama Pembeli</th>
								<th>Item</th>
								<th>Total Jual</th>
								<th></th>
                                </tr>
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
										<td><?=$row->invoice;?></td>
										<td><?=date("d-m-Y",strtotime($row->tanggal));?></td>
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
													echo '<li>'.$nama_produk.' <b>'.$rOrder->qty.' item</b> <br/> Rp '.number_format($rOrder->harga,0).'</li>';
												}
											}
								?>
                                    	</td>
                                    	<?php $total = $row->harga * $row->qty; ?>
										<td>Rp <?=number_format($total,0);?></td>
										<td>
											<?php
											if($row->status=="kirim"){
												?>
												dan dikirim ke tujuan
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
			<div class="row">

					<div class="col-md-4">
					<div class="panel panel-default">
					  <div class="panel-heading">Penjualan Bulanan</div>
					  <div class="panel-body">
					    <?php
						echo validation_errors();
						echo form_open(site_url('report/bulanan'),array('class'=>'form-horizontal','target'=>'_blank'));
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Bulan</label>
							<div class="col-md-9">
								<?=com_select_bulan('bulan',1,array('class'=>'form-control select2'));?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Tahun</label>
							<div class="col-md-6">
								<input type="text" name="tahun" id="" class="form-control tanggal" autocomplete="off" placeholder="Tahun" required="" value="<?php echo set_value('tahun',date('Y')); ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">&nbsp;</label>
							<div class="col-md-9">
								<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
							</div>
						</div>
						<?php
						echo form_close();
						?>
					  </div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="panel panel-default">
					  <div class="panel-heading">Penjualan Tahunan</div>
					  <div class="panel-body">
					    <?php
						echo validation_errors();
						echo form_open(site_url('report/tahunan'),array('class'=>'form-horizontal','target'=>'_blank'));
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Tahun</label>
							<div class="col-md-6">
								<input type="text" name="tahun" id="" class="form-control tanggal" autocomplete="off" placeholder="Tahun" required="" value="<?php echo set_value('tahun',date('Y')); ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">&nbsp;</label>
							<div class="col-md-9">
								<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
							</div>
						</div>
						<?php
						echo form_close();
						?>
					  </div>
					</div>
				</div>
				<!--<div class="col-md-6">
					<div class="panel panel-default">
					  <div class="panel-heading">Per Produk</div>
					  <div class="panel-body">
					    <?php
						echo validation_errors();
						echo form_open(site_url('report/produk'),array('class'=>'form-horizontal','target'=>'_blank'));
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Produk</label>
							<div class="col-md-9">
								<select name="produk" class="form-control select2" required="" style="width: 100%" data-placeholder="Pilih Produk">
								<option></option>
								<?php
								if(!empty($products))
								{
									foreach($products as $rProduk)
									{
										echo '<option value="'.$rProduk->produk_id.'">'.$rProduk->nama_produk.'</option>';
									}
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Dari</label>
							<div class="col-md-6">
								<input type="text" name="t1" id="tgl2" class="form-control" autocomplete="off" placeholder="Dari Tanggal" required="" value="<?php echo set_value('t1',date('Y-m-d')); ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="">Hingga</label>
							<div class="col-md-6">
								<input type="text" name="t2" id="tgl3" class="form-control" autocomplete="off" placeholder="Hingga Tanggal" required="" value="<?php echo set_value('t2',date('Y-m-d')); ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">&nbsp;</label>
							<div class="col-md-9">
								<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Tampilkan</button>
							</div>
						</div>
						<?php
						echo form_close();
						?>
					  </div>
					</div>
				</div>-->
				</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
	$('#tgl').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    }); 
    $('#tgl1').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    }); 
    $('#tgl2').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    }); 
    $('#tgl3').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    }); 
    </script>


<?php $this->load->view("admin/admin_footer"); ?>