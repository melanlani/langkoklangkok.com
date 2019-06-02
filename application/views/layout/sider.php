	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Spices Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
				            	$dKat=produk_kategori();
				            	if(!empty($dKat))
				            	{
									foreach($dKat as $rKat)
									{
										$slugCat=string_create_slug($rKat->nama_kategori);
										$urlcat=site_url().'/produk/kategori/'.$rKat->kategori_id.'/'.$slugCat;
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?=$urlcat;?>"><?=$rKat->nama_kategori;?></a></h4>
								</div>
							</div>
							<?php
									}
								}
			            	?>   
						</div>
						
						<div class="shipping text-center"><!--shipping-->
							<img src="<?php echo base_url('assets/images/home/rule.jpg') ?>" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>