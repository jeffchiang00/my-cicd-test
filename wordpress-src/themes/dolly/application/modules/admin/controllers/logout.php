<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MX_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

	public function index()
	{
		$_SESSION[ADMIN_SESSION] = 0;
		$this->admin_model->check_login();
	}
}