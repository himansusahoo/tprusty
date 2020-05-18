<?php
require_once('header.php');
?>	
		
		<!--- Zebra_Datepicker link start here ---->
		<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
		<?php /*?><script src="<?php echo base_url() ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script><?php */?>
		<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
		<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
		<!--- Zebra_Datepicker link end here ---->
		
		<style>
			.Zebra_DatePicker_Icon{left: 72px !important; top: 0px !important;}
			
            .Zebra_DatePicker{ z-index:999999 !important;}
		</style>

			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_customer.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
						<div class="col-md-8"><b>Manage Customers</b></div>
						<!--<div class="col-md-4 show_report">
							<button type="button" class="all_buttons">Add New Customer</button>
						</div>-->
					</div>
                    
					<div class="row mb10">
					<div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div>
					</div>
					 <form action="<?php echo base_url().'admin/customers/filter_customer' ?>" method="post" >
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
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>
						</table>
                        </div>
                        <div class="clearfix"></div>
					  <div>
                      <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
						<table class="table table-bordered table-hover">
                   
						<!--<div class="col-md-6">
							Page 
							<span class="glyphicon glyphicon-chevron-left arrow_button"></span>
							<input type="text" name="page" class="input_text" value="1">
							<span class="glyphicon glyphicon-chevron-right"></span>
							of 1 pages <span class="separator">|</span> View
							<select> 
								<option selected="selected" value="">20</option>
								<option>30</option>
								<option>50</option>
								<option>100</option>
								<option>200</option>
							</select>
							per page <span class="separator">|</span> Total 11 records found
						</div>
						<div class="col-md-3 show_report">
							<div class="all_save">
								Export To:
								<select>
									<option>CSV</option>
									<option>Excel XML</option>
								</select>
								<button type="button">Export</button>
							</div>
						
						<div class="col-md-3 show_report">
							<button type="button" class="all_buttons">Search</button>
							<button type="button" class="all_buttons">Reset Filter</button>
						</div>
					</div>
					<div>
						<table class="multi_action">
							<tr>
								<td>
									<a href="#">Select All</a>
									<span class="separator">|</span>
									<a href="#">Unselect All</a>
									<span class="separator">|</span>
									<a href="#">Select Visible</a>
									<span class="separator">|</span>
									<a href="#">Unselect Visible</a>
									<span class="separator">|</span>
									0 items selected
								</td>
								<td>
									<div class="right">
										<form>
											<table>
												<tr>
													<td>Actions</td>
													<td>
														<select>
															<option value=""></option>
															<option value="">Delete</option>
															<option value="">Subscribe to Newsletter</option>
															<option value="">Unsubscribe from Newsletter</option>
															<option value="">Assign a Customer Group</option>
														</select>
													</td>
													<td><input type="submit" name="submit" class="all_buttons" value="Submit"></td>
												</tr>
											</table>
										</form>
									</div>
								</td>
							</tr>
						</table>
					</div>
                    </div>-->
                    <!--<form action="<?php// echo base_url().'admin/Customers/filter_customer' ?>" method="post" >-->
                   <!--  <div class="col-md-3 show_report">
                    
							 <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
						</div>
					<div>-->
					
					
					<tr>
                            <?php
							
							/*if($user_id){ ?>
                            <td colspan="9">Filtered Data  as  user_id:- <?php echo $user_id;?> 
                            </td>
                           <?php }*/
							
							
							if($cust_name){ ?>
                            <td colspan="9">Filtered Data  as  cust_name:- <?php echo $cust_name;?> 
                            </td>
                           <?php }
							
							else if($email){ ?>
                            <td colspan="9">Filtered Data  as  email:- <?php echo $email;?> 
                            </td>
                            <?php }
							
							else if($phone){ ?>
                            <td colspan="9">Filtered Data  as  phone:- <?php echo $phone;?> 
                            </td>
                            <?php }
							
												
							else if($zip){ ?>
                            <td colspan="9">Filtered Data  as  Attribute zip:-<?php echo $zip;?> 
                            </td>
                             <?php }
							 
							 if($country_id){ ?>
                            <td colspan="9">Filtered Data  as  country_id:- <?php echo $country_id;?> 
                            </td>
                           <?php }
							
							else if($state_province){ ?>
                            <td colspan="9">Filtered Data  as  state_province:-<?php echo $state_province;?> 
                            </td>
                             <?php }
							
							else if($cust_since){ ?>
                            <td colspan="9">Filtered Data  as  cust_since:-<?php echo $cust_since;?> 
                            </td>
                           <?php } ?>
                            </tr>
						
							<tr class="table_th">
								
								<th width="5%">ID</th>
								<th width="10%">Name</th>
								<th width="10%">Email</th>
								<!--<th width="10%">Group</th>-->
								<th width="10%">Phone Number</th>
								<th width="10%">ZIP</th>
								<th width="10%">Country</th>
								<th width="10%">State/Province</th>
								<th width="10%">Customer Since</th>
								<th width="5%">Action</th>
							</tr>
							<tr class="filter_tr">
								<td><!--<input type="text" id="check_all" name="user_id">--></td>
								<td>
									<input type="text" name="cust_name" id="cust_name" >
								</td>
								<td>
									<input type="text" name="email" id="email" >
								</td>
								<td>
									<input type="text" name="phone" id="phone" >
								</td>
								<td>
									<input type="text" name="zip" id="zip" >
								</td>
								<td>
                                
									<select name="country_id">
                                    <option value="">--select--</option>
                                     <?php
									 $query = $this->db->query("select distinct(country) as country_id from user_address");
									 $rw=$query->result();
									  foreach ($rw as $cust){?>
										<option value="<?php echo $cust->country_id; ?>"><?php echo $cust->country_id; ?> </option><?php }?>
										<!--<option value="AF">Afghanistan</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AS">American Samoa</option>
										<option value="AD">Andorra</option>
										<option value="AO">Angola</option>
										<option value="AI">Anguilla</option>
										<option value="AQ">Antarctica</option>
										<option value="AG">Antigua and Barbuda</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>
										<option value="BB">Barbados</option>
										<option value="BY">Belarus</option>
										<option value="BE">Belgium</option>
										<option value="BZ">Belize</option>
										<option value="BJ">Benin</option>
										<option value="BM">Bermuda</option>
										<option value="BT">Bhutan</option>
										<option value="BO">Bolivia</option>
										<option value="BA">Bosnia and Herzegovina</option>
										<option value="BW">Botswana</option>
					-->				</select>  
								</td>
								<td>
									<select name="state_province">
                                    <option value="">--select--</option>
                                     <?php
									 $query = $this->db->query("select * from state");
									 $rw=$query->result();
									  foreach ($rw as $cust){?>
										<option value="<?php echo $cust->state; ?>"><?php echo $cust->state; ?> </option><?php }?>
                                    </select>
								</td>
								<td>
									<input type="text" name="cust_since" id="cust_since" >
								</td>
								
								<td>
									
								</td>
								
							</tr>
							
                            <?php 
			if($customer) {
    		foreach ($customer as $cust){
			$id=$cust->user_id;
			?>
                         <tr>
                        
                         <td><?php echo $id; ?></td>
                         <td><?php echo $cust->fname; ?>&nbsp;<?php echo $cust->lname; ?></td>
                         <td><?php echo $cust->email; ?></td>
                         <td><?php echo $cust->mob; ?></td>
                         <td><?php echo $cust->pin_code; ?></td>
                         <td><?php echo $cust->country; ?></td>
                         <td><?php echo $cust->state; ?></td>
                         <td><?php $date=$cust->registration_date; echo $datee = strstr($date, ' ', true);?></td>
                         <td> <a href='<?php echo base_url().'admin/customers/customer_details/'.$id  ; ?>' title="View Seller Details"> <i style="font-size:16px;" class="fa fa-eye"></i> </a></td>
                         </tr>
                         <?php }}else{ ?>
                            
							<tr><td class="a-center" colspan="11">No records found ! </td></tr>
                            <?php }?>
						</table>
						</div>
                    </form>
				</div>
                      <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>			