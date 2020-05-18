<style>
/**************************mtree****************/
.mtree-skin-selector {
  text-align: center;
  padding: 10px 0 5px;
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
    <li id="<?php echo 'liid'.$i_arr.$i_arr1; ?>" class="liclass"><a onclick="liblocknone('<?php echo $i_arr.$i_arr1; ?>');click_ul_lifilter('<?php echo 'Category_Lvl1:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['value']).'|||)&fq=Category_Lvl2:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'|||)'?>','<?php echo $i_arr.$i_arr1; ?>')" href="#">
	
	<?php echo stripslashes($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'('.$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['count'].')';?>
    
    <input style="display:none;" id="<?php echo 'radiotextbox'.$i_arr.$i_arr1; ?>" type="radio" name="ul_liradio" value="<?php echo 'Category_Lvl1:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['value']).'|||)&fq=Category_Lvl2:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'|||)'?>" />
    
    </a>
      <ul>
      <?php
	$cntt2=count($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot']);
	for($i_arr2=0; $i_arr2<$cntt2; $i_arr2++ ) {
	 ?>
     
     
     
     
        <span onclick="spanblock('<?php echo $search_title; ?>','<?php echo $i_arr.$i_arr1.$i_arr2; ?>','<?php echo $filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']; ?>');click_ul_lifilter('<?php echo 'Category_Lvl1:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['value']).'|||)&fq=Category_Lvl2:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'|||)'?>','<?php echo $i_arr.$i_arr1; ?>')" class="spanclass" id="<?php echo '2ndspan'.$i_arr.$i_arr1.$i_arr2; ?>" style="color:#e8540d; font-size:16px; display:none; cursor:pointer;">
  
  
        <i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i> <span style="font-size:12px;">Back to Sub Categories</span>
        <i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i><i class="fa fa-angle-left" aria-hidden="true" title="Back to Sub Category"></i>
        </span>
        
        
        
        
        
        <li id="<?php echo '2ndliid'.$i_arr.$i_arr1.$i_arr2; ?>" class="2ndliclass">
        <input style="display:none;" type="checkbox" id="<?php echo 'ckboxid'.$i_arr.$i_arr1.$i_arr2; ?>" name="" class="" /><input style="display:none;" type="checkbox" value="<?php echo '2ndckboxid'.$i_arr.$i_arr1.$i_arr2; ?>" id="<?php echo '2ndckboxid'.$i_arr.$i_arr1.$i_arr2; ?>" name="2ndckboxclass[]" class="2ndckboxclass" />
        <a onclick="li2bdblocknone('<?php echo $i_arr.$i_arr1.$i_arr2; ?>');click_ul_lifilter('<?php echo 'Category_Lvl1:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['value']).'|||)&fq=Category_Lvl2:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'|||)&fq=Category_Lvl3:(|||'.urlencode($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']).'|||)' ?>','<?php echo $i_arr.$i_arr1.$i_arr2; ?>');mtree2('<?php echo $search_title; ?>','<?php echo $i_arr.$i_arr1.$i_arr2; ?>','<?php echo $filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']; ?>')" href="#" class="active-sub">
        <i id="<?php echo 'plus_minus'.$i_arr.$i_arr1.$i_arr2; ?>" style="float: right;font-size: 10px;" class="fa fa-plus" aria-hidden="true"></i>
		
		<?php echo ucwords(stripslashes($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value'])).'('.$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['count'].')';?>
        
        <input style="display:none;" id="<?php echo 'radiotextbox'.$i_arr.$i_arr1.$i_arr2; ?>" type="radio" name="ul_liradio" value="<?php echo 'Category_Lvl1:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['value']).'|||)&fq=Category_Lvl2:(|||'.urlencode(@$filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['value']).'|||)&fq=Category_Lvl3:(|||'.urlencode($filter_data['facet_counts']['facet_pivot']['Category_Lvl1,Category_Lvl2,Category_Lvl3'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']).'|||)' ?>" />
        
        </a>
          <!--<ul>-->
          
          
          
          
          
          <?php /*?><?php $id= $filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['value'].$filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['pivot'][$i_arr1]['value'].$filter_data['facet_counts']['facet_pivot']['Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id'][$i_arr]['pivot'][$i_arr1]['pivot'][$i_arr2]['value']; ?><?php */?>
          
          
          

          <div style="display:none;" id="<?php echo 'mtree2'.$i_arr.$i_arr1.$i_arr2; ?>" class="<?php echo 'mtree2'.$i_arr.$i_arr1.$i_arr2.' mtree22'; ?>">loading..</div>
          
          
          
          
          
          
          
          
          
          
          
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
<!--<script>
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
</script>-->