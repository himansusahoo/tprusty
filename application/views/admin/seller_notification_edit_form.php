<?php
require_once('header.php');
?>

<script type="text/javascript" src="<?php echo base_url().'asset/ckeditor/ckeditor.js' ?>"></script>

		<div id="content">
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_sellers.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
				<div class="form_view">
					<h3>Create Seller Notice</h3>
<?php if(validation_errors()) : ?>
<h4 class="a-center validation_error"><?php echo validation_errors(); ?></h4>
<?php
endif;

$attributes = array('name' => 'seller_notification_form');
			echo form_open_multipart('admin/sellers/seller_notification_update', $attributes);
?>
						<table>
							<tr>
								<td><label>Title <sup>*</sup>: <label></td>
								<td><input type="text" class="text2" name="title" value="<?php echo $result ? $result[0]->title : " "; ?>">
									<input type="hidden" name="hidden_id" value="<?php echo $result ? $result[0]->id : " "; ?>">
								</td>
							</tr>
							<tr>
								<td><label>Content <sup>*</sup>: <label></td>
								<td>
									<textarea name="page_content" class="text"><?php echo $result ? $result[0]->content : " "; ?></textarea>
									<script type="text/javascript">
										CKEDITOR.replace('page_content');
									</script>
								</td>
							</tr>
							<tr>
								<td><label>Status <sup>*</sup>: <label></td>
								<td>
									<select name="status" class="text2">
										<option value="">--Select Status--</option>
										<option value="Active" <?php if($result[0]->status == 'Active'){?>selected="selected"<?php } ?> >Active</option>
										<option value="Inactive" <?php if($result[0]->status == 'Inactive'){?>selected="selected"<?php } ?> >Inactive</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><input type="submit" name="submit" class="all_buttons" value="Save"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->


<?php
require_once('footer.php');
?>					