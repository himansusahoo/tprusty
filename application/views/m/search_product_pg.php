<?php include 'header.php'; ?>

<?php
		$search_title=trim(str_replace(' ','%20',$this->uri->segment(2)));
        $curl_strng=SOLR_BASE_URL.SOLR_CORE_NAME."/select?indent=on&q=".$search_title."&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=1&start=0";
						
			
			$curl2 = curl_init($curl_strng);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			$product_data_sco = json_decode($output, true);
			//echo '<pre>';print_r($product_data_sco);exit;
			if($product_data_sco['response']['numFound']==0){
				if(count($product_data_sco['spellcheck']['collations'])>2)
				{
				$sugword=$product_data_sco['spellcheck']['collations'][1];
				}else{
						$sugword=$search_title;
					 }
				
				$searchsuggst_txt=trim(str_replace(' ','%20',$sugword));	
				//echo $searchsuggst_txt;exit;
				$curl_strng=SOLR_BASE_URL.SOLR_CORE_NAME."/select?indent=on&q=".$searchsuggst_txt."&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=50&start=0";
				
				
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
		<meta name="Description" content="<?php echo uc_first(DOMAIN_NAME).':'.str_replace("%20"," ",$this->uri->segment(2)).','.$category_lvl3 ;?>">
		<meta name="Keywords" content="<?php echo str_replace("%20"," ",$this->uri->segment(2)).','.$category_lvl3.','.uc_first(DOMAIN_NAME) ;?>" />
		<title><?php echo uc_first(DOMAIN_NAME).':'.str_replace("%20"," ",$this->uri->segment(2).'-'.$category_lvl3) ;?></title>
<?php }else{?>
		<meta name="Description" content="<?php echo uc_first(DOMAIN_NAME).':'.str_replace("%20"," ",$this->uri->segment(2)) ;?>">
		<meta name="Keywords" content="<?php echo str_replace("%20"," ",$this->uri->segment(2)).','.uc_first(DOMAIN_NAME) ;?>" />
		<title><?php echo uc_first(DOMAIN_NAME).':'.str_replace("%20"," ",$this->uri->segment(2)) ;?></title>
<?php }?>
        
      <link rel="canonical" href="<?php echo base_url().'search-by/'.$this->uri->segment(2); ?>"/>
<script type="text/javascript" src="<?php echo base_url()?>new_js/js/jquery.visible.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.view-fifth {
    margin: auto;
    width: 210px;
    height: 210px;
    padding: 10px;
    text-align: center!important;
    align-content: stretch;
    align-items: stretch;
    display: flex;
    margin: auto;
}
.view-fifth a {
    align-content: center;
    align-items: center;
    display: flex;
    flex: 1 1 0;
    text-align: center;
}
.view-fifth img {
    display: inline-block;
    height: auto;
    width: auto;
    margin: 0 auto;
    max-height: 180px;
    max-width: 170px;
}
#slider1,#slider2,#slider3{margin:30px 0 0;overflow:hidden;position:relative;padding:0 25px 10px}
#slider1 .viewport,#slider2 .viewport,#slider3 .viewport {height:235px;overflow:hidden;position:relative}
#slider1 .buttons,#slider2 .buttons,#slider3 .buttons{
	border-radius: 35px;
    width: 20px;
    height: 20px;
    display: block;
    line-height: 18px;
    font-size: 15px;
    top: 35%;
    text-decoration: none;
    font-weight: 700;
}
#slider1 .buttons{background:#ed2541 !important;position:absolute;left:0;color:#fff}
#slider1 .next{right:0;left:auto;top:35%}
#slider1 .buttons:hover{color:#fff;background:#f1f1f1}
#slider2 .buttons{background:#ed2541;position:absolute;left:0;color:#fff}
#slider2 .next{right:0;left:auto;top:35%}
#slider2 .buttons:hover{color:#ed2541;background:#f1f1f1}
#slider1 .disable,#slider2 .disable{visibility:hidden}
#slider1 .overview,#slider2 .overview{list-style:none;position:absolute;padding:0;margin:0;left:0; top: 0;}
#slider3,#slider3 .viewport{position:relative;overflow:hidden}
#slider1 .overview li,#slider2 .overview li,#slider3 .overview li{float:left;margin:5px;padding:0px;width:170px;height:235px; border:none;}
#slider1 .overview li:hover i,#slider2 .overview li,#slider3 .overview li:hover i{color:#6bb700}
#slider3{height:48%;margin:30px 0 0;padding:0 50px 10px}
#slider3 .viewport{height:310px}
#slider3 .buttons{background:#ed2541;border-radius:35px;display:block;position:absolute;top:35%;left:0;width:35px;height:35px;color:#fff;font-weight:700;text-align:center;line-height:35px;text-decoration:none;font-size:22px}
#slider3 .next{right:0;left:auto;top:35%}
#slider3 .buttons:hover{color:#ed2541;background:#f1f1f1}
#slider3 .disable{visibility:hidden}
#slider3 .overview{position:absolute;padding:0;margin:0;left:0; top: 0}
#slider3 .overview li{float:left;margin:0 10px;padding:10px;width:12.4%}
#slider3 .overview li:hover{}
#slider3 .overview li:hover i{color:#6bb700}
#slider1 .overview {
    list-style: none;
    position: absolute;
    padding: 0;
    margin: 0;
    width: 180px;
    left: 0;
    top: 0;
}
.wish-list {
    position: absolute;
    top: 3px;
    margin-left: 177px;
}
.wish_spn {
    color: #666;
}
.price {
    color: #ed2541 !important;
    /* float: right; */
    width: 100% !important;
    height: 25px !important;
    text-align: right !important;
	display: inline!important;
    /* font-size: 16px; */
    padding: 7px 1px!important;
    position: inherit!important;
}
.sponsored-agile-products {
    max-height: 350px;
    min-height: 250px;
    padding: 5px;
    border:none;
    position: relative;
    overflow: hidden;
    -webkit-transition: .5s all;
    -moz-transition: .5s all;
    -o-transition: .5s all;
    -ms-transition: .5s all;
    transition: .5s all;
}
.sponsored-image{
	height:150px;max-width: 100%;margin: auto;text-align: center;
}
.sponsored-h5{
	text-align:left; margin-left:0; font-family: 'SegoeUI' !important; line-height: 16px;
}
@media (min-width: 0px) and (max-width: 320px) {
#slider1 .overview li, #slider2 .overview li, #slider3 .overview li {
    width: 255px;
}
.sponsored-image{
	height:177px;
}
.sponsored-h5{ text-align:center;}
#slider1 .overview li,#slider2 .overview li,#slider3 .overview li{height:255px;}
#slider1 .viewport,#slider2 .viewport,#slider3 .viewport {height:255px;}
#slider1 .overview {
    margin: auto;
    width: 270px;
}
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
	height: 244px;
}
#slider02 .viewport {
    height: 265px;
    overflow: hidden;
    position: relative;
}
.prduct-sl-1st{
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
#slider1 .viewport {
    height: 79px;
    overflow: hidden;
    position: relative;
}
#slider01 .viewport {
    height: 165px;
    overflow: hidden;
    position: relative;
    width: 237px;
}
.brands-name img {
    width: 100%;
    margin: auto;
    height: auto;
    max-height: 170px;
}.panel-body ul li {
    height: 150px;
    width: 46%;
    float: left;
    border: 1px solid #f5f5f5;
    margin: 5px;
}
.product-sl-image-held img {
    max-width: 100%;
/*    height: auto;
*/    max-height: 95px;
}

.discount {
    /* border: 1px solid #ed2541; */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    text-align: center;
    /*position: absolute;
    margin-top: -80px;*/
    background: #ed2541;
    border: 1px solid #ed2541;
    color: #fff;
    font-weight: bold;
	    margin-right: 46px;
		margin-top: -10px;
}
.discount p{
	font-size: 13px;line-height: 14px;
    letter-spacing: 1px;
}
.pad-res {
       margin-bottom: 13px;
    /* margin-top: 15px; */
    border-bottom: 1px solid #ccc;
    background: #fff;
	    padding: 5px;
}
i.fa.fa-list {
    font-size: 25px;
}
i.fa.fa-th-large{font-size: 25px;}
a.button.act {
    background: #0066c0;
    padding: 11px 7px 2px;
    color: #fff;
}
.view-search {
    position: relative;
    text-align: center;
    height: 100px;
    vertical-align: middle;
}
.search-view-search img {
    height: auto!important;
    max-width: 100% !important;
    max-height: 100px;
}
/*sujit*/
.labeldisabled:after {
    position: absolute;
    content: "";
    display: block;
    background: white;
    opacity: 0.5;
    z-index: 999;
    left: -34px;
    top: -5px;
    bottom: 0;
	height:25px;
    right: 0;
  }
/*sujit*/
</style>
<script type="text/javascript" src="<?php echo base_url()?>new_js/js/jquery.visible.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_js/js/jquery.tinycarousel.js"></script>
<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel({ interval: true });
			$('#slider2').tinycarousel({ interval: true });
		});
		
</script>



<script>

/*function redirectCategoryPage(category_id,cat_name){
	window.location.href='<?php //echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+category_id;
}*/

function redirectCategoryPage(cat_name){
	window.location.href='<?php echo base_url();?>'+cat_name.replace(" ","-");
}
</script>		




<script>

<?php //if($row>0){ ?>
/* $(document).ready(function(){
	 loadfirstproductsearchajax();
	 loadajax();
   
});*/
<?php //}  ?>



/*function loadajax(){
 
 //var srch_data ="<?php  //echo $_GET['search'];  ?>";
 var srch_data ="<?php  //echo $this->uri->segment(2); ?>";
 
 //alert(srch_data);return false;
 //$("#catg_loader").css('display','block');
  $.ajax({ 
    url:'<?php //echo base_url().'Product_description/product_searchcategory_ajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     //$("#catg_loader").css('display','none');
	 $("#product_catgdiv").html(data);
	 
    }
  });
}*/
</script>



<script>

/* $(document).ready(function(){
	 //loadfirstproductsearchajax();
	 //loadajax();
   
});

function loadfirstproductsearchajax(){
 
 //var srch_data ="<?php  //echo $_GET['search'];  ?>";
 var srch_data ="<?php  //echo $this->uri->segment(2);  ?>";
 
 
 
  $.ajax({ 
    url:'<?php //echo base_url().'Product_description/search_firstproductloadajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     $("#firstproduct_loader").css('display','none');
	 $("#ajaxprodload_divid").html(data);
	 
    }
  });
}*/
</script>


<!------------------------------------- menu1 & menu2 visibility Start ------------------------------------->
<script>
	 function menuvisibility(val) {
		 //alert(val);
		if(val=='menu2'){
			
			//alert('Menu1');
			document.getElementById('menu2').style.display="block";
			document.getElementById('menu1').style.display="none";
			//$("#act1").toggleClass("act"); 
			$("#act1").removeClass("act");
			$("#act2").addClass('act');
		}
		if(val=='menu1'){
			//alert('Menu2');
			document.getElementById('menu1').style.display="block";
			document.getElementById('menu2').style.display="none";
			//$("#act2").toggleClass("act"); 
			$("#act2").removeClass("act");
			$("#act1").addClass('act');
		}
	 }
</script>
<!------------------------------------- menu1 & menu2 visibility End ------------------------------------->
<!-------------------------- Show First ajax Data append start -------------------------->
<script>

 $(document).ready(function(){
	 loadfirstproductsearchajax();
	 $("#act1").addClass('act');
	 document.getElementById('ft1').checked = true;
  
});



function loadfirstproductsearchajax(){
 
 
<?php if($this->uri->segment(3)==''){ ?>
 var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
 
  //$("#viewmorebtns_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description/search_firstproductloadajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
		//alert(data);
	 var $holder = $('<div/>').html(data);
     $("#firstproduct_loader").css('display','none');
	 //$("#ajaxprodload_divid").html(data);
	 $('#product_countno').html($('#htmlcount' , $holder).html());
	 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
	 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
	 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
	 
	// var $holder = $('<div/>').html(responseHtml);
	 //$('#coupon').html($('#coupon', $holder).html());
    }
  });
  <?php }else{?>
  search_click_filterdata()
  <?php }?>
}
</script>
<!-------------------------- Show First ajax Data append end -------------------------->


<!-------------------------- loadviewmorebuttonajax start -------------------------->
<script>
$(document).ready(function(){
    setTimeout(function(){
       //loadviewmorebuttonajax();
     },100); // milliseconds
});

function loadviewmorebuttonajax(){

 //var srch_data ="<?php  //echo $_GET['search'];  ?>";
 var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
 
 //alert('sujit');
  //$("#viewmorebtns_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description/product_searchvewmorebtn_ajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     //$("#viewmorebtns_loader").css('display','none');
	 //alert(data);
	 $("#view_more_dv").html(data);
	 
    }
  });
}
</script> 
<!-------------------------- loadviewmorebuttonajax end -------------------------->

<!-------------------------- search_click_filterdata suggestion Start -------------------------->
<script>
function search_click_filterdata()
{
	//alert("sujit");
	var qsearch_title='<?php echo str_replace('/','',base64_decode($this->uri->segment(3)));?>';
	//alert(qsearch_title);
	var fqq='<?php echo str_replace('/','',base64_decode($this->uri->segment(4)));?>';
	//alert(fqq);
	$.ajax({
		url:'<?php echo base_url().'Product_description/search_click_filterdata' ?>',
		method:"post",
		data:{fqq:fqq,qsearch_title:qsearch_title,start_from:'0'},
		success:function(data){
			//alert(data);
			//$("#ajaxprodload_divid").html(data);
			$('#firstproduct_loader').css('display','none');
		
			var $holder = $('<div/>').html(data);
			$('#product_countno').html($('#htmlcount' , $holder).html());
			$('#ajaxprodload_divid').html($('#html1' , $holder).html());
	 		$('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
			$('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
			
			}
		});
}
</script>
<!-------------------------- search_click_filterdata suggestion end -------------------------->


<!------------------------------ view more lastScrollTop Start ------------------------------------------->
<script>
var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   
   if (st > lastScrollTop)
   {       
   
			 if($('#view_more_dv').visible(true) && $('#scrol_tracktxtbox').val()!='' )
			 {
				 
				//alert('hi');
				$('#viewmore_prodbtnid')[0].click();
				$('#scrol_tracktxtbox').val('');
				//alert('test'); 
			} 
		
   
   
   } else {
      // upscroll code
   }
   lastScrollTop = st;
   
});


</script> 
<!------------------------------ view more lastScrollTop End -------------------------------------------->

<!------------------------------- Show More Data append start ----------------------------------->
<script>

function ShowMoreData(result_no){
	//alert(result_no);return false;
	var low_price = document.getElementById("low_price").value;
	var high_price = document.getElementById("high_price").value;
	if(low_price=="" && high_price==""){
	
	var title ="<?php  echo $this->uri->segment(2);  ?>";
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	
	
	
	if(checked_product==''){
		
			var radiochecked_product = $('input[name="ul_liradio"]:checked').map(function(_, el){
       		return $(el).val();
   			}).get();
	
		  //alert(radiochecked_product);return false;
		  if(radiochecked_product=='' || radiochecked_product=='nocatlvlradiobtn')
		  {
			
			
			<?php if($this->uri->segment(3)!=''){ ?>
<!------------------------- segmented3 filter more start ----------------------------->				
			var sort_val = document.getElementById("pricesort_textbox").value;
			if(sort_val=='')
			{
<!------------------ segmented3 normal more start ----------------------------->				
			var qsearch_title='<?php echo str_replace('/','',base64_decode($this->uri->segment(3)));?>';
			//alert(qsearch_title);
			//var fqq='<?php //echo base64_decode($this->uri->segment(4));?>';
			var fqq='<?php echo str_replace('/','',base64_decode($this->uri->segment(4)));?>';
			//alert(fqq);
			var result_no = parseInt(result_no);
			//alert(result_no);
			var numItems = parseInt($('.product-grids').length);
			//alert(numItems);
	$.ajax({
		url:'<?php echo base_url(); ?>Product_description/show_more_search_click_filterdata',
		method:'post',
		data:{fqq:fqq,qsearch_title:qsearch_title,start_from:numItems},
		beforeSend: function(){
			$('.view_mor').hide();
			$('#lodr_img').show();
			//$('.list_view_lodr_img').show();
		},
		complete: function(){
			$('#lodr_img').hide();
			//$('.list_view_lodr_img').hide();
			//$('.view_mor').show();
			
		},
		success:function(result){
			//alert(result);
			var $holdermore = $('<div/>').html(result);
			//$('.grids_of_4').append(result);
			//$('.grids_of_4').append(result);
			$('.product-more').append($('#htmlmore1' , $holdermore).html());
			$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
			$('#scrol_tracktxtbox').val('wait to scroll');
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
<!------------------ segmented3 normal more end ----------------------------->	
			}else{
<!------------------ segmented3 price short more start ----------------------------->
						//alert('segmented3 price short more start');
						var qsearch_title='<?php echo base64_decode($this->uri->segment(3));?>';
						var fqq='<?php echo base64_decode($this->uri->segment(4));?>';
						var result_no = parseInt(result_no);
						var numItems = parseInt($('.product-grids').length);
						//alert(numItems);
						//alert(sort_val);
						//alert(title);
						$.ajax({
								url:'<?php echo base_url(); ?>Product_description/show_more_pricesortajax',
								method:'post',
								data:{search_title:title,sort_val:sort_val,start_from:numItems,},
								beforeSend: function(){
									$('.view_mor').hide();
									$('#lodr_img').show();
									//$('.list_view_lodr_img').show();
								},
								complete: function(){
									$('#lodr_img').hide();
									//$('.list_view_lodr_img').hide();
									//$('.view_mor').show();
									
								},
								success:function(result){
									//alert(result);
									
									//$('.grids_of_4').append(result);
									var $holdermore = $('<div/>').html(result);
									$('.product-more').append($('#htmlmore1' , $holdermore).html());
									$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
									$('#scrol_tracktxtbox').val('wait to scroll');
									if(numItems == result_no){
										$('.view_mor').hide();
										$('#view_more_dv').html('<span>No more product available!</span>');
									}
								}
							});
<!------------------ segmented3 price short more start ----------------------------->
				   
				
				
				
				 }
<!------------------------- segmented3 filter more end ----------------------------->				
	<?php }else{?> 
<!------------------------- normal filter more start ----------------------------->	
	var sort_val = document.getElementById("pricesort_textbox").value;
	if(sort_val=='')
	{
<!------------------------- normal filter more start ----------------------------->		
	//alert('u r in normal search more start');
	var numItems = parseInt($('.product-grids').length);
	var result_no = parseInt(result_no);
	//alert(result_no);
	$.ajax({
		url:'<?php echo base_url(); ?>Product_description/show_more_search_product_data',
		method:'get',
		data:{from:numItems,title:title},
		beforeSend: function(){
			$('.view_mor').hide();
			$('#lodr_img').show();
			//$('.list_view_lodr_img').show();
		},
		complete: function(){
			$('#lodr_img').hide();
			//$('.list_view_lodr_img').hide();
			//$('.view_mor').show();
			
		},
		success:function(result){
			//alert(result);
			var $holdermore = $('<div/>').html(result);
			//$('.grids_of_4').append(result);
			//$('.grids_of_4').append(result);
			$('.product-more').append($('#htmlmore1' , $holdermore).html());
			$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
			$('#scrol_tracktxtbox').val('wait to scroll');
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
<!------------------------- normal filter more start ----------------------------->	
	}else{
<!------------------------ u r in normal price short search more start ------------------------>
			//alert('u r in normal price short search more');
			var numItems = parseInt($('.product-grids').length);
			//alert(numItems);
			//alert(sort_val);
			//alert(title);
			$.ajax({
					url:'<?php echo base_url(); ?>Product_description/show_more_pricesortajax',
					method:'post',
					data:{search_title:title,sort_val:sort_val,start_from:numItems,},
					beforeSend: function(){
						$('.view_mor').hide();
						$('#lodr_img').show();
						//$('.list_view_lodr_img').show();
					},
					complete: function(){
						$('#lodr_img').hide();
						//$('.list_view_lodr_img').hide();
						//$('.view_mor').show();
						
					},
					success:function(result){
						//alert(result);
						
						//$('.grids_of_4').append(result);
						var $holdermore = $('<div/>').html(result);
						$('.product-more').append($('#htmlmore1' , $holdermore).html());
						$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
						$('#scrol_tracktxtbox').val('wait to scroll');
						if(numItems == result_no){
							$('.view_mor').hide();
							$('#view_more_dv').html('<span>No more product available!</span>');
						}
					}
				});
<!------------------------ u r in normal price short search more end ------------------------>
		
		
		 }
<!------------------------- normal filter more end ----------------------------->	
	<?php }?>
		  }else{
<!---------------------------- radio product more start ----------------------------------------------->			  				
		 	var sort_val = document.getElementById("pricesort_textbox").value;
			//alert(sort_val);
			if(sort_val!='')
			{
<!---------------------------- radio product price sort more start ----------------------------------------------->						
						//alert("radio product price sort more start");
						
						  var numItems = parseInt($('.product-grids').length);
						  var result_no = parseInt(result_no);
						  var radiochecked_product=radiochecked_product.toString();
						  
						  //alert(result_no);
						  $.ajax({
							  url:'<?php echo base_url(); ?>Product_description/ul_li_radio_pricesortmore',
							  method:'post',
							  data:{start_from:numItems,search_title:title,sort_val:sort_val,fq:radiochecked_product},
							  beforeSend: function(){
								  $('.view_mor').hide();
								  $('#lodr_img').show();
								  //$('.list_view_lodr_img').show();
							  },
							  complete: function(){
								  $('#lodr_img').hide();
								  //$('.list_view_lodr_img').hide();
								  //$('.view_mor').show();
								  
							  },
							  success:function(result){
								  //alert(result);
								  //$('.grids_of_4').append(result);
								  var $holdermore = $('<div/>').html(result);
								  $('.product-more').append($('#htmlmore1' , $holdermore).html());
								  $('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
								  $('#scrol_tracktxtbox').val('wait to scroll');
								  if(numItems == result_no){
									  $('.view_mor').hide();
									  $('#view_more_dv').html('<span>No more product available!</span>');
								  }
							  }
						  });
<!---------------------------- radio product price sort more end ----------------------------------------------->					
			}else{
<!---------------------------- radio product normal more start ----------------------------------------------->				
			//alert("normal radio more part")
			var numItems = parseInt($('.product-grids').length);
			//alert(numItems);
			var result_no = parseInt(result_no);
			//alert(result_no);
			var radiochecked_product=radiochecked_product.toString();
			//alert(result_no);
			$.ajax({
				url:'<?php echo base_url(); ?>Product_description/click_ul_lifilter_moredataajax',
				method:'post',
				data:{start_from:numItems,search_title:title,fq:radiochecked_product},
				beforeSend: function(){
					$('.view_mor').hide();
					$('#lodr_img').show();
					//$('.list_view_lodr_img').show();
				},
				complete: function(){
					$('#lodr_img').hide();
					//$('.list_view_lodr_img').hide();
					//$('.view_mor').show();
					
				},
				success:function(result){
					//alert(result);
					var $holdermore = $('<div/>').html(result);
					//$('.grids_of_4').append(result);
					//$('.grids_of_4').append(result);
					$('.product-more').append($('#htmlmore1' , $holdermore).html());
					$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
					$('#scrol_tracktxtbox').val('wait to scroll');
					if(numItems == result_no){
						$('.view_mor').hide();
						$('#view_more_dv').html('<span>No more product available!</span>');
					}
				}
			});
<!---------------------------- radio product normal more end ----------------------------------------------->			
		 }
<!---------------------------- radio product more end ----------------------------------------------->  
			   }
		  
		
		
		}else{
<!---------------------------- chkd product more start ----------------------------------------------->

			var sort_val = document.getElementById("pricesort_textbox").value;
			if(sort_val!='')
			{
<!---------------------------- chkd product price sort more start ----------------------------------------------->				
				//alert('chkd product price sort more start');
				var numItems = parseInt($('.product-grids').length);
				$.ajax({
						  url:'<?php echo base_url(); ?>Product_description/show_more_chk_box_pricesort',
						  method:'post',
						  data:{checked_product:checked_product,search_title:title,sort_val:sort_val,start_from:numItems},
						  beforeSend: function(){
							  $('.view_mor').hide();
							  $('#lodr_img').show();
							  //$('.list_view_lodr_img').show();
						  },
						  complete: function(){
							  
							  $('#lodr_img').hide();
							  //$('.list_view_lodr_img').hide();
							  //$('.view_mor').show();
							  
						  },
						  success:function(result){
							  //alert(result);
							  //$('.grids_of_4').append(result);
							  var $holdermore = $('<div/>').html(result);
							  $('.product-more').append($('#htmlmore1' , $holdermore).html());
							  $('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
							  $('#scrol_tracktxtbox').val('wait to scroll');
							  if(numItems == result_no){
								  $('.view_mor').hide();
								  $('#view_more_dv').html('<span>No more product available!</span>');
							  }
						  }
					  })
<!---------------------------- chkd product price sort more end --------------------------------------------->					  
			}else{
<!---------------------------- chkd product normal more start ----------------------------------------------->			
			var numItems = parseInt($('.product-grids').length);
			//alert(numItems);
			$.ajax({
					url:'<?php echo base_url(); ?>Product_description/show_more_filter_search_product_data',
					method:'post',
					data:{checked_product:checked_product,search_title:title,start_from:numItems},
					beforeSend: function(){
						$('.view_mor').hide();
						$('#lodr_img').show();
						//$('.list_view_lodr_img').show();
					},
					complete: function(){
						
						$('#lodr_img').hide();
						//$('.list_view_lodr_img').hide();
						//$('.view_mor').show();
						
					},
					success:function(result){
						//alert(result);
						var $holdermore = $('<div/>').html(result);
						//$('.grids_of_4').append(result);
						//$('.grids_of_4').append(result);
						$('.product-more').append($('#htmlmore1' , $holdermore).html());
						$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
						$('#scrol_tracktxtbox').val('wait to scroll');
						if(numItems == result_no){
							$('.view_mor').hide();
							$('#view_more_dv').html('<span>No more product available!</span>');
						}
					}
				});
<!---------------------------- chkd product normal more start ----------------------------------------------->			
		 }
<!---------------------------- chkd product more end ----------------------------------------------->			 
		}
	}else{
	 	price_filtermore(low_price,high_price,result_no);
	  }
}


</script>

<!------------------------------- Show More Data append end ----------------------------------->



<!-------------------------- Show mtree loadfilter_product start -------------------------->
<script>
$(document).ready(function(){
   //loadmtreefilter_product();
    //setTimeout(function(){
       loadmtreefilter_product();
     //},2000); // milliseconds
	 
	 
});


function loadmtreefilter_product()
{	
	//alert('hi');
	var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
	$.ajax({
		url:'<?php echo base_url().'Product_description/filter_product_mtree' ?>',
		method:"post",
		data:{search_data:srch_data},
		success:function(data){
			//alert(data);
			$("#mtreefb_loader").css('display','none');
			$(".filter_searchdatamtree").html(data);
			}
		});
}
</script>
<!-------------------------- Show mtree loadfilter_product end -------------------------->
<!-------------------------- search checkbox click data display start -------------------------->
<script>
function filter_dataajax()
{
	//alert("filter_dataajax");
	var ptradiock = $('input[name="radiofiltertypename"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	if(ptradiock=='radiofiltertypeval'){
	arrck();
	}
	if(ptradiock=='radiomtreeval'){
	arrck2();
	}
	document.getElementById('low_price').value='';
	document.getElementById('high_price').value='';
	
	
	
	document.getElementById('pricesort_textbox').value='';
	document.getElementById("clearallid").style.display = "block";
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	//alert(checked_product);
	
	if(checked_product!='')
	{
	var search_title='<?php echo $this->uri->segment(2);?>';
	$('#firstproduct_loader').css('display','block');
	//alert(search_title);return false;
	$.ajax({
		url:'<?php echo base_url().'Product_description/filter_product_list' ?>',
		method:"post",
		data:{checked_product:checked_product,search_title:search_title,start_from:'0'},
		beforeSend: function(){
						$("#filter_searchdatamtree").addClass('disabled');
						$('#ajaxprodload_divid').hide();
						$('#ajaxprodload_dividlist').hide();
						$('#lodr_img').show();
					},
		/*complete: function(){
						$('#ajaxprodload_divid').show();
						$('#ajaxprodload_dividlist').show();
					},*/
		complete: function(){
						//loadviewmorebuttonajax();
						$("#filter_searchdatamtree").removeClass('disabled');
						$('#ajaxprodload_divid').show();
						$('#ajaxprodload_dividlist').show();
						$('#lodr_img').hide();
						},			
		success:function(data){
			$('#firstproduct_loader').css('display','none');
		
			var $holder = $('<div/>').html(data);
			$('#product_countno').html($('#htmlcount' , $holder).html());
			$('#ajaxprodload_divid').html($('#html1' , $holder).html());
	 		$('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
			$('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
			
			}
		});
	}else{
			click_ul_lifilter()
		 }
}
</script>
<!-------------------------- search checkbox click data display end -------------------------->
<!-------------------------- click a mtree ul li filter start -------------------------->
<script>
function click_ul_lifilter()
{
	
	var radiochecked_product = $('input[name="ul_liradio"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	var search_title='<?php echo $this->uri->segment(2);?>';
	//alert(radiochecked_product);
	radiochecked_product=radiochecked_product.toString();
	
		 $.ajax({ 
				url:'<?php echo base_url().'Product_description/click_ul_lifilter_dataajax' ?>',
				method:"post",
				data:{search_title:search_title,fq:radiochecked_product},
				
				beforeSend: function(){
					$("#filter_searchdatamtree").addClass('disabled');
					$('#ajaxprodload_divid').hide();
					$('#ajaxprodload_dividlist').hide();
					$('#lodr_img').show();  
					},
				complete: function(){
					$("#filter_searchdatamtree").removeClass('disabled');
					$('#ajaxprodload_divid').show();
					$('#ajaxprodload_dividlist').show();
					$('#lodr_img').hide();
					},
				   
				success:function(data){
					//alert(data);
					//$("#ajaxprodload_divid").html(data);
				 var $holder = $('<div/>').html(data);
				 $("#firstproduct_loader").css('display','none');
				 //$("#ajaxprodload_divid").html(data);
				 $('#product_countno').html($('#htmlcount' , $holder).html());
				 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
				 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
				 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
				// var $holder = $('<div/>').html(responseHtml);
				 //$('#coupon').html($('#coupon', $holder).html());
				}
			  });
	
}
</script>
<!-------------------------- click a mtree ul li filter end -------------------------->
<!-------------------------- clear_all start -------------------------->
<script>
function clear_all()
{
	//alert('clear_all');
	 location.reload();
}
</script>
<!-------------------------- clear_all end -------------------------->
<!-------------------------- product_type filter start -------------------------->
<script>
$(document).ready(function(){
       product_type();
	   //alert('fff');
});


function product_type()
{	
	//alert('hi');
	var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
	$.ajax({
		url:'<?php echo base_url().'Product_description/filter_product_type' ?>',
		method:"post",
		data:{search_data:srch_data},
		success:function(data){
			//alert(data);
			$("#search-left").html(data);
			}
		});
}
</script>
<!-------------------------- product_type filter end -------------------------->
<!-------------------------- remove filter_data start -------------------------->
<script>
function removefilter_data(id)
{
	//alert("hi");
	//alert(id);
	var namev =document.getElementById('filter_productId'+id).value;
	//alert(namev);
	var fields = namev.split('|');
	var filterattribute1 = fields[0];
	var filterattribute2 = fields[1];
	var filterattribute3 = fields[2];
	
	
	
	if(document.getElementById("filter_productId"+id).checked)
	{
		
	 var p = document.createElement('span');

    p.innerHTML = '<span class="rst_spn removespan_'+id+'" onclick="removespanattr('+"'"+id+"'"+')" >'+filterattribute3+ ' <i class="fa fa-times close_filter" aria-hidden="true"></i></span>';

     document.getElementById('span_val').appendChild(p);
	}else{
		
		$(".removespan_"+id).remove();
		}
}
</script>
<!-------------------------- remove filter_data end -------------------------->
<!-------------------------- after select checkbox remove span start -------------------------->
<script>
function removespanattr(id)
{
	//alert("sujit");
	//alert(id);
	document.getElementById("filter_productId"+id).checked = false;
	$(document).ready(function(){
    setTimeout(function(){
       filter_dataajax(id)
     },1); // milliseconds
	});
	$(document).ready(function(){
    setTimeout(function(){
       $(".removespan_"+id).remove();
     },1000); // milliseconds
	});
	 
}
</script>
<!-------------------------- after select checkbox remove span end -------------------------->
<!----------------------------------- pricesort start --------------------------------------->
<script>
function pricesort(sort_val)
{
	//alert("pricesort");
	//alert(sort_val);
	document.getElementById("pricesort_textbox").value=sort_val;
	
	$('#dd').attr('checked', false);
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	if(checked_product!=''){
<!----------------------------------- u r in checked_product price sort start ----------------------------->	
		//alert('u r in checked_product price sort');
		//alert(checked_product);
		var search_title ="<?php  echo $this->uri->segment(2);  ?>";
		$.ajax({
				url:'<?php echo base_url().'Product_description/chk_box_pricesort' ?>',
				method:"post",
				data:{checked_product:checked_product,search_title:search_title,sort_val:sort_val,start_from:'0'},
				beforeSend: function(){
								$("#filter_searchdatamtree").addClass('disabled');
								$('#ajaxprodload_divid').hide();
								$('#ajaxprodload_dividlist').hide();
								$('#lodr_img').show();
							},
				
				complete: function(){
								loadviewmorebuttonajax();
								$("#filter_searchdatamtree").removeClass('disabled');
								$('#ajaxprodload_divid').show();
								$('#ajaxprodload_dividlist').show();
								$('#lodr_img').hide();
								},			
				success:function(data){
					$('#firstproduct_loader').css('display','none');
					//alert(data);
					//$("#ajaxprodload_divid").html(data);
					var $holder = $('<div/>').html(data);
					$('#count_divid').html($('#htmlcount' , $holder).html());
					$('#ajaxprodload_divid').html($('#html1' , $holder).html());
					$('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
					$('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
					
					}
			  })
<!------------------------------- u r in checked_product price sort end ------------------------------------->		
		}else{
				
				var radiochecked_product = $('input[name="ul_liradio"]:checked').map(function(_, el){
       				return $(el).val();
   					}).get();
	
	//alert(radiochecked_product);return false;
					if(radiochecked_product=='')
					{
						
						var search_title ="<?php  echo $this->uri->segment(2);  ?>";
						<?php if($this->uri->segment(3)!=''){ ?>
						//alert('u r in segment3 price sort');
						var qsearch_title='<?php echo str_replace('/','',base64_decode($this->uri->segment(3)));?>';
						var fqq='<?php echo str_replace('/','',base64_decode($this->uri->segment(4)));?>';
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/pricesortajaxseg3' ?>',
									method:"post",
									data:{search_title:qsearch_title,fqq:fqq,sort_val:sort_val,start_from:0},
									
									
									beforeSend: function(){
										$("#act3").addClass('disabled');
										$('#ajaxprodload_divid').hide();
										$('#ajaxprodload_dividlist').hide();
										$('#lodr_img').show();  
										},
									complete: function(){
										$("#act3").removeClass('disabled');
										$('#ajaxprodload_divid').show();
										$('#ajaxprodload_dividlist').show();
										$('#lodr_img').hide();
										},
									   
									success:function(data){
										//alert(data);
										//$("#ajaxprodload_divid").html(data);
									 var $holder = $('<div/>').html(data);
									 $("#firstproduct_loader").css('display','none');
									 $('#count_divid').html($('#htmlcount' , $holder).html());
									 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
									 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
									 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
									
									}
								  });
						
						
						<?php }else{ ?>
								//alert('u r in normal price sort');
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/pricesortajax' ?>',
									method:"post",
									data:{search_title:search_title,sort_val:sort_val,start_from:0},
									
									beforeSend: function(){
										//$("#act3").addClass('disabled');
										$('#ajaxprodload_divid').hide();
										$('#ajaxprodload_dividlist').hide();
										$('#lodr_img').show();  
										},
									complete: function(){
										//$("#act3").removeClass('disabled');
										$('#ajaxprodload_divid').show();
										$('#ajaxprodload_dividlist').show();
										$('#lodr_img').hide();
										
										},
									   
									success:function(data){
										//alert(data);
										//$("#ajaxprodload_divid").html(data);
									 var $holder = $('<div/>').html(data);
									 $("#firstproduct_loader").css('display','none');
									 $('#count_divid').html($('#htmlcount' , $holder).html());
									 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
									 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
									 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
									
									}
								  });
							<?php } ?>
						
						
						
					}else{
							//alert('u r in radio_product price sort');
							//nocatlvlradiobtn
							//alert(radiochecked_product);
							var search_title ="<?php  echo $this->uri->segment(2);  ?>";
							
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/ul_li_radio_pricesort' ?>',
									method:"post",
									data:{search_title:search_title,fq:radiochecked_product,sort_val:sort_val,start_from:0},
									
									beforeSend: function(){
										$("#filter_searchdatamtree").addClass('disabled');
										$('#ajaxprodload_divid').hide();
										$('#ajaxprodload_dividlist').hide();
										$('#lodr_img').show();  
										},
									complete: function(){
										$("#filter_searchdatamtree").removeClass('disabled');
										$('#ajaxprodload_divid').show();
										$('#ajaxprodload_dividlist').show();
										$('#lodr_img').hide();
										},
									   
									success:function(data){
										//alert(data);
										//$("#ajaxprodload_divid").html(data);
									 var $holder = $('<div/>').html(data);
									 $("#firstproduct_loader").css('display','none');
									 $('#count_divid').html($('#htmlcount' , $holder).html());
									 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
									 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
									 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
									 
									
									}
								  });
							
						 }
				
				
				
			 }
	
	
	
	
	
	
	
	
	
	
}
</script>
<!------------------------------------ pricesort end -------------------------------------->
<!--st & nd _block_none start -->
<script>
function st_block_none(li_id)
{
	//alert('st_block_none');
	document.getElementById('radiotextbox'+li_id).checked = true;
	
	$('#st_block_nonetextbox').val(li_id);
	$("#backtoall").css('display','inline-block');
	$(".st_block_none").css('display','none');
	$("#st_"+li_id).css('display','block');
}
function nd_block_none(li_id)
{
	//alert('nd_block_none');
	document.getElementById('radiotextbox'+li_id).checked = true;
	
	$('#nd_block_nonetextbox').val(li_id);
	$(".spanclass").css('display','inline-block');
	$(".nd_block_none").css('display','none');
	$("#nd_"+li_id).css('display','block');
}

function backtoall()
{
	var li_id=$("#st_block_nonetextbox").val()
	if(li_id!=''){
	$('#stan_'+li_id)[0].click();
	$('#st_block_nonetextbox').val('');
	}
	var li_id=$("#nd_block_nonetextbox").val()
	if(li_id!=''){
	$('#ndan_'+li_id)[0].click();
	$('#nd_block_nonetextbox').val('');
	}
	
	$(".nd_block_none").css('display','block');
	$(".st_block_none").css('display','block');
	$("#backtoall").css('display','none');
	$(".spanclass").css('display','none');
}
function ndspanback()
{
	var li_id=$("#nd_block_nonetextbox").val()
	if(li_id!=''){
	$('#ndan_'+li_id)[0].click();
	$('#nd_block_nonetextbox').val('');
	}
	
	$(".nd_block_none").css('display','block');
	$(".spanclass").css('display','none');
	
}
</script>
<!--st & nd _block_none end -->
<!--------------------------price_filter_function from-to start-------------------->
<script>
function price_filter()
{
	//alert('price_filter');
	var low_price = document.getElementById("low_price").value;
	var high_price = document.getElementById("high_price").value;
    if(low_price=="" || high_price=="")
	{
	  alert('You must select a valid Price');
	  //document.getElementById("phnoii").innerHTML="You must select a valid Phno";
	  return false;
	}
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->			  
		 var y =/[^0-9]/;
		 if(low_price.match(y) || high_price.match(y)){
			 alert('You must select a valid Price');
		 //document.getElementById("phnoii").innerHTML="You must select a valid Phno";
		 document.getElementById("low_price").value="";
		 document.getElementById("high_price").value="";
		 return false;
		}
		else{
			//alert(low_price);
			//alert(high_price);
			 if(parseInt(low_price)>parseInt(high_price)){
				 	alert('From price Must Less Than To Price');
					return false;
				 }else{
					 //alert('good');
					 price_filter_aftervalidation(low_price,high_price);
					  }
			}
}



function price_filter_aftervalidation(low_price,high_price)
{
	
	//document.getElementById("filterdivid").style.display = "block";
	//document.getElementById("clearallid").style.display = "block";
	//var div = document.createElement('span');

    //div.innerHTML = '<span class="rst_spn" id="remove_price_tag" onclick="remove_price_tag()" >'+low_price+'-'+high_price+' <i class="fa fa-times close_filter" aria-hidden="true"></i></span>';
	// $("#remove_price_tag").remove();
     //document.getElementById('span_val').appendChild(div);
	
	
	
	fltrclose();
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	if(checked_product!=''){
<!-------------------------- u r in checked_product price filter from-to start -------------------------->	
		//alert('u r in checked_product from-to');
		//return false;
		//alert(checked_product);
		var search_title ="<?php  echo $this->uri->segment(2);  ?>";
		$.ajax({
				url:'<?php echo base_url().'Product_description/chk_box_pricefilter_fromto' ?>',
				method:"post",
				data:{checked_product:checked_product,search_title:search_title,low_price:low_price,high_price:high_price,start_from:'0'},
				beforeSend: function(){
								$("#filter_searchdatamtree").addClass('disabled');
								$('#ajaxprodload_divid').hide();
								$('#ajaxprodload_dividlist').hide();
								$('#lodr_img').show();
							},
				
				complete: function(){
								//loadviewmorebuttonajax();
								$("#filter_searchdatamtree").removeClass('disabled');
								$('#ajaxprodload_divid').show();
								$('#ajaxprodload_dividlist').show();
								$('#lodr_img').hide();
								},			
				success:function(data){
					$('#firstproduct_loader').css('display','none');
					//alert(data);
					//$("#ajaxprodload_divid").html(data);
					var $holder = $('<div/>').html(data);
					$('#product_countno').html($('#htmlcount' , $holder).html());
					$('#ajaxprodload_divid').html($('#html1' , $holder).html());
					$('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
					$('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
					
					}
			  })
<!------------------------------- u r in checked_product price sort end ------------------------------------->		
		}else{
				
				var radiochecked_product = $('input[name="ul_liradio"]:checked').map(function(_, el){
       				return $(el).val();
   					}).get();
	
	//alert(radiochecked_product);return false;
					if(radiochecked_product=='')
					{
						
						var search_title ="<?php  echo $this->uri->segment(2);  ?>";
						<?php if($this->uri->segment(3)!=''){ ?>
						//alert('u r in segment3 price from-to');
						//return false;
						var qsearch_title='<?php echo str_replace('/','',base64_decode($this->uri->segment(3)));?>';
						var fqq='<?php echo str_replace('/','',base64_decode($this->uri->segment(4)));?>';
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/pricefilter_fromto_seg3' ?>',
									method:"post",
									data:{search_title:qsearch_title,fqq:fqq,low_price:low_price,high_price:high_price,start_from:0},
									
									
									beforeSend: function(){
										$("#act3").addClass('disabled');
										$('#ajaxprodload_divid').hide();
										$('#ajaxprodload_dividlist').hide();
										$('#lodr_img').show();  
										},
									complete: function(){
										$("#act3").removeClass('disabled');
										$('#ajaxprodload_divid').show();
										$('#ajaxprodload_dividlist').show();
										$('#lodr_img').hide();
										},
									   
									success:function(data){
										//alert(data);
										//$("#ajaxprodload_divid").html(data);
									 var $holder = $('<div/>').html(data);
									 $("#firstproduct_loader").css('display','none');
									 $('#product_countno').html($('#htmlcount' , $holder).html());
									 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
									 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
									 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
									
									}
								  });
						
						
						<?php }else{ ?>
								//alert('u r in normal price from-to');
								//return false;
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/pricefilter_fromto' ?>',
									method:"post",
									data:{search_title:search_title,low_price:low_price,high_price:high_price,start_from:0},
									
									beforeSend: function(){
										//$("#act3").addClass('disabled');
										//$("#filter_searchdatamtree").addClass('disabled');
										$('#ajaxprodload_divid').hide();
										$('#ajaxprodload_dividlist').hide();
										$('#lodr_img').show();  
										},
									complete: function(){
										//$("#act3").removeClass('disabled');
										$('#ajaxprodload_divid').show();
										$('#ajaxprodload_dividlist').show();
										$('#lodr_img').hide();
										
										},
									   
									success:function(data){
										//alert(data);
										//$("#ajaxprodload_divid").html(data);
									 var $holder = $('<div/>').html(data);
									 $("#firstproduct_loader").css('display','none');
									 $('#product_countno').html($('#htmlcount' , $holder).html());
									 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
									 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
									 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
									
									}
								  });
							<?php } ?>
						
						
						
					}else{
							//alert('u r in radio_product from-to');
							//return false;
							//nocatlvlradiobtn
							//alert(radiochecked_product);
							var search_title ="<?php  echo $this->uri->segment(2);  ?>";
							
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/ul_li_radio_pricefilter_fromto' ?>',
									method:"post",
									data:{search_title:search_title,fq:radiochecked_product,low_price:low_price,high_price:high_price,start_from:0},
									
									beforeSend: function(){
										$("#filter_searchdatamtree").addClass('disabled');
										$('#ajaxprodload_divid').hide();
										$('#ajaxprodload_dividlist').hide();
										$('#lodr_img').show();  
										},
									complete: function(){
										$("#filter_searchdatamtree").removeClass('disabled');
										$('#ajaxprodload_divid').show();
										$('#ajaxprodload_dividlist').show();
										$('#lodr_img').hide();
										},
									   
									success:function(data){
										//alert(data);
										//$("#ajaxprodload_divid").html(data);
									 var $holder = $('<div/>').html(data);
									 $("#firstproduct_loader").css('display','none');
									 $('#product_countno').html($('#htmlcount' , $holder).html());
									 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
									 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
									 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
									 
									
									}
								  });
							
						 }
				
				
				
			 }
	
}

</script>
<!--------------------------price_filter_function from-to end--------------------------->
<!--------------------------price_filter_more function from-to start--------------------------->
<script>
function price_filtermore(low_price,high_price,result_no)
{
	//alert('price_filter more');
	if(low_price=="" || high_price=="")
	{
	  alert('You must select a valid Price');
	  //document.getElementById("phnoii").innerHTML="You must select a valid Phno";
	  return false;
	}
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->			  
		 var y =/[^0-9]/;
		 if(low_price.match(y) || high_price.match(y)){
			 alert('You must select a valid Price');
		 //document.getElementById("phnoii").innerHTML="You must select a valid Phno";
		 document.getElementById("low_price").value="";
		 document.getElementById("high_price").value="";
		 return false;
		}
		else{
			//alert(low_price);
			//alert(high_price);
			 if(parseInt(low_price)>parseInt(high_price)){
				 	alert('From price Must Less Than To Price');
					return false;
				 }else{
					 //alert('good');
					 price_filter_aftervalidation_more(low_price,high_price,result_no);
					  }
			}
}



function price_filter_aftervalidation_more(low_price,high_price,result_no)
{
	
	var numItems = parseInt($('.product-grids').length);
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	if(checked_product!=''){
<!-------------------------- u r in checked_product price filter from-to start -------------------------->	
		//alert('u r in checked_product from-to more');
		//return false;
		//alert(checked_product);
		var search_title ="<?php  echo $this->uri->segment(2);  ?>";
		$.ajax({
				url:'<?php echo base_url().'Product_description/chk_box_pricefilter_fromto_more' ?>',
				method:"post",
				data:{checked_product:checked_product,search_title:search_title,low_price:low_price,high_price:high_price,start_from:numItems},
									beforeSend: function(){
									$('.view_mor').hide();
									$('#lodr_img').show();
									//$('.list_view_lodr_img').show();
									},
									complete: function(){
										$('#lodr_img').hide();
										//$('.list_view_lodr_img').hide();
										//$('.view_mor').show();
										
									},
									success:function(result){
										//alert(result);
										//$('.grids_of_4').append(result);
										var $holdermore = $('<div/>').html(result);
										$('.product-more').append($('#htmlmore1' , $holdermore).html());
										$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
										$('#scrol_tracktxtbox').val('wait to scroll');
										if(numItems == result_no){
											$('.view_mor').hide();
											$('#view_more_dv').html('<span>No more product available!</span>');
										}
									}
			  })
<!------------------------------- u r in checked_product price sort end ------------------------------------->		
		}else{
				
				var radiochecked_product = $('input[name="ul_liradio"]:checked').map(function(_, el){
       				return $(el).val();
   					}).get();
	
	//alert(radiochecked_product);return false;
					if(radiochecked_product=='')
					{
						
						var search_title ="<?php  echo $this->uri->segment(2);  ?>";
						<?php if($this->uri->segment(3)!=''){ ?>
						//alert('u r in segment3 price from-to more');
						//return false;
						var qsearch_title='<?php echo str_replace('/','',base64_decode($this->uri->segment(3)));?>';
						var fqq='<?php echo str_replace('/','',base64_decode($this->uri->segment(4)));?>';
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/pricefilter_fromto_seg3_more' ?>',
									method:"post",
									data:{search_title:qsearch_title,fqq:fqq,low_price:low_price,high_price:high_price,start_from:numItems},
									
									
									beforeSend: function(){
									$('.view_mor').hide();
									$('#lodr_img').show();
									//$('.list_view_lodr_img').show();
									},
									complete: function(){
										$('#lodr_img').hide();
										//$('.list_view_lodr_img').hide();
										//$('.view_mor').show();
										
									},
									success:function(result){
										//alert(result);
										//$('.grids_of_4').append(result);
										var $holdermore = $('<div/>').html(result);
										$('.product-more').append($('#htmlmore1' , $holdermore).html());
										$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
										$('#scrol_tracktxtbox').val('wait to scroll');
										if(numItems == result_no){
											$('.view_mor').hide();
											$('#view_more_dv').html('<span>No more product available!</span>');
										}
									}
								  });
						
						
						<?php }else{ ?>
								//alert('u r in normal price from-to more');
								//return false;
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/pricefilter_fromto_more' ?>',
									method:"post",
									data:{search_title:search_title,low_price:low_price,high_price:high_price,start_from:numItems},
									
									beforeSend: function(){
									$('.view_mor').hide();
									$('#lodr_img').show();
									//$('.list_view_lodr_img').show();
									},
									complete: function(){
										$('#lodr_img').hide();
										//$('.list_view_lodr_img').hide();
										//$('.view_mor').show();
										
									},
									success:function(result){
										//alert(result);
										//$('.grids_of_4').append(result);
										var $holdermore = $('<div/>').html(result);
										$('.product-more').append($('#htmlmore1' , $holdermore).html());
										$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
										$('#scrol_tracktxtbox').val('wait to scroll');
										if(numItems == result_no){
											$('.view_mor').hide();
											$('#view_more_dv').html('<span>No more product available!</span>');
										}
									}
									
								  });
							<?php } ?>
						
						
						
					}else{
							//alert('u r in radio_product from-to more');
							//return false;
							//nocatlvlradiobtn
							//alert(radiochecked_product);
							var search_title ="<?php  echo $this->uri->segment(2);  ?>";
							
							$.ajax({ 
									url:'<?php echo base_url().'Product_description/ul_li_radio_pricefilter_fromto_more' ?>',
									method:"post",
									data:{search_title:search_title,fq:radiochecked_product,low_price:low_price,high_price:high_price,start_from:numItems},
									
									beforeSend: function(){
									$('.view_mor').hide();
									$('#lodr_img').show();
									//$('.list_view_lodr_img').show();
									},
									complete: function(){
										$('#lodr_img').hide();
										//$('.list_view_lodr_img').hide();
										//$('.view_mor').show();
										
									},
									success:function(result){
										//alert(result);
										//$('.grids_of_4').append(result);
										var $holdermore = $('<div/>').html(result);
										$('.product-more').append($('#htmlmore1' , $holdermore).html());
										$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
										$('#scrol_tracktxtbox').val('wait to scroll');
										if(numItems == result_no){
											$('.view_mor').hide();
											$('#view_more_dv').html('<span>No more product available!</span>');
										}
									}
								  });
							
						 }
				
				
				
			 }
}
</script>
<!--------------------------price_filter_more function from-to end--------------------------->
 <script>
function arrck()
{
	//alert('sdfsd');
	var search_title='<?php echo $this->uri->segment(2);?>';
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	//alert(checked_product);
	var textbox_val = $('input[name="cktextbox[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
	var textbox_id = $('input[name="cktextboxid[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
	var datacount = $('input[name="datacount[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
	if(checked_product!=''){
	for(i = 0; i < textbox_id.length; i++)
				 {
					//$("#labelid"+textbox_id[i]).addClass('labeldisabled');
					$("#labelid"+textbox_id[i]).css("display", "none");
				 }
	//alert(textbox_val);
	$.ajax({ 
				url:'<?php echo base_url().'Product_description/arrck' ?>',
				method:"post",
				data:{checked_product:checked_product,search_title:search_title,textbox_val:textbox_val,textbox_id:textbox_id},
				success:function(data){
				 //alert(data);
				 var data = data.split('|');

				 var dataid=data[0];
				 var datacount=data[1];
				 var arraydataid = JSON.parse("[" + dataid + "]");
				 var arraydatacount = JSON.parse("[" + datacount + "]");
				//alert(arraydatacount);
				 $("#labelid100").removeClass('labeldisabled');
				 for(i = 0; i < arraydataid.length; i++)
				 {
					 //alert(data[i]);
					 //$("#labelid"+arraydataid[i]).removeClass('labeldisabled');
					 $("#labelid"+arraydataid[i]).css("display", "block");
					 $('#spanpcountid'+arraydataid[i]).html('('+arraydatacount[i]+')');
					 
				 }
				
				//$(".Brand").removeClass('labeldisabled');
				$(".Brand").css("display", "block");
				}
			  });
	}else{
		for(i = 0; i < textbox_id.length; i++)
				 {
					//$("#labelid"+textbox_id[i]).removeClass('labeldisabled');
					$("#labelid"+textbox_id[i]).css("display", "block");
					$('#spanpcountid'+textbox_id[i]).html('('+datacount[i]+')');
				 }
		 }
}
</script>
<script>
function arrck2()
{
	//alert('sdfsd');
	var search_title='<?php echo $this->uri->segment(2);?>';
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	//alert(checked_product);
	var textbox_val = $('input[name="2cktextbox[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
	var textbox_id = $('input[name="2cktextboxid[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
	//alert(textbox_id);
	var datacount = $('input[name="2datacount[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
	if(checked_product!=''){
	for(i = 0; i < textbox_id.length; i++)
				 {
					//$("#labelid"+textbox_id[i]).addClass('labeldisabled');
					$("#labelid"+textbox_id[i]).css("display", "none");
				 }
	//alert(textbox_val);
	//return false;
	$.ajax({ 
				url:'<?php echo base_url().'Product_description/arrck2' ?>',
				method:"post",
				data:{checked_product:checked_product,search_title:search_title,textbox_val:textbox_val,textbox_id:textbox_id},
				success:function(data){
				 //alert(data);
				 //$("#ajaxprodload_divid").html(data);
				 //$(".Brand").css("display", "block");
				 if(data=='nobrandselect'){
					 //alert('if');
					 otherfunction();
					 
					 }else{
						 //alert('else');
				 var data = data.split('|');

				 var dataid=data[0];
				 //alert(dataid);
				 var datacount=data[1];
				 //alert(datacount);
				 
				 var arraydataid = dataid.split(",");
				 var arraydatacount = datacount.split(",");
				 //var arraydataid = JSON.parse("[" + dataid + "]");
				 //var arraydatacount = JSON.parse("[" + datacount + "]");
				 //alert(arraydataid);
				 //alert(arraydatacount);
				 //alert(arraydatacount.length);
				
				 for(i = 0; i < arraydataid.length; i++)
				 {
					 //alert(data[i]);
					 //$("#labelid"+arraydataid[i]).removeClass('labeldisabled');
					 $("#labelid"+arraydataid[i]).css("display", "block");
					 $('#spanpcountid'+arraydataid[i]).html('('+arraydatacount[i]+')');
					 
				 }
				
				//$(".Brand").removeClass('labeldisabled');
				$(".Brand").css("display", "block");
				
				}}
			  });
	}else{
		for(i = 0; i < textbox_id.length; i++)
				 {
					//$("#labelid"+textbox_id[i]).removeClass('labeldisabled');
					$("#labelid"+textbox_id[i]).css("display", "block");
					$('#spanpcountid'+textbox_id[i]).html('('+datacount[i]+')');
				 }
		 }
}
function otherfunction()
{
	//alert('other');
	var textbox_id = $('input[name="2cktextboxid[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
	//alert(textbox_id);
	var datacount = $('input[name="2datacount[]"]').map(function(_, el){
       	return $(el).val();
   	}).get();
for(i = 0; i < textbox_id.length; i++)
  {
	  $("#labelid"+textbox_id[i]).css("display", "block");
	  $('#spanpcountid'+textbox_id[i]).html('('+datacount[i]+')');
  }
}
</script>
        <div class="wrap push" id="home">
		<!--products-->
       <div class="info-products" id="info">
	   
	      <div class="info-inner">
		  
               <?php include "search_filtermenu.php"; ?>
               <!-- Filter Panel -->
                <?php //include "catalog_menu.php"; ?>  
               <!--Filter Panel -->
               
               
            <!---------------------------------subcategory list start---------------------------------------------->
               
               		 <!--<div class="category" >
					 <?php /*?><div id="catg_loader" align="center"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading Categories...</div><?php */?>
                     <ul class="cssmenu">
						<li class="has-sub"><a href="#"> Categories </a>
							 <ul id="product_catgdiv">
                             
                              </ul>
							</li>							
						</ul> 
					</div>-->
                    
                    
              <!-- <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Simple collapsible</button>
          		<div id="demo" class="collapse">
           		 <ul id="product_catgdiv">
                   <li>hgjhgj</li> 
                   <li>hgjhgj</li>          
                 </ul>
          		</div-->
<!---------------------------------subcategory list end------------------------------------------------>
<!------------------------------- sponsored_product start -------------------------------------->
           <?php

$search_title=trim(str_replace(' ','%20',$this->uri->segment(2)));
			$curl_strng=SOLR_BASE_URL.SOLR_CORE_NAME."/select?indent=on&wt=json&q=".$search_title."&group=true&group.query=(Spec5:*%20OR%20Spec6:*%20OR%20Spec7:*)&group.main=true";
						
			$curl2 = curl_init($curl_strng);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			$data2 = json_decode($output, true);
			$ponsored_product_data=$data2;			
			
			$cntt=count($ponsored_product_data['response']['docs']);
	?>
           
           
           
           
           <?php if($cntt>0){ ?>
           	<h3 class="tittle">Sponsored Products</h3>
               <div id="slider2" style="margin:0 !important;">
        <a class="buttons prev" href="#">&lt;</a>
			<div class="viewport">
								
				<ul class="overview best-selr-prdct" >
                <?php
				for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
				$cdate=date("Y-m-d");
 				?>
                    <li>
                        <div class="sponsored-agile-products" style="max-height: 350px; height: 250px;">
                            <!--<div class="new-tag">
                            	<h6>50% <br>OFF</h6>
                            </div>-->
                                <div style="margin:auto; width:100%; text-align:center; ">
                                     <a style="margin:auto; text-align:center;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($ponsored_product_data['response']['docs'][$i_arr]['Title'])))).'/'.$ponsored_product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$ponsored_product_data['response']['docs'][$i_arr]['Sku']  ?>">
                                     
                                     <?php if(empty($ponsored_product_data['response']['docs'][$i_arr]['Catalog_Image'][0])){?>
                                        <img class="sponsored-image" src="<?php echo base_url();?>images/product_img/prdct-no-img.png" onerror="imgError(this);" alt="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>" title="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>">
                                     <?php }else{?>
                                     <img class="sponsored-image" src="<?php echo base_url();?>images/product_img/<?=$ponsored_product_data['response']['docs'][$i_arr]['Catalog_Image'][0];?>" onerror="imgError(this);" alt="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>" title="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>">
                                     <?php }?>
                                     </a>                       
                                </div>
                                <div class="agile-product-text">              
								<h5 style="text-align:center; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;">
                                <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($ponsored_product_data['response']['docs'][$i_arr]['Title'])))).'/'.$ponsored_product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$ponsored_product_data['response']['docs'][$i_arr]['Sku']  ?>">
								<?php if(strlen($ponsored_product_data['response']['docs'][$i_arr]['Title']) > 19){echo substr($ponsored_product_data['response']['docs'][$i_arr]['Title'],0,19).' ...';}else{echo $ponsored_product_data['response']['docs'][$i_arr]['Title'];} ?>
                                </a>
                                </h5> 
                                
         <!-- <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 1399 </span>&nbsp;&nbsp;
          <span style="color:#eead0f; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 1399 </span>&nbsp;&nbsp; 
          <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 498 </span> -->
                                 
                            
                            <?php
						 if($ponsored_product_data['response']['docs'][$i_arr]['Special_Price'] !=0){
							if($cdate >= substr($ponsored_product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($ponsored_product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10)){
					?>     
                            <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=$ponsored_product_data['response']['docs'][$i_arr]['Mrp'] ?> </span>&nbsp;&nbsp;     
                            <?php if($ponsored_product_data['response']['docs'][$i_arr]['Price'] != 0){?>     
                            <span style="color:#eead0f; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Price']); ?> </span>&nbsp;&nbsp;     
                            <?php }?>  
                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Special_Price']); ?> </span>
                            <?php }else{ ?>
                            <?php if($ponsored_product_data['response']['docs'][$i_arr]['Price'] != 0){?> 
                            <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>&nbsp;&nbsp; 
                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Price']); ?> </span>
                            <?php }else{?>
                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
                            <?php }?>
							<?php } //End of date condition ?>
                            <?php }else{ ?>
                            <?php if($ponsored_product_data['response']['docs'][$i_arr]['Price'] != 0){?>
                            <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>&nbsp;&nbsp;
                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Price']); ?> </span>
                            <?php }else{?> 
                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
                            <?php }?>
       						<?php } ?>        
        						</div>
                        </div>
    				</li>
				<?php } // End of foreach loop?>						
					
            </ul>
		</div>
			<a class="buttons next" href="#">&gt;</a>	
		</div>
           <?php } ?>
<!------------------------------- sponsored_product end -------------------------------------->            
				<div class="section-info">
				<!--<h3 class="tittle">View Products</h3>-->
<div id="menu1">
	<div style="text-align:center; font-size:15px;">                
 <!---------------------------------Product Detail Start------------------------------------------------>
                 <div class="product-more" id="ajaxprodload_divid" >
                 <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;">
                 <img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...
                 </div>
                 <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none;" width="24px" />
                 </div>
<!---------------------------------Product Detail end------------------------------------------------>
    </div>
</div>   

<div id="menu2" style="display:none;">          
<div style="text-align:center; font-size:15px;">
		
    <div class="grids_of_4list" id="ajaxprodload_dividlist">
                 <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;">
                 <img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...
                 </div>
                 <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none;" width="24px" />
    </div>
    </div>
</div>                
				   
				    <div class="clearfix"> </div>
				</div>
                <div id="view_more_dv" class="grid_view_morebtn" align="center">
            			<img src="<?php echo base_url(); ?>images/loader.gif" id="lodr_img" class="grid_view_lodr_img" style="display:none;">
                				<input style="display:none;" type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">
        			</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>
	<div class="wrap" >
		<div class="info-products">
			<div class="info-inner">
				<?php 
					if($sec_info!=false){
					if($sec_info->num_rows()>0)
					{ $cur_dtm=date('y-m-d h:i:s');
					foreach($sec_info->result_array() as $res_secdata)
					{
				?>
					<!------------------------- Section 1st condition start------------------------------------------------>
					<?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='350x35'  )
					{?><div class="thin">
					<?php 
					$sec_id=$res_secdata['Sec_id'];                 
					$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
						<a href="#"><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" >
						</a>
					<?php } ?>
           
					<?php if($res_imgdata['URL']!=''){ ?> 
						<a href="#"><img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;"></a>
					<?php } ?>
					<?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?>  
						<a href="#"><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;"></a>
					<?php } ?>
					<?php   } // image for loop end ?>
            	
					<?php 
							} 
						}
					?> 
					</div>
					<?php }  ?> 
					<!------------------------- Section 1st condition End------------------------------------------------>
					<!------------------------- Section 2nd condition Start------------------------------------------------>
					<?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && ($res_secdata['image_size']=='1000x244' || $res_secdata['image_size']=='600x259') )
					{?><div>
					<?php 
					$sec_id=$res_secdata['Sec_id'];                 
					$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
					<?php   }  ?>
					<?php 
							} 
						}
					?> 
					</div>
					<?php } ?> 
					<!------------------------- Section 2nd condition End------------------------------------------------>					
					<!------------------------- Section 3rd condition Start------------------------------------------------>
					<?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='208x300')
					{?>
					
					<?php 
						$sec_id=$res_secdata['Sec_id'];                 
						$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
						<?php if(in_array($res_imgdata['imge_nm'],$img_arrnew)) { echo "style='float:left; width:50%;margin-top: 2px;'"; }else{echo "style='float:left; width:50%;margin-top: 2px;'";}?>  
						onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'">
					<?php } ?>
					<?php if($res_imgdata['URL']!=''){ ?> 
						<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
					<?php if(in_array($res_imgdata['imge_nm'],$img_arrnew)) { echo "style='float:left; width:50%;margin-top: 2px;'"; }else{echo "style='float:left; width:50%;margin-top: 2px;'";}?>  >
					<?php } ?>
					<?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?>  
						<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
					<?php if(in_array($res_imgdata['imge_nm'],$img_arrnew)) { echo "style='float:left; width:50%;margin-top: 2px;'"; }else{echo "style='float:left; width:50%;margin-top: 2px;'";}?>  >
					<?php }   } ?>
            	
					<?php 
							} 
						}
					?> 
					
					<?php } ?>
					<!------------------------- Section 3rd condition End------------------------------------------------>
					<!------------------------- Section 4th condition Start------------------------------------------------>
					<?php 
						if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='770x394')
						{
					?>
					<?php 
						$sec_id=$res_secdata['Sec_id'];                 
						$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
						if($qr_clmn->num_rows()>0)
						{  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
					?>
					<div class="details-grid" style="padding-top:2px;">
						<div class="details-shade">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                  <?php $i_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>  
                                  <li data-target="#carousel-example-generic" data-slide-to="<?=$i_slide?>" <?php if($i_slide=='0'){ ?> class="active" <?php } ?> ></li>                                  
                                  <?php $i_slide++; } ?>
                                </ol>                            
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
							</div> 
						</div>
					</div>
					</div>
					<?php 
							} 
						}
					}?> 
					<!------------------------- Section 4th condition End------------------------------------------------>
					<!------------------------- Section 5th condition Start------------------------------------------------>
					<?php if($res_secdata['sec_type']=='Grouped Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='600x259')
					{?> 
					<?php 
					$sec_id=$res_secdata['Sec_id'];                 
					$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
					if($qr_clmn->num_rows()>0)
					{   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                         $image_count=$qr_imginfo->num_rows();
					?>
           			<div class="container">
					<!--<h3>Banner</h3>-->
					<div class="panel-group category-products" id="accordian">
							<div class="panel panel-default">
								<div class="panel-heading" style="padding: 5px 10px;">
                                	
									<h4 class="panel-title" style="text-align:center;">
										<a data-toggle="collapse">
											<?=$res_secdata['sec_lbl']?>
										</a>
									</h4>
								</div>
								<div id="mens" class="collapse in">
									<div class="panel-body" style="min-height: auto; width: 100%; overflow: hidden;">
                                    <ul>
					<?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){
                        ?>
                    <li style="height:auto">
                        <div class="brands_products">
                            <div class="brands-name" style="width:100%; height:auto;">
                                <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>">
                            </div>
                        </div>
                    </li>
                    <?php } }?>
					</ul>
                                   <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
					</div>
					<?php } } ?>
            
					<?php }?>
					<!------------------------- Section 5th condition End------------------------------------------------>
					
					<!------------------------- Section 6th condition End------------------------------------------------>
					<?php if($res_secdata['sec_type']=='Product'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
					{   ?>
               
					<div class="left-sidebar"><h2><?=$res_secdata['sec_lbl']?></h2></div>
					<div class="slider autoplay" style="width:100%; margin:auto;">
                    <?php 
						$sec_id=$res_secdata['Sec_id'];                 
						$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                
                                <div class="view-search searc-hview-fifth">    
                                  <a style="margin: auto;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
                                  <img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"   class="wow flipInY grow"  alt="<?=$rw['name']?>">
                                  
                                  </a>
                                  </div>
                                
                                   <div class="wish-list"> 
                                   <a class="link-wishlist wish_spn" onClick="" href="#"  data-toggle="tooltip" title="Add To Wishlist"  ><i class="fa fa-heart"></i></a>
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
									</div>
						</div>
						<?php			
								} 
							} 
						?>
               			<?php  } ?>
						<?php 
								} 
							}
						?>
					</div>
					<?php } ?>
					<!------------------------- Section 6th condition End------------------------------------------------>
					<!------------------------- Section 7th condition End------------------------------------------------>
					<?php if($res_secdata['sec_type']=='Featured Box'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && 		$res_secdata['image_size']=='140x142')
					{?>
					<div class="single-product">
					<div class="single-product1">
					<span class="fash_left"><h4><?=$res_secdata['sec_lbl']?></h4></span><!--<span class="fash_right" ><a href="#"><!--View More</a></span>-->
					<?php 
						$sec_id=$res_secdata['Sec_id'];                 
						$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
					<?php   } ?>
						<div style="clear:both"></div>
					<?php 
							}
						}
					?>
					</div>
					</div>
					<?php } ?>
					<!------------------------- Section 7th condition End------------------------------------------------>
					<div style="clear:both"></div>
					<!------------------------- Section 8th condition Start------------------------------------------------>
					<?php
						if($res_secdata['sec_type']=='Prodcts Vertical section'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
					{   ?>
					<div class="fandt">	
					<div class=" features">
					<?php /*?><h3><?=$res_secdata['sec_lbl']?> <a href="#" class="btn btn-primary right"> More</a></h3><?php */?>
					<?php 
						$sec_id=$res_secdata['Sec_id'];                 
						$qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
					<h3><?=$res_secdata['sec_lbl']?>
					<a href="<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>" class="btn btn-primary right">More</a></h3>
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
							<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;<?=$rw['mrp'];?> </span>&nbsp;&nbsp;
							<span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;<?=$rw['price'];?> </span>&nbsp;&nbsp;
							<span style="color:#079107 !important;  font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;<?=ceil($rw['special_price'])?> </span>
						<?php }} ?>
						<?php if($rw['price'] != 0 && $rw['special_price']==0){?>
							<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;	<?=$rw['mrp'];?> </span>
						<?php } ?>
						<?php if($rw['price'] == 0 && $rw['special_price']==0){?>
							<span><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;<?=$rw['mrp'];?> </span>
						<?php } ?>&nbsp;&nbsp;
						<?php
						   if($rw['special_price'] ==0 && $rw['price']>0){
						?>                               
							<span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;<?=ceil($rw['price'])?> </span>
						<?php } ?>
                        </p>
					</div>
                    <div class="clearfix"></div>
					</div>
					<?php }} ?>
					<?php } ?>
					<?php
							} 
						}
					?> 
					</div>
					<div class="clearfix"></div>
					</div>
					<?php } // section 10th condition end ?>
					<!------------------------- Section 8th condition End------------------------------------------------>
					<!------------------------- Section 9th Condition Start---------------------------------------------->
					<?php 
						if($res_secdata['sec_type']=='Rich Text Editor'  && $res_secdata['sec_type_data']=='Banner'){
							
						$sec_id=$res_secdata['Sec_id'];
					?>
					<div class="container-fluid">
						<div class="col-lg-12" style="background:#f5f5f5; padding:10px;">
							<?php if ($res_secdata['sec_lbl']=='') {?>
							<?php } else {?>
							<h5><strong><?=$res_secdata['sec_lbl']?></strong></h5>
							<?php }?>
							<p style="text-align: justify;"><?=$res_secdata['sec_descrp']?></p>
						</div>
					</div>
					<?php }?>
					<!------------------------- Section 9th Condition End---------------------------------------------->
				<?php } } }?>
			</div>
        </div>
	</div>
        
   
 <?php include "footer.php"; ?> 
 
 