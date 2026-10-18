<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('accounts_model','model');
    }

	public function index(){
		$this->admin_model->check_login();
		$this->data['rs'] = $this->model->get_rs();
		$this->load->view('list_view',$this->data);
     
	}

	public function edit(){
		$id = $this->input->get('id', TRUE);
		$this->admin_model->check_login();
		$this->data['row'] = $this->model->get_row($id);
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
}