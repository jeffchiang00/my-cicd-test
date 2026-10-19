<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

	public function index()
	{
		if (count($_POST)){
			$this->load->model('admin/admin_model','admin_model');
			$query = $this->admin_model->do_login();
			if ($query->num_rows() > 0){
				//login success
				$row = $query->row_array();
				$_SESSION[ADMIN_SESSION] = $row['id'];
				if ($_GET['ref']!='')
					echo "location='" . SITE_URL . $_GET['ref'] . "';";
				else
					echo "location='" . ADMIN_URL . "';";
			}
			else{
				//login error
				echo "alert('login error');";
			}
			exit;
		}
		else{
			$this->load->view('admin/login_view');
		}
	}
}