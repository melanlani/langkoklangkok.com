<?php $this->load->view('layout/header') ?>
<?php $this->load->view('layout/sider') ?>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Bumbu Masakan <?=$data_resep['jdl_resep']?></h2>
                        <?php
                
                            if(!empty($bumbu_resep))
                            {
                                    foreach($bumbu_resep as $rKategori)
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
                                        $id=$rKategori->id_paket;
                                        $produk= $this->db->get_where('produk', array('produk_id' => $rKategori->produk_id))->row();  
                                        $urlProdukDetail=site_url().'/produk/detailproduk/'.$produk->produk_id;
                                    ?>   
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?=$urlPhotoKategori;?>" style="height:220px" alt="" />
                                            <h2>Rp <?=number_format($produk->harga,0);?></h2>
                                            <p><?=$produk->nama_produk;?></p>
                                            <a href="<?=$urlProdukDetail;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <a href="<?=$urlProdukDetail;?>"><img src="<?=$urlPhotoKategori;?>" style="height:220px" alt="" /></a>
                                                <h2>Rp <?=number_format($produk->harga,0);?></h2>
                                                <a href="#" ><p><?=$produk->nama_produk;?></p></a>
                                                <a href="<?=$urlProdukDetail;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
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