<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
        $this->load->model('article_single_page_model','model');
        $this->data['function_title'] = 'about';
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
			$content = $this->get_template($template_content[$idx]);
		}	
		$this->data['content_view'] = $this->load->view('about',array('template_content'=>$content),true);
		$this->load->view('master_view',$this->data);
	}

	private function get_template($template_content){
		$content = '';
		foreach($template_content as $template_info){
			$template_data = array(
				'view_id'=>$template_info->view_id,
				'content'=>$template_info->text,
				'img'=>$template_info->img
			);
			$content .= $this->load->view('template/template_0' . $template_data['view_id'] . '_view',$template_data,true);
		}
		return $content;
	}
}
