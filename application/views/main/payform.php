<font size=6>Check Out</font>
<hr>
<div class="form_container">
<?php
echo form_open_multipart('candystore/handle_checkout',
		array('method'=>"post",'style'=> "margin:10px"))."\n";
?>

	<label>Credicard Number:</label>
	<input type="text" class="text-input-style" name="credicard_num" autocomplete="off"
	placeholder="16 Digit Credicard Number" value="<?=set_value('credicard_num')?>"
	pattern="[0-9]{16}" title="16 Digit Credicard Number" required>
	<?php echo form_error('credicard_num',"<span class='form_error'>","</span>");?><br>

<!-- autocomplete="off" -->
	<label>Credicard Expiration:</label>
	<input type="text" class="text-input-style" name="expiration_month" placeholder="MM" 
	pattern="[0-9]{2}" autocomplete="off" value="<?=set_value('expiration_month')?>"
	style="width:50px" title="2 Digit number indicate month, in 'MM' format" required>
	-
	<input type="text" class="text-input-style" name="expiration_year" placeholder="YY" 
	pattern="[0-9]{2}" autocomplete="off" value="<?=set_value('expiration_year')?>"
	style="width:50px" title="2 Digit number indicate year, in 'YY' format" required>
	<?php echo form_error('expiration_month',"<span class='form_error'>","</span>")."
	".form_error('expiration_year',"<span class='form_error'>","</span>");?>
	
	<hr>
	<input type="submit" class="btn" onclick="validate()" value="Confirm & Proceed">
</form>
</div>