<?php
require_once("header.php");
?>


			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sales.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                
                
					<div class="row content-header">
						<div class="col-md-8"><b>Add New Tax Rate</b></div>
						<div class="col-md-4 show_report">
							<form action="<?php echo base_url().'admin/sales/insertnew_tax_rate' ?>" method="post">
                            <!--<button type="button" class="all_buttons" >Save and Continue Edit</button>-->
							<input type="submit" class="all_buttons" value="Save Rate" />
							<input type="reset" class="all_buttons" value="Reset"/>
							<button type="button" onClick="window.location.href='<?php echo base_url().'admin/sales/tax' ?>'" class="all_buttons">Back</button>
						</div>
					</div>
					<div class="form_view">
						<h3>Tax Rate Information</h3>
						
							<table>
                            
                            <tr>
									<td style="width:20%;">Select Tax Classes </td>
                                    <td>
                                    <select name="tax_class" class="text2" >
											<option value="Product Tax">Seller Tax</option>
											<option value="Customer Tax">Customer Tax</option>
										</select>
                                     </td>
									<td> 
								</tr>
                               
								<tr>
									<td style="width:20%;">Tax Rate Identifier Name  </td>
									<td> <input type="text" name="txri_name" class="text" required/> </td>
								</tr>
								<tr>
									<td> Country </td>
									<td> 
										<input name="country" class="text2" id="datepicker-example7-end" required/>
										
									</td>
								</tr>
								<tr>
									<td> State </td>
									<td> 
										<input name="state" class="text2" id="datepicker-example7-end" required/>
									</td>
								</tr>
								<!--<tr>
									<td>Zip/Post is Range </td>
									<td> <select class="text2">
											<option selected="selected" value="">-- Please Select --</option>
											<option value="">Yes</option>
											<option value="">No</option>
										</select></td>
								</tr>
								
								<tr>
									<td> Range From *</td>
									<td><input name="from_date" class="text2" id="datepicker-example7-start"></td>
								</tr>
								<tr>
									<td>Range To *</td>
									<td><input name="to_date" class="text2" id="datepicker-example7-end"></td>
								</tr>-->
								<tr>
									<td>Tax Rate Percent </td>
									<td> 
										<input name="tax_rate" class="text2" id="datepicker-example7-end" required/>
									</td>
								</tr>
								
							</table>
						</form>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
		<!--</div>--><!-- @end #w -->

	</body>
</html>