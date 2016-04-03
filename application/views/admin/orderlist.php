<h2>Finalized Order Table</h2>
<?php 

echo "<tr><th>Order ID</th><th>CID</th><th>Date</th><th>Time</th><th>Total</th></tr>";

foreach ($orders as $order) {
	echo "<tr>";
	echo "<td>" . $order->id . "</td>";
	echo "<td>" . $order->customer_id . "</td>";
	echo "<td>" . $order->order_date . "</td>";
	echo "<td>" . $order->order_time . "</td>";
	echo "<td>" . $order->total . "</td>";
	
	/*echo "<td>" . anchor("candystore/delete/$order->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
	echo "<td>" . anchor("candystore/editForm/$order->id",'Edit') . "</td>";
	echo "<td>" . anchor("candystore/read/$order->id",'View') . "</td>";*/

	echo "</tr>";
}
echo "<table>";
?>


