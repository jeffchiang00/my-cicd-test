<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends MX_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

	public function index()
	{
		$this->admin_model->check_login();
		$data['controller_addr'] = '';
		$this->load->view('master_view.php',$data);
	}
}