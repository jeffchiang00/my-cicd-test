<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dollipop extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function index(){
		switch($_SESSION['lang']){
			case 'tw':
				$content_view = 'dollipop';
				break;
			case 'cn':	
				$content_view = 'dollipop';
				break;
		}


		$this->data['content_view'] = $this->load->view($content_view ,$this->data,true);
		$this->load->view('master_view_dollipop',$this->data);
	}

	
}
