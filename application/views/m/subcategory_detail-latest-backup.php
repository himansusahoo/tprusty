<?php include 'header.php';?>

<!-------------------------------------category extra header code start-------------------------->
			
<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.tinycarousel.js"></script>

<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
<!--<script src="<?php //echo base_url()?>mobile_css_js/new/js/jquery-1.11.1.min.js"></script>-->
<script src="<?php echo base_url()?>mobile_css_js/new/js/js/jquery.tinycarousel.js"></script>

<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
</script>

<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider01').tinycarousel();
		});
</script>

<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider4').tinycarousel({ interval: true });
			$('#slider2').tinycarousel();
			$('#slider3').tinycarousel({ interval: true });
		});
		
</script>

<style>
  button.first-accordion {
    background-color: #f5f5f5;
    color: #444;
    cursor: pointer;
    padding: 7px 10px;
    width: 100%;
    border: 1px solid #ddd;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    border-radius: 3px;
    margin-bottom: 5px;
}

button.first-accordion.active, button.first-accordion:hover {
    background-color: #f5f5;
}

button.first-accordion:after {
    content: '\02C7';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: 1px solid #afadad;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
	
}

button.first-accordion.active:after {
    content: "\02C6";
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: 1px solid #afadad;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
}

div.panel {
    /*padding: 0 15px*/;
    background-color: white;
    max-height: 0;
    transition: max-height 0.2s ease-out;
	margin-bottom: 0!important;
	width: 100%;
	overflow-y: scroll;
}
div.panel ul li {
    list-style: none; 
}
.catagory-banner {
    float: left;
    width: 50%;
/*    border-right: 1px solid #B9B9B9;
*/    /* height: 160px; */
    padding:10px;
/*   border-bottom: 1px solid #B9B9B9;
*/}
.catagory-banner img {
    width: 95%;
	float:left;
	margin-right: 15px;
}
.category-products .panel {
    max-height: 2000px!important;
}
.brands-name {
    border: 1px solid #F7F7F0;
     padding-bottom: 0px;
    padding-top: 0px;
    width: 48%;
    float: left;
    margin-left: 6;
    margin-right: 6px;
    margin-bottom: 6px;
}
  </style>        
    
    

     

<!-------------------------------------category extra header code end----------------------------->
       <div class="wrap">
       <div class="container">
			<div class="row">
				<div class="">
					<div class="left-sidebar">
						<h2>Category</h2>
                        
						<div class="panel-group category-products" id="accordian">
							<div class="panel panel-default">
								<div class="panel-heading">
                                	
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>
											Category
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body"><ul>
                                       <?php  foreach($product_image->result() as $rw ) {  //$image_arr=explode(',',$rw->catelog_img_url); 
												$dsply_img = $rw->imag;
													 $catgIdmenu=$rw->category_id;
													$qr_dispurl=$this->db->query("SELECT distinct url_displayname,label_name FROM category_menu_mobile WHERE (category_id='$catgIdmenu' OR category_id LIKE '$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu' ) ");
													
									echo $url_disp=$qr_dispurl->row()->url_displayname;
									
									echo $catgIdmenu;
								?>
                                
                                <li>
                                            <div class="brands_products">
                                              <div class="brands-name" >
                                           <a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rw->category_name)))))  ?>">
                                              <?php if(empty($dsply_img)){?>
                							<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" >
                							<?php }else{?>
                                            <img src="<?php echo base_url();?>images/product_img/<?=$rw->imag;?>" >                                          
                                              
                                            <?php } ?>
                                           </a>   
                                              <a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rw->category_name)))))  ?>"><?=$rw->category_name;?></a></div>
                                            </div>
                                   </li>	 									
                                   
                                    <?php } ?> </ul>
                                   <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
               
            </div>
            
        </div>
        
    </div>
<?php if($sec_info->num_rows()>0)
	{ 
		$cur_dtm=date('y-m-d h:i:s');
		foreach($sec_info->result_array() as $res_secdata)
		{		 
?>
            
            <!---------------------------------------------------section 1st condition start--------------------------------------------->
				<?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='53x52')
                   {?>
				<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                   $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
                <div id="slider1">
                <a class="buttons prev" href="#">&#60;</a>
                <div class="viewport">
                    <ul class="overview">
                    <?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){
                        ?>
                         <?php if($res_imgdata['sku']!=''){ ?>
                    	<li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"/></li>
                        <?php } ?>
                        <?php if($res_imgdata['URL']!=''){ ?>
                        <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"/></li>
                            <?php } ?>
                            <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                        <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" /></li>
                            <?php } ?>
                        <?php } } ?>
                    </ul>
                </div>
                <a class="buttons next" href="#">&#62;</a>
				</div>
    			<?php } } }?>
                
                <!---------------------------------------------------section 1st condition end--------------------------------------------->
                
                <!---------------------------------------------------section 2nd condition start--------------------------------------------->
                <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='600x259')
               {?> 
               <?php 
                   $sec_id=$res_secdata['Sec_id'];
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
						?>
                         <div class="left-sidebar"><h2>Category</h2></div>
                         <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
                        
                         	<?php if($res_imgdata['sku']!=''){ ?>  
                                 <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"">
							<?php }?>
                            
                            <?php if($res_imgdata['URL']!=''){ ?>                                                     
                                <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"><?php }?>                            
                             <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>                                
                                 <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"><?php } ?>
                             
                            <?php } ?>
       
			<?php } } }?>
            
            	<!---------------------------------------------------section 2nd condition end--------------------------------------------->
            
              	<!---------------------------------------------------section 3rd condition start--------------------------------------------->
                <?php if($res_secdata['sec_type']=='Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='370x48')
               {?> 
               <?php 
                   $sec_id=$res_secdata['Sec_id'];
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                 <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" style="padding:3px; border:1px solid #BBB; width:100%">
							<?php }?>
                            
                            <?php if($res_imgdata['URL']!=''){ ?>                                                     
                                <img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  style="padding:3px; border:1px solid #BBB; width:100%"><?php }?>                            
                             <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>                                
								<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  style="padding:3px; border:1px solid #BBB; width:100%"><?php } ?>
                            <?php } ?>
       
			<?php } } }?>
            
            <!---------------------------------------------------section 3rd condition end--------------------------------------------->
          
            <!---------------------------------------------------section 4th condition start--------------------------------------------->
           <?php if($res_secdata['sec_type']=='Featured Box'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='200x83')
                   {?>
                    <div class="top-brands">
                  <div class="container">
                    
                			
					<h3>shop by Brands</h3>
                    
				<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                   $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
				   
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
                 	
                    <ul id="flexiselDemo11">
                     <li>
                    <?php foreach($qr_imginfo->result_array() as $res_imgdata){
							$img_link="#";
							if($res_imgdata['URL']!=''){
								$img_link=$res_imgdata['URL']; 
							}
                        ?>   
                                             
                       <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" class="img-responsive" onClick="window.location.href='<?php echo $img_link; ?>'"/>                        
                   
                
               <?php } }?>
               </li>
    			
                 </ul>
                
				 <?php } ?> 
				 </div></div>
				 <?php }?>
            
             <!---------------------------------------------------section 4th condition end--------------------------------------------->
             
             <!---------------------------------------------------section 5th condition start--------------------------------------------->
				<?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='106x161')
                   {?><div style="background:#e2dddd;">  
                <div id="slider01">
                <a class="buttons prev" href="#">&#60;</a>
                <div class="viewport">
                    <ul class="overview">
				<?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                   $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
                
                    <?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){
                        ?>
                         <?php if($res_imgdata['sku']!=''){ ?>
                    	<li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"/></li>
                        <?php } ?>
                        <?php if($res_imgdata['URL']!=''){ ?>
                        <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"/></li>
                            <?php } ?>
                            <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                        <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" /></li>
                            <?php } ?>
                        <?php } } ?>
                   
               
    			<?php } } ?>
                
                 </ul>
                </div>
                <a class="buttons next" href="#">&#62;</a>
				</div></div>
                <?php }?>
                	<!---------------------------------------------------section 5th condition end------------------------------------------------->
                
                     <!---------------------------------------------------section 6th condition start------------------------------------------------->
         
        <?php if($res_secdata['sec_type']=='Slider' && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='770x394')
               {   ?>
               
         <div id="jssor_10" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;    width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height: 300px;overflow:hidden;"> 
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
    <script type="text/javascript">jssor_10_slider_init();</script>
        		
	  <?php   } ?> 
        
        <!---------------------------------------------------section 6th condition end------------------------------------------------->
        
        <!---------------------------------------------------section 7th condition start------------------------------------------------->
        <?php if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='1000x244')
               {   ?>
               
         <div id="jssor_12" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('<?php echo base_url()?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height: 300px;overflow:hidden;"> 
              <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
        
        
        
        <!-- <a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
            <a data-u="any" href="#" style="display:none">js slider</a>-->
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
    <script type="text/javascript">jssor_12_slider_init();</script>
        		
	  <?php  } ?>
         
           <!---------------------------------------------------section 7th condition end------------------------------------------------->
           
           <!---------------------------------------------------section 8th condition start------------------------------------------------->
           
           <?php if($res_secdata['sec_type']=='Product'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
               {   ?>
       <div class="container">			
            <div class="trending-ads">
			<div class="container">
				<!-- slider -->
				<div class="trend-ads">
				<ul id="flexiselDemo3">
				<?php 
                   $sec_id=$res_secdata['Sec_id'];
                  $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
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
				
                <li>
				<div class="col-md-3 biseller-column">
                    <a href="single.html">
                        <img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"/>
                        
                        <span class="price1 left">5% off</span>
                       <span class="price right"><span ><?php echo $rw['special_price'] ?></span><?php echo $rw['price'] ?></span>
                    </a> 
                    <div class="ad-info">
                        <h5><?php echo $rw['name'] ?></h5>
                        <span>Add to Cart</span>
                    </div>
                </div>
				</li>
               
             <?php			} // product data loop end
									} // product num_rows() condition end ?>
               		
               		
               			<?php  } // image for loop end ?>
          	<?php 
	   		 			} // column for loop end
				}// column num_rows condition end
		    ?>
				</ul>
					
					</div>
			    <!-- //slider -->				
			</div>	
		  </div>
        </div>
    
    <?php }?>
           
           <!---------------------------------------------------section 8th condition end------------------------------------------------->
           
           <!---------------------------------------------------section 9th condition start------------------------------------------------->
           
           <?php if($res_secdata['sec_type']=='Grouped Banner'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='600x259')
                   {?>
                   <?php 
                   $sec_id=$res_secdata['Sec_id'];                 
                   $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
                   if($qr_clmn->num_rows()>0)
                   {   
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                         $image_count=$qr_imginfo->num_rows();
                  ?>
            <div class="container">
			<!--<h3>Banner</h3>-->
            <button class="first-accordion"><?=$res_secdata['sec_lbl']?></button>
            <div class="panel" style="height:200px;">
                 <ul>
                 <?php if($qr_imginfo->num_rows()>0) 
                            { foreach($qr_imginfo->result_array() as $res_imgdata){
                        ?>
                    <li>
                        <div class="brands_products">
                            <div class="brands-name">
                                <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>">
                            </div>
                        </div>
                    </li>
                    <?php } }?>
                 </ul>
            </div>
            <?php } } ?>
            </div>
           <?php }?>
           <!---------------------------------------------------section 9th condition end-------------------------------------------------> 
               
		<?php } } ?>
            
	</div>
    
    

 <?php include "footer.php"; ?>
 
 <!----------------------------------------------category extra footer code start-------------------------------->
	<script type="text/javascript" src="<?php echo base_url()?>mobile_css_js/new/js/jquery.flexisel.js"></script>

<script>
   var acc = document.getElementsByClassName("first-accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
</script>


<script type="text/javascript">
						 $(window).load(function() {
							$("#flexiselDemo3").flexisel({
								visibleItems:1,
								animationSpeed: 1000,
								autoPlay: true,
								autoPlaySpeed: 5000,    		
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: { 
									portrait: { 
										changePoint:480,
										visibleItems:1
									}, 
									landscape: { 
										changePoint:640,
										visibleItems:1
									},
									tablet: { 
										changePoint:768,
										visibleItems:1
									}
								}
							});
							
						});
</script>


<!----------------------------------------------category extra footer code end----------------------------------->    
    