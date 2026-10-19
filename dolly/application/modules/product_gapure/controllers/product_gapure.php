<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('product_model','model');
        $this->default_coffee_taste = array(
        	'花香'=>0,
        	'柑橘'=>0,
        	'蜂蜜'=>0,
        	'堅果'=>0,
        	'焦糖'=>0,
        	'巧克力'=>0
        	);
    }

	public function index(){
		$this->admin_model->check_login();
		$this->data['rs'] = $this->model->get_rs();
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->load->view('list_view',$this->data);
	}

	public function edit(){
		$this->admin_model->check_login();
		$id = $this->input->get('id', TRUE);
		$this->admin_model->check_login();
		$this->data['row'] = $this->model->get_row($id);
		//分類
		$this->data['brand_list'] = $this->model->get_brand_tags($id);
		$this->data['brand_list'] = $this->data['brand_list']===false?array():$this->data['brand_list'];
		//顏色
		$this->data['color_list'] = $this->model->get_color_list($id);
		$this->data['color_list'] = $this->data['color_list']===false?array():$this->data['color_list'];
		//照片
		$this->data['gallery'] = $this->model->get_gallery($id);
		$this->data['gallery'] = $this->data['gallery']===false?array():$this->data['gallery'];
		$arr_lang = array('en','tw','cn');
		$template_content = json_decode(urldecode($this->data['row']['template_content']));
		//尺寸規格
		$this->data['product_item'] = $this->model->get_product_item($id);
		$this->data['product_item'] = $this->data['product_item']===false?array():$this->data['product_item'];
		for($i=0;$i<count($this->data['product_item']);$i++){
			//加入咖啡風味
			for($j=0;$j<count($this->data['product_item'][$i]['items']);$j++){
				$coffee_taste = $this->default_coffee_taste;
				$taste = $this->data['product_item'][$i]['items'][$j]['coffee_taste'];
				if ($taste!=''){
					$arr_taste = explode(',',$taste);
					$coffee_taste = array(
			        	'花香'=>$arr_taste[0],
			        	'柑橘'=>$arr_taste[1],
			        	'蜂蜜'=>$arr_taste[2],
			        	'堅果'=>$arr_taste[3],
			        	'焦糖'=>$arr_taste[4],
			        	'巧克力'=>$arr_taste[5]
			        	);
				}
				$this->data['product_item'][$i]['items'][$j]['coffee_taste'] = $coffee_taste;
				$this->data['product_item'][$i]['items'][$j]['html'] = $this->load->view('product_item_view',array('item'=>$this->data['product_item'][$i]['items'][$j]),true);
			}
			//print_r($this->data['product_item']);
			$this->data['product_item'][$i]['tab_view'] = $this->load->view('color_template_view',array(
				'color_id'=>$this->data['product_item'][$i]['color_id'],
				'gallery'=>$this->data['product_item'][$i]['gallery'],
				'product_item'=>$this->data['product_item'][$i]['items'],
				),true);
		}
		//print_r($this->data['product_item']);

		for($i=0;$i<count($arr_lang);$i++){
			$lang = $arr_lang[$i];
			$content = '';
			if (count($template_content[$i])>0){
				$content = $this->get_template($template_content[$i]);
			}
			$this->data['tab_'.$lang] = $this->load->view('tab_view',array(
				'lang'=>$lang,
				'title'=>$this->data['row']['title_'.$lang],
				'subtitle'=>$this->data['row']['subtitle_'.$lang],
				'description'=>$this->data['row']['description_'.$lang],
				'content'=>$content),true);
		}
		
		$this->load->view('edit_view',$this->data);
	}

	private function get_template($template_content){
		$content = '';
		foreach($template_content as $template_info){
			$template_data = array(
				'view_id'=>$template_info->view_id,
				'content'=>$template_info->text,
				'img'=>$template_info->img
			);
			for($key=0;$key<count($template_data['img']);$key++){
				if ($template_data['img'][$key]==''){
					switch($template_data['view_id']){
						case 1:
							$template_data['img'][$key] = '';
							$template_data['default_img'][$key] = 'http://placehold.it/860x200';
							break;
						case 2:
							$template_data['img'][$key] = '';
							$template_data['default_img'][$key] = 'http://placehold.it/430x275';
							break;
					}
				}
				else{
					//$template_data['img'][$key] = IMG_URL . $template_data['img'][$key];
				}
			}
			$content .= $this->load->view('template/template_0' . $template_data['view_id'] . '_view',$template_data,true);
		}
		return $content;
	}

	public function save(){
		if (!$this->post) return;
		$id = $this->post['id'];
		$id = $this->model->save($id);
		if ($id!==false){
			echo "alert('儲存完成');";
			echo "location='" . MODULE_URL . "/edit?id={$id}';";
		}
		else{
			echo "alert('儲存失敗')";
		}
		exit;
	}

	public function publish(){
		if (!$this->post) return;
		$id = $this->post['id'];
		$id = $this->model->publish($id);
		exit;
	}

	public function del(){
		if (!$this->post) return;
		$id = $this->post['id'];
		$id = $this->model->del($id);
		echo "$('#row_{$this->post['id']}').remove();";
		exit;
	}

	public function news(){ //分類
		$this->admin_model->check_login();
		$this->data['rs'] = $this->model->get_rs_by_type(1);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['type_title'] = '- 新聞';
		$this->load->view('list_view',$this->data);
	}

	public function stories(){ //分類
		$this->admin_model->check_login();
		$this->data['rs'] = $this->model->get_rs_by_type(2);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['type_title'] = '- 故事';
		$this->load->view('list_view',$this->data);
	}

	public function reports(){ //分類
		$this->admin_model->check_login();
		$this->data['rs'] = $this->model->get_rs_by_type(3);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['type_title'] = '- 媒體報導';
		$this->load->view('list_view',$this->data);
	}

	// public function upload(){
	// 	echo 'upload';
	// }
}