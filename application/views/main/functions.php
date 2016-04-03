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
	return $len;
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