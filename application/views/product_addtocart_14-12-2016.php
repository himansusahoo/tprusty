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

    	<?php include "header.php";?><!------ Start Content ------>

    	<!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.css">
  		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css">-->
  		<!--<link rel="stylesheet" href="<?php// echo base_url(); ?>css/frontend/jquery.simplecolorpicker.css">
  		<link rel="stylesheet" href="<?php// echo base_url(); ?>css/frontend/jquery.simplecolorpicker-fontawesome.css">-->


<script>
function ShowMoreData(result_no,cat_id,lastseg){
	var numItems = parseInt($('.grid1_of_4').length);
	var result_no = parseInt(result_no);
	//alert(lastseg);return false;
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
			$('.grids_of_4').append(result);
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
}
</script>


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
			window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'price='+price_slab;
		}else{
			window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&price='+price_slab;
		}
	}
}

function sortby_price(sortbyprice,catgnm,cat_id,lastseg)
{
	window.onload = $('#limg').css('display','block');
	
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+'sortbyprice='+sortbyprice;
	}else{
		window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&sortbyprice='+sortbyprice;
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


<!---Reset filetring script start here --->
<script>
function resetAllFilter(){
	window.onload = $('#limg').css('display','block');
	window.location.href='<?php echo base_url();?>product_description/product_addtocart/<?=$this->uri->segment(3);?>/<?=$this->uri->segment(4);?>';
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
	window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+res;
}


//removing a value from an array script
/*function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}
var ary = ['three', 'seven', 'eleven'];
removeA(ary, 'seven');*/
</script>
<!---Reset filetring script end here --->



<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1735141076720620');
fbq('track', "PageView");
</script>
<noscript><img height="1" width="1" style="display:none;" src="https://www.facebook.com/tr?id=1735141076720620&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<div class="main-content">
<!--Need for colour pallet-->
<!-- Button to init the jQuery plugin -->
<button id="init" style="display:none;" class="btn btn-primary">Init the jQuery plugin</button>
<!-- Button to destroy the jQuery plugin -->
<button id="destroy" style="display:none;" class="btn btn-danger">Destroy the jQuery plugin</button>

<div class="col-md-3 filter">
<h3>Filter by <span id="ajxtst"></span></h3>

	  <!-- Price filtering section start-->
      <?php
      //remove brand parameter if brand is already in the url parameter program start here
		if(strpos($this->uri->segment(5),'price') !== false){
			$array = explode('&',$this->uri->segment(5));
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
      
	  <div class="f_sidebar">
        <section class="filter-form">
          <h4>Price</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
					<div  class="price-range"> FROM : <br> <input type="text" name="start_pric" id="start_pric" placeholder="(Rs.)"> </div>
                    <div  class="price-range"> TO :  <br> <input type="text" name="end_pric" id="end_pric" placeholder="(Rs.)"> </div>
                    <input class="btn-go hvr-sweep-to-right" type="button" value="Search" onClick="FilterProduct_PriceData('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>')">
                    
                    <!--<input type="button" value="search" onClick="asdf()">-->
                    
                  </div>
              </div>
		</section>
        </div>
        <!-- Price filtering section end-->
        
        <?php
		if($filter_fld_result != false){
			$brand_arr = array();
			$color_arr = array();
			$size_arr = array();
			$sub_size_arr = array();
			$type_arr = array();
			$occasion_arr = array();
			
			foreach($filter_fld_result as $row){
				if($row->brand != ''){
					array_push($brand_arr,trim($row->brand));
				}
				
				if($row->color != ''){
					array_push($color_arr,trim($row->color));
				}
				
				if($row->size != ''){
					array_push($size_arr,trim($row->size));
				 }
				
				if($row->sub_size != ''){
					array_push($sub_size_arr,trim($row->sub_size));
				}
				
				if($row->type != ''){
					array_push($type_arr,trim($row->type));
				}
				
				if($row->occasion != ''){
					array_push($occasion_arr,trim($row->occasion));
				}
			}
			
			$brand_arr = array_unique($brand_arr);
			$color_arr = array_unique($color_arr);
			$size_arr = array_unique($size_arr);
			$sub_size_arr = array_unique($sub_size_arr);
			$type_arr = array_unique($type_arr);
			$occasion_arr = array_unique($occasion_arr);
		}
		?>
        
        <!-- Brand filtering section start-->
        <?php 
		if(!empty($brand_arr)){
			//remove brand parameter if brand is already in the url parameter program start here
		  	if(strpos($this->uri->segment(5),'brand') !== false){
			  	$array = explode('&',$this->uri->segment(5));
				$param = array();
				foreach($array as $key=>$val){
					$arr1 = preg_split('/=/',$val);
					$brand_attr[] = $arr1[1];
					if($arr1[0] != 'brand'){
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
				$brand_attr = array();
			}
		?>
        <div class="f_sidebar">
        <section class="filter-form">
          <h4>Brand</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
					<?php foreach($brand_arr as $val){?>
					<label class="radio"><input type="radio" value="<?=$val;?>" <?php if(in_array($val,$brand_attr)){ echo 'checked';} ?> name="brand_radio" onClick="FilterProduct_BrandData('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=$val;?>')"><i></i><?=$val;?></label>
					<?php } ?>
                  </div>
              </div>
		</section>
        </div>
        <?php } ?>
		<!-- Brand filtering section end-->
        
        <!-- Color filtering section start-->
        <?php if(!empty($color_arr)){
			//remove brand parameter if brand is already in the url parameter program start here
		  	if(strpos($this->uri->segment(5),'color') !== false){
			  	$array = explode('&',$this->uri->segment(5));
				$param = array();
				foreach($array as $key=>$val){
					$arr1 = preg_split('/=/',$val);
					$color_attr[] = $arr1[1];
					if($arr1[0] != 'color'){
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
				$color_attr = array();
			}
		?>
        
        <div class="f_sidebar">
        <section class="filter-form">
          <h4>Colour</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
                    <select name="colorpicker-fontawesome" id="color_palet" onChange="FilterProduct_ColorData('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>',this.value)">
                    	<option value=""></option>
                        <?php foreach($color_arr as $val){?>                                
                        <option value="<?=$val;?>" <?php if(in_array($val,$color_attr)){ echo 'selected';} ?>><?=$val;?></option>
                        <?php } ?>
                    </select>
                  </div>
              </div>
		</section>
        </div>
        <?php } ?>
		<!-- Color filtering section end-->
        
        <!-- Size filtering section start-->
        <?php if(!empty($size_arr)){ 
			//remove brand parameter if brand is already in the url parameter program start here
		  	if(strpos($this->uri->segment(5),'size') !== false){
			  	$array = explode('&',$this->uri->segment(5));
				$param = array();
				foreach($array as $key=>$val){
					$arr1 = preg_split('/=/',$val);
					$size_attr[] = $arr1[1];
					if($arr1[0] != 'size'){
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
				$size_attr = array();
			}
		?>
        <div class="f_sidebar">
        <section class="filter-form">
          <h4>Size</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
					<?php foreach($size_arr as $val){?>
					<label class="radio"><input type="radio" value="<?=$val;?>" <?php if(in_array($val,$size_attr)){ echo 'checked';} ?> name="color_radio" onClick="FilterProduct_SizeData('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=$val;?>')"><i></i><?=$val;?></label>
					<?php } ?>
                  </div>
              </div>
		</section>
        </div>
        <?php } ?>
		<!-- Size filtering section end-->
        
        <!-- Sub Size filtering section start-->
        <?php if(!empty($sub_size_arr)){
			//remove brand parameter if brand is already in the url parameter program start here
		  	if(strpos($this->uri->segment(5),'subsize') !== false){
			  	$array = explode('&',$this->uri->segment(5));
				$param = array();
				foreach($array as $key=>$val){
					$arr1 = preg_split('/=/',$val);
					$subsize_attr[] = $arr1[1];
					if($arr1[0] != 'subsize'){
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
				$subsize_attr = array();
			}
		?>
        <div class="f_sidebar">
        <section class="filter-form">
          <h4>Sub Size</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
					<?php foreach($sub_size_arr as $val){?>
					<label class="radio"><input type="radio" value="<?=$val;?>" <?php if(in_array($val,$subsize_attr)){ echo 'checked';} ?> name="color_radio" onClick="FilterProduct_SubSizeData('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=$val;?>')"><i></i><?=$val;?></label>
					<?php } ?>
                  </div>
              </div>
		</section>
        </div>
        <?php } ?>
		<!-- Sub Size filtering section end-->
       
        <!-- Type filtering section start-->
        <?php if(!empty($type_arr)){
			//remove brand parameter if brand is already in the url parameter program start here
		  	if(strpos($this->uri->segment(5),'type') !== false){
			  	$array = explode('&',$this->uri->segment(5));
				$param = array();
				foreach($array as $key=>$val){
					$arr1 = preg_split('/=/',$val);
					$type_attr[] = $arr1[1];
					if($arr1[0] != 'type'){
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
				$type_attr = array();
			}
		?>
        <div class="f_sidebar">
        <section class="filter-form">
          <h4>Sub Size</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
					<?php foreach($type_arr as $val){?>
					<label class="radio"><input type="radio" value="<?=$val;?>" <?php if(in_array($val,$type_attr)){ echo 'checked';} ?> name="color_radio" onClick="FilterProduct_TypeData('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=$val;?>')"><i></i><?=$val;?></label>
					<?php } ?>
                  </div>
              </div>
		</section>
        </div>
        <?php } ?>
		<!-- Type filtering section end-->
        
        <!-- Type filtering section start-->
        <?php if(!empty($occasion_arr)){
			//remove brand parameter if brand is already in the url parameter program start here
		  	if(strpos($this->uri->segment(5),'ocsns') !== false){
			  	$array = explode('&',$this->uri->segment(5));
				$param = array();
				foreach($array as $key=>$val){
					$arr1 = preg_split('/=/',$val);
					$ocsn_attr[] = $arr1[1];
					if($arr1[0] != 'ocsns'){
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
				$ocsn_attr = array();
			}
		?>
        <div class="f_sidebar">
        <section class="filter-form">
          <h4>Occasion</h4>
              <div class="row1 scroll-pane">
                  <div class="col col-4">
					<?php foreach($occasion_arr as $val){?>
					<label class="radio"><input type="radio" value="<?=$val;?>" <?php if(in_array($val,$ocsn_attr)){ echo 'checked';} ?> name="color_radio" onClick="FilterProduct_OccasionData('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>','<?=$val;?>')"><i></i><?=$val;?></label>
					<?php } ?>
                  </div>
              </div>
		</section>
        </div>
        <?php } ?>
		<!-- Type filtering section end-->
        
        <!-- Type filtering section Start-->
          <!-- <div class="f_sidebar">
           
           <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
   <section class="filter-form">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1 <i class="fa fa-angle-down"></i>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus 
      </div>
     
    </div>
  
         </section>   
         </div>  
         </div>
         </div>-->
       <!-- Type filtering section end--> 
        <div class="clearfix"></div>
   </div>


<div class="catalog-cont">
<div class="w_content">
		<div class="catlog">
            
            <div id="limg"> <div class="ldr-img"></div> </div> <!--Loader div-->
            
        	<div>
            	<span>Total <?=$no_of_product;?> products </span>
                <?php
				if($this->uri->segment(5) != ''){
					//echo ' of &nbsp;&nbsp;&nbsp;&nbsp;';
					$url_array = explode('&',$this->uri->segment(5));
					foreach($url_array as $key=>$val){
						//$arr1 = str_replace('-',' ',str_replace('%20',' ',preg_split('/=/',$val)));
						$arr1 = preg_split('/=/',$val);
						//$attr[] = $arr1[0];
						//$vale[] = $arr1[1];
						
						$reset_filter_parameter = $arr1[0].'='.$arr1[1];
				?>
                 
			<?php if(@$arr1[1]=='Low-To-High'||  @$arr1[1]=='High-To-Low')   { echo " ";}else{ echo "  "?>	<span class="rst_spn"> <?php  echo $arr1[1]; ?><i class="fa fa-times close_filter" aria-hidden="true" onClick="resetFilterIndivisually('<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?=$this->uri->segment(5);?>','<?php echo $arr1[0].'='.$arr1[1];?>')"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;
<?php }  ?>
				<?php } //End of if foreach loop ?>
				<?php if(@$arr1[1]=='Low-To-High'||  @$arr1[1]=='High-To-Low')   { echo " ";}else{ ?><span class="rst_spn close_filter" onClick="resetAllFilter();">Clear all</span> <?php } ?>
				<?php } //End of if condition ?>
                <!--<span>HP <i class="fa fa-times" aria-hidden="true"></i></span>-->
                 <div class="dropdown_left">
			       Sort By Price &nbsp;<select class="dropdown selectpicker" id="attr_size"  data-style="btn-info" style="width:auto;" onChange="sortby_price(this.value,'<?=$this->uri->segment(3);?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $strng;}else{ echo 'NOT';}?>')" >        <option value=''>--Select--</option>
						  <option value="Low-To-High" <?php if(@$arr1[1]=='Low-To-High') {echo "selected";}?> >Price: Low To High</option>						  
						  <option value="High-To-Low" <?php if(@$arr1[1]=='High-To-Low') {echo "selected";}?>>Price: High To Low</option>
						  
					   </select>
					  </div>
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
             
            <!-- IMPORTANT, SHOWING FILTER DATA RESULT -->
             <?php /*?><div id="filtr_breadcrumb">
             	Showing Result : 
                <span style="color:#757575;">
				<?= $this->uri->segment(3)?> &nbsp;
				<?php
				if($this->uri->segment(5)){
					$parm_arr = explode('&',$this->uri->segment(5));
					$parm = $parm_arr[1];
					echo '/ '.$parm;
				}
				if($this->uri->segment(6) != ''){ 
					echo ' / '.substr($this->uri->segment(6),4);
				}
				if($this->uri->segment(7) != ''){
					echo ' / '.substr($this->uri->segment(7),4);
				}
				?>
                </span>
             </div><?php */?>
             
		     <div class="clearfix"> </div>
		</div>
         <!-- grids_of_4 -->
		<div class="grids_of_4" id="catlog_dv">
        <?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
		//print_r($row);exit;
		if($row>0){
		foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw->special_pric_from_dt;
			$special_price_to_dt = $rw->special_pric_to_dt;
			
			$dsply_img = $rw->catelog_img_url;
			$image_arr=explode(',',$rw->catelog_img_url);
			//$taxdecimal = $rw->tax_rate_percentage/100;
			
			//tax amount for product price
			//$tax_amount = $rw->price*$taxdecimal;
			
			//tax amount for product special price
			//$tax_amount_special = $rw->special_price*$taxdecimal;
			$quantity=$rw->quantity;
		?>
		  <div class="grid1_of_4 catlg">
          
				<div class="content_box"> 
               <div class="view view-fifth">
                 <?php if($quantity == 0){ ?>
                 <div class="outofstock">
                <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" >Out of Stock </a> </div><?php }?>
                <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" >
                  	
                    <?php if(empty($dsply_img)){?>
    				<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="noimage">
    				<?php }else{?>
					<img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" onerror="imgError(this);" class="img-responsive wow flipInY" data-wow-delay="1s" alt="<?=$rw->name.'_moonboy' ?>">
   					<?php } ?>
                    
				   </a> </div>
                   
                  <div class="wish-list"> <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$rw->product_id; ?>,'<?=$rw->sku; ?>')"> <i class="fa fa-heart"></i> </span>
            <?php }else{ ?>
            	<a class="link-wishlist inline" href="#inline_content"> <i class="fa fa-heart"></i> </a>
            <?php } ?>
            </div>
				    <h2 class="prdt_title"> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" > <?php if(strlen($rw->name) > 40){ echo substr($rw->name,0,40).'...';}else{ echo $rw->name;}?></a> </h2>
                     
                      <!--- <h6><?php// echo substr($rw->description,0,50).'...';  ?> </h6> -->
                     
                     <!--- price calculation div start here --->
                    <?php /*?><div class="price-box">
                    <?php 
                    if($rw->special_price !=0){ 
                        if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                    ?> 
                    
                    <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                    <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
                    <?php }else{ ?>
                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span>
                        <?php } //End of date condition ?>
                    
                    <?php }else{ ?>
                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span>
                    <?php } ?>
                    </div><?php */?>
                    
                    
        <!--- price calculation div start here --->
     	<div class="price-box">
        <!---Special price exists condition start here --->
		<?php
		if($rw->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
		
        <?php } ?>
        </div>
        <!--- price calculation div end here --->
      
       <?php
		$query= $this->db->query("SELECT product_id FROM product_master WHERE approve_status = 'Active' and product_id='$rw->product_id' and seller_id!=0 GROUP BY product_id, seller_id");
		
		//$qr=$query->result();
		//print_r($qr);exit;
		    //foreach($qr as $rew){
			$count_13 = $query->num_rows()-1;
			//print_r($count_1);exit;
			if($count_13 != 0)
			{
			//?>

         <div class="other-seller">  <a href="#"> From <?php echo $count_13; ?> other Sellers </a> </div> 
		 <?php }//} ?>

           <!--<ul class="add-to-links">
            <li><span class="separator"> <input type="checkbox"> </span> <a href="#" class="link-compare">Add to Compare</a></li>
           </ul>-->


        <!--<div class="btn-bg">
			<button type="button" title="Quick View" class="button btn-cart" data-toggle="modal" data-target="#myModal<?=$sl?>">View Details</button> 
		</div> -->
		
         <!-- Modal --> 
		<?php /*?><div class="modal fade" id="myModal<?=$sl?>" role="dialog" aria-labelledby="myModalLabel"> 
            <div class="vertical-alignment-helper">
                 <div class="modal-dialog vertical-align-center">
                     <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         </div>
                         
                         <div class="modal-body">
                            <div class="col-md-8 quick_view_img">
                              <img src="<?php $image_arr1=explode(',',$rw->imag); echo base_url().'images/product_img/'.$image_arr1[0]; ?>" class="" width="500" alt=""/>
                            </div>
                                
                            <div class="col-md-4 quick_view_data">
                                <div class="light-box-product-details">
                                    <h2 class="single_prdct_title"><?=$rw->name?></h2>
                                    
                                    <!--- price calculation div start here --->
                                    <div class="price-box">
                                    <!---Special price exists condition start here --->
                                    <?php
                                    if($rw->special_price !=0){
                                        if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                    ?>
                                    
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
                                    <!---Special price exists condition end here --->
                                    <?php }else{ ?>
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } //End of date condition ?>
                                    
                                    <?php }else{ ?>
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } ?>
                                    </div>
                                    <!--- price calculation div end here --->
                                    <!--<button type="button" title="Add to Cart" onClick="window.location.href='<?//php echo base_url().'product_description/addtocart/'.str_replace(" ","-",strtolower($rw->name)).'/'.$rw->product_id.'/'.$rw->sku; ?>' " class="btn btn-primary" >Add to Cart</button>--> 
                                    <div>
                                        <ul>
                                            <?php if($rw->short_desc){
                                                $data = $rw->short_desc;
                                                //$description = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $data);
                                            	//$short_desc = unserialize($description);
												$short_desc = unserialize($data);
                                                foreach($short_desc as $value){
                                                ?>
                                                    <li><?=$value?></li>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                                
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
            </div><?php */?>
		
          <!-- Modal --> 
		
			   	</div>
				
			</div>
            
            <?php } // End of foreach loop?>
            <?php }else{ ?>
           <div>NO Record Found</div>
			<?php } ?>
     
          <?php } // End of product data is not false condition ?>
       </div><!-- end grids_of_4 -->

           <div class="clearfix"></div>
           <div id="view_more_dv">
           		<img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none;"/>
                <?php if($no_of_product > $sl){ ?>
				<input type="button" id="view_moreproduct" class="add-to-cart view_mor" value="View More" name="button" onClick="ShowMoreData('<?=$no_of_product;?>','<?=$this->uri->segment(4);?>','<?php if($this->uri->segment(5) != ''){ echo $this->uri->segment(5);}else{ echo 'NOT';}?>')">
				<?php }	?>
           </div>
</div>
</div>

<div class="clearfix">&nbsp;</div>


<?php include "footer.php" ?>

<!-- Script start for color pallet start here -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.js"></script>-->
<script src="<?php echo base_url();?>js/jquery.simplecolorpicker.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
 /* $('select[name="colorpicker-change-background-color"]').on('change', function() {
    $(document.body).css('background-color', $('select[name="colorpicker-change-background-color"]').val());
  });*/

  $('#init').on('click', function() {
    $('select[name="colorpicker-fontawesome"]').simplecolorpicker({theme: 'fontawesome'});
  });

  $('#destroy').on('click', function() {
    $('select').simplecolorpicker('destroy');
  });

  // By default, activate simplecolorpicker plugin on HTML selects
  $('#init').trigger('click');
  $('#init').hide();
  $('#destroy').hide();
});
</script>
<!--Script end of color pallet start here-->

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
				window.location.reload(true);
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

<!--<script>
function thirdBrandFilter(brand,cat_name,cat_id){
	window.location.href='<?php// echo base_url();?>product_description/filteredbrand/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'brnd&'+brand;
}

function thirdPriceFilter(price_slab,cat_name,cat_id){
	window.location.href='<?php// echo base_url();?>product_description/filteredprice/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+'prce&'+price_slab;
}

function thirdMultiFilter(price_brnd,cat_id,cat_name,val){
	window.location.href='<?php// echo base_url();?>product_description/multifilter/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+price_brnd+'/'+val;
}

function brandColor(cat_name,cat_id,brand){
	var clr_name = $("#color_palet option:selected").text();
	window.location.href='<?php// echo base_url();?>product_description/filteredbrand_color/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+brand+'/'+'colr'+clr_name;
}

function priceColor(cat_name,cat_id,price){
	var clr_name = $("#color_palet option:selected").text();
	window.location.href='<?php// echo base_url();?>product_description/filteredprice_color/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+price+'/'+'colr'+clr_name;
}

function multiFldFiltr(cat_name,cat_id,parm1,parm2){
	var clr_name = $("#color_palet option:selected").text();
	window.location.href='<?php// echo base_url();?>product_description/multifiltered/'+cat_name.replace(" ","-")+'/'+cat_id+'/'+parm1+'/'+parm2+'/colr'+clr_name;
}
</script>-->


<script>
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
.quick_view_img img{width: auto !important; height: auto !important;}
.quick_view_img{width:500px; height:500px;}
.quick_view_data{height::500px; width:300px;}
.light-box-product-details{padding: 10px;}

span[title="Multicolor"]{
   background: red; /* For browsers that do not support gradients */
  /* For Safari 5.1 to 6.0 */
  background: -webkit-linear-gradient(left,red,orange,yellow,green,blue,indigo,violet);
  /* For Opera 11.1 to 12.0 */
  background: -o-linear-gradient(left,red,orange,yellow,green,blue,indigo,violet);
  /* For Fx 3.6 to 15 */
  background: -moz-linear-gradient(left,red,orange,yellow,green,blue,indigo,violet);
  /* Standard syntax */
  background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet); 
}

#lodr_img{ width:80px; height:80px;display:none;}
.color{border:1px solid #ccc !important;}
#view_more_dv{text-align:center;}
.close_filter{ font-weight:300px; cursor:pointer;}
.rst_spn{ background-color:#ccc; padding:0px 5px;}
#limg { background:rgba(255,255,255,0.7); /*position:absolute;*/ top:0;left:0px; z-index:10000000; position:fixed;}
.ldr-img{background:url(<?php echo base_url(); ?>images/lodr.gif) no-repeat top center; margin:25% 649px 70%; width:50px; height:50px;}
</style>



  <script src="<?php echo base_url();?>js/wow.js"></script>
<script>
    wow = new WOW(
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
    };
  </script>

</body>

</html>