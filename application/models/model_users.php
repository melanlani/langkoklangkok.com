<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	private $tbl_login='users';
    function __construct()
    {
         $this->load->library('m_db');
    }

	public function check_credential()
	{
		$username = set_value('username');
		$password = set_value('password');

		$hasil = $this->db->where('username',$username)
							->where('password',$password)
							->limit(1)
							->get('users');

		if($hasil->num_rows() > 0){
			return $hasil->row();
		} else {
			// tidak ada username yg cocok
			return array();
		}

	}

	function user_daftar($fullname,$username,$password,$roleid)
	{
		$s=array(
		'username'=>$username,
		);
		if($this->m_db->is_bof($this->tbl_login,$s)==TRUE)
		{
			$d=array(
			'fullname'=>$fullname,
			'username'=>$username,
			'password'=>$password,
			'roleid'=>$roleid,
			);
			if($this->m_db->add_row($this->tbl_login,$d)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function akun_info($user)
	{
		$hasil = $this->db->select('*')
							->from('supplier, users')
							->where('username',$user)
							->where('supplier_id = supplier_id')
							->limit(1)
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

	function akun_member($user)
	{
		//get all invoices identified by $user
		$hasil = $this->db->select('i.*')
							->from('pelanggan i, users u')
							->where('u.username',$user)
							->where('u.userid = i.userid')
							->get();

		if($hasil->num_rows() >0){
			return $hasil->result();
		} else {
			return false; //if there are no matching records
		}
	}

}