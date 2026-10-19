<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Color_template extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('article_model','model');
    }

    public function index(){
        $data['color_id'] = $this->post['color_id'];
        $data['gallery'] = array();
        $data['product_item'] = array();
        $this->load->view('color_template_view',$data);
        exit;
    }
}