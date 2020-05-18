<?php include 'header.php'; ?>

<link rel="canonical" href="<?php echo base_url().'Product_description/product_search?search='.$_GET['search']; ?>"/>
<script>

/*function redirectCategoryPage(category_id,cat_name){
	window.location.href='<?php //echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+category_id;
}*/

function redirectCategoryPage(cat_name){
	window.location.href='<?php echo base_url();?>'+cat_name.replace(" ","-");
}
</script>		
<script>

function ShowMoreData(result_no){
	var title ="<?php  echo $_GET['search'];  ?>";
	var numItems = parseInt($('.col-md-4').length);
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
			$('.product-more').append(result);
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
}
</script>
<script>

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
 
 var srch_data ="<?php  echo $_GET['search'];  ?>";
 //alert(srch_data);return false;
 //$("#catg_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description/product_searchcategory_ajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     //$("#catg_loader").css('display','none');
	 $("#product_catgdiv").html(data);
	 
    }
  });
}
</script>


<script>
$(document).ready(function(){
    setTimeout(function(){
       loadviewmorebuttonajax();
     },10000); // milliseconds
});

function loadviewmorebuttonajax(){

 var srch_data ="<?php  echo $_GET['search'];  ?>";
 
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
</script> 
<script>

 $(document).ready(function(){
	 loadfirstproductsearchajax();
	 loadajax();
    /*setTimeout(function(){
       loadfirstproductsearchajax();
     },10);*/ // milliseconds
});

function loadfirstproductsearchajax(){
 
 var srch_data ="<?php  echo $_GET['search'];  ?>";
 
 
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
</script>

      
        <div class="wrap push" id="home">
		<!--products-->
       <div class="info-products" id="info">
	   
	      <div class="info-inner">
		  
               
               <!-- Filter Panel -->
                <?php //include "catalog_menu.php"; ?>  
               <!--Filter Panel -->
               
               
            <!---------------------------------subcategory list start---------------------------------------------->
               
               		 <div class="category" >
					 <?php /*?><div id="catg_loader" align="center"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading Categories...</div><?php */?>
                     <ul class="cssmenu">
						<li class="has-sub"><a href="#"> Categories </a>
							 <ul id="product_catgdiv">
                             
                              </ul>
							</li>
							
						</ul>
                     
                     
					</div>
               
               <!---------------------------------subcategory list end------------------------------------------------>
           
				<div class="section-info">
				<h3 class="tittle">View Products</h3>
                 <!---------------------------------Product Detail Start------------------------------------------------>
                 <div class="product-more" id="ajaxprodload_divid" >
                 <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>
                 </div>
                  <!---------------------------------Product Detail end------------------------------------------------>
                   <div id="view_more_dv" >
            
        			</div>
				   
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>
        
   
 <?php include "footer.php"; ?>      