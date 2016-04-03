<?php
function display($item){
	$img_url=base_url() . "images/product/" . $item->photo_url; 
	$sdescp=shorten($item->description);

	$req_url=base_url()."ajaxhandler/add_to_cart";
	$onclick="add_to_cart('$req_url',".$item->id.")";
	// $_SESSION['cart'][]=array('id' => 1, 'quantity' => 2);
	// print_r($_SESSION['cart']);
	//echo "Session!".$_SESSION['cart'][];
	//echo $onclick;
//	print_r($item);
?>
<div class="item_container">

	<a target="_blank" href="<?=$img_url?>">
		<img src="<?=$img_url?>" >
	</a>
	<span class="name"><?=$item->name?></span>
	<hr>
	<div class="description" title="<?=$item->description?>"><?=$sdescp?></div>
	<hr>
	Price:<span class="price" style="margin-bottom:0px"><b> $<?=$item->price?></b></span>
	<br>Quantity: <input id="quantity_<?=$item->id?>" type="number" value="1" size="3">
	<a class="btn" href="javascript:void(0)" onclick="<?=$onclick?>">Add to Cart</a>
</div>
<?php
}

function shorten($str,$len=140){
//	return $len;
	if(strlen($str)<=$len){
		return $str;
	}else{
		$lasti=strpos($str,' ',$len-15);
		if($lasti<$len-3)
			$len=$lasti;
		return substr($str, 0, $lasti)."...";
	}
}
?>

<?php
//Make a row for each individual product in the cart
function makeRow($products,$key,$value){?>
<hr id="idv_hr_<?=$key?>">
<div class="idv_list" id="idv_list_<?=$key?>">
	<!--First display the image-->
	<img class="idv_image" src="<?=base_url()?>images/product/<?=$products[$key]->photo_url?>">

	<!--Then the name and description of the product-->
	<div class="idv_name_descp">
		<b><font><?=$products[$key]->name?></font></b><hr>
		<?=$products[$key]->description ?>
	</div>

	<!--Quantity form(display/update/delete)-->
	<div class="idv_quantity">
		<div>&nbsp;<span class="disp_msg" id="disp_msg<?=$key?>">Saved</span></div>
		<input autocomplete="off" type="number" onfocus="clear_msg()"
		id="quantity_<?=$key?>" size=5 value="<?=$value?>">

		<center><a class="btn" href="javascript:void(0)"
			onclick="update_quantity('<?=base_url()?>ajaxhandler/update_quantity',<?=$key?>)">
			Update
		</a></center>

		<center style="margin:15px;"><a class="btn" href="javascript:void(0)"
			onclick="delete_from_cart('<?=base_url()?>ajaxhandler/delete_from_cart',<?=$key?>)">
			Delete
		</a></center>

	</div>
	<div class="idv_price">
		$<?=$products[$key]->price ?>
	</div>
</div>
<?php
}

?>
