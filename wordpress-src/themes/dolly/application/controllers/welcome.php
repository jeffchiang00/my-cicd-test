<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
        $this->load->model('article_model','model');
    }

	public function index(){
		
		
		$this->data['rs'] = $this->model->get_rs(0,3,1);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['rs2'] = $this->model->get_rs(0,9,2);
		$this->data['rs2'] = $this->data['rs2']===false?array():$this->data['rs2'];
		//
		switch($_SESSION['lang']){
			case 'tw':
				$content_view = 'index_view';
				break;
			case 'cn':	
				$content_view = 'index_view';
				break;

		}

		$metadata = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta charset='UTF-8' />
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
			<meta property='fb:admins' content='1531802340' />
			<meta property='fb:app_id' content='1720065518209265' />

			<meta property='og:type' content='website' />
			<meta property='og:url' content='http://gapure.com/dolly/tw/index.php' />
			<meta property='og:title' content='Dolly' />
			<meta property='og:description' content='Dolly官方網站' />
			<meta property='og:image' content='http://gapure.com/dolly/assets/img/about1.jpg' />";
		$this->output->set_output($metadata);
		$this->data['content_view'] = $this->load->view($content_view ,$this->data,true);
		$this->load->view('master_view',$this->data);

	}

	
}
