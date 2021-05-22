<?php
$ccavenue_order_id = $this->session->userdata('sessccavenue_order_id');
$moonboy_trans_id = $this->session->userdata('sessmoonboy_trans_id');

$ccavenue_data_arr=array(
	'tid'=>$moonboy_trans_id,
	'merchant_id'=>MID,
	'order_id'=>$ccavenue_order_id,
	//'amount'=>$total_price,
	'amount'=>1,
	//'amount'=>1,
	'currency'=>'INR',
	'redirect_url'=>APP_BASE.'Online_payment/ccav_response_handler',
	'cancel_url'=>APP_BASE.'Online_payment/ccav_response_handler',
	'language'=>'EN',
	'billing_name'=>$cus_data->full_name,
	'billing_address'=>$cus_data->address,
	'billing_city'=>$cus_data->city,
	'billing_state'=>$cus_data->state_name,
	'billing_zip'=>$cus_data->pin_code,
	'billing_country'=>$cus_data->country,
	'billing_tel'=>$cus_data->phone,
	'billing_email'=>$cus_data->email,
	'integration_type'=>'iframe_normal'
);
?>
    
    <!--ccAvenue Iframe data start-->
    
    <?php include('Crypto.php')?>

<?php 

	//error_reporting(0);
	
	$working_key=WORKING_KEY;//Shared by CCAVENUES
	$access_code=ACCESS_CODE;//Shared by CCAVENUES
	$merchant_data='';
	
	//foreach ($_POST as $key => $value){
	
	foreach ($ccavenue_data_arr as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

	$production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;

?>
<iframe src="<?php echo $production_url?>" id="paymentFrame" width="800" height="515"  frameborder="0" scrolling="auto" ></iframe>

<!--ccAvenue Iframe data end-->