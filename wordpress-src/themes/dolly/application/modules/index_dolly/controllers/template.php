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
        if ($this->post['view_id']==1){
            $data['img'][0] = '';
            $data['default_img'][0] = 'http://placehold.it/860x200';
        }
        else{
            $data['img'][0] = '';
            $data['default_img'][0] = 'http://placehold.it/430x275';
        }
        $data['view_id'] = $this->post['view_id'];
        $data['content'][0] = '';
        $data['section_idx'] = $this->post['section_idx'];
        $this->load->view('template/' . $this->post['view'],$data);
        exit;
    }
}