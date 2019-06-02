<?php $this->load->view('layout/header') ?>

    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <?php 
                        if($this->session->flashdata('success')==TRUE): ?>
                        <div class="alert alert-success" role="alert"><center>
                         <?php echo $this->session->flashdata('success'); ?></center>
                        </div><?php endif;?>
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <?php 
                        if($this->session->flashdata('error')==TRUE): ?>
                        <div class="alert alert-danger" role="alert">
                         <?php echo $this->session->flashdata('error'); ?>
                        </div><?php endif;?>
                        <?php echo form_open('login'); ?>
                            <input type="text" name="username" id="username" placeholder="Username" />
                            <input type="password" name="password" id="password" placeholder="Password"/>
                            <span>
                                <input type="checkbox" class="checkbox"> 
                                Keep me signed in
                            </span>
                            <button type="submit" name="login" value="Go" class="btn btn-default">Login</button>
                        <?php echo form_close(); ?>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Customer Register</h2>
                        <p style="color:red;"><?php echo validation_errors();?></p>
                        <?php echo form_open('daftar/pendaftaran'); ?>
                        <?php if($msg = $this->session->flashdata('response')): ?>
                            <div class="response">
                                <?php echo $msg; ?>
                            </div>
                        <?php endif; ?>
                        <?php 
                            $data = array(
                                'roleid' => '2');
                        ?>
                            <input type="text" id="fullname" name="fullname" placeholder="Full Name"/>
                            <input type="email" id="email" name="email" placeholder="Email Address"/>
                            <input type="text" id="username" name="username" placeholder="Username"/>
                            <input type="password" id="password" name="password" placeholder="Password"/>
                            <textarea id="alamat" name="alamat" placeholder="Alamat Lengkap" rows="3"/></textarea><br><br>
                            <select name="provinsi" id="propinsi" onchange="loadKabupaten()" class="form-control select2" required="" style="width: " data-placeholder="Pilih Kota">
                            <option>Pilih Provinsi</option>
                            <?php
                            foreach ($propinsi->result() as $p) {
                                echo "<option value='$p->provinsi_id'>$p->nama_provinsi</option>";
                            }
                            ?>
                            </select><br>
                            <select name="kota" id="kota" class="form-control select2" required="" style="width: " data-placeholder="Pilih Kota">
                            <option>Pilih Kota</option>
                            </select><br>
                            <input type="text" id="notelp" name="notelp" placeholder="No Handphone" />
                            <button type="submit" name="daftar" value="Go" class="btn btn-default">Signup</button>
                        <?php echo form_close(); ?>
                    </div><!--/sign up form-->
                </div>
                <div class="col-sm-2">
                    <center><h2 class="or">
                    <a href="<?=site_url('daftar/toko');?>" title="&larr; Buka Toko">
                        <img src="<?php echo base_url('assets/images/home/toko.png') ?>" style="width:50px;"/>
                    </a>
                    </h2></center>
                </div>
            </div>
        </div>
    </section><!--/form-->

<script type="text/javascript">
function copy(u,p){
    $('#username').val(u);
    $('#password').val(p);
    return false
}

function loadKabupaten()
            {
                var propinsi = $("#propinsi").val();
                $.ajax({
                    type:'GET',
                    url:"<?php echo site_url(); ?>/login/kabupaten",
                    data:"id=" + propinsi,
                    success: function(html)
                    { 
                       $("#kota").html(html);
                    }
                }); 
            }
/*
$(function() {

});
*/
</script>

<?php $this->load->view('layout/footer')?>
