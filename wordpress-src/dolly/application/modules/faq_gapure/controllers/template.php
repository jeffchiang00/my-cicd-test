<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('article_model','model');
    }

    public function index(){
        $data['img'] = array();
        $data['content'] = array();
        $data['view_id'] = $this->post['view_id'];
        $data['input'][0] = '';
        $data['content'][0] = '';
        $data['section_idx'] = $this->post['section_idx'];
        $this->load->view('template/' . $this->post['view'],$data);
        exit;
    }
}