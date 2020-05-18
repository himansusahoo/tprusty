<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
         
	
<?php
								$rows1 = $search_prodclause->num_rows();
						  
						  if($rows1 > 0){ ?>
                            <!-- category list start -->							  
                            
                            <ul>	
								<?php 
								$lvl2_nmarr=array();
								foreach($search_prodclause->result() as $row1){
									if($row1->lvl2_name!=''  ){ 
									
									$lvl2_bredcum=$row1->lvl2;
									
									$qr_bredcum=$this->db->query("SELECT * FROM category_menu_desktop WHERE 
		 ((category_id LIKE '%,$lvl2_bredcum,%' OR category_id LIKE '$lvl2_bredcum,%' OR category_id LIKE '%,$lvl2_bredcum' OR category_id='$lvl2_bredcum')) 
		 ");
		 							$thirddlvl_bredcummenu='';
									$thirddlvl_bredcummenudisplay='';
									
		 							foreach($qr_bredcum->result_array() as $res_bredcum)
									 {
										$array_ctgsrch=explode(',',$res_bredcum['category_id']);			
										
										if(in_array($lvl2_bredcum,$array_ctgsrch))
										{	
											$thirddlvl_bredcummenu=$res_bredcum['url_displayname'];
											$thirddlvl_bredcummenudisplay=$res_bredcum['label_name'];
											
											//$parent_2ndllvlmenu=$res_bredcum['parent_id'];				
										}		
												 
									 }
									
									?>
                                    <?php if(!in_array($thirddlvl_bredcummenudisplay,$lvl2_nmarr)) {?>
										<li>
											<a href="<?php echo base_url().$thirddlvl_bredcummenu ?>">
											 <?php
											 if($thirddlvl_bredcummenudisplay!='' ){
												//echo ($search_keyword);  
												if($search_keyword!='')
												{echo $search_keyword;}
												
												?>&nbsp; 
												<b style="color:#F96;"><?php  echo "in ".$thirddlvl_bredcummenudisplay;  ?></b><?php } ?>
											 </a>
									<?php } ?>
										</li>
                                        <?php } ?> 
								<?php $lvl2_nmarr[]=$thirddlvl_bredcummenudisplay; } ?>
                            </ul>
							<!--<hr />-->
						  <?php } ?>
                            


      
 