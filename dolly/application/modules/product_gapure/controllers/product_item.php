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
        $data['item'] = array('coffee_taste'=>array(
            '花香'=>0,
            '柑橘'=>0,
            '蜂蜜'=>0,
            '堅果'=>0,
            '焦糖'=>0,
            '巧克力'=>0
            ));
        $this->load->view('product_item_view',$data);
        exit;
    }
}