<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs(){
        $sql = "select * from " . admin_user . " where active=1 order by username";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_row($id=0){
        $sql = "select * from admin_user where id = '{$id}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function save($id=0){
        $post = $this->input->post(NULL, TRUE);
        if ($id==0){
            //insert
            $sql = "insert into " . admin_user . "(`id` ,`username` ,`password` ,`publish` ,`active`) values(NULL ,  '{$post['userid']}',  '{$post['userpwd']}',  '{$post['publish']}',  '1')";
            $this->db->query($sql);
            return $this->db->insert_id();
        }
        else{
            //edit
            $sql_pw = '';
            if ($post['userpwd']!=''){
                $sql_pw = ",password='".$post["userpwd"]."'";
            }
            $sql = "update " . admin_user . " set publish='{$post['publish']}' {$sql_pw} where id='{$id}'";
            $this->db->query($sql);
            return $id;
        }
    }

    public function del($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "delete from " . admin_user . " where id='{$id}'";
        $this->db->query($sql);
    }

    public function publish($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . admin_user . " set publish='{$post['publish']}' where id='{$id}'";
        $this->db->query($sql);
    }
}
?>