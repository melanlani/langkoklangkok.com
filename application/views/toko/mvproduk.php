<?php
  $this->load->view('admin/admin_header.php');
?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <div class="panel panel-info">
                        <div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Daftar Semua Produk</div>
                        <div class="panel-body">

                        <button class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> Add Produk</button>
                        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                        <br><br>
                          
                        <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>     
                                <th>Nama Produk</th>
                                <th>Supplier</th>
                                <th>Metadata</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($products))
                                {
                                    foreach($products as $row)
                                    {
                                        $id=$row->produk_id;
                                        $nama=$row->kode_produk."-".$row->nama_produk;
                                        $supplier= $this->db->get_where('supplier', array('supplier_id' => $row->supplier_id))->row();
                                        $kategori= $this->db->get_where('produk_kategori', array('kategori_id' => $row->kategori_id))->row();
                                        $merek= $this->db->get_where('produk_merek', array('merek_id' => $row->merek_id))->row();
                                    ?>
                                    <tr>                
                                        <td><?=$nama;?></td>
                                        <td><?=$supplier->nama_supplier;?></td>                
                                        <td>
                                            <li>Kategori <?=$kategori->nama_kategori;?></li>
                                            <li>Merek <?=$merek->nama_merek;?></li>
                                            <li>Berat <?=number_format($row->berat,2);?> Gram</li>
                                        </td>               
                                        <td>Rp <?=number_format($row->harga,0);?></td>              
                                        <td>
                                            <?php
                                            $dStok=produk_stok_data(toko_user(),$id);
                                            if(!empty($dStok))
                                            {
                                                foreach($dStok as $rStok)
                                                {                           
                                                    $mutasi=$rStok->stok_mutasi;
                                                    $jual=$rStok->stok_jual;
                                                    $stok=$rStok->stok-($mutasi+$jual);
                                                    ?>
                                                    <li><?=$stok;?></li>
                                                    <?php
                                                }
                                            }else{
                                            ?>
                                            
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <!-- <a href="<?=base_url('produk/stoklist').'?id='.$id;?>" class="btn btn-xs btn-default">Stok List</a> -->
                                            <center><a href="<?=site_url('produk/edit').'?id='.$id;?>"><i class="fa fa-edit fa-fw"></i></a></center>
                                        </td>
                                        <td>
                                            <center><a onclick="return confirm('Yakin ingin menghapus produk ini?');" href="<?=site_url('produk/delete').'?id='.$id;?>"><i class="fa fa-trash fa-fw"></i></a></center>
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
                <h3 class="modal-title">Tambah Produk</h3>
            </div>
          <div class="modal-body form">
          <?= form_open_multipart('produk/add', ['id' =>'form']) ?>
            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label" >Kode Produk</p>
                <div class="col-sm-6">
                <input type="text" name="kode" id="" class="form-control " autocomplete="off" placeholder="Kode Produk" required="" value="<?php echo set_value('kode'); ?>"/>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Nama Produk</p>
                <div class="col-sm-6">
                <input type="text" name="nama" id="" class="form-control " autocomplete="off" placeholder="Nama Produk" required="" value="<?php echo set_value('nama'); ?>"/>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Supplier</p>
                <div class="col-sm-6">
                <select name="supplier" id="supplier" class="form-control" required="" style="width: 100%">
                </select>
                <!-- <a href="<?=site_url('mitra/supplier');?>" class="btn btn-link" target="_blank" style="color:black;">+ Tambah Supplier</a> -->
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Kategori</p>
                <div class="col-sm-6">
                <select name="kategori" id="kategori" class="form-control" required="" style="width: 100%">
                </select>
                <!-- <a href="<?=base_url('produk/kategori');?>" class="btn btn-link" target="_blank" style="color:black;">+ Tambah Kategori</a> -->
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Merek</p>
                <div class="col-sm-6">
                <select name="merek" id="merek" class="form-control" required="" style="width: 100%">
                </select>
                <!-- <a href="<?=base_url('produk/merek');?>" class="btn btn-link" target="_blank" style="color:black;">+ Tambah Merek</a> -->
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Stok</p>
                <div class="col-sm-6">
                <input type="number" name="stok" id="" class="form-control " autocomplete="off" placeholder="Stok produk" required="" value="<?php echo set_value('stok'); ?>"/>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Harga</p>
                <div class="col-sm-6">
                <input type="text" name="harga" id="harga" class="form-control duit" autocomplete="off" placeholder="Harga Produk" required="" value="<?php echo set_value('harga'); ?>"/>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Berat</p>
                <div class="col-sm-6">
                <div class="input-group">
                <input type="number" name="berat" id="" class="form-control " autocomplete="off" placeholder="Berat Produk" required="" value="<?php echo set_value('berat',0); ?>" step="0.1"/>
                <div class="input-group-addon">gram</div>
                </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Deskripsi</p>
                <div class="col-sm-6">
                <textarea name="deskripsi" class="form-control" id="isi" required="" placeholder="Isi Halaman"><?=set_value('deskripsi');?></textarea>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Photo</p>
                <div class="col-sm-6">
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

    $("#supplier").select2({ 
    placeholder : '---Pilih Supplier---',       
    ajax:{
        url:'<?=site_url("produk/getdata");?>',
        dataType:'json',
        delay:0,
        data:function(){
            return {
            tipe:"supplier",                
            };
        },
        processResults: function (data,params) {
            params.page = params.page || 1;
            return {
                results: $.map(data, function(obj) {
                    return { id: obj.supplier_id, text: obj.nama_supplier };
                }),
                pagination: {
                  more: (params.page * 30) < data.total_count
                }
            };
        }
    }
});

    $("#merek").select2({
    placeholder : '---Pilih Merek---',       
    ajax:{
        url:'<?=site_url("produk/getdata");?>',
        dataType:'json',
        delay:0,
        data:function(){
            return {
            tipe:"merek",               
            };
        },
        processResults: function (data,params) {
            params.page = params.page || 1;
            return {
                results: $.map(data, function(obj) {
                    return { id: obj.merek_id, text: obj.nama_merek };
                }),
                pagination: {
                  more: (params.page * 30) < data.total_count
                }
            };
        }
    }
});

    $("#bumburesep").select2({
    placeholder : '---Pilih Resep---',       
    ajax:{
        url:'<?=site_url("produk/getdata2");?>',
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

    $("#kategori").select2({       
    placeholder : '---Pilih Kategori---',    
    ajax:{
        url:'<?=site_url("produk/getdata");?>',
        dataType:'json',
        delay:0,
        data:function(){
            return {
            tipe:"kategori",                
            };
        },
        processResults: function (data,params) {
            params.page = params.page || 1;
            return {
                results: $.map(data, function(obj) {
                    return { id: obj.kategori_id, text: obj.nama_kategori };
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
    
        
       
