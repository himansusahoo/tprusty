<!-- Slide Menu -->
      <?php $qrs=$this->db->query("select * from mb_category_indexing where parent_id=0 ORDER BY order_by "); ?>
         <a href="#menu" class="menu-link menu-close"> <div class="mask-menu"> <span> <img src="<?php echo base_url().'mobile_css_js/' ?>images/menu-close.png" width="50" height="50" alt=""> </span> </div></a>
        

		<div id="menu" class="nav-panel" role="navigation">
			<div class="wrap-content">

				<div class="profile-menu">
						<div class="pro-menu">
                          
						  <nav class="nav-main">
      <div class="nav-container">   
      	<ul>
			
           <!-- <div class="menu-cont">-->				
 <?php foreach($qrs->result() as $rw ) {?>				
		<li>  <a href="#"><?php echo $rw->category_name; ?> 
<!--1st level-->
<?php $q_arrow=$this->db->query("select * from mb_category_indexing where parent_id='$rw->category_id' "); 
	  	
	  	$ct_arrow=$q_arrow->num_rows();		
	  	if($ct_arrow>0){ ?> <?php } ?> </a>

						
     <ul class="cssmenu">
      <li><a href="#" class="back"> Main Menu</a></li>   
      <?php foreach($q_arrow->result() as $res_arrow) {?>
         <li  class="<?php if($rw->category_name=='Life Style'){ echo "has-sub"; } ?>"><a href="<?php echo base_url().'product_description/product_data/'.preg_replace('#/#',"-",str_replace(' ','-',strtolower($res_arrow->category_name))).'/'.$res_arrow->category_id ?>" > <?php echo	$res_arrow->category_name;?></a>
          <ul>             
      <?php $qr=$this->db->query("select * from mb_category_indexing where parent_id='$res_arrow->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct=$qr->num_rows();
		
	  	if($ct>0 && $rw->category_name=='Life Style' ){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
            	
                 <li>  <a href="<?php echo base_url().'product_description/product_data/'.preg_replace('#/#',"-",str_replace(' ','-',strtolower($rs->category_name))).'/'.$rs->category_id ?>"> <?php echo	$rs->category_name;?> </a> </li>

			
     
			  <!-- level-2-end --> 							
            <?php }} ?> </ul>	</li> <?php } ?>
							
			</ul> 
			</li> 
        
				<?php } ?>  
                
            <!--</div>  -->    
		   </li> 
       </ul> 
</div>
           </nav> 
           <!-- End Nav -->
           
        <!-- Start login details -->
		<div class="user-profile">
        <div class="login-details"> 

             <?php if(@$this->session->userdata('session_data')){ ?>
           <i class="fa fa-user" aria-hidden="true"></i> Welcome, <a class="login" href="<?php echo base_url().'user/profile' ?>"  onMouseOver="OverFunction()" onMouseOut="OutFunction()"> <span> <?php echo @$this->session->userdata['session_data']['fname'] ; ?> </span> </a>  <br />
             <a class="login" href="<?php echo base_url(); ?>user/logout"> <i class="fa fa-power-off" aria-hidden="true"></i> Logout </a> 
             	<!--<div id="profile_menu">
                    <ul>
                        <li><a href="<?php// echo base_url(); ?>profile">Account</a></li>
                        <li><a href="<?php// echo base_url(); ?>orders">Orders</a></li>
                        <li><a href="#">Wallet</a></li>
                        <li><a href="<?php// echo base_url(); ?>wish-list">Wishlist</a></li>
                        <li><a href="<?php// echo base_url(); ?>review-rating">Reviews & Ratings</a></li>
                        <li><a href="#">Email Preferences</a></li>
                        <li><a href="<?php// echo base_url(); ?>change_password">Change Password</a></li>
                        <li><a href="<?php// echo base_url(); ?>user/logout">Logout</a></li>
                    </ul>
                 </div>-->

             <?php }else{ ?>
             <a href="<?php echo base_url().'user/m_login' ?>" class="logout">  <i class="fa fa-user" aria-hidden="true"></i> Log In/Sign Up </a>
             <?php } ?>
     
          
            		
                      <div class="clearfix"> </div>
  
          
        
        
        </div>
        </div>
        <!-- End login details -->
        
        					
		</div>
		</div>
		</div>
		
 </div>
   <!-- Slide Menu -->   