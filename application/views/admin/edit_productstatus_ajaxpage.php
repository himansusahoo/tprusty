 <!-------------------------------------------------------------------------------------------------------------->
                 <?php //if($this->input->post('fileuploadid')){ uploadid
				// if($this->session->userdata('prod_uploaduid'))
				  if($uploadid)
				 {
				 ?>
                 <table class="table table-bordered table-hover"> 
                 
							<tr class="table_th">
								
								<th width="12%">Pending</th>
								<th width="6%">Failed</th>
								<th width="10%">Uploaded</th>
								<th width="10%">Total</th>								
								
							</tr>   
                           
                  <?php 	
									//$upload_id=$this->input->post('fileuploadid');
									
									$upload_id=$uploadid;
									
									$prod_query=$this->db->query("SELECT uploadprod_sqlid,uploadprod_uid,upload_status FROM bulk_editedproductupload_log WHERE uploadprod_uid='$upload_id' AND editstatus='Edited'  ");
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
                                                 
                            <td><?=$pending?> </td>                           
                            <td><?=$failed?> </td> 
                            <td><?=$upload?> </td>
                            <td><?=$tot?> </td>
                            
                            </tr>
                          
					  </table>
                      <?php } ?>
                      <!-------------------------------------------------------------------------------------------------------------->
                 