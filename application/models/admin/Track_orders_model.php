<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_orders_model extends CI_Model {
	
	function select_order_data()
	{
		/* $query=$this->db->query("select a.shipment_no,a.courier_name,a.tracking_no, a.order_id,a.shipping_date, b.date_of_order, b.order_status, d.fname,d.lname  from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join user d on c.user_id=d.user_id where b.order_status='Shipped' group by b.order_id "); */
		
		$query=$this->db->query("select a.shipment_no,a.courier_name,a.tracking_no, a.order_id,a.shipping_date, b.date_of_order, b.order_status, d.full_name from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Shipped' group by b.order_id ");
		return $query;
	}
	
	
	function select_delivered_order()
	{
		$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date,a.courier_name,a.tracking_no, b.date_of_order, b.order_status, d.full_name from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Delivered' group by b.order_id ");
		return $query;
	}
	
	
	function filter_order_in_transist()
	{
		
			$shipment = $this->input->post('shipment_no');
			
			$shipped_from = $this->input->post('shipped_from_1');		
				
						
			$shipped_to = $this->input->post('shipped_to_1');
			//print_r($shipped_from);exit;		
			$order = $this->input->post('order_no');
			
			$order_from = $this->input->post('order_from');
			
			$order_to = $this->input->post('order_to');
		    //print_r($order_from);exit;	
			$order_status = $this->input->post('order_status2');	
			//print_r($order_status);exit;			
			
			$ship_to_name = $this->input->post('ship_to_name');
			
			//$condition = "b.status='Active' AND c.status='Active'";
			
			$condition = '';
			
			if( $shipment!='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $ship_to_name=='' ){
				    $condition .= "a.shipment_no='$shipment'" ;}
				
			if($order!='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status=='' && $ship_to_name==''){
					$condition .= "a.order_id='$order'" ;}
					
			if($ship_to_name!='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status=='' && $order==''){
					$condition .= "d.fname='$ship_to_name'" ;}
			
			if($ship_to_name=='' && $shipped_from!='' && $shipped_to!='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status=='' && $order==''){
					$condition .= "a.shipping_date>='$shipped_from' and a.shipping_date<='$shipped_to'" ;}	
					
			if($ship_to_name=='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status!='' && $order==''){
					$condition .= "b.order_status='$order_status'" ;}	
					
			if($ship_to_name=='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from!='' && $order_to!='' && $order_status=='' && $order==''){
					$condition .= "b.date_of_order>='$order_from' and b.date_of_order<='$order_to'" ;}	
				
				
		//echo $condition;exit;
		
		$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date,a.courier_name,a.tracking_no, b.date_of_order, b.order_status, d.full_name from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Shipped' AND ".$condition."");
		
		return $query;
		
			
	}
	
	function filter_delivered_order()
	{
		    $shipment = $this->input->post('ship_to_name');
			//print_r($shipment);exit;
			
			$shipped_from = $this->input->post('shipped_from_1');			
						
			$shipped_to = $this->input->post('shipped_to_1');
					
			$order = $this->input->post('order_no');
			
			$order_from = $this->input->post('order_from');
			
			$order_to = $this->input->post('order_to');
			//print_r($order_from);exit;
			$order_status = $this->input->post('order_status1');	
			//print_r($order_status);exit;			
			
			$billing_name = $this->input->post('billing_name');
			$condition = '';
			
			if( $shipment!='' && $shipped_from=='' && $shipped_to=='' && $order=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name=='' ){
				    $condition .= "a.shipment_no='$shipment'" ;}
				
			if($order!='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status=='' && $billing_name==''){
					$condition .= "a.order_id='$order'" ;}
					
			if($billing_name!='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status=='' && $order==''){
					$condition .= "d.fname='$billing_name'" ;}
			
			if($billing_name=='' && $shipped_from!='' && $shipped_to!='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status=='' && $order==''){
					$condition .= "a.shipping_date>='$shipped_from' and a.shipping_date<='$shipped_to'" ;}	
					
			if($billing_name=='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from=='' && $order_to=='' && $order_status!='' && $order==''){
					$condition .= "b.order_status='$order_status'" ;}	
					
			if($billing_name=='' && $shipped_from=='' && $shipped_to=='' && $shipment=='' && $order_from!='' && $order_to!='' && $order_status=='' && $order==''){
					$condition .= "b.date_of_order>='$order_from' and b.date_of_order<='$order_to'" ;}						
					
				
				$query=$this->db->query("select a.shipment_no, a.order_id,a.shipping_date,a.courier_name,a.tracking_no, b.date_of_order, b.order_status, d.full_name from shipment_info a inner join order_info b on a.order_id=b.order_id inner join ordered_product_from_addtocart c on b.order_id=c.order_id inner join shipping_address d on b.order_id=d.order_id where b.order_status='Delivered' AND ".$condition."");
		
		return $query;	
	}
	
	function select_shipmentinfo()
	{
		
	$query_courierinfo=$this->db->query("select * from  courier_info ");
	$res_courierinfo=$query_courierinfo->result();	
	return $res_courierinfo;
	}
	
}