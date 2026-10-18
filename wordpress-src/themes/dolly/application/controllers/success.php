<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Success extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
    }

	public function index(){
		echo 'success';
	}
}
