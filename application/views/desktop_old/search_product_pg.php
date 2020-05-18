<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php echo $data->meta_descrp ;?>" content="">
        <meta name="<?php echo $data->meta_keyword ;?>" content="" />
        
		
		<title><?php echo $data->title ;?></title>

    	<?php include "header.php" ?><!------ Start Content ------>

<script>
function ShowMoreData(result_no,title){
	var numItems = parseInt($('.grid1_of_4').length);
	var result_no = parseInt(result_no);
	$.ajax({
		url:'<?php echo base_url(); ?>product_description/show_more_search_product_data',
		method:'get',
		data:{from:numItems,title:title},
		beforeSend: function(){
			$('.view_mor').hide();
			$('#lodr_img').show();
		},
		complete: function(){
			$('#lodr_img').hide();
			$('.view_mor').show();
		},
		success:function(result){
			$('.grids_of_4').append(result);
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
}
</script>
 
<div class="main-content"> 


<div class="col-md-3 filter">
<h3>Browse</h3>
	  <div class="f_sidebar">
		<!--<div class="f_nav1">
			<h4>All</h4>
			<ul>
				<li><a href="#">women</a></li>
				<li><a href="#">new arrivals</a></li>
				<li><a href="#">trends</a></li>
				<li><a href="#">boys</a></li>
				<li><a href="#">girls</a></li>
				<li><a href="#">sale</a></li>
			</ul>	
		</div>-->
		
		<section class="filter-form">
          <h4>Categories</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
                  <?php
				  if($product_data->num_rows() > 0){
					  foreach($catg_ids->result() as $cat_row){
						  $fltr_cat_id[] = $cat_row->category_id;
					  }
					  $uniq_arr = array_unique($fltr_cat_id);
					  //print_r($uniq_arr);
					  if(!empty($uniq_arr)){
					  	foreach($uniq_arr as $val){
							$sql = $this->db->query("SELECT * FROM category_indexing WHERE category_id='$val'");
							//$sql = $this->db->query("SELECT distinct lvl1,lvl1_name FROM view_catinfo WHERE lvl2='$val'");
							foreach($sql->result() as $cat_name_rw){
				  ?>
                  		<!--<p><?//=$cat_name_rw->category_name;?></p>-->
                        
                        <label class="radio"><input type="radio" name="radio" onClick="redirectCategoryPage('<?=$cat_name_rw->category_id;?>','<?= preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($cat_name_rw->category_name))))); ?>')"><i></i><?php echo stripslashes($cat_name_rw->category_name); ?></label>
                        
                  <?php
							}
						}
						} // End of not empty arry condition
				  } // End of if condition
				  ?>
                  </div>
              </div>
		</section>
		
    	
        <!--<section class="filter-form">
          <h4>Price</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
                      
                  </div>
              </div>
		</section>-->
        
    	
	  </div>
   </div>



<div class="catalog-cont">
<div class="w_content">
		<div class="catlog">
        	<div style="text-align:right;">Total <?=$no_of_product;?> products </div>
			<!--<a href="#"><h4>Enthecwear - <span>4449 itemms</span> </h4></a>-->
			<!--<ul class="f_nav">
						<li>Sort : </li>
		     			<li> <a class="active" href="#"> popular</a> </li> |
		     			<li> <a href="#"> new </a> </li> |
		     			<li> <a href="#"> discount</a> </li> |
		     			<li> <a href="#"> price: Low High </a> </li> 
		     			<div class="clear"></div>	
		     </ul>-->
             <?php /*?><div id="filtr_breadcrumb">
                <span style="color:#757575;">
				<?= $this->uri->segment(3)?> &nbsp;
				<?php
				if($this->uri->segment(5)){
					$parm_arr = explode('&',$this->uri->segment(5));
					$parm = $parm_arr[1];
					echo '/ '.$parm;
				}
				if($this->uri->segment(6) != ''){ echo ' / '.$this->uri->segment(6);}
				?>
                </span>
             </div><?php */?>
		     <div class="clearfix"> </div>	
		</div>
		<!-- grids_of_4 -->
		<div class="grids_of_4">
        <?php  
		$row=$product_data->num_rows();
		//print_r($row);exit;
		$sl=0;
		if($row>0){
		foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw->special_pric_from_dt;
			$special_price_to_dt = $rw->special_pric_to_dt;
			
			$dsply_img = $rw->catelog_img_url;
			$image_arr=explode(',',$rw->catelog_img_url);
			//$taxdecimal = $rw->tax_rate_percentage/100;
		
			//tax amount for product price
			//$tax_amount = $rw->price*$taxdecimal;
		
			//tax amount for product special price
			//$tax_amount_special = $rw->special_price*$taxdecimal;
			$quantity=$rw->quantity;
		?>
		  <div class="grid1_of_4 catlg">
          
				<div class="content_box"> 
               <div class="view view-fifth">
                 <?php if($quantity == 0){ ?>
                 <div class="outofstock">
               <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" ><?php */?>
                 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" >
                
                
                
                Out of Stock </a> </div><?php }?>
               <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" ><?php */?>
                
                 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" >
			   	  
  
                    <?php if(empty($dsply_img)){?>
    				<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="<?=$rw->name;?>">
    				<?php }else{?>
					<img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" onerror="imgError(this);" class="wow flipInY grow" data-wow-delay="1s" alt="<?=$rw->name;?>">
   					<?php } ?>
                      
				   </a> </div>
                   
                  <div class="wish-list">    <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$rw->product_id; ?>,'<?=$rw->sku; ?>')"> <i class="fa fa-heart"></i> </span>
            <?php }else{ ?>
            	<a class="link-wishlist inline" href="#inline_content"> <i class="fa fa-heart"></i> </a>
            <?php } ?>
            </div>
				    <h2 class="prdt_title"><?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" > <?php if(strlen($rw->name) > 40){ echo substr($rw->name,0,40).'...';}else{ echo $rw->name;}?> <?php */?>
                    
                <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" > <?php if(strlen($rw->name) > 40){ echo substr($rw->name,0,40).'...';}else{ echo $rw->name;}?>    
                 
                    </a> </h2>
                     
                      <!--- <h6><?php// echo substr($rw->description,0,50).'...';  ?> </h6> -->
                     
                     <!--- price calculation div start here --->
                    <?php /*?><div class="price-box">
                    <?php 
                    if($rw->special_price !=0){ 
                        if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                    ?> 
                    
                    <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                    <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
                    <?php }else{ ?>
                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span>
                        <?php } //End of date condition ?>
                    
                    <?php }else{ ?>
                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span>
                    <?php } ?>
                    </div><?php */?>
                    
                    
        <!--- price calculation div start here --->
     	<div class="price-box">
        <!---Special price exists condition start here --->
		<?php
		if($rw->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
		
        <?php } ?>
        </div>
        <!--- price calculation div end here --->
      
       <?php
		$query= $this->db->query("SELECT  product_id   FROM product_master WHERE approve_status = 'Active' and product_id='$rw->product_id' and seller_id!=0 GROUP BY product_id, seller_id");
		
		
		//$qr=$query->result();
		//print_r($qr);exit;
		    //foreach($qr as $rew){
			$count_13 = $query->num_rows()-1;
			//print_r($count_1);exit;
			if($count_13 != 0)
			{
			//?>

         <div class="other-seller">  <a href="#"> From <?php echo $count_13; ?> other Sellers </a> </div> 
		 <?php }//} ?>
                         
           <!--<ul class="add-to-links">
            <li><span class="separator"> <input type="checkbox"> </span> <a href="#" class="link-compare">Add to Compare</a></li>
           </ul>-->
                   
                 
                   
        <!--<div  class="btn-bg">
			<button type="button" title="Quick View" class="button btn-cart" data-toggle="modal" data-target="#myModal<?=$sl?>"> View Details</button> 
            
		</div> -->
		
         <!-- Modal --> 
            <?php /*?><div class="modal fade" id="myModal<?=$sl?>" role="dialog" aria-labelledby="myModalLabel"> 
            <div class="vertical-alignment-helper">
                 <div class="modal-dialog vertical-align-center">
                     <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         </div>
                         
                         <div class="modal-body">
                            <div class="col-md-8 quick_view_img">
                              <img src="<?php $image_arr1=explode(',',$rw->imag); echo base_url().'images/product_img/'.$image_arr1[0]; ?>" class="" width="500" alt=""/>
                            </div>
                                
                            <div class="col-md-4 quick_view_data">
                                <div class="light-box-product-details">
                                    <h2 class="single_prdct_title"><?=$rw->name?></h2>
                                    
                                    <!--- price calculation div start here --->
                                    <div class="price-box">
                                    <!---Special price exists condition start here --->
                                    <?php
                                    if($rw->special_price !=0){
                                        if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                    ?>
                                    
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
                                    <!---Special price exists condition end here --->
                                    <?php }else{ ?>
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } //End of date condition ?>
                                    
                                    <?php }else{ ?>
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } ?>
                                    </div>
                                    <!--- price calculation div end here --->
                                    <!--<button type="button" title="Add to Cart" onClick="window.location.href='<?//php echo base_url().'product_description/addtocart/'.str_replace(" ","-",strtolower($rw->name)).'/'.$rw->product_id.'/'.$rw->sku; ?>' " class="btn btn-primary" >Add to Cart</button>--> 
                                    <div>
                                        <ul>
                                            <?php if($rw->short_desc){
                                                $data = $rw->short_desc;
                                                //$description = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $data);
                                            	//$short_desc = unserialize($description);
												$short_desc = unserialize($data);
                                                foreach($short_desc as $value){
                                                ?>
                                                    <li><?=$value?></li>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                                
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
            </div><?php */?>
            
		
			   	</div>
			</div>
            <?php } // End of foreach loop?>
            <?php }else{ ?>
           <div>NO Record Found</div>
			<?php } ?>
        </div><!-- end grids_of_4 -->
       	<div class="clearfix"></div>
       
        <div id="view_more_dv">
            <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img"/>
            <?php if($no_of_product > $sl){ ?>
            <input type="button" class="add-to-cart view_mor" value="view more" name="button" onClick="ShowMoreData('<?=$no_of_product;?>','<?=$this->input->get('search');?>')">
            <?php } ?>
        </div>
       		
	</div>

</div> 
  
  <div class="clearfix">&nbsp;</div>
 

    
 <?php include "footer.php" ?> 


<script>
function addWishlistFunction(product_id,sku){
	/*var succ_dv = '#wiss_succs'+sl;
	$(succ_dv).show();
	$(succ_dv).text('process...');*/
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist',
		method:'post',
		data:{product_id:product_id,sku:sku},
		success:function(result){
			
			if(result=='success'){
				alert('successfully added');
			}
			if(result=='exists'){
				window.location.href='<?php echo base_url(); ?>wish-list';
			}
		}
	});
}
</script> 

<script>
function getFiltercat_id(cat_id,curnt_url,sl){
	var checked = $('#cat_checkbox'+sl).is(':checked');
	if (checked){
		//alert(curnt_url+cat_id);
		$.ajax({
			url:'<?php echo base_url();?>product_description/filtered',
			method:'post',
			data:{category_id:cat_id},
		});
	}else{
		//alert(curnt_url+'-'+cat_id);
	}
}
</script>

<script>
function thirdBrandFilter(brand,cat_name,cat_id){
	window.location.href='<?php echo base_url();?>product_description/filteredbrand/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'brnd&'+brand;
}

function thirdPriceFilter(price_slab,cat_name,cat_id){
	window.location.href='<?php echo base_url();?>product_description/filteredprice/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'prce&'+price_slab;
}

function thirdMultiFilter(price_brnd,cat_id,cat_name,val){
	window.location.href='<?php echo base_url();?>product_description/multifilter/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+price_brnd+'/'+val;
}
</script>


<script>
function redirectCategoryPage(category_id,cat_name){
	//window.location.href='<?php //echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+category_id;
	
	window.location.href='<?php echo base_url();?>'+cat_name.replace(" ","-");
}


function imgError(image){
    image.onerror = "";
    image.src = "<?php echo base_url();?>images/product_img/prdct-no-img.png";
    return true;
}
</script>

<style>
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:850px;
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
	z-index: 10000001 !important;
}
.modal-header { min-height: 15px; padding: 10px; border-bottom: none;}
/*.modal-body{padding: 10px 10px 10px 35px;}*/

.quick_view_img img{width: auto !important; height: auto !important;}
.quick_view_img{width:500px; height:500px;}
.quick_view_data{height::500px; width:300px;}

.banner2 img{width:450px !important; height:450px !important;}
.light-box-product-details{padding: 10px;}

#lodr_img{ width:80px; height:80px; display:none;}
#view_more_dv{text-align:center;}
</style>

  <script src="<?php echo base_url();?>js/wow.js"></script>
<script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'wow flipInY';
      this.parentNode.insertBefore(section, this);
    };
  </script>

</body>

</html>