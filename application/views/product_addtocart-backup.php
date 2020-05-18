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

    	<?php include "header.php"; $this->db->cache_on();?>
        <!------ Start Content ------>

<style>
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
    padding: 7px 10px;
    float: none;
    border: 0;
    margin: 20px 0px;
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
    margin-bottom: 5px;
	margin-top: 17px;
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
.media-carousel 
{
  margin-bottom: 0;
  padding: 0 40px 0px 40px;
}
/* Previous button  */
.media-carousel .carousel-control.left 
{
  
    background-image: none;
    background: none;
    border: 2px solid #ccc;
    border-radius: 50%;
    height: 30px;
    width: 30px;
    margin-top: 20px;
    color: #ccc;
    padding-top: 0;
    font-size: 31px;
    line-height: 21px;
    text-shadow: none;
  
}
/* Next button  */
.media-carousel .carousel-control.right 
{
  
      background-image: none;
    background: none;
    border: 2px solid #ccc;
    border-radius: 50%;
    height: 30px;
    width: 30px;
    margin-top: 20px;
    color: #ccc;
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


.thumbnail{ margin-bottom:0;}
.col-md-1{ height:90px;}
/* End carousel */
@import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
.col-item
{
/*    border: 1px solid #E1E1E1;
*/    border-radius: 5px;
    background: #FFF;
}
.col-item .photo img
{
    margin: 0 auto;
    width: 100%;
}

.col-item .info
{
    padding: 10px;
    border-radius: 0 0 5px 5px;
    margin-top: 1px;
}

.col-item:hover .info {
    background-color: #F5F5DC;
}


.col-item .price h5
{
    line-height: 20px;
    margin: 0;
}

.price-text-color
{
    color: #219FD1;
}

.col-item .info .rating
{
    color: #777;
}

.col-item .rating
{
    /*width: 50%;*/
    float: left;
    font-size: 17px;
    text-align: right;
    line-height: 52px;
    margin-bottom: 10px;
    height: 52px;
}

.col-item .separator
{
    border-top: 1px solid #E1E1E1;
}

.clear-left
{
    clear: left;
}

.col-item .separator p
{
    line-height: 20px;
    margin-bottom: 0;
    margin-top: 10px;
    text-align: center;
}

.col-item .separator p i
{
    margin-right: 5px;
}
.col-item .btn-add
{
    width: 50%;
    float: left;
}

.col-item .btn-add
{
    border-right: 1px solid #E1E1E1;
}

.col-item .btn-details
{
    width: 50%;
    float: left;
    padding-left: 10px;
}
.controls
{
    margin-top: 20px;
}
[data-slide="prev"]
{
    margin-right: 10px;
}
.carousel-control.left{    background-image: none;}
.carousel-control.right{    background-image: none;}
.carousel-control .fa-chevron-left, .carousel-control .fa-chevron-right {
        width: 30px;
    height: 30px;
    line-height: 29px;
    margin-top: 115px;
    font-size: 14px;
    color: #fff;
    background: #ed2541;
    border-radius: 50px;
}
.left-banner{
	
    width: 100%;
    margin: auto;
	
}

.right-banner{
	border:1px solid #ccc !important;
	border-radius:6px !important;
	background-color: #f7f7f7 !important;
    background-image: -moz-linear-gradient(top, #ffffff, #ececec) !important;
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#ececec)) !important;
    background-image: -webkit-linear-gradient(top, #ffffff, #ececec) !important;
    background-image: -o-linear-gradient(top, #ffffff, #ececec) !important;
    background-image: linear-gradient(to bottom, #ffffff, #ececec) !important;
    background-repeat: repeat-x !important;
}

.col:first-child {
    margin-left: 0;
}

.col {
    display: block;
    float: left;
}

.images_1_of_3 {
    margin-top: .3em;
    line-height: 1.9em;
	width: 25%;
    padding-right: 1px;
}
.images_1_of_5 {
    width: 18.4%;
    text-align: center;
}

.col1 {
    display: block;
    float: left;
    /* margin-right: 4px; */
    width: 256px;
    margin-right: 1px;
}

.images_1_of_5 {
    margin-top: .3em;
    line-height: 1.9em;
}
.images_1_of_5 img {
    max-width: 100%;
    display: inline-block;
}
#news-container
{
	width: 100%; 
	margin: auto;
	background-color: #e95546;
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
}



#news-container2 ul li{
	height:auto !important;
	border: 1px dotted #fff;
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

/*****************************news tixker repeat end************************************/

/*****************************news tixker repeat start************************************/


#news-container
{
	width: 100%; 
	margin: auto;
	background-color: #e95546;
}



#news-container ul li{
	height:auto !important;
	border: 1px dotted #fff;
}

 #news-container ul li a  { 
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
  #news-container ul li p {
    height: 55px;
    line-height: 18px;
    overflow: hidden;
    font-size: 14px;
	color: #fff;
    padding: 0 5px;
	text-align:center;
	
}

/*****************************news tixker repeat end************************************/


.tickering-right-banner{
margin-top: 5px; background: #333; padding:2px 8px 0;
}
.tickering-right-banner ul{
width:100%;
}
.tickering-right-banner ul li{
border-bottom:1px dotted #fff;
}
.tickering-right-banner ul li img{
	width:100%; height:56px; margin:5px 0px;
}
#tabbed-Carousel .nav a small {
    display:block;
}
#tabbed-Carousel .nav {
	background:#eeac0d;
}
#tabbed-Carousel .nav a {
    border-radius:0px;
}

.nav-justified>li {
    width: auto;
}

.nav-justified>li:hover {
    width: auto;
}
.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
	background:#ed313b;}
.bnnr_container .latest_offers {
    float: right;
    width: 240px;
    background: #fff;
    -webkit-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.06);
    -moz-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.06);
    box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.06);
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    height: 409px;
    position: absolute;
    top: 0;
    right: 20px;
    overflow: hidden;
}
.bnnr_container .latest_offers li {
    list-style: none;
    padding: 0;
    border-bottom: 1px solid #f0f0f0;
    text-align: center;
    overflow: hidden;
    height: 126px;
    position: relative;
}
.latest_offers li img {
    max-width: inherit;
    height: 126px;
    left: 50%;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
    position: relative;
    z-index: 0;
}

.menu-link-product-held {
    float: left;
    width: 47%;
    /* border: 1px solid #B9B9B9; */
    /* height: 80px; */
    /* max-height: 120px; */
    /* padding: 1px 4px 2px 10px; */
    /* border-bottom: 1px solid #B9B9B9; */
    margin: 0 0%;
}	
.today-deal-left {
    width: 30%;
    float: left;
    padding: 5px;
    text-align: center;
}
.today-deal-left img {
        display: inline-block;
    height: auto;
    width: auto;
    margin: 0 auto;
    max-height: 165px;
    max-width: 170px;
}
.today-deal-right {
    width: 70%;
    float: right;
    padding: 5px;
    text-align: left;
}
.today-deal-right h4 {
    text-align: left;
    margin-top: 5px;
    font-family: Arial,sans-serif;
    font-weight: normal;
    font-size: 20px;
}	
.today-deal-right p {
    font-size: 14px;
    color: #999;
    width: 280px;
    text-align: justify;
}
.nav>li>a:focus, .nav>li>a:hover{
	text-decoration: none;
    background-color: #ed313b;
}
/*top slider*/

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

*//* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 20%; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fff;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 40%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}
.modal-header {
    padding: 11px 16px 0px;
    background-color: #f2f2f2;
    color: #000;
}
/* The Close Button */
.close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
	margin-top: -5px;
	opacity:1 !important;
	
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


.modal-body {padding: 2px 16px;}
.modal-body img {
    width: auto!important;
}
.modal-body ul{
	margin-top:10px;
}
.modal-body ul li{margin:10px;}
.modal-body ul li a{color:#eeac0d;}
.modal-body ul li a img{margin-right:10px;}

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
.mainContent {
  width: 100%;
  position: relative;
}

.sidebar {
  width: 20%;
  float: left;
  height: 550px;
  background: #fff;
}
.sidebar.fixed {
  position: fixed;
  top: 0;
}
/*.content::-webkit-scrollbar { 
    display: none !important;
}
.content::-moz-scrollbar { 
    display: none !important; 
}
*/.content {
  float: right;
  width: 79%;
 /* height:1200px;
  overflow-y:scroll;
  overflow-x:hidden;*/
  padding:10px;
  background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);
}
.content{
    scrollbar-face-color: #367CD2;
    scrollbar-shadow-color: #FFFFFF;
    scrollbar-highlight-color: #FFFFFF;
    scrollbar-3dlight-color: #FFFFFF;
    scrollbar-darkshadow-color: #FFFFFF;
    scrollbar-track-color: #FFFFFF;
    scrollbar-arrow-color: #FFFFFF;
}
/* Track */
.content::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 10px;
    border-radius: 10px;
}
/* Handle */
.content::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: rgba(255,0,0,0.8); 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
.footer {
  clear: both;
}
#search-left > ul > li.has-sub > a span {
  background: url(<?php echo base_url();?>new_css/css/menu_images/icon_plus.png) 96% center no-repeat;
}
#search-left > ul > li.has-sub.active > a span {
  background: url(<?php echo base_url();?>new_css/css/menu_images/icon_minus.png) 96% center no-repeat;
}
.jspTrack {
    display: none;
}
.price-range {
    float: left;
    width: 34%;
    margin: 0.3%;
}
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>new_css/css/search-left-3rdsection-menu.css" />
 <script src="<?php echo base_url()?>new_js/js/search-left-3rdsection-menu.js" type="text/javascript"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.js"></script>
<!------------------------ Start active list-grid menu script -----------------> 
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
	
	var numItems = parseInt($('.grid1_of_4').length);
	var result_no = parseInt(result_no);
	
	
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



<div class="container" style="width: 100%; padding: 0; padding:5px;">
<main class="mainContent" style="margin-top:70px;">


   <!--------------------------------- Start of Filter bar----------------------------------------------->
	
<div class="sidebar">
   <div class="select-filter-box">
    <div class="filter-box"><h4>Filter</h4></div>
    <?php if($this->uri->segment(1)=='filterby'){ ?>
    <div class="clearall-box"><h6 class="rstClear close_filter" style="color:blue;margin: 5px;" onClick="resetAllFilter();">Clear All</h6></div>
    <?php } ?>
    <div style="clear:both;"></div>
    
    <div style="width:100%; height:auto; margin:5px 0 5px 0;">
   
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
    </div>
    <!--<div style="width:50%; float:left; padding: 2px 4px; text-align:left;"><h4 style="margin:0 0 0 0;">Filter</h4></div>-->
   <?php /*?> <?php if($this->uri->segment(1)=='filterby'){ ?>
    <div style="width:50%; float:right; padding:3px 5px; text-align:right; cursor:pointer;"><h6 class="rstClear close_filter" style="color:blue;margin: 5px;" onClick="resetAllFilter();">Clear All</h6></div>
    <?php } ?><?php */?>
    
<!-----------------------------Start close_filter------------>
    <?php /*?><div style="width:100%; height:auto; margin:5px 0 5px 0;">
   
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
    </div><?php */?>
    
    
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
        <section class="filter-form" style="margin: -12px 1px 5px;border: 1px solid #ececec;">
          <h4 style="background: #ececec;padding: 5px 9px; margin-top: 0px;font-size: 13px;">Price</h4>
              <div class="row1 scroll-pane" style="overflow: hidden; padding: 0px; width:100%; height: 70px;">
              <div class="jspContainer" style="width:100%; height: 63px;">
              	<div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 100%;">
                  <div class="col-sm-12">
                  <div class="jspPane" style="padding: 0px; top: 0px; left: 0px;"><div class="col col-4">
					<div class="price-range"> FROM : <br> <input type="text" name="start_pric" id="start_pric" placeholder="(Rs.)"> </div>
                    <div class="price-range"> TO :  <br> <input type="text" name="end_pric" id="end_pric" placeholder="(Rs.)"> </div>
                    <div style="width: 30%; margin: auto;text-align: center;float: right;">
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
 <div id='search-left' style="height:350px;margin-top: 5px;">
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
   
   			<li><a href=''><span><?=$valattrbhead?></span></a>
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
               <div style="border-bottom:1px solid #fdf0ba;">
         		<label class="checkbox" style="font-size: 14px;color: #A9A8A8;">
                     <input type="checkbox" style="margin-top:0;"
                     <?php
                     if (strpos(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval['attr_value'])) !== false)
					 {echo "Checked disabled";}
                     ?>
                     
                     class="flipswitch" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval['attr_value'])?>" onchange="filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>')">
                       
                       <i class="fa fa-circle" aria-hidden="true" style="border:#FFF; color:<?php echo trim($res_attrbval['attr_value']);?>;"></i>
                       
                       <span><?php echo trim($res_attrbval['attr_value']);?> </span> 
                </label>
         </div>
          <?php }} else { 
				 if($res_attrbval['attr_value']!='' && in_array(trim($res_attrbval['attr_value']),$attrb_reapt)){
		  ?>
         <div style="border-bottom:1px solid #fdf0ba;">
         		<label class="checkbox" style="font-size: 14px;color: #A9A8A8;" >
                     <input type="checkbox" style="margin-top:0;" 
                     <?php
                     if (strpos(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval['attr_value'])) !== false)
					 {echo "Checked disabled";}
                     ?>
                     
                      class="flipswitch" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval['attr_value'])?>" onchange="filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>')">
                      <span> <?php echo trim($res_attrbval['attr_value']);?>  </span>
                </label>
         	  
         </div>
         
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
    <div class="content">
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
            <select class="dropdown selectpicker" id="attr_size"  data-style="btn-info" style="width:auto; vertical-align:top" onChange="sortby_price(this.value,'<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>')" >        <option value=''>--Select--</option>
						  <option value="Low-To-High" <?php if(@$arr1[1]=='Low-To-High') {echo "selected";}?> >Price: Low To High</option>						  
						  <option value="High-To-Low" <?php if(@$arr1[1]=='High-To-Low') {echo "selected";}?>>Price: High To Low</option>
						  
					   </select>
		</div>
				 </div>
            </div>
<!------------- end of act grid list & Sort menu 1 -------------> 
	<div style="clear:both;"></div>
	<hr style="margin:0;">
	
	<!-------------------------------------------------------- All Section Home Start -------------------------------------------------->
	
	<?php $this->db->cache_off();
		if($sec_info!=false)
		{
			if($sec_info->num_rows()>0)
				{ 
					$cur_dtm=date('y-m-d h:i:s');
					$jsortwo=31;
					$jsor=1;
					$tiny=1;
					$carasolbrabd=41;
					$jsorsingle=51;
					$nnews=1;
					foreach($sec_info->result_array() as $res_secdata)
					{
	?>
	<!----------------------------------------- Section 1st Condition Start --------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='45x45')
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
	<div class="first-thumbnail-banner" style="margin: 2px auto 0; padding: 10px 0 0!important;background-color: <?=$res_secdata['bg_color'];?>">
	<div class='row'>
    <div class='col-md-12'>
		<div class="carousel slide media-carousel" id="media-<?php echo $sec_id; ?>" >
        <div class="carousel-inner">
        <?php 
			
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' 
										AND clmn_status='active' ORDER BY ordr_by DESC  ");
			 if($qr_clmn->num_rows()>0)
				{
					$image_track=array();
				   foreach($qr_clmn->result_array() as $res_clmn_four)
				   {
					   $clmn_sqlid1=$res_clmn_four['clmn_sqlid']; 
					   $qr_act_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC");
					   $image_all_count=$qr_act_imginfo1->num_rows();
					   // print_r($image_all_count);exit;
					   $qr_act_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC LIMIT 12 ");
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
						AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC LIMIT 12,$image_all_count ");
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
	<!----------------------------------------- Section 1st Condition End ----------------------------------------------------------->
	<!----------------------------------------- Section 2nd Condition End ----------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='1065x288')
			{
	?>
	<?php 
		$sec_id=$res_secdata['Sec_id'];
		$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' 
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
	<div style="width:100%; margin:auto; text-align:center; color:#000; padding:0;">
		<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
	</div>
	<?php }?>
	<div class="banner" style="height:auto; margin-bottom:5px;">
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
			<a class="right carousel-control" href="#myCarousel-<?php echo $sec_id;?>" data-slide="next"><span class="fa fa-chevron-right" style="margin-left:-22px;"></span></a> 
		</div>
	</div>
	<?php } } ?>
	<?php } ?>
	<!----------------------------------------- Section 2nd Condition End ----------------------------------------------------------->
	<!----------------------------------------- Section 3rd Condition Start --------------------------------------------------------->
	<?php
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='527x233')
			{
	?>

	<div class="row" style="margin-bottom:5px; margin:auto; padding:0;">
		<?php if($res_secdata['sec_lbl']=='') {?>
		<?php } else { ?>
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:0;">
			<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
		</div>
		<?php } ?>
		<?php
			$sec_id=$res_secdata['Sec_id'];                 
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' 
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
			<div id="jssor_<?=$jsortwo?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:527px;height:233px;overflow:hidden;visibility:hidden; float:right;">
				<!-- Loading Screen -->
				<div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
					<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
				</div>
				<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:527px;height:233px;overflow:hidden;">
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
	<!------------------------------------------------- Section 3rd Condition End----------------------------------------------------------->
	
	<!------------------------------------------------- Section 4th Condition Start ---------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='3' && $res_secdata['image_size']=='348x201')
		{
	?>
	<div class="row" style="padding:0; margin:5px auto;">
		<?php if($res_secdata['sec_lbl']=='') {?>
		<?php } else { ?>
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:5px 0;">
			<h3 class="title"> <span> <?=$res_secdata['sec_lbl']?> </span></h3>
		</div>
		<?php }?>
	<?php 
	   $sec_id=$res_secdata['Sec_id'];                 
		$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
	<div id="jssor_<?=$jsor?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:348px;height:201px;overflow:hidden;visibility:hidden;">
		<!-- Loading Screen -->
		<div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:<?=$res_clmn['bg_color'];?>">
			<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
		</div>
		<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:348px;height:201px;overflow:hidden;">
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
	<!------------------------------------------------- Section 4th Condition End ---------------------------------------------------------->

	<!------------------------------------------------- Section 5th Condition Start ---------------------------------------------------------->
	
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
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
	<!------------------------------------------------- Section 5th Condition End ----------------------------------------------------------->

	<!------------------------------------------------- Section 6th Condition Start ----------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider with Product Carousel'  && $res_secdata['sec_type_data']=='Banner With Product' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='337x229')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
		
	<div class="container-fluid" style="padding-right:4px; padding-left:4px;">
	<div class="row" style="margin-right: 0px; margin-left: 0px;">
		<?php if($res_secdata['sec_lbl']=='') {?>
		<?php } else { ?>
		<h3 style="margin-top:0;">
			<span class="new-arivl"> <?=$res_secdata['sec_lbl']?> </span>
			<!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
		</h3>
		<?php }?>
		<div style="clear:both;"></div>
		<?php
		   
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {   
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
		?>
		<div class="col-lg-4" style="padding-left: 0; margin-top:5px;">
			<div class="left-banner">
				<div id="jssor_<?=$jsorsingle?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:337px;height:229px;overflow:hidden;visibility:hidden;">
				<!-- Loading Screen -->
					<div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
						<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
					</div>
					<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:337px;height:229px;overflow:hidden;">
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
		
		<div class="col-lg-8 right-banner" style="margin-top:5px;border:none !important; background:none !important; background-image:none !important;">
   		<div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
				<?php 
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px; height:178px;">
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
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px; height:178px;">
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
            <a class="left carousel-control" style="margin-top:-4%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
			<a class="right carousel-control" style="margin-top:-4%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
			</div>
		</div>
		</div>
	</div>
	
	<?php }?>
	<!------------------------------------------------- Section 6th Condition End ----------------------------------------------------------->
	
	<!------------------------------------------------- Section 7th Condition Start ---------------------------------------------------------->
	
	<?php
		if($res_secdata['sec_type']=='Video with Product Carousel'  && $res_secdata['sec_type_data']=='Video With Product' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='100x200')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid" style="padding-right:4px; padding-left:4px;">
		<div class="row" style="margin-right: 0px; margin-left: 0px;">
		<?php if($res_secdata['sec_lbl']=='') {?>
		<?php } else { ?>
			<h3 style="margin-top:0;">
				<span class="new-arivl"><?=$res_secdata['sec_lbl']?></span>
				<!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
			</h3>
		<?php }?>
		<div style="clear:both;"></div>       
		<?php 
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
		?>
		<div class="col-lg-4" style="padding-left: 0; margin-top:5px;">
			<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
			<?php $url=str_replace('=','',strrchr($res_imgdata['URL'],"="));  ?>
			<iframe width="100%" height="230" style="border:1px solid #ccc; padding:10px;" src="https://www.youtube.com/embed/<?=$url?>" frameborder="0" allowfullscreen></iframe>
			<?php } ?>
		</div>
		<?php 
				   }
			   }
		?>
		<div class="col-lg-8 right-banner" style="margin-top:5px;border:none !important; background:none !important; background-image:none !important;">
   		<div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
				<?php 
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px; height:178px;">
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
                                <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px; height:178px;">
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
            <a class="left carousel-control" style="margin-top:-4%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
			<a class="right carousel-control" style="margin-top:-4%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
        </div>
		</div>
		</div>
	</div>
	<?php }?>
	<!------------------------------------------------- Section 7th Condition End ---------------------------------------------------------->
	
	<!------------------------------------------------- Section 8th Condition End ---------------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider With Add Banner'  && $res_secdata['sec_type_data']=='Slider With Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='size1_834x257_size2_143x105')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid" style="padding-left:4px; padding-right:4px;">
		<div class="row" style=" padding:10px; margin:20px 0; background:<?=$res_secdata['bg_color'];?>">
			<div class="col-lg-10">
				<div id="tabbed-Carousel" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
					
					<div class="carousel-inner">
						<?php 
							$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
							$qr_clmn_item=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
							$qr_clmn1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
							$qr_clmn_item1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
				$qr_clmn1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
								<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata1['display_url'].'/'.$res_imgdata1['img_sqlid'] ?>'" alt="" style="cursor: pointer;height: 105px !important;">
							<?php }?>
							<?php if($res_imgdata1['URL']!=''){ ?>
                                 <img onClick="window.location.href='<?php echo $res_imgdata1['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" style="cursor: pointer;height: 105px !important;"/>
                            <?php } ?>
                            <?php if($res_imgdata1['URL']=='' && $res_imgdata1['sku']=='' ) { ?>
                                <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata1['imge_nm'];?>" style="cursor: pointer;height: 105px !important;" />
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
	<!-------------------------------------------------Section 8th Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 9th Condition End-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Vertical Carousal With Thin Banner'  && $res_secdata['sec_type_data']=='Carousal With Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='size1_518x93_size2_517x56')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid" style="padding:0;">
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
				$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
				$qr_clmn1=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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

	<!-------------------------------------------------Section 9th Condition End-------------------------------------------------->	
	
	<!-------------------------------------------------Section 10th Condition Start----------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Product Grid View'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<div class="container-fluid" style="padding:0;">
		<div class="row">
			<div class="col-lg-12">				
				<?php
					$sec_id=$res_secdata['Sec_id'];                 
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
										<span style="color:#999 !important;  text-decoration:line-through">
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
	<!-------------------------------------------------Section 10th Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 11th Condition Start------------------------------------------------>
	<?php 
		if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='4' && $res_secdata['image_size']=='263x166'){
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
				$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
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
	<!-------------------------------------------------Section 11th Condition End---------------------------------------------------->
	
	<!-------------------------------------------------Section 15th Condition Start-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='209x129'){
			
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
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
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
            <a class="left carousel-control" style="margin-top:-75px; margin-left: 5px;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
			<a class="right carousel-control" style="margin-top:-75px; margin-right: 21px;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
			<?php }?>
        </div>
		</div>
	</div>	
	<?php }?>
	<!-------------------------------------------------Section 15th Condition End-------------------------------------------------->
	<!-------------------------------------------------Section 16th Condition Start-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='140x100')
			{
	?>
	<?php if($res_secdata['sec_lbl']=='') { ?>
	<?php } else{?>
		<h2 style="float:left; margin-left:15px; margin-top:0;"><?=$res_secdata['sec_lbl']?></h2>

	<?php }?>
	<?php 
	$sec_id=$res_secdata['Sec_id'];
	$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
	<!-------------------------------------------------Section 16th Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 17th Condition End-------------------------------------------------->
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
	<!-------------------------------------------------Section 17th Condition End-------------------------------------------------->
			
	<?php 
				}
			}
		}
	?>
	
	<!-------------------------------------------------------- All Section Home End -------------------------------------------------->
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
<div id="view_more_dv" style="padding-bottom:500px;">
           		<img src="<?php echo base_url(); ?>images/loader.gif" id="lodr_img" style="display:none;">
                <?php if($no_of_product > $sl){ ?>
                				<input type="button" id="viewmore_prodbtnid" class="add-to-cart view_mor" value="View More" name="button" onclick="ShowMoreData('<?=$no_of_product;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $this->uri->segment(4);}else{ echo 'NOT';}?>')">
                                <input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
                <?php }	?>
		</div>
<!------------------------ End View More btn show more data ---------->    
    </div>
</main>


  
</div> 
  <div class="clearfix">&nbsp;</div>
 
<script>
$(document).ready(function() {
  var $window = $(window);  
  var $sidebar = $(".sidebar"); 
  var $sidebarHeight = $sidebar.innerHeight();   
  var $footerOffsetTop = $(".footer").offset().top; 
  var $sidebarOffset = $sidebar.offset();
  
  $window.scroll(function() {
    if($window.scrollTop() > $sidebarOffset.top) {
      $sidebar.addClass("fixed");   
    } else {
      $sidebar.removeClass("fixed");   
    }    
    if($window.scrollTop() + $sidebarHeight > $footerOffsetTop) {
      $sidebar.css({"top" : -($window.scrollTop() + $sidebarHeight - $footerOffsetTop)});        
    } else {
      $sidebar.css({"top": "50",});  
    }    
  });   

  
});

</script>

    
 <div class="footer">
   <?php include "footer.php" ?> 
</div>
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

</html>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>