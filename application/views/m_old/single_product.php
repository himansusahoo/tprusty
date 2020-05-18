<?php include 'header.php'; 
 date_default_timezone_set('Asia/Calcutta');
        if($this->session->userdata('addtocarttemp_session_id')==""){
        $dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
        $addtocarttemp_session_id=random_string('alnum', 16).$dtm;
        $this->session->set_userdata('addtocarttemp_session_id',$addtocarttemp_session_id);
        
        $data= array();
        $this->session->set_userdata('addtocarttemp',$data);
        $arr_sku=array();
        $this->session->set_userdata('addtocart_sku',$arr_sku);
		}

?>

<link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>"/>

<script>
	function valid_pin(){
		var pin=document.getElementById('pin').value;

		 //var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		 if(pin==""){
			 $('#valid_msg1').show().text('Please enter your Pin Number!');
			return false;
			//pin.focus();
			
		}
		else if(isNaN(pin)){
			$('#valid_msg1').show().text('Enter a valid Pin Number');
			return false;
			//pin.focus();
			
		}
		else if(pin.length != 6){
			$('#valid_msg1').show().text('Enter a 6-digit Pin Number');
			return false;
			//pin.focus();
			
		}
		//else if(pin.length == 6){
//			$('#pin-msg').show();
//			$('#valid_msg1').hide();				
//		}
		
		else if(pin.length == 6)
		{
			
			$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>Mycart/pincode_check",
			data:{pincode:pin},
			success: function (data) {
						//$("#ss").html(data);
						if(data == 'COD'){
							//$('#pin-msg').text('Product is available at your location with COD');
							$('#pin-msg').show();
							$('#pin_msg_cod').show();
							$('#valid_msg1').hide();
							
						}
						else
						{
							//$('#pin-msg').text('Product is available at your location');
							$('#pin-msg').show();
							$('#pin_msg_cod').hide();
							$('#valid_msg1').hide();	
						}
						
					}
				});
				
		}
		
	}
	</script>

<script>
function goAddtoCart(prdt_name,prdt_id,sku){
	var attr_clr = $('#attr_color').val();
	var attr_size = $('#attr_size').val();
	
	var attr_parm='';
	if(attr_size){
		if(attr_clr){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/size='+attr_size.replace(' ','-');
		}
	}else if(attr_clr){
		if(attr_size){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/color='+attr_clr.replace(' ','-');
		}
	}
	window.location.href='<?php echo base_url();?>product_description/addtocart/'+prdt_name+'/'+prdt_id+'/'+sku+attr_parm;
}
</script>
<script>
function StoreInSession(pid,sku,pname){
	$('.by_btn').css('background-color','#ccc');
	$.ajax({
		url:'<?php echo base_url();?>product_description/set_buynow_session',
		method:'post',
		data:{pid:pid,sku_id:sku,pname:pname},
		success:function(result){
			
			if(result=='success'){
				//window.location.href= '?restart';
				window.location.href="<?php echo base_url().'user/m_login' ?>";
			}
		}
	});
}


//$(document).ready(function(){
//  if(window.location.search.indexOf('restart') > -1){
//  setTimeout(function(){ 
//	  $('.inline').trigger('click');
//	  }, 500);
//  };
//});
</script>

<script>
function goAddtoCartBuyNow(prdt_name,prdt_id,sku){
	var attr_clr = $('#attr_color').val();
	var attr_size = $('#attr_size').val();
	
	var attr_parm='';
	if(attr_size){
		if(attr_clr){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/size='+attr_size.replace(' ','-');
		}
	}else if(attr_clr){
		if(attr_size){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/color='+attr_clr.replace(' ','-');
		}
	}
	window.location.href='<?php echo base_url();?>product_description/addtocart_buynow/'+prdt_name+'/'+prdt_id+'/'+sku+attr_parm;
}
</script>			


<script type="text/javascript">
 function bigimgbox()
 {
	 $(".flexslider").addClass("fullimgview");
	 $(".backbtn").css("display","block");
	 $('body').addClass('bodyScrollLock');
 }

 function backbtn()
 {
	 $(".flexslider").removeClass("fullimgview");
	 $(".backbtn").css("display","none");
	  $('body').removeClass('bodyScrollLock');
 }

</script>



         <div class="wrap">
         <div class="view-product" id="view">
   		
				  <!--/view-->
				 
			<div class="cont span_2_of_3 inner">
			 <h3 class="tittle two">Get Shop</h3>
			     <div class="labout span_1_of_a1">
				<!-- start product_slider -->
				<div class="flexslider">
                <a class="backbtn" onclick="backbtn()"> Back </a>
							  <ul class="slides">
                              
                              <?php
							$query=$this->db->query("select * from product_general_info where product_id='$product_data->product_id'");
				  			$recd1=$query->row();
		
							  	$rec=explode(',',$product_data->imag);
							   foreach($rec as $val){ ?>
								<li data-thumb="<?php echo base_url().'images/product_img/'.$val; ?>">
									<div class="thumb-image simpleLens-lens-image">
                                    
                                <a href="#" onclick="bigimgbox()">  <img src="<?php echo base_url().'images/product_img/'.$val; ?>" alt="<?=$recd1->name;?>"> </a>
                                    </div>
								</li>
                                <?php } ?>
								
							  </ul>
         <a href="#" onclick="bigimgbox()"> <img src="<?php echo base_url().'mobile_css_js/' ?>images/touchtozoom.png" width="50" height="" alt="zoom"  class="img-zoom"> </a>
							<div class="clearfix"></div>
				   </div>		

				<!-- end product_slider -->
			</div>
            
            
            
             
            
            
            
			<div class="cont1 span_2_of_a1 pull-right">
            <?php $query=$this->db->query("select * from product_general_info where product_id='$product_data->product_id'");
				  $recd1=$query->row();
			?>
				<h3 class="m_3"><?php echo $recd1->name; ?></h3>
				
				<div class="price_single">
                <div class="price-dtls">
                <?php  
					$query=$this->db->query("select * from product_master where sku='$data_sku' ");
					$recd=$query->row();
					$cdate = date('Y-m-d');
					$special_price_from_dt = $recd->special_pric_from_dt;
					$special_price_to_dt = $recd->special_pric_to_dt;
					?>      
                              
                          <!-------------------------------------------------- Price section start-------------------------------->
                         <?php
						if($recd->special_price !=0){
							if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
					?>
                     	<div class="cut-price"> MRP - Rs.<?=ceil($recd->mrp); ?></div>                        
                        <?php if($recd->price != 0){?>
        				<div class="reducedfrom"> Sell Price - Rs.<?=ceil($recd->price); ?> </div>
       		 			<?php }?> 
                                  	
                     	<div class="actual"> <span>Special Price - Rs.<?=ceil($recd->special_price); ?><?php $cur_price=ceil($recd->special_price); ?></span></div>
                        <!---Special price exists condition end here --->
        			<?php }else{ ?>
						
						<?php if($recd->price != 0){?>
                        <div class="cut-price"> MRP - Rs.<?=ceil($recd->mrp); ?></div> 
                        <div class="actual"><span> Sell Price - Rs.<?=ceil($recd->price); ?><?php $cur_price=ceil($recd->price); ?></span></div>
                        <?php }else{?>                        
                        <div class="actual"><span> MRP - Rs.<?=ceil($recd->mrp); ?><?php $cur_price=ceil($recd->mrp); ?></span></div> &nbsp;&nbsp;
                        <?php }?>
        
        			<?php } //End of date condition ?>

                    <?php }else{ ?>
        
						<?php if($recd->price != 0){?>
                        <div class="cut-price"> MRP - Rs.<?=ceil($recd->mrp); ?> </div>
                       <div class="actual"><span> Sell Price - Rs.<?=ceil($recd->price); ?><?php $cur_price=ceil($recd->mrp); ?></span></div>  
                        <?php }else{?>                       
                        <div class="actual"><span> MRP - Rs.<?=ceil($recd->mrp); ?><?php $cur_price=ceil($recd->mrp); ?></span></div>
                        <?php }?>
		
        			<?php } ?>
                        
                          <!-- ---------Price Section end-------- -->    
                        
                            
                        <!-- -----------Shipping Fees Start----------- -->
                        		<!-- Shiping fee -->
                    
                     <?php $query=$this->db->query("select a.business_name,a.seller_id,b.shipping_fee_amount from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'");
					 $ct=$query->num_rows();
					 $rew=$query->row();
					?> 
                    
                    
                    <?php if($rew->shipping_fee_amount == 0){?>
                    
                         <div class="sphng">(Shipping charges free) &nbsp;</div>
                        <?php }else{?>
                    	 <div class="sphng">Shipping fee &nbsp;Rs.<?php echo $rew->shipping_fee_amount; ?>&nbsp;</div>
                         
                          <?php //$price_divresult=$cur_price/$recd->mrp; 
						 	//if($price_divresult!=1)
//							{$percen_priceoff=100-($price_divresult*100);
						  ?>
                                                  
                        <?php } ?>
                        <div class="clearfix"></div>
                        </div>
                        <!--<div class="discount">15% <br> OFF </div>  -->
                               <div class="clearfix"></div>
                       
                        <div class="dlvry-date"> 
                        
                         <?php $qr1 = $this->db->query("SELECT c.dispatch_days
												FROM seller_account a
												INNER JOIN state b ON a.seller_state = b.state
												INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
												WHERE a.seller_id ='$rew->seller_id'");
					$ct1 = $qr1->num_rows();
					 $res = $qr1->row();
					 if($ct1 > 0){
					?>       
                      <?php /*?>Delivered By : <?php echo $res->dispatch_days+4;?> - <?php echo $res->dispatch_days+5;?> Days<?php */?>
                       Delivered By: 4 - 6 Days
                     <?php  }else{  ?>
                     Delivered By : 10-12 Days 
                     <?php } ?>
                        
                          </div>
                         </div>    
                           
                            <ul class="star">
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>
                            <li class="review"> | &nbsp; 50 reviews </li>
                            </ul>          
			  
                        
                        <?php $query=$this->db->query("select a.business_name,a.seller_id,b.quantity,b.stock_availability,a.display_name,b.max_qty_allowed_in_shopng_cart from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'"); 
					 $ct=$query->num_rows();
					 $rew=$query->row();
					 
					 $max_quantity=$rew->max_qty_allowed_in_shopng_cart;
					 
					 if($rew->quantity==0);
					{
					
					?> 
                   <?php 
					}
				   ?>
            <!-- ------------Shipping Fees End---------------- -->             
                              
                              
			 <!-- ------------- add to wishlist --------------- -->
                <div class="add-to-links"><i class="fa fa-heart-o"></i> <a href="#">Add to Wish list</a></div>
                 <div class="clearfix"></div>    
              
              
              <!------------------------ Color , Size , Capacity, ROM , ROM code start -------------------------->  
 						 <?php 
						   
						$query_curclolr=$this->db->query("SELECT color, size,lvl2,Capacity,RAM,ROM FROM cornjob_productsearch WHERE sku='$data_sku' group by sku ");
						
						$curnt_color=$query_curclolr->row()->color;
						$curnt_size=$query_curclolr->row()->size;
						$cur_capacity=$query_curclolr->row()->Capacity;
						$cur_ram=$query_curclolr->row()->RAM;
						$cur_rom=$query_curclolr->row()->ROM;
						
						
						$cur_lvl2=$query_curclolr->row()->lvl2;
						?>
 
                     <!------------color code start-----------> 
                     <?php
                     	if($curnt_color!=''){
							 	$cur_productid=$recd->product_id;
								
								$prodname_wisecolr=$recd1->name;
								
								$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND size='$curnt_size'  AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
								
								if($query_extngskugrp->num_rows()<=1)
								{
										$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
								}
								
								//$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by color ");
								
								$rw_extngskugrp=$query_extngskugrp->result_array();
								?>
                                 <ul class="color_list">
                        <h4> Color : </h4>
                                <?php 
								foreach($rw_extngskugrp as $res_extngsku)
								{
									
									 $sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
									if($rw_extngsku[0]->color!='')
									{
										
									  ?>
                                      
										 <li>
                                         <?php 
										  if($rw_extngsku[0]->color==$curnt_color)
										 {$sku_select=$data_sku;}
										 else
										 {$sku_select=$rw_extngsku[0]->sku;}
										 
										 //if($rw_extngsku[0]->quantity=0 || $rw_extngsku[0]->quantity=='' || ($curnt_size!=$rw_extngsku[0]->size && $curnt_color!=$rw_extngsku[0]->color) ){  ?><!--<div class="not-available"> </div>--><?php //} ?>
                            <label  class="color"> 
                            <input type='radio' id='attr_colr' name='attr_colr'  value='<?php echo $rw_extngsku[0]->color; ?>' <?php if($curnt_color==$rw_extngsku[0]->color){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" />	
                            <span class="<?php if($rw_extngsku[0]->quantity=0 || $rw_extngsku[0]->quantity=='' || ($curnt_size!=$rw_extngsku[0]->size && $curnt_color!=$rw_extngsku[0]->color) ){ echo "not-available"; } ?>">
                             <i style="background-color:<?php if($rw_extngsku[0]->color!='Multicolor'){ echo $rw_extngsku[0]->color;}?>;" <?php if($rw_extngsku[0]->color=='Multicolor'){ echo "class='multicolor'";}?> title="<?=$rw_extngsku[0]->color;?>" > </i> </span> 	 
                            </label>
                            </li>
										
							<?php				
									}	
								}
								?>
							</ul>	
						<?php	} // if color not blank condition end
							 
							//**********************************Recocde of color  end***************************************
							?>
							
                     
                      <!------------color code end--------------> 
                      
                      
                      
                      <!------------size code start--------------> 
                      
                      	<?php
						
						if($curnt_size!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid'  AND color='$curnt_color' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");
								
								if($query_extngsku->num_rows()<=1)
								{
										$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");
								}
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> Size : </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
									if($rw_extngsku[0]->size!='')
									{
									  ?>
										 
                            
                             <li> 
                             <?php 
							 
							 			if($rw_extngsku[0]->size==$curnt_size)
										 {$sku_select=$data_sku;}
										 else
										 {$sku_select=$rw_extngsku[0]->sku;}
							 
							// if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity=='' || ($curnt_color!=$rw_extngsku[0]->color && $curnt_size!=$rw_extngsku[0]->size) ){  ?><!--<div class="not-available"> </div>--><?php //} ?>
                             <label  class="size">  
                            <input type='radio' id='attr_size' name='attr_size'  value='<?php echo $rw_extngsku[0]->size; ?>' <?php if($rw_extngsku[0]->size==$curnt_size){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" />	
                            <span class="size-box <?php if($rw_extngsku[0]->quantity=0 || $rw_extngsku[0]->quantity=='' || ($curnt_color!=$rw_extngsku[0]->color && $curnt_size!=$rw_extngsku[0]->size) ){ echo "not-available"; } ?>">
							<?=$rw_extngsku[0]->size;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php
					 } 
						
						
						 
						?>
                      
                      
                      <!------------size code end----------------> 
                      
                      <!------------Capacity code start---------------->  
                		<?php if($cur_capacity!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> Capacity: </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
									if($rw_extngsku[0]->Capacity!='')
									{
									  ?>
										 
                            
                             <li> 
                             <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity=='' ){  ?><div class="not-available"> </div><?php } ?>
                             <label  class="size">  
                            <input type='radio' id='attr_capcity' name='attr_capcity'  value='<?php echo $rw_extngsku[0]->Capacity; ?>' <?php if($rw_extngsku[0]->Capacity==$cur_capacity){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span class="size-box"><?=$rw_extngsku[0]->Capacity;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php 
							 }  ?>
                    
                     
                
                	 <!------------Capacity code end--------------> 
                     
                     
                     <!------------RAM code start-----------------> 
                     
                        <?php
							if($cur_ram!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> RAM : </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
									if($rw_extngsku[0]->RAM!='')
									{
									  ?>
										 
                            
                             <li> 
                             <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity=='' ){  ?><div class="not-available"> </div><?php } ?>
                             <label  class="size">  
                            <input type='radio' id='attr_ram' name='attr_ram'  value='<?php echo $rw_extngsku[0]->RAM; ?>' <?php if($rw_extngsku[0]->RAM==$cur_ram){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span class="size-box"><?=$rw_extngsku[0]->RAM;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php 
							 }
						
						
						 ?>
                        
                     <!------------RAM code end-------------------------------------->
                     
                     <!------------ROM code START-------------------------------------->
                     
                     	<?php 
						
								if($cur_rom!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> ROM : </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
									if($rw_extngsku[0]->ROM!='')
									{
									  ?>
										 
                            
                             <li> 
                             
                             <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity=='' ){  ?><div class="not-available"> </div><?php } ?>
                             <label  class="size">  
                            <input type='radio' id='attr_rom' name='attr_rom'  value='<?php echo $rw_extngsku[0]->ROM; ?>' <?php if($rw_extngsku[0]->ROM==$cur_rom){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span class="size-box"><?=$rw_extngsku[0]->ROM;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php 
							 }
						
						?>
                     
                     <!------------ROM code END--------------------------------------> 
                     
                     
                <!------------------------------Color , Size , Capacity, ROM , ROM code END -------------------------->      
                       
              
                    
                <?php if($recd1->short_desc){
					?>
					
				<div class="gray-box">
                <h5> Product Details </h5>
                <ul class="prdct-highlights">
                <?php $data = $recd1->short_desc;
						
					$short_desc = unserialize($data);
						foreach($short_desc as $value){
							if($value != ''){
						?>
                <li><?=$value?> </li>
                <?php } } ?>
                </ul>
                
                </div>
               <?php } ?> 
               
               
               <div class="gray-box">
                
                <ul class="pay-optn">
                <li> <i class="fa fa-money" aria-hidden="true"></i> <br> Cash on Delivery</i> </li>
                <li> <i class="fa fa-credit-card" aria-hidden="true"></i> <br>  Easy EMI </li>
                <li> <i class="fa fa-exchange" aria-hidden="true"></i> <br>  100% Replacement Guarantee.</li>
                <div class="clearfix"> </div>
                </ul>
                
                </div>
                
                
                <div class="other-seller gray-box">
                <h5>  Sold by  </h5>
                <div class="slr-details"> <i class="fa fa-university" aria-hidden="true"></i>             
                
                <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rew->seller_id));?>"> <?php if($ct!=0){echo " ". $rew->business_name;}else {echo " moonboy";} ?></a>
                </div>
                <div class="slr-badge"> 
                              
                <?php
					if($seller_badge)
					
					{
						$badge_string = $seller_badge[0]->seller_badge_type;
						$badge_array = explode(',', $badge_string);
						
						if(in_array('Moonboy Fulfilled', $badge_array)){
					?>
                    <img src="<?php echo base_url()?>images/moon-fulfilled.png"  width="80">
					<?php 
						}
						if(in_array('Fast Shipping', $badge_array)){
					?>
					<img src="<?php echo base_url()?>images/fast-delivery.png"  width="110">								
					<?php
						}
						if(in_array('Star Seller', $badge_array)){
						?>
							<img src="<?php echo base_url()?>images/star-seller.png"  width="110" >								
					<?php	
						}
					}
					?>
                
                </div>
                <div class="clearfix"> </div>
                <?php $other_seller_product_row = $other_seller_product->num_rows();
			   if($other_seller_product_row > 0){ ?>
                 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                 <div class="panel panel-default">
                 <div class="panel-heading" role="tab" id="headingOne">
                 
                 <h4 class="panel-title">
               <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 
              From <?=$other_seller_product_row; ?> <?php if($other_seller_product_row == 1){ echo 'Other Seller';}else{ echo 'Other Sellers';} ?>   <i class="fa fa-angle-double-right" aria-hidden="true"></i>
               </a>
                </h4>
              </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      <div class="table-responsive">
      <table width="100%" class="table table-bordered">
  <tbody>
    <tr>
      <th >Sellers</th>
      <th >Rating</th>
      <th >Delivered By</th>
      <th >Price</th>
      <th > </th>
    </tr>
  <?php  foreach($other_seller_product->result() as $other_slr_product){ 
  
  							$cdate = date('Y-m-d');
							$special_price_from_dt = $other_slr_product->special_pric_from_dt;
							$special_price_to_dt = $other_slr_product->special_pric_to_dt;
							
							
							$quantity=$other_slr_product->quantity;
							$max_quantity=$other_slr_product->max_qty_allowed_in_shopng_cart;
							$stock=$other_slr_product->stock_availability;
  
  ?>
			   
    <tr>
      <td>
      <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($other_slr_product->seller_id));?>" id="goslr" style="cursor:pointer !important;" target="_blank"><?=$other_slr_product->business_name; ?></a>
      </td>
      <td>
       <?php
		
			if($seller_rating_result != false){
								foreach($seller_rating_result as $k => $v){
									if($k == $other_slr_product->seller_id){
										echo $v.' / 5';
									}
								}
							}else{
								echo ' ';
							}
		
		?>
      </td>
      <td>     
      	<?php
								$qr1 = $this->db->query("SELECT c.dispatch_days
												FROM seller_account a
												INNER JOIN state b ON a.seller_state = b.state
												INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
												WHERE a.seller_id ='$other_slr_product->seller_id'");
								$ct1 = $qr1->num_rows();
					 			$res = $qr1->row();
								if($ct1 > 0){
								?>
                                Delivered By : <?php echo $res->dispatch_days+4;?> - <?php echo $res->dispatch_days+5;?> Days 
                                <?php  }else{  ?>
                                 Delivered By : 10-12 Days 
                                 <?php } ?>
								,
                                <?php 
                             
								if($other_slr_product->shipping_fee_amount == 0){
									echo ' Free';
								}else{
									echo ' Rs. '.$other_slr_product->shipping_fee_amount;
								}
								?>
      
      </td>
      <td> 
      	<?php
                            if($other_slr_product->special_price !=0){ 
								if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
        					?>
                            
                            Rs. <?=ceil($other_slr_product->special_price); ?>
                            
                            
                            <?php } }else 
							
							{ echo "Rs.". ceil($other_slr_product->price); }
							
							?>
                            
                           
      
      </td>
      <td> <div class="single-bottom" ><label for="yes">
      
      <!-------------------------------------------------------------------------------------------------------------------------->
      
      			  <?php   if(@$this->session->userdata['session_data']['user_id']!=""){
								 if($quantity==0){
						 
						  ?>                          
	        <input type="radio" value="yes" name="radio" id="yes" disabled="disabled" > 
           
            <?php } else { ?>
            <input type="radio" value="yes" name="radio" id="yes" onClick="window.location.href='<?php echo base_url().'product_description/addtocart/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($other_slr_product->name))))).'/'.$other_slr_product->product_id.'/'.$other_slr_product->sku; ?>' "  >
			
			<?php } ?>
            
             <?php } else if($quantity==0){?>
            
            <input type="radio" value="yes" name="radio" id="yes" disabled="disabled" >
            
             <?php } else { ?>
             <input type="radio" value="yes" name="radio" id="yes" onClick="window.location.href='<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($other_slr_product->name))))).'/'.$other_slr_product->product_id.'/'.$other_slr_product->sku;?>' " >
             
            <?php } ?>               
      <span> </span> </label> </div>
      <!-------------------------------------------------------------------------------------------------------------------------->
      
      
      
      </td>
    </tr>
  <?php } ?>   
  </tbody>
</table>
</div>
      </div>
    </div>
  </div>
</div>
              
 <?php } ?>               </div>
 
 			  <div class="delivry-detls gray-box">  
                       <h5 > Check Availability </h5>
                        <input type="text" name="pin" id="pin" placeholder="Enter Your Pincode" class="pncd">
                       <button class="go-btn" href="#" onclick="valid_pin()"><span>Check</span> </button>
                       
                       <div id="valid_msg1" style="font-weight:bold; color:red;" ></div>
                       <div id="pin-msg" style="display:none; font-weight:bold; color:#093;"> Product is available at your location. </div>
                       <div id="pin_msg_cod" style="display:none; font-weight:bold; color:#90F;"> COD is also available. </div>
                         <div class="clearfix"> </div>
                       </div> 
               
                <!-----------------------------------------------Addtocart & Buynow Button Start---------------------------------------------------->
                <div class="btn_form">
                		 <?php   
					 if(@$this->session->userdata['session_data']['user_id']!=""){
						 if($rew->quantity==0){
					?>
	        <button type="button" id="1" title="Add to Cart"  class="submit" disabled="disabled" >Add to Cart</button>
            
            <button type="button" title="Buy Now" class="buy-btn" disabled="disabled">Buy Now</button> <br/>
            
            <?php } else { ?>
          
         <!-- Condition of vertual quantity not available start here-->
           <?php if($vertual_inventory_data <= 0){?>
           
            <button type="button" title="Add to Cart" id="2" onClick="alert('This product is out of stock.');" class="submit" >Add to Cart</button>
            <button type="button" title="Buy Now" onClick="alert('This product is out of stock.');" class="buy-btn">Buy Now</button> <br/>
            <!-- Condition of vertual quantity not available end here-->
            <?php } else{?>
            <!-- Condition of vertual quantity available start here-->
            <button type="button" title="Add to Cart" id="3" onClick="goAddtoCart('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",str_replace("'", "",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')" class="submit" >Add to Cart</button>       
            
            <button type="button" title="Buy Now" class="buy-btn" onClick="goAddtoCartBuyNow('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')" >Buy Now</button> <br/>
            
            
            
            <!-- Condition of vertual quantity available end here-->
			<?php } } ?>
            
             <?php } else if($rew->quantity==0){?>
            
            <button type="button" title="Add to Cart" id="4"  class="submit" disabled="disabled" >Add to Cart</button>
            
            <button type="button" title="Buy Now" class="buy-btn" disabled="disabled">Buy Now</button> <br/>
             <?php } else { ?>
              
             <!-- Condition of vertual quantity not available start here-->
           <?php if($vertual_inventory_data <= 0){?>
           
           <button type="button" title="Add to Cart" id="5" onClick="alert('This product is out of stock.');" class="submit">Add to Cart</button>
           <button type="button" title="Buy Now" onClick="alert('This product is out of stock.');" class="buy-btn">Buy Now</button> <br/>
           <!-- Condition of vertual quantity not available end here-->
           
           <?php }else{ ?>
           <!-- Condition of vertual quantity available start here-->
             <button type="button" title="Add to Cart" id="6" onClick="window.location.href='<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name))))).'/'.$product_data->product_id.'/'.$data_sku ?>' " class="submit" >Add to Cart</button>

           <?php /*?><button type="button" title="Buy Now" onClick="StoreInSession('<?=$product_data->product_id;?>','<?=$data_sku;?>','<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",str_replace("'", "",strtolower($recd1->name)))));?>')" class="buy-btn">Buy Now</button><?php */?> 
           
           <a href="<?php echo base_url().'user/m_login' ?>" class="buy-btn" title="Buy Now" >Log In To Buy Now </a><br/>
           <!-- Condition of vertual quantity available end here-->
            <?php } }?>
            </div>        
                
                <!------------------------------------------------Addtocart & Buynow Button End------------------------------------------------->
                
                <div class="clearfix">  &nbsp;</div>
                 <h4 class="title2"> Short Description  </h4>
    			<p class="m_desc"><?php //echo stripslashes($recd1->description);
				echo str_replace('\\', '', $recd1->description);
				 ?></p>
    			<!------------------------------------Product specification start----------------------------->
                <?php
	$attr_hedng_row = $product_attr_result->num_rows();
	
	if($attr_hedng_row > 0){
		
	?>
                		 <h3 class="tittle"> Specification </h3> 
                     <?php    
					 		$prodattr_skucronj=$data_sku;
									
							$query_attrcronjob=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$prodattr_skucronj' ");
							$rw_attrcronjob=$query_attrcronjob->row();
					 
					 	 $r=0;
                         foreach($product_attr_result->result() as $product_attr_heading_row){
								$r++;
								
								$sql = $this->db->query("SELECT product_id FROM product_attribute_value WHERE sku='$product_attr_heading_row->sku'");
							$sku_row = $sql->num_rows();
							if($sku_row > 0){
								$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.product_id='$product_attr_heading_row->product_id' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '')"
							);
							}else{
								
							
							$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.sku='$product_attr_heading_row->sku' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '')"
							);
							}
								if($query->num_rows()>0)	
								{
							?>
                <h4 class="qw<?=$r;?>" ><?=$product_attr_heading_row->attribute_heading_name;?> </h4>
        
       
								
								
                             <?php /*?><h3 class="tittle<?=$r;?>"> <?=$product_attr_heading_row->attribute_heading_name;?> </h3><?php */?>
                            <!--<h4 class="qw<?//=//$r;?>"><strong><?//=//$product_attr_heading_row->attribute_heading_name;?></strong></h4>-->
                            <?php
							
							
							$result = $query->result();
								foreach($result as $product_attr_row){
							?>
                            <table class="table table-striped table-hover" width="100%">
                             <tr>
                             <td width="30%"> <?=$product_attr_row->attribute_field_name; ?>   </td>
                             <td width="5%"> : </td>
                             <td style="text-align:left;"> <?php
									if($product_attr_row->attribute_field_name=='Color')
									{echo $rw_attrcronjob->color;}
									if($product_attr_row->attribute_field_name=='Size')
									{echo $rw_attrcronjob->size;}
									if($product_attr_row->attribute_field_name=='Capacity')
									{echo $rw_attrcronjob->Capacity;}
									if($product_attr_row->attribute_field_name=='RAM')
									{echo $rw_attrcronjob->RAM;}									
									if($product_attr_row->attribute_field_name=='ROM')
									{echo $rw_attrcronjob->ROM;}
									
									else if($product_attr_row->attribute_field_name != 'Color' && $product_attr_row->attribute_field_name != 'Size' && $product_attr_row->attribute_field_name != 'Capacity' && $product_attr_row->attribute_field_name != 'RAM'  && $product_attr_row->attribute_field_name != 'ROM')
									{ echo $product_attr_row->attr_value; }
									 
									 
									 ?> </td> 
                             </tr>  
                                  <?php }
								  } //if sub heading values not available condition end
							
							} 
							?> 
        					</table>
         <?php //}  ?>
         <?php } ?>       
                <!-----------------------------------product specification end-------------------------------->
                
                
                
                
                <!--<div class="social_single">	
				   <ul list-unstyled>	
					  <li class="fb"><a href="#"><span> </span></a></li>
					  <li class="tw"><a href="#"><span> </span></a></li>
					  <li class="g_plus"><a href="#"><span> </span></a></li>
					  <li class="rss"><a href="#"><span> </span></a></li>		
				   </ul>
			    </div>-->
			</div>
			
			<div class="clearfix"></div>
         </div>
				<!-- FlexSlider -->
		<script defer src="<?php echo base_url().'mobile_css_js/' ?>js/jquery.flexslider.js"></script>
		<link rel="stylesheet" href="<?php echo base_url().'mobile_css_js/' ?>css/flexslider.css" type="text/css" media="screen" />
		<script>
		// Can also be used with $(document).ready()
			$(window).load(function() {
				$('.flexslider').flexslider({
					//animation: "slide",
					controlNav: "thumbnails"
				 });
			});
		</script>
	<!-- //FlexSlider-->
					
  </div>
   <!--//view-product-->
   
  <div class="clearfix"></div> 
</div>

<?php include 'footer.php'; ?>  