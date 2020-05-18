 <select name="slctimage_size" id="slctimage_size" class="text2" onchange="populate_screenshot(this.value)" >
 <option>--select--</option>
	<?php foreach($img_size->result_array() as $img_sz) { ?>            	
		<option value="<?=$img_sz['img_size'];?>"><?=$img_sz['desktop_homepage_img_size'];?></option>
	<?php } ?>                
</select>