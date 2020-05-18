<?php include "header.php"; ?>
	<style>
	.table-striped>tbody>tr:nth-of-type(odd) {
		background-color: #f0f0f0;
	}
	</style>
	<script>
		function show_onlinepayment()
		{
			$('#onlinepay_div').css('display','block');
		}
	</script>
	
	<?php if(@$result[0]->order_status=='Failed') {
	$this->load->helper('string');
	date_default_timezone_set('Asia/Calcutta');
	
	$dt= preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s')) ;
	
	$moonboy_trans_id=random_string('numeric',2).$dt;
	
	$user_id=$this->session->userdata['session_data']['user_id'];
		$query=$this->db->query("select a.mob, a.email,a.mob,a.address_id,b.*,c.state AS state_name from user a inner join user_address b on a.user_id=b.user_id INNER JOIN state c ON b.state=c.state_id where a.user_id=$user_id and a.address_id=b.address_id  ");

		$cus_data=$query->row();

	}?>
	<?php if($result[0]->order_status=='Pending payment' && $result[0]->order_processstatus !=='Order Placed Successfully By Buyer') {
	$this->load->helper('string');
	date_default_timezone_set('Asia/Calcutta');
	
	$dt= preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s')) ;
	
	$moonboy_trans_id=random_string('numeric',2).$dt;
	
	$user_id=$this->session->userdata['session_data']['user_id'];
		$query=$this->db->query("select a.mob, a.email,a.mob,a.address_id,b.*,c.state AS state_name from user a inner join user_address b on a.user_id=b.user_id INNER JOIN state c ON b.state=c.state_id where a.user_id=$user_id and a.address_id=b.address_id  ");

		$cus_data=$query->row();

	}?>
<div class="wrap">

<div class="order-details">
<div class="info-inner" style="padding: 6px;">
    <div class="od-dtl">
    <h2 class="title4"  style="font-size: 18px; margin-bottom:5px;"> Orders Details </h2>
        <table  class="table table-striped">
    <!--<tr> <td> Order ID: </td> <td> OD304191371012843002 (1 Item)</td> </tr>-->
    <tr> <td> Order ID: </td> <td> 
	<?= $result[0]->order_id ;?> <?php $session_order_id=$result[0]->order_id; $sess_ccavenue_ordrid=$result[0]->order_id_payment_gateway?></td> </tr>
    <tr> <td> Seller: </td> <td> <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($result[0]->seller_id);?>"><?= $result[0]->business_name ;?></a> </td> </tr>
    <tr> <td> Order Date: </td> <td> <?= //date("d-m-Y", strtotime($result[0]->date_of_order));
	date('M-d-Y',strtotime($result[0]->date_of_order))
	?> </td> </tr>
    <tr> <td> Amount Paid: </td> <td> Rs. <?= $result[0]->Total_amount ;?> &nbsp;through <?= $result[0]->payment_type ;?></td> </tr>
    <tr> <td> Status : </td> <td style="vertical-align: middle;">
	<?php if(@$result[0]->order_status == 'Pending payment' && @$result[0]->order_processstatus == 'Order Placed Successfully By Buyer'){ ?>
		Order Placed by COD
	<?php } else {?>
	<?= ucwords($result[0]->order_status) ; ?>
	<?php } ?>
	<?php $prod_qntarr=array(); 
	foreach($result_product as $resqnt)
	{
		$qry_qnt=$this->db->query("SELECT sku,quantity FROM product_master WHERE sku='$resqnt->sku' ");
		$rw_qnyt=$qry_qnt->row();
		if($rw_qnyt->quantity==0)
		{array_push($prod_qntarr,$rw_qnyt->sku);}	
	}
	
	if($result[0]->order_status=='Failed' ){
		//if(count($prod_qntarr)>0){ ?>
		<form method="post" name="customerData" action="<?php echo base_url().'Online_payment' ?> ">
               
                <input type="hidden" name="tid" id="tid" value="<?php echo $moonboy_trans_id ?>" readonly />
				<input type="hidden" name="merchant_id" value="21635"/>
				<input type="hidden" name="order_id" value="<?php echo $result[0]->order_id_payment_gateway; ?>"/>
                
				<input type="hidden" name="amount" value="<?php  echo $result[0]->Total_amount; ?>"/> 
                           
				<input type="hidden" name="currency" value="INR"/>
				<input type="hidden" name="redirect_url" value="https://www.moonboy.in/Online_payment/ccav_response_handler"/>
				<input type="hidden" name="cancel_url" value="https://www.moonboy.in/Online_payment/ccav_response_handler"/>
			 	<input type="hidden" name="language" value="EN"/>				
		     	<input type="hidden" name="billing_name" value="<?php echo $cus_data->full_name; ?>"/>
		        <input type="hidden" name="billing_address" value="<?php echo $cus_data->address; ?>"/>
		        <input type="hidden" name="billing_city" value="<?php echo $cus_data->city; ?>"/>
		        <input type="hidden" name="billing_state" value="<?php echo $cus_data->state_name; ?>"/>
		        <input type="hidden" name="billing_zip" value="<?php echo $cus_data->pin_code; ?>"/>
		       <input type="hidden" name="billing_country" value="<?php echo $cus_data->country ?>"/>
		       <input type="hidden" name="billing_tel" value="<?php echo $cus_data->phone; ?>"/>
		       <input type="hidden" name="billing_email" value="<?php echo $cus_data->email; ?>"/>
               
		       <input type="submit" value="Revise Payment Method" style="padding: 5px;font-size: 0.9em;border: 1px solid #ddd; color: #444;background: none;margin: -15px 62px -15px 0px;float: right; width: 57%; background-color:green; color:#fff;"> &nbsp;
		       <!--<img src="<?php echo base_url().'mobile_css_js/images/ccavenue_images.png' ?>" width="75" height="20" >-->
	      </form>
		<?php //} else{ ?>
			<!--<span style="background-color:#900; color:#FFF; font-weight:bold;">In This Order Products are Out Of Stock. </span>-->
		<?php //}
		} ?>
		
		<?php 
			if($result[0]->order_status=='Pending payment' && $result[0]->order_processstatus !=='Order Placed Successfully By Buyer' ){
		?>
			<form method="post" name="customerData" action="<?php echo base_url().'Online_payment' ?> ">
               
                <input type="hidden" name="tid" id="tid" value="<?php echo $moonboy_trans_id ?>" readonly />
				<input type="hidden" name="merchant_id" value="21635"/>
				<input type="hidden" name="order_id" value="<?php echo $result[0]->order_id_payment_gateway; ?>"/>
                
				<input type="hidden" name="amount" value="<?php  echo $result[0]->Total_amount; ?>"/>
				<input type="hidden" name="currency" value="INR"/>
				<input type="hidden" name="redirect_url" value="https://www.moonboy.in/Online_payment/ccav_response_handler"/>
				<input type="hidden" name="cancel_url" value="https://www.moonboy.in/Online_payment/ccav_response_handler"/>
			 	<input type="hidden" name="language" value="EN"/>				
		     	<input type="hidden" name="billing_name" value="<?php echo $cus_data->full_name; ?>"/>
		        <input type="hidden" name="billing_address" value="<?php echo $cus_data->address; ?>"/>
		        <input type="hidden" name="billing_city" value="<?php echo $cus_data->city; ?>"/>
		        <input type="hidden" name="billing_state" value="<?php echo $cus_data->state_name; ?>"/>
		        <input type="hidden" name="billing_zip" value="<?php echo $cus_data->pin_code; ?>"/>
		       <input type="hidden" name="billing_country" value="<?php echo $cus_data->country ?>"/>
		       <input type="hidden" name="billing_tel" value="<?php echo $cus_data->phone; ?>"/>
		       <input type="hidden" name="billing_email" value="<?php echo $cus_data->email; ?>"/>
			   
		       <input type="submit" value="Revise Payment Method" style="padding: 5px;font-size: 0.9em;border: 1px solid #ddd; color: #444;background: none;margin: -20px -8px -15px 0px;float: right; width: 57%; background-color:green; color:#fff;"> &nbsp;
		       <!--<img src="<?php echo base_url().'mobile_css_js/images/ccavenue_images.png' ?>" width="75" height="20" >-->
	      </form>
		<?php }?>
		
		</td> </tr>
    </table>
    </div>

    
    <div class="adrs-details">
    <h3> <?= $result[0]->full_name ;?></h3>
    <p> <?= $result[0]->phone ;?> <br>
    <?= $result[0]->address ;?> <br>
    <?= $result[0]->city ;?>, <?= $result[0]->state ;?> - <?= $result[0]->pin_code ;?>,<br/><?= $result[0]->country ;?>
    </p>
    </div>
    <div class="clearfix"></div>          
    </div>
	
	
    
    <div class="ordr-prdct-details" style="padding: 7px;">
    <h4 style="margin-bottom:10px!important;"> Product Details </h4>
    
  
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
     <div class="order_img" style="text-align:center; margin-bottom:5px;"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku ?>" target="_blank">
     <img width="60%" alt="<?=$rows->name;?>" src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" />
     </a> </div>
           
     <div class="order_prdct_data"> 
           <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku ?>" target="_blank">
                    <h3 style="font-size: 17px; margin-bottom:10px;"> <?= $rows->name ;?> </h3>
                    </a>
                    
                    <?php
                     if($rows->prdt_color != 'not'){ echo "<span class='cart_attr'>Color : ".$rows->prdt_color.'</span><br/>'; }
									 
   					 if($rows->prdt_size != 'not'){ echo "<span class='cart_attr'>Size : ".$rows->prdt_size.'</span><br/>';}
					?>
                    
                    <span>Quantity : <?= $rows->quantity;?></span>
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
 <div class="clearfix"></div>
       <div class="manage-order">
         <?php if($result[0]->invoice_id == ''){ ?>
    	<a href='#' onClick="alert('Invoice is not available.');return false;" title="Invoice"> <i class="fa fa-file-text-o"></i><br> Download Invoice </a>
    <?php }else if($result[0]->order_status == 'Delivered'){?>
    	<a href='<?php echo base_url().'admin/sales/generate_invoice_slip/'.$result[0]->order_id ; ?>' title="Invoice"> <i class="fa fa-file-text-o"></i><br> Download Invoice </a>
       <?php }else{ ?>
       		<a href='#' onClick="alert('Invoice is not available.');return false;" title="Invoice"> <i class="fa fa-file-text-o"></i><br> Download Invoice </a>
       <?php } ?>
       </div>
     
       
       <div class="ordr_details_sts_dv trackng_dv">
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
         
  <div class="clearfix"></div>
  <hr/>
            
     <?php } //End of foreach loop ?>
     <span class="total_spn">Total <strong>Rs. <?= $result[0]->Total_amount ;?></strong></span>
      <div class="clearfix"></div>
    </div> 
     <!--- End of ordr-prdct-details div --->
     
 </div>   
</div>
<?php include "footer.php"; ?>