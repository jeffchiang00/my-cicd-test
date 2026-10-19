<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('cart');
		$this->post = $this->input->post(NULL,TRUE);

	}

	public function login(){
		$login = false;
		switch($this->post['member_type']){
			case 'fb':
				$login = $this->login_fb();
				break;
			case 'email':
				$login = $this->login_email();
				break;
		}
		return $login;
	}

	public function login_cookie(){
		$sql = "select * from member where email='{$_COOKIE["email"]}' and pwd='{$_COOKIE["pwd"]}' and active=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			$_SESSION[SITE_MEMBER_LOGIN] = $row['id'];
			$_SESSION[SITE_MEMBER_FIRST_NAME] = $row['first_name'];
			$_SESSION[SITE_MEMBER_LAST_NAME] = $row['last_name'];
			$_SESSION[SITE_MEMBER_EMAIL] = $row['email'];
			return true;
		}
		else{
			return false;
		}
	}

	private function login_email(){
		setcookie('email','',time()-3600);
		setcookie('pwd','',time()-3600);
		$sql = "select * from member where email='{$this->post['email']}' and pwd='{$this->post['pwd']}' and active=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			$_SESSION[SITE_MEMBER_LOGIN] = $row['id'];
			$_SESSION[SITE_MEMBER_FIRST_NAME] = $row['first_name'];
			$_SESSION[SITE_MEMBER_LAST_NAME] = $row['last_name'];
			$_SESSION[SITE_MEMBER_EMAIL] = $row['email'];
			if ($this->post['remember_login']=='1'){
				$this->load->helper('cookie');
				$this->input->set_cookie('email', $this->post['email'], 86500);
				$this->input->set_cookie('pwd', $this->post['pwd'], 86500);
			}
			return true;
		}
		else{
			return false;
		}
	}

	private function login_fb(){
		// $sql = "select * from member where email='{$this->post['email']}' and member_type='fb' and active=1";
		// $query = $this->db->query($sql);
		// if ($query->num_rows() > 0){
		// 	$row = $query->row_array();
		// 	$_SESSION[SITE_MEMBER_LOGIN] = $row['id'];
		// 	$_SESSION[SITE_MEMBER_FIRST_NAME] = $row['first_name'];
		// 	$_SESSION[SITE_MEMBER_LAST_NAME] = $row['last_name'];
		// 	$_SESSION[SITE_MEMBER_EMAIL] = $row['email'];
		// 	return true;
		// }
		// else{
		// 	return false;
		// }

		$sql = "select * from member where email='{$this->post['email']}' and member_type='fb' and active=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			$_SESSION[SITE_MEMBER_LOGIN] = $row['id'];
			$_SESSION[SITE_MEMBER_FIRST_NAME] = $row['first_name'];
			$_SESSION[SITE_MEMBER_LAST_NAME] = $row['last_name'];
			$_SESSION[SITE_MEMBER_EMAIL] = $row['email'];
			return true;
		}
		else{
			echo $sql = "insert into member(member_type,email,first_name,last_name,createtime,active) values(
				'fb',
				'{$this->post['email']}',
				'{$this->post['first_name']}',
				'{$this->post['last_name']}',
				'".date('Y-m-d H:i:s')."',
				1
				)";
			$query = $this->db->query($sql);
			$this->login_fb();
		}
	}

	public function member_reg(){
		$sql = "insert into member(email,member_type,first_name,last_name,pwd,createtime,active,member_addr) values(
			'{$this->post['reg_email']}',
			'',
			'{$this->post['reg_first_name']}',
			'{$this->post['reg_last_name']}',
			'{$this->post['reg_pwd']}',
			NOW(),
			1,
			'".($this->post['purchase_form'])."')";
		$this->db->query($sql);
		$this->db->affected_rows();
		if ($this->db->affected_rows()>0){
			$_SESSION[SITE_MEMBER_LOGIN] = $this->db->insert_id();
			$_SESSION[SITE_MEMBER_FIRST_NAME] = $this->post['reg_first_name'];
			$_SESSION[SITE_MEMBER_LAST_NAME] = $this->post['reg_last_name'];
			$_SESSION[SITE_MEMBER_EMAIL] = $this->post['reg_email'];
		}
	}

	public function get_order_rs(){
		switch ($_SESSION['lang']){
			case 'en':
				$col_status = 'name';
				break;
			case 'tw':
				$col_status = 'name2';
				break;
			case 'cn':
				$col_status = 'name3';
				break;
			default:
				$col_status = 'name';
				break;
		}
        $sql = "select x1.createtime,x1.member_order_id,total_amount,x2.{$col_status} as status,x1.id as purchase_id from " . purchase . " x1 
            inner join " . purchase_statuses . " x2 on x1.paystatus=x2.id 
            inner join " . member . " x3 on x1.member_id=x3.id
            left join (select purchase_id,sum(qty) as items from " . purchase_item . " group by purchase_id) x4 on x4.purchase_id=x1.id
            where x1.member_id='" . $_SESSION[SITE_MEMBER_LOGIN] . "'
            order by x1.id desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
	}

	public function get_order($order_id){
		$sql = "select *,x1.id as purchase_id from purchase x1 inner join member x2 on x1.member_id=x2.id where checkout_order_id='{$order_id}'";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			$result['master'] = $row;
			$sql = "select * from purchase_item where purchase_id='{$row['purchase_id']}'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				$result['detail'] = $this->get_purchase_item($query->result_array());
			}
			return $result;
		}else{
			return false;
		}
	}

	public function get_purchase_item($purchase_items){
		$cart = array();
        $this->load->model('product_model');
		foreach($purchase_items as $item){
			$product = $this->product_model->get_row($item['product_id']);
			$product_item = $this->product_model->get_product_item_for_cart($item['product_id'],$item['color_id'],$item['size']);
			$product_qty = 0;
			$product_item['max_qty'] = $product_item['qty']>10?10:$product_item['qty'];
			$product_item['title'] = $product['title'];
			$product_item['qty'] = $item['qty'];
			$product_item['product_price'] = $item['price'];
			$product_item['product_s_price'] = $item['special_price'];
			array_push($cart,$product_item);
		}
		return $cart;
	}

	public function get_rs($data){
        $search_key = $data['search_key'] == ''?'':" and (email like '%{$data['search_key']}%')";
		$sql = "select *,(select count(*) from purchase where member_id=member.id) as orders from member where active=1 {$search_key} order by createtime desc";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	public function get_member(){
		$sql = "select * from member where id='" . $_SESSION[SITE_MEMBER_LOGIN] . "' and active=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			//print_r($query->row_array());
			return $query->row_array();
		}
		else{
			return false;
		}

	}

	public function email_exist(){
		$exist = false;
		$sql = "select * from member where email='{$this->post['email']}' and active=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	public function save(){
		if ($_SESSION[SITE_MEMBER_LOGIN]==0){
			return false;
		}
		$str_pwd = '';
		if ($this->post['pwd']!=''){
			$str_pwd = ",pwd='{$this->post['pwd']}'";
		}
		$sql = "update member set 
			email='{$this->post['email']}',
			first_name='{$this->post['first_name']}',
			last_name='{$this->post['last_name']}',
			member_type='{$this->post['member_type']}',
			member_addr='{$this->post['purchase_form']}'
			{$str_pwd} 
			where active=1 and id='" . $_SESSION[SITE_MEMBER_LOGIN] . "'";
		$this->db->query($sql);
		if ($this->db->affected_rows()==1){
			$_SESSION[SITE_MEMBER_FIRST_NAME] = $this->post['first_name'];
			$_SESSION[SITE_MEMBER_LAST_NAME] = $this->post['last_name'];
			$_SESSION[SITE_MEMBER_EMAIL] = $this->post['email'];
			setcookie('email','',time()-3600);
			setcookie('pwd','',time()-3600);
			return true;
		}
		else{
			return false;
		}
	}

	public function forget(){
		$sql = "select * from member where email='{$this->post['email']}' and active=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$new_pwd = $this->generatorPassword();
			$sql = "update member set pwd='{$new_pwd}' where email='{$this->post['email']}' and active=1";
			$query = $this->db->query($sql);
			switch($this->uri->segment(1)){
				case 'tw':
				$this->mail_tw($new_pwd);
				break;
				case 'cn':
				$this->mail_cn($new_pwd);
				break;
				case 'en':
				$this->mail_en($new_pwd);
				break;
				default:
				$this->mail_en($new_pwd);
				break;
			}
			return true;
		}
		else{
			return false;
		}
	}

	private function mail_en($new_pwd){
		$this->email->set_mailtype('html');
		$this->email->from('service@gapure.com', 'Gapure');
		$this->email->to($this->post['email']);
		$this->email->subject('Get Password from Gapure');
		$this->email->message($this->mail_body_en($new_pwd));
		$this->email->send();
	}

	private function mail_tw($new_pwd){
		$this->email->set_mailtype('html');
		$this->email->from('service@gapure.com', 'Gapure');
		$this->email->to($this->post['email']);
		$this->email->subject('Gapure - 忘記密碼');
		$this->email->message($this->mail_body_tw($new_pwd));
		$this->email->send();
	}

	private function mail_cn($new_pwd){
		$this->email->set_mailtype('html');
		$this->email->from('service@gapure.com', 'Gapure');
		$this->email->to($this->post['email']);
		$this->email->subject('Gapure - 忘記密碼');
		$this->email->message($this->mail_body_cn($new_pwd));
		$this->email->send();
	}

	private function mail_body_en(){

	}

	private function mail_body_tw($new_pwd){
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
				<strong>親愛的顧客</strong><strong>您好：</strong><br/><br/>
				您在 GAPURE 的密碼已變更為' . $new_pwd . '。<br/>
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

	private function mail_body_cn($new_pwd){
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
				<strong>親愛的顧客</strong><strong>您好：</strong><br/><br/>
				您在 GAPURE 的密碼已變更為' . $new_pwd . '。<br/>
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

	private function generatorPassword()
	{
	    $password_len = 6;
	    $password = '';

	    // remove o,0,1,l
	    $word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
	    $len = strlen($word);

	    for ($i = 0; $i < $password_len; $i++) {
	        $password .= $word[rand() % $len];
	    }

	    return $password;
	}
}
?>