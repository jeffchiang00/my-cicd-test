<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs(){
        $sql = "SELECT x1 . * , x2.title_tw as type_title
            FROM  `" . tags . "` x1
            LEFT JOIN " . tags . " x2 ON x1.parentid = x2.id
            where x1.active=1 and x1.parentid>0 order by x1.sort,x1.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
        $sql = "select * from " . tags . " where active=1 and parentid>0 order by sort,id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_row($id=0){
        $sql = "select * from " . tags . " where id = '{$id}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function get_tags_type($parentid=0){
        $sql = "select *,(case when id='{$parentid}' then 1 else 0 end) as selected from " . tags . " where parentid in(0)";
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
            $sql = "INSERT INTO  " . tags . " (`id` ,`tag_type` , `title_en` , `title_tw` , `title_cn` , `description_en` , `description_tw` , `description_cn` , `parentid` , `sort` , `publish` , `active` , `thumbnail` , `url` ) VALUES (
                NULL ,  
                '',  
                '{$post['title_en']}',  
                '{$post['title_tw']}',  
                '{$post['title_cn']}',  
                '{$post['description_en']}',  
                '{$post['description_tw']}',  
                '{$post['description_cn']}',  
                '{$post['tags_type']}',  
                '0',  
                '{$post['publish']}',  
                '1',  
                '{$post['cover_img']}',  
                ''
                );";
            $this->db->query($sql);
            return $this->db->insert_id();
        }
        else{
            //edit
            $sql = "select * from " . tags . " where id='{$id}'";
            $query = $this->db->query($sql);
            if ($query->num_rows() == 0){
                echo 'alert("資料不存在");location="'.MODULE_URL.'"';
                exit;
            }
            $sql = "update " . tags . " set 
                title_en='{$post['title_en']}',  
                title_tw='{$post['title_tw']}',  
                title_cn='{$post['title_cn']}',  
                description_en='{$post['description_en']}',  
                description_tw='{$post['description_tw']}',  
                description_cn='{$post['description_cn']}',  
                parentid='{$post['tags_type']}', 
                publish='{$post['publish']}',  
                thumbnail='{$post['cover_img']}'  
                where id='{$id}'";
            $this->db->query($sql);
            return $id;
        }
    }

    public function del($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . tags . " set active='0' where id='{$id}'";
        $this->db->query($sql);
    }

    public function publish($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . tags . " set publish='{$post['publish']}' where id='{$id}'";
        $this->db->query($sql);
    }
}
?>