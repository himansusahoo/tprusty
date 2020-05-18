 <?php $sl=49; 
 $this->load->helper(array('html','form','url'));
 ?>
 
 <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img"/>
            <?php if(@$no_of_product > $sl){ ?>
            <input type="button" class="add-to-cart view_mor" value="view more" name="button" onClick="ShowMoreData('<?=@$no_of_product;?>')">
            <?php } ?>