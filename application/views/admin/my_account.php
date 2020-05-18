<?php
require_once('header.php');
?>			
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_about.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
						<div class="col-md-8"><b>My Account</b></div>
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons">Reset</button>
							<button type="button" class="all_buttons">Save Account</button>
						</div>
					</div>
					<div class="form_view">
						<h3>Account Information</h3>
						<form>
							<table>
								<tr>
									<td style="width:20%;"> User Name * </td>
									<td><input type="text" class="text2" name="uname" value="admin"></td>
								</tr>
								<tr>
									<td> First Name * </td>
									<td><input type="text" class="text2" name="fname" value="admin"></td>
								</tr>
								<tr>
									<td> Last Name * </td>
									<td><input type="text" class="text2" name="lname" value="admin"></td>
								</tr>
								<tr>
									<td> Email * </td>
									<td><input type="text" class="text2" name="email" value="admin@gmail.com"></td>
								</tr>
								<tr>
									<td> Current Admin Password  * </td>
									<td><input type="text" class="text2" name="current_password"></td>
								</tr>
								<tr>
									<td> New Password </td>
									<td><input type="text" class="text2" name="new_password"></td>
								</tr>
								<tr>
									<td> Password Confirmation </td>
									<td><input type="text" class="text2" name="cnf_password"></td>
								</tr>
							</table>
						</form>
					</div>
				</div><!--   End of Main-content  -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>	