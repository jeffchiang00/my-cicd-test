<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_rs($start_idx,$records,$type_id=0){
    
         //SELECT a.*, b.* FROM `test1` as a, `test2` as b where a.id = b.id
        $sql = "SELECT x1 . *, x2.* , filename as cover_img
            FROM  `" . product . "` x1, `" . product_image . "` x2
            where x1.id=x2.product_id AND x2.sort=0 AND x1.publish=1 AND x1.type_id={$type_id}
            order by x1.article_date desc
            limit {$start_idx},{$records}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
        
        
    }

    public function get_row($id){
        $title_col = 'title_' . $_SESSION['lang'];
        $subtitle_col = 'subtitle_' . $_SESSION['lang'];
        $description_col = 'description_' . $_SESSION['lang'];
        $sql = "select *,
            {$title_col} as title,
            {$subtitle_col} as subtitle, 
            {$description_col} as description,
            isnull(x2.tag_id) as not_coffee 
            from " . product . " x1 left join product_tags_assoc x2 on x1.id=x2.product_id and x2.tag_id=11  where id='{$id}' and active=1 and publish=1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }
    
    public function get_all_brand_logo($start_idx,$records,$parentid=1){
        $sql = "select *, thumbnail as cover_img from tags x1
            where x1.parentid={$parentid} AND x1.active=1
            order by x1.title_tw
            limit {$start_idx},{$records}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_brand_logo($product_id){
        $sql = "select * from tags x1
            inner join product_tags_assoc x2 on x2.tag_id=x1.id and x2.product_id='{$product_id}'
            order by x1.sort,id
            limit 0,1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $row = $query->row_array();
            return $row['thumbnail'];
        }
        else{
            return false;
        }
    }

    public function get_gallery($product_id){
        $sql = "select * from " . product_image . " where product_id='{$product_id}' order by sort";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_recommand($id){
        $title_col = 'title_'.$_SESSION['lang'];
        $sql = "SELECT x1.id,x4.filename,x1.title_en,x1.title_tw,x1.title_cn,x1.{$title_col} as title FROM product x1
            INNER JOIN product_tags_assoc x2 ON x1.id=x2.product_id
            INNER JOIN product_tags_assoc x3 ON x3.tag_id=x2.tag_id AND x3.product_id={$id}
            INNER JOIN product_image x4 ON x1.id=x4.product_id AND x4.sort=0
            WHERE x1.id<>{$id}
            GROUP BY x1.id,x1.cover_img,x1.title_en,x1.title_tw,x1.title_cn limit 0,3";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_product_item($product_id){
        $title_col = 'title_'.$_SESSION['lang'];
        $sql = "select product_id,color_id,x2.{$title_col} as color_text,x2.thumbnail as color_img 
            from product_item x1 
            inner join product_color x2 on x1.color_id=x2.id and x2.active=1 
            where product_id='{$product_id}' and x1.active=1 
            group by x1.product_id,x1.color_id,x1.color_sort,x2.{$title_col},x2.thumbnail
            order by x1.color_sort";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->result_array();
            for($i=0;$i<count($result);$i++){
                //product_gallery
                $sql = "select filename from product_image where product_id='{$product_id}' and color_id='" . $result[$i]['color_id'] . "' order by sort";
                $query = $this->db->query($sql);
                $result[$i]['gallery'] = array();
                if ($query->num_rows() > 0){
                    $result[$i]['gallery'] = $query->result_array();
                }
                //product_item
                $sql = "select size,qty,coffee_taste from product_item where product_id='{$product_id}' and color_id='" . $result[$i]['color_id'] . "' and active=1 order by sort,id";
                $query = $this->db->query($sql);
                $result[$i]['items'] = array();
                if ($query->num_rows() > 0){
                    $result[$i]['items'] = $query->result_array();
                }
            }
            return $result;
        }
        else{
            return false;
        }
    }

    public function get_product_item_for_cart($product_id,$color_id,$size){
        $title_col = 'title_'.$_SESSION['lang'];
        $sql = "SELECT x1.*,x2.filename,x3.{$title_col} as color_title FROM product_item x1
            INNER JOIN product_image x2 ON x1.product_id=x2.product_id AND x1.color_id=x2.color_id AND x2.sort=0
            INNER JOIN product_color x3 ON x1.color_id=x3.id
            WHERE x1.active=1 AND x1.publish=1 AND x1.product_id='{$product_id}' AND x1.color_id='{$color_id}' AND x1.size='{$size}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }


}
?>