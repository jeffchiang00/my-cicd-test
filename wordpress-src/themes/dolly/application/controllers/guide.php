<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guide extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
        $this->load->model('article_single_page_model','model');
        $this->data['function_title'] = 'guide';
    }

	public function index(){
		$this->data['row'] = $this->model->get_row($this->data['function_title']);
		$template_content = json_decode(urldecode($this->data['row']['template_content']));
		$lang = $this->data['language_sort'][0][0];
		$content = '';
		switch($lang){
			case 'en':
				$idx = 0;
				break;
			case 'tw':
				$idx = 1;
				break;
			case 'cn':
				$idx = 2;
				break;
		}
		if (count($template_content[$idx])>0){
			$content = $template_content[$idx];
		}	
		$this->data['content_view'] = $this->load->view('guide_view',array('template_content'=>$content),true);
		$this->load->view('master_view',$this->data);
	}
}
