<!--<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="<?php //echo $data->meta_descrp ;?>" content="">
        <meta name="<?php //echo $data->meta_keyword ;?>" content="" />
        
		<meta name="author" content="">
		<title><?php //echo $data->title ;?></title>
        
 

<div class="main-content">
<div class="clearfix">  </div>
<div  class="checkout"  align="center">-->

<?php //include('Crypto.php')?>

<?php 
	//$working_key='A6E109AE1CF65837E8964E0B04552D21';//Shared by CCAVENUES
//	$access_code='AVOE00BA76CA08EOAC';//Shared by CCAVENUES
//	$merchant_data='';
//	
//	foreach ($_POST as $key => $value){
//		
//		$merchant_data.=$key.'='.$value.'&';
//		
//	}
//	
//	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
//
//	$production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
//	
?>
<!--<iframe src="<?php //echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>
-->
<!--<script type="text/javascript" src="<?php //echo base_url().'js/jquery-1.7.2.js' ?>"></script>
<script type="text/javascript">
    	$(document).ready(function(){
    		 window.addEventListener('message', function(e) {
		    	 $("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
		 	 }, false);
	 	 	
		});
</script> -->

  <!-- end main content -->

<!--</div>-->


<!----------------------------ccavenue request handler start---------------------------->

	<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	error_reporting(0);
	
	$merchant_data='';
	$working_key='A6E109AE1CF65837E8964E0B04552D21';//Shared by CCAVENUES
	$access_code='AVOE00BA76CA08EOAC';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>



<!----------------------------ccavenue request handler end---------------------------->