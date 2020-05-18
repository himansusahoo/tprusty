<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function slider_box1_select(){
		$results = array();
		$qr = $this->db->query("SELECT a.*, b.category_name FROM slider_box1 a INNER JOIN category_indexing b ON a.category_id = b.category_id ORDER BY box1_id ASC");
		return $qr;
	}
	
	function insert_slider_box1($name_array1){
		$this->db->query("insert into slider_box1(box1_image) values('$name_array1')");
		return true;
	}
	
	function update_slider_box1($name_array1,$id,$category){
		$qr=$this->db->query("UPDATE slider_box1 SET box1_image='$name_array1',category_id='$category' where box1_id='$id' ");
		return true;
	}

	function insert_box1($name_array1,$category){
		$this->db->query("insert into block_and_box_images(image_name,category_id) values('$name_array1','$category')");
		return true;
	}
	
	function box1_select(){
		$qr=$this->db->query("SELECT a.*, b.category_name FROM block_and_box_images a INNER JOIN category_indexing b ON a.category_id = b.category_id WHERE box_name='box1' ORDER BY image_id ASC");	
		return $qr;
	}
	
	function update_box1($name_array1,$category)	{
		$qr=$this->db->query("UPDATE block_and_box_images SET image_name='$name_array1',category_id='$category' WHERE image_id = 1 ");
		return true;
	}
	
	function box2_select(){
		$qr=$this->db->query("SELECT a.*, b.category_name FROM block_and_box_images a INNER JOIN category_indexing b ON a.category_id = b.category_id WHERE image_id=2");	
		return $qr;
	}
	
	function insert_box2($name_array1,$category){
		$this->db->query("insert into block_and_box_images(image_name,category_id) values('$name_array1','$category')");
		return true;
	}
	
	function update_box2($name_array1,$category){
		$qr=$this->db->query("UPDATE block_and_box_images SET image_name='$name_array1',category_id='$category' WHERE image_id = 2 ");
		return true;
	}	
	
	function block2_box1_select(){
		$qr=$this->db->query("SELECT a.*, b.category_name FROM block_and_box_images a INNER JOIN category_indexing b ON a.category_id = b.category_id WHERE box_name='box2' ORDER BY image_id ASC");	
		return $qr;
	}
	
	function insert_block2_box1($name_array1,$category){
		$this->db->query("insert into block_and_box_images(image_name,category_id) values('$name_array1','$category')");
		return true;
	}
	
	function update_block2_box1($name_array1,$category){
		$qr=$this->db->query("UPDATE block_and_box_images SET image_name='$name_array1',category_id='$category' WHERE image_id = 3 ");
		return true;
	}
	
	function block2_box2_select(){
		$qr=$this->db->query("select * from block_and_box_images WHERE image_id=4");	
		return $qr;
	}
	
	function insert_block2_box2($name_array1,$category){
		$this->db->query("insert into block_and_box_images(image_name,category_id) values('$name_array1','$category')");
		return true;
	}
	
	function update_block2_box2($name_array1,$category){
		$qr=$this->db->query("UPDATE block_and_box_images SET image_name='$name_array1',category_id='$category' WHERE image_id = 4 ");
		return true;
	}
	
	function block2_box3_select(){
		$qr=$this->db->query("select * from block_and_box_images WHERE image_id=5");	
		return $qr;
	}
	
	function insert_block2_box3($name_array1,$category){
		$this->db->query("insert into block_and_box_images(image_name,category_id) values('$name_array1','$category')");
		return true;
	}
	
	function update_block2_box3($name_array1,$category){
		$qr=$this->db->query("UPDATE block_and_box_images SET image_name='$name_array1',category_id='$category' WHERE image_id = 5 ");
		return true;
	}
	
	function block3_box1_select(){
		$qr=$this->db->query("SELECT a.*, b.category_name FROM block_and_box_images a INNER JOIN category_indexing b ON a.category_id = b.category_id WHERE box_name='box3' ORDER BY image_id ASC");	
		return $qr;
	}
	
	function insert_block3_box1($name_array1,$category){
		$this->db->query("insert into block_and_box_images(image_name,category_id) values('$name_array1','$category')");
		return true;
	}
	
	function update_block3_box1($name_array1,$category){
		$qr=$this->db->query("UPDATE block_and_box_images SET image_name='$name_array1',category_id='$category' WHERE image_id = 6");
		return true;
	}
	
	function ad_blog(){
		$qr=$this->db->query("select * from block_and_box_images WHERE image_id=7");	
		return $qr;
	}
	
	function insert_ad_blog($name_array1){
		$this->db->query("insert into block_and_box_images(image_name) values('$name_array1')");
		return true;
	}
	
	function update_ad_blog($name_array1){
		$qr=$this->db->query("UPDATE block_and_box_images SET image_name='$name_array1' WHERE image_id = 7 ");
		return true;
	}	
	
	// NEW
	function insert_slider_tmp_img($name_array1){
		$data = array(
			'image_name' => $name_array1,
			'type' => 'slider_img',
		);
		$this->db->insert('tmp_slider_img', $data);
	}
	function delete_slider_tmp_img($fileName){
		$type = 'slider_img';
		$this->db->where('type', $type);
		$this->db->delete('tmp_slider_img');
	}
	function update_slider_image(){
		$query = $this->db->query("SELECT image_name FROM tmp_slider_img WHERE type='slider_img' ORDER BY id DESC LIMIT 1");
		$res = $query->row();
		$image = $res->image_name;  
		$category_id = $this->input->post('categoryid1'); 
		$slider_sl_id = $this->input->post('hidden_slider_id');
		
		$data = array(
			'box1_image' => $image,
			'category_id' => $category_id,
		);
		$this->db->where('box1_id',$slider_sl_id);
		$this->db->update('slider_box1', $data);
		
		$this->db->where('type', 'slider_img');
		$this->db->delete('tmp_slider_img');
		return true;
	}
	
	
	function insert_box1_tmp_img($name_array1){
		$data = array(
			'image_name' => $name_array1,
			'type' => 'block1_img',
		);
		$this->db->insert('tmp_slider_img', $data);
	}
	function delete_box1_tmp_img($fileName){
		$type = 'block1_img';
		$this->db->where('type', $type);
		$this->db->delete('tmp_slider_img');
	}
	function update_box1_image_image(){
		$query = $this->db->query("SELECT image_name FROM tmp_slider_img WHERE type='block1_img' ORDER BY id DESC LIMIT 1");
		$res = $query->row();
		$image = $res->image_name;  
		$category_id = $this->input->post('categoryid1'); 
		$slider_sl_id = $this->input->post('hidden_slider_id'); //echo $image."  ". $category_id." ".$slider_sl_id; exit;
		
		$data = array(
			'image_name' => $image,
			'category_id' => $category_id,
		);
		$this->db->where('image_id', $slider_sl_id);
		$this->db->update('block_and_box_images', $data);
		
		$this->db->where('type', 'block1_img');
		$this->db->delete('tmp_slider_img');
		return true;
	}
	
	function insert_box2_tmp_img($name_array1){
		$data = array(
			'image_name' => $name_array1,
			'type' => 'block2_img',
		);
		$this->db->insert('tmp_slider_img', $data);
	}
	function delete_box2_tmp_img($fileName){
		$type = 'block2_img';
		$this->db->where('type', $type);
		$this->db->delete('tmp_slider_img');
	}
	function update_box2_image_image(){
		$query = $this->db->query("SELECT image_name FROM tmp_slider_img WHERE type='block2_img' ORDER BY id DESC LIMIT 1");
		$res = $query->row();
		$image = $res->image_name;  
		$category_id = $this->input->post('categoryid2'); 
		$slider_sl_id = $this->input->post('hidden_slider_id'); //echo $image."  ". $category_id." ".$slider_sl_id; exit;
		
		$data = array(
			'image_name' => $image,
			'category_id' => $category_id,
		);
		$this->db->where('image_id', $slider_sl_id);
		$this->db->update('block_and_box_images', $data);
		
		$this->db->where('type', 'block2_img');
		$this->db->delete('tmp_slider_img');
		return true;
	}
	
	function insert_box3_tmp_img($name_array1){
		$data = array(
			'image_name' => $name_array1,
			'type' => 'block3_img',
		);
		$this->db->insert('tmp_slider_img', $data);
	}
	function delete_box3_tmp_img($fileName){
		$type = 'block3_img';
		$this->db->where('type', $type);
		$this->db->delete('tmp_slider_img');
	}
	function update_box3_image_image(){
		$query = $this->db->query("SELECT image_name FROM tmp_slider_img WHERE type='block3_img' ORDER BY id DESC LIMIT 1");
		$res = $query->row();
		$image = $res->image_name;  
		$category_id = $this->input->post('categoryid2'); 
		$slider_sl_id = $this->input->post('hidden_slider_id'); //echo $image."  ". $category_id." ".$slider_sl_id; exit;
		
		$data = array(
			'image_name' => $image,
			'category_id' => $category_id,
		);
		$this->db->where('image_id', $slider_sl_id);
		$this->db->update('block_and_box_images', $data);
		
		$this->db->where('type', 'block3_img');
		$this->db->delete('tmp_slider_img');
		return true;
	}
	
	function addnew_codchargesasperweight()
	{
		$wt_from=$this->input->post('weight_from');
		$wt_to=$this->input->post('weight_to');	
		$chrg_amnt=$this->input->post('charge_amount');
		$dtm=date('Y-m-d H:i:s');
		
		$data=array(
			'wt_from'=>$wt_from,
			'wt_to'=>$wt_to,
			'wt_charge'=>$chrg_amnt,
			'dtm_modf'=>$dtm
		
		);
		
		$this->db->insert('cod_chargeasper_weight',$data);
	
	}
	
	function select_codchargesasweight()
	{
		return $query=$this->db->query("SELECT * FROM cod_chargeasper_weight ORDER BY cod_wtsqlid DESC");	
	}
	
	public function edit_codchargesasperweight()
	{
		$cod_wtcgrg_sqlid=$this->input->post('weight_sqlidedit');
		$weight_fromedit=$this->input->post('weight_fromedit');
		$weight_toedit=$this->input->post('weight_toedit');
		$charge_amountedit=$this->input->post('charge_amountedit');
		$dtm=date('Y-m-d H:i:s');
		
		$data=array(
			'wt_from'=>$weight_fromedit,
			'wt_to'=>$weight_toedit,
			'wt_charge'=>$charge_amountedit,
			'dtm_modf'=>$dtm
		);
		
		$this->db->where('cod_wtsqlid',$cod_wtcgrg_sqlid);
		$this->db->update('cod_chargeasper_weight',$data);
		
	}
	
	public function delete_codchargesasperweight()
	{
		$codwt_sqlid=$this->input->post('codsqlidwtchrg');
		
		$this->db->query("DELETE FROM cod_chargeasper_weight WHERE cod_wtsqlid='$codwt_sqlid' ");	
	}
	
	
	
	function select_size()
	{
		return $query=$this->db->query("SELECT * FROM size_master ORDER BY size_id DESC");	
	}
	
	function addnew_sizes()
	{
		$size_name=$this->input->post('size_name');
		$size_cate='M';
		$dtm=date('Y-m-d H:i:s');
		
		$data=array(
			'size_name'=>$size_name,
		    'size_cat'=>$size_cate
		);
		
		$this->db->insert('size_master',$data);
	
	}
	
	public function edit_sizes()
	{
		$size_id=$this->input->post('size_idedit');
		$size_name=$this->input->post('size_name');
		$size_cate='M';
		
		$data=array(
			'size_name'=>$size_name,
		    'size_cat'=>$size_cate
		);
		
		$this->db->where('size_id',$size_id);
		$this->db->update('size_master',$data);
		
	}
	
	
	public function delete_sizes()
	{
		$size_id=$this->input->post('size_id');
		
		$this->db->query("DELETE FROM size_master WHERE size_id='$size_id' ");	
	}
	
	
	
	
	function select_color()
	{
		return $query=$this->db->query("SELECT * FROM color_master ORDER BY color_id DESC");	
	}
	
	
	function addnew_colors()
	{
		$color_name=$this->input->post('color_name');
		//$color_code=$this->input->post('color_code');
		
		$data=array(
			'clr_name'=>$color_name,
		    //'clr_cod'=>$color_code
		);
		
		$this->db->insert('color_master',$data);
	
	}
	
	public function edit_colors()
	{
		$color_id=$this->input->post('color_idedit');
		$color_name=$this->input->post('color_name');
		
		$data=array(
			'clr_name'=>$color_name
		);
		
		$this->db->where('color_id',$color_id);
		$this->db->update('color_master',$data);
		
	}
	function select_codtaxrate()
	{
		return $query=$this->db->query("SELECT * FROM cod_taxratecharges ");	
			
	}
	
	
	
	
	
	function select_attrilink()
	{
		return $query=$this->db->query("SELECT * FROM attribute_group WHERE cate_attributelink!='' ORDER BY attribute_group_id ASC");	
	}
	public function addnew_attrilink()
	{
		//$attribute_id=$this->input->post('attri_groupid');
		 $catg_name=$this->input->post('catg_name');
		 $cate_attributelink=$this->input->post('attrilinkgroup');
		 
		$query=$this->db->query("SELECT DISTINCT cate_attributelink FROM attribute_group WHERE attribute_group_id='$catg_name'");
		$catelink=$query->row()->cate_attributelink;
		if($query->num_rows()>0)
		{
			$unserialize_link=unserialize($catelink);
			foreach($cate_attributelink as $key=>$val)
			{
				$unserialize_link[]=$val;
				
			}
				$slzcate_link=serialize($unserialize_link);
				$qr=$this->db->query("UPDATE attribute_group SET cate_attributelink='$slzcate_link' WHERE attribute_group_id='$catg_name'");
	
		}
		else{
			$serialize_link=serialize($cate_attributelink);
			$data=array(	
				'cate_attributelink'=>$serialize_link
			);
		
		$this->db->where('attribute_group_id',$catg_name);
		$this->db->update('attribute_group',$data);
		}
		
	}
	function delete_allattrilink()
		{
			$attri_id=$this->input->post('attri_id');
			$attri_nm=$this->input->post('attri_nm');
			
			$qr_extcatg=$this->db->query("SELECT cate_attributelink FROM attribute_group WHERE attribute_group_id='$attri_id' ");
			$rw_extcatg=$qr_extcatg->row();			
		
			//------------------------------------
			
			$rw_extcatg_arr = unserialize(',', $rw_extcatg->cate_attributelink);
		
			$pccatg_list = array_search($attri_id, $rw_extcatg_arr, true);
			
			//if($pccatg_list != false)
//			{
				  unset($rw_extcatg_arr[$pccatg_list]);
			//}
			$pccatg_updatedList = serialize( $rw_extcatg_arr);
			
			$this->db->query("UPDATE attribute_group SET cate_attributelink='' WHERE attribute_group_id='$attri_id' ");
			//--------------------------------------------------
			
		}
	function remove_oneattrilink()
		{
			$cate_id=$this->input->post('cate_id');
			$attri_id=$this->input->post('attri_id');
			$attri_nm=$this->input->post('attri_nm');
			//$attri_link=$this->input->post('attri_link');
			
			$qr_extcatg=$this->db->query("SELECT * FROM attribute_group WHERE attribute_group_id='$attri_id' ");
			$rw_extcatg=$qr_extcatg->row();			
		
			//------------------------------------
			
			$rw_extcatg_arr = unserialize( $rw_extcatg->cate_attributelink);
		
			$pccatg_list = array_search($cate_id, $rw_extcatg_arr, true);
			
			//if($pccatg_list)
			//{
				 unset($rw_extcatg_arr[$pccatg_list]);
				 //$arr_attrb=$rw_extcatg_arr[0];
				  //unset($rw_extcatg_arr[$pccatg_list]);
			//}
			if(count($rw_extcatg_arr)==0){
				$arr_attrb=$rw_extcatg_arr[0];
			if($arr_attrb=='')	
			{$this->db->query("UPDATE attribute_group SET cate_attributelink='' WHERE attribute_group_id='$attri_id' ");
				return true;
			}	
			
			}
			else{
				
				$pccatg_updatedList = serialize($rw_extcatg_arr);
			
			$this->db->query("UPDATE attribute_group SET cate_attributelink='$pccatg_updatedList' WHERE attribute_group_id='$attri_id' ");
			}
			/*if(!$pccatg_list)
			{
				//unset($rw_extcatg_arr[0]);
				$this->db->query("UPDATE attribute_group SET cate_attributelink='' WHERE attribute_group_id='$attri_id' ");
			}*/
			//--------------------------------------------------
			
		}
		
		
		
		
		
		
	function addnew_codtaxcharges()
	{
		$state_id=$this->input->post('state_name');
		$dtm=date('Y-m-d H:i:s');
		
		$query = $this->db->query("SELECT * FROM state WHERE state_id='$state_id' ");
		$state_name=$query->row()->state;
		$taxrate=$this->input->post('tax_percenrage');
		
		
		$data=array(
			'state_name'=>$state_name,
			'state_id'=>$state_id,
			'taxrate'=>$taxrate,
			'dtm_modf'=>$dtm
		);
		
		$this->db->insert('cod_taxratecharges',$data);
	}
	
	
	function update_codtaxcharges()
	{
		$state_id=$this->input->post('editstate_name');
		$tax_sqlid=$this->input->post('tax_sqlid');
		$edittax_percenrage=$this->input->post('edittax_percenrage');
		$dtm=date('Y-m-d H:i:s');
		
		if($state_id!='')
		{
			$query = $this->db->query("SELECT * FROM state WHERE state_id='$state_id' ");
			$state_name=$query->row()->state;		
			
			$data=array(
				'state_name'=>$state_name,
				'state_id'=>$state_id,
				'taxrate'=>$edittax_percenrage,
				'dtm_modf'=>$dtm
			);
			
			$this->db->where('cod_taxratechrgsqlid',$tax_sqlid);
			$this->db->update('cod_taxratecharges',$data);
		
		}
		else
		{
			$data=array(
				'taxrate'=>$edittax_percenrage,
				'dtm_modf'=>$dtm
			);
			
			$this->db->where('cod_taxratechrgsqlid',$tax_sqlid);
			$this->db->update('cod_taxratecharges',$data);
				
		}
		
	}
	
	
	function delete_taxcharges()
	{
		$codwt_sqlid=$this->input->post('delete_taxcharges');
		
		$this->db->query("DELETE FROM cod_taxratecharges WHERE cod_taxratechrgsqlid='$codwt_sqlid' ");	
	}
	
	function select_codtobecharged()
	{
		return $query=$this->db->query("SELECT * FROM cod_tobecharged");
		
	}
	
	function update_codtobcherged()
	{
		$cod_tobechargedsqlid=$this->input->post('chargeto_sqlidedit');
		$cod_percentage=$this->input->post('cod_percentage');
		$dtm=date('Y-m-d H:i:s');
		$data=array(
				'Percentage_charge'=>$cod_percentage,
				'dtm_charge'=>$dtm 
			);
			
			$this->db->where('tobechargedsql_id',$cod_tobechargedsqlid);
			$this->db->update('cod_tobecharged',$data);
		
	}
	
	function select_coddiscountlist()
	{
		return $query=$this->db->query("SELECT * FROM cod_discount");	
	}
	
	function add_coddiscountpercentage()
	{	
		$dtm=date('Y-m-d H:i:s');
		$discount_from=$this->input->post('discount_from');
		$discount_to=$this->input->post('discount_to');
		$discount_perc=$this->input->post('discount_perc');
		
		$data=array(
			'discount_from'=>$discount_from,
			'discount_to'=>$discount_to,
			'discount_percentage'=>$discount_perc,
			'modf_dtm'=>$dtm
		);
		
		$this->db->insert('cod_discount',$data);
			
	}
	
	function update_coddiscountpercentage()
	{		
		$dtm=date('Y-m-d H:i:s');
		$editdiscountsqlid=$this->input->post('editdiscountsqlid');
		$discount_from=$this->input->post('editdiscount_from');
		$discount_to=$this->input->post('editdiscount_to');
		$discount_perc=$this->input->post('editdiscount_perc');
		
		$data=array(
			'discount_from'=>$discount_from,
			'discount_to'=>$discount_to,
			'discount_percentage'=>$discount_perc,
			'modf_dtm'=>$dtm
		);
		
		$this->db->where('cod_dissqlid',$editdiscountsqlid);
		$this->db->update('cod_discount',$data);
			
	}
	
	function delete_discountpercentage()
	{
		$coddiscount_sqlid=$this->input->post('coddissqlid');
		
		$this->db->query("DELETE FROM cod_discount WHERE cod_dissqlid='$coddiscount_sqlid' ");		
	}
	
	function selectall_subattributeid()
	{
		
		$attrbgroup_id=$this->input->post('attrbgroup_id');
		
		return $attrb_query=$this->db->query("SELECT * FROM attributes WHERE  attribute_group_id='$attrbgroup_id' ");	
	}
	
	function check_filterdata($catgid)
	{
		return $query_checkfilterdata=$this->db->query("SELECT * FROM product_filtersetup WHERE category_id='$catgid' ");
	}
	
	
	function get_maxid($table, $field){
		$query = $this->db->query("SELECT MAX($field) AS `maxid` FROM ".$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	
	function save_productfilterdata()
	{
			
			$catg_id=$this->input->post('subcategory_id');
			$price=$this->input->post('price');
			$discount=$this->input->post('discount');
			$seller=$this->input->post('seller');
			
			
			$query_checkfilterdata=$this->db->query("SELECT category_id FROM product_filtersetup WHERE category_id='$catg_id' ");
			if($query_checkfilterdata->num_rows()==0)
			{
			
			
					$attrb_fldid=$this->input->post('attrbfield_id');
					$max_fltrid = $this->get_maxid('product_filtersetup', 'fltr_maxid');
					
					
					$attrbgroup_id=$this->input->post('attribute_set');
					
					// query for attribute group name start
										
					$query_attrbname=$this->db->query("SELECT attribute_group_name FROM attribute_group WHERE attribute_group_id='$attrbgroup_id' ");
					$attrg_groupname=$query_attrbname->row()->attribute_group_name;
					
					// query for attribute group name end
					
					// subattribute group name start
						
						$attrb_fldidstr=implode(',',$attrb_fldid);
						
						$query_subattrbid=$this->db->query("SELECT * FROM attribute_real WHERE attribute_id IN ($attrb_fldidstr) ");
						$subattrb_id=array();
						$subattrb_name=array();
						$attrb_filedname=array();
						$attrb_realid=array();
						
						if($query_subattrbid->num_rows()>0)
						{
							$rwattrg_groupid=$query_subattrbid->result_array();
							foreach($rwattrg_groupid as $res_attrg_groupid)
							{
								array_push($subattrb_id,$res_attrg_groupid['attribute_heading_id']);
								array_push($attrb_filedname,$res_attrg_groupid['attribute_field_name']);
								array_push($attrb_realid,$res_attrg_groupid['attribute_id']);
								
								$subattrb_id=$res_attrg_groupid['attribute_heading_id'];
								$query_subattrbname=$this->db->query("SELECT attribute_heading_name FROM attributes WHERE attribute_heading_id ='$subattrb_id' ");
								
								if($query_subattrbname->num_rows()>0)
								{
									$rw_subattrbname=$query_subattrbname->row()->attribute_heading_name;							
									array_push($subattrb_name,$rw_subattrbname);
									
									
								} 
									
							}
							
						}
						
						$subattrb_idserialize=serialize($subattrb_id);
						$subattrb_nameserialize=serialize($subattrb_name);
						$attrb_filednameserialize=serialize($attrb_filedname);
						$attrb_fldidserialize=serialize($attrb_realid);
										
					//subattribute group name end
					
						//----------------------------------Data insert in product_filtersetup start------------------------------------
								
							$data=array(
							'fltr_maxid'=>$max_fltrid,
							'category_id'=>$catg_id,
							'attribut_groupid'=>$attrbgroup_id,
							'attribute_groupname'=>$attrg_groupname,
							'subattribute_groupid'=>$subattrb_idserialize,
							'subattribute_groupname'=>$subattrb_nameserialize,
							'attribute_realid'=>$attrb_fldidserialize,
							'attribute_realname'=>$attrb_filednameserialize,
							'seller'=>$seller,
							'price'=>$price,
							'discount'=>$discount
								
							);
							
							$this->db->insert('product_filtersetup',$data);
							$this->cachedlt_product_filtersetup($catg_id);
						//----------------------------------Data insert in product_filtersetup end--------------------------------------
			} 
			else
			{
				$attrb_fldid=$this->input->post('attrbfield_id');
					//$max_fltrid = $this->get_maxid('product_filtersetup', 'fltr_maxid');
					
					
					$attrbgroup_id=$this->input->post('attribute_set');
					
					// query for attribute group name start
										
					$query_attrbname=$this->db->query("SELECT attribute_group_name FROM attribute_group WHERE attribute_group_id='$attrbgroup_id' ");
					$attrg_groupname=$query_attrbname->row()->attribute_group_name;
					
					// query for attribute group name end
					
					// subattribute group name start
						
						$attrb_fldidstr=implode(',',$attrb_fldid);
						
						$query_subattrbid=$this->db->query("SELECT * FROM attribute_real WHERE attribute_id IN ($attrb_fldidstr) ");
						$subattrb_id=array();
						$subattrb_name=array();
						$attrb_filedname=array();
						$attrb_realid=array();
						
						if($query_subattrbid->num_rows()>0)
						{
							$rwattrg_groupid=$query_subattrbid->result_array();
							foreach($rwattrg_groupid as $res_attrg_groupid)
							{
								array_push($subattrb_id,$res_attrg_groupid['attribute_heading_id']);
								array_push($attrb_filedname,$res_attrg_groupid['attribute_field_name']);
								array_push($attrb_realid,$res_attrg_groupid['attribute_id']);
								
								$subattrb_id=$res_attrg_groupid['attribute_heading_id'];
								$query_subattrbname=$this->db->query("SELECT attribute_heading_name FROM attributes WHERE attribute_heading_id ='$subattrb_id' ");
								
								if($query_subattrbname->num_rows()>0)
								{
									$rw_subattrbname=$query_subattrbname->row()->attribute_heading_name;							
									array_push($subattrb_name,$rw_subattrbname);
									
									
								} 
									
							}
							
						}
						
						$subattrb_idserialize=serialize($subattrb_id);
						$subattrb_nameserialize=serialize($subattrb_name);
						$attrb_filednameserialize=serialize($attrb_filedname);
						$attrb_fldidserialize=serialize($attrb_realid);
										
					//subattribute group name end
					
						//----------------------------------Data insert in product_filtersetup start------------------------------------
								
							$data=array(
							//'fltr_maxid'=>$max_fltrid,
							'category_id'=>$catg_id,
							'attribut_groupid'=>$attrbgroup_id,
							'attribute_groupname'=>$attrg_groupname,
							'subattribute_groupid'=>$subattrb_idserialize,
							'subattribute_groupname'=>$subattrb_nameserialize,
							'attribute_realid'=>$attrb_fldidserialize,
							'attribute_realname'=>$attrb_filednameserialize,
							'seller'=>$seller,
							'price'=>$price,
							'discount'=>$discount	
							);
							
							
							
							$this->db->where('category_id',$catg_id);
							$this->db->update('product_filtersetup',$data);
							$this->cachedlt_product_filtersetup($catg_id);
						//----------------------------------Data insert in product_filtersetup end--------------------------------------
			}
			// main if condition  end
		}
		
		
		function cachedlt_product_filtersetup($catg_id)
		{
			$query=$this->db->query("select url_displayname from category_menu_desktop where category_id in ($catg_id)");
			//$cnt=$query->num_rows();
			if($query->num_rows()>0)
			{
				foreach($query->result_array() as $res)  
				{
					$folder_name1=$res['url_displayname'];
					$folder_name2='index';
					$this->db->cache_delete($folder_name1, $folder_name2);
				}
			}
			
			
			$query=$this->db->query("select url_displayname from category_menu_mobile where category_id in ($catg_id)");
			//$cnt=$query->num_rows();
			if($query->num_rows()>0)
			{
				foreach($query->result_array() as $res)  
				{
					$folder_name1=$res['url_displayname'];
					$folder_name2='index';
					$this->db->cache_delete($folder_name1, $folder_name2);
				}
			}
			
			
			
			
		}
		
}
?>