<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php echo $data1->meta_descrp ;?>" content="">
        <meta name="<?php echo $data1->meta_keyword ;?>" content=""/>

		<title><?php echo $data1->title ;?></title>
        <script>
		function show_onlinepayment()
		{
			$('#onlinepay_div').css('display','block');
		}
		</script>

<?php include "header.php"; 

$qantity_arr=array();
$sku_arr=array();   
?>

<!------ Start Content ------>

<?php if(@$result[0]->order_status=='Failed') {
	$this->load->helper('string');
	 date_default_timezone_set('Asia/Calcutta');
	
	$dt= preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s')) ;
	
	$moonboy_trans_id=random_string('numeric',2).$dt;
	
	$user_id=$this->session->userdata['session_data']['user_id'];
		$query=$this->db->query("select a.mob, a.email,a.mob,a.address_id,b.*,c.state AS state_name from user a inner join user_address b on a.user_id=b.user_id INNER JOIN state c ON b.state=c.state_id where a.user_id=$user_id and a.address_id=b.address_id  ");

		$cus_data=$query->row();

	}?>

<div class="main-content"> 

   <!-- <div class="main-content_inn">
		<form name="persional_info_form" class="persional_info_form">
        	<input type="text">
        </form>
    </div> -->
	
    <div class="order-details">
    <div class="col-md-6">
    <h2 class="title4"> Orders Details </h2>
    <table  class="table table-striped">
    <!--<tr> <td> Order ID: </td> <td> OD304191371012843002 (1 Item)</td> </tr>-->
    <tr> <td> Order ID: </td> <td> 
	<?= @$result[0]->order_id ;?> <?php @$session_order_id=$result[0]->order_id; @$sess_ccavenue_ordrid=$result[0]->order_id_payment_gateway?></td> </tr>
    <tr> <td> Seller: </td> <td> <a target="_blank" href="<?php echo base_url() ;?>sellers/<?= base64_encode(@$result[0]->seller_id);?>"><?= @$result[0]->business_name ;?></a> </td> </tr>
    <tr> <td> Order Date: </td> <td> <?= //date("d-m-Y", strtotime($result[0]->date_of_order));
	date('M-d-Y',strtotime(@$result[0]->date_of_order))
	?> </td> </tr>
    <tr> <td> Amount Paid: </td> <td> Rs. <?= @$result[0]->Total_amount ;?> &nbsp;through <?= @$result[0]->payment_type ;?></td> </tr>
    <tr> <td> Status : </td> <td>
	<?php if(@$result[0]->order_status == 'Pending payment' && @$result[0]->order_processstatus == 'Order Placed Successfully By Buyer'){ ?>
		Order Placed by COD
	<?php } else {?>
	<?= ucwords(@$result[0]->order_status) ; ?>
	<?php } ?>
	<?php @$prod_qntarr=array(); 
	foreach($result_product as $resqnt)
	{
		$qry_qnt=$this->db->query("SELECT sku,quantity FROM product_master WHERE sku='$resqnt->sku' ");
		$rw_qnyt=$qry_qnt->row();
		if($rw_qnyt->quantity==0)
		{array_push($prod_qntarr,$rw_qnyt->sku);}
	}
	
	if($result[0]->order_status=='Failed' ){  //if(count($prod_qntarr)>0){ ?> 
	<input type="button" value="Revise Payment Method" onClick="show_onlinepayment()"> <?php //} else{ ?>  <!--<span style="background-color:#900; color:#FFF; font-weight:bold;">In This Order Products are Out Of Stock. </span> -->
	<?php //} 
	} ?>  </td> </tr>
    </table>
    </div>

    
    <div class="col-md-6 adrs-details">
    <h3> <?= $result[0]->full_name ;?></h3>
    <p> <?= $result[0]->phone ;?> <br>
    <?= $result[0]->address ;?> <br>
    <?= $result[0]->city ;?>, <?= $result[0]->state ;?> - <?= $result[0]->pin_code ;?>,<br/><?= $result[0]->country ;?>
    </p>
    </div>
    <div class="clearfix"></div>          
    </div>
  <!--  <div class="manage-order"> 
    <table width="100%" border="0" cellspacing="5">
  <tr>
    <td colspan="3" bgcolor="#f1f1f1"> <h4> Manage Order </h4></td>
  </tr>
  <tr>
    <td align="center" style="border-right:1px solid #f1f1f1; width:33%;"> <a href="<?php// echo base_url().'admin/sales/generate_order_slip/'.$result[0]->order_id  ; ?>" title="Print Order"> <i class="fa fa-print"></i> <br> Print Order </a> </td>
    <td align="center" style="border-right:1px solid #f1f1f1; width:33%;"> 
  
    </td>
    <td align="center"> <a href="#"> <i class="fa fa-phone"></i> <br> Call </a> </td>
  </tr>
</table>

    </div> -->
    
    
    <!-- ccavenue iframe start -->
    <div id="onlinepay_div" style="display:none;" >
  

    <?php 
	if($result[0]->order_status=='Failed')
	{
	$ccavenue_data_arr=array(
		'tid'=>$moonboy_trans_id,
		'merchant_id'=>21635,
		'order_id'=>$result[0]->order_id_payment_gateway,
		'amount'=>$result[0]->Total_amount,
		'currency'=>'INR',
	 	'redirect_url'=>'https://www.moonboy.in/Online_payment/ccav_response_handler_revisepayment',
	 	'cancel_url'=>'https://www.moonboy.in/Online_payment/ccav_response_handler_revisepayment',
	 	'language'=>'EN',
	 	'billing_name'=>$cus_data->full_name,
	  	'billing_address'=>$cus_data->address,
	  	'billing_city'=>$cus_data->city,
		'billing_state'=>$cus_data->city,
		'billing_zip'=>$cus_data->pin_code,
		'billing_country'=>$cus_data->country,
		'billing_tel'=>$cus_data->phone,
		'billing_email'=>$cus_data->email,
		'integration_type'=>'iframe_normal'
	);
	}
	?>
    
     <!--ccAvenue Iframe data start-->
    
    <?php include('Crypto.php')?>

<?php 

	//error_reporting(0);

	$working_key='A6E109AE1CF65837E8964E0B04552D21';//Shared by CCAVENUES
	$access_code='AVOE00BA76CA08EOAC';//Shared by CCAVENUES
	$merchant_data='';
	
	//foreach ($_POST as $key => $value){
	
	foreach ($ccavenue_data_arr as $key => $value){
		
		$merchant_data.=$key.'='.$value.'&';	
	}
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

	$production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
	
?>
<iframe src="<?php echo $production_url?>" id="paymentFrame" width="800" height="400"  frameborder="0" scrolling="No" ></iframe>

   </div>
   <!-- ccavenue iframe end -->
    
    <div class="ordr-prdct-details">
    <table width="100%" border="0" cellspacing="5">
  <tr>
    <td colspan="3" bgcolor="#f1f1f1"> <h4> Product Details </h4></td>
  </tr>
  <tr> 
  <td class="order_product_td">
  <?php
  $sl=0;
  foreach($result_product as $rows){
	$qantity_arr=array();
	$sku_arr=array();
	array_push($qantity_arr,$rows->quantity);
	array_push($sku_arr,$rows->sku);
	 $sl++;
	 $image = explode(',',$rows->imag);
  ?>
     <div class="order_img"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku ?>" target="_blank"> <img alt="<?=$rows->name;?>" src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" /></a> </div>
            <div class="order_data"> 
                <div class="col-md-5 left">
                
                <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku ?>" target="_blank">
                    <h3> <?= $rows->name ;?> </h3>
                    </a>
                    
                    <?php
                    // if($rows->prdt_color != 'not'){ echo "<span class='cart_attr'>Color : ".$rows->prdt_color.'</span><br/>'; }
									 
   					// if($rows->prdt_size != 'not'){ echo "<span class='cart_attr'>Size : ".$rows->prdt_size.'</span><br/>';}
					 
					 
					 
					 
					 //---------------------------Capacity,RAM,ROM display start--------------------
									
										
									$color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rows->sku' group by sku ");
									if($color_sizecronjobquery->num_rows()>0)
									{										
										$color=$color_sizecronjobquery->row()->color;
										$size=$color_sizecronjobquery->row()->size;	
										$capacity=$color_sizecronjobquery->row()->Capacity;
										$ram=$color_sizecronjobquery->row()->RAM;
										$rom=$color_sizecronjobquery->row()->ROM;
									}
									
									if($color != ''){ echo "<span class='cart_attr'>Color : ".$color.'</span><br/>';} 
									if($size != ''){ echo "<span class='cart_attr'>Size : ".$size.'</span><br/>'; }
									if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>'; }
									if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>'; }
									if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>'; }
									//---------------------------Capacity,RAM,ROM display end--------------------
					?>
                    
                    <span>Quantity : <?= $rows->quantity ;?></span>
                    <span class="price2" style="padding:10px 0px; text-align:left; ">Rs. <?= $rows->sub_total_amount ;?></span>  
                    <div class="clearfix"></div>
                    <?php 
					if($result[0]->order_status == 'Delivered' || $result[0]->order_status == 'Return Requested' || $result[0]->order_status == 'Return Received'){ ?>
					
                    <span> <a href="#add_review<?=$sl;?>" class="order_id inline"> REVIEW PRODUCT</a> </span>
                    
<!--- lightbox div start  ---->                 
<div style="display:none">
      <div id="inline_content_return_details<?=$sl;?>" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         <h4 class="title6 sn">Given Your Return Request Details</h4>
		<div class="col-md-12">
            <table class="edit_address_form">
                <tr>
                    <td width="150px">Choose Return Type : </td>
                    <td>
                        <select id="return_typ<?=$sl;?>" onChange="getReason(this.value)" class="input-text">
                        	<option value="">---select---</option>
                        	<option value="Refund">Refund</option>
                            <option value="Replacement">Replacement</option>
                        </select>
                    </td>
                </tr>
				<tr class="refund_reason">
                	<td>Refund Reason : </td>
                    <td>
						<select id="refund_reason" class="input-text">
                        	<option value="">---select---</option>
                        	<option value="It is not same product as displayed">It is not same product as displayed</option>
                            <option value="Quantity as not displayed">Quantity as not displayed</option>
                            <option value="Other">Other</option>
                        </select>
					</td>
                </tr>
				<tr class="refund_reason">
                	<td>Refund Type : </td>
                    <td>
						<input type="radio" name="refund_type" id="refund_bank" value="bank">  bank account transfer    
						<input type="radio" name="refund_type" id="refund_wallet" value="Wallet">  wallet 
					</td>
                </tr>
				<tr class="bank_details">
					<td>Bank_Details : </td>
					<td>
						<input type="text" class="input-text" placeholder="Enter Holder Name">
						<input type="text" class="input-text" placeholder="Enter Account Number">
						<input type="text" class="input-text" placeholder="Enter IFS Code">
					</td>
				</tr>
				<tr class="replacement_reson">
                	<td>Replacement Reason : </td>
                    <td>
						<select id="replacement_reason" class="input-text">
                        	<option value="">---select---</option>
                        	<option value="Defective Product">Defective Product</option>
                            <option value="Missing Itens">Missing Itens</option>
                            <option value="Other">Other</option>
                        </select>
					</td>
                </tr>
                <tr>
                	<td>Comment : </td>
                    <td><textarea id="return_comnt<?=$sl;?>" class="input-text"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input  type="submit" id="return_btn<?=$sl; ?>" onClick="product_returnFunction(<?= $rows->id;?>,<?=$sl;?>)" class="btn-sign-in" value="Submit">
                    </td>
                </tr>
          </table>
	</div>
    </div>
  </div>
</div>
<!--- lightbox div start  ---->                
                    
                    <?php }else{ ?>
                    <span> <a href="#" onClick="alert('You can Review this product after the product is delivered.');return false;" class="order_id1"> REVIEW PRODUCT </a> </span>
                    
                    <?php } ?>
                    
<!--- lightbox div start here --->             
<div style="display:none">
    <div id="add_review<?=$sl;?>" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title6 sn">Write Review</h4>
		<div class="col-md-12">
<table width="100%" border="0" cellspacing="5" class="rating">
	<tr>
    <td width="28%"> Review Title: </td>
    <td width="72%"><input type="text" name="product_review_title" id="product_review_title<?=$sl;?>" placeholder="Review title Here"  class="input-text" ><br/><span class="error1"></span></td>
  </tr>
  <tr>
    <td valign="top"> Your Review: </td>
    <td> <textarea rows="3" cols="50"  class="input-text" name="product_review_cont" id="product_review_cont<?=$sl;?>"></textarea> </td>
  </tr>
  <tr>
    <td>Your rating :</td>
    <td>
      <select id="backing2c<?=$sl;?>" name="product_rating">
        <option value="1">Bad</option>
        <option value="2">OK</option>
        <option value="3">Great</option>
        <option value="4">Excellent</option>
        <option value="5">Excellent1</option>
      </select>
      <div class="rateit" data-rateit-backingfld="#backing2c<?=$sl;?>" data-rateit-min="0"></div>
    </td>
  </tr>
  
   <tr>
    <td>&nbsp;</td>
    <td><button type="button" title="Submit" id="rev_pdt_btn<?=$sl;?>"  class="button btn-cart-big" onClick="getProductReviewData(<?= $rows->product_id ;?>,'<?= $rows->sku ;?>',<?=$sl;?>)"> Submit </button></td>
  </tr>
  <tr id="show_ssmsg<?=$sl;?>"><td colspan="2"><div id="show_ssmsg_dv<?=$sl;?>"></div></td></tr>
</table>

	</div>
            
        </div>
      </div>
</div>            
<!--- lightbox div end here --->   
        </div>

       <!--- return option show only in delivered status --->

       <div class="col-md-3 manage-order">
         <?php if($result[0]->invoice_id == ''){ ?>
    	<a href='#' onClick="alert('Invoice is not available.');return false;" title="Invoice"> <i class="fa fa-file-text-o"></i><br> Download Invoice </a>
    <?php }else if($result[0]->order_status == 'Delivered'){?>
    	<a href='<?php echo base_url().'admin/sales/generate_invoice_slip/'.$result[0]->order_id ; ?>' title="Invoice"> <i class="fa fa-file-text-o"></i><br> Download Invoice </a>
       <?php }else{ ?>
       		<a href='#' onClick="alert('Invoice is not available.');return false;" title="Invoice"> <i class="fa fa-file-text-o"></i><br> Download Invoice </a>
       <?php } ?>
       </div>
       <!-- On 02/12
	   <div class="col-md-2 ordr_details_sts_dv">  
		   <?//php if($rows->product_order_status == 'Delivered'){ ?>
            <a class="cancl_prdt" href="<?//php echo base_url(); ?>my_order/return_product/<?//= base64_encode($this->encrypt->encode($rows->id)); ?>">Return</a>
           <?//php }else{?> 
            <span><?//=$rows->product_order_status;?></span>
           <?//php }?>
       </div>  -->
       
       <div class="col-md-3 ordr_details_sts_dv trackng_dv">
		  <?php if($tracking_details != false){ ?>
          <ul>
          	<li><strong>Shipment Date</strong> : <br/><?=$tracking_details->shipping_date;?></li>
            <li><strong>Shipment No.</strong> : <br/><?=$tracking_details->shipment_no;?></li>
            <li><strong>Courier Name</strong> : <br/><?=$tracking_details->courier_name;?></li>
            <li><strong>Tracking No.</strong> : <br/><?=$tracking_details->tracking_no;?></li>
          </ul>
          <?php } ?>
       </div>
       
       <!--- return option show only in delivered status --->    
         
  </div>
  <!--- End of order_data div --->
  
  <div class="clearfix"></div>
  <hr/>

            
     <?php } //End of foreach loop ?>
     <span class="price2 total_spn">Total <strong>Rs. <?= $result[0]->Total_amount ;?></strong></span>
    </td>
    </tr></table>
 </div>
<div class="clearfix">&nbsp;</div>


<?php


		$this->session->set_userdata('sess_orderid',$session_order_id);
		 $this->session->set_userdata('sess_qntarr',implode('-',$qantity_arr));       
        $this->session->set_userdata('sess_skuarr',implode('-',$sku_arr));
		$this->session->set_userdata('sess_ccaavenueorderid',$sess_ccavenue_ordrid);
		
 include "footer.php"; 

 		
?>

<script>
function cancelOrder(val){
	var m = confirm('Are you sure to cancel this order ?');
	if(m){
		$.ajax({
			url:'<?php echo base_url(); ?>user/order_cancelation',
			method:'post',
			data:{id:val},
			success:function(result){
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
	}else{
		return false;
	}
}
</script>


<!--Review script start here-->
<link href="<?php echo base_url(); ?>rateit/src/rateit.css" rel="stylesheet" type="text/css">
<!--<script src="<?php// echo base_url(); ?>rateit/src/jquery.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>rateit/src/jquery.rateit.js" type="text/javascript"></script>

<!--- product review script start here ---->
<script>
function getProductReviewData(val,val1,sl){
	var product_rev_title = $('#product_review_title'+sl).val();
	var product_rev_cont = $('#product_review_cont'+sl).val();
	var product_ratingt = $('#backing2c'+sl).val();
	if(product_rev_title == ''){
		alert('Please enter review title.');
		$('#product_review_title'+sl).focus();
		return false;
	}else if(product_rev_cont == ''){
		alert('Please enter your review.');
		$('#product_review_cont'+sl).focus();
		return false;
	}/*else if(product_rev_cont.length < 200){
		alert('your review contains at least 200 characters.');
		$('#product_review_cont'+sl).select();
		return false;
	}*/else if(product_ratingt == ''){
		alert('Please rate this product.');
		return false;
	}else{
		$('#rev_pdt_btn'+sl).text('Wait...');
		$.ajax({
		  url:'<?php echo base_url(); ?>user/product_review',
		  method:'post',
		  data:{title:product_rev_title,content:product_rev_cont,rating:product_ratingt,product_id:val,sku_id:val1},
		  success:function(result) {
			  
			if(result == 'success'){
				  $("#show_ssmsg_dv"+sl).html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Your review have been submited successfully.');
				  $("#show_ssmsg_dv"+sl).css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'})
				  $("#show_ssmsg"+sl).fadeIn();
				  $('#rev_pdt_btn'+sl).text('Submit');
				  window.location.reload(true);
				  setTimeout(function() { location.reload() },1500);
			  }
			  if(result == 'exists'){
				  $('#rev_pdt_btn'+sl).text('Submit');
				  alert('you have been already reviewed this product');
				  window.location.href='<?php echo base_url(); ?>review-rating';
			}
		  }
	  });
	}
}
</script>
<!--- product review script end here ---->

<script>
$(document).ready(function(){
	$('.refund_reason').hide();
	$('.replacement_reson').hide();
	$('.bank_details').hide();
});

$(':radio').change(function (event) {
	var value = $(this).val(); //alert(id); return false;
	if(value == 'bank'){
		$('.bank_details').show();
	}else{
		$('.bank_details').hide();
	}
});

function getReason(val){
	//var v = $("input[name='refund_type']:checked").val(); alert(v); return false;
	if(val == 'Refund'){
		$('.dflt').hide();
		$('.replacement_reson').hide();
		$('.refund_reason').show();
	}
	else if(val == 'Replacement'){
		$('.dflt').hide();
		$('.refund_reason').hide();
		$('.replacement_reson').show();
	}
	
}

function product_returnFunction(id,sl){
	var retn_typ = $('#return_typ'+sl).val();
	if(retn_typ == 'Refund'){
		var reason = $('#refund_reason'+sl).val();
	}
	else if(retn_typ == 'Replacement'){
		var reason = $('#replacement_reason'+sl).val();
	}
	var comnt = $('#return_comnt'+sl).val();
	
	if(retn_typ == ''){
		alert('Please choose return type.');
		return false;
	}
	else if(reason == ''){
		alert('Please choose your reason.');
		return false;
	}else{
		
		$('#return_btn'+sl).val('Processing...');
		$.ajax({
			url:'<?php echo base_url();?>user/product_return',
			method:'post',
			data:{return_prdt_id:id,retn_typ:retn_typ,reason:reason,comnt:comnt},
			success:function(result){
				if(result == 'success'){
					window.location.reload(true);
				}
				if(result == 'not')
				$('#return_btn'+sl).val('Some occurred ! Please Try again');
			}
		});
		
	}
}



</script>

</body>

</html>