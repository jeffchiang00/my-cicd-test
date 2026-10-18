<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('cart');

	}


	public function insert(){
		$form = $this->input->post(NULL, TRUE);
		$data = array(
			'id'      => $form['p_id'],
			'qty'     => $form['p_qty'],
			'price'   => $form['p_price'],
			'name'    => '',
			'options' => array('size' => $form['p_size'],'color' => $form['p_color'])
		);

		$this->cart->insert($data);
	}
	public function update_cart(){
		$form = $this->input->post(NULL, TRUE);
		$data = array(
			array(
				'rowid'   => $form['rowid'],
				'qty'     => $form['qty']
				)
			);

		$this->cart->update($data);

	}
	
	public function get_cart_contents(){
		$cart = array();
        $this->load->model('product_model');
		foreach($this->cart->contents() as $item){
			$product = $this->product_model->get_row($item['id']);
			$product_item = $this->product_model->get_product_item_for_cart($item['id'],$item['options']['color'],$item['options']['size']);
			$product_qty = 0;
			$product_item['max_qty'] = $product_item['qty']>10?10:$product_item['qty'];
			$product_item['title'] = $product['title'];
			$product_item['rowid'] = $item['rowid'];
			$product_item['qty'] = $item['qty'];
			$product_item['product_price'] = $product['price'];
			$product_item['product_s_price'] = $product['special_price'];
			array_push($cart,$product_item);
		}
		return $cart;
	}

	public function get_shipping_data(){
		$title_col = $_SESSION['lang']=='en'?'location_en':'location';
		$sql = "select *,{$title_col} as title from shipping_data where price>0";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>