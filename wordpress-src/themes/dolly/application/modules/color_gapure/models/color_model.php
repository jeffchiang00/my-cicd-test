<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Color_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs(){
        $sql = "SELECT x1 . *
            FROM  `" . product_color . "` x1
            where x1.active=1 order by x1.sort,x1.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_row($id=0){
        $sql = "select * from " . product_color . " where id = '{$id}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function get_tags_type($parentid=0){
        $sql = "select *,(case when id='{$parentid}' then 1 else 0 end) as selected from " . product_color . " where parentid in(0)";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function save($id=0){
        $post = $this->input->post(NULL, TRUE);
        $template_content = addslashes($this->input->post('template_content',FALSE));
        if ($id==0){
            //insert
            $sql = "INSERT INTO  " . product_color . " (`id` , `title_en` , `title_tw` , `title_cn` , `description_en` , `description_tw` , `description_cn` , `sort` , `publish` , `active` , `thumbnail` ) VALUES (
                NULL , 
                '{$post['title_en']}',  
                '{$post['title_tw']}',  
                '{$post['title_cn']}',  
                '',  
                '',  
                '',  
                '0',  
                '{$post['publish']}',  
                '1',  
                '{$post['cover_img']}'
                );";
            $this->db->query($sql);
            return $this->db->insert_id();
        }
        else{
            //edit
            $sql = "select * from " . product_color . " where id='{$id}'";
            $query = $this->db->query($sql);
            if ($query->num_rows() == 0){
                echo 'alert("資料不存在");location="'.MODULE_URL.'"';
                exit;
            }
            $sql = "update " . product_color . " set 
                title_en='{$post['title_en']}',  
                title_tw='{$post['title_tw']}',  
                title_cn='{$post['title_cn']}',  
                publish='{$post['publish']}',  
                thumbnail='{$post['cover_img']}'  
                where id='{$id}'";
            $this->db->query($sql);
            return $id;
        }
    }

    public function del($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . product_color . " set active='0' where id='{$id}'";
        $this->db->query($sql);
    }

    public function publish($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . product_color . " set publish='{$post['publish']}' where id='{$id}'";
        $this->db->query($sql);
    }
}
?>