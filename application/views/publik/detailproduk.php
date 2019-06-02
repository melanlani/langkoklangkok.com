<?php $this->load->view('layout/header') ?>
  <style>
  #body{ width:60%;}
p{ margin:0px 0px 20px 0px;}
ul{ margin:0; padding:0; }
li{ cursor:pointer; list-style-type: none; display: inline-block; color: #F0F0F0; text-shadow: 0 0 1px #666666; font-size:20px; }
.highlight, .selected { color:#F4B30A; }

#rating_modal .close{
    font-size: 40px;
    color: #fff;
    opacity: 1;
}

#rating_modal .modal-header{
    background: #d9534f;
    color: #fff;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}   

.star-rating {
    line-height:32px;
    font-size:1.25em;       
}

.star {
    line-height:32px;
    font-size:1.25em;
    cursor: pointer;
}

.star-rating .fa-star{color: #c20001;}
.star .fa-star{color: #c20001;}

</style>
<?php $this->load->view('layout/sider') ?>

        <div class="col-sm-9 padding-right">
          <?php
                  $toko=toko_pusat();
                  $sStok=array(
                  'produk_id'=>$data_produk['produk_id'],
                  'toko_id'=>$toko,
                  );
                  $stok_awal=$this->m_db->get_row('produk_stok',$sStok,'stok');
                  $stok_jual=$this->m_db->get_row('produk_stok',$sStok,'stok_jual');
                  $stok_mutasi=$this->m_db->get_row('produk_stok',$sStok,'stok_mutasi');
                  $stok=$stok_awal-($stok_jual+$stok_mutasi);
                  $produkID=$data_produk['produk_id'];
                  $sql="Select photo FROM produk_photo Where produk_id='$produkID' ";
                  $gPhoto=$this->m_db->get_query_row($sql,"photo");
                                            $pathfile=FCPATH.'uploads/'.$gPhoto;
                                            if(is_file($pathfile))
                                            {
                                                $photo=base_url().'uploads/'.$gPhoto;
                                            }       
                        
                      ?>
          <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
              <div class="view-product">
                <img src="<?= $photo?>" alt="" />
              </div>
            </div>
            <div class="col-sm-7">
              <div class="product-information"><!--/product-information-->
                <h2><?=$data_produk['nama_produk']?></h2>
               <h3 class="modal-title star-rating">Rating <?=$data_produk['rating']?>
               <span class="fa fa-star-o" data-rating="1"></span>
                <span class="fa fa-star-o" data-rating="2"></span>
                <span class="fa fa-star-o" data-rating="3"></span>
                <span class="fa fa-star-o" data-rating="4"></span>
                <span class="fa fa-star-o" data-rating="5"></span><input type="hidden" name="whatever1" class="rating-value" value="<?=$data_produk['rating']?>"></h3>
                <p><?=$data_produk['kode_produk']?></p>
                <p><b>Berat:</b> <?=$data_produk['berat']?> gram</p>
                <p><b>Stok:</b> <?=$stok?> buah</p>
                <p><b>Deskripsi:</b> <?=$data_produk['deskripsi']?></p>
                <img src="images/product-details/rating.png" alt="" />
                <span>
                  <span>Rp.<?=$data_produk['harga']?></span>
                  <?php
                  if($stok > 0)
                  {
                        
                  echo validation_errors();
                  echo form_open(site_url('produk/beli/'.$data_produk['produk_id']),array('class'=>'form-horizontal'));
                  ?>
                  <input type="hidden" name="produkid" value="<?=$data_produk['produk_id'];?>"/>
                  </span><br>
                  
                  <label>Keterangan
                    <textarea name="keterangan" class="form-control" placeholder=""><?=set_value('keterangan');?></textarea>
                  </label><br><br>
                  <label>Jumlah
                  <input type="number" name="qty" id="" class="cart_quantity_input" autocomplete="off" placeholder="Jumlah Beli" required="" value="<?php echo set_value('qty',1); ?>"/></label><br><br><br>
                  <button type="submit" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                  <?php
                  echo form_close();
                  }else{
                    echo "STOK KOSONG";
                  }
                  ?>
              </div><!--/product-information-->
              
            </div>
          </div><!--/product-details-->
          <h1>RATING PRODUK</h1>
          <div id="body">
          <?php if($this->session->userdata('username')) { ?>
                    <?php 
                      foreach ($record->result_array() as $row) {
                      echo "<h5>$row[nama_produk]</h5>
                          <div id='rate-$row[produk_id]'>
                          <input type='hidden' name='rating' id='rating' value='$row[rating]'>
                            <ul onMouseOut=\"resetRating($row[produk_id])\">";
                                for($i=1; $i<=5; $i++) {
                                if($i <= $row["rating"]){ $selected = "selected"; }else{ $selected = ""; }
                                  echo "<li class='$selected' onmouseover=\"highlightStar(this,$row[produk_id])\" onmouseout=\"removeHighlight($row[produk_id]);\" onClick=\"addRating(this,$row[produk_id])\">★</li>"; 
                                }
                            echo "<ul>
                          </div>";
                    }
                    ?>
              <?php } else { ?>
                    rating
              <?php } ?>
              </div>

          <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#reviews" data-toggle="tab">Details</a></li>
              </ul>
            </div>
            <div class="tab-content">
              
              <div class="tab-pane fade active in" id="reviews" >
                <div class="col-sm-12">
                  <p><?=$data_produk['deskripsi']?></p>

                  <?php if($this->session->userdata('username')) { 
                              
                      echo validation_errors();
                      echo form_open(site_url('produk/add_komentar/'.$data_produk['produk_id']),array('class'=>'form-horizontal'));
                    ?>
                    <span>
                      <input type="hidden" name="produkid" value="<?=$data_produk['produk_id'];?>"/>
                      <input type="hidden" name="userid" value="<?=$this->session->userdata('userid');?>"/>
                      <input type="text" disabled placeholder="<?=$this->session->userdata('username');?>"/>
                      <input type="text" disabled placeholder=""/>
                    </span>
                    <textarea name="comment" rows="11"></textarea>
                    <button type="submit" class="btn btn-default pull-right">
                      Submit
                    </button>
                  <?php
                        echo form_close();
                      }
                    ?>
                </div>
                      
            </div>
          </div><!--/category-tab-->
          
        </div>
      </div>
    </div>
  </section>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

  <script>
  // saat mengarahkan kursor ke bintang maka bintang akan kuning
  function highlightStar(obj,id) {
    removeHighlight(id);    
    $('#rate-'+id+' li').each(function(index) {
      $(this).addClass('highlight');
      if(index == $('#rate-'+id+' li').index(obj)) {
        return false; 
      }
    });
  }
 
  // saat mengarahkan kursor ke bintang maka bintang akan transparant
  function removeHighlight(id) {
    $('#rate-'+id+' li').removeClass('selected');
    $('#rate-'+id+' li').removeClass('highlight');
  }
 
  // Aksi untuk proses rating ke database di saat bintang diklik
  function addRating(obj,id) {
    $('#rate-'+id+' li').each(function(index) {
      $(this).addClass('selected');
      $('#rate-'+id+' #rating').val((index+1));
      if(index == $('#rate-'+id+' li').index(obj)) {
        return false; 
      }
    });
    $.ajax({
    url: "<?php echo site_url('produk/tambah_rating'); ?>",
    data:'id='+id+'&rating='+$('#rate-'+id+' #rating').val(),
    type: "POST"
    });
  }
 
  // Ketika Kursor meninggalkan bintang maka kembali kepada keaadan awal
  function resetRating(id) {
    if($('#rate-'+id+' #rating').val() != 0) {
      $('#rate-'+id+' li').each(function(index) {
        $(this).addClass('selected');
        if((index+1) == $('#rate-'+id+' #rating').val()) {
          return false; 
        }
      });
    }
  } 
</script>

<?php $this->load->view('layout/footer')?>