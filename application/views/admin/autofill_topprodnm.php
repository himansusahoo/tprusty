<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$rows = $autofilldatas->num_rows();
if($rows > 0)
  {
	  foreach($autofilldatas->result() as $row)
	  	{
		  echo "<li onclick=getprodname("."'".str_replace(" ", "-", $row->name)."'".")>".$row->name."</li>";
	 	}
  }else{
	  echo '<li>No Record Found</li>';
  }
?>