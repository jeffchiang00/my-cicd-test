<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
        $this->load->model('product_model','model');
    }

	public function index(){

	}
}
