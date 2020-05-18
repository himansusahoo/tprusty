<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$rows =count($autofilldata);
if($rows > 0)
  {
	  foreach($autofilldata as $row)
	  	{
		  echo "<li onclick=getcatgname("."'".str_replace(" ", "-", $row['lvl2_name'])."'".","."'".$row['lvl2']."'".")>".$row['lvlmain_name'].">>".$row['lvl1_name'].">>".$row['lvl2_name']."</li>";
	 	}
  }else{
	  echo '<li>No Record Found</li>';
  }
?>