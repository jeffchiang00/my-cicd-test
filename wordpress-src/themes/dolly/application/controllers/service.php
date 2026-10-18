<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function index(){
		$this->data['content_view'] = $this->load->view('service',$this->data,true);
		$this->load->view('master_view_boostrap',$this->data);
	}

	public function baked(){
		$this->data['content_view'] = $this->load->view('service1',$this->data,true);
		$this->load->view('master_view_boostrap',$this->data);
	}

	public function tutorial(){
		$this->data['content_view'] = $this->load->view('service2',$this->data,true);
		$this->load->view('master_view_boostrap',$this->data);
	}

	public function guidance(){
		$this->data['content_view'] = $this->load->view('service3',$this->data,true);
		$this->load->view('master_view_boostrap',$this->data);
	}
}
