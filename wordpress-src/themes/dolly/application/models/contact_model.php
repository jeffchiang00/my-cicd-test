<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function set_contact(){
         $data = array(
      		'subject' => $this->input->post('subject'),
      		'name' => $this->input->post('name'),
            'company' => $this->input->post('company'),
            'email' => $this->input->post('email'),
      		'message' => $this->input->post('message')
      	);
      	return $this->db->insert('contact', $data);
    }
}
?>