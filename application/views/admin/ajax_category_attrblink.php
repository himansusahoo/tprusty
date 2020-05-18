<script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree1.js' ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
	$('ul#example').collapsibleCheckboxTree();
	
});
</script>

                                            
<?php 
if($editedprod_catg!=''){
$query = $this->db->query("SELECT * FROM category_indexing  WHERE parent_id = 0 ");
$all_categories = $query->result();
if($editedprod_catg!='')
{
	$prodattg_arr=explode(',',$editedprod_catg);
	
foreach($all_categories as $category){ ?>

<?php if(in_array($category->category_id,$prodattg_arr)) { ?>
<ul id="example">
		<li id="category_li">
													<!--<input id="subcategory_id" type="radio" name="subcategory_id" value="<?php// echo $category->category_name; ?>" disabled />--><?php echo stripslashes($category->category_name); ?>
												
		<ul>

      <?php $qr=$this->db->query("select * from category_indexing where parent_id='$category->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct=$qr->num_rows();
		
	  	if($ct>0){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
            <?php if(in_array($rs->category_id,$prodattg_arr)) { ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs->category_id; ?>" />
            
		 <?php echo	stripslashes($rs->category_name);?>   
         
         <ul>
         <!--level-3-->
          <?php $qr1=$this->db->query("select * from category_indexing where parent_id='$rs->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct1=$qr1->num_rows();
		
	  	if($ct1>0){ ?>
        
        <?php 
			foreach($qr1->result() as $rs1){ 	?>
        <?php if(in_array($rs1->category_id,$prodattg_arr)) { ?>    
            
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs1->category_id; ?>"  />
            
				
		 <?php echo	stripslashes($rs1->category_name);?>&nbsp;
        
         
         <ul>
         <!--level-4-->
          <?php $qr2=$this->db->query("select * from category_indexing where parent_id='$rs1->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct2=$qr2->num_rows();
		
	  	if($ct2>0){ ?>
        
        <?php 
			foreach($qr2->result() as $rs2){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs2->category_id; ?>" />
			
		 <?php echo	stripslashes($rs2->category_name);?> 
         
         <ul>
         <!--level-5-->
          <?php $qr3=$this->db->query("select * from category_indexing where parent_id='$rs2->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct3=$qr3->num_rows();
		
	  	if($ct3>0){ ?>
        
        <?php 
			foreach($qr3->result() as $rs3){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs3->category_id; ?>" />
			
		 <?php echo	$rs3->category_name;?>
        
                 
         <ul>
         <!--level-6-->
          <?php $qr4=$this->db->query("select * from category_indexing where parent_id='$rs3->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct4=$qr4->num_rows();
		
	  	if($ct4>0){ ?>
        
        <?php 
			foreach($qr4->result() as $rs4){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs4->category_id; ?>" />
					
		 <?php echo	$rs4->category_name;?>
        
                 
          <ul>
         <!--level-7-->
          <?php $qr5=$this->db->query("select * from category_indexing where parent_id='$rs4->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct5=$qr5->num_rows();
		
	  	if($ct5>0){ ?>
        
        <?php 
			foreach($qr5->result() as $rs5){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs5->category_id; ?>" />
					
		 <?php echo	$rs5->category_name;?>
        
         
         <ul>
         <!--level-8-->
          <?php $qr6=$this->db->query("select * from category_indexing where parent_id='$rs5->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct6=$qr6->num_rows();
		
	  	if($ct6>0){ ?>
        
        <?php 
			foreach($qr6->result() as $rs6){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs6->category_id; ?>" />
					
		 <?php echo	$rs6->category_name;?>
         
       
          <ul>
         <!--level-9-->
          <?php $qr7=$this->db->query("select * from category_indexing where parent_id='$rs6->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct7=$qr7->num_rows();
		
	  	if($ct7>0){ ?>
        
        <?php 
			foreach($qr7->result() as $rs7){?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs7->category_id; ?>" />
					
		 <?php echo	$rs7->category_name;?>
            <ul>
         <!--level-10-->
          <?php $qr8=$this->db->query("select * from category_indexing where parent_id='$rs7->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct8=$qr8->num_rows();
		
	  	if($ct8>0){ ?>
        
        <?php 
			foreach($qr8->result() as $rs8){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs8->category_id; ?>" />
				
		 <?php echo	$rs8->category_name;?>
        
               
        </li> <?php } ?>  <?php } ?> </ul>              
                      
        </li> <?php } ?>  <?php } ?> </ul>
        
        </li> <?php } ?>  <?php } ?> </ul>       
                      
        </li> <?php } ?>  <?php } ?> </ul>
                      
        </li> <?php } ?>  <?php } ?> </ul>
          
        </li> <?php } ?>  <?php } ?> </ul>
         
        </li> <?php } ?>  <?php } ?> </ul>
             
        </li> <?php
		
		} //level3 categorgy display or not condition end
		 } ?>  <?php } ?> </ul>
         
        </li> <?php  
			} //level2 categorgy display or not condition end
		 } ?>  <?php } ?> </ul>
     </li>
     <?php } // main categorgy display or not condition end ?>
     </ul>
        <?php } ?>

  
<?php }}
else
{?>
<span style="color:#F00; text-align:center;"> No Category Found! </span>
<?php } ?>  