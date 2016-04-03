<?php

class AjaxHandler extends CI_Controller {

    function __construct() {
    	session_start();
    	parent::__construct();
    }
	function index(){
		echo "hello world";
	}

	function add_to_cart(){
		$product_id=$this->input->get_post('id');
		$quantity=$this->input->get_post('quantity');
		if(isset($_SESSION['cart'][$product_id])){
			$_SESSION['cart'][$product_id] += $quantity;
		}else{
			$_SESSION['cart'][$product_id] = $quantity;			
		}
		print_r($_SESSION['cart']);
		//echo "this is add to cart function!";
	}

	function update_quantity(){
		$product_id=$this->input->get_post('id');
		$quantity=$this->input->get_post('quantity');
		$_SESSION['cart'][$product_id] = $quantity;	
		print_r($_SESSION['cart']);
	}

	function delete_from_cart(){
		$product_id=$this->input->get_post('id');
		unset($_SESSION['cart'][$product_id]);
		print_r($_SESSION['cart']);
		//echo "this is add to cart function!";
	}

}
?>