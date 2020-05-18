<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returned_order_model extends CI_Model {
	
	function select_retun_order()
	{
		$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date, b.date_of_order, b.order_status, d.full_name  from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Return Requested' group by b.order_id ");
		
		return $query;	
	
	
	}
	
	function filter_return_order()
	{
		    $shipment = $this->input->post('shipment');
		   // print_r($shipment);exit;
			
			$shipped_from = $this->input->post('shipped_from2');			
						
			$shipped_to = $this->input->post('shipped_to2');
				//print_r($shipped_from);exit;	
			$order = $this->input->post('order');
			
			$order_from = $this->input->post('order_from');
			
			$order_to = $this->input->post('order_to');
			//print_r($order_from);exit;
			$order_status = $this->input->post('order_status1');	
			//print_r($order_status);exit;			
			
			$billing_name = $this->input->post('billing_name');
			
			$condition = '';
			if( $shipment!='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "a.shipment_no='$shipment'" ;}
			if( $shipment=='' && $shipped_from!='' && $shipped_to!='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "a.shipping_date>='$shipped_from' and a.shipping_date<='$shipped_to'" ;}		
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order!='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "a.order_id='$order'" ;}	
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from!='' && $order_to!='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "b.date_of_order>='$order_from' and b.date_of_order<='$order_to'" ;}			
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status!='' && $billing_name=='' ){
				    $condition .= "b.order_status='$order_status'" ;}	
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name!='' ){
				    $condition .= "d.fname='$billing_name'" ;}		
						
					//echo $condition;exit; 
					
			$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date, b.date_of_order, b.order_status, d.full_name from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Return Requested' AND ".$condition."");
		
		return $query;	
					
	}
	
	
	function select_retun_order_complete()
	{
		$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date, b.date_of_order, b.order_status, d.full_name from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Return Received' group by b.order_id ");
		return $query;	
	}
	
	
	function filter_retun_order_complete()
	{
	        $shipment = $this->input->post('shipment');
		   // print_r($shipment);exit;
			
			$shipped_from = $this->input->post('shipped_from');			
						
			$shipped_to = $this->input->post('shipped_to');
				//print_r($shipped_to);exit;	
			$order = $this->input->post('order');
			
			$order_from = $this->input->post('order_from');
			
			$order_to = $this->input->post('order_to');
			//print_r($order_from);exit;
			$order_status = $this->input->post('order_status');	
			//print_r($order_status);exit;			
			
			$billing_name = $this->input->post('billing_name');	
			
			$condition = '';
			if( $shipment!='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "a.shipment_no='$shipment'" ;}
			if( $shipment=='' && $shipped_from!='' && $shipped_to!='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "a.shipping_date>='$shipped_from' and a.shipping_date<='$shipped_to'" ;}		
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order!='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "a.order_id='$order'" ;}	
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from!='' && $order_to!='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "b.date_of_order>='$order_from' and b.date_of_order<='$order_to'" ;}			
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status!='' && $billing_name=='' ){
				    $condition .= "b.order_status='$order_status'" ;}	
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name!='' ){
				    $condition .= "d.fname='$billing_name'" ;}		
			if( $shipment=='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){		
						
				$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date, b.date_of_order, b.order_status, d.full_name  from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Return Received'");
		
		return $query;	
			}
					//echo $condition;exit; 
			$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date, b.date_of_order, b.order_status, d.full_name from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Return Received' AND ".$condition."");
		
		return $query;	
					
			
	}

}