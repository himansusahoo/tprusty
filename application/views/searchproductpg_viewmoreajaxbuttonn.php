 <?php $sl=49; 
 $this->load->helper(array('html','form','url'));
 ?>
 
 <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img"/>
            <?php if(@$no_of_product > $sl){ ?>
            <input type="button" style="display:none;" class="add-to-cart view_mor" id="viewmore_prodbtnid" value="view more new" name="button" onClick="ShowMoreData('<?=@$no_of_product;?>')">
            <input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
            <?php } ?>