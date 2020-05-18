
<?php 
	include "header.php";
?>
		
	<link rel="stylesheet" href="<?php echo base_url();?>colorbox/colorbox.css" />
	<script src="<?php echo base_url();?>new_js/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>colorbox/jquery.colorbox.js"  ></script>
     
	<script>
		$(document).ready(function(){
			$(".inline").colorbox({inline:true, width:"25%", height:"447px"});
			$(".inline2").colorbox({inline:true, width:"35%"});
		});
	</script>
    <script>
function ShowMoreData(result_no,cat_id,lastseg){
	var numItems = parseInt($('.grid1_of_4').length);
	var result_no = parseInt(result_no);
	//alert(result_no);
	//alert(numItems);
	
	$.ajax({
		url:'<?php echo base_url(); ?>user/show_more_catalog_data',
		method:'get',
		data:{from:numItems,cat_id:cat_id,lastseg:lastseg},
		beforeSend: function(){
			$('.view_mor').hide();
			$('#lodr_img').show();
		},
		complete: function(){
			$('#lodr_img').hide();
			//$('.view_mor').show();
		},
		success:function(result){
			//alert(result);
			$('.grids_of_4').append(result);
			$('#scrol_tracktxtbox').val('wait to scroll');
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
}

function sortby_price(sortbyprice,catgnm,cat_id,lastseg)
{
	window.onload = $('#limg').css('display','block');
	
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>filterby/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+'sortbyprice='+sortbyprice;
	}else{
		window.location.href='<?php echo base_url();?>filterby/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&sortbyprice='+sortbyprice;
	}	
}
</script>
	<style>
		 /* carousel */
		.media-carousel 
		{
		  margin-bottom: 0;
		  padding: 0 40px 0px 40px;
		}
		/* Previous button  */
		.media-carousel .carousel-control.left 
		{
		  
		  background-image: none;
			background: none;
			border: 4px solid #FFFFFF;
			border-radius: 23px 23px 23px 23px;
			height: 35px;
			width: 35px;
			margin-top: 8px;
			color: #000;
			padding-top: 0;
			font-size: 31px;
			line-height: 23px;
			text-shadow: none;
		  
		}
		/* Next button  */
		.media-carousel .carousel-control.right 
		{
		  
		  background-image: none;
			background: none;
			border: 4px solid #FFFFFF;
			border-radius: 23px 23px 23px 23px;
			height: 35px;
			width: 35px;
			margin-top: 8px;
			color: #000;
			padding-top: 0;
			font-size: 31px;
			line-height: 23px;
			text-shadow: none;
		}
		/* Changes the position of the indicators */
		.media-carousel .carousel-indicators 
		{
		  right: 50%;
		  top: auto;
		  bottom: 0px;
		  margin-right: -19px;
		}
		/* Changes the colour of the indicators */
		.media-carousel .carousel-indicators li 
		{
		  background: #c0c0c0;
		}
		.media-carousel .carousel-indicators .active 
		{
		  background: #333333;
		}

		.thumbnail{ margin-bottom:0;}

		.title:after, .title:before {
			display: inline-block;
			height: 3px;
			content: " ";
			text-shadow: none;
			background-color: #ed2541;
			width: 290px;
		}
		.form-control {
			padding: 6px 2px;
		}
		/*.content_box{ border:1px solid #f2f2f2;}*/
		.content_box h6 {
			color: #fff;
			z-index: 1;
			position: absolute;
			top: -5px;
			left: 2%;
			font-size: .8em;
		}

		.discount-off:before {
			content: '';
			width: 0;
			height: 0;
			border-top: 60px solid #0280e1;
			border-right: 60px solid transparent;
			position: absolute;
			top: 0;
			left: 0;
			-webkit-transition: .5s all;
			-moz-transition: .5s all;
			-o-transition: .5s all;
			-ms-transition: .5s all;
			transition: .5s all;
		}
		.content_box h5{
			margin:0;
			text-align:center; margin-left:0; font-family: Calibri,Arial,Helvetica,sans-serif; line-height: 16px;
		}
		.content_box h5 a {
			 color: #0280e1;
			 font-weight: normal;
			font-size: 14px;
			margin:0;
			font-family: Calibri,Arial,Helvetica,sans-serif;
		}
		.price-through{
			margin-bottom:10px;
		}
		.price-recent{
			display: inline-block;font-size: 16px;font-weight: 500; color: #212121;
		}
		.original-price{
			text-decoration: line-through; display: inline-block; margin-left: 8px;font-size: 14px; color: #878787;
		}
		.off-price{
			display: inline-block;
			margin-left: 8px;
			color: #388e3c;
			font-size: 13px;
			letter-spacing: -0.2px;
			font-weight: 500;
		}
		.out-of-stock{
			width: 100%;
			font-size: 16px;
			margin: 0 auto;
			border-radius: 2px;
			background-color: #fff;
			box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .12);
			text-align: center;
			padding: 10px 15px;
			text-transform: uppercase;
			pointer-events: none;
			position: absolute;
			left: 50%;
			-webkit-transform: translateX(-50%);
			transform: translateX(-50%);
			top:50%;
		}
		.out-of-stock span{color: #ff6161; line-height:1;}
		.row1 {
			height: 110px;
		}
		.jspPane {
			padding: 3px!important; 
		}
		.btn-go {
			background-color: #6bb700;
			color: #fff;
			font-size: 13px;
			padding: 4px 10px;
			float: none;
			border: 0;
			margin: 10px 0px;
			text-align: center;
		}
		.rst_spn {
			cursor: pointer;
			display: inline-block;
			font-size: 12px;
			background-color: #ececec;
			box-shadow: 0 2px 4px 0 rgba(255, 255, 255, .5);
			border-radius: 3px;
			margin: 2px 4px;
			overflow: hidden;
			transition: background-color 0.1s;
			max-width: 200px;
			padding: 8px;
			
		}
		.rst_spn:hover{ text-decoration:line-through;}

		.filter-form h4 {
			margin-top: 10px;
			padding: 12px;
			color: #333;
			/* border-bottom: 1px solid #f0f0f0; */
			margin-bottom: 0;
			font-weight: bold;
			font-size: 12px;
			text-transform: uppercase;
			letter-spacing: 0.3px;
			font-family: Roboto, Arial, sans-serif;
		}
		.f_sidebar {
			border: none;
			margin-bottom: 20px;
		}
		.KG9X1F ._2Wy-am {
			font-weight: bold;
			font-size: 16px;
			margin-top: 8px;
			display: inline-block;
			font-family: Roboto, Arial, sans-serif;
			letter-spacing: 0;
		}
		.dropdown_left {
			float: left;
			width: 100%;
		}
		.C5rIv_ {
			display: inline-block;
			margin-left: 10px;
			color: #878787;
			font-size: 12px;
			font-family: Roboto, Arial, sans-serif;
			letter-spacing: 0;
		}
		.catlg {
			height: auto !important;
		}
		.grid1_of_4:hover{box-shadow: 0 3px 16px 0 rgba(0, 0, 0, .11);
		}
		/* End carousel */
		div#more-brand{
		position: absolute;
		color: black;
		display: none;
		display: block;
		height: 245px;
		width: 868px;
		border: 1px solid #CCC;
		z-index: 999;
		margin: -86px 24px 20px -88px;
		background: #fff;
		overflow-x: scroll;
		white-space: nowrap;
		border-radius: 2px;
		display: flex;
		flex-wrap: wrap;
		flex-direction: column;
		}
		#more-close {
			float:right;
			display:inline-block;
			padding:2px 5px;
		 
		}
		.alfa{
			letter-spacing: 2px;
			font-size: 12px;
			padding: 6px;
			color: #888;
		}
		.padd{
				padding: 6px;
		}
		.column-more{
			float: left;
			width: 100%;
			height: 176px;
			white-space: nowrap;
			display: flex;
			flex-wrap: wrap;
			flex-direction: column;
		}
		.column-more2{
			float: left;
			height: 176px;
			width: 125px;
			white-space: nowrap;
			display: flex;
			flex-wrap: wrap;
			flex-direction: column;
		}
		.column-more label.checkbox{ width:125px;}
	</style> 

	<script language="JavaScript">
		function setVisibility(id, visibility) {
			document.getElementById(id).style.display = visibility;
		}
	</script>
	<script>
		function scrollWin(x, y) {
			window.scrollBy(x, y);
		}
	</script>

<?php //echo '<pre>';print_r($product_data);exit; ?>
<div style="clear:both;"></div> 
<!----------------------------------------Body Section start------------------------------------------------------> 
<div class="container" style="width: 100%; margin-top: 58px; padding: 0; background:#f3f3f3; padding:5px;">
<div class="row" style="margin-top:10px;">

   <!--------------------------------- Start of Filter bar------------------------------------------------------------------------------------------>
	
   
   <!--------------------------------- End of Filter bar------------------------------------------------------------------------------------------>
    <div class="col-md-9" style="width:100%; background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); float:right;">
    		<div style="width:1000%;">
            	<a href="<?php echo base_url();?>" style="color:#878787; font-size:12px;">Home > </a>
                <a href="<?php echo base_url().'/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>" style="color:#878787; font-size:12px;">Offers > </a>
                <a href="<?php echo base_url().'/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>" style="color:#878787; font-size:12px;"><?php echo ucwords(str_replace('-', ' ', $this->uri->segment(2)));?> </a>
            </div>
            
            
            <div style="clear:both;"></div>
            
            <!--<div style="width:70%; float:left;">
            	<div class="KG9X1F">
            <h2 class="_2Wy-am"><?php echo ucwords(str_replace('-', ' ', $this->uri->segment(2)));?></h2>
            <div class="C5rIv_">
            <span>(Showing 1 – <samp id="totalcontent">50</samp> products of 1000 products)</span>
            </div>
            </div>
            </div>-->
            
            <!--<div style="width:30%; float:right; text-align:right;">
            	<div class="dropdown_left">
			       
                  <div class="ac" align="right" style="margin-right:19px; margin-bottom:10px;">
			<a class="button" data-rel="#content-a" id="act1" href="#" onclick="menuvisibility('menu2');">
				<i class="fa fa-th-large" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<a class="button" data-rel="#content-a" id="act2" href="#" onclick="menuvisibility('menu1');">
				<i class="fa fa-list" aria-hidden="true"></i></a>
            
            <a href="#" id="myBtn"><i class="fa fa-sort-amount-desc ali"  aria-hidden="true"></i> <span class="sp">Sort</span></a>  
            
		</div>
				</div>
            </div>-->
            
<div id="menu2">          
<div class="w_content">
		<div class="catlog">
		     <div class="clearfix"> </div>
		</div>
         <!-- grids_of_4 -->
		<div class="grids_of_4" id="catlog_dv">
       
        <?php if($product_data != false){
					$row=$product_data->num_rows();
					$sl=0;
					//print_r($row);exit;
					if($row>0){
					foreach($product_data->result_array() as $rw ) { $sl++;
						$cdate = date('Y-m-d');
						//echo '<pre>';print_r($rw);exit;
						$special_price_from_dt = $rw['special_pric_from_dt'];
						$special_price_to_dt = $rw['special_pric_to_dt'];
						
						$dsply_img = $rw['catelog_img_url'];
						$image_arr=explode(',',$rw['catelog_img_url']);
						$quantity=$rw['quantity'];			
				?>
        <div class="grid1_of_4 catlg products-row">
        <div class="content_box <?php 
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
                            <?php if($percen_off>0){ echo 'discount-off'; ?><?php } ?>"> 
        <?php 
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
                            <?php if($percen_off>0){ ?>
                
                    <h6><?=$percen_off?>% <br>OFF</h6>
                    <?php } ?>
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                     <?php  if(empty($dsply_img)){?>
                        <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="">
                        <?php }else { ?>
                        <img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" class="img-responsive" data-wow-delay="1s" alt="<?=$rw['name'];?>">
                        <?php } ?>
                     </a>
                 </div>
                  <div class="wish-list">
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                        <?php if(strlen($rw['name']) > 30){ echo substr($rw['name'],0,30).'...';}else{ echo $rw['name'];}?> 
                        </a>
                    </h5> 
                    <div class="price-through">
                    <!-----------------------------------Product price start---------------------------->
                        <!--<div class="original-price">₹999</div>-->
                        <!--<div class="original-price" style="color:#c5aa21;">₹777</div>-->
                        <!--<div class="price-recent" style="color:#6bb700;">₹539</div>-->
                        <?php
						   if($rw['special_price'] !=0){
							   if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
								   $cur_splprc=$rw['special_price'];
						?>
                        <div class="original-price"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;<?=$rw['mrp'];?></div>
                        <div class="original-price" style="color:#c5aa21;"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?></div>
                        <div style="color:#6bb700;" class="price-recent"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?></div>
                        <?php }} ?>
                        <?php if($rw['price'] != 0 && $cur_splprc==0){?>
                        <div class="original-price"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?></div>
                         <?php } ?>
                         <?php if($rw['price'] == 0 && $cur_splprc==0){?>
                         <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?></div>
                         
                         <?php } ?>
                                         &nbsp;&nbsp;

                         <?php
                           if($rw['special_price'] ==0 && $rw['price']>0){
                         ?>    
                          <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?></div>
                          <?php } ?>               
                    <!-----------------------------------Product Price End----------------------------->    
                    </div>
                    <?php if($rw['quantity'] ==0){?>
                    <div class="out-of-stock"><span>Out Of Stock</span></div>
                    <?php }?>
        		</div>
             </div>
        </div>
        
        <?php }}}?>
       
</div>
<!-- end grids_of_4 -->

           <div class="clearfix"></div>
           <div id="view_more_dv" align="center" >
           		<img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none; height:80px; width:80px;" >
                <?php $catgstr_urlpass=$this->uri->segment(3); 
				if($no_of_product > $sl){?>
                <input style="display:none;" type="button" class="add-to-cart view_mor" id="viewmore_prodbtnid"  value="View more" name="button" onClick="ShowMoreData('<?=$no_of_product;?>','<?=$catgstr_urlpass?>','<?php if($this->uri->segment(2) != ''){ echo $this->uri->segment(2);}else{ echo 'NOT';}?>')">
		<input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
        <?php }	?>
                				<!--<input type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">-->
		</div>
          
</div>
</div>
    </div>
</div>


  
</div>
<div class="above-footer">
<!--<div style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;margin:20px!important; padding:10px;">
           <p style="margin-right:10px !important; ">
           		</p><p>How to <strong>Buy Best Smartphones Online</strong>? While purchasing mobiles online, you will need to keep a few things in mind. Such as: Type of handset The first thing you will need to decide on is which type of cellular device you wish to buy. If it's a featured model, then it will be designed with a small screen and a keypad that will have numbers, call and answer buttons. But if it's a smartphone, then it comes with a big display that uses touchscreen technology to operate the device. Which OS The popular cell phones available online come equipped with operating systems like Android, Windows, iOS and Blackberry OS. So read about them online and check out videos to know which operating system suits you better. Feature Sets Every person has his own requirement and hence, would like to have specific features that he will need more often. These can be high resolution front and back camera, Bluetooth, music player, radio, dual SIM and such. You also need to look for its hardware. For example, If&nbsp;It's <strong>Android Phone</strong> Or <strong>Windows Phone</strong> if it's dual core or quad core, if it supports 3G and 4G network, its screen size, RAM and the available storage space. Brands The top brands offering highly-advanced cell phones today in the market are Motorola, LeEco, Sony, Samsung, HTC, Apple, MI Redmi, Gionee, Vivo, Oppo, Lenovo, Nokia, Microsoft, Asus and OnePlus. What ever might be your budget, you can definitely find a handset that suits your pocket and meets your needs. What Else Should you Check? Apart from checking the availability of these features, you should also read the reviews from various experts to know more about the models. These reviews will give you practical insights about the performance of a mobile phone and also a first-hand experience which will help you make better decisions. So do your research and have fun buying your desired mobile phones online.</p>
           <p></p></div>
<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h2 style="float:left; margin-left:15px;">Top Brands</h2>
        </div>-->
        <!--<div style="width:98%; margin:auto; padding:10px;">
        	<div id="jssor_6" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;visibility:hidden; border:1px solid #ccc;">-->
        <!--Loading Screen -->
        <!--<div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;">
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/android.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/bitly.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/blogger.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/dnn.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/drupal.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/facebook.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/google.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/ibm.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/ios.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/joomla.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/linkedin.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/mac.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/pinterest.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/samsung.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/twitter.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/windows.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/wordpress.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/youtube.jpg" />
            </div>
            <a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
        </div>-->
    </div>
    <script type="text/javascript">jssor_6_slider_init();</script> 
        </div>
		<!--<div class="container-fluid">
      <div class="row" style="width:100%; padding:0; margin:auto;">
            <div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h2 style="float:left; margin-left:15px;">Know Moonboy a little more</h2>
        </div>
      </div>
      <div class="col-lg-12" style="background:#f5f5f5; padding:10px;">
      <h5><strong>Term & Condition</strong></h5>
		<p>est Please allow at least 10-12 business days for your order to arrive after payment has been confirmed.</p> 
        <h5><strong>Shipping & Delivery</strong></h5>
		<p>Test Please allow at least 10-12 business days for your order to arrive after payment has been confirmed. If the product ordered is out of stocks, we will contact you immediately to confirm a new delivery date or other arrangements. Shipping through Reputed Couriers – Fedex/ DHL (Blue Dart)/ &nbsp;Professional/ DTDC / First Flight /Speed Post.</p> 
        <h5><strong>Payment terms</strong></h5>
		<p>est Please allow at least 10-12 business days for your order to arrive after payment has been confirmed.</p>      
      </div>
  </div>-->
<?php 
	include "footer.php";
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.js"></script>
<script>
var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop)
   {
		 if($('#view_more_dv').visible(true) && $('#scrol_tracktxtbox').val()!='')
		 {
			$('#viewmore_prodbtnid')[0].click();
			$('#scrol_tracktxtbox').val('');
		}
   } else {
      // upscroll code
   }
   lastScrollTop = st;
   
});
</script>