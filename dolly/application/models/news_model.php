<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs($start_idx,$records,$type_id){
        $sql = "SELECT x1 . * , x2.title_cht as type_title
            FROM  `" . article . "` x1
            LEFT JOIN " . article_type . " x2 ON x1.type_id = x2.id
            where x1.publish=1 AND type_id={$type_id}
            order by x1.article_date desc,x1.id
            limit {$start_idx},{$records}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_row($id=0){
        $sql = "SELECT x1 . * , x2.title_en as type_title_en , x2.title_cht as type_title_tw , x2.title_chs as type_title_cn,
            (SELECT id FROM " . article . " WHERE article_date<=x1.article_date AND id<>x1.id ORDER BY article_date DESC,id LIMIT 0,1) AS next_id,
            (SELECT id FROM " . article . " WHERE article_date>=x1.article_date AND id<>x1.id ORDER BY article_date,id DESC LIMIT 0,1) AS prev_id
            FROM  `" . article . "` x1
            LEFT JOIN " . article_type . " x2 ON x1.type_id = x2.id
            where x1.id = '{$id}' and x1.publish=1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function get_next_prev($id){
        if ($id==null) return false;
        $sql = "select * from article where id='{$id}' and publish=1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function get_recommand($id){
        $title_col = 'title_'.$_SESSION['lang'];
        $sql_type_id = "SELECT type_id FROM article WHERE id={$id}";
        $query_type_id = $this->db->query($sql_type_id);
        $type_id_array =$query_type_id->result_array();
        $type_id = $type_id_array[0]['type_id'];
        $sql = "SELECT x1.id,x1.cover_img,x1.title_en,x1.title_tw,x1.title_cn,x1.{$title_col} as title FROM article x1
            WHERE x1.id<>{$id} AND type_id={$type_id}
            order by rand() limit 4";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }
}
?>