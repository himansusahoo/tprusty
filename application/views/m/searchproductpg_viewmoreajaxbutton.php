 <?php $sl=49; 
 $this->load->helper(array('html','form','url'));
 ?>

<img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none;" width="24px"/>
            <?php if(@$no_of_product > $sl){ ?>
            <input style="display:none;" type="button" class="btn-sign-in view_mor" value="View more" name="button" id="viewmore_prodbtnid" onClick="ShowMoreData('<?=$no_of_product;?>')">
            <input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
            <?php } ?>