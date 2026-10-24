<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	
   function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->post = $this->input->post(null,true);
        $this->data = array();
    }
	public function index(){
		$this->admin_model->check_login();
		$this->data['menu_selected'] = '';
      $this->data['menu'] = $this->admin_model->get_func_menu();
      $this->data['contact'] = $this->admin_model->get_contact();
      $this->data['content_view'] = $this->load->view('list_view',$this->data,true);
		$this->load->view('master_view.php',$this->data);
      //var_dump($this->data['contact']);
		
	}
   
	public function del(){
		if (!$this->post) return;
		$id = $this->post['id'];
		$id = $this->admin_model->del($id);
		echo "$('#row_{$this->post['id']}').remove();";
		exit;
	}

	public function router(){
		$this->admin_model->check_login($this->uri->uri_string());
		$module_name = $this->uri->segment(3);
		$module_controller = $this->uri->segment(4);
		$module_method = $this->uri->segment(5);
		$module_root = dirname(dirname(dirname(__FILE__)));
		$module_info = $this->admin_model->get_module_info($module_name);
		if ($module_info===false){
			show_404('page',false);
		}

    	define('MODULE_URL',ADMIN_URL . 'module/' . $module_info['url']); //module function url
		$module_folder = $module_root . '/' . $module_info['folder'];
		if (!is_dir($module_folder)){
			show_404('page',false);
		}
		else{
			$path = $module_info['folder'];
			if (strlen($module_controller)){
				$path .= '/' . $module_controller;
			}
			$content = modules::run($path);
			if ($content==''){ //other controller
				if ($module_method==''){
					$path .= '/index';
				}
				else{
					$path .=  '/' . $module_method;
				}
				$content = modules::run($path);
			}
		}
		if(strlen($content)==0){
			show_404('page',false);
		}
		else{
			$this->admin_model->log('page view');
    		$this->data["menu_selected"]  = $module_info['url']; //menu highlight
			$this->data['content_view'] = $content;
        	$this->data['menu'] = $this->admin_model->get_func_menu();
			$this->load->view('master_view.php',$this->data);
		}
	}
}
