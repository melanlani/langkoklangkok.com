<?php
  $this->load->view('admin/admin_header.php');
?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <?php
                    echo form_open_multipart('resep/add',array('class'=>'form-horizontal','id' =>'form'));
                    ?>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Judul Resep</label>
                            <div class="col-md-10">
                                <input type="text" name="nama" id="" class="form-control " autocomplete="off" placeholder="Judul Resep" required="" value="<?php echo set_value('nama'); ?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Bahan</label>
                            <div class="col-md-10">
                                <textarea name="bahan" class="form-control" id="isi" required="" placeholder="Isi Halaman"><?=set_value('bahan');?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Bumbu</label>
                            <div class="col-md-10">
                                <textarea name="bumbu" class="form-control" id="isi" required="" placeholder="Isi Halaman"><?=set_value('bumbu');?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Resep</label>
                            <div class="col-md-10">
                                <textarea name="resep" class="form-control" id="isi" required="" placeholder="Isi Halaman"><?=set_value('resep');?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">Kategori</label>
                            <div class="col-md-10">
                                <select name="kategori" id="kategori" class="form-control" required="" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label" for="">Photo</label>
                        <div class="col-md-10">
                            <div class="row">
                            <?php   
                            for($i=1;$i<=4;$i++)
                            {       
                                $photo=base_url().'asset/images/uploadbg.png';     
                            ?>
                            <div class="col-xs-3">
                                <a href="javascript:;" class="thumbnail uploadbox" data-id="<?=$i;?>" id="upload_<?=$i;?>">
                                   <img src="<?=$photo;?>" class="gg" id="preview_img_<?=$i;?>" style="width: 180px;height:70px"/>
                                </a>
                            </div>
                            <input type="file" name="upload<?=$i;?>" class="ff" onchange="preview_image(this,'preview_img_<?=$i;?>');" data-id="<?=$i;?>" id="ele_upload_<?=$i;?>" style="display: none;"/>
                            <?php
                            }
                            ?>  
                            </div>          
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">Save</button>
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
        </div>
    </section>

  <script>
        $(".uploadbox").each(function(){
        $(this).click(function(){       
            var did=$(this).attr('data-id');
            $("#ele_upload_"+did).trigger("click");
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

        $("#kategori").select2({ 
    placeholder : '---Pilih Kategori Resep---',       
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

    </script>



<?php $this->load->view("admin/admin_footer"); ?>
    
        
       
