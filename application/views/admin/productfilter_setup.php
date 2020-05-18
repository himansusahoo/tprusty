<?php
	require_once('header.php');
?>

<div id="content">
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_config.php';?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php';?>
			</div>
		</div>
 
     <div class="main-content" style="padding:40px 10px;">   
 <div class="row content-header">
				<h3 style="margin-top:18px;">Product Filter Setup</h3>
            <?php /*?> <span style="float:right;">   
                 <a id="product_submit" class='seller_buttons' href="<?php echo base_url().'admin/Download_bulkproducttemp/uploadlog_list/'.$seller_id ?>" style="cursor:pointer;" >
           				<i class="fa fa-list-alt" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Upload Log 
           		</a>
            </span>   <?php */?> 
			</div> 
  
  <!----------------------------------------------Category Listing Start----------------------------->
 <!-- collapsibleCheckboxTree -->
<script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree.js' ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
	$('ul#example').collapsibleCheckboxTree();
});
</script>
         
  
  <div id="show_error" align="center" style="color:#F00; display:none;" > </div> 
  
  	
  
										<!--<div class="left">--> <div class="left-sidebar" style="width:18%;">
											<ul id="example">
                                            
<?php 
/*$query = $this->db->query("SELECT a. * FROM category_indexing a INNER JOIN category_master b 
ON a.category_id = b.category_id WHERE b.active_status = 'yes' AND a.parent_id = 0 ");
$categories = $query->result();*/
foreach($categories as $category){ ?>


		<li id="category_li">
													<!--<input id="subcategory_id" type="radio" name="subcategory_id" value="<?php// echo $category->category_name; ?>" disabled />--><?php echo $category->category_name; ?>
												
		<ul>

      <?php $qr=$this->db->query("select * from category_indexing where parent_id='$category->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct=$qr->num_rows();
		
	  	if($ct>0){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
       <li>		
			<?php /* ?><input type="radio" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs->category_id; ?>" /><?php */ ?>
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs->category_id; ?>" />
            
		 <?php echo	$rs->category_name;?>   
         
         <ul>
         <!--level-3-->
          <?php $qr1=$this->db->query("select * from category_indexing where parent_id='$rs->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct1=$qr1->num_rows();
		
	  	if($ct1>0){ ?>
        
        <?php 
			foreach($qr1->result() as $rs1){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs1->category_id; ?>" />
            
				
		 <?php echo	$rs1->category_name;?>&nbsp;
        
         
         <ul>
         <!--level-4-->
          <?php $qr2=$this->db->query("select * from category_indexing where parent_id='$rs1->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct2=$qr2->num_rows();
		
	  	if($ct2>0){ ?>
        
        <?php 
			foreach($qr2->result() as $rs2){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs2->category_id; ?>" />
			
		 <?php echo	$rs2->category_name;?> 
         
         <ul>
         <!--level-5-->
          <?php $qr3=$this->db->query("select * from category_indexing where parent_id='$rs2->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct3=$qr3->num_rows();
		
	  	if($ct3>0){ ?>
        
        <?php 
			foreach($qr3->result() as $rs3){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs3->category_id; ?>" />
			
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs4->category_id; ?>" />
					
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs5->category_id; ?>" />
					
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs6->category_id; ?>" />
					
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs7->category_id; ?>" />
					
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" onclick="get_menuattribute()" value="<?php echo $rs8->category_id; ?>" />
				
		 <?php echo	$rs8->category_name;?>
        
               
        </li> <?php } ?>  <?php } ?> </ul>              
                      
        </li> <?php } ?>  <?php } ?> </ul>
        
        </li> <?php } ?>  <?php } ?> </ul>       
                      
        </li> <?php } ?>  <?php } ?> </ul>
                      
        </li> <?php } ?>  <?php } ?> </ul>
          
        </li> <?php } ?>  <?php } ?> </ul>
         
        </li> <?php } ?>  <?php } ?> </ul>
             
        </li> <?php } ?>  <?php } ?> </ul>
         
        </li> <?php } ?>  <?php } ?> </ul>
     </li>
        <?php } ?>
  </ul>
  
  
										</div><!-- @end left-sidebar -->
  
  <!---------------------------------------------Category Listing End-------------------------------->
            
    <!-- @start #right-content -->
         
           <div class="right-cont" style="width:80%;">
           <div id="show_error" align="center" style="color:#F00;"> </div>
           <div class="form_view">
						<h3>
                        
                        Select Attribute Set
                         
                        </h3>
							<div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
							</div>
							<table style="display:none;" id="att_datadisplay">
								
                                
                                 <tr>
									<td>Attribute Set Type <sup>*</sup> </td>
									<td>
                                    	<select class="seller_input" id="attribute_set" name="attribute_set" onChange="select_subattrb(this.value)" >
														<option value="">--Choose Attribute--</option>
													<?php /* ?><?php 
													
													$attribute = $attrbset->result_array(); 
													if($attribute) :
														foreach($attribute as $row) : 
													?>
														<option value="<?php echo $row['attribute_group_id']; ?>"><?php echo $row['attribute_group_name']; ?></option>
													<?php endforeach;
														endif;
													?><?php */ ?>
													</select>
                                                    
                                    </td>
								</tr>
                               
							</table>
                            <?php if($this->session->flashdata('msgcod_wtchrg')){ ?>	<sapn id="successfully_verify" style="color:#0C0; text-align:center;">
						<img src="<?php echo base_url().'images/success_icon.png' ?>">&nbsp<?php echo $this->session->flashdata('msgcod_wtchrg'); ?></span> <?php } ?>
                             <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div>
                            <div id="filter_slabdiv" class="alert alert-info alert-dismissable" style="display:none; overflow-y:scroll; height:450px;"> </div>
                            
                            
					</div>
                    
                   
          </div>
				
			</div>
            </div>
            <div class="clearfix"> </div>
            <!-- @end #right-content -->         
        
          
</div>  <!-------div content main end tag-------->                  
</div>  <!-------div content end tag-------->       

<script>

function select_subattrb(attrbgroup_id)
{
	var subcatgid = $('input[name="subcategory_id"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
	var subcategoryid = document.getElementsByName("subcategory_id"); 
		var subcategoryid_count = subcategoryid.length; 
		var count = 0;
		for (var i=0; i<subcategoryid_count; i++) {
			if (subcategoryid[i].checked === true) {
				count++;
			}
		}
	if(count==0){
	 $("#show_error").text('Please Select Atleast One Category');
	 $("#show_error").show();
	 $("#show_errorattrb").hide();
	 return false;	
	}
	var attrb_id=$('#attribute_set').val();
	if(attrb_id=='')
	{
	$("#show_error").text('Please Select Atleast One Attribute Set');
	 $("#show_error").show();
	 $("#show_errorattrb").hide();
	 return false;	
	}
    else{		
	
	
	
	$('#loader_div').css('display','block');
	$('#filter_slabdiv').css('display','none');
	$("#show_error").hide();
	$("#show_errorattrb").hide();
	var subcategory_id=$("input[type='radio']:checked").val();
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Super_admin/showall_attribute",
					data:{attrbgroup_id:attrbgroup_id,subcategory_id:subcategory_id},
					success:function(data){			
						
						$("#filter_slabdiv").html(data);
						$('#filter_slabdiv').css('display','block');
						
						$('#loader_div').css('display','none');
						
						
					}
				});	
				
	}
	
		
}


function valid_attrb()
{
	var order_ids = document.getElementsByName("attrbfield_idchk[]");
		var orderid_count=order_ids.length;
		
		var count=0;
		for (var i=0; i<orderid_count; i++) {
			if (order_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if ($('#price').is(":checked"))
		{var price_chk=$('#price').val();}
		else
		{var price_chk='';}
		
		if ($('#discount').is(":checked"))
		{var discount_chk=$('#discount').val();}
		else
		{var discount_chk='';}
		
		if ($('#seller').is(":checked"))
		{var seller_chk=$('#seller').val();}
		else
		{var seller_chk='';}
	
		if(count==0)
		{
			
	 		$("#show_error").hide();
			$("#show_errorattrb").text('Please Select Atleast One Attribute From Following List !');
	 		$("#show_errorattrb").show();
			
			
	 		return false;
		}
		else
		{
			
			$('#loader_div').css('display','block');
			//$('#filter_slabdiv').css('display','none');
			//var subcategory_id=$('#subcategory_id').val();
			
			var subcategory_id=$("input[type='radio']:checked").val();			
			var attribute_set=$('#attribute_set').val();
			var attrbfield_id = $('input[name="attrbfield_idchk[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
	
			$.ajax({
							method:"POST",
							url:"<?php echo base_url(); ?>admin/Super_admin/save_filterdata",
							data:{subcategory_id:subcategory_id,
								  attribute_set:attribute_set,
								  attrbfield_id:attrbfield_id,
								  price:price_chk,
								  discount:discount_chk,
								  seller:seller_chk
							},
							success:function(data){			
								
								$("#filter_slabdiv").html(data);
								$('#filter_slabdiv').css('display','none');
								
								$('#loader_div').css('display','none');
								
								window.location.reload(true);
								
								
							}
						});	
			
		}
}

function get_menuattribute()
{
	//alert("hello");
	var subcategory_id = $('input[name="subcategory_id"]:checked').map(function(_, el){
      return $(el).val();
  }).get();
  subcategory_id=subcategory_id.toString();
  //$('#loader_div').css('display','block');
  $.ajax({
		method:"POST",
		url:"<?php echo base_url(); ?>admin/Super_admin/getattribute_menuwise",
		data:{subcategory_id:subcategory_id},
		beforeSend: function(){
				//$('#att_datadisplay').css('display','block');
				$('#loader_div').css('display','block');
				
				
			},
		complete: function(){
			$('#loader_div').css('display','none');
			$('#att_datadisplay').css('display','block');
		},	
		success:function(data){
				$("#attribute_set").html(data);
		}
	});	
  
}

</script>


  
<?php
	require_once('footer.php');
?>	