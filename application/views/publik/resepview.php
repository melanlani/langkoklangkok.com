<?php $this->load->view('layout/header') ?>
<?php $this->load->view('layout/sider') ?>


<div class="col-sm-9">
          <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            <div class="single-blog-post">
              <h3><?=$data_resep['jdl_resep']?></h3>
              <div class="post-meta">
                <ul>
                  <li><i class="fa fa-user"></i> Admin</li>
                </ul>
                <span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </span>
              </div>
              <?php $urlPhotoKategori=base_url().'uploadsthumbs/400/'.$data_resep['foto_resep']; ?>
              <a href="#">
                <center><img src="<?= $urlPhotoKategori?>" alt="" style="width: 500px; height: 300px;"></center>
              </a>
              <strong style="color:#009931;">Bahan</strong>
              <p><?=$data_resep['bahan']?></p>
              <?php
                        
                        $slugKategori=string_create_slug($data_resep['jdl_resep']);
                        $urlProdukKategori=site_url().'/resep/bumburesep/'.$data_resep['id_resep'].'/'.$slugKategori;
                      ?>  
              <strong style="color:#009931;">Bumbu </strong><br>
              <a class="btn btn-primary" href="<?=$urlProdukKategori;?>"><i class="fa fa-shopping-cart"></i>Beli</a>
              <p><?=$data_resep['bumbu']?></p>
              <strong style="color:#009931;">Cara Memasak</strong>
              <p><?=$data_resep['resep']?></p>
              <div class="pager-area">
                <ul class="pager pull-right">
                  <li><a href="#">Pre</a></li>
                  <li><a href="#">Next</a></li>
                </ul>
              </div>
            </div>
          </div><!--/blog-post-area-->

          <div class="rating-area">
            <ul class="ratings">
              <li class="rate-this">Rate this item:</li>
              <li>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </li>
              <li class="color">(6 votes)</li>
            </ul>
          </div><!--/rating-area-->

          <div class="socials-share">
            <a href=""><img src="<?php echo base_url('assets/images/blog/socials.png') ?>" alt=""></a>
          </div><!--/socials-share-->
          <div class="response-area">
            <h2>3 RESPONSES</h2>
            <ul class="media-list">
              <li class="media">
                
                <a class="pull-left" href="#">
                  <img class="media-object" src="<?php echo base_url('assets/images/blog/man-two.jpg') ?>" alt="">
                </a>
                <div class="media-body">
                  <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                </div>
              </li>
              <li class="media second-media">
                <a class="pull-left" href="#">
                  <img class="media-object" src="<?php echo base_url('assets/images/blog/man-three.jpg') ?>" alt="">
                </a>
                <div class="media-body">
                  <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                </div>
              </li>
            </ul>         
          </div><!--/Response-area-->
          <div class="replay-box">
            <div class="row">
              <div class="col-sm-4">
                <h2>Leave a replay</h2>
                <form>
                  <div class="blank-arrow">
                    <label>Your Name</label>
                  </div>
                  <span>*</span>
                  <input type="text" placeholder="write your name...">
                  <div class="blank-arrow">
                    <label>Email Address</label>
                  </div>
                  <span>*</span>
                  <input type="email" placeholder="your email address...">
                  <div class="blank-arrow">
                    <label>Web Site</label>
                  </div>
                  <input type="email" placeholder="current city...">
                </form>
              </div>
              <div class="col-sm-8">
                <div class="text-area">
                  <div class="blank-arrow">
                    <label>Your Name</label>
                  </div>
                  <span>*</span>
                  <textarea name="message" rows="11"></textarea>
                  <a class="btn btn-primary" href="">post comment</a>
                </div>
              </div>
            </div>
          </div><!--/Repaly Box-->
        </div>  
      </div>
    </div>
  </section>

<?php $this->load->view('layout/footer')?>