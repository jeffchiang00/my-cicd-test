<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs(){
        $sql = "SELECT x1 . * , x2.title_cht as type_title
            FROM  `" . article . "` x1
            LEFT JOIN " . article_type . " x2 ON x1.type_id = x2.id
            order by x1.article_date desc";
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
            FROM  `" . article . "` x1
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
        $sql = "select * from " . article . " where id = '{$id}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function get_brand_tags($article_id){
        $sql = "SELECT * , (
            CASE WHEN x2.article_id IS NULL 
            THEN 0 
            ELSE 1 
            END
            ) AS selected
            FROM tags x1
            LEFT JOIN " . article_tags_assoc . " x2 ON x2.tag_id = x1.id
            AND x2.article_id ='{$article_id}'
            WHERE x1.parentid =1 and x1.active=1";
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
            $sql = "INSERT INTO " . article . " (`id`, `cover_img`, `type_id`, `small_type_id`, `article_date`, `title_en`, `title_tw`, `title_cn`, `template_content`, `youtube_url`, `publish`) VALUES (
                NULL, 
                '{$post['cover_img']}', 
                '{$post['type_id']}', 
                '{$post['small_type_id']}', 
                '{$post['article_date']}', 
                '{$post['title_en']}', 
                '{$post['title_tw']}', 
                '{$post['title_cn']}', 
                '{$template_content}', 
                '{$post['youtube_url']}', 
                '{$post['publish']}');";
            $this->db->query($sql);
            $id = $this->db->insert_id();
            $this->save_brand($id);
            return $id;
        }
        else{
            //edit
            $sql = "select * from " . article . " where id='{$id}'";
            $query = $this->db->query($sql);
            if ($query->num_rows() == 0){
                echo 'alert("資料不存在");location="'.MODULE_URL.'"';
                exit;
            }
            $sql = "update " . article . " set 
                cover_img='{$post['cover_img']}', 
                type_id='{$post['type_id']}', 
                small_type_id='{$post['small_type_id']}', 
                article_date='{$post['article_date']}', 
                title_en='{$post['title_en']}', 
                title_tw='{$post['title_tw']}', 
                title_cn='{$post['title_cn']}', 
                template_content='{$template_content}', 
                youtube_url='{$post['youtube_url']}',
                publish='{$post['publish']}' 
                where id='{$id}'";
            $this->db->query($sql);
            $this->save_brand($id);
            return $id;
        }

    }

    private function save_brand($id){
        $brand_selected = $this->input->post('brand', TRUE);
        $sql = "delete from " . article_tags_assoc . " where article_id='{$id}'";
        $this->db->query($sql);
        if (is_array($brand_selected)){
            foreach($brand_selected as $brand_id){
                $sql = "insert into " . article_tags_assoc . " values('{$id}','{$brand_id}')";
                $this->db->query($sql);
            }
        }
    }

    public function del($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "delete from " . article . " where id='{$id}'";
        $this->db->query($sql);
    }

    public function publish($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . article . " set publish='{$post['publish']}' where id='{$id}'";
        $this->db->query($sql);
    }
}
?>