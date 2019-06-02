<?php $this->load->view('layout/header') ?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Spices Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
			            	$dKat=resep_kategori();
			            	if(!empty($dKat))
			            	{
								foreach($dKat as $rKat)
								{
									$slugCat=string_create_slug($rKat->negara);
									$urlcat=site_url().'/resep/kategori/'.$rKat->id_masakan.'/'.$slugCat;
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?=$urlcat;?>"><?=$rKat->negara;?></a></h4>
								</div>
							</div>
							<?php
									}
								}
			            	?>   
						</div>
						
						<div class="shipping text-center"><!--shipping-->
							<img src="<?php echo base_url('assets/images/home/shipping.jpg') ?>" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>

				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<?php
						$dKategoriTerbaru=resep_kategori_data($kategoriid,12);

						if(!empty($dKategoriTerbaru))
						{
							foreach($dKategoriTerbaru as $rKategori)
							{
								$photoKategori=resep_masakan($rKategori->id_resep,1);
								foreach($photoKategori as $rPhotoKategori)
								{								
								}
								$urlPhotoKategori=base_url().'uploadsthumbs/400/'.$rPhotoKategori->foto_resep;
								$pathPhotoKategori=FCPATH.'uploadsthumbs/400/'.$rPhotoKategori->foto_resep;
								if(!file_exists($pathPhotoKategori) && !file_exists($pathPhotoKategori))
								{
									$urlPhotoKategori=base_url().'asset/images/avatar/noavatar.jpg';
								}
								$slugKategori=string_create_slug($rKategori->jdl_resep);
								$urlProdukKategori=site_url().'/resep/detailresep/'.$rKategori->id_resep.'/'.$slugKategori;
						?>
						<div class="single-blog-post">
							<h3><a href="<?=$urlProdukKategori;?>"><?=$rKategori->jdl_resep;?></a></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="">
								<center><img src="<?=$urlPhotoKategori;?>" alt="" style="width: 400px; height: 300px;"></center>
							</a>
							<p><?=$cut=substr($rKategori->resep,0,150); $cut; ?>...</p>
							<a class="btn btn-primary" href="<?=$urlProdukKategori;?>">Read More</a>
						</div>
						<?php
								}
						}
						?>
						<div class="pagination-area">
							<ul class="pagination">
								<li><a href="" class="active">1</a></li>
								<li><a href="">2</a></li>
								<li><a href="">3</a></li>
								<li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php $this->load->view('layout/footer')?>