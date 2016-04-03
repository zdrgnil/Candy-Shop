<?php

class CandyStore extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
	    	session_start();
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    	$this->load->helper('functions');
	    	$this->load->library('upload', $config);
	    	
    }

    function index() {
   		// $this->load->model('product_model');
   		// $products = $this->product_model->getAll();
   		// $data['products']=$products;
   		//$this->load->view('product/list.php',$data);
    	$this->load->model('product_model');
    	$data['items']=$this->product_model->getAll();
   		$this->load->view('main/main.php',$data);
    }
	
	function list_orders() {
		$this->load->model('order_model');
		$orders = $this->order_model->getAll();
		echo 'THIS IS NOT PRINTED';
		$data['orders']=$orders;
		
		$this->load->view('admin/orderlist.php',$data);
	}

    function home(){
    	$this->load->model('product_model');
    	$data['items']=$this->product_model->getAll();
   		$this->load->view('main/main.php',$data);    	
    }

    function register(){
    	$this->load->view('register.php'); 
    }

    function handle_checkout(){
		$cred_num=$this->input->get_post('credicard_num');
		$exp_month=$this->input->get_post('expiration_month');
		$exp_year=$this->input->get_post('expiration_year');

    	$this->load->library('form_validation');
		$this->form_validation->set_rules('credicard_num','<b>Credicard Number</b>',
			'required|exact_length[16]|integer');
		$this->form_validation->set_rules('expiration_month','<b>Expiration Month</b>',
			'required|exact_length[2]|integer|greater_than[0]|less_than[31]');
		$this->form_validation->set_rules('expiration_year','<b>Expiration Year</b>',
			"required|exact_length[2]|integer|greater_than[0]|callback_check_date[$exp_month]");

		$data=$this->get_cart_data();
		if ($this->form_validation->run() == true){//Checkout Success!
			$_SESSION['customer_id']=2;
			$this->load->model('order_model');
			$Order = new Order();
			$Order->customer_id=$_SESSION['customer_id'];
			$Order->order_date=date('Y-m-d');
			$Order->order_time=date('H:i:s');
			$Order->total=$data['total_price'];
			$Order->creditcard_number=$cred_num;
			$Order->creditcard_month=$exp_month;
			$Order->creditcard_year=$exp_year;
			$order_id = $this->order_model->insert($Order);
			$this->order_model->insert_all_items($order_id);
			$_SESSION['order_id']=$order_id;
			$_SESSION['print_receipt_cart']=$_SESSION['cart'];
			redirect('page/print_receipt', 'refresh');
		}else{//Checkout failed
			$data['form_error']=true;
			$this->load->view('mycart.php',$data);  
		}
    }

    function handle_register_request(){
    	$this->load->model('register_model');
    	$result= $this->register_model->submit_to_db(
    		$this->input->get_post('fname'),
    		$this->input->get_post('lname'),
    		$this->input->get_post('username'),
    		$this->input->get_post('password'),
    		$this->input->get_post('email'));

    	echo "submit success!".$result;
    }
    
    function newForm() {
	    	$this->load->view('product/newForm.php');
    }
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[product.name]|min_length[5]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];

			$this->product_model->insert($product);


			//Then we redirect to the index page again
			redirect('candystore/index', 'refresh');
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				$this->load->view('product/newForm.php',$data);
				return;
			}
			
			$this->load->view('product/newForm.php');
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			redirect('candystore/index', 'refresh');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('product/editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('candystore/index', 'refresh');
	}
      
   
    function check_date($year,$month){
    	//echo $year.",".$month;
    	if($year < date('y') || ($year==date('y') && $month <= date('m'))){
			$this->form_validation->set_message('check_date', 
				'This credicard has already been expired.');
			return FALSE;
    	}else{
    		return true;
    	}
    }

	function get_cart_data(){
		$this->load->model('product_model');
		$data['total_price']=0;
		if(isset($_SESSION['cart']) && count($_SESSION['cart'])!=0){
			foreach ($_SESSION['cart'] as $key => $value) {
				$product[$key]=$this->product_model->get($key);
				$data['total_price']+=$product[$key]->price * $value;
			}
			$data['products']=$product;
		}
		return $data;
	}
    
        
}

