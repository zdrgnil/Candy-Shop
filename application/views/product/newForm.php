<h2>New Product</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('candystore/index','Back') . "</p>\n";
	
	echo form_open_multipart('candystore/create')."\n";
		
	echo form_label('Name'); 
	echo form_error('name');
	echo form_input('name',set_value('name'),"required id='iname'")."\n";

	echo form_label('Description');
	echo form_error('description');
	echo form_input('description',set_value('description'),"required")."\n";
	
	echo form_label('Price');
	echo form_error('price');
	echo form_input('price',set_value('price'),"required")."\n";
	
	echo form_label('Photo');
	
	if(isset($fileerror))
		echo $fileerror;	
?>	
	<input type="file" name="userfile" size="20" />
	
<?php 	
	//, "onClick='varlidate()'"
	echo form_submit('submit', 'Create');
	echo form_close();
?>	

