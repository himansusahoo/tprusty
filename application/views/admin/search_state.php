<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
  $ct=$autofilldata->num_rows();
  if($ct>0)
  {
	   foreach($autofilldata->result() as $rs)
	  {?>
      
    <option value="<?php echo $rs->state; ?>"> <?php echo $rs->state; ?> </option>

	<?php   } } ?>