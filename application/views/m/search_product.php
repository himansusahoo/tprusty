<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
  <style>
  
  #searchdiv2 {
    /* left: 0; */
    background-color: #fff;
    height: 185px;
    /* overflow: scroll; */
    /* border-bottom: 2px solid #eeac0d; */
    border: 1px solid #888;
    /* right: -9px; */
    width: 74%;
    box-shadow: 0 8px 16px 1px rgba(0,0,0,.7);
    /* top: -12px; */
    margin-top: -3px;
    float: right;
    position: absolute;
    overflow-y: scroll;
}
  </style>       
	<?php 
	//echo '<pre>';print_r($search_prodclause);exit; 
	if(count($search_prodclause['spellcheck']['collations'])>1){
		
		$seg2val=$search_prodclause['spellcheck']['collations'][1];
		$seg2val=str_replace('*','',$seg2val);
		}else{
				
				$seg2val=$search_prodclause['responseHeader']['params']['f.Brand_s.facet.prefix'];
			 }
	
	
	?>

								
                            <!-- category list start -->							  
                            
                            <ul>	
								<?php 
								
			//echo '<pre>';print_r(array_unique($category_Lvl3_arr));	?>
<!---------------------------------- category_Lvl3_arrun start ------------------------------------------>
							
							<?php 
							$lvlcnt=count($search_prodclause['grouped']['Category_Lvl1']['groups']);
							if($lvlcnt>0){
							for($i_lvl3=0; $i_lvl3<$lvlcnt; $i_lvl3++ ){
							$lvlcnt1=count($search_prodclause['grouped']['Category_Lvl1']['groups'][$i_lvl3]['doclist']['docs']);
							for($i_lvl=0; $i_lvl<$lvlcnt1; $i_lvl++ ){
								
								$arr_title=array(
								'Title'=>$search_prodclause['grouped']['Category_Lvl1']['groups'][$i_lvl3]['doclist']['docs'][$i_lvl]['Title']	);
							$qtitle_strng= str_replace("+","%20",str_replace("=",":",http_build_query($arr_title)));
							
							$arr_catlvl3=array(
								'Category_Lvl3'=>$search_prodclause['grouped']['Category_Lvl1']['groups'][$i_lvl3]['doclist']['docs'][$i_lvl]['Category_Lvl3']	);
							$fqcatlvl3_strng= str_replace("+","%20",str_replace("=",":",http_build_query($arr_catlvl3)));
							?>
                                       
                                       
                                       
                                        <li>
											<a href="<?php echo base_url().'search-by/'.str_replace('/','',$search_prodclause['grouped']['Category_Lvl1']['groups'][$i_lvl3]['doclist']['docs'][$i_lvl]['Title']).'/'.str_replace('/','',base64_encode($qtitle_strng)).'/'.str_replace('/','',base64_encode($fqcatlvl3_strng)) ?>" >
											 <?php echo $search_prodclause['grouped']['Category_Lvl1']['groups'][$i_lvl3]['doclist']['docs'][$i_lvl]['Title']; ?>&nbsp; 
												<b style="color:#000;"> in <?php echo $search_prodclause['grouped']['Category_Lvl1']['groups'][$i_lvl3]['doclist']['docs'][$i_lvl]['Category_Lvl3']; ?> </b>
											 </a>
									
										</li>
                               <?php }}} ?>  
<!---------------------------------- category_Lvl3_arrun end ------------------------------------------>
<!----------------------------------------- brandarrun start ------------------------------------>
			<?php
			$brandarr=array();
			$cntbrand=count($search_prodclause['facet_counts']['facet_fields']['Brand_s']);
			if($cntbrand>0)
			{
				for($brandi=0; $brandi<$cntbrand; $brandi+=2 )
				{
					array_push($brandarr,$search_prodclause['facet_counts']['facet_fields']['Brand_s'][$brandi]);			
				}
					$brandarrun=array_values(array_filter(array_unique($brandarr)));
							foreach ($brandarrun as $valuebrand){
								
								
								$arr_brand=array(
												'Brand'=>$valuebrand
												);
							$qbrand_strng= str_replace("+","%20",str_replace("=",":",http_build_query($arr_brand)));
								
							?>
                                        <li>
											<a href="<?php echo base_url().'search-by/'.str_replace('/','',$valuebrand).'/'.str_replace('/','',base64_encode($qbrand_strng)).'/'.str_replace('/','',base64_encode('seg_3data'))?>" >
											 <?php echo $search_prodclause['responseHeader']['params']['f.Brand_s.facet.prefix']; ?>&nbsp; 
												<b style="color:#000;"> in <?php echo '(Brand: '.$valuebrand.')'; ?></b>
											 </a>
									
										</li>
             <?php } }?>  
<!----------------------------------------- brandarrun end ------------------------------------> 
<!---------------------------------- title_arrun start ------------------------------------------>                               
							   
			<?php
			$textarr=array();
			$cnt_text=count($search_prodclause['facet_counts']['facet_fields']['_text_']);
			if($cnt_text>0)
			{
				for($texti=0; $texti<$cnt_text; $texti+=2 )
				{
					array_push($textarr,$search_prodclause['facet_counts']['facet_fields']['_text_'][$texti]);			
				}
					$textarrun=array_values(array_filter(array_unique($textarr)));
							foreach ($textarrun as $valuetext){
								
							$arr_text=array(
											  'text'=>$valuetext
											);
							$qtext_strng= str_replace("+","%20",str_replace("text=","",http_build_query($arr_text)));	
								
							?>
                                        <li>
											<a href="<?php echo base_url().'search-by/'.str_replace('/','',$valuetext).'/'.str_replace('/','',base64_encode($qtext_strng)).'/'.str_replace('/','',base64_encode('seg_3data'))?>" >
											 <?php echo $search_prodclause['responseHeader']['params']['f.Brand_s.facet.prefix']; ?>&nbsp; 
												<b style="color:#000;"> in <?php echo $valuetext; ?></b>
											 </a>
									
										</li>
             <?php } }?> 
<!----------------------------------------- title_arrun end ------------------------------------>                 
                            </ul>
							<!--<hr />-->
						 
                            


      
 