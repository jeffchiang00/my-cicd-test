<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_model extends CI_Model {
    public $data;
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_rs($data){
        $search_key = $data['search_key'] == ''?'':" and (x1.member_order_id like '%{$data['search_key']}%' or x3.email like '%{$data['search_key']}%')";
        $data['search_edate'] .= ' 23:59:59';
        $search_paystatus = $data['search_status']==''?'':" and paystatus='{$data['search_status']}'";
        $sql = "select *,x1.id as purchase_id from " . purchase . " x1 
            inner join " . purchase_statuses . " x2 on x1.paystatus=x2.id 
            inner join " . member . " x3 on x1.member_id=x3.id
            left join (select purchase_id,sum(qty) as items from " . purchase_item . " group by purchase_id) x4 on x4.purchase_id=x1.id
            where x1.createtime between '{$data['search_sdate']}' and '{$data['search_edate']}'
            {$search_paystatus}
            {$search_key}
            order by x1.id desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }

    public function get_row($id=0){
        $sql = "select * from " . purchase . " x1 
            inner join " . purchase_statuses . " x2 on x1.paystatus=x2.id 
            inner join " . member . " x3 on x1.member_id=x3.id
            left join (select purchase_id,sum(qty) as items from " . purchase_item . " group by purchase_id) x4 on x4.purchase_id=x1.id
            where x1.id='{$id}'";
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
        $sql = "update purchase set paystatus='{$post['paystatus']}',invoice='{$post['invoice']}',track='{$post['track']}',note='{$post['note']}' where id='{$id}'";
        $this->db->query($sql);
        if ($this->db->affected_rows()==1){
            return true;
        }
        else{
            return false;
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

    public function get_pay_status(){
        $sql = "select * from " . purchase_statuses . "";
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