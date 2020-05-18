<?php
require_once("header.php");
?>


		
		<!--- Zebra_Datepicker link start here ---->
	<?php /*?>	<link href="<?php echo base_url().'Zebra_Datepicker-master/public/css/default.css' ?>" rel="stylesheet">
		<link href="<?php echo base_url().'Zebra_Datepicker-master/examples/public/css/style.css' ?>" rel="stylesheet">
		<script src="<?php echo base_url().'Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js' ?>"></script>
		<script src="<?php echo base_url().'Zebra_Datepicker-master/examples/public/javascript/core1.js' ?>"></script>
		<script src="<?php echo base_url().'Zebra_Datepicker-master/public/javascript/zebra_datepicker.js' ?>"></script><?php */?>
		<!--- Zebra_Datepicker link end here ---->
        
        
       <?php /*?> <link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script><?php */?>
        
        
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
        
		<!--<style>
			.Zebra_DatePicker_Icon{left: 170px !important; top: 8px !important;}
		</style>-->
        
        <script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree.js' ?>"></script>
       
        
        <script type="text/javascript">
jQuery(document).ready(function(){
		$('ul#example').collapsibleCheckboxTree();
});

</script>
<script>

function valid()
{
			
	if($('#category_name').val()=='')
	{
		
		$('.form_view').find('#tab1').addClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		
		
		$('.tabs-horiz').find('#li_tab1').addClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		
		document.getElementById('show_error').innerHTML="Enter Category Name";
		$('#category_name').css('border','1px solid red');
		document.getElementById('category_name').focus();
		return false;
	
	}
	
	if($('#active_status').val()=='')
	{
		
		$('.form_view').find('#tab1').addClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		
		
		$('.tabs-horiz').find('#li_tab1').addClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		
		document.getElementById('show_error').innerHTML="Select Active Status";
		$('#active_status').css('border','1px solid red');
		document.getElementById('active_status').focus();
		return false;
	
	}
	
	
	if($('#incld_navmenu_status').val()=='')
	{
		
		$('.form_view').find('#tab1').addClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		
		
		$('.tabs-horiz').find('#li_tab1').addClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		
		document.getElementById('show_error').innerHTML="Select Include Navigation Menu";
		$('#incld_navmenu_status').css('border','1px solid red');
		document.getElementById('incld_navmenu_status').focus();
		return false;
	
	}
	
	
	
	if($('#avl_prod_list_order').val()=='')
	{
		
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		
		
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		
		document.getElementById('show_error').innerHTML="Select Available Product Listing Sort by";
		$('#avl_prod_list_order').css('border','1px solid red');
		document.getElementById('avl_prod_list_order').focus();
		return false;
	
	}
	
	
	if($('#def_prod_list_sortby').val()=='')
	{
		
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		
		
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		
		document.getElementById('show_error').innerHTML="Select Default Product Listing Sort By";
		$('#def_prod_list_sortby').css('border','1px solid red');
		document.getElementById('def_prod_list_sortby').focus();
		return false;
	
	}
	
}

<?php /*?><?php if($catg_info!=""){ ?><?php */?>



</script>

  <script>
  $(function() {
    $( "#datepicker_from" ).datepicker();
  });
  
   $(function() {
    $( "#datepicker_to" ).datepicker();
  });
  
  
  </script>        
    
    <script>
function select_subcategory_valid()
{
	
	var subcategoryid = document.getElementsByName("subcategory_id");
	var subcategoryid_count= subcategoryid.length;
	
	var count=0;
		for (var i=0; i<subcategoryid_count; i++) {
			if (subcategoryid[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			document.getElementById('show_error').innerHTML="Select any category from directory list";
			//alert('Please select atleast one directory');
			return false
		}
		
}


</script>    


	<div id="content">    
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_catalog.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
		<div class="main-content">
		
		
		<?php if(@$data==true){ ?><div align="center" style="color:#0C6"> <?php  echo $data ?> </div> <?php } ?>
       
          <form id="save_catgory_form" method="post" action="<?php echo base_url().'admin/catalog/save_category' ?>">
			<div class="row content-header">
		   <div class="col-md-8"> <b>Category Information</b></div>
				                          
           <div class="col-md-4 show_report">
               
                <?php /*?><input  type="button" class="all_buttons" value="Add Subcategory" onClick="window.location.href='<?php echo base_url().'admin/catalog/add_subcategory' ?>' " /><?php */?>
                
				<input  type="submit" class="all_buttons" value="Save Category" onClick="return valid()"/>
				<input type="reset" class="all_buttons" value="Reset" />
				
           </div>
			</div>
            
           <div class="clearfix"></div>
           
           
           
           
           <div class="left-sidebar">  
             <input type="button" value="Add Root Category" class="btns" onClick="window.location.href='<?php echo base_url(); ?>admin/catalog/manage_category'" />
             <input type="button" value="Add Subcategory" class="btns" onClick="select_subcategory_valid()"  />
  <ul id="example">
  <?php foreach($data2->result() as $rows){ ?> <!--level-1 --> 
    <li id="category_li">
      <input id="subcategory_id"  type="radio" name="subcategory_id"   value="<?php echo $rows->category_id; ?> "   onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rows->category_id; ?>'"    />
      <?php echo $rows->category_name; ?>
      <ul >
      <?php $qr=$this->db->query("select * from category_indexing where parent_id='$rows->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct=$qr->num_rows();
		
	  	if($ct>0){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs->category_id; ?>'"  />
				
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
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs1->category_id; ?>" onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs1->category_id; ?>'"  />
				
		 <?php echo	$rs1->category_name;?>
         
         
         <ul>
         <!--level-4-->
          <?php $qr2=$this->db->query("select * from category_indexing where parent_id='$rs1->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct2=$qr2->num_rows();
		
	  	if($ct2>0){ ?>
        
        <?php 
			foreach($qr2->result() as $rs2){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs2->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs2->category_id; ?>'"  />
				
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
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs3->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs3->category_id; ?>'"   />
				
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
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs4->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs4->category_id; ?>'"  />
				
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
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs5->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs5->category_id; ?>'"  />
				
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
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs6->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs6->category_id; ?>'"  />
				
		 <?php echo	$rs6->category_name;?>
         
         
          <ul>
         <!--level-9-->
          <?php $qr7=$this->db->query("select * from category_indexing where parent_id='$rs6->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct7=$qr7->num_rows();
		
	  	if($ct7>0){ ?>
        
        <?php 
			foreach($qr7->result() as $rs7){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs7->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs7->category_id; ?>'"  />
				
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
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs8->category_id; ?>"  onChange="window.location.href='<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs8->category_id; ?>'"  />
				
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
           </div>  <!-- @end left-sidebar -->
           
           <!-- @start #right-content -->
           
           <div class="right-cont">
           
           <div id="show_error" align="center" style="color:#F00;"> </div>
           
			<ul class="nav nav-tabs tabs-horiz">
				<li id="li_tab1"><a data-toggle="tab" href="#tab1">General Information</a></li>
				<li id="li_tab2"><a data-toggle="tab" href="#tab2">Display Settings</a></li>
				<li id="li_tab3"><a data-toggle="tab" href="#tab3">Custom Design</a></li>
				<li id="li_tab4" class="active"><a data-toggle="tab" href="#tab4">Category List</a></li>
			</ul>

			<!--<div class="tab-content form_view">-->
			<div class="tab-content form_view">
				<div id="tab1" class="tab-pane fade ">
					<h3> General Information </h3>
					<!--<form class="general_information" >-->
						<table>
							<tr>
								<td style="width:20%;"> Name <sup>*</sup> </td>
								<td> <input type="text" id="category_name" name="category_name" class="text" > </td>
							</tr>
							<tr>
								<td> Is Active <sup>*</sup> </td>
								<td> 
									<select id="active_status" name="active_status" class="text2" >
                                    	<option value="">--select--</option>
										<option value="yes"> Yes </option>
										<option value="no"> No </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> Description </td>
								<td> 
									<textarea rows="7" class="text" name="catg_description" > </textarea>
									<!--<button type="button">WYSIWYG Editor</button> -->
								</td>
							</tr>
							<!--<tr>
								<td> Image </td>
								<td> <input type="file" name="cat_img" class="text"></td>
							</tr>-->
							<tr>
								<td> Page Title </td>
								<td> <input type="text" name="page_title" class="text" ></td>
							</tr>
							<tr>
								<td> Meta Keywords </td>
								<td> 
									<textarea rows="7" class="text" name="meta_keyword" > </textarea>
								</td>
							</tr>
							<tr>
								<td> Meta Description </td>
								<td> 
									<textarea rows="7" class="text" name="meta_descrp" > </textarea>
								</td>
							</tr>
							<tr>
								<td> Include in Navigation Menu<sup>*</sup> </td>
								<td> 
									<select id="incld_navmenu_status" class="text2" name="incld_navmenu_status" >
                                    <option value="">--select--</option>
										<option value="yes"> Yes </option>
										<option value="no"> No </option>
									</select>
								</td>
							</tr>
						</table>
					<!--</form>-->
				</div>
				<div id="tab2" class="tab-pane fade ">
					<h3> Display Settings </h3>
					<!--<form>-->
						<table>
							<tr>
								<td style="width:20%;"> Display Mode </td>
								<td> 
									<select class="text2" name="display_mode" id="display_mode" >
                                    <option value="">--select--</option>
										<option value="Products only"> Products only </option>
										<option value="Static block only"> Static block only </option>
										<option value="Static block and Products only"> Static block and Products only </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> CMS Block </td>
								<td> 
									<select class="text2" name="cms_block" >
                                    
										<option value=""> Please select a static block.. </option>
										<option value="Footer links"> Footer links </option>
										<option value="Footer links Company"> Footer links Company </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> Is Anchor </td>
								<td> 
									<select class="text2" name="anchor_status" >
										<option value="">--select--</option>
                                        <option value="yes"> Yes </option>
										<option value="no" > No </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> Available Product Listing Sort by <sup>*</sup> </td>
								<td> 
									<select name="avl_prod_list_order" id="avl_prod_list_order"  size="10" class="text2" >
                                    	<option value="">--select--</option>
										<option value="Best Value"> Best Value </option>
										<option value="Name"> Name </option>
										<option value="Price"> Price </option>
									</select>
									<!--<input id="avail_product" class="checkbox" type="checkbox" checked="checked" />
									<label> Use All Available Attributes </label>-->
								</td>
							</tr>
							<tr>
								<td>Default Product Listing Sort By <sup>*</sup></td>
								<td>
									<select class="text2" id="def_prod_list_sortby" name="def_prod_list_sortby" >
                                    	<option value="">--select--</option>
										<option value="Best Value"> Best Value </option>
										<option value="Name"> Name </option>
										<option value="Price"> Price </option>
									</select>
									<!--<input id="default_product" class="checkbox" type="checkbox" checked="checked" />
									<label> Use Config Settings </label>-->
								</td>
							</tr>
							<tr>
								<td>Layered Navigation Price Step</td>
								<td>
									<input type="text" name="navigation_price" class="text2" >
									<!--<input id="default_product" class="checkbox" type="checkbox" checked="checked" />
									<label> Use Config Settings </label>-->
								</td>
							</tr>
						</table>
					<!--</form>-->
				</div>
				<div id="tab3" class="tab-pane fade">
					<h3>Custom Design</h3>
					<!--<form>-->
						<table>
							<tr>
								<td style="width:20%;"> Use Parent Category Settings </td>
								<td> 
									<select class="text2" name="parent_catg_stg_status" >
										<option value="">--select--</option>
                                        <option value="yes"> Yes </option>
										<option value="no"> No </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> Apply To Products </td>
								<td> 
									<select class="text2" name="apply_to_product_status" >
										<option value="">--select--</option>
                                        <option value="yes"> Yes </option>
										<option value="no"> No </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> Custom Design </td>
								<td> 
									<select class="text2" name="custom_design" >
										<option value="">-- Please Select --</option>
										<optgroup label="base">
											<option value="default">default</option>
										</optgroup>
										<optgroup label="default">
											<option value="blank">blank</option>
											<option value="default">default</option>
											<option value="iPhone">iPhone</option>
											<option value="modern">modern</option>
										</optgroup>
										<optgroup label="moonboy">
											<option value="default">default</option>
										</optgroup>
									</select>
								</td>
							</tr>
							<tr>
								<td>Active From</td>
								<td><input class="text2" name="date_from" id="datepicker_from"  /></td>
							</tr>
							<tr>
								<td>Active To</td>
								<td><input class="text2"  name="date_to" id="datepicker_to" /></td>
							</tr>
							<tr>
								<td>Page Layout</td>
								<td>
									<select class="text2" name="page_layout" >
                                    <option value="">--select--</option>
										<option value="No layout updates">No layout updates</option>
										<option value="Empty">Empty</option>
										<option value="column">1 column</option>
										<option value="columns with left bar">2 columns with left bar</option>
										<option value="columns with right bar">2 columns with right bar</option>
										<option value="columns">3 columns</option>
									</select>
								</td>
							</tr>
							<tr>
								<td> Custom Layout Update </td>
								<td> 
									<textarea name="custom_layout_update" rows="7" class="text" > </textarea>
								</td>
							</tr>
						</table>
					
				</div></form>
				<div id="tab4" class="tab-pane fade in active">
                
                <form action="<?php echo base_url().'admin/catalog/filter_category' ?>" method="post" >
					<div class="row mb10 mt10">
						<div class="col-md-6">
							<!--Page 
							<span class="glyphicon glyphicon-chevron-left arrow_button"></span>
							<input type="text" name="page" class="input_text" value="1">-->
                            
                            <p style="font-size:14px;" ><?php // echo $links; ?></p>
							<!--<span class="glyphicon glyphicon-chevron-right"></span>
							of 1 pages <span class="separator">|</span> View
							<select> 
								<option selected="selected" value="">20</option>
								<option>30</option>
								<option>50</option>
								<option>100</option>
								<option>200</option>
							</select>
							per page <span class="separator">|</span> Total 3 records found-->
						</div>
						<div class="col-md-6">
							<input type="submit" class="all_buttons" value="Search" />
							<input type="reset" class="all_buttons" value="Reset">
						</div>
					</div>
					<div>
						<table class="table table-bordered">
							<tr class="table_th">
								<!--<th width="5%" class="a-center"><input type="checkbox"></th>-->
								<th width="10%">ID</th>
								<th width="20%">Name</th>
								
								<th width="15%">Active From</th>
								<th width="15%">Active To</th>
                                <th width="10%">Active Status</th></tr>
							<tr class="filter_tr">
                            <!--<td><input type="checkbox"></td>-->
								<td class="a-center"><input type="text" name="id" ></td>
								<td><input type="text" name="catg_name" ></td>
								
								<td><input type="text" name="active_from" value=""></td>
                                <td><input type="text" name="active_to" value=""></td>
								<td>
									<select name="ctg_status">
										<option value="">--select--</option>
										<option value="yes">Active</option>
										<option value="no">Inactive</option>
									</select>
								</td>
								
							</tr>
                            <?php foreach($catg_info->result() as $rows) { ?>
							<tr>
								<!--<td class="a-center"><input type="checkbox"></td>-->
								<td><?php echo $rows->category_id ?></td>
								<td><?php echo $rows->category_name ?></td>
								
								<td><?php echo $rows->active_from ?></td>
								<td><?php echo $rows->active_to ?></td>
                                <td><?php echo $rows->active_status ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div></form>
			</div>
            
            
            </div>
            <div class="clearfix"> </div>
             
            
		</div>  <!-- @end #main-content -->
	</div>
<?php
require_once('footer.php');
?>	