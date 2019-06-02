<?php $this->load->view("admin/admin_header"); ?>

<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                         <?php
                                if(!empty($data))
                                {
                                    foreach($data as $row)
                                    {
                        ?>
                        <div class="col-md-3">
                        	<form id="formphoto">
                              <div class="thumbnail">                        
                                <img alt="" src="<?php echo base_url('asset/admin/images/avatar2.png')?>"/>
                                <!--<span id="tukarphoto" style="margin-top: 5px" class="btn btn-link">Tukar Avatar</span> 
                                <input type="file" name="file" id="file" style="display: none;"/> -->
                              </div>
                            </form>
                        </div>
                        <div class="col-md-9">
                        	<?php
                            echo form_open(site_url().'/profil/profilupdate',array('class'=>'form-horizontal'));
                            ?>
                        	<div class="form-group">
                        		<label class="col-sm-2 control-label" for="nama">Username</label>
                        		<div class="col-md-8">
                        			<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" placeholder="Entri Username" required="" disabled value="<?php echo $this->session->userdata('username') ?>"/>
                        		</div>
                        	</div>	
                        	<div class="form-group">
                        		<label class="col-sm-2 control-label" for="password">Password</label>
                        		<div class="col-md-4">
                        			<input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="Entri jika ingin mengubah password" value="<?=$row->password; ?>"/>
                        		</div>
                        	</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama</label>
                                <div class="col-md-8">
                                    <input type="text" name="fullname" id="fullname" class="form-control" autocomplete="off" placeholder="Entri nama lengkap" required="" value="<?=$row->fullname; ?>"/>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-md-8">
                                    <input type="text" name="email" id="email" class="form-control" autocomplete="off" placeholder="example@contoh.com" required="" value="<?=$row->email; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="nama">Alamat</label>
                                <div class="col-md-8">
                                    <textarea name="alamat" id="alamat" class="form-control" autocomplete="off" placeholder="Entri alamat lengkap" required="" value="<?=$row->alamat; ?>"></textarea> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">No Telp</label>
                                <div class="col-md-8">
                                    <input type="text" name="notelp" id="notelp" class="form-control" autocomplete="off" placeholder="Entri Nomor Handphone/Telp Rumah" required="" value="<?=$row->notelp; ?>"/>
                                </div>
                            </div>-->
                        	<div class="form-group">
                        		<label class="col-sm-2 control-label" for="hp">&nbsp;</label>
                        		<div class="col-md-4">
                        			<button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                        		</div>
                        	</div>
                        	<?php
                            echo form_close();
                            ?>
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


<?php $this->load->view("admin/admin_footer"); ?>