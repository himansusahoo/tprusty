<html>
<h4>Additional instruction for mailing Your package </h4>
<br/>
>> Securely pack the items in box.<br/>
>> Remember to include the Return Merchandise Authorisation inside the package.<br/>
>> Affix the maiing label squarely onto the address side of the parcel, covering up any previous delivery <br>
   address and barcode without overlapping any adjacent side.<br/>
>> Use the address listed in the Mailing label and affix the appropriate amount of postage.<br/>
>> Ship package from your nearest post office or courier company of your choice.
<br>
<br>
<?php echo "Order Id: ". $orderid ;
$qr_returnrequest_approv=$this->db->query("select c.name,c.seller_address,c.seller_city,c.seller_state,c.pincode from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join seller_account c on b.seller_id=c.seller_id where a.order_id='$orderid' and return_request_approve_status='Approved' ");
$row_returnrequest_approv=$qr_returnrequest_approv->result();



?>
Hi,

Thank you for contacting us. We are really sorry for this inconvenience.<br /><br />
Please send the package back to :<br /><br/>

<div style="font-weight:bold;">
<?= $row_returnrequest_approv[0]->name;  ?><br />
<?= $row_returnrequest_approv[0]->seller_address;  ?><br />
<?= $row_returnrequest_approv[0]->seller_city;  ?><br />
<?= $row_returnrequest_approv[0]->seller_state;  ?><br />
<?= $row_returnrequest_approv[0]->pincode;  ?>
</div>

<br/>
<br/>
<br/>
<br/>
Please let us know the tracking details of the returned pacakage and we will issue a refund to your account.

<br/>
<br/>
Thank you. 

</html>