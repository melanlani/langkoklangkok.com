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
							<form id="idform" action="<?php echo site_url('administrator/userSave'); ?>" method="post">	
								<div class="form-group row">
									<p class="col-sm-4 form-control-label">Username *</p>
									<div class="col-sm-8">
										<input type="text" class="form-control" placeholder=""  id="username" name="username" required>
										<input type="hidden" name="userid" id="userid" value=''>
									</div>
								</div>								
								<div class="form-group row">
									<p class="col-sm-4 form-control-label">Password *</p>
									<div class="col-sm-8">
										<input type="password" class="form-control" placeholder="" name="password" id="password" required>
									</div>
								</div>		
								<div class="form-group row">
									<p class="col-sm-4 form-control-label">Retype Password *</p>
									<div class="col-sm-8">
										<input type="password" class="form-control" placeholder="" id="repassword" required>
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
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-info">
					<div class="panel-heading" align="center" style="background-color:#71ca2a;color:#ffffff">Daftar User</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="contoh">
								<thead>
									<tr>
										<th></th>
										<th>Username</th>
										<th>Password</th>
										<th>Roles</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div id="dialog-confirm"></div>
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
												<th></th>
												<th>Role</th>
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
					</div>
				</div>
			</div>
		</div>
	</section>
	

	
		

<script type='text/javascript'>

$(function() {
	$( "#dialog-confirm" ).hide();
	objTable = $('#contoh').DataTable( {
			ajax: "<?php echo site_url('administrator/userList'); ?>",
			columns: [
				{ data: "userid" },
				{ data: "username" },
				{ data: "password" },
				{ data: "role" },
				{ data: "edit" },
				{ data: "drop" }
			],
			columnDefs: [
				{ targets: [ 0 ], visible: false }
			]	
		} );	
	
	$(":reset").click(function(){		
		$("#username").prop('disabled', false);
	});	
	
	$('#btnSimpan').click(function(){
		if ( $('#password').val() == $('#repassword').val() ){
			if ($('#userid').val()==''){
				$.ajax({
					data: {id:$('#username').val()},
					type: 'POST',
					url: '<?php echo site_url('administrator/userExist'); ?>',
					dataType:'json',
					success: function( response ) {
						if (response.exist){
							$( "#dialog-confirm" ).html("Sudah ada username dengan nama yang sama!");
							$( "#dialog-confirm" ).dialog({
							  resizable: false,
							  modal: true,
							  buttons: {
								"Oke": function() {
									$( this ).dialog( "close" );
									$('#username').focus();
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
		}else{
			alert('Please retype, password is missmatch!');
			$('#password').val('');
			$('#repassword').val('');
			$('#password').focus();
		}
	});
	
	//=========== When (modal) POP-UP closed, remove class from TR Grid =================
	$('#myModal').on('hidden.bs.modal', function (e) {
		$("tr").removeClass('detailselected');
	});
});

function test(obj) {
	alert('test');
	$(obj).parent().parent().addClass("selected");	
}	

var objTable2;
function setUserRole(vid,vname){
	if (objTable2!= null)
		objTable2.destroy();

	objTable2 = $('#detailTable').DataTable( {
		ajax: "<?php echo site_url('administrator/userRoleList'); ?>/"+vid,
		columns: [
			{ data: "id" },
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
			{ data: "role" }
		],
		columnDefs: [
			{ targets: [ 0 ], visible: false },
			{ targets: [ 1 ], orderable: false },
			{ targets: [ 2 ], orderable: false }
		],
		paging: false,			
		searching: false,
		autoWidth: false
	} );	
	$('#modalTitle').html( "Set Role for User : <strong>"+vname+"</strong>");
}

function editUser(vid){
	$.ajax({
		data: {id:vid},
		type: 'POST',
		url: '<?php echo site_url('administrator/userInfo'); ?>',
		dataType:'json',
		success: function( response ) {
			$("#userid").val(response.userid);
			$("#username").val(response.username);
			$("#username").prop('disabled', true);
			$("#password").val(response.password);
			$('#password').focus();
			$("#repassword").val('');			
		}
	});
	return false;
}

function dropUser(vid){	
	$( "#dialog-confirm" ).html("Anda yakin akan menghapus user?");
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
				url: '<?php echo site_url('administrator/dropUser'); ?>',
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
			vdata[x] = {"roleid":objTable2.column( 0 ).data()[i],"userid":checkApp[i].value,"role":objTable2.column( 2 ).data()[i]};	
			x++;
		}
	}
	
	$.ajax({		
		type: 'POST',					
		url: '<?php echo site_url('administrator/userRoleSave'); ?>',
		data: {vdata:vdata},
		dataType:'json',
		success: function( response ) {
			if (response.success){ 
				alert("Assign Role Berhasil");
				$('#myModal').modal('hide');
			}else 
				alert("Assign Role Gagal");
		}
	});	
}

</script>

<?php $this->load->view("admin/admin_footer"); ?>