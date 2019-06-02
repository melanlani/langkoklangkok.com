<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_user extends CI_Model{
	function __construct(){
		parent::__construct();
	}
		
	function exist($username){
		$this->db->from('users');
		$this->db->where('username',$username);	
		return $this->db->count_all_results();	
	}
	
	function get_all(){
		return $this->db->query("select *
			from users
			where deleted = 0
			order by username asc");
	}
	
	function get_role_all($id){
		return $this->db->query("select b.id, IFNULL(a.roleid,0) as sts, b.role
			from dyn_role_user a
			RIGHT JOIN 
			role_users b
			on a.roleid = b.id
			and a.userid = $id");
	}
	/*
	Attempts to login employee and set session. Returns boolean based on outcome.
	*/
	function login($username, $password)
	{
		//$query = $this->db->get_where('users', array('username' => $username,'password'=>md5($password), 'deleted'=>0), 1);
		$query = $this->db->get_where('users', array('username' => $username,'password'=>$password, 'deleted'=>0), 1);
		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			$this->session->set_userdata('userid', $row->userid);
			return true;
		}
		return false;
	}
	
	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	
	/*
	Determins if a user is logged in
	*/
	function is_logged_in()
	{
		return $this->session->userdata('userid')!=false;
	}
	/*
	Gets information about a user loged in
	*/
	function get_logged_in_user_info()
	{
		$userid = $this->session->userdata('userid');
		if (!empty($userid)){
			return $this->get_info($userid);
		}
	}
	/*
	Gets information about a particular user
	*/
	function get_info($userid)
	{
		$this->db->from('users');	
		$this->db->where('userid',$userid);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $item_id is NOT an item
			$data_obj=new stdClass();

			//Get all the fields from items table
			$fields = $this->db->list_fields('users');

			foreach ($fields as $field)
			{
				$data_obj->$field='';
			}

			return $data_obj;
		}
	}
	/*
	Determins whether the employee specified employee has access the specific module.
	*/
	function has_permission($url,$userid)
	{
		//if no module_id is null, allow access
		if($url==null or $url=='beranda' or $url=='logout')
		{
			return true;
		}
		
		$query = $this->db->query("select count(*) as jml
					from dyn_role_user ru, dyn_role_menu rm, dyn_menu m
					where ru.id = $id
						and ru.roleid = rm.role_id
					  and rm.menu_id = m.page_id
					  and m.url = '$url'");
		return $query->num_rows() == 1;
		
		
		return false;
	}
	
	function save(&$data)
	{	
		if ($data["userid"] == ''){
			$this->db->set('deleted', '0');
			if($this->db->insert('users',$data))
			{
				return true;
			}
			return false;
		}else{			
			$this->db->set('password', $data["password"]);
			$this->db->where('userid', $data["userid"]);
			return $this->db->update('users');
		}
	}
	
	function delete($id)
	{
		$this->db->set('deleted', '1');
		$this->db->where('id',$userid);	
		if ($this->db->update('users')){
			return true;
		}else{			
			return false;
		}
	}
	function userRoleSave($id,&$data)
	{	
		$this->db->where('userid', $id);
		$this->db->delete('dyn_role_user');
		$temp =count($data);
		for($i=0; $i<$temp;$i++){
			$this->db->insert('dyn_role_user',$data[$i]);
		}
		return true;
	}
}
?>