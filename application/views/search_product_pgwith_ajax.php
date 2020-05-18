<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		
        
         <?php
		$search_title=trim(str_replace(' ','%20',$this->uri->segment(2)));
        $curl_strng=SOLR_BASE_URL."mycollection2_offline/select?indent=on&q=".$search_title."&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=1&start=0";
						
			
			$curl2 = curl_init($curl_strng);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			$product_data_sco = json_decode($output, true);
			//echo '<pre>';print_r($product_data_sco);exit;
			if($product_data_sco['response']['numFound']==0){
				$sugword=$product_data_sco['spellcheck']['collations'][1];
						
				//$this->load->library('session');
				
				//$this->session->set_userdata('sugstword',$sugword);					
				
				$searchsuggst_txt=trim(str_replace(' ','%20',$sugword));	
				//echo $searchsuggst_txt;exit;
				$curl_strng=SOLR_BASE_URL."mycollection2_offline/select?indent=on&q=".$searchsuggst_txt."&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=50&start=0";
				
				
				$curl3 = curl_init($curl_strng);
				curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
				$output3 = curl_exec($curl3);
				$product_data_sco = json_decode($output3, true);
				}
        ?>
        <?php //echo '<pre>';print_r($product_data_sco);exit;
		$cnt=count($product_data_sco['facet_counts']['facet_fields']['Category_Lvl3']);
		if($cnt==2)
		{	
			$Category_Lvl3=array();
			for($i_arr=0; $i_arr<$cnt; $i_arr += 2 )
			{
				$Category_Lvl3[]=$product_data_sco['facet_counts']['facet_fields']['Category_Lvl3'][$i_arr];
			}
			$category_lvl3=implode(",",$Category_Lvl3);
	?>
		<meta name="Description" content="<?php echo 'Moonboy.in:'.str_replace("%20"," ",$this->uri->segment(2)).','.$category_lvl3 ;?>">
		<meta name="Keywords" content="<?php echo str_replace("%20"," ",$this->uri->segment(2)).','.$category_lvl3.',Moonboy.in' ;?>" />
		<title><?php echo 'Moonboy.in:'.str_replace("%20"," ",$this->uri->segment(2).'-'.$category_lvl3) ;?></title>
<?php }else{?>
		<meta name="Description" content="<?php echo 'Moonboy.in:'.str_replace("%20"," ",$this->uri->segment(2)) ;?>">
		<meta name="Keywords" content="<?php echo str_replace("%20"," ",$this->uri->segment(2)).',Moonboy.in' ;?>" />
		<title><?php echo 'Moonboy.in:'.str_replace("%20"," ",$this->uri->segment(2)) ;?></title>
<?php }?>
        
		
		
        
        <!--<link rel="canonical" href="<?php //echo base_url().'Product_description/product_search?search='.$_GET['search']; ?>"/>-->
        <link rel="canonical" href="<?php echo base_url().'search-by/'.$this->uri->segment(2); ?>"/>
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

    	<?php include "header.php"; 
		//$row=$product_data->num_rows();
		?><!------ Start Content ------>

<script>
/*function ShowMoreData(result_no,title){
	var numItems = parseInt($('.grid1_of_4').length);
	var result_no = parseInt(result_no);
	$.ajax({
		url:'<?php //echo base_url(); ?>product_description/show_more_search_product_data',
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
*/

function ShowMoreData(result_no){
	//var title ="<?php  //echo $_GET['search'];  ?>";
	var title ="<?php  echo $this->uri->segment(2);  ?>";
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

<script>

function loadfirstproductsearchajax(){
 
 //var srch_data ="<?php // echo $_GET['search'];  ?>";
 var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
 
  //$("#viewmorebtns_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description/search_firstproductloadajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     $("#firstproduct_loader").css('display','none');
	 $("#ajaxprodload_divid").html(data);
	 
    }
  });
}

<?php //if($row>0){ ?>
 $(document).ready(function(){
	 loadfirstproductsearchajax();
	 loadajax();
    /*setTimeout(function(){
       loadfirstproductsearchajax();
     },10);*/ // milliseconds
});
<?php //}  ?>



function loadajax(){
 
 //var srch_data ="<?php // echo $_GET['search'];  ?>";
 var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
 
 //alert(srch_data);return false;
 //$("#catg_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description/product_searchcategory_ajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     $("#catg_loader").css('display','none');
	 $("#product_catgdiv").html(data);
	 
    }
  });
}

<?php //if($row>0){ ?>

/* $(document).ready(function(){
    setTimeout(function(){
       loadajax();
     },10); 
	 
	 // milliseconds
});*/
 <?php  //} ?>

function loadproductcountajax(){
 
 //var srch_data ="<?php  //echo $_GET['search'];  ?>";
 var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
 
 //$("#productcount_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description/product_searchproductcount_ajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     //$("#productcount_loader").css('display','none');
	 $("#productcount_div").html(data);
	 
    }
  });
}
<?php //if($row>0){ ?>
 $(document).ready(function(){
    setTimeout(function(){
       loadproductcountajax();
     },10000); // milliseconds
});

<?php //} ?>

function loadviewmorebuttonajax(){
 
 //var srch_data ="<?php  //echo $_GET['search'];  ?>";
 var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
 
  //$("#viewmorebtns_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description/product_searchvewmorebtn_ajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     //$("#viewmorebtns_loader").css('display','none');
	 $("#view_more_dv").html(data);
	 
    }
  });
}

<?php //if($row>0){ ?>
 $(document).ready(function(){
    setTimeout(function(){
       loadviewmorebuttonajax();
     },10000); // milliseconds
});
<?php //}  ?>

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
              <div class="row1">
              <div id="product_catgdiv">
              <div id="catg_loader" align="center"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading Categories...</div>
                  <?php /*?><div class="col col-4">
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
                        
                        <label class="radio"><input type="radio" name="radio" onClick="redirectCategoryPage('<?=$cat_name_rw->category_id;?>','<?= preg_replace('#/#',"-",str_replace(' ','-',$cat_name_rw->category_name)); ?>')"><i></i><?php echo stripslashes($cat_name_rw->category_name); ?></label>
                        
                  <?php
							}
						}
						} // End of not empty arry condition
				  } // End of if condition
				  ?>
                  </div><?php */?>
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
        	<div style="text-align:right;" id="productcount_div"><!--Total <?php //echo $no_of_product;?> products--> 
            
            <?php /*?><div id="productcount_loader" align="right"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;display:none;" /><br>Loading...</div><?php */?>
            </div>
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
        <div id="ajaxprodload_divid">
		<!-- grids_of_4 -->
        
        <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>
		<!-- end grids_of_4 -->
        
        </div>
       	<div class="clearfix"></div>
       
        <div id="view_more_dv" >
       <?php /*?> <div id="viewmorebtns_loader" align="center"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;display:none;" />
        <br>Loading...</div><?php */?>
        
           <?php /*?> <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img"/>
            <?php if(@$no_of_product > $sl){ ?>
            <input type="button" class="add-to-cart view_mor" value="view more" name="button" onClick="ShowMoreData('<?=@$no_of_product;?>','<?=$this->input->get('search');?>')">
            <?php } ?><?php */?>
            
            
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

  <!--<script src="<?php //echo base_url();?>js/wow.js"></script>-->
<script>
   /* wow = new WOW(
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
    };*/
  </script>

</body>

</html>