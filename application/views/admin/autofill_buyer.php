<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$rows = $autofilldata->num_rows();
if($rows > 0)
  {
	  foreach($autofilldata->result() as $row)
	  	{
		  echo "<li onclick=getslrname("."'".str_replace(" ", "-", $row->fname)."'".")>".$row->fname."</li>";
	 	}
  }else{
	  echo '<li>No Record Found</li>';
  }
?>