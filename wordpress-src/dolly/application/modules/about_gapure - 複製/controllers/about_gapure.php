<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('article_single_page_model','model');
        $this->data['function_title'] = 'about';
    }

	// public function index(){
	// 	$this->admin_model->check_login();
	// 	$this->data['rs'] = $this->model->get_rs();
	// 	$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
	// 	$this->load->view('list_view',$this->data);
	// }

	public function index(){
		$this->admin_model->check_login();
		$this->admin_model->check_login();
		$this->data['row'] = $this->model->get_row($this->data['function_title']);
		$arr_lang = array('en','tw','cn');
		$template_content = json_decode(urldecode($this->data['row']['template_content']));
		for($i=0;$i<count($arr_lang);$i++){
			$lang = $arr_lang[$i];
			$content = '';
			if (count($template_content[$i])>0){
				$content = $this->get_template($template_content[$i]);
			}
			$this->data['tab_'.$lang] = $this->load->view('tab_view',array('lang'=>$lang,'content'=>$content),true);
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
		$id = $this->model->save($this->data['function_title']);
		if ($id!==false){
			echo "alert('儲存完成');";
			echo "location.reload();";
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