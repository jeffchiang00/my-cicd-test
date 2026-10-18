<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
        $this->load->model('product_model','model');
    }

	public function index(){
		$this->data['content_view'] = $this->load->view('product_list',$this->data,true);
		$this->load->view('master_view_boostrap',$this->data);
	}

	

	public function type($type){

		$this->data['row'] = $this->model->get_type($type);
		//$dick=$this->data['row'];		
		
		//var_dump($dick);
		
		
		if ($this->data['row']===false){
			show_404();
			exit;
		}
		


		
		//$template_content = json_decode(urldecode($this->data['row']['template_content']));
		switch($_SESSION['lang']){
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
		$content = '';

		
		$view = 'product_list_view';
		

		

		$this->data['template_content'] = $content;

		

		$this->data['content_view'] = $this->load->view($view,$this->data,true);

		$this->load->view('master_view_boostrap',$this->data);
		

		
	}
	



	public function item($id){
		$this->data['row'] = $this->model->get_row($id);
		if ($this->data['row']===false){
			show_404();
			exit;
		}
		$template_content = json_decode(urldecode($this->data['row']['template_content']));
		switch($_SESSION['lang']){
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
		$content = '';
		if (count($template_content[$idx])>0){
			$content = $this->get_template($template_content[$idx]);
		}
		$recommand = $this->model->get_recommand($id);
		$gallery = $this->model->get_gallery($id);
		$brand_logo = $this->model->get_brand_logo($id);
		$product_item = $this->model->get_product_item($id);
		$view = 'product_item_view';
		if ($this->data['row']['tag_id']==11){
			$view = 'product_item_coffee_view';
		}
		else if($this->data['row']['tag_id']==14){
			$view = 'product_item_coffeebean_view';
		}
		else if($this->data['row']['tag_id']==13){
			$view = 'product_item_coffeecup_view';
		}

		//$dick = $this->data['row'];
		//var_dump($dick);

		$this->data['content_view'] = $this->load->view($view,array(
			'product_id'=>$this->data['row']['id'],
			'title'=>$this->data['row']['title'],
			'subtitle'=>$this->data['row']['subtitle'],
			'description'=>$this->data['row']['description'],
			'gallery'=>$gallery,
			'template_content'=>$content,
			'brand_logo'=>$brand_logo,
			'recommand'=>$recommand,
			'price'=>$this->data['row']['price'],
			's_price'=>$this->data['row']['special_price'],
			'product_item'=>$product_item
			),true);
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
