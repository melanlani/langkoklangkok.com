<?php
  $this->load->view('admin/admin_header.php');
?>
 <!--Tinymce-->
    <script src="<?php echo base_url('tinymce/tinymce.js'); ?>"></script>
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <?php
                    foreach($data as $row){ 
                    }
                    $resepid=$row->id_resep;
                    echo validation_errors();
                    echo form_open_multipart(site_url('resep/edit'),array('class'=>'form-horizontal'));
                    ?>
                        <input type="hidden" name="resepid" value="<?=$row->id_resep;?>"/>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Judul Resep</label>
                            <div class="col-md-10">
                                <input type="text" name="nama" id="" class="form-control " autocomplete="off" placeholder="Nama Produk" required="" value="<?php echo set_value('nama',$row->jdl_resep); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Bahan</label>
                            <div class="col-md-10">
                                <textarea name="bahan" class="form-control" id="isi" required="" placeholder="Isi Bahan"><?=set_value('bahan',$row->bahan);?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Bumbu</label>
                            <div class="col-md-10">
                                <textarea name="bumbu" class="form-control" id="isi" required="" placeholder="Isi Bahan"><?=set_value('bahan',$row->bumbu);?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Resep</label>
                            <div class="col-md-10">
                                <textarea name="resep" class="form-control" id="isi" required="" placeholder="Isi Resep"><?=set_value('resep',$row->resep);?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Kategori</label>
                            <div class="col-md-10">
                                <select name="kategori" id="kategori" class="form-control" required="" style="width: 100%">
                                
                                <option value="<?=$row->id_masakan;?>"><?=field_value('masakan','id_masakan',$row->id_masakan,'negara');?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label" for="">Photo</label>
                        <div class="col-md-10">
                            <div class="row">
                            <?php   
                            for($i=1;$i<=1;$i++)
                            {       
                                $this->load->library('m_db');
                                $photo=base_url().'asset/images/uploadbg.png';
                                $fphoto="resep_".$resepid."-".$i;
                                $sql="Select foto_resep FROM resep_masakan Where id_resep='$resepid' ";
                                $gPhoto=$this->m_db->get_query_row($sql,"foto_resep");
                                $pathfile=FCPATH.'uploads/'.$gPhoto;
                                if(is_file($pathfile))
                                {
                                    $photo=base_url().'uploads/'.$gPhoto;
                                }       
                            ?>
                            <div class="col-xs-3">
                                <a href="javascript:;" class="thumbnail uploadbox" data-id="<?=$i;?>" id="upload_<?=$i;?>">
                                  <img src="<?=$photo;?>" class="gg" id="preview_img_<?=$i;?>" style="width: 128px;height:94px"/>
                                </a>
                            </div>
                            <input type="file" name="upload<?=$i;?>" class="ff" onchange="preview_image(this,'preview_img_<?=$i;?>');" data-id="<?=$i;?>" id="ele_upload_<?=$i;?>" style="display: none;"/>
                            <input type="hidden" name="fupload<?=$i;?>" value="<?=$gPhoto;?>"/>
                            <?php
                            }
                            ?>  
                            </div>          
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary btn-flat">Ubah</button>
                                <a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
                            </div>
                        </div>
                        <?php
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
$(document).ready(function(){

$(".uploadbox").each(function(){
    $(this).click(function(){       
        var did=$(this).attr('data-id');
        $("#ele_upload_"+did).trigger("click");
    });
});


    $("#kategori").select2({       
    placeholder : '---Pilih Kategori---',    
    ajax:{
        url:'<?=site_url("resep/getdata");?>',
        dataType:'json',
        delay:0,
        data:function(){
            return {
            tipe:"masakan",                
            };
        },
        processResults: function (data,params) {
            params.page = params.page || 1;
            return {
                results: $.map(data, function(obj) {
                    return { id: obj.id_masakan, text: obj.negara };
                }),
                pagination: {
                  more: (params.page * 30) < data.total_count
                }
            };
        }
    }
});


});


function preview_image(fileInput,targetID) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {           
        var file = files[i];
                
        var img=document.getElementById(targetID);            
        img.file = file;    
        var reader = new FileReader();
        reader.onload = (function(aImg) { 
            return function(e) { 
                aImg.src = e.target.result; 
            }; 
        })(img);
        reader.readAsDataURL(file);
    }    
}
</script>



<?php $this->load->view("admin/admin_footer"); ?>
    
        
       
