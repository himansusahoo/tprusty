<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once('header.php'); ?>
  <style>.carousel-control {
  padding-top:6%;
  width:5%;
}
.thumbnail {
    display: inline-block!important;
    padding: 4px;
    margin-bottom: 4px;
    line-height: 1.42857143;
    background-color: #ceccaa!important;
    border: none;
    border-radius: 4px;
    -webkit-transition: border .2s ease-in-out;
    -o-transition: border .2s ease-in-out;
    transition: border .2s ease-in-out;
    float: left;
    width: 25%!important;
	    color: #000 !important;
    font-weight: normal;
	font-size:13px;
	text-align:center;
}
.carousel-control.right {
    background-image: none!important;
}
.carousel-control.left {
    background-image: none!important;
}
.well {
    padding: 0px!important;
    margin-bottom:0px!important;
	background-color: #ceccaa!important;
}
</style>         
        <!--div wrap start-->
<div class="wrap">
    
<?php 
  
if($sec_info->num_rows()>0)
{ $cur_dtm=date('y-m-d h:i:s');
	foreach($sec_info->result_array() as $res_secdata)
	{		  
?>
	<!---------------------------------------------------section 1st condition start--------------------------------------------->
	<?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='53x52')
               {?>
               <div class="container" style="padding:0!important;">
                    <div class="col-md-12" style="padding:0!important;">
                        <div class="well">
                            <div id="myCarousel" class="carousel slide">
                             <div class="carousel-inner">
               
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
                    
                                <!-- Carousel items -->
                                
										 <?php if($qr_imginfo->num_rows()>0) 
                                            { 
											
											foreach($qr_imginfo->result_array() as $res_imgdata){
                                                                    
                                        ?>
                                       
                                   		<div class="item active">
                                        <div class="row" style="margin: auto;">
                                        
                                        <?php if($res_imgdata['sku']!=''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail">
                                           <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'"  alt="Image" class="img-responsive" />
                                           <?=stripslashes($res_imgdata['imag_label'])?>
                                            </a>
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if($res_imgdata['URL']!=''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail">
                                             <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"  alt="Image" class="img-responsive"/>
                                           <?=stripslashes($res_imgdata['imag_label'])?>
                                            </a>                            
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                                            <div class="col-sm-3">
                                            <a class="thumbnail">
                                            <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" alt="Image" class="img-responsive">
                                            <?=stripslashes($res_imgdata['imag_label'])?>
                                            </a>
                                            
                                            </div>
                                            <?php } ?>
                                            
                                            </div>
                                        <!--/row-->
                                    </div>
                                
                                            
                                            <?php 
                                                } // image for loop end 
                                            } // image num_rows condition end ?>
                                        
                               
			<?php  
					   } // column for loop end
					   
					}// column num_rows condition end
			?>
            
             <!--/carousel-inner--> </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                            </div>
                            <!--/myCarousel-->
                        </div>
                        <!--/well-->
                    </div>
                </div>		

			<?php  } // section 1st condition end ?>
	 <!---------------------------------------------------section 1st condition end--------------------------------------------->
	<!---------------------------------------------------section 1st condition start--------------------------------------------->	
	<?php /*?><?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='53x52')
               {?>
               
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
    
              	<div style="background:<?=$res_clmn['bg_color']?>; ">
                
                   <section class="regular slider" style="height:105px;">
                   <!-- <div>
                       <img src="<?=APP_BASE?>images/pagedesign_image/ghig24zimtntqv920170601142745.jpg">
                      <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">1st Image</p>
                    </div>-->
                    
                    <!------------------------------------->
                    
                    <?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){
								                        
                        ?>
                        <?php if($res_imgdata['sku']!=''){ ?>
                      <div>
                        <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
						 <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
						 <?=stripslashes($res_imgdata['imag_label'])?>
                         </p>
                         </div>
                            <?php } ?>
                        
                           <?php if($res_imgdata['URL']!=''){ ?>
                        <div>
                        <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"/>
                        <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
						<?=stripslashes($res_imgdata['imag_label'])?>
                        </p>
                        </div>
                            <?php } ?>
                        
                        <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                   	 <div>
                        <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
						<p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
						<?=stripslashes($res_imgdata['imag_label'])?>
                        </p>
                        </div>
                            <?php } ?>
                        
                        
                            <?php 
                                } // image for loop end 
                            } // image num_rows condition end ?>
    
  					</section> 
                   
                    
                    
                  </div>	
  		

             
             <?php  
					   } // column for loop end
					}// column num_rows condition end
					   
			 

			 } // section 1st condition end ?><?php */?>

    	<!---------------------------------------------------section 1st condition end--------------------------------------------->
        
        
        
        <!---------------------------------------------------section 2nd condition start--------------------------------------------->
        
       <?php 
	    if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='770x394')
		 {
	   ?>
       		<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>
                  
                  
                  <div class="details-grid">
                                <div class="details-shade">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <?php $i_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>  
                                  <li data-target="#carousel-example-generic" data-slide-to="<?=$i_slide?>" <?php if($i_slide=='0'){ ?> class="active" <?php } ?> ></li>                                  
                                  <?php $i_slide++; } ?>
                                </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                             <?php $j_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?> 
                              
                             <?php if($res_imgdata['sku']!=''){ ?>
                              <div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
                                  <a href="#">
                                  <img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" /> 
                                  </a></div>
                             <?php } ?>
                              
                              <?php if($res_imgdata['URL']!=''){ ?>
                              <div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
                                  <a href="#">
                                  <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> </a>
                              </div>
                             <?php } ?>
                                
                             <?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?> 
                             <div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
                                  <a href="#">
                                  <img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
                                  </a>
                            </div>                                
                            <?php } ?> 
                             <?php $j_slide++; } ?>
                            </div> <!-- Wrapper for slides -->
                            </div>
                            </div>
			</div>
           <!--------slider start end ----->    
       
       
       <?php 
	   		 			} // column for loop end
				}// column num_rows condition end
	   }  // section 2nd condition end ?> 
        <!---------------------------------------------------section 2nd condition end----------------------------------------------->
        
        
        <!---------------------------------------------------section 3rd condition start--------------------------------------------->
        
				<?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='350x72')
                      { ?>
                      <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>
                      
                      
                      
                      
                      <div style="margin-top:1px;">
                         <div id="jssor_4" style="position:relative;margin:0 auto;top:0px;left:0px;width:1024px;height:80px;overflow:hidden;visibility:hidden;">
                         <!-- Loading Screen -->
                         <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:<?=$res_clmn['bg_color']?>;">
                             <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                             <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                         </div>
                         <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1024px;height: 80px;overflow:hidden;">
                          <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>                             
                             <div>
                                 
                                 <?php if($res_imgdata['sku']!=''){ ?>
                                 <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
                                 <?php } ?>
                                 
                                 <?php if($res_imgdata['URL']!=''){ ?>
                                 <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
                                 <?php } ?>
                                 <?php if($res_imgdata['URL']=='' && $res_imgdata['URL']=='' ) { ?>
                                 <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
                                 <?php } ?>
                             </div>
                          <?php } ?>   
                             
                             <!--<a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>-->
                              <a data-u="any" href="#" style="display:none">js slider</a>
                         </div>
                         <!-- Bullet Navigator -->
                         <?php if($image_count>1){ ?>
                         <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                             <!-- bullet navigator item prototype -->
                             <div data-u="prototype" style="width:16px;height:16px;"></div>
                         </div>
                         <?php } ?>
                         <!-- Arrow Navigator -->
                         <?php if($image_count>1){ ?>
                         <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
                         <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
                         <?php } ?>
                     </div>
                     <script type="text/javascript">jssor_4_slider_init();</script>
                        </div>
                        
                      <?php 
	   		 			} // column for loop end
				}// column num_rows condition end
	   }  // section 3rd condition end ?> 
                             	 
        <!---------------------------------------------------section 3rd condition end----------------------------------------------->
        
        
        <!---------------------------------------------------section 4th condition start----------------------------------------------->
        <?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='3' && $res_secdata['image_size']=='119x84')
                     { 
                   ?>                   
                    <div class="container-fluid">
         			<div class="row">
                   <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   $jsor=1; 
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                          
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>
                   <div class="col-xs-4 col-sm-4 col-md-4 " >
                    <div id="jssor_<?=$jsor?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:110px;height:84px;overflow:hidden;visibility:hidden;">                     <!-- Loading Screen -->
                                <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:<?=$res_clmn['bg_color'];?>">
                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                    <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                </div>
                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:100px;height:80px;overflow:hidden;">
                  
                  <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
                 
                                    <div>
                                        <?php if($res_imgdata['sku']!=''){ ?>
                                        <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
                                        <?php } ?>
                                        
                                        <?php if($res_imgdata['URL']!=''){ ?>
                                        <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
                                        <?php } ?>
                                        <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>                                        
                                         <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
                                       <?php } ?>
                                         
                                    </div>   
                   			<!--<div class="clearfix"></div> --> 
                   <?php } ?>
                   
                    </div>
                                <!-- Bullet Navigator -->
                                <?php if($image_count>1){ ?>
                                <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                                    <!-- bullet navigator item prototype -->
                                    <div data-u="prototype" style="width:16px;height:16px;"></div>
                                </div>
                                <?php } ?>
                                <!-- Arrow Navigator -->
                                <?php if($image_count>1){ ?>
                                <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                <?php } ?>
                            </div>
                            <script type="text/javascript">jssor_<?=$jsor?>_slider_init();</script>
                                  
                   </div>
         <?php 
	   		 		$jsor++;	} // column for loop end
				}// column num_rows condition end
		?>
        </div>
                </div>
                 <div class="clearfix"></div>		
	 <?php  } // section 4th condition end ?>       
        		
        <!---------------------------------------------------section 4th condition end------------------------------------------------->
        
         <!---------------------------------------------------section 5th condition start------------------------------------------------->
         
        <?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='770x394')
               {   ?>
               
         <div id="jssor_9" style="position:relative;margin:0 auto;top:1px;left:0px;width:1024px;height:500px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 5px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1024px;height: 500px;overflow:hidden;"> 
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
                            
							<?php if($res_imgdata['sku']!=''){ ?>
                            <div>
                                <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
                            </div>
                            <?php } ?>
                            
                            <?php if($res_imgdata['URL']!=''){ ?>
                             <div>
                                <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
                            </div>
                            <?php } ?>
                            
                             <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>                             	
                               <div>
                                <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
                            </div>                              
                             <?php } ?>
         
         				<?php  } // image for loop end ?>
          <?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		?>
        
        
        <!-- <a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>-->
            <a data-u="any" href="#" style="display:none">js slider</a>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
    </div>
    <script type="text/javascript">jssor_9_slider_init();</script>
        		
	  <?php  }  // section 5th condition end ?> 
         
         
          <!---------------------------------------------------section 5th condition end------------------------------------------------->
          
          
          <!---------------------------------------------------section 6th condition start------------------------------------------------->
          	<?php if($res_secdata['sec_type']=='Video'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' )
               {   ?>
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
               	 <!-----------video------------->
      <div class="left-sidebar"> <h2><?=$res_secdata['sec_lbl']?></h2></div>
            
<iframe style="padding:4px; margin-top:4px;" width="100%" height="200" src="<?=$res_imgdata['URL']?>" frameborder="0" allowfullscreen></iframe>
             <!------------video--------------->	
               			
               
               <?php  } // image for loop end ?>
          <?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		?>
          
 				         
          <?php } // section 6th end ?>
           <!---------------------------------------------------section 6th condition end------------------------------------------------->
           
           
            <!---------------------------------------------------section 7th condition start------------------------------------------------->
            
            	<?php if($res_secdata['sec_type']=='Product'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
               
                <div class="left-sidebar"><h2><?=$res_secdata['sec_lbl']?></h2></div>
 <div class="slider autoplay" style="width:100%; margin:auto;">
					
                    
                    <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
                       	
						$prod_skuarr=unserialize($res_imgdata['sku']);
						$prod_skuarr_modf=array();
						foreach($prod_skuarr as $skuky=>$skuval)
						{$prod_skuarr_modf[]="'".$skuval."'";}
						
						 $prod_skustr=implode(',',$prod_skuarr_modf);
						
						
						$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
						if($query_prod->num_rows()>0)
						{
							foreach($query_prod->result_array() as $rw)
							{
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rw['special_pric_from_dt'];
								$special_price_to_dt = $rw['special_pric_to_dt'];								
								$dsply_img = $rw['catelog_img_url'];														
								//$quantity=$rw->quantity;
						?>
                           
                    
                    
                    	<div class="multiple" style="border:1px solid #ccc;">
                   
                   			<?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                 ?>                               
                                <div class="price"> <i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw['special_price'])?> </div>
                                <?php }} ?>
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <div class="price"> <i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw['price'])?> </div>
                                <?php } ?>
                                
                                <div class="view view-fifth">    
                                  <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
                                  <img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"   class="wow flipInY grow"  alt="<?=$rw['name']?>">
                                  
                                  </a>
                                  </div>
                                
                                   <div class="wish-list"> 
                                   <a class="link-wishlist wish_spn" onClick="" href="#"  data-toggle="tooltip" title="Add To Wishlist"  ><i class="fa fa-heart"></i></a>
                                   </div>
                                
                                    <div class="best-slr-data">
                                   <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="wallet"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a> 
                                        <!-- price calculation div start here --><br>
                                        <div class="price-box">
                                        <?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                		 ?>                               
                                		<span class="regular-price" style="color:#CCC; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['mrp'];?> </span><br>
                                
                                        <span class="regular-price" style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['price'];?> </span><br>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $rw['special_price']==0){?>
                                        <span class="regular-price" style="color:#CCC; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $rw['special_price']==0){?>
                                         <span class="regular-price" > <i class="fa fa-inr" aria-hidden="true"></i> <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                        
                                        </div>
                                        <!-- price calculation div end here --></div>	
                   
                   		</div><!----jhfkjfdk-->
                    
                    
                    <?php			} // product data loop end
									} // product num_rows() condition end ?>
               		
               		
               			<?php  } // image for loop end ?>
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?>
                    
</div>
					  
                
                
                
                
                
               <?php } // 7th section condition end ?>
            
             <!---------------------------------------------------section 7th condition end------------------------------------------------->
             
             <!---------------------------------------------------section 8th condition start------------------------------------------------->
        
         <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='600x259')
               {   ?>
               <div class="clearfix"></div>  
               <div style="background:#fff; height:80px; padding-top:4px;">
               
               	<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   $clmn_div=1;
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?>  
               
                 <!---------two banner------------->           
           
           <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
                            
							<?php if($res_imgdata['sku']!=''){ ?>  
                                 <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"
                                 <?php if($clmn_div==1){ ?>  style="float:left; width:50%; margin-right:1px;"<?php }else{ ?> style="float:left; width:49.6%;" <?php }?> onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'">          
								 <?php } ?>
                            
                            <?php if($res_imgdata['URL']!=''){ ?>                                                     
                                <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  <?php if($clmn_div==1){ ?>  style="float:right; width:49.6%; margin-right:1px;"<?php }else{ ?> style="float:left; width:49.6%;" <?php }?>>                            
                            <?php } ?>
                            
                             <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>                                
                                 <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  <?php if($clmn_div==1){ ?>  style="float:right; width:50%;"<?php }else{ ?> style="float:right; width:49.6%;" <?php }?>>
                             <?php } ?>
         
         				<?php  } // image for loop end ?>
           
            <!---------two banner-------------->
            
            	
          	<?php 
	   		 		$clmn_div++;	} // column for loop end
				}// column num_rows condition end
		    ?> 
                </div>
        <?php } // section 8 condition end ?>
        
        
        	<!---------------------------------------------------section 8th condition end------------------------------------------------>
            
            
            
            <!---------------------------------------------------feature box section 9th condition start------------------------------------------------>
            	 <?php if($res_secdata['sec_type']=='Featured Box'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='140x142')
               {   ?>
               	<div class="single-product">
           
           <div class="single-product1">
           <span class="fash_left"><h4><?=$res_secdata['sec_lbl']?></h4></span><!--<span class="fash_right" ><a href="#"><!--View More</a></span>-->
                		<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						   
						?>            
          
           <?php 
		   foreach($qr_imginfo->result_array() as $res_imgdata){ 
		   
		   $img_link="#";
		    if($res_imgdata['URL']!=''){
				$img_link=$res_imgdata['URL']; 
			}
			if($res_imgdata['sku']!='')
			{$img_link=base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ;}
		   ?>           
           <div class="inn-single">
         
           
            <div  class="pro-1"><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $img_link; ?>'"  /></div> 
           </div>
           <?php   } // image for loop end ?>
            	<div style="clear:both"></div>
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
                 
           </div>
           
            </div>
        <?php } // section 9 condition end ?>
            
            <!---------------------------------------------------feature box section 9th condition end------------------------------------------------>
            
            <!---------------------------------------------------Prodcts Vertical section 10th condition start----------------------------->
            <?php if($res_secdata['sec_type']=='Prodcts Vertical section'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
         <div class="fandt">	
		<div class=" features">
			<?php /*?><h3><?=$res_secdata['sec_lbl']?> <a href="#" class="btn btn-primary right"> More</a></h3><?php */?>
               <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];                            
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();					   
						?>
                        
                   <?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
				   ?>
                   <div class="pad-res">
				   <h3><?=$res_secdata['sec_lbl']?><a href="<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>" class="btn btn-primary right"> More</a>
  </h3>
		</div>		   	<?php 	$prod_skuarr=unserialize($res_imgdata['sku']);
						$prod_skuarr_modf=array();
						foreach($prod_skuarr as $skuky=>$skuval)
						{$prod_skuarr_modf[]="'".$skuval."'";}
						
						 $prod_skustr=implode(',',$prod_skuarr_modf);
						
						
						$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid LIMIT 3 ");
						if($query_prod->num_rows()>0)
						{
							foreach($query_prod->result_array() as $rw)
							{
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rw['special_pric_from_dt'];
								$special_price_to_dt = $rw['special_pric_to_dt'];								
								$dsply_img = $rw['catelog_img_url'];
				   
				   ?>                         
                                
                   <div class="support">
                   <div class="pad-res">
                    <div class="today-deal-left">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                    <img src="<?php echo base_url().'images/product_img/'.$dsply_img;?>" />
                    </a>
                    </div>
                  <div class="today-deal-right">
                  		<h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href='<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>'"><?=$rw['name']?></h4>
                        <p style="margin-left:0px;">
                        <?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;  font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $rw['special_price']==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $rw['special_price']==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                        
                        </p>
				  </div>
                  <div style="clear:both;"></div>
                    </div>
                    <?php }} ?>
                    <div class="clearfix"></div>
                </div>
               
               
               
                <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
        </div>
		
		<div class="clearfix"></div>
	</div> 
           
        <?php } // section 10th condition end ?>
            
            <!---------------------------------------------------Prodcts Vertical section 10th condition end------------------------------------------------>
            
             <!---------------------------------------------------feature box section 11th condition start------------------------------------------------>
            <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='3' && $res_secdata['image_size']=='245x168')
               {?>
               <div class="left-sidebar"><h2><?=$res_secdata['sec_lbl']?> </h2></div>
				<div style="height:85px; background:#fff;">
               	<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   $clmn_div=1;
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?> 
           
           <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
           
           
           <?php if($res_imgdata['sku']!=''){ ?> 
                                <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="margin-right:2px; padding:2px; border:1px solid #BBB; width:32.7%; float:left" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'">
            <?php } ?>
           
           <?php if($res_imgdata['URL']!=''){ ?> 
                                <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="margin-right:2px; padding:2px; border:1px solid #BBB; width:32.7%; float:left">
            <?php } ?>
            
            <?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?>  
                                <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="margin-right:2px; padding:2px; border:1px solid #BBB; width:32.7%; float:left">
            <?php } ?>
               
            <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
       </div>
        <?php } // section 11th condition end ?> 
            
        <!---------------------------------------------------feature box section 11th condition end------------------------------------------------>  
        
        
        <!---------------------------------------------------feature box section 12th condition start------------------------------------------------>
        	 <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && ($res_secdata['image_size']=='1000x244' || $res_secdata['image_size']=='600x259') )
               {?><div>
               	<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   $clmn_div=1;
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00'))  ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?> 
           
           <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
               
              
                <?php if($res_imgdata['sku']!=''){ ?>                                
                  <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'">
            	<?php } ?>
           
           <?php if($res_imgdata['URL']!=''){ ?> 
           <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;">
            <?php } ?>
            
            <?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?>  
             <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;">
            <?php } ?>
               
               
               <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
       </div>
           
        <?php } // section 12th condition end ?> 
        <!---------------------------------------------------feature box section 12th condition end-------------------------------------------------->
        
        
         <!---------------------------------------------------feature box section 13th condition start------------------------------------------------>
        	 <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='350x35'  )
               {?><div class="thin">
               	<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   $clmn_div=1;
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00'))  ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?> 
           
           <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
               
              
                <?php if($res_imgdata['sku']!=''){ ?>                                
                  <a href="#"><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" >
                  </a>
            	<?php } ?>
           
           <?php if($res_imgdata['URL']!=''){ ?> 
           <a href="#"><img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;"></a>
            <?php } ?>
            
            <?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?>  
             <a href="#"><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="width: 100%;margin: 1px 0px;"></a>
            <?php } ?>
               
               
               <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
       </div>
           
        <?php } // section 12th condition end ?> 
        <!---------------------------------------------------feature box section 13th condition end-------------------------------------------------->
       
        <!---------------------------------------------------New Arrival section 14th condition start----------------------------->
          <?php if($res_secdata['sec_type']=='New Arrivals'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
               
         <div class="fandt">	
		<div class=" features">
        <div class="pad-res">
			<h3><?=$res_secdata['sec_lbl']?> <!--<a href="#" class="btn btn-primary right"> More</a>--></h3>
            </div>
               <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];                            
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();					   
						?>
                        
                   <?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
				   
						
						$query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY name ORDER BY `prod_search_sqlid` DESC LIMIT 10  ");
						if($query_prod->num_rows()>0)
						{
							foreach($query_prod->result_array() as $rw)
							{
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rw['special_pric_from_dt'];
								$special_price_to_dt = $rw['special_pric_to_dt'];								
								$dsply_img = $rw['catelog_img_url'];
				   
				   ?>                         
                                
                   <div class="support">                   
                    	<div class="pad-res">
                    <div class="new-arrival-left">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                        <img  src="<?php echo base_url().'images/product_img/'.$dsply_img;?>" >
                        </a>
                    </div>
                    
                   
                    <div class="new-arrival-right">
                    
                        <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href='<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>'"><?=$rw['name']?></h4>
                        <p style="padding:0px; width:auto!important;">
                        <?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $rw['special_price']==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $rw['special_price']==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107!important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                        
                        </p>
                    </div>
                    </div>
                    <?php }} ?>
                    <div class="clearfix"></div>
                </div>
               
               
               
                <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
        </div>
		
		<div class="clearfix"></div>
	</div> 
           
        <?php } // section 10th condition end ?>
            
            <!---------------------------------------------------New Arrival section 14th condition end------------------------------------------------>
            
        
        
        <!---------------------------------------------------Trending Products 15th condition start----------------------------->
          <?php if($res_secdata['sec_type']=='Trending Products'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
               <hr>
         <div class="fandt">	
		<div class=" features">
			<h3><?=$res_secdata['sec_lbl']?> <!--<a href="#" class="btn btn-primary right"> More</a>--></h3>
               <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];                            
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();					   
						?>
                        
                   <?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
				   
						
						/*$query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY lvl2 ORDER BY `prod_search_sqlid` DESC LIMIT 10  ");*/
						
						 $pord_viewqr=$this->db->query("SELECT sku FROM product_viewcount GROUP BY sku ORDER BY prodview_count desc LIMIT 5");
						 $pordviewctr=array();
						 
						 foreach($pord_viewqr->result_array() as $res_prodview)
						 {$pordviewctr[]="'".$res_prodview['sku']."'";}
						 $pordviewctr_string=implode(',',$pordviewctr);
						 
						 if($pord_viewqr->num_rows()>0)
						{ $query_prod = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND sku IN ($pordviewctr_string) GROUP BY sku   ");
						}else
						{
						
						 $query_prod = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY sku ORDER BY cronprod_viewcount desc LIMIT 5  ");
						 
						}
						
						
						if($query_prod->num_rows()>0)
						{
							foreach($query_prod->result_array() as $rw)
							{
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rw['special_pric_from_dt'];
								$special_price_to_dt = $rw['special_pric_to_dt'];								
								$dsply_img = $rw['catelog_img_url'];
				   
				   ?>                         
                                
                   <div class="support">
                    <div class="today-deal-left">
                    <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                        <img src="<?php echo base_url().'images/product_img/'.$dsply_img;?>"  >
                     </a>
                    </div>
                    <div class="today-deal-right">
                    
                        <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href='<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>'"><?=$rw['name']?></h4>
                        <p style="padding:10px;">
                        <?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $rw['special_price']==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $rw['special_price']==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                        
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
               
               <?php }} ?>
               
                <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
        </div>
		
		<div class="clearfix"></div>
	</div> 
           
        <?php } // section 15th condition end ?>
            
            <!---------------------------------------------------Trending Products section 15th condition end--------------------------------->
            
            
             <!---------------------------------------------------Recently viewed Items section 14th condition start----------------------------->
             
          <?php 
		  $prod_skustr=get_cookie('prodid', TRUE); 
		  if($prod_skustr!=''){
		  if($res_secdata['sec_type']=='Recently Viewed Items'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
               <hr>
         <div class="fandt">	
		<div class=" features">
			<h3><?=$res_secdata['sec_lbl']?> <!--<a href="#" class="btn btn-primary right"> More</a>--></h3>
               <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {  
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];                            
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();					   
						?>
                        
                   <?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
						 
						$modf_prod_skustr=implode(',',array_unique(explode(',', $prod_skustr)));
						$query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND product_id IN ($modf_prod_skustr) GROUP BY product_id LIMIT 5  ");
						if($query_prod->num_rows()>0)
						{
							foreach($query_prod->result_array() as $rw)
							{
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rw['special_pric_from_dt'];
								$special_price_to_dt = $rw['special_pric_to_dt'];								
								$dsply_img = $rw['catelog_img_url'];
				   
				   ?>                         
                                
                   <div class="support">
                    <div class="today-deal-left">
                      <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">  
                        <img src="<?php echo base_url().'images/product_img/'.$dsply_img;?>" >
                        </a>
                    </div>
                    <div class="today-deal-right">
                    
                        <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href='<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>'"><?=$rw['name']?></h4>
                        <p style="padding:10px;">
                        <?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $rw['special_price']==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $rw['special_price']==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                        
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
               
               <?php }} ?>
               
                <?php   } // image for loop end ?>
            	
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?> 
        </div>
		
		<div class="clearfix"></div>
	</div> 
           
        <?php } // section 16th condition end 
		
		} //cookie condition check end
		?>
            
            <!---------------------------------------------------Recently viewed Items section 16th condition end------------------------------------->
            
       		
         

<?php } // main foreach end 

} // section  num_rows condition end
?>  
  
    <!-- #endregion Jssor Slider End -->   

 
 <div class="clearfix"></div>
 
 <style>.carousel-control {
  padding-top:6%;
  width:5%;
}
.thumbnail {
    display: inline-block!important;
    padding: 4px;
    margin-bottom: 4px;
    line-height:1;
    background-color: #ceccaa!important;
    border: none;
    border-radius: 4px;
    -webkit-transition: border .2s ease-in-out;
    -o-transition: border .2s ease-in-out;
    transition: border .2s ease-in-out;
    float: left;
    width: 25%!important;
	    color: #000 !important;
    font-weight: normal;
	font-size:12px;
	text-align:center;
}
.carousel-control.right {
    background-image: none!important;
}
.carousel-control.left {
    background-image: none!important;
}
.well {
    padding: 0px!important;
    margin-bottom:0px!important;
	background-color: #ceccaa!important;
}
</style>
<script>
$(document).ready(function() {
    $('#myCarousel').carousel({
	interval: 10000
	})
    
    $('#myCarousel').on('slid.bs.carousel', function() {
    	//alert("slid");
	});
    
    
});

</script>
 
 
 
 
 
  <!------------------------------footer start-------------------------------->
        
<footer class="site-footer">
<div class="container-fluid">
<?php 
 $qr=$this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Status='active' AND sec_type='Rich Text Editor' ");
		 
if($qr->num_rows()>0)
{ 
	foreach($qr->result_array() as $res_secdata)
	{		  
?>
    
<strong><b><?=$res_secdata['sec_lbl']?> :</b></strong>
</br>
<p style="text-align:justify;"><?=$res_secdata['sec_descrp']?></p>

<?php }} ?>
</div>        
     <div class="clearfix"> </div>
     <br>
        <!-----------section 30  start------------>
        <?php //require_once('footer_link.php'); ?>  
        <!-----------section 30  end------------------>
      
      
    <!--</footer>-->
        <!---------------------------------------footer end--------------------------------->
 
 
    
<!--</div>--> <!--div wrap end--> 
  

<!--div wrap end-->
<?php require_once('footer.php'); ?>
