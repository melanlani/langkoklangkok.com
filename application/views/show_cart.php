<?php $this->load->view('layout/header') ?>

<section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="<?=base_url(); ?>">Home</a></li>
                  <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Product</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $pembelian=$this->cart->contents();
                            $i=0;   
                            if(!empty($pembelian))
                            {
                                foreach($pembelian as $items)
                                {
                                    $i+=1;
                                    $id=$items['rowid'];
                        ?>
                        <tr>
                            <?php
                                $produkID= $items['produk_id'];
                                $sql="Select photo FROM produk_photo Where produk_id='$produkID' ";
                                $gPhoto=$this->m_db->get_query_row($sql,"photo");
                                $pathfile=FCPATH.'uploads/'.$gPhoto;
                                if(is_file($pathfile))
                                {
                                    $photo=base_url().'uploads/'.$gPhoto;
                                }       
                                                                
                            ?>
                            <td class="cart_product">
                                <a href="#"><img src="<?=$photo;?>" style="max-width: 100%; max-height: 100%; height: 100px;" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="#"><?= $items['name'] ?></a></h4>
                                <p>Keterangan: <?=$items['keterangan'];?></p>
                            </td>
                            <td class="cart_price">
                                <p><?= number_format($items['price'], 0,',','.') ?></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input class="cart_quantity_input" type="text" name="qty" disabled value="<?= $items['qty'] ?>" autocomplete="off" size="2">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">Rp. <?= number_format($items['subtotal'], 0,',','.') ?></p>
                            </td>
                            <td class="cart_delete">
                                <a onclick="return confirm('Yakin ingin menghapusnya?');" href="<?=site_url();?>/welcome/hapus/<?=$id;?>" class="cart_quantity_delete" ><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                            <?php
                            }
                                }
                                else{
                            ?>
                            <center><div class="alert alert-warning">Keranjang Belanja Anda Kosong</div></center>
                            <?php
                                    }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>Apakah ingin melanjutkan belanja?</h3>
                <p>Silahkan tekan tombol checkout pada form dibawah ini.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>Rp. <?= number_format($this->cart->total(), 0,',','.'); ?></span></li>
                        </ul>
                            <a class="btn btn-default check_out" href="<?=site_url();?>/order/selesai">Check Out</a>
                    </div>
                </div>
                
            </div>
        </div>
    </section><!--/#do_action-->


<?php $this->load->view('layout/footer')?>