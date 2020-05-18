<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
         
	  
<?php
								$rows1 = $search_sub->num_rows();
								//print_r($rows1);exit;
						  
						  if($rows1 > 0){
                          foreach($search_sub->result() as $row){
							  
							   ?>
                               
                                
 
<li><a href="<?php echo base_url(); ?>admin/newsletter/search_user/<?php echo ($row->user_email_id); ?>">
 <?php echo $row->user_email_id;?></br>

</a></li>
	<?php  }?>	
    <?php }else{?>
	<li><?php echo "No Results Found" ?></li>
 <?php  }?>	

 <script type="text/javascript">
    function showInnerHtml(e){
		//alert(e);return false;
       document.getElementById("search-text").innerHTML=e.innerHTML;
        
    }
    </script>