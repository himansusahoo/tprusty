<?php
require_once('header.php');
?>	

<script>

$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<script>

function select_userrecord()
{
		
		var user_ids = document.getElementsByName("check_userid[]");
		var userid_count=user_ids.length;
		
		var count=0;
		for (var i=0; i<userid_count; i++) {
			if (user_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		
	
			
}


function chk_record(id)
{
	
	
	if(document.getElementById('check_userid'+id).checked== true)
	{
		$('#check_drcramt'+id).prop('checked','checked');
		
	}
	else if(document.getElementById('check_userid'+id).checked== false)
	{
		$('#check_drcramt'+id).prop('checked',false);
		
	}	
		
}


function fill_data(id)
{	
	
 document.getElementById('check_drcramt'+id).value=document.getElementById('drcr_amt'+id).value;	

}
function check_debit()
{
	document.getElementById('chk_debit_amount').checked='checked';	
	document.getElementById('chk_credit_amount').checked=false;
}
function check_credit()
{
	document.getElementById('chk_credit_amount').checked='checked';
	document.getElementById('chk_debit_amount').checked=false;	
}

</script>	

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_payment.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; 
						
						?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                
			<div class="row content-header">
						<div class="col-md-8"><h3>Buyers Wallet List</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
								
						</div>
					</div>
					
						
				  <div class="col-md-6 left" >
                  <div class="pagination">
                   <?php $param1=array('method'=>'GET');
					 echo form_open('admin/payment/buyer_wallet',$param1 ) ?>
                  <table class="table table-bordered table-hover">
                       <tr style="">                    
                                <td> <input type="text" autocomplete="off" name="slrsreach_name" id="slrsreach_name" class="seller_input" placeholder="Enter Buyer Name" required>
           						<div id="slr_nm_dv"><ul></ul></div>
                                </td>
                               
                                                        
                                 <td><input style="background-color:#666;" class="seller_buttons" type="submit" value="Search" id="srchby_prod1" name="srchby_prod1" onClick="searchby_productfordelete()" ></td>
                                
							</tr>
                            </table>
                  <?php echo form_close(); ?>
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div> 
					</div>
					 <!--<form action="<?php //echo base_url().'admin/payment/update_walletamt' ?>" method="post" Onsubmit="return select_userrecord()" > -->
                    
                     <?php $param=array('Onsubmit'=>'return select_userrecord()');
					 echo form_open('admin/payment/update_walletamt',$param ) ?>
                     
                     <div class="col-md-6 right">
                      	<input type="submit"  class="all_buttons" value="Debit Wallet" onclick="check_debit()" >
                       <span style="display:none;">  <input type="checkbox" value="debit" name="chk_debit_amount" id="chk_debit_amount"/>		
														<input type="checkbox" value="credit" name="chk_credit_amount" id="chk_credit_amount"/>	
                                                        </span>
                    <input type="submit"  class="all_buttons" value="Crdit Wallet"  onclick="check_credit()">
                    
				
                        </div>
                        <div class="clearfix"></div>
					
						<table class="table table-bordered table-hover">
                     
                            	<tr class="table_th">
                                <th width="10%"><input type="checkbox" name="check_all" id="check_all">&nbsp;Select All</th>
                                								
								<th>User Id</th>                               
                                <th>Buyer Name</th>
                                <th>Email </th>
                                <th>Contact Number </th>
                                <th>Wallet Amount </th>
                                <th width="25%">Debit/Credit Amount</th>                                
                                 <th>Action</th>
							</tr>
                           
							
                            
                           <?php
						 $i=1;
						   
						    if(count($buyer_wallet)!=0){
							   
							   foreach($buyer_wallet as $res_walletlist)
							   { 
							     
							   ?>
                            <tr>
                            <td><input type="checkbox" name="check_userid[]" id="check_userid<?php echo $res_walletlist->user_id ?>" value="<?php echo $res_walletlist->user_id ?>"         
                            		onClick="chk_record(<?php echo $res_walletlist->user_id ?>)"></td> 
                           <td><?= $res_walletlist->user_id; ?></td>
                            <td><?= $res_walletlist->fname. " ". $res_walletlist->lname  ?></td>
                            
                            <td><?= $res_walletlist->email ?>  </td>
                            
                            <td><?= $res_walletlist->mob ?> </td>
                            <td><?php 
							$qr=$this->db->query("select * FROM wallet_info WHERE user_id='$res_walletlist->user_id' ");
							$rw=$qr->row();
							if ($qr->num_rows()!=0)
							{ echo "Rs.".@$rw->wallet_balance ; }
							else{echo "Rs.0"; }
							 
							 ?> </td>
                           <td>
                          <span style="display:none;"> <input type="checkbox" name="check_drcramt[]" id="check_drcramt<?php echo $res_walletlist->user_id ?>" ></span>
                           <input type="text" name="drcr_amt[]" id="drcr_amt<?=$res_walletlist->user_id?>" onKeyUp="fill_data(<?=$res_walletlist->user_id?>)" /> </td>
                            <td>
                        <a href='<?php echo base_url().'admin/payment/view_wallet_detail/'.$res_walletlist->user_id ?>' title="View Wallet Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a>
                     <?php  if ($qr->num_rows()!=0)
							{ ?>
                        <?php if($rw->wallet_approve_status=='Not Approved') {?>
                        <a href='<?php echo base_url().'admin/payment/approve_wallet/'.$res_walletlist->user_id ?>' title="Approve Wallet"> <i class="fa fa-thumbs-o-up"></i> </a>      
					<?php }else{ ?>
                    <a href='<?php echo base_url().'admin/payment/disapprove_wallet/'.$res_walletlist->user_id ?>' title="Disapprove Wallet"> <i class="fa fa-thumbs-down"></i>
 </a>      
                    <?php } } ?>
					</td> 
                            
                            </tr>
                            <?php $i++; } }else { ?>
                           
							<tr><td colspan="8" class="a-center">No Records Found ! </td></tr>
                            <?php }  ?> 
					  </table>
                    
                       <!-- </form> -->

				<?php echo form_close(); ?>
  
</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    

 <script>
$(document).ready(function(){
	
	$("#slrsreach_name").keyup(function(){
		
		var slr_nam=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/payment/autofill_buyername' ?>',
			method:'post',
			data:{buyer_nam:slr_nam},
			success:function(data)
			{
				if(slr_nam){
					$("#slr_nm_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#slr_nm_dv ul").html("");
					//HideLoder1();
					$('#slr_nm_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})


function getslrname(val){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#slrsreach_name').val(res);
	$('#slrsreach_name').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script> 

 <script>
 $(document).ready(function(){
$(document).keyup(function(event){
        if(event.which === 27){
            $('#slr_nm_dv').css('display','none');
			
        }
    });
	
});

</script> 
<style>

#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 38%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style>  

<script>
             
 <?php
require_once('footer.php');
?>