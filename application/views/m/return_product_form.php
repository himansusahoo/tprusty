<?php include "header.php"; ?>

<style>
.refund_reason,.replacement_reson,.bank_details,.refund_type{display:none;}
</style>
<script>
function getReturnType(val){
	if(val == 'Refund'){
		/*$('.replacement_reson').hide();*/
		$('.refund_type').show();
		$('.refund_reason').show();
	}
	else if(val == 'Replacement'){
		$('.refund_type').hide();
		$('.bank_details').hide();
		$('.refund_reason').show();
	}
}


function getBankDetails(val){
	if(val == 'Wallet'){
		$('.bank_details').hide();
	}
	else if(val == 'Bank Transfer'){
		$('.bank_details').show();
	}
}


function product_returnFunction(){
	var retn_typ = $('#return_typ').val();
	var refund_reason = $('#refund_reason').val();
	if(retn_typ == ""){
		$('#return_typ').css('border-color','red');
		$('.fil1').show();
		return false;
	}else if(retn_typ == "Refund"){
		var refund_type = $('#refund_type').val();
		if(refund_reason == ""){
			$('#return_typ').css('border-color','#ccc');
			$('#refund_reason').css('border-color','red');
			$('.fil1').hide();
			$('.fil2').show();
			return false;
		}
		else if(refund_type == 'Bank Transfer'){
			var holder_name = $('#holder_name').val();
			var bank_name = $('#bank_name').val();
			var accnt_no = $('#AC_no').val();
			var ifsc_code = $('#IFSC').val();
			
			if(holder_name == ''){
				$('#return_typ').css('border-color','#ccc');
				$('#refund_reason').css('border-color','#ccc');
				$('#holder_name').focus().css('border-color','red');
				$('.fil1').hide();
				$('.fil2').hide();
				$('.fil3').show();
				return false;
			}
			else if(bank_name == ''){
				$('#return_typ').css('border-color','#ccc');
				$('#refund_reason').css('border-color','#ccc');
				$('#holder_name').css('border-color','#ccc');
				$('#bank_name').focus().css('border-color','red');
				$('.fil1').hide();
				$('.fil2').hide();
				$('.fil3').hide();
				$('.fil4').show();
				return false;
			}
			else if(accnt_no == ''){
				$('#return_typ').css('border-color','#ccc');
				$('#refund_reason').css('border-color','#ccc');
				$('#holder_name').css('border-color','#ccc');
				$('#bank_name').css('border-color','#ccc');
				$('#AC_no').focus().css('border-color','red');
				$('.fil1').hide();
				$('.fil2').hide();
				$('.fil3').hide();
				$('.fil4').hide();
				$('.fil5').show();
				return false;
			}
			else if(isNaN(accnt_no)){
				$('#return_typ').css('border-color','#ccc');
				$('#refund_reason').css('border-color','#ccc');
				$('#holder_name').css('border-color','#ccc');
				$('#bank_name').css('border-color','#ccc');
				$('#AC_no').focus().css('border-color','red');
				$('.fil1').hide();
				$('.fil2').hide();
				$('.fil3').hide();
				$('.fil4').hide();
				$('.fil5').show();
				$('.fil5').text('Invalid account number.');
				return false;
			}
			else if(ifsc_code == ''){
				$('#return_typ').css('border-color','#ccc');
				$('#refund_reason').css('border-color','#ccc');
				$('#holder_name').css('border-color','#ccc');
				$('#bank_name').css('border-color','#ccc');
				$('#AC_no').css('border-color','#ccc');
				$('#IFSC').focus().css('border-color','red');
				$('.fil1').hide();
				$('.fil2').hide();
				$('.fil3').hide();
				$('.fil4').hide();
				$('.fil5').hide();
				$('.fil6').show();
				return false;
			}
		}
	}
	else if(retn_typ == "Replacement"){
		if(refund_reason == ""){
			$('#return_typ').css('border-color','#ccc');
			$('#refund_reason').css('border-color','red');
			$('.fil1').hide();
			$('.fil2').show();
			return false;
		}
	}
}

</script>

<div class="wrap" >
       <div class="info-products">
	  
	      <div class="info-inner">

		<div class="section-info">        
         <h4 class="title-ylw">Return Request OrderID : <?=$order_id?></h4>   
		<?php			
	if(isset($msg)){ ?>
	<h4 style="color: red;"><?php echo $msg; ?></h4>
	<?php
	}
		echo form_open_multipart('my_order/add_return_product');
	?>
		
		<table class="account_form" width="100%">
			<tr>
				<td width="100%">Choose Return Type : </td> </tr>
				<tr> <td>
					<select class="input-text" name="return_typ" id="return_typ" onChange="getReturnType(this.value)">
						<option value="">---select---</option>
						<option value="Refund">Refund</option>
						<option value="Replacement">Replacement</option>
					</select>
					<span class="req fil1"> This field is required.</span>
				</td>
			</tr>
			<tr class="refund_reason">
				<td>Refund Reason : </td> </tr>
				<tr class="refund_reason"> <td>
					<select id="refund_reason" name="reason1" class="input-text">
						<option value="">---select---</option>
						<option value="Quality Issue">Quality Issue</option>
						<option value="Not as described">Not as described</option>
						<option value="Wrong product delivered">Wrong product delivered</option>
						<option value="Damaged product received">Damaged product received</option>
						<option value="Defective product">Defective product</option>
						<option value="Dont want the product any more">Dont want the product any more</option>
                        <option value="Defective Product">Defective Product</option>
						<option value="Missing Items">Missing Items</option>
						<option value="Damaged Product">Damaged Product</option>
					</select>
					<span class="req fil2"> This field is required.</span>
				</td>
			</tr>
            
            <tr class="refund_type">
				<td>Refund Type : </td> </tr>
			<tr class="refund_type">	<td>
					<select id="refund_type" name="refund_type" class="input-text" onChange="getBankDetails(this.value)">
						<option value="Wallet">Wallet</option>
						<option value="Bank Transfer">Bank Transfer</option>
					</select>
					<!--<span class="req fil3"> This field is required.</span>-->
				</td>
			</tr>
            
			<tr class="bank_details">
				<td>Bank_Details : </td> </tr>
			<tr class="bank_details">	<td>
					<input type="text" id="holder_name" class="input-text" name="AC_holder_name" placeholder="Enter Holder Name">
					<span class="req fil3"> This field is required.</span>
					<input type="text" id="bank_name" class="input-text" name="bank_name" placeholder="Enter Bank Name">
                    <span class="req fil4"> This field is required.</span>
					<input type="text" id="AC_no" class="input-text" name="AC_no" placeholder="Enter Account Number">
					<span class="req fil5"> This field is required.</span>
					<input type="text" id="IFSC" class="input-text" name="IFSC" placeholder="Enter IFS Code">
					<span class="req fil6"> This field is required.</span>
				</td>
			</tr>
			<tr>
				<td>Comment : </td> </tr>
			<tr>	<td>
					<textarea id="return_comnt" name="comnt" class="input-text"></textarea>
					<span class="req fil7"> This field is required.</span>
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="hidden_sl_id" value="<?php echo ($sl_id) ?  $sl_id : "" ; ?>">
					<input type="submit" id="cs_submit_btn" class="btn-sign-in" onClick="return product_returnFunction()" value="Submit">
				</td>
			</tr>
		</table>
		</form>
			  </div>

          </div>    
        </div>
        
</div>

<?php include "footer.php"; ?>