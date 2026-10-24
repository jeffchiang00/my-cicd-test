<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model('global_model','global_model');
	}

	public function index(){
		$post = $this->input->post(NULL,TRUE);
		$MerchantNumber = $post['MerchantNumber'];
		$OrderNumber = $post['OrderNumber'];
		$PRC = $post['PRC'];
		$SRC = $post['SRC'];
		$Amount = $post['Amount'];
		$CheckSum = $post['CheckSum'];
		$ApprovalCode = $post['ApprovalCode'];
		$BankResponseCode = $post['BankResponseCode'];
		$BatchNumber = $post['BatchNumber'];		
		$Code = $this->config->item('credit_pwd');

		$chkstr = $MerchantNumber.$OrderNumber.$PRC.$SRC.$Code.$Amount;
		log_message('info',$chkstr);
		$chkstr = md5($chkstr);
		log_message('info',json_encode($post));
		log_message('info',$CheckSum);
		if($PRC=="0" && $SRC=="0"){
          	//-- 回傳成功，但結果有可能遭竄改，因此需和編碼內容比較
			if(strtolower($chkstr)==strtolower($CheckSum)){
				//交易成功
				$this->load->model('checkout_model');
				$this->checkout_model->payment_success($OrderNumber);
				log_message('info','交易成功');
			}else{
               	log_message('error','資料遭竄改');
			}
		}else if($PRC=="34" && $SRC=="171"){
			//交易失敗(金融失敗)
			log_message('error','交易失敗(金融失敗)');
		}else if($PRC=="8" && $SRC=="204"){
			//訂單編號重複
			log_message('error','訂單編號重複');
		}else if($PRC=="52" && $SRC=="554"){
			//使用者帳號密碼錯誤
			log_message('error','使用者帳號密碼錯誤');
		}else{
			//交易失敗(系統錯誤)
			if (isset($post['MerchantNumber'])>0){
				//log_message('error','交易失敗(系統錯誤)');
			}
		}
	}
}
// var frm = '<form id="payment_form" name="payment_form" action="https://testmaple2.neweb.com.tw/NewebmPP/cdcard.jsp" method=post>';
// 			frm += '<input type=hidden id="MerchantNumber" name="MerchantNumber" 	value="760319">';
// 			frm += '<input type=hidden id="OrderNumber" name="OrderNumber"    		value="14120200006">';
// 			frm += '<input type=hidden id="Amount" name="Amount"         			value="9160">';
// 			frm += '<input type=hidden id="OrgOrderNumber" name="OrgOrderNumber" 	value="14120200006">';
// 			frm += '<input type=hidden id="ApproveFlag" name="ApproveFlag"    		value="1">';
// 			frm += '<input type=hidden id="DepositFlag" name="DepositFlag"    		value="0">';
// 			frm += '<input type=hidden id="Englishmode" name="Englishmode"    		value="0">'; 
// 			frm += '<input type=hidden id="OrderURL" name="OrderURL"       		value="http://beta.gapure.com/payment/feedback">';
// 			frm += '<input type=hidden id="ReturnURL" name="ReturnURL"     		value="http://beta.gapure.com/tw/success">';
// 			frm += '<input type=hidden id="checksum" name="checksum"       		value="7163be4147a73bbc39abb76746c188e0">';
// 			frm += '<input type=hidden id="op" name="op"		           			value="AcceptPayment">';
// 			frm += '</form>';
// 			$('#payment_form').remove();
// 			$('body').append(frm);
// 			//document.payment_form.submit();