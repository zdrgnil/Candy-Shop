<?php
include("order.php");
class Order_model extends CI_Model {

	function getAll(){		
		$query = $this->db->get('order');
		return $query->result('Order');
	}

	function get($id){
		$query = $this->db->get_where('order',array('id' => $id));
		return $query->row(0,'Order');
	}

	function insert($order) {
		// print_r($_SESSION['cart']);
		$result = $this->db->insert("order", array(
				'customer_id' => $order->customer_id,
				'order_date' => $order->order_date,
				'order_time' => $order->order_time,
				'total' => $order->total,
				'creditcard_number' => $order->creditcard_number,
				'creditcard_month' => $order->creditcard_month,
				'creditcard_year' => $order->creditcard_year));
		return $this->db->insert_id();;
	}

	function insert_all_items($order_id){
		$result=true;
		foreach ($_SESSION['cart'] as $product_id => $quantity) {
			$r = $this->db->insert("order_item", 
				array('order_id' => $order_id, 
					'product_id' => $product_id,
					'quantity' => $quantity));
			$result=$result && $r;
		}
		return $result;
	}


	/*function delete($id) {
		return $this->db->delete("order",array('id' => $id ));
	}

	function insert($order) {
		return $this->db->insert("order", array('id' => $order->id,
				'customer_id' => $order->customer_id,
				'order_date' => $order->order_date,
				'order_time' => $order->order_time,
				'total' => $order->total,
				'creditcard_number' => $order->creditcard_number,
				'creditcard_month' => $order->creditcard_month,
				'creditcatd_year' => $order->creditcatd_year));
	}*/

	/*function update($order) {
		$this->db->where('id', $order->id);
		return $this->db->update("order", array('name' => $order->name,
				'description' => $order->description,
				'price' => $order->price));
	}*/


}
?>