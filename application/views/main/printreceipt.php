<html>
<head>
	<style>
		table{
			border-collapse: collapse;
		}
		th{
			width: 170px;
		}
		td{
			text-align: center;
		}
	</style>
</head>

For printing, <a onclick="window.print();return false;" href="#">click here</a> or press Ctrl+P
<?php

echo"<table border=1>";
echo "<tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";
foreach ($_SESSION['print_receipt_cart'] as $product_id => $quantity) {
	echo "<tr><td>".$products[$product_id]->name."</td>
	<td>".$quantity."</td>
	<td>".$products[$product_id]->price."</td>
	<td>".$products[$product_id]->price * $quantity."</td>
	</tr>";
}
	echo "<tr><th>Subtotal</th><td></td><td></td><td>".$total_price."</td></tr>";
echo"</table>";

unset($_SESSION['cart']);
?>

