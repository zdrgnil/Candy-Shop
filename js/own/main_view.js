function add_to_cart(url,product_id){
	quantity=$("#quantity_"+product_id).val();
	//alert(quantity);
	//alert(url+","+product_id)
	$.post(url,
	    {id:product_id,quantity:quantity},
	    atc_callback
	  );
}

function atc_callback(data, status){
	if(status=="success"){
		alert("Item added!");
	}
    //alert("Data: " + data + "\nStatus: " + status);
}