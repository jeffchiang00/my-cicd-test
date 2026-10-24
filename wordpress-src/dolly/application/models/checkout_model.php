<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Checkout_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('cart');
		$this->post = $this->input->post(NULL,TRUE);
	}

	public function order(){
		$this->check_login();
		$this->check_qty();
		$this->count_total_amount();
		$this->save_order_master();
		$this->save_order_detail();
		$this->update_qty();
		//echo 'alert("測試訂單完成，請至後台訂單管理核對金額")';
		//exit;
		switch($this->uri->segment(1)){
			case 'tw':
			$this->order_mail_tw();
			break;
			case 'cn':
			$this->order_mail_cn();
			break;
			case 'en':
			$this->order_mail_en();
			break;
			default:
			$this->order_mail_en();
			break;
		}
		$this->order_form_credit_card();
		$this->cart->destroy();
	}

	private function order_mail_en(){
		$this->email->set_mailtype('html');
		$this->email->from('service@gapure.com', 'Gapure');
		$this->email->to($_SESSION[SITE_MEMBER_EMAIL]);
		$this->email->subject('Order Confirm from Gapure');
		$this->email->message($this->order_mail_body_en());
		$this->email->send();
	}

	private function order_mail_tw(){
		$this->email->set_mailtype('html');
		$this->email->from('service@gapure.com', 'Gapure');
		$this->email->to($_SESSION[SITE_MEMBER_EMAIL]);
		$this->email->subject('Gapure - 訂單通知');
		$this->email->message($this->order_mail_body_tw());
		$this->email->send();
	}

	private function order_mail_cn(){
		$this->email->set_mailtype('html');
		$this->email->from('service@gapure.com', 'Gapure');
		$this->email->to($_SESSION[SITE_MEMBER_EMAIL]);
		$this->email->subject('Gapure - 訂單通知');
		$this->email->message($this->order_mail_body_cn());
		$this->email->send();
	}

	private function order_mail_body_en(){
		$sql = "select * from purchase where checkout_order_id='".$this->checkout_order_id."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		$createtime = strtotime($row->createtime);
		$purchase_form = json_decode($this->post['purchase_form']);
		$addr = $purchase_form->shipping_zipcode . 
			$purchase_form->shipping_country . 
			$purchase_form->shipping_province .
			$purchase_form->shipping_city .
			$purchase_form->shipping_area .
			$purchase_form->shipping_address;
		$mobile = $purchase_form->shipping_mobile;
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>無標題文件</title>
			<style type="text/css">
				body {
				font-family: "Gill Sans MT", "微軟正黑體";
				font-size: 14px;
				color: #000;
				line-height: 1.5em;
			}
				a:link {
				text-decoration: none;
			}
				a:visited {
				text-decoration: none;
			}
				a:hover {
				text-decoration: underline;
			}
			.mgb-20 {
				margin-bottom: 20px;
			}
				.mgr-50 {margin-right: 50px;}
				.box1 {
				float: left;
				width: 450px;
				float: left;
				text-align: center;
			}
			.box_t {
				width: 450px;
				border-top-width: 1px;
				border-right-width: 1px;
				border-bottom-width: 1px;
				border-left-width: 1px;
				border-bottom-style: dotted;
				border-top-color: #999;
				border-right-color: #999;
				border-bottom-color: #999;
				border-left-color: #999;
				margin-bottom: 20px;
				padding-bottom: 20px;
				text-align: center;
			}
				.box2 {float:left;width:240px;height:240px;padding:30px;background-color:#ff17a3;color:#FFF;}
				.ft-peach {color:#ff3493;}
				.ft-32{font-size:32px;}
				a:active {
				text-decoration: none;
			}
			</style>
			</head>
			<body>
			<div class="box_t">
				<span class="mgb-20"><img src="'.SITE_URL.'assets/images/logo.jpg" width="400" height="80"/>
			</div>
			<div class="box1 mgb-20 mgr-50">
				<strong>Dear Customer</strong> '.$_SESSION[SITE_MEMBER_LAST_NAME] . $_SESSION[SITE_MEMBER_FIRST_NAME].'： <br/><br/>
				Your order has been received, we will arrange the shipping as soon as possible. <br/>
				<br/>
				If you want to check the order status, please login in and click the account email on the upper right side. Please feel free to contact us if you have any questions, thank you.<br/>
				<br/><b>Order Number:</b><br/>
				'.$this->checkout_order_id.' <br/><b>Address:<br/>
				</b>'.$addr.' <br/><b>Phone Number:<br/>
				</b>'.$mobile.' <br/><b>Paid by:<br/>
				</b>CREDIT CARD <br/><b><br/>
				If you have any questions, please contact our customer service cente.<br/><br/>
				Carry Me Customer Service Center<br/>
				<a href="mailto:service@gapure.com">service@gapure.com</a>
				<br/>
				<br/>
			</div>
			</body>
			</html>';

		return $body;
	}

	private function order_mail_body_tw(){
		$sql = "select * from purchase where checkout_order_id='".$this->checkout_order_id."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		$createtime = strtotime($row->createtime);
		$purchase_form = json_decode($this->post['purchase_form']);
		$addr = $purchase_form->shipping_zipcode . 
			$purchase_form->shipping_country . 
			$purchase_form->shipping_province .
			$purchase_form->shipping_city .
			$purchase_form->shipping_area .
			$purchase_form->shipping_address;
		$mobile = $purchase_form->shipping_mobile;
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>無標題文件</title>
			<style type="text/css">
				body {
				font-family: "Gill Sans MT", "微軟正黑體";
				font-size: 14px;
				color: #000;
				line-height: 1.8em;
			}
				a:link {
				text-decoration: none;
			}
				a:visited {
				text-decoration: none;
			}
				a:hover {
				text-decoration: underline;
			}
			.mgb-20 {
				margin-bottom: 20px;
			}
				.mgr-50 {margin-right: 50px;}
				.box1 {
				float: left;
				width: 450px;
				float: left;
				text-align: center;
			}
				.box2 {float:left;width:240px;height:240px;padding:30px;background-color:#ff17a3;color:#FFF;}
				.ft-peach {color:#ff3493;}
				.ft-32{font-size:32px;}
				a:active {
				text-decoration: none;
			}
			</style>
			</head>
			<body>
			<div class="mgb-20">
				<img src="' . SITE_URL . 'assets/images/logo.jpg" width="400" height="80"/>
			</div>
			<div class="box1 mgb-20 mgr-50">
				<strong>親愛的顧客</strong> ' . $_SESSION[SITE_MEMBER_LAST_NAME] . $_SESSION[SITE_MEMBER_FIRST_NAME] . ' <strong>您好：</strong><br/><br/>
				您的訂單 GAPURE 已收到。我們會立即為您安排出貨事宜。<br/>
				<br/>
				欲查詢訂單狀態，請登入 GAPURE 官網，點選右上方帳號處可進入歷史訂購頁面，如有其他任何問題，請立即與我們聯絡，謝謝。<br/>
				<br/>
				<br/>
				<strong>訂單編號：</strong><br/>'.$this->checkout_order_id.' <br/>
				<strong>收件地址：</strong><br/>'.$addr.'<br/>
				<strong>聯絡電話：</strong><br/>'.$mobile.' <br/>
				<strong>付款方式：</strong><br/>信用卡 <br/>
				<br/>
				如果您有任何疑問，請與我們聯絡查詢<br/>
				<br/>
				GAPURE 客服中心敬上<br/>
				<a href="mailto:service@gapure.com">service@gapure.com</a><br/>
				<br/>
				<br/>
			</div>
			</body>
			</html>';

		return $body;
	}

	private function order_mail_body_cn(){
		$sql = "select * from purchase where checkout_order_id='".$this->checkout_order_id."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		$createtime = strtotime($row->createtime);
		$purchase_form = json_decode($this->post['purchase_form']);
		$addr = $purchase_form->shipping_zipcode . 
			$purchase_form->shipping_country . 
			$purchase_form->shipping_province .
			$purchase_form->shipping_city .
			$purchase_form->shipping_area .
			$purchase_form->shipping_address;
		$mobile = $purchase_form->shipping_mobile;
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>無標題文件</title>
			<style type="text/css">
				body {
				font-family: "Gill Sans MT", "微軟正黑體";
				font-size: 14px;
				color: #000;
				line-height: 1.8em;
			}
				a:link {
				text-decoration: none;
			}
				a:visited {
				text-decoration: none;
			}
				a:hover {
				text-decoration: underline;
			}
			.mgb-20 {
				margin-bottom: 20px;
			}
				.mgr-50 {margin-right: 50px;}
				.box1 {
				float: left;
				width: 450px;
				float: left;
				text-align: center;
			}
				.box2 {float:left;width:240px;height:240px;padding:30px;background-color:#ff17a3;color:#FFF;}
				.ft-peach {color:#ff3493;}
				.ft-32{font-size:32px;}
				a:active {
				text-decoration: none;
			}
			</style>
			</head>
			<body>
			<div class="mgb-20">
				<img src="' . SITE_URL . 'assets/images/logo.jpg" width="400" height="80"/>
			</div>
			<div class="box1 mgb-20 mgr-50">
				<strong>親愛的顧客</strong> ' . $_SESSION[SITE_MEMBER_LAST_NAME] . $_SESSION[SITE_MEMBER_FIRST_NAME] . ' <strong>您好：</strong><br/><br/>
				您的訂單 GAPURE 已收到。我們會立即為您安排出貨事宜。<br/>
				<br/>
				欲查詢訂單狀態，請登入 GAPURE 官網，點選右上方帳號處可進入歷史訂購頁面，如有其他任何問題，請立即與我們聯絡，謝謝。<br/>
				<br/>
				<br/>
				<strong>訂單編號：</strong><br/>'.$this->checkout_order_id.' <br/>
				<strong>收件地址：</strong><br/>'.$addr.'<br/>
				<strong>聯絡電話：</strong><br/>'.$mobile.' <br/>
				<strong>付款方式：</strong><br/>信用卡 <br/>
				<br/>
				如果您有任何疑問，請與我們聯絡查詢<br/>
				<br/>
				GAPURE 客服中心敬上<br/>
				<a href="mailto:service@gapure.com">service@gapure.com</a><br/>
				<br/>
				<br/>
			</div>
			</body>
			</html>';

		return $body;
	}

	private function check_login(){
		$this->load->helper('language');
		if (!isset($_SESSION[SITE_MEMBER_LOGIN]) || $_SESSION[SITE_MEMBER_LOGIN]==0){
			//echo 'alert("'. lang('cm_cart_error_login').'");location.reload();';
			$this->load->model('member_model');
			$this->member_model->member_reg();
			if ($_SESSION[SITE_MEMBER_LOGIN]==0){
				echo 'site.echo("請登入帳號");//location.reload();';
				exit;
			}
		}
	}
	private function check_qty(){
		$this->cart_max_qty = $this->get_max_qty();
		foreach($this->cart->contents() as $item){
			if ($item['qty']>$this->cart_max_qty[$item['rowid']]){
				echo 'site.echo("數量不足");is_send=false;';
				echo '$(\'#checkout input[type="submit"]\').attr(\'disabled\',false);';
				exit;
			}
		}
	}

	private function get_max_qty(){
		$max_qty = array();
		foreach($this->cart->contents() as $item){
			$sql = "select * from product_item where product_id='{$item['id']}' and color_id='".$item['options']['color']."' and size='{$item['options']['size']}' and active=1";
			$query = $this->db->query($sql);
			$row = $query->row();
			$qty = $row->qty;
			$max_qty[$item['rowid']] = $qty;
		}
		return $max_qty;
	}

	private function count_total_amount(){
		$total = $this->cart->total();
		$total += (int)$this->post['shipping'];
		$this->total_amount = $total;
	}
	private function save_order_master(){
		$temp_order_no = date('y').date('m').date('d');
		$sql = "select * from purchase where checkout_order_id like '{$temp_order_no}%' order by checkout_order_id desc";
		$query = $this->db->query($sql);
		if ($query->num_rows()>0){
			$row = $query->row();
			$checkout_order_id = $row->checkout_order_id;
			$sn = (int)substr($checkout_order_id,-5) + 1;
			$this->checkout_order_id = $temp_order_no . substr("00000" . $sn,-5);
		}
		else{
			$this->checkout_order_id = $temp_order_no . '00001';
		}
		$sql = "insert into purchase(member_id,total_amount,shipping,add_shipping,createtime,member_order_id,checkout_order_id,payment,paystatus,purchase_form,discount) values(
			'" . $_SESSION[SITE_MEMBER_LOGIN] . "',
			'{$this->total_amount}',
			'{$this->post['shipping']}',
			'0',
			'".date('Y-m-d H:i:s')."',
			'{$this->checkout_order_id}',
			'{$this->checkout_order_id}',
			'1',
			'1',
			'".($this->post['purchase_form'])."',
			'')";
		$sql = str_replace("\\u", "\\\u", $sql);
		$this->db->query($sql);
		if ($this->db->affected_rows()==0){
			log_message('info','error sql - '.$sql);
			echo 'site.echo("交易失敗，請重新操作。");is_send=false;';
			//echo '$(\'#checkout input[type="submit"]\').attr(\'disabled\',false);';
			exit;
		}
		$this->order_id = $this->db->insert_id();
	}

	private function save_order_detail(){
		$index = 0;
		$sql = "insert into purchase_item(purchase_id,product_id,color_id,size,qty,price,sku) values";
		foreach($this->cart->contents() as $key => $item){
			$color_id = $item['options']['color'];
			if($index =='0'){
				$sql.=" (
					'{$this->order_id}',
					'{$item['id']}',
					(select id from product_color where id='{$color_id}'),
					'{$item['options']['size']}',
					'{$item['qty']}',
					'{$item['price']}',
					(select sku from product_item where product_id='{$item['id']}' and color_id=(select id from product_color where id='{$color_id}') and size='{$item['options']['size']}' and active=1)
					)";
			}else{
				$sql.=",(
					'{$this->order_id}',
					'{$item['id']}',
					(select id from product_color where id='{$color_id}'),
					'{$item['options']['size']}',
					'{$item['qty']}',
					'{$item['price']}',
					(select sku from product_item where product_id='{$item['id']}' and color_id=(select id from product_color where id='{$color_id}') and size='{$item['options']['size']}' and active=1)
					)";
			}
			$index++;
		}
		$sql = $sql;
		$this->db->query($sql);
		if ($this->db->affected_rows()==0){
			log_message('info','error sql - '.$sql);
			echo 'site.echo("交易失敗，請重新操作。");is_send=false;';
			echo '$(\'#checkout input[type="submit"]\').attr(\'disabled\',false);';
			exit;
		}
	}
	private function update_qty(){
		foreach($this->cart->contents() as $item){
			$color_id = $item['options']['color'];
			$sql = "update product_item set qty=qty-{$item['qty']} where product_id='{$item['id']}' and color_id=(select id from product_color where id='{$color_id}') and size='{$item['options']['size']}'";
			$this->db->query($sql);
		}
	}
	private function order_form_credit_card(){
		$credit_id = $this->config->item('credit_id');
		$credit_pwd = $this->config->item('credit_pwd');
		$order_id = $this->checkout_order_id;
		$amount = $this->total_amount;
		log_message('info',$credit_id.$order_id.$credit_pwd.$amount);
		echo '
			var frm = \'<form id="payment_form" name="payment_form" action="' . $this->config->item('credit_url') . '" method=post>\';
			frm += \'<input type=hidden id="MerchantNumber" name="MerchantNumber" 	value="' . $credit_id . '">\';
			frm += \'<input type=hidden id="OrderNumber" name="OrderNumber"    		value="' . $order_id . '">\';
			frm += \'<input type=hidden id="Amount" name="Amount"         			value="' . $amount . '">\';
			frm += \'<input type=hidden id="OrgOrderNumber" name="OrgOrderNumber" 	value="' . $order_id . '">\';
			frm += \'<input type=hidden id="ApproveFlag" name="ApproveFlag"    		value="1">\';
			frm += \'<input type=hidden id="DepositFlag" name="DepositFlag"    		value="0">\';
			frm += \'<input type=hidden id="Englishmode" name="Englishmode"    		value="0">\'; 
			frm += \'<input type=hidden id="OrderURL" name="OrderURL"       		value="' . SITE_URL . 'payment/feedback' . '">\';
			frm += \'<input type=hidden id="ReturnURL" name="ReturnURL"     		value="' . SITE_URL . $_SESSION['lang'] . '/order_result' . '">\';
			frm += \'<input type=hidden id="checksum" name="checksum"       		value="' . md5($credit_id.$order_id.$credit_pwd.$amount) . '">\';
			frm += \'<input type=hidden id="op" name="op"		           			value="AcceptPayment">\';
			frm += \'</form>\';
			$(\'#payment_form\').remove();
			$(\'body\').append(frm);
			document.payment_form.submit();';
	}

	public function payment_success($member_order_id){
		$sql = "update purchase set paystatus=2 where member_order_id='{$member_order_id}'";
		$this->db->query($sql);
	}
}
?>