<?php include 'header.php';?>
<meta name="Description" content="<?php echo @$data->meta_desc ;?>">
        <meta name="Keywords" content="<?php echo @$data->meta_keywords ;?>" />
        
        <link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>"/>
        
		<title><?php
			if($page_title->meta_title!='')
		 	{
				echo @$page_title->meta_title ;
		
     		}else
            {
            		$curpricequery=$this->db->query("SELECT name, current_price,lvl2,lvl1 FROM cornjob_productsearch WHERE sku='$data_sku' ");
					$rw_curprice=$curpricequery->row();
					echo "Buy Online ".$rw_curprice->name.'@Rs.'.number_format($rw_curprice->current_price, 0, ".", ",");
           	}
       		 ?></title>
<style >
		

collpse.tabs{
	padding:0px 0;
}
.top-products h3,.features h3,.top-brands h3,.contact h3,.about h3,.team h3,h3.agileits-icons-title,.faq h3,.products h3,.login h3,.check-out h3,.payment h3{
	font-size:40px;
	color:#000;
	
}


/*-- collapse-tabs -*/
.collpse.tabs {
    padding-bottom:0;
}
.panel-group {
    margin-bottom: 0;
}
.collpse.tabs h4.panel-title a {
    font-size: 1em;
    text-transform: uppercase;
    color: #000;
    display: block;
    text-decoration: none;
    padding: .5em 1.5em;
    font-weight: 300;
	position:relative;
}
.collpse.tabs .panel-default {
    border-color:#C5C5C5;
}
.collpse.tabs .panel-body {
	padding: 15px;
	color: #999;
	line-height: 1.8em;
	font-size: 1em;
}
.collpse.tabs .panel-default > .panel-heading {
    padding: 0;
    background:#fff;
} 
.pa_italic span.fa-arrow{
    display: none;
}
.pa_italic i.fa-arrow, .collapsed span.fa-arrow{
    right: 3%;
    font-size: 1.1em;
    color:#666;
    position: absolute;
    top: 20%; 
}
.collapsed i.fa-arrow{
    display: none;
}
.collapsed span.fa-arrow{
    display: inline-block;
}
.pa_italic i.fa-icon {
    margin-right: 0.8em;
}
.products .panel-title {
    text-align: left;
}

.not-active {
   pointer-events: none;
   cursor: default;
}

.glry-w3agile-grids {
    background-color: #FFF;
    display: block;
    overflow: hidden;
    position: relative;
    -webkit-box-shadow: 0 0 0 0 #555;
    -moz-box-shadow: 0 0 0 0 #555;
    -o-box-shadow: 0 0 0 0 #555;
    -ms-box-shadow: 0 0 0 0 #555;
    box-shadow: 0 0 0 0 #555;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
    opacity: 1;
    filter: alpha(opacity=100);
}


button.first-accordion {
    background-color: #f5f5f5;
    color: #444;
    cursor: pointer;
    padding: 7px 10px;
    width: 100%;
    border: 1px solid #ddd;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    border-radius: 3px;
    margin-bottom: 5px;
}

button.first-accordion.active, button.first-accordion:hover {
    background-color: #f5f5;
}

button.first-accordion:after {
    content: '\02C7';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: 1px solid #afadad;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    text-align: center;
    padding: 0px;
	
}

button.first-accordion.active:after {
    content: "\02C6";
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: 1px solid #afadad;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
}

div.panel {
    padding: 0 15px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
	    margin-bottom: 0!important;
}
div.panel ul li {
    list-style: none; 
}
.top-accordian{
	    background-color: #f2f2f2;
    color: #444;
    cursor: pointer;
    padding: 7px 10px;
    width: 100%;
    border: 1px solid #ddd;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    border-radius: 3px;
    margin-bottom: 6px;
}
.search_big1 {
    height: 50px;
    width: 100%;
}
.search_big1 input[type="search"] {
    width: 90%;
}
.search_big1 .search{
	position: absolute;
    margin-top: 5px;
    margin-right: 14px;
    height: 42px;
}

.brands-name img {
    width: 35%;
	float:left;
}
.brands-held{
	width:100%; 
	margin:auto; 
	padding:5px;
}
.brands_products ul{ background:#e3e3e3; padding:0!important;}
.brands_products ul li{
	padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc;
}
.brands_products ul li:hover{ background:#ED2541;color:#fff;}
.brands_products ul li a{font-size:17px; text-decoration:none; color:#000;}
.accordion {
      width: 100%;
    margin: 0px auto 0px;
    background: #FFF;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #f2f2f2;
}

.accordion .link {
  cursor: pointer;
  display: block;
  padding: 15px 15px 15px 42px;
  color: #4D4D4D;
  font-size: 14px;
  font-weight: 700;
  margin-bottom: 2px;
    background: #e3e3e3;
  border: 1px solid #CCC;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li:last-child .link { border-bottom: 0; }

.accordion li i {
  position: absolute;
  top: 16px;
  left: 12px;
  font-size: 18px;
  color: #595959;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
  right: 12px;
  left: auto;
  font-size: 16px;
}

.accordion li.open .link { color: #b63b4d; }

.accordion li.open i { color: #b63b4d; }

.accordion li.open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/


.submenu {
  display: none;
  
  font-size: 14px;
}

.submenu li { border-bottom: 1px solid #4b4a5e;background: #444359; }

.submenu a {
  display: block;
  text-decoration: none;
  color: #d9d9d9;
  padding: 12px;
  padding-left: 42px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}
.submenu a:hover{background:#F00;}
.m_desc {
    text-align: justify;
}
.btn_form .buy-btn {
    padding: 13px 13px!important;
}
.catagory-banner {
    float: left;
    width: 50%;
/*    border-right: 1px solid #B9B9B9;
*/    /* height: 160px; */
    padding:10px;
/*   border-bottom: 1px solid #B9B9B9;
*/}
.catagory-banner img {
    width: 95%;
	float:left;
	margin-right: 15px;
}
.category-products .panel {
    max-height: 2000px!important;
}
.brands-name {
    border: 1px solid #F7F7F0;
     padding-bottom: 0px!important;
    padding-top: 0px!important;
    width: 48%;
    float: left;

}
.prduct-sl-1st{
	width:100%; padding:0; height:30px;
	}
.price_single .dlvry-date {
    padding: 0px;
    font-size: 11px;
}
.pncd {
    margin: 0px!important;
}
.go-btn {
    padding: 12px!important;
}
.labout {
    width: 100%!important;
}
.discount {
    margin-top: -10px;
}
.price_single .dlvry-date {
    width: 40%;
    float: right;
}
</style>      
        	<link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/font-awesome.min.css">
            <link href="<?php echo base_url()?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/style.css" rel="stylesheet" type="text/css"/>
             <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery-1.11.1.min.js"></script>
            <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.tinycarousel.js"></script>
            
    
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
	</script>
	<script src="<?php echo base_url()?>mobile_css_js/new/js/bootstrap.min.js"></script>            
    <script src="<?php echo base_url()?>mobile_css_js/new/js/bigSlide.js"></script>
    <script>
        $(document).ready(function() {
        $('.menu-link').bigSlide();
        });
    </script>
               
     	<!-- requried-jsfiles-for owl -->
    <link href="<?php echo base_url()?>mobile_css_js/new/css/owl.carousel.css" rel="stylesheet">
    <script src="<?php echo base_url()?>mobile_css_js/new/js/owl.carousel.js"></script>
    <?php 
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
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                items : 4,
                lazyLoad : true,
                autoPlay : true,
                pagination : true,
            });
        });
    </script>
        
    <script>
    	function valid_pin(curprice){
				var pin=document.getElementById('pin').value;
				 if(pin==""){
					 $('#valid_msg1').show().text('Please enter your Pin Number!');
					return false;
				}
				else if(isNaN(pin)){
					$('#valid_msg1').show().text('Enter a valid Pin Number');
					return false;					
				}
				else if(pin.length != 6){
					$('#valid_msg1').show().text('Enter a 6-digit Pin Number');
					return false;
				}
				else if(pin.length == 6)
				{
					$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>Mycart/pincode_check",
					data:{pincode:pin},
					success: function (data) {
								if(data == 'COD'){
									$('#pin-msg').show();
									$('#pin_msg_cod').show();
									$('#valid_msg1').hide();
									
									codcharge_chk(curprice);									
								}
								else
								{
									$('#pin-msg').show();
									$('#pin_msg_cod').hide();
									$('#valid_msg1').hide();
									$('#codchrg_spn').hide();	
								}
								
							}
						});
						
						
				}
			}
			
	function codcharge_chk(curprice)
	{ var pin=document.getElementById('pin').value;
		var prodid=<?=$this->uri->segment(2);?>	
						
					$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>Mycart/prodcod_chargesapply",
					data:{pincode:pin,prodid:prodid,curprice:curprice},
					success: function (data) {
								if(data){
									//$('#pin-msg').show();
									$('#codchrg_spn').html(data);
									$('#codchrg_spn').show();
									$('#valid_msg1').hide();									
								}
								else
								{
									//$('#pin-msg').show();
									//$('#pin_msg_cod').hide();
									$('#codchrg_spn').hide();
									$('#valid_msg1').hide();	
								}
								
							}
						});
						
	}		
			
    </script>
    <script type="text/javascript">
		 function bigimgbox()
		 {
			 $(".flexslider").addClass("fullimgview");
			 $(".backbtn").css("display","block");
			 $(".simpleLens-lens-image").css("display","block");
			 $(".hands_disable").css("display","none");
			 $(".alldata").css("display","none");
			 $(".foot-no").css("display","none");
			 $(".backend-sec").css("display","none");
			 $('body').addClass('bodyScrollLock');
		 }
		
		 function backbtn()
		 {
			 $(".flexslider").removeClass("fullimgview");
			 $(".backbtn").css("display","none");
			 $(".hands_disable").css("display","block");
			 $(".alldata").css("display","block");
			 $(".foot-no").css("display","block");
			 $(".backend-sec").css("display","block");
			  $('body').removeClass('bodyScrollLock');
		 }

	</script>
    <script>
		function addtoWishlist(product_id,sku){		
				$.ajax({
				url:'<?php echo base_url(); ?>user/add_wishlist',
				method:'post',
				data:{product_id:product_id,sku:sku},
				success:function(result){
					
					if(result=='success'){
						alert('successfully added');
						window.location.reload(true);
					}
					if(result=='exists'){
						window.location.href='<?php echo base_url(); ?>wish-list';
					}
				}
			});
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
    
    

    </head>

<div class="body-back">

        	<div class="masthead pdng-stn1">
         <div class="wrap push" id="home">
         <div class="view-product" id="view">
   		
				  <!--/view-->
				 <?php $query=$this->db->query("select * from product_general_info where product_id='$product_data->product_id'");
				  			$recd1=$query->row(); ?>
			<div class="cont span_2_of_3 inner">
			<h3 class="m_3"><?=$recd1->name;?></h3>
			     <div class="labout span_1_of_a1">
				<!-- start product_slider -->
				<div class="flexslider">
                		<a  class="backbtn" onclick="backbtn()" style="display:none;">Back</a>
							  <ul class="slides">
								<?php			
		
							  	$rec=explode(',',$product_data->imag);
							   foreach($rec as $val){ ?>
								<li data-thumb="<?php echo base_url().'images/product_img/'.$val; ?>">
									 <div class="thumb-image simpleLens-lens-image">
                                     	<a href="#" onclick="bigimgbox()">
                                        	<img src="<?php echo base_url().'images/product_img/'.$val; ?>" alt="<?=$recd1->name;?>">
                                         </a>
                                         <div style="clear:both;"></div>
                                         <a style="float:right;" href="#" class="hands_disable" onclick="bigimgbox()"> 
                              <img src="<?php echo base_url().'mobile_css_js/' ?>images/touchtozoom.png" width="50" height="" alt="zoom" class="img-zoom" draggable="false">
                               </a>
                                     </div>
								</li>
								 <?php } ?>
							  </ul>
							
				   </div>

				<!-- end product_slider -->
			</div>
            <div class="alldata">
			<div class="cont1 span_2_of_a1 pull-right">
				
				
				          <div class="price_single">
                          
                          <div class="price-dtls">
                          		<?php  
									$query=$this->db->query("select * from product_master where sku='$data_sku' ");
									$recd=$query->row();
									$cdate = date('Y-m-d');
									$special_price_from_dt = $recd->special_pric_from_dt;
									$special_price_to_dt = $recd->special_pric_to_dt;
								?>
                              <!--------------------------------------Price Section Start------------------------------------------------>
                              
                              <?php
								if($recd->special_price !=0){
									if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
								?>
                                <div class="cut-price"> MRP - Rs.<?=ceil($recd->mrp); ?></div>                        
                                <?php if($recd->price != 0){?>
                                <div class="reducedfrom"> Sell Price - Rs.<?=ceil($recd->price); ?> </div>
                                <?php }?>
                                
                     			<div class="actual"> <span>Special Price - Rs.<?=ceil($recd->special_price); ?><?php $cur_price=ceil($recd->special_price); ?></span></div>
                        
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
                             <!--------------------------------------Price Section End------------------------------------------------>  
                              <div class="clearfix"> </div>
                            </div> 
                             	<?php
									$query=$this->db->query("select * from product_master where sku='$data_sku' ");
									foreach($query->result_array() as $rw ) {
									$cur_prodprice=0;
									$cursplprc_foroff=0;
									  if($rw['special_price'] !=0)
									  {
										   if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt)
										   {$cur_prodprice= $rw['special_price'];
											$cursplprc_foroff=$rw['special_price'];
										   }
									  }
									  if($rw['price'] != 0 && $rw['special_price']==0)
									  {$cur_prodprice=$rw['price'];}
									  
									  if($rw['price'] == 0 && $cursplprc_foroff==0)
									  {
										$cur_prodprice=	$rw['mrp'];	  
									  }
									  
									  $percen_curprc=((100/$rw['mrp'])*$cur_prodprice);
									  
									  $percen_off=100- round($percen_curprc); 
									  $cur_splprc=0;                                		
							 	?>
                             <?php }?>
									 <?php if($percen_off>0){ ?>
                               <div class="discount"><?=$percen_off?>% <br> OFF </div>
                               <?php } ?>
                               <div class="sphng">
                               		<!--------------------------------------Shipping charges Section Start------------------------------------------------>
									   <?php
                                            $query=$this->db->query("select a.business_name,a.seller_id,b.shipping_fee_amount,b.status,b.approve_status from seller_account_information a inner join product_master
 b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'");
                                            $ct=$query->num_rows();
                                            $rew=$query->row();
                                       ?>
                                       <?php
                                            if($rew->shipping_fee_amount == 0){
                                       ?>
                               			<span style="float:left; width:60%"> <img src="<?php echo base_url()?>images/free shipping-icon.png" height="20" width="30"> &nbsp;(Shipping charges free)</span>
                                       <?php /*?> <img src="<?php echo base_url()?>images/free shipping-icon.png" height="30px" width="30px"></span><?php */?>
                                         
                                    <?php } else {?>
                                    	<span style="float:left; width:50%">Shipping fee &nbsp;Rs.<?php echo $rew->shipping_fee_amount; ?></span>                                    <?php }?>
                               <!--------------------------------------Shipping charges Section End------------------------------------------------>
                               
                               <!--------------------------------------Delivered Section Start----------------------------------------------------->
                               
                                <span class="dlvry-date">
                                	<?php
										$qr1 = $this->db->query("SELECT c.dispatch_days
												FROM seller_account a
												INNER JOIN state b ON a.seller_state = b.state
												INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
												WHERE a.seller_id ='$rew->seller_id'");
										$ct1 = $qr1->num_rows();
										 $res = $qr1->row();
										 if($ct1 > 0){
									 ?>                                     
                       					Delivered By: 4 - 6 Days
									 <?php  }else{  ?>
                                     	Delivered By : 10-12 Days 
                                     <?php } ?>
                                </span>
                               
                               <!--------------------------------------Delivered Section End------------------------------------------------------->
                                   
                               </div>
                               
                               <div class="clearfix"></div>
                            
                            
                               
                                    
			  </div>
              <div class="delivry-detls gray-box">
                <h5> Check Availability </h5>
                <input class="pncd" type="text" placeholder="Enter Your Pincode" name="pin" id="pin">
                <a class="go-btn" onclick="valid_pin(<?=$cur_prodprice?>)"><span>Check</span> </a>
                <div id="valid_msg1" style="font-weight:bold; color:red;" ></div>
                <div class="clearfix"> </div>
                <h5 id="pin-msg" style="display:none; font-weight:bold; color:#093; class="pro">Product is available at your location</h5>
                <div><span id="pin_msg_cod" style="display:none; color:#909; class="left cod1">COD is also available.</span>
                <span class="right cod2" id="codchrg_spn"></span></div><div class="clearfix"></div>
                
                <ul class="star">
                	<?php
						$number_review = $review_result->num_rows();
						if($number_review != 0){
							$rating = array();
							foreach($review_result->result() as $val){
								$rating[] = $val->rating;
							}
							$total_sum_of_rating = array_sum($rating);
							$average_rating = ceil($total_sum_of_rating / $number_review) ;
						}else{
							$average_rating = 0;
						}
					?>
                    <li><i class="fa fa-star" aria-hidden="true" <?php if($average_rating==0){?> style="color:#CCC;" <?php } ?>></i></li>
                    <li><i class="fa fa-star" aria-hidden="true" <?php if($average_rating<=1){?> style="color:#CCC;" <?php } ?>></i></li>
                    <li><i class="fa fa-star" aria-hidden="true" <?php if($average_rating<=2){?> style="color:#CCC;" <?php } ?>></i></li>
                    <li><i class="fa fa-star" aria-hidden="true" <?php if($average_rating<=3){?> style="color:#CCC;" <?php } ?>></i></li>
                    <li><i class="fa fa-star" aria-hidden="true" <?php if($average_rating<=4){?> style="color:#CCC;" <?php } ?>></i></li>
                    <li class="review"> | &nbsp; <?= $number_review ;?> reviews  </li>
                    <li class="add-to-links right">
                    	<?php if($this->session->userdata('session_data')){ ?>
                    		<i class="fa fa-heart-o"></i><a onClick="addtoWishlist(<?=$product_data->product_id; ?>,'<?=$data_sku; ?>')">Add to Wish list</a></span>
                        <?php } else {?>
                        	<i class="fa fa-heart-o"></i><a href="<?php echo base_url().'user/m_login' ?>">Add to Wish list</a></span>
                        <?php }?>
                    </li>
                 </ul>
                </div>
                   <div class="options">
                   <?php
				   		$query_curclolr=$this->db->query("SELECT color, size,lvl2 FROM cornjob_productsearch WHERE sku='$data_sku' group by sku ");
						$curnt_color=$query_curclolr->row()->color;
						$curnt_size=$query_curclolr->row()->size;
						
						$cur_lvl2=$query_curclolr->row()->lvl2;
				    ?>
                    <?php
						if($curnt_color!=''){
							$cur_productid=$recd->product_id;
							$prodname_wisecolr=$recd1->name;
							$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' 
													AND size='$curnt_size'  AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
							if($query_extngskugrp->num_rows()<=1)
							{
									$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' 
													AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
							}
							$rw_extngskugrp=$query_extngskugrp->result_array();
					 ?>
                     <!------------------------------------------------------Color Code Section Start---------------------------------------> 
				  	<ul class="color_list">
                    <h4> Color : </h4>
                    	
                    	<?php
							foreach($rw_extngskugrp as $res_extngsku)
								{
									$sku_ext=$res_extngsku['sku'];
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' 
													AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
									if($rw_extngsku[0]->color!='')
									{
						 ?>
                        <li>
                        	<?php 
							  if($rw_extngsku[0]->color==$curnt_color)
							 	{
									$sku_select=$data_sku;
								}
							 else
							 	{
								 	$sku_select=$rw_extngsku[0]->sku;
								}
							?>
                        	<label class="color"> 
                            <input type="radio" id="attr_colr" name="attr_colr" value='<?php echo $rw_extngsku[0]->color; ?>' <?php if($curnt_color==$rw_extngsku[0]->color){echo "checked='checked'";} ?> onclick="window.location.href='<?php echo base_url().$prod_nm.'/'.$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'">	
                            <span class="">
                                <i style="background-color:<?php if($rw_extngsku[0]->color!='Multicolor'){ echo $rw_extngsku[0]->color;}?>;" <?php if($rw_extngsku[0]->color=='Multicolor'){ echo "class='multicolor'";}?> title="<?=$rw_extngsku[0]->color;?>"> </i> </span> 	 
                            </label>
                        </li>
                        <?php } }?>
					</ul>
                    <?php }?>
                    <!------------------------------------------------------Color Code Section End---------------------------------------> 
                    
                    <!------------------------------------------------------Size Code Section Start--------------------------------------->
                    <?php 
						if($curnt_size!=''){
							$cur_productid=$recd->product_id;						
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' 
									AND color='$curnt_color' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");							
							if($query_extngsku->num_rows()<=1)
							{
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' 
									AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");
							}
							
							$rw_extngsku=$query_extngsku->result_array();
					
					?>
					<ul class="size_list">
                    <h4> Size : </h4>
                    	<?php 
							foreach($rw_extngsku as $res_extngsku)
								{
									
								$sku_ext=$res_extngsku['sku'];
								$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' 
										AND status='Enabled' AND seller_status='Active' group by sku ");

								$rw_extngsku=$query_extngsku->result();
								$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
								if($rw_extngsku[0]->size!='')
								{						
						?>
                        <li>
                        	<?php 
								if($rw_extngsku[0]->size==$curnt_size)
									{
										$sku_select=$data_sku;
									}
								else
								 	{
									 $sku_select=$rw_extngsku[0]->sku;
									}
							
							?>
                        	<label class="size">  
                            <input type="radio" id="attr_size" name="attr_size" value='<?php echo $rw_extngsku[0]->size; ?>' <?php if($rw_extngsku[0]->size==$curnt_size){echo "checked='checked'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'">
                            <span class="size-box <?php if($rw_extngsku[0]->quantity=0 || $rw_extngsku[0]->quantity=='' || ($curnt_color!=$rw_extngsku[0]->color && $curnt_size!=$rw_extngsku[0]->size) ){ echo "not-available"; } ?>"><?=$rw_extngsku[0]->size;?></span>
                            </label>
                        </li>
                        <?php } }?>
					</ul>
                    <?php } ?>
                    <!------------------------------------------------------Size Code Section End--------------------------------------->
                    
                    <div class="clearfix"></div>
                    </div>
                    <?php $query=$this->db->query("select a.business_name,a.seller_id,b.quantity,b.stock_availability,a.display_name,b.max_qty_allowed_in_shopng_cart,b.status,b.approve_status from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'"); 
					 $ct=$query->num_rows();
					 $rew=$query->row();
					 
					 $max_quantity=$rew->max_qty_allowed_in_shopng_cart;
					 ?>
                     
                 <!-------------------------------------------Add To Cart And Buy Now Section Start--------------------------------------->    
                <div class="btn_form">
                  <?php
				  	if(@$this->session->userdata['session_data']['user_id']!=""){
						 if($rew->quantity==0 || $rew->status=='Disabled'|| $rew->approve_status =='Inactive'){				  
				  ?>
                  	<button type="button" id="1" title="Add to Cart" style="background: #ccc; color: #fff;" class="submit" disabled="disabled" >Add to Cart</button>
            		<button type="button" title="Buy Now" style="background: #b1a9a9; color: #fff;" class="buy-btn" disabled="disabled">Buy Now</button> <br/>
                    <b style="color:#900; font-size:16px;">
			<?php 
			if($rew->quantity==0  || $rew->status=='Disabled'|| $rew->approve_status =='Inactive'){
				
				if($rew->quantity==0  || $rew->status =='Disabled' ){
						 
						 if($rew->quantity==0){echo "Out of Stock";}
						 else{echo "Product  has been Temporarily Discontinued";}
					}
					else{echo "Product has been Discontinued";}
			 } 
			
			?></b>
                    <?php } else {?>
                    <?php if($vertual_inventory_data <= 0){?>
                        <button type="button" title="Add to Cart" id="2" onClick="alert('This product is out of stock.');" class="submit" >Add to Cart</button>
                        <button type="button" title="Buy Now" onClick="alert('This product is out of stock.');" class="buy-btn">Buy Now</button> <br/>
                    <?php } else{ ?>
                    	<button type="button" title="Add to Cart" id="3" onClick="goAddtoCart('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",str_replace("'", "",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')" class="submit" >Add to Cart</button>       
            
            <button type="button" title="Buy Now" class="buy-btn" onClick="goAddtoCartBuyNow('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')" >Buy Now</button> <br/>
                    <?php }  }?>
                    <?php } else if($rew->quantity==0 || $rew->status=='Disabled'|| $rew->approve_status =='Inactive'){ ?>
                    	<button type="button" title="Add to Cart" id="4" style="width:100%;background: #ccc; color: #fff;" class="submit" disabled="disabled" >Add to Cart</button>
            			<?php /*?><button type="button" title="Buy Now" class="buy-btn" disabled="disabled">Buy Now</button><?php */?> <br/>
                      <b style="color:#900; font-size:16px;">
						<?php 
                        if($rew->quantity==0  || $rew->status=='Disabled'|| $rew->approve_status =='Inactive'){
                            
                            if($rew->quantity==0  || $rew->status =='Disabled' ){
                                     
                                     if($rew->quantity==0){echo "Out of Stock";}
                                     else{echo "Product  has been Temporarily Discontinued";}
                                }
                                else{echo "Product has been Discontinued";}
                         } 
                        
                        ?></b>  
                    <?php } else {?>
                    <?php if($vertual_inventory_data <= 0){?>
                       <button type="button" title="Add to Cart" id="5" onClick="alert('This product is out of stock.');" class="submit">Add to Cart</button>
                       <button type="button" title="Buy Now" onClick="alert('This product is out of stock.');" class="buy-btn">Buy Now</button> <br/>
                    <?php }else{ ?>
             			<button type="button" title="Add to Cart" id="6" onClick="window.location.href='<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name))))).'/'.$product_data->product_id.'/'.$data_sku ?>' " class="submit" style="width:100%" >Add to Cart</button>
           				<?php /*?><a href="<?php echo base_url().'user/m_login' ?>" class="buy-btn" title="Buy Now" >Log In To Buy Now </a><?php */?><br/>
            <?php } }?>
				</div>
				<!-------------------------------------------Add To Cart And Buy Now Section Start--------------------------------------->    
                   
                <div class="clearfix"></div>
                <!------------------------------------------------------------Product Details Section Strat------------------------------>
                <?php 
					if($recd1->short_desc){
				?>
                <div class="gray-box">
                <h5> Product Details </h5>
                    <ul class="prdct-highlights">
                    	<?php 
							$data = $recd1->short_desc;
							$short_desc = unserialize($data);
								foreach($short_desc as $value){
									if($value != ''){
						?>
                        <li><?=$value?></li>
                         <?php } } ?>
                    </ul>
                </div>
                <?php }?>
                <!------------------------------------------------------------Product Details Section Strat------------------------------>
                 <div class="other-seller gray-box">
                <h5>  Sold by  </h5>
                <div class="slr-details"> <i class="fa fa-university" aria-hidden="true"></i>
                 <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rew->seller_id));?>"> <?php if($ct!=0){echo " ". $rew->business_name;}else {echo " moonboy";} ?></a> </div>
                 <!------------------------------------------------------------Product Details Section End------------------------------>
                <div class="slr-badge">
                <!----------------------------------Sold By Image Section Start----------------------------------------------->
                <?php
					if($seller_badge)					
					{
						$badge_string = $seller_badge[0]->seller_badge_type;
						$badge_array = explode(',', $badge_string);						
						if(in_array('Moonboy Fulfilled', $badge_array)){?>
                    		<img src="<?php echo base_url()?>images/moon-fulfilled.png"  width="80">
						<?php } if(in_array('Fast Shipping', $badge_array)){ ?>
							<img src="<?php echo base_url()?>images/fast-delivery.png"  width="110">								
						<?php } if(in_array('Star Seller', $badge_array)){ ?>
							<img src="<?php echo base_url()?>images/star-seller.png"  width="110" >								
				<?php } } ?>
                <!----------------------------------Sold By Image Section End----------------------------------------------->
                </div>
                <div class="clearfix"> </div>
                <!----------------------------------Sold By Table Section Start----------------------------------------------->
                 <div class="collpse tabs">
				 <?php $other_seller_product_row = $other_seller_product->num_rows();
			   	if($other_seller_product_row > 0){ ?>
				<div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" >
									<i class="fa fa-file-text-o fa-icon" aria-hidden="true"></i> From <?=$other_seller_product_row; ?> <?php if($other_seller_product_row == 1){ echo 'Other Seller';}else{ echo 'Other Sellers';} ?> <span class="fa fa-angle-down fa-arrow" aria-hidden="true"></span> <i class="fa fa-angle-up fa-arrow" aria-hidden="true"></i>
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<table width="100%" class=" table-bordered">
                                  <tbody>
                                    <tr>
                                      <th >Sellers</th>
                                      <th >Rating</th>
                                      <th >Delivered By</th>
                                      <th >Price</th>
                                      <th ></th>
                                    </tr>
                                    <?php
										foreach($other_seller_product->result() as $other_slr_product){ 
	  
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
											if($ct1 > 0){ ?>
											Delivered By : <?php echo $res->dispatch_days+4;?> - <?php echo $res->dispatch_days+5;?> Days 
											<?php  }else{  ?>
											 Delivered By : 10-12 Days 
											 <?php } ?> ,
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
                                  <td>
                                  	<?php
										if(@$this->session->userdata['session_data']['user_id']!=""){
								 		if($quantity==0){
									 ?>
                                     	<a href="#" class="not-active">View</a>
                                     <?php } else {  ?>
                                  		<a onClick="window.location.href='<?php echo base_url().'product_description/addtocart/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($other_slr_product->name))))).'/'.$other_slr_product->product_id.'/'.$other_slr_product->sku; ?>' ">View</a>
                                     <?php } } else if($quantity==0) { ?>
                                     	<a href="#" class="not-active">View</a>
                                     <?php }  else { ?>
                                     	<a onClick="window.location.href='<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($other_slr_product->name))))).'/'.$other_slr_product->product_id.'/'.$other_slr_product->sku;?>' ">View</a>
                                     <?php }?>
                                  </td>
                                  </tr>
                                  <?php }?>
                                  </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
                <?php }?>
			</div>
            <!----------------------------------Sold By Table Section End----------------------------------------------->
			<!-- //collapse -->  
              
                </div> 
			
			 
			<div class="clearfix"></div>
            
         </div>
         
         <div class="container-fluid">
         		<!------------------------------------Short Description Section Start-------------------------------------------->
                <h4 class="title2"> Short Description  </h4>
    			<p class="m_desc"><?php echo str_replace('\\', '', $recd1->description); ?></p>
               </div>
               <!------------------------------------Short Description Section Start-------------------------------------------->
               
         <div class="clearfix"></div>
         
            <!------------------------------------Specification Section Start------------------------------------------------>
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
                
                            <button class="first-accordion"><span class="menu-head"><?=$product_attr_heading_row->attribute_heading_name;?> </span></button>
                            <div class="panel">
                                <ul>
                                    <li>
                					<table class="table table-striped table-hover" width="100%">
                                    <?php
										$result = $query->result();
										foreach($result as $product_attr_row){
										?>
                                    
                                    <tr style="border-bottom:1px solid #ccc;">
                                         <td style="font-size: 13px; color: #333;" width="30%"> <?=$product_attr_row->attribute_field_name; ?> :  </td>
                                         <td style="font-size: 13px; color: #333;">
                                         	<?php
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
									 
									 ?>
                                         </td> </tr> 
                                         <?php } ?>
                                </table>
                                    
									</li>
                                    </ul>
                                </div>
                               <?php } } ?>
							<?php } ?>
					
			</div>
            </div>
            
            <!------------------------------------Specification Section End------------------------------------------------>
            <div class="backend-sec">
            <div class="clearfix"></div> 
            <!------------------------------------Backend Section Start------------------------------------------------>
            <?php
			if($sec_info!=false)
			{
			 if($sec_info->num_rows()>0)
				{ $cur_dtm=date('y-m-d h:i:s');
					foreach($sec_info->result_array() as $res_secdata)
					{		  
			?>
           <!---------------------------------------------------section 1st condition start------------------------------------------------->
        
        <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='600x259')
               {?> 
               <?php 
                   $sec_id=$res_secdata['Sec_id'];
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?>
                         <div class="left-sidebar"><h2><?=$res_secdata['sec_lbl']?></h2></div>
                         <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
                        
                         	<?php if($res_imgdata['sku']!=''){ ?>  
                                 <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"">
							<?php }?>
                            
                            <?php if($res_imgdata['URL']!=''){ ?>                                                     
                                <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"><?php }?>                            
                             <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>                                
                                 <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"><?php } ?>
                             
                            <?php } ?>
       
			<?php } } }?>        
        
        	<!---------------------------------------------------section 1st condition end------------------------------------------------>
            
            <!---------------------------------------------------section 2st condition start--------------------------------------------->
	<?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='53x52')
               {?>
               <div class="container" style="padding:0!important;">
                    <div class="col-md-12" style="padding:0!important;">
                        <div class="well" style="background-color: <?=$res_secdata['bg_color'];?>">
                            <div id="myCarousel" class="carousel slide">
                             <div class="carousel-inner">
               
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {
					   $image_track=array();
                       foreach($qr_clmn->result_array() as $res_clmn_four)
                       {
                           $clmn_sqlid1=$res_clmn_four['clmn_sqlid'];
						   
						    $qr_act_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC ");
                         $image_all_count=$qr_act_imginfo->num_rows(); 
                           
                           $qr_act_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 4 ");
                         $image_count=$qr_act_imginfo->num_rows();
						 
                  ?>                    
                                <!-- Carousel items -->
                                <div class="item active">
                                        <div class="row" style="margin: auto;">
                                            <?php
												foreach($qr_act_imginfo->result_array() as $res_imgdata_active){
                                        	?>
                                            <?php if($res_imgdata_active['sku']!=''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                                           <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata_active['img_sqlid'] ?>'"  alt="Image" class="img-responsive" />
                                           <?=stripslashes($res_imgdata_active['imag_label'])?>
                                            </a>
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if($res_imgdata_active['URL']!=''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                                             <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata_active['URL']; ?>'"  alt="Image" class="img-responsive"/>
                                           <?=stripslashes($res_imgdata_active['imag_label'])?>
                                            </a>
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if($res_imgdata_active['URL']=='' && $res_imgdata_active['sku']==''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                                            <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" alt="Image" class="img-responsive">
                                            <?=stripslashes($res_imgdata_active['imag_label'])?>
                                            </a>
                                            
                                            </div>
                                            <?php } ?>
                                            <?php }?>
                                        </div>                       
                    				</div>
                                    <?php } ?>
                                    <?php
										foreach($qr_clmn->result_array() as $res_clmn)
										   {
											   $clmn_sqlid=$res_clmn['clmn_sqlid']; 
											   
											   $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 4,$image_all_count  ");
											 $image_count=$qr_imginfo->num_rows();
											 $row=$qr_imginfo->result_array();
											 $img_count=$image_count/4;
											 $ceiled = ceil($img_count);
											 
											 
									  ?>
                                    <?php //for($i=1;$i<$ceiled;$i++) {
										 foreach(array_chunk($row,4) as $rw){
										?>
                                      
									<div class="item">
                                        <div class="row" style="margin: auto;">
                                        	<?php 
											
											foreach($rw as $res_imgdata){
                                                                    
                                        ?>
                                            <?php if($res_imgdata['sku']!=''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                                           <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'"  alt="Image" class="img-responsive" />
                                           <?=stripslashes($res_imgdata['imag_label'])?>
                                            </a>
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if($res_imgdata['URL']!=''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                                             <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"  alt="Image" class="img-responsive"/>
                                           <?=stripslashes($res_imgdata['imag_label'])?>
                                            </a>                            
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                                            <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" alt="Image" class="img-responsive">
                                            <?=stripslashes($res_imgdata['imag_label'])?>
                                            </a>
                                            
                                            </div>
                                            <?php } ?>
                                            
                                            <?php }?>
                                            
                                        </div>                       
                    				</div>
                                    
                                	<?php } //}?>
                                    
                               
										<?php  
                                                   } // column for loop end
                                                   
                                                }// column num_rows condition end
                                        ?>
            
             							<!--/carousel-inner--> </div>
                                <?php if($image_all_count>4){ ?>        
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                                <?php } ?>
                            </div>
                            <!--/myCarousel-->
                        </div>
                        <!--/well-->
                    </div>
                </div>		

			<?php  } // section 1st condition end ?>
	 <!---------------------------------------------------section 2st condition end--------------------------------------------->
            
            
			<!---------------------------------------------------section 2nd condition start---------------------------------------------->	
	
    	    	<?php /*?><?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='53x52')
               {?>
               
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
    
              		<div style="background:<?=$res_clmn['bg_color']?>; ">
                
                   <section class="regular slider" style="height:105px;">
                    
                    <?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){
								                        
                        ?>
                        <?php if($res_imgdata['sku']!=''){ ?>
                      <div>
                        <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
						 <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
						 <?=stripslashes($res_imgdata['imag_label'])?>
                         </p>
                         </div>
                            <?php } ?>
                        
                           <?php if($res_imgdata['URL']!=''){ ?>
                        <div>
                        <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"/>
                        <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
						<?=stripslashes($res_imgdata['imag_label'])?>
                        </p>
                        </div>
                            <?php } ?>
                        
                        <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                   	 <div>
                        <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
						<p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
						<?=stripslashes($res_imgdata['imag_label'])?>
                        </p>
                        </div>
                            <?php } ?>
                        
                        
                            <?php 
                                }
                            } ?>
    
  					</section>
                    
                  </div>
                  
             <?php  
					   }
					}
			 } ?><?php */?>
    	<!---------------------------------------------------section 2nd condition end--------------------------------------------->
        
        <!---------------------------------------------------section 3rd condition start------------------------------------------->
        
       <?php 
	    if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='770x394')
		 {
	   ?>
       		<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>
                  
                  
                  <div class="details-grid">
                                <div class="details-shade">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <?php $i_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>  
                                  <li data-target="#carousel-example-generic" data-slide-to="<?=$i_slide?>" <?php if($i_slide=='0'){ ?> class="active" <?php } ?> ></li>                                  
                                  <?php $i_slide++; } ?>
                                </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                             <?php $j_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?> 
                              
                             <?php if($res_imgdata['sku']!=''){ ?>
                              <div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
                                  <a href="#">
                                  <img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" /> 
                                  </a></div>
                             <?php } ?>
                              
                              <?php if($res_imgdata['URL']!=''){ ?>
                              <div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
                                  <a href="#">
                                  <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> </a>
                              </div>
                             <?php } ?>
                                
                             <?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?> 
                             <div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
                                  <a href="#">
                                  <img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
                                  </a>
                            </div>                                
                            <?php } ?> 
                             <?php $j_slide++; } ?>
                            </div> <!-- Wrapper for slides -->
                            </div>
                            </div>
			</div>
           <!--------slider start end ----->    
       
       
       <?php 
	   		 			} // column for loop end
				}// column num_rows condition end
	   }  // section 2nd condition end ?> 
        <!---------------------------------------------------section 3rd condition end----------------------------------------------->
        
        <!---------------------------------------------------section 4th condition start--------------------------------------------->
          	<?php if($res_secdata['sec_type']=='Video'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' )
               {   ?>
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
               	 <!-----------video------------->
      <div class="left-sidebar"> <h2><?=$res_secdata['sec_lbl']?></h2></div>
      <?php $url=str_replace('=','',strrchr($res_imgdata['URL'],"="));  ?>
<iframe style="padding:4px; margin-top:4px;" width="100%" height="200" src="https://www.youtube.com/embed/<?=$url?>" frameborder="0" allowfullscreen></iframe>
             <!------------video--------------->	
               			
               
               <?php  } // image for loop end ?>
          <?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		?>
          
 				         
          <?php } // section 6th end ?>
           <!---------------------------------------------------section 4th condition end------------------------------------------------->
           
           <!---------------------------------------------------section 5th condition start------------------------------------------------>
        	 <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && ($res_secdata['image_size']=='1000x244') )
               {?><div>
               	<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   $clmn_div=1;
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00'))  ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?> 
           
           <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
               
              
                <?php if($res_imgdata['sku']!=''){ ?>                                
                  <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'">
            	<?php } ?>
           
           <?php if($res_imgdata['URL']!=''){ ?> 
           <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;">
            <?php } ?>
            
            <?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?>  
             <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;">
            <?php } ?>
               
               
               <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
       </div>
           
        <?php } // section 12th condition end ?> 
        <!---------------------------------------------------section 5th condition end-------------------------------------------------->
        
        <!---------------------------------------------------section 6th condition start------------------------------------------------->
         <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='208x300')
               {?>
              <div style="background:<?=$res_clmn['bg_color']?>; height:254px">
               	<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   $clmn_div=1;
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?> 
           
           <?php 
		   $img_arr=array();
		   $img_arr_ctr=0;
		   foreach($qr_imginfo->result_array() as $res_imgdataarr){
			   $img_arr[]=$res_imgdataarr['imge_nm']; 
		   		
		   }
		   $img_arrnew=array();
		   foreach($img_arr as $ky_img=>$vl_img)
		   {
				if($ky_img+1==$img_arr_ctr || $ky_img==0)
				{$img_arrnew[]=$img_arr[$ky_img];}
			$img_arr_ctr++;	   
		   }		   
		   foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
           
           <?php if($res_imgdata['sku']!=''){ ?> 
                
               
                <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
				<?php if(in_array($res_imgdata['imge_nm'],$img_arrnew)) { echo "style='float:left; width:48.5%; margin-right:4px;'"; }else{echo "style='float:left; width:49%'";}?>  
                onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'">
           
            <?php } ?>
           
           <?php if($res_imgdata['URL']!=''){ ?> 
                  <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" 
                  src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
                  <?php if(in_array($res_imgdata['imge_nm'],$img_arrnew)) { echo "style='float:left; width:48.5%; margin-right:4px;'"; }else{echo "style='float:left; width:49%'";}?>  >
            <?php } ?>
            
            <?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?>  
               <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
               <?php if(in_array($res_imgdata['imge_nm'],$img_arrnew)) { echo "style='float:right; width:48.5%; margin-right:4px;'"; }else{echo "style='float:left; width:49%'";}?>  >
            <?php } ?>
               
            <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
       </div>
        <?php } // section 11th condition end ?>
        <!---------------------------------------------------section 6th condition end------------------------------------------------->
        
        <!---------------------------------------------------section 7th condition start------------------------------------------------->
           
           <?php if($res_secdata['sec_type']=='Grouped Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='600x259')
                   {?> 
                   <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                   $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
           			<div class="container" style="width:100%;padding:0!important;">
            <button class="first-accordion"><?=$res_secdata['sec_lbl']?></button>
            <div class="panel" style="height:200px; overflow-y:scroll!important;">
                 <ul>
                 <?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){
                        ?>
                    <li>
                        <div class="brands_products">
                            <div class="brands-name">
                                <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>">
                            </div>
                        </div>
                    </li>
                    <?php } }?>
                 </ul>
            </div>
            </div>
            <?php } } ?>
            
           <?php }?>
           <!---------------------------------------------------section 7th condition end------------------------------------------------->
           
           <!---------------------------------------------------section 8th condition start----------------------------------------------->
            
            	<?php if($res_secdata['sec_type']=='Product'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
               
                <div class="left-sidebar"><h2><?=$res_secdata['sec_lbl']?></h2></div>
 <div class="slider autoplay" style="width:100%; margin:auto;">
                    <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
                       	
						$prod_skuarr=unserialize($res_imgdata['sku']);
						$prod_skuarr_modf=array();
						foreach($prod_skuarr as $skuky=>$skuval)
						{$prod_skuarr_modf[]="'".$skuval."'";}
						
						 $prod_skustr=implode(',',$prod_skuarr_modf);
						
						
						$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
						if($query_prod->num_rows()>0)
						{
							foreach($query_prod->result_array() as $rw)
							{
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rw['special_pric_from_dt'];
								$special_price_to_dt = $rw['special_pric_to_dt'];								
								$dsply_img = $rw['catelog_img_url'];														
								//$quantity=$rw->quantity;
						?>
                                            
                    	<div class="multiple" style="border:1px solid #ccc;">
                   
                   			<?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                 ?>                               
                                <div class="price"> <i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw['special_price'])?> </div>
                                <?php }} ?>
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <div class="price"> <i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw['price'])?> </div>
                                <?php } ?>
                                
                                <div class="view view-fifth">    
                                  <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
                                  <img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"   class="wow flipInY grow"  alt="<?=$rw['name']?>">
                                  
                                  </a>
                                  </div>
                                
                                   <div class="wish-list"> 
                                   <a class="link-wishlist wish_spn" onClick="" href="#"  data-toggle="tooltip" title="Add To Wishlist"><i class="fa fa-heart"></i></a>
                                   </div>
                                
                                    <div class="best-slr-data">
                                   <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="wallet"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a> 
                                        <!-- price calculation div start here --><br>
                                        <div class="price-box">
                                        <?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                		 ?>                               
                                		<span class="regular-price" style="color:#CCC; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['mrp'];?> </span><br>
                                
                                        <span class="regular-price" style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['price'];?> </span><br>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $rw['special_price']==0){?>
                                        <span class="regular-price" style="color:#CCC; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $rw['special_price']==0){?>
                                         <span class="regular-price" > <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                        
                                        </div>
                                        <!-- price calculation div end here --></div>	
                   
                   		</div>
                    
                    
                    <?php			} // product data loop end
									} // product num_rows() condition end ?>
               		
               		
               			<?php  } // image for loop end ?>
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?>
                    
			</div>      <?php } // 7th section condition end ?>
            
             <!---------------------------------------------------section 8th condition end------------------------------------------------->
             
             <!---------------------------------------------------section 9th condition start------------------------------------------------->
             <?php if($res_secdata['sec_type']=='Prodcts Vertical section'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
         <div class="fandt">
		<div class=" features">
               <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];                            
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();					   
						?>
                        
                   <?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
				   ?>
				   <h3><?=$res_secdata['sec_lbl']?> <a href="<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>" class="btn btn-primary right"> More</a></h3>
				   	<?php 	$prod_skuarr=unserialize($res_imgdata['sku']);
						$prod_skuarr_modf=array();
						foreach($prod_skuarr as $skuky=>$skuval)
						{$prod_skuarr_modf[]="'".$skuval."'";}
						
						 $prod_skustr=implode(',',$prod_skuarr_modf);
						
						
						$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid LIMIT 3 ");
						if($query_prod->num_rows()>0)
						{
							foreach($query_prod->result_array() as $rw)
							{
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rw['special_pric_from_dt'];
								$special_price_to_dt = $rw['special_pric_to_dt'];								
								$dsply_img = $rw['catelog_img_url'];
				   
				   ?>                         
                                
                   <div class="support">
                    <div class="today-deal-left">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                    <img src="<?php echo base_url().'images/product_img/'.$dsply_img;?>" />
                    </a>
                    </div>
                  <div class="today-deal-right">
                  		<h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href='<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>'"><?=$rw['name']?></h4>
                        <p style="margin-left:0px;">
                        <?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;  font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $rw['special_price']==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $rw['special_price']==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                        
                        </p>
				  </div>
                    
                    <div class="clearfix"></div>
                </div>
               
               <?php }} ?>
               
                <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
        </div>
		

	</div> 
         <div style="clear:both;"></div>  
        <?php } // section 10th condition end ?>
             <!---------------------------------------------------section 9th condition end------------------------------------------------->
             
             <!---------------------------------------------------section 10th condition end------------------------------------------------->
             <div style="clear:both;"></div> 
              <?php if($res_secdata['sec_type']=='Featured Box'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='140x142')
               {   ?>
               	<div class="single-product">
           
           <div class="single-product1">
           <span class="fash_left"><h4><?=$res_secdata['sec_lbl']?></h4></span><!--<span class="fash_right" ><a href="#"><!--View More</a></span>-->
                		<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						   
						?>            
          
           <?php 
		   foreach($qr_imginfo->result_array() as $res_imgdata){ 
		   
		   $img_link="#";
		    if($res_imgdata['URL']!=''){
				$img_link=$res_imgdata['URL']; 
			}
			if($res_imgdata['sku']!='')
			{$img_link=base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ;}
		   ?>           
           <div class="inn-single">
         
           
            <div  class="pro-1"><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $img_link; ?>'"  /></div> 
           </div>
           <?php   } // image for loop end ?>
            	<div style="clear:both"></div>
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
                 
           </div>
           
            </div>
        <?php } // section 9 condition end ?>
             
             <!---------------------------------------------------section 10th condition end------------------------------------------------->
             
             <?php }}?>
            <!------------------------------------Backend Section End------------------------------------------------>
            <?php } // if $sec_info not false condition end ?> 
			</div>
            </div>
		</div>
  </div>
  <div class="clearfix"></div> 
  

</div>
<div class="foot-no">
<footer class="site-footer">
<div class="container-fluid">
<?php 
 $qr=$this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='4' AND page_name='single product' AND Status='active' AND sec_type='Rich Text Editor' ");
		 
if($qr->num_rows()>0)
{ 
	foreach($qr->result_array() as $res_secdata)
	{		  
?>
    
<strong><b><?=$res_secdata['sec_lbl']?> :</b></strong>
</br>
<p style="text-align:justify;"><?=$res_secdata['sec_descrp']?></p>

<?php }} ?>
</div>


	<div class="clearfix"> </div>
	<?php include 'footer_single_product.php';?>
    </div>
      <style>.carousel-control {
  padding-top:6%;
  width:5%;
}
.thumbnail {
    display: inline-block!important;
    padding: 4px;
    margin-bottom: 4px;
    line-height:1;
    
    border: none;
    border-radius: 4px;
    -webkit-transition: border .2s ease-in-out;
    -o-transition: border .2s ease-in-out;
    transition: border .2s ease-in-out;
    float: left;
    width: 25%!important;
	    color: #000 !important;
    font-weight: normal;
	font-size:12px;
	text-align:center;
}
.carousel-control.right {
    background-image: none!important;
}
.carousel-control.left {
    background-image: none!important;
}
.well {
    padding: 0px!important;
    margin-bottom:0px!important;
	
}
</style>  
  <script>
    $(document).ready(function() {
        $('#myCarousel').carousel({
        interval: 10000
        })
        
        $('#myCarousel').on('slid.bs.carousel', function() {
            //alert("slid");
        });
        
        
    });
    
    </script>
    
    <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.flexslider.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/flexslider.css">
    <script>
    // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
             });
        });
    </script>
	<!-- //FlexSlider-->

<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>

 <script>
    var acc = document.getElementsByClassName("first-accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
      acc[i].onclick = function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "100px";
        } 
      }
    }
    </script>
    