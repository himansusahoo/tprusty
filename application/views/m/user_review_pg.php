<?php include "header.php"; ?>
<!--<script type= "text/javascript" src = "<?php //echo base_url(); ?>js/countries.js"></script>-->	
	<div class="wrap">
		<!--Profile-->
      <div class="profile">
	   
	      <div class="info-inner">
		     		      
		  <div class="section-info">
				<h3 class="tittle"> My Account </h3>
               
                <?php include "profile_menu.php"; ?>
                     
                    <!-- Nav tabs -->


  <!-- Tab panes -->
  
  <div class="order">
   <h3 class="tittle two">My reviews & Ratings</h3>
					
	  <div class="off-section" style="padding:10px;">
		<ul class="nav nav-tabs tabs-horiz">
            <li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Product Reviews</a></li>
            <li id="li_tab2"><a data-toggle="tab" href="#tab2">Seller Reviews</a></li>
        </ul>
        
        <!---- Tab content satrt here ---->
        <div class="tab-content form_view">
				<div id="tab1" class="tab-pane fade in active">
						<?php
                        	$no_of_product_review = $product_review->num_rows();
							if($no_of_product_review > 0){
								$result = $product_review->result();
                        ?>
					<h3>Reviews by <?=$result[0]->fname;?> (<?= $no_of_product_review;?>)</h3>
                    <?php
						$i=0;
						foreach($product_review->result() as $product_rev_rows){
							$i++;
							$date1 = $product_rev_rows->added_date;
							$dt1 = new DateTime($date1);
							$arr_img = explode(',',$product_rev_rows->imag);
							
							$cdate = date('Y-m-d');
							$special_price_from_dt = $product_rev_rows->special_pric_from_dt;
							$special_price_to_dt = $product_rev_rows->special_pric_to_dt;
							
							$taxdecimal = $product_rev_rows->tax_rate_percentage/100;
							
							//tax amount for product price
							$tax_amount = $product_rev_rows->price*$taxdecimal;
							
							//tax amount for product special price
							$tax_amount_special = $product_rev_rows->special_price*$taxdecimal;
					?> 
                    
                    <!-- Review start-->
                    <div class="review">
                     <div class="rev_product">
                     	<div class="rev_product_img"><img src="<?php echo base_url(); ?>images/product_img/<?=$arr_img[0]; ?>"></div>
                        <div class="rev_product_inn">
                        
                        	<h4 class="product-name" >
                            <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product_rev_rows->name)))).'/'.$product_rev_rows->product_id.'/'.$product_rev_rows->sku ?>" target="_blank">
                             <?= $product_rev_rows->name;?> </a>
                             </h4>
                            
                            
                              <p>  
                              <!--Price: <strong class="price">Rs. <?//= $product_rev_rows->price;?> </strong> -->
                              
                            <?php /*?>  <?php 
							  if($product_rev_rows->special_price !=0){ 
								  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
							  ?> 
							  
							  <span class="regular-price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
							  <span class="price"> Rs. <?=ceil($product_rev_rows->special_price); ?> </span>
							  <?php }else{ ?>
							  <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span>
								  <?php } //End of date condition ?>
							  
							  <?php }else{ ?>
							  <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span>
							  <?php } ?><?php */?>
                              
                              
                      <!--- Pricing script start here --->
                      <!---Special price exists condition start here --->
                      <?php
                      if($product_rev_rows->special_price !=0){
                          if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                      ?>
                      
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      
                      <?php if($product_rev_rows->price != 0){?>
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
                      <?php }?>
                      
                      <span class="price"> Rs. <?=ceil($product_rev_rows->special_price); ?> </span>
                      <!---Special price exists condition end here --->
                      <?php }else{ ?>
                      
                      <?php if($product_rev_rows->price != 0){?>
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
                      <?php }else{?>
                      <span class="price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <?php }?>
                      
                      <?php } //End of date condition ?>
                      
                      <?php }else{ ?>
                      
                      <?php if($product_rev_rows->price != 0){?>
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
                      <?php }else{?>
                      <span class="price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <?php }?>
                      
                      <?php } ?>
                      <!--- Pricing script end here --->
                                    
                              
                              <br>
                               <?php $desc=$product_rev_rows->short_desc;
					 $descp=unserialize(substr($desc,0));
					 $desc1=implode(',',$descp);?>
                               <?= $desc1;?></p>
                        </div>
                        <div class="clearfix"> </div>
                     </div>  
                     <div class="usr_product_rev_dv">
                     	<strong> <?= $product_rev_rows->title;?> </strong>&nbsp;&nbsp;&nbsp;<span class="rev_date">on <?= $dt1->format('Y-m-d'); ?></span><br/>
                        <span><strong style="color:#6bb700;"> <?= $product_rev_rows->fname;?> </strong>rated:
                        	<select id="backingd<?=$i; ?>" disabled>
                                <option value="1" <?php if($product_rev_rows->rating == 1){ echo 'selected';} ?>>Bad</option>
                                <option value="2" <?php if($product_rev_rows->rating == 2){ echo 'selected';} ?>>OK</option>
                                <option value="3" <?php if($product_rev_rows->rating == 3){ echo 'selected';} ?>>Great</option>
                                <option value="4" <?php if($product_rev_rows->rating == 4){ echo 'selected';} ?>>Excellent</option>
                                <option value="5" <?php if($product_rev_rows->rating == 5){ echo 'selected';} ?>>Excellent1</option>
                            </select>
    						<div class="rateit" data-rateit-backingfld="#backingd<?=$i; ?>" data-rateit-min="0"></div>
                        </span>
                        <p><?= $product_rev_rows->content;?></p>
                     </div> 
                     <div class="clearfix"> </div>
                     </div> <!-- Review End-->
                     <?php } } else{ ?>
                    <h4>REVIEWS (0)</h4>
                    <p>You have not written any product reviews.</p>
                     <?php } ?>
				</div>
				<div id="tab2" class="tab-pane fade">
                <?php $no_of_seller_review = $seller_review->num_rows();?>
                    <h4>REVIEWS (<?= $no_of_seller_review;?>)</h4>
                    <?php
					$sl=0;
					if($no_of_seller_review > 0){
						foreach($seller_review->result() as $rev_rows){
							$sl++;
							$date = $rev_rows->added_date;
							$dt = new DateTime($date);
					?>
					<div class="seller-review">
                    <h4 class="product-name">
                    <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rev_rows->seller_id));?>" target="_blank">
					<?= $rev_rows->business_name; ?></a>
                    </h4>
                    <select id="backing<?= $sl; ?>c<?= $sl; ?>" disabled>
                        <option value="1" <?php if($rev_rows->rating == 1){ echo 'selected';} ?>>Bad</option>
                        <option value="2" <?php if($rev_rows->rating == 2){ echo 'selected';} ?>>OK</option>
                        <option value="3" <?php if($rev_rows->rating == 3){ echo 'selected';} ?>>Great</option>
                        <option value="4" <?php if($rev_rows->rating == 4){ echo 'selected';} ?>>Excellent</option>
                        <option value="5" <?php if($rev_rows->rating == 5){ echo 'selected';} ?>>Excellent1</option>
                    </select>
                    <div class="rateit" data-rateit-backingfld="#backing<?= $sl; ?>c<?= $sl; ?>" data-rateit-min="0"></div>&nbsp;
                    <span class="rev_date"> on <?= $dt->format('Y-m-d'); ?></span><br/>
                    <h4 ><?= $rev_rows->title; ?></h4>
                    <p><?= $rev_rows->content; ?></p>
                    </div> 
				<?php } }else{?>
                <p>You have not written any seller reviews.</p> 
                
                <?php } ?>
				</div>
                
            </div>
            
        <!---- Tab content satrt here ---->
        
	</div>    
              
                                
  </div> 
  
    
  <!-- Tab panes -->   
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//profile-->
		
		</div>

<script>
function saveAddress(){
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
					$('#address_btn').val('Save Changes');
					
					setTimeout(function() { window.location.reload(true); }, 3000);
				
				}
				if(result == 'not saved'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/error.png"> &nbsp;No data Saved');
					$("#show_ssmsg_dv").css({'background-color':'pink','border':'1px solid salmon','color':'#d8000c'})
					$("#show_ssmsg").fadeIn();
					$('#address_btn').val('Save Changes');
				}
			}
		});
		
	}
}

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
///////User Persional Information script start here///////
function savePersionalInfo(){
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var mobile = $('#mob').val();
	var email = $('#hidden_mail').val();
	//var otp = $('.otp').val();
	var sex = $("input[name='sex']:checked").val();
	if(fname == ''){
		$('#fname').css('border-color','red');
		$('#fname').focus();
		$('.nam1').show();
		return false;
	}else if(lname == ''){
		$('#fname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('#lname').css('border-color','red');
		$('#lname').focus();
		$('.nam2').show();
		return false;
	}else if(mobile == ''){
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mob').css('border-color','red');
		$('#mob').focus();
		$('.mob1').show();
		return false;
	}else if(isNaN(mobile)){
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mob').css('border-color','red');
		$('#mob').select();
		$('.mob1').show();
		$('.mob1').text('Please Enter a valide Mobile number.');
		return false;
	}else if(mobile.length != 10){
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mob').css('border-color','red');
		$('#mob').select();
		$('.mob1').show();
		$('.mob1').text('Please enter 10 digit mobile number.');
		return false;
	}
	//else if(otp == ""){
//		$('#fname').css('border-color','#ebebeb');
//		$('#lname').css('border-color','#ebebeb');
//		$('.otp').css('border-color','#ebebeb');
//		$('.nam1').hide();
//		$('.nam2').hide();
//		$('.mob1').hide();
//		$('.otp').css('border-color','red');
//		$('.otp').focus();
//		$('.otp').show();
//		$('.otp1').show();
//		return false;
//	}
	else{
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('#mob').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();		
		$('.mob1').hide();
		
		$('#persional_btn').val('Processing...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/persional_info',
			method:'post',
			//data:{fname:fname,lname:lname,mobile:mobile,otp:otp,email:email,gen:sex},
			data:{fname:fname,lname:lname,mobile:mobile,email:email,gen:sex},
			success:function(result){
				if(result == 'success'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Your changes have been saved successfully.');
					$("#show_ssmsg_dv").css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'})
					$("#show_ssmsg").fadeIn();
					$('#persional_btn').val('Save Changes');
					//window.location.reload(true);
					setTimeout(function() { location.reload() },1500);
				}
				if(result == 'not'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/error.png"> &nbsp;No data Updated');
					$("#show_ssmsg_dv").css({'background-color':'pink','border':'1px solid salmon','color':'#d8000c'})
					$("#show_ssmsg").fadeIn();
					$('#persional_btn').val('Save Changes');
				}
			}
		});
		
	}
}
///////User Persional Information script end here///////

//$.fn.delayKeyup = function(callback, ms){
//     var timer = 0;
//     var el = $(this);
//     $(this).keyup(function(){                   
//         clearTimeout (timer);
//         timer = setTimeout(function(){
//             callback(el)
//                 }, ms);
//     });
//     return $(this);
// };
// 
// $('#mob').delayKeyup(function(el){
//	var mobile = el.val();  
//	var otp = $('#otp').val();
//	var email = $('#hidden_mail').val();
//	if(mobile == ''){
//		$('#mob').css('border-color','red');
//		$('#mob').focus();
//		$('.mob1').show();
//		return false;
//	}else if(isNaN(mobile)){
//		$('#mob').css('border-color','red');
//		$('#mob').select();
//		$('.mob1').show();
//		$('.mob1').text('Please Enter a valide Mobile number.');
//	}else if(mobile.length != 10){
//		$('#mob').select().css('border-color','red');
//		$('#mob').select();
//		$('.mob1').show();
//		$('.mob1').show().text('Please enter 10 digit mobile number.');
//	}else{
//		$('#mob').css('border-color','#ccc');
//		$('.mob1').hide();
//		$('.otp').show();
//		$('.otp1').show().text('Please chech your mail for OTP').css('color','green');
//		$('.account_form').find('#otp').removeClass('req');
//		
//		
//		var base_url = "<?php //echo base_url(); ?>";
//		var fname = $('#fname').val();
//		var lname = $('#lname').val();
//		var mobile = $('#mob').val();
//		var email = $('#hidden_mail').val();
//		$.ajax({
//			url : base_url+'user/send_mobile_change_otp',
//			type : 'POST',
//			data : {fname:fname, lname:lname, mobile:mobile, email:email},
//			success:function(result){
//				if(result == 'success'){
//					alert("To get OTP, Please check your email.");
//					return false;
//				}
//			}
//		});
//	}
//},1800);

</script>
<?php include "footer.php"; ?>