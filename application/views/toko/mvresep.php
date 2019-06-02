<?php
  $this->load->view('admin/admin_header.php');
?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <div class="panel panel-info">
                        <div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Daftar Semua Resep</div>
                        <div class="panel-body">

                        <button class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> Add Resep</button>
                        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                        <br><br>
                          
                        <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>     
                                <th>Judul Resep</th>
                                <th>Bahan</th>
                                <th>Resep</th>
                                <th>Kategori</th>
                                <th>Foto</th>
                                <th>Bumbu</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($recipes))
                                {
                                    foreach($recipes as $row)
                                    {
                                        $id=$row->id_resep;
                                        $nama=$row->jdl_resep;
                                        $bahan=$row->bahan;
                                        $bumbu=$row->bumbu;
                                        $resep=$row->resep;

                                        $foto=$row->foto_resep;
                                        $kategori= $this->db->get_where('masakan', array('id_masakan' => $row->id_masakan))->row();
                                    ?>
                                    <tr>                
                                        <td><?=$nama;?></td>
                                        <td><?=$bahan;?></td> 
                                        <td><?=$resep;?></td>                
                                        <td>Kategori <?=$kategori->negara;?></td>               
                                        <td><?php
                                          $resep_image = ['src' => 'uploads/' . $foto,
                                                  'height' => '50'];
                                          echo img($resep_image) 
                                          ?>
                                        </td>              
                                        <td><?=$bumbu;?></td>
                                        <td>
                                            <center><a href="<?=site_url('resep/edit').'?id='.$id;?>"><i class="fa fa-edit fa-fw"></i></a></center>
                                        </td>
                                        <td>
                                            <center><a onclick="return confirm('Yakin ingin menghapus resep ini?');" href="<?=site_url('resep/delete').'?id='.$id;?>"><i class="fa fa-trash fa-fw"></i></a></center>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
              </div>
          </div>
      </div>
  </section>
 <script >
      $(document).ready(function(){
        $('#myTable').DataTable();
      });

      var save_method;
      var table;

      function add_product(){
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        }

      function reload_table(){
        table.ajax.reload(null,false); //reload datatable ajax 
        }

    

    </script>


<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-success">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Resep</h3>
            </div>
          <div class="modal-body form">
          <?= form_open_multipart('resep/add', ['id' =>'form']) ?>
            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label" >Judul Resep</p>
                <div class="col-sm-6">
                <input type="text" name="nama" id="" class="form-control " autocomplete="off" placeholder="Judul Resep" required="" value="<?php echo set_value('nama'); ?>"/>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Bahan</p>
                <div class="col-sm-6">
                <textarea name="bahan" class="form-control" id="isi" required="" placeholder="Isi Halaman"><?=set_value('bahan');?></textarea>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Bumbu</p>
                <div class="col-sm-6">
                <textarea name="bumbu" class="form-control" id="isi" required="" placeholder="Isi Halaman"><?=set_value('bumbu');?></textarea>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Resep</p>
                <div class="col-sm-6">
                <textarea name="resep" class="form-control" id="isi" required="" placeholder="Isi Halaman"><?=set_value('resep');?></textarea>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Kategori</p>
                <div class="col-sm-6">
                <select name="kategori" id="kategori" class="form-control" required="" style="width: 100%">
                </select>
                <!-- <a href="<?=base_url('resep/kategori');?>" class="btn btn-link" target="_blank" style="color:black;">+ Tambah Kategori</a> -->
                <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Photo</p>
                <div class="col-sm-6">
                    <?php   
                    for($i=1;$i<=1;$i++)
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

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        <?= form_close() ?>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>

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
    
        
       
