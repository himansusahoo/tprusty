<style>
/**************************mtree****************/
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

/**************************mtree end****************/
</style>
<ul class="mtree transit filter_searchdata">
  <?php //error_reporting(0);
	  //echo '<pre>';print_r($filter_data);exit; ?>
    
    <?php
	$cntt=count($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3']);
	for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
	$cntt1=count($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot']);	
		for($i_arr1=0; $i_arr1<$cntt1; $i_arr1++ ) {
	?>
    <li><a href="#"><?php echo stripslashes($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'('.$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['count'].')';?></a>
      <ul>
      <?php
	$cntt2=count($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot']);
	for($i_arr2=0; $i_arr2<$cntt2; $i_arr2++ ) {
	 ?>
        <li><a href="#"><?php echo stripslashes($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']).'('.$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['count'].')';?></a>
          <!--<ul>-->
          
          
          
          
          
          <?php $id= $filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['value'].$filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['pivot'][$i_arr1]['value'].$filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']; ?>
          
          
          <?php
		  $curl_strng6="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&q=".$search_title."&wt=json&useParams=".$id."&rows=0";
				
			$curl26 = curl_init($curl_strng6);
			curl_setopt($curl26, CURLOPT_RETURNTRANSFER, true);
			$output6 = curl_exec($curl26);
			$data26 = json_decode($output6, true);			
			//echo '<pre>';print_r($data2);exit;
			if($data26['response']['numFound']==0)
			{	
				$sugword6=$data26['spellcheck']['collations'][1];
				//$this->load->library('session');
				//$this->session->set_userdata('sugstword',$sugword);					
				$searchsuggst_txt6=trim(str_replace(' ','%20',$sugword6));	
				$curl_strng="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&q=".$search_title."&wt=json&useParams=".$id."&rows=0";
				$curl36 = curl_init($curl_strng6);
				curl_setopt($curl36, CURLOPT_RETURNTRANSFER, true);
				$output36 = curl_exec($curl36);
				$data36 = json_decode($output36, true);				
				$filter_dataid=$data36;
				
			}
			else
			{	
				$filter_dataid=$data26;		
			}
		?>
          
          
          
          <?php
		  if(@$filter_dataid['facet_counts']['facet_fields']){
          $arrbrand=array_keys($filter_dataid['facet_counts']['facet_fields']);
		  $cnt_brand=count($arrbrand);
		  if($cnt_brand>0){
		  ?>

          <ul>
          	<?php
			for($i_arrbrand=0; $i_arrbrand<$cnt_brand; $i_arrbrand++ ) {
	 		?>
            <li><a href="#"><?php echo str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand]);?></a>
              <ul>
              
              
            <?php
			//print_r($filter_dataid['facet_counts']['facet_fields']);
			$cnt=count($filter_dataid['facet_counts']['facet_fields'][$attribute]);
			for($i=0,$j=1; $i<$cnt-1; $i+=2,$j+=2 ) {
            ?> 
                <li style="color:#999; font-weight:bold;"><a href="#"><input value="<?php echo $id.'|'.$attribute.'|'.$filter_dataid['facet_counts']['facet_fields'][$attribute][$i] ?>" onClick="filter_dataajax('<?php echo $i_arrbrand.$i ?>')" id="<?php echo 'filter_productId'.$i_arrbrand.$i ?>" name="filter_productId[]" type="checkbox">
				&nbsp;
				<?php echo $filter_dataid['facet_counts']['facet_fields'][$attribute][$i].'('.$filter_dataid['facet_counts']['facet_fields'][$attribute][$j].')'?></a></li>
           <?php }?>
                <!--<li><a href="#"><input type="checkbox">HTC</a></li>-->
              </ul>
            </li>
            <?php }?>
          </ul>
          <?php }}?>
        </li>
     <?php }?>
      </ul>
    </li>
    
   <?php }}?>
  </ul>
<script src="<?php echo base_url()?>new_js/js/jquery.velocity.min.js"></script> 
<script src="<?php echo base_url()?>new_js/js/mtree.js"></script>
<script>
$(document).ready(function() {
	//loadfilter_product();
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