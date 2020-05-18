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
		
		if(count==0)
		{
			document.getElementById('show_error').innerHTML="Please select atleast one privileges";
			//alert('Please select atleast one previleges');
			return false;
		}
}
</script>
<script>
function check_orders_tab()
{
	document.getElementById('order_tab').checked='checked';
}
function check_payments_tab()
{
	document.getElementById('Payments_tab').checked='checked';
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

function log_tab()
{
	document.getElementById('log_tab').checked='cheked';		
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
                <form action='<?php echo base_url().'admin/user_role_setup' ?>' method='post' onSubmit="return valid_user_role()">
                <div class="row content-header">
						<div class="col-md-8"><b>User Setup</b></div>
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
									<td><input type="text" class="text2" name="fname" id="fname" ></td>
								</tr> <tr>
									<td style="width:20%;">Last Name <sup>*</sup> </td>
									<td><input type="text" class="text2" name="lname" id="lname"></td>
								</tr>
								<tr>
									<td style="width:20%;">User Name <sup>*</sup> </td>
									<td><input type="text" class="text2" name="uname" id="uname"></td>
								</tr>
								<tr>
									<td> Designation <sup>*</sup> </td>
									<td><input type="text" class="text2" name="user_desgn" id="user_desgn"></td>
								</tr>
                                <tr>
									<td> Category<sup>*</sup> </td>
									<td><select name="user_category" id="user_category" class="text2">
                                        	<option value="">---select---</option>
                                        	<option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select></td>
								</tr>
								<tr>
									<td> Email<sup>*</sup> </td>
									<td><input type="text" class="text2" name="emailid" id="emailid"></td>
								</tr>
								<tr>
									<td> Contact Number <sup>*</sup> </td>
									<td>
                                    	<input type="text" class="text2" name="conct_no" id="conct_no">
                                    </td>
								</tr>
                                <tr>
									<td style="width:20%;"> Set Password <sup>*</sup> </td>
									<td><input type="password" class="text2" name="Set_pwd" id="Set_pwd"></td>
								</tr>
                                 <tr>
									<td style="width:20%;"> Confirm Password <sup>*</sup> </td>
									<td><input type="password" class="text2" name="conf_pwd" id="conf_pwd"></td>
								</tr>
                                
                               <tr>
									<td> Dashboard Privileges<sup>*</sup> 
                                    <br>
                                     <input type='checkbox' name='all_prvilages' id='all_prvilages'  >Select All Privileges
                                    
                                    </td>
									<td>
                                    	<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='order_tab' value='Sales'>Orders
                                        </legend>
											<input type='checkbox' name='order_tab[]' id='orders' value='orders' onClick="check_orders_tab()">Orders &nbsp;&nbsp;
											<input type='checkbox' name='order_tab[]' id='track_orders' value='track_orders' onClick="check_orders_tab()" >Track Orders &nbsp;&nbsp;
											<input type='checkbox' name='order_tab[]' id='returns' value='returns' onClick="check_orders_tab()" >Returns &nbsp;&nbsp;
											<input type='checkbox' name='order_tab[]' id='tax' value="tax" onClick="check_orders_tab()" >Tax &nbsp;&nbsp;
											
											<!--<input type='checkbox' name='order_tab[]' id='credit_memos' value='credit_memos' onClick="check_sales_tab()" >Credit Memos&nbsp;&nbsp;
											<input type='checkbox' name='order_tab[]' id='transactions' value='transactions' onClick="check_sales_tab()" >Transactions&nbsp;&nbsp;
											<input type='checkbox' name='order_tab[]' id='terms_conditions' value='terms_conditions' onClick="check_sales_tab()" >Terms&Conditions&nbsp;&nbsp;-->
                                        </fieldset>
                                        <br>
										
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Payments_tab' value='Payments'>Payments 
                                        </legend>
											<input type='checkbox' name='Payments_tab[]' id='payout' value='payout' onClick="check_payments_tab()">Payout &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='seller_payout' value='seller_payout' onClick="check_payments_tab()">Seller Payout &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='buyer_refund' value='buyer_refund' onClick="check_payments_tab()">Buyer Refund &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='buyer_wallet' value="buyer_wallet" onClick="check_payments_tab()">Buyer Wallet &nbsp;&nbsp;
											<input type='checkbox' name='Payments_tab[]' id='ledger' value="ledger" onClick="check_payments_tab()">Ledger &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
                                        
                                        <fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Catalog_tab' value='Catalog'>Catalog
                                        </legend>
											<input type='checkbox' name='Catalog_tab[]' id='manage_product' value='manage_product' onClick="check_catalog_tab()" >Manage Product &nbsp;&nbsp;
											<input type='checkbox' name='Catalog_tab[]' id='manage_catageories' value='manage_catageories' onClick="check_catalog_tab()" >Manage Categories&nbsp;&nbsp;
											<input type='checkbox' name='Catalog_tab[]' id='attributes' value='attributes' onClick="check_catalog_tab()" >Attributes&nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
                                        <fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Sellers_tab' value='Sellers'>Sellers
                                        </legend>                                        
											<input type='checkbox' name='Sellers_tab[]' id='sellers' value='sellers' onClick="check_Sellers_tab()" >Sellers &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='product_for_approval' value='product_for_approval' onClick="check_Sellers_tab()" >Product For Approval &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='notification' value='notification' onClick="check_Sellers_tab()" >Notification &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='dispatch_time' value='dispatch_time' onClick="check_Sellers_tab()" >Dispatch Time &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='badge_membership' value='badge_membership' onClick="check_Sellers_tab()" >Badge & Membership &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='defaulter_seller' value='defaulter_seller' onClick="check_Sellers_tab()" >Defaulter Seller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='courier_setup' value='courier_setup' onClick="check_Sellers_tab()" >Courier Setup &nbsp;&nbsp;
											<input type='checkbox' name='Sellers_tab[]' id='terms_conditions' value='terms_conditions' onClick="check_Sellers_tab()" >Terms & Conditions &nbsp;&nbsp;
											</fieldset>
                                        <br>
										
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Customer_tab' value='Customer'>Customer
                                        </legend>                                        
											<input type='checkbox' name='Customer_tab[]' id='manage_customers' value='manage_customers' onClick="check_Customer_tab()" >Manage Customers &nbsp;&nbsp;
										</fieldset>
                                        <br>
										
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Pages_tab' value='Pages' >Pages
                                        </legend>                                        
											<input type='checkbox' name='Pages_tab[]' id='pages' value='pages' onClick="check_Pages_tab()" >Pages&nbsp;&nbsp;                                 
                                        </fieldset>
                                        <br>
										
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Reports_tab' value='Reports' >Reports
                                        </legend>
											<input type='checkbox' name='Reports_tab[]' id='order_report' value='order_report' onClick="check_Reports_tab()" >Order Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='return_order_report' value='return_order_report' onClick="check_Reports_tab()" >Return Order Report &nbsp;&nbsp;
											<!---<input type='checkbox' name='Reports_tab[]' id='sales_report' value='sales_report' onClick="check_Reports_tab()" >Sales Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='seller_report' value='seller_report' onClick="check_Reports_tab()" >Seller Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='product_report' value='product_report' onClick="check_Reports_tab()" >Products Reports &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='top_selling_by_seller' value='top_selling_by_seller' onClick="check_Reports_tab()" >Top Selling Product By Seller &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='buyer_report' value='buyer_report' onClick="check_Reports_tab()" >Buyer Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='buyer_wallet_report' value='buyer_wallet_report' onClick="check_Reports_tab()" >Buyer Wallet Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='seller_payout_report' value='seller_payout_report' onClick="check_Reports_tab()" >Seller Payout Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='tax_report' value='tax_report' onClick="check_Reports_tab()" >Tax Report &nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='seller_profile_report' value='seller_profile_report' onClick="check_Reports_tab()" >Seller Profile Report &nbsp;&nbsp;&nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='buyer_profile_report' value='buyer_profile_report' onClick="check_Reports_tab()" >Buyer Profile Report &nbsp;&nbsp;
											
											<input type='checkbox' name='Reports_tab[]' id='shopping_cart_report' value='shopping_cart_report' onClick="check_Reports_tab()" >Shopping Cart&nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='customer_report' value='customer_report' onClick="check_Reports_tab()" >Customers&nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='tags_report' value='tags_report' onClick="check_Reports_tab()" >Tags&nbsp;&nbsp;
											<input type='checkbox' name='Reports_tab[]' id='reviews_report' value='reviews_report' onClick="check_Reports_tab()" >Reviews&nbsp;&nbsp;-->
										</fieldset> 
                                        <br>
										
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Newsletter_tab' value='Newsletter'>Newsletter
                                        </legend>                                        
											<input type='checkbox' name='newsletter_chk[]' id='newsletter_chk' value='News_letter' onClick="check_Newsletter_tab()" >Newsletter &nbsp;&nbsp;
                                        </fieldset>
										<br>
										
										<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Config_tab' value='Config'>Config
                                        </legend>                                        
											<input type='checkbox' name='Config_tab[]' id='membership' value='membership' onClick="check_Config_tab()" >Membership &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='seller_commission' value='seller_commission' onClick="check_Config_tab()" >Seller Commission &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='other_charges' value='other_charges' onClick="check_Config_tab()" >Other Charges &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='homepage_image_setting' value='homepage_image_setting' onClick="check_Config_tab()" >Homepage Image Setting &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='user_role' value='user_role' onClick="check_Config_tab()" >Users &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='voucher' value='voucher' onClick="check_Config_tab()" >Voucher <br> 
											<input type='checkbox' name='Config_tab[]' id='category_menu_setup' value='category_menu_setup' onClick="check_Config_tab()" >Category Menu Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='cod_setup' value='cod_setup' onClick="check_Config_tab()" >COD Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='filter_setup' value='filter_setup' onClick="check_Config_tab()" >Filter Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='size_colour' value='size_colour' onClick="check_Config_tab()" >Size & Colour Setup &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='category_att_link' value='category_att_link' onClick="check_Config_tab()" >Category Attribute Link Setup <br>
											<input type='checkbox' name='Config_tab[]' id='bulk_product_log' value='bulk_product_log' onClick="check_Config_tab()" >Bulk Product Log &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='bulk_product_excel_track' value='bulk_product_excel_track' onClick="check_Config_tab()" >Bulk New Product Excelsheet Tracking &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='bulk_product_delete' value='bulk_product_delete' onClick="check_Config_tab()" >Bulk Product Delete &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='advance_search' value='advance_search' onClick="check_Config_tab()" >Advance Search &nbsp;&nbsp;<br>
											<input type='checkbox' name='Config_tab[]' id='search_keyword_setup' value='search_keyword_setup' onClick="check_Config_tab()" >Search Keyword Setup 
											<input type='checkbox' name='Config_tab[]' id='page_design' value='page_design' onClick="check_Config_tab()" >Page Design &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='manage_cache' value='manage_cache' onClick="check_Config_tab()" >Manage Cache &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='manage_solar_index' value='manage_solar_index' onClick="check_Config_tab()" >Manage Solar Indexing &nbsp;&nbsp;
											<input type='checkbox' name='Config_tab[]' id='solar_index' value='solar_index' onClick="check_Config_tab()" >Solar Indexing &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
										<fieldset style="border:1; background-color:#CCC;">
                                        <legend>
											<input type='checkbox' name='main_tab[]' id='log_tab' value='Log'>Log
										</legend>
											<input type='checkbox' name='log_tab[]' id='email_log' value='email_log' onClick="check_log_tab()" >Email Log &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
										
                                        <fieldset style="border:1; background-color:#CCC;">
                                        <legend>
											<input type='checkbox' name='main_tab[]' id='bdm_tab' value='BDM'>BDM
										</legend>
											<input type='checkbox' name='bdm_tab[]' id='bdm' value='seller_profile' onClick="check_bdm_tab()" >BDM &nbsp;&nbsp;
                                        </fieldset>
                                        <br>
                                        
                                        <!--<fieldset style="border:1; background-color:#CCC;">
										<legend>
											<input type='checkbox' name='main_tab[]' id='Promotions_tab' value='Promotions_main'>Promotions
										</legend>
											<input type='checkbox' name='Promotions_tab[]' id='manage_coupons' value='manage_coupons' onClick="check_Promotions_tab()" >Manage Coupons&nbsp;&nbsp;            
                                        </fieldset>
                                        <br>-->
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