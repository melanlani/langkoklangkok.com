<?php $this->load->view('layout/header') ?>

<?php
$berat=0;
$pembelian=$this->cart->contents();

if(!empty($pembelian)){

$tgl_ini=date("Y-m-d");
$this->load->model('produk_model','mod_produk');
?>

<section id="cart_items">
        <div class="container">

            <div class="register-req">
                <p style="color:red;"><b>Dapatkan Ongkir Gratis dengan belanja minimal Rp 90.000 dan kaitkan akun anda <a href="<?=site_url();?>/login">disini</a></b></p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="shopper-info">
                            <p>Shopper Information</p>
                            <?php
                            echo validation_errors();
                            echo form_open(site_url('tamu/selesai'));
                            ?>
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Alamat Email">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" name="notelp" id="notelp" placeholder="No Handphone">
                        </div>
                    </div>
                    <div class="col-sm-5 clearfix">
                        <div class="bill-to">
                            <p>Pengiriman</p>
                            <div class="form-one">
                                <label>Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi">
                                <option value="" disabled selected>--Pilih Provinsi--</option>
                                <?php $this->load->view('member/prov'); ?>
                                </select>
                                <label>Kota</label>
                                <select class="form-control" name="kota" id="kota">
                                <option value="" disabled selected>--Pilih Kota--</option>
                                </select>
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                                <label>Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos" id="kodepos" placeholder="Kode Pos">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="bill-to">
                            <p>Service</p>
                            <label>Kurir</label>
                                <select name="kurir" id="kurir">
                                    <option value="pos">POS</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            <label>Layanan</label>
                            <select name="service" id="layanan">
                                <option value="" disabled selected>--Pilih Layanan--</option>
                            </select>
                            <br>
                            
                        </div>
                    </div>                  
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
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
                        $i=0;   
                        if(!empty($pembelian))
                        {
                            foreach($pembelian as $items)
                            {
                                $i+=1;
                                $id=$items['rowid'];
                                $berat_tmp=field_value('produk','kode_produk',$items['id'],'berat');
                                $produk_id=field_value('produk','kode_produk',$items['id'],'produk_id');
                                $berat+=$berat_tmp;
                                $produkid=$items['produk_id'];
                                $harga2=$items['price'];
                                $harga=produk_info($produkid,'harga');
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
                                <p>Berat: <?=$items['weight'];?> gram</p>
                            </td>
                            <td class="cart_price">
                                <p><?= number_format($items['price'], 0,',','.') ?></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input class="cart_quantity_input" type="text" name="qty" disabled selected value="<?= $items['qty'] ?>" autocomplete="off" size="2">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">Rp. <?= number_format($items['subtotal'], 0,',','.') ?></p>
                            </td>
                            <td class="cart_delete">
                                <a onclick="return confirm('Yakin ingin menghapusnya?');" href="<?=site_url();?>/welcome/hapus/<?=$id;?>" class="cart_quantity_delete" ><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                            <input type="hidden" name="produk[<?=$i;?>][produkid]" value="<?=$produk_id;?>"/>
                            <input type="hidden" name="produk[<?=$i;?>][qty]" value="<?=$items['qty'];?>"/>
                            <input type="hidden" name="produk[<?=$i;?>][harga]" value="<?=$items['price'];?>"/>
                            <input type="hidden" name="produk[<?=$i;?>][userid]" value="<?=$items['userid'];?>"/>
                            <input type="hidden" name="produk[<?=$i;?>][keterangan]" value="<?=$items['keterangan'];?>"/>
                            <input type="hidden" name="produk[<?=$i;?>][subtotal]" value="<?=$items['subtotal'];?>"/>
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
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Ongkos Kirim <span>Rp <input type="number" name="ongkir" value="0" id="ongkir"><br></span></li>
                            <li>Belanja <span>Rp <input type="number" name="belanja" value="<?= $this->cart->total(); ?>" id="belanja"><br></span></li>
                            <li>Total Bayar<span>Rp <input type="number" name="total" value="0" id="bayar"> </span></li>
                        </ul>
                            <button type="submit" name="submit" value="Submit" class="btn btn-default check_out">Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
        <input type="hidden" name="berat" value="<?=$berat;?>"/>
        <?php
        echo form_close();
        ?>

<script type='text/javascript'>

 $(document).ready(function(){

        $('#provinsi').change(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
            var prov = $('#provinsi').val();

            $.ajax({
                type : 'GET',
                url : '<?php echo site_url('order/city'); ?>',
                data :  'prov_id=' + prov,
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#kota").html(data);
                }
            });
        });

        $('#kota').change(function(){
            var kota = $('#kota').val();
            var dest = kota.split(',');
            var kurir = $('#kurir').val()

            $.ajax({
                url: '<?php echo site_url('order/getcost'); ?>',
                method: "POST",
                data: { dest : dest[0], kurir : kurir },
                success: function(obj){
                    $('#layanan').html(obj);
                }
            });
        });

        $('#kurir').change(function(){
            var kota = $('#kota').val();
            var dest = kota.split(',');
            var kurir = $('#kurir').val()

            $.ajax({
                url: '<?php echo site_url('order/getcost'); ?>',
                method: "POST",
                data: { dest : dest[0], kurir : kurir },
                success: function(data){
                    $('#layanan').html(data);
                }
            });
        });

        $('#layanan').change(function(){
            var layanan = $('#layanan').val();

            $.ajax({
                url: '<?php echo site_url('tamu/cost'); ?>',
                method: "POST",
                data: { layanan : layanan },
                success: function(obj){
                    var hasil = obj.split(",");

                    $('#ongkir').val(hasil[0]);
                    $('#belanja').val(hasil[1]);
                    $('#bayar').val(hasil[2]);
                }
            });
        });
 
    });


</script>


<?php
}else{
    redirect(site_url().'/produk/keranjang');
}
?>




<?php $this->load->view('layout/footer')?>