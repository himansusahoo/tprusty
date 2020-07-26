<?php include "header.php"; 
		
        if($this->session->userdata('chkoutemp_session_id')==""){
        $dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
        $chkoutemp_session_id=random_string('alnum', 10).$dtm;
        $this->session->set_userdata('chkoutemp_session_id',$chkoutemp_session_id);
        }

?>
<style>
.btn-big2 {
    font-family: 'SegoeUI';
    width: 100%;
    float: left;
    cursor: pointer;
    border: none;
    outline: none;
    display: block;
    font-size: 0.9em;
    padding: 13px 22px;
    text-align: center;
    font-family: 'SegoeUI-SemiBold';
    background: #067ab4;
    color: #FFF;
    text-transform: uppercase;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
	margin-bottom: 5px;
}
</style>
<script type= "text/javascript" src = "<?php echo base_url(); ?>js/countries.js"></script>
<script>

 function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';  
        var e = Math.ceil(Math.random() * 10)+ '';  
        var f = Math.ceil(Math.random() * 10)+ '';  
        var g = Math.ceil(Math.random() * 10)+ '';  
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;
        document.getElementById("txtCaptcha").value = code
    }

    // Validate the Entered input aganist the generated security code function   
    function ValidCaptcha(addtocart_ids,total_price,seller_id_arr,tax_arr,shipping_fees_arr,sub_total_arr,qantity_arr,sku_arr,address_id,price_arr,color_arr,size_arr){
			
		var ids=addtocart_ids;
		
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        var str2 = removeSpaces(document.getElementById('txtInput').value);
        if (str1 == str2)
		{ 
		 	var conf=confirm('Do you confirm your Order(s)');
			 if(conf==true)
			 {
				//Script start for attribute parametere//
				var color_strng = color_arr.replace(' ','&');
				var size_strng = size_arr.replace(' ','&');
				//Script end of attribute parametere//

			window.location.href='<?php echo base_url().'my_order/myorder_detail_mobile/' ?>' + ids + '/' + total_price + '/' + seller_id_arr + '/' + tax_arr + '/' + shipping_fees_arr + '/' + sub_total_arr + '/' + qantity_arr + '/' + sku_arr + '/' + address_id +'/' + price_arr + '/' + color_strng + '/' + size_strng;
				
				//window.location.href='<?php //echo base_url().'my_order/myorder_detail' ?>';
				
					
			 }
		 
		}else
        {			
			alert('Enter Correct Number');
		}
        
    }

function removeSpaces(string)
{
	return string.split(' ').join('');
}

function pay_by_cod(pincode)
{
	$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>Mycart/pincode_check",
			data:{pincode:pincode},
			success: function (data) {
						//$("#ss").html(data);
						if(data == 'COD'){
							$('#codcaptchadiv').css('display','block');							
						}
						else
						{
							//alert('Currently COD Service not available to your location,Please go for Online Payment');
							$('#codcaptchadiv').css('display','none');							
							$('#valid_msg_dv').show();
							$('#valid_msg_dv').text('Currently COD Service not available to your location,Please go for Online Payment.');
							
						}
					}
				});
				
				
}

</script>

<script>
function deleteAddress(id,sl){
		$spn_id = '.del'+sl;
		$($spn_id).text('deleting...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/delete_address',
			method:'post',
			data:{id:id},
			success:function(result)
			{
				if(result == 'deleted'){
					window.location.reload(true);
				}
			}
		});
}


function setDefaultaddress(address_id){
	$.ajax({
			url:'<?php echo base_url(); ?>user/update_user_default_address',
			method:'post',
			data:{id:address_id},
			success:function(result)
			{
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
}
</script>

<script>
function removeFromCart(add_to_cart_id){
	$.ajax({
		url:'<?php echo base_url();?>mycart/remove_from_cart_in_final',
		method:'post',
		data:{cart_id:add_to_cart_id},
		success:function(result){
			if(result == 'success'){
				window.location.reload(true);
			}
		}
	});
}
</script>
<script>
function saveAddress()
{
	
	var full_name = $('#full_name').val();
	var country = $('#country2').val();
	var state = $('#state').val();
	var city = $('#city').val();
	var address = $('#street_addrs').val();
	var pin = $('#pincode').val();
	var mob = $('#mobile').val();
	if(full_name == ''){
		$('#full_name').css('border-color','red');
		$('#full_name').focus();
		$('.ad1').show();
		return false;
	}else if(country == -1){
		$('#full_name').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('#country').css('border-color','red');
		$('.ad2').show();
		return false;
	}else if(state == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('#state').css('border-color','red');
		$('.ad3').show();
		return false;
	}else if(city == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('#city').focus();
		$('#city').css('border-color','red');
		$('.ad4').show();
		return false;
	}else if(address == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('#street_addrs').focus();
		$('#street_addrs').css('border-color','red');
		$('.ad5').show();
		return false;
	}else if(pin == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('#pincode').focus();
		$('#pincode').css('border-color','red');
		$('.ad6').show();
		return false;
	}else if(isNaN(pin)){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('#pincode').select();
		$('#pincode').css('border-color','red');
		$('.ad6').show();
		$('.ad6').text('Invalid pin code.');
		return false;
	}else if(mob == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('#pincode').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('.ad6').hide();
		$('#mobile').focus();
		$('#mobile').css('border-color','red');
		$('.ad7').show();
		return false;
	}else if(isNaN(mob)){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('#pincode').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('.ad6').hide();
		$('#mobile').select();
		$('#mobile').css('border-color','red');
		$('.ad7').show();
		$('.ad7').text('Invalide Mobile number.');
		return false;
	}else if(mob.length != 10){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('#pincode').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('.ad6').hide();
		$('#mobile').select();
		$('#mobile').css('border-color','red');
		$('.ad7').show();
		$('.ad7').text('Please enter 10 digit mobile number.');
		return false;
	}else{
		
		$('#address_btn').val('Processing...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/save_address',
			method:'post',
			data:{
					name:full_name,
					country:country,
					state:state,
					city:city,
					address:address,
					pin:pin,
					mob:mob,
				},
			success:function(result)
			{
				
				if(result == 'saved'){
					var maddrs = $(".multi_address_dv").text();
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Your address have been saved successfully.');
					$("#show_ssmsg_dv").css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'})
					$("#show_ssmsg").fadeIn();
					$('#address_btn').val('Save Address');
					
					setTimeout(function() { window.location.reload(true); }, 3000);
				
				}
				if(result == 'not saved'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/error.png"> &nbsp;No data Saved');
					$("#show_ssmsg_dv").css({'background-color':'pink','border':'1px solid salmon','color':'#d8000c'})
					$("#show_ssmsg").fadeIn();
					$('#address_btn').val('Save Address');
				}
			}
		});
		
	}
	
}

</script>
<script>
	function pay()
		{
			$('#proceed_to_pay').attr('disabled',true);
			$('#proceed_to_pay').css('background-color','#ccc');
			$('#payment_div').css('display','block');
		}
</script>
<style>
.multi_address {
    padding: 10px 10px 33px;
}
</style>

	<div class="wrap">
    <!--/view-product-->
  <div class="view-product">
  <div class="checkout">
  <?php 
if($cus_data!=""){
$address_id = $cus_data->address_id;
?>
   <h3> Your Shipping Address   </h3>
   <div class="clearfix"> &nbsp;</div>
   <div class="default-adrs ">
   <p class="left"> <strong><?php echo $cus_data->full_name;  ?></strong>   <br>
                        <?php echo $cus_data->city;  ?>   <br>
                        <?php echo $cus_data->state_name;  ?>  <br>
                        <?php echo $cus_data->country;  ?> <br>                        
                        <?php echo $cus_data->pin_code;  ?>  <br>
                        <?php echo $cus_data->phone;  ?><br>
                        <?php echo $cus_data->address;  ?>
                        </p>
  <div class="gray-sml-btn right"> <a href="<?php echo base_url().'user/profile' ?>"> <i class="fa fa-plus-square"></i>  Add New Address </a> </div>
  <div class="clearfix"></div>
  </div>
  <div class="clearfix"> &nbsp;</div>
  <?php }else{ ?>
  
  <!--<span style="font-size:20px; color:#F00"> You have not complete your personal information & <a class='inline' href="#inline_content_add_address">Address</a> in your account--> 
  <!------------------------------------------------Add Address Form Start------------------------------------------------------------------>
  
  <span style="font-size:20px; color:#F00">Add New Address </span>
  	<div class="login-frm">
            	
                    <input type="text" class="input-text" name="full_name" id="full_name" value="" placeholder="Name">
                            <span class="req ad1"> This field is required.</span>
                      
                        	<select id="country2" name ="country2" placeholder="Select country">
                            <option value="India">India</option>
                            </select>
                            <span class="req ad2"> This field is required.</span>
                           <!-- <script language="javascript">
								//populateCountries("country", "state");
								populateCountries("country2");
 							</script>-->
                       
                        	<select name ="state" id ="state" class="input-text">
                            	<option value="">Select State</option>
                                <?php
								foreach($state_result as $state){
								?>
                                <option value="<?=$state->state_id; ?>"><?=$state->state; ?></option>
                                <?php } ?>
                            </select>
                            <span class="req ad3"> This field is required.</span>
                            <script language="javascript">
								//populateCountries("country", "state");
								populateCountries("country");
 							</script>
                        
                        	<input type="text" class="input-text" name="city" id="city" placeholder="City">
                            <span class="req ad4"> This field is required.</span>
                        
                        	<textarea class="input-text" name="street_addrs" id="street_addrs" placeholder="Address"></textarea>
                            <span class="req ad5"> This field is required.</span>
                    
                        	<input type="text" class="input-text" name="pincode" id="pincode" placeholder="Pincode">
                            <span class="req ad6"> This field is required.</span>
                   
                        	<input type="text" class="input-text" name="mobile" maxlength="10" id="mobile" placeholder="Mobile">
                            <span class="req ad7"> This field is required.</span>
                        
                        	<input  type="submit" id="address_btn" onClick="saveAddress()" class="btn-sign-in hvr-sweep-to-right" value="Save Address">
                   
                        	<div id="show_ssmsg_dv"></div>
 </div>
  <!------------------------------------------------Add Address Form End--------------------------------------------------------------------->
  
  
  
<script>
$(document).ready(function(){
	$('#accordion').hide();
	//$('#proceed_to_pay_dis').show();
	$('#addrs_confrm_dv').show();
});
</script>

</span>
<?php }?>

<?php
	if($address_result != ''){
		$sl=0;
		foreach($address_result as $row_addrss){
			$sl++;
	?>
  <div class="multi_address">
                       <p> <strong><?=$row_addrss->full_name; ?></strong>   <br>
                        <?=$row_addrss->address; ?> <br>
                        <?=$row_addrss->city.'-'.$row_addrss->pin_code; ?>  <br>
                        <?=$row_addrss->state_name.','.$row_addrss->country; ?><br>
                        Ph : <?=$row_addrss->phone; ?> 
                          </p>
                 <div class="single-bottom">
                 <label for="adrs">
                 <input type="radio" name="addrs" id="adrs" onclick="setDefaultaddress(<?=$row_addrss->address_id; ?>)" <?php if($cus_data!=""){if($address_id == $row_addrss->address_id){ echo 'checked';} } ?> > 
                 
                 <span> </span> </label> </div>
                 <?php if($cus_data!=""){if($address_id != $row_addrss->address_id){ ?>
                 <span onclick="deleteAddress(<?php echo $row_addrss->address_id; ?>,<?=$sl; ?>)" class="del<?=$sl; ?> gray-sml-btn right"> <i class="fa fa-trash-o"></i>Delete address </span>
                 <?php } }?>
                </div>
   <?php }} ?>           
                
  <div class="clearfix"></div>
				<!--/cart-->
				  
				      <h3 class="tittle two"> Order Summary  </h3>
					
						<div class="list">
						  <h3>My Shopping Bag </h3>
						  <div class="shopping_cart">
                        <?php 
								  $seller_id_arr=array();
								  $addtocart_id_arr=array();
								  $tax_arr=array();
								  $shipping_fees_arr=array();
								  $sub_total_arr=array();
								  $qantity_arr= array();
								  $sku_arr=array();
								  $price_arr = array();
								  $color_arr = array();
								  $size_arr = array();
								  
								  $total_price=0;
								  //$prod_weight=0; 
   									$prod_weight=array();
   							foreach($cart_data->result() as $rec_cart){  
							
						   //$image_cart=explode(',',$rec_cart->imag);
						    $qr1=$this->db->query("select d.name, b.image as imag , c.product_id, e.quantity,e.sku  from product_general_info d inner join seller_product_master a ON a.master_product_id=d.product_id
	   INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id 
	   INNER JOIN product_image c ON c.product_id=a.master_product_id
	   INNER JOIN product_master e on d.product_id=e.product_id 
		WHERE  a.sku='$rec_cart->sku' ");
		
    			if($qr1->num_rows()==0)
				{
						 
						   $qr1=$this->db->query("select a.imag,b.sku,c.name,b.product_id,b.quantity from product_image a inner join product_master b on a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id where a.product_id='$rec_cart->product_id' AND b.sku='$rec_cart->sku'");
						   
				}
				$rw1=$qr1->row();
						   $image_cart=explode(',',$rw1->imag);
						    if($rw1->quantity>0){
						   
   
    ?>
							
							 <div class="cart_box">
							   	 <div class="message">
							   	     <div class="alert-close" onClick="removeFromCart('<?=$rec_cart->addtocart_id;?>');"> Remove <i class="fa fa-times-circle"> </i> </div> 
					                <div class="list_img">
                                   <!-- <a href="#"><img src="images/1.jpg"  alt=""/> </a>-->
                                    
                                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))).'/'.$rw1->product_id.'/'.$rw1->sku  ?>"   alt="">
                                    <img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" alt="<?=$rw1->name;?>"></a>
                                    
                                    </div>
                                    
								    <div class="list_desc"><h4>                                    
                                   <!-- <a href="#">Velit esse molestie</a>-->
                                    
                                     <?php  $qr2=$this->db->query("select name,weight from product_general_info where product_id='$rec_cart->product_id'");
   $rw2=$qr2->row(); 
   //$prod_weight=$prod_weight+$rw2->weight;
    $constprodweight=$rw2->weight;
   array_push($prod_weight,$rw2->weight);
   
   echo "<a href="."'".base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name))))."/".$rw1->product_id."/".$rw1->sku."'".">". $rw2->name ."</a><br><br>" ;
   
   //	if($rec_cart->prdt_color != ''){ echo "<span class='cart_attr'>Color : ".$rec_cart->prdt_color.'</span><br/>'; }
//	else{$color_val = 'not';}
//	@array_push(@$color_arr,@$color_val);
//   	
//	if($rec_cart->prdt_size != ''){ echo "<span class='cart_attr'>Size : ".$rec_cart->prdt_size.'</span><br/>';}
//	else
//	{$size_val = 'not' ;}
//	array_push($size_arr,$size_val);
	
	
	
	
	//---------------------------------------color , size, capacity, RAM, ROM attribute display start--------------------
	
	
	$color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rec_cart->sku' group by sku ");
   	if($color_sizecronjobquery->num_rows()>0)
	{
		$color_rw=$color_sizecronjobquery->row()->color;
		$size_rw=$color_sizecronjobquery->row()->size;
		$capacity=$color_sizecronjobquery->row()->Capacity;
		$ram=$color_sizecronjobquery->row()->RAM;
		$rom=$color_sizecronjobquery->row()->ROM;  
		
		
		if($color_rw != ''){ echo "<span class='cart_attr'>Color : ".$color_rw.'</span><br/>'; }else {$color_rw = 'not';}array_push($color_arr,$color_rw);
		if($size_rw != ''){ echo "<span class='cart_attr'>Size : ".$size_rw.'</span><br/>';}else{$size_rw = 'not';}array_push($size_arr,$size_rw);
		if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>';}
		if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>';}
		if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>';}
	}
	
	//----------------------------color , size, capacity, RAM, ROM attribute display end-------------------------
	
	
	 ?>
                                    </h4>
                                    <div class="actual"> <span> Rs. 
                                    <!----------------------------Price Section Start----------------------->
                                    
                                    	<?php  $user_id=$this->session->userdata['session_data']['user_id'];
	  $qr3=$this->db->query("select * from addtocart_temp where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku'");  
	  //$row3=$qr3->row();
	  $price=0;
	  $ct_rec = $qr3->num_rows();
	  
	   $user_id=$this->session->userdata['session_data']['user_id'];
                                    $qr2=$this->db->query("select * from addtocart_temp  where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
                                   $rec_ct=$qr2->num_rows(); 
								   array_push($qantity_arr,$rec_ct);
	  foreach($qr3->result() as $rw_price)
	  {
		  
		  $qr4=$this->db->query("select * from product_master where sku='$rw_price->sku'"); 
		  $rec4=$qr4->result();
		  
		  $cdate = date('Y-m-d');
		  $special_price_from_dt = $rec4[0]->special_pric_from_dt;
		  $special_price_to_dt = $rec4[0]->special_pric_to_dt;
		  
		   $tax_persent = $rec4[0]->tax_amount;
		  $taxdecimal = $tax_persent/100;
		  
		  //array_push($tax_arr,$taxdecimal);
		  //tax amount for product price
		 $tax_amount = $rec4[0]->price*$taxdecimal;
					
		  //tax amount for product special price
		  $tax_amount_special = $rec4[0]->special_price*$taxdecimal;
		  
		  //tax amount for product mrp price
		  $tax_amount_mrp = $rec4[0]->mrp*$taxdecimal;
		  ///calculating tax amount script end here///
		 
		  
		  if($rec4[0]->special_price !=0){
			  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
				  array_push($tax_arr,$tax_amount_special*$rec_ct);
				  
		  			$price= $price + $rec4[0]->special_price;
			  }else{
				  //array_push($tax_arr,$tax_amount*$rec_ct);
				    //$price= $price + $rec4[0]->price;
					if($rec4[0]->price != 0){
						array_push($tax_arr,$tax_amount*$rec_ct);
				    	$price= $price + $rec4[0]->price;
					}else{
						array_push($tax_arr,$tax_amount_mrp*$rec_ct);
						$price= $price + $rec4[0]->mrp;
					}
			  } //End of date condition
		  }else{
			  //array_push($tax_arr,$tax_amount*$rec_ct);
			  //$price= $price + $rec4[0]->price;
			  
			  	if($rec4[0]->price != 0){
					array_push($tax_arr,$tax_amount*$rec_ct);
				    $price= $price + $rec4[0]->price;
				}else{
					array_push($tax_arr,$tax_amount_mrp*$rec_ct);
					$price= $price + $rec4[0]->mrp;
				}
			  
		  } //End of date special_price!=0 condition
			
	  }
	   echo $final_price = ceil($price/$ct_rec);
	   array_push($price_arr,$final_price);
	  
	   ?>
                                    <?php
									  
									$user_id=$this->session->userdata['session_data']['user_id'];
									$qr2=$this->db->query("select * from addtocart_temp  where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
								   $rec_ct=$qr2->num_rows(); 
								  // echo ($rec_ct);
								   foreach($qr2->result() as $rw){
									 $product_id1=$rw->product_id;
									 $sku_id1=$rw->sku;
									 $session_id=$rw->addtocart_session_id;}
									$qr3=$this->db->query("select * from product_master where product_id='$product_id1' and sku='$sku_id1' ");
								   $query=$qr3->num_rows(); 
								  // echo ($rec_ct);  
								  
								   foreach($qr3->result() as $row1){
									 $product_id1=$row1->product_id;
									 $sku_id1=$row1->sku;
									 $quantity_table=$row1->quantity;}
									// echo ($quantity_table);  
								   ?>
                                    <!----------------------------Price Section End-------------------------->
                                  <?php
								  
								 
                                    ?>
                                    </span> </div>
                                   <div class="quantity">
                                    <input type="text" disabled  class="quantity_added" id="quantity_added" name="quantity_added" value="<?php echo ($rec_ct); ?>" placeholder="qty" />
                                    <?php  //$prod_weight=$prod_weight*$rec_ct; 
									   if($rec_ct>1)
									   {
										 for($codi=2;$codi<=$rec_ct; $codi++ )
											{array_push($prod_weight,$constprodweight); }  
									   }
									
									?>
                                   <?php /*?> <input type="button"  value="save" class="btn-success add-btn" onClick="valid_function('<?=$product_id1;?>','<?=$sku_id1;?>','<?=$session_id;?>','<?=$user_id;?>','<?=$rec_ct;?>','<?=$rec_cart->addtocart_id;?>','<?=@$quantity_table;?>','<?=$sl;?>')" id="submit1<?=$sl;?>"><?php */?>
                                    </div>
                                    <div class="clearfix"></div>
									    <div class="delivery">
										 <p><i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee* </p>
                                         <?php 
										 		
										$query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on                                                                             a.seller_id=b.seller_id where b.sku='$rec_cart->sku'");
									   $count_row=$query_sellername->num_rows();
									   
									   $seller_id_arr_row=$query_sellername->row();
									   array_push($seller_id_arr,$seller_id_arr_row->seller_id);
									   
									   if($count_row!=0){
									   $rw_sellername=$query_sellername->row();
										  
										  ?>
										 <!--<a href="#"> <span> Seller : </span> Omm International</a>-->
                                         
                                        <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rw_sellername->seller_id));?>" id="goslr" style="cursor:pointer !important;">
                                        <span>  Seller :</span>
									   <?php 
                                       echo $rw_sellername->business_name; }
                                       else { echo "Seller: ".COMPANY;}
                                       ?>
                                       </a>
                                         
                                         
										 <div class="clearfix"></div>
                                         <div class="sphng"> 
                                         <?php 
										 array_push($shipping_fees_arr,$rec4[0]->shipping_fee_amount*$rec_ct); 
										 if($rec4[0]->shipping_fee_amount!=0)
											{
												echo 'Shipping Fees Rs.'.$rec4[0]->shipping_fee_amount*$rec_ct;
											}
										?>
                                         </div>
                                         <div class="dlvry-date">  
                                         
                                         <?php 
											$qr11 = $this->db->query("SELECT c.dispatch_days
											FROM seller_account a 
											INNER JOIN state b ON a.seller_state = b.state
											INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
											WHERE a.seller_id = '$rw_sellername->seller_id'");
											$ct11 = $qr11->num_rows();
											$res11 = $qr11->row();
											if($ct11 > 0){
												$days = $res11->dispatch_days+5; 
												   
												
												$dt =  date('d M', strtotime(+$days.'days'));
												echo "Standard delivery by ". $dt;
											}else{
												$dt1 =  date('d M', strtotime(+'12 days'));
												echo $dt1;
												//echo "Standard delivery by 10-12 Days";
											}
									?>
                                         
                                         <?php
										 	$subtotal_price = 0;
			
											 $subtotal_price=$subtotal_price+$rec4[0]->shipping_fee_amount*$rec_ct+ceil($price) ;
											 $total_price=ceil($total_price+$subtotal_price);
										 	array_push($sub_total_arr,$subtotal_price);
										  ?>
                                         </div>
                                         <div class="clearfix"></div>
                                         <div class="total-price"> Sub Total : Rs. <?php echo   number_format($subtotal_price, 0, ".", ",")?> </div>
									    </div>
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								 
	                            </div>
	                       <?php 
						    array_push($addtocart_id_arr,$rec_cart->addtocart_id);							
							array_push($sku_arr,$rec_cart->sku);
							
							} //quantity cehck conitions end
						   } ?>     
	                            
	                        </div>
				            
                            <div class="cart-total">
								<div class="total_left">Cart Total : </div>
								<div class="total_right">Rs. <?php echo " ".  number_format($total_price, 0, ".", ",")?></div>
								<div class="clearfix"> </div>
							</div>
                            
                            
								<!--<div class="btn_form">
				  <a href="cart.html"> <span class="submit">  Continue Shopping </span> </a>
                  <a href="cart.html"> <span class="buy-btn">  Proceed To Checkout  </span> </a>
				</div>
							-->		  <div class="clearfix"></div>
									</div>
					
							<script>$(document).ready(function(c) {
								$('.alert-close').on('click', function(c){
									$('.message').fadeOut('slow', function(c){
										$('.message').remove();
									});
								});	  
							});
							</script>
                            
                     <!--------------------------------------------Product & Price Deatil stored in Session start--------------------------------->
                     
                     			<?php 
											
											
											$dt= preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s')) ;
											
											$ccavenue_order_id =$this->session->userdata['session_data']['user_id'].implode('', $addtocart_id_arr).$dt;	
											
											$moonboy_trans_id=random_string('numeric',2).$dt;									
									
											$this->session->set_userdata('sessccavenue_order_id',$ccavenue_order_id);
											
											$this->session->set_userdata('sessmoonboy_trans_id',$moonboy_trans_id);
											
											$this->session->set_userdata('sessaddtocart_id_arr',implode('-', $addtocart_id_arr)); 
									   
											$this->session->set_userdata('sesstotal_price', $total_price); 
									   
											$this->session->set_userdata('sessseller_id_arr',implode('-', $seller_id_arr)); 
									   
											$this->session->set_userdata('sesstax_arr',implode('-', $tax_arr)); 
									   
											$this->session->set_userdata('sessshipping_fees_arr',implode('-', $shipping_fees_arr)); 
									   
											$this->session->set_userdata('subtotal_arr',implode('-', $sub_total_arr));
											
											$this->session->set_userdata('price_arr',implode('-', $price_arr));
									   
											$this->session->set_userdata('sessqantity_arr',implode('-', $qantity_arr));
									   
											$this->session->set_userdata('sesssku_arr',implode('*', $sku_arr));
									   
											$this->session->set_userdata('sesscus_data',@$cus_data->address_id);
											
											$this->session->set_userdata('color_arr',implode('-', $color_arr));
											
											$this->session->set_userdata('size_arr',implode('-', $size_arr));

								?>
                     
                     <!--------------------------------------------Product & Price Deatil stotred in Session end---------------------------------->       
							<?php if($cart_data->num_rows()!=0){ ?>
                            <h3 class="tittle">  Proceed To Pay  </h3>
                            <div style="width:51%; margin:auto; color:#fff;">
                            	<button id="proceed_to_pay" type="button" title="Proceed To Pay" class="btn-big2"  onClick="pay()"> Proceed To Pay </button>

                            </div>
                            <!------------------------------------------if Address Not Available------------------------------->
                            			
                            <div id="addrs_confrm_dv" style="display:none; clear:both;">
    							<span style="font-size:18px; color:#F00;">
                                You have not complete your personal information & 
                                <a href="#" >Address</a> in your account</span>
    						</div>
							<?php } else {?>
								<button id="proceed_to_pay" type="button" title="Continue Shopping" class="button btn-cart-big"  onClick="window.location.href='<?php echo base_url(); ?>'" > <i class="fa fa-angle-double-left"></i> Continue Shopping  </button>
							<?php } ?>
                            <!-------------------------------------------if Address Not Available------------------------------->
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <!------------------------------------------Online Payment Div Start--------------------------------------------------------------------------> 
		<div id="payment_div" style="display:none; clear: both;">
         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" >
                 Pay By Online
                </a>
              </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
              <div class="panel-body">
               <!--<h4 class="orange-txt"> Amount Payable Rs.15448 </h4>-->
               <!-----------------------------------ccavenue form start--------------------------->
               
               <form method="post" name="customerData" action="<?php echo base_url().'Online_payment' ?> ">
               
                <input type="hidden" name="tid" id="tid" value="<?php echo $moonboy_trans_id ?>" readonly />
				<input type="hidden" name="merchant_id" value="21635"/>
				<input type="hidden" name="order_id" value="<?php echo $ccavenue_order_id; ?>"/>
                
				<input type="hidden" name="amount" value="<?php  echo $total_price; ?>"/> 
                           
				<input type="hidden" name="currency" value="INR"/>
				<input type="hidden" name="redirect_url" value="<?=APP_BASE?>Online_payment/ccav_response_handler"/>
				<input type="hidden" name="cancel_url" value="<?=APP_BASE?>Online_payment/ccav_response_handler"/>
			 	<input type="hidden" name="language" value="EN"/>				
		     	<input type="hidden" name="billing_name" value="<?php echo @$cus_data->full_name; ?>"/>
		        <input type="hidden" name="billing_address" value="<?php echo @$cus_data->address; ?>"/>
		        <input type="hidden" name="billing_city" value="<?php echo @$cus_data->city; ?>"/>
		        <input type="hidden" name="billing_state" value="<?php echo @$cus_data->state_name; ?>"/>
		        <input type="hidden" name="billing_zip" value="<?php echo @$cus_data->pin_code; ?>"/>
		       <input type="hidden" name="billing_country" value="<?php echo @$cus_data->country ?>"/>
		       <input type="hidden" name="billing_tel" value="<?php echo @$cus_data->phone; ?>"/>
		       <input type="hidden" name="billing_email" value="<?php echo @$cus_data->email; ?>"/>
               
		       <INPUT TYPE="submit" value="Proceed For Payment" class="btn-success" style="font-size:20px; padding:10px;" > &nbsp;
		       <!--<img src="<?php echo base_url().'mobile_css_js/images/ccavenue_images.png' ?>" width="75" height="20" >-->
	      </form>	
               
               <!------------------------------------ccavenue form end----------------------------->
                            
              </div>
            </div>
            <div class="panel-heading" role="tab" id="headingFive">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" onClick="pay_by_cod('<?=$cus_data->pin_code?>'); DrawCaptcha();" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFour" >
                 Cash On Delivery
                </a>
              </h4>
            </div>
            
            <div id="collapseFive"  class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
              <div class="panel-body">
              <div id="valid_msg_dv" style="color:#F00; text-align:center"> </div>
           
            <div id="codcaptchadiv" style="display:none;">
              <div id="payment_cod_div">
 <h4> Pay using Cash-on-Delivery </h4> 
 <div class="captcha">
<table width="100%">
<tr>
    <td>
    	<strong> Verify Order </strong> <br>
		Type the characters you see in the image on the left.<br/><br/>
        <input type="text" id="txtCaptcha"/>
        <button id="btnrefresh" onclick="DrawCaptcha();"> <i class="fa fa-refresh"></i> </button>
        <input type="text" id="txtInput" class="captcha-input" placeholder="Enter the above code Here"/>
    </td>
    </tr>
    <tr>
    <td class="amnt-payble">
        Total Amount:
   <?php  echo " Rs.".round($total_price);
		  echo "<br>";
		  echo "----------------------------";
	?> <br><strong>
        <span style="font-size:17px;">
       <?php 
		
		$cod_totalprice=$total_price;
		$cod_chargeaswtgh=0;
		$cod_chargetobuyer=0;
		$codtaxamount=0;
		$cod_chargeaswtgheach=0;
		
		$total_weightcharge=0; // varaible for session
		$total_taxchrgetobuyer=0; // varaible for session
		$total_chargetocustomer=0; // varaible for session
		$total_chargetomoonboy=0; // varaible for session
		$totatl_discounttobuyer=0;// varaible for session
		
		
		//------------------------------------COD charges start---------------------------------------
		
		for($codj=0;$codj<count($prod_weight); $codj++)
		{
			$prod_weighteach=$prod_weight[$codj];
			$wtchrg_query=$this->db->query("SELECT * FROM cod_chargeasper_weight WHERE (wt_from <= '$prod_weighteach') AND (wt_to >= '$prod_weighteach') ");
			if($wtchrg_query->num_rows()>0)
			{
				$wtchrg_row=$wtchrg_query->row();
				$cod_chargeaswtgheach=$wtchrg_row->wt_charge;
				
				//-------------------amount to be charge start--------------------------
					
						$cod_percen_query=$this->db->query("SELECT * FROM cod_tobecharged WHERE charge_to='Buyer' ");
						if($cod_percen_query->num_rows()>0)
						{
							$cod_percen_row=$cod_percen_query->row();
							$cod_percen_charge=$cod_percen_row->Percentage_charge;
							
							 $cod_chargetobuyer=$cod_chargetobuyer+round(($cod_chargeaswtgheach/100)*$cod_percen_charge);
							 
							 $total_weightcharge=$cod_chargetobuyer; // total weight for session
							 $total_chargetocustomer=$cod_chargetobuyer; // total charge to buyer for session
							 
							 if($cod_percen_charge!='100')
							 {$total_chargetomoonboy=$total_chargetomoonboy+round(($cod_chargeaswtgheach/100)*(100-$cod_percen_charge));}
							//$cod_chargetobuyer=$cod_chargetobuyer+round($codtaxamount);		
							
							//--------------------------tax charge to buyer start--------------------
							
									/*if($cus_data!=""){
													
										$codcharge_stateid=$cus_data->cod_stateid;
										$codtax_query=$this->db->query("SELECT * FROM cod_taxratecharges WHERE state_id='$codcharge_stateid' ");
										if($codtax_query->num_rows()>0)
										 {
											$row_codtax=$codtax_query->row();
											$cod_taxpercentage=$row_codtax->taxrate;
											
											$codtaxamount=$codtaxamount+($total_price/100)*$cod_taxpercentage;
											$cod_chargetobuyer=$cod_chargetobuyer+$codtaxamount;
										 
										 }
										 else
										 {$cod_totalprice=$cod_totalprice+$cod_chargetobuyer;} 
										// if condition of tax ends	
								}*/ // cus_data condition end
							//--------------------------tax charge to buyer end----------------------							
							
						} 
						else // else condition of tobe charge 
						{$cod_totalprice=$cod_totalprice+$cod_chargeaswtgheach;}
						
						// if condition of tobe charge end
					} 
					
					// weight condtion end  
						 
				} // forloop end
					
				//-------------------amount to be charge end----------------------------
				
				
				
				
				//--------------------------tax charge to buyer start--------------------
							
									if($cus_data!=""){
													
										$codcharge_stateid=$cus_data->cod_stateid;
										$codtax_query=$this->db->query("SELECT * FROM cod_taxratecharges WHERE state_id='$codcharge_stateid' ");
										if($codtax_query->num_rows()>0)
										 {
											$row_codtax=$codtax_query->row();
											$cod_taxpercentage=$row_codtax->taxrate;
											
											$codtaxamount=$codtaxamount+($total_price/100)*$cod_taxpercentage;
											
											$total_taxchrgetobuyer=$codtaxamount; // tax for session variable
											
											$cod_chargetobuyer=$cod_chargetobuyer+$codtaxamount;
										 
										 }
										 else
										 {$cod_totalprice=$cod_totalprice+$cod_chargetobuyer;} 
										// if condition of tax ends	
								} // cus_data condition end
				//--------------------------tax charge to buyer end----------------------
				
			 
			if($cod_chargetobuyer!=0 && $codtaxamount!=0)
			{
					echo "(COD Charges+Tax) :Rs.". round($cod_chargetobuyer);
					echo "<br>";
					echo "-------------------------------------";
					echo "<br>";
				$cod_totalprice=$cod_totalprice+$cod_chargetobuyer;
				//echo "(COD Charges+Tax) :". $cod_totalprice;
				$cod_discountquery=$this->db->query("SELECT * FROM cod_discount WHERE (discount_from<='$total_price') AND (discount_to>='$total_price')");
				
				if($cod_discountquery->num_rows()>0)
				{
					//echo "(COD Charges+Tax) :Rs.". round($cod_totalprice);
					//echo "<br>";
					//echo "--------------------------------------------";
					//echo "<br>";
					$cod_discount_row=$cod_discountquery->row();
					$cod_discountpercentage=$cod_discount_row->discount_percentage;
					$cod_discountamount=($cod_chargetobuyer/100)*$cod_discountpercentage;
					
					$totatl_discounttobuyer=$cod_discountamount;
					
					$cod_totalprice=$cod_totalprice-$cod_discountamount;
					
					echo "Discount On COD Charges :Rs.". round($cod_discountamount);
					echo "<br>";
					echo "--------------------------------------";
					echo "<br>";
					echo "Amount Payable Rs.".round($cod_totalprice);
										
				}else
				{
					//echo $cod_chargetobuyer."  ".$codtaxamount." ".$prod_weight." ".$cod_chargeaswtgh; 
					echo "Amount Payable Rs.".round($cod_totalprice);
				}
			}
			else
			{
				//echo " ". $total_price;
				
				if($cod_chargeaswtgheach!=0 && $cod_chargetobuyer==0)
				{
					echo "(COD Charges) :Rs.". round($cod_chargeaswtgheach);
					echo "<br>";
					echo "-------------------------------------";
					echo "<br>";
					echo "Amount Payable Rs.". round($cod_totalprice);
						
				}
				
				if($cod_chargeaswtgheach!=0 && $cod_chargetobuyer!=0)
				{
					echo "(COD Charges+Tax) :Rs.". round($cod_chargetobuyer);
					echo "<br>";
					echo "-------------------------------------";
					echo "<br>";
					echo "Amount Payable Rs.". round($cod_totalprice);
						
				}
				else{
				echo "Amount Payable Rs.". round($cod_totalprice);
				}
			}
		//------------------------------------COD charges end-----------------------------------------
		
		
		 ?>
	<?php	$this->session->set_userdata('sesscodtotal_price', round($cod_totalprice));
	
	
			$this->session->set_userdata('sesstotal_weightcharge',$total_weightcharge);
   
    		$this->session->set_userdata('sesstotal_taxchrgetobuyer', $total_taxchrgetobuyer);
   
    		$this->session->set_userdata('sesstotal_chargetocustomer',$total_chargetocustomer);
		
			$this->session->set_userdata('sesstotal_chargetomoonboy',$total_chargetomoonboy);
		
			$this->session->set_userdata('sesstotatl_discounttobuyer',$totatl_discounttobuyer);  
		
		?>
        </span>
        </strong>
    </td>
</tr>

</table>
   <!--<button id="proceed_to_pay" type="button" title="Add to Cart" class="btn-success" >Confirm your Order</button>-->
    <br>
   <button id="proceed_to_paybycod" type="button" title="Add to Cart" class="btn-big2" onClick="ValidCaptcha('<?php echo implode('-', $addtocart_id_arr)?>',<?php echo $total_price ?>,'<?php echo implode('-', $seller_id_arr)?>','<?php echo implode('-', $tax_arr)?>','<?php echo implode('-', $shipping_fees_arr)?>','<?php echo implode('-', $sub_total_arr)?>','<?php echo implode('-', $qantity_arr)?>','<?php echo implode('*',$sku_arr)?>', '<?php echo $cus_data->address_id ?>','<?php echo implode('-',$price_arr);?>','<?php echo implode('-',$color_arr);?>','<?php echo implode('-',$size_arr);?>' )" >Confirm your Order</button>
   	
    <div style="text-align:left; color:#F00;"><br /> As per Govt directive, we will not be able to accept the old Rs. 500 and Rs. 1000 currency notes. We request you to keep the right denominations handy for payment at delivery. </div>
    
    <div style="text-align:left; color:#C3F;"><br /> Pay using Credit Card/Debit Card/Netbanking/other prepaid option to get Faster Delivery and avoid additional 'COD' charges. </div>

   </div>
   
  </div>
              
                            
              </div>
            </div>
            </div>
            
  	</div>
	</div>
   <!---------------------------------------Online Payment Div End------------------------------------------------------------------------------------> 
   
   
   
  <!--<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Pay By Wallet 
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      <h6 class="actual"> <span> Total Wallet Balance: Rs.471 </span> </h6>
      <div class="clearfix"> </div>
      <p> Cannot pay by wallet due to insufficient balance. </p>
	 <h4 class="orange-txt"> Amount Payable Rs. 15448 </h4>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         Gift Voutcher 
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      <h4 class="orange-txt"> Amount Payable Rs.15448 </h4>
      
        <div class="login-frm">
        <input type="text" name="gv_number" placeholder="Enter Gift Voutcher Number">
        <input type="submit" value="APPLY">
         </div>               
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Using Coupon 
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
       <h4 class="orange-txt"> Amount Payable Rs.15448 </h4>
       
      <div class="login-frm">
         <input id="gv_number" type="text" name="gv_number" placeholder="Enter Coupon Code">
         <input type="submit" value="APPLY">
        </div>                
      </div>
    </div>
  </div>
  
  
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
         COD
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
       <h4 class="orange-txt"> Amount Payable Rs.15448 </h4>
       
      Currently COD Service not available to your location,Please go for Online Payment               
      </div>
    </div>
  </div>-->
  
  <div class="clearfix"> &nbsp; </div>
</div>                   
                            
						</div>
				  <!--/cart-->
				  
  </div>

     <!--/view-product-->
				
		</div>
    
    

<?php include "footer.php"; ?>