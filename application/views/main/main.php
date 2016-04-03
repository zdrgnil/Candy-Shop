<?php
	//include("functions.php");
	$this->load->helper('functions');
?>
<html>
<head>
	<title>Candy Store</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/mainview.css">	
	<script src="<?php echo base_url();?>js/own/main_view.js"></script>
	<script src="<?php echo base_url();?>js/jquery-latest.js"></script>
</head>
<body>
	<?php
	//Load the header view: which has logo(store name/title) and the link to
	//'Login' page and 'My Cart' Page
	$data["title"]="Store Name/Title";
	$this->load->view('main/header.php',$data);  
	?>

	<div class="main_container">
		<hr>
		<?php
			foreach ($items as $item) {
				display($item);
			}

		?>		
	</div>

</body>
</html>

