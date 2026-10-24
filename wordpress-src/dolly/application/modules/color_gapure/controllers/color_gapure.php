<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Color_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('color_model','model');
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
		//$this->data['tags_type'] = $this->model->get_tags_type($this->data['row']['parentid']);
		$arr_lang = array('en','tw','cn');
		for($i=0;$i<count($arr_lang);$i++){
			$lang = $arr_lang[$i];
			$this->data['tab_'.$lang] = $this->load->view('tab_view',array('lang'=>$lang,'title'=>$this->data['row']['title_'.$lang],'description'=>$this->data['row']['description_'.$lang]),true);
		}
		
		$this->load->view('edit_view',$this->data);
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