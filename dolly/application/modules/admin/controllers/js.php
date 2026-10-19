<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Js extends MX_Controller {
	function __construct()
    {
        parent::__construct();
        $this->data = array();
    }

	public function index()
	{
		header('Content-Type: application/javascript');
		$this->load->view('js_view.php',$this->data);
	}
}