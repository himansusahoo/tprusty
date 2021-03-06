<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">

		<title>My Returns</title>
<style>
.main-content {
    padding: 100px 0px 10px !important;
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
</style>
<?php include "header.php" ?>

	<div class="main-content">
		<!--<div class="left-nav">
        	<?//php include'profile_menu.php'; ?>
        </div>-->
		<!--<div class="profile-right">-->
			<?php if($this->session->flashdata('return_req')):?><h4><?php echo $this->session->flashdata('return_req');?></h4><?php endif; ?>
			<h2 class="title3">My Orders</h2>
			<ul class="nav nav-tabs tabs-horiz">
                <li class="active"><a data-toggle="tab" href="#tab1">ORDERS</a></li>
                <!--<li><a data-toggle="tab" href="#tab2">PAST ORDERS</a></li>-->
			</ul>
			<div class="tab-content form_view">
                <div id="tab1" class="tab-pane fade in active">
					<div class="tab-l">
                        <div id="load_form">
<?php
$order_rows = $order_id_result->num_rows();
if($order_rows > 0){
	foreach($order_id_result->result() as $order_row){
		$no_of_item = $order_row->NO_OF_ITEM;
		 $query = $this->db->query("SELECT a.id,a.sub_total_amount,a.quantity,a.product_order_status,a.returned_request_deny,a.order_id,b.name,b.product_id,b.description,
							b.short_desc,c.imag,d.business_name ,e.date_of_order,e.order_status,e.Total_amount,e.order_accept_by_seller,e.order_status_modified_date,f.sku
							FROM ordered_product_from_addtocart a 
                            INNER JOIN product_general_info b ON a.product_id=b.product_id 
                            INNER JOIN product_image c ON a.product_id=c.product_id 
                            INNER JOIN seller_account_information d ON a.seller_id=d.seller_id 
                            INNER JOIN order_info e ON a.order_id=e.order_id 
							INNER JOIN product_master f ON a.sku=f.sku WHERE a.order_id='$order_row->order_id' AND e.is_transfer='no' 
							AND (a.product_order_status = 'Delivered' OR a.product_order_status='Return Requested' 
							OR a.product_order_status='Return Received'  ) ");
                            
                            $order_details_result = $query->result();
							if($order_details_result){
                            foreach($order_details_result as $order_details_row){
                                $image = explode(',',$order_details_row->imag);
?>
							<div class="order_item">
								<div class="o-id"> 
									<!--<a href="<?php echo base_url(); ?>order-details/<?= base64_encode($this->encrypt->encode($order_row->order_id)) ;?>" target="_blank" class="order_id"><?= $order_row->order_id; ?></a> -->
									<a href="#" class="order_id" style="cursor:default;"><?=$order_row->order_id;?></a>
									<div class="clearfix"></div> 
								</div>
								<div class="order_img"> 
									<a href="<?php echo base_url().str_replace(" ","-",strtolower($order_details_row->name)).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" >
										<img alt="" src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" width="30"/>
									</a>
									<!--<img alt="" src="<?//php echo base_url();?>images/product_img/<?//=$image[0]; ?>" />-->
								</div>
								<div class="order_data"> 
									<div class="col-sm-4 left">
										<a href="<?php echo base_url().str_replace(" ","-",strtolower($order_details_row->name)).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" >
											<h4><?= $order_details_row->name; ?></h4>
										</a>
										<span>Quantity : <?= $order_details_row->quantity; ?></span>
									</div>
									<div class="col-sm-3 left">
										<span class="price2">Rs. <?= $order_details_row->sub_total_amount; ?></span>
									</div>
									<div class="col-md-2 left">
										<?php
										$qr_returnrequest_approv=$this->db->query("select * from return_product where order_id='$order_row->order_id' and return_request_approve_status='Approved'");
										
										if($order_details_row->product_order_status == 'Delivered'){
											//checking delivered date between 10 days
											$qr_delivereddate=$this->db->query("select * from order_status_log where order_id='$order_row->order_id' ");											
											$rw_delivereddate=$qr_delivereddate->row();
											
											
											$after_10days_delivereddate=date('y-m-d H:i:s' ,strtotime(@$rw_delivereddate->delivered_date.'+ 10 day'));
											$date1 = date('y-m-d H:i:s');
											
											
										
										if($order_details_row->returned_request_deny == 'Yes'){
										?>
										
										<?php } else {?>
										<?php if($date1<=@$after_10days_delivereddate){
										?>
										<a href="<?php echo base_url(); ?>my_order/return_product/<?= base64_encode($this->encrypt->encode($order_details_row->id)); ?>/<?= base64_encode($this->encrypt->encode($order_row->order_id)); ?>" class="cancl_prdt">Return</a>
                                        <?php } //End of 10 days condition 
										}
										?>
										<?php  }else{
										
											if($qr_returnrequest_approv->num_rows()!=0)
											{ ?> <a href='<?php echo base_url().'my_order/generate_return_slip/'.$order_row->order_id; ?>' title='Print Return Slip' ><i style="font-size:24px" class="fa fa-print"></i><br> Return Slip</a> <?php }

										} ?>
									 </div>
									 <div class="col-sm-3 right">
                                     	<?php if($qr_returnrequest_approv->num_rows()!=0 && $order_details_row->product_order_status!='Return Received'){ ?>
										<div class="order-status">Return Requested Approved</div>
                                     	<?php }else{ ?>
                                        <div class="order-status"><?=$order_details_row->product_order_status;?></div>
                                        <?php } ?>
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="line2"> </div>
							<?php
							}
							?>
								<div class="order-total">
									<span>Seller : <?= $order_row->business_name; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    
									<span>Date : <?= date('Y-m-d',strtotime($order_row->date_of_order));?></span>
									<?php if($order_row->order_status != 'Cancelled'){ ?>
									<?php } ?>
									<span class="o-total">Order Total : <strong>Rs. &nbsp;<?= $order_row->Total_amount;?></strong></span>
								</div>
							</div>
		<?php
		}
	}// Top foreach closed
}//  Top if closed
else{
	?>
		<p>No Records Found.</p>
	<?php } ?>	
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				

			</div>
			

	
	<div class="clearfix">&nbsp;</div>
<?php include "footer.php" ?>