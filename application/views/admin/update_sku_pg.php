<?php
require_once('header.php');
?>
			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_payment.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>SKU</h3> </div>
					<div class="col-md-4 show_report">
                   <!--<button type="button" class="all_buttons" onClick="window.location.href='<?php// echo base_url().'admin/catalog/addnew_product' ?>'">Add Product</button>-->
                     </div>
                
					</div>
					
                    
                    <div class="col-md-6">
                    <?php echo $this->session->flashdata('ssmsg'); ?>
						<form action="<?php echo base_url().'admin/payment/update_new_sku' ?>" method="post" >
                         	old sku : <input type="text" name="osku"><br/><br/>
                            New sku : <input type="text" name="nsku"><br/>
                            <input type="submit" name="submit" value="submit">
                       	</form>
					</div>
                    
				    <div class="col-md-6 left">
                        <table class="multi_action">
							<tr>
								<td>
                                    <div class="right" style="visibility:hidden;">
                                        <input type="submit" class="all_buttons" value="Search" id="search"  />
                                        <input type="reset" class="all_buttons" value="Reset Filter" />
                                    </div>
								</td>
							</tr>
						</table>
					</div>
					<div class="clearfix"></div>
					<div>
						
					</div>
                    
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    





<?php
require_once('footer.php');
?>			