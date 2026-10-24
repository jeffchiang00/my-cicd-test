<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_item extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('article_model','model');
    }

    public function index(){
        $data['img'] = array();
        $this->load->view('product_item_view',$data);
        exit;
    }
}