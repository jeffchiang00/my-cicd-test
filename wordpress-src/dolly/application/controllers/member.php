<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function index(){

		if ($_SESSION[SITE_MEMBER_LOGIN]==0){
			show_404();
			exit;
		}
        $this->load->model('member_model');
        $this->data['member_data'] = $this->member_model->get_member();
        $this->data['member_order'] = $this->member_model->get_order_rs();
		$this->data['member_order'] = $this->data['member_order']===false?array():$this->data['member_order'];
		$this->load->model('cart_model');
		$this->data['shipping_data'] = $this->cart_model->get_shipping_data();
		$this->data['content_view'] = $this->load->view('member_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}
}
