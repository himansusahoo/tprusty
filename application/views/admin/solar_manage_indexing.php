<?php
require_once('header.php');
?>
		<div id="content">
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_config.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
          
				<div class="row content-header" >
					<div style="background-color:  #d7bde2  ; border: 1px solid; border-radius: 5px; height:50px;" ><b style="font-size:24px;"> Indexing Of:&nbsp;</b>
                    
                 <select id="indextype_slct" name="indextype_slct" class="text2" style="width:200px; height:30px;" onChange="indextypeslct(this.value)">
                                    <!--<option value="">--select--</option>-->
                                    <option value="Add" <?php if($this->uri->segment(3)=='Solar_manage'){echo "selected";} ?>>New Product</option>
                                    <option value="Edit" <?php if($this->uri->segment(3)=='edited_productindex'){echo "selected";} ?>>Edited Product</option>  
                                    <option value="Delete" <?php if($this->uri->segment(3)=='removed_productindex'){echo "selected";} ?>>Deleted Product</option>                                  
                                </select>
                    </div>
					<div class="col-md-4 show_report">
						<!--<button type="button" class="all_buttons">Add Seller</button>-->
                    </div>
                   
                     <h4><img src='<?php echo base_url().'images/Solr_Logo_on_white.png' ?>' style="width:70px;height:40px;"> Indexing Of New Products</h4>
				</div>
				 
                <div class="col-md-6 left">
									<!--<form>-->
										<table>
											<tr>
                                            <td></td>
												<td><button type="button" style="background-color:#dc7633;"  class="seller_buttons" onClick="valid_slctsku()" id="selctedproductindex_btn"  ><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;Add Indexing On Selected</button></td>
                                                <!--<td>
                                                <div id="img_info"></div>
                                                <button type="button" style="background-color:#27ae60;" class="seller_buttons" id="solrallindex_btn" onClick="apply_solrindextoall(<?//=//$totrec?>)" ><i class="fa fa-indent" aria-hidden="true"></i>&nbsp;Apply Indexing To All</button></td>-->
											</tr>
										</table>
									<!--</form>-->
								</div>
				<!-------solr process detail start-------------->			
				 <div id="process_div" style="display:none; font-weight:bolder; color:#F00;"> 
                     <img src="<?php echo base_url().'images/Progressbar.gif' ?>" /><br>
                     Please wait , Indexing is on process... </div>
                     <span id="rec_pending_tot">
					<?php 
                    if(@$_GET['indx_status']=='Completed')
					{?>
					 <?php echo "Total Records Completed: " .$totrec."nos."; ?>
                     <?php }else{ ?>
                     <?php echo "Total Records Pending: " .$totrec."nos."; ?>
                     <?php } ?>
                     </span>
                     <span id="rec_indexedprod" style="font-weight:bold; color:#090; display:block;"> </span>
                     <div id="div_solrprocess" >
                     </div>
                  <!-------solr process detail end-------------->
                  
                <div class="clearfix"></div>
                
                <div id="tballisting_divid">  	
                <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				<div>
               
					<table class="table table-bordered">
                     
						<tr class="table table-bordered table-hover" style="background-color:#FC6;color:#FFF;">
							<th class="a-center" width="1%"><input type="checkbox" id="check_all"/></th>
							<th width="1%">Product Id</th>
                            <th width="2%">SKU</th>
							<th width="8%">Name</th>
                            <th width="2%">Solar Index Status</th>
                           <th width="2%">Action</th>
						</tr>
                        
                      <?php $attrb=array('method'=>'GET'); echo form_open('admin/Solar_manage',$attrb); ?>  
                        <tr class="filter_tr">
								<td> </td>
								<td>
									<!--<input type="text" name="product_id" id="product_id" >-->
								</td>
								<td>
									<!--<input type="text" name="prod_sku" id="prod_sku" >-->
								</td>
								<td>
														
								</td>
								<td>
									 <select class="text2" name="indx_status" id="indx_status" required>
										<option value="">--select--</option>
										<option value="Pending">Pending</option>
										<option value="Completed">Completed</option>
										                                           				
								  </select>	
								</td>
                                <td>
                               <button type="submit" style="background-color:#52be80;"  class="seller_buttons" id="indxsearch_btn"  ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                               <button type="button" onClick="window.location.href='<?php echo base_url().'admin/Solar_manage' ?>'" 
                               style="background-color: #ec7063 ;"  class="seller_buttons" id="indxreset_btn"  ><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset</button>
								</td>
							</tr>
						 <?php echo form_close(); ?>
						
						<?php 
                            
							if($solar_indx_info!==false){
							$rows = $solar_indx_info->num_rows();
                            if($rows > 0){$i=1;
                            	foreach ($solar_indx_info->result_array() as $row){
																		
                        ?>
						<tr id="tblrow<?=$i?>"> 
							<td class="a-center">
                            	 <?php if($row['indexing_status']=='Pending' ) {?>
                                <input type="checkbox" name="chk_sku[]" id="chk_sku<?=$i?>" value="<?=$row['sku'] ; ?>"  onClick="select_tblrow(<?=$i?>)">
                                <?php } ?>
							</td>
                            <td><?=$row['product_id'] ; ?></td>
                            <td><?=$row['sku'] ; ?></td>
							<td>
							<span style="float:left;"> 
                                <?php
								$prd_sku=$row['sku'];
								$qr_slrprodimg=$this->db->query("select b.catelog_img_url  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$prd_sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$rw_img=$qr_slrprodimg->row()->catelog_img_url;
								
								 ?>
                                 
                                  <?php if(empty($rw_img)){?>
    							<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="list_img" >
    							<?php }else{?>
                                 <img  class="list_img" src="<?php echo base_url().'images/product_img/'.str_replace('catalog','thumbnil',$rw_img); ?>" >
                                                               
                                 <?php } }else{ ?>
                                 
                                 
                                 <?php if(empty($row['imag'])){?>
    							<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="list_img" >
    							<?php }else{?>
                                <img  class="list_img" src="<?php echo base_url().'images/product_img/'.str_replace('catalog','thumbnil',$row['imag']) ; ?>" >
                                <?php } } ?>
                                </span>
							<?=$row['name'] ; ?></td>
                            <td colspan="2" ><?=$row['indexing_status'] ; ?>
                            <?php if($row['error_msg']!=''){echo "<br>[Error:<span style='color:#F00'> ".$row['error_msg']."</span> ]";} ?>
                            </td>
							
						</tr>
						<?php $i++;}
							 }}
							else{?>
                             <tr>
                            	<td colspan="11">No Record Found!</td>
                            </tr>
                            <?php }?>
					</table>
                   
				</div><!--tballisting_divid end-->
                </div>
              </div>  <!-- @end #main-content -->
            <div id="show"></div>
		</div><!-- @end #content -->
	
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<script>
function apply_solrindexing(){
	var prod_sku = $('input[name="chk_sku[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();	
	
		if(prod_sku == ''){
		alert('Please select any record.');
		return false;
		}
		var ys = confirm("Do you want to change apply indexing.. ?");
		if(ys){
			
			$('#product_action_btn').val('Wait.....');
			$("#loader_div").css('display','block');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/yyy",
				data: {prod_sku:prod_sku},
				success: function () {
					//$("#show").html(data);
					//if(data == 'success'){
						window.location.reload(true);
						$("#loader_div").css('display','none');
					//}
				}
			});
		
		}
		
	
	
}
function select_tblrow(tblrowsl)
{
		
		if(document.getElementById('chk_sku'+tblrowsl).checked== true)
		{
			$("#tblrow"+tblrowsl).css("background-color", "#82e0aa");
			//document.getElementById('prodskuid_chk'+sl).checked='checked';
			
			
		}
		else if(document.getElementById('chk_sku'+tblrowsl).checked== false)
		{
			
			$("#tblrow"+tblrowsl).css("background-color", "");
			//document.getElementById('prodskuid_chk'+sl).checked='';
			
		}		  
	
}

</script>

<script>

function apply_solrindextoall(totrec)
{
	var prod_indexd=0;
	var ys = confirm("Do You Want To Apply Indexing To All.. ?");
		if(ys){
			$("#process_div").css('display','block');
			
			$("#solrallindex_btn").css('display','none');
			$("#tballisting_divid").css('display','none');
			
			$("#rec_pending_tot").css('display','none');
			$("#selctedproductindex_btn").css('display','none');
			
			var prod_sku='test';
			
			for (var i = 1; i <=2; i++) {
            
       		
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url().'admin/Solar_manage/add_solrindex' ?>",
				data: {prod_sku:prod_sku},
				success: function (data) {
					$("#div_solrprocess").html(data);
					//$("#rec_indexedprod").css('display','block');
					prod_indexd=prod_indexd+1;
					$('#rec_indexedprod').html('Total Record Indexed: '+prod_indexd);
					//$("#div_solrprocess").css('display','block');
					
					//$('#div_solrprocess').append(data);
					//$('#div_solrprocess').html('');
					//if(data == 'success'){
						window.location.reload(true);
						$("#process_div").css('display','none');
						
						
						
						
					//}
				}
			});
			
			
			
			}
			
			
		
		}	
}


function valid_slctsku()
{
	
		var order_ids = document.getElementsByName("chk_sku[]");
		var orderid_count=order_ids.length;
		
		var count=0;
		for (var i=0; i<orderid_count; i++) {
			if (order_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		else
		{
			var prod_sku = $('input[name="chk_sku[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
			
			$("#selctedproductindex_btn").css('display','none');
			
			//$("#process_div").css('display','block');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url().'admin/Solar_manage/add_solrindex' ?>",
				data: {prod_sku:prod_sku},
				success: function (data) {
					
						$("#process_div").css('display','none');
						window.location.reload(true);
					
				}
			});
			
				
		}
		
		
			
}
</script>

<script>

function indextypeslct(indx_type)
{	if(indx_type=='Add')
	{
		window.location.href="<?php echo base_url().'admin/Solar_manage' ?>";	
	}
	if(indx_type=='Edit')
	{
		window.location.href="<?php echo base_url().'admin/Solar_manage/edited_productindex' ?>";		
	}
	if(indx_type=='Delete')
	{
		window.location.href="<?php echo base_url().'admin/Solar_manage/removed_productindex' ?>";		
	}
		
}

</script>

<?php
require_once('footer.php');
?>	
				