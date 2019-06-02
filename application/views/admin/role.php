<?php
	$this->load->view('admin/admin_header.php');
?>
	<!-- Content Header (Page header) -->	
	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Form Input</div>
					<div class="panel-body">
						<br>
							<form id="idform" action="<?php echo site_url('administrator/roleSave'); ?>" method="post">	
								<div class="form-group row">
									<p class="col-sm-4 form-control-label">Role *</p>
									<div class="col-sm-8">
										<input type="text" class="form-control" placeholder="" name="role"  id="role" required>
										<input type="hidden" name="id" id="id" value=''>
									</div>
								</div>								
								<div class="form-group row">
									<p class="col-sm-4 form-control-label">Deskripsi *</p>
									<div class="col-sm-8">
										<textarea class="form-control" rows="2" placeholder="" name="deskripsi" id="deskripsi" required></textarea>
									</div>
								</div>	
								<div class="form-group row">
									<div class="col-sm-4">
									</div>
									<div class="col-sm-8">
										<div class="form-inline">
											<button type="reset" class="btn btn-success">Reset</button>
											<button type="button" class="btn btn-success" id="btnSimpan">Simpan</button>
											<!--<a href="#" class="btn btn-primary">Cetak Kartu</a>-->
										</div>
									</div>	
								</div>
							<?php echo form_close();?>
					</div>
					<!--- end panel body-->
				</div>
				<!--- end panel -->
			</div>
		<!--- end col -->
			<div class="col-md-8">
				<div class="panel panel-info">
					<div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Daftar Role</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="tes">
								<thead>
									<tr>
										<th></th>
										<th>Role</th>
										<th>Deskripsi</th>
										<th>Access</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!--- end panel body-->
				</div>
				<div id="dialog-confirm"></div>
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="modalTitle"></h4>
							</div>
							<div class="modal-body">							
								<div class="table-responsive">
								<form id="detailForm" >
									<table class="table table-striped table-bordered table-hover" id="detailTable">
										<thead>
											<tr>
												<th></th>
												<th>urutan</th>
												<th></th>
												<th>Menu</th>
											</tr>
										</thead>
									</table>
								</form>
								</div>
								<!-- /.table-responsive -->
							</div>
							<div class="modal-footer">
								<button type="button" onclick="saveSetting()" class="btn btn-primary">Save</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!--- end panel -->
			</div>
		<!--- end col -->
		</div><!--- end row -->
	</section>
	
<?php
	$this->load->view('admin/admin_footer.php');
?>


<script type='text/javascript'>
$(function() {
	$( "#dialog-confirm" ).hide();
	objTable = $('#tes').DataTable( {
		ajax: "<?php echo site_url('administrator/roleList'); ?>",
		columns: [
			{ data: "id" },
			{ data: "role" },
			{ data: "deskripsi" },
			{ data: "access" },
			{ data: "edit" },
			{ data: "drop" }
		],
		columnDefs: [
			{ targets: [ 0 ], visible: false }
		]	
	});	
	
	$('#btnSimpan').click(function(){
		$.ajax({
			data: {id:$('#role').val()},
			type: 'POST',
			url: '<?php echo site_url('administrator/roleExist'); ?>',
			dataType:'json',
			success: function( response ) {
				if (response.exist){
					$( "#dialog-confirm" ).html("Sudah ada role dengan nama yang sama!");
					$( "#dialog-confirm" ).dialog({
					  resizable: false,
					  modal: true,
					  buttons: {
						"Oke": function() {
							$( this ).dialog( "close" );
							$('#role').focus();
						}
					  }
					});
				}else{										  
					$.ajax({			
						type: 'POST',				
						url: $('#idform').attr( 'action' ),
						data: $('#idform').serialize(),
						dataType:'json',
						success: function( response ) {
							if (response.success) window.location.reload(true);
							else alert("Gagal menambahkan data");
						}
					});							
				}
			}
		});
	});
	//=========== When (modal) POP-UP closed, remove class from TR Grid =================
	$('#myModal').on('hidden.bs.modal', function (e) {
		$("tr").removeClass('detailselected');
	});
});

var objTable2;
function setAccessRole(vid,vname){
	if (objTable2!= null)
		objTable2.destroy();

	objTable2 = $('#detailTable').DataTable( {
		ajax: "<?php echo site_url('administrator/roleMenuList'); ?>/"+vid,
		columns: [
			{ data: "id" },
			{ data: "urutan" },
			{
				data:   "sts",
				render: function ( data, type, row ) {
					if ( type === 'display' ) {
						if (data==0){
							return "<input type='checkbox' name='checkApp' value='"+vid+"' onchange='chooseApp(this)'/>";
						}else{
							return "<input type='checkbox' name='checkApp' value='"+vid+"' onchange='chooseApp(this)' checked/>";
						}
					}
					return data;
				},
				className: "dt-body-center"
			},
			{ data: "menu" }
		],
		columnDefs: [
			{ targets: [ 0 ], visible: false },
			{ targets: [ 1 ], visible: false, orderable: false },
			{ targets: [ 2 ], orderable: false },
			{ targets: [ 3 ], orderable: false }
		],
		paging: false,			
		searching: false,
		autoWidth: false,
		order: [[ 1, "asc" ]]			
	} );	
	$('#modalTitle').html( "Set Access Menu for Role : <strong>"+vname+"</strong>");
}

function editRole(vid){
	$.ajax({
		data: {id:vid},
		type: 'POST',
		url: '<?php echo site_url('administrator/roleInfo'); ?>',
		dataType:'json',
		success: function( response ) {
			$("#id").val(response.id);
			$("#role").val(response.role);
			$("#deskripsi").val(response.deskripsi);

		}
	});
	return false;
}

function dropRole(vid){	
	$( "#dialog-confirm" ).html("Anda yakin akan menghapus role?");
	$( "#dialog-confirm" ).dialog({
	  resizable: false,
	  modal: true,
	  buttons: {
		"Batal": function() {
			$( this ).dialog( "close" );
		},
		"Ya": function() {					  
			$.ajax({
				data: {id:vid},
				type: 'POST',
				url: '<?php echo site_url('administrator/dropRole'); ?>',
				dataType:'json',
				success: function( response ) {
					if (response.success) window.location.reload(true);
					else alert("Gagal menghapus");
				}
			});
		}
	  }
	});
	
	return false;
}

function saveSetting(){
	var vdata = [];
	var checkApp = document.forms[1].checkApp;
	var x=0;
	for (var i = 0; i < checkApp.length; i++) {
		if (checkApp[i].checked) {
			vdata[x] = {"menu_id":objTable2.column( 0 ).data()[i],"role_id":checkApp[i].value,"menu":objTable2.column( 3 ).data()[i]};	
			x++;
		}
	}
	
	$.ajax({		
		type: 'POST',					
		url: '<?php echo site_url('administrator/roleMenuSave'); ?>',
		data: {vdata:vdata},
		dataType:'json',
		success: function( response ) {
			if (response.success){ 
				alert("Access Menu Berhasil");
				$('#myModal').modal('hide');
			}else 
				alert("Access Menu Gagal");
		}
	});	
}
</script>