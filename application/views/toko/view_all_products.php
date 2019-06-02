<?php
  $this->load->view('admin/admin_header.php');
?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">

                        <button class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> Add Barang</button>
                        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                        <br><br>
                          
                        <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $product ) : ?>
                              <tr>
                                <td><?=$product->id ?></td>
                                <td><?=$product->nama ?></td>
                                <td><?php
                                $product_image = ['src' => 'uploads/' . $product->gambar,
                                        'height' => '50'];
                                echo img($product_image) 
                                ?>
                                </td>
                                <td><?=$product->harga ?></td>
                                <td><?=$product->stok ?></td>
                                <td><?=$product->status ?></td>
                                <td>
                                  <?=anchor('produk/update/'. $product->id,'Edit', ['class'=>'btn btn-primary btn-sm']) ?>
                                  <?=anchor('produk/delete/'. $product->id,'Delete', ['class'=>'btn btn-danger btn-sm', 'onclick' =>'return confirm(\'Apakah Anda Yakin?\')']) ?>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                            </tbody>
                          </table>  
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
                <h3 class="modal-title">Produk Form</h3>
            </div>
          <div class="modal-body form">
          <?= form_open_multipart('produk/create', ['id' =>'form']) ?>
            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label" >Product Name</p>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="nama" placeholder="" value="<?= set_value('nama') ?>">
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Description</p>
                <div class="col-sm-6">
                <textarea class="form-control" name="deskripsi" value="<?= set_value('deskripsi') ?>"></textarea>
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Price</p>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="harga" placeholder="" value="<?= set_value('harga') ?>">
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Stock</p>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="stok" placeholder="" value="<?= set_value('stok') ?>">
                <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Product Image</p>
                <div class="col-sm-6">
                <input type="file" class="form-control" name="userfile" >
                <span class="help-block"></span><h6 style="color:white;">Gambar harus diupload!</h6>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-1"></div>
                <p class="col-sm-3 form-control-label">Status</p>
                <div class="col-sm-6">
                <select name="status" class="form-control">
                <option value="">--Pilih Status--</option>
                <option value="1" <?php if($status == 1 ) { echo "selected"; }?>>Aktif</option>
                <option value="2" <?php if($status == 2 ) { echo "selected"; }?>>Tidak Aktif</option>
                </select>
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

<?php $this->load->view("admin/admin_footer"); ?>
	
		
       
