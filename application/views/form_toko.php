<?php $this->load->view('layout/header') ?>

    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <p style="color:red;"><?php echo validation_errors();?></p>
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
                        <h2>Seller Register</h2>
                        <p style="color:red;"><?php echo validation_errors();?></p>
                        <?php echo form_open('daftar/toko'); ?>
                        <?php if($msg = $this->session->flashdata('response')): ?>
                            <div class="response">
                                <?php echo $msg; ?>
                            </div>
                        <?php endif; ?>
                        <?php 
                            $data = array(
                                'roleid' => '3');
                        ?>
                            <input class="span12" id="fullname" type="text" name="fullname" placeholder="Nama Toko"/>
                            <input type="email" id="email" name="email" placeholder="Email Address"/>
                            <input type="text" id="username" name="username" placeholder="Username"/>
                            <input type="password" id="password" name="password" placeholder="Password"/>
                            <textarea id="alamat" name="alamat" placeholder="Alamat Lengkap" rows="3"/></textarea>
                            <select name="kota" class="form-control select2" required="" style="width: " data-placeholder="Pilih Kota">
                            <option>Pilih Kota</option>
                                <?php
                                $dKota=$this->m_db->get_data('lokasi_kota',array(),'nama_kota ASC');
                                if(!empty($dKota))
                                {
                                    foreach($dKota as $rKota)
                                    {
                                        echo '<option value="'.$rKota->kota_id.'" '.set_select('kota',$rKota->kota_id).'>'.$rKota->nama_kota.'</option>';
                                    }
                                }
                                ?>
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
/*
$(function() {

});
*/
</script>

<?php $this->load->view('layout/footer')?>
		
<script type="text/javascript">
function copy(u,p){
	$('#username').val(u);
	$('#password').val(p);
	return false
}
/*
$(function() {

});
*/
</script>

<?php $this->load->view('layout/footer')?>
