<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_contact(){
         $result = array();
         $sql = "select * from contact order by id DESC";
         $query = $this->db->query($sql);
         $result = $query->result_array();
         return $result;
         
    }
    public function del($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "delete from contact where id='{$id}'";
        $this->db->query($sql);
    }
    
    public function get_func_menu(){
        $result = array();
        $sql = "select * from " . admin_func . " where active=1 and parent_id=0 order by sort,id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->result_array();
            for($i=0;$i<count($result);$i++){
                $result[$i]['sub'] = array();
                $sql = "select * from " . admin_func . " where active=1 and parent_id='{$result[$i]['id']}' order by sort,id";
                $query_sub = $this->db->query($sql);
                if ($query->num_rows() > 0){
                    $result[$i]['sub'] = $query_sub->result_array();
                }
            }
            return $result;
            //print_r($result);
            //exit;
            //return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function do_login(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $sql = "select * from " . admin_user . " where username='{$username}' and password='{$password}'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function check_login($ref='')
    {
        if($_SESSION[ADMIN_SESSION]==0||!isset($_SESSION[ADMIN_SESSION]))
        {
            $this->admin_model->log('not login');
            header("location:".SITE_URL."admin/login?ref=".$ref);exit;
        }
    }

    public function get_module_info($module_name){
        $sql = "select * from " . admin_func . " where active=1 and url='{$module_name}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function log($str){
        $msg = array(
            ''.$str,
            'url:'.$this->uri->uri_string(),
            'ip:'.$this->admin_model->get_client_ip(),
            'userid:'.$_SESSION[ADMIN_SESSION]
            );
        log_message('info',implode('; ',$msg));
    }

    public function get_client_ip(){
        if (isset($_SERVER['HTTP_CLIENT_IP'])) { // check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { // to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
?>