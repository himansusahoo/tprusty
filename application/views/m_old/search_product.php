<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
         
	
<?php
								$rows1 = $search_prodclause->num_rows();
						  
						  if($rows1 > 0){ ?>
                            <!-- category list start -->							  
                            
                            <ul>	
								<?php
								$lvl2_nmarr=array();
								 foreach($search_prodclause->result() as $row1){
									if($row1->lvl2_name!='' ){ 
									
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
											<?php /*?><a href="<?php echo base_url().'product_description/product_addtocart/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($row1->lvl2_name)))).'/'.$row1->lvl2 ?>"><?php */?>
                                            
                                            <a href="<?php echo base_url().$thirddlvl_bredcummenu ?>">
                                            
											 <?php
												 if($thirddlvl_bredcummenudisplay!=''){
												echo ($search_keyword);  ?>&nbsp; 
												<b style="color:#F96;"><?php  echo "in ".$thirddlvl_bredcummenudisplay;  ?></b><?php } ?>
											 </a>
									<?php } ?>
										</li>
                                        <?php } ?> 
								<?php $lvl2_nmarr[]=$thirddlvl_bredcummenudisplay; } ?>
                            </ul>
							<hr />
						  <?php } ?>
                            
<?php
$rows2 = $search_prod->num_rows();
 if($rows2 > 0){ ?>                           <!-- category list end -->
 <ul>							  
                     <?php     foreach($search_prod->result() as $row_prd){
							  $product_id=$row_prd->product_id;
							   // $category_name=$row->category_name;
							  //$arr_img = explode(',',$row_prd->imag);
							   ?>
  <?php if($row_prd->name!=''){ 
  
  
  								$lvl2_bredcum=$row_prd->lvl2;
									
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
<li>

<?php /*?><a href="<?php echo base_url().'product_description/product_addtocart/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($row_prd->lvl2_name)))).'/'.$row_prd->lvl2 ?>">
<?php */?>
<?php /*?><a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($row_prd->lvl2_name))))) ?>">
<?php */?>

<a href="<?php echo base_url().$thirddlvl_bredcummenu ?>">

<!--<img src="<?php //echo base_url().'images/product_img/'.$row_prd->imag; ?>" style="height:50px; width:50px;">&nbsp;-->
<p> <?php 
 echo ($row_prd->name); ?> </p><!--&nbsp; in-->
 <div class="clearfix"> &nbsp;</div>
<?php
 //echo ($row->lvl1_name); ?>
 </a>

 <?php } ?>


</li> <?php } ?>

</ul>
    <?php }else{?>
<ul>	<li>
	
	<?php echo "No Results Found" ?></li>
	
   </ul> 
         
         <?php  }?>	

      
 