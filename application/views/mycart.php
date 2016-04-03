<html>
<head>
	<!-- Load the required css/js files -->
	<title>My Shopping Cart - Candy Store</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/mainview.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/mycart.css">
	<script src="<?php echo base_url();?>js/own/mycart.js"></script>
	<script src="<?php echo base_url();?>js/jquery-latest.js"></script>

	<!-- Set up the js Enviroment -->
	<script>
		var total_price = <?=$total_price?>;
		var quant = new Array();
		var price = new Array();
		<?php
			foreach ($_SESSION['cart'] as $key => $value) {
				echo "quant[$key]=$value;\n";
				echo "price[$key]=".$products[$key]->price.";\n";
			}
		?>
	</script>
</head>
<body>

<!-- Load the header view (contain logo / title stuff...) -->
<?php

	$data['title']="Logo & Title";
 	$this->load->view('main/header.php',$data); 
	$this->load->helper('functions');
?>

<!-- Set up the main containner -->
<div class="main_container">
	<!-- Display the table header -->
	<div class="idv_list">
		<b>Items to buy</b>
		<b class="title1">quantity</b>
		<b class="title2">price</b>
	</div>

	<!-- Display the items in the shopping cart -->
	<?php
		if(isset($_SESSION['cart']) && count($_SESSION['cart'])!=0){
			foreach ($_SESSION['cart'] as $key => $value) {
				makeRow($products,$key,$value);
			}
		}
	?>

	<!-- Display Ending: subtotal stuff -->
	<hr>
	<div class="idv_list">
		<input type="hidden" id="total_price" value="<?=$total_price?>">
		<b class="checkout">
			<a href="javascript:void(0)" onclick="display_checkout_form()" 
			class='btn'>Check Out</a></b>
		<b id="total_price_content" class="price">$<?=$total_price?></b>
	</div>

	<br><br><br>

	<?php
		$display="display:none";
		if(isset($form_error)&&$form_error)
			$display="";
	?>
	<div id="payform" style="<?=$display?>">
	<?php
		$this->load->view("main/payform.php");
	?>
	</div>
	<br><br><br><br><br><br>
</div>
</body>
</html>

