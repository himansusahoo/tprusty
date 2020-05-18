<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	require_once('header.php');
?>

<div id="content">
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_sellers.php';?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php';?>
			</div>
		</div>
        
        <!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php //echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php //echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php //echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">-->

<link href="<?php echo base_url(); ?>js/datetime/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/1.0.0/js/bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>
<style>
	/*.Zebra_DatePicker_Icon{	
	top:6px !important;
}
.Zebra_DatePicker{ z-index:999999 !important;}*/
</style>
<!--- Zebra_Datepicker link end here ---->
    <br />
    <br />    
  <div class="main-content" style="padding:40px 10px;">   
 <div class="row content-header" style="background-color:#CCC;">
				<h3 style="margin-top:0px; font-weight:bold;"><span style="color:#F00">Edit Bulk Existing Products</span></h3>
   
   
           
</div>
		<!-------------------------------------------Listing start--------------------------------------------------------------------->
        
        
					
                     <div class="col-md-6 right">
					  <table class="multi_action">
							<tr>
								<!--<td>
									<a href="#">Select Visible</a>
									<span class="separator">|</span>
									<a href="#">Unselect Visible</a>
									<span class="separator">|</span>
									0 items selected
								</td>-->
								<td>
									
                           
								</td>
							 </tr>
						</table>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div id="show_error" align="center" style="color:#F00; font-weight:bold; display:none;" > </div> 
					  <div><form action="<?php echo base_url().'admin/Bulkexistingproduct_edit/filter_bulkexisting_editedproduct/'.$catg_id.'/'.$attrbsetid.'/'.$seller_id.'/' ?>" method="get" onsubmit="return validetdate()" >
						<table class="table table-bordered table-hover">
                       
                           
							<tr class="table_th">
								
								<th width="5%"> From Date</th>
								<th width="7%"> To Date</th>
                                <th width="10%">Product Name</th>
                                <th width="7%">SKU</th>
								<th>  </th>
							</tr>
							
                             <tr class="filter_tr">
                             <td>
                              <!--<input type="text" class="seller_input" name="from_dtm1" id="datepicker-example7-start" style="width:300px">-->
                               
                               
    
                                 <div class="form-group">
                                        <div class='input-group date' id='datetimepicker6'>
                                            <input type='text' class="form-control" name="from_dtm" style="width:250px" id="datepicker-example7-start" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    
                          <!-- <input type="text" class="seller_input" name="to_dtm1" id="datepicker-example7-end" style="width:300px">-->
                                   
                        
              
                             </td>
                             <td> <span style="display:none;"><input type="text" class="seller_input" name="seller_name" id="seller_name" style="width:280px"></span>
                           
                             <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" name="to_dtm" style="width:250px" id="datepicker-example7-end" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                             </td>
                             
                             <td> <input type="text" class="seller_input" name="prod_name" id="prod_name" style="width:280px"></td>
                             <td> <input type="text" class="seller_input" name="prod_sku" id="prod_sku" style="width:200px"></td>
                               
                             <td> 
                             
                             <button id="product_submit" class="seller_buttons" onClick="" >                           
                               <i class="fa fa-search" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Apply</button>
                               <br /> 
                                <br /> 
                                <button id="product_reset" class="seller_buttons" onClick="window.location.href='<?php echo base_url().'admin/Upload_bulk_existingproduct/filter_bulkexisting_product/'.$catg_id.'/'.$attrbsetid.'/'.$seller_id.'/' ?>' " style="width:75px;">                           
                               <i class="fa fa-refresh" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Reset</button>
                             </td>
                             </tr>
                            
                           
                            
                           
					  </table>
                       </form>
                      
                      <?php
					  
					   
					 /* if($this->input->post('hidden_subcatgtxtbox') && $this->input->post('attribute_set'))
					  {	$catg=@$this->input->post('hidden_subcatgtxtbox');
					  	$attrbset=@$this->input->post('attribute_set');
						
						$this->session->set_userdata('catgid',$catg);
						$this->session->set_userdata('attrbid',$attrbset);
						
					  }else
					  {		$catg = @$_REQUEST['catg_id'];
							$attrbset = @$_REQUEST['attrbsetid'];
							
							$this->session->set_userdata('catgid',$catg);
							$this->session->set_userdata('attrbid',$attrbset);
							
										 
					  }*/
					  	$catg=$catg_id;
						$attrbset=$attrbsetid;
						$qrprod_catg=$this->db->query("SELECT * FROM category_indexing WHERE category_id='$catg' ");
						$qr_attrbset=$this->db->query("SELECT * FROM attribute_group WHERE attribute_group_id='$attrbset' ");
						?>
                        <span style="color:#333; font-weight:bold;">Product Filter By:</span>
                        <span style="color:#900; ">
						<?php 
								echo 'Category: '.$qrprod_catg->row()->category_name;
								echo ' / Attribute: '.$qr_attrbset->row()->attribute_group_name;
								if(@$_REQUEST['from_dtm']!='' && @$_REQUEST['to_dtm']!='')
								{
									$dtm_from=date_create($_REQUEST['from_dtm']);
									$dtm_from1= date_format($dtm_from, 'M d, Y ');
									
									$dtm_to=date_create($_REQUEST['to_dtm']);
									$dtm_to1= date_format($dtm_to, 'M d, Y ');
									
									
									echo ' / From Date:'.$dtm_from1.' To '.$dtm_to1;
									
								}
								if(@$_REQUEST['prod_name'])
								{
									echo ' / Product Name: '.$_REQUEST['prod_name'];	
								}
								if(@$_REQUEST['prod_sku'])
								{
									echo ' / SKU: '.$_REQUEST['prod_sku'];	
								}
								
								if(@$_REQUEST['seller_name'])
								{echo ' / Seller: '.$_REQUEST['seller_name'];}
					  
						?>
    <!--------------------------------------------Form submit for excel template genarate start-------------------------------------------->                    
                        <?php
						 
						$from_arr=array('onSubmit'=>'return dwlnbulk_existingprodtemplate()');
						echo form_open('admin/Bulkproduct_edit/download_exting_editprodtemplate',$from_arr); 
						
						?>
                      <?php if($search_result->num_rows()>0) { 
					  
					  ?>
                        
                        <button type="submit" id="product_download" class="seller_buttons"  style="float:right;"> 
           					<i class="fa fa-download" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Download Products 
           				</button>
           
             <div class="exist_prod_new_list" align="left"><button type="button" onclick="window.location.href='<?php echo base_url(). 'admin/Bulkexistingproduct_edit/bulk_existingeditproductupload_panel/'.$seller_id?>' " style='width:260px;'>Bulk Existing Edited Products Upload &nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
</button>  </div>
              <?php } ?>
              
                        </span>
                        <br/>
                        <div id="show_productserror" align="center" style="color:#F00; font-weight:bold; display:none;" > </div> 
						<br/>
                       <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                        
                      <div class="row">
						<div class="search_products">
                        
                        <input type="hidden" id="hiddenbox_catgrid" name="hiddenbox_catgrid" value="<?php echo $catg; ?>">
                        <input type="hidden" id="hiddenbox_attrbsetid" name="hiddenbox_attrbsetid" value="<?php echo $attrbset; ?>">
                        <input type="hidden" id="hiddenbox_sellerid" name="hiddenbox_sellerid" value="<?php echo $seller_id; ?>">
                        
							<table class="table table-hover" style="border: 1px solid #c8c8c8;">
								<tr>
                                
									<th width="70%">
                                  <input type="checkbox" id="check_all" name="check_all"> 
                                    Product Specification</th>
									<th width="20%">Subcategory</th>
									<!--<th width="10%">Action</th>-->
								</tr>
								<?php $prodsl=0; 
								//$prodid_arr=array();
								if($search_result->num_rows()>0) { 
									foreach($search_result->result_array() as $row) :
									//var_dump($search_result); exit;
									//$arr_img = explode(',',$row->imag);
									//$first_img = $arr_img[0];
									
									//if(!in_array($row['product_id'],$prodid_arr)){
								?>
								<tr id="prod<?=$prodsl?>">
                               
									<td>
										<div class="row">
											<div class="col-md-4">
												<input type='checkbox' name="prodid_chk[]"  onclick="add_exist_product('<?=$row['product_id']?>', '<?=$row['seller_id']?>','<?=$row['sku']?>','<?=$prodsl?>')" id="prodchk<?=$prodsl?>" value="<?=$row['product_id']?>">
                                                
                                     <span style="display:none;"> <input type='checkbox' name='ckh_sku[]' id="ckh_sku<?=$prodsl?>" value="<?=$row['sku']?>"/></span>
                                                <img src="<?php echo base_url(); ?>images/product_img/<?=$row['imag']?>" width="100" height="100">
											</div>
											<div class="col-md-8">
												<div>
													<strong><?=$row['name']?></strong>
													<table class="exist_product_list_table">
														<tr>
                                                        <td>
										
									</td>
															<td>Category : </td>
															<td><?=$row['lvlmain_name'].' >> '.$row['lvl1_name'];?></td>
														</tr>
														<tr>
															<td>SKU ID : </td>
															<td><?=$row['sku']?></td>
														</tr>
														<tr>
															<td>Seller : </td>
															<td><?php 
															$seller_idofprod=$row['seller_id'];
												$qr_sllnm=$this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$seller_idofprod' ");
												
												echo @$qr_sllnm->row()->business_name;
															
															 ?></td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</td>
									<td>
										<h5><?=$row['lvl2_name']?></h5>
									</td>
									
								</tr>
								<?php
								//$prodid_arr[]=$row['product_id'];
									//} // array of product_id check end
									$prodsl++;
								endforeach;
								}else{
								?>
								<tr>
									<td colspan="3" class="a-center">No record found !</td>
								</tr>
								<?php
								}
								?>
							</table>
						</div>
					</div>
                        
						 <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
               <?php echo form_close(); ?>
               
               
              <!--------------------------------------------Form submit for excel template genarate end-------------------------------------------->             
   		<!------------------------------------------Listing End------------------------------------------------------------------------->
                
	</div> <!-- end of rowcontent-header div -->
</div> <!-- end of main-content div -->
<script>

function dwlnbulk_existingprodtemplate()
{
	 $("#show_productserror").hide();
	//var prodid = $('input[name="prodid_chk"]:checked').map(function(_, el){
//        	return $(el).val();
//    	}).get();
	
	var productid = document.getElementsByName("prodid_chk[]");
	 
		var productid_count = productid.length; 
		var count = 0;
		for (var i=0; i<productid_count; i++) {
			if (productid[i].checked === true) 
			{
				count++;
			}
		}
	if(count==0){
	 $("#show_productserror").text('! Please Select Atleast One Product');
	 $("#show_productserror").show();
	 return false;	
	}
	
	/*$.ajax({
					method:"POST",
					url:"<?php //echo base_url(); ?>admin/Download_bulkexisting_prodtemplate/download_extprodtemplate",
					data:{catg_id:catg_id,attrbsetid:attrbsetid,prodid:prodid},
					success:function(data){			
						
						$("#excelrec_statisdiv").html(data);
						$('#process_div').css('display','none');
						$("#excelrec_statisdiv").css('display','block');
						
					}
				});	*/
		
}

function add_exist_product(prodid,selrid,sku,prodsl)
{
		
		if(document.getElementById('prodchk'+prodsl).checked== true)
		{
			$("#prod"+prodsl).css("background-color", "LightGoldenRodYellow ");
			document.getElementById('ckh_sku'+prodsl).checked= 'checked';
			
		}
		else if(document.getElementById('prodchk'+prodsl).checked== false)
		{
			
			$("#prod"+prodsl).css("background-color", "");
			document.getElementById('ckh_sku'+prodsl).checked= '';
		}		  
	
}
function validetdate()
{
	var fromdate=$('#datepicker-example7-start').val();
	var todate=	$('#datepicker-example7-end').val();
	
	if(fromdate!='' && todate=='')
	{ 	$("#show_error").text('! Please Select To Date');
	 	$("#show_error").show();
	 	return false;
	 }
	if(fromdate=='' && todate!='')
	{ 	$("#show_error").text('! Please Select From Date');
	 	$("#show_error").show();
	 	return false;
	 }
	
}
</script>

<?php
	require_once('footer.php');
?>                      