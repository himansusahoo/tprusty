<link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/mtree.css"> 

<ul class="mtree transit">
    
   <?php //error_reporting(0);
	  //echo '<pre>';print_r($filter_data);exit; ?>
    <input style="display:none;" type="text" value="" name="" id="st_block_nonetextbox" class="" /><input style="display:none;" type="text" value="" name="" id="nd_block_nonetextbox" class="" />
    <?php
	$cntt=count($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3']);
	for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
	$cntt1=count($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot']);	
		for($i_arr1=0; $i_arr1<$cntt1; $i_arr1++ ) {
	?> 
    <li class="st_block_none" id="<?php echo 'st_'.$i_arr.$i_arr1?>">
    <a id="<?php echo 'stan_'.$i_arr.$i_arr1?>" onclick="st_block_none('<?php echo $i_arr.$i_arr1?>')" href="#">
    
    <?php echo stripslashes($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'('.$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['count'].')';?>
    
    </a> <input type="radio" id="<?php echo 'radiotextbox'.$i_arr.$i_arr1; ?>" name="ul_liradio" value="<?php echo 'Category_Lvl1:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['value']).'|||)&fq=Category_Lvl2:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'|||)'?>" style="margin:-29px 0 0 -2px;" class="heading-checkb0x">
      <ul>
      <span onclick="ndspanback()" class="spanclass" id="2ndspan" style="color: rgb(232, 84, 13); font-size: 16px; display:none; cursor: pointer;">
  
  
        <i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i> <span style="font-size:12px;">Back to Sub Categories</span>
        <i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i>
        </span>
      <?php
	$cntt2=count($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot']);
	for($i_arr2=0; $i_arr2<$cntt2; $i_arr2++ ) {
	 ?>
        <li class="nd_block_none" id="<?php echo 'nd_'.$i_arr.$i_arr1.$i_arr2?>">
        <a id="<?php echo 'ndan_'.$i_arr.$i_arr1.$i_arr2?>" onclick="nd_block_none('<?php echo $i_arr.$i_arr1.$i_arr2?>')" href="#">
        <?php echo stripslashes($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']).'('.$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['count'].')';?>
        </a> <input type="radio" id="<?php echo 'radiotextbox'.$i_arr.$i_arr1.$i_arr2; ?>" name="ul_liradio" value="<?php echo 'Category_Lvl1:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['value']).'|||)&fq=Category_Lvl2:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'|||)&fq=Category_Lvl3:(|||'.urlencode($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']).'|||)' ?>" style="margin:-29px 0 0 -2px;" class="heading-checkb0x">
          
          
          <?php /*?><?php $id= $filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['value'].$filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['pivot'][$i_arr1]['value'].$filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']; ?><?php */?>
          
          
          
          
          <?php 
		  
		  $Category_Lvl3_Id=urlencode($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']);
		  
		  
		  
          $curl_strngparamid="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&wt=json&rows=1&start=0&fq=Category_Lvl3:(%22".$Category_Lvl3_Id."%22)&fl=Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id";
		
		
		
		$curl3 = curl_init($curl_strngparamid);
		curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
		$output3 = curl_exec($curl3);
		$data3 = json_decode($output3, true);
		$id=$data3['response']['docs'][0]['Category_Lvl1_Id'][0].$data3['response']['docs'][0]['Category_Lvl2_Id'][0].$data3['response']['docs'][0]['Category_Lvl3_Id'][0];
          
          
          ?>
          
          
          
          
          
          
          
          <?php
		  $curl_strng6="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&q=".$search_title."&wt=json&useParams=".$id."&rows=0&fq=Category_Lvl3:".$Category_Lvl3_Id."";
				
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
				$curl_strng="http://74.208.217.65:8983/solr/mycollection2_online/select?indent=on&q=".$search_title."&wt=json&useParams=".$id."&rows=0&fq=Category_Lvl3:".$Category_Lvl3_Id."";
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
            <li>
            <a href="#">
			<?php echo str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand]);?>
            </a> <!--<input type="radio" id="<?php //echo 'radiotextbox'.$i_arr.$i_arr1.$i_arr2.$i_arrbrand; ?>" name="ul_liradio" value="nocatlvlradiobtn" style="margin:-29px 0 0 -2px;" class="heading-checkb0x">-->
              <ul>
              
              <?php
			//print_r($filter_dataid['facet_counts']['facet_fields']);
			$cnt=count($filter_dataid['facet_counts']['facet_fields'][$attribute]);
			for($i=0,$j=1; $i<$cnt-1; $i+=2,$j+=2 ) {
            ?> 
                <li>
                    <a href="#" style="padding:8px 5px 1px;">
                    <div class="single-bottom" title="Apple">
              	<input type="checkbox" id="<?php echo 'filter_productId'.$i_arr.$i_arr1.$i_arr2.$i_arrbrand.$i ?>" name="filter_productId[]" onclick="removefilter_data('<?php echo $i_arr.$i_arr1.$i_arr2.$i_arrbrand.$i ?>')" value="<?php echo $id.'|'.$attribute.'|'.$filter_dataid['facet_counts']['facet_fields'][$attribute][$i] ?>">
                <label for="<?php echo 'filter_productId'.$i_arr.$i_arr1.$i_arr2.$i_arrbrand.$i ?>"><span></span>
                <?php echo $filter_dataid['facet_counts']['facet_fields'][$attribute][$i].'('.$filter_dataid['facet_counts']['facet_fields'][$attribute][$j].')'
				
				
				?>
                </label>
                 	</div>
                    </a>
                </li>
                
             <?php }?>   
              </ul>
            </li>
            <?php }?>
            <?php 
		   $category_id=$data3['response']['docs'][0]['Category_Lvl3_Id'][0]; 
		   $qry=$this->db->query("SELECT url_displayname FROM category_menu_mobile WHERE category_id in($category_id) limit 1;");
		   if($qry->num_rows()>0){
	  	   $url=$qry->row()->url_displayname;
		  ?>
          <a href="<?php echo base_url().$url;?>" style="text-align:center; font-size:13px; color:#eeac0d;">More Attributes</a>
           <?php }?>
          </ul>
          <?php }}?>
        </li>
      <?php }?>  
      </ul>
    </li>
   <?php }}?>
   
    
</ul>

<script type="text/javascript" src="<?php echo base_url()?>mobile_css_js/new/js/jquery.velocity.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>mobile_css_js/new/js/mtree.js"></script>