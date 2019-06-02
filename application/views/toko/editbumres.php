<?php
  $this->load->view('admin/admin_header.php');
?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <?php
                    foreach($data as $row){ 
                    }
                    echo form_open_multipart(site_url('resep/editbumres'),array('class'=>'form-horizontal'));
                    ?> 
                    <br><br>

                        <input type="hidden" name="paketid" value="<?=$row->id_paket;?>"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="">List Resep Masakan</label>
                            <div class="col-md-10">
                                <select name="resepbumbu" id="resepbumbu" class="form-control select2" required="" style="width: 50%" data-placeholder="Pilih Resep Masakan">
                                
                               <option value="<?=$row->id_resep;?>"><?=field_value('resep_masakan','id_resep',$row->id_resep,'jdl_resep');?></option>
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-sm-2 control-label" for="">List Produk Bumbu</label>
                            <div class="col-md-10">
                                <select name="bumburesep" id="bumburesep" class="form-control select2" style="width: 50%" data-placeholder="Pilih Produk Bumbu">
                                    
                                    <option value="<?=$row->produk_id;?>"><?=field_value('produk','produk_id',$row->produk_id,'nama_produk');?></option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
                        </div>

                     <?= form_close() ?>
                  
                </div>
              </div>
            </div>
          </div>
      </section>
       <script>
$(document).ready(function(){


    $("#resepbumbu").select2({
    placeholder : '---Pilih Resep---',       
    ajax:{
        url:'<?=site_url("resep/getdata");?>',
        dataType:'json',
        delay:0,
        data:function(){
            return {
            tipe:"resep_masakan",               
            };
        },
        processResults: function (data,params) {
            params.page = params.page || 1;
            return {
                results: $.map(data, function(obj) {
                    return { id: obj.id_resep, text: obj.jdl_resep };
                }),
                pagination: {
                  more: (params.page * 30) < data.total_count
                }
            };
        }
    }
});

    $("#bumburesep").select2({       
    placeholder : '---Pilih Bumbu---',    
    ajax:{
        url:'<?=site_url("resep/getdata");?>',
        dataType:'json',
        delay:0,
        data:function(){
            return {
            tipe:"produk",                
            };
        },
        processResults: function (data,params) {
            params.page = params.page || 1;
            return {
                results: $.map(data, function(obj) {
                    return { id: obj.produk_id, text: obj.nama_produk };
                }),
                pagination: {
                  more: (params.page * 30) < data.total_count
                }
            };
        }
    }
});


});

</script>

<?php $this->load->view("admin/admin_footer"); ?>






    
        
       
