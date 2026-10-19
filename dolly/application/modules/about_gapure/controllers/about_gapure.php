<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('about_model','model');
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
		$arr_lang = array('en','tw','cn');
		$template_content = json_decode(urldecode($this->data['row']['template_content']));
		for($i=0;$i<count($arr_lang);$i++){
			$lang = $arr_lang[$i];
			$content = '';
			if (count($template_content[$i])>0){
				$content = $this->get_template($template_content[$i]);
			}
			$this->data['tab_'.$lang] = $this->load->view('tab_view',array('lang'=>$lang,'title'=>$this->data['row']['title_'.$lang],'content'=>$content),true);
		}
		
		$this->load->view('edit_view',$this->data);
	}

	private function get_template($template_content){
		$content = '';
		foreach($template_content as $template_info){
			$template_data = array(
				'view_id'=>$template_info->view_id,
				'input'=>$template_info->input,
				'content'=>$template_info->text,
				'img'=>$template_info->img
			);
			for($key=0;$key<count($template_data['img']);$key++){
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

	public function sort(){
		if (!$this->post) return;
		$id = $this->post['id'];
		$id = $this->model->sort();
		exit;
	}
}