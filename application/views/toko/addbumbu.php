<?php
  $this->load->view('admin/admin_header.php');
?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body ">
                    <?= form_open_multipart('resep/add_bumbu', ['id' =>'form']) ?>
                        <input type="hidden" name="paketid" value=""/>
                        <div class="col-md-6">

                        <div class="form-group">
                            <label>List Resep Masakan</label>
                                <select name="resepbumbu" id="resepbumbu" class="form-control select2" required="" style="width: 100%" data-placeholder="Pilih Resep Masakan">
                                
                                <option></option>
                                <?php
                                if(!empty($resep))
                                {
                                    foreach($resep as $rsep)
                                    {
                                        echo '<option value="'.$rsep->id_resep.'">'.$rsep->jdl_resep.'</option>';
                                    }
                                }
                                ?>
                                </select>
                        </div>

                        </div>
                        <div class="col-md-6">
                         <div class="form-group">
                            <label>List Produk Bumbu</label>
                                <select name="bumburesep" id="bumburesep" class="form-control select2" style="width: 100%" data-placeholder="Pilih Produk Bumbu">
                                    <option></option>
                                    <?php
                                    if(!empty($produk))
                                    {
                                        foreach($produk as $rpro)
                                        {
                                            echo '<option value="'.$rpro->produk_id.'">'.$rpro->nama_produk.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                        </div>
                
                        </div>
                        
                        <hr/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                     <?= form_close() ?>
                     <div class="col-md-12">
                            <div class="pull-left">
                                <b>List Bumbu Resep Masakan</b><hr/>
                            </div>
                            <div class="pull-right">
                                <button type="submit" id="selesai" style="display: none;" class="btn btn-primary">Selesai</button>
                            </div>
                            
                            <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <th>Nama Resep Masakan</th>
                                    <th>Nama Bumbu Resep</th>
                                    <th>Gambar Bumbu</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($paket))
                                    {
                                        foreach($paket as $row)
                                        {
                                            $id=$row->id_paket;
                                            $resep= $this->db->get_where('resep_masakan', array('id_resep' => $row->id_resep))->row();
                                            $produk= $this->db->get_where('produk', array('produk_id' => $row->produk_id))->row();

                                            $photoKategori=produk_photo($row->produk_id,1);
                                            foreach($photoKategori as $rPhotoKategori)
                                            {                               
                                            }
                                            $urlPhotoKategori=base_url().'uploadsthumbs/400/'.$rPhotoKategori->photo;
                                            $pathPhotoKategori=FCPATH.'uploadsthumbs/400/'.$rPhotoKategori->photo;
                                            if(!file_exists($pathPhotoKategori) && !file_exists($pathPhotoKategori))
                                            {
                                                $urlPhotoKategori=base_url().'asset/images/avatar/noavatar.jpg';
                                            }
                                        ?>
                                        <tr>                
                                        <td><?=$resep->jdl_resep;?></td>                
                                        <td><?=$produk->nama_produk;?></td> 
                                        <td><center><img src="<?=$urlPhotoKategori;?>"alt="" style="max-width: 100%; max-height: 100%; height: 50px;"><center>
                                        </td>   
                                        <td>
                                            <center><a href="<?=site_url('resep/editbumres').'?id='.$id;?>"><i class="fa fa-edit fa-fw"></i></a></center>
                                        </td>
                                        <td>
                                            <center><a onclick="return confirm('Yakin ingin menghapus produk ini?');" href="<?=site_url('resep/deletebumres').'?id='.$id;?>"><i class="fa fa-trash fa-fw"></i></a></center>
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
<?php $this->load->view("admin/admin_footer"); ?>

<script >
      $(document).ready(function(){
        $('#myTable').DataTable();
      });
</script>





    
        
       
