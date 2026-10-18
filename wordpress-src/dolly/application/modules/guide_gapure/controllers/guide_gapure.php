<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guide_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('article_single_page_model','model');
        $this->data['function_title'] = 'guide';
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
			$content = $template_content[$i];
			$this->data['tab_'.$lang] = $this->load->view('tab_view',array('lang'=>$lang,'content'=>$content),true);
		}
		
		$this->load->view('edit_view',$this->data);
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