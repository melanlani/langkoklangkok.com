<?php $this->load->view('layout/header') ?>
<?php $this->load->view('layout/slider') ?>
<?php $this->load->view('layout/sider') ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
						if(!empty($dCariTerbaru))
						{
								foreach($dCariTerbaru as $rCari)
								{
									$photoCari=produk_photo($rCari->produk_id,1);
									foreach($photoCari as $rPhotoCari)
									{								
									}
									$urlPhotoCari=base_url().'uploads/'.$rPhotoCari->photo;
									$pathPhotoCari=FCPATH.'uploads/'.$rPhotoCari->photo;
									if(!file_exists($pathPhotoCari) && !file_exists($pathPhotoCari))
									{
										$urlPhotoCari=base_url().'asset/images/avatar/noavatar.jpg';
									}
									$slugCari=string_create_slug($rCari->nama_produk);
									$urlProdukCari=site_url().'/produk/detailproduk/'.$rCari->produk_id.'/'.$slugCari;
								?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?=$urlPhotoCari;?>" style="height:220px" alt="" />
											<h2>Rp. <?=number_format($rCari->harga,0);?></h2>
											<p><?=$rCari->nama_produk;?></p>
											<a href="<?=$urlProdukCari;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<a href="<?=$urlProdukCari;?>"><img src="<?=$urlPhotoCari;?>" style="width: 350px; height:220px" alt="" /></a>
												<h2>Rp. <?=number_format($rCari->harga,0);?></h2>
												<a href="#" ><p><?=$rCari->nama_produk;?></p></a>
												<a href="<?=$urlProdukCari;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
											</div>
										</div>	
								</div>
							</div>
						</div>
						<?php
								}
						}else{
							?>
							Tidak menemukan produk dengan keyword <b><?=$keyword;?></b>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php $this->load->view('layout/footer')?>