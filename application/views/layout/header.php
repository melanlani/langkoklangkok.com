<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/home/spices.png'); ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Website Belanja Bumbu Dapur | MPU</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/prettyPhoto.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/price-range.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css') ?>">
    
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/js/jQuery-3.1.0.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>

</head><!--/head-->

<body>

<header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +62 812 61 892 128</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> melanlani96@yahoo.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <h6 style="color:green;">Hai, Selamat datang <?=$this->session->userdata('username') ?> <i class="fa fa-smile-o" aria-hidden="true"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="<?php echo base_url() ?>" title="&larr; Back home">
                                <img src="<?php echo base_url('assets/images/home/logoo.png') ?>" style="height:100px;" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                
                                <?php if($this->session->userdata('username')) { ?>
                                <li><?php echo anchor('profil/member','Account '. ' <i class="fa fa-user">'.'</i>'); ?></li>
                                <li><?php echo anchor('pembayaran/konfirmasi','Konfirmasi Pembayaran '. ' <i class="fa fa-crosshairs">'.'</i>'); ?></li>
                                <li><?php echo anchor('akun/histori','Histori Belanja '. ' <i class="fa fa-list-alt">'.'</i>'); ?></li>
                                <li><?php echo anchor('login/logout','Logout '. ' <i class="fa fa-lock">'.'</i>'); ?></li>
                                <?php } else { ?>
                                <li><?php echo anchor('login','Login/Register '. ' <i class="fa fa-lock">'.'</i>'); ?></li>
                                <li><?php echo anchor('tamu/konfirmasi','Konfirmasi Pembayaran '. ' <i class="fa fa-crosshairs">'.'</i>'); ?></li>
                                <?php } ?>
                                <li><a href="<?= site_url('welcome/cart') ?>" title="Go to cart &rarr;">
                                    <img src="<?php echo base_url('assets/images/home/cart.png') ?>" /><span><?php echo $this->cart->total_items(); ?></span>
                                </a></li>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="#"></a></li>
                                <li><?php echo anchor(base_url(), 'Home', array('title' => 'Home', 'class'=>'active')); ?></li> 
                                <li class="dropdown"><a href="#">Kategori<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <?php
                                        $dKat=produk_kategori();
                                        if(!empty($dKat))
                                        {
                                            foreach($dKat as $rKat)
                                            {
                                                $slugCat=string_create_slug($rKat->nama_kategori);
                                                $urlcat=site_url().'/produk/kategori/'.$rKat->kategori_id.'/'.$slugCat;
                                        ?>

                                        <li>
                                        <a href="<?=$urlcat;?>"><?=$rKat->nama_kategori;?></a>
                                        <?php
                                            }
                                        }
                                        ?>    
                                        </li> 
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Resep Masakan<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <?php
                                        $dKat=resep_kategori();
                                        if(!empty($dKat))
                                        {
                                            foreach($dKat as $rKat)
                                            {
                                                $slugCat=string_create_slug($rKat->negara);
                                                $urlcat=site_url().'/resep/kategori/'.$rKat->id_masakan.'/'.$slugCat;
                                            ?>
                                        <li>
                                        <a href="<?=$urlcat;?>"><?=$rKat->negara;?></a>
                                        <?php
                                            }
                                        }
                                        ?>  
                                        </li> 
                                    </ul>
                                </li> 
                                <?php if($this->session->userdata('roleid') != '3') { ?>
                                <li><?php echo anchor('pembayaran/cektagihan', 'Cek Pesanan'); ?></li>
                                <?php  ?>
                                <?php }else {?>
                                <li><?php echo anchor('administrator', 'Toko'); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="<?=site_url();?>/produk/cari" method="get">
                                    <input type="text" name="cari" class="form-control input-search" placeholder="Cari produk apapun"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

