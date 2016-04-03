var tempt_id;
function update_quantity(url,product_id){
	tempt_id=product_id;
	quantity=$("#quantity_"+product_id).val();	
	if(quantity%1 == 0 && quantity>0){
	$.post(url,
	    {id:product_id,quantity:quantity},
	    function(data, status){
			if(status=="success"){
				total_price+=(quantity-quant[product_id])*price[product_id];
				quant[product_id]=quantity;
				//$("#disp_msg"+product_id).text("Saved");
				$("#total_price_content").text("$"+total_price);
				$("#disp_msg"+product_id).fadeIn();
				//alert(total_price);
			}else{//else output the error
				alert("Error:"+status+","+data);
			}
		}
	  );
	}else{
		alert("invalid input!");
	}
}

function delete_from_cart(url,product_id){
	$.post(url,{id:product_id}, 
	function(data, status){
		if(status=="success"){//If delete success
			total_price-=quant[product_id]*price[product_id];
			quant[product_id]=0;
			$("#total_price_content").text(total_price);
			
			$("#idv_hr_"+product_id).fadeOut();		
			$("#idv_list_"+product_id).fadeOut();
		}else{//else output the error
			alert("Error:"+status+","+data);
		}
	});
}

function dfc_callback(data, status){
	alert("#idv_list_"+tempt_id);
	$("#idv_list_"+tempt_id).fadeOut();
}

function atc_callback(data, status){
      alert("Data: " + data + "\nStatus: " + status);
}

function clear_msg(){
	for(key in quant){
		$("#disp_msg"+key).fadeOut();
	}
}

function display_checkout_form(){
	$("#payform").fadeIn();
}