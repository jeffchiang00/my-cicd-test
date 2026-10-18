<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index2 extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function index(){
		$this->data['product_data'] = array(4,3,1,5,6);
		$this->data['is_index'] = true;
		switch($_SESSION['lang']){
			case 'tw':
				$content_view = 'index_view_tw2';
				break;
			case 'cn':
				$content_view = 'index_view_tw2';
				break;
		}
		$this->data['content_view'] = $this->load->view($content_view ,$this->data,true);
		$this->load->view('master_view_index',$this->data);
	}

	
}
