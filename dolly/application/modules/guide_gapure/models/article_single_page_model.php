<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_single_page_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_row($function_title=''){
        $sql = "select * from " . article_single_page . " where function_title='{$function_title}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function save($function_title=''){
        $post = $this->input->post(NULL, TRUE);
        $template_content = addslashes($this->input->post('template_content',FALSE));
        //echo addslashes($template_content);
        $sql = "select * from " . article_single_page . " where function_title='{$function_title}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0){
            $sql = "INSERT INTO " . article_single_page . " (`id`, `function_title`, `template_content`, `publish`) VALUES (
                NULL, 
                '{$function_title}', 
                '{$template_content}', 
                '{$post['publish']}');";
            $this->db->query($sql);
            return true;
        }
        $sql = "update " . article_single_page . " set 
            template_content='{$template_content}', 
            publish='{$post['publish']}' 
            where function_title='{$function_title}'";
        $this->db->query($sql);
        return true;
    }
}
?>