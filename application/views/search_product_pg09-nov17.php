
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
				
				$curl_strng=SOLR_BASE_URL.SOLR_CORE_NAME."/select?indent=on&q=".$searchsuggst_txt."&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=50&start=0";
				
				
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
    height: 2px;
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
    margin-bottom: 4px;
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
.dropdown {
    padding: 3px 10px;
    border: 1px solid #6bb700;
    margin: 0;
    width: 90%;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url(<?php echo base_url();?>new_css/css/menu_images/down-arw.png) center right no-repeat #f8f8f8;
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
	font-weight:normal;
}
/*top slider start*/

/*.carousel-inner {
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
}*/
/*top slider end*/
.disabled:after {
    position: absolute;
    content: "";
    display: block;
    background: white;
    opacity: 0.5; 
    z-index: 999;
    left: 0;
    top: 0;
    bottom: 0;
	height:2000px;
    right: 0;
  }
  
 .single-bottom label { 
display: block; 
position:relative; 
color: #000; 
font-weight:normal;
padding-left:30px;
margin-bottom:10px;
 }
.single-bottom label:hover{color: #fff; }
.single-bottom input[type="checkbox"] {  display: none;}
.single-bottom input[type="checkbox"]+label span:first-child {
	width:20px; 
	height:20px; 
	display: inline-block; 
	border: 2px solid #333; 
	position: absolute; 
	left: 0; top: 4px;
}
.single-bottom input[type="checkbox"]+label span:hover {
	border: 2px solid #fff; 
}
.single-bottom input[type="checkbox"]:checked+label span:first-child:before { content: ""; background: url(<?php echo base_url(); ?>mobile_css_js/images/mark1.png) no-repeat; position: absolute; left:2px; top:2px;  font-size: 10px; width:16px; height:16px; }
.single-bottom [type="radio"] {display:none;}
/* the basic, unchecked style */
.single-bottom [type="radio"] + span:before { content: ''; display:inline-block; width:20px; height:20px; border-radius: 50px; border: 2px solid #fff; box-shadow: 0 0 0 3px #ccc;margin-right:10px; transition: 0.5s ease all; position: absolute; top:4px; left:0;}
/* the checked style using the :checked pseudo class */
.single-bottom [type="radio"]:checked + span:before { background: #067AB4; box-shadow: 0 0 0 3px #ccc;} 
  
  /*******************Selected filter box design***************************************/
.select-filter-box{
	height:70px;
	overflow-y:scroll;
	background:#fff;
	border: 1px solid #8eb7c0;
} 
  
.filter-box{width:50%; float:left; padding:0px 5px; text-align:left;}  
.filter-box h4{margin:2px 0 0 0;}
.clearall-box{
	width:50%; float:right; padding:0px 5px; text-align:right;
}
.clearall-box h6{
	display:block; color:blue; cursor:pointer;margin:2px 0 0 0;
}
.catlog {
    text-align: left;
    border-bottom:none;
}
.text-center {
  text-align: center;
}

.font-size-24 {
  font-size: 24px;
  color: #fff;
}
.s-ref-price-currency {
    position: absolute;
    margin-top: 6.5px;
    line-height: 30px;
    font-size: 100%;
}
.s-ref-small-padding-left {
    padding-left: 9px;
}

.a-color-base {
    color: #111!important;
}
.a-input-text{
    background-color: #fff;
    height: 31px;
    padding: 3px 7px;
    line-height: normal;
	border: 1px solid #a6a6a6;
    border-top-color: #949494;
    border-radius: 3px;
    box-shadow: 0 1px 0 rgba(255,255,255,.5), 0 1px 0 rgba(0,0,0,.07) inset;
    outline: 0;
	color: #111;
	transition: all .1s linear;
}
.a-spacing-top-mini {
    margin-top: 6px!important;
}
.s-ref-price-range {
    width: 65px;
}
.s-ref-price-padding {
    padding-left: 18px;
}
.s-small-margin-left {
    margin-left: 4px;
}
.a-button {
/*    background: #e7e9ec;
    border-radius: 3px;
    border-color: #ADB1B8 #A2A6AC #8D9096;
    border-style: solid;
    border-width: 1px;
*/    cursor: pointer;
    display: inline-block;
    padding: 0;
    text-align: center;
    text-decoration: none!important;
    vertical-align: middle;
}
.a-button-inner {
    display: block;
    position: relative;
    overflow: hidden;
    height: 29px;
}
.a-button-input {
    position: absolute;
    background-color: transparent;
    color: transparent;
    border: 0;
    cursor: pointer;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
    opacity: .01;
    outline: 0;
    overflow: visible;
    z-index: 20;
	transition: all .1s linear;
    line-height: 19px;
}

.a-button .a-button-text {
    color: #111;
    background-color: transparent;
    border: 0;
    display: block;
    font-size: 13px;
    margin: 0;
    outline: 0;
    text-align: center;
    white-space: nowrap; 
}
#search-left {
    border-radius: 5px;
}
.cata-head{
	padding: 4px;
    margin: 4px 0 0 0;
    background:rgba(140, 130, 130, 0.5);
    border: 1px solid #8eb7c0;border-radius: 5px 5px 0 0;
	color:#fff;
}
.cata-head h4{
	padding: 1px; margin: 0;display:inline-block;vertical-align: middle; color:#fff;
}
 .thumbnail {
    margin-bottom: 0;
    text-align: center;
}
.product-title{
	font-size: 15px;
    font-weight: bold;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
	text-align: center;
	font-family: Roboto, Arial, sans-serif;
    letter-spacing: 0;
}
.price{
	font-size:15px!important;
}
.carousel-control {
    padding-top: 13%;
    width: 1%;
}
.row1 {
    height: 175px;
	
}
.trend-state {
    height: 45px;
    padding: 13px 0;
    text-align: center;
	background:#e3e3e3;
    -webkit-transition: all .3s ease-out;
    -moz-transition: all .3s ease-out;
    -ms-transition: all .3s ease-out;
    -o-transition: all .3s ease-out;
    transition: all .3s ease-out;
}
.trend-state .heading {
    padding: 0;
    margin-bottom: 5px;
    font-size: 14px;
    
    color: #333;
    text-overflow: ellipsis;
    -webkit-line-clamp: 1;
    overflow: hidden;
    -webkit-box-orient: vertical;
    max-height: 15px;
    white-space: nowrap;
    width: 80%;
    margin: 0 auto 10px;
    height: 21px;
	font-weight:bold;
}
.trend-state .item-count {
    font-size: 14px;
    color: #999;
}
.catagory-row{
	margin-top:10px; 
	margin-bottom:20px;
}
.catagory-col{
	width:100%;
	margin:auto;
	border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 1px 35px 0 rgba(0,0,0,0.1);
    background: #fff;
    -webkit-transition: all .3s ease-out;
    -moz-transition: all .3s ease-out;
    -ms-transition: all .3s ease-out;
    -o-transition: all .3s ease-out;
    transition: all .3s ease-out;	
}
.catagory-col-img-held{
	width:100%;
	 margin:auto; 
	 text-align:center;
	 height: 240px;
	     padding: 7px 0px;
	 /*background:linear-gradient(to left, #3a6186 , #89253e);*/
}
.catagory-col-img-held img{
	width: auto; 
	height: auto;  
	max-height: 100%; 
	max-width: 100%; 
	margin: auto;
}
.content_box {
    position: relative;
/*    box-shadow: 0 1px 35px 0 rgba(0,0,0,0.1);
*/    border-radius: 5px;
}
.product-catgry-name {
    font-size: 17px;
    margin: 0px;
    line-height: inherit;
    /* height: 50px; */
    padding: 10px 0;
    text-align: center;
    border-radius: 0 0 5px 5px;
    color: #333;
    font-weight: bold;
}
.view-fifth {
    margin: auto;
}
.grid1_of_4 {
   width: 23%;
   margin: 1%
}
.catagory-row {
    margin-top: 0px;
    margin-bottom: 0px;
}

.col-md-1{ height:100px;}
#news-container1
{
	width: 100%; 
	margin: auto;
	background-color: #e95546;
	height: 356px !important;
}
#news-container1 ul li{
	height:auto !important;
	border-bottom: 1px dotted #fff;
}

 #news-container1 ul li a  { 
 width: 100%;
   height: 40px;
    line-height: 25px;
    display: block;
    text-align: center;
    margin: 7px auto;
    font-size: 17px;
    overflow: hidden;
    font-family: 'Microsoft Yahei';
	    color: #fff;
		}
  #news-container1 ul li p {
    height: 55px;
    line-height: 18px;
    overflow: hidden;
    font-size: 14px;
	color: #fff;
    padding: 0 5px;
	text-align:center;
	
}

/*****************************news tixker repeat start************************************/
#news-container2
{
	width: 100%; 
	margin: auto;
	background-color: #e95546;
	height: 356px !important;
}
#news-container2 ul li{
	height:auto !important;
	border-bottom: 1px dotted #fff;
}

 #news-container2 ul li a  { 
 width: 100%;
   height: 40px;
    line-height: 25px;
    display: block;
    text-align: center;
    margin: 7px auto;
    font-size: 17px;
    overflow: hidden;
    font-family: 'Microsoft Yahei';
	    color: #fff;
		}
  #news-container2 ul li p {
    height: 55px;
    line-height: 18px;
    overflow: hidden;
    font-size: 14px;
	color: #fff;
    padding: 0 5px;
	text-align:center;
	
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
/*.section {
  float: right;
  width: 80%;
  padding: 5px;
}

.aside {
  float: left;
  width: 20%;
  padding: 5px;
}
.point-stick {
  position: relative;
  top:0;
}

.footer {
  display: block;
  clear: both;
}
.fixed {  position: fixed; top: 10%; }
*/
#sticky {
    padding: 0.5ex;
    width: 20%;
    height:auto;
    color: #fff;
    border-radius: 0.5ex;
    float:left;
}
#sticky.stick {
    position: fixed;
    top: 0;
    z-index: 10;
    border-radius:0.5ex;
}
.content-holder {
  margin-left:21%;
  padding:10px;
}
#footer {
  width:100%;
  height:auto;
  z-index:999999
 }
</style>
<script type="text/javascript" src="<?php echo base_url();?>new_js/js/jquery.vticker-min.js"></script>
<script type="text/javascript">
$(function(){
	$('#news-container1').vTicker({ 
		speed: 500,
		pause: 3000,
		animation: 'fade',
		mousePause: false,
		showItems: 3
	});
});

$(function(){
	$('#news-container2').vTicker({ 
		speed: 500,
		pause: 3000,
		animation: 'fade',
		mousePause: false,
		showItems: 3
	});
});

$(function(){
	$('#news-container3').vTicker({ 
		speed: 500,
		pause: 3000,
		animation: 'fade',
		mousePause: false,
		showItems: 3
	});
});
</script>
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
	//alert('more');
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
			var e = document.getElementById("pricesortid");
			var sort_val = e.options[e.selectedIndex].value;
			if(sort_val=='')
			{
<!------------------ segmented3 normal more start ----------------------------->				
			//alert("segmented3 normal more start");
			//return false;
			
			var qsearch_title='<?php echo base64_decode($this->uri->segment(3));?>';
			var fqq='<?php echo base64_decode($this->uri->segment(4));?>';
			var result_no = parseInt(result_no);
			var numItems = parseInt($('.grid1_of_4').length);
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
							  $('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
						var numItems = parseInt($('.grid1_of_4').length);
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
									$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
	var e = document.getElementById("pricesortid");
	var sort_val = e.options[e.selectedIndex].value;
	//alert(sort_val);
	if(sort_val=='')
	{
<!------------------------- normal filter more start ----------------------------->
	//alert("normal filter more start");	
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
<!------------------------- normal filter more start ----------------------------->
	}else{
<!------------------------ u r in normal price short search more start ------------------------>
			//alert('u r in normal price short search more');
			var numItems = parseInt($('.grid1_of_4').length);
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
						$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
			
					var e = document.getElementById("pricesortid");
					var sort_val = e.options[e.selectedIndex].value;
	
					if(sort_val!='')
					{
<!---------------------------- radio product price sort more start ----------------------------------------------->						
						//alert("radio product price sort more start");
						
						  var numItems = parseInt($('.grid1_of_4').length);
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
								  $('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
						  //alert("radio product normal more start");
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
<!---------------------------- radio product normal more end ----------------------------------------------->			
						}
<!---------------------------- radio product more end ----------------------------------------------->		
		 }
		
		
		
		
		
		
		
		
		
		}else{
<!---------------------------- chkd product more start ----------------------------------------------->	
			var e = document.getElementById("pricesortid");
			var sort_val = e.options[e.selectedIndex].value;
			if(sort_val!='')
			{
<!---------------------------- chkd product price sort more start ----------------------------------------------->				
				//alert('chkd product price sort more start');
				var numItems = parseInt($('.grid1_of_4').length);
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
							  $('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
			//alert('chkd product normal more start');
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
<!---------------------------- chkd product normal more end ----------------------------------------------->				
			}
<!---------------------------- chkd product more end ----------------------------------------------->			
		}
 }else{
	 	price_filtermore(low_price,high_price,result_no);
	  }
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
	 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
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
	
	var srch_data ="<?php  echo $this->uri->segment(2);  ?>";
	$.ajax({
		 
		url:'<?php echo base_url().'Product_description/filter_product_mtree' ?>',
		
		type:"POST",
		data:{search_data:srch_data},
		success:function(data){			
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
       //loadviewmorebuttonajax();
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
			$('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
			
			}
		});
}
</script>
<!-------------------------- search_click_filterdata suggestion end -------------------------->


<!-------------------------- search checkbox click data display start -------------------------->
<script>
function filter_dataajax(id)
{
	document.getElementById('low_price').value='';
	document.getElementById('high_price').value='';
	$("#remove_price_tag").remove();
	
	document.getElementById("filterdivid").style.display = "block";
	document.getElementById('pricesortid').value='';
	document.getElementById("clearallid").style.display = "block";
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
						//loadviewmorebuttonajax();
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
			$('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
			
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
	/*document.getElementById("filter_productId"+id).checked = false;
	$(document).ready(function(){
    setTimeout(function(){
       filter_dataajax(id)
     },1); // milliseconds
	});
	$(document).ready(function(){
    setTimeout(function(){
       $(".removespan_"+id).remove();
     },1000); // milliseconds
	});*/
	var str =document.getElementById('filter_productId'+id).value;
	
	document.getElementById("filter_productId"+id).checked = false;
	if(str.search("|Brand|")!=-1)
	{
		//alert('ss');
		arrck();
	}
	filter_dataajax(id);
	$(".removespan_"+id).remove();
	 
}
</script>
<!-------------------------- after select checkbox remove span end -------------------------->

<!-------------------------- click a mtree ul li filter start -------------------------->
<script>

function spanblock(search_title,mtree2id,Category_Lvl3_Id)
{
	
	if($("#2ndckboxid"+mtree2id).prop('checked') == true){
			mtree2(search_title,mtree2id,Category_Lvl3_Id);
		}
	$(".2ndliclass").css('display','block');
	$(".spanclass").css('display','none');
	$("input[name='filter_productId[]']:checkbox").prop('checked', false);
	$("#span_val").html('');
}

function li2bdblocknone(xid)
{
	$(".2ndliclass").css('display','none');
	$("#2ndspan"+xid).css('display','inline-block');
	$("#2ndliid"+xid).css('display','block');
}



function liblock()
{
	$(".liclass").css('display','block');
	$("#backtoall").css('display','none');
}

function liblocknone(xid)
{
	$(".liclass").css('display','none');
	$("#backtoall").css('display','inline-block');
	$("#liid"+xid).css('display','block');
}

function click_ul_lifilter(fq,x)
{
	//alert(fq);
	//alert(x);
	
	document.getElementById('low_price').value='';
	document.getElementById('high_price').value='';
	$("#remove_price_tag").remove();
	
	
	
	
	
	document.getElementById('pricesortid').value='';
	document.getElementById("clearallid").style.display = "block";
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
				 $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
				// var $holder = $('<div/>').html(responseHtml);
				 //$('#coupon').html($('#coupon', $holder).html());
				}
			  });
	 }
	}
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

<!----------------------------------- pricesort start --------------------------------------->
<script>
function pricesort(sort_val)
{
	//alert("pricesort");
	//alert(sort_val);
	//$('#view_more_dv').html('<img src="<?php //echo base_url(); ?>images/loader.gif" id="lodr_img" class="grid_view_lodr_img" style="display:none;"> <input style="display:none;" type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">');
	//return false;
	
	
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



<!-------------------- mtree2 start -------------------->
<script>
function mtree2(search_title,mtree2id,Category_Lvl3_Id)
{
	
	if($("#2ndckboxid"+mtree2id).prop('checked') == true)
	{
		
		$("#plus_minus"+mtree2id).removeClass("fa-minus");
		$("#plus_minus"+mtree2id).addClass("fa-plus");
		
	$('.mtree22').css('display','none');
	document.getElementById("2ndckboxid"+mtree2id).checked = false;
	//$('#mtree2'+mtree2id).css('display','block');
	}else{
		//$('#checkboxes').find('input:checkbox').prop('checked', checked);
		$("#plus_minus"+mtree2id).removeClass("fa-plus");
		$("#plus_minus"+mtree2id).addClass("fa-minus");
		
		var ndckboxclass = $('input[name="2ndckboxclass[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	//alert(ndckboxclass.length);
	for (i = 0; i < ndckboxclass.length; i++) {
	document.getElementById(ndckboxclass[i]).checked = false;
	}
		//ndckboxclass=ndckboxclass.toString();
		//document.getElementById(ndckboxclass).checked = false;
		document.getElementById("2ndckboxid"+mtree2id).checked = true;
		$('.mtree22').css('display','none');
		$('#mtree2'+mtree2id).css('display','block');
		 }
	
	
	
	if($("#ckboxid"+mtree2id).prop('checked') == false)
	{
		//alert('if');
	document.getElementById("ckboxid"+mtree2id).checked = true;
	$.ajax({
		url:'<?php echo base_url().'Product_description/mtree2' ?>',
		method:"post",
		data:{search_title:search_title,mtree2id:mtree2id,Category_Lvl3_Id:Category_Lvl3_Id},
		success:function(data){
			//alert(data);
			//$("#mtreefb_loader").css('display','none');
			$(".mtree2"+mtree2id).html(data);
			}
		});
	
	}else{
		//alert('else');
		 }
	
}
</script>
<!-------------------- mtree2 end -------------------->
<!--------------------------price_filter_function from-to start-------------------->
<script>
function price_filter()
{
	
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
	
	document.getElementById("filterdivid").style.display = "block";
	document.getElementById("clearallid").style.display = "block";
	var div = document.createElement('span');

    div.innerHTML = '<span class="rst_spn" id="remove_price_tag" onclick="remove_price_tag()" >'+low_price+'-'+high_price+' <i class="fa fa-times close_filter" aria-hidden="true"></i></span>';
	 $("#remove_price_tag").remove();
     document.getElementById('span_val').appendChild(div);
	
	
	
	
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	if(checked_product!=''){
<!-------------------------- u r in checked_product price filter from-to start -------------------------->	
		//alert('u r in checked_product from-to');
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
						//alert('u r in segment3 price from-to');
						
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
									 $('#count_divid').html($('#htmlcount' , $holder).html());
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
	
	var numItems = parseInt($('.grid1_of_4').length);
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	if(checked_product!=''){
<!-------------------------- u r in checked_product price filter from-to start -------------------------->	
		//alert('u r in checked_product from-to more');
		
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
										$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
										$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
										$('.grids_of_4').append($('#htmlmore1' , $holdermore).html());
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
				
				
				
			 }
}
</script>
<!--------------------------price_filter_more function from-to end--------------------------->
<!--------------------------remove_price_tag start--------------------------->
<script>
function remove_price_tag()
{
	//alert('remove_price_tag');
	document.getElementById('low_price').value='';
	document.getElementById('high_price').value='';
	$("#remove_price_tag").remove();
	var search_title ="<?php  echo $this->uri->segment(2);  ?>";
	
	var checked_product = $('input[name="filter_productId[]"]:checked').map(function(_, el){
       	return $(el).val();
   	}).get();
	
	if(checked_product!=''){
    //alert('checked_product');
	
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
			$('#count_divid').html($('#htmlcount' , $holder).html());
			$('#ajaxprodload_divid').html($('#html1' , $holder).html());
	 		$('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
			$('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
			
			}
		});
    
    }else{
				
				var radiochecked_product = $('input[name="ul_liradio"]:checked').map(function(_, el){
       				return $(el).val();
   					}).get();
	
	//alert(radiochecked_product);return false;
					if(radiochecked_product=='')
					{
                    //loadfirstproductsearchajax();
					<?php if($this->uri->segment(3)!=''){ ?>
                    
                    //alert('seg3');
					var qsearch_title='<?php echo str_replace('/','',base64_decode($this->uri->segment(3)));?>';
					var fqq='<?php echo str_replace('/','',base64_decode($this->uri->segment(4)));?>';
					$.ajax({
							  url:'<?php echo base_url(); ?>Product_description/search_click_filterdata',
							  method:'post',
							  data:{fqq:fqq,qsearch_title:qsearch_title,start_from:'0'},
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
		
                                  var $holder = $('<div/>').html(data);
                                  $('#count_divid').html($('#htmlcount' , $holder).html());
                                  $('#ajaxprodload_divid').html($('#html1' , $holder).html());
                                  $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
                                  $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
								  }
							  
						  });
					
                    <?php }else{ ?>
                    //alert('normal');
					
					$.ajax({
							  url:'<?php echo base_url(); ?>Product_description/search_firstproductloadajax',
							  method:'post',
							  data:{search_data:search_title},
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
		
                                  var $holder = $('<div/>').html(data);
                                  $('#count_divid').html($('#htmlcount' , $holder).html());
                                  $('#ajaxprodload_divid').html($('#html1' , $holder).html());
                                  $('#ajaxprodload_dividlist').html($('#html2' , $holder).html());
                                  $('#view_more_dv').html($('#htmlviewmorecount' , $holder).html());
								  }
							  
						  });
					
					
                    <?php } ?>
                    
                    }else{
                    //alert('ulli');
					var radiochecked_product=radiochecked_product.toString();
						  //alert(result_no);
						  $.ajax({
							  url:'<?php echo base_url(); ?>Product_description/click_ul_lifilter_dataajax',
							  method:'post',
							  data:{start_from:0,search_title:search_title,fq:radiochecked_product},
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
		
                                  var $holder = $('<div/>').html(data);
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
<!--------------------------remove_price_tag end--------------------------->
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
<div style="width: 100%; padding: 0; background:#fff; padding:5px;">

<!------------------------------- sponsored_product start -------------------------------------->
<!--<div id="sponsored_product" class="sponsored_product">
	
</div>-->

<?php
if($this->session->userdata('sesson_searchword'))
	   {
		   ?>
<div class="row" style="background:#fff;">
	<div class="col-md-12" style="padding:2px 38px">
    <p style="font-size: 14px; font-weight: bold; margin-bottom:0;"> No Result Found For "<span style="color:#800000;"><?php echo ucwords($this->session->userdata('sesson_searchword'))?></span>"</p>
    <p style="font-size: 14px; font-weight: bold;"> Do you mean 
    	<?php $sesson_suggestword_arr=$this->session->userdata('sesson_suggestword_arr');
		$cntssw=count($sesson_suggestword_arr);
		for($swi=0;$swi<$cntssw;$swi++){
		
		?>
        "<a href="<?php echo base_url().'search-by/'.$sesson_suggestword_arr[$swi]?>"><?php echo ucwords($sesson_suggestword_arr[$swi]) ?></a>"<?php if($swi!=$cntssw-1){echo ',';}?>
        <?php }?>
    </p>
    </div>
</div>
<?php 
$this->session->unset_userdata('sesson_searchword');
$this->session->unset_userdata('sesson_suggestword_arr');
}?>



<?php

$search_title=trim(str_replace(' ','%20',$this->uri->segment(2)));
			$curl_strng=SOLR_BASE_URL.SOLR_CORE_NAME."/select?indent=on&wt=json&q=".$search_title."&group=true&group.query=(Spec5:*%20OR%20Spec6:*%20OR%20Spec7:*)&group.main=true";
						
			$curl2 = curl_init($curl_strng);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			$data2 = json_decode($output, true);
			$ponsored_product_data=$data2;			
			//echo '<pre>';print_r($data2);exit;
			/*if($data2['response']['numFound']==0)
			{
				
				$sugword=$data2['spellcheck']['collations'][1]['collationQuery'];
				
				$searchsuggst_txt=trim(str_replace(' ','%20',$sugword));	
				$curl_strng=SOLR_BASE_URL.SOLR_CORE_NAME."/select?indent=on&wt=json&q=".$searchsuggst_txt."&group=true&group.query=(Spec5:*%20OR%20Spec6:*%20OR%20Spec7:*)&group.main=true";
				$curl3 = curl_init($curl_strng);
				curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
				$output3 = curl_exec($curl3);
				$data3 = json_decode($output3, true);				
				$ponsored_product_data=$data3;
				
			}
			else
			{	
				$ponsored_product_data=$data2;		
			}*/
		$cntt=count($ponsored_product_data['response']['docs']);
		///if($cntt>0){
  ?>
<div style="clear:both;"></div>
<?php //} ?>
<!--------------------------------- sponsored_product end ------------------------------------------->
<div id="sticky-anchor"></div>
<div id="sticky">
   <div class="select-filter-box" id="filterdivid" style="display:none;">
    <div class="filter-box"><h4>Filter</h4></div>
    <div class="clearall-box"><h6 id="clearallid" style="display:none; color:blue; cursor:pointer;" onClick="clear_all()">Clear All</h6></div>
    <div style="clear:both;"></div>
    <div style="width:100%; height:auto; margin:5px 0 0 0;" id="span_val">
    	    <!--<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
            <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>-->
    </div>
    </div>
    <div style="clear:both"></div>
        
<!--------------------------- Price filtering section (FROM - TO) start ------------------------------>
	 <div class="f_sidebar" style="background:#fff;">
        
      <span class="a-color-base s-ref-small-padding-left s-ref-price-currency"><i class="fa fa-inr" aria-hidden="true"></i></span>
      <input type="text" maxlength="9" placeholder="From" id="low_price" name="low-price" class="a-input-text a-spacing-top-mini s-ref-price-range s-ref-price-padding" aria-label="Min">
      <span class="a-color-base s-ref-small-padding-left s-ref-price-currency s-small-margin-left"><i class="fa fa-inr" aria-hidden="true"></i></span>
      <input type="text" maxlength="9" id="high_price" placeholder="To" name="high-price" class="a-input-text a-spacing-top-mini s-ref-price-range s-ref-price-padding s-small-margin-left" aria-label="Max">
      <span class="a-button s-small-margin-left">
      <!--<input class="a-button-input" type="button" onClick="" value="Search">-->
      <span onClick="price_filter()" class="a-button-text" aria-hidden="true">
      <button class="btn-go" style="margin:auto;border-radius: 5px;font-size: 14px;padding: 4px 6px;">Search <i class="fa fa-search-plus" style="font-size:18px;"></i></button>
      </span></span>
      
        </div>
       
<!---------------------------------- Price filtering section (FROM - TO) end --------------------------->
        
		<!-- Type filtering section Start-->
 <!-------------------------- product_type filter start -------------------------->
 <div id='search-left' style="margin-top:5px;">

 </div>
<!-------------------------- product_type filter end -------------------------->
       <!-- Type filtering section end-->        
        <div class="clearfix"></div>
  <!-------Nested accordian start---------->  
<!------------------- category filter_data section Start(1->2->3->brand,clr,etc) ------------------------->

<div class="cata-head">
<h4>Categories</h4> 
<span id="backtoall" onClick="clear_all()" style="font-size:13px; display:none;vertical-align: middle; cursor:pointer; color:#e8540d;">
		
        <i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i>
        <span style=" font-size:12px;">Back To All Categories</span>
        <i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i>
        
</span>
</div>
 <div class="filter_searchdatamtree" id="filter_searchdatamtree" style="border:1px solid #8eb7c0;border-top: none; border-radius: 0px 0px 5px 5px; height: 251px; overflow-y: scroll; margin-top: 0px;background: #f5f5f5;">
  <div id="mtreefb_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>
 </div>
<!-------------------------- category filter_data section end(1->2->3->brand,clr,etc) ----------------------->
  
  <!-------Nested accordian end---------->



</div>
<div class="content-holder">
<?php if($cntt>0){ ?>
<h4 class="title" style="margin-bottom:5px; font-size:24px; color:#eeac0d"><span>Sponsord Product</span> </h4>

<div id="slider1" style="margin:0 !important;">
        <a class="buttons prev" href="#">&lt;</a>
			<div class="viewport">
				<ul class="overview best-selr-prdct" style="width: 36800px; left: -2070px;">
                <?php
	for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
	$cdate=date("Y-m-d");
  ?>
					<li>
						<div class="view sponsored-view-fifth">
							<a style="cursor: pointer;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($ponsored_product_data['response']['docs'][$i_arr]['Title'])))).'/'.$ponsored_product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$ponsored_product_data['response']['docs'][$i_arr]['Sku']  ?>">
                            <?php if(empty($ponsored_product_data['response']['docs'][$i_arr]['Catalog_Image'][0])){?>
								<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>" title="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>">
                            <?php }else{?>
                            <img src="<?php echo base_url();?>images/product_img/<?=$ponsored_product_data['response']['docs'][$i_arr]['Catalog_Image'][0];?>" alt="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>" title="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>">
                            <?php } ?>
							</a>
						</div>
						<div class="wish-list">
							<a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
							<i class="fa fa-heart"></i></a>
						</div>
						<!--<div class="product-title">T-Shirt</div>-->
						<div class="best-slr-data">      
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($ponsored_product_data['response']['docs'][$i_arr]['Title'])))).'/'.$ponsored_product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$ponsored_product_data['response']['docs'][$i_arr]['Sku']  ?>" title="<?php echo $ponsored_product_data['response']['docs'][$i_arr]['Title']; ?>"><?php if(strlen($ponsored_product_data['response']['docs'][$i_arr]['Title']) > 19){echo substr($ponsored_product_data['response']['docs'][$i_arr]['Title'],0,19).' ...';}else{echo $ponsored_product_data['response']['docs'][$i_arr]['Title'];} ?></a>
							<div class="price-box">
								<!--<span class="regular-price"> Rs. 299 </span> &nbsp;
								<span class="price"> Rs. 149 </span> &nbsp;-->
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
					</li>
                    <?php } // End of foreach loop?>
			</ul>
				
	</div>
			<a class="buttons next" href="#">&gt;</a>	
</div>


<?php } ?>
    		
            
            
            <div style="width:100%;">
            	<a href="<?php echo base_url();?>" style="color:#878787; font-size:12px;">Home > </a>
                <a href="<?php echo base_url().'search-by/'.$this->uri->segment(2); ?>" style="color:#878787; font-size:12px;">Search > </a>
                <a href="<?php echo base_url().'search-by/'.$this->uri->segment(2); ?>" style="color:#878787; font-size:12px;"><?php echo ucwords($product_data_sco['responseHeader']['params']['q']); ?> </a>
            </div>

            
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
            
            <select class="dropdown selectpicker" id="pricesortid" data-style="btn-info" style="width:auto; vertical-align:top" onchange="pricesort(this.value)">        
            			  <option value="">--Select--</option>
						  <option value="asc">Price: Low To High</option>						  
						  <option value="desc">Price: High To Low</option>
                          <option value="Product_Id%20desc">Product:New To Old</option>
                          <option value="Product_Id%20asc">Product:Old To New</option>
			</select>
            
		</div>
				 </div>
            </div>
<!--------------------------------menu 1 start -------------------------------------------->            
<div id="menu1">            
<div class="w_content">
		<div class="catlog">
<!--		     <div class="clearfix"> </div>
-->		</div>
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
    <div id="footer">
    <div class="container" style="width: 100%; margin-top: 58px; padding: 0;">
<?php
	if($sec_info->num_rows()>0)
	{ $cur_dtm=date('y-m-d h:i:s');
	$jsortwo=31;
	$jsor=1;
	$tiny=1;
	$carasolbrabd=41;
	$jsorsingle=51;
	$nnews=1;
	foreach($sec_info->result_array() as $res_secdata)
	{
?>
	<!-------------------------------------------------Section 1st Condition Start-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='69x69')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<script>
    	$(document).ready(function() {
		  $('#media-<?php echo $sec_id; ?>').carousel({
			pause: true,
			interval: false,
		  });
		});
    </script>
	<div class="first-thumbnail-banner" style="background-color: <?=$res_secdata['bg_color'];?>">
	<div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide media-carousel" id="media-<?php echo $sec_id; ?>" >
        <div class="carousel-inner">
        <?php
		$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
		 if($qr_clmn->num_rows()>0)
			   {
					$image_track=array();
				   foreach($qr_clmn->result_array() as $res_clmn_four)
				   {
					   $clmn_sqlid1=$res_clmn_four['clmn_sqlid']; 
					   $qr_act_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid");
					   $image_all_count=$qr_act_imginfo1->num_rows();
					   // print_r($image_all_count);exit;
					   $qr_act_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 12 ");
						$image_count=$qr_act_imginfo->num_rows();
			?>
          <div class="item active">
            <div class="row">
				<?php
					foreach($qr_act_imginfo->result_array() as $res_imgdata_active){
				?>
				<?php if($res_imgdata_active['sku']!=''){ ?>
                  <div class="col-md-1">
                    <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>; cursor: pointer;">
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" 
                      	onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata_active['display_url'].'/'.$res_imgdata_active['img_sqlid'] ?>'"  alt="Image" />
						<?=stripslashes($res_imgdata_active['imag_label'])?>
                    </a>
                  </div>
                  <?php } ?>
                  <?php if($res_imgdata_active['URL']!=''){ ?>
				  <div class="col-md-1">
					<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>; cursor: pointer;">
						<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" 
                        onClick="window.location.href='<?php echo $res_imgdata_active['URL']; ?>'"  alt="Image"/>
						<?=stripslashes($res_imgdata_active['imag_label'])?>
					</a>
				  </div>
				<?php } ?>
                <?php if($res_imgdata_active['URL']=='' && $res_imgdata_active['sku']==''){ ?>
                <div class="col-md-1">
                	<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>; cursor: pointer;">
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" alt="Image">
						<?=stripslashes($res_imgdata_active['imag_label'])?>
                    </a>
                </div>	
                <?php } ?>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php 
		  	foreach($qr_clmn->result_array() as $res_clmn)
				{
					$clmn_sqlid=$res_clmn['clmn_sqlid'];
					$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' 
						AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 12,$image_all_count ");
				 $image_count=$qr_imginfo->num_rows();
				 $row=$qr_imginfo->result_array();				 
				 foreach(array_chunk($row,12) as $rw){
		  ?> 
          <div class="item">
            <div class="row">
            <?php 
				foreach($rw as $res_imgdata){
			?>
            	<?php if($res_imgdata['sku']!=''){ ?>
                  <div class="col-md-1">
                    <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>; cursor: pointer;" >
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
                      	onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'"  alt="Image" />
						<?=stripslashes($res_imgdata['imag_label'])?>
                    </a>
                  </div>
                  <?php } ?>
                  <?php if($res_imgdata['URL']!=''){ ?>
				  <div class="col-md-1">
					<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>; cursor: pointer;">
						<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
                        onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"  alt="Image"/>
						<?=stripslashes($res_imgdata['imag_label'])?>
					</a>
				  </div>				 
				<?php } ?>
                <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                <div class="col-md-1">
                	<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>; cursor: pointer;">
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" alt="Image">
						<?=stripslashes($res_imgdata['imag_label'])?>
                    </a>
                </div>	
                <?php } ?>
            <?php } ?>
            </div>
          </div>
          <?php } } ?>
          <?php } ?>
        </div>
        <?php if($image_all_count>12){ ?>
        <a data-slide="prev" href="#media-<?php echo $sec_id; ?>" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media-<?php echo $sec_id; ?>" class="right carousel-control" style="margin-right:0!important;">›</a>
        <?php }?>
      </div>                          
    </div>
	</div> 
	</div>
	<?php } ?>
	<!-------------------------------------------------Section 1st Condition End---------------------------------------------------->
	
	<!----------------------------------------------- Section 2nd Condition Start ---------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='1350x365')
			{
	?>
	<?php 
		$sec_id=$res_secdata['Sec_id'];
		$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' 
				ORDER BY ordr_by DESC ");
		if($qr_clmn->num_rows()>0)
			{
				foreach($qr_clmn->result_array() as $res_clmn)
					{
						$clmn_sqlid=$res_clmn['clmn_sqlid'];
						$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND 
								image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00'
								OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
						$image_count=$qr_imginfo->num_rows();
	?>
		<?php if($res_secdata['sec_lbl']=='') { ?>
		<?php } else {?>
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
			<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
		</div>
		<?php }?>
		<div class="banner">
			<div id="myCarousel-<?php echo $sec_id;?>" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php $i_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>
					<li data-target="#myCarousel-<?php echo $sec_id;?>" data-slide-to="<?=$i_slide?>" <?php if($i_slide=='0'){ ?> class="active" <?php } ?>></li>
					<?php $i_slide++; } ?>
				</ol>
				<div class="carousel-inner">
					<?php $j_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>
						<?php if($res_imgdata['sku']!=''){ ?>
							<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
								<img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;"  width="" height="" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" /> 
							</div>
						<?php } ?>
						<?php if($res_imgdata['URL']!=''){ ?>
							<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
								<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" style="cursor: pointer;" alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
							</div>
						<?php } ?>
						<?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?> 
							<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
								<img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;"  width="" height="" /> 
							</div>
						<?php } ?>
					<?php $j_slide++; }?>
				</div>
				<a class="left carousel-control" href="#myCarousel-<?php echo $sec_id;?>" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
				<a class="right carousel-control" href="#myCarousel-<?php echo $sec_id;?>" data-slide="next"><span class="fa fa-chevron-right"></span></a> 
			</div>
		</div>
	<?php } } ?>
	<?php } ?>
	<!---------------------------------------------------- Section 2nd Condition End --------------------------------------------------------->
	<!---------------------------------------------------- Section 3rd Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='3' && $res_secdata['image_size']=='450x261')
		{
	?>
		<div class="row" style="padding:0; margin-bottom:5px; margin-top:5px;">
			<?php if($res_secdata['sec_lbl']=='') {?>
			<?php } else { ?>
			<div style="width:100%; margin:auto; text-align:center; color:#000; padding:5px 0;">
				<h3 class="title"> <span> <?=$res_secdata['sec_lbl']?> </span></h3>
			</div>
			<?php }?>
		<?php 
		   $sec_id=$res_secdata['Sec_id'];                 
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {   
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
		?>
		<div class="col-lg-4" style="padding-right:0; padding-left:0;">
		<div style="width:98%; margin:auto;">
		<div id="jssor_<?=$jsor?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:450px;height:261px;overflow:hidden;visibility:hidden;">
			<!-- Loading Screen -->
			<div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:<?=$res_clmn['bg_color'];?>">
				<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
			</div>
			<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:450px;height:261px;overflow:hidden;">
				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
				
				<?php if($res_imgdata['sku']!=''){ ?>
				<div>
					<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
				</div>
				<?php } ?>
				<?php if($res_imgdata['URL']!=''){ ?>
				<div>
					<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" style="cursor: pointer;" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
				</div>
				<?php } ?>
				<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
				<div>
					<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" />
				</div>
				<?php } ?>
				<?php }?>
				<a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
			</div>
			<!-- Bullet Navigator -->
			<?php if($image_count>1){ ?>
			<div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
				<div data-u="prototype" class="i" style="width:16px;height:16px;">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
						<circle class="b" cx="8000" cy="8000" r="5800"></circle>
					</svg>
				</div>
			</div>
			<?php } ?>
			<!-- Arrow Navigator -->
			<?php if($image_count>1){ ?>
			<div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
				<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
					<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
				</svg>
			</div>
			<div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
				<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
					<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
				</svg>
			</div>
			<?php } ?>
		</div>
		
		<script type="text/javascript">jssor_<?=$jsor?>_slider_init();</script>
		</div>
		
		</div>
		<?php $jsor++; } } ?>
		</div>
	<?php } ?>
	<!---------------------------------------------------- Section 3rd Condition End --------------------------------------------------------->
	<!---------------------------------------------------- Section 4th Condition Start --------------------------------------------------------->
	<?php
		if($res_secdata['sec_type']=='Product'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
			{
	?>
	<div class="best-seller">
		<?php if ($res_secdata['sec_lbl']==''){ ?>
		<?php } else { ?>
		<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
		<?php }?>
		<div id="slider<?php echo $tiny;?>">
			<a class="buttons prev" href="#">&#60;</a>
			<div class="viewport">
				<?php
					$sec_id=$res_secdata['Sec_id'];                 
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
					if($qr_clmn->num_rows()>0)
						{
						foreach($qr_clmn->result_array() as $res_clmn)
							{
								$clmn_sqlid=$res_clmn['clmn_sqlid'];
								$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' 
									AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') 
									OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
								$image_count=$qr_imginfo->num_rows();
				?>
				<ul class="overview best-selr-prdct">
					<?php 
						foreach($qr_imginfo->result_array() as $res_imgdata){
							$prod_skuarr=unserialize($res_imgdata['sku']);
							$prod_skuarr_modf=array();
							foreach($prod_skuarr as $skuky=>$skuval)
								{
									$prod_skuarr_modf[]="'".$skuval."'";
								}
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
					
					?>
					<li>
						<div class="view view-fifth">
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" style="cursor: pointer;" title="<?=$rw['name']?>" >
								<?php if(empty($dsply_img)) {?>
									<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" width="184" height="154" alt="<?=$rw['name']?>">
								<?php } else {?>
									<img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"  alt="<?=$rw['name']?>">
								<?php }?>
							</a>
						</div>
						<div class="wish-list">
							<a href="#" class="link-wishlist wish_spn"  data-toggle="tooltip" title="Add To Wishlist" data-placement="right" onClick="">
								<i class="fa fa-heart"></i>
							</a>
						</div>
						<div class="best-slr-data">
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="<?=$rw['name']?>"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a>
							
							<div class="price-box">
								<?php
									if($rw['special_price'] !=0){
									if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
								?>
								<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
								<?php if($rw['price'] !=0){?>
									<span class="regular-price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
								<?php }?>
									<span class="price"> Rs. <?=$rw['special_price'];?> </span>
								<?php } else { ?>
								<?php if($rw['price'] !=0){ ?>
									<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
								<?php } else {?>
									<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
								<?php }?>
								<?php } ?>
								<?php } else { ?>
								<?php if($rw['price'] !=0){?>
									<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
								<?php }else{?>
									<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
								<?php }?>
								<?php } ?>
							</div>   
						</div>
					</li>
					<?php } } ?>
				</ul>
					<?php } ?>
				<?php }  }?>
			</div>
			<a class="buttons next" href="#">&#62;</a>	
		</div>
	</div>
	<?php $tiny++;} ?>
	<!---------------------------------------------------- Section 4th Condition End --------------------------------------------------------->
	<!---------------------------------------------------- Section 5th Condition Start --------------------------------------------------------->
	<?php
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='668x296')
			{
	?>
	<div class="row" style="margin-bottom:5px; margin:auto;">
		<?php if($res_secdata['sec_lbl']=='') {?>
		<?php } else { ?>
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:5px 0;">
			<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
		</div>
		<?php } ?>
		<?php
			$sec_id=$res_secdata['Sec_id'];                 
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' 
				AND clmn_status='active' ORDER BY ordr_by DESC  ");
			if($qr_clmn->num_rows()>0)
				{    
			   foreach($qr_clmn->result_array() as $res_clmn)
			   {
				   $clmn_sqlid=$res_clmn['clmn_sqlid'];
				   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
				   $image_count=$qr_imginfo->num_rows();
		?>
		<div class="col-lg-6" style="padding:0; margin:auto;">
			<div style="width:99%; margin:auto;">
			<div id="jssor_<?=$jsortwo?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:668px;height:296px;overflow:hidden;visibility:hidden; float:right;">
				<!-- Loading Screen -->
				<div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
					<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
				</div>
				<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:668px;height:296px;overflow:hidden;">
					<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
					<?php if($res_imgdata['sku']!=''){ ?>
						<div>
							<img data-u="image" style="cursor: pointer;" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
						</div>
					<?php } ?>
					<?php if($res_imgdata['URL']!=''){ ?>
						<div>
							<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" style="cursor: pointer;" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
						</div>
					<?php } ?>
					<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
						<div>
							<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" />
						</div>
					<?php } ?>
					<?php } ?>
					<a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
				</div>
				<!-- Bullet Navigator -->
				<?php if($image_count>1){ ?>
				<div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
					<div data-u="prototype" class="i" style="width:16px;height:16px;">
						<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<circle class="b" cx="8000" cy="8000" r="5800"></circle>
						</svg>
					</div>
				</div>
				<?php } ?>
				<!-- Arrow Navigator -->
				<?php if($image_count>1){ ?>
				<div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
						<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
					</svg>
				</div>
				<div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
						<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
					</svg>
				</div>
				<?php } ?>
			</div>
			<script type="text/javascript">jssor_<?=$jsortwo?>_slider_init();</script>
			</div>
		</div>
		<?php $jsortwo++; } } ?>
	</div>
	<?php } ?>
	<!---------------------------------------------------- Section 5th Condition End --------------------------------------------------------->
	<!---------------------------------------------------- Section 6th Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='140x100')
			{
	?>
	<?php if($res_secdata['sec_lbl']=='') { ?>
	<?php } else{?>
	<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
		<h2 style="float:left; margin-left:15px;"><?=$res_secdata['sec_lbl']?></h2>
	</div>
	<?php }?>
	<?php 
	$sec_id=$res_secdata['Sec_id'];
	$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
	   if($qr_clmn->num_rows()>0)
	   {
		   foreach($qr_clmn->result_array() as $res_clmn)
		   {
			   $clmn_sqlid=$res_clmn['clmn_sqlid'];
			   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
			   $image_count=$qr_imginfo->num_rows();
	?>
	<div style="width:98%; margin:auto; padding:10px;">
		<div id="jssor_<?php echo $carasolbrabd; ?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;visibility:hidden; border:1px solid #ccc;">
			<!-- Loading Screen -->
			<div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
			<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;">
			<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
			
			<?php if($res_imgdata['sku']!=''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']!=''){ ?>
			<div>
				<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" />
			</div>
			<?php } ?>
			<?php }?>
			<a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
			</div>
		</div>
			<script type="text/javascript">jssor_<?php echo $carasolbrabd; ?>_slider_init();</script> 
	</div>
	<?php  }  }?>
	<?php $carasolbrabd++;} ?>
	<!---------------------------------------------------- Section 6th Condition End --------------------------------------------------------->
	
	<!---------------------------------------------------- Section 7th Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider with Product Carousel'  && $res_secdata['sec_type_data']=='Banner With Product' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='400x260')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	
	<div class="container-fluid">
	<div class="row" style="margin-right: 0px; margin-left: 0px;">
		<?php if($res_secdata['sec_lbl']=='') {?>
		<?php } else { ?>
		<h3>
			<span class="new-arivl"> <?=$res_secdata['sec_lbl']?> </span>
			<!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
		</h3>
		<?php }?>
		<div style="clear:both;"></div>
		<?php
		   
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {   
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
		?>
		<div class="col-lg-4" style=" margin-top:20px;">
			<div class="left-banner">
				<div id="jssor_<?=$jsorsingle?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:400px;height:260px;overflow:hidden;visibility:hidden;">
				<!-- Loading Screen -->
					<div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
						<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
					</div>
					<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:400px;height:260px;overflow:hidden;">
						<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
						<?php if($res_imgdata['sku']!=''){ ?>
						<div>
							<img data-u="image"  src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" style="border: 1px solid #ccc !important; border-radius: 6px !important; padding:10px;cursor: pointer;" />
						</div>
						<?php } ?>
						<?php if($res_imgdata['URL']!=''){ ?>
						<div>
							<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="border: 1px solid #ccc !important; border-radius: 6px !important; padding:10px; cursor:pointer;"/>
						</div>
						<?php } ?>
						<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
						<div>
							<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="border: 1px solid #ccc !important; border-radius: 6px !important; padding:10px; cursor:pointer;"/>
						</div>
						<?php } ?>
						<?php }?>
						
						<a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
					</div>
					<!-- Bullet Navigator -->
					<div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
						<div data-u="prototype" class="i" style="width:16px;height:16px;">
							<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
								<circle class="b" cx="8000" cy="8000" r="5800"></circle>
							</svg>
						</div>
					</div>
					<!-- Arrow Navigator -->
					<div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
						<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
						</svg>
					</div>
					<div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
						<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
							<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
						</svg>
					</div>
				</div>
			</div> 
			<script type="text/javascript">jssor_<?=$jsorsingle?>_slider_init();</script>
		</div>
		<?php $jsorsingle++; } }?>
		
		<div class="col-lg-8 right-banner" style=" margin-top:20px;">
   		<div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
				<?php 
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
					if($qr_clmn->num_rows()>0)
						{
							foreach($qr_clmn->result_array() as $res_six_clmn)
								{
									$clmn_six_sqlid=$res_six_clmn['clmn_sqlid'];
									
									$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_six_sqlid' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
									$image_count=$qr_imginfo->num_rows();
									
				?>
                <div class="item active">
                    <div class="row">
						<?php 
							foreach($qr_imginfo->result_array() as $res_imgdata){
								$prod_skuarr=unserialize($res_imgdata['sku']);
								$prod_skuarr_modf=array();
								foreach($prod_skuarr as $skuky=>$skuval)
									{
										$prod_skuarr_modf[]="'".$skuval."'";
									}
									$prod_skustr=implode(',',$prod_skuarr_modf);
									
									
									$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3 ");
									
								if($query_prod->num_rows()>0)
									{
									foreach($query_prod->result_array() as $rw)
										{
											$cdate = date('Y-m-d');
											$special_price_from_dt = $rw['special_pric_from_dt'];
											$special_price_to_dt = $rw['special_pric_to_dt'];								
											$dsply_img = $rw['catelog_img_url'];
						?>
                        <div class="col-sm-4">
                            <div class="col-item" style="background:none!important;">
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                    <a style="cursor: pointer;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
									<?php if(empty($dsply_img)) {?>
										<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?=$rw['name']?>" title="<?=$rw['name']?>">
									<?php } else {?>
										<img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"  alt="<?=$rw['name']?>" title="<?=$rw['name']?>">
									<?php }?>
									</a>
								</div>
                                <div class="wish-list" style="right: 23px;">
                                    <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                        <i class="fa fa-heart"></i>
                                     </a>
                                </div>
                                <div class="best-slr-data" style="padding: 0px 5px;">      
                                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="<?php echo $rw['name']; ?>"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a>
                                        <div class="price-box">
                                            <?php
												if($rw['special_price'] !=0){
													if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
											?>
												<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
											<?php if($rw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$rw['price'];?> </span> &nbsp;
											<?php }?>
												<span class="price"> Rs. <?=$rw['special_price'];?> </span>
											<?php } else { ?>
											<?php if($rw['price'] !=0){ ?>
												<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;
											<?php } else {?>
												<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
											<?php } else { ?>
											<?php if($rw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;
											<?php }else{?>
												<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
                                        </div>
                                </div>
                            </div>
                        </div>
						<?php } }?>
						<?php } ?>
                    </div>
                </div>
				<?php } ?>
				<?php 
					foreach($qr_clmn->result_array() as $res_clmn)
						{
							$clmn_sqlid1=$res_clmn['clmn_sqlid'];
							$image_imfo_all=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
							$image_all_count=$image_imfo_all->num_rows();
							
							foreach($image_imfo_all->result_array() as $res_allimgdata){
								$prod_allskuarr=unserialize($res_allimgdata['sku']);
								$prod_all_skuarr_modf=array();
								foreach($prod_allskuarr as $allskuky=>$allskuval)
								{
								$prod_all_skuarr_modf[]="'".$allskuval."'";
								}
								$prod_allskustr=implode(',',$prod_all_skuarr_modf);
								
								
								$query_all_prod_alds=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
								$image_all_count_alldata=$query_all_prod_alds->num_rows();
								
								$query_all_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3,$image_all_count_alldata");
						
						$image_count_allproduct=$query_all_prod->num_rows();
						$row_product=$query_all_prod->result_array();				 
						foreach(array_chunk($row_product,3) as $row_all_product){
					?>
					<div class="item">
                    <div class="row">
						<?php 
							foreach($row_all_product as $allrw){
									
									$ccdate = date('Y-m-d');
									$special_all_price_from_dt = $allrw['special_pric_from_dt'];
									$special_all_price_to_dt = $allrw['special_pric_to_dt'];
									$dsply_all_img = $allrw['catelog_img_url'];
						?>
                        <div class="col-sm-4">
                            <div class="col-item" style="background:none!important;">
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                    <a style="cursor: pointer;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($allrw['name'])))).'/'.$allrw['product_id'].'/'.$allrw['sku']  ?>" >
									<?php if(empty($dsply_all_img)) {?>
										<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?=$allrw['name']?>" title="<?=$allrw['name']?>">
									<?php } else {?>
										<img src="<?php echo base_url().'images/product_img/'.$dsply_all_img?>"  alt="<?=$allrw['name']?>" title="<?=$allrw['name']?>">
									<?php }?>
									</a>
								</div>
                                <div class="wish-list" style="right: 23px;">
                                    <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                        <i class="fa fa-heart"></i>
                                     </a>
                                </div>
                                <div class="best-slr-data" style="padding: 0px 5px;">      
                                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($allrw['name'])))).'/'.$allrw['product_id'].'/'.$allrw['sku']  ?>" title="<?php $allrw['name']; ?>"><?php if(strlen($allrw['name']) > 20){ echo substr($allrw['name'],0,20).'...';}else{ echo $allrw['name'];}?></a>
                                        <div class="price-box">
                                            <?php
												if($allrw['special_price'] !=0){
													if($cdate >= $special_all_price_from_dt && $cdate <= $special_all_price_to_dt){
											?>
												<span class="regular-price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
											<?php if($allrw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$allrw['price'];?> </span> &nbsp;
											<?php }?>
												<span class="price"> Rs. <?=$allrw['special_price'];?> </span>
											<?php } else { ?>
											<?php if($allrw['price'] !=0){ ?>
												<span class="regular-price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$allrw['price'];?> </span> &nbsp;
											<?php } else {?>
												<span class="price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
											<?php } else { ?>
											<?php if($allrw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$allrw['price'];?> </span> &nbsp;
											<?php }else{?>
												<span class="price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
                                             
                                        </div>
                                </div>
                            </div>
                        </div>
						<?php }?>
                    </div>
                </div>
				<?php } }?>
                        <?php  }?>
				<?php  }?>
				
				
				<?php  //} ?>
            </div>
            <a class="left carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
			<a class="right carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
        </div>
		</div>
	</div>
	</div>
	
	<?php }?>
	<!---------------------------------------------------- Section 7th Condition End --------------------------------------------------------->
	
	<!---------------------------------------------------- Section 8th Condition Start --------------------------------------------------------->
    <?php
		if($res_secdata['sec_type']=='Video with Product Carousel'  && $res_secdata['sec_type_data']=='Video With Product' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='100x200')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid">
		<div class="row" style="margin-right: 0px; margin-left: 0px;">
		<?php if($res_secdata['sec_lbl']=='') {?>
		<?php } else { ?>
			<h3>
				<span class="new-arivl"><?=$res_secdata['sec_lbl']?></span>
				<!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
			</h3>
		<?php }?>
		<div style="clear:both;"></div>       
		<?php 
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
		?>
		<div class="col-lg-4" style=" margin-top:20px;">
			<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
			<?php $url=str_replace('=','',strrchr($res_imgdata['URL'],"="));  ?>
			<iframe width="100%" height="260" style="border:1px solid #ccc; padding:10px;" src="https://www.youtube.com/embed/<?=$url?>" frameborder="0" allowfullscreen></iframe>
			<?php } ?>
		</div>
		<?php 
				   }
			   }
		?>
		<div class="col-lg-8 right-banner" style=" margin-top:20px;">
   		<div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
				<?php 
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
					if($qr_clmn->num_rows()>0)
						{
							foreach($qr_clmn->result_array() as $res_six_clmn)
								{
									$clmn_six_sqlid=$res_six_clmn['clmn_sqlid'];
									
									$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_six_sqlid' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
									$image_count=$qr_imginfo->num_rows();
									
				?>
                <div class="item active">
                    <div class="row">
						<?php 
							foreach($qr_imginfo->result_array() as $res_imgdata){
								$prod_skuarr=unserialize($res_imgdata['sku']);
								$prod_skuarr_modf=array();
								foreach($prod_skuarr as $skuky=>$skuval)
									{
										$prod_skuarr_modf[]="'".$skuval."'";
									}
									$prod_skustr=implode(',',$prod_skuarr_modf);
									
									
									$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3 ");
								
								if($query_prod->num_rows()>0)
									{
									foreach($query_prod->result_array() as $rw)
										{
											$cdate = date('Y-m-d');
											$special_price_from_dt = $rw['special_pric_from_dt'];
											$special_price_to_dt = $rw['special_pric_to_dt'];								
											$dsply_img = $rw['catelog_img_url'];
						?>
                        <div class="col-sm-4">
                            <div class="col-item" style="background:none!important;">
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                    <a style="cursor: pointer;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
									<?php if(empty($dsply_img)) {?>
										<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?=$rw['name']?>" title="<?=$rw['name']?>">
									<?php } else {?>
										<img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"  alt="<?=$rw['name']?>" title="<?=$rw['name']?>">
									<?php }?>
									</a>
								</div>
                                <div class="wish-list" style="right: 23px;">
                                    <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                        <i class="fa fa-heart"></i>
                                     </a>
                                </div>
                                <div class="best-slr-data" style="padding: 0px 5px;">      
                                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="<?php echo $rw['name']; ?>"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a>
                                        <div class="price-box">
                                            <?php
												if($rw['special_price'] !=0){
													if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
											?>
												<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
											<?php if($rw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$rw['price'];?> </span> &nbsp;
											<?php }?>
												<span class="price"> Rs. <?=$rw['special_price'];?> </span>
											<?php } else { ?>
											<?php if($rw['price'] !=0){ ?>
												<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;
											<?php } else {?>
												<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
											<?php } else { ?>
											<?php if($rw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;
											<?php }else{?>
												<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
                                        </div>
                                </div>
                            </div>
                        </div>
						<?php } }?>
						<?php } ?>
                    </div>
                </div>
				<?php } ?>
				<?php 
					foreach($qr_clmn->result_array() as $res_clmn)
						{
							$clmn_sqlid1=$res_clmn['clmn_sqlid'];
							$image_imfo_all=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
							$image_all_count=$image_imfo_all->num_rows();
							
							foreach($image_imfo_all->result_array() as $res_allimgdata){
								$prod_allskuarr=unserialize($res_allimgdata['sku']);
								$prod_all_skuarr_modf=array();
								foreach($prod_allskuarr as $allskuky=>$allskuval)
								{
								$prod_all_skuarr_modf[]="'".$allskuval."'";
								}
								$prod_allskustr=implode(',',$prod_all_skuarr_modf);
								
								$query_all_prod_alds=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
								$image_all_count_alldata=$query_all_prod_alds->num_rows();
								
								$query_all_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3,$image_all_count_alldata");
						
						$image_count_allproduct=$query_all_prod->num_rows();
						$row_product=$query_all_prod->result_array();				 
						foreach(array_chunk($row_product,3) as $row_all_product){
					?>
					<div class="item">
                    <div class="row">
						<?php 
							foreach($row_all_product as $allrw){
									
									$ccdate = date('Y-m-d');
									$special_all_price_from_dt = $allrw['special_pric_from_dt'];
									$special_all_price_to_dt = $allrw['special_pric_to_dt'];
									$dsply_all_img = $allrw['catelog_img_url'];
						?>
                        <div class="col-sm-4">
                            <div class="col-item" style="background:none!important;">
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                    <a style="cursor: pointer;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($allrw['name'])))).'/'.$allrw['product_id'].'/'.$allrw['sku']  ?>" >
									<?php if(empty($dsply_all_img)) {?>
										<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?=$allrw['name']?>" title="<?=$allrw['name']?>">
									<?php } else {?>
										<img src="<?php echo base_url().'images/product_img/'.$dsply_all_img?>"  alt="<?=$allrw['name']?>" title="<?=$allrw['name']?>">
									<?php }?>
									</a>
								</div>
                                <div class="wish-list" style="right: 23px;">
                                    <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                        <i class="fa fa-heart"></i>
                                     </a>
                                </div>
                                <div class="best-slr-data" style="padding: 0px 5px;">      
                                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($allrw['name'])))).'/'.$allrw['product_id'].'/'.$allrw['sku']  ?>" title="<?php $allrw['name']; ?>"><?php if(strlen($allrw['name']) > 20){ echo substr($allrw['name'],0,20).'...';}else{ echo $allrw['name'];}?></a>
                                        <div class="price-box">
                                            <?php
												if($allrw['special_price'] !=0){
													if($cdate >= $special_all_price_from_dt && $cdate <= $special_all_price_to_dt){
											?>
												<span class="regular-price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
											<?php if($allrw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$allrw['price'];?> </span> &nbsp;
											<?php }?>
												<span class="price"> Rs. <?=$allrw['special_price'];?> </span>
											<?php } else { ?>
											<?php if($allrw['price'] !=0){ ?>
												<span class="regular-price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$allrw['price'];?> </span> &nbsp;
											<?php } else {?>
												<span class="price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
											<?php } else { ?>
											<?php if($allrw['price'] !=0){?>
												<span class="regular-price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
												<span class="price"> Rs. <?=$allrw['price'];?> </span> &nbsp;
											<?php }else{?>
												<span class="price"> Rs. <?=$allrw['mrp'];?> </span> &nbsp;
											<?php }?>
											<?php } ?>
                                        </div>
                                </div>
                            </div>
                        </div>
						<?php }?>
                    </div>
                </div>
				<?php } }?>
				<?php  }?>
				<?php  }?>
				<?php  //} ?>
            </div>
            <a class="left carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
			<a class="right carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
        </div>
		</div>
		</div>
	</div>
	<?php }?>
	<!---------------------------------------------------- Section 8th Condition End --------------------------------------------------------->
	<div style="clear:both;"></div>
	<!---------------------------------------------------- Section 9th Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Vertical Carousal With Thin Banner'  && $res_secdata['sec_type_data']=='Carousal With Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='size1_640x115_size2_644x58')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid">
		<div class="row" style="margin-right: 0px; margin-left: 0px;">
			<?php if($res_secdata['sec_lbl']=='') {?>
			<?php } else { ?>
			<h3>
				<span class="new-arivl"><?=$res_secdata['sec_lbl']?></span>
				<!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
			</h3>
			<?php }?>
			<div style="clear:both;"></div>
			<?php 
				$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
			
			?>
			<div class="col-lg-6" style=" padding-left:0; margin-top:5px;">
				<div id="news-container<?=$nnews?>">
					<ul>
						<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
						<li>
							<?php if($res_imgdata['sku']!=''){ ?>
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" width="100%;" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;">
							<?php }?>
							<?php if($res_imgdata['URL']!=''){ ?>
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"  style="cursor: pointer;"/>
							<?php } ?>
							<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;">
							<?php }?>
						</li> 
						<?php }?>
					</ul>
				</div>
			</div>
			<?php $nnews++; } }?>
			<?php 
				$qr_clmn1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn1->num_rows()>0)
			   {
				   foreach($qr_clmn1->result_array() as $res_clmn1)
				   {
					   $clmn_sqlid1=$res_clmn1['clmn_sqlid'];
					   $qr_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count1=$qr_imginfo1->num_rows();
			
			?>
			<div class="col-lg-6 tickering-right-banner">
				<ul>
					<?php foreach($qr_imginfo1->result_array() as $res_imgdata1){ ?>
						<li>
							<?php if($res_imgdata1['sku']!=''){ ?>
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata1['display_url'].'/'.$res_imgdata1['img_sqlid'] ?>'" style="cursor: pointer;">
							<?php } ?>
							<?php if($res_imgdata1['URL']!=''){ ?>
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata1['URL']; ?>'"  style="cursor: pointer;"/>
							<?php } ?>
							<?php if($res_imgdata1['URL']=='' && $res_imgdata1['sku']==''){ ?>
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" style="cursor: pointer;">
							<?php } ?>
						</li>
					<?php }?>
				</ul>
			</div>
			   <?php } }?>
		</div>
	</div>
	<?php }?>
	<!---------------------------------------------------- Section 9th Condition End --------------------------------------------------------->
	
	<!---------------------------------------------------- Section 10th Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider With Add Banner'  && $res_secdata['sec_type_data']=='Slider With Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='size1_1053x324_size2_187x126')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid">
		<div class="row" style=" padding:10px; margin:20px 0; background:<?=$res_secdata['bg_color'];?>">
			<div class="col-lg-10">
				<div id="tabbed-Carousel" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
					
					<div class="carousel-inner">
						<?php 
							$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
							   if($qr_clmn->num_rows()>0)
							   {
							   foreach($qr_clmn->result_array() as $res_clmn)
							   {
								   $clmn_sqlid_all=$res_clmn['clmn_sqlid'];
								   $qr_imginfo_all=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_all' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
								   $image_count_all=$qr_imginfo_all->num_rows();
								   
								   $clmn_sqlid=$res_clmn['clmn_sqlid'];
								   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1 ");
								   $image_count=$qr_imginfo->num_rows();
						?>
						<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
						<div class="item active">
							<?php if($res_imgdata['sku']!=''){ ?>
								<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;">
							<?php }?>
							<?php if($res_imgdata['URL']!=''){ ?>
								<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;"/>
							<?php } ?>
							<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']=='' ) { ?>
								<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" />
							<?php } ?>
						</div><!-- End Item -->
						<?php } } }?>
						<?php 
							$qr_clmn_item=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
							   if($qr_clmn_item->num_rows()>0)
							   {
							   foreach($qr_clmn_item->result_array() as $res_clmn_item)
							   {
								   
								   $clmn_sqlid_item=$res_clmn_item['clmn_sqlid'];
								   $qr_imginfo_item=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_item' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1,$image_count_all ");
								   $image_count_item=$qr_imginfo_item->num_rows();
								   
								   //print_r($image_count_item);
						?>
						<?php foreach($qr_imginfo_item->result_array() as $res_imgdata_item){ ?>
						<div class="item">
							<?php if($res_imgdata_item['sku']!=''){ ?>
								<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_item['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata_item['display_url'].'/'.$res_imgdata_item['img_sqlid'] ?>'" style="cursor: pointer;">
							<?php }?>
							<?php if($res_imgdata_item['URL']!=''){ ?>
								<img onClick="window.location.href='<?php echo $res_imgdata_item['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_item['imge_nm'];?>" style="cursor: pointer;"/>
							<?php }?>
							<?php if($res_imgdata_item['URL']=='' && $res_imgdata_item['sku']=='' ) { ?>
								<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_item['imge_nm'];?>">
							<?php }?>
						</div><!-- End Item -->
							   <?php } } } ?>
					</div><!-- End Carousel Inner -->
					<ul class="nav nav-pills nav-justified" style="width:100%!important;">
						<?php 
							$qr_clmn1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
							   if($qr_clmn1->num_rows()>0)
							   {
							   foreach($qr_clmn1->result_array() as $res_clmn1)
							   {
								   $clmn_sqlid_all1=$res_clmn1['clmn_sqlid'];
								   $qr_imginfo_all1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_all1' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC ");
								   $image_count_all1=$qr_imginfo_all1->num_rows();
								   
								   $clmn_sqlid1=$res_clmn1['clmn_sqlid'];
								   $qr_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1 ");
								   $image_count1=$qr_imginfo1->num_rows();
						?>
						<?php foreach($qr_imginfo1->result_array() as $res_imgdata1){ ?>
						<li data-target="#tabbed-Carousel" data-slide-to="0" class="active">
							<a href="#" style="padding:18px 25px;"><?php echo $res_imgdata1['memo']; ?></a>
						</li>
						<?php } ?>
						<?php } }?>
						<?php 
							$qr_clmn_item1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
							   if($qr_clmn_item1->num_rows()>0)
							   {
							   foreach($qr_clmn_item1->result_array() as $res_clmn_item1)
							   {
								   
								   $clmn_sqlid_item1=$res_clmn_item['clmn_sqlid'];
								   $qr_imginfo_item1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_item1' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1,$image_count_all1 ");
								   $image_count_item1=$qr_imginfo_item1->num_rows();
								  $i=1;
						?>
						<?php foreach($qr_imginfo_item1->result_array() as $res_imgdata_item1){ ?>
						<li data-target="#tabbed-Carousel" data-slide-to="<?php echo $i;?>">
							<a href="#" style="padding:18px 25px;"><?php echo $res_imgdata_item1['memo']; ?></a>
						</li>
						<?php $i++; } ?>
						<?php  } } ?>
					</ul>
				</div><!-- End Carousel -->
			</div>
			<?php 
				$qr_clmn1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn1->num_rows()>0)
			   {
				   foreach($qr_clmn1->result_array() as $res_clmn1)
				   {
					   $clmn_sqlid1=$res_clmn1['clmn_sqlid'];
					   $qr_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count1=$qr_imginfo1->num_rows();
			
			?>
			<div class="col-lg-2">
				<div class="latest_offers">
				<input type="hidden" class="right_xtra_banner" data-id="4520" blkname="Plat" position="2">
				<ul id="4520">
					<?php foreach($qr_imginfo1->result_array() as $res_imgdata1){ ?>
					<li>
						<a>
						<?php if($res_imgdata1['sku']!=''){ ?>
								<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata1['display_url'].'/'.$res_imgdata1['img_sqlid'] ?>'" alt="" style="cursor: pointer;">
							<?php }?>
							<?php if($res_imgdata1['URL']!=''){ ?>
                                 <img onClick="window.location.href='<?php echo $res_imgdata1['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" style="cursor: pointer;"/>
                            <?php } ?>
                            <?php if($res_imgdata1['URL']=='' && $res_imgdata1['sku']=='' ) { ?>
                                <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" style="cursor: pointer;" />
                            <?php } ?>
						</a>
					</li>
					<?php } ?>
				</ul>
				</div>
			</div>
			<?php } }?>
		</div>
	</div>
	<?php }?>
	<!---------------------------------------------------- Section 10th Condition End --------------------------------------------------------->
	
	<!---------------------------------------------------- Section 11th Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Product Grid View'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">				
				<?php
					$sec_id=$res_secdata['Sec_id'];                 
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
					   if($qr_clmn->num_rows()>0)
					   {
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
				?>					
				
				<ul>
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
					?>
					<li>
						<div class="menu-link-product-held"> 
							<div class="pad-res">
								<div class="today-deal-left">
									<a style="cursor: pointer;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
									<?php if(empty($dsply_img)) {?>
									<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="<?=$rw['name']?>" title="<?=$rw['name']?>">
									<?php } else{ ?>
									<img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"  alt="<?=$rw['name']?>" title="<?=$rw['name']?>">
									<?php }?>
									</a>
								</div>
								<div class="today-deal-right">
									<h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';"><a style="cursor: pointer;" href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>"><?php echo $rw['name'];?></a></h4>
									<p style="margin-left:0px;">
										<?php
											if($rw['special_price'] !=0){
												if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
										?>
										<span style="color:#999; text-decoration:line-through">
											<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
											</i> &nbsp; <?=$rw['mrp'];?>
										</span>&nbsp;&nbsp;
										<?php if($rw['price'] !=0){?>
										<span style="color:#999; text-decoration:line-through">
                                        <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=$rw['price'];?> </span> &nbsp;&nbsp;
										<?php }?>
										<span style="color:#079107 !important;  font-weight:bold;">
											<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
											</i>&nbsp; <?=$rw['special_price'];?>
										</span> &nbsp;&nbsp;
										<?php } else{ ?>
										<?php if($rw['price'] !=0){ ?>
										<span style="color:#999; text-decoration:line-through">
											<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
											</i> &nbsp; <?=$rw['mrp'];?>
										</span>&nbsp;&nbsp;
										<span style="color:#079107 !important;  font-weight:bold;">
                                        <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=$rw['price'];?> </span> &nbsp;&nbsp;
										<?php } else {?>
										<span style="color:#999; text-decoration:line-through">
											<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
											</i> &nbsp; <?=$rw['mrp'];?>
										</span>&nbsp;&nbsp;
										<?php }?>
										<?php }?>
										<?php } else {?>
										<?php if($rw['price'] !=0){?>
										<span style="color:#999; text-decoration:line-through">
											<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
											</i> &nbsp; <?=$rw['mrp'];?>
										</span>&nbsp;&nbsp;
										<span style="color:#079107 !important;  font-weight:bold;">
                                        <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?=$rw['price'];?> </span> &nbsp;&nbsp;
										<?php } else {?>
										<span style="color:#999; text-decoration:line-through">
											<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
											</i> &nbsp; <?=$rw['mrp'];?>
										</span>&nbsp;&nbsp;
										<?php }?>
										<?php }?>
									</p>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div>
					</li>
					<?php } } ?>
					<?php } ?>
				</ul>
				<?php } }?>
			</div>
		</div>
	</div>
	<?php }?>
	<!---------------------------------------------------- Section 11th Condition End --------------------------------------------------------->
	
	<!---------------------------------------------------- Section 12th Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='4' && $res_secdata['image_size']=='333x210'){
	?>
	<div class="container-fluid" style="padding:0;">
		<div class="row" style="margin-right: 0px; margin-left: 15px;">
		<?php if ($res_secdata['sec_lbl']=='') {?>
		<?php } else {?>
			<h3>
				<span class="new-arivl"> <?php echo $res_secdata['sec_lbl']; ?> </span>
				<!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
			</h3>
		<?php } ?>
		</div>
		<div class="container-fluid" style="padding:0;">
			
			<div class="row" style="margin-right: 0px; margin-left: 0px;">
				<?php 
				$sec_id=$res_secdata['Sec_id'];
				$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
				if($qr_clmn->num_rows()>0)
					{
						foreach($qr_clmn->result_array() as $res_clmn)
							{
								$clmn_sqlid=$res_clmn['clmn_sqlid'];
								$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND 
									image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
								$image_count=$qr_imginfo->num_rows();
			?>
				<?php foreach($qr_imginfo->result_array() as $res_imgdata){  ?>
					<?php if($res_imgdata['sku']!=''){ ?>
						<div class="col images_1_of_3">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;" >
						</div>
					<?php } ?>
					<?php if($res_imgdata['URL']!=''){ ?>
						<div class="col images_1_of_3">
							<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" >
						</div>
					<?php }?>
					<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
						<div class="col images_1_of_3">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="cursor: pointer;" >
						</div>
					<?php }?>
				<?php }?>
				<?php 
				}	}
			?>
			</div>
			
		</div>
	</div>
	<?php }?>
	<!---------------------------------------------------- Section 12th Condition End --------------------------------------------------------->
	
	<!---------------------------------------------------- Section 13th Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='266x164'){
			
			$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid" style="padding:0;">
	<div class="row" style="margin:5px 0;">
		<?php if ($res_secdata['sec_lbl']=='') {?>
		<?php } else {?>
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
			<h3 class="title"> <span><?php echo $res_secdata['sec_lbl']; ?></span> </h3>
		</div>
		<?php }?>
		
		<div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<?php 
				$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='5' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
				if($qr_clmn->num_rows()>0)
					{
						foreach($qr_clmn->result_array() as $res_clmn_four)
							{
							   $clmn_sqlid1=$res_clmn_four['clmn_sqlid']; 
							   $qr_act_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid");
							   $image_all_count=$qr_act_imginfo1->num_rows();
							   
							   $qr_act_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 5 ");
								$image_count=$qr_act_imginfo->num_rows();
			?>
			<div class="item active">
				<div class="row" style="margin:auto;" >
					<?php
						foreach($qr_act_imginfo->result_array() as $res_imgdata_active){
					?>
					<?php if($res_imgdata_active['sku']!=''){ ?>
					<div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
						<div class="col-item" style="background:<?=$res_secdata['bg_color'];?>;">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata_active['display_url'].'/'.$res_imgdata_active['img_sqlid'] ?>'" alt="" style="cursor: pointer;">
						</div>
					</div>
					<?php } ?>
					<?php if($res_imgdata_active['URL']!=''){ ?>
					<div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
						<div class="col-item" style="background:<?=$res_secdata['bg_color'];?>;">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata_active['URL']; ?>'" alt="" style="cursor: pointer;">
						</div>
					</div>
					<?php } ?>
					<?php if($res_imgdata_active['URL']=='' && $res_imgdata_active['sku']==''){ ?>
					<div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
						<div class="col-item" style="background:<?=$res_secdata['bg_color'];?>;">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" alt="" style="cursor: pointer;">
						</div>
					</div>
					<?php }?>
					<?php }?>
				</div>
			</div>
			<?php } ?>
			<?php 
				foreach($qr_clmn->result_array() as $res_clmn)
					{
				$clmn_sqlid=$res_clmn['clmn_sqlid'];
				$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 5,$image_all_count ");
				$image_count=$qr_imginfo->num_rows();
				$row=$qr_imginfo->result_array();
				//print_r($image_count);
				foreach(array_chunk($row,5) as $rw){
			?> 
			<div class="item">
				<div class="row" style="margin:auto;">
					<?php 
						foreach($rw as $res_imgdata){
					?>
					<?php if($res_imgdata['sku']!=''){ ?>
					<div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
						<div class="col-item" style="background:<?=$res_secdata['bg_color'];?>;">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" alt="" style="cursor: pointer;">
						</div>
					</div>
					<?php }?>
					<?php if($res_imgdata['URL']!=''){ ?>
					<div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
						<div class="col-item" style="background:<?=$res_secdata['bg_color'];?>;">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" alt="" style="cursor: pointer;">
						</div>
					</div>
					<?php }?>
					<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
					<div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
						<div class="col-item" style="background:<?=$res_secdata['bg_color'];?>;">
							<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" alt="" style="cursor: pointer;">
						</div>
					</div>
					<?php }?>
					<?php } ?>
				</div>
			</div>
			<?php } } ?>
			<?php }?>
		</div>
		<?php if($image_all_count>5){ ?>
		<a class="left carousel-control" style="padding-top: 5%; margin-left: 5px;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
		<a class="right carousel-control" style="padding-top: 5%; margin-right: 21px;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
		<?php }?>
	</div>
	</div>
	</div>	
	<?php }?>
	<!---------------------------------------------------- Section 13th Condition End --------------------------------------------------------->
	<!---------------------------------------------------- Section 14th Condition Start --------------------------------------------------------->
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
				<p><?=$res_secdata['sec_descrp']?></p>
			</div>
		</div>
	<?php }?>
	<!---------------------------------------------------- Section 14th Condition End --------------------------------------------------------->
	
<?php
		}
	}
?>
</div>
   <?php include "footer.php" ?> 
    </div>








  
</div> 
  <div class="clearfix">&nbsp;</div>
 

    
 <script>
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var footer_top = $("#footer").offset().top;
    var div_top = $('#sticky-anchor').offset().top;
    var div_height = $("#sticky").height();
    
    var padding = 20;  // tweak here or get from margins etc
    
    if (window_top + div_height > footer_top - padding)
        $('#sticky').css({top: (window_top + div_height - footer_top + padding) * -1})
    else if (window_top > div_top) {
        $('#sticky').addClass('stick');
        $('#sticky').css({top: 55})
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>



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


<!--<script>
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
-->


</body>

</html>