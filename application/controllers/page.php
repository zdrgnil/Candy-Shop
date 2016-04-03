<?php

class Page extends CI_Controller {
    function __construct() {
   		// Call the Controller constructor
    	parent::__construct();
    	session_start();
	}

	function my_cart(){
		$this->load->model('product_model');

		$data['total_price']=0;

		if(isset($_SESSION['cart']) && count($_SESSION['cart'])!=0){
			foreach ($_SESSION['cart'] as $key => $value) {
				$product[$key]=$this->product_model->get($key);
				$data['total_price']+=$product[$key]->price * $value;
			}
			$data['products']=$product;
		}

		$this->load->view('mycart.php',$data);   
	}

    function print_receipt(){
    	$data=$this->get_cart_data();
		$this->load->view('main/printreceipt.php',$data);
    }

   	function get_cart_data(){
		$this->load->model('product_model');
		$data['total_price']=0;
		if(isset($_SESSION['print_receipt_cart']) && count($_SESSION['print_receipt_cart'])!=0){
			foreach ($_SESSION['print_receipt_cart'] as $key => $value) {
				$product[$key]=$this->product_model->get($key);
				$data['total_price']+=$product[$key]->price * $value;
			}
			$data['products']=$product;
		}
		return $data;
	}
}

?>