<?php $this->load->view("admin/admin_header"); ?>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
      <!-- Put Content Here -->
          <div class="col-lg-12">
            <div class="box box-solid">
              <div class="box-body">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="<?=base_url();?>assets/images/admin/a.png" alt="First slide">

                      <div class="carousel-caption">
                        First Slide
                      </div>
                    </div>
                    <div class="item">
                      <img src="<?=base_url();?>assets/images/admin/b.png" alt="Second slide">

                      <div class="carousel-caption">
                        Second Slide
                      </div>
                    </div>
                    <div class="item">
                      <img src="<?=base_url();?>assets/images/admin/c.png" alt="Third slide">

                      <div class="carousel-caption">
                        Third Slide
                      </div>
                    </div>
                  </div>
                  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="fa fa-angle-left"></span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="fa fa-angle-right"></span>
                  </a>
                </div>
              </div>
            <!-- /.box-body -->
          </div>
          </div>
          </div><!-- /.row (main row) -->
        </section><!-- /.content -->
<?php $this->load->view("admin/admin_footer"); ?>

  
