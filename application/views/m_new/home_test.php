<!DOCTYPE html>
<html lang="en"><head>
       <meta charset utf="8">
        <title>Welcome to moonboy </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--css-->
            <link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/font-awesome.min.css"> 
			<link href="<?php echo base_url()?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/style.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
       <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>      
      <script src="<?php echo base_url()?>mobile_css_js/new/js/jssor.slider-23.1.6.min.js" type="text/javascript"></script>   
     <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery-1.11.1.min.js"></script>	  
	 <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
	  <!-- <script type="text/javascript" src="<?php //echo base_url()?>mobile_css_js/new/js/dc_carousel_ver.js"></script> -->    
    <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.tinycarousel.js"></script>
    <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>

		<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>

   
    
<script>
function myFunction(x) 
{
    x.classList.toggle("fa-minus");
}
</script>
<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
</script>    
	
<script src="<?php echo base_url()?>mobile_css_js/new/js/bootstrap.min.js"></script>            
<script src="<?php echo base_url()?>mobile_css_js/new/js/bigSlide.js"></script>
            
<script>
	$(document).ready(function() {
	$('.menu-link').bigSlide();
	});
</script>
<script>$(document).ready(function() {
  $('#media').carousel({
	  items : 1,
    pause: true,
    interval: false,
	autoPlay : true,
  });
});</script>
          
 <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>mobile_css_js/new/css/easy-responsive-tabs.css " />
 <script src="<?php echo base_url()?>mobile_css_js/new/js/easyResponsiveTabs.js"></script>
		<!-- requried-jsfiles-for owl -->
		<link href="<?php echo base_url()?>mobile_css_js/new/css/owl.carousel.css" rel="stylesheet">
		<script src="<?php echo base_url()?>mobile_css_js/new/js/owl.carousel.js"></script>
        
			<script>
				$(document).ready(function() {
					$("#owl-demo").owlCarousel({
						items : 3,
						lazyLoad : true,
						autoPlay : true,
						//pagination : true,
					});
				});
			</script> 
    </head>
<body>

<div class="body-back">
        	<div class="masthead pdng-stn1">
		<!-- Header Bar-->
			<div class="menu-notify">
				<div class="profile-left left">
					<h5 class="pro-link"> <a href="index.html"><img src="<?php echo base_url()?>mobile_css_js/new/images/logo.png" width="150" height="55" alt=""  class="img-responsive"> </a></h5>
				</div>
				
				<div class="profile-right">
                <ul>
                <li><i class="fa fa-user"></i> <a href="#" style="vertical-align:top; padding:0px 3px;">Account</a></li>
                <li>  <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> </a> </li>
			   <li>  <a href="#checkout" class="cart">
						 <div class="total"> 
                             <span id="simpleCart_quantity" class="simpleCart_quantity">1</span> </div>
						<i class="fa fa-shopping-cart"></i> </h3>
					</a>
				</li>
                 
                
					</ul>
                  
					
				</div>
                
				<div class="clearfix"></div>
                    
              <div class="menu left"><li style="list-style-type:none"><a href="menu_link.html" ><span >Shop by</span> Category</a></li></a></li>
              </div>
              <div class="right search_big"><form action="#" method="post">
				<input type="search" name="Search" placeholder="Search for a Product..." required="">
				<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
			</form></div>
              <div class="clearfix"></div>  
              
            </div>
        <!-- Header Bar--> 
         <div class="clearfix"></div> 
              
        <!--div wrap start-->
<div class="wrap">
    
<?php 
  
if($sec_info->num_rows()>0)
{
	foreach($sec_info->result_array() as $res_secdata)
	{		  
?>
	<!---------------------------------------------------section 1st condition start--------------------------------------------->	
	
    	<?php if($res_secdata['sec_type']=='Carusel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='53x52')
               {?>
               
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' ORDER BY img_sqlid DESC  ");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
    
              			 <div style="background:<?=$res_clmn['bg_color']?>; ">
                
                   <div id="slider1">
                   <?php if($image_count>4){ ?> <a class="buttons prev" href="#">&#60;</a><?php } ?>
                    <div class="viewport" >
                        <ul class="overview">
                        <?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){                        
                        ?>
                            <?php if($res_imgdata['sku']!=''){ ?>
                        <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" /></li>
                            <?php } ?>
                        
                           <?php if($res_imgdata['URL']!=''){ ?>
                        <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"/></li>
                            <?php } ?>
                        
                        <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                        <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" /></li>
                            <?php } ?>
                        
                            <?php 
                                } // image for loop end 
                            } // image num_rows condition end ?>
                        </ul>
                    </div>
                    <?php if($image_count>4){ ?><a class="buttons next" href="#">&#62;</a><?php } ?>
                  </div>
  		</div>
             
             <?php  
					   } // column for loop end
					}// column num_rows condition end
					   
			 
			 } // section 1st condition end ?>
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
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' ORDER BY img_sqlid DESC  ");
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
                                  <img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
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
        
				<?php if($res_secdata['sec_type']=='Carusel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='350x72')
                      { ?>
                      <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>
                      
                      
                      
                      
                      <div style="margin-top:1px;">
                         <div id="jssor_4" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:80px;overflow:hidden;visibility:hidden;">
                         <!-- Loading Screen -->
                         <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:<?=$res_clmn['bg_color']?>;">
                             <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                             <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                         </div>
                         <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height: 80px;overflow:hidden;">
                          <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>                             
                             <div>
                                 
                                 <?php if($res_imgdata['sku']!=''){ ?>
                                 <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
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
        <?php if($res_secdata['sec_type']=='Carusel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='3' && $res_secdata['image_size']=='119x84')
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
                          
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>
                   <div class="left " >
                    <div id="jssor_<?=$jsor?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:119px;height:84px;overflow:hidden;visibility:hidden;">                     <!-- Loading Screen -->
                                <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:<?=$res_clmn['bg_color'];?>">
                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                    <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                </div>
                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:119px;height:84px;overflow:hidden;">
                  
                  <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
                 
                                    <div>
                                        <?php if($res_imgdata['sku']!=''){ ?>
                                        <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
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
         
        <?php if($res_secdata['sec_type']=='Carusel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='770x394')
               {   ?>
               
         <div id="jssor_9" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:300px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height: 300px;overflow:hidden;"> 
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
                            
							<?php if($res_imgdata['sku']!=''){ ?>
                            <div>
                                <img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
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
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
               	 <!-----------video------------->
      <div class="left-sidebar"> <h2>Real Moonboy Story around the country</h2></div>
            
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
               
                <div class="left-sidebar"><h2>popular products</h2></div>
      
					  <script type="text/javascript">
                        $(document).ready(function()
                        {
                            $('#slider4').tinycarousel({ interval: true });
                            $('#slider2').tinycarousel();
                            $('#slider3').tinycarousel({ interval: true });
                        });
                        
                    </script>
                <div class="offer-panel">
                
                <div class="image group">
                  <div class="grid span_2_of_3" style="margin-top:13px;">
                          <div class="" >
                
                <div id="slider4">
                        <a class="buttons prev" href="#">&#60;</a>
                                  <div class="viewport">
                            <ul class="overview best-selr-prdct">
               	<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
                  ?>  
         
         				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
						$prod_skuarr=unserialize($res_imgdata['URL']);
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
								$special_price_from_dt = $rw->special_pric_from_dt;
								$special_price_to_dt = $rw->special_pric_to_dt;								
								$dsply_img = $rw->catelog_img_url;														
								//$quantity=$rw->quantity;
						?>
                           
                            <li>
                            <div class="view view-fifth">    
                              <a href="#" >
                              <img src="<?php echo base_url()?>mobile_css_js/new/images/headphone1.png"   class="wow flipInY grow"  alt="Vingajoy VT 4900 Wireless Headphone">
                              </a>
                              </div>
                            
                               <div class="wish-list"> 
                               <a class="link-wishlist wish_spn" onClick="" href="#"  data-toggle="tooltip" title="Add To Wishlist"  ><i class="fa fa-heart"></i></a>
                               </div>
                            
                                <div class="best-slr-data">
                               <a href="#" title="wallet">Wireless Headphone...</a> 
                                    <!-- price calculation div start here -->
                                    <div class="price-box">
                                    <span class="regular-price"> Rs. 1699 </span>
                                    <span class="price"> Rs. 989 </span>
                                    </div>
                                    <!-- price calculation div end here --></div>
                            </li>
                            
               			<?php 
										} // product data loop end
									} // product num_rows() condition end ?>
               		
               			<?php  } // image for loop end ?>
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?>
          
               </ul>
                </div>
                 <a class="buttons next" href="#">&#62;</a>	
                </div>
                </div> 
                                
                                
                        </div>
                        <div class="clearfix">&nbsp;</div> 
                      </div>
                
                </div>
               <?php } // 7th section condition end ?>
            
             <!---------------------------------------------------section 7th condition end------------------------------------------------->
        
        
        
        
        
        	

<?php } // main foreach end 

} // section  num_rows condition end
?>  
    
 
 
 <div class="clearfix"></div>
  <!------------------------------footer start-------------------------------->
        
<footer class="site-footer">
<div class="container-fluid">
<strong ><b>Terms & Conditions :</b></strong>

<p class="para">We only accept payment in Indian currency ( INR) for all products purchased.Purchases are subjected to delivery charges as stated in the Cart at time of purchase.</p>
<strong>Shipping & Delivery :</strong>
      <p class="para"> Please allow at least 10-12 business days for your order to arrive after payment has been confirmed. If the product ordered is out of stocks, we will contact you immediately to confirm a new delivery date or other arrangements. Shipping through Reputed Couriers – Fedex/ DHL (Blue Dart)/ &nbsp;Professional/ DTDC / First Flight /Speed Post.</p>
      
        
        <div class="clearfix"> </div>
        <!-----------section 30  start------------>
          <div>
          <ul class="footer-li">
		   <li><a href="#">Cart</a></li>
           <li><a href="#">Your Moonboy.in</a></li>
           <li><a href="#">Your Subscribe & Save Items</a></li>
           <li><a href="#">Yours Orders</a></li>
           <li><a href="#">Amazone Pay</a></li>
           <li><a href="#">Wish List</a></li>
           <li><a href="#">Find a Wish List</a></li>
           <li><a href="#">Your Recently Viewed Items</a></li>
           <li><a href="#">Sell</a></li>
           <li><a href="#">Customer</a></li>
           <li><a href="#">Service Help</a></li>
          </ul>
          </div>
           <!-----------section 30  end------------------>
      
       <div class="clearfix"> </div>
      <div class="copy-right">
          <span class="site-footer-copyright">&copy; 2016, <a href="#">Moonboy</a>. <a target="_blank" rel="nofollow" href="#">Powered by SPIS</a></span>
        </div>
        </div>
    </footer>
        <!---------------------------------------footer end--------------------------------->
 
 
    
</div> <!--div wrap end--> 
</div>
</div>   

<!--div wrap end-->

<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>

<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>

</body>
</html>    