<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_gapure extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('purchase_model','model');
    }

	public function index(){
		$this->admin_model->check_login();
		$this->data['search_edate'] = isset($_GET['search_edate'])?$_GET['search_edate']:date('Y-m-d');
		$this->data['search_sdate'] = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
		$this->data['search_sdate'] = (isset($_GET['search_sdate']) && $_GET['search_sdate']!='')?$_GET['search_sdate']:date('Y-m-d',$this->data['search_sdate']);
		$this->data['pay_status'] = $this->model->get_pay_status();
		$this->data['search_key'] = isset($_GET['search_key'])?$_GET['search_key']:'';
		$this->data['search_status'] = isset($_GET['search_status'])?$_GET['search_status']:'2';
		$this->data['rs'] = $this->model->get_rs($this->data);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->load->view('list_view',$this->data);
	}

	public function detail(){
		$id = $this->input->get('id', TRUE);
		$this->admin_model->check_login();
		$this->data['pay_status'] = $this->model->get_pay_status();
		$this->data['row'] = $this->model->get_row($id);
		$this->data['purchase_form'] = json_decode($this->data['row']['purchase_form']);
		$this->load->model('member_model');
		$this->data['order_detail'] = $this->member_model->get_order($this->data['row']['member_order_id']);
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