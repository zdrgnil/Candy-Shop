<?php
	//echo base_url();
	$base_url=$this->config->config["base_url"];
	$form_open_tag=form_open_multipart('candystore/handle_register_request',
		array('id' => "register-form", 'method'=>"post", 'onsubmit'=>"return validateForm()",
			'style'=> "margin:10px"))."\n";
?>

<html>
<head>	
	<title>Create New Account - Candy Store</title>
	<link rel="stylesheet" type="text/css" href="<?=$base_url?>css/register.css">	
	<style>

	</style>

	<script>
		function validateForm(){
			var pwd = document.getElementsByName("password")[0].value;
			var confpwd = document.getElementsByName("conf-password")[0].value;
			if(pwd==confpwd){
				return true;
			}else{
				alert("password does not match");
				return false;
			}

		}
		//alert(document.getElementById("text-input-style").name);
	</script>

</head>

<body>

	<div id="container">
		<h2>Register</2>
		<hr>

		<!--<form style="margin:10px" autocomplete="on" 
			id="register-form" method="post" onsubmit="return validateForm()">-->
			<?=$form_open_tag?>

			<input type="text" class="text-input-style" name="username" placeholder="Login Name" 
			pattern="[a-z][a-z0-9]{5,13}" title="6 to 14 alphabets/numbers, must start with an alphabet charcter" required>
			<!--<span title="error">a</span>-->

			<input type="password" class="text-input-style" name="password" 
			pattern="[\w\W]{6,12}" title="6 to 8 characters" placeholder="Password" required>
			<input type="password" class="text-input-style" name="conf-password" 
			pattern="[\w\W]{6,12}" title="6 to 8 characters" placeholder="Confirm Password" required>

			<hr>
			<input type="email" class="text-input-style" name="email" placeholder="Email Address" required>
			<input type="text" class="text-input-style" name="fname" placeholder="First Name" 
			pattern="[A-Za-z]{2,15}" title="2 to 15 characters" required>
			<input type="text" class="text-input-style" name="lname" placeholder="Last Name" 
			pattern="[A-Za-z]{2,15}" title="2 to 15 characters" required>

			<hr>
			<input type="submit" class="btn" onclick="validate()">
			<!--<a class="btn" href="" type="submit" onclick="document.forms[0].submit();return false;">Create an account</a>-->
		</form>
	</div>
</body>
</html>