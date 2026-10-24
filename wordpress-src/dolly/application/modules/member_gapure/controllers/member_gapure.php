<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('member_model','model');
    }

	public function index(){
		$this->admin_model->check_login();
		$this->data['search_key'] = isset($_GET['search_key'])?$_GET['search_key']:'';
		$this->data['rs'] = $this->model->get_rs($this->data);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->load->view('list_view',$this->data);
	}

	public function detail(){
		$id = $this->input->get('id', TRUE);
		$this->admin_model->check_login();
		$this->data['member_data'] = $this->model->get_order($this->data['row']['member_order_id']);
		$this->load->view('edit_view',$this->data);
	}

	public function save(){
		if (!$this->post) return;
		$id = $this->post['id'];
		$id = $this->model->save($id);
		if ($id!==false){
			echo "alert('儲存完成');";
			echo "location.reload();";
		}
		else{
			echo "alert('儲存失敗')";
		}
		exit;
	}
}