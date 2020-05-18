<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model
{
	
	function slider_box1_select()
  {
	  $results = array();
       $qr=$this->db->query("select * from slider_box1");
   		//$row=$qr->row();
       return $qr->result();
  }
  
 
	 function block1_box1_select()
	{
		//print_r($id);exit;
		$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 1");	
		return $qr;
	}

function block1_box2_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 2");	
    return $qr;
	
	}
function block2_box1_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 3");	
    return $qr;
	
	}
	function block2_box2_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 4");	
    return $qr;
	
	}
	function block2_box3_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 5");	
    return $qr;
	
	}
	function block3_box1_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 6");	
    return $qr;
	
	}
	
	function ad_blog(){
		$qr=$this->db->query("select * from block_and_box_images WHERE image_id=7");	
		return $qr;
	}
	
	//function search_product($keyword)
//{
//	/*$qr=$this->db->query("select * from product_general_info p INNER JOIN product_image i where p.name LIKE '%$keyword%' and p.product_id=i.product_id ");*/	
//$qr=$this->db->query("select a.imag,b.product_id,c.name,c.description,d.price,d.special_price,d.special_pric_from_dt,d.special_pric_to_dt,d.quantity,d.sku,f.tax_rate_percentage from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join tax_management f on d.tax_class=f.tax_id inner join seller_account g on g.seller_id=d.seller_id inner join category_indexing h on b.category_id=h.category_id inner join category_indexing i on h.parent_id=i.category_id inner join category_indexing j on i.parent_id=j.category_id   where c.name LIKE '%$keyword%' or j.category_name LIKE '%$keyword%' or i.category_name LIKE '%$keyword%' or h.category_name LIKE '%$keyword%' AND e.status='Active' AND g.status='Active' ");
//		   return $qr;
//}

/*function search_product($keyword)
{

$qr=$this->db->query("
SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name,  ''sku, 0 product_id,  ''name,  ''imag
FROM  `temp_category` 
WHERE lvl2_name LIKE  '%$keyword%'
OR lvl1_name LIKE  '%$keyword%'
AND lvl1 !=0
UNION ALL 
SELECT DISTINCT b.lvl2, b.lvl2_name, b.lvl1, b.lvl1_name, a.sku, a.product_id, a.name, a.imag
FROM cornjob_productsearch a
INNER JOIN temp_category b ON b.lvl2 = a.lvl2
WHERE a.name LIKE  '%$keyword%' AND a.prod_status='Active' group by b.lvl2");
if($qr->num_rows()==0){
$qry="SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name, sku, product_id, name, imag 
        FROM 
        (SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name,  ''sku, 0 product_id,  ''name,  ''imag
                from temp_category
                where soundex(lvl2_name)=soundex('$keyword')
                or soundex_match('$keyword','lvl2_name','')
                or soundex(lvl2_name) like concat(trim(trailing '0' from soundex('$keyword')),'%')
                or soundex(lvl1_name)=soundex('$keyword')
                or soundex_match('$keyword','lvl1_name','')
                or soundex(lvl1_name) like concat(trim(trailing '0' from soundex('$keyword')),'%')
                and lvl1!=0 
            UNION ALL
                SELECT DISTINCT b.lvl2, b.lvl2_name, b.lvl1, b.lvl1_name, a.sku, a.product_id, a.name, a.imag

                FROM cornjob_productsearch a
                INNER JOIN temp_category b ON b.lvl2 = a.lvl2
                WHERE soundex(a.name)=soundex('$keyword')
                or soundex_match('$keyword','a.name','')
                or soundex(a.name) like concat(trim(trailing '0' from soundex('$keyword')),'%')       
                AND a.prod_status='Active' and product_id!=0 group by b.lvl2
        ) r
        where r.product_id !=''";
    
$qr=$this->db->query($qry);
}
return $qr;
}*/





function search_product($keyword)
{
		
		$fnl_sugst_word='';
				
		//----------------------------- solr search start------------------------------//
		
		//if($qr_ctag->num_rows()==0 || $qr2->num_rows()==0)
		//{
			$search_title=$keyword;
			
			set_time_limit(0);
		
			$search_title=trim(str_replace(' ','%20',$search_title));
			
			//$curl_strng=SOLR_BASE_URL."mycollection1/select?q=*".$search_title."*&wt=json&rows=1&start=0&fl=lvl2_name,lvl1_name,lvlmain_name";	
			
			//$search_txt=trim(str_replace('%20','%20AND%20',$search_title));
			//$curl_strng=SOLR_BASE_URL."mycollection1/select?facet.pivot=lvlmain_name,lvl1_name,lvl2_name&facet=on&indent=on&q=".$search_txt."&wt=json&rows=1&start=0";
			
			$curl_strng=SOLR_BASE_URL.SOLR_CORE_NAME."/select?facet.pivot=Category_Lvl1,Category_Lvl2,Category_Lvl3&facet=on&indent=on&q=".$search_title."&wt=json&rows=1&start=0";
					
			
			$curl2 = curl_init($curl_strng);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			$data2 = json_decode($output, true);			
			
			if($data2['response']['numFound']==0)
			{
				$curl_strng = SOLR_BASE_URL.SOLR_CORE_NAME."/spell?q=".$search_title."&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true&rows=1&start=0&fl=Category_Lvl3,Category_Lvl2,Category_Lvl1";
				
				$curl2 = curl_init($curl_strng);
				curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($curl2);
				$data2 = json_decode($output, true);			
			
							
				$str=array();
				$str=$data2;		
				
				$sugs_word=array();
				$sugs_word=$str['spellcheck']['suggestions'][1]['suggestion'];				
				$sugword_arr=array();
				$sugword_hits=array();
				
				foreach($sugs_word as $ky_allsug=>$val_allsug)
				{
					$sugword_arr[]=$sugs_word[$ky_allsug]['word'];
					$sugword_hits[]=$sugs_word[$ky_allsug]['freq'];
						
				}
				
				 $max_hits=max($sugword_hits);				
				 $max_hitkey=array_search($max_hits,$sugword_hits);				
					
						
				 $fnl_sugst_word=$sugword_arr[$max_hitkey];
				 $this->session->unset_userdata('srchsugst_solrword');
				 $this->session->set_userdata('srchsugst_solrword',$fnl_sugst_word);
					
				/*$curl_strng = SOLR_BASE_URL."mycollection1/spell?q=".$sugword_arr[$max_hitkey]."&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true&rows=1&start=0&fl=name,lvl2_name,lvl1_name,lvlmain_name,sku";
				
				$curl3 = curl_init($curl_strng);
				curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
				$output3 = curl_exec($curl3);
				$data3 = json_decode($output3, true);				
				
				$sku_ids=array();
				
				for($i_arr=0; $i_arr<count($data3['response']['docs']); $i_arr++ )
				{
					$sku_ids[]="'".$data3['response']['docs'][$i_arr]['sku'][0]."'";	
				}	*/		
				//$this->session->unset_userdata('prodcount_solr');
				//$this->session->set_userdata('prodcount_solr',$data3['response']['numFound']);
			}
			else
			{	
				$fnl_sugst_word=$keyword;
				$this->session->unset_userdata('srchsugst_solrword');
				$this->session->set_userdata('srchsugst_solrword',$fnl_sugst_word);
					
				
						
				/*$sku_ids=array();
				
				for($i_arr=0; $i_arr<count($data2['response']['docs']); $i_arr++ )
				{
					$sku_ids[]="'".$data2['response']['docs'][$i_arr]['sku'][0]."'";	
				}*/
				//$this->load->library('session');
				//$this->session->unset_userdata('prodcount_solr');
				//$this->session->set_userdata('prodcount_solr',$data2['response']['numFound']);
				
				
			}
			
			//$skuids_strng=implode(',',$sku_ids);
			//$qr2=$this->db->query("select DISTINCT a.lvl2, a.lvl2_name, a.lvl1, a.lvl1_name, a.sku, a.product_id, a.name  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND a.sku IN ($skuids_strng)  group by a.lvl2 ");
			
			
			//$qr2=$this->db->query("select DISTINCT lvl2, lvl2_name, lvl1, lvl1_name from temp_category  WHERE (lvl2_name LIKE '%$fnl_sugst_word%' OR  lvl1_name LIKE '%$fnl_sugst_word%' OR lvlmain_name LIKE '%$fnl_sugst_word%' )	group by lvl2 LIMIT 10");
			
			$qr2=$this->db->query("select DISTINCT lvl2, lvl2_name, lvl1, lvl1_name, sku, product_id, name  from cornjob_productsearch b WHERE b.quantity>0 AND b.seller_id!=0 AND b.prod_status = 'Active' AND b.status = 'Enabled' AND b.seller_status = 'Active' AND (lvl2_name LIKE '%$fnl_sugst_word%' OR  lvl1_name LIKE '%$fnl_sugst_word%' OR lvlmain_name LIKE '%$fnl_sugst_word%' OR name LIKE '%$fnl_sugst_word%' ) group by b.lvl2 DESC LIMIT 10");
			
			return 	$qr2;	
			
		//}
		
		
			
		//----------------------------- solr search end------------------------------//
		
		
		
}
	
	
	function search_product_clause($keyword)
	{
		
		$fnl_sugst_word='';
				
		//----------------------------- solr search start------------------------------//
		
		//if($qr_ctag->num_rows()==0 || $qr2->num_rows()==0)
		//{
			$search_title=$keyword;
			
			set_time_limit(0);
		
			$search_title=trim(str_replace(' ','%20',$search_title));
			
			//$curl_strng=SOLR_BASE_URL."mycollection1/select?q=*".$search_title."*&wt=json&rows=1&start=0&fl=lvl2_name,lvl1_name,lvlmain_name";	
			
			$search_txt=trim(str_replace('%20','%20AND%20',$search_title));
			/*$curl_strng=SOLR_BASE_URL."mycollection1/select?facet.pivot=lvlmain_name,lvl1_name,lvl2_name,name&facet=on&indent=on&q=".$search_txt."&wt=json&rows=1&start=0";*/
			
			$curl_strng=SOLR_BASE_URL."mycollection1/select?indent=on&q=".$search_txt."&facet=true&facet.field=lvl2_name&facet.field=lvl1_name&facet.field=lvlmain_name&facet.mincount=1&wt=json&rows=1&start=0";
					
			
			$curl2 = curl_init($curl_strng);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			$data2 = json_decode($output, true);			
			
			if($data2['response']['numFound']==0)
			{
				
						
				 $fnl_sugst_word=$data2['spellcheck']['collations'][1];
				$this->session->unset_userdata('srchsugst_solrword');
				 $this->session->set_userdata('srchsugst_solrword',$fnl_sugst_word);
					
				
			}
			else
			{	
				$fnl_sugst_word=$keyword;
				$this->session->unset_userdata('srchsugst_solrword');
				 $this->session->set_userdata('srchsugst_solrword',$fnl_sugst_word);
					
				
				
				
			}
			
			
			
			
			$qr2=$this->db->query("select DISTINCT lvl2, lvl2_name, lvl1, lvl1_name from temp_category  WHERE (lvl2_name LIKE '%$fnl_sugst_word%' OR  lvl1_name LIKE '%$fnl_sugst_word%' OR lvlmain_name LIKE '%$fnl_sugst_word%' ) group by lvl2 LIMIT 5");
			
			if($qr2->num_rows()==0)
			{
				$qr2=$this->db->query("select DISTINCT lvl2, lvl2_name, lvl1, lvl1_name, sku, product_id, name  from cornjob_productsearch b WHERE b.quantity>0 AND b.seller_id!=0 AND b.prod_status = 'Active' AND b.status = 'Enabled' AND b.seller_status = 'Active' AND (lvl2_name LIKE '%$fnl_sugst_word%' OR  lvl1_name LIKE '%$fnl_sugst_word%' OR lvlmain_name LIKE '%$fnl_sugst_word%' OR name LIKE '%$fnl_sugst_word%' ) group by b.lvl2 DESC LIMIT 5");}
			
			return 	$qr2;	
			
		//}
		
		
			
		//----------------------------- solr search end------------------------------//
		
		
		
}


function search_category($keyword)
{
	/*$qr=$this->db->query("select * from product_general_info p INNER JOIN product_image i where p.name LIKE '%$keyword%' and p.product_id=i.product_id ");*/	
//$qr=$this->db->query("select a.imag,b.product_id,c.name,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join tax_management f on d.tax_class=f.tax_id inner join seller_account g on g.seller_id=d.seller_id inner join category_indexing h on b.category_id=h.category_id inner join category_indexing i on h.parent_id=i.category_id inner join category_indexing j on i.parent_id=j.category_id   where c.name LIKE '%$keyword%' or j.category_name LIKE '%$keyword%' or i.category_name LIKE '%$keyword%' or h.category_name LIKE '%$keyword%' AND e.status='Active' AND g.status='Active' ");


$qr=$this->db->query("SELECT a.name,f.*
FROM product_general_info a
INNER JOIN product_image b ON a.product_id = b.product_id
INNER JOIN product_master c ON a.product_id = c.product_id
INNER JOIN seller_account d ON d.seller_id = c.seller_id
INNER JOIN product_category e ON e.product_id= c.product_id
INNER JOIN view_catinfo f on e.category_id=f.lvl2
WHERE c.approve_status = 'Active'
AND d.status = 'Active' and (f.lvl2_name  like '%$keyword%' or f.lvl1_name like '%$keyword%' or f.lvlmain_name like '%$keyword%') 
group by f.lvl2,f.lvl1,f.lvlmain   ");
		   
	return $qr;
}
	
	function view_homepage()
	{
		$qr=$this->db->query("select * from pages where page_name='home'");
		$row=$qr->row();		
		return $row;	
	}
	
	function view_single_product()
	{
		$qr=$this->db->query("select * from pages where page_name='single_product'");
		$row=$qr->row();		
		return $row;	
	}
	
	function select_root_categories()
	{
		$qr=$this->db->query("select a.*,b.catg_image,b.category_id from category_indexing a inner join category_master b on a.category_name=b.category_name where a.parent_id=0 ");
		
		return $qr;	
	
	}
	
	function get_unique_id($table,$uid){
		$query = $this->db->query('SELECT MAX('.$uid.') AS `maxid` FROM '.$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	
	function retrive_state(){
		$query = $this->db->query("SELECT * FROM state");
		return $query->result();
	}
	
	function login_register(){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d');
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$encript_pass = md5($pass);
		$case = $this->input->post('flag');
		/////programming for new user start here//////
		if($case == 1){
			$query = $this->db->query("SELECT email FROM user WHERE email='$email'");
			$row = $query->num_rows();
			if($row > 0){
				echo 'exists';exit;	
			}else{
				$user_id = $this->get_unique_id('user','user_id');
				$data = array(
					'user_id' => $user_id,
					'email' => $email,
					'password' => $encript_pass,
				);
				
				$news_letter_data = array(
					'user_unique_id' => $user_id,
					'user_email_id' => $email,
					'user_reg_date' => $cdate
				);
				
				$this->db->insert('subscriber_detail',$news_letter_data);
				
				$query1 = $this->db->insert('user',$data);
				$insert_id = $this->db->insert_id();
		//-----------------------mail part start----------------------------
		          
		 
				//$message = "
//		<div style='padding:20px;'> <h5>Hi ,</h5>
//		<p>Thank you for signing up with Moonboy.in</p>
//		<strong>Your Log in ID is :  ".$email." and<br/><br/>
//			    Password is : ".$pass."</strong><br/>
//		<p>You can now log in to Moonboy using this ID and the password. </p><br/>
//           Thanks & regards,<br/>Moonboy Team <br/>
//         </div>
//		
//		<div style='text-align:center; background-color:#0e4370; color:#fff; padding:10px;'>
//	    <p> copyright@ 2015 Moonboy . All rights reserved . </p>
//       </div>";
			   $user_info['email']=$email;
			   $user_info['pass']=$pass;
			   
				$this->email->set_mailtype("html");
				$this->email->from('noreply@moonboy.in', 'Moonboy.in');
				$this->email->to($email);
				$this->email->subject('Welcome to Moonboy.in');
				//$this->email->message($message);
				$this->email->message($this->load->view('email_template/user_login_manual',$user_info,true));
				$this->email->send();
				
				date_default_timezone_set('Asia/Calcutta');
				$dt = date('Y-m-d H:i:s');
					
				$msg=$this->load->view('email_template/user_login_manual',$user_info,true);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$email,
					'from_email_id'=>'noreply@moonboy.in',
					'date'=>$dt,
					'email_sub'=>'Welcome to Moonboy.in',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$email,
					'from_email_id'=>'noreply@moonboy.in',
					'date'=>$dt,
					'email_sub'=>'Welcome to Moonboy.in',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);
				}
				$this->db->insert('email_log',$email_data);
				
								
				$query2 = $this->db->query("SELECT * FROM user WHERE id='$insert_id'");
				return $query2->result();
			}
		}
		/////programming for new user end here//////
		/////programming for existing user start here//////
		if($case == 2){
			$query = $this->db->query("SELECT * FROM user WHERE email='$email' AND password='$encript_pass'");
			$result = $query->result();
			$row = $query->num_rows();
			if($row > 0){
				if($result[0]->status == 'Active'){
					return $result;
				}else{
					echo 'blocked';exit;
				}
			}else{
				echo 'invalid';exit;
			}
		}
		/////programming for existing user end here//////	
	}
	
	
	function insertinto_addtocart()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$encript_pass = md5($pass);
		//insert into addtocart start
		
		$product_id_arr=count($this->session->userdata('addtocarttemp'));
		//$user_id=$this->session->userdata('user_id');
		
		if($product_id_arr!=0 )
		{ 	
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$query1 = $this->db->query("SELECT * FROM user WHERE email='$email' AND password='$encript_pass'");
			$result1 = $query1->row();
			$user_id_cart=$result1->user_id;
			   
			$addtocart_seesid=$this->session->userdata('addtocarttemp_session_id');
			$product_ids_arr=array();
			$product_ids_arr=$this->session->userdata('addtocarttemp');
			
			$sku_arr=array();
			$sku_arr=$this->session->userdata('addtocart_sku');
			
			//$user_id=$this->session->userdata['session_data']['user_id'];
			//$user_id=$this->session->userdata('user_id');
			//echo $user_id;exit;
			
			$ct=count($product_ids_arr);
			for($i=0;$i<$ct;$i++)
			{
			//$qr=$this->db->query("select * from addtocart_temp where addtocart_session_id='$addtocart_seesid' and product_id='$product_ids_arr[$i]' and user_id='$user_id' and sku='$sku_arr[$i]' ");
//				$count_rows=$qr->num_rows();
//				if($count_rows==0){				
				
				$addtocarttemp_id=$this->get_unique_id('addtocart_temp','addtocart_id');
				$data=array(
					'addtocart_id'=>$addtocarttemp_id,
					'addtocart_session_id'=>$addtocart_seesid,
					'product_id'=>$product_ids_arr[$i],
					 'user_id'=>$user_id_cart,
					'sku'=>$sku_arr[$i],
					'added_time'=>$dt
				);			
				
				$qr=$this->db->insert('addtocart_temp',$data);
				//}
					
			}
			
			return $qr;
			
		}
		
		//insert into addtocart end
		
	
	}
	function insert_addtocartfromtemp($email)
	{
	
		
		//insert into addtocart start
		
		$product_id_arr=count($this->session->userdata('addtocarttemp'));
		
		
		if($product_id_arr!=0 )
		{ 	
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$query1 = $this->db->query("SELECT * FROM user WHERE email='$email' ");
			$result1 = $query1->row();
			$user_id_cart=$result1->user_id;
			   
			$addtocart_seesid=$this->session->userdata('addtocarttemp_session_id');
			$product_ids_arr=array();
			$product_ids_arr=$this->session->userdata('addtocarttemp');
			
			$sku_arr=array();
			$sku_arr=$this->session->userdata('addtocart_sku');
			
			//$user_id=$this->session->userdata['session_data']['user_id'];
			//$user_id=$this->session->userdata('user_id');
			//echo $user_id;exit;
			
			$ct=count($product_ids_arr);
			for($i=0;$i<$ct;$i++)
			{
			//$qr=$this->db->query("select * from addtocart_temp where addtocart_session_id='$addtocart_seesid' and product_id='$product_ids_arr[$i]' and user_id='$user_id' and sku='$sku_arr[$i]' ");
//				$count_rows=$qr->num_rows();
//				if($count_rows==0){				
				
				$addtocarttemp_id=$this->get_unique_id('addtocart_temp','addtocart_id');
				$data=array(
					'addtocart_id'=>$addtocarttemp_id,
					'addtocart_session_id'=>$addtocart_seesid,
					'product_id'=>$product_ids_arr[$i],
					 'user_id'=>$user_id_cart,
					'sku'=>$sku_arr[$i],
					'added_time'=>$dt
				);			
				
				$qr=$this->db->insert('addtocart_temp',$data);
				//}
				
					
			}
			return $qr;
		
		}
	
	}
	
	
	function insert_from_tempwishlist()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$encript_pass = md5($pass);
		//insert into addtocart start
		
		$product_id_arr=count($this->session->userdata('addtowishlisttemp_prdid'));
		//$user_id=$this->session->userdata('user_id');
		
		if($product_id_arr!=0 )
		{ 	
			
			$query1 = $this->db->query("SELECT * FROM user WHERE email='$email' AND password='$encript_pass'");
			$result1 = $query1->row();
			$user_id_wishlist=$result1->user_id;
			   
			
			$product_ids_arr=array();
			$product_ids_arr=$this->session->userdata('addtowishlisttemp_prdid');
			
			$sku_arr=array();
			$sku_arr=$this->session->userdata('addtowishlist_tempsku');
			
			$ct=count($product_ids_arr);
			for($i=0;$i<$ct;$i++)
			{
				$data=array(
					
					'user_id'=>$user_id_wishlist,
					'product_id'=>$product_ids_arr[$i],
					 
					'sku'=>$sku_arr[$i],
					
				);			
				
				$qr=$this->db->insert('wishlist',$data);
				//}
					
			}
			return $qr;
			
		}
		
		//insert into addtocart end
		
	
	}
	
	
	function insertfromtemp_wishlist($email)
	{
		
		//insert into addtocart start
		
		$product_id_arr=count($this->session->userdata('addtowishlisttemp_prdid'));
		//$user_id=$this->session->userdata('user_id');
		
		if($product_id_arr!=0 )
		{ 	
			
			$query1 = $this->db->query("SELECT * FROM user WHERE email='$email' ");
			$result1 = $query1->row();
			$user_id_wishlist=$result1->user_id;
			   
			
			$product_ids_arr=array();
			$product_ids_arr=$this->session->userdata('addtowishlisttemp_prdid');
			
			$sku_arr=array();
			$sku_arr=$this->session->userdata('addtowishlist_tempsku');
			
			$ct=count($product_ids_arr);
			for($i=0;$i<$ct;$i++)
			{
				$data=array(
					
					'user_id'=>$user_id_wishlist,
					'product_id'=>$product_ids_arr[$i],
					 
					'sku'=>$sku_arr[$i],
					
				);			
				
				$qr=$this->db->insert('wishlist',$data);
				//}
					
			}
			return $qr;
			
		}
		
		//insert into addtocart end
		
	
	}
	
	
	
	
	function check_user_email_address($data){
		$query = $this->db->query("SELECT * FROM user WHERE email="."'".$data['email']."'");
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function insert_social_registration_data($data){;
		$this->db->insert('user',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	
	function insert_retrive_password_data($retrive_data){
		$this->db->insert('retrive_password',$retrive_data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function retrive_otp_details($otp,$otp_email){
		$query = $this->db->query("SELECT * FROM retrive_password WHERE email='$otp_email' ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		$last_otp = $result[0]->otp;
		if($otp == $last_otp){
			return $result;
		}else{
			return false;
		}
	}
	
	function update_forgot_password(){
		$email_id = $this->input->post('email');
		$data = array(			
			'password' => md5($this->input->post('pass')),
		);		
		$this->db->where('email',$email_id);
		$this->db->update('user',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function check_password($user_id,$password){		
		$encrpt_pass = md5($password);
		$query = $this->db->query("SELECT * FROM user WHERE user_id='$user_id' AND password='$encrpt_pass'");
		$row = $query->num_rows();
		if($row > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function update_changes_password($user_id,$password){
		$encrpt_pass = md5($password);
		$query = $this->db->query("UPDATE user SET password='$encrpt_pass' WHERE user_id='$user_id'");
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	function update_persional_info(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'mob' => $this->input->post('mobile'),
			'gendr' => $this->input->post('gen'),			
		);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		if($this->db->affected_rows() > 0){
			$user_data = array(
				'user_id' => $user_id,
				'fname' => $data['fname']
			);
			
			//update programming start for newsletter//
			$query = $this->db->query("SELECT email FROM user WHERE user_id=$user_id");
			$result = $query->result();
			$mail_id = $result[0]->email;
			$news_data = array(
				'user_gender' => $this->input->post('gen'),
			);			
			$this->db->where('user_email_id',$mail_id);
			$this->db->update('subscriber_detail',$news_data);
			//update programming end of newsletter//
			
			$this->session->set_userdata('session_data', $user_data);
			return true;
		}else{
			return false;
		}
	}
	
	function insert_address(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$data = array(
			'user_id' => $user_id,
			'full_name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'pin_code' => $this->input->post('pin'),
			'phone' => $this->input->post('mob'),
		);
		$this->db->insert('user_address',$data);
		$insert_id = $this->db->insert_id();
		$data_id = array('address_id' => $insert_id);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data_id);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function update_inn_address(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$address_id = $this->input->post('id');
		
		//--------select of state id as pincode start-------
		$postal_pincode=$this->input->post('pin');
		
		$pinccde_query=$this->db->query("SELECT State FROM  postalpincodemaster_fedexin WHERE postalcode='$postal_pincode' ");
		if($pinccde_query->num_rows()>0)
		{ $rw_postalpincode=$pinccde_query->row();
		  $state_name=$rw_postalpincode->State;
		  
		  $postal_codequery=$this->db->query("SELECT state_id FROM  state WHERE state_code LIKE '%$state_name%' ");
		  $state_id=$postal_codequery->row()->state_id;	
		  	
		}
		else
		{
			$state_id=$this->input->post('state');	
		}
		
			
		
		//--------select of state id as pincode end---------
		
		$data = array(
			'user_id' => $user_id,
			'full_name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'state' => $state_id,
			//'country' => $this->input->post('country'),
			'pin_code' => $this->input->post('pin'),
			'phone' => $this->input->post('mob'),
		);
		$this->db->where('address_id',$address_id);
		$this->db->update('user_address',$data);
		//update user address id in user table script start////
		$data_id = array('address_id' => $address_id);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data_id);
		//update user address id in user table script end////
		//return ($this->db->affected_rows() != 1) ? false : true;		
		return true;
	}
	
	function retrive_user_address(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.*,b.state_id,b.state AS state_name FROM user_address a INNER JOIN state b ON a.state=b.state_id WHERE a.user_id='$user_id'");
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();			
		}else{
			return false;
		}
	}
	
	function retrieve_user_persional_info(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT * FROM user WHERE user_id='$user_id'");
		$result = $query->result();
		return $result;
	}
	
	function delete_user_address(){
		$addrs_id = $this->input->post('id');
		$this->db->where('address_id',$addrs_id);
		$this->db->delete('user_address');
		return true;
	}
	
	function update_user_address(){
		$data = array('address_id' => $this->input->post('id'));		
		$user_id = $this->session->userdata['session_data']['user_id'];
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	function insert_product_review(){
			$user_id = $this->session->userdata['session_data']['user_id'];
			$sku = $this->input->post('sku_id');
			$query = $this->db->query("SELECT * FROM review_product WHERE user_id='$user_id' AND sku_id='$sku'");
			$rows = $query->num_rows();
			if($rows > 0){
				return 'exists';
			}else{
				$data = array(
					'user_id' => $user_id,
					'product_id' => $this->input->post('product_id'),
					'sku_id' =>$sku,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating')
				);		
				$this->db->insert('review_product',$data);
				if($this->db->affected_rows() > 0){
					return 'success';
				}
			}
	}
	
	function insert_seller_review(){
		$rating = $this->input->post('rating');
		$user_id = $this->session->userdata['session_data']['user_id'];
		$seller_id = $this->input->post('seller_id');
		$query = $this->db->query("SELECT * FROM review_seller WHERE seller_id='$seller_id' AND user_id='$user_id'");
		$rows = $query->num_rows();
		if($rows > 0){
			return 'exists';
		}else{
			if($rating >= 4){
				$data = array(
					'user_id' => $user_id,
					'seller_id' => $seller_id,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating'),
					'rating_type' => 'Best',
				);
			}else if($rating <= 2){
				$data = array(
					'user_id' => $user_id,
					'seller_id' => $seller_id,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating'),
					'rating_type' => 'Bad'
				);
			}else{
				$data = array(
					'user_id' => $user_id,
					'seller_id' => $seller_id,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating'),
					'rating_type' => 'Good'
				);
			}
			$this->db->insert('review_seller',$data);
			if($this->db->affected_rows() > 0){
				return 'success';
			}
		}
	}
	
	function retrieve_seller_review($user_id){
		$query = $this->db->query("SELECT a.*,b.business_name FROM review_seller a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.user_id='$user_id' AND a.status='Active' AND a.added_date > NOW() - INTERVAL 30 DAY ORDER BY a.review_id DESC");
		return $query;
	}
	
	function retrieve_product_review($user_id){
		$query = $this->db->query("SELECT a.*,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,b.sku,c.name,c.short_desc,d.imag,e.fname,f.tax_rate_percentage FROM review_product a INNER JOIN product_master b ON a.sku_id=b.sku INNER JOIN product_general_info c ON a.product_id=c.product_id INNER JOIN product_image d ON a.product_id=d.product_id INNER JOIN user e ON a.user_id=e.user_id INNER JOIN tax_management f ON b.tax_class=f.tax_id WHERE a.user_id='$user_id' AND a.status='Active' AND a.added_date > NOW() - INTERVAL 30 DAY ORDER BY a.review_id DESC");
		return $query;
	}
	
	function retrieve_new_product(){		
				
		$query = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY name ORDER BY `prod_search_sqlid` DESC LIMIT 10  ");
		
		//-------------------sujit start home page cache----------------------------//
		/*$this->db->cache_off();
		
								//delete start
		
		$querycachedlt=$this->db->query("select clear_catch.catg_id,clear_catch.folder_name from clear_catch inner join prod_cache on clear_catch.catg_id=prod_cache.catg_id where clear_catch.folder_name='default+index' ");
		$cnt=$querycachedlt->num_rows();
		if($querycachedlt->num_rows()>0)
		{
			foreach($querycachedlt->result_array() as $res)  
			{
				
				$catg_id=$res['catg_id'];
				//echo $catg_id;exit;
				$folder_name=$res['folder_name'];
				list($folder_name1, $folder_name2) = explode("+", $folder_name, 2);
				$this->db->cache_delete($folder_name1, $folder_name2);
				$this->db->query("DELETE FROM clear_catch WHERE catg_id='$catg_id'");
				$this->db->query("DELETE FROM prod_cache WHERE catg_id='$catg_id'");
			}
		}
		*/
		
								//delete end
		
		
								//insert start
		
		/*foreach ($query->result() as $row){
			$dskcatgid_idarr=$row->lvl2 ;
		$data=array(
					'catg_id'=>$dskcatgid_idarr,
					'folder_name'=>"default+index"
					);
		$querycache=$this->db->query("select * from clear_catch where catg_id='$dskcatgid_idarr' and folder_name='default+index' ");
		  if($querycache->num_rows()==0)
		  {
		  $qr=$this->db->insert('clear_catch',$data);
		  }
		}
		
								//insert end
		$this->db->cache_on();*/
		
		//-------------------sujit end home page cache----------------------------//
		
		return $query;
	}
	
	
	function retrieve_random_product(){
		 $query = $this->db->query("SELECT a.*,b.sku,b.price,b.special_price,b.quantity,b.stock_availability,b.special_pric_from_dt,b.special_pric_to_dt,b.mrp,c.*,e.tax_rate_percentage FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_setting d ON a.product_id=d.product_id 
		INNER JOIN tax_management e ON b.tax_class=e.tax_id INNER JOIN seller_account f on b.seller_id=f.seller_id WHERE d.status='Active' AND b.approve_status='Active' AND b.status='Enabled' AND f.status='Active' AND b.seller_id
IN (
SELECT seller_id
FROM seller_account_information
) GROUP BY b.product_id ORDER BY RAND() LIMIT 10");
		return $query;
	}
	
	
	function retrieve_random_product1(){
		
 $prod_skustr=get_cookie('prodid', TRUE);  
 $modf_prod_skustr=implode(',',array_unique(explode(',', $prod_skustr)));
 
 $query = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND product_id IN ($modf_prod_skustr) GROUP BY product_id   ");
		return $query;
 		
		//$query = $this->db->query("SELECT a.name,b.product_id,b.sku,b.price,b.special_price,b.quantity,b.stock_availability,b.special_pric_from_dt,b.special_pric_to_dt,b.mrp,c.catelog_img_url FROM cornjob_productsearch a INNER JOIN product_master b ON a.product_id=b.product_id INNER JOIN product_image c ON a.product_id=c.product_id WHERE a.prod_status='Active' GROUP BY a.product_id ORDER BY RAND() LIMIT 10");
		return $query;
	}
	
	
	function retrieve_product(){
	
		 
		/* $query = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY product_id ORDER BY RAND() LIMIT 5  ");*/
		 
		 
		  $query = $this->db->query("SELECT  product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity 
									FROM cornjob_productsearch
									WHERE prod_search_sqlid
									IN (
									
									SELECT prod_search_sqlid
									FROM (
									
									SELECT prod_search_sqlid
									FROM cornjob_productsearch
									ORDER BY RAND( ) 
									LIMIT 5
									)t
									)
									AND prod_status =  'Active'
									AND seller_status =  'Active'
									AND STATUS =  'Enabled'
									AND (
									quantity >0
									)  ");
		
		 
		return $query;
	}
	
	
	
	
	function retrieve_trending_products(){
	
		 
		 $pord_viewqr=$this->db->query("SELECT sku FROM product_viewcount GROUP BY sku ORDER BY prodview_count desc LIMIT 5");
		 $pordviewctr=array();
		 
		 foreach($pord_viewqr->result_array() as $res_prodview)
		 {$pordviewctr[]="'".$res_prodview['sku']."'";}
		 $pordviewctr_string=implode(',',$pordviewctr);
		 
		 if($pord_viewqr->num_rows()>0)
		{ $query = $this->db->query("SELECT lvl2,product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND sku IN ($pordviewctr_string) GROUP BY sku   ");
		}else
		{
		
		 $query = $this->db->query("SELECT lvl2,product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY sku ORDER BY cronprod_viewcount desc LIMIT 5  ");
		 
		}
		
		//-------------------sujit start home page cache----------------------------//
		/*$this->db->cache_off();
		
								//delete start
		
		$querycachedlt=$this->db->query("select clear_catch.catg_id,clear_catch.folder_name from clear_catch inner join prod_cache on clear_catch.catg_id=prod_cache.catg_id where clear_catch.folder_name='default+index' ");
		$cnt=$querycachedlt->num_rows();
		if($querycachedlt->num_rows()>0)
		{
			foreach($query->result_array() as $res)  
			{
				$catg_id=$res['catg_id'];
				//echo $catg_id;exit;
				$folder_name=$res['folder_name'];
				list($folder_name1, $folder_name2) = explode("+", $folder_name, 2);
				$this->db->cache_delete($folder_name1, $folder_name2);
				$this->db->query("DELETE FROM clear_catch WHERE catg_id='$catg_id'");
				$this->db->query("DELETE FROM prod_cache WHERE catg_id='$catg_id'");
			}
		}
		*/
		
								//delete end
		
		
								//insert start
		
		/*foreach ($query->result() as $row){
			$dskcatgid_idarr=$row->lvl2 ;
		$data=array(
					'catg_id'=>$dskcatgid_idarr,
					'folder_name'=>"default+index"
					);
		$querycache=$this->db->query("select * from clear_catch where catg_id='$dskcatgid_idarr' and folder_name='default+index' ");
		  if($querycache->num_rows()==0)
		  {
		  $qr=$this->db->insert('clear_catch',$data);
		  }
		}
		
								//insert end
		$this->db->cache_on();*/
		
		//-------------------sujit end home page cache----------------------------//
		
		
		return $query;
	}
	
	function retrieve_product_for_scroll1(){
		//$product_arr=array();
		
//		$query_product=$this->db->query("select product_id FROM product_master WHERE  approve_status='Active' AND status='Enabled' AND seller_id!=0 AND seller_id IN (SELECT seller_id FROM seller_account_information) GROUP BY product_id  ORDER BY RAND() LIMIT 5 ");
//		$row_prod=$query_product->result();
//		foreach($row_prod as $res_prod)
//		{
//			array_push($product_arr,$res_prod->product_id);
//		}
//		$productid_str=implode(',',$product_arr);
//		
//		$query = $this->db->query("SELECT a.*,b.sku,b.price,b.special_price,c.* FROM product_general_info a 
//		INNER JOIN product_master b ON a.product_id=b.product_id 
//		INNER JOIN product_image c ON a.product_id=c.product_id 
//		INNER JOIN product_setting d ON  a.product_id=d.product_id INNER JOIN seller_account e on e.seller_id=b.seller_id  WHERE b.product_id IN ($productid_str) AND d.status='Active' AND e.status='Active' AND b.quantity!=0 AND b.stock_availability='In Stock'");
		
 
 $prod_skustr=get_cookie('prodid', TRUE);  
 
 $modf_prod_skustr=implode(',',array_unique(explode(',', $prod_skustr)));
//$query = $this->db->query("SELECT product_id,name,sku,imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0)  GROUP BY product_id ORDER BY RAND() DESC LIMIT 5  ");
$query = $this->db->simple_query("SELECT lvl2,product_id,name,sku,imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND product_id IN ($modf_prod_skustr) GROUP BY product_id LIMIT 5  ");
if($query==TRUE)
{$query = $this->db->query("SELECT lvl2,product_id,name,sku,imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND product_id IN ($modf_prod_skustr) GROUP BY product_id LIMIT 5  ");
	
	//-------------------sujit start home page cache----------------------------//
		/*$this->db->cache_off();
		
								//delete start
		
		$querycachedlt=$this->db->query("select clear_catch.catg_id,clear_catch.folder_name from clear_catch inner join prod_cache on clear_catch.catg_id=prod_cache.catg_id where clear_catch.folder_name='default+index' ");
		$cnt=$querycachedlt->num_rows();
		if($querycachedlt->num_rows()>0)
		{
			foreach($querycachedlt->result_array() as $res)  
			{
				$catg_id=$res['catg_id'];
				//echo $catg_id;exit;
				$folder_name=$res['folder_name'];
				list($folder_name1, $folder_name2) = explode("+", $folder_name, 2);
				$this->db->cache_delete($folder_name1, $folder_name2);
				$this->db->query("DELETE FROM clear_catch WHERE catg_id='$catg_id'");
				$this->db->query("DELETE FROM prod_cache WHERE catg_id='$catg_id'");
			}
		}*/
		
		
								//delete end
		
		
								//insert start
		
		/*foreach ($query->result() as $row){
			$dskcatgid_idarr=$row->lvl2 ;
		$data=array(
					'catg_id'=>$dskcatgid_idarr,
					'folder_name'=>"default+index"
					);
		$querycache=$this->db->query("select * from clear_catch where catg_id='$dskcatgid_idarr' and folder_name='default+index' ");
		  if($querycache->num_rows()==0)
		  {
		  $qr=$this->db->insert('clear_catch',$data);
		  }
		}
		
								//insert end
		$this->db->cache_on();*/
		
		//-------------------sujit end home page cache----------------------------//
	
	return $query;
}
		//return $query;
	}
	
	function retrieve_product_for_scroll2(){
		$query = $this->db->query("SELECT a.*,b.sku,b.price,b.special_price,c.* FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_setting d ON  a.product_id=d.product_id INNER JOIN seller_account e on e.seller_id=b.seller_id  WHERE d.status='Active' AND b.approve_status='Active' AND b.status='Enabled' AND e.status='Active' AND b.seller_id!=0 AND b.seller_id
IN (
SELECT seller_id
FROM seller_account_information
) ORDER BY  rand() LIMIT 5   ");
		return $query;
	}
	
	function retrive_user_data(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT * FROM user WHERE user_id='$user_id'");
		return $query->result();
	}
	
	function insert_inn_wishlist(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$product_id = $this->input->post('product_id');
		$sku = $this->input->post('sku');
		$query = $this->db->query("SELECT * FROM wishlist WHERE user_id='$user_id' AND sku='$sku'");
		$row = $query->num_rows();
		if($row > 0){
			return false;
		}else{
			$data = array(
				'user_id' => $user_id,
				'product_id' => $product_id,
				'sku' => $sku
			);
			$this->db->insert('wishlist',$data);
			if($this->db->affected_rows()>0){
				return true;
			}
		}
	}
	
	
	
	
	
	
	
	function insert_inn_wishlist_temp(){
		
		
		$product_id = $this->input->post('product_id');
		$sku = $this->input->post('sku');
		
		array_push($this->session->userdata['addtowishlisttemp_prdid'],$product_id);
		
		array_push($this->session->userdata['addtowishlist_tempsku'],$sku);
		
		return true;
		
	}
	
	function retrieve_wishlist_products(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.*,b.mrp,b.price,b.sku,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,b.stock_availability,c.imag,e.wishlist_id FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id = b.product_id 
		INNER JOIN product_image c ON a.product_id = c.product_id
		INNER JOIN product_setting d ON a.product_id = d.product_id
		INNER JOIN wishlist e ON e.sku = b.sku 
		WHERE b.approve_status='Active' AND d.status='Active' AND e.user_id='$user_id'");
		return $query;
	}
	
	function delete_from_wishlist(){
		$wishlist_id = $this->input->post('id');
		$this->db->where('wishlist_id', $wishlist_id);
		$this->db->delete('wishlist');
		return true;
	}
	
	/*function retrieve_customer_order_details(){
		$user_id = $user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.order_id,a.sub_total_amount,a.quantity,b.name,b.description,b.short_desc,c.imag,d.business_name ,e.date_of_order,e.order_status,e.Total_amount FROM ordered_product_from_addtocart a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN seller_account_information d ON a.seller_id=d.seller_id 
		INNER JOIN order_info e ON a.order_id=e.order_id WHERE a.user_id='$user_id'");
		return $query;
	}*/
	
	function retrieve_customer_last3_mnth_order_id(){
		$user_id = $user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.order_id,COUNT(a.order_id) AS NO_OF_ITEM,a.seller_id,b.business_name ,c.id,c.date_of_order,c.order_status,c.Total_amount FROM ordered_product_from_addtocart a 		
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN order_info c ON a.order_id=c.order_id WHERE a.user_id='$user_id' AND c.is_transfer='no' AND c.date_of_order >= now()-interval 3 month GROUP BY a.order_id ORDER BY c.id DESC");
		return $query;
	}
	
	function retrieve_customer_past_order_id(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.order_id,COUNT(a.order_id) AS NO_OF_ITEM,a.seller_id,b.business_name ,c.id,c.date_of_order,c.order_status,c.Total_amount FROM ordered_product_from_addtocart a 		
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN order_info c ON a.order_id=c.order_id WHERE a.user_id='$user_id' AND c.is_transfer='no' AND c.date_of_order <= now()-interval 3 month GROUP BY a.order_id ORDER BY c.id DESC");
		return $query;
	}
	
	function cancel_order(){
		$id = $this->input->post('id');
		$cdate = date('Y-m-d H:i:s');
		$data = array(
			'order_status' => 'Cancelled',
			'order_status_modified_date' => $cdate,
			'cancelled_by'=>'Customer'
		);
		$this->db->where('id',$id);
		$this->db->update('order_info',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	
	//===========================Order status change log insert start===================================================//		
		

	function update_orderstatus_log($ordered_id,$order_log_status)
		{
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			
			$qr=$this->db->query("select * from order_status_log WHERE order_id IN ($ordered_id) ");
			$ct=$qr->num_rows();
			
			if($ct>0)
			{
				$this->db->query("update order_status_log set ".$order_log_status."='$dt' WHERE order_id IN ($ordered_id) ");	
			}else
			{
				$order_arr=explode(',',$ordered_id);
				$ct=count($order_arr);
				
				for($i=0; $i<$ct; $i++)
				{
					$data=array(
						'order_id'=>$order_arr[$i],
						$order_log_status=>$dt
					 );
					 $this->db->insert('order_status_log',$data );
				} // for loop end
			}
					
		}

		
//===========================Order status change log insert end======================================================//
	
	function cancel_product(){
		$id = $this->input->post('id');
		$sku = $this->input->post('sku_id');
		$order_id = $this->input->post('order_id');
		$reason = $this->input->post('reason');
		$cancel_qty = $this->input->post('qty');
		$cdate = date('Y-m-d H:i:s');
		$data = array(
			'product_order_status' => 'Cancelled',	
		);
		
		//======================Order Status log insert start==========================
			
			$order_log_status='buyer_cancel_date';
			$this->update_orderstatus_log($order_id,$order_log_status);
			
		//======================Order Status log insert end==========================
		
		$cancel_data = array(
			'order_id' => $order_id,
			'sku' => $sku,
			'reason' => $reason,
		);
		
		$this->refund_wallet_balance($sku,$order_id);
		
		//program start for quantity increment of product//
		$query = $this->db->query("SELECT quantity FROM product_master WHERE sku='$sku'");
		$result = $query->result();
		$quantity = $result[0]->quantity;
		$total_qty = $quantity+$cancel_qty;
		$qty_data = array('quantity' => $total_qty);
		$this->db->where('sku',$sku);
		$this->db->update('product_master',$qty_data);
		
		//quantity update in seller product table start here//
		$query1 = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku'");
		if($query1->num_rows() > 0){
			$this->db->where('sku',$sku);
			$this->db->update('seller_product_master',$qty_data);
		}else{
			$query2 = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku'");
			if($query2->num_rows() > 0){
				$result3 = $query2->result();
				$slr_prdt_id = $result3[0]->seller_product_id;
				$this->db->where('seller_product_id',$slr_prdt_id);
				$this->db->update('seller_product_inventory_info',$qty_data);
			}
		}
		//quantity update in seller product table end here//
		//program end of quantity increment in of product//
		
		$this->db->where('id',$id);
		$this->db->update('ordered_product_from_addtocart',$data);
		if($this->db->affected_rows() > 0){
			$this->db->insert('cancel_product',$cancel_data);
			if($this->db->affected_rows() > 0){
				//program start for checking if all product are cancel of a order or not//
				$query4 = $this->db->query("SELECT * FROM ordered_product_from_addtocart WHERE order_id='$order_id'");
				$row4 = $query4->num_rows();
				$query5 = $this->db->query("SELECT * FROM ordered_product_from_addtocart WHERE order_id='$order_id' AND product_order_status='Cancelled'");
				$row5 = $query5->num_rows();
				if($row4 == $row5){
					$status_data = array('order_status' => 'Cancelled','cancelled_by'=>'Customer');
					$this->db->where('order_id',$order_id);
					$this->db->update('order_info',$status_data);
					return true;
				}else{
					return true;
				}
				//program end of checking if all product are cancel of a order or not//
			}
		}
	}
	
	function refund_wallet_balance($sku,$order_id){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT order_id_payment_gateway FROM order_info WHERE order_id='$order_id'");
		$result = $query->row();
		$transaction_id = $result->order_id_payment_gateway;
		
		//retrieve wallet adjustment amount program start here//
		$query1 = $this->db->query("SELECT adj_amount FROM pay_adjust_data WHERE transaction_id='$transaction_id' AND adj_type='W'");
		if($query1->num_rows() > 0){
			$result1 = $query1->row();
			$wlt_adj_amt = $result1->adj_amount;
		}else{
			$wlt_adj_amt = 0;
		}
		//retrieve wallet adjustment amount program end here//
		
		//update wallet balance program start here//
		$wlt_sql = $this->db->query("SELECT wallet_balance FROM wallet_info WHERE user_id='$user_id'");
		if($wlt_sql->num_rows() > 0){
			$wlt_res = $wlt_sql->row();
			$wlt_amt = $wlt_res->wallet_balance;
			$total_wlt_amt = $wlt_amt+$wlt_adj_amt;
			$data = array('wallet_balance'=>$total_wlt_amt);
			$this->db->where('user_id',$user_id);
			$this->db->update('wallet_info',$data);
		}
		//update wallet balance program end here//
	}
	
	function mail_cancel_product()	
	{
			$order_id = $this->input->post('order_id');
		
			//email for cancellation of ordered product start
		
		$query_reurn_product_info=$this->db->query("select c.imag,d.name as prd_name, a.quantity, a.sub_total_amount from  ordered_product_from_addtocart a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id where a.order_id='$order_id'  ");
			$row_reurn_product_info=$query_reurn_product_info->result();
			$image=explode(',',$row_reurn_product_info[0]->imag);
			
			$rtorder_id=$order_id;
			
			$image_name=$image[0]; //image name
			$prd_name=$row_reurn_product_info[0]->prd_name;
			$prd_qnt=$row_reurn_product_info[0]->quantity;
			$prd_totamnt=$row_reurn_product_info[0]->sub_total_amount;
		
				 $data['rtorder_id']=$rtorder_id;
			$data['prd_name']=$prd_name;
			$data['prd_qnt']=$prd_qnt;
			$data['prd_totamnt']=$prd_totamnt;
			
				
								$user_id = $this->session->userdata['session_data']['user_id'];
								$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								$email1=$mail_row1->email;
								$fname=$mail_row1->fname;
								$data['fname']=$fname;
								$data['email1']=$email1;
								/*$message1 = "
										 <html>
					<head>					
					<title></title>
					<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
					</head>					
					<body style='background-color:#fabd2f; font-family:'Calibri',Arial, Helvetica, sans-serif;'>
					
					<table width='600' cellspacing='0' align='center'>
					<tr> <td style='text-align:right; color:#e8442b;font-weight:bold; font-size:14px;'> 
					Call us :  <span style='color:#fff;'> 917874460000  </span><br>
					Email :   <span style='color:#fff;'> seller@moonboy.in </span> 
					</td>
					</tr>
					
					<tr>
					<td> 
					
					<table style'background-color:#f1f1f1;color:#333; font-size:12px; border:2px solid #e8442b;'>
					<tr>
					
					<td align='center' colspan='3'>
					
					 Moonboy
					 <div style='clear:both;'>  </div>
					
					<div style='clear:both;'> </div>
					 </td> </tr>
					 
					 <tr> 
					 <td width='10px'> </td>
					 <td>
					 <p> <strong style='font-size:16px;'>Dear ".$mail_row1->fname." ,</strong> <br /><br />
					
					<span style='color:#e25a0c; font-weight:bold;'> Order No.: ".$rtorder_id."</span> <br /> <br />
					
					This Ordered product cancelled with following details:
					
					<table border='1' ><tr bgcolor='#CCC'> <th>Product Name </th><th>Quantity </th><th>Amount </th></tr> 
					<tr> 
					<td> ".$prd_name." </td> <td> ".$prd_qnt." </td> <td>Rs.".$prd_totamnt."  </td>  </tr>
					
					</table>
					<br />  <br />
					 
					
					</td> 
					<td width='10px'></td>
					</tr>
					</table>
					
					</td>
					</tr>
					
					<tr>
					<td style='background-color:#e8442b;  border:2px solid #e8442b; color:#fff; padding:15px; text-align:center;'>
					 &copy; 2015 Moonboy. 1st Floor, Khajotiya House, Beside Parsi Fire Temple , Sayedpura, Surat, GJ, IN- 395003 <br />
					You received this email because you're a registered Moonboy user. 
					</td> </tr> </table>
					
					</td> </tr> </table>
					
					</body>
					</html>";*/
			
			
	
				$this->email->set_mailtype("html");
				$this->email->from('noreply@moonboy.in', 'Moonboy.in');
				$this->email->to($email1);
				$this->email->subject('Ordered Product Cancellled');
				$this->email->message($this->load->view('email_template/ordercancel_buyer',$data,true));
				//$this->email->message($message1);
				$this->email->send();
				
				date_default_timezone_set('Asia/Calcutta');
				$dt = date('Y-m-d H:i:s');
					
				$msg=$this->load->view('email_template/ordercancel_buyer',$data,true);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$email1,
					'from_email_id'=>'noreply@moonboy.in',
					'date'=>$dt,
					'email_sub'=>'Ordered Product Cancellled',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$email1,
					'from_email_id'=>'noreply@moonboy.in',
					'date'=>$dt,
					'email_sub'=>'Ordered Product Cancellled',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);
				}
				$this->db->insert('email_log',$email_data);
			
		
	}
	
	
	/*function retrive_indivisual_order_id_details($order_id){
		$query = $this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.name,b.description,b.short_desc,c.imag,d.*,f.business_name,g.state,
		h.payment_type FROM order_info a INNER JOIN ordered_product_from_addtocart e ON a.order_id=e.order_id 
		INNER JOIN product_general_info b ON b.product_id=e.product_id 
		INNER JOIN product_image c ON b.product_id=c.product_id 
		INNER JOIN shipping_address d ON a.order_id=d.order_id 
		INNER JOIN seller_account_information f ON e.seller_id=f.seller_id 
		INNER JOIN state g ON d.state=g.state_id 
		INNER JOIN payment_info h ON a.payment_mode=h.payment_mode_id WHERE a.order_id='$order_id'");
		return $query->result();
	}*/
	
	
	function retrive_indivisual_order_id_details($order_id){
		$query = $this->db->query("SELECT a.order_id,a.order_processstatus,a.Total_amount,a.date_of_order,a.order_status,a.invoice_id, a.order_id_payment_gateway,d.*,f.seller_id,f.business_name,g.state,
		h.payment_type FROM order_info a INNER JOIN ordered_product_from_addtocart e ON a.order_id=e.order_id 				
		INNER JOIN shipping_address d ON a.order_id=d.order_id 
		INNER JOIN seller_account_information f ON e.seller_id=f.seller_id 
		INNER JOIN state g ON d.state=g.state_id 
		INNER JOIN payment_info h ON a.payment_mode=h.payment_mode_id WHERE a.order_id='$order_id'");
		return $query->result();
	}
	
	function retrive_indivisual_order_id_product_details($order_id){
		$query = $this->db->query("SELECT a.id,a.product_id,a.sku,a.sub_total_amount,a.quantity,a.product_order_status,a.prdt_color,a.prdt_size,b.name,b.description,b.short_desc,c.imag FROM ordered_product_from_addtocart a INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		WHERE a.order_id='$order_id'");
		return $query->result();
	}
	
	function get_customer_referenceid($table, $field){
		$query = $this->db->query("SELECT MAX($field) AS `maxid` FROM ".$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	
	function insert_customer_support_data(){
		date_default_timezone_set('Asia/Calcutta');
		$dt =  date('Y-m-d H:i:s');
		$customer_reference_id = $this->get_customer_referenceid('customer_support', 'customer_reference_id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$subject = $this->input->post('title');
		$content = $this->input->post('content');
		$query = $this->db->query("INSERT INTO customer_support SET customer_reference_id='$customer_reference_id', name='$name',
		email='$email',subject='$subject',content='$content',mobile='$mobile',create_date='$dt'");
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	function insert_inn_return_product(){
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d H:i:s');
		$return_id = 'RN'.preg_replace("/[^0-9]+/","", $date);
		
		$product_return_id = $this->input->post('return_prdt_id');
		$return_type = $this->input->post('retn_typ');
		$reason = $this->input->post('reason');
		$coment = $this->input->post('comnt');
		$query = $this->db->query("SELECT * FROM ordered_product_from_addtocart WHERE id=$product_return_id");
		$result = $query->result();
		
		$return_data = array(
			'return_id' => $return_id,
			'order_id' => $result[0]->order_id,
			'sku' => $result[0]->sku,
			'quantity' => $result[0]->quantity,
			'tax_rate' => $result[0]->sub_tax_rate,
			'shipping_fee' => $result[0]->sub_shipping_fees,
			'total_amount' => $result[0]->sub_total_amount,
			'seller_id' => $result[0]->seller_id,
			'return_typ' => $return_type,
			'reason' => $reason,
			'comnt' => $coment,
			'cdate' => $date
		);
		
		$this->db->insert('return_product',$return_data);
		if($this->db->affected_rows() > 0){
			$data = array(
				'product_order_status' => 'Return Requested',
			);
			$this->db->where('id',$product_return_id);
			$this->db->update('ordered_product_from_addtocart',$data);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	/*$data = array(
				'order_status' => 'Return Requested',
			);
			$this->db->where('order_id',$result[0]->order_id);
			$this->db->update('order_info',$data);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}*/
			
			function insert_subscriber_detail($email,$gender)
	{
		//print_r($email);exit;
		$query = $this->db->query("select max(user_unique_id) as scb_unique from subscriber_detail");
		$qr=$query->row()->scb_unique;
		//print_r($qr);exit;
		$unique1d=$qr+1;
		date_default_timezone_set('Asia/Calcutta');
		$dt =  date('Y-m-d H:i:s');
		//$x="insert into subscriber_detail(user_unique_id,user_email_id,user_gender) values('$unique1d','$email','$gender')";echo $x;exit;
		//print_r($unique1d);exit;
		$insert_scb=$this->db->query("insert into subscriber_detail(user_unique_id,user_email_id,user_gender,user_reg_date) values('$unique1d','$email','$gender','$dt')");
		return $insert_scb;
	}
	
	function select_subscriber_detail($email,$gender)
	{
		$query = $this->db->query("select * from subscriber_detail where user_email_id='$email' and user_gender='$gender'");
		$scb_register=$query->num_rows();
		//print_r($scb_register);exit;
		if($scb_register>0)
		{
			return $query->result();
		}
		else{
			return false;
		}
	}
	
	function insert_user_mobile_otp($otp){
		date_default_timezone_set('Asia/Calcutta');
		$dt =  date('Y-m-d H:i:s');

		$user_otp_data = array(
			'user_email' => $this->input->post('email'),
			'user_otp' => $otp,
			'creat_time' => $dt,
		);
		$this->db->insert('user_mobile_change_otp', $user_otp_data);
		return true;
	}
	
	function retrive_mob_otp_details($otp){
		$query = $this->db->query("SELECT * FROM user_mobile_change_otp WHERE user_otp = '$otp' ORDER BY creat_time DESC LIMIT 1");
		return $query->result();
	}
	
	function getEmailbyIserID($user_id){
		$query = $this->db->query("SELECT * FROM user WHERE user_id = '$user_id'");
		return $query->result();
	}
	
	function retrieve_tracking_details($order_id){
		$query = $this->db->query("SELECT * FROM shipment_info WHERE order_id='$order_id'");
		$rows = $query->num_rows();
		if($rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
}