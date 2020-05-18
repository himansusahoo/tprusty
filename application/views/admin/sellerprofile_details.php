<?php
require_once('header.php');
?>
<!--- colorbox script start here--->
<link rel="stylesheet" href="<?php echo base_url();?>colorbox/colorbox.css" />
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!--<script src="../jquery.colorbox.js"></script>-->
<script src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".group3").colorbox({rel:'group3', transition:"none", width:"60%", height:"75%"});

		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
<!--- colorbox script end here--->
<style>
.cboxPhoto{
    cursor: pointer;
    float: none;
    height: 300px !important;
    margin-top: 78px !important;
    width: 450px !important;
}
#cboxTitle{
	color: #000;
    display: block;
    float: left;
    font-weight: 600;
    left: 50% !important;
    position: absolute !important;
    top: 400px !important;
}
#cboxCurrent{
	display:none !important;
}
#cboxPrevious,#cboxNext{display:none !important;}
.udt{ display:none;}
</style>

		<div id="content">
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_sellersprofile.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
					<?php $qr1=$this->db->query("SELECT *
FROM seller_account_information WHERE seller_id = '$seller_id'"); 
									$rw1=$qr1->row();
									?>
					<div class="row content-header" style="background-color:#9CF;">
						<h4 class="col-md-6" >Profile Of Seller:  <?php echo $rw1 ? $rw1->business_name : "Not Available"; ?> <span id="ajxtst"></span></h4>
						
                        
                        
					</div>
					<?php /*?><a class="right" style="text-align:right;" href="<?php echo base_url().'admin/sellers/addnew_product_for_seller/'.$seller_id;?>" title="Add New Product"><i style="font-size:25px;" class="fa fa-plus-square"></i></a><?php */?>
                    
                    <a class="right" style="text-align:right;" href="<?php echo base_url().'admin/upload_bulkproduct/bulkproductupload_forseller/'.$seller_id;?>" title="Add New Product"><i style="font-size:25px;" class="fa fa-plus-square"></i></a>
					 <br>
              <?php /*?><span style="float:right;">                          
                 <a id="product_submit" class='seller_buttons' href="<?php echo base_url().'admin/Bulkproduct_edit/bulkproduct_editpanel/'.$seller_id ?>" style="cursor:pointer;" >
           				<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Edit Bulk New Products 
           		</a>
            </span> <?php */?>
					
                    
                <?php /*?><span style="float:left;">                          
                 <a  id="product_submit" class='seller_buttons' href="<?php echo base_url().'admin/Bulkexistingproduct_edit/bulk_existingproductedit_forseller/'.$seller_id ?>" style="cursor:pointer; background-color:#0C6;" >
           				<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Edit Bulk Existing Products 
           		</a>
                <br> <br>
                <a id="exportproduct" class='seller_buttons' href="<?php echo base_url().'admin/sellers/exportseller_products/'.$seller_id ?>" style="cursor:pointer; float:left"  >
           				<i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export Seller Products 
           		</a>
            </span> <?php */?>
					
                    <div class="a-center" id="ajax_res"></div>
                    <div class="clearfix"></div>
                   	
                  
			<ul class="nav nav-tabs tabs-horiz">
            
				<li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Seller Primary Details</a></li>
				<li id="li_tab2"><a data-toggle="tab" href="#tab2">Seller Personal Details</a></li>
				<li id="li_tab3"><a data-toggle="tab" href="#tab3">Seller Account Details</a></li>
				<!--<li id="li_tab4"><a data-toggle="tab" href="#tab4">Seller Business Documents</a></li>-->
               	<!--<li id="li_tab5"><a data-toggle="tab" href="#tab5">Seller Products</a></li>-->
                <li id="li_tab6"><a data-toggle="tab" href="#tab6"> KYC Details</a></li>
                <li id="li_tab7"><a data-toggle="tab" href="#tab7">Store Details</a></li>
                 <a id="product_submit" class='seller_buttons' href="<?php echo base_url().'admin/sellers/seller_products_forbdm/'.$seller_id ?>" style="cursor:pointer; float:right" target="_blank" >
           				<i class="fa fa-list-alt" aria-hidden="true" style="color:#FFF;"></i> &nbsp;View All Products 
           		</a>
                
                
                
			</ul>
            
           
			<div id="ajax_res"></div>
			<div id="validate_msg" class="a-center" style="color:red;"></div>
			<?php if ($this->session->flashdata('msg1')) { ?>
				<div class="a-center" style="color:red;"> <?= $this->session->flashdata('msg1') ?> </div>
			<?php } ?>
            <div class="tab-content form_view">
				<div id="tab1" class="tab-pane fade in active">
					
					<h3>Seller Primary Details</h3>
						<table class="table table-bordered table-hover">
                       
								    
                                <tr>
									<td> Seller Primary Name:</td>
									<td> 
                                      <span class="slrp1"><?php echo $rw1 ? $rw1->pname : "Not Available"; ?></span>
                                      <span class="updt_slrp1" style="display:none;"></span>
                                      <input type="text" name="slr_pname" class="hidden_input slrinf1" value="<?php echo $rw1 ? $rw1->pname : ""; ?>">
                                      <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer1" style="display:none;float:right" /> </span>
                                      <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader1" style="display:none;float:right" /> </span>
                                      
                                     </td>
                                     <td>
                                     	<span class="edt pedit1" onClick="editSlrInfo(<?=$seller_id;?>,1);">Edit</span>
                                        <span class="edt updt1 udt" onClick="updateSlrInfo(<?=$seller_id;?>,1);">Update</span>
                                     </td>
								</tr>
                                 <tr>
									<td> Seller Primary Email ID: </td>
									<td>
										<span class="slrp2"><?php echo $rw1 ? $rw1->pemail : "Not Available"; ?></span>
                                        <span class="updt_slrp2" style="display:none;"></span>
                                        <input type="text" name="slr_pemail" class="hidden_input slrinf2" value="<?php echo $rw1 ? $rw1->pemail : ""; ?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer2" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader2" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit2" onClick="editSlrInfo(<?=$seller_id;?>,2);">Edit</span>
                                        <span class="edt updt2 udt" onClick="updateSlrInfo(<?=$seller_id;?>,2);">Update</span>
                                    </td>
								</tr>
                                
                                <tr>
									<td> Seller Primary Number:</td>
									<td>
										<span class="slrp3"><?php echo $rw1 ? $rw1->pmobile : "Not Available"; ?></span>
                                        <span class="updt_slrp3" style="display:none;"></span>
                                    	<input type="text" name="slr_pmobile" maxlength="10" class="hidden_input slrinf3" value="<?php echo $rw1 ? $rw1->pmobile : ""; ?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer3" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader3" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit3" onClick="editSlrInfo(<?=$seller_id;?>,3);">Edit</span>
                                        <span class="edt updt3 udt" onClick="updateSlrInfo(<?=$seller_id;?>,3);">Update</span>
                                    </td>
								</tr>
                                
                                <tr>
									<td> Seller Business Name: </td>
									<td>
										<span class="slrp4"><?php echo $rw1 ? $rw1->business_name : "Not Available"; ?></span>
                                        <span class="updt_slrp4" style="display:none;"></span>
                                        <input type="text" name="slr_pmobile" class="hidden_input slrinf4" value="<?php echo $rw1 ? $rw1->business_name : ""; ?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer4" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader4" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit4" onClick="editSlrInfo(<?=$seller_id;?>,4);">Edit</span>
                                        <span class="edt updt4 udt" onClick="updateSlrInfo(<?=$seller_id;?>,4);">Update</span>
                                    </td>
								</tr>
                                 <tr>
									<td> Seller Business Description: </td>
									<td>
										<span class="slrp5"><?php echo $rw1 ? $rw1->business_desc : "Not Available"; ?></span>
                                        <span class="updt_slrp5" style="display:none;"></span>
                                        <textarea name="slr_business_desc" class="hidden_input slrinf5"><?php echo $rw1 ? $rw1->business_desc : ""; ?></textarea>
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer5" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader5" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit5" onClick="editSlrInfo(<?=$seller_id;?>,5);">Edit</span>
                                        <span class="edt updt5 udt" onClick="updateSlrInfo(<?=$seller_id;?>,5);">Update</span>
                                    </td>
								</tr>
                                <?php 
                                $qr4=$this->db->query("SELECT a.*,a.tan AS TAN_NO
                                FROM seller_account_information a LEFT JOIN seller_account b ON a.seller_id = b.seller_id
                                WHERE a.seller_id='$seller_id'"); 
                                $rw4=$qr4->row();
                            ?>  
								<tr>
									<td>PAN CARD :</td>
									<td>
                                    <div id="imgdv19">
									<?php if($rw4){ ?>
									<a class="group3" href="<?php echo base_url().'images/seller_image_doc/'.$rw4->pan_img; ?>" title="<?=$rw4->pan;?>">
                                    	<img src="<?php echo base_url().'images/seller_image_doc/'.$rw4->pan_img; ?>" width="30" class="list_img">
                                        <br/><strong><?=$rw4->pan;?></strong>
                                    </a>
									<?php }else{ echo "Not Available"; }?>
                                    </div>
                                    <?php
									$attributes = array('id' => 'imgform19','class' => 'slrimgfrm');
									echo form_open_multipart('admin/sellers/update_slr_proof', $attributes);
									?>
                                    	<input type="hidden" name="fldnm" value="pan">
                                        <input type="hidden" name="slr_id" value="<?=$seller_id;?>">
                                    	Pan Card Img : <input type="file" name="userfile" id="seller_panimg19" style="display:inline;"><br/>
                                        Pan Card Number : <input type="text" name="cardno" id="seller_panno19" class="hidden_inputfld" value="<?php echo $rw4 ? $rw4->pan:'';?>">
                                        <input type="submit" name="submit" value="Update" onClick="return validate_panform()">
                                    <?php echo form_close();?>
									</td>
                                    <td>
                                    	<span class="edt pedit19" onClick="editSlrImgInfo(19);">Edit</span>
                                    </td>
								</tr>
                                
								<tr>
									<td>TIN NO. :</td>
									<td>
                                    <div id="imgdv20">
									<?php if($rw4){ ?>
                                    <a class="group3" href="<?php echo base_url().'images/seller_image_doc/'.$rw4->tin_img; ?>" title="<?=$rw4->tin;?>">
										<img src="<?php echo base_url().'images/seller_image_doc/'.$rw4->tin_img; ?>" width="30" class="list_img">
                                        <br/><strong><?=$rw4->tin;?></strong>
                                    </a>
									<?php }else{ echo "Not Available"; }?>
                                    </div>
                                    	<?php
										$attributes = array('id' => 'imgform20','class' => 'slrimgfrm');
										echo form_open_multipart('admin/sellers/update_slr_proof', $attributes);
										?>
                                    	<input type="hidden" name="fldnm" value="tin">
                                        <input type="hidden" name="slr_id" value="<?=$seller_id;?>">
                                    	Tin Card Img : <input type="file" name="userfile" id="seller_tinimg20" style="display:inline;"><br/>
                                        Tin Number : <input type="text" name="cardno" id="seller_tinno20" class="hidden_inputfld" value="<?php echo $rw4 ? $rw4->tin:'';?>">
                                        <input type="submit" name="submit" value="Update" onClick="return validate_tinform()">
                                    <?php echo form_close();?>
									</td>
                                    <td>
                                    	<span class="edt pedit20" onClick="editSlrImgInfo(20);">Edit</span>
                                    </td>
								</tr>
								<!--<?php// if(@$rw4->TAN_NO) { ?>-->
                                 <tr>
									<td>TAN ID :</td>
									<td>
                                    <div id="imgdv21">
									<?php if($rw4){ ?>
                                    <a class="group3" href="<?php echo base_url().'images/seller_image_doc/'.$rw4->tan_img; ?>" title="<?=$rw4->TAN_NO;?>">
										<img src="<?php echo base_url().'images/seller_image_doc/'.$rw4->tan_img; ?>" width="30" class="list_img">
                                        <br/><strong><?=$rw4->TAN_NO;?></strong>
                                    </a>
									<?php }else{ echo "Not Available"; }?>
                                    </div>
                                    <?php
									$attributes = array('id' => 'imgform21','class' => 'slrimgfrm');
									echo form_open_multipart('admin/sellers/update_slr_proof', $attributes);
									?>
                                    	<input type="hidden" name="fldnm" value="tan">
                                        <input type="hidden" name="slr_id" value="<?=$seller_id;?>">
                                    	Tan Card Img : <input type="file" name="userfile" id="seller_tanimg21" style="display:inline;"><br/>
                                        Tan Number : <input type="text" name="cardno" id="seller_tanno21" class="hidden_inputfld" value="<?php echo $rw4 ? $rw4->TAN_NO:'';?>">
                                        <input type="submit" name="submit" value="Update" onClick="return validate_tanform()">
                                    <?php echo form_close();?>
									</td>
                                    <td><span class="edt pedit21" onClick="editSlrImgInfo(21);">Edit</span></td>
								</tr>
								<!--<?php// } ?>-->
<!----------------------------sujit start fimdr45nm------------------------------>                              
                                
                                <tr>
									<td>GSTIN:</td>
									<td>
                                    <div id="imgdv211">
									<?php if($rw4->gstin_img){ ?>
                                    <a class="group3" href="<?php echo base_url().'images/seller_image_doc/'.$rw4->gstin_img; ?>" title="<?=$rw4->gstin;?>">
										<img src="<?php echo base_url().'images/seller_image_doc/'.$rw4->gstin_img; ?>" width="30" class="list_img"><?php }?>
                                       </a>
                                        
                                    <br/>
                                    <?php if($rw4->gstin){?>
                                    <strong><?=$rw4->gstin;?></strong>
									<?php }if($rw4->gstin_img==""  && $rw4->gstin==""){ echo "Not Available"; }?>
                                    </div>
                                    <?php
									$attributes = array('id' => 'imgform211','class' => 'slrimgfrm');
									echo form_open_multipart('admin/sellers/update_slr_proof', $attributes);
									?>
                                    	<input type="hidden" name="fldnm" value="gstin">
                                        <input type="hidden" name="slr_id" value="<?=$seller_id;?>">
                                    	GSTIN Img : <input type="file" name="userfile" id="seller_gstinimg211" style="display:inline;"><br/>
                                        GSTIN Number : <input type="text" name="cardno" id="seller_gstinno211" class="hidden_inputfld" value="<?php echo $rw4 ? $rw4->gstin:'';?>">
                                        <input type="submit" name="submit" value="Update" onClick="return validate_gstinform()">
                                    <?php echo form_close();?>
									</td>
                                    <td><span class="edt pedit211" onClick="editSlrImgInfo(211);">Edit</span></td>
								</tr>
                                
<!------------------------------------------------sujit end---------------------------------->                                
							</table>
				</div>
				<div id="tab2" class="tab-pane fade">
					<h3>Seller Personal Details</h3>
						<table class="table table-bordered table-hover">
								    <?php $qr2=$this->db->query("select * from seller_account where seller_id='$seller_id' "); 
											$rw2=$qr2->row();
											
									?>                         
                                <tr>
									<td> Seller Name:</td>
									<td>
										<span class="slrp6"><?php echo $rw2->name; ?></span>
                                        <span class="updt_slrp6" style="display:none;"></span>
                                        <input type="text" name="slr_prename" class="hidden_input slrinf6" value="<?php echo $rw2->name;?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer6" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader6" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit6" onClick="editSlrInfo(<?=$seller_id;?>,6);">Edit</span>
                                        <span class="edt updt6 udt" onClick="updateSlrInfo(<?=$seller_id;?>,6);">Update</span>
                                    </td>
								</tr>
                                 <tr>
									<td> Seller Email ID: </td>
									<td>
										<span class="slrp7"><?php echo $rw2->email; ?></span>
                                        <span class="updt_slrp7" style="display:none;"></span>
                                        <input type="text" name="slr_premail" class="hidden_input slrinf7" value="<?php echo $rw2->email;?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer7" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader7" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit7" onClick="editSlrInfo(<?=$seller_id;?>,7);">Edit</span>
                                        <span class="edt updt7 udt" onClick="updateSlrInfo(<?=$seller_id;?>,7);">Update</span>
                                    </td>
								</tr>
                                 <tr>
									<td> Seller Registration Date: </td>
									<td> <?php echo $rw2->register_date; ?></span></td>
                                    <td>&nbsp;</td>
								</tr>
                                <tr>
									<td> Seller Phone Number:</td>
									<td>
                                    	<span class="slrp8"><?php echo $rw2->mobile; ?></span>
                                        <span class="updt_slrp8" style="display:none;"></span>
                                        <input type="text" name="slr_premob" maxlength="10" class="hidden_input slrinf8" value="<?php echo $rw2->mobile;?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer8" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader8" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit8" onClick="editSlrInfo(<?=$seller_id;?>,8);">Edit</span>
                                        <span class="edt updt8 udt" onClick="updateSlrInfo(<?=$seller_id;?>,8);">Update</span>
                                    </td>
								</tr>
                                
                                <tr>
									<td> Seller Address: </td>
									<td>
										<span class="slrp9"><?php echo $rw2->seller_address; ?></span>
                                        <span class="updt_slrp9" style="display:none;"></span>
                                        <textarea name="slr_preadrs" class="hidden_input slrinf9"><?php echo $rw2->seller_address;?></textarea>
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer9" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader9" style="display:none;float:right" /> </span>
                                        
                                    </td>
                                    <td>
                                    	<span class="edt pedit9" onClick="editSlrInfo(<?=$seller_id;?>,9);">Edit</span>
                                        <span class="edt updt9 udt" onClick="updateSlrInfo(<?=$seller_id;?>,9);">Update</span>
                                    </td>
								</tr>
                                 <tr>
									<td> City: </td>
									<td>
										<span class="slrp10"><?php echo $rw2->seller_city; ?></span>
                                        <span class="updt_slrp10" style="display:none;"></span>
                                        <input type="text" name="slr_precty" class="hidden_input slrinf10" value="<?php echo $rw2->seller_city;?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer10" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader10" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit10" onClick="editSlrInfo(<?=$seller_id;?>,10);">Edit</span>
                                    	<span class="edt updt10 udt" onClick="updateSlrInfo(<?=$seller_id;?>,10);">Update</span>
                                    </td>
								</tr>
                                <tr>
									<td> Pin: </td>
									<td>
										<span class="slrp11"><?php echo $rw2->pincode; ?></span>
                                        <span class="updt_slrp11" style="display:none;"></span>
                                        <input type="text" name="slr_precty" class="hidden_input slrinf11" value="<?php echo $rw2->pincode;?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer11" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader11" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit11" onClick="editSlrInfo(<?=$seller_id;?>,11);">Edit</span>
                                    	<span class="edt updt11 udt" onClick="updateSlrInfo(<?=$seller_id;?>,11);">Update</span>
                                    </td>
								</tr>
                                <tr>
									<td> State: </td>
									<td>
										<span class="slrp12"><?php echo $rw2->seller_state; ?></span>
                                        <span class="updt_slrp12" style="display:none;"></span>
                                        <!--<input type="text" name="slr_prestate" class="hidden_input slrinf12" value="<?php// echo $rw2->seller_state;?>">-->
                                        <select class="hidden_input slrinf12" name="slr_prestate" >
                                        	<option value="<?php echo $rw2->seller_state;?>"><?php echo $rw2->seller_state;?></option>
                                            <?php 
												$query = $this->db->query("select * from state");  
												$rows = $query->num_rows();
												if($rows > 0){
													foreach($query->result() as $rs){
													?>
                                                    	<option value="<?=$rs->state?>"><?=$rs->state?></option>
                                                    <?php
													}
												}
											?>
                                        </select>
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer12" style="display:none;float:left" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader12" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit12" onClick="editSlrInfo(<?=$seller_id;?>,12);">Edit</span>
                                    	<span class="edt updt12 udt" onClick="updateSlrInfo(<?=$seller_id;?>,12);">Update</span>
                                    </td>
								</tr>
							</table>
                            
				</div>
				<div id="tab3" class="tab-pane fade">
					<h3>Seller Account Details</h3>
						<table class="table table-bordered table-hover">
                         		<?php 
								$qr3=$this->db->query("SELECT a.* 
								FROM seller_account_information a LEFT JOIN seller_account b ON a.seller_id = b.seller_id
								WHERE a.seller_id='$seller_id'"); 
								$slr_acnt_info_row = $qr3->num_rows();
								$rw3=$qr3->row();
								?>  
								<tr>
									<td> Seller Name: </td>
									<td>
										<span class="slrp13"><?php echo $rw3 ? $rw3->pname : "Not Available"; ?></span>
                                        <span class="updt_slrp13" style="display:none;"></span>
                                        <input type="text" name="slr_prestate" class="hidden_input slrinf13" value="<?php echo $rw3 ? $rw3->pname:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer13" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader13" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit13" onClick="editSlrInfo(<?=$seller_id;?>,13);">Edit</span>
                                        <span class="edt updt13 udt" onClick="updateSlrInfo(<?=$seller_id;?>,13);">Update</span>
                                    </td>
								</tr>
								<tr>
									<td> Account Holder Name:</td>
									<td>
										<span class="slrp14"><?php echo $rw3 ? $rw3->ac_holder_name : "Not Available"; ?></span>
                                        <span class="updt_slrp14" style="display:none;"></span>
                                        <input type="text" name="slr_prestate" class="hidden_input slrinf14" value="<?php echo $rw3 ? $rw3->ac_holder_name:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer14" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader14" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit14" onClick="editSlrInfo(<?=$seller_id;?>,14);">Edit</span>
                                        <span class="edt updt14 udt" onClick="updateSlrInfo(<?=$seller_id;?>,14);">Update</span>
                                    </td>
								</tr>
                                
                               <tr>
									<td> Account Number:</td>
									<td>
										<span class="slrp15"><?php echo $rw3 ? $rw3->ac_number : "Not Available"; ?></span>
                                        <span class="updt_slrp15" style="display:none;"></span>
                                    	<input type="text" name="slr_prestate" class="hidden_input slrinf15" value="<?php echo $rw3 ? $rw3->ac_number:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer15" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader15" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit15" onClick="editSlrInfo(<?=$seller_id;?>,15);">Edit</span>
                                        <span class="edt updt15 udt" onClick="updateSlrInfo(<?=$seller_id;?>,15);">Update</span>
                                    </td>
								</tr>
                                 <tr>
									<td> IFSC Code:</td>
									<td>
										<span class="slrp16"><?php echo $rw3 ? $rw3->ifsc_code : "Not Available"; ?></span>
                                        <span class="updt_slrp16" style="display:none;"></span>
                                        <input type="text" name="slr_prestate" class="hidden_input slrinf16" value="<?php echo $rw3 ? $rw3->ifsc_code:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer16" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader16" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit16" onClick="editSlrInfo(<?=$seller_id;?>,16);">Edit</span>
                                        <span class="edt updt16 udt" onClick="updateSlrInfo(<?=$seller_id;?>,16);">Update</span>
                                    </td>
								</tr>
                                <tr>
									<td> Bank Name:</td>
									<td>
										<span class="slrp17"><?php echo $rw3 ? $rw3->bank : "Not Available"; ?></span>
                                        <span class="updt_slrp17" style="display:none;"></span>
                                    	<input type="text" name="slr_prestate" class="hidden_input slrinf17" value="<?php echo $rw3 ? $rw3->bank:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer17" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader17" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit17" onClick="editSlrInfo(<?=$seller_id;?>,17);">Edit</span>
                                        <span class="edt updt17 udt" onClick="updateSlrInfo(<?=$seller_id;?>,17);">Update</span>
                                    </td>
								</tr>
                                <tr>
									<td> Branch Name:</td>
									<td>
										<span class="slrp18"><?php echo $rw3 ? $rw3->branch : "Not Available"; ?></span>
                                        <span class="updt_slrp18" style="display:none;"></span>
                                        <input type="text" name="slr_prestate" class="hidden_input slrinf18" value="<?php echo $rw3 ? $rw3->branch:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer18" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader18" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit18" onClick="editSlrInfo(<?=$seller_id;?>,18);">Edit</span>
                                        <span class="edt updt18 udt" onClick="updateSlrInfo(<?=$seller_id;?>,18);">Update</span>
                                    </td>
								</tr>
                               <tr>
                               <tr>
									<td> City:</td>
									<td>
										<span class="slrp22"><?php echo $rw3 ? $rw3->city : "Not Available"; ?></span>
                                        <span class="updt_slrp22" style="display:none;"></span>
                                        <input type="text" name="slr_prestate" class="hidden_input slrinf22" value="<?php echo $rw3 ? $rw3->city:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer22" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader22" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit22" onClick="editSlrInfo(<?=$seller_id;?>,22);">Edit</span>
                                        <span class="edt updt22 udt" onClick="updateSlrInfo(<?=$seller_id;?>,22);">Update</span>
                                    </td>
								</tr>
									<td> State:</td>
									<td>
                                    
										<span class="slrp23"><?php echo $rw3 ? $rw3->state : "Not Available"; ?></span>
                                        <span class="updt_slrp23" style="display:none;"></span>
                                    	<!--<input type="text" name="slr_prestate" class="hidden_input slrinf23" value="<?php// echo $rw3 ? $rw3->state:'';?>">-->
                                        <select class="hidden_input slrinf23" name="slr_prestate" >
                                        	<option value="<?php echo $rw3 ? $rw3->state:'';?>"><?php echo $rw3 ? $rw3->state:'';?></option>
                                            <?php 
												$query = $this->db->query("select * from state");  
												$rows = $query->num_rows();
												if($rows > 0){
													foreach($query->result() as $rs){
													?>
                                                    	<option value="<?=$rs->state?>"><?=$rs->state?></option>
                                                    <?php
													}
												}
											?>
                                        </select>
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer23" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader23" style="display:none;float:right" /> </span>
                                        <!--<select name="slr_prestate" class="hidden_input slrinf23">
                                        			<option value="<?php// echo $rw3 ? $rw3->state:'';?>"><?php// echo $rw3 ? $rw3->state:'';?></option>					
                                        </select>-->
                                    </td>
                                    <td>
                                    	<span class="edt pedit23" onClick="editSlrInfo(<?=$seller_id;?>,23);">Edit</span>
                                        <span class="edt updt23 udt" onClick="updateSlrInfo(<?=$seller_id;?>,23);">Update</span>
                                    </td>
								</tr>
							</table>
				</div>
			
				<?php /*?><div id="tab5" class="tab-pane fade">
<?php
 
//$qr1=$this->db->query("SELECT product_id, name, imag, mrp, prod_status as approve_status,sku
//FROM cornjob_productsearch 
//WHERE seller_id = '$seller_id' GROUP BY sku ORDER BY product_id DESC");
//if($qr1->num_rows()==0)
//{
$qr1=$this->db->query("SELECT b.product_id, c.name, d.imag, b.mrp, b.approve_status, b.sku
FROM seller_account a
INNER JOIN product_master b ON a.seller_id = b.seller_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE a.seller_id = '$seller_id' GROUP BY b.sku ORDER BY b.product_id DESC  LIMIT 100");
//}
?>  
					<h3>Product Details </h3>
                    
                    
                   
					<table class="table table-bordered table-hover">
						<tr>
							<td width="10%">Product Id</td>
							<td width="20%">Product Name</td>
							<td width="10%">Product Image</td>
							<td width="10%">MRP</td>
							<td width="10%">Status</td>
							<td width="40%" colspan="2">Action</td>
						</tr>
							<?php
								$product_row = $qr1->num_rows();
								$j = 0;
								if($product_row > 0){
								foreach($qr1->result() as $product){
								$j++;
								$cdate = date('Y-m-d');
								$image_cart=explode(',',$product->imag);
							?>
						<tr>
							<td> <?php echo $product->product_id; ?> </td>
							<td> <?php echo $product->name; ?> </td>
							<td> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku;?>" target="_blank">
							<?php 
									$qr_slrprodimg=$this->db->query("select b.image  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$product->sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$rw_img=$qr_slrprodimg->row()->image;
									$image_cart=explode(',',$rw_img);
								
							  ?>	
                                 <img  class="list_img" src="<?php echo base_url().'images/product_img/catalog_'.$image_cart[0]; ?>" width="30" >
                                <?php }else{ ?>
                                <img src="<?php echo base_url().'images/product_img/catalog_'.$image_cart[0]; ?>" width="30" class="list_img">
                                <?php } ?>
                                
                                </a>							
							</td>
							<td> <?php echo $product->mrp; ?> </td>
							<td> <?php echo $product->approve_status; ?> </td>
							<td>
								<select id="product_status<?=$j?>" onchange="change_product_status(this.value, <?=$j?>)" style="vertical-align: top;">
									<option value="">--Select Status--</option>
									<option value="Active">Active</option>
									<option value="Suspended">Blocked</option>
									<option value="Rejected">Permanently Blocked</option>
								</select>
								<textarea rows="5" cols="40" class="reason_block" id="reason_block<?=$j?>"></textarea>
								<button class="reason_block_btn" id="pro_inactiv_btn<?=$j?>" onclick="do_save_reject_pro(<?=$product->product_id?>, '<?=$product->sku?>', <?=$j?>)">Save</button>
							</td>
                            <td><a href="<?php echo base_url(); ?>admin/catalog/product_edit/<?=$product->product_id;?>/<?= base64_encode($this->encrypt->encode($product->sku));?>"target="_blank">Edit</a></td>
						</tr>
							<?php }}else{ ?>
						<tr>
							<td class="a-center" colspan="6">No record found!</td>
						</tr>
							<?php } ?>
					</table>
				</div><?php */?>
                <div id="tab6" class="tab-pane fade">
                	<h3>KYC Details</h3>
                   	<table class="table table-bordered table-hover">
							 <?php 
                                $qr4=$this->db->query("SELECT a.*,a.tan AS TAN_NO
                                FROM seller_account_information a LEFT JOIN seller_account b ON a.seller_id = b.seller_id
                                WHERE a.seller_id='$seller_id'"); 
                                $rw4=$qr4->row();
                            ?>  
								<tr>
									<td>Address Proof* :</td>
									<td>
                                    <div id="imgdv25">
									<?php if($rw4){ ?>
									<a class="group3" href="<?php echo base_url().'images/seller_image_doc/'.$rw4->address_img; ?>" title="address_proof">
                                    	<img src="<?php echo base_url().'images/seller_image_doc/'.$rw4->address_img; ?>" width="30" class="list_img">
                                        
                                    </a>
									<?php }else{ echo "Not Available"; }?>
                                    </div>
                                    <?php
									$attributes = array('id' => 'imgform25','class' => 'slrimgfrm');
									echo form_open_multipart('admin/sellers/update_kyc_details', $attributes);
									?>
                                    	<input type="hidden" name="fldnm" value="address_img">
                                        <input type="hidden" name="slr_id" value="<?=$seller_id;?>">
                                    	Address Proof Img: <input type="file" name="userfile" id="address_proofimg25" style="display:inline;"><br/>
                                       <input type="submit" name="submit" value="Update" onClick="return validate_addproof()">
                                    <?php echo form_close();?>
									</td>
                                    <td>
                                    	<span class="edt pedit25" onClick="editSlrImgInfo(25);">Edit</span>
                                    </td>
								</tr>
                                
								<tr>
									<td>ID Proof* :</td>
									<td>
                                    <div id="imgdv26">
									<?php if($rw4){ ?>
                                    <a class="group3" href="<?php echo base_url().'images/seller_image_doc/'.$rw4->ID_img; ?>" title="<?=$rw4->tin;?>">
										<img src="<?php echo base_url().'images/seller_image_doc/'.$rw4->ID_img; ?>" width="30" class="list_img">
                                        <br/>
                                    </a>
									<?php }else{ echo "Not Available"; }?>
                                    </div>
                                    
                                    
                                    
                                    	<?php
										$attributes = array('id' => 'imgform26','class' => 'slrimgfrm');
										echo form_open_multipart('admin/sellers/update_kyc_details', $attributes);
										?>
                                    	<input type="hidden" name="fldnm" value="id_proof">
                                        <input type="hidden" name="slr_id" value="<?=$seller_id;?>">
                                    	ID Proof Img: <input type="file" name="userfile" id="id_proofimg26" style="display:inline;"><br/>
                                        <input type="submit" name="submit" value="Update" onClick="return validate_idproof()">
                                    <?php echo form_close();?>
                                   	</td>
                                    <td>
                                    	<span class="edt pedit26" onClick="editSlrImgInfo(26);">Edit</span>
                                    </td>
								</tr>
								<!--<?php// if(@$rw4->TAN_NO) { ?>-->
                                 <tr>
									<td>Cancelled Cheque* :</td>
									<td>
                                    <div id="imgdv27">
									<?php if($rw4){ ?>
                                    <a class="group3" href="<?php echo base_url().'images/seller_image_doc/'.$rw4->Cheque_img; ?>" title="<?=$rw4->TAN_NO;?>">
										<img src="<?php echo base_url().'images/seller_image_doc/'.$rw4->Cheque_img; ?>" width="30" class="list_img">
                                        <br/>
                                    </a>
									<?php }else{ echo "Not Available"; }?>
                                    </div>
                                    <?php
									$attributes = array('id' => 'imgform27','class' => 'slrimgfrm');
									echo form_open_multipart('admin/sellers/update_kyc_details', $attributes);
									?>
                                    	<input type="hidden" name="fldnm" value="cancle_cheque">
                                        <input type="hidden" name="slr_id" value="<?=$seller_id;?>">
                                    	Cancelled Cheque Img* : <input type="file" name="userfile" id="cancelled_chequeimg27" style="display:inline;"><br/>
                                        <input type="submit" name="submit" value="Update" onClick="return validate_cancheque()">
                                    <?php echo form_close();?>
									</td>
                                    <td><span class="edt pedit27" onClick="editSlrImgInfo(27);">Edit</span></td>
								</tr>
								<!--<?php// } ?>-->
                                
							</table>
                    
				</div>
                <div id="tab7" class="tab-pane fade">
					<h3>Store Details</h3>
						<table class="table table-bordered table-hover">
                         		<?php 
								$qr3=$this->db->query("SELECT a.* 
								FROM seller_account_information a LEFT JOIN seller_account b ON a.seller_id = b.seller_id
								WHERE a.seller_id='$seller_id'"); 
								$slr_acnt_info_row = $qr3->num_rows();
								$rw3=$qr3->row();
								?>  
								<tr>
									<td> Display name*: </td>
									<td>
										<span class="slrp28"><?php echo $rw3 ? $rw3->display_name : "Not Available"; ?></span>
                                        <span class="updt_slrp28" style="display:none;"></span>
                                        <input type="text" name="slr_prestate" class="hidden_input slrinf28" value="<?php echo $rw3 ? $rw3->display_name:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer28" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader28" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit28" onClick="editSlrInfo(<?=$seller_id;?>,28);">Edit</span>
                                        <span class="edt updt28 udt" onClick="updateSlrInfo(<?=$seller_id;?>,28);">Update</span>
                                    </td>
								</tr>
								<tr>
									<td> Store Description*:</td>
									<td>
										<span class="slrp29"><?php echo $rw3 ? $rw3->store_description : "Not Available"; ?></span>
                                        <span class="updt_slrp29" style="display:none;"></span>
                                        <input type="text" name="slr_prestate" class="hidden_input slrinf29" value="<?php echo $rw3 ? $rw3->store_description:'';?>">
                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer29" style="display:none;float:right" /> </span>
                                        <span>  <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader29" style="display:none;float:right" /> </span>
                                    </td>
                                    <td>
                                    	<span class="edt pedit29" onClick="editSlrInfo(<?=$seller_id;?>,29);">Edit</span>
                                        <span class="edt updt29 udt" onClick="updateSlrInfo(<?=$seller_id;?>,29);">Update</span>
                                    </td>
								</tr>
                                
                               
								</tr>
							</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 show_report">
					
				</div>
			</div>	
		</div>
    </div>
    <div class="clearfix"></div>
            <!-- @end #right-content -->

			<!--</div>--><!-- @end #content -->
</div><!-- @end #w -->


<style>
.dt {
    width: 150px;
}
.Zebra_DatePicker_Icon{left: 130px !important;}
</style>



<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">-->
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->




<!---script start for Checking for unique SKU--->

			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->
		
<script>
	function change_product_status(status, j){
		if(status == 'Rejected'){
			$('#reason_block'+j).show();
			//$('#pro_inactiv_btn'+j).show();
		}else if(status == 'Suspended'){
			$('#reason_block'+j).show();
			//$('#pro_inactiv_btn'+j).hide();
		}else{
			$('#reason_block'+j).hide();
		}
	}
	function do_save_reject_pro(product_id, sku, j){
		var base_url = '<?php echo base_url(); ?>';
		var controller = 'admin/sellers/';
		var reason = $("#reason_block"+j).val();
		var status = $("#product_status"+j).val();
		if(status == ""){
			alert("Please select status."); 
			return false;
		}else{
			$.ajax({
				url : base_url+controller+'product_inactive',
				type : 'POST',
				data : {reason:reason, status:status, sku:sku, product_id:product_id},
				'success' : function(data){
					if(data == 'success'){
						window.location.reload(true);
						$('#ajax_res').html("<div style='color:green;'>Product Status Updated Successfully.</div>");
					}else{
						window.location.reload(true);
						$('#ajax_res').html("<div style='color:red;'>Product Status Update Failed.</div>");
					}
				}
			});
		}
	}
	
</script>

<script>
function editSlrInfo(slr_id,sl){
	$('.slrp'+sl).hide();
	$('.slrinf'+sl).show();
	//$('.pedit'+sl).text('Update');
	$('.pedit'+sl).hide();
	$('.updt'+sl).show();
	$('.updt_slrp'+sl).hide();
	
	//$('.updt_slrp'+sl).show();
}


function updateSlrInfo(slr_id,sl){
	var slr_data = $('.slrinf'+sl).val();
	$('.timer'+sl).css('display','block');
	$('.comsn_loader'+sl).css('display','none');
	
	$.ajax({
		url:'<?php echo base_url();?>admin/sellers/update_seller_info',
		method:'post',
		data:{slr_id:slr_id,sl:sl,slr_data:slr_data},
		success:function(result){
			//$('#ajxtst').html(result);
			if(result){
			$('.slrp'+sl).hide();
			$('.slrinf'+sl).hide();
			$('.pedit'+sl).show();
			$('.updt'+sl).hide();
			$('.timer'+sl).css('display','none');
			$('.comsn_loader'+sl).css('display','block');
			$('.updt_slrp'+sl).css('display','block');
			$('.updt_slrp'+sl).html(result);
			$('.slrp'+sl).html(result);
				
			}
			
			//window.location.reload(true);
			else
			
			{
			$('.slrp'+sl).show();
			$('.slrinf'+sl).hide();
			$('.pedit'+sl).show();
			$('.updt'+sl).hide();
			$('.timer'+sl).css('display','none');
			
			}
			
		}
	});
}


function editSlrImgInfo(sl){
	$('#imgdv'+sl).hide();
	$('.pedit'+sl).hide();
	$('#imgform'+sl).show();
	//$('#updt_imgdv'+sl).css('display','block');
}
</script>	
<script>
	function validate_panform(){
		var re = /(\.jpg|\.jpeg|\.png)$/i;
		var pan_img = $("#seller_panimg19").val(); //alert(pan_img); return false;
		var pan_no = $("#seller_panno19").val(); //alert(pan_img); return false;
		
		if(pan_img == ""){
			$('#validate_msg').show().text("Pan image required!");
			$("#seller_panimg19").css('border-color','red');
			return false;
		}else if(!re.exec(pan_img)){
			$('#validate_msg').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
			$("#seller_panimg19").css('border-color','red');
			return false;
		}else if(pan_no == ""){
			$("#seller_panimg19").css('border-color','#ccc');
			
			$('#validate_msg').show().text("Pan Card number required!");
			$("#seller_panno19").focus().css('border-color','red');
			return false;
		}else{
			$("#seller_panimg19").css('border-color','#ccc');
			$("#seller_panno19").css('border-color','#ccc');
			
		}
	}
	function validate_tinform(){
		var re = /(\.jpg|\.jpeg|\.png)$/i;
		var tin_img = $("#seller_tinimg20").val(); //alert(pan_img); return false;
		var tin_no = $("#seller_tinno20").val(); //alert(pan_img); return false;
		//var fghfg = tin_img.size; 
		
		
		if(tin_img == ""){
			$('#validate_msg').show().text("TIN image required!");
			$("#seller_tinimg20").css('border-color','red');
			return false;
		}else if(!re.exec(tin_img)){
			$('#validate_msg').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
			$("#seller_tinimg20").css('border-color','red');
			return false;
		}else if(tin_no == ""){
			$("#seller_tinimg20").css('border-color','#ccc');
			
			$('#validate_msg').show().text("TIN number required!");
			$("#seller_tinno20").focus().css('border-color','red');
			return false;
		}else{
			$("#seller_tinimg20").css('border-color','#ccc');
			$("#seller_tinno20").css('border-color','#ccc');
			
		}
	}
	function validate_tanform(){
		var re = /(\.jpg|\.jpeg|\.png)$/i;
		var tan_img = $("#seller_tanimg21").val(); //alert(pan_img); return false;
		var tan_no = $("#seller_tanno21").val(); //alert(pan_img); return false;
		
		if(tan_img == ""){
			$('#validate_msg').show().text("TAN image required!");
			$("#seller_tanimg21").css('border-color','red');
			return false;
		}else if(!re.exec(tan_img)){
			$('#validate_msg').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
			$("#seller_tanimg21").css('border-color','red');
			return false;
		}else if(tan_no == ""){
			$("#seller_tanimg21").css('border-color','#ccc');
			
			$('#validate_msg').show().text("TAN number required!");
			$("#seller_tanno21").focus().css('border-color','red');
			return false;
		}else{
			$("#seller_tanimg21").css('border-color','#ccc');
			$("#seller_tanno21").css('border-color','#ccc');
			
		}
	}
	
	
	function validate_addproof(){
		var re = /(\.jpg|\.jpeg|\.png)$/i;
		var add_img = $("#address_proofimg25").val(); //alert(pan_img); return false;
		//var pan_no = $("#seller_panno19").val(); //alert(pan_img); return false;
		
		if(add_img == ""){
			$('#validate_msg').show().text("Address proof image required!");
			$("#address_proofimg25").css('border-color','red');
			return false;
		}else if(!re.exec(add_img)){
			$('#validate_msg').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
			$("#address_proofimg25").css('border-color','red');
			return false;
		}
	}
	
	
	
	function validate_idproof(){
		var re = /(\.jpg|\.jpeg|\.png)$/i;
		var id_img = $("#id_proofimg26").val();
		
		if(id_img == ""){
			$('#validate_msg').show().text("ID proof image required!");
			$("#id_proofimg26").css('border-color','red');
			return false;
		}else if(!re.exec(id_img)){
			$('#validate_msg').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
			$("#id_proofimg26").css('border-color','red');
			return false;
		}
	}
	
	
	function validate_cancheque(){
		var re = /(\.jpg|\.jpeg|\.png)$/i;
		var cheque_img = $("#cancelled_chequeimg27").val();
		
		if(cheque_img == ""){
			$('#validate_msg').show().text("Cancelled cheque image required!");
			$("#cancelled_chequeimg27").css('border-color','red');
			return false;
		}else if(!re.exec(cheque_img)){
			$('#validate_msg').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
			$("#cancelled_chequeimg27").css('border-color','red');
			return false;
		}
	}
	
</script>
<script>
	function displayPreview(files, sl) {
		var reader = new FileReader();
		var img = new Image();

		reader.onload = function (e) {
			img.src = e.target.result;
			fileSize = Math.round(files.size / 1024);
			//alert("File size is " + fileSize + " kb");
			if(fileSize > 1024 && sl == 20){
				alert("Maximum file size 1mb.");
				$("#seller_tinimg20").val("");
				return false;
			}else if(fileSize > 1024 && sl == 19){
				alert("Maximum file size 1mb.");
				$("#seller_panimg19").val("");
				return false;
			}else if(fileSize > 1024 && sl == 21){
				alert("Maximum file size 1mb.");
				$("#seller_tanimg21").val("");
				return false;
			}
			else if(fileSize > 1024 && sl == 25){
				alert("Maximum file size 1mb.");
				$("#address_proofimg25").val("");
				return false;
			}
			else if(fileSize > 1024 && sl == 26){
				alert("Maximum file size 1mb.");
				$("#id_proofimg26").val("");
				return false;
			}
			else if(fileSize > 1024 && sl == 27){
				alert("Maximum file size 1mb.");
				$("#cancelled_chequeimg27").val("");
				return false;
			}
			
		};
		reader.readAsDataURL(files);
	}


	$("#seller_tinimg20").change(function () {
		var file = this.files[0];
		displayPreview(file, 20);
	});
	$("#seller_panimg19").change(function () {
		var file = this.files[0];
		displayPreview(file, 19);
	});
	$("#seller_tanimg21").change(function () {
		var file = this.files[0];
		displayPreview(file, 21);
	});
	
	$("#address_proofimg25").change(function () {
		var file = this.files[0];
		displayPreview(file, 25);
	});
	$("#id_proofimg26").change(function () {
		var file = this.files[0];
		displayPreview(file, 26);
	});
	$("#cancelled_chequeimg27").change(function () {
		var file = this.files[0];
		displayPreview(file, 27);
	});

</script>

<?php
require_once('footer.php');
?>					