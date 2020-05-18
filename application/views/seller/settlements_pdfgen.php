<style type="text/css">
.clr{clear:both;}
.table{font-family:Arial, Helvetica, sans-serif;}
.settelment_details_table tr th{background-color:#f3f3f3 !important; font-weight:bold; font-size:12px; padding:5px;}
.settelment_details_table tr td{ border:1px solid #ccc; padding:3px; margin:0px; font-size:10px !important;}
</style>

            <div id="content">    

				<div class="main-content">
					
					<div class="settelment_details_table">
						<table class="table table-hover" width="98%" cellspacing="0">
							<tr>
								<th>Settlement Date</th>
								<th>Bank Account</th>
								<th>Settlement Reference#</th>
								<th class="a-center">Settlement Value (Rs.)</th>
                                <th>Status</th>
							</tr>
							
                            <?php
							$settelment_data_row = $settelment_data->num_rows();
							if($settelment_data_row > 0){
								foreach($settelment_data->result() as $rows){
							?>
                            <tr>
                            	<td><?=$rows->pyt_generated_dt;?></td>
                                <td><?=$rows->bnk_acnt_no;?></td>
                                <td><?=$rows->settlmnt_refno;?></td>
                                <td style="text-align:center !important;"><?=number_format($rows->fnl_stl_amt,2, ".", ",");?></td>
                                <td><?=$rows->status;?></td>
                            </tr>
                            <?php
								} //End of foreach loop
							 }else{?>
                            <tr>
                            	<td colspan="5">No Record Found!</td>
                            </tr>
                            <?php }?>
						</table>
						<!--<div>
							<button class="show_more_btn"><span>Show More</span></button>
						</div>-->
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
