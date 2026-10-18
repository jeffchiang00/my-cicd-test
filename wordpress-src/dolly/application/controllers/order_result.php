<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_result extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function index(){
		if (isset($_POST['P_MerchantNumber'])){
			$this->load->model('member_model');
			$this->data['order_detail'] = $this->member_model->get_order($_POST['P_OrderNumber']);
			if ($this->data['order_detail']===false){
				$this->data['content_view'] = '<script>$(function(){site.echo("交易失敗")})</script>';
			}
			else{
				$this->data['content_view'] = $this->load->view('order_view',$this->data,true);
			}
			
			$this->load->view('master_view',$this->data);
		}
		else{
			show_404();
		}
	}
}
