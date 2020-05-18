<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		
        
		<meta name="Description" content="<?php echo $data->meta_description;?>">
		<meta name="Keywords" content="<?php echo $data->meta_keywords;?>" />
		<title><?php echo $data->page_title ;?></title>

        <?php  if($this->uri->segment(1)!='filterby')
			{
				$label_name=$this->uri->segment(1);}
			else
			{$label_name=$this->uri->segment(2);}
			?>
        
     
      <link rel="canonical" href="<?php echo base_url().$label_name; ?>"/>

    	<?php include "header.php"; ?>
        <!------ Start Content ------>

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

.mtree-skin-selector {
  text-align: center;
  background: #EEE;
  padding: 10px 0 15px;
}

.mtree-skin-selector li {
  display: inline-block;
  float: none;
}

.mtree-skin-selector button {
  padding: 5px 10px;
  margin-bottom: 1px;
  background: #BBB;
}

.mtree-skin-selector button:hover { background: #999; }

.mtree-skin-selector button.active {
  background: #999;
  font-weight: bold;
}

.mtree-skin-selector button.csl.active { background: #FFC000; }
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
.flipswitch
{
   position: relative !important;
    background: white;
    width: 17px;
    height: 17px;
    /*-webkit-appearance: initial;*/
    border-radius: 3px;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    outline: none;
    font-size: 14px;
    font-family: Trebuchet, Arial, sans-serif;
    font-weight: bold;
    cursor: pointer;
    border: 2px solid #067AB4;
}

/*.checkbox input[type=checkbox] {  width: 20px;
    height: 20px;
    display: inline-block;
    border: 2px solid #067AB4;
    position: absolute;
    left: 0;
    top: 4px;}*/
/*i.fa.fa-angle-down {
    float: right;*/
}
 </style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>new_css/css/search-left-3rdsection-menu.css" />
 <script src="<?php echo base_url()?>new_js/js/search-left-3rdsection-menu.js" type="text/javascript"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.js"></script>
<!------------------------ Start active list-grid menu script -----------------> 
 <script>
	 function menuvisibility(val) {
		if(val=='menu1'){
			
			document.getElementById('menu1').style.display="block";
			document.getElementById('menu2').style.display="none";
			$("#act1").addClass("act");
			$("#act2").removeClass('act');
			
		}
		if(val=='menu2'){
			document.getElementById('menu2').style.display="block";
			document.getElementById('menu1').style.display="none";
			$("#act1").removeClass("act");
			$("#act2").addClass('act');
			
		}
	 }
</script>
<!------------------------ End active list-grid menu script ----------------->
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

<!----------------- Start scrooling script and show loader & click the view more function ----------------->
<script>
var lastScrollTop = 0;
$(window).scroll(function(event){
	//alert("hi");
   var st = $(this).scrollTop();
   if (st > lastScrollTop)
   {       
	   if($('#view_more_dv').visible(true) && $('#scrol_tracktxtbox').val()!='' )
	   {
		  $('#viewmore_prodbtnid')[0].click();
		  $('#scrol_tracktxtbox').val('');
	   } 
   } 
   lastScrollTop = st;
   
});
</script>   
<!----------------- End scrooling script and show loader & click the view more function ----------------->
<script>
 $(document).ready(function(){
	 $("#act1").addClass('act');
	});
</script>
<script>
function FilterProduct_PriceData(cat_name,cat_id,lastseg){
	var start_price = $('#start_pric').val();
	var end_price = $('#end_pric').val();
	if(start_price == '' || end_price == ''){
		alert('Please enter both price value field.');
		return false;
	}else if(isNaN(start_price) || isNaN(end_price)){
		alert('Please enter valid parice value.');
		return false;
	}else if(parseInt(start_price) >= parseInt(end_price)){
		alert('First price should be less than the Last price.');
		return false;
	}else{
		window.onload = $('#limg').css('display','block');
		
		/*window.onload = onloderimg();*/
		
		var price_slab = start_price+'-'+end_price;
		if(lastseg == 'NOT'){
			window.location.href='<?php echo base_url().'filterby/';?>' +cat_name.replace(" ","-")+'/'+cat_id+'/'+'price='+price_slab;
		}else{
			window.location.href='<?php echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&price='+price_slab;
		}
	}
}
</script>

<!----------------- Start viewmore script function ----------------->
<script>
function ShowMoreData(result_no,cat_id,lastseg){
	//alert("hi");
	var numItems = parseInt($('.grid1_of_4').length);
	var result_no = parseInt(result_no);
	
	/*if(numItems+12>result_no)
	{
		var shownumItems=result_no ;
	}else{var shownumItems=numItems+12;}
	document.getElementById("show_product_count").innerHTML = shownumItems;*/
	$.ajax({
		url:'<?php echo base_url(); ?>product_description/show_more_catalog_data',
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
			
			//$('.grids_of_4').append(result);
			var $holdermore = $('<div/>').html(result);
			$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
			$('.listview_more').append($('#htmlmore2' , $holdermore).html());
			$('#scrol_tracktxtbox').val('wait to scroll');
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
}
</script>
<!----------------- End viewmore script function ----------------->

<!----------------- Start resetFilterIndivisually script function ----------------->
<script>
<!---Reset filetring script start here --->
function resetAllFilter(){
	window.onload = $('#limg').css('display','block');
	var seg='<?php echo $this->uri->segment(2);?>';
	//alert(seg);
	if(seg!='')
	{
		window.location.href='<?php echo base_url().$this->uri->segment(2);?>';
	}
	
}

function resetFilterIndivisually(cat_name,cat_id,total_param,reset_param){
	window.onload = $('#limg').css('display','block');
	var array = total_param.split('&');
	
	var what, a = arguments, L = a.length, ax;
    while (L > 1 && array.length){
        what = a[--L];
        while ((ax= array.indexOf(what)) !== -1){
            array.splice(ax, 1);
        }
    }
    var jstring = array.join();
	var res = jstring.replace(',','&');
	if(res=='')
	{window.location.href='<?php echo base_url();?>'+cat_name.replace(" ","-");}
	else
	{window.location.href='<?php echo base_url();?>filterby/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+res;}
}
<!---Reset filetring script start here --->
</script>
<!----------------- End resetFilterIndivisually script function ----------------->
<!----------------- Start Filter color brand etc script function ----------------->
<script>
function filter_attribute(cat_name,cat_id,lastseg,attrbtype,attrbvalue,attrbsli){
	
	
		
		var new_attrbtype= attrbtype.replace(new RegExp('%20', 'g'), ' ');
		var new_attrbvalue= attrbvalue.replace(new RegExp('%20', 'g'), ' ');
		
		var lastseg= lastseg.replace(new RegExp('%20', 'g'), ' ');
		var removeedstrgn=new_attrbtype+'='+new_attrbvalue;
		
		if(lastseg!=removeedstrgn)
		{
			var removeedstrgn='&'+removeedstrgn;
		}
		//alert(removeedstrgn);alert(lastseg);return false;
		window.onload = $('#limg').css('display','block');
		if(lastseg == 'NOT'){
			window.location.href='<?php echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id+'/'+attrbtype+'='+attrbvalue;
		}else{ 
				if (lastseg.indexOf(removeedstrgn) !== -1)	
				{ 
							
					var lastseg = lastseg.replace(removeedstrgn, "");
					
					if(lastseg=='')
					{window.location.href='<?php echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id;}
					
				else if(lastseg!='')
				{
					window.location.href='<?php echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg;
				}
			}
			else{
			window.location.href='<?php echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&'+attrbtype+'='+attrbvalue;}
		}
	
	
}
</script>
<!----------------- End Filter color brand etc script function ----------------->
<!----------------- Start Filter low to high & high to low script function ----------------->
<script>
function sortby_price(sortbyprice,catgnm,cat_id,lastseg)
{
	
	window.onload = $('#limg').css('display','block');
	
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url().'filterby/';?>'+catgnm.replace(" ","-")+'/'+cat_id+'/'+'sortbyprice='+sortbyprice;
	}else{
		window.location.href='<?php echo base_url().'filterby/';?>'+catgnm.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&sortbyprice='+sortbyprice;
	}	
}
</script>
<!----------------- End Filter low to high & high to low script function ----------------->
<?php 
			//$catg_idstr=str_replace('-',',',$this->uri->segment(4));
			if($this->uri->segment(1)!='filterby')
			{
				$label_name=$this->uri->segment(1);}
			else
			{$label_name=$this->uri->segment(2);}
			
			
			
			$qr_lblid=$this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$label_name'  ");
				if($qr_lblid->num_rows()>0)
				{
					$dskcatgid_id=$qr_lblid->row()->category_id;
					$bredcum_name=$qr_lblid->row()->label_name;
					$bredcum_parnetlblbid=$qr_lblid->row()->parent_id;
						
				}
				
				
				$qrparntbrecum=$this->db->query("SELECT * FROM category_menu_desktop WHERE dskmenu_lbl_id='$bredcum_parnetlblbid' ");
				$parent_bredcumname=$qrparntbrecum->row()->label_name;
				$parent_bredcumnamelink=$qrparntbrecum->row()->url_displayname;
			
			$catg_idstr=str_replace('-',',',$dskcatgid_id);
			
			$catgstr_urlpass=str_replace(',','-',$dskcatgid_id);
			
			$query_fltrcatg=$this->db->query("SELECT * FROM product_filtersetup WHERE category_id IN ($catg_idstr) ");			
			
			if($query_fltrcatg->num_rows()>0)
			{
				$rw_filterchk=$query_fltrcatg->row();
				$price_chk=$rw_filterchk->price;
				$discount_chk=$rw_filterchk->discount;
				$seller_chk=$rw_filterchk->seller;
				
				if($price_chk==0 && $discount_chk==0 && $seller_chk==0)
				
				{
					
					$query_fltrcatgzero=$this->db->query("SELECT * FROM product_filtersetup WHERE category_id='0' ");
					if($query_fltrcatgzero->num_rows()>0)
					{			
						$rw_filterchkzero=$query_fltrcatgzero->row();
						$price_chk=$rw_filterchkzero->price;
						$discount_chk=$rw_filterchkzero->discount;
						$seller_chk=$rw_filterchkzero->seller;
						}else
						{
							$price_chk=0;
							$discount_chk=0;
							$seller_chk=0;	
						}	
							
				} // conditiond end of $price_chk==0 && $discount_chk==0 && $seller_chk==0 
				
			}
			else 
			{
				$query_fltrcatgzero=$this->db->query("SELECT * FROM product_filtersetup WHERE category_id='0' ");
				if($query_fltrcatgzero->num_rows()>0)
				{			
					$rw_filterchkzero=$query_fltrcatgzero->row();
					$price_chk=$rw_filterchkzero->price;
					$discount_chk=$rw_filterchkzero->discount;
					$seller_chk=$rw_filterchkzero->seller;
				}else
				{
					$price_chk=0;
					$discount_chk=0;
					$seller_chk=0;	
				}
			}
 ?>



<div class="container" style="width: 100%; padding: 0; background:#f3f3f3; padding:5px;">
<div class="row" style="margin-top:70px;">


   <!--------------------------------- Start of Filter bar----------------------------------------------->
	
   <div class="col-md-3 filter" style="width:250px; padding: 0;position: relative;background: #fff;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); margin-left:16px;">
   
    <div style="width:50%; float:left; padding: 10px; text-align:left;"><h4 style="margin:10px 0 0 0;">Filter</h4></div>
    <?php if($this->uri->segment(1)=='filterby'){ ?>
    <div style="width:50%; float:right; padding: 10px; text-align:right; cursor:pointer;"><h6 class="rstClear close_filter" style="color:blue;" onClick="resetAllFilter();">Clear All</h6></div>
    <?php } ?>
    <div style="clear:both;"></div>
<!-----------------------------Start close_filter------------>
    <div style="width:100%; height:auto; margin:5px 0 10px 0;">
   
    <?php
		if($this->uri->segment(4) != ''){
			$url_array = explode('&',$this->uri->segment(4));
			foreach($url_array as $key=>$val){
				$arr1 = preg_split('/=/',$val);
				$reset_filter_parameter = $arr1[0].'='.$arr1[1];
	?>
    <?php if(@$arr1[1]=='Low-To-High'||  @$arr1[1]=='High-To-Low')   { echo " ";}else{ echo "  "?>
            
    	    <span class="rst_spn" onClick="resetFilterIndivisually('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?=$this->uri->segment(4);?>','<?php echo $arr1[0].'='.$arr1[1];?>')"> <?php  echo str_replace('%20',' ',$arr1[1]); ?>&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
    <?php }  ?>        
    <?php }} //End of if foreach loop ?>        
            <!--<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>-->
    </div>
<!---------------------------------End close_filter-------------------->
    <div style="clear:both"></div>
<!------------------- Price filtering section start-->
      <?php
	  if($price_chk>0)
	  {
      //remove brand parameter if brand is already in the url parameter program start here
		if(strpos($this->uri->segment(4),'price') !== false){
			$array = explode('&',$this->uri->segment(4));
			$param = array();
			foreach($array as $key=>$val){
				$arr1 = preg_split('/=/',$val);
				if($arr1[0] != 'price'){
					//$param[] = $arr1[0].'='.$arr1[1];
					array_push($param,$arr1[0].'='.$arr1[1]);
				}
			}
			
			//making parameter array to string
			if(!empty($param)){
				$strng = implode('&',$param);
			}else{
				$strng = 'NOT';
			}
		}
		//remove brand parameter if brand is already in the url parameter program end here
		else{
			$strng = $this->uri->segment(4);
		}
      ?>
	  <div class="f_sidebar" style="background:#fff;">
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
                    	<input class="btn-go hvr-sweep-to-right" type="button" value="Search" onClick="FilterProduct_PriceData('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>')">
                    </div>
                    
                  </div></div>
                        
                      </div>
            </div>
            </div>
            </div>
		</section>
        </div>
        <?php } // price condition cehck from product_filtersetup end  ?>
<!------------------- Price filtering section end-->
        
<!----------------------------- Type filtering section Start---------------->
 <div id='search-left'>
<ul>
   <li><a href='http://google.com'><span>Home</span></a></li>
   
    <?php
//---------------------- filter slab display as per filter setup start---------------------------
			$arr_mrgattrbfldid=array();
			$arr_mrgattrbfldname=array();
			
			if($query_fltrcatg->num_rows()>0)
			{
				$rw_queryfltrcatg=$query_fltrcatg->result_array();
				foreach($rw_queryfltrcatg as $resqueryfltrdata)
				{
					$attr_fldidarr=unserialize($resqueryfltrdata['attribute_realid']);
					$attr_fldnamearr=unserialize($resqueryfltrdata['attribute_realname']);
					
					foreach($attr_fldnamearr as $arrfldkey=>$arrfldvalue)
					{
						array_push($arr_mrgattrbfldname,$arrfldvalue);	
					}
					foreach($attr_fldidarr as $arrfldidkey=>$arrfldidvalue)
					{
						array_push($arr_mrgattrbfldid,$arrfldidvalue);	
					}
				} // for loop end
			}  // filter setup main if condition end 
//------------------------ filter slab display as per filter setup end-----------------------------
		  ?>         
          <?php
		  	$uniquearr_mrgattrbfldname = array_unique($arr_mrgattrbfldname);
			$uniarr_mrgattrbfldid = array_unique($arr_mrgattrbfldid);
		 	$iattrb=0;
		  foreach($uniquearr_mrgattrbfldname as $key=>$valattrbhead){ ?>  
   <!-- Type filtering section Start-->
   
   			<li><a href=''><span><?=$valattrbhead?><i class="fa fa-angle-down" style="float: right;" aria-hidden="true"></i></span></a>
      <ul <?php if (strpos(str_replace('%20', ' ', $this->uri->segment(4)), trim('-'.$valattrbhead)) !== false){  ?>
      style="display: block;"
      <?php }?>
      >
         <li>
         	
            
            <?php 
					$attrb_reapt=array(); 
					$attrb_id=$uniarr_mrgattrbfldid[$key];
					//die("SELECT a.attr_value,a.attr_id FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE  a.attr_id='$attrb_id' AND b.lvl2 IN ($catg_idstr)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' GROUP BY REPLACE(attr_value, ' ', '') ");
					$attrbval_query=$this->db->query("SELECT a.attr_value,a.attr_id FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE  a.attr_id='$attrb_id' AND b.lvl2 IN ($catg_idstr)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' GROUP BY REPLACE(attr_value, ' ', '') ");
					if($attrbval_query->num_rows()>0)
					{ 
						//echo '';print_r($attrbval_query->result_array());
						foreach($attrbval_query->result_array() as $res_attrbval)
						{
							$attrb_reapt[]=	$res_attrbval['attr_value'];		
			?>
                     <!---------------------------checking of url start-------------------------------------------->
            <?php 
							if(count($uniquearr_mrgattrbfldname)>0){
								//remove brand parameter if brand is already in the url parameter program start here
								$attrbrealvalue=array();
								if(strpos(str_replace('%20',' ',$this->uri->segment(2)),$valattrbhead) !== false){ 
									$array = explode('&',$this->uri->segment(4));
									$param = array();
									
									foreach($array as $key=>$val){
										$arr1 = preg_split('/=/',$val);
										$attrb_attr[] = $arr1[1];
										if($arr1[0] != $valattrbhead){
											//$param[] = $arr1[0].'='.$arr1[1];
											array_push($param,$arr1[0].'='.$arr1[1]);
											
										}
										$attrbrealvalue[]=str_replace('%20',' ',$arr1[1]);
									}
									
									//making parameter array to string
									if(!empty($param)){
										$strng = implode('&',$param);
									}else{
										$strng = 'NOT';
									}
								}
								//remove brand parameter if brand is already in the url parameter program end here
								else{
									$strng = $this->uri->segment(4);
									//$uniarr_mrgattrbfldid = array();
								}
								
		
			?>
                <!----------------------------checking of url end---------------------------------------------->
               <?php 
			   if($valattrbhead=='COLOR' || $valattrbhead=='Color' || $valattrbhead=='color' || strpos($valattrbhead, 'COLOR') !== false || strpos($valattrbhead, 'color') !== false || strpos($valattrbhead, 'Color') !== false) 
			    { if($res_attrbval['attr_value']!='' && in_array(trim($res_attrbval['attr_value']),$attrb_reapt)){
			   ?>
         
         
         
         
         		<label class="checkbox" style="font-size: 14px;color: #A9A8A8;line-height: 1;">
                     <input type="checkbox" 
                     <?php
                     if (strpos(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval['attr_value'])) !== false)
					 {echo "Checked disabled";}
                     ?>
                     
                     class="flipswitch" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval['attr_value'])?>" onchange="filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>')">
                       
                       <i class="fa fa-circle" aria-hidden="true" style="border:#FFF; color:<?php echo trim($res_attrbval['attr_value']);?>;"></i>
                       
                       <span><?php echo trim($res_attrbval['attr_value']);?> </span> 
                </label>
         	  
         
         
         
         
         
         
          <?php }} else { 
				 if($res_attrbval['attr_value']!='' && in_array(trim($res_attrbval['attr_value']),$attrb_reapt)){
		  ?>
         
         		<label class="checkbox" style="font-size: 14px;color: #A9A8A8;line-height: 1;" >
                     <input type="checkbox"  
                     <?php
                     if (strpos(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval['attr_value'])) !== false)
					 {echo "Checked disabled";}
                     ?>
                     
                      class="flipswitch" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval['attr_value'])?>" onchange="filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>')">
                      <span> <?php echo trim($res_attrbval['attr_value']);?>  </span>
                </label>
         	  
         
         
         <?php }} ?> 
         <?php
						} // for loop end 
						$iattrb++;
					 } 
					 
		}?>
              <!--<label class="checkbox">
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
                              </div>-->
         
         </li>
         
      </ul>
   </li>
   <!-- Type filtering section end-->        
        
        <?php  } ?>
   
   
   
   
   <!--<li><a href=''><span>Products</span></a>
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
   </li>-->
   
   
</ul>
</div>
<!------------------------------ Type filtering section end---------------->        
        <div class="clearfix"></div>

   </div>
   <!--------------------------------- End of Filter bar-------------------------------------------------->
    <div class="col-md-9" style="width:80%; background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); float:right;">
    <!-- Breedcum start--> 
    		<div style="width:1000%;">
            	<a href="<?php echo base_url(); ?>" style="color:#878787; font-size:12px;">Home > </a>
                <a href="<?php  echo base_url().'category/'.$parent_bredcumnamelink ?>" style="color:#878787; font-size:12px;"><?=$parent_bredcumname?> > </a>
                <a href="<?php echo base_url().$label_name ?>" style="color:#878787; font-size:12px;"><?=$bredcum_name?> </a>
            <span >(Total: <?=$no_of_product;?> products) </span>
            </div>
     <!-- Breedcum end-->        
             
            <div style="clear:both;"></div>


<!------------- Start of (Showing 1 – 12</samp> products of 100 products) ------------->            
            <div style="width:70%; float:left;">
            	<div class="KG9X1F">
            <h2 class="_2Wy-am"><?=$bredcum_name?></h2>
            <div class="C5rIv_">
            <!--<span>(Showing 1 – <samp id="show_product_count">12</samp> products of <?php /*?><?=$no_of_product;?><?php */?> products)</span>-->
            </div>
            </div>
            </div>
<!------------- end of (Showing 1 – 12</samp> products of 100 products) ------------->            
            
<!------------- Start of act grid list & Sort menu 1 -------------> 
            <div style="width:30%; float:right; text-align:right;">
            	<div class="dropdown_left">
			       
                       <div class="ac" align="right" style="margin-right:19px; margin-bottom:10px;">
			<a class="button" data-rel="#content-a" id="act1" href="#" onclick="menuvisibility('menu1');">
				<i class="fa fa-th-large" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<a class="button" data-rel="#content-a" id="act2" href="#" onclick="menuvisibility('menu2');">
				<i class="fa fa-list" aria-hidden="true"></i></a>
            <!--<a class="shortby-link"><i class="short-by"></i><span id="slSrtName">Sort</span></a> --> 
            <!--<a href="#" id="act3"><i class="fa fa-sort-amount-desc ali"  aria-hidden="true"></i> <span class="sp">Sort</span></a>-->  
            <!--<a href="#" id="act4"><i class="fa fa-sort-amount-asc ali"  aria-hidden="true"></i> <span class="sp">Sort</span></a>--> 
            <select class="dropdown selectpicker" id="attr_size"  data-style="btn-info" style="width:auto; vertical-align:top" onChange="sortby_price(this.value,'<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>')" >        <option value=''>-- New Arrival --</option>
						  <option value="Low-To-High" <?php if(@$arr1[1]=='Low-To-High') {echo "selected";}?> >Price: Low To High</option>						  
						  <option value="High-To-Low" <?php if(@$arr1[1]=='High-To-Low') {echo "selected";}?>>Price: High To Low</option>
						  
					   </select>
		</div>
				 </div>
            </div>
<!------------- end of act grid list & Sort menu 1 -------------> 

<!--------------------------------------- Start of menu 1 ------------------------------------------>            
<div id="menu1">          
<div class="w_content">
		<div class="catlog">
		     <div class="clearfix"> </div>
		</div>
        <?php //echo '<pre>';print_r($product_data->result());exit?>
<!------------------------- start grids_of_4 menu1-->
		<div class="grids_of_4" id="catlog_dv">
        <?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
		if($row>0){
		foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw->special_pric_from_dt;
			$special_price_to_dt = $rw->special_pric_to_dt;
			$dsply_img = $rw->catelog_img_url;
			$image_arr=explode(',',$rw->catelog_img_url);
			$quantity=$rw->quantity;
		?>
        <div class="grid1_of_4 catlg">
                <div class="content_box <?php 
if($rw->special_price!=0)
{
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{
		echo 'discount-off';
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount-off';
				}
			}
		 }
}else{
		if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount-off';
				}
				
			}
	 }
?>">
                
                 
                    
                    <?php 
if($rw->special_price!=0)
{
	
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{ ?>
		<h6><?php echo round(100-($rw->special_price/$rw->mrp*100)) ?>% <br>OFF</h6>
        <?php
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
				 ?>
				<h6><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% <br>OFF</h6>
			<?php }}
		 }
}else{
		if($rw->price!=0)
			{ 
			if($rw->price!=$rw->mrp)
				{
			?>
				<h6><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% <br>OFF</h6>
			<?php }}
	 }
?>
                    
                    
                    
                    
                    
                    
                    
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
                     <?php if(empty($dsply_img)){?>
                        <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name ?>">
                     <?php }else{?>
                     	<img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name.'_moonboy' ?>">
                     <?php }?>
                     </a>
                 </div>
                  <div class="wish-list"> 
                  <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$rw->product_id; ?>,'<?=$rw->sku; ?>')"> <i class="fa fa-heart"></i> </span>
            <?php }else{ ?>
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                    <?php }?>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
                        <?php if(strlen($rw->name) > 30){ echo substr($rw->name,0,30).'...';}else{ echo $rw->name;}?> 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <!--<div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i>999</div>
                        <div class="original-price" style="color:#ff7e00;"><i class="fa fa-inr" aria-hidden="true"></i>666</div>&nbsp;
                        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i>539</div>-->
                        
                        
                        
                        <?php
		if($rw->special_price !=0){
			//$cdate=time();
			if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt){
		?>
        
		
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i><?=$rw->mrp; ?></div>
        <?php if($rw->price != 0){?>
        <div class="original-price" style="color:#ff7e00;"><i class="fa fa-inr" aria-hidden="true"></i><?=ceil($rw->price); ?></div>
        <?php }?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i><?=ceil($rw->special_price); ?></div>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw->price != 0){?>
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->price); ?> </div>
        <?php }else{?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw->price != 0){?>
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->price); ?> </div>
        <?php }else{?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <?php }?>
		
        <?php } ?>
                        
                        
                        
                    </div>
                    <?php if($rw->quantity==0){?>
                    <div class="out-of-stock"><span>Out Of Stock</span></div>
                    <?php }?>
        		</div>
             </div>
        </div>
        <?php }}else{?>
        <div>NO Record Found</div>
		<?php }}?>
        
    	
</div>
<!-------------------------- end grids_of_4 menu1-->
        <div class="clearfix"></div>
          
</div>
</div>
<!--------------------------------------- End of menu 1 ------------------------------------------>
<!--------------------------------------- Start of menu 2 ------------------------------------------>
<div id="menu2" style="display:none;">
<div class="w_content">
    <div class="catlog">
         <div class="clearfix"> </div>
    </div>
    <?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
		if($row>0){ ?>
<!----------------------------- start listview_more menu2-->
			<div class="listview_more">
            <?php
		foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw->special_pric_from_dt;
			$special_price_to_dt = $rw->special_pric_to_dt;
			$dsply_img = $rw->catelog_img_url;
			$image_arr=explode(',',$rw->catelog_img_url);
			$quantity=$rw->quantity;
		?>
      <div class="row catlog " style="padding-top:10px;">
           	<div class="col-lg-3 catlg">
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
                     <?php if(empty($dsply_img)){?>
                        <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name ?>">
                     <?php }else{?>
                     <img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name.'_moonboy' ?>">
                     <?php }?>
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <?php if($rw->quantity==0){?>
				<div class="out-of-stock"><span>Out Of Stock</span></div>
                <?php }?>
        </div>
        <div class="col-lg-7 liner-shadow">
        	<div class="listing-title">
            <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
            <?php  echo $rw->name;?>
            </a>
            </div>
            <div style="clear:both;"></div>
            <p style="margin-left:0px; float:left; display:inline-block; margin-bottom:0;">
               <!--<span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; 14500
			   </span>&nbsp;&nbsp;
               <span style="color:#F90;text-decoration:line-through;font-size: 18px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp;
 29790 </span>&nbsp;&nbsp;
			   <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; 12200
               </span>-->
			   <?php
		if($rw->special_price !=0){
			//$cdate=time();
			if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt){
		?>
        		<span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=$rw->mrp; ?>
			   </span>&nbsp;&nbsp;
               <?php if($rw->price != 0){?>
               <span style="color:#F90;text-decoration:line-through;font-size: 18px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw->price); ?> </span>&nbsp;&nbsp;
 			   <?php }?>
               <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->special_price); ?>
               </span>
               <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw->price != 0){?>
              <span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
			   </span>&nbsp;&nbsp; 
              <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->price); ?>
               </span>
              <?php }else{?>
              <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
               </span>
       		  <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw->price != 0){?>
        	  <span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
			   </span>&nbsp;&nbsp;
               <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->price); ?>
               </span>
         <?php }else{?>
        	  <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
               </span>
               <?php }?>
		
        <?php } ?>
            </p>
            <div style="clear:both;"></div>
            <div class="payment-mode">
                <ul>
                <li> <span> COD </span> Cash on Delivery </li>
                 <li> <i class="fa fa-exchange"></i> 100% Replacement Guarantee. </li>
                 <?php if($rw->prod_status !='Active' || $rw->prod_status !='Active'){?> 
                 <li><b style="color:#900; font-size:18px;">
			Product has been Discontinued</b></li>
            <?php }?>
                </ul>
                <div class="clearfix"> </div>
                 
                </div>
        </div>
        <div class="col-lg-2" style="text-align:center;">
        	<p style="margin-left:0px; float:left; display:inline-block;">
			   <span style="display:inline-block;"><div class="<?php 
if($rw->special_price!=0)
{
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{
		echo 'discount';
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount';
				}
			}
		 }
}else{
		if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount';
				}
				
			}
	 }
?>">




				<?php 
if($rw->special_price!=0)
{
	
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{ ?>
		<p><?php echo round(100-($rw->special_price/$rw->mrp*100)) ?>% OFF</p>
        <?php
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
				 ?>
				<p><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% OFF</p>
			<?php }}
		 }
}else{
		if($rw->price!=0)
			{ 
			if($rw->price!=$rw->mrp)
				{
			?>
				<p><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% OFF</p>
			<?php }}
	 }
?>
                
                
                
			</div></span>
            </p>
        </div>
      </div>
      <?php }}else{?>
		  
		  <div>NO Record Found</div>
		 <?php  }}?>
        
 </div>
<!----------------------------- end listview_more menu2-->
        <div class="clearfix"></div>
             
</div>
</div>
<!--------------------------------------- End of menu 2 ------------------------------------------>
<div style="clear:both;"></div>
<!----------------------- start of View More btn show more data -------------->
<div id="view_more_dv">
           		<img src="<?php echo base_url(); ?>images/loader.gif" id="lodr_img" style="display:none;">
                <?php if($no_of_product > $sl){ ?>
                				<input type="button" id="viewmore_prodbtnid" class="add-to-cart view_mor" value="View More" name="button" onclick="ShowMoreData('<?=$no_of_product;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $this->uri->segment(4);}else{ echo 'NOT';}?>')">
                                <input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
                <?php }	?>
		</div>
<!------------------------ End View More btn show more data ---------->    
    </div>
</div>


  
</div> 
  <div class="clearfix">&nbsp;</div>
 

    
 <?php include "footer.php" ?> 

<!------------------------ Start add to wishlist script ----------------->    
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
<!------------------------ End add to wishlist script ------------> 
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

</body>

</html>>>>>>>>>>>