<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	require_once('header.php');
?>


<style>
.wrapper {
  position: relative; margin:0px; float:none; width:100%;
  cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}
.wrapper .tooltip {
  background: #1496bb;
  bottom: 0;
  color: #fff;
  display: block;
  left: 30px;
  margin-bottom: 0px;
  opacity: 0;
  padding: 10px;
  pointer-events: none;
  position: absolute;
  width: 300px;  text-align: center;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {
  bottom: -20px;
  content: " ";
  display: block;
  height: 20px;
  left: 0;
  position: absolute;
  width: 100%;
}

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after {
  border-left: solid transparent 10px;
  border-right: solid #1496bb 10px;
  border-top: solid transparent 10px;
  border-bottom: solid transparent 10px;
  bottom: 7px;
  content: " ";
  height: 0;
  left: -7px;
  margin-left: -13px;
  position: absolute;
  width: 0;
}
  
.wrapper:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip {
  display: none;
}

.lte8 .wrapper:hover .tooltip {
  display: block;
}
.fa-question-circle {
  font-size: 15px;
}
/*.wrapper{left:5px; top:5px; position:relative;}*/

</style>
<div id="content">
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_sellers.php';?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php';?>
			</div>
		</div>
   <br>  
   <br>    
  <div class="main-content" style="padding:40px 10px;">   
 <div class="row content-header" style="background-color:#099;">
				<h3 style="margin-top:0px;">Bulk Existing Edited Products Upload Log</h3>
   
   
             <div class="exist_prod_new_list" align="right"><button type="button" onclick="window.location.href='<?php echo base_url(). 'admin/Bulkexistingproduct_edit/bulk_existingeditproductupload_panel/'.$seller_id ?>' " style="width:260px;">Bulk Existing Edited Products Upload &nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
</button>  </div>
</div>
		<!-------------------------------------------Listing start--------------------------------------------------------------------->
        
         <div class="col-md-6 left" >	
										
					
					</div>
					
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
					  <div>
						<table class="table table-bordered table-hover">
                       <form action="<?php echo base_url().'admin/sales/filter_order' ?>" method="post" >
                           
							<tr class="table_th">
								
								<th width="5%">Template ID</th>
								<th width="10%">File Name</th>
								<th width="12%">Pending</th>
								<th width="6%">Failed</th>
								<th width="10%">Uploaded</th>
								<th width="10%">Total</th>								
								<th width="10%">Action</th>
							</tr>
							<!--<tr class="filter_tr" >
								
								<td>
									<input type="text" name="order_id" id="order_id" >
								</td>
								<td>
									<input type="text" name="customer_name" id="customer_name" >
								</td>
								<td>
									<input type="text" name="customer_name" id="customer_name" >						
								</td>
								<td>
									<input type="text" name="tot_amount" id="tot_amount" >
								</td>
								<td>
									<div class="purchase">
										<span >From:</span>
										<input type="text" name="order_date_from"   id="datepicker-example7-start1">
									</div>
									<div class="purchase">	
										<span >To:</span>
										<input type="text" name="order_date_to"   id="datepicker-example7-end1">
									</div>
									
								</td>
								<td>
									<div class="purchase">
										<span >From:</span>
										<input type="text" name="status_modified_from"   id="datepicker-example7-start">
									</div>
									<div class="purchase">	
										<span >To:</span>
										<input type="text" name="status_modified_to"   id="datepicker-example7-end">
									</div>
								</td>
                                <td> <input type="submit" class="all_buttons" value="Search" id="search"  /> &nbsp;
							<input type="reset" class="all_buttons" value="Reset Filter" />                               
                                </td>
							</tr>-->
                            
                            </form>
                            <?php if($uploadlist->num_rows()>0){ 
								foreach($uploadlist->result_array() as $res_uploadlist)
								{	
									$upload_id=$res_uploadlist['blk_tempid'];
									$prod_query=$this->db->query("SELECT uploadprod_sqlid,uploadprod_uid,upload_status FROM bulk_existing_editedproductupload_log WHERE uploadprod_uid='$upload_id' AND master_productid!='' AND editstatus='Edited'  ");
									$tot=$prod_query->num_rows();
									$pending=0;
									$upload=0;
									$failed=0;
									foreach($prod_query->result_array() as $res_produploadsts)
									{
										if($res_produploadsts['upload_status']=='Pending')
										{
											$pending++;	
										}
										if($res_produploadsts['upload_status']=='Uploaded')
										{
											$upload++;
										}
										if($res_produploadsts['upload_status']=='Failed')
										{
											$failed++;
										}	
									}
									
							?>
                            <tr> 
                            <td><?=$res_uploadlist['blk_tempid']; ?> </td>
                            <td><a href="<?php echo base_url().'bulk_existingeditedproductexcel/'.$res_uploadlist['excelfile_name']?>"><div class="wrapper"><img src="<?php echo base_url().'images/Excel.png' ?>" width="30" height="30"  title="<?=$res_uploadlist['excelfile_name']; ?>"/><?=$res_uploadlist['excelfile_name']; ?><div class="tooltip">Click to download the file as you have original uploaded</div></div></a><!--<i style="font-size:16px;" class="fa fa-eye"></i>--></td>
                            <td><?=$pending?> </td>                           
                            <td><?=$failed?> </td> 
                            <td><?=$upload?> </td>
                            <td><?=$tot?> </td>
                            <td><?php if($failed>0 || $pending>0){ ?>
                                                    
                                                   <?php /*?><button id="faild_product" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'admin/download_bulkproducttemp/generate_failedproductexcelsheet/'.$res_uploadlist['blk_tempid'].'/'.$res_uploadlist['category_id'].'/'.$res_uploadlist['attribute_set'].'/'.$seller_id ?>' " title="Download Failed Or Pending Product Excel Sheet" ><i class="fa fa-download" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Download</button><?php */?>
												   
												   <?php } ?>
                            
                            </td>
                            </tr>
                           <?php
								} // forloop end 
						    } else { ?>
							<tr><td colspan="9" class="a-center">No Uploaded File Found ! </td></tr>
                            <?php } ?> 
					  </table>
                        

   		<!------------------------------------------Listing End------------------------------------------------------------------------->
                
	</div> <!-- end of rowcontent-header div -->
</div> <!-- end of main-content div -->


<?php
	require_once('footer.php');
?>                      