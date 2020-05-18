<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=myfil.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
       <div style="padding-left:250px;">
       <table width="65%" border="0">
       <tr><td>  <?php echo $filetest; ?></td></tr>
       </table>


      </div>
      <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
        
</div>