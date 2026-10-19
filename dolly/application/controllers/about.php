<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
        $this->load->model('faq_model','model');
    }

	public function index(){
		$this->data['rs'] = $this->model->get_rs('about');
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['content_view'] = $this->load->view('about',$this->data,true);
		$this->load->view('master_view',$this->data);
	
	}
}