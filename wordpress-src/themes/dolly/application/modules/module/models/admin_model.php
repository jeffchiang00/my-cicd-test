<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function do_login(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $sql = "select * from " . admin_user . " where username='{$username}' and password='{$password}'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function check_login()
    {
        if($_SESSION[ADMIN_SESSION]==0||!isset($_SESSION[ADMIN_SESSION]))
        {
            header("location:".SITE_URL."admin/login?ref=".$_SERVER['HTTP_REFERER']);exit;
        }
    }
}
?>