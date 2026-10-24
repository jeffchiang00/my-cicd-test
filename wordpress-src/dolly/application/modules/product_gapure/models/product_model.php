<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs(){
        $sql = "SELECT x1 . * , x2.title_cht as type_title
            FROM  `" . product . "` x1
            LEFT JOIN " . article_type . " x2 ON x1.type_id = x2.id
            where x1.active=1
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
            FROM  `" . product . "` x1
            LEFT JOIN " . article_type . " x2 ON x1.type_id = x2.id
            where x1.type_id='{$type_id}' and active=1
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
        $sql = "select * from " . product . " where id = '{$id}' and active=1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function get_brand_tags($product_id){
        $sql = "SELECT * , (
            CASE WHEN x2.product_id IS NULL 
            THEN 0 
            ELSE 1 
            END
            ) AS selected
            FROM tags x1
            LEFT JOIN " . product_tags_assoc . " x2 ON x2.tag_id = x1.id
            AND x2.product_id ='{$product_id}'
            WHERE x1.parentid >0
            AND x1.active=1
            ORDER BY x1.parentid";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_color_list(){
        $sql = "select * from " . product_color . " where active=1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
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

    public function _get_product_item($product_id){
        $sql = "select * from " . product_item . " where product_id='{$product_id}' and active=1 order by sort,id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_product_item($product_id){
        $sql = "select product_id,color_id,x2.title_tw as color_text 
            from product_item x1 
            inner join product_color x2 on x1.color_id=x2.id and x2.active=1 
            where product_id='{$product_id}' and x1.active=1 
            group by x1.product_id,x1.color_id,x1.color_sort,x2.title_tw
            order by x1.color_sort";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->result_array();
            for($i=0;$i<count($result);$i++){
                //product_gallery
                $sql = "select * from product_image where product_id='{$product_id}' and color_id='" . $result[$i]['color_id'] . "' order by sort";
                $query = $this->db->query($sql);
                $result[$i]['gallery'] = array();
                if ($query->num_rows() > 0){
                    $result[$i]['gallery'] = $query->result_array();
                }
                //product_item
                $sql = "select * from product_item where product_id='{$product_id}' and color_id='" . $result[$i]['color_id'] . "' and active=1 order by sort,id";
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

    public function save($id=0){
        $post = $this->input->post(NULL, TRUE);
        $template_content = addslashes($this->input->post('template_content',FALSE));
        $description_en = addslashes($this->input->post('description_en',FALSE));
        $description_tw = addslashes($this->input->post('description_tw',FALSE));
        $description_cn = addslashes($this->input->post('description_cn',FALSE));
        if ($id==0){
            //insert
            $sql = "INSERT INTO " . product . " (`id`, `cover_img`, `type_id`, `article_date`, `title_en`, `title_tw`, `title_cn`, `description_en`, `description_tw`, `description_cn`, `template_content`, `url`, `active`, `publish`, `createtime`, `edittime`, `price`, `special_price`, `subtitle_en`, `subtitle_tw`, `subtitle_cn`) VALUES (
                NULL, 
                '', 
                '', 
                '{$post['article_date']}', 
                '{$post['title_en']}', 
                '{$post['title_tw']}', 
                '{$post['title_cn']}', 
                '{$post['description_en']}', 
                '{$post['description_tw']}', 
                '{$post['description_cn']}', 
                '{$template_content}', 
                '', 
                1, 
                '{$post['publish']}', 
                NOW(), 
                NOW(),
                '{$post['price']}',
                '{$post['s_price']}',
                '{$post['subtitle_en']}',
                '{$post['subtitle_tw']}',
                '{$post['subtitle_cn']}');";
            $this->db->query($sql);
            $id = $this->db->insert_id();
            $this->save_brand($id);
            $this->save_product_item($id);
            return $id;
        }
        else{
            //edit
            $sql = "select * from " . product . " where id='{$id}'";
            $query = $this->db->query($sql);
            if ($query->num_rows() == 0){
                echo 'alert("資料不存在");location="'.MODULE_URL.'"';
                exit;
            }
            $sql = "update " . product . " set 
                cover_img='', 
                article_date='{$post['article_date']}', 
                title_en='{$post['title_en']}', 
                title_tw='{$post['title_tw']}', 
                title_cn='{$post['title_cn']}', 
                description_en='{$description_en}', 
                description_tw='{$description_tw}', 
                description_cn='{$description_cn}', 
                template_content='{$template_content}', 
                publish='{$post['publish']}', 
                edittime=NOW(), 
                price='{$post['price']}', 
                special_price='{$post['s_price']}', 
                subtitle_en='{$post['subtitle_en']}', 
                subtitle_tw='{$post['subtitle_tw']}', 
                subtitle_cn='{$post['subtitle_cn']}' 
                where id='{$id}'";
            $this->db->query($sql);
            $this->save_brand($id);
            $this->save_product_item($id);
            return $id;
        }

    }

    private function save_brand($id){
        $brand_selected = $this->input->post('brand', TRUE);
        $sql = "delete from " . product_tags_assoc . " where product_id='{$id}'";
        $this->db->query($sql);
        if (is_array($brand_selected)){
            foreach($brand_selected as $brand_id){
                $sql = "insert into " . product_tags_assoc . " values('{$id}','{$brand_id}')";
                $this->db->query($sql);
            }
        }
    }

    private function save_gallery($product_id,$color_id,$gallery){
        $sql = "delete from " . product_image . " where product_id='{$product_id}' and color_id='{$color_id}'";
        $this->db->query($sql);
        $idx = 0;
        if (is_array($gallery)){
            foreach($gallery as $img){
                $sql = "insert into " . product_image . " values('{$product_id}','{$color_id}','{$img}','{$idx}')";
                $this->db->query($sql);
                $idx++;
            }
        }
    }

    public function save_product_item($product_id){
        $product_item = json_decode($this->input->post('product_item', TRUE));
        //print_r($product_item);exit;
        $color_idx = 0;
        foreach($product_item as $color){
            $color_id = $color->color_id;
            //寫入product_gallery
            $this->save_gallery($product_id,$color_id,$color->gallery);

            $arr_item_id = array();
            foreach($color->items as $item){
                array_push($arr_item_id,$item->itemid);
            }
            //停用ID不存在的ITEM
            if (count($arr_item_id)>0){
                $sql = "update " . product_item . " set active=0,edittime=NOW() where product_id='{$product_id}' and color_id='{$color_id}' and id not in(" . implode(',',$arr_item_id) . ") and active=1";
                $this->db->query($sql);
            }
            else{
                $sql = "update " . product_item . " set active=0,edittime=NOW() where product_id='{$product_id}' and color_id='{$color_id}' and active=1";
                $this->db->query($sql);
            }
            //寫入product_item
            $idx = 0;
            foreach($color->items as $item){
                if ($item->size!=''){
                    if ($item->itemid==0){
                        $sql = "INSERT INTO  " . product_item . " (`id` ,`product_id` ,`color_id` ,`size` ,`qty` ,`cost` ,`price` ,`special_price` ,`sku` ,`createtime` ,`edittime` ,`publish` ,`active` ,`sort` ,`color_sort` ,`coffee_taste`)VALUES (
                            NULL ,  
                            '{$product_id}',  
                            '{$color_id}', 
                            '{$item->size}',  
                            '{$item->qty}',  
                            '',  
                            '0',  
                            '0',  
                            '{$item->sku}',  
                            NOW(),  
                            NOW(),  
                            '{$item->publish}',  
                            1,  
                            '{$idx}',  
                            '{$color_idx}',  
                            '{$item->coffee_taste}'
                            );";
                        $this->db->query($sql);
                    }
                    else{
                        $sql = "update " . product_item . " set 
                            size='{$item->size}',  
                            qty='{$item->qty}', 
                            sku='{$item->sku}',  
                            edittime=NOW(),
                            sort='{$idx}',
                            color_sort='{$color_idx}',
                            coffee_taste='{$item->coffee_taste}'
                            where id='{$item->itemid}'";
                        $this->db->query($sql);
                    }
                    $idx++;
                }
            }

            $color_idx++;
        }
    }



    public function del($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . product . " set active=0 where id='{$id}'";
        $this->db->query($sql);
    }

    public function publish($id=0){
        $post = $this->input->post(NULL, TRUE);
        $sql = "update " . product . " set publish='{$post['publish']}' where id='{$id}'";
        $this->db->query($sql);
    }
}
?>