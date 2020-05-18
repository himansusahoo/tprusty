<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="Description" content="<?php echo $data->meta_description;?>">
        <meta name="Keywords" content="<?php echo $data->meta_keywords;?>"/>
        
		<meta name="author" content="">
		<title><?php echo $data->page_title ;?></title>
		<link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>"/>
    <?php include "header.php" ;
	$this->db->cache_on();
	?>
<!------ Start Content ------>
<div class="main-content"> 

<div class="col-md-3 filter">
<!--<h3>Filter By</h3>-->
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
		
		<section  class="filter-form">
					<h4>Categories</h4>
						<div class="row1 scroll-pane">
							<div class="col col-4">
                            <?php
							$sl=0;
							foreach($brand_name->result() as $res){ 
							$sl++;
							?>
								<?php /*?><label class="radio"><input type="radio" name="radio" onClick="redirectCategoryPage('<?=$res->category_id;?>',<?=$sl;?>,'<?= str_replace('---','-',str_replace('--','-',str_replace(',','',preg_replace('#/#',"-",str_replace("'s",'-',str_replace('&','',str_replace(' ','-',strtolower($res->category_name)))))))); ?>')"><i></i><?php echo $res->category_name; ?><?php */?>
                                
                                 <label class="radio"><input type="radio" name="radio" onClick="window.location.href='<?php echo base_url().$res->url_displayname ?>'">
                                <i></i><?php echo $res->label_name; ?>
                                
                                
                                </label>
                                
                                
                                
                                <?php } ?>
							</div>
							
						</div>
		</section>
		
	  </div>
      
      <div class="clearfix"></div>
   </div>



<div class="catalog-cont">
<!--<div class="bnr-t"> <img alt="" src="<?php// echo base_url() ?>images/catalog-banner.jpg" /> </div>-->
<div class="w_content">
		<div class="catlog">
			<!--<a href="#"><h4>Enthecwear - <span>4449 itemms</span> </h4></a>
			<ul class="f_nav">
						<li>Sort : </li>
		     			<li> <a class="active" href="#"> popular</a> </li> |
		     			<li> <a href="#"> new </a> </li> |
		     			<li> <a href="#"> discount</a> </li> |
		     			<li> <a href="#"> price: Low High </a> </li> 
		     			<div class="clear"></div>	
		     </ul>
		     <div class="clearfix"> </div>	-->
		</div>
        <span>   <?php //echo $this->benchmark->elapsed_time(); ?>
       </span>
		<!-- grids_of_4 --><?php if($product_image!=""){ ?>
		<div class="grids_of_4 catgry-catlog">
    
        <?php  foreach($product_image->result() as $rw ) {  //$image_arr=explode(',',$rw->catelog_img_url); 
		$dsply_img = $rw->imag;
			 $catgIdmenu=$rw->category_id;
			$qr_dispurl=$this->db->query("SELECT distinct url_displayname FROM category_menu_desktop WHERE (category_id='$catgIdmenu' OR category_id LIKE '$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu' ) ");
			
			$url_disp=$qr_dispurl->row()->url_displayname;
		?>
		  <div class="grid1_of_4 catlg">
				<div class="content_box">
                <div class="view view-fifth">
                
                 
        <?php /*?> <a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rw->category_name))))) ?>"><?php */?>
         <a href="<?php echo base_url().$url_disp; ?>">
         
			   	<!-- <img src="<?php // echo base_url().'images/product_img/'.$image_arr[0];?>" class="img-responsive" alt=""/>-->
                 
                <?php if(empty($dsply_img)){?>
                <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="">
                <?php }else{?>
                <img src="<?php echo base_url();?>images/product_img/<?=$rw->imag;?>" onerror="imgError(this);" class="img-responsive" alt="">
                <?php } ?>
                 
		  </a>  </div>	
				    <!--<h5> <a href="#"> Duis autem </a> </h5>
				    <h6>It is a long established fact that a reader<h6>
				    <h4 class="catalog-price"> Rs. 499.00 </h4>
                   <ul class="add-to"> 
                   <li> <a href="#"> Add to Wishlist  </a> |  </li>
                   <li> <a href="#"> Add to Compare  </a> </li>
                   </ul>-->
         <a href="<?php echo base_url().$url_disp; ?> ">
        <h1 class="btn-bg catgry-name"> <!--<?//= substr($rw->name,0,45).'...';?>--> <?=$rw->category_name; ?></h1></a>
			   	</div>
			</div>
            <?php } ?>
            
            <?php } ?>
            
		</div>
		<!-- end grids_of_4 -->
        
	</div>
<?php

//$cat_id = $this->uri->segment(4);

		$query = $this->db->query("SELECT catg_description FROM category_master WHERE category_id='$cat_id' ");
		
  if($query->num_rows()>0) {?>
<div class="col-md-12">
<div  style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;">
<?php 

		echo  stripslashes($query->row()->catg_description);
?>
        </div>
        </div>
<?php } ?>        
        
</div> 



 
     <!-- Page generated in {elapsed_time} seconds.<br> -->
     <?php //echo "Query_intime:" . $this->benchmark->elapsed_time('code_start')."<br>";
	 	//echo "Query_outtime:" . $this->benchmark->elapsed_time('code_end');
	 ?>
 
  <div class="clearfix">&nbsp;</div>
  
<div class="clearfix">&nbsp;</div>
 
<?php include "footer.php" ?>

<script>
function redirectCategoryPage(category_id,sl,cat_name){
	//window.location.href='<?php //echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+category_id;
	
	window.location.href='<?php echo base_url();?>'+cat_name;
}


function imgError(image){
    image.onerror = "";
    image.src = "<?php echo base_url();?>images/product_img/prdct-no-img.png";
    return true;
}
</script>

</body>

</html>