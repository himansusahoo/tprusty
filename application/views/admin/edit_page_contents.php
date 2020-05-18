<script type="text/javascript" src="<?php echo base_url().'asset/ckeditor/ckeditor.js' ?>"></script>
<!--<script type="text/javascript" src="<?php //echo base_url().'asset/ckfinder/ckfinder.js' ?>"></script>-->

<?php
require_once('header.php');
?>
	<div id="content">
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_pages.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
		<div class="main-content">
			<div class="row content-header">
				<div class="col-md-8"><h4>Edit Page Content</h4></div>
			</div>	
			<div>
<?php
$attributes = array('name' => 'page_content_edit_form');
			echo form_open_multipart('admin/pages/update_page_content', $attributes);
?>
					<table>
						<tr>
							<td width="20%">Page Title</td>
							<td width="80%"><input type="text" name="title" class="text" value="<?php echo $result ? $result[0]->title : " "; ?>"></td>
						</tr>
						<tr>
							<td>Meta Keyword</td>
							<td><input type="text" name="meta_keyword" class="text" value="<?php echo $result ? $result[0]->meta_keyword : " "; ?>"></td>
						</tr>
						<tr>
							<td>Meta Description</td>
							<td>
								<textarea name="meta_description" rows="10" class="text"><?php echo $result ? $result[0]->meta_descrp : " "; ?></textarea>
								<!--<input type="text" name="meta_description" class="text" value=""></td>-->
						</tr>
						<tr>
							<td>Page content</td>
							<td>
								<textarea name="page_content" class="text"><?php echo $result ? $result[0]->content : " "; ?></textarea>
								<script type="text/javascript">
									CKEDITOR.replace('page_content');
								</script>
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<input type="hidden" name="page_id" value="<?php echo $result ? $result[0]->page_id : " "; ?>">
							</td>
						</tr>
						<tr>
							<td colspan="2" class="a-center"><input type="submit" name="Submit" value="Submit" class="seller_buttons" ></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>			