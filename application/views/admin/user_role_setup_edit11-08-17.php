<?php
require_once('header.php');
?>


<script>
$(document).ready(function(){
	$('#sales_tab').click(function(){
		$('#orders').prop('checked', this.checked);
		$('#track_orders').prop('checked', this.checked);
		$('#returns').prop('checked', this.checked);
		$('#credit_memos').prop('checked', this.checked);
		$('#transactions').prop('checked', this.checked);
		$('#terms_conditions').prop('checked', this.checked);
		$('#tax').prop('checked', this.checked);
		
	
});

    


     $('#Catalog_tab').click(function(){
                                            
     $('#manage_product').prop('checked', this.checked);
     $('#manage_catageories').prop('checked', this.checked);
     $('#attributes').prop('checked', this.checked);
     $('#shipment_setting').prop('checked', this.checked);
     $('#review_ratings').prop('checked', this.checked);
     $('#tags').prop('checked', this.checked);                                                                            
		
     
   });


     $('#Sellers_tab').click(function(){
		                                             
     $('#sellers').prop('checked', this.checked);
     $('#promotion').prop('checked', this.checked);
     $('#product_approval').prop('checked', this.checked);
     $('#product_list').prop('checked', this.checked);
     $('#notification_despatch_time').prop('checked', this.checked);
     $('#membership_badge').prop('checked', this.checked);                                                                            
	 $('#seller_billing').prop('checked', this.checked); 
	 	
     
   });
   
   $('#bdm_tab').click(function(){
		                                             
     $('#bdm').prop('checked', this.checked);
    
     
   }); 
   
     $('#Customer_tab').click(function(){
		                                             
     $('#manage_customers').prop('checked', this.checked);
     $('#customers').prop('checked', this.checked);
    
	 	
     
   });
   
   
 
     $('#Promotions_tab').click(function(){
		                                             
     $('#manage_coupons').prop('checked', this.checked);    
	 	
     
   });
  
                                          
  
     $('#Pages_tab').click(function(){
		                                             
     $('#pages').prop('checked', this.checked);
     
	 	
      
   });
   
   

     $('#Reports_tab').click(function(){
		                                             
     $('#order_report').prop('checked', this.checked);
	 $('#return_order_report').prop('checked', this.checked);
     $('#shopping_cart_report').prop('checked', this.checked);
     $('#product_report').prop('checked', this.checked);
     $('#customer_report').prop('checked', this.checked);
     $('#tags_report').prop('checked', this.checked);
     $('#reviews_report').prop('checked', this.checked);                                                                            
	
	 	
     
   });
  
     $('#Newsletter_tab').click(function(){
		                                             
     $('#newsletter_chk').prop('checked', this.checked);
     
      
   });
           

     $('#Customer_tab').click(function(){
		                                             
     $('#manage_customers').prop('checked', this.checked);
       $('#customers').prop('checked', this.checked);
     
     
   }); 
   
   
  

     $('#Config_tab').click(function(){
		                                             
     $('#membership').prop('checked', this.checked);
     $('#seller_commission').prop('checked', this.checked);
     $('#other_charges').prop('checked', this.checked);
     $('#homepage_image_setting').prop('checked', this.checked);
	  $('#user_role').prop('checked', this.checked);
	 $('#addto_filter').prop('checked', this.checked);
     //$('#tags_chk').prop('checked', this.checked);
//     $('#reviews').prop('checked', this.checked);                                                                            
	
	 	
     
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
                                    	<fieldset style="border:1; background-color:#CCC;"><legend><input type='checkbox' name='main_tab[]' id='sales_tab' value='Sales' <?php if( @$user_role_info[0]->main_tab_name=='Sales') echo "checked"?> >Sales
                                        
                                        														                                        
                                        
                                        </legend> 
                                                                               
                                        <input type='checkbox' name='sales_tab[]' id='orders' value='orders' onClick="check_sales_tab()" 
										<?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='orders') echo "checked"; }?>  >Orders &nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='sales_tab[]' id='track_orders' value='track_orders' onClick="check_sales_tab()" 
                                        <?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='track_orders') echo "checked"; }?>>Track Orders&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='sales_tab[]' id='returns' value='returns' onClick="check_sales_tab()"
                                        <?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='returns') echo "checked"; }?> >Returns&nbsp;&nbsp;
                                                                                
                                        <input type='checkbox' name='sales_tab[]' id='credit_memos' value='credit_memos' onClick="check_sales_tab()" 
                                        <?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='credit_memos') echo "checked"; }?>>Credit Memos&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='sales_tab[]' id='transactions' value='transactions' onClick="check_sales_tab()" 
                                       <?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='transactions') echo "checked"; }?>>Transactions&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='sales_tab[]' id='terms_conditions' value='terms_conditions' onClick="check_sales_tab()"
                                         <?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='terms_conditions') echo "checked"; }?> >Terms&Conditions&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='sales_tab[]' id='tax' value="tax" onClick="check_sales_tab()"
                                       <?php foreach($user_role_info as $rw){ if($rw->sub_tab_name=='tax') echo "checked"; }?> >Tax&nbsp;&nbsp;
                                        </fieldset>
                                        <br>
                                        
                                        <?php
										
										
										$query1=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Catalog'  ");
		
		$row1=$query1->result();
									
										 ?>
                                        
                                        <fieldset style="border:1; background-color:#CCC;"><legend><input type='checkbox' name='main_tab[]' id='Catalog_tab' value='Catalog'
                                        <?php if( @$row1[0]->main_tab_name=='Catalog') echo "checked"?>>Catalog
                                        <!--<input type='hidden' name='Catalog_tab_txthidden' id='Catalog_tab_txthidden' value='Catalog'>-->
                                        </legend>                                       
                                        
                                                                               
                                        <input type='checkbox' name='Catalog_tab[]' id='manage_product' value='manage_product' onClick="check_catalog_tab()"  
										<?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='manage_product') echo "checked"; }?> >Manage Product &nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Catalog_tab[]' id='manage_catageories' value='manage_catageories' onClick="check_catalog_tab()" 
                                        <?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='manage_catageories') echo "checked";}?> >Manage Categories&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Catalog_tab[]' id='attributes' value='attributes' onClick="check_catalog_tab()" 
                                        <?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='attributes') echo "checked";} ?> >Attributes&nbsp;&nbsp;
                                                                             
                                        <input type='checkbox' name='Catalog_tab[]' id='shipment_setting' value='shipment_setting' onClick="check_catalog_tab()" 
                                        <?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='shipment_setting') echo "checked"; }?>>Shipment Setting&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Catalog_tab[]' id='review_ratings' value='review_ratings' onClick="check_catalog_tab()" 
                                         <?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='review_ratings') echo "checked"; }?>
                                        >Reviews & Ratings&nbsp;&nbsp;
                                        <input type='checkbox' name='Catalog_tab[]' id='tags' value='tags' onClick="check_catalog_tab()" 
                                        <?php foreach($row1 as $rw1){ if($rw1->sub_tab_name=='tags') echo "checked";} ?>>Tags&nbsp;&nbsp;                                        
                                        </fieldset>
                                        
                                        <br>
                                        
                                          <?php
																			
										$query2=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Sellers'  ");
		
		$row2=$query2->result();
									
										 ?>
                                        
                                        <fieldset style="border:1; background-color:#CCC;"><legend> <input type='checkbox' name='main_tab[]' id='Sellers_tab' value='Sellers'
                                        <?php if( @$row2[0]->main_tab_name=='Sellers') echo "checked" ?> >Sellers
                                       
                                       <!-- <input type='hidden' name='Sellers_tab_txthidden' id='Sellers_tab_txthidden' value='Sellers'>-->                            
                                        </legend>                                        
                                        <input type='checkbox' name='Sellers_tab[]' id='sellers' value='sellers' onClick="check_Sellers_tab()" 
										<?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='sellers') echo "checked";} ?> >Sellers &nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Sellers_tab[]' id='promotion' value='promotion' onClick="check_Sellers_tab()" 
                                        <?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='promotion') echo "checked";} ?>>Promotions Categories&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Sellers_tab[]' id='product_approval' value='product_approval' onClick="check_Sellers_tab()" 
                                        <?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='product_approval') echo "checked";} ?> >ProductApproval&nbsp;&nbsp; 
                                           
                                        <input type='checkbox' name='Sellers_tab[]' id='product_list' value='product_list' onClick="check_Sellers_tab()" 
                                        <?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='product_list') echo "checked";} ?> >Product List&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Sellers_tab[]' id='notification_despatch_time' value='notification_despatch_time'onClick="check_Sellers_tab()" <?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='notification_despatch_time') echo "checked";} ?> >Notification&Despatch Time&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Sellers_tab[]' id='membership_badge' value='membership_badge' onClick="check_Sellers_tab()" 
                                        <?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='membership_badge') echo "checked";} ?>>Membership Badge&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Sellers_tab[]' id='seller_billing' value='seller_billing' onClick="check_Sellers_tab()"
                                        <?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='seller_billing') echo "checked";} ?> >Seller's Billing&nbsp;&nbsp;           
                                        </fieldset>
                                        
                                        <br>
                                        
                                        
                                        <?php
																			
										$query2=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='BDM'  ");
		
		$row2=$query2->result();
									
										 ?>
                                        
                                        <br>
                                        <fieldset style="border:1; background-color:#CCC;">
                                        <legend> <input type='checkbox' name='main_tab[]' id='bdm_tab' value='BDM'
                                        <?php if( @$row2[0]->main_tab_name=='BDM') echo "checked" ?>
                                        >BDM</legend>                                        
                                        <input type='checkbox' name='Sellersbdm_tab[]' id='bdm' value='seller_profile' onClick="check_bdm_tab()" 
                                        <?php foreach($row2 as $rw2){ if($rw2->sub_tab_name=='seller_profile') echo "checked";} ?>>BDM &nbsp;&nbsp;
                                        
                                        </fieldset>
                                        
                                        <br>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                         <?php
																			
										$query3=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Customer'  ");
		
		$row3=$query3->result();				 ?>
                                        
                                        <fieldset style="border:1; background-color:#CCC;"><legend><input type='checkbox' name='main_tab[]' id='Customer_tab' value='Customer'
                                        <?php if(@$row3[0]->main_tab_name=='Customer') echo "checked" ?>>Customer
                                         <!--<input type='hidden' name='Customer_tab_txthidden' id='Customer_tab_txthidden' value='Customer'>-->
                                   
                                        </legend>                                        
                                        <input type='checkbox' name='Customer_tab[]' id='manage_customers' value='manage_customers' onClick="check_Customer_tab()" 
                                        <?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='manage_customers') echo "checked";} ?> >Manage Customers &nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Customer_tab[]' id='customers' value='customers' onClick="check_Customer_tab()" 
                                         <?php foreach($row3 as $rw3){ if($rw3->sub_tab_name=='customers') echo "checked";} ?> >Customers&nbsp;&nbsp;                                
                                        </fieldset>
                                        
                                        <br>
                                        
                                        <?php
																			
										$query4=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Promotions_main'  ");
		
		$row4=$query4->result();				 ?>
                                         <fieldset style="border:1; background-color:#CCC;"><legend><input type='checkbox' name='main_tab[]' id='Promotions_tab' 
                                         value='Promotions_main' <?php if( @$row4[0]->main_tab_name=='Promotions_main') echo "checked" ?>>Promotions
                                         <!--<input type='hidden' name='Promotions_tab_txthidden' id='Promotions_tab_txthidden' value='Promotions'>-->
                                       </legend>                                        
                                        <input type='checkbox' name='Promotions_tab[]' id='manage_coupons' value='manage_coupons' onClick="check_Promotions_tab()" 
										<?php foreach($row4 as $rw4){ if($rw4->sub_tab_name=='manage_coupons') echo "checked";} ?>>Manage Coupons&nbsp;&nbsp;            
                                        </fieldset>
                                        
                                        <br>
                                         <?php
																			
										$query5=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Pages'  ");
		
		$row5=$query5->result();				 ?>
                                        
                                         <fieldset style="border:1; background-color:#CCC;"><legend><input type='checkbox' name='main_tab[]' id='Pages_tab' value='Pages' <?php if( @$row5[0]->main_tab_name=='Pages') echo "checked" ?> >Pages
                                         <!--<input type='hidden' name='Pages_tab_txthidden' id='Pages_tab_txthidden' value='Pages'>-->
                                         
                                         </legend>                                        
                                        <input type='checkbox' name='Pages_tab[]' id='pages' value='pages' onClick="check_Pages_tab()" 
                                        <?php foreach($row5 as $rw5){ if($rw5->sub_tab_name=='pages') echo "checked";} ?>>Manage Pages &nbsp;&nbsp;                                 
                                        </fieldset>
                                        <br>
                                        <?php
																			
										$query6=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Reports'  ");
		
		$row6=$query6->result();				 ?>
                                         <fieldset style="border:1; background-color:#CCC;"><legend> <input type='checkbox' name='main_tab[]' id='Reports_tab' value='Reports' 
                                         <?php if( @$row6[0]->main_tab_name=='Reports') echo "checked" ?>>Reports
                                        
                                         <!--<input type='hidden' name='Reports_tab_txthidden' id='Reports_tab_txthidden' value='Reports'>-->
                                       
                                         </legend>                                        
                                        <input type='checkbox' name='Reports_tab[]' id='order_report' value='order_report' onClick="check_Reports_tab()" 
                                        <?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='order_report') echo "checked";} ?>>Order Report &nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Reports_tab[]' id='return_order_report' value='Return_order_report' onClick="check_Reports_tab()" 
                                        
                                        <?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='Return_order_report') echo "checked";} ?>>Order Report &nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Reports_tab[]' id='shopping_cart_report' value='shopping_cart_report' onClick="check_Reports_tab()" 
                                        <?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='shopping_cart_report') echo "checked";} ?> >Shopping Cart&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Reports_tab[]' id='product_report' value='product_report' onClick="check_Reports_tab()" 
                                        <?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='product_report') echo "checked";} ?>>Products&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Reports_tab[]' id='customer_report' value='customer_report' onClick="check_Reports_tab()" 
                                        <?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='customer_report') echo "checked";} ?>>Customers&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Reports_tab[]' id='tags_report' value='tags_report' onClick="check_Reports_tab()" 
                                        <?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='tags_report') echo "checked";} ?>>Tags&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Reports_tab[]' id='reviews_report' value='reviews_report' onClick="check_Reports_tab()" 
										<?php foreach($row6 as $rw6){ if($rw6->sub_tab_name=='reviews_report') echo "checked";} ?> >Reviews&nbsp;&nbsp;
                                           </fieldset> 
                                        <br>   
                                        
                            <?php
																			
										$query7=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Newsletter'  ");
		
		$row7=$query7->result();				 ?>
                                        
                                         <fieldset style="border:1; background-color:#CCC;" ><legend> <input type='checkbox' name='main_tab[]' id='Newsletter_tab'
                                          value='Newsletter' <?php if( @$row7[0]->main_tab_name=='Newsletter') echo "checked" ?>>Newsletter
                                       <!-- <input type='hidden' name='Newsletter_tab_txthiden' id='Newsletter_tab_txthidden' value='Newsletter'>-->
                                
                                         </legend>                                        
                                        <input type='checkbox' name='newsletter_chk[]' id='newsletter_chk' value='News_letter' onClick="check_Newsletter_tab()" 
										<?php foreach($row7 as $rw7){ if($rw7->sub_tab_name=='News_letter') echo "checked";} ?> >Newsletter &nbsp;&nbsp;
                                          </fieldset>
                                       <br>               
                                                      
                            <?php
																			
										$query8=$this->db->query("select b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id' and b.main_tab_name='Config'  ");
		
		$row8=$query8->result();				 ?>
                                         <fieldset style="border:1; background-color:#CCC;"><legend><input type='checkbox' name='main_tab[]' id='Config_tab' value='Config'
                                         <?php if( @$row8[0]->main_tab_name=='Config') echo "checked" ?>>Config
                                       <!-- <input type='hidden' name='Config_tab_txthidden' id='Config_tab_txthidden' value='Config'>-->
                                       
                                         </legend>                                        
                                        <input type='checkbox' name='Config_tab[]' id='membership' value='membership' onClick="check_Config_tab()" 
										<?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='membership') echo "checked";} ?>>Membership &nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Config_tab[]' id='seller_commission' value='seller_commission' onClick="check_Config_tab()"
                                        <?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='seller_commission') echo "checked";} ?> >Seller Commission&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Config_tab[]' id='other_charges' value='other_charges' onClick="check_Config_tab()" 
                                        <?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='other_charges') echo "checked";} ?>>Other Charges&nbsp;&nbsp;                                        <input type='checkbox' name='Config_tab[]' id='homepage_image_setting' value='homepage_image_setting' onClick="check_Config_tab()"
                                        <?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='homepage_image_setting') echo "checked";} ?> >Homepage Image Setting&nbsp;&nbsp;
                                        
                                        
                                        <input type='checkbox' name='Config_tab[]' id='user_role' value='user_role' onClick="check_Config_tab()" 
                                        <?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='user_role') echo "checked";} ?> >Users&nbsp;&nbsp;
                                        
                                        <input type='checkbox' name='Config_tab[]' id='addto_filter' value='addto_filter' onClick="check_Config_tab()" 
                                        <?php foreach($row8 as $rw8){ if($rw8->sub_tab_name=='addto_filter') echo "checked";} ?> >Users
                                        <!--<input type='checkbox' name='Config_tab[]' id='tags_chk' value='Tags' onClick="check_Config_tab()" >Tags&nbsp;&nbsp;
                                        <input type='checkbox' name='Config_tab[]' id='reviews' value='Reviews' onClick="check_Config_tab()" >Reviews&nbsp;&nbsp;-->                                       
                                        </fieldset>
         
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