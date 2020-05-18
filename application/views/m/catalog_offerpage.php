<?php
 include 'header.php'; 
 ?>

<style>
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
    /* background: #ccc; */
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
    /*padding: 0 15px*/;
    background-color: white;
    max-height: 0;
    transition: max-height 0.2s ease-out;
	margin-bottom: 0!important;
	width: 100%;
	overflow-y: scroll;
}
div.panel ul li {
    list-style: none; 
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
     padding-bottom: 0px;
    padding-top: 0px;
    width: 48%;
    float: left;
    margin-left: 6;
    margin-right: 6px;
    margin-bottom: 6px;
}.prduct-sl-1st{
	width:100%; padding:0; height:30px;
	}
.product-sl-off{
	width: 25%;
	text-align: center;
	background: rgba(89, 194, 175, 0.79);
	color: #fff; 
	font-weight: bold; 
	letter-spacing: 1px; 
	line-height: 18px;
	padding: 1px;
	display: inline-block;	
}	
.product-sl-right{
	float:right; width:65%; text-align:right;
}
.poduct-sl-pre{
		text-decoration: line-through;
    display: inline-block;
    color: #8B8B8B;
    font-size: 10px;
}
.product-sl-main-price{
	color: #900;
    display: inline-block;
    font-size: 14px;
   text-align: right;
}
.product-sl-image-held{
	text-align:center; width:100%; margin:auto;
}
#slider02 .overview li {
    border: none;
}
#slider02 .viewport {
    height: 195px;
    /* overflow: hidden; */
    /* position: relative; */
    width: 268px;
    margin: auto auto auto -25px;
}
.product-sl-image-held img {
    max-width: 100%;
    height: auto;
    max-height: 95px;
}
.best-deals {
    width: 98%;
    padding: 10px;
    margin: auto;
    border: 3px solid #ed2541 !important;
    height: 230px;
}

.best-deals ul{
	margin:auto;
}
.best-deals ul li{
	width:45%; float:left; margin:5px;
	list-style:none;
}
.featured-phones-held {
    width: 98%;
    padding: 10px;
    margin: auto;
    border: 3px solid #f2f2f2 !important;
    height: 445px;
	overflow-y:scroll;
}
.featured-phones-held ul{margin:auto;}
.featured-phones-held ul li{
	width:45%; float:left; margin:5px 5px 16px 5px;
	list-style:none;height: 235px;
}
.featured-phones-sl-image-held{
	text-align:center; width:100%; margin:auto;
}
.featured-phones-held img {
    max-width: 100%;
    height: auto;
    max-height: 150px;
}
.best-deals-end{
	width:100%; 
	color:#555; font-size:13px; text-align:right;
}
.best-deals-heading{
	width:98%; background:#ed2541 !important; color:#fff; height:35px; margin:auto;
}
.ad-info h5 {
    text-align: center;
}
.featured-phones-heading{
	width:98%; color:#333; height:25px; margin:20px auto 0px;    text-align: left;
    font-family: /*"Adobe Song Std L"*/ /*Pristina*/ /*Perpetua*/ /*"Tekton Pro"*/ /*"Adobe Arabic"*/ "Adobe Song Std L" /*"Poor Richard"*/;
}
  </style>
 <link rel="canonical" href="<?php //echo base_url().$label_name; ?>"/>
 
 
<script>
function ShowMoreData(result_no,cat_id,lastseg){
	var numItems = parseInt($('.product-grids').length);
	var result_no = parseInt(result_no);
	//alert(result_no);
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
			$('.view_mor').show();
		},
		success:function(result){
			$('.products-row').append(result);
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
		<div class="wrap" >
		<!--products-->
       <div class="info-products">
	   
	      <div class="info-inner">
		  
               
               <!-- Filter Panel -->
                <?php //include "catalog_menu.php"; ?>  
               <!--Filter Panel -->
				
				<h3 class="tittle">View Products</h3>
                <div class="products" style="padding:0px;">
                <div class="container">
                    <div class="col-md-12 product-w3ls-right">			
				<div class="products-row" id="prod_rwdiv">
                <?php if($product_data != false){
					$row=$product_data->num_rows();
					$sl=0;
					//print_r($row);exit;
					if($row>0){
					foreach($product_data->result_array() as $rw ) { $sl++;
						$cdate = date('Y-m-d');
						$special_price_from_dt = $rw['special_pric_from_dt'];
						$special_price_to_dt = $rw['special_pric_to_dt'];
						
						$dsply_img = $rw['catelog_img_url'];
						$image_arr=explode(',',$rw['catelog_img_url']);
						$quantity=$rw['quantity'];			
				?>                
                		<div class="col-md-3 product-grids"> 
						<div class="agile-products" style="max-height: 350px; min-height: 250px;">
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
							<div class="new-tag">
                            <!--<h6>20%<br>Off</h6>-->                           
                            <h6><?=$percen_off?>%<br>Off</h6>                            
                            </div>
                            <?php } ?>
                            
							
                            <div style="margin:auto; width:100%; text-align:center; ">
                             <?php  if(empty($dsply_img)){?>
                             <a style="margin:auto; text-align:center;" 
                             href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                             <img style="height: 112px; max-width: 100%; margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/prdct-no-img.png"  alt="<?=$rw['name'];?>"></a>
                             <?php }else { ?>
                             <a style="margin:auto; text-align:center;" 
                             href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                             <img style="height: 112px;max-width: 100%;margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" onerror="imgError(this);"  alt="<?=$rw['name'];?>">
                             </a>                       
                             <?php } ?>
                            </div>
							<div class="agile-product-text" >              
								<h5 style="text-align:left; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
								<?php if(strlen($rw['name']) > 30){ echo substr($rw['name'],0,30).'...';}else{ echo $rw['name'];}?>
                                </a></h5> 
								<!--<h6><del>$200</del> $100</h6>-->

                                
                                 <!-----------------------------------Product price start---------------------------->
                                
                                	<?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
										   $cur_splprc=$rw['special_price'];
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $cur_splprc==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $cur_splprc==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                                <!-----------------------------------Product Price End----------------------------->
							</div>
						</div> 
					</div>
            <?php } } } ?>                
				</div>
                <div class="clearfix"> </div>
			</div>
		</div>
	</div>   
		<br>     
        <div id="view_more_dv" align="center">
        <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none;" width="24px" />
        <?php 	$catgstr_urlpass=$this->uri->segment(3); 
				//$catgstr_urlpass='offer'; 
				if($no_of_product > $sl){?>
        <input style="display:none;" type="button" class="btn-sign-in" id="viewmore_prodbtnid"  value="View more" name="button" onClick="ShowMoreData('<?=$no_of_product;?>','<?=$catgstr_urlpass?>','<?php if($this->uri->segment(2) != ''){ echo $this->uri->segment(2);}else{ echo 'NOT';}?>')">
		<input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
        <?php }	?>
   		</div>
			<div class="clearfix"> </div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>
 <!--<footer class="site-footer">
<div class="container-fluid">-->
<?php 
/* $qr=$this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Status='active' AND sec_type='Rich Text Editor' ");
		 
if($qr->num_rows()>0)
{ 
	foreach($qr->result_array() as $res_secdata)
	{	*/	  
?>
    
<strong><b><?//=//$res_secdata['sec_lbl']?> <!--:--></b></strong>
</br>
<p><?//=//$res_secdata['sec_descrp']?></p>

<?php //}} ?>        
     <div class="clearfix"> </div>
     <br>
        <!-----------section 30  start------------>
        <?php /*?><?php require_once('footer_link.php'); ?>  <?php */?>
        <!-----------section 30  end------------------>
      
      
   
        <!---------------------------------------footer end--------------------------------->  
 <?php include "footer.php"; ?> 
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