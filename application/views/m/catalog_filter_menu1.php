<?php $this->load->helper(array('html','form','url'));

?>
<style>
.fltr {
    float: left;
    padding: 10px 0px;
    text-align: center;
    width: 32%;
    margin: 1px;
}
.fltr ul{
  display:block;
  list-style-type: none;
  text-align:center;
  
}
.fltr ul li{
	font-size: 14px;
    padding: 5px;
    width: 108px;
    margin: 2px auto 0px;
    height: 35px;
    background: #f7f7f7;
    color: #777;
    border: 2px solid #dedede;
    display: block;
  display: inline-block;
  color: white;
  font-family: sans-serif;
  font-weight: 800;
  position:relative;
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
  width: 100%;
  padding:0; margin:0;
  background: green;
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
.fltr a{width: 101px; margin:2px;height: auto;}
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
@media only screen and (min-width:0px) and (max-width:320px){
	.fltr-cont {
    height: 480px;
    overflow-y: scroll;
}
.fltrtabs {
    height: 480px;
    overflow-y: scroll;
}

}
@media only screen and (min-width:321px) and (max-width:360px){
	.fltr-cont {
    height: 86%!important;
}
.fltrtabs {
    height: 86%!important;
}
.fltr {
    width:29%;
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
.fltr {
    width:28%;
}
}
@media only screen and (min-width:376px) and (max-width:414px){
	.fltr-cont {
    height: 88%!important;
    overflow-y: scroll;
}
.fltrtabs {
    height:88%!important;
    overflow-y: scroll;
}
.fltr {
    width:25%;
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
.fltr {
    width:18%;
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
.fltr {
    width:16%;
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
.fltr {
    width:16%;
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
.fltr {
    width:14%;
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
}
@media only screen and (min-width:1025px) and (max-width:1366px){

.fltr {
    width:8%;
}
.search_big input[type="search"]:{width: 96%;}
.search_big button.search:{top: 11px;}
}

</style>

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
function clear_all(cat_name){
	
		window.location.href='<?php echo base_url();?>'+'<?php echo $this->uri->segment(2); ?>';
	}

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

function viewmore(div_id)
{	
	//alert("fff");
	$("#more_div"+div_id).css('display','none');
	$("#rest_prod_div"+div_id).css('display','block');

}
function viewless(div_id)
{	
	//alert("fff");
	$("#more_div"+div_id).css('display','block');
	$("#rest_prod_div"+div_id).css('display','none');

}

</script>
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
                <div class="col-md-2 fltr"> <a href="#" onClick="showfilter()"><i class="fa fa-filter" aria-hidden="true"></i> Filter</a> </div>
                 <div id="low_to_high" onclick="sortby_pricenew()" style="display:<?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)),'sortbyprice=Low-To-High' )){echo "none";}else{echo "block";} ?>;" class="col-md-2 fltr"> <a href="#" onClick=""><!--<img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-up.png" width="18">--><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Price</a></div>
				 <div id="high_to_low" onclick="sortby_pricenew1()" style="display:<?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)),'sortbyprice=Low-To-High' )){echo "block";}else{echo "none";} ?>;"  class="col-md-2 fltr"><a href="#" onClick=""><!--<img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-down.png" width="18">--><i class="fa fa-sort-amount-desc" aria-hidden="true"></i> Price</a></div>

                 
                 <!--<div class="col-md-2 fltr"> 
                 	<ul>
                          <li><label for="dd" style="color:#0066c0;">Sort By</label>
                            <input type="checkbox" id="dd" hidden>
                                <ul class="dropdown">
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-up.png" width="18"> Price Low to High</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-down.png" width="18"> Price High to Low</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/popularity.png" width="18"> Popularity</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/discount.png" width="18"> Discount</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/whats-new.png" width="18"> What's New</li>
                                </ul>
                          </li>
                    </ul>
                    
                  </div>-->
               
               
               <div class="clearfix"> </div>
               </div>



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

<div class="filterpanel">
               <div class="filters-head">
                  <div class="filter-result">
                  <h4>Refine Your Results</h4>
                   <div id="clearFilter" class="clear-all" onclick="clear_all('<?=$label_name;?>')">Clear All</div>
                   </div>
                 <div class="fltrclose"> <a href="#" onClick="fltrclose()"> <img src="<?php echo base_url().'mobile_css_js/' ?>images/close.png" width="16" height="16" alt=""> </a> </div>
                 <div class="clearfix"></div>
                 </div>
         <div class="fltrtabs">
         <!-- Nav tabs -->
          <!---------------------------------------sujit start------------------------------------->
  <?php 
			//$catg_idstr=str_replace('-',',',$this->uri->segment(4));
			if($this->uri->segment(1)!='filterby')
			{
				$label_name=$this->uri->segment(1);}
			else
			{$label_name=$this->uri->segment(2);}
			
			$qr_lblid=$this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
				if($qr_lblid->num_rows()>0)
				{
					$dskcatgid_id=$qr_lblid->row()->category_id;
					$bredcum_name=$qr_lblid->row()->label_name;
					$bredcum_parnetlblbid=$qr_lblid->row()->parent_id;						
				}
				
				$qrparntbrecum=$this->db->query("SELECT * FROM category_menu_mobile WHERE dskmenu_lbl_id='$bredcum_parnetlblbid' ");
				$parent_bredcumname=$qrparntbrecum->row()->label_name;
				$parent_bredcumnamelink=$qrparntbrecum->row()->url_displayname;
			
			$catg_idstr=str_replace('-',',',$dskcatgid_id);
			
			$catgstr_urlpass=str_replace(',','-',$dskcatgid_id);
			//echo $catgstr_urlpass;exit;
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
	 
   <?php
//------------------------ filter slab display as per filter setup start----------------------
		
			
			$arr_mrgattrbfldid=array();
			$arr_mrgattrbfldname=array();
			
			
			if($query_fltrcatg->num_rows()>0)
			{
				$rw_queryfltrcatg=$query_fltrcatg->result_array();
				foreach($rw_queryfltrcatg as $resqueryfltrdata)
				{
					$attr_fldidarr=unserialize($resqueryfltrdata['attribute_realid']);
					$attr_fldnamearr=unserialize($resqueryfltrdata['attribute_realname']);
					//print_r($attr_fldnamearr);print_r($attr_fldidarr);
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
		
//-------------------------- filter slab display as per filter setup end-----------------------
		  ?>         
          
          
          <?php
		
		  	$uniquearr_mrgattrbfldname = array_unique($arr_mrgattrbfldname);
			$uniarr_mrgattrbfldid = array_unique($arr_mrgattrbfldid);
			//print_r($arr_mrgattrbfldid);print_r($uniarr_mrgattrbfldid);exit;
		 	$iattrb=0;
		  ?>
  <!---------------------------------------sujit end-------------------------------------> 
          <ul class="nav nav-tabs filter-tabs sideways">
            <?php foreach($uniquearr_mrgattrbfldname as $key=>$valattrbhead){ ?>
            <li><a href="#tab<?=$key?>" data-toggle="tab"> <?=$valattrbhead?> </a></li>
          <?php  } ?>
            
            <li  class="active"><a href="#tabprice3" data-toggle="tab"> Price</a> </li>
            
            <!--<li><a href="#tab2" data-toggle="tab"> Capacity</a> </li>
            <li><a href="#tab4" data-toggle="tab"> Type </a> </li>
            <li><a href="#tab5" data-toggle="tab"> Discount %  </a> </li>
            <li><a href="#tab6" data-toggle="tab"> Connectivity  </a> </li>
            <li><a href="#tab7" data-toggle="tab"> Customer Rating  </a> </li>
            <li><a href="#tab8" data-toggle="tab"> Color </a> </li>
            <li><a href="#tab9" data-toggle="tab"> Occasion  </a> </li>-->
          </ul>
      </div>

        <div class="fltr-cont">
          <!-- Tab panes -->
          <div class="tab-content">
            <!--<div class="tab-pane active" id="tab1">
            <div class="single-bottom"> <label for="accessible"> <input type="radio" value="accessible" name="quality" id="accessible"> <span></span> accessible</label> </div>
            <div class="single-bottom"> <label for="party"> <input type="radio" value="party" name="quality" id="party"> <span></span>party </label></div>
            <div class="single-bottom"> <label for="rock"> <input type="radio" value="rock"  name="quality" id="rock" checked> <span></span> Rock</label></div>
            <div class="single-bottom"> <label for="pop"> <input type="radio" value="pop" name="quality" id="pop"> <span></span>  Pop </label></div>
            <div class="single-bottom"> <label for="classical"> <input type="radio" value="classical"  name="quality" id="classical" checked> <span></span> classical</label>
            </div>
            
            </div>-->
            
          <?php foreach($uniquearr_mrgattrbfldname as $key=>$valattrbhead){ ?>  
            <div class="tab-pane" id="tab<?=$key?>">
            
            <?php 
					$attrb_reapt=array(); 
					$attrb_id=$uniarr_mrgattrbfldid[$key];
					$attrbval_query=$this->db->query("SELECT distinct a.attr_value,a.attr_id FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE  a.attr_id='$attrb_id' AND b.lvl2 IN ($catg_idstr)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND a.attr_value!='' GROUP BY REPLACE(attr_value, ' ', '') limit 10  ");
					if($attrbval_query->num_rows()>0)
					{ 
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
			   
			   if($valattrbhead=='COLOR' || $valattrbhead=='Color' || $valattrbhead=='color') 
			    { if($res_attrbval['attr_value']!='' && in_array(trim($res_attrbval['attr_value']),$attrb_reapt)){
			   ?>
            <div class="single-bottom">
             <div class="left-menu-left">
            	<input <?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval['attr_id']).'-'.trim($valattrbhead).'='.trim($res_attrbval['attr_value']))){echo "checked";} ?>  type="checkbox" onChange="added_attribute('<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>'),filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>')" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval['attr_value'])?>" >
               
               <label for="attrb_realvalue<?=$iattrb?>"><span></span> <?php echo trim($res_attrbval['attr_value']);?> </label>
            </div>
            <div class="color-fl" style="background-color:<?php echo trim($res_attrbval['attr_value'])?>;background-image:<?php if(trim($res_attrbval['attr_value'])=='Multicolor'){echo "url(".base_url()."images/multi_color.jpg)";}?>"></div>
            </div>
            <div style="clear:both"></div>
            <hr style="border-top: 1px solid #ccc !important;margin: 0!important;">
              
            <?php }} else { 
				 if($res_attrbval['attr_value']!='' && in_array(trim($res_attrbval['attr_value']),$attrb_reapt)){
				 ?>
            
            <div class="single-bottom" title="<?php echo trim($res_attrbval['attr_value'])?>">
              	<input <?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval['attr_id']).'-'.trim($valattrbhead).'='.trim($res_attrbval['attr_value']))){echo "checked";} ?> type="checkbox"  onChange="added_attribute('<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>'),filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval['attr_value'])?>','<?=$iattrb?>')" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval['attr_value'])?>"  
					   <?php if(in_array(trim($res_attrbval['attr_value']), $attrbrealvalue)){echo "Checked disabled ";} ?> >
                <label for="attrb_realvalue<?=$iattrb?>"><span></span> <?php echo trim($res_attrbval['attr_value']);?> </label>
                 </div>
            <?php }} ?>      
                       
					<?php
						} // for loop end 
						$iattrb++;
					 } 
					 
		}?>
             <div id="more_div<?=$key?>" style="display:block" onclick="viewmore(<?=$key?>)"><i class="fa fa-angle-double-down" aria-hidden="true"></i> More</div>
         <?php 
		 $attrbval_query=$this->db->query("SELECT distinct a.attr_value,a.attr_id FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE  a.attr_id='$attrb_id' AND b.lvl2 IN ($catg_idstr)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND a.attr_value!='' GROUP BY REPLACE(attr_value, ' ', '') ");
		 echo $tot=$attrbval_query->num_rows();
		 
		 $attrbval_query2=$this->db->query("SELECT distinct a.attr_value,a.attr_id FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE  a.attr_id='$attrb_id' AND b.lvl2 IN ($catg_idstr)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND a.attr_value!='' GROUP BY REPLACE(attr_value, ' ', '') limit 10,$tot  ");
		 
		  ?>
          <div id="rest_prod_div<?=$key?>" style="display:none;">   
            <?php
						foreach($attrbval_query2->result_array() as $res_attrbval2)
						{
							$attrb_reapt[]=	$res_attrbval2['attr_value'];		
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
			   
			   if($valattrbhead=='COLOR' || $valattrbhead=='Color' || $valattrbhead=='color') 
			    { if($res_attrbval2['attr_value']!='' && in_array(trim($res_attrbval2['attr_value']),$attrb_reapt)){
			   ?>
            <div class="single-bottom">
             <div class="left-menu-left">
            	<input <?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval2['attr_id']).'-'.trim($valattrbhead).'='.trim($res_attrbval2['attr_value']))){echo "checked";} ?>  type="checkbox" onChange="added_attribute('<?=trim($res_attrbval2['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval2['attr_value'])?>','<?=$iattrb?>'),filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval2['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval2['attr_value'])?>','<?=$iattrb?>')" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval2['attr_value'])?>" >
               
               <label for="attrb_realvalue<?=$iattrb?>"><span></span> <?php echo trim($res_attrbval2['attr_value']);?> </label>
            </div>
            <div class="color-fl" style="background-color:<?php echo trim($res_attrbval2['attr_value'])?>;background-image:<?php if(trim($res_attrbval2['attr_value'])=='Multicolor'){echo "url(".base_url()."images/multi_color.jpg)";}?>"></div>
            </div>
            <div style="clear:both"></div>
            <hr style="border-top: 1px solid #ccc !important;margin: 0!important;">
              
            <?php }} else { 
				 if($res_attrbval2['attr_value']!='' && in_array(trim($res_attrbval2['attr_value']),$attrb_reapt)){
				 ?>
                 
                 
                
                
                
               <!-- ---------------------------------------------- -->
                 
                 
                 
            
            <div class="single-bottom" title="<?php echo trim($res_attrbval2['attr_value'])?>">
              	<input <?php if(strstr(str_replace('%20', ' ', $this->uri->segment(4)), trim($res_attrbval2['attr_id']).'-'.trim($valattrbhead).'='.trim($res_attrbval2['attr_value']))){echo "checked";} ?> type="checkbox"  onChange="added_attribute('<?=trim($res_attrbval2['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval2['attr_value'])?>','<?=$iattrb?>'),filter_attribute('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=trim($res_attrbval2['attr_id']).'-'.trim($valattrbhead);?>','<?=trim($res_attrbval2['attr_value'])?>','<?=$iattrb?>')" id="attrb_realvalue<?=$iattrb?>" name="attrb_realvalue[]" value="<?=trim($res_attrbval2['attr_value'])?>"  
					   <?php if(in_array(trim($res_attrbval2['attr_value']), $attrbrealvalue)){echo "Checked disabled ";} ?> >
                <label for="attrb_realvalue<?=$iattrb?>"><span></span> <?php echo trim($res_attrbval2['attr_value']);?> </label>
                 </div>
                 
              
                 
                 
              <!-- ---------------------------------------------- -->   
                 
                 
                 
           
            
            
            
            <!-- ---------------------------------------------- -->
            
            
            
            
            <?php }} ?>      
                       
					<?php
						} // for loop end 
						$iattrb++;
						
					 } 
					
		?>  <div id="less_div<?=$key?>" style="display:block" onclick="viewless(<?=$key?>)"><i class="fa fa-angle-double-up" aria-hidden="true"></i> Less</div>
           </div><!--2nd div end for view more-->
            
            
            </div>
          <?php  } ?> 
             <!-- Price filtering section start-->
      <?php //Price filtering section start
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

  
            <div class="tab-pane active" id="tabprice3">
            <div class="price-range">FROM :<br><input id="start_pric" type="text" placeholder="(Rs.)" name="start_pric"></div>
            <div class="price-range">TO :<br><input id="end_pric" type="text" placeholder="(Rs.)" name="end_pric"></div>
            <input class="btn-success" type="button" value="Search" onClick="FilterProduct_PriceData('<?=$label_name;?>','<?=$catgstr_urlpass;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>')">
            </div>
            <?php }//Price filtering section start?>
<!------------------Price filtering section start------------------------------------>
            <!--<div class="tab-pane" id="tab4">Settings Tab.</div>
            <div class="tab-pane" id="tab5">Home Tab.</div>
            <div class="tab-pane" id="tab6">Profile Tab.</div>
            <div class="tab-pane" id="tab7">Messages Tab.</div>
            <div class="tab-pane" id="tab8">Settings Tab.</div>
            <div class="tab-pane" id="tab9">Settings Tab.</div>-->
          </div>
        </div>

        <div class="clearfix"></div>
        			<!--<input type="text" id="label_nameid" value="" />-->
                    <input type="hidden" id="catgstr_urlpassid" value="<?=$catgstr_urlpass;?>" />
                  <div class="btn_form">
                  
				  <a href="#" onclick="apply_filter('<?=$label_name;?>','<?=$catgstr_urlpass;?>')"> <span class="apply"> Apply </span> </a>	
                  </div>
        
               </div>