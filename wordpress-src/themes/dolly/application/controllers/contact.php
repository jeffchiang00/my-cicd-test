<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
    }

	public function index(){
		$name = $_POST['inputname'];//$this->input->post('inputname');
		$email = $_POST['inputemail'];//$this->input->post('inputemail');
		$phone = $_POST['inputphone'];//$this->input->post('inputphone');
		$message = $_POST['inputmessage'];//$this->input->post('inputmessage');
		$submit = $_POST['submit'];//$this->input->post('submit');

		$this->load->library('email');
	    $config['protocol'] = 'smtp';
	    $config['smtp_host'] = 'ssl://smtp.gmail.com';
	    $config['smtp_port'] = '465';
	    $config['smtp_user'] = 'frencyliu@gmail.com';  //change it
	    $config['smtp_pass'] = 'hhknfkfzwteayycq'; //change it
	    $config['charset'] = 'utf-8';
	    $config['newline'] = "\r\n";
	    $config['mailtype'] = 'text';
	    $config['wordwrap'] = TRUE;

	    $this->email->initialize($config);
	    $this->email->from($email);   //change it
	    $this->email->to('dollycrazylab@gmail.com');       //
	    $list = array('frencyliu@gmail.com', 'purple3377@gmail.com', 'Loagn03@gmail.com');
	    $this->email->cc($list);
	    $this->email->subject($name . "給dolly留言瞜");


	    if($message != ""){
		    	$this->email->message(
		    	"姓名：" . $name . 
		    	"\r\nEMAIL：" . $email . 
		    	"\r\n手機：" . $phone . 
		    	"\r\n留言：" . $message
		    );
		    if ($this->email->send()) {
		        echo "<br>" . var_dump($name) . "<br>" . var_dump($email) . "<br>" . var_dump($phone) . "<br>" . var_dump($message) . "<br>" . var_dump($submit);
		        echo '123';
		    } else {
		        $data['success'] = 0;
		        $data['error'] = $this->email->print_debugger(array('headers'));
		    }
	    }
	    
	
		
	}
}
