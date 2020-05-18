<?php
require_once('header.php');
?>


<script>
$(document).ready(function(){
	$('#order_tab').click(function(){
		$('#orders').prop('checked', this.checked);
		$('#track_orders').prop('checked', this.checked);
		$('#returns').prop('checked', this.checked);
		$('#tax').prop('checked', this.checked);
	});
	
	$('#Payments_tab').click(function(){
		$('#payout').prop('checked', this.checked);
		$('#seller_payout').prop('checked', this.checked);
		$('#buyer_refund').prop('checked', this.checked);
		$('#buyer_wallet').prop('checked', this.checked);
		$('#ledger').prop('checked', this.checked);
	});

    $('#Catalog_tab').click(function(){
		$('#manage_product').prop('checked', this.checked);
		$('#manage_catageories').prop('checked', this.checked);
		$('#attributes').prop('checked', this.checked);
	});
	
	$('#Sellers_tab').click(function(){
		$('#sellers').prop('checked', this.checked);
		$('#product_for_approval').prop('checked', this.checked);
		$('#notification').prop('checked', this.checked);
		$('#dispatch_time').prop('checked', this.checked);
		$('#badge_membership').prop('checked', this.checked);
		$('#defaulter_seller').prop('checked', this.checked);                                                                            
		$('#courier_setup').prop('checked', this.checked); 
		$('#terms_conditions').prop('checked', this.checked);
	});
	
	$('#Customer_tab').click(function(){
		$('#manage_customers').prop('checked', this.checked);
	});
	
	$('#Pages_tab').click(function(){		                                             
		$('#pages').prop('checked', this.checked);
	});
   
   $('#Reports_tab').click(function(){
		$('#order_report').prop('checked', this.checked);
		$('#return_order_report').prop('checked', this.checked);
		$('#sales_report').prop('checked', this.checked);
		$('#seller_report').prop('checked', this.checked);
		$('#product_report').prop('checked', this.checked);
		$('#top_selling_by_seller').prop('checked', this.checked);
		$('#buyer_report').prop('checked', this.checked);
		$('#buyer_wallet_report').prop('checked', this.checked);
		$('#seller_payout_report').prop('checked', this.checked);
		$('#tax_report').prop('checked', this.checked);
		$('#seller_profile_report').prop('checked', this.checked);
		$('#buyer_profile_report').prop('checked', this.checked);
	});
	
	$('#Newsletter_tab').click(function(){		                                             
		$('#newsletter_chk').prop('checked', this.checked);
	});
	
	$('#Config_tab').click(function(){
		$('#membership').prop('checked', this.checked);
		$('#seller_commission').prop('checked', this.checked);
		$('#other_charges').prop('checked', this.checked);
		$('#homepage_image_setting').prop('checked', this.checked);
		$('#user_role').prop('checked', this.checked);
		$('#voucher').prop('checked', this.checked);
		$('#category_menu_setup').prop('checked', this.checked);
		$('#cod_setup').prop('checked', this.checked);
		$('#filter_setup').prop('checked', this.checked);
		$('#size_colour').prop('checked', this.checked);
		$('#category_att_link').prop('checked', this.checked);
		$('#bulk_product_log').prop('checked', this.checked);
		$('#bulk_product_excel_track').prop('checked', this.checked);
		$('#bulk_product_delete').prop('checked', this.checked);
		$('#advance_search').prop('checked', this.checked);
		$('#search_keyword_setup').prop('checked', this.checked);
		$('#page_design').prop('checked', this.checked);
		$('#manage_cache').prop('checked', this.checked);
		$('#manage_solar_index').prop('checked', this.checked);
	});
	
	$('#log_tab').click(function(){
		$('#email_log').prop('checked', this.checked);
	});
	
	$('#bdm_tab').click(function(){
		$('#bdm').prop('checked', this.checked);
	});
 
	$('#all_prvilages').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
   
	$('#all_prvilages').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});  
});


function valid_user_role()
{
	if($('#fname').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter First Name";
		$('#fname').css('border','1px solid red');
		document.getElementById('fname').focus();
		return false;
	}
	
	if($('#lname').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter last Name";
		$('#lname').css('border','1px solid red');
		document.getElementById('lname').focus();
		return false;
	}
	
	if($('#uname').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter User Name";
		$('#uname').css('border','1px solid red');
		document.getElementById('uname').focus();
		return false;
	}
	
	if($('#user_desgn').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter Designation";
		$('#user_desgn').css('border','1px solid red');
		document.getElementById('user_desgn').focus();
		return false;
	}
	
	
	if($('#user_category').val()=='')
	{
		document.getElementById('show_error').innerHTML="Select Category";
		$('#user_category').css('border','1px solid red');
		document.getElementById('user_category').focus();
		return false;
	}
	
	if($('#emailid').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter Email";
		$('#emailid').css('border','1px solid red');
		document.getElementById('emailid').focus();
		return false;
	}
	
	var email_id=$('#emailid').val();
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
        if(!regex.test(email_id)) {
		
		document.getElementById('show_error').innerHTML="Enter valid Email";
		$('#emailid').css('border','1px solid red');
		document.getElementById('emailid').focus();
          return false;
        }
     
	 if($('#conct_no').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter Contact Number";
		$('#conct_no').css('border','1px solid red');
		document.getElementById('conct_no').focus();
		return false;
	}
	
	
	var cont_num=$('#conct_no').val();
	if(isNaN(cont_num))
	{
		document.getElementById('show_error').innerHTML="Enter Valid Contact Number";
		$('#conct_no').css('border','1px solid red');
		document.getElementById('conct_no').focus();
		return false;
	}
	
	
	 if($('#Set_pwd').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter password";
		$('#Set_pwd').css('border','1px solid red');
		document.getElementById('Set_pwd').focus();
		return false;
	}
	
	if($('#conf_pwd').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter Confirm password";
		$('#conf_pwd').css('border','1px solid red');
		document.getElementById('conf_pwd').focus();
		return false;
	}
	
	if($('#conf_pwd').val()!=$('#Set_pwd').val())
	{
		document.getElementById('show_error').innerHTML="Confirm password not matched ";
		$('#conf_pwd').css('border','1px solid red');
		document.getElementById('conf_pwd').focus();
		return false;
	}
	
	
	
		var artb_id = document.getElementsByName("main_tab[]");
		var atrbid_count=artb_id.length;
		
		var count=0;
		for (var i=0; i<atrbid_count; i++) {
			if (artb_id[i].checked === true) 
			{
				count++;
			}
		}
		
		//var artb_id1 = document.getElementsByName("sales_tab[]");
//		var atrbid_count1=artb_id1.length;
//		
//		var count1=0;
//		for (var i1=0; i1<atrbid_count1; i1++) {
//			if (artb_id1[i1].checked === true) 
//			{
//				count1++;
//			}
//		}
//		
//		var artb_id2 = document.getElementsByName("Catalog_tab[]");
//		var atrbid_count2=artb_id2.length;
//		
//		var count2=0;
//		for (var i2=0; i2<atrbid_count2; i2++) {
//			if (artb_id2[i2].checked === true) 
//			{
//				count2++;
//			}
//		}
//		
//		var artb_id3 = document.getElementsByName("Sellers_tab[]");
//		var atrbid_count3=artb_id3.length;
//		
//		var count3=0;
//		for (var i3=0; i3<atrbid_count3; i3++) {
//			if (artb_id3[i3].checked === true) 
//			{
//				count3++;
//			}
//		}
//		
//		var artb_id4 = document.getElementsByName("Customer_tab[]");
//		var atrbid_count4=artb_id4.length;
//		
//		var count4=0;
//		for (var i4=0; i4<atrbid_count4; i4++) {
//			if (artb_id4[i4].checked === true) 
//			{
//				count4++;
//			}
//		}
//		
//		var artb_id5 = document.getElementsByName("Pages_tab[]");
//		var atrbid_count5=artb_id5.length;
//		
//		var count5=0;
//		for (var i5=0; i5<atrbid_count5; i5++) {
//			if (artb_id5[i5].checked === true) 
//			{
//				count5++;
//			}
//		}
//		
//		
//		var artb_id6 = document.getElementsByName("Reports_tab[]");
//		var atrbid_count6=artb_id6.length;
//		
//		var count6=0;
//		for (var i6=0; i6<atrbid_count6; i6++) {
//			if (artb_id6[i6].checked === true) 
//			{
//				count6++;
//			}
//		}
//		
//		var artb_id7 = document.getElementsByName("Newsletter_tab[]");
//		var atrbid_count7=artb_id7.length;
//		
//		var count7=0;
//		for (var i7=0; i7<atrbid_count7; i7++) {
//			if (artb_id7[i7].checked === true) 
//			{
//				count7++;
//			}
//		}
//		
//		
//		var artb_id8 = document.getElementsByName("Config_tab[]");
//		var atrbid_count7=artb_id7.length;
//		
//		var count8=0;
//		for (var i8=0; i8<atrbid_count8; i8++) {
//			if (artb_id8[i8].checked === true) 
//			{
//				count8++;
//			}
		//}
		
		if(count==0 )
		{
			document.getElementById('show_error').innerHTML="Please select atleast one privileges";
			//alert('Please select atleast one previleges');
			return false;
		}
	
	
}
 
 

</script>
<script>
function check_sales_tab()
{
	
	document.getElementById('sales_tab').checked='checked';	
}


function check_catalog_tab()
{
	document.getElementById('Catalog_tab').checked='checked';	
}
function check_Sellers_tab()
{
	document.getElementById('Sellers_tab').checked='cheked';	
}

function check_bdm_tab()
{
	document.getElementById('bdm_tab').checked='cheked';	
}

function check_Customer_tab()
{
	document.getElementById('Customer_tab').checked='cheked';		
}
function check_Promotions_tab()
{
	document.getElementById('Promotions_tab').checked='cheked';	
}
function check_Pages_tab()
{
	document.getElementById('Pages_tab').checked='cheked';
}
function check_Reports_tab()
{
	document.getElementById('Reports_tab').checked='cheked';
}

function check_Newsletter_tab()
{
	document.getElementById('Newsletter_tab').checked='cheked';	
}
function check_Config_tab()
{
	document.getElementById('Config_tab').checked='cheked';	
}

</script>


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
                <?php $user_role_id=$user_role_info[0]->userole_id; ?>
                <form action='<?php echo base_url().'admin/user_role_setup/update_user_roles/'.$user_role_id ?>' method='post' onSubmit="return valid_user_role()">
                <div class="row content-header">
						<div class="col-md-8"><b>Edit User Setup</b></div>
						<div class="col-md-4 show_report">
							<button type="reset" class="all_buttons">Reset</button>
							<input type="submit" class="all_buttons" value="Save"  >
						</div>
                       
					</div>
                    <div id='show_error' align="center" style="color:#F00;"> </div>
					<div class="form_view"><div id="ss" ></div>
						<h3>Add New User </h3>
							<table>
                            <tr>
									<td style="width:20%;">First Name <sup>*</sup> </td>
									<td><input type="text" class="text2" name="fname" id="fname" value='<?= $user_role_info[0]->first_name ?>' ></td>
								</tr> <tr>
									<td style="width:20%;">Last Name <sup>*</sup> </td>
									<td><input type="text" class="text2" name="lname" id="lname" value="<?= $user_role_info[0]->last_name ?>"></td>
								</tr>
								<tr>
									<td style="width:20%;">User Name <sup>*</sup> </td>
									<td><input type="text" class="text2" name="uname" id="uname" value="<?= $user_role_info[0]->uname ?>"></td>
								</tr>
								<tr>
									<td> Designation <sup>*</sup> </td>
									<td><input type="text" class="text2" name="user_desgn" id="user_desgn" value="<?= $user_role_info[0]->designation ?>"></td>
								</tr>
                                <tr>
									<td> Category<sup>*</sup> </td>
									<td><select name="user_category" id="user_category" class="text2">
                                        	<option value="">---select---</option>
                                        	<option value="admin" <?php if($user_role_info[0]->user_category=='admin') echo "selected"; ?> >Admin</option>
                                            <option value="user" <?php if($user_role_info[0]->user_category=='user') echo "selected"; ?> >User</option>
                                        </select></td>
								</tr>
								<tr>
									<td> Email<sup>*</sup> </td>
									<td><input type="text" class="text2" name="emailid" id="emailid" value="<?= $user_role_info[0]->email ?>"></td>
								</tr>
								<tr>
									<td> Contact Number <sup>*</sup> </td>
									<td>
                                    	<input type="text" class="text2" name="conct_no" id="conct_no" value="<?= $user_role_info[0]->contact_no ?>" >
                                    </td>
								</tr>
                                <tr>
									<td style="width:20%;"> Set Password <sup>*</sup> </td>
									<td><input type="password" class="text2" name="Set_pwd" id="Set_pwd" value="<?= $user_role_info[0]->password ?>"></td>
								</tr>
                                 <tr>
									<td style="width:20%;"> Confirm Password <sup>*</sup> </td>
									<td><input type="password" class="text2" name="conf_pwd" id="conf_pwd" value="<?= $user_role_info[0]->password ?>"></td>
								</tr>
                                
                               <tr>
									<td> Dashboard Privileges<sup>*</sup> 
                                    <br>
                                     <input type='checkbox' name='all_prvilages' id='all_prvilages'  >Select All Privileges
                                    
                                    </td>
									<td>
                                    	<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='order_tab' value='Sales' <?php if( @$user_role_info[0]->main_tab_name=='Sales') echo "checked"?> >Orders                                        
                                        </legend>
											<input type='checkbox' name='order_tab[]' id='orders' value='orders' onClick="check_sales_tab()" 
											<?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='orders') echo "checked"; }?>  >Orders &nbsp;&nbsp;
											
											<input type='checkbox' name='order_tab[]' id='track_orders' value='track_orders' onClick="check_sales_tab()" 
											<?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='track_orders') echo "checked"; }?>>Track Orders&nbsp;&nbsp;
											
											<input type='checkbox' name='order_tab[]' id='returns' value='returns' onClick="check_sales_tab()"
											<?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='returns') echo "checked"; }?> >Returns&nbsp;&nbsp;
																					
											<input type='checkbox' name='order_tab[]' id='tax' value="tax" onClick="check_sales_tab()"
											<?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='tax') echo "checked"; }?> >Tax&nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
										<?php
											$query1=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Payments'");
											$row1=$query1->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Payments_tab' value='Payments' 
											<?php if( @$row1[0]->main_tab_name=='Payments') echo "checked"?>>Payments
                                        </legend>
											<input type='checkbox' name='Payments_tab[]' id='payout' value='payout' onClick="check_payments_tab()"
											<?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='payout') echo "checked"; }?>>Payout &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='seller_payout' value='seller_payout' onClick="check_payments_tab()"
											<?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='seller_payout') echo "checked"; }?>>Seller Payout &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='buyer_refund' value='buyer_refund' onClick="check_payments_tab()"
											<?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='buyer_refund') echo "checked"; }?>>Buyer Refund &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='buyer_wallet' value="buyer_wallet" onClick="check_payments_tab()"
											<?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='buyer_wallet') echo "checked"; }?>>Buyer Wallet &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='ledger' value="ledger" onClick="check_payments_tab()"
											<?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='ledger') echo "checked"; }?>>Ledger &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
										<?php
											$query2=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Catalog'");
											$row2=$query2->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Catalog_tab' value='Catalog'
											<?php if( @$row2[0]->main_tab_name=='Catalog') echo "checked"?>>Catalog
                                        </legend>
											<input type='checkbox' name='Catalog_tab[]' id='manage_product' value='manage_product' onClick="check_catalog_tab()"
											<?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='manage_product') echo "checked"; }?>>Manage Product &nbsp;&nbsp;
											<input type='checkbox' name='Catalog_tab[]' id='manage_catageories' value='manage_catageories' onClick="check_catalog_tab()"
											<?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='manage_catageories') echo "checked"; }?>>Manage Categories&nbsp;&nbsp;
											<input type='checkbox' name='Catalog_tab[]' id='attributes' value='attributes' onClick="check_catalog_tab()"
											<?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='attributes') echo "checked"; }?>>Attributes&nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
										<?php
											$query3=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Sellers'");
											$row3=$query3->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Sellers_tab' value='Sellers'
											<?php if( @$row3[0]->main_tab_name=='Sellers') echo "checked"?>>Sellers
                                        </legend>                                        
											<input type='checkbox' name='Sellers_tab[]' id='sellers' value='sellers' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='sellers') echo "checked"; }?>>Sellers &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='product_for_approval' value='product_for_approval' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='product_for_approval') echo "checked"; }?>>Product For Approval &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='notification' value='notification' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='notification') echo "checked"; }?>>Notification &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='dispatch_time' value='dispatch_time' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='dispatch_time') echo "checked"; }?>>Dispatch Time &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='badge_membership' value='badge_membership' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='badge_membership') echo "checked"; }?>>Badge & Membership &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='defaulter_seller' value='defaulter_seller' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='defaulter_seller') echo "checked"; }?>>Defaulter Seller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='courier_setup' value='courier_setup' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='courier_setup') echo "checked"; }?>>Courier Setup &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='terms_conditions' value='terms_conditions' onClick="check_Sellers_tab()"
											<?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='terms_conditions') echo "checked"; }?>>Terms & Conditions &nbsp;&nbsp;
											</fieldset>
                                        <br>
										
										<?php
											$query4=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Customer'");
											$row4=$query4->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Customer_tab' value='Customer'
											<?php if( @$row4[0]->main_tab_name=='Customer') echo "checked"?>>Customer
                                        </legend>                                        
											<input type='checkbox' name='Customer_tab[]' id='manage_customers' value='manage_customers' onClick="check_Customer_tab()"
											<?php foreach($row4 as $rw4){ if($rw4->sub_tab_name=='manage_customers') echo "checked"; }?>>Manage Customers &nbsp;&nbsp;
										</fieldset>
                                        <br>
										
										<?php
											$query5=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Pages'");
											$row5=$query5->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Pages_tab' value='Pages'
											<?php if( @$row5[0]->main_tab_name=='Pages') echo "checked"?>>Pages
                                        </legend>                                        
											<input type='checkbox' name='Pages_tab[]' id='pages' value='pages' onClick="check_Pages_tab()"
											<?php foreach($row5 as $rw5){ if($rw5->sub_tab_name=='pages') echo "checked"; }?>>Pages&nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
										<?php
											$query6=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Reports'");
											$row6=$query6->result();
										?>										
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Reports_tab' value='Reports'
											<?php if( @$row6[0]->main_tab_name=='Reports') echo "checked"?>>Reports
                                        </legend>
											<input type='checkbox' name='Reports_tab[]' id='order_report' value='order_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='order_report') echo "checked"; }?>>Order Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='return_order_report' value='return_order_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='return_order_report') echo "checked"; }?>>Return Order Report &nbsp;&nbsp;
											<?php /*?><input type='checkbox' name='Reports_tab[]' id='sales_report' value='sales_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='sales_report') echo "checked"; }?>>Sales Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='seller_report' value='seller_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='seller_report') echo "checked"; }?>>Seller Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='product_report' value='product_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='product_report') echo "checked"; }?>>Products Reports &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='top_selling_by_seller' value='top_selling_by_seller' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='top_selling_by_seller') echo "checked"; }?>>Top Selling Product By Seller &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='buyer_report' value='buyer_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='buyer_report') echo "checked"; }?>>Buyer Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='buyer_wallet_report' value='buyer_wallet_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='buyer_wallet_report') echo "checked"; }?>>Buyer Wallet Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='seller_payout_report' value='seller_payout_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='seller_payout_report') echo "checked"; }?>>Seller Payout Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='tax_report' value='tax_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='tax_report') echo "checked"; }?>>Tax Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='seller_profile_report' value='seller_profile_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='seller_profile_report') echo "checked"; }?>>Seller Profile Report &nbsp;&nbsp;&nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='buyer_profile_report' value='buyer_profile_report' onClick="check_Reports_tab()"
											<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='buyer_profile_report') echo "checked"; }?>>Buyer Profile Report &nbsp;&nbsp;<?php */?>
										</fieldset> 
                                        <br>
										
										<?php
											$query7=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Newsletter'");
											$row7=$query7->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Newsletter_tab' value='Newsletter'
											<?php if( @$row7[0]->main_tab_name=='Newsletter') echo "checked"?>>Newsletter
                                        </legend>                                        
											<input type='checkbox' name='newsletter_chk[]' id='newsletter_chk' value='News_letter' onClick="check_Newsletter_tab()"
											<?php foreach($row7 as $rw7){ if($rw7->sub_tab_name=='News_letter') echo "checked"; }?>>Newsletter &nbsp;&nbsp;
                                        </fieldset>
										<br>
										
										<?php
											$query8=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Config'");
											$row8=$query8->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Config_tab' value='Config'
											<?php if( @$row8[0]->main_tab_name=='Config') echo "checked"?>>Config
                                        </legend>                                        
											<input type='checkbox' name='Config_tab[]' id='membership' value='membership' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='membership') echo "checked"; }?>>Membership &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='seller_commission' value='seller_commission' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='seller_commission') echo "checked"; }?>>Seller Commission &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='other_charges' value='other_charges' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='other_charges') echo "checked"; }?>>Other Charges &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='homepage_image_setting' value='homepage_image_setting' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='homepage_image_setting') echo "checked"; }?>>Homepage Image Setting &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='user_role' value='user_role' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='user_role') echo "checked"; }?>>Users &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='voucher' value='voucher' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='voucher') echo "checked"; }?>>Voucher <br> 
											<input type='checkbox' name='Config_tab[]' id='category_menu_setup' value='category_menu_setup' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='category_menu_setup') echo "checked"; }?>>Category Menu Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='cod_setup' value='cod_setup' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='cod_setup') echo "checked"; }?>>COD Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='filter_setup' value='filter_setup' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='filter_setup') echo "checked"; }?>>Filter Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='size_colour' value='size_colour' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='size_colour') echo "checked"; }?>>Size & Colour Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='category_att_link' value='category_att_link' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='category_att_link') echo "checked"; }?>>Category Attribute Link Setup <br>
											<input type='checkbox' name='Config_tab[]' id='bulk_product_log' value='bulk_product_log' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='bulk_product_log') echo "checked"; }?>>Bulk Product Log &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='bulk_product_excel_track' value='bulk_product_excel_track' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='bulk_product_excel_track') echo "checked"; }?>>Bulk New Product Excelsheet Tracking &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='bulk_product_delete' value='bulk_product_delete' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='bulk_product_delete') echo "checked"; }?>>Bulk Product Delete &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='advance_search' value='advance_search' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='advance_search') echo "checked"; }?>>Advance Search &nbsp;&nbsp;<br>
											<input type='checkbox' name='Config_tab[]' id='search_keyword_setup' value='search_keyword_setup' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='search_keyword_setup') echo "checked"; }?>>Search Keyword Setup 
											<input type='checkbox' name='Config_tab[]' id='page_design' value='page_design' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='page_design') echo "checked"; }?>>Page Design &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='manage_cache' value='manage_cache' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='manage_cache') echo "checked"; }?>>Manage Cache &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='manage_solar_index' value='manage_solar_index' onClick="check_Config_tab()"
											<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='manage_solar_index') echo "checked"; }?>>Manage Solar Indexing &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
										<?php
											$query9=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='Log'");
											$row9=$query9->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
                                        <legend>
											<input type='checkbox' name='main_tab[]' id='log_tab' value='Log'
											<?php if( @$row9[0]->main_tab_name=='Log') echo "checked"?>>Log
										</legend>                                        
											<input type='checkbox' name='log_tab[]' id='email_log' value='email_log' onClick="check_log_tab()"
											<?php foreach($row9 as $rw9){ if($rw9->sub_tab_name=='email_log') echo "checked"; }?>>Email Log &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
										<?php
											$query10=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a 
																	INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id 
																	INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id 
																	WHERE a.userole_id='$user_role_id' and b.main_tab_name='BDM'");
											$row10=$query10->result();
										?>
										<fieldset style="border:1; background-color:#CCC;">
                                        <legend>
											<input type='checkbox' name='main_tab[]' id='bdm_tab' value='BDM'
											<?php if( @$row10[0]->main_tab_name=='BDM') echo "checked"?>>BDM
										</legend>
											<input type='checkbox' name='bdm_tab[]' id='bdm' value='seller_profile' onClick="check_bdm_tab()"
											<?php foreach($row10 as $rw10){ if($rw10->sub_tab_name=='seller_profile') echo "checked"; }?>>BDM &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
                                    </td>
								</tr> 
							</table>
					</div>
                    </form>
                
                </div>
                </div>
                <?php
require_once('footer.php');
?>