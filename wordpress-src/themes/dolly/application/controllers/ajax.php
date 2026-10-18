<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function add2cart(){
		$this->load->model('cart_model');
		$this->cart_model->insert();
	}

	public function update_cart(){
		$this->load->model('cart_model');
		$this->cart_model->update_cart();
	}

	public function cart_destroy(){
		$this->cart->destroy();
	}

	public function member_login(){
		$this->load->model('member_model');
		$login = $this->member_model->login();
		echo $login==true?1:0;
	}

	public function member_logout(){
		session_unset();
		$this->load->helper('cookie');
		$this->input->set_cookie('email', '', -86500);
		$this->input->set_cookie('pwd', '', -86500);
	}

	public function member_save(){
		$this->load->model('member_model');
		$save = $this->member_model->save();
		echo 'site.echo("儲存成功");location.reload();';
	}

	public function checkout(){
		$this->load->model('checkout_model');
		$this->checkout_model->order();
	}

	public function check_email(){
		$this->load->model('member_model');
		$email_exist = $this->member_model->email_exist();
		echo $email_exist==true?1:0;
	}

	public function member_forget(){
		$this->load->model('member_model');
		$exist = $this->member_model->forget();
		echo $exist==true?1:0;
	}
}
