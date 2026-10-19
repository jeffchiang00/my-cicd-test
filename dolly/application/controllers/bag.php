<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bag extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function index(){
		$this->load->model('cart_model');
		$this->data['cart'] = $this->cart_model->get_cart_contents();
		if ($this->cart->total_items()==0){
			$this->data['content_view'] = '<script>
				$(function(){
					setTimeout(function(){
						site.echo("cart is empty!");location="'. SITE_URL . $_SESSION['lang'] . '/#index_pic";
					},200);
				})</script>';
		}
		else{
			$this->data['content_view'] = $this->load->view('bag_view',$this->data,true);	
		}
		
		$this->load->view('master_view',$this->data);
	}
}
