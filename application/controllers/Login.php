<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('m_db');
		$this->load->model('model_users');
	}

	public function index() 
	{
		$this->form_validation->set_rules('username','Username','required|alpha_numeric');
		$this->form_validation->set_rules('password','Password','required|alpha_numeric');

		if($this->form_validation->run() == TRUE)
		{	
			$valid_user = $this->model_users->check_credential();

			if($valid_user == FALSE)
			{
				$this->session->set_flashdata('error','Wrong Username/ Password!');
				redirect('login');
			} else {
				// Jika username dan password sudah benar
				$this->session->set_userdata('username',$valid_user->username);
				$this->session->set_userdata('roleid',$valid_user->roleid);
				$this->session->set_userdata('userid',$valid_user->userid);

				switch($valid_user->roleid){
				case 1 : //admin
							redirect('administrator'); 
							break;
				case 2 : //member
							redirect('order');
							break;
				case 3 : //pelapak
							redirect('administrator');
							break;
				case 6 : //pelapak
							redirect('administrator');
							break;			

				default: break;
				}
			}
			
		} else {
			$data['propinsi'] = $this->db->get('lokasi_provinsi');
			$this->load->view('form_login',$data);
			

		}
		
	}

	function kabupaten(){
        $propinsiID = $_GET['id'];
        $kota   = $this->db->get_where('lokasi_kota',array('provinsi_id'=>$propinsiID));
        
        echo "<select id='kota' name='kota' class='form-control'>";
        foreach ($kota->result() as $k)
        {
            echo "<option value='$k->kota_id'>$k->nama_kota</option>";
        }
        echo "</select></div>";
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

}