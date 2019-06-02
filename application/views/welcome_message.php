<?php $this->load->view('layout/header') ?>
<?php $this->load->view('layout/slider') ?>
<?php $this->load->view('layout/sider') ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php foreach($products as $product) : 
							$urlProdukDetail=site_url().'/produk/detailproduk/'.$product->produk_id;
						?> 
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<?php

											$produkID=$product->produk_id;
											$sql="Select photo FROM produk_photo Where produk_id='$produkID' ";
											$gPhoto=$this->m_db->get_query_row($sql,"photo");
								                                $pathfile=FCPATH.'uploads/'.$gPhoto;
								                                if(is_file($pathfile))
								                                {
								                                    $photo=base_url().'uploads/'.$gPhoto;
								                                }       
												
											?>
											<img src="<?=$photo;?>" style="height:220px" alt="" />
											<h2>Rp. <?php echo $product->harga; ?></h2>
											<p><?php echo $product->nama_produk; ?></p>
											<a href="<?=$urlProdukDetail;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<a href="<?=$urlProdukDetail;?>"><img src="<?=$photo;?>" style="width: 350px; height:220px" alt="" /></a>
												<h2>Rp. <?php echo $product->harga; ?></h2>
												<a href="#" ><p><?php echo $product->nama_produk; ?></p></a>
												<a href="<?=$urlProdukDetail;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
											</div>
										</div>	
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
		
<?php $this->load->view('layout/footer')?>