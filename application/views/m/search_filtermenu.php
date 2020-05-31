<?php $this->load->helper(array('html','form','url'));

?>
<link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/mtree.css"> 

<style>
.fltr {
    float: left;
    padding:0px;
    text-align: center;
    width: auto;
    margin: 1px;
}
.fltr ul{
  display:block;
  list-style-type: none;
  text-align:center;
  
}
.fltr ul li{
    font-size: 12px;
    padding: 5px;
    /* width: 60px; */
    margin: 2px auto 0px;
    height: 30px;
    background: #f7f7f7;
    color: #777;
    border: 2px solid #dedede;
    display: block;
    display: inline-block;
    color: white;
    font-family: sans-serif;
    font-weight: normal;
    position: relative;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
         -webkit-user-select: none;
     -moz-user-select: none;    
     -ms-user-select: none;  
     user-select: none;
}
. fltr ul li:hover{
  background: #f9a1c6;
  color: #000;
}
.fltr ul li .dropdown{
  display:none;
  width: 120px;
  padding:0 0 0 5px; margin:0;
  position: absolute;
  top: 45px;
  left:0;
}
.fltr ul li .dropdown li{
  width: 100%;
    display: block;
    padding: 10px 0px;
    margin: 0px;
    color: #0066c0;
    font-weight: normal;
    border: none;
    text-align: left;
    height: auto;
    font-size: 10px;
    border-bottom: 1px solid #ccc;
}
.fltr a{width: 100%; margin:2px;height: auto; padding:3px !important; border:none !important;}
#dd:checked ~ .dropdown{
  display:block;
  margin-top: -10px;
  z-index:9999999;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
  
}
.agile-products {
    max-height: 350px;
    min-height: 250px;
}
.agile-products img{
	height: 112px;
    max-width: 100%;
    margin: auto;
    text-align: center;
}
.products {
    padding: 0 0 14px 0;
}

.filter-tabs>li {
   margin-bottom: 0px;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    width: 100%;
}
.left-menu{
	width:100%; height:24px; border-bottom:1px solid #ccc;clear: both;margin-top: 0px;
}
.left-menu-left{
	width:85%; float:left;margin-top: -1px;
}
.fltr-cont input[type="checkbox"]+label span:first-child {
    width: 20px;
    height: 20px;
    display: inline-block;
    border: 2px solid #067AB4;
    position: absolute;
    left: 0;
    top: 4px;
}
.fltrtabs {
    float: left;
    width: 30%;
    background-color: #f6f6f6;
	height: 550px;
    overflow-y: scroll;

}
.fltr-cont {
    float: left;
    width: 70%;
    padding-left: 10px;
    height: 550px;
    overflow-y: scroll;
	
}	
.nav-tabs>li>a {
    width: 100%;
}
.filterpanel .btn_form {
    width: 100%;
}
.single-bottom label {
   margin-top: 7px;
}
.colorFilter li label {
    width: 35px;
    height: 35px;
    display: block;
    border: 1px solid #ccc!important;
}
.color-fl{
	width:20%; float:left;
	height:23px; width:23px;margin-top: 12px;
	border: 1px solid #ccc !important;
	}
.color-fl:hover{ border:2px solid #008000;}	
.filterpanel {
    z-index: 9999999;
}
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
.mtree-skin-selector {
    display: none;
}
.heading-checkb0x{
	float: left;
    width: 10%;
    position: absolute;
    z-index: 9999;
    margin-top: -29px;
    margin-left: -2px !important;
    height: 18px;
}
.mtree-skin-selector button.csl.active { background: #FFC000; }

.filters-head {
    background-color: #f7f7f7;
    border-bottom: 1px solid #e8e8e8;
    padding: 10px 10px 10px;
    margin-bottom: 5px;
}
.panel-group .panel-heading a.collapsed:after {
    content: '\002B';
    color: #000;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    font-size: 19px;
    height: 34px;
    width: 34px;
    line-height: 34px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
}
.panel-group .panel-heading a:after {
    content: "\2212";
    color: #000;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;

    font-size: 19px;
    height: 34px;
    width: 34px;
    line-height: 34px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
}
.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
    color: inherit;
}
.panel-heading {
    padding: 0px 15px;
	background-color: #f9f7df !important;
}
.panel-group {
    margin-bottom: 20px;
    margin-top: 20px;
}
.panel-body ul li {
    display: block;
	height: auto;
}
.panel-body ul li a {
    color: #696763;
    font-family: unset;
    font-size: 12px;
    text-transform: capitalize;
    font-weight: 600;
    /* text-align: center; */
    display: block;
    margin-left: 0px;
    margin-top: 0px;
	text-align:left;
}
.panel-body ul {
    padding-left: 0;
    float: none;
}
.more-content {display:none;}
.cg-visible {display:block;}
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
    padding: 6px;
	
}
.rst_spn:hover{ text-decoration:line-through;}

.button.act {
    background: #0066c0;
    padding: 10px 5px 2px;
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

.filter-clearall{
	float:left; 
	width:48%; 
	margin-right:5px; 
	list-style:none;
}
.list-grid{
	margin-right:19px;
	width: 30%;
	float: right;
	margin-top: 18px;
}
.product-countno{
	    margin-top: 19px;
    width: auto;
    float: left;
    margin-left: 4px;
}
.btn_form .apply {
    position: fixed;
    bottom: 0;
}

.search-filter-apply{
	height:100%!important;
	width:100%;
	z-index:9999999;
	background:#fff;
}

@media only screen and (min-width:0px) and (max-width:320px){
	.fltr-cont {
    height: 480px;
    overflow-y: scroll;
}
.fltrtabs {
    height: 480px;
    overflow-y: scroll;
}

.list-grid {
    margin-right: 5px;
    width: 24%;
    float: right;
    margin-top: 18px;
}
.button.act {
    background: #0066c0;
    padding: 5px 4px 2px;
    color: #fff;
    border-radius: 6px;
}
i.fa.fa-th-large {
    font-size: 20px;
}
a#act2 {
    padding: 5px 0px 0px 4px;
}
i.fa.fa-list {
    font-size: 20px;
    margin-right: 4px;
}
}
@media only screen and (min-width:321px) and (max-width:360px){
	.fltr-cont {
    height: 86%!important;
}
.fltrtabs {
    height: 86%!important;
}
.list-grid {
    margin-right: 0px;
    width: 23%;
    float: right;
    margin-top: 18px;
}
}
@media only screen and (min-width:361px) and (max-width:375px){
	.fltr-cont {
    height: 88%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:88%!important;
    overflow-y: scroll;
}

}
@media only screen and (min-width:376px) and (max-width:412px){
	.fltr-cont {
    height: 88%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:88%!important;
    overflow-y: scroll;
}
}
@media only screen and (min-width:413px) and (max-width:414px){
	.fltr-cont {
    height: 88%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:88%!important;
    overflow-y: scroll;
}
}
@media only screen and (min-width:415px) and (max-width:568px){
	.fltr-cont {
    height: 72%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:72%!important;
    overflow-y: scroll;
}
}
@media only screen and (min-width:569px) and (max-width:640px){
	.fltr-cont {
    height: 75%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:75%!important;
    overflow-y: scroll;
}
.heading-checkb0x {
    float: left;
    width: 6%;
}
}
@media only screen and (min-width:641px) and (max-width:667px){
	.fltr-cont {
    height: 76%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:76%!important;
    overflow-y: scroll;
}
.heading-checkb0x {
    float: left;
    width: 6%;
}
}
@media only screen and (min-width:668px) and (max-width:736px){
	.fltr-cont {
    height: 78%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:78%!important;
    overflow-y: scroll;
}
.heading-checkb0x {
    float: left;
    width: 5%;
}
}

@media only screen and (min-width:737px) and (max-width:768px){
	.fltr-cont {
    height: 92%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:92%!important;
    overflow-y: scroll;
}
.fltr {
    width:14%;
}
.heading-checkb0x{
    width: 5%;
}
}
@media only screen and (min-width:1000px) and (max-width:1024px){
	.fltr-cont {
    height: 89%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:89%!important;
    overflow-y: scroll;
}
.fltr {
    width:10%;
}
.heading-checkb0x {
    float: left;
    width: 3%;
}
}
@media only screen and (min-width:1025px) and (max-width:1366px){

.fltr {
    width:8%;
}
.search_big input[type="search"]:{width: 96%;}
.search_big button.search:{top: 11px;}
}



.pad-res {
    margin-bottom: 13px;
    /* margin-top: 15px; */
    border-bottom: 1px solid #ccc;
    background: #fff;
    padding: 5px;
}
.discount {
    /* border: 1px solid #ed2541; */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    text-align: center;
    background: #ed2541;
    border: 1px solid #ed2541;
    color: #fff;
    font-weight: bold;
    margin-right: 0px;
    margin-top: -10px;
	margin-left: 0;
    float: RIGHT;
}
.discount p {
    font-size: 13px;
    line-height: 14px;
    letter-spacing: 1px;
}
.out-of-stock {
width: 35%;
font-size: 11px;
margin: 18px auto;
border-radius: 2px;
background-color: #fff;
box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .12);
text-align: center;
padding: 10px 7px;
text-transform: uppercase;
pointer-events: none;
position: absolute;
left: 13%;
-webkit-transform: translateX(-50%);
/* transform: translateX(-50%); */
/* top: 97px; */
}
.out-of-stock span {
    color: #ff6161;
    line-height: 1;
}
/*shortby*/
.dropbtn {
    color: #0066c0;
    padding: 3px;
    font-size: 15px;
    margin: 2px;
    border: 2px solid #ccc;
    cursor: pointer;
}


.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 125px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 999;
}

.dropdown-content a {
    width: 100%;
    display: block;
    padding: 10px 7px !important;
    margin: 0px;
    color: #0066c0;
    font-weight: normal;
    border: none;
    text-align: left;
    height: auto;
    font-size: 10px;
    /* z-index: 9999999999999; */
    border-bottom: 1px solid #ccc !important;
}
.show {display:block;}
.multi-dropdown {
  width: 100%;
  max-width: 100%;
  margin: 0px auto 0px;
  background: #f2f2f2;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}

.multi-dropdown .link {
  cursor: pointer;
  display: block;
  padding: 10px 15px;
  color: #333;
  font-size: 16px;
  font-weight: 700;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.multi-dropdown li:last-child .link { border-bottom: 0; }

.multi-dropdown li i {
  /*position: absolute;*/
  top: 16px;
  left: 12px;
   font-size: 12px;
   color: red !important;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.multi-dropdown li i.fa-chevron-down {
  right: 12px;
  left: auto;
  font-size: 16px;
}

.multi-dropdown li.open .link { color: #333; width:36%; padding:5px; }

.multi-dropdown li.open i { color: #333; }

.multi-dropdown li.open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}
/**
 * Submenu
 -----------------------------*/
.multi-dropdown-submenu {
  display: none;
  font-size: 14px;
}


.multi-dropdown-submenu a {
  display: block;
  text-decoration: none;
  color: #333;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}
.f_sidebar {
    border: none;
    /* margin-bottom: 4px; */
    /* width: 102%; */
    margin: 0 10px 5px;
}
.a-color-base {
    color: #111!important;
}
.s-ref-small-padding-left {
    padding-left: 9px;
}
.s-ref-price-currency {
    position: absolute;
    margin-top: 6.5px;
    line-height: 30px;
    font-size: 100%;
}
.s-ref-price-padding {
    padding-left: 18px;
}
.s-ref-price-range {
    width: 100px;
}
.a-spacing-top-mini {
    margin-top: 6px!important;
}
.a-input-text {
    background-color: #fff;
    height: 31px;
    padding: 3px 0 7px 22px;
    line-height: 31px;
    border: 1px solid #a6a6a6;
    border-top-color: #949494;
    border-radius: 3px;
    box-shadow: 0 1px 0 rgba(255,255,255,.5), 0 1px 0 rgba(0,0,0,.07) inset;
    outline: 0;
    color: #111;
    transition: all .1s linear;
	display:inline-block !important;
}
.s-small-margin-left {
    margin-left: 4px;display:inline-block !important;
}
.a-color-base {
    color: #111!important;
}
.s-ref-small-padding-left {
    padding-left: 9px;display:inline-block !important;
}
.a-button {
    cursor: pointer;
    display:inline-block !important;
    padding: 0;
    text-align: center;
    text-decoration: none!important;
    
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
	display:inline-block !important;
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
	display:inline-block !important;
}
.tit {
    font-weight: bold;
    font-size: 16px;
    margin-top: 8px;
    display: inline-block;
    font-family: Roboto, Arial, sans-serif;
    letter-spacing: 0;
}
.tit-text {
    display: inline-block;
    margin-left: 10px;
    color: #878787;
    font-size: 12px;
    font-family: Roboto, Arial, sans-serif;
    letter-spacing: 0;
}
/*shortby*/
</style>
<!--shortby-->
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function shortFunction() {
    document.getElementById("shortDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<!--shortby-->

<!---Reset filetring script start here --->
<script>
function resetAllFilter(){
	window.onload = $('#limg').css('display','block');
	window.location.href='<?php echo base_url().$this->uri->segment(2);?>';
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


</script>
<!---Reset filetring script end here --->
<!---New filetring script start here --->
<script>
/*var ready = false;
$(document).ready(function (){
    ready = true;
});*/

$(document).ready(function(){
	$('#limg').css('display','none');
});

/*function onloderimg(){
	$('#limg').css('display','block');
	$('.ldr-img').css('display','block');
}*/
 
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

function sortby_price(sortbyprice,catgnm,cat_id,lastseg)
{
	window.onload = $('#limg').css('display','block');
	
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url().'filterby/';?>'+catgnm.replace(" ","-")+'/'+cat_id+'/'+'sortbyprice='+sortbyprice;
	}else{
		window.location.href='<?php echo base_url().'filterby/';?>'+catgnm.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&sortbyprice='+sortbyprice;
	}	
}

function FilterProduct_BrandData(cat_name,cat_id,lastseg,brand){
	window.onload = $('#limg').css('display','block');
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'brand='+brand;
	}else{
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&brand='+brand;
	}
}


function FilterProduct_ColorData(cat_name,cat_id,lastseg,color){
	window.onload = $('#limg').css('display','block');
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'color='+color;
	}else{
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&color='+color;
	}
}


function FilterProduct_SizeData(cat_name,cat_id,lastseg,size){
	window.onload = $('#limg').css('display','block');
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'size='+size;
	}else{
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&size='+size;
	}
}


function FilterProduct_SubSizeData(cat_name,cat_id,lastseg,subsize){
	window.onload = $('#limg').css('display','block');
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'subsize='+subsize;
	}else{
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&subsize='+subsize;
	}
}


function FilterProduct_TypeData(cat_name,cat_id,lastseg,type){
	window.onload = $('#limg').css('display','block');
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'type='+type;
	}else{
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&type='+type;
	}
}

/*function filter_attribute(cat_name,cat_id,lastseg,attrbtype,attrbvalue){
	
	window.onload = $('#limg').css('display','block');
	if(lastseg == 'NOT'){
		window.location.href='<?php //echo base_url();?>product_description/product_addtocart_filter/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+attrbtype+'='+attrbvalue;
	}else{
		window.location.href='<?php //echo base_url();?>product_description/product_addtocart_filter/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&'+attrbtype+'='+attrbvalue;
	}
}*/

var url_strngadded='';

var add_attribute=[];
var remove_attribute=[];
var remove_attribute1=[];
function added_attribute(attrbtype_add,attrbvalue_add,iattrb)
{
	
	var attrbtype_add= attrbtype_add.replace(new RegExp('%20', 'g'), ' ');
	var attrbvalue_add= attrbvalue_add.replace(new RegExp('%20', 'g'), ' ');
	var uri_seg1added='<?php echo $this->uri->segment(1)?>';
	
	if(uri_seg1added=='filterby')
		{
			dltt=attrbtype_add+'='+attrbvalue_add+'&';
			dltt1=attrbtype_add+'='+attrbvalue_add;
			if(document.getElementById('attrb_realvalue'+iattrb).checked== true)
			{
			add_attribute.push(dltt);
			//alert(add_attribute);
			}
			else
			{
			remove_attribute.push(dltt);
			remove_attribute1.push(dltt1);
			//alert(remove_attribute);
			}
		}
	
}


var url_strng='';
function filter_attribute(cat_name,cat_id,lastseg,attrbtype,attrbvalue,attrbsli)
{

		var uri_seg1='<?php echo $this->uri->segment(1)?>';
		if(uri_seg1=='filterby')
		{url_strng='';
		//-----------------old code start-------------------//
				
				var new_attrbtype= attrbtype.replace(new RegExp('%20', 'g'), ' ');
				var new_attrbvalue= attrbvalue.replace(new RegExp('%20', 'g'), ' ');
				
				var lastseg= lastseg.replace(new RegExp('%20', 'g'), ' ');
				
				if(lastseg == 'NOT'){
					url_strng=url_strng+attrbtype+'='+attrbvalue;
				}/*else{ 
						if (lastseg.indexOf(removeedstrgn) !== -1)	
						{ 
									
							var lastseg = lastseg.replace(removeedstrgn, "");
							
							if(lastseg=='')
							{url_strng=url_strng;}
							
						else if(lastseg!='')
						{	
							
							
							url_strng=url_strng+cat_id+'/'+lastseg;
							
						}
					}
					else{
						
					url_strng=url_strng+lastseg+'&';}
				}*/
		url_strng=	lastseg+"&";
		if(add_attribute.length>0){
		for (i = 0; i < add_attribute.length; i++) {
		 
   		 url_strng += add_attribute[i] ;
		 //remove_attribute.pop(dltt);
		 //alert(lastseg);
			}
			//alert("add");
			//alert(url_strng);
		}
		if(remove_attribute.length>0){
		for (i = 0; i < remove_attribute.length; i++) {
   		 
		 url_strng=url_strng.replace(remove_attribute[i],'');
		 //remove_attribute.pop(dltt);
		 
			}
			//alert("remove");
			//alert(url_strng);
		}
		
		
		}
		
		
		else{
			
			dlt=attrbtype+'='+attrbvalue+'&';
			if (url_strng.indexOf(dlt) >= 0){
			url_strng=url_strng.replace(dlt,'');
			}
			else{
				
				url_strng=url_strng+attrbtype+'='+attrbvalue+'&';
				}
			
			}
		//-----------------old code end-------------------//
		
	}
	
	
	
	
	
	function apply_filter(cat_name,catgstr_urlpass)
	{
		//alert(url_strng);
		if (url_strng.substring(url_strng.length-1) == "&")
    	{
		url_strng = url_strng.substring(0, url_strng.length-1);
		}
		if (url_strng.charAt(0) == "&")
    	{
		url_strng = url_strng.substr(1);
		}
		url_strng=cat_name.replace(" ","-")+'/'+catgstr_urlpass+'/'+url_strng;
		//alert(url_strng);
		/*if(url_strngadded!='')
			{
					if (url_strngadded.substring(url_strngadded.length-1) == "&")
					{
					url_strngadded = url_strngadded.substring(0, url_strngadded.length-1);
					}
					//url_strngadded=cat_name.replace(" ","-")+'/'+catgstr_urlpass+'/'+url_strngadded;
				
				
			url_strng=url_strng+'&'+url_strngadded;
			
			window.location.href='<?php  //echo base_url().'filterby/';?>'+url_strng;
			}*/
		
			//else{
			window.location.href='<?php echo base_url().'filterby/';?>'+url_strng;
			//}
		}
/*function clear_all(cat_name){
	
		window.location.href='<?php //echo base_url();?>'+'<?php //echo $this->uri->segment(2); ?>';
	}
*/
/*function filter_attribute(cat_name,cat_id,lastseg,attrbtype,attrbvalue,attrbsli){
	
	
		
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
			window.location.href='<?php //echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id+'/'+attrbtype+'='+attrbvalue;
		}else{ 
				if (lastseg.indexOf(removeedstrgn) !== -1)	
				{ 
							
					var lastseg = lastseg.replace(removeedstrgn, "");
					
					if(lastseg=='')
					{window.location.href='<?php //echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id;}
					
				else if(lastseg!='')
				{
					window.location.href='<?php //echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg;
				}
			}
			else{
			window.location.href='<?php //echo base_url().'filterby/';?>'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&'+attrbtype+'='+attrbvalue;}
		}
	
	
}*/
</script>


<script>
function FilterProduct_OccasionData(cat_name,cat_id,lastseg,ocsns){
	window.onload = $('#limg').css('display','block');
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'ocsns='+ocsns;
	}else{
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&ocsns='+ocsns);
	}
}
</script>
<!---New filetring script end here --->
<script>
function sortby_pricenew()
{        
    
	document.getElementById("low_to_high").style.display="none";
	document.getElementById("high_to_low").style.display="block";
	if('<?php echo $this->uri->segment(4); ?>'=='')
	{
		//label_nameid=$('#label_nameid').val();
		var catgstr_urlpassid=$('#catgstr_urlpassid').val();
		//alert(catgstr_urlpassid);
	window.location.href='<?php echo base_url().'filterby/';?>'+'<?php echo $this->uri->segment(1).'/'; ?>'+catgstr_urlpassid+'<?php echo '/sortbyprice=Low-To-High'; ?>';
	}
	else{
			url_strng='<?php echo $this->uri->segment(4); ?>'
			//alert(url_strng);
			url_strng=url_strng.replace('&sortbyprice=Low-To-High','');
			url_strng=url_strng.replace('sortbyprice=Low-To-High','');
			url_strng=url_strng.replace('&sortbyprice=High-To-Low','');
			url_strng=url_strng.replace('sortbyprice=High-To-Low','');
			
			url_strng += '&sortbyprice=Low-To-High' ;
			//alert(url_strng);
			if (url_strng.charAt(0) == "&")
			{
			url_strng = url_strng.substr(1);
			}
			window.location.href='<?php echo base_url().'filterby/';?>'+'<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3).'/'; ?>'+url_strng;
		}
	
	
}
function sortby_pricenew1()
{        
    document.getElementById("low_to_high").style.display="block";
	document.getElementById("high_to_low").style.display="none";
	
			url_strng='<?php echo $this->uri->segment(4); ?>'
			//alert(url_strng);
			url_strng=url_strng.replace('&sortbyprice=Low-To-High','');
			url_strng=url_strng.replace('sortbyprice=Low-To-High','');
			url_strng=url_strng.replace('&sortbyprice=High-To-Low','');
			url_strng=url_strng.replace('sortbyprice=High-To-Low','');
			
			url_strng += '&sortbyprice=High-To-Low' ;
			//alert(url_strng);
			if (url_strng.charAt(0) == "&")
			{
			url_strng = url_strng.substr(1);
			}
			window.location.href='<?php echo base_url().'filterby/';?>'+'<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3).'/'; ?>'+url_strng;
	
}
</script>

<script>
function clear_allclose()
{
	//alert('sdfdjf');
	//$('input[name=filter_productId[]]').attr('checked', false);
	//document.getElementsByName(filter_productId[]).checked = false;
	backtoall();
	
	var ptradioval = $('input[name="ptradio"]:checked').map(function(_, el){
      return $(el).val();
  }).get();
  if(ptradioval!=''){
	  $('#ptradio'+ptradioval)[0].click();
	  document.getElementById('ptradioboxid'+ptradioval).checked = false;
	  }
	
	$('.has-sub').find('input[type=checkbox]:checked').removeAttr('checked');
	$('.single-bottom').find('input[type=checkbox]:checked').removeAttr('checked');
	$('.heading-checkb0x').prop('checked', false);
	//loadfirstproductsearchajax();
	/*var srch_data='<?php //echo $this->uri->segment(2);?>';
	fltrclose();
	$.ajax({ 
    url:'<?php //echo base_url().'Product_description/search_firstproductloadajax' ?>',
    method:"post",
    data:{search_data:srch_data},    
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
  });*/
	
}
</script>
<script>
function producttyperadio_ck(radiobox_id)
{
document.getElementById('ptradioboxid'+radiobox_id).checked = true;
}
</script>
<script>
function radiofiltertype(id)
{
document.getElementById('ft'+id).checked = true;
}
</script>





<?php
if($this->session->userdata('sesson_searchword'))
	   {
		   ?>
<div class="row" style="background:#fff;">
	<div class="col-md-12" style="padding: 3px 5px; width: 87%; border: 1px solid #ccc; margin: auto; border-radius: 5px;">
    <p style="font-size: 12px; font-weight: bold;"> No Result Found For "<span style="color:#800000;"><?php echo ucwords($this->session->userdata('sesson_searchword'))?></span>"</p>
    <p style="font-size: 12px; font-weight: bold;"> Do you mean 
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

<div style="width:100%;padding: 0 5px;">
     <h2 class="tit"><?php echo ucwords(rawurldecode($this->uri->segment(2)));?></h2>
     <div class="tit-text">
        <span id="product_countno"></span>
    </div>       	
</div>
<div class="filter">
<?php
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
			$strng = $this->uri->segment(5);
		}
      ?>
<!--------------------------Start 26-06-2017-mamata short by menu----------------------------------> 
<div class="filter">
                <div class="col-md-1 fltr"> <a style="border:2px solid #ccc !important;" href="#" onClick="showfilter()"><i class="fa fa-filter" aria-hidden="true"></i> Filter</a> </div>
<?php /*?>            <div id="low_to_high" onclick="sortby_pricenew()" style="display:<?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)),'sortbyprice=Low-To-High' )){echo "none";}else{echo "block";} ?>;" class="col-md-2 fltr"> <a href="#" onClick=""><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-up.png" width="18"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Price</a></div>
				 <div id="high_to_low" onclick="sortby_pricenew1()" style="display:<?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)),'sortbyprice=Low-To-High' )){echo "block";}else{echo "none";} ?>;"  class="col-md-2 fltr"><a href="#" onClick=""><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-down.png" width="18"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i> Price</a></div>
<?php */?>
                 
                 <div class="col-md-1 fltr"> 
                 <!--shortby-->
                 		<div class="dropdown">
<button onclick="shortFunction()" class="dropbtn">Sort By</button>
  <div id="shortDropdown" class="dropdown-content">
  <input style="display:none;" type="text" value="" id="pricesort_textbox" name="pricesort_textbox" class="pricesort_textbox" />
    <a href="#" onclick="pricesort('asc')"><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-up.png" width="18"> Price Low to High</a>
    <a href="#" onclick="pricesort('desc')"><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-down.png" width="18"> Price High to Low</a>
   <!-- <a href="#"><img src="<?php //echo base_url().'mobile_css_js/' ?>images/short-icon/popularity.png" width="18"> Popularity</a>
    <a href="#"><img src="<?php //echo base_url().'mobile_css_js/' ?>images/short-icon/discount.png" width="18"> Discount</a>-->
    <a href="#" onclick="pricesort('Product_Id%20desc')"><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/whats-new.png" width="18"> What's New</a>
    <a href="#" onclick="pricesort('Product_Id%20asc')"><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/whats-new.png" width="18"> Old To New</a>
  </div>
</div>
				 <!--shortby-->
                 	<?php /*?><ul>
                          <li><label for="dd" style="color:#0066c0;"> <img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/short-by.png" style="width:8px;"> Sort By</label>
                            <input type="checkbox" id="dd" hidden>
                                <ul class="dropdown">
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-up.png" width="18"> Price Low to High</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-down.png" width="18"> Price High to Low</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/popularity.png" width="18"> Popularity</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/discount.png" width="18"> Discount</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/whats-new.png" width="18"> What's New</li>
                                </ul>
                          </li>
                    </ul><?php */?>
                    
                  </div>
                 	<!--<div class="product-countno" id="product_countno">
                          <a style="border:none; background:none; list-style:none;">( 100 Product )</a>
                    </div>-->
                  
        <div class="ac list-grid" align="right">
			<a class="button" data-rel="#content-a" id="act1" href="#" onclick="menuvisibility('menu1');">
				<i class="fa fa-th-large" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<a class="button" data-rel="#content-a" id="act2" href="#" onclick="menuvisibility('menu2');">
				<i class="fa fa-list" aria-hidden="true"></i></a>
		</div>
        
        
               <div class="clearfix"> </div>
               
               
</div>

<!--<div id="menu1" style="display:none;">
	<div style="text-align:center; font-size:15px;">
    	List View Demo test
    </div>
</div>-->



<!--<div id="menu2">          
<div style="text-align:center; font-size:15px;">
        <div class="pad-res singleproduct-grids">
			<div class="today-deal-left">
					<a href="<?=APP_BASE?>ansh-fashion-wear-men-denim-lycra-strachable-jeans-&amp;-jogger-pack-of-2/1200974/LTAY-725-2CM-JOGGER-DB-T-20MW-3-34">
					<img src="<?=APP_BASE?>images/product_img/catalog_utfqgoroipyvnkv20170619121653.jpg" alt="Ansh Fashion Wear Men Denim Lycra Strachable Jeans &amp; Jogger Pack Of 2">
				     </a>
			</div>
			<div class="today-deal-right">
				<h5 style="text-align:left; margin-left:0; margin-bottom:8px; font-size:18px; font-family: 'SegoeUI';">
					<a href="<?=APP_BASE?>ansh-fashion-wear-men-denim-lycra-strachable-jeans-&amp;-jogger-pack-of-2/1200974/LTAY-725-2CM-JOGGER-DB-T-20MW-3-34">Ansh Fashion Wear Men Denim Ly...					</a>
				</h5>
				<p style="margin-left:0px; float:left; display:inline-block;">
					<span style="color:#999; text-decoration:line-through">
							<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 3555 </span>&nbsp;&nbsp;
					<span style="color:#fb8928; text-decoration:line-through">
							<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 3555 </span>&nbsp;&nbsp;	
                            <span style="color:#079107 !important;  font-weight:bold;">
                            <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 1199 </span>
					          <span style="display:inline-block;"></span>
                  </p>
                   <div class="discount">
                    <p> 66% off </p>
                   </div>
						                   
			</div>
            <div style="clear:both;"></div>
		</div>
    </div>
</div>-->
<!-----------------------End 26-06-2017-mamata short by menu-------------------------------------> 




     
      
               <!--<div class="col-md-6 fltr"> <a href="#" onClick="showfilter()"> Filters </a> </div>-->
               <!--<div class="col-md-6 fltr">  
               <select class="form-select" onChange="sortby_price(this.value,'<?=$label_name;?>','<?=$label_id;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>')">
               <option value=''> Short By </option>
                <option value="Low-To-High" <?php /*?><?php if(@$arr1[1]=='Low-To-High') {echo "selected";}?><?php */?>> Price: Low To High </option>
               <option value="High-To-Low" <?php /*?><?php if(@$arr1[1]=='High-To-Low') {echo "selected";}?><?php */?>> Price: High To Low </option>
              <!-- <option> Featured </option>
               <option> Price </option>
               <option> Color </option>
               <option> Brand </option>-->
               <!--</select>-->
               
               <!--</div>-->
               <div class="clearfix"> </div>
               </div>

<div class="filterpanel" style="overflow: visible;">
               <div class="filters-head">
                  <div class="filter-result">
                  <!--<h4>Refine Your Results</h4>-->
                  <ul style="padding:0; margin:auto;">
                  	<li class="filter-clearall" id="" onclick="clear_allclose()" style="width:40%;"><a href="#">Clear all</a></li>
                    <li id="clearallid" onclick="clear_all()" class="filter-clearall"><a href="#">Clear all & Close</a></li>
                    
                  </ul>
                  <!--<div id="clearallid" style="display:none;" class="clear-all" onclick="clear_all()">Clear All</div>-->
                   </div>
                 <div class="fltrclose" style="width:auto;"> <a href="#" onClick="fltrclose()"> Close<!--<img src="<?php //echo base_url().'mobile_css_js/' ?>images/close.png" width="16" height="16" alt="">--> </a> </div>
                 <div class="clearfix"></div>
                 </div>
                 
   <div class="f_sidebar" style="background:#fff; height:50px;">
        <div style="width:70%; float:left;">
              <span class="a-color-base s-ref-small-padding-left s-ref-price-currency"><i class="fa fa-inr" aria-hidden="true"></i></span>
      <input type="text" maxlength="9" placeholder="From" id="low_price" name="low-price" class="a-input-text a-spacing-top-mini s-ref-price-range s-ref-price-padding" aria-label="Min">
      <span class="a-color-base s-ref-small-padding-left s-ref-price-currency s-small-margin-left"><i class="fa fa-inr" aria-hidden="true"></i></span>
      <input type="text" maxlength="9" id="high_price" placeholder="To" name="high-price" class="a-input-text a-spacing-top-mini s-ref-price-range s-ref-price-padding s-small-margin-left" aria-label="Max">

        
        </div>
        <div style="width:25%; float:left; margin-top:8px;">
        <span class="a-button s-small-margin-left">
      <!--<input class="a-button-input" type="button" onClick="" value="Search">-->
      <span class="a-button-text" onclick="price_filter()">
      <button class="btn-go" style="margin:auto;border-radius: 5px;font-size: 14px;padding: 4px 6px;">Search <i class="fa fa-search-plus" style="font-size:18px;"></i></button>
      </span>
      </span>
        </div>
      
      
        </div>              
                 
         <div class="search-filter-apply">
         
        <div style="clear:both;"></div>
<div style="width:100%; height:86%; margin:auto; background:#fff; overflow-y:scroll;"> 

<ul id="multi-dropdown" class="multi-dropdown">
  <li>
    <div onclick="radiofiltertype(1)" class="link"><input style="display:none;" type="radio" id="ft1" name="radiofiltertypename" value="radiofiltertypeval" />Filter By<!--<i class="fa fa-chevron-down"></i>--></div>
    <ul class="multi-dropdown-submenu" style="display:block; ">
      <li>
          <a href="#">
          <div id='search-left' style="padding: 0px;">
    
           </div>
          </a>
	</li>
    </ul>
  </li>
  <li style="background:#f9f7df;">
  <div style="float:right; margin-right: 10px;margin-top: 2px;"><span id="backtoall" onclick="backtoall()" style="font-size: 16px; display:none; vertical-align: middle; cursor: pointer; color: rgb(232, 84, 13);">
      <i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i>
         <span style=" font-size:12px;">Back To All Categories</span>
   <i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back To All Categories"></i>
    </span>
 </div>
    <div onclick="radiofiltertype(2)" class="link"><input style="display:none;" type="radio" value="radiomtreeval" id="ft2" name="radiofiltertypename" />Advance Filter
     <!--<i class="fa fa-chevron-down"></i>--></div>
    
    
    
   
    
    
    <ul class="multi-dropdown-submenu">
      <li>
          <a href="#">
          	         <!------------------- category filter_data section Start(1->2->3->brand,clr,etc) ------------------------->
 <div class="filter_searchdatamtree" id="filter_searchdatamtree">
  <div id="mtreefb_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url().'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>
 </div>
<!-------------------------- category filter_data section end(1->2->3->brand,clr,etc) ----------------------->
          </a>
      </li>

    </ul>
  </li>

</ul>

</div>
 </div>
        

        <div class="clearfix"></div>
        			<!--<input type="text" id="label_nameid" value="" />-->
                    
                  <div class="btn_form">
                  
				  <a href="#" onclick="filter_dataajax();fltrclose()"> <span class="apply"> Apply </span> </a>	
                  </div>
        
               </div>
               
<script>
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.multi-dropdown-submenu ').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#multi-dropdown'), false);
});


</script>               
<script type="text/javascript" src="<?php echo base_url()?>mobile_css_js/new/js/jquery.velocity.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>mobile_css_js/new/js/mtree.js"></script>
<script>
$(document).ready(function() {
  var mtree = $('ul.mtree');
  
  // Skin selector for demo
  mtree.wrap('<div class=mtree-demo></div>');
  var skins = ['bubba','skinny','transit','jet','nix'];
  mtree.addClass(skins[0]);
  $('body').prepend('<div class="mtree-skin-selector"><ul class="button-group radius"></ul></div>');
  var s = $('.mtree-skin-selector');
  $.each(skins, function(index, val) {
    s.find('ul').append('<li><button class="small skin">' + val + '</button></li>');
  });
  s.find('ul').append('<li><button class="small csl active">Close Same Level</button></li>');
  s.find('button.skin').each(function(index){
    $(this).on('click.mtree-skin-selector', function(){
      s.find('button.skin.active').removeClass('active');
      $(this).addClass('active');
      mtree.removeClass(skins.join(' ')).addClass(skins[index]);
    });
  })
  s.find('button:first').addClass('active');
  s.find('.csl').on('click.mtree-close-same-level', function(){
    $(this).toggleClass('active'); 
  });
});
</script>