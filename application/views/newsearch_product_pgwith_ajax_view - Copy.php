
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		
        
        
<!---------------------------------------- product_data_seo Start -------------------------------------------->    
        <?php
		$search_title=trim(str_replace(' ','%20',$this->uri->segment(2)));
        $curl_strng="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&q=".$search_title."&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=1&start=0";
						
			
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
				
				$curl_strng="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&q=".$searchsuggst_txt."&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=50&start=0";
				
				
				$curl3 = curl_init($curl_strng);
				curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
				$output3 = curl_exec($curl3);
				$product_data_sco = json_decode($output3, true);
				}
        ?>
        <?php 
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
        
      <link rel="canonical" href="<?php echo base_url().'search-by/'.$this->uri->segment(2); ?>"/>
<!---------------------------------------- product_data_seo End --------------------------------------------> 
    	<?php include "header.php"; 
		
		?><!------ Start Content ------>

<style>
 /* carousel */

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
    color: red;
    z-index: 1;
    position: absolute;
    top: 1px;
    left: 5%;
    font-size: .8em;
    text-align: center;
    font-weight: bold;
}

.discount-off:before {
	content: '';
    width: 45px;
    height: 45px;
    border-radius: 50%;
    position: absolute;
    top: 0;
    left: 0;
    -webkit-transition: .5s all;
    -moz-transition: .5s all;
    -o-transition: .5s all;
    -ms-transition: .5s all;
    transition: .5s all;
    border: 1px solid red;
}
.content_box h5{
	margin:0;
	text-align:center; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;
}
.content_box h5 a {
     color: #0280e1;
     font-weight: normal;
    font-size: 15px;
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
margin: -86px 24px 20px 144px;
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
    padding: 18px 22px 0;
    color: #888;
}
.padd{
	    padding: 18px 22px 0;
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

.top-list{
	background: #f5f5f5;
    padding: 10px;
    -moz-box-shadow: 0 0 5px #888;
    -webkit-box-shadow: 0 0 5px#888;
    box-shadow: 0 0 5px #888;
    margin-bottom: 21px;

}
a.button.act {
    background: #0066c0;
    padding: 12px 7px 2px;
    color: #fff;
	border-radius: 6px;
}
i.fa.fa-list {
    font-size: 25px;
	margin-right:5px;
}
i.fa.fa-th-large{font-size: 25px;}
.short-by{
	width: 15px;
    height: 17px;
    display: inline-block;
    position: relative;
    top: -2px;
    margin-right: 7px;
	background:url(image/shortby.png) no-repeat;
    background-size: 250px auto;
	background-position: -114px -152px !important;
}
.shortby-link{
	display: inline-block;
    text-decoration: none;
    color: #353535;
    line-height: 25px;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    text-align: center;
}
i.ali {
    vertical-align: 4px;
    font-weight: bold;
    color: #0066c0;
    font-size: 18px;
}
span.sp {
    vertical-align: 6px;
    font-size: 13px;
    /* font-weight: bold; */
    color: #333;
    margin-left: -1px;
}
.listing-title {
    font-weight: 500;
    font-size: 18px;
    display: block;
    cursor: pointer;
	color: #2874f0;
	margin-bottom: 14px;
}
.listing-sub-title {
        font-weight: bold;
    display: inline-block;
    margin-right: 14px;

}
.rateit .rateit-range {
    position: relative;
    display: -moz-inline-box;
    display: inline-block;
	background:url(image/star.gif);
    height: 16px;
    outline: none;
}
.listing-ul{
    margin-top: 5px;
    color: #212121;
    line-height: 22px;
    display: table;
}
.listing-ul-li{
	display: table-row;
    padding-right: 8px;
	color: #212121;
    line-height: 25px;
}
.discount {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    text-align: center;
    background: #ed2541;
    border: 1px solid #ed2541;
    color: #fff;
    font-weight: bold;
    margin-left: 40px;
    float: left;
    margin-top: 50px;
}
.discount p {
    font-size: 13px;
    line-height: 17px;
    letter-spacing: 1px;
    text-align: center;
}
.payment-mode ul li {
    display: block;
    float: none;
    padding: 8px 1px;
    font-size: 12px;
    color: #989898;
}
.payment-mode ul li span {
    background-color: #989898;
    color: #fff;
    padding-left: 2px;
    font-size: 12px;
    margin-right: 3px;
}
a#act2 {
    padding: 12px 1px 3px 5px;
}

.liner-shadow {
    position: relative;
    overflow: hidden;
    /* width: 38%; */
    /* margin-right: 18px; */
}
.liner-shadow:before {
    content: "";
    position: absolute;
    z-index: 1;
    width: 10px;
    /* top: 2%; */
    height: 100%;
    right: -11px;
    border-radius: 5px / 100px;
    box-shadow: 0 0 7px rgba(0,0,0,0.6);
	display:none;
}	
.search-bold{
	font-size:15px; font-weight:bold; width: 125px; color:#333;
}
li.has-sub ul li label {
    margin-left: 31px;
}
/*top slider start*/

.carousel-inner {
  margin: auto;
  width: 90%;
}

.carousel-control {
  width: 4%;
}

.carousel-control.left,
.carousel-control.right {
  background-image: none;
}

.glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {
  margin-top: -10px;
  margin-left: -10px;
  color: #444;
}

.carousel-inner a {
  
}
.carousel-inner img {
 
}

@media (max-width: 767px) {
  .carousel-inner > .item.next,
  .carousel-inner > .item.active.right {
    left: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
  }

  .carousel-inner > .item.prev,
  .carousel-inner > .item.active.left {
    left: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
@media (min-width: 767px) and (max-width: 992px) {
  .carousel-inner > .item.next,
  .carousel-inner > .item.active.right {
    left: 0;
    -webkit-transform: translate3d(50%, 0, 0);
    transform: translate3d(50%, 0, 0);
  }

  .carousel-inner > .item.prev,
  .carousel-inner > .item.active.left {
    left: 0;
    -webkit-transform: translate3d(-50%, 0, 0);
    transform: translate3d(-50%, 0, 0);
  }
}
@media (min-width: 992px) {
  .carousel-inner > .item.next,
  .carousel-inner > .item.active.right {
    left: 0;
    -webkit-transform: translate3d(16.7%, 0, 0);
    transform: translate3d(16.7%, 0, 0);
  }

  .carousel-inner > .item.prev,
  .carousel-inner > .item.active.left {
    left: 0;
    -webkit-transform: translate3d(-16.7%, 0, 0);
    transform: translate3d(-16.7%, 0, 0);
  }
}
i.fa.fa-chevron-right {
color: #333;
} i.fa.fa-chevron-left{
color: #333;
}
/*top slider end*/
.disabled:after {
    position: absolute;
    content: "";
    display: block;
    background: white;
    opacity: 0.5; // optional 
    z-index: 999;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
  }
 </style>
 
 <link href="<?php echo base_url()?>new_css/css/mtree.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>new_css/css/search-left-3rdsection-menu.css" />
 <script src="<?php echo base_url()?>new_js/js/search-left-3rdsection-menu.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo base_url()?>new_js/js/jquery.visible.js"></script>
<!------------------------------------- menu1 & menu2 visibility Start ------------------------------------->
 <script>
	 function menuvisibility(val) {
		 //alert(val);
		if(val=='menu1'){
			
			//alert('Menu1');
			document.getElementById('menu1').style.display="block";
			document.getElementById('menu2').style.display="none";
			//$("#act1").toggleClass("act"); 
			$("#act1").addClass("act");
			$("#act2").removeClass('act');
			//$('div.list_view_morebtn').removeAttr('id');
			//$('div.grid_view_morebtn').attr("id","view_more_dv");
			
			
			
		}
		if(val=='menu2'){
			//alert('Menu2');
			document.getElementById('menu2').style.display="block";
			document.getElementById('menu1').style.display="none";
			//$("#act2").toggleClass("act"); 
			$("#act1").removeClass("act");
			$("#act2").addClass('act');
			//$('div.grid_view_morebtn').removeAttr('id');
			//$('div.list_view_morebtn').attr("id","view_more_dv");
			
			
		}
	 }
</script>
<!---------------------------------- menu1 & menu2 visibility End ------------------------------------------>
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

<!------------------------------ view more lastScrollTop Start ------------------------------------------->
<script>
var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   
   if (st > lastScrollTop)
   {       
   
			 if($('#view_more_dv').visible(true) && $('#scrol_tracktxtbox').val()!='' )
			 {
				
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
	var title ="<?php  echo $this->uri->segment(2);  ?>";
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	
	
	
	if(checked_product==''){
	//alert(result_no);
					<!-- u r in segmented filter suggestion click start -->
	<?php if($this->uri->segment(3)!=''){ ?>
			
			//alert("u r in segmented filter suggestion click ");
			//return false;
			
			var qsearch_title='<?php echo base64_decode($this->uri->segment(3));?>';
			//alert(qsearch_title);
			var fqq='<?php echo base64_decode($this->uri->segment(4));?>';
			//alert(fqq);
			var result_no = parseInt(result_no);
			//alert(result_no);
			var numItems = parseInt($('.grid1_of_4').length);
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
			$('.view_mor').show();
			
		},
		success:function(result){
			//alert(result);
			var $holdermore = $('<div/>').html(result);
			//$('.grids_of_4').append(result);
			//$('.grids_of_4').append(result);
			$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
			$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
			$('#scrol_tracktxtbox').val('wait to scroll');
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
					<!-- u r in segmented filter suggestion click end -->
			
	<?php }else{?>
					
		var radiochecked_product = $('input[name="ul_liradio"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	//alert(radiochecked_product);return false;
	if(radiochecked_product=='' || radiochecked_product=='nocatlvlradiobtn')
	{		
	
	<!-- u r in normal search more start -->	
	var numItems = parseInt($('.grid1_of_4').length);
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
			$('.view_mor').show();
			
		},
		success:function(result){
			//alert(result);
			var $holdermore = $('<div/>').html(result);
			//$('.grids_of_4').append(result);
			//$('.grids_of_4').append(result);
			$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
			$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
			$('#scrol_tracktxtbox').val('wait to scroll');
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
	<!-- u r in normal search more end -->
	}else{
			//alert("u r in Ul LI Start part")
			var numItems = parseInt($('.grid1_of_4').length);
			var result_no = parseInt(result_no);
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
					$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
					$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
					$('#scrol_tracktxtbox').val('wait to scroll');
					if(numItems == result_no){
						$('.view_mor').hide();
						$('#view_more_dv').html('<span>No more product available!</span>');
					}
				}
			});
			
			
		 }
	
			<?php }?>
					
					<!-- u r in checkbox filter search more start -->
	
	}else{
			
			//alert('hi');
			//alert(result_no);
			var numItems = parseInt($('.grid1_of_4').length);
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
						$('.view_mor').show();
						
					},
					success:function(result){
						//alert(result);
						var $holdermore = $('<div/>').html(result);
						//$('.grids_of_4').append(result);
						//$('.grids_of_4').append(result);
						$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
						$('.grids_of_4list').append($('#htmlmore2' , $holdermore).html());
						$('#scrol_tracktxtbox').val('wait to scroll');
						if(numItems == result_no){
							$('.view_mor').hide();
							$('#view_more_dv').html('<span>No more product available!</span>');
						}
					}
				});
				
		 }
		 				<!-- u r in checkbox filter search more end -->
}


</script>
<!------------------------------- Show More Data append end ----------------------------------->

<!---------------------- Show First ajax Data & unnecessary append Start --------------------------->
<script>

<?php //if($row>0){ ?>
 $(document).ready(function(){
	 loadfirstproductsearchajax();
	 //loadajax();
	 $("#act1").addClass('act');
    /*setTimeout(function(){
       loadfirstproductsearchajax();
     },10);*/ // milliseconds
});
<?php //}  ?>


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
	 $('#count_divid').html($('#htmlcount' , $holder).html());
	 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
	 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
	// var $holder = $('<div/>').html(responseHtml);
	 //$('#coupon').html($('#coupon', $holder).html());
    }
  });
  <?php }else{?>
  search_click_filterdata()
  <?php }?>
}



function loadajax(){
 
 var srch_data ="<?php echo $this->uri->segment(2);  ?>";
 //alert(srch_data);return false;
 //$("#catg_loader").css('display','block');
  $.ajax({ 
    url:'<?php echo base_url().'Product_description_search/product_searchcategory_ajax' ?>',
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

/*sujit
function loadproductcountajax(){
 
 var srch_data ="<?php // echo $_GET['search'];  ?>";
 
 //$("#productcount_loader").css('display','block');
  $.ajax({ 
    url:'<?php //echo base_url().'Product_description/product_searchproductcount_ajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
    success:function(data){
     //$("#productcount_loader").css('display','none');
	 $("#productcount_div").html(data);
	 
    }
  });
}*/
<?php //if($row>0){ ?>
 /*$(document).ready(function(){
    setTimeout(function(){
       loadproductcountajax();
     },10000); // milliseconds
});*/

<?php //} ?>


</script>
<!-------------------------- Show First ajax Data & unnecessary append end -------------------------->
<!-------------------------- load sponsored_product script start -------------------------------->
<script>
/*$(document).ready(function(){
    setTimeout(function(){
       loadsponsored_product();
     },8000); // milliseconds
});
*/

/*function loadsponsored_product()
{
	//alert('hi');
	var srch_data ="<?php  //echo $this->uri->segment(2);  ?>";
	$.ajax({
		url:'<?php //echo base_url().'Product_description/ponsored_product' ?>',
		method:"post",
		data:{search_data:srch_data},
		success:function(data){
			//alert(data);
			$("#sponsored_product").html(data);
			}
		})
}
*/</script>
<!-------------------------- load sponsored_product script end -------------------------------->


<!-------------------------- Show mtree loadfilter_product start -------------------------->
<script>
$(document).ready(function(){
    setTimeout(function(){
       loadmtreefilter_product();
     },1000); // milliseconds
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

<!-------------------------- loadviewmorebuttonajax start -------------------------->
<script>
<?php //if($row>0){ ?>
 $(document).ready(function(){
    setTimeout(function(){
       loadviewmorebuttonajax();
     },2000); // milliseconds
});
<?php //}  ?>


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
			$('#count_divid').html($('#htmlcount' , $holder).html());
			$('#ajaxprodload_divid').html($('#html1' , $holder).html());
	 		$('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
			
			}
		});
}
</script>
<!-------------------------- search_click_filterdata suggestion end -------------------------->


<!-------------------------- search checkbox click data display start -------------------------->
<script>
function filter_dataajax(id)
{
	
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	//alert(id);
	var namev =document.getElementById('filter_productId'+id).value;
	//alert(namev);
	var fields = namev.split('|');
	var filterattribute1 = fields[0];
	var filterattribute2 = fields[1];
	var filterattribute3 = fields[2];
	
	
	
	if(document.getElementById("filter_productId"+id).checked)
	{
		
	 var div = document.createElement('span');

    div.innerHTML = '<span class="rst_spn removespan_'+id+'" onclick="removespanattr('+"'"+id+"'"+')" >'+filterattribute3+ ' <i class="fa fa-times close_filter" aria-hidden="true"></i></span>';

     document.getElementById('span_val').appendChild(div);
	}else{
		
		$(".removespan_"+id).remove();
		}
	
	
	
	
	
	
	
	
	//return false;
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
						loadviewmorebuttonajax();
						$("#filter_searchdatamtree").removeClass('disabled');
						$('#ajaxprodload_divid').show();
						$('#ajaxprodload_dividlist').show();
						$('#lodr_img').hide();
						},			
		success:function(data){
			$('#firstproduct_loader').css('display','none');
		
			var $holder = $('<div/>').html(data);
			$('#count_divid').html($('#htmlcount' , $holder).html());
			$('#ajaxprodload_divid').html($('#html1' , $holder).html());
	 		$('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
			
			}
		});
}
</script>
<!-------------------------- search checkbox click data display end -------------------------->


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

<!-------------------------- click a mtree ul li filter start -------------------------->
<script>
function click_ul_lifilter(fq,x)
{
	//alert(fq);
	//alert(x);
	if (document.getElementById('radiotextbox'+x).checked == false){ 
	var search_title ="<?php  echo $this->uri->segment(2);  ?>";
	//$('#radiotextbox'+x).attr('checked', true);
	 document.getElementById('radiotextbox'+x).checked = true;
	 if(fq!='nocatlvl')
	 {
		 $.ajax({ 
				url:'<?php echo base_url().'Product_description/click_ul_lifilter_dataajax' ?>',
				method:"post",
				data:{search_title:search_title,fq:fq},
				
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
				 $('#count_divid').html($('#htmlcount' , $holder).html());
				 $('#ajaxprodload_divid').html($('#html1' , $holder).html());
				 $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
				// var $holder = $('<div/>').html(responseHtml);
				 //$('#coupon').html($('#coupon', $holder).html());
				}
			  });
	 }
	}
}
</script>
<!-------------------------- click a mtree ul li filter end -------------------------->

<div class="container" style="width: 100%; padding: 0; background:#f3f3f3; padding:5px;">

<!------------------------------- sponsored_product start -------------------------------------->
<!--<div id="sponsored_product" class="sponsored_product">
	
</div>-->

<?php

$search_title=trim(str_replace(' ','%20',$this->uri->segment(2)));
			$curl_strng="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&wt=json&q=".$search_title."&group=true&group.query=(Spec5:*%20OR%20Spec6:*%20OR%20Spec7:*)&group.main=true";
						
			$curl2 = curl_init($curl_strng);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			$data2 = json_decode($output, true);			
			//echo '<pre>';print_r($data2);exit;
			if($data2['response']['numFound']==0)
			{
				if(count($data2['spellcheck']['collations'])){
				$sugword=$data2['spellcheck']['collations'][1];
				}else{
						$sugword=$search_title;
					 }
				$searchsuggst_txt=trim(str_replace(' ','%20',$sugword));	
				$curl_strng="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&wt=json&q=".$searchsuggst_txt."&group=true&group.query=(Spec5:*%20OR%20Spec6:*%20OR%20Spec7:*)&group.main=true";
				$curl3 = curl_init($curl_strng);
				curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
				$output3 = curl_exec($curl3);
				$data3 = json_decode($output3, true);				
				$ponsored_product_data=$data3;
				
			}
			else
			{	
				$ponsored_product_data=$data2;		
			}
		$cntt=count($ponsored_product_data['response']['docs']);
		if($cntt>0){
  ?>

<h4 class="title" style="margin-bottom:5px; font-size:28px; color:#eeac0d"><span>Sponsord Product</span> </h4>


<div style="clear:both;"></div>
<?php } ?>
<!--------------------------------- sponsored_product end ------------------------------------------->
<div style="clear:both;"></div>
<div class="row" style="position:relative;">


   <!--------------------------------- Start of Filter bar--------------------------------------->
	
   <div class="col-md-3 filter" style="width:250px; padding: 0;position: relative;background: #fff;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); margin-left:16px; min-h">
    <div style="width:50%; float:left; padding: 10px; text-align:left;"><h4 style="margin:10px 0 0 0;">Filter</h4></div>
    <!--<div style="width:50%; float:right; padding: 10px; text-align:right"><h6 style="color:blue;">Clear All</h6></div>-->
    <div style="clear:both;"></div>
    <div style="width:100%; height:auto; margin:5px 0 10px 0;" id="span_val">
    	    <!--<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>-->
    </div>
    <div style="clear:both"></div>
        
<!--------------------------- Price filtering section (FROM - TO) start ------------------------------>
	  <!--<div class="f_sidebar" style="background:#fff;">
        <section class="filter-form" style="margin: -12px 10px 10px;border: 1px solid #ececec;">
          <h4 style="background:#ececec; padding:10px 20px; margin-top: 0px; font-size:15px;">Price</h4>
              <div class="row1 scroll-pane" style="overflow: hidden; padding: 0px; width:100%;">
              <div class="jspContainer" style="width:100%; height: 110px;">
              	<div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 100%;">
                  <div class="col-sm-12">
                  <div class="jspPane" style="padding: 0px; top: 0px; left: 0px;"><div class="col col-4">
					<div class="price-range"> FROM : <br> <input type="text" name="start_pric" id="start_pric" placeholder="(Rs.)"> </div>
                    <div class="price-range"> TO :  <br> <input type="text" name="end_pric" id="end_pric" placeholder="(Rs.)"> </div>
                    <div style="width:100%; margin:auto; text-align:center;">
                    	<input class="btn-go hvr-sweep-to-right" type="button" value="Search" onclick="">
                    </div>
                    
                    
                    
                    
                  </div></div>
    
                        
                       
                        
                      </div>
            </div>
            </div>
            </div>
		</section>
        </div>-->
<!---------------------------------- Price filtering section (FROM - TO) end --------------------------->
        
		<!-- Type filtering section Start-->
 <!--<div id='search-left'>
<ul>
   <li><a href='http://google.com'><span>Home</span></a></li>
   <li><a href='http://google.com'><span>Products</span></a>
      <ul >
         <li>
                              <label class="checkbox">
                                   <input type="checkbox" id="" name="" value="" onchange="">
                                   		<i></i> Apple  
                               </label>
                               <label class="checkbox">
                               		<input type="checkbox" id="" name="" value="" onchange="">
                         			<i></i> HTC
                                </label>
                               <a  href="#1" onclick="setVisibility('more-brand', 'inline');" ;>195 More</a>
                               
                               <div style="display:none;" id="more-brand">
                               <div class="row" style="background:#f2f2f2; padding:2px 0; margin:0;">
                               		<div class="col-lg-2 padd">Brand</div>
                                    <div class="col-lg-3 padd"><input type="text" placeholder="Search Brand" class="_2rhM-s"></div>
                                    <div class="col-lg-6 alfa" ># A B C D E F G H I J K L M N O P Q R S T U V W X Y Z</div>
                                    <div class="col-lg-1 padd"><a id="more-close" href="#" onclick="setVisibility('more-brand', 'none');";>x</a></div>
                               </div>
                               	<ul class="aco" style="padding:10px;">
                                	<li class="column-more">
                                      <h5 class="search-bold">Popular</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        
                                        <h5 class="search-bold">A</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        
                                        <h5 class="search-bold">B</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        
                                        <h5 class="search-bold">C</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        
                                        
                                    </li>
                                </ul>
                              </div>
         
         </li>
         
      </ul>
   </li>
   <li><a href='#'><span>Color</span></a>
      <ul>
         <li>
         	
                               <label class="checkbox">
                                   <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> Apple  
                               </label>
                               <label class="checkbox">
                                    <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> HTC
                                </label>
        		  
         </li>
         </ul>
   </li>
   <li><a href='#'><span>Color</span></a>
      <ul>
         <li>
         	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                                       </label>
                                       <label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                        </label>  
         </li>
         </ul>
   </li>
</ul>
</div>-->
       <!-- Type filtering section end-->        
        <div class="clearfix"></div>
  <!-------Nested accordian start---------->  
<!------------------- category filter_data section Start(1->2->3->brand,clr,etc) ------------------------->
 <div class="filter_searchdatamtree" id="filter_searchdatamtree">
  <div id="mtreefb_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>
 </div>
<!-------------------------- category filter_data section end(1->2->3->brand,clr,etc) ----------------------->
  
  <!-------Nested accordian end---------->
    
   </div>
<!--------------------------------- End of Filter bar------------------------------------------------>
    <div class="col-md-9" style="width:80%; background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); float:right;">
    <div id="slider1" style="margin:0 !important;">
        <a class="buttons prev" href="#">&lt;</a>
			<div class="viewport">
				<ul class="overview best-selr-prdct" style="width: 36800px; left: -2070px;">
					<li>
						<div class="view view-fifth">
							<a style="cursor: pointer;" href="https://www.moonboy.in/mesleep-beautiful-printed-rangoli-for-festivals/221750/PKWQ-459-RG-01-01">
								<img src="https://www.moonboy.in/images/product_img/catalog_byandkisgrc91tl.jpg" alt="meSleep Beautiful Printed Rangoli For Festivals" title="meSleep Beautiful Printed Rangoli For Festivals">
							</a>
						</div>
						<div class="wish-list">
							<a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
							<i class="fa fa-heart"></i></a>
						</div>
						<!--<div class="product-title">T-Shirt</div>-->
						<div class="best-slr-data">      
							<a href="https://www.moonboy.in/mesleep-beautiful-printed-rangoli-for-festivals/221750/PKWQ-459-RG-01-01" title="meSleep Beautiful Printed Rangoli For Festivals">meSleep Beautiful Pr...</a>
							<div class="price-box">
																											<span class="regular-price"> Rs. 299 </span> &nbsp;
										<span class="price"> Rs. 149 </span> &nbsp;
																								</div>
						</div>
					</li>
			</ul>
				
	</div>
			<a class="buttons next" href="#">&gt;</a>	
</div>

<div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2000" id="myCarousel">
  <div class="carousel-inner">
  <?php
	for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
	$cdate=date("Y-m-d");
  ?>
    <div class="item <?php if($i_arr==0){echo 'active';} ?> ">
      <div class="col-md-3">
      
      		<div class="view view-fifth">
				 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($ponsored_product_data['response']['docs'][$i_arr]['Title'])))).'/'.$ponsored_product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$ponsored_product_data['response']['docs'][$i_arr]['Sku']  ?>">
				 <?php if(empty($ponsored_product_data['response']['docs'][$i_arr]['Catalog_Image'][0])){?>
                 <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="Lakme 9 to 5 Complexion Care Face Cream - Beige">
                 <?php }else{?>
                 <img src="https://www.moonboy.in/images/product_img/<?=$ponsored_product_data['response']['docs'][$i_arr]['Catalog_Image'][0];?>" alt="">
                 <?php } ?>
				</a>
			</div>
      		<div class="wish-list">
				 <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
					<i class="fa fa-heart"></i>
                 </a>
		    </div>
            
            <div class="best-slr-data">      
				 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($ponsored_product_data['response']['docs'][$i_arr]['Title'])))).'/'.$ponsored_product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$ponsored_product_data['response']['docs'][$i_arr]['Sku']  ?>" title="wallet"><?php if(strlen($ponsored_product_data['response']['docs'][$i_arr]['Title']) > 19){echo substr($ponsored_product_data['response']['docs'][$i_arr]['Title'],0,19).' ...';}else{echo $ponsored_product_data['response']['docs'][$i_arr]['Title'];} ?></a>
					<div class="price-box">
						 <!--<span class="regular-price"> Rs. 1020 </span> &nbsp;&nbsp;
						 <span class="regular-price"> Rs. 485 </span> &nbsp;&nbsp;<br>
						 <span class="price"> Rs. 399 </span>-->
                         <?php
						 if($ponsored_product_data['response']['docs'][$i_arr]['Special_Price'] !=0){
							if($cdate >= substr($ponsored_product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($ponsored_product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10)){
					?>   
                    <span class="regular-price"> Rs. <?=$ponsored_product_data['response']['docs'][$i_arr]['Mrp'] ?> </span> &nbsp;&nbsp;
                    <?php if($ponsored_product_data['response']['docs'][$i_arr]['Price'] != 0){?>
                    <span class="regular-price" style="color:#F90;"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Price']); ?> </span> &nbsp;&nbsp;<br />
                    <?php }?>  
                    <span class="price"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Special_Price']); ?> </span>
                    <!---Special price exists condition end here --->
					<?php }else{ ?>
                    <?php if($ponsored_product_data['response']['docs'][$i_arr]['Price'] != 0){?>   
                    <span class="regular-price"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span> &nbsp;&nbsp; 
                    <span class="price"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Price']); ?> </span>
                    <?php }else{?> 
                    <span class="price"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
                    <?php }?>
					<?php } //End of date condition ?>
                    <?php }else{ ?>
                    <?php if($ponsored_product_data['response']['docs'][$i_arr]['Price'] != 0){?> 

                    <span class="regular-price"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span> &nbsp;&nbsp; 
                    <span class="price"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Price']); ?> </span>
                    <?php }else{?> 
                    <span class="price"> Rs. <?=ceil($ponsored_product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
                    <?php }?>
       				<?php } ?> 
					</div>
			</div>
      </div>
    </div>
  <?php } // End of foreach loop?>
  
  
    
  </div>
  <a class="left carousel-control" style="padding-top: 10%;" href="#myCarousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
  <a class="right carousel-control" style="padding-top: 10%;" href="#myCarousel" data-slide="next"><i class="fa fa-chevron-right"></i></a>
</div>
    		<div style="width:1000%;">
            	<a href="<?php echo base_url();?>" style="color:#878787; font-size:12px;">Home > </a>
                <a href="<?php echo base_url().'search-by/'.$this->uri->segment(2); ?>" style="color:#878787; font-size:12px;">Search > </a>
                <a href="<?php echo base_url().'search-by/'.$this->uri->segment(2); ?>" style="color:#878787; font-size:12px;"><?php echo ucwords($product_data_sco['responseHeader']['params']['q']); ?> </a>
            </div>
            
            
            <div style="clear:both;"></div>
            
            <div style="width:70%; float:left;">
            	<div class="KG9X1F">
            <h2 class="_2Wy-am"><?php echo ucwords($product_data_sco['responseHeader']['params']['q']);?></h2>
            <div class="C5rIv_"  id="count_divid">
            <!--<span>(Showing 1 – <samp id="content">50</samp> products of <?php //echo $product_data_sco['response']['numFound']; ?> products)</span>-->
            </div>
            </div>
            </div>
            
            <div style="width:30%; float:right; text-align:right;">
            	<div class="dropdown_left">
			       <!--Sort By Price &nbsp;<select class="dropdown selectpicker" id="attr_size" data-style="btn-info" style="width:auto;" onchange="sortby_price(this.value,'smart-phones','71-73','NOT')">        <option value="">--Select--</option>
						  <option value="Low-To-High">Price: Low To High</option>						  
						  <option value="High-To-Low">Price: High To Low</option>
						  
					   </select>-->
                       <div class="ac" align="right" style="margin-right:19px; margin-bottom:10px;">
			<a class="button" data-rel="#content-a" id="act1" href="#" onclick="menuvisibility('menu1');">
				<i class="fa fa-th-large" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<a class="button" data-rel="#content-a" id="act2" href="#" onclick="menuvisibility('menu2');">
				<i class="fa fa-list" aria-hidden="true"></i></a>
            <!--<a class="shortby-link"><i class="short-by"></i><span id="slSrtName">Sort</span></a> --> 
            <!--<a href="#" id="act3"><i class="fa fa-sort-amount-desc ali"  aria-hidden="true"></i> <span class="sp">Sort</span></a>-->  
            <!--<a href="#" id="act4"><i class="fa fa-sort-amount-asc ali"  aria-hidden="true"></i> <span class="sp">Sort</span></a>--> 
		</div>
				 </div>
            </div>
<!--------------------------------menu 1 start -------------------------------------------->            
<div id="menu1">            
<div class="w_content">
		<div class="catlog">
		     <div class="clearfix"> </div>
		</div>
         <!-- grids_of_4 -->
		<div class="grids_of_4" id="ajaxprodload_divid">
        
        <!-- display ajax data sujit-->
         <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>
        
        
		</div>
<!-- end grids_of_4 -->

           <div class="clearfix"></div>
           
          
</div>
</div>
<!----------------------------- menu 1 end ------------------------------------------->
<!----------------------------------------------- menu 2 start ----------------------------->
<div id="menu2" style="display:none;">
<div class="w_content">
    <div class="catlog">
         <div class="clearfix"> </div>
    </div>
    
    
       
      
       <!-- grids_of_4 -->
		<div class="grids_of_4list" id="ajaxprodload_dividlist">
        
        <!-- display ajax data sujit-->
         <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>
        
        
		</div>
<!-- end grids_of_4 -->

           <div class="clearfix"></div>
           <?php /*?><div id="view_more_dv" class="list_view_morebtn" >
           		<img src="<?php echo base_url(); ?>images/loader.gif" id="lodr_img1" class="list_view_lodr_img" style="display:none;">
                				<input style="display:none;" type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">
		</div><?php */?>
      
           
</div>
</div>

<div style="width:15%; margin:auto">
<div id="view_more_dv" class="grid_view_morebtn" >
           		<img src="<?php echo base_url(); ?>images/loader.gif" id="lodr_img" class="grid_view_lodr_img" style="display:none;">
                				<input style="display:none;" type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">
</div>
</div>
<!-------------------------------------------- menu 2 end ----------------------------->
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
.grid_view_lodr_img{ width:80px; height:80px; display:none;}
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
 
<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/velocity/0.2.1/jquery.velocity.min.js'></script> -->


<script>
$('.carousel[data-type="multi"] .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}
    
    next.children(':first-child').clone().appendTo($(this));
  }
});
</script>
</body>

</html>