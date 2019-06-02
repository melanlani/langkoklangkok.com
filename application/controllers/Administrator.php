<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('admin/M_user');
		$this->load->model('admin/M_menu');
		$this->load->model('admin/M_role');
	}

	public function index()
	{
		$data["title"] = "Beranda";
		$this->load->view('admin/beranda',$data);
	}

/*=================================== USER ============================================*/

	public function user()
	{
		$data["title"] = "Data User";
		$this->load->view('admin/user',$data);
	}

	public function userSave(){	
		$data = array(
			'userid'=>$this->input->post('userid'),
			'username'=>$this->input->post('username'),
			'password'=>$this->input->post('password')
		);
		if($this->M_user->save($data)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
	}

	public function userList() {
	
		$line  = array();
		$line2 = array();
		$row2  = array();
		
		$hasil = $this->M_user->get_all()->result();
		/*echo json_encode($hasil);*/
		
		foreach ($hasil as $value) {
			$row2['userid'] = $value->userid;
			$row2['username'] = $value->username;
			$row2['password'] = $value->password;
			$row2['role'] = '<center><a href="#" title="Set Roles" data-toggle="modal" data-target="#myModal" onclick="setUserRole('.$value->userid.',\''.$value->username.'\')" ><i class="fa fa-user-secret fa-fw"></i></a></center>';
			$row2['edit'] = '<center><a href="#" title="Reset Password" onClick="return editUser('.$value->userid.');"><i class="fa fa-edit fa-fw"></i></a></center>';
			$row2['drop'] = '<center><a href="#" title="Delete" onClick="return dropUser('.$value->userid.');"><i class="fa fa-trash fa-fw"></i></a></center>';
						
			$line2[] = $row2;
		}
				
		$line['data'] = $line2;
					
		echo json_encode($line);
	}

	public function userInfo(){			
		$userid = $this->input->post('id');
		$data = $this->M_user->get_info($userid);
		echo json_encode($data);
	}
	
	public function userExist(){			
		$username = $this->input->post('id');
		$exist = $this->M_user->exist($username);
		if ($exist > 0){
			echo json_encode(array('exist'=>true));
		}else{
			echo json_encode(array('exist'=>false));
		}
	}

	public function dropUser(){				
		$userid = $this->input->post('id');
		if($this->M_user->delete($userid)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
	}

	public function userRoleList($id) {
	
		$line  = array();
		$line2 = array();
		$row2  = array();
		
		$hasil = $this->M_user->get_role_all($id)->result();
		/*echo json_encode($hasil);*/
		
		foreach ($hasil as $value) {
			$row2['id'] = $value->id;
			$row2['sts'] = $value->sts;
			$row2['role'] = $value->role;
						
			$line2[] = $row2;
		}
				
		$line['data'] = $line2;
					
		echo json_encode($line);
	}
	
	public function userRoleSave(){
		$data = $this->input->post('vdata');
		$id = $data[0]['userid'];
		/**/
		if($this->M_user->userRoleSave($id,$data)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
		
	}

/*======================================== MENU =================================================*/

	public function menu()
	{
		$data["title"] = "Data Menu";
		$data['parents'] = $this->M_menu->get_all_menu();
		$data['sortMenu'] = sortMenu();
		$this->load->view('admin/menu', $data);
	
	}

	public function menuInfo(){			
		$page_id = $this->input->post('id');
		$data = $this->M_menu->get_info($page_id);
		echo json_encode($data);
	}
	
	public function hasChildMenu(){			
		$page_id = $this->input->post('id');
		$child = $this->M_menu->has_child($page_id);
		if ($child > 0){
			echo json_encode(array('hasChild'=>true));
		}else{
			echo json_encode(array('hasChild'=>false));
		}
	}
	
	public function menuSave(){						
		$data = array(
			'page_id'=>$this->input->post('id'),
			'title'=>$this->input->post('title'),
			'url'=>$this->input->post('url'),
			'icon'=>$this->input->post('icon'),
			'parent_id'=>$this->input->post('parent_id')
		);
		if($this->M_menu->save($data)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
	}
	
	public function dropMenu(){				
		$page_id = $this->input->post('id');
		if($this->M_menu->delete($page_id)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
	}
	
	public function updateOrderMenu(){						
		$arr = $this->input->post('data');
		echo $this->M_menu->updatePosition($arr);
	}

/*================================== ROLE ========================================*/

public function role()
	{
		$data["title"] = "Data Role";
		$this->load->view('admin/role', $data);
	}
	
	public function roleExist(){			
		$role = $this->input->post('id');
		$exist = $this->M_role->exist($role);
		if ($exist > 0){
			echo json_encode(array('exist'=>true));
		}else{
			echo json_encode(array('exist'=>false));
		}
	}
	
	public function roleList() {
	
		$line  = array();
		$line2 = array();
		$row2  = array();
		
		$hasil = $this->M_role->get_all()->result();
		/*echo json_encode($hasil);*/
		
		foreach ($hasil as $value) {
			$row2['id'] = $value->id;
			$row2['role'] = $value->role;
			$row2['deskripsi'] = $value->deskripsi;
			$row2['access'] = '<center><a href="#" title="Set Access Menu" data-toggle="modal" data-target="#myModal" onclick="setAccessRole('.$value->id.',\''.$value->role.'\')" ><i class="fa fa-user-secret fa-fw"></i></a></center>';
			$row2['edit'] = '<center><a href="#" title="Set Inactive"onClick="return editRole('.$value->id.');"><i class="fa fa-edit fa-fw"></i></a></center>';
			$row2['drop'] = '<center><a href="#" title="Delete" onClick="return dropRole('.$value->id.');"><i class="fa fa-trash fa-fw"></i></a></center>';
						
			$line2[] = $row2;
		}
				
		$line['data'] = $line2;
					
		echo json_encode($line);
	}

	public function roleInfo(){			
		$id = $this->input->post('id');
		$data = $this->M_role->get_info($id);
		echo json_encode($data);
	}
	
	public function roleSave(){	
		$data = array(
			'id'=>$this->input->post('id'),
			'role'=>$this->input->post('role'),
			'deskripsi'=>$this->input->post('deskripsi')
		);
		/*echo json_encode($data);*/
		
		if($this->M_role->save($data)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
		
	}
	
	public function dropRole(){				
		$id = $this->input->post('id');
		if($this->M_role->delete($id)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
	}

	public function roleMenuList($id) {
	
		$line  = array();
		$line2 = array();
		$row2  = array();
		
		$hasil = $this->M_role->get_menu_all($id)->result();
		/*echo json_encode($hasil);*/
		
		foreach ($hasil as $value) {
			$row2['id'] = $value->page_id;
			$row2['urutan'] = $value->urutan;
			$row2['sts'] = $value->sts;
			$row2['menu'] = $value->title;
						
			$line2[] = $row2;
		}
				
		$line['data'] = $line2;
					
		echo json_encode($line);
	}
	
	public function roleMenuSave(){
		$data = $this->input->post('vdata');
		$id = $data[0]['role_id'];
		/**/
		if($this->M_role->roleMenuSave($id,$data)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false));
		}
		
	}
	
}

?>

