<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends MX_Controller {
	function __construct()
    {
        parent::__construct();
    }
	public function index()
	{
		//$this->admin_model->check_login();
		$data['controller_addr'] = '';
		$this->load->view('master_view.php',$data);
		//echo $content = modules::run('admin/account');
	}

	public function method(){
		echo 'module/method';
	}
}
