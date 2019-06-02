<?php $this->load->view('layout/header') ?>

<?php
if($this->session->userdata('roleid') != '2')
{
    redirect('profil');
}
?>

<script>
$(document).ready(function(){
    $("#tukarphoto").click(function(e){
        e.preventDefault();
        $("#file").trigger('click');
    });
    
    $("#file").change(function(){
        var photo=$(this).val();
        if(photo=="")
        {
            return false;
        }else{
            $("#formphoto").trigger('submit');
        }
    });
    
    $("#formphoto").submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: '<?=site_url();?>/profil/uploadphoto',
            type: 'POST',
            dataType:'JSON',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                
            },
            success: function (x) {
              if(x.status=="ok")
              {
                reload_avatar(x.url);
                $("#photo").attr('src',x.url);              
                alert(x.message);
              }else{
                alert(x.message);
              }           
            }
        });               
    });
});
</script>

<section id="cart_items">
    <div class="container">

      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-6">
            <div class="shopper-info">
            <h2>Data Diri</h2>
            <?php 
              if($this->session->flashdata('success')==TRUE): ?>
              <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
              </div><?php endif;?>
            <?php foreach ($data as $row) :
              $prop= $this->db->get_where('lokasi_provinsi', array('provinsi_id' => $row->provinsi))->row();
              $kot= $this->db->get_where('lokasi_kota', array('kota_id' => $row->kota))->row();
            ?>
            <?php
              echo form_open(site_url().'/profil/memberupdate',array('class'=>'form-horizontal'));
            ?>
            <input type="hidden" name="pelangganid" value="<?= $row->pelanggan_id; ?>"/>
            <input name="fullname" class="form_control" id="fullname" type="text" value="<?= $row->nama_pelanggan; ?>"/> 
            <input type="text" class="form_control" name="email" id="email" value="<?=$row->email;?>" />
            <input type="text" class="form_control" name="notelp" id="notelp" value="<?=$row->notelp;?>"/>
            <textarea id="alamat" class="form_control" name="alamat"><?=$row->alamat;?></textarea><br><br>
              <select name="provinsi" id="propinsi" class="form-control select2" onchange="loadKabupaten()" required="" style="width: " data-placeholder="Pilih Kota">
                <option value="<?=$row->provinsi;?>"><?=field_value('lokasi_provinsi','provinsi_id',$row->provinsi,'nama_provinsi');?></option>
                <?php
                $dProv=$this->m_db->get_data('lokasi_provinsi',array(),'nama_provinsi ASC');
                if(!empty($dProv))
                  {
                    foreach ($dProv as $p) 
                    {
                      echo "<option value='$p->provinsi_id'>$p->nama_provinsi</option>";
                    }
                  }
                  ?>
              </select><br>
              <select name="kota" id="kota" class="form-control select2" required="" style="width: " data-placeholder="Pilih Kota">
                <option value="<?=$row->kota;?>"><?=field_value('lokasi_kota','kota_id',$row->kota,'nama_kota');?></option>
              </select><br>
              </select><br>
            </div>
            
              <button type="simpan" class="btn btn-primary btn-flat">Save</button>
                <?php
                echo form_close();
                ?>  
                <br>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
  </section> <!--/#cart_items-->

<script type="text/javascript">

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