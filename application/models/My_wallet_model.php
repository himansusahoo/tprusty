<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_wallet_model extends CI_Model
{
	function select_wallet_data()
	{
		$user_id=$this->session->userdata['session_data']['user_id'];
		$qr=$this->db->query("select * from wallet_info where user_id='$user_id' ");
		return $qr->row();	
	}
	
	function retrieve_gift_voucher(){
		$query = $this->db->query("SELECT * FROM gift_voucher_master");
		return $query;
	}
	
	//if page refresh in payment process within 15 minutes
	/* function check_inn_wallet_adjustment(){
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$total_payble_amt = $this->session->userdata('sesstotal_price');
		$query = $this->db->query("SELECT * FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='W'");
		if($query->num_rows() > 0){
			
		}
	} */
	
	function calculating_adjustment(){
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$total_payble_amt = $this->session->userdata('sesstotal_price');
		/*
			code commented for not any adjustment with any mode of payment
					
		$query = $this->db->query("SELECT SUM(adj_amount) AS TOTAL_ADJ_AMT FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id'");
		if($query->num_rows() > 0){
			$result = $query->result();
			$adjust_amt = $result[0]->TOTAL_ADJ_AMT;
			$rest_payble_amt = $total_payble_amt-$adjust_amt;
			return $rest_payble_amt;
		}else{
			return false;
		}*/
		
		return $total_payble_amt;
	}
	
	function calculating_total_adjustment_n_without_wallet(){
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$total_payble_amt = $this->session->userdata('sesstotal_price');
		$query = $this->db->query("SELECT SUM(adj_amount) AS TOTAL_ADJ_AMT FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id'");
		if($query->num_rows() > 0){
			$result = $query->result();
			$adjust_amt = $result[0]->TOTAL_ADJ_AMT;
			//total rest amount of pay_adj_temp_dat with wallet
			$rest_payble_amt = $total_payble_amt-$adjust_amt;
			//return $rest_payble_amt;
			
			$sql = $this->db->query("SELECT SUM(adj_amount) AS TOTAL_ADJ_AMT_WITHOUT_WLT FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type!='W'");
			if($sql->num_rows() > 0){
				$res = $sql->result();
				$adjust_amt_without_wlt = $res[0]->TOTAL_ADJ_AMT_WITHOUT_WLT;
			}else{
				$adjust_amt_without_wlt = 0;
			}
			$rest_payble_amt_without_wlt = $total_payble_amt-$adjust_amt_without_wlt;
			echo json_encode(array("rest_payble_amt"=>$rest_payble_amt,"rest_payble_amt_without_wlt"=>$rest_payble_amt_without_wlt));exit;
		}else{
			return false;
		}
	}
	
	function adjust_wallet_bal_to_shopping(){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d H:i:s');
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$user_id = $this->session->userdata['session_data']['user_id'];
		$total_payble_amt = $this->input->post('total_payble');
		$rest_payble_amt = $this->input->post('rest_payble');
		$wallet_payble_amt = $this->input->post('wallet_payble');
		
		//getting wallet unique id
		$query = $this->db->query("SELECT wallet_uni_id,wallet_balance FROM wallet_info WHERE user_id='$user_id'");
		$result = $query->row();
		$wallet_id = $result->wallet_uni_id;
		$total_wallet_amt = $result->wallet_balance;
		
		if($total_wallet_amt > $wallet_payble_amt){
			//if($total_payble_amt < $wallet_payble_amt){
			if($rest_payble_amt < $wallet_payble_amt){
				//echo $wallet_payble_amt;exit;
				//return false;
				echo json_encode(array("status"=>'Invalid'));exit;
			}else{
				$sql = $this->db->query("SELECT adj_type_id,adj_amount FROM pay_adjust_data_temp WHERE adj_type_id='$wallet_id' AND chkout_session_id='$chkout_session_id'");
				if($sql->num_rows() > 0){
					$res = $sql->result();
					$prev_wlt_adj_amt = $res[0]->adj_amount;
					$final_wlt_adj_amt = $prev_wlt_adj_amt+$wallet_payble_amt;
					//$this->db->query("UPDATE pay_adjust_data_temp SET adj_amount='$final_wlt_adj_amt' WHERE adj_type_id='$wallet_id'");
					$this->db->query("UPDATE pay_adjust_data_temp SET adj_amount='$final_wlt_adj_amt' WHERE adj_type_id='$wallet_id' AND chkout_session_id='$chkout_session_id'");
					//return true;
					//return $final_wlt_adj_amt;
					
					//retrieve total adjusted amount
					$adj_sql = $this->db->query("SELECT SUM(adj_amount) AS TOTAL_ADJ_AMT FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id'");
					$adj_res = $adj_sql->result();
					$total_adj_amt = $adj_res[0]->TOTAL_ADJ_AMT;
					echo json_encode(array("wlt_adj_amt"=>$final_wlt_adj_amt,"total_adj_amt"=>$total_adj_amt));exit;
				}else{
					$temp_adj_data = array(
						'chkout_session_id' => $chkout_session_id,
						'user_id' => $user_id,
						'transaction_date' => $cdate,
						'adj_type' => 'W',
						'adj_type_id' => $wallet_id,
						'adj_amount' => $wallet_payble_amt,
					);
					$this->db->insert('pay_adjust_data_temp',$temp_adj_data);
					//return true;
					//return $wallet_payble_amt;
					
					//retrieve total adjusted amount
					$adj_sql = $this->db->query("SELECT SUM(adj_amount) AS TOTAL_ADJ_AMT FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id'");
					$adj_res = $adj_sql->result();
					$total_adj_amt = $adj_res[0]->TOTAL_ADJ_AMT;
					echo json_encode(array("wlt_adj_amt"=>$wallet_payble_amt,"total_adj_amt"=>$total_adj_amt));exit;
				}
			}
		}else{
			//return false;
			echo json_encode(array("status"=>'Invalid'));exit;
		}
	}
	
	/*function adjust_voucher_to_shopping(){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d H:i:s');
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$user_id = $this->session->userdata['session_data']['user_id'];
		$voucher_no = $this->input->post('voucher_no');
		$vaucher_no_arr[] = $voucher_no;
		$amt_payble_by_voucher = $this->input->post('amt_payble_voucher');
		
		$query= $this->db->query("SELECT * FROM gift_voucher_master WHERE voucher_no='$voucher_no' AND ('$cdate' BETWEEN valid_from AND valid_to) AND voucher_status='available' AND qty>0 AND (purchase_value>='$amt_payble_by_voucher')  ");
		
		
		
		//$query = $this->db->query("SELECT * FROM purchase_gift_voucher WHERE voucher_no='$voucher_no' AND '$cdate' BETWEEN valid_from AND valid_to");
		if($query->num_rows() > 0){
			$result = $query->result();
			$status = $result[0]->status;
			if($status != 'A'){
				echo $status;
			}else{
				//program start for discount in amount
				if($result[0]->amount != 0){
					$voucher_amt = $result[0]->amount;
					//data inserted in payment adjustment temp table program start here//
					$temp_adj_data = array(
						'chkout_session_id' => $chkout_session_id,
						'user_id' => $user_id,
						'transaction_date' => $cdate,
						'adj_type' => 'V',
						'adj_type_id' => $voucher_no,
						'adj_amount' => $voucher_amt
					);
					$this->db->insert('pay_adjust_data_temp',$temp_adj_data);
					//data inserted in payment adjustment temp table program end here//
					
					$this->update_purchase_gift_voucher_status($vaucher_no_arr,'T');
					
					//retrieve current session voucher data program start here
					$voucher_sql = $this->db->query("SELECT adj_type_id,adj_amount FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='V'");
					$voucher_res = $voucher_sql->result();
					foreach($voucher_res as $vrow){
						$vchr_no[] = $vrow->adj_type_id;
						$vchr_amt[] = $vrow->adj_amount;
					}
					$voucher_no_n_amt = array_combine($vchr_no,$vchr_amt);
					return $voucher_no_n_amt;
					//retrieve current session voucher data program end here
				}else{
					//program start for discount in percentage
					$discount_persent = $result[0]->discount;
					$discntdecimal = $discount_persent/100;
					$voucher_amt = ceil($amt_payble_by_voucher*$discntdecimal);
					//data inserted in payment adjustment temp table program start here//
					$temp_adj_data = array(
						'chkout_session_id' => $chkout_session_id,
						'user_id' => $user_id,
						'transaction_date' => $cdate,
						'adj_type' => 'V',
						'adj_type_id' => $voucher_no,
						'adj_amount' => $voucher_amt
					);
					$this->db->insert('pay_adjust_data_temp',$temp_adj_data);
					//data inserted in payment adjustment temp table program end here//
					
					$this->update_purchase_gift_voucher_status($vaucher_no_arr,'T');
					
					//retrieve current session voucher data program start here
					$voucher_sql = $this->db->query("SELECT adj_type_id,adj_amount FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='V'");
					$voucher_res = $voucher_sql->result();
					foreach($voucher_res as $vrow){
						$vchr_no[] = $vrow->adj_type_id;
						$vchr_amt[] = $vrow->adj_amount;
					}
					$voucher_no_n_amt = array_combine($vchr_no,$vchr_amt);
					return $voucher_no_n_amt;
					//retrieve current session voucher data program end here
				}
			}
		}else{
			echo 'Invalid';
		}
	}*/
	
	
	
	function adjust_voucher_to_shopping(){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d H:i:s');
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$user_id = $this->session->userdata['session_data']['user_id'];
		$voucher_no = $this->input->post('voucher_no');
		$vaucher_no_arr[] = $voucher_no;
		$amt_payble_by_voucher = $this->input->post('amt_payble_voucher');
		
		$query= $this->db->query("SELECT * FROM gift_voucher_master WHERE voucher_no='$voucher_no' AND ('$cdate' BETWEEN valid_from AND valid_to) AND voucher_status='available' AND qty>0 AND (purchase_value>='$amt_payble_by_voucher')  ");
			
		//$query = $this->db->query("SELECT * FROM purchase_gift_voucher WHERE voucher_no='$voucher_no' AND '$cdate' BETWEEN valid_from AND valid_to");
		
		
		if($query->num_rows() > 0){
			
		$query_uservrch = $this->db->query("SELECT * FROM purchase_gift_voucher WHERE voucher_no='$voucher_no'  AND used_id='$user_id' ");
		
		if($query_uservrch->num_rows()==0)	
		{	
			$result = $query->result();
			$status = $result[0]->status;
			if($status != 'A'){
				echo $status;
			}else{
				//program start for discount in amount
				if($result[0]->amount != 0){
					$voucher_amt = $result[0]->amount;
					//data inserted in payment adjustment temp table program start here//
					$temp_adj_data = array(
						'chkout_session_id' => $chkout_session_id,
						'user_id' => $user_id,
						'transaction_date' => $cdate,
						'adj_type' => 'V',
						'adj_type_id' => $voucher_no,
						'adj_amount' => $voucher_amt
					);
					$this->db->insert('pay_adjust_data_temp',$temp_adj_data);
					//data inserted in payment adjustment temp table program end here//
					
					$this->update_purchase_gift_voucher_status($vaucher_no_arr,'T');
					
					//retrieve current session voucher data program start here
					$voucher_sql = $this->db->query("SELECT adj_type_id,adj_amount FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='V'");
					$voucher_res = $voucher_sql->result();
					foreach($voucher_res as $vrow){
						$vchr_no[] = $vrow->adj_type_id;
						$vchr_amt[] = $vrow->adj_amount;
					}
					$voucher_no_n_amt = array_combine($vchr_no,$vchr_amt);
					return $voucher_no_n_amt;
					//retrieve current session voucher data program end here
				}else{
					//program start for discount in percentage
					$discount_persent = $result[0]->discount;
					$discntdecimal = $discount_persent/100;
					$voucher_amt = ceil($amt_payble_by_voucher*$discntdecimal);
					//data inserted in payment adjustment temp table program start here//
					$temp_adj_data = array(
						'chkout_session_id' => $chkout_session_id,
						'user_id' => $user_id,
						'transaction_date' => $cdate,
						'adj_type' => 'V',
						'adj_type_id' => $voucher_no,
						'adj_amount' => $voucher_amt
					);
					$this->db->insert('pay_adjust_data_temp',$temp_adj_data);
					//data inserted in payment adjustment temp table program end here//
					
					$this->update_purchase_gift_voucher_status($vaucher_no_arr,'T');
					
					//retrieve current session voucher data program start here
					$voucher_sql = $this->db->query("SELECT adj_type_id,adj_amount FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='V'");
					$voucher_res = $voucher_sql->result();
					foreach($voucher_res as $vrow){
						$vchr_no[] = $vrow->adj_type_id;
						$vchr_amt[] = $vrow->adj_amount;
					}
					$voucher_no_n_amt = array_combine($vchr_no,$vchr_amt);
					return $voucher_no_n_amt;
					//retrieve current session voucher data program end here
				}
			}
		} // if voucher not used by buyer condtion end
		else
		{echo 'U'; // if voucher  used by buyer condtion end 
		}
			
		}else{
			echo 'Invalid';
		}
	}
	
	
	function adjust_coupon_to_shopping(){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d H:i:s');
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$user_id = $this->session->userdata['session_data']['user_id'];
		$copn_code = $this->input->post('copn_code');
		$copn_code_arr[] = $copn_code;
		$amt_payble_by_copn = $this->input->post('amt_payble_copn');
		$query = $this->db->query("SELECT * FROM purchase_coupon WHERE copn_code='$copn_code' AND '$cdate' BETWEEN valid_from AND valid_to");
		if($query->num_rows() > 0){
			$result = $query->result();
			$status = $result[0]->status;
			if($status != 'A'){
				echo $status;
			}else{
				//program start for discount in amount
				if($result[0]->amount != 0){
					$copn_amt = $result[0]->amount;
					//data inserted in payment adjustment temp table program start here//
					$temp_adj_data = array(
						'chkout_session_id' => $chkout_session_id,
						'user_id' => $user_id,
						'transaction_date' => $cdate,
						'adj_type' => 'C',
						'adj_type_id' => $copn_code,
						'adj_amount' => $copn_amt
					);
					$this->db->insert('pay_adjust_data_temp',$temp_adj_data);
					//data inserted in payment adjustment temp table program end here//
					
					$this->update_purchase_copn_status($copn_code_arr,'T');
					
					//retrieve current session coupon data program start here
					$copn_sql = $this->db->query("SELECT adj_type_id,adj_amount FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='C'");
					$copn_res = $copn_sql->result();
					foreach($copn_res as $crow){
						$cpn_code[] = $crow->adj_type_id;
						$cpn_amt[] = $crow->adj_amount;
					}
					$copn_no_n_amt = array_combine($cpn_code,$cpn_amt);
					return $copn_no_n_amt;
					//retrieve current session coupon data program end here
				}else{
					//program start for discount in percentage
					$discount_persent = $result[0]->discount;
					$discntdecimal = $discount_persent/100;
					$copn_amt = ceil($amt_payble_by_copn*$discntdecimal);
					//data inserted in payment adjustment temp table program start here//
					$temp_adj_data = array(
						'chkout_session_id' => $chkout_session_id,
						'user_id' => $user_id,
						'transaction_date' => $cdate,
						'adj_type' => 'C',
						'adj_type_id' => $copn_code,
						'adj_amount' => $copn_amt
					);
					$this->db->insert('pay_adjust_data_temp',$temp_adj_data);
					//data inserted in payment adjustment temp table program end here//
					
					$this->update_purchase_copn_status($copn_code_arr,'T');
					
					//retrieve current session coupon data program start here
					$copn_sql = $this->db->query("SELECT adj_type_id,adj_amount FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='C'");
					$copn_res = $copn_sql->result();
					foreach($copn_res as $crow){
						$cpn_code[] = $crow->adj_type_id;
						$cpn_amt[] = $crow->adj_amount;
					}
					$copn_no_n_amt = array_combine($cpn_code,$cpn_amt);
					return $copn_no_n_amt;
					//retrieve current session coupon data program end here
				}
			}
		}else{
			echo 'Invalid';
		}
	}
	
	function update_purchase_gift_voucher_status($vaucher_no_arr,$status){
		$data = array('status' => $status);
		foreach($vaucher_no_arr as $val){
			$this->db->where('voucher_no',$val);
			$this->db->update('purchase_gift_voucher',$data);
		}
	}
	
	function update_purchase_gift_voucher_data($voucher_no_arr,$vchr_gft_data){
		foreach($voucher_no_arr as $val){
			$this->db->where('voucher_no',$val);
			$this->db->update('purchase_gift_voucher',$vchr_gft_data);
		}
	}
	
	function update_purchase_copn_status($copn_code_arr,$status){
		$data = array('status' => $status);
		foreach($copn_code_arr as $val){
			$this->db->where('copn_code',$val);
			$this->db->update('purchase_coupon',$data);
		}
	}
	
	function update_purchase_coupon_data($copn_code_arr,$copn_data){
		foreach($copn_code_arr as $val){
			$this->db->where('copn_code',$val);
			$this->db->update('purchase_coupon',$copn_data);
		}
	}
	
	function getting_adj_wllt_amount(){
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		$query = $this->db->query("SELECT adj_amount FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='W'");
		if($query->num_rows() > 0){
			$result = $query->result();
			$wlt_adj_amt = $result[0]->adj_amount;
			return $wlt_adj_amt;
		}else{
			return 0;
		}
	}
}
?>
