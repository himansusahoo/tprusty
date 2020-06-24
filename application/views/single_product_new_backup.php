<!DOCTYPE html>
<html lang="en">
<head>
<?php
	include "header.php" ;$this->db->cache_on();
	?>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
	<meta name="Description" content="<?php echo @$data->meta_desc ;?>">
	<meta name="Keywords" content="<?php echo @$data->meta_keywords ;?>" />
	<link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>"/>
	<title>
		<?php
			if($page_title->meta_title!='')
		 	{
				echo @$page_title->meta_title ;
     		}else
            {
				$curpricequery=$this->db->query("SELECT name, current_price,lvl2,lvl1 FROM cornjob_productsearch WHERE sku='$data_sku' ");
				$rw_curprice=$curpricequery->row();
				echo "Buy Online ".$rw_curprice->name.'@Rs.'.number_format($rw_curprice->current_price, 0, ".", ",");
           	}
		?>
	</title>
<script src="<?php echo base_url();?>new_js/js/jquery.js"  ></script>
<link rel="stylesheet" href="<?php echo base_url();?>colorbox/colorbox.css" />
    
		<script src="<?php echo base_url();?>colorbox/jquery.colorbox.js"  ></script>
	<script>
		$(document).ready(function(){
			$(".inline").colorbox({inline:true, width:"25%", height:"447px"});
			$(".inline2").colorbox({inline:true, width:"35%"});
		});
	</script>
 <style>
 .single_grid {
    margin-top: 94px;
}
.simpleLens-container {
     padding-top:0;
}
.simpleLens-thumbnails-container a {
    width: 70px;
	margin:0;
    
}
.simpleLens-container{
    display: table;
    position: relative;
}

.simpleLens-big-image-container {
    display: table-cell;
    text-align: center;
	position:relative;
    height: 300px;
    width: 350px;
}

.simpleLens-big-image {
    max-width: 100%;
	
}

.simpleLens-lens-image {
    height: auto !important;
    width: 350px;
    display: inline-block;
    text-align: center;
    margin:0;
    box-shadow:none;
    float:none;
    position:relative;
}
.item img {
    width: 100%;
    height: 185px;
}
.simpleLens-mouse-cursor{
	background-color:#CCC;
	opacity:0.2;
	filter: alpha(opacity = 20);
	position:absolute;
	top:0;
	left:0;
	border:1px solid #999;
	box-shadow:0 0 2px 2px #999;
	cursor:none;
	/*height: 94.0625px !important;
    width: 171.913px !important;*/
}

.simpleLens-lens-element {
    background-color: #FFFFFF;
    box-shadow: 0 0 2px 2px #8E8E8E;
    height: 500px;
    left: 105%;
    overflow: hidden;
    position: absolute;
    top: 0;
    width: 800px;
    z-index: 9999;
    text-align: center;
}

.simpleLens-lens-element img{
    position:relative;
    top:50px;
    left:0;
    width:auto !important;
    max-width:none !important;
}
.discount {
    border: 1px solid #ed2541;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    float: left;
    padding: 5px;
    text-align: center;
	font-weight:bold;
}
.price3{
	font-size: 14px;
    font-weight: bold;
	color:#000;
}
.price2{
	font-size: 14px;
    font-weight: bold;
}
.single-prod-detail{
	height:100px;
	overflow-y:scroll;
	margin:10px 0;
	border:1px solid #FFAEC9;
}
/*check box coloring*/
.color-checkbox-ul{
	
	margin-top:10px;
	min-height:80px;
	max-height:120px;
	}
.color-checkbox-ul input[type=checkbox] {
display:none;
}
 
.color-checkbox-ul label {
    margin-left: 0px !important;
	cursor: pointer;
}
.color-checkbox-ul-list{float:left; margin-right:2px!important;}
.color-checkbox-ul input[type=checkbox] + label:after
{
	height:30px;
	width:30px;
}
.color-checkbox-ul input[type=checkbox]:checked + label:after
{
    content: '\2713';
    /* height: 30px; */
    /* width: 30px; */
    text-align: center;
    position: absolute;
    margin-top: 4px;
    color: #fff;
    font-size: 20px;

}
.single-product-size{
	display: inline-block;
    float: left;
    margin-top: 3px;
    width: 8.8%;
}
.single-product-size-ul{
	float:left; width:90%;
}
.single-product-size-ul-li{
	border: 2px solid #090;
    float: left;
    margin-right: 10px;
    padding: 5px 10px;
}
.single-product-size-ul-li a{
	color:#000;
	text-align:center;
	font-size:16px;
}
.desc1 {
    display: block;
    float: left;
    width: 100%;
}
.price_single{
	border-top:1px solid #e7e7e7;
	border-bottom:none;
	margin:10px 0px 0px;
	padding:10px 0;
}
.by-btn-big{
    background-color: #fb8928;
    margin-left: 15px;
}
.add-to-cart {
    padding: 10px 54px;
}
.social-ul-li {
    /* border: 2px solid #090; */
    float: left;
    margin-right: 10px;
    /* padding: 5px 10px; */
}
.right-button-helder{
	width:80%; 
	margin:15px auto auto;
	text-align: center;
}
.right-button-ul{
	width:65%; 
	margin:10px auto;
}
.right-button-first-p{
	font-size: 14px;  
	font-weight: bold;  
	width: 88%; 
	margin: 15px auto auto;	
}
.return-refund-held{
	font-size: 14px;  
	font-weight: bold;  
	width: 88%; 
	margin: 25px auto auto; 
	height: 40px;
}
.return-refunt-strong{
	font-size:18px; 
	font-weight:bold; 
	margin:10px 20px auto auto; 
	float:left;
}
.refund-guaranty-back{
	float:left; background:#eef9ff; padding:5px;
}
.refunt-guaranty-strong{
	font-size:20px; font-weight:bold;
}
.check-availablity{
	float:left; width:70%; margin-top: -25px;
}
.left-long-text{
	font-size: 16px;
    font-weight: bold;
    width: 100%;
    padding: 31px 20px 45px;
    border-bottom: 3px solid;
}
h3.tittle:before {
    content: "";
    width: 20%;
    background: #FCB314;
    height: 2px;
    position: absolute;
    left: 10px;
    top: 12px;
}
h3.tittle:after {
    content: "";
    width: 20%;
    background: #FCB314;
    height: 2px;
    position: absolute;
    right: 10px;
    top: 12px;
}
h3.tittle, h3.tittle.two {
    font-size: 1em;
    position: relative;
    text-align: center;
    margin-bottom: 1em;
    font-weight: 600;
}
.xyz{
    display: block;
    margin-left: 0;
    color: #111;
    float: left;
    margin-right: 25px;
    line-height: 116px;
    vertical-align: middle;
    margin-top: 14px!important;
}

.a-ordered-list.a-horizontal:before, .a-unordered-list.a-horizontal:before, ol.a-horizontal:before, ul.a-horizontal:before{ display: table;
    content: "";
    line-height: 0;
    font-size: 0;
}
.a-align-center {
    vertical-align: middle!important;
	float: left;
    margin: 10px;
}
.a-list-item {
    color: #111;
}
.a-section:last-child {
    margin-bottom: 0;
}
.a-section {
    margin-bottom: 22px;
	width:150px;
	height:150px;
}
.a-section img{
	width:150px;
	height:auto;
	max-height:180px;
}
.sims-fbt-image {
    vertical-align: middle;
}

.a-size-large {
    font-size: 21px!important;
    line-height: 6.3!important;
	text-rendering: optimizeLegibility;
}
.a-color-tertiary {
    color: #767676!important;
}
.sims-fbt-price-box {
    padding-right: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
}
.media-carousel 
{
  margin-bottom: 0;
  padding: 0 40px 0px 40px;
}
/* Previous button  */
.media-carousel .carousel-control.left 
{
  
    background-image: none;
    background: #eeeff2;
    border: 2px solid #ccc;
    /* border-radius: 50%; */
    height: 30px;
    width: 30px;
    margin-top: 76px;
    color: #333;
    padding-top: 0;
    font-size: 31px;
    line-height: 21px;
    text-shadow: none;
  
}
/* Next button  */
.media-carousel .carousel-control.right 
{
  
          background-image: none;
    background: #eeeff2;
    border: 2px solid #ccc;
    /* border-radius: 50%; */
    height: 30px;
    width: 30px;
    margin-top: 76px;
    color: #333;
    padding-top: 0;
    font-size: 31px;
    line-height: 21px;
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


.multiple-sl{ margin-bottom:0; border:none;}
 </style>
 
 <?php 
		$this->db->cache_on();
        
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

 <link href="<?php echo base_url();?>new_css/css/single-prod-accordian.css" rel="stylesheet"> 
<!--------------for multiple tickkering------------------------->

<script>
function selesct_prodas_size(prod_nm,prod_id,prod_sku)
{
	//window.location.href="<?php //echo base_url().'product_description/product_detail/';?>" + prod_nm + '/' + prod_id + '/' + prod_sku;
	
	window.location.href="<?php echo base_url()?>" + prod_nm + '/' + prod_id + '/' + prod_sku;	
}

</script>
<script>
function logintobuynow(l,s,p)
{
	//alert(s);
	document.getElementById("ltbn_id").checked = true;
	var lbn_prod_name=l;
	var lbn_product_id=s;
	var lbn_sku_id=p;
	if(document.getElementById("ltbn_id").checked)
		  {
		  	logintobuysku= document.getElementById("ltbn_id").value;
		  //alert(logintobuysku);
		  }
	
	$.ajax({
			url:'<?php echo base_url(); ?>Product_description/logintobuynowaddtocart_temp',
			method:'post',
			data:{lbn_prod_name:lbn_prod_name,lbn_product_id:lbn_product_id,lbn_sku_id:lbn_sku_id,ltbn_id:logintobuysku},
			success:function(data)
			{
				
				
			}
		  })
}

</script>
 
</head>
<body>
     
<div style="clear:both;"></div>
<!----------------------------------------Body Section start------------------------------------------------------> 




<div class="container" style="width: 100%; padding:5px; margin-top:60px;">
	<div class="row" style="background:#fff;">
		<?php $rec=explode(',',$product_data->imag);  ?>
		<?php 
			$query=$this->db->query("select * from product_general_info where product_id='$product_data->product_id'");
			$recd1=$query->row();
		?>
        <?php
			$curpricequery=$this->db->query("SELECT lvl2,lvl1 FROM cornjob_productsearch WHERE sku='$data_sku' GROUP BY sku ");
			$bredcum_sku=$this->uri->segment(3);
			$lvl2_bredcum=$rw_curprice=$curpricequery->row()->lvl2;
			$lvl1_bredcum=$rw_curprice=$curpricequery->row()->lvl1;
		
			$bredsrch_string=$lvl2_bredcum.','.$lvl1_bredcum;
			$bredcumarr=array();
			$secondlvl_bredcummenu='';
			$thirddlvl_bredcummenu='';
		
			$qr_bredcum=$this->db->query("SELECT * FROM category_menu_desktop WHERE ((category_id LIKE '%,$lvl2_bredcum,%' OR category_id LIKE '$lvl2_bredcum,%' OR category_id LIKE '%,$lvl2_bredcum' OR category_id='$lvl2_bredcum')) ");
		 
			foreach($qr_bredcum->result_array() as $res_bredcum)
				{
					$array_ctgsrch=explode(',',$res_bredcum['category_id']);
					if(in_array($lvl2_bredcum,$array_ctgsrch))
						{	
							$thirddlvl_bredcummenu=$res_bredcum['url_displayname'];
							$thirddlvl_bredcummenudisplay=$res_bredcum['label_name'];
				
							$parent_2ndllvlmenu=$res_bredcum['parent_id'];				
						}		
					 
				}
			$qr_scndlvlbredcum=$this->db->query("SELECT * FROM category_menu_desktop WHERE dskmenu_lbl_id='$parent_2ndllvlmenu' ");
			$secondlvl_bredcummenu=$qr_scndlvlbredcum->row()->url_displayname;
			$secondlvl_bredcummenudisplay=$qr_scndlvlbredcum->row()->label_name;
		?> 
		<div class="col-md-9">
        	<ul class="breadcrumb">
			<li><a href="<?php echo base_url() ?>">Home</a></li>
			<li><a href="<?php  echo base_url().'category/'.$secondlvl_bredcummenu ?>"><?=$secondlvl_bredcummenudisplay?></a></li>
			<li><a href="<?php echo base_url().$thirddlvl_bredcummenu ?>"><?=$thirddlvl_bredcummenudisplay?></a></li>
            <li class="active"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>"><?php echo $recd1->name; ?> </a></li>
		</ul>
        </div>
        <div class="col-md-3">
                <p style="padding: 24px 5px; font-size: 18px; color: #999;"><i class="fa fa-exchange"></i> 100% Replacement Guarantee.</p>
                 
        </div>
    </div>
    
    <div class="row" style="background:#fff;">
        <div class="col-md-5">
			<div class="simpleLens-gallery-container" id="demo-1">
				<div class="row">
					<div class="col-lg-3">
						<div class="simpleLens-thumbnails-container">
							<?php $rec=explode(',',$product_data->imag);  foreach($rec as $val){ ?>
							<a href="#" class="simpleLens-thumbnail-wrapper"
							   data-lens-image="<?php echo base_url().'images/product_img/original_'.$val;?>  "
							   data-big-image="<?php echo base_url().'images/product_img/'.$val;?>">
								<img src="<?php echo base_url().'images/product_img/thumbnil_'.$val; ?>" alt="<?php echo $recd1->name;?>">
							</a>
							<?php } ?>
						</div>
						
					</div>
					<div class="col-lg-9">
						<div class="simpleLens-container">
							<div class="simpleLens-big-image-container">
								<a class="simpleLens-lens-image" data-lens-image="<?php echo base_url().'images/product_img/'.$rec[0]; ?>">
									<img  src="<?php echo base_url().'images/product_img/original_'.$rec[0]; ?>" alt=" <?php echo $recd1->name; ?>" class="simpleLens-big-image">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        
        <div class="col-md-7" >
        	<div class="desc1">
					<h1 class="single_prdct_title"><?php echo $recd1->name; ?> </h1>
                    <div class="row">
                    	<div class="col-lg-8">
                        	<div class="rate_review">
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
									<div class="stars">
                                    <select id="backing4c" name="product_rating" disabled="" style="display: none;">
                                        <option value="1" <?php if($average_rating == 1){ echo 'selected' ;} ?>>Bad</option>
                                        <option value="2" <?php if($average_rating == 2){ echo 'selected' ;} ?>>OK</option>
                                        <option value="3" <?php if($average_rating == 3){ echo 'selected' ;} ?>>Great</option>
                                        <option value="4" <?php if($average_rating == 4){ echo 'selected' ;} ?>>Excellent</option>
                                        <option value="5" <?php if($average_rating == 5){ echo 'selected' ;} ?>>Excellent1</option>
                                    </select>
                                    <div class="rateit" data-rateit-backingfld="#backing4c" data-rateit-min="0">
                                        <button id="rateit-reset-2" type="button" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-2" style="display: none;"></button>
                                    </div> 
      							</div>
             					<div class="single-prdct-rvw"> | &nbsp; &nbsp; <?= $number_review ;?> reviews </div>
            					<div class="clearfix"> </div>
                    		</div>	
                        </div>
                        <div class="col-lg-4" style="text-align:left">
                        	<span><strong>Product Id - <?php echo $product_data->product_id; ?></strong></span>
                        </div>
                    </div>
					
                    	<div style="clear:both;"></div>
                        
<!-----------------------------------Price Section---------------------------------------->   

<div class="row price_single">
	<?php  
		$query=$this->db->query("select * from product_master where sku='$data_sku' ");
		$recd=$query->row();
		$cdate = date('Y-m-d');
		$special_price_from_dt = $recd->special_pric_from_dt;
		$special_price_to_dt = $recd->special_pric_to_dt;
	?>
	<div class="col-lg-5">
    	<div class="row">
        	<div class="col-lg-8" style="padding-right:0;">
            	<div class="prc">
					<?php
					if($recd->special_price !=0){
						if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
					?>
                	<ul style="margin:0; padding:0;">
                    	<li class="regular-price"> MRP - Rs. <?=ceil($recd->mrp); ?></li>
						<?php if($recd->price != 0){?>
                        <li class="price2"> Sell Price - Rs. <?=ceil($recd->price); ?></li>
						<?php }?>
                        <li class="price3"> Special Price - Rs. <?=ceil($recd->special_price); ?></li>
                    </ul>
					<?php }else {?>
					<ul style="margin:0; padding:0;">
						<?php if($recd->price != 0){?>
							<li class="regular-price"> MRP - Rs. <?=ceil($recd->mrp); ?></li>
							<li class="price2"> Sell Price - Rs. <?=ceil($recd->price); ?></li>
						<?php } else{?>
							<li class="price3"> MRP - Rs. <?=ceil($recd->mrp); ?></li>
						<?php }?>
					</ul>
					<?php }?>
					<?php } else{ ?>
					<ul style="margin:0; padding:0;">
						<?php if($recd->price != 0){?>
							<li class="regular-price"> MRP - Rs. <?=ceil($recd->mrp); ?></li>
							<li class="price2"> Sell Price - Rs. <?=ceil($recd->price); ?></li>
						<?php } else{?>
							<li class="price3"> MRP - Rs. <?=ceil($recd->mrp); ?></li>
						<?php }?>
					</ul>	
					<?php }?>
					
					<?php 
						$query=$this->db->query("select a.business_name,a.seller_id,b.shipping_fee_amount,b.status,b.approve_status from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'");
						$ct=$query->num_rows();
						$rew=$query->row();
					?>
					<?php if($rew->shipping_fee_amount == 0){?>
						<div class="shipng_spn">(Shipping charges free) &nbsp;</div>
					<?php } else {?>
						<div class="shipng_spn">Shipping free &nbsp;Rs.&nbsp; &nbsp; <?= $rew->shipping_fee_amount; ?></div>
					<?php }?>
                </div>
				<?php
					$query=$this->db->query("select a.business_name,a.seller_id,b.quantity,b.stock_availability,a.display_name,b.max_qty_allowed_in_shopng_cart,b.status,b.approve_status from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'");
					
					$ct=$query->num_rows();
					$rew=$query->row();
					$max_quantity=$rew->max_qty_allowed_in_shopng_cart;
					if($rew->quantity==0);
						{
					?> 
                   <?php 
					}
				   ?>
                <div class="sold-by" style="margin-top:15px;"> Sold by - 
                <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($rew->seller_id);?>" id="goslr" style="cursor:pointer !important; color:#6bb700;text-transform: capitalize;" target="_blank"><?php if($ct!=0){echo " ". $rew->business_name;}else {echo " moonboy";} ?></a>
				</div>
				<?php
					$qr1 = $this->db->query("SELECT c.dispatch_days FROM seller_account a INNER JOIN state b ON a.seller_state = b.state INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id WHERE a.seller_id ='$rew->seller_id'");
					$ct1 = $qr1->num_rows();
					$res = $qr1->row();
					if($ct1 > 0){
				?>   
					<p style="color: #999;font-size: .85em;line-height: 1.8em;"> Delivered By : 4 - 6 Days </p>
				<?php } else {?>
					<p style="color: #999;font-size: .85em;line-height: 1.8em;"> Delivered By : 10 - 12 Days </p>
				<?php }?>
            </div>
            <div class="col-lg-4" style="padding-left:0; text-align:left;">
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
            </div>
        </div>
    </div>
    <div class="col-lg-7">
    	<div class="single-prod-detail item-no">
        	<ul class="shtr-desc">
				<?php
					if($recd1->short_desc){
						$data = $recd1->short_desc;
						$short_desc = unserialize($data);
						foreach($short_desc as $value){
							if($value != ''){
						?>
				<li><?=$value?></li>
				<?php
							}
						}
					}
				?>
			</ul>
        </div>
    </div>
    <div class="row">
	<div class="col-lg-12">
    	<ul>
        	<li style="float:left; margin-right:10px;"><span style="height:50px; width:50px; background:green"></span></li>
        </ul>
    
    </div>
</div>  
</div> 
<!--COLOUR SIZE DIV START-->
<div id="corlsize_attrbdivid">
 
</div>
<!--COLOUR SIZE DIV START-->
	<?php 
		$query_curclolr=$this->db->query("SELECT color, size,lvl2,Capacity,RAM,ROM,seller_status FROM cornjob_productsearch WHERE sku='$data_sku' group by sku ");
		
		$curnt_color=$query_curclolr->row()->color;
		$curnt_size=$query_curclolr->row()->size;
		$cur_capacity=$query_curclolr->row()->Capacity;
		$cur_ram=$query_curclolr->row()->RAM;
		$cur_rom=$query_curclolr->row()->ROM;					
		$cur_lvl2=$query_curclolr->row()->lvl2;
		
		if($curnt_color!=''){
			$cur_productid=$recd->product_id;
			$prodname_wisecolr=$recd1->name;
			$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND size='$curnt_size' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
			if($query_extngskugrp->num_rows()<=1)
			{
				$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
			}
			$rw_extngskugrp=$query_extngskugrp->result_array();
	?>
	<div class="row">
  	<div class="col-lg-12">
    <span style="display:inline-block; float:left; margin-right:20px; margin-top:6px;"><strong>Color:</strong></span>
		
    	<ul class="color-checkbox-ul" style="min-height: 40px; margin-top: 0; margin-bottom: 0;">
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
			<li class="color-checkbox-ul-list">
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
				<input type="checkbox" value="<?php echo $rw_extngsku[0]->color; ?>" name="attr_colr" id='attr_colr' <?php if($curnt_color==$rw_extngsku[0]->color){echo "checked='checked'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" />
				<label for="checkboxInput" class='<?php if($rw_extngsku[0]->quantity=0 || $rw_extngsku[0]->quantity=='' || ($curnt_size!=$rw_extngsku[0]->size && $curnt_color!=$rw_extngsku[0]->color) ){echo "not-available";} ?>' style="width:30px; height:30px; background:<?php if($rw_extngsku[0]->color!='Multicolor'){ echo $rw_extngsku[0]->color;}?>;" <?php if($rw_extngsku[0]->color=='Multicolor'){ echo "class='multicolor'";}?> title="<?=$rw_extngsku[0]->color;?>"></label>
			</li>
			<?php } }?>
		</ul>
    </div>
	</div>
	<?php }?>
	<div style="clear:both;"></div>
  <?php 
	if($curnt_size!=''){
		$cur_productid=$recd->product_id;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND color='$curnt_color' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");
		if($query_extngsku->num_rows()<=1)
			{
				$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");
			}
			$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
    <span class="single-product-size"><strong>Size:</strong></span>
		<ul class="single-product-size-ul">
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
        	<li class="single-product-size-ul-li">
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
            	<a onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" style="cursor: pointer;"><?php echo $rw_extngsku[0]->size; ?></a>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
	<?php 
	if($cur_capacity!=''){
		$cur_productid=$recd->product_id;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by Capacity ");
		$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
    <span class="single-product-size"><strong>Capacity:</strong></span>
		<ul class="single-product-size-ul">
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
        	<li class="single-product-size-ul-li">
				<?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?><div class="not-available"> </div><?php } ?>
            	<a onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;"><?=$rw_extngsku[0]->Capacity;?></a>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
  
	<?php 
	if($cur_ram!=''){
		$cur_productid=$recd->product_id;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by RAM ");
		
		$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
    <span class="single-product-size"><strong>RAM:</strong></span>
		<ul class="single-product-size-ul">
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
        	<li class="single-product-size-ul-li">
				<?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?><div class="not-available"> </div><?php } ?> 
            	<a onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;"><?=$rw_extngsku[0]->RAM;?></a>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
  
  <?php 
	if($cur_ram!=''){
		$cur_productid=$recd->product_id;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by ROM ");
		$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
    <span class="single-product-size"><strong>RAM:</strong></span>
		<ul class="single-product-size-ul">
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
        	<li class="single-product-size-ul-li">
				<?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?><div class="not-available"> </div><?php } ?> 
            	<a onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;"><?=$rw_extngsku[0]->ROM;?></a>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
  
  
  
<div class="clearfix"> &nbsp; </div>

              
                </div>
        </div>
    </div>

<div class="row">
	<div class="col-lg-5">
    	<div class="right-button-helder">
			<?php   
				if(@$this->session->userdata['session_data']['user_id']!=""){
					if($rew->quantity==0 || $rew->status=='Disabled'|| $rew->approve_status =='Inactive' || $query_curclolr->row()->seller_status!='Active'){
			?>
        	<button type="button" title="Add to Cart" id="1" onclick="#" class="hvr-sweep-to-right add-to-cart" disabled="disabled" >Add to Cart</button>
    		<a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart disabled">Buy Now</a>
			<b style="color:#900; font-size:18px;">
			<?php
				if($rew->quantity==0  || $rew->status=='Disabled'|| $rew->approve_status =='Inactive' || $query_curclolr->row()->seller_status!='Active'){
				if($rew->quantity==0  || $rew->status =='Disabled' ){
						 if($rew->quantity==0){echo "Out of Stock";}
						 else{echo "Product  has been Temporarily Discontinued";}
					}
					else{
							echo "Product has been Discontinued";
						}
				}
			?></b>
			<?php } else {?>
				<?php if($vertual_inventory_data <= 0){?>
				<button type="button" title="Add to Cart" id="2" onClick="alert('This product is out of stock.');" class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>
				<a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="alert('This product is out of stock.');">Buy Now</a>
				<?php } else { ?>
				<button type="button" title="Add to Cart" id="3" onClick="goAddtoCart('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",str_replace("'", "",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')" class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>
				<a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="goAddtoCartBuyNow('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')">Buy Now</a>
			<?php } } ?>
			<?php } else if($rew->quantity==0 || $rew->status=='Disabled'|| $rew->approve_status =='Inactive' || $query_curclolr->row()->seller_status!='Active'){ ?>
				<button type="button" title="Add to Cart" id="4" onclick="#" class="hvr-sweep-to-right add-to-cart" disabled="disabled" >Add to Cart</button>
				<a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart disabled">Buy Now</a>
				<b style="color:#900; font-size:18px;">
				<?php 
					if($rew->quantity==0  || $rew->status=='Disabled'|| $rew->approve_status =='Inactive' || $query_curclolr->row()->seller_status!='Active'){
						
						if($rew->quantity==0  || $rew->status =='Disabled' ){
								if($rew->quantity==0){echo "Out of Stock";}
								else{echo "Product  has been Temporarily Discontinued";}
							}
							else{echo "Product has been Discontinued";}
					}
				?></b>
			<?php } else {?>
				<?php if($vertual_inventory_data <= 0){?>
					<button type="button" title="Add to Cart" id="5" onClick="alert('This product is out of stock.');" class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>
					<a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="alert('This product is out of stock.');">Buy Now</a>
				<?php } else {?>
				<button type="button" title="Add to Cart" id="6" onClick="window.location.href='<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name))))).'/'.$product_data->product_id.'/'.$data_sku ?>' " class="hvr-sweep-to-right add-to-cart">Add to Cart</button>
				
				<input type="checkbox" name="ltbn_name" value="<?php echo $data_sku ?>" id="ltbn_id" style="display:none;">
				<a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="logintobuynow('<?php echo preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name))))); ?>','<?php echo $product_data->product_id; ?>','<?php echo $data_sku ?>')" href="#inline_content">Buy Now</a>
			<?php } } ?>
        </div>
    	<div class="row">
        	<div class="col-lg-12">
                <ul  class="right-button-ul">
                   <!-- <li class="social-ul-li">
                        <a><img src="<?php //echo base_url();?>images/fb.png"></a>
                    </li>
                    <li class="social-ul-li">
                        <a><img src="<?php //echo base_url();?>images/tw.png"></a>
                    </li>
                    <li class="social-ul-li">
                        <a><img src="<?php //echo base_url();?>images/pr.png"></a>
                    </li>
                    <li class="social-ul-li">
                        <a><img src="<?php //echo base_url();?>images/g+.png"></a>
                    </li>
                    <li class="social-ul-li">
                        <a><img src="<?php //echo base_url();?>images/share.png"></a>
                    </li>
					-->
					
					<div class="addthis_native_toolbox"></div>
            	</ul>
                <div style="clear:both"></div>
                <p class="right-button-first-p">Share with friends and reletives. When they buy we give Rs.100</p>
            
            <div style="clear:both"></div>
            
                <div class="return-refund-held">
                <strong class="return-refunt-strong">Return & refund</strong>
                <span class="refund-guaranty-back">
                	<strong class="refunt-guaranty-strong"> 
                		<img src="<?php echo base_url();?>images/buyer-protection.png" style="width:24px; height:25px;">
                 		100% <span style="color:#5ac0fc; vertical-align: middle;">BUYER PROTECTON</span>
                 	</strong>
                 </span>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-7">
    <div class="check-availablity">
       <h4 class="title-sml"> Check Availability </h4>
        <input type="text" placeholder="Enter Your Pincode" name="pin" id="pin" class="pncd">
        <button type="button" class="btn1 btn-primary1 hvr-sweep-to-right" onClick="valid_pin()" style="cursor:pointer;"> <span>Check </span></button>
		<div id="valid_msg1"  style="font-weight:bold; color:red;"></div>
		<div id="pin-msg" style=" display:none; font-weight:bold; color:#093;"> Product is available at your location. </div>
       <div id="pin_msg_cod" style=" display:none; font-weight:bold; color:#90F; float:left;"> COD is also available. </div>
       <!--<div   style="font-weight:bold; color:red; float:right;">COD Charges Rs.65</div>-->
    </div>
</div>
</div>
               <div style="clear:both"></div>
  <div class="row">
  	<div class="col-lg-12">
      <p class="left-long-text">This item is eligible for returns have to be initiated by the buyer within 5 days of recipt of their parcel. Know more about the <a href="#" style="font-weight:bold; text-decoration:underline;">Return Policy here</a></p>

    
    </div>
  </div>  
    
 <div class="row" style="width:98%; margin:auto;">
  	<div class="col-lg-12">
		<h3>Short Description </h3>
        <ul> 
		<li style="text-align:justify;"><?php echo str_replace('\\', '', $recd1->description); ?></li>
    	<!--<li>  </li>-->
   </ul>
    
    </div>
  </div>
  
  <div style="clear:both;"></div>
   <?php
		$attr_hedng_row = $product_attr_result->num_rows();	
		if($attr_hedng_row > 0){
	?>
  <div class="row" style="width:98%; margin:auto;">
  	<div class="col-lg-6">
    	<h3 class="tittle">Specification</h3>
    </div>
    <div class="col-lg-6">
    </div>
  </div>
	<div class="row" style="width:98%; margin:auto;">
		<div class="col-lg-6">
			<ul id="accordion" class="accordion">
				<li>
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
								$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.product_id='$product_attr_heading_row->product_id' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '') group by b.attr_value" );
							}
							else{
								$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.sku='$product_attr_heading_row->sku' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '') group by b.attr_value");
							}
							if($query->num_rows()>0)	
								{
					?>
					<div class="link"><?=$product_attr_heading_row->attribute_heading_name;?><i class="fa fa-chevron-down"></i></div>
					<ul class="submenu" style="display:block;">
						<?php
							$result = $query->result();
								foreach($result as $product_attr_row){
						?>
						<li>
							<a href="#">
								<div class="row">
									<div class="col-lg-6"><?=$product_attr_row->attribute_field_name; ?> :</div>
									<div class="col-lg-6">
										<?php
											if($product_attr_row->attribute_field_name=='Color')
												{
													echo $rw_attrcronjob->color;
												}
											if($product_attr_row->attribute_field_name=='Size')
												{
													echo $rw_attrcronjob->size;
												}
											if($product_attr_row->attribute_field_name=='Capacity')
												{
													echo $rw_attrcronjob->Capacity;
												}
											if($product_attr_row->attribute_field_name=='RAM')
												{
													echo $rw_attrcronjob->RAM;
												}									
											if($product_attr_row->attribute_field_name=='ROM')
												{
													echo $rw_attrcronjob->ROM;
												}
											else if($product_attr_row->attribute_field_name != 'Color' && $product_attr_row->attribute_field_name != 'Size' && $product_attr_row->attribute_field_name != 'Capacity' && $product_attr_row->attribute_field_name != 'RAM'  && $product_attr_row->attribute_field_name != 'ROM')
												{ 
													echo $product_attr_row->attr_value;
												}
										?>
									</div>
								</div>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
					<?php } ?>
				</li>
			</ul>
		</div>
	</div>
	<?php } ?>
<div style="clear:both;"></div>
  <!--<div class="row" style="width:98%; margin:auto;">
  	<div class="col-lg-12">
    	<h2 style="color: #C60!important;
    font-size: 16px!important;
    font-family: verdana,arial,helvetica,sans-serif!important; font-weight: 700;line-height: 1.3;">Frequently bought together</h2>
    
    <ul class="xyz">
        
       
        <li class="a-align-center sims-fbt-image-2">
        <span class="a-list-item"><a class="a-link-normal" href="#">
        <div class="a-section">
        <img alt="" src="<?php echo base_url();?>images/combo-product1.png" class="sims-fbt-image">
        </div>
        </a>
        </span>
        </li>
        <li class="a-align-center sims-fbt-plus-2"><span class="a-list-item a-size-large a-color-tertiary">+</span></li>
        <li class="a-align-center sims-fbt-image-2">
        <span class="a-list-item"><a class="a-link-normal" href="#">
        <div class="a-section">
        <img alt="" src="<?php echo base_url();?>images/combo-product2.png" class="sims-fbt-image">
        </div>
        </a>
        </span>
        </li>
        </ul>
        <div class="sims-fbt-price-box">
            <div style="width:90%; margin:auto;">
            	<span style="font-size:13px; color:#555;">Total Price :</span>
                <span style="font-size:15px; color:#cc2d04!important;font-size: 17px!important; font-weight:bold; line-height: 1.255!important;"> <i class="fa fa-inr" aria-hidden="true"></i>56,448.00</span>
			<div style="margin-top:5px;">
            <a href="#" style="background: linear-gradient(to bottom,#f7dfa5,#f0c14b);
    border:1px solid #999; color: #111; padding:2px 5px; border-radius:3px;">Add both to Cart</a>
            </div>		
            	
            </div>
            
       </div>
    </div>
    <label><input type="checkbox" name="checkbox" value="value" checked=checked style="vertical-align:middle;"> <strong style="vertical-align:middle;">This item:</strong> <span style="font-weight:400;vertical-align:middle;">Sony 101.6cm (40 inches) Bravia KLV-40W562D full HD Smart LED TV <span style="color: #cc2d04!important;
    font-size: 17px!important;
    font-weight: bold;"><i class="fa fa-inr" aria-hidden="true"></i>56,448.00</span></span></label> 
  </div>
  <div class="first-multiple-banner">-->

	<!--<div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner">
          <div class="item  active">
            <div class="row">
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-11.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-10.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-9.png"></a>
              </div> 
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-8.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-8.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-7.png"></a>
              </div>      
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-6.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-5.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-4.png"></a>
              </div> 
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-3.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-2.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-1.png"></a>
              </div>      
            </div>
          </div>
        </div>
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>-->
 </div>

	<hr style="border-top: 1px solid #CCC!important;margin: 0;">
    
    <div style="clear:both;"></div>
    <!--<div class="row" style="width:98%; margin:auto;">
    	<div class="col-lg-6">
        	<h2 style="color: #C60!important;
    font-size: 16px!important;
    font-family: verdana,arial,helvetica,sans-serif!important; font-weight: 700;line-height: 1.3;margin-top: 10px;">Sponsored products related to this item <span style="color:#0066c0;">(What's this?)</span></h2>
        </div>
        <div class="col-lg-6">
        <p style="float:right; font-weight:bold;margin-top: 10px;">Page 1 of 5</p>
        </div>
    </div>
    <div class="first-multiple-banner">

	<div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide media-carousel" id="media2">
        <div class="carousel-inner">
          <div class="item  active">
            <div class="row">
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-1.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-2.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-3.png"></a>
              </div> 
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-4.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-5.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-6.png"></a>
              </div>      
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-7.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-8.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-9.png"></a>
              </div> 
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-10.png"></a>
              </div>          
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-11.png"></a>
              </div>
              <div class="col-md-2">
                <a class="multiple-sl" href="#"><img alt="" src="<?php echo base_url();?>images/thumb-sing-pro-sl-12.png"></a>
              </div>      
            </div>
          </div>
        </div>
        <a data-slide="prev" href="#media2" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media2" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>
 </div>-->

<?php include "footer.php" ?>

<a href="#" id="back-to-top" title="Back to top" class="show">↑</a>

</div>
<script type="text/javascript" src="<?php echo base_url();?>new_js/js/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_js/js/jquery.simpleLens.js"></script>

<script>
    $(document).ready(function(){
        $('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
            loading_image: 'demo/images/loading.gif'
        });

        $('#demo-1 .simpleLens-big-image').simpleLens({
            loading_image: 'demo/images/loading.gif'
        });
    });
</script>
<script>
$(document).ready(function(){
	var mrp = parseFloat($('#mrp_spn').text());
	var final_price = parseFloat($('#finl_spn').text());
	var percnt = parseFloat((final_price/mrp)*100);
	var discount_percent =  Math.round(100-percnt);
	if(isNaN(discount_percent)){
		$('#discount_spn').hide();
	}else{
		$('#discount_spn').html(discount_percent+'%<br>OFF');
	}
});
</script>

<script>
	function addWishlistFunction(product_id,sku){
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
	$(document).ready(function(){
		var no_of_mor_slr = $('.no_slr_spn').text();
		if(no_of_mor_slr > 0){
			$('.more_seller_spn').text('From - '+no_of_mor_slr+' Other Sellers ');
		}
		if(no_of_mor_slr == 1){
			$('.more_seller_spn').text('From - '+no_of_mor_slr+' Other Seller');
		}
	})
</script>

<script>
	$(document).ready(function(){
		$('.attr_hd_no').hide();
		var attr_hd_no = $('.attr_hd_no').text();
		for($i=1; $i<=attr_hd_no; $i++){
			if($('.qw'+$i).next().hasClass("attr_tbl") == false){
				$('.qw'+$i).hide();
			}
		}
	});
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

<script>
	function StoreInSession(pid,sku,pname){
		$('.by_btn').css('background-color','#ccc');
		$.ajax({
			url:'<?php echo base_url();?>product_description/set_buynow_session',
			method:'post',
			data:{pid:pid,sku_id:sku,pname:pname},
			success:function(result){
				
				if(result=='success'){
					window.location.href= '?restart';
				}
			}
		});
	}
	$(document).ready(function(){
	  if (window.location.search.indexOf('restart') > -1){
	  setTimeout(function(){ 
		  $('.inline').trigger('click');
		  }, 500);
	  };
	});
</script>

<script type="text/javascript">
	$(".simpleLens-big-image").css("height", "auto");
</script>


<script>
	function valid_pin(){
		var pin=document.getElementById('pin').value;

		 var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		 if(pin==""){
			 $('#valid_msg1').show().text('Please enter your Pin Number!');
			return false;
			pin.focus();
			
		}
		else if(isNaN(pin)){
			$('#valid_msg1').show().text('Enter a valid Pin Number');
			return false;
			pin.focus();
			
		}
		else if(pin.length != 6){
			$('#valid_msg1').show().text('Enter a 6-digit Pin Number');
			return false;
			pin.focus();
			
		}
		
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
<link href="<?php echo base_url();?>rateit/src/rateit.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>rateit/src/jquery.rateit.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>new_js/js/single-prod-accordian.js"></script>    
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57921268b212b919"></script>
</body>
</html>