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

<?php include "header.php" ?>
<style>
.main-content {
    padding: 100px 0px 10px;
	width:100%;
}
.category h4 {
    font-size: 19px;
}

.my_account_menu>h5 {
    font-size: 14px;
}
.title3 {
    font-size: 26px;
	margin-bottom: 10px;
	margin-top: -4px;
}
.tab-pane {
    padding: 20px 10px;
    border-bottom: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}
.nav-tabs li a:hover {
    background-color: #fdbf14 !important;
    color: #fff !important;
}
</style>
<!------ Start Content ------>

<div class="main-content">
<!--
	<div class="main-content_inn">
		<form name="persional_info_form" class="persional_info_form">
        	<input type="text">
        </form>
    </div>-->
    <div style="width:90%; margin:auto;">
		<div class="left-nav">
        	<?php include'profile_menu.php'; ?>
        </div>
    
    <div class="profile-right">
		<?php if($this->session->flashdata('return_req')):?><h4><?php echo $this->session->flashdata('return_req');?></h4><?php endif; ?>
    	<h2 class="title3">My Orders</h2>
    	<!--<div id="load_form">-->
        	
            <ul class="nav nav-tabs tabs-horiz">
                <li class="active"><a data-toggle="tab" href="#tab1">RECENT ORDERS (Last 3 month)</a></li>
                <li><a data-toggle="tab" href="#tab2">PAST ORDERS</a></li>
			</ul>
            
            <div class="tab-content form_view">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="tab-l">
                        <div id="load_form">
                        <?php
						$sl=0;
						$order_rows = $order_id_result->num_rows();
						if($order_rows > 0){
							foreach($order_id_result->result() as $order_row){
								$sl++;
								$no_of_item = $order_row->NO_OF_ITEM;
								
								$after_10days_delivereddate=date('y-m-d H:i:s' ,strtotime($order_row->date_of_order.'+ 1 day'));
								$date1 = date('y-m-d H:i:s');
								//if($date1<=@$after_10days_delivereddate){
						?>
            
                      <div class="order_item">
                           <div class="o-id"> 
                               <a href="<?php echo base_url(); ?>order-details/<?= base64_encode($this->encrypt->encode($order_row->order_id)) ;?>" target="_blank" class="order_id"><?= $order_row->order_id; ?></a> 
                               <!--<span class="order_id_sts"><?//= $order_row->order_status; ?></span>-->
                               <div class="clearfix"></div> 
                           </div>
                       
						  <?php
                            $query = $this->db->query("SELECT a.id,a.sub_total_amount,a.quantity,a.product_order_status,a.order_id,
							a.prdt_color,a.prdt_size,a.order_accept_by_seller,b.name,b.product_id,b.description,b.short_desc,c.imag,d.business_name,e.date_of_order,e.order_status,
							e.Total_amount,e.order_processstatus,f.sku 
							FROM ordered_product_from_addtocart a 
                            INNER JOIN product_general_info b ON a.product_id=b.product_id 
                            INNER JOIN product_image c ON a.product_id=c.product_id 
                            INNER JOIN seller_account_information d ON a.seller_id=d.seller_id 
                            INNER JOIN order_info e ON a.order_id=e.order_id 
							INNER JOIN product_master f ON a.sku=f.sku  WHERE a.order_id='$order_row->order_id' AND e.is_transfer='no' group by f.sku ");
                            
                            $order_details_result = $query->result();
							$slr=0;
                            foreach($order_details_result as $order_details_row){
								$slr++;
                                $image = explode(',',$order_details_row->imag);
                           ?>
                       
                      		<div class="order_img"> 
								<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" target="_blank">
									<img src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" width="30" alt="<?=$order_details_row->name;?>" />
								</a>
							</div>
                            <div class="order_data"> 
                                <div class="col-sm-4 left">
									<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" target="_blank">
										<h4><?= $order_details_row->name; ?></h4>
									</a>
                                    
                                    <?php
                                     //if($order_details_row->prdt_color != 'not'){ echo "<span class='cart_attr'>Color : ".$order_details_row->prdt_color.'</span><br/>'; }
									 
   									//if($order_details_row->prdt_size != 'not'){ echo "<span class='cart_attr'>Size : ".$order_details_row->prdt_size.'</span><br/>';}
									
									//---------------------------Capacity,RAM,ROM display start--------------------
									
										
									$color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$order_details_row->sku' group by sku ");
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
                                    
                                    <span>Quantity : <?= $order_details_row->quantity; ?></span>
                                </div>
                                <div class="col-sm-3 left">
                                    <span class="price2">Rs. <?= $order_details_row->sub_total_amount; ?></span> </div>
                                    <div class="col-md-2 left">
                                    <?php
                                   /* if($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Failed' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing' || $order_details_row->order_accept_by_seller == 'Not Accepted' ){*/
										
										if(($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing') && 
										$order_details_row->order_accept_by_seller =='Not Accepted'){
                                    ?>
                                 <!--<span onClick="cancelProduct(<?//= $order_details_row->id; ?>)" class="cancl_prdt">Cancel</span>-->
                                 <a href="#inline_content_cancel_details<?=$sl.$slr;?>" class="cancl_prdt inline2">Cancel</a>



<!--- lightbox div start  ---->                
<div style="display:none">
      <div id="inline_content_cancel_details<?=$sl.$slr;?>" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         <h4 class="title6 sn">Give Your Cancellation Details<span id="ajxtst<?=$sl.$slr;?>"></span></h4>
		<div class="col-md-12">
            <table class="edit_address_form">
                <tr>
                	<td>Cancellation Reason: </td>
                    <td><textarea id="cancel_reson<?=$sl.$slr;?>" class="input-text"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input  type="button" id="return_btn<?=$sl.$slr; ?>"onClick="cancelProduct1(<?= $order_details_row->id; ?>,'<?= $order_details_row->sku; ?>','<?= $order_details_row->order_id; ?>',<?=$sl.$slr;?>,'<?= $order_details_row->quantity; ?>')" class="btn-sign-in" value="Submit">
                    </td>
                </tr>
          </table>
	</div>
    </div>
  </div>
</div>
<!--- lightbox div start  ---->


                                 
                                 <?php } ?>
                                </div>
								<?php
									if($order_details_row->order_status == 'Pending payment' && $order_details_row->order_processstatus == 'Order Placed Successfully By Buyer'){
								?>
								<div class="col-sm-3 right">
                                    <div class="order-status">Order Placed by COD</div>
                                </div>
									<?php } else {?>
                                <div class="col-sm-3 right">
                                    <div class="order-status"> <?= $order_details_row->product_order_status; ?></div>
                                </div>
								   <?php }?>
                            </div>
                      
                          <div class="clearfix"></div>
                          
                          <div class="line2"> </div>
                         
                          <?php } //end of 2nd forloop ?>
                              <div class="order-total">
                                  <span>Seller : <a target="_blank" href="<?php echo base_url() ;?>sellers/<?= base64_encode($order_row->seller_id);?>"><?= $order_row->business_name; ?></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  
                                  <?php if($order_row->order_status == 'Delivered'){ ?>
                                  <a href="#add_seller_review<?=$sl;?>" class="inline">Review Seller</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?php } ?>
                                  
                                  <span>Date : <?= //date('Y-m-d',strtotime($order_row->date_of_order));   
								      date('M-d-Y',strtotime($order_row->date_of_order))?></span>
                                  <?php if($order_row->order_status != 'Cancelled'){ ?>
                                  <!--<span class="wish_spn a_spn" style="margin-left:150px;" onClick="cancelOrder(<?//=$order_row->id ?>)"><i class="fa fa-times-circle"> Cancel Order </i></span>-->
                                  <?php } ?>
                                  <span class="o-total">Order Total : <strong>Rs. &nbsp;<?=$order_row->Total_amount;?></strong></span>
                              </div>
                      </div>

<!--- lightbox div start here --->
<div style="display:none">
    <div id="add_seller_review<?=$sl;?>" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title6 sn">Write Review</h4>
		<div class="col-md-12">
        <table width="100%" border="0" cellspacing="5" class="rating">
          <tr>
            <td width="28%"> SReview Title: </td>
            <td width="72%"><input type="text" name="slr_review_title" id="slr_review_title<?=$sl;?>" placeholder="Review title Here"  class="input-text" > </td>
          </tr>
          <tr>
            <td valign="top"> Your Review: </td>
            <td> <textarea rows="3" cols="50"  class="input-text" name="slr_review_cont" id="slr_review_cont<?=$sl;?>"></textarea> </td>
          </tr>
          <tr>
            <td>Your rating :</td>
            <td>
              <select id="backing3c<?=$sl;?>" name="seller_rating">
                <option value="1">Bad</option>
                <option value="2">OK</option>
                <option value="3">Great</option>
                <option value="4">Excellent</option>
                <option value="5">Excellent1</option>
              </select>
              <div class="rateit" data-rateit-backingfld="#backing3c<?=$sl;?>" data-rateit-min="0"></div>
            </td>
          </tr>
          
           <tr>
            <td>&nbsp;</td>
            <td><button type="button" title="Submit" id="rev_slr_btn<?=$sl;?>" onClick="getSellerReviewData(<?= $order_row->seller_id; ?>,<?=$sl;?>)" class="button btn-cart-big"> Submit </button></td>
          </tr>
          <tr id="show_ssmsg1<?=$sl;?>"><td colspan="2"><div id="show_ssmsg_dv1<?=$sl;?>"></div></td></tr>
        </table>

	</div>
            
        </div>
      </div>
</div>
<!--- lightbox div end here --->
            
           <?php
					//} //condition of product show
				} //end of foreach loop
			}else{ //end of if condition ?>
           <!-- <p>No Order Records.</p>-->
            <?php } ?>

            
                        </div>
                    </div>      
					<div class="clearfix"></div>
                    
                </div>
                <!--- end of tab1 id div --->
                
                <div id="tab2" class="tab-pane fade">
                    
                    <div class="tab-l">
                        <div id="load_form">
                        <?php
						$sl=0;
						$order_rows = $order_id_past_result->num_rows();
						if($order_rows > 0){
							foreach($order_id_past_result->result() as $order_row){
								$sl++;
								$no_of_item = $order_row->NO_OF_ITEM;
						?>
            
                      <div class="order_item">
                           <div class="o-id"> 
                               <a href="<?php echo base_url(); ?>order-details/<?= base64_encode($order_row->order_id) ;?>" target="_blank" class="order_id"><?= $order_row->order_id; ?></a> 
                               <!--<span class="order_id_sts"><?//= $order_row->order_status; ?></span>-->
                               <div class="clearfix"></div> 
                           </div>
                       
						  <?php
                            $query = $this->db->query("SELECT a.id,a.sub_total_amount,a.quantity,a.product_order_status,b.name,b.description,b.short_desc,c.imag,d.business_name ,e.date_of_order,e.order_status,e.Total_amount FROM ordered_product_from_addtocart a 
                            INNER JOIN product_general_info b ON a.product_id=b.product_id 
                            INNER JOIN product_image c ON a.product_id=c.product_id 
                            INNER JOIN seller_account_information d ON a.seller_id=d.seller_id 
                            INNER JOIN order_info e ON a.order_id=e.order_id WHERE a.order_id='$order_row->order_id' AND e.is_transfer='no' ");
                            
                            $order_details_result = $query->result();
                            foreach($order_details_result as $order_details_row){
                                $image = explode(',',$order_details_row->imag);
                           ?>
                       
                      		<div class="order_img"> <img alt="<?=$order_details_row->name;?>" src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" /></div>
                            <div class="order_data"> 
                                <div class="col-sm-4 left">
                                    <h4><?= $order_details_row->name; ?></h4>
                                    <span>Quantity : <?= $order_details_row->quantity; ?></span>
                                </div>
                                <div class="col-sm-3 left">
                                    <span class="price2">Rs. <?= $order_details_row->sub_total_amount; ?></span> </div>
                                    <div class="col-md-2 left">
                                    <?php
                                    if($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Failed' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing'){
                                    ?>
                                 <span onClick="cancelProduct(<?= $order_details_row->id; ?>)" class="cancl_prdt">Cancel</span>
                                 <?php } ?>
                                </div>
								<?php
									if($order_details_row->order_status == 'Pending payment' && $order_details_row->order_processstatus == 'Order Placed Successfully By Buyer'){
								?>
								<div class="col-sm-3 right">
                                    <div class="order-status">Order Placed by COD</div>
                                </div>
								<?php } else {?>
                                <div class="col-sm-3 right">
                                    <div class="order-status"> <?= $order_details_row->product_order_status; ?></div>
                                </div>
								<?php }?>
                            </div>
                      
                          <div class="clearfix"></div>
                          
                          <div class="line2"> </div>
                         
                          <?php } //end of 2nd forloop ?>
                              <div class="order-total">
                                  <span>Seller : <?= $order_row->business_name; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  
                                  <?php if($order_row->order_status == 'Delivered'){ ?>
                                  <a href="#add_seller_review_past<?=$sl;?>" class="inline">Review Seller</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?php } ?>
                                  
                                  <span>Date : <?= date('Y-m-d',strtotime($order_row->date_of_order));?></span>
                                  <?php if($order_row->order_status != 'Cancelled'){ ?>
                                  <span class="wish_spn a_spn" style="margin-left:150px;" onClick="cancelOrder(<?=$order_row->id ?>)"><i class="fa fa-times-circle"> Cancel Order </i></span>
                                  <?php } ?>
                                  <span style="float:right;">Order Total : <strong>Rs. &nbsp;<?= $order_row->Total_amount;?></strong></span>
                              </div>
                      </div>
            
<!--- lightbox div start here --->            
<div style="display:none">
    <div id="add_seller_review_past<?=$sl;?>" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title6 sn">Write Review</h4>
		<div class="col-md-12">
        <table width="100%" border="0" cellspacing="5" class="rating">
          <tr>
            <td width="28%"> SReview Title: </td>
            <td width="72%"><input type="text" name="slr_review_title" id="slr_review_title<?=$sl;?>" placeholder="Review title Here"  class="input-text" > </td>
          </tr>
          <tr>
            <td valign="top"> Your Review: </td>
            <td> <textarea rows="3" cols="50"  class="input-text" name="slr_review_cont" id="slr_review_cont<?=$sl;?>"></textarea> </td>
          </tr>
          <tr>
            <td>Your rating :</td>
            <td>
              <select id="backing3c<?=$sl;?>" name="seller_rating">
                <option value="1">Bad</option>
                <option value="2">OK</option>
                <option value="3">Great</option>
                <option value="4">Excellent</option>
                <option value="5">Excellent1</option>
              </select>
              <div class="rateit" data-rateit-backingfld="#backing3c<?=$sl;?>" data-rateit-min="0"></div>
            </td>
          </tr>
          
           <tr>
            <td>&nbsp;</td>
            <td><button type="button" title="Submit" id="rev_slr_btn<?=$sl;?>" onClick="getSellerReviewData(<?= $order_row->seller_id; ?>,<?=$sl;?>)" class="button btn-cart-big"> Submit </button></td>
          </tr>
          <tr id="show_ssmsg1<?=$sl;?>"><td colspan="2"><div id="show_ssmsg_dv1<?=$sl;?>"></div></td></tr>
        </table>

	</div>
            
        </div>
      </div>
</div>
<!--- lightbox div end here --->
            
            <?php
				} //end of foreach loop
			}else{ //end of if condition ?>
            <p>you don't have any past orders record.</p>
            <?php } ?>

            
                        </div>
                    </div>
                    
                    
                    
                    
                </div>
                <!--- end of tab2 id div --->
                        
              </div>
              <!--- end of tab content --->          

        <!--</div>-->
        
    </div>
</div>
<div class="clearfix">&nbsp;</div>


<?php include "footer.php" ?>

<!--Review script start here-->
<link href="<?php echo base_url(); ?>rateit/src/rateit.css" rel="stylesheet" type="text/css">
<!--<script src="<?php// echo base_url(); ?>rateit/src/jquery.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>rateit/src/jquery.rateit.js" type="text/javascript"></script>

<!--- seller review script start here ---->
<script>
function getSellerReviewData(val,sl){
	//alert(val);return false;
	var slr_rev_title = $('#slr_review_title'+sl).val();
	var slr_rev_cont = $('#slr_review_cont'+sl).val();
	var slr_ratingt = $('#backing3c'+sl).val();
	if(slr_rev_title == ''){
		alert('Please enter review title.');
		$('#slr_review_title'+sl).focus();
		return false;
	}else if(slr_rev_cont == ''){
		alert('Please enter your review.');
		$('#slr_review_cont'+sl).focus();
		return false;
	}/*else if(slr_rev_cont.length < 50){
		alert('your review contains at least 50 characters.');
		$('#slr_review_cont'+sl).select();
		return false;
	}*/else if(slr_ratingt == 'null'){
		alert('Please rate this product.');
		return false;
	}else{
		
		$('#rev_slr_btn'+sl).text('Wait...');
		$.ajax({
		  url:'<?php echo base_url(); ?>user/seller_review',
		  method:'post',
		  data:{title:slr_rev_title,content:slr_rev_cont,rating:slr_ratingt,seller_id:val},
		  success:function(result)
		  {
			  
			if(result == 'success'){
				  $("#show_ssmsg_dv1"+sl).html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Your review have been submited successfully.');
				  $("#show_ssmsg_dv1"+sl).css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'})
				  $("#show_ssmsg1"+sl).fadeIn();
				  $('#rev_slr_btn'+sl).text('Submit');
				  window.location.reload(true);
				  setTimeout(function() { location.reload() },1500);
			  }
			  if(result == 'exists'){
				  $('#rev_slr_btn'+sl).text('Submit');
				  alert('you have been already reviewed this seller');
				  window.location.href='<?php echo base_url(); ?>review-rating';
			}
			  
		  }
	  });
		
	}
}
</script>
<!--- seller review script end here ---->
<!--Review script end here-->



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


/*function cancelProduct(id){
	var m = confirm('Are you sure to cancel this product ?');
	if(m){
		$.ajax({
			url:'<?php// echo base_url(); ?>user/product_cancelation',
			method:'post',
			data:{id:id},
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
*/


function cancelProduct1(id,sku,order_id,sl,qty){
	var reason = $('#cancel_reson'+sl).val();
	//alert(reason);return false;
	if(reason == ''){
		alert('Please enter reason.');
		return false;
	}else{
		$('#return_btn'+sl).val('Wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>user/product_cancelation',
			method:'post',
			data:{id:id,sku_id:sku,order_id:order_id,reason:reason,qty:qty},
			success:function(result){
				//$('#ajxtst'+sl).html(result);
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
	}
}
</script>

</body>

</html>