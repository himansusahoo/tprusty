<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordercount_cornjobmodel extends CI_Model {
	
	
	
	function updatecount_transferedorder($order_transfercount)
	{
		$this->db->query("update order_count set count_order='$order_transfercount' where count_id=1 ");
			
	}
	
	function updatecount_returnorder($order_returncount)
	{
		$this->db->query("update order_count set count_order='$order_returncount' where count_id=2 ");	
	}
	
	function updatecount_replacementorder($order_replacementcount)
	{
		$this->db->query("update order_count set count_order='$order_replacementcount' where count_id=3 ");	
	}
	
	function updatecount_graceperiodorder($order_graceperiodcount)
	{
		$this->db->query("update order_count set count_order='$order_graceperiodcount' where count_id=4 ");	
	}
	
	function updatecount_sellerpayout($payout_sellercount)
	{
		$this->db->query("update order_count set count_order='$payout_sellercount' where count_id=5 ");	
	}
	
	function updatecount_buyerrefund($refund_buyercount)
	{
		$this->db->query("update order_count set count_order='$refund_buyercount' where count_id=6 ");		
	}
	
	
}