<?php $this->load->view('layout/header') ?>
<?php $this->load->view('layout/sider') ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
						$dKategoriTerbaru=produk_kategori_data($kategoriid,12);

						if(!empty($dKategoriTerbaru))
						{
								foreach($dKategoriTerbaru as $rKategori)
								{
									$photoKategori=produk_photo($rKategori->produk_id,1);
									foreach($photoKategori as $rPhotoKategori)
									{								
									}
									$urlPhotoKategori=base_url().'uploadsthumbs/400/'.$rPhotoKategori->photo;
									$pathPhotoKategori=FCPATH.'uploadsthumbs/400/'.$rPhotoKategori->photo;
									if(!file_exists($pathPhotoKategori) && !file_exists($pathPhotoKategori))
									{
										$urlPhotoKategori=base_url().'asset/images/avatar/noavatar.jpg';
									}
									$slugKategori=string_create_slug($rKategori->nama_produk);
									$urlProdukKategori=site_url().'/produk/detailproduk/'.$rKategori->produk_id.'/'.$slugKategori;
								?>   
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?=$urlPhotoKategori;?>" style="height:220px" alt="" />
											<h2>Rp <?=number_format($rKategori->harga,0);?></h2>
											<p><?=$rKategori->nama_produk;?></p>
											<a href="<?=$urlProdukKategori;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<img src="<?=$urlPhotoKategori;?>" style="height:220px" alt="" />
												<h2>Rp <?=number_format($rKategori->harga,0);?></h2>
												<a href="#" ><p><?=$rKategori->nama_produk;?></p></a>
												<a href="<?=$urlProdukKategori;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
											</div>
										</div>	
								</div>
							</div>
						</div>
						<?php
								}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	

<?php $this->load->view('layout/footer')?>