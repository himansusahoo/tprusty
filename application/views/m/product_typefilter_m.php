<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>mobile_css_js/new/css/search-left-3rdsection-menu.css" />
<script src="<?php echo base_url()?>mobile_css_js/new/js/search-left-3rdsection-menu.js" type="text/javascript"></script>
<style>
li.has-sub ul li label {
    margin-left: 31px;
    margin-bottom: 13px;
    font-weight: normal !important;
}
#search-left > ul > li.has-sub > a span {
  background: url(<?php echo base_url();?>new_css/css/menu_images/icon_plus.png) 96% center no-repeat;
}
#search-left > ul > li.has-sub.active > a span {
  background: url(<?php echo base_url();?>new_css/css/menu_images/icon_minus.png) 96% center no-repeat;
}
</style>
<ul>
   <li><a href='http://google.com'><span>Home</span></a></li>
   <?php //error_reporting(0);
	  //echo '<pre>';print_r($filter_data);exit; ?>
<?php
	  $arrbrand1=array('0'=>'Type','1'=>'Brand','2'=>'Color','3'=>'Size','4'=>'Age Group','5'=>'Design');
	  if(@$filter_data['facet_counts']['facet_fields']){
		  $id=$filter_data['response']['docs'][0]['Category_Lvl1_Id'][0].$filter_data['response']['docs'][0]['Category_Lvl2_Id'][0].$filter_data['response']['docs'][0]['Category_Lvl3_Id'][0];
	  $arrbrand=array_keys($filter_data['facet_counts']['facet_fields']);
	  $cnt_brand=count($arrbrand);
	  if($cnt_brand>0){
		  $unid=0;
		 for($i_arrbrand=0; $i_arrbrand<$cnt_brand; $i_arrbrand++ ) {
			 if(count($filter_data['facet_counts']['facet_fields'][$arrbrand[$i_arrbrand]])>0){
?>
	<?php $attrb_chk=str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand]);
	 if(in_array($attrb_chk,$arrbrand1)){ ?>
   <li><input style="display:none;" type="radio" name="ptradio" id="<?php echo 'ptradioboxid'.$i_arrbrand;?>" value="<?php echo $i_arrbrand;?>" /><a onclick="producttyperadio_ck(<?php echo $i_arrbrand;?>)" id="<?php echo 'ptradio'.$i_arrbrand;?>" href='#'><span><?php echo str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand]);?></span></a>
      <ul>
         <li>
         <?php
			//print_r($filter_dataid['facet_counts']['facet_fields']);
			$cnt=count($filter_data['facet_counts']['facet_fields'][$attribute]);
			for($i=0,$j=1; $i<$cnt-1; $i+=2,$j+=2 ) {
				$unid++;
            ?>
         	<div id="<?php echo 'labelid'.$unid.$i_arrbrand.$i;?>" class="<?php echo str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand]);?>" style="border-bottom:1px solid #ccc;">
         	<label class="checkbox">
               <input type="checkbox" style="margin-left: -31px; width: 10%; float: left; margin-top: 1px;" value="<?php echo $id.'|'.$attribute.'|'.$filter_data['facet_counts']['facet_fields'][$attribute][$i] ?>" onclick="removefilter_data('<?php echo '999'.$unid.$i_arrbrand.$i ?>')" id="<?php echo 'filter_productId'.'999'.$unid.$i_arrbrand.$i ?>" name="filter_productId[]">
               		<i></i><?php echo $filter_data['facet_counts']['facet_fields'][$attribute][$i]?><span id="<?php echo 'spanpcountid'.$unid.$i_arrbrand.$i;?>"> <?php echo '('.$filter_data['facet_counts']['facet_fields'][$attribute][$j].')' ?> </span>  
            </label>
            </div>
            <input style="display:none;" type="text" value="<?php echo $attribute.':'.@$filter_data['facet_counts']['facet_fields'][$attribute][$i];?>" name="cktextbox[]" id="" class="" /><input style="display:none;" type="text" value="<?php echo $unid.$i_arrbrand.$i;?>" name="cktextboxid[]" id="" class="" /><input style="display:none;" type="text" value="<?php echo $filter_data['facet_counts']['facet_fields'][$attribute][$j];?>" name="datacount[]" id="" class="" />
            <?php }?>
         </li>
         </ul>
   </li>
   <?php }}}}}?>
   
   
   
</ul>