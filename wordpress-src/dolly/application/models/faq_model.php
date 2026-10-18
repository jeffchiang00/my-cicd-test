<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs($url=""){
        $sql = "SELECT * FROM  `" . faq . "`
            where url = '{$url}' AND publish=1
            order by article_date desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_rs_by_type($type_id){
        $sql = "SELECT x1 . * , x2.title_cht as type_title
            FROM  `" . faq . "` x1
            LEFT JOIN " . article_type . " x2 ON x1.type_id = x2.id
            where x1.type_id='{$type_id}'
            order by x1.article_date desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_row($id=0){
        $sql = "select * from " . faq . " where id = '{$id}'";
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
        $template_content = addslashes($this->input->post('template_content',FALSE));
        if ($id==0){
            //insert
            $sql = "INSERT INTO " . faq . " (`id`, `cover_img`, `type_id`, `article_date`, `title_en`, `title_tw`, `title_cn`, `template_content`, `url`, `publish`) VALUES (
                NULL, 
                '{}', 
                '{}', 
                '{}', 
                '{$post['title_en']}', 
                '{$post['title_tw']}', 
                '{$post['title_cn']}', 
                '{$template_content}', 
                '', 
                '{$post['publish']}');";
            $this->db->query($sql);
            return $this->db->insert_id();
        }
        else{
            //edit
            $sql = "select * from " . faq . " where id='{$id}'";
            $query = $this->db->query($sql);
            if ($query->num_rows() == 0){
                echo 'alert("資料不存在");location="'.MODULE_URL.'"';
                exit;
            }
            $sql = "update " . faq . " set 
                cover_img='', 
                type_id='', 
                article_date='', 
                title_en='{$post['title_en']}', 
                title_tw='{$post['title_tw']}', 
                title_cn='{$post['title_cn']}', 
                template_content='{$template_content}', 
                publish='{$post['publish']}' 
                where id='{$id}'";
            $this->db->query($sql);
            return $id;
        }
    }

    public function del($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "delete from " . faq . " where id='{$id}'";
        $this->db->query($sql);
    }

    public function publish($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . faq . " set publish='{$post['publish']}' where id='{$id}'";
        $this->db->query($sql);
    }
}
?>