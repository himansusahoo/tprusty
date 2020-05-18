<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Product_descrp_model extends CI_Model

{

	function view_product_descrp()

	{

		$qr=$this->db->query("select * from pages where page_name='single_product' ");

		$row=$qr->row();

		return $row;	

	}

	

	function retrieve_category_meta_info(){

		$cat_id = $this->uri->segment(4);

		$query = $this->db->query("SELECT page_title,meta_keywords,meta_description FROM category_master WHERE category_id='$cat_id' ");

		$row = $query->row();

		return $row;

	}

	

	function modf_retrieve_category_meta_info($cat_id){

		//$cat_id = $this->uri->segment(4);

		$query = $this->db->query("SELECT page_title,meta_keywords,meta_description FROM category_master WHERE category_id='$cat_id' ");

		$row = $query->row();

		return $row;

	}

	

	function select_brand_name($catg_id)

	{	

		

		$qr1=$this->db->query("select * from category_indexing where parent_id='$catg_id' ");				

		return $qr1;		

	}

	function catg_brand_name($label_id)

	{

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' AND category_id!='' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		

		$qr1=$this->db->query("select * from category_menu_desktop where category_id IN ($catg_id) AND dskmenu_lbl_id!='$label_id' AND parent_id='$label_id'  AND order_by!=0 AND is_active='Yes' order by order_by ");				

		return $qr1;	

	}

	function catg_brand_name_mobile($label_id)

	{

			$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_mobile WHERE parent_id='$label_id' AND category_id!='' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		

		$qr1=$this->db->query("select * from category_menu_mobile where category_id IN ($catg_id) AND dskmenu_lbl_id!='$label_id' AND parent_id='$label_id' AND order_by!=0 AND is_active='Yes' order by order_by ");				

		return $qr1;	

	}

	

	function select_product_image($label_id)

	{

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		//$qr2=$this->db->query("select imag ,lvl2 as category_id,lvl2_name as category_name from cornjob_productsearch  WHERE lvl1 =$catg_id AND product_id!=0 group by lvl2  ");

	

	$qr2=$this->db->query("select imag ,lvl2 as category_id,lvl2_name as category_name from cornjob_productsearch  WHERE lvl2 IN ($catg_id) AND product_id!=0 group by lvl2  ");

		

		return $qr2;	

			

	}

	

	/*function retrieve_parent_cat_id($catg_id){

		$query = $this->db->query("SELECT * FROM category_indexing WHERE category_id='$catg_id'");

		$result = $query->result();

		return $result[0]->parent_id;

	}*/

	

	function retrieve_category_to_attribute($catg_id){

		$query = $this->db->query("SELECT category_name

FROM category_indexing

WHERE category_id = ( 

SELECT parent_id

FROM category_indexing

WHERE category_id = '$catg_id')");

		$result = $query->result();

		@$category_name = addslashes($result[0]->category_name);

		//echo $category_name;exit;

		

		$query1 = $this->db->query("SELECT attribute_group_id FROM attribute_group WHERE attribute_group_name='$category_name'");

		$rows1 = $query1->num_rows();

		if($rows1 > 0){

			$result1 = $query1->result();

			$attr_group_id = $result1[0]->attribute_group_id;

			return $attr_group_id;

		}else{

			return 0;

		}

	}

	

	

	function retrieve_attribute_brand_name($catg_id){

		$query = $this->db->query("SELECT a.product_id, a.attribut_set

FROM product_setting a

INNER JOIN product_category b ON a.product_id = b.product_id

WHERE b.category_id ='$catg_id'");

		$result = $query->result();

		@$attr_group_id = $result[0]->attribut_set;

		

		//program for getting attribute id and attribute value//

		//program start for master table attribute brand//

		$mstr_attr_qr = $this->db->query("SELECT DISTINCT a.attr_id, a.attr_value

FROM product_attribute_value a

INNER JOIN attribute_real b ON a.attr_id = b.attribute_id

WHERE b.attribute_group_id ='$attr_group_id'

AND b.attribute_field_name =  'Brand'

AND a.attr_value IS NOT NULL AND (a.attr_value <> '')");

	if($mstr_attr_qr->num_rows() > 0){

		foreach($mstr_attr_qr->result() as $val){

			$mstr_attr_val[] = $val->attr_value;

		}		

	}else{

		$mstr_attr_val = array();

	}

	//program end of master table attribute brand//

	//program start for seller table attribute brand//

	$slr_attr_qr = $this->db->query("SELECT DISTINCT a.attr_id, a.attr_value

FROM seller_product_attribute_value a

INNER JOIN attribute_real b ON a.attr_id = b.attribute_id

WHERE b.attribute_group_id ='$attr_group_id'

AND b.attribute_field_name =  'Brand'

AND a.attr_value IS NOT NULL AND (a.attr_value <> '')");

	if($slr_attr_qr->num_rows() > 0){

		foreach($slr_attr_qr->result() as $val1){

			$slr_attr_val[] = $val1->attr_value;

		}

	}else{

		$slr_attr_val = array();

	}

	//program end of seller table attribute brand//

	$total_attr_value = array_unique(array_merge($mstr_attr_val,$slr_attr_val));

	return $total_attr_value;

	}

	

	

	function retrieve_filter_fld_data($catg_id,$last_segmt){

		$condition = " WHERE lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		/* if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		} */

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND current_price BETWEEN $min_price AND $max_price";

		}

		/* if($brand != ''){

			$condition .=" AND brand='$brand'";

		} */

		

		$query = $this->db->query("SELECT brand,color,size,sub_size,type,occasion FROM cornjob_productsearch $condition AND product_id<>0");

		

		if($query->num_rows() > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	

	function category_catalog_filter_fld_data($label_id,$last_segmt){		

		

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' AND  category_id!='' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		

		$condition = " WHERE lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		/* if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		} */

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND current_price BETWEEN $min_price AND $max_price";

		}

		/* if($brand != ''){

			$condition .=" AND brand='$brand'";

		} */

		

		$query = $this->db->query("SELECT brand,color,size,sub_size,type,occasion FROM cornjob_productsearch $condition AND product_id<>0");

		

		if($query->num_rows() > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	

	

	function select_product_data_list($catg_id,$last_segmt)

	{

		

		$limit = 12;

		$condition = " WHERE a.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		//price sorting array end

		

		/*if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		}

		if(array_key_exists('color',$arr)){

			$color = $arr['color'];

		}else{

			$color = '';

		}

		if(array_key_exists('size',$arr)){

			$size = $arr['size'];

		}else{

			$size = '';

		}

		if(array_key_exists('subsize',$arr)){

			$subsize = $arr['subsize'];

		}else{

			$subsize = '';

		}

		if(array_key_exists('type',$arr)){

			$type = $arr['type'];

		}else{

			$type = '';

		}

		if(array_key_exists('ocsn',$arr)){

			$ocsn = $arr['ocsn'];

		}else{

			$ocsn = '';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND a.current_price BETWEEN $min_price AND $max_price";

		}		

		if($brand != ''){

			$condition .=" AND a.brand='$brand'";

		}

		if($color != ''){

			$condition .=" AND a.color='$color'";

		}

		if($size != ''){

			$condition .=" AND a.size='$size'";

		}

		if($subsize != ''){

			$condition .=" AND a.sub_size='$subsize'";

		}

		if($type != ''){

			$condition .=" AND a.type='$type'";

		}

		if($ocsn != ''){

			$condition .=" AND a.occasion='$ocsn'";

		}	

		*/

		

		//$query = $this->db->query("SELECT a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku FROM cornjob_productsearch a INNER JOIN product_master b ON a.product_id=b.product_id INNER JOIN seller_account g ON g.seller_id=b.seller_id $condition AND b.approve_status='Active' AND b.seller_id!=0 AND b.status='Enabled' AND g.status='Active' group by b.product_id order by rand() LIMIT $limit");

		

		if(@$price_sortby)

		{ 

				$query=$this->db->query("select distinct a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.sku,a.product_id order by a.current_price $orderpricceby LIMIT $limit");

		}else{

		$query=$this->db->query("select distinct a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.sku,a.product_id order by rand() DESC LIMIT $limit");

		}

		return $query;

	}

	

	function select_category_product_data_list($label_id,$last_segmt)

	{

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' AND  category_id!=''  ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		

		

		$limit = 12;

		$condition = " WHERE a.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		//price sorting array end

		

		if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		}

		if(array_key_exists('color',$arr)){

			$color = $arr['color'];

		}else{

			$color = '';

		}

		if(array_key_exists('size',$arr)){

			$size = $arr['size'];

		}else{

			$size = '';

		}

		if(array_key_exists('subsize',$arr)){

			$subsize = $arr['subsize'];

		}else{

			$subsize = '';

		}

		if(array_key_exists('type',$arr)){

			$type = $arr['type'];

		}else{

			$type = '';

		}

		if(array_key_exists('ocsn',$arr)){

			$ocsn = $arr['ocsn'];

		}else{

			$ocsn = '';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND a.current_price BETWEEN $min_price AND $max_price";

		}

		if($brand != ''){

			$condition .=" AND a.brand='$brand'";

		}

		if($color != ''){

			$condition .=" AND a.color='$color'";

		}

		if($size != ''){

			$condition .=" AND a.size='$size'";

		}

		if($subsize != ''){

			$condition .=" AND a.sub_size='$subsize'";

		}

		if($type != ''){

			$condition .=" AND a.type='$type'";

		}

		if($ocsn != ''){

			$condition .=" AND a.occasion='$ocsn'";

		}	

		

		if(@$price_sortby)

		{ 

		

		$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by a.current_price $orderpricceby  LIMIT $limit");

		}

		else

		{

			$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by rand() DESC LIMIT $limit");

			

		}

		return $query;

	}

	

	

	function select_more_product_data_list(){

		$limit = 12;

		$catg_id = $this->input->get('cat_id');

		

		$catg_id=str_replace('-',',',$catg_id);

		

		$tart = $this->input->get('from');

		$last_segmt = $this->input->get('lastseg');

		//echo $last_segmt;exit;

		//$condition = " WHERE a.lvl2='$catg_id'";

		$condition = " WHERE a.lvl2 IN ($catg_id) ";

		

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		//price sorting array end

		if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		}

		if(array_key_exists('color',$arr)){

			$color = $arr['color'];

		}else{

			$color = '';

		}

		if(array_key_exists('size',$arr)){

			$size = $arr['size'];

		}else{

			$size = '';

		}

		if(array_key_exists('subsize',$arr)){

			$subsize = $arr['subsize'];

		}else{

			$subsize = '';

		}

		if(array_key_exists('type',$arr)){

			$type = $arr['type'];

		}else{

			$type = '';

		}

		if(array_key_exists('ocsn',$arr)){

			$ocsn = $arr['ocsn'];

		}else{

			$ocsn = '';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND a.current_price BETWEEN $min_price AND $max_price";

		}

		if($brand != ''){

			$condition .=" AND a.brand='$brand'";

		}

		if($color != ''){

			$condition .=" AND a.color='$color'";

		}

		if($size != ''){

			$condition .=" AND a.size='$size'";

		}

		if($subsize != ''){

			$condition .=" AND a.subsize='$subsize'";

		}

		if($type != ''){

			$condition .=" AND a.type='$type'";

		}

		if($ocsn != ''){

			$condition .=" AND a.occasion='$ocsn'";

		}

		

		//$query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,b.short_desc,c.imag,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from cornjob_productsearch a inner join product_general_info b on a.product_id=b.product_id inner join product_image c on a.product_id=c.product_id inner join product_master d on a.product_id=d.product_id inner join seller_account g on g.seller_id=d.seller_id $condition AND d.approve_status='Active' AND d.status='Enabled' AND g.status='Active' group by d.product_id LIMIT $tart, $limit");

//		

		

		//$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a inner join seller_account g on g.seller_id=a.seller_id $condition AND a.prod_status='Active' AND a.status='Enabled' AND g.status='Active' group by a.product_id LIMIT $tart, $limit");

		if(@$price_sortby)

		{ 

			$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by a.current_price $orderpricceby LIMIT $tart, $limit");

			

		}else

		{

		$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by rand() DESC LIMIT $tart, $limit");

		}

		return $query;

	}

	

	

	function select_more_categoryproduct_data_list(){

		$limit = 12;

		$catg_id = $this->input->get('cat_id');

		

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$catg_id' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		

		$tart = $this->input->get('from');

		$last_segmt = $this->input->get('lastseg');

		//echo $last_segmt;exit;

		$condition = " WHERE a.lvl2 IN ($catg_id) ";

		

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		//price sorting array end

		

		if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		}

		if(array_key_exists('color',$arr)){

			$color = $arr['color'];

		}else{

			$color = '';

		}

		if(array_key_exists('size',$arr)){

			$size = $arr['size'];

		}else{

			$size = '';

		}

		if(array_key_exists('subsize',$arr)){

			$subsize = $arr['subsize'];

		}else{

			$subsize = '';

		}

		if(array_key_exists('type',$arr)){

			$type = $arr['type'];

		}else{

			$type = '';

		}

		if(array_key_exists('ocsn',$arr)){

			$ocsn = $arr['ocsn'];

		}else{

			$ocsn = '';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND a.current_price BETWEEN $min_price AND $max_price";

		}

		if($brand != ''){

			$condition .=" AND a.brand='$brand'";

		}

		if($color != ''){

			$condition .=" AND a.color='$color'";

		}

		if($size != ''){

			$condition .=" AND a.size='$size'";

		}

		if($subsize != ''){

			$condition .=" AND a.subsize='$subsize'";

		}

		if($type != ''){

			$condition .=" AND a.type='$type'";

		}

		if($ocsn != ''){

			$condition .=" AND a.occasion='$ocsn'";

		}

		

		//$query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,b.short_desc,c.imag,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from cornjob_productsearch a inner join product_general_info b on a.product_id=b.product_id inner join product_image c on a.product_id=c.product_id inner join product_master d on a.product_id=d.product_id inner join seller_account g on g.seller_id=d.seller_id $condition AND d.approve_status='Active' AND d.status='Enabled' AND g.status='Active' group by d.product_id LIMIT $tart, $limit");

//		

		

		//$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a inner join seller_account g on g.seller_id=a.seller_id $condition AND a.prod_status='Active' AND a.status='Enabled' AND g.status='Active' group by a.product_id LIMIT $tart, $limit");

		if(@$price_sortby)

		{

			$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by a.current_price $orderpricceby  LIMIT $tart, $limit");

		}

		else

		{

		$query=$this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by rand() DESC LIMIT $tart, $limit");

		}

		return $query;

	}

	

	

	function select_product_data_count($catg_id,$last_segmt)

	{

		$condition = " WHERE a.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		//price sorting array end

		if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		}

		if(array_key_exists('color',$arr)){

			$color = $arr['color'];

		}else{

			$color = '';

		}

		if(array_key_exists('size',$arr)){

			$size = $arr['size'];

		}else{

			$size = '';

		}

		if(array_key_exists('subsize',$arr)){

			$subsize = $arr['subsize'];

		}else{

			$subsize = '';

		}

		if(array_key_exists('type',$arr)){

			$type = $arr['type'];

		}else{

			$type = '';

		}

		if(array_key_exists('ocsn',$arr)){

			$ocsn = $arr['ocsn'];

		}else{

			$ocsn = '';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND a.current_price BETWEEN $min_price AND $max_price";

		}

		if($brand != ''){

			$condition .=" AND a.brand='$brand'";

		}

		if($color != ''){

			$condition .=" AND a.color='$color'";

		}

		if($size != ''){

			$condition .=" AND a.size='$size'";

		}

		if($subsize != ''){

			$condition .=" AND a.sub_size='$subsize'";

		}

		if($type != ''){

			$condition .=" AND a.type='$type'";

		}

		if($ocsn != ''){

			$condition .=" AND a.occasion='$ocsn'";

		}

		

		//$query = $this->db->query("SELECT a.product_id FROM cornjob_productsearch a INNER JOIN product_master b ON a.product_id=b.product_id INNER JOIN seller_account g ON g.seller_id=b.seller_id $condition AND b.approve_status='Active' AND b.seller_id!=0 AND b.status='Enabled' AND g.status='Active' group by b.product_id");

		

		if(@$price_sortby)

		{ 		

		

		$query=$this->db->query("select  a.product_id from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by a.current_price $orderpricceby ");

		

		}else

		{

		$query=$this->db->query("select  a.product_id from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id ");

		

		}

		return $query->num_rows();

		

	}

	

	function select_category_product_data_count($label_id,$last_segmt)

	{

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' AND category_id!='' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		

		$catg_id=implode(',',$arry_catgid);	

		

		

		$condition = " WHERE a.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

			//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		//price sorting array end

		

		if(array_key_exists('brand',$arr)){

			$brand = $arr['brand'];

		}else{

			$brand = '';

		}

		if(array_key_exists('color',$arr)){

			$color = $arr['color'];

		}else{

			$color = '';

		}

		if(array_key_exists('size',$arr)){

			$size = $arr['size'];

		}else{

			$size = '';

		}

		if(array_key_exists('subsize',$arr)){

			$subsize = $arr['subsize'];

		}else{

			$subsize = '';

		}

		if(array_key_exists('type',$arr)){

			$type = $arr['type'];

		}else{

			$type = '';

		}

		if(array_key_exists('ocsn',$arr)){

			$ocsn = $arr['ocsn'];

		}else{

			$ocsn = '';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND a.current_price BETWEEN $min_price AND $max_price";

		}

		if($brand != ''){

			$condition .=" AND a.brand='$brand'";

		}

		if($color != ''){

			$condition .=" AND a.color='$color'";

		}

		if($size != ''){

			$condition .=" AND a.size='$size'";

		}

		if($subsize != ''){

			$condition .=" AND a.sub_size='$subsize'";

		}

		if($type != ''){

			$condition .=" AND a.type='$type'";

		}

		if($ocsn != ''){

			$condition .=" AND a.occasion='$ocsn'";

		}

		

		//$query = $this->db->query("SELECT a.product_id FROM cornjob_productsearch a INNER JOIN product_master b ON a.product_id=b.product_id INNER JOIN seller_account g ON g.seller_id=b.seller_id $condition AND b.approve_status='Active' AND b.seller_id!=0 AND b.status='Enabled' AND g.status='Active' group by b.product_id");

		if(@$price_sortby)

		{

			 $query=$this->db->query("select  a.product_id from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by a.current_price $orderpricceby ");

		}

		else

		{

		

		$query=$this->db->query("select  a.product_id from cornjob_productsearch a  $condition AND a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by a.product_id DESC ");

		}

		return $query->num_rows();

	}

	

	

	function filter_category_brand_data($cat_id,$brand){

		$query_prod=$this->db->query("select a.product_id from product_category a INNER JOIN product_attribute_value h ON a.product_id=h.product_id WHERE a.category_id='$cat_id' AND h.attr_value='$brand'");

		$orw_prod=$query_prod->result();

		$prodid_arr=array();

		

		foreach($orw_prod as $res_prodid)

		{array_push($prodid_arr,$res_prodid->product_id);}

		

		$prod_str=implode(',',$prodid_arr);

		

		

		$query = $this->db->query("select a.imag,a.catelog_img_url,a.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_general_info c on c.product_id=a.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id  where a.product_id IN ('$prod_str')  AND d.approve_status='Active' AND d.status='Enabled' AND d.seller_id!=0 AND g.status='Active' 

		UNION ALL 

		select a.imag,a.catelog_img_url,a.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a  inner join product_general_info c on c.product_id=a.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id where a.product_id IN ('$prod_str')  AND x.master_product_id IN ('$prod_str') AND d.approve_status='Active' AND d.status='Enabled' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand'

		");

		return $query;

	}

	

	function filter_category_brand_color_data($cat_id,$brand,$color_name){

		//query for getting brand products

		$brand_query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN product_attribute_value h ON d.product_id=h.product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand'

		UNION ALL 

		select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand'

		");

		

		//query for getting color products

		$color_query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN product_attribute_value h ON d.product_id=h.product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$color_name'

		UNION ALL 

		select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$color_name'

		");

		

		$brand_result = $brand_query->result();

		foreach($brand_result as $brand_row){

			$brand_sku[] = "'".$brand_row->sku."'";

		}

		

		$color_result = $color_query->result();

		foreach($color_result as $color_row){

			$color_sku[] = "'".$color_row->sku."'";

		}

		

		@$common_sku = implode(',',array_intersect($brand_sku,$color_sku));

		if(!empty($common_sku)){

			$query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id WHERE d.sku IN ($common_sku) AND d.status='Enabled'");

			return $query;

		}else{

			return false;

		}

	}

	

	

	function filter_category_price_color_data($cat_id,$price_slab,$color_name){

		$price_arr = explode('-',$price_slab);

		$min_price = $price_arr[0];

		$max_price = $price_arr[1];

		//query for getting price sku

		$price_query = $this->db->query("SELECT a.*,b.mrp,b.price,b.special_price,c.catelog_img_url FROM view_ative_product_final_price a INNER JOIN product_master b ON a.product_id=b.product_id INNER JOIN product_image c ON a.product_id=c.product_id WHERE a.category_id='$cat_id' AND a.final_price>='$min_price' AND a.final_price<='$max_price'");

		

		//query for getting color sku

		$color_query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN product_attribute_value h ON d.product_id=h.product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$color_name'

		UNION ALL 

		select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$color_name'

		");

		

		foreach($price_query->result() as $price_row){

			$price_sku[] = "'".$price_row->sku."'";

		}

		

		foreach($color_query->result() as $color_row){

			$color_sku[] = "'".$color_row->sku."'";

		}

		

		$common_sku = implode(',',array_intersect($price_sku,$color_sku));

		if(!empty($common_sku)){

			$query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id WHERE d.sku IN ($common_sku) AND d.status='Enabled'");

			return $query;

		}else{

			return false;

		}

	}

	

	function filter_third_multi_data($cat_id){

		$brand_price_arr = explode('&',$this->uri->segment(5));

		$first_indx = $brand_price_arr[0];		

		if($first_indx == 'brnd'){

			$str = substr($this->uri->segment(6), 4);

			$price_arr = explode('-',$str);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$brand = $brand_price_arr[1];

			

			$query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN product_attribute_value h ON d.product_id=h.product_id INNER JOIN view_ative_product_final_price j ON d.product_id=j.product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.status='Enabled' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand' AND j.final_price>='$min_price' AND j.final_price<='$max_price'

			UNION ALL 

			select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id INNER JOIN view_ative_product_final_price j ON d.product_id=j.product_id  where b.category_id='$cat_id' AND d.approve_status='Active' AND d.status='Enabled' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand' AND j.final_price>='$min_price' AND j.final_price<='$max_price'

			");

			return $query;

		}

		else if($first_indx == 'prce'){

			$brand = substr($this->uri->segment(6), 4);

			$price_arr = explode('-',$brand_price_arr[1]);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			

			$query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN product_attribute_value h ON d.product_id=h.product_id INNER JOIN view_ative_product_final_price j ON d.product_id=j.product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.status='Enabled' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand' AND j.final_price>='$min_price' AND j.final_price<='$max_price'

			UNION ALL 

			select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id INNER JOIN view_ative_product_final_price j ON d.product_id=j.product_id  where b.category_id='$cat_id' AND d.approve_status='Active' AND d.status='Enabled' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand' AND j.final_price>='$min_price' AND j.final_price<='$max_price'

			");

			return $query;

		}

	}

	

	function filtered_multi_data($cat_id){

		$param1 = $this->uri->segment(5);

		$param2 = $this->uri->segment(6);

		$param3 = $this->uri->segment(7);

		

		$param1_str = substr($param1,0,4);

		if($param1_str == 'brnd'){

			$brand = substr($param1,5);

			$price_arr = explode('-',substr($param2,4));

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$color_name = substr($param3,4);

		}

		if($param1_str == 'prce'){

			$brand = substr($param2,4);

			$price_arr = explode('-',substr($param1,5));

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$color_name = substr($param3,4);

		}

		

		//query for getting brand products

		$brand_query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN product_attribute_value h ON d.product_id=h.product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand'

		UNION ALL 

		select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$brand'

		");

		

		//query for getting color products

		$color_query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN product_attribute_value h ON d.product_id=h.product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$color_name'

		UNION ALL 

		select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join seller_account g on g.seller_id=d.seller_id INNER JOIN seller_product_setting x ON d.product_id=x.master_product_id INNER JOIN seller_product_attribute_value h ON x.seller_product_id=h.seller_product_id where b.category_id='$cat_id' AND d.approve_status='Active' AND d.seller_id!=0 AND g.status='Active' AND h.attr_value='$color_name'

		");

		

		//query for getting price products

		$price_query = $this->db->query("SELECT a.*,b.mrp,b.price,b.special_price,c.catelog_img_url FROM view_ative_product_final_price a INNER JOIN product_master b ON a.product_id=b.product_id INNER JOIN product_image c ON a.product_id=c.product_id WHERE a.category_id='$cat_id' AND a.final_price>='$min_price' AND a.final_price<='$max_price'");

		

		$brand_result = $brand_query->result();

		foreach($brand_result as $brand_row){

			$brand_sku[] = "'".$brand_row->sku."'";

		}

		

		$color_result = $color_query->result();

		foreach($color_result as $color_row){

			$color_sku[] = "'".$color_row->sku."'";

		}

		

		foreach($price_query->result() as $price_row){

			$price_sku[] = "'".$price_row->sku."'";

		}

		

		$first_common_sku = array_intersect($brand_sku,$price_sku);

		$common_sku = implode(',',array_intersect($first_common_sku,$color_sku));

		

		if(!empty($common_sku)){

			$query = $this->db->query("select a.imag,a.catelog_img_url,b.product_id,c.name,c.description,c.short_desc,d.mrp,d.price,d.special_price,d.quantity,d.special_pric_from_dt,d.seller_id,d.special_pric_to_dt,d.sku from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id WHERE d.sku IN ($common_sku) AND d.status='Enabled'");

			return $query;

		}else{

			return false;

		}

		

	}

	

	function select_product_list($name)

	{

		

		/*$qr2=$this->db->query("select a.imag,b.product_id,c.name,c.description,d.price,d.special_price,d.special_pric_from_dt,d.special_pric_to_dt,d.quantity,d.sku,f.tax_rate_percentage from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join tax_management f on d.tax_class=f.tax_id inner join seller_account g on g.seller_id=d.seller_id where c.name LIKE '%$name%' AND e.status='Active' AND g.status='Active'  ");*/

	$qr2=$this->db->query("select a.imag,b.product_id,c.name,c.description,d.seller_id,d.mrp,d.price,d.special_price,d.special_pric_from_dt,d.special_pric_to_dt,d.quantity,d.sku,f.tax_rate_percentage from product_image a inner join product_category b on a.product_id=b.product_id inner join category_indexing h on b.category_id=h.category_id inner join category_indexing i on h.parent_id=i.category_id inner join category_indexing j on i.parent_id=j.category_id  inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join tax_management f on d.tax_class=f.tax_id inner join seller_account g on g.seller_id=d.seller_id where (c.name LIKE '%$name%' or j.category_name LIKE '%$name%' or i.category_name LIKE '%$name%' or h.category_name LIKE '%$name%') AND d.approve_status='Active' AND d.status='Enabled' AND d.seller_id!=0 AND g.status='Active'");

		return $qr2;	

	}
	
	
	function select_product_searchfirstcount($search_title)
	{
		if (preg_match('/[\'^ \" ]/', $search_title))
		{
			/*$search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));
			$search_title=substr($search_title1,0,strpos($search_title1,' '));
			*/
			$search_title=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));
		}
		$prodctnamefind='';
		//$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.name LIKE  '%$search_title%' or a.lvl2_name LIKE '%$search_title%' OR a.lvl1_name LIKE '%$search_title%' OR a.lvlmain_name LIKE '%$search_title%') group by a.product_id order by a.product_id DESC LIMIT 12");		

		if(preg_match('/valentine/',$search_title))
		{
			$qr2=$this->db->query("select a.sku from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.sku IN (SELECT sku FROM seller_product_attribute_value WHERE attr_value='valentine') OR a.name like '%valentine%')  group by a.sku order by a.product_id DESC LIMIT 1");	

		}
		else
		{
		//level 3 category product access
		$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='2'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='2'  "); 
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}
					
				 }			
			}
				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
		
		if($ctgid!='')
			{$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a
			 INNER JOIN category_indexing b ON b.category_id=a.lvl2
			 WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND b.parent_id='$ctgid' AND a.name LIKE '%$prodctnamefind%'  group by a.sku order by a.product_id DESC LIMIT 1");
		    }	

		}		
		
		if($qr_ctag->num_rows()==0)
		{	//level 2 category product access
		
			$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='3'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='3'  ");
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}					
				 }			
			}				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
	
		if($ctgid!='')
			{
			$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND a.lvl2='$ctgid' AND a.name LIKE '%$prodctnamefind%' group by a.sku order by a.product_id DESC LIMIT 1");
		   }
		}	
		
		
		if($qr_ctag->num_rows()==0)
		{
			//Product Name access
			$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND LOWER(a.name) LIKE '%$search_title%'  group by a.sku order by a.product_id DESC LIMIT 1");			
		}
		
		if($qr2->num_rows()==0)
		{		 		

		$qr2=$this->db->query("select a.sku,a.product_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND 

		(soundex(a.name)=soundex('$search_title')

                or soundex_match('$search_title','a.name','')

                or soundex(a.name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl2_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl2_name','')

                or soundex(a.lvl2_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl1_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl1_name','')

                or soundex(a.lvl1_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvlmain_name)=soundex('$search_title')

                or soundex_match('$search_title','lvlmain_name','')

                or soundex(lvlmain_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')	

		) group by a.sku order by a.product_id DESC LIMIT 1");

		

		}
		return $qr2;		

	}


	

	

	function select_product_search($search_title)
	{
		if (preg_match('/[\'^ \" ]/', $search_title))
		{
			/*$search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));
			$search_title=substr($search_title1,0,strpos($search_title1,' '));
			*/
			
			$search_title=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));
		}

		$prodctnamefind='';
		//$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.name LIKE  '%$search_title%' or a.lvl2_name LIKE '%$search_title%' OR a.lvl1_name LIKE '%$search_title%' OR a.lvlmain_name LIKE '%$search_title%') group by a.product_id order by a.product_id DESC LIMIT 12");		

		if(preg_match('/valentine/',$search_title))
		{
			$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.sku IN (SELECT sku FROM seller_product_attribute_value WHERE attr_value='valentine') OR a.name like '%valentine%')  group by a.sku order by a.product_id DESC LIMIT 50");	

		}
		else
		{
		//level 3 category product access
		$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='2'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='2'  "); 
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}
					
				 }			
			}
				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
		
		if($ctgid!='')
			{$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id   from cornjob_productsearch a
			 INNER JOIN category_indexing b ON b.category_id=a.lvl2
			 WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND b.parent_id='$ctgid' AND a.name LIKE '%$prodctnamefind%'  group by a.sku order by a.product_id DESC LIMIT 50");
		    }	

		}		
		
		if($qr_ctag->num_rows()==0)
		{	//level 2 category product access
		
			$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='3'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='3'  ");
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}					
				 }			
			}				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
	
		if($ctgid!='')
			{
			$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id   from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND a.lvl2='$ctgid' AND a.name LIKE '%$prodctnamefind%' group by a.sku order by a.product_id DESC LIMIT 50");
		   }
		}	
		
		
		if($qr_ctag->num_rows()==0)
		{
			//Product Name access
			$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id   from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND LOWER(a.name) LIKE '%$search_title%'  group by a.sku order by a.product_id DESC LIMIT 50");			
		}
		
		if($qr2->num_rows()==0)
		{		 		

		$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND 

		(soundex(a.name)=soundex('$search_title')

                or soundex_match('$search_title','a.name','')

                or soundex(a.name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl2_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl2_name','')

                or soundex(a.lvl2_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl1_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl1_name','')

                or soundex(a.lvl1_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvlmain_name)=soundex('$search_title')

                or soundex_match('$search_title','lvlmain_name','')

                or soundex(lvlmain_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')	

		) group by a.sku order by a.product_id DESC LIMIT 50");

		

		}
		return $qr2;

		

	}

	function select_firstproductajax_search($search_title)
	{
		if (preg_match('/[\'^ \" ]/', $search_title))
		{
			/*$search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));
			 $search_title=substr($search_title1,0,strpos($search_title1,' '));*/
			 
			$search_title=trim(preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title))));
		}

		
		$prodctnamefind='';
		
		//$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.name LIKE  '%$search_title%' or a.lvl2_name LIKE '%$search_title%' OR a.lvl1_name LIKE '%$search_title%' OR a.lvlmain_name LIKE '%$search_title%') group by a.product_id order by a.product_id DESC LIMIT 12");
		
		
			//Product Name access
			
				
			
			/*$qr2=$this->db->query("select a.sku,a.lvl2,a.brand  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND LOWER(a.name) LIKE '%$search_title%'					
			group by a.sku order by a.product_id DESC LIMIT 1
			
			");
			
			$brand_srch=$qr2->row()->brand;
			$lvl2_search=$qr2->row()->lvl2;
			$sku_srchfirst=$qr2->row()->sku;
			
			$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND a.sku='$sku_srchfirst'	 OR (a.lvl2=$lvl2_search AND a.brand='$brand_srch' )				
			group by a.sku order by a.product_id DESC LIMIT 50
			
			");
			
			if($qr2->num_rows()>0)
			{return $qr2;}		*/	
		
				

		if(preg_match('/valentine/',$search_title))
		{
			$qr2=$this->db->query("select a.sku,a.product_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.sku IN (SELECT sku FROM seller_product_attribute_value WHERE attr_value='valentine') OR a.name like '%valentine%')  group by a.sku order by a.product_id DESC LIMIT 50");	

		}
		else
		{
		
		/*$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.name LIKE  '%$search_title%' or a.lvl2_name LIKE '%$search_title%' OR a.lvl1_name LIKE '%$search_title%' OR a.lvlmain_name LIKE '%$search_title%') group by a.sku order by a.product_id DESC LIMIT 50");*/
		
		//level 3 category product access
		$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='2'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='2'  "); 
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}
					
				 }			
			}
				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
		
		if($ctgid!='')
			{$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a
			 INNER JOIN category_indexing b ON b.category_id=a.lvl2
			 WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND b.parent_id='$ctgid' AND a.name LIKE '%$prodctnamefind%'  group by a.sku order by a.product_id DESC LIMIT 50");
		    }	

		}		
		
		if($qr_ctag->num_rows()==0)
		{	//level 2 category product access
		
			$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='3'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='3'  ");
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}					
				 }			
			}				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
	
		if($ctgid!='')
			{
			$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND a.lvl2='$ctgid' AND a.name LIKE '%$prodctnamefind%' group by a.sku order by a.product_id DESC LIMIT 50");
		   }
		}	
		
		
		if($qr_ctag->num_rows()==0)
		{
			//Product Name access
			$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND LOWER(a.name) LIKE '%$search_title%'  group by a.sku order by a.product_id DESC LIMIT 50");			
		}
		
		if($qr2->num_rows()==0)
		{		 		

		$qr2=$this->db->query("select a.sku,a.product_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND 

		(soundex(a.name)=soundex('$search_title')

                or soundex_match('$search_title','a.name','')

                or soundex(a.name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl2_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl2_name','')

                or soundex(a.lvl2_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl1_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl1_name','')

                or soundex(a.lvl1_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvlmain_name)=soundex('$search_title')

                or soundex_match('$search_title','lvlmain_name','')

                or soundex(lvlmain_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')	

		) group by a.sku order by a.product_id DESC LIMIT 50");

		

		}

		

		return $qr2;

		

	}

	

	function select_categoryfor_searchpage($search_title)
	{
		if (preg_match('/[\'^ \" ]/', $search_title))
		{
			$search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));

			$search_title=substr($search_title1,0,strpos($search_title1,' '));

		}
		if(preg_match('/valentine/',$search_title))
		{

			$qr2=$this->db->query("select a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.sku IN (SELECT sku FROM seller_product_attribute_value WHERE attr_value='valentine') OR a.name like '%valentine%') group by a.lvl2   ");	
		}
		else
		{		
/*
			$qr2=$this->db->query("select a.lvl2 as category_id from cornjob_productsearch a WHERE
												a.quantity >0
												AND a.seller_id !=0
												AND a.prod_status =  'Active'
												AND a.status =  'Enabled'
												AND a.seller_status =  'Active' AND
			 a.prod_search_sqlid IN ( SELECT b.prod_search_sqlid FROM cornjob_productsearch b WHERE  (b.name LIKE  '%$search_title%' or b.lvl2_name LIKE '%$search_title%' OR b.lvl1_name LIKE '%$search_title%' OR b.lvlmain_name LIKE '%$search_title%')) group by a.lvl2   ");*/
			 
			 
			/* $qr2=$this->db->query("SELECT a.lvl2 AS category_id FROM cornjob_productsearch a WHERE a.prod_search_sqlid IN (
SELECT b.prod_search_sqlid FROM cornjob_productsearch b WHERE ( b.name LIKE  '%$search_title%' OR b.lvl2_name LIKE  '%$search_title%' OR b.lvl1_name LIKE  '%$search_title%' OR b.lvlmain_name LIKE  '%$search_title%') AND b.quantity >0 AND b.seller_id !=0 AND b.prod_status =  'Active' AND b.status =  'Enabled'
AND b.seller_status =  'Active' ) GROUP BY a.lvl2  ");*/


$qr2=$this->db->query("SELECT a.lvl2 AS category_id
FROM cornjob_productsearch a
WHERE a.quantity >0
AND a.seller_id !=0
AND a.prod_status =  'Active'
AND a.status =  'Enabled'
AND a.seller_status =  'Active'
AND (
a.name LIKE  '%$search_title%'
OR a.lvl2_name LIKE  '%$search_title%'
OR a.lvl1_name LIKE  '%$search_title%'
OR a.lvlmain_name LIKE  '%$search_title%'
)
GROUP BY a.lvl2   ");

			/* $qr2=$this->db->query("SELECT a.lvl2 AS category_id
									FROM cornjob_productsearch a
									WHERE a.quantity >0
									AND a.seller_id !=0
									AND a.prod_status =  'Active'
									AND a.status =  'Enabled'
									AND a.seller_status =  'Active'
									AND a.prod_search_sqlid
									IN (SELECT t.prod_search_sqlid FROM (	
									(
									SELECT b.prod_search_sqlid	FROM cornjob_productsearch b WHERE
									(
									b.name LIKE  '%$search_title%'
									OR b.lvl2_name LIKE  '%$search_title%'
									OR b.lvl1_name LIKE  '%$search_title%'
									OR b.lvlmain_name LIKE  '%$search_title%'
									)
									)
									)t
									)
									GROUP BY a.lvl2

									   ");*/
		}

		if($qr2->num_rows()==0)
		{			

		$qr2=$this->db->query("select a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND
		 a.prod_search_sqlid IN ( SELECT b.prod_search_sqlid FROM cornjob_productsearch b
		 WHERE 
		(soundex(b.name)=soundex('$search_title')
                or soundex_match('$search_title','b.name','')
                or soundex(b.name) like concat(trim(trailing '0' from soundex('$search_title')),'%')
		OR soundex(b.lvl2_name)=soundex('$search_title')
                or soundex_match('$search_title','b.lvl2_name','')
                or soundex(b.lvl2_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')
		OR soundex(b.lvl1_name)=soundex('$search_title')
                or soundex_match('$search_title','b.lvl1_name','')
                or soundex(b.lvl1_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')
		OR soundex(b.lvlmain_name)=soundex('$search_title')
                or soundex_match('$search_title','lvlmain_name','')
                or soundex(lvlmain_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')	

		) ) group by a.lvl2  ");
				

		}

		

		return $qr2;	

	}

	

	

	function select_product_search_count($search_title){

		if (preg_match('/[\'^ \" ]/', $search_title))

		{

			/*$search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));

			$search_title=substr($search_title1,0,strpos($search_title1,' '));
			*/
			
			$search_title=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));

		}

		
		$prodctnamefind='';
		//$qr2=$this->db->query("SELECT a.name FROM cornjob_productsearch a

//		INNER JOIN product_master c ON a.product_id = c.product_id

//		INNER JOIN seller_account d ON d.seller_id = c.seller_id

//		WHERE c.seller_id!=0 AND c.approve_status = 'Active' AND c.status = 'Enabled' AND d.status = 'Active' AND (a.name LIKE  '%$search_title%' or a.lvl2_name LIKE '%$search_title%' OR a.lvl1_name LIKE '%$search_title%' OR a.lvlmain_name LIKE '%$search_title%') group by c.product_id");

if(preg_match('/valentine/',$search_title))

		{

			$qr2=$this->db->query("select a.product_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND  (a.sku IN (SELECT sku FROM seller_product_attribute_value WHERE attr_value='valentine') OR a.name like '%valentine%')  group by a.sku  ");	

		}

else{

/*$qr2=$this->db->query("select a.product_id from cornjob_productsearch a  WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND  a.prod_search_sqlid IN ( SELECT b.prod_search_sqlid FROM cornjob_productsearch b WHERE  (b.name LIKE  '%$search_title%' or b.lvl2_name LIKE '%$search_title%' OR b.lvl1_name LIKE '%$search_title%' OR b.lvlmain_name LIKE '%$search_title%')) group by a.product_id  ");*/ 

//level 3 category product access
		$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='2'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='2'  "); 
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}
					
				 }			
			}
				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
		
		if($ctgid!='')
			{
				$qr2=$this->db->query("select a.prod_search_sqlid  from cornjob_productsearch a
			 INNER JOIN category_indexing b ON b.category_id=a.lvl2
			 WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND b.parent_id='$ctgid' AND a.name LIKE '%$prodctnamefind%'  group by a.product_id");
			 
		    }	

		}		
		
		if($qr_ctag->num_rows()==0)
		{	//level 2 category product access
		
			$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='3'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='3'  ");
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}					
				 }			
			}				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
	
		if($ctgid!='')
			{
			$qr2=$this->db->query("select a.prod_search_sqlid  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND a.lvl2='$ctgid' AND a.name LIKE '%$prodctnamefind%' group by a.product_id ");
		   }
		}	
		
		
		if($qr_ctag->num_rows()==0)
		{
			//Product Name access
			$qr2=$this->db->query("select a.prod_search_sqlid  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND LOWER(a.name) LIKE '%$search_title%'  group by a.product_id  ");			
		}
		
		if($qr2->num_rows()==0)
		{		 		

		$qr2=$this->db->query("select a.prod_search_sqlid from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND 

		(soundex(a.name)=soundex('$search_title')

                or soundex_match('$search_title','a.name','')

                or soundex(a.name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl2_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl2_name','')

                or soundex(a.lvl2_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl1_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl1_name','')

                or soundex(a.lvl1_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvlmain_name)=soundex('$search_title')

                or soundex_match('$search_title','lvlmain_name','')

                or soundex(lvlmain_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')	

		) group by a.product_id ");

		

		}
		return $qr2->num_rows();

	}
	
	

	function select_more_product_search_data($search_title){

		if (preg_match('/[\'^ \" ]/', $search_title))

		{

			/*$search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));

			$search_title=substr($search_title1,0,strpos($search_title1,' '));
			*/
			$search_title=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));

		}

	

		$tart = $this->input->get('from');

		$limit = 12;

		$prodctnamefind='';		/*$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND  a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.name LIKE  '%$search_title%' or a.lvl2_name LIKE '%$search_title%' OR a.lvl1_name LIKE '%$search_title%' OR a.lvlmain_name LIKE '%$search_title%') group by a.product_id order by a.product_id DESC LIMIT $tart, $limit");*/

		

		if(preg_match('/valentine/',$search_title))

		{

			$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active'  AND (a.sku IN (SELECT sku FROM seller_product_attribute_value WHERE attr_value='valentine') OR a.name like '%valentine%' ) group by a.sku order by a.product_id DESC LIMIT $tart, $limit ");	

		}

		else

		{

		//level 3 category product access
		$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='2'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='2'  "); 
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}
					
				 }			
			}
				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
		
		if($ctgid!='')
			{$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id   from cornjob_productsearch a
			 INNER JOIN category_indexing b ON b.category_id=a.lvl2
			 WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND b.parent_id='$ctgid' AND a.name LIKE '%$prodctnamefind%'  group by a.sku,a.product_id order by a.product_id DESC LIMIT $tart, $limit");
		    }	

		}		
		
		if($qr_ctag->num_rows()==0)
		{	//level 2 category product access
		
			$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$search_title%' AND cat_level='3'  ");
		
			if($qr_ctag->num_rows()==0)
			{
				$srch_title1= explode(' ',$search_title);
				$srch_title12 = array_diff($srch_title1, array('and', 'with', 'in', 'of', 'to', '&', '/', 'on', 'the',','));
				$srch_title1finl=array_values($srch_title12);
				
				 foreach($srch_title1finl as $key=>$val)
				 {
					$qr_ctag=$this->db->query("SELECT category_id,category_name FROM category_indexing WHERE LOWER(category_name) LIKE '%$val%' AND cat_level='3'  ");
					if($qr_ctag->num_rows()>0)
					{$search_title=$val;break;}
					else
					{	//$prodifnd_catg[]=$val;
						$prodctnamefind=$val;
					}					
				 }			
			}				
		
		$ctg_arr=array();
		$ctgid='';
		foreach($qr_ctag->result_array() as $res_ctg)
		{
			if (stripos($res_ctg['category_name'], strtolower($search_title))!== false)
			{$ctgid=$res_ctg['category_id']; break; }
		}
	
		if($ctgid!='')
			{
			$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id   from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND a.lvl2='$ctgid' AND a.name LIKE '%$prodctnamefind%' group by a.sku,a.product_id order by a.product_id DESC LIMIT $tart, $limit");
		   }
		}	
		
		
		if($qr_ctag->num_rows()==0)
		{
			//Product Name access
			$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id   from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND LOWER(a.name) LIKE '%$search_title%' group by a.sku,a.product_id order by a.product_id DESC LIMIT $tart, $limit ");			
		}
		
		if($qr2->num_rows()==0)
		{		 		

		$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id  from cornjob_productsearch a WHERE a.quantity>0 AND a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND 

		(soundex(a.name)=soundex('$search_title')

                or soundex_match('$search_title','a.name','')

                or soundex(a.name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl2_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl2_name','')

                or soundex(a.lvl2_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvl1_name)=soundex('$search_title')

                or soundex_match('$search_title','a.lvl1_name','')

                or soundex(a.lvl1_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')		

		OR soundex(a.lvlmain_name)=soundex('$search_title')

                or soundex_match('$search_title','lvlmain_name','')

                or soundex(lvlmain_name) like concat(trim(trailing '0' from soundex('$search_title')),'%')	

		) group by a.sku,a.product_id order by a.product_id DESC LIMIT $tart, $limit ");

		

		}

		return $qr2;

	}

	

	

	function select_single_product_data($product_id,$skuid)

	{

		//$qr_slrprod=$this->db->query("select seller_exist_product_id from seller_product_master where sku='$skuid'");

//		$row_slrprod=$qr_slrprod->row();

//		@$seller_prodext_id=$row_slrprod->seller_exist_product_id;

		

		//$qr_slrprodimg=$this->db->query("select image as imag ,catelog_img_url as catelog_img_url  from seller_existingproduct_image where seller_extproduct_id='$seller_prodext_id'");

		

		$qr_slrprodimg=$this->db->query("select b.image as imag ,b.catelog_img_url as catelog_img_url, c.product_id  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id INNER JOIN product_image c ON c.product_id=a.master_product_id 

		WHERE  a.sku='$skuid' ");

		

		if($qr_slrprodimg->num_rows()>0)

		{

			$row_slrprodimg=$qr_slrprodimg->row();

			return $row_slrprodimg;

		}

		else

		{

		$qr2=$this->db->query("select  * from product_image where product_id='$product_id'");

		$row=$qr2->row();

		return $row;

		}

	}

	

	function retrieve_attr_color_option($product_id){

		$query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$product_id'");

		$attr_group_id_res = $query->result();

		$attr_group_id=$attr_group_id_res[0]->attribut_set;

		

		$sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND attribute_field_name='Color'");

		$rows = $sql->num_rows();

		if($rows > 0){

			return $sql->result();

		}else{

			return false;

		}

	}

	

	function retrieve_attr_size_option($product_id){

		$query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$product_id'");

		$attr_group_id_res = $query->result();

		$attr_group_id=$attr_group_id_res[0]->attribut_set;

		

		$sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND attribute_field_name='Size'");

		$rows = $sql->num_rows();

		if($rows > 0){

			return $sql->result();

		}else{

			return false;

		}

	}

	

	

	function retrieve_attr_capacity($product_id){

		$query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$product_id'");

		$attr_group_id_res = $query->result();

		$attr_group_id=$attr_group_id_res[0]->attribut_set;

		

		$sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND attribute_field_name='Capacity'");

		$rows = $sql->num_rows();

		if($rows > 0){

			return $sql->result();

		}else{

			return false;

		}

	}

	

	function retrieve_attr_ram($product_id){

		$query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$product_id'");

		$attr_group_id_res = $query->result();

		$attr_group_id=$attr_group_id_res[0]->attribut_set;

		

		$sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND attribute_field_name='RAM'");

		$rows = $sql->num_rows();

		if($rows > 0){

			return $sql->result();

		}else{

			return false;

		}

	}

	

	function retrieve_attr_rom($product_id){

		$query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$product_id'");

		$attr_group_id_res = $query->result();

		$attr_group_id=$attr_group_id_res[0]->attribut_set;

		

		$sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND attribute_field_name='ROM'");

		$rows = $sql->num_rows();

		if($rows > 0){

			return $sql->result();

		}else{

			return false;

		}

	}

	

	

	function get_unique_id($table,$uid){

			

		$query = $this->db->query('SELECT MAX('.$uid.') AS `maxid` FROM '.$table);

		$maxId = $query->row()->maxid;

		$id = $maxId+1;

		return $id;

		}

	

	function insert_addtocart_temp($product_id,$sku_id)

	{

		

		//$addtocarttemp=$this->get_unique_id('addtocart_temp','addtocart_id');

		//print_r( $this->session->userdata($addtocarttemp_session_id));

		//$addtocart_session_id= $this->session->userdata('addtocarttemp_session_id');

		//$qr=$this->db->insert('addtocart_temp',$data);

				

		array_push($this->session->userdata['addtocarttemp'],$product_id);

		array_push($this->session->userdata['addtocart_sku'],$sku_id);

		

		

		

		//echo count($this->session->userdata('addtocarttemp'));

//		print_r($this->session->userdata('addtocarttemp'));

//		exit;

		

		//if($qr)

//		{

//			return true;

//		}else

//		{

//			return false;	

//		}		

	}

	

	function insert_addtocart_temp_withlogin($product_id,$sku_id)

	{

		array_push($this->session->userdata['addtocarttemp'],$product_id);

		array_push($this->session->userdata['addtocart_sku'],$sku_id);

		$addtocarttemp_id=$this->get_unique_id('addtocart_temp','addtocart_id');

		//print_r($addtocarttemp_id);exit;

		

		$addtocart_session_id= $this->session->userdata('addtocarttemp_session_id');

		//echo $addtocart_session_id;exit;

		date_default_timezone_set('Asia/Calcutta');

		$dtd=date('Y-m-d H:i:s');

		$user_id=$this->session->userdata['session_data']['user_id'];

		$data=array(

			'addtocart_id'=>$addtocarttemp_id,

			'addtocart_session_id'=>$addtocart_session_id,

			'product_id'=>$product_id,

			'user_id'=>$user_id,			

			'sku'=>$sku_id,

			'prdt_color' => '',

			'prdt_size' => '',

			'added_time'=>$dtd

		);

		

		

		//if($this->session->userdata['session_data']['user_id']==5){ print_r($data);exit;

			//$this->db->query("INSERT INTO addtocart_temp (addtocart_id,addtocart_session_id,product_id,user_id,sku,added_time) VALUES ('$addtocarttemp_id','$addtocart_session_id','$product_id','$user_id','$sku_id','$dtd')");

		//}

		$qr=$this->db->insert('addtocart_temp',$data);

		

	}

	

	

	function insert_addtocart_temp_withlogin_attr($product_id,$sku_id,$attr_val)

	{

		$clr_val_arr = array();

		$sz_val_arr = array();

		$attr_arr = explode('&',$attr_val);

		foreach($attr_arr as $attr_fld){

			$key = strstr($attr_fld,'=',true);

			$value = str_replace('-',' ',trim(strstr($attr_fld,'=',false),'='));

			//echo $value.'<br/>';

			if($key == 'color'){

				//$clr_val_arr[] = $value;

				array_push($clr_val_arr,$value);

			}else if($key == 'size'){

				//$sz_val_arr[] = $value;

				array_push($sz_val_arr,$value);

			}

		}

		

		if (!empty($clr_val_arr)){

			$clr_val = $clr_val_arr[0];

		}else{

			$clr_val = '';

		}

		

		if (!empty($sz_val_arr)){

			$sz_val = $sz_val_arr[0];

		}else{

			$sz_val = '';

		}

		

		array_push($this->session->userdata['addtocarttemp'],$product_id);

		

		array_push($this->session->userdata['addtocart_sku'],$sku_id);

						

		$addtocarttemp_id=$this->get_unique_id('addtocart_temp','addtocart_id');

		//print_r($addtocarttemp_id);exit;

		

		$addtocart_session_id= $this->session->userdata('addtocarttemp_session_id');

			date_default_timezone_set('Asia/Calcutta');

		$dtd=date('Y-m-d H:i:s');	

		$data=array(

			'addtocart_id'=>$addtocarttemp_id,

			'addtocart_session_id'=>$addtocart_session_id,

			'product_id'=>$product_id,

			'user_id'=>$this->session->userdata['session_data']['user_id'],

			'sku'=>$sku_id,

			'prdt_color' => $clr_val,

			'prdt_size' => $sz_val,

			'added_time'=>$dtd

		);

		$qr=$this->db->insert('addtocart_temp',$data);

	}

	

	

	function insert_checkout_withlogin($product_id,$sku_id)

	{

		

		array_push($this->session->userdata['addtocarttemp'],$product_id);

		

		array_push($this->session->userdata['addtocart_sku'],$sku_id);

						

				$addtocarttemp_id=$this->get_unique_id('addtocart_temp','addtocart_id');

				//print_r($addtocarttemp_id);exit;

				

				$addtocart_session_id= $this->session->userdata('addtocarttemp_session_id');

				

				$data=array(

					'addtocart_id'=>$addtocarttemp_id,

					'addtocart_session_id'=>$addtocart_session_id,

					'product_id'=>$product_id,

					'user_id'=>$this->session->userdata['session_data']['user_id'],

					'sku'=>$sku_id

				);

				

				$qr=$this->db->insert('addtocart_temp',$data);

	}

	

	function checking_vertual_inventory_data($sku_id){

		//getting temporary checkout table quantity

		$query = $this->db->query("SELECT SUM(quantity) AS TEMP_QTY FROM checkout_temp WHERE sku='$sku_id'");

		if($query->num_rows() > 0){

			$result = $query->row();

			$temp_qty = $result->TEMP_QTY;

		}else{

			$temp_qty = 0;

		}

		//getting master table quantity

		$sql = $this->db->query("SELECT quantity FROM product_master WHERE sku='$sku_id'");

		$res = $sql->row();

		$mstr_qty = $res->quantity;

		return $mstr_qty-$temp_qty;

	}

	

	

	function retrieve_product_review($sku){

		$query = $this->db->query("SELECT a.*,b.fname FROM review_product a INNER JOIN user b ON a.user_id=b.user_id WHERE a.sku_id='$sku' AND a.status='Active' AND a.added_date > NOW() - INTERVAL 30 DAY");

		return $query;

	}

	

	function retrieve_seller_review($seller_id){

		$query = $this->db->query("SELECT a.*,b.fname,c.business_name,c.business_desc,a.seller_id FROM review_seller a INNER JOIN user b ON a.user_id=b.user_id INNER JOIN seller_account_information c ON a.seller_id=c.seller_id WHERE a.seller_id='$seller_id' AND a.added_date > NOW() - INTERVAL 30 DAY");

		return $query;

	}

	

	function retrieve_seller_datacount($seller_id)

	{

		$query = $this->db->query("SELECT product_id FROM cornjob_productsearch  WHERE seller_id='$seller_id' AND prod_status = 'Active' AND status='Enabled' AND seller_status='Active' group by sku ");

		

		

		//$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.seller_id!=0 AND a.prod_status = 'Active' AND a.status = 'Enabled' AND a.seller_status = 'Active' AND (a.name LIKE  '%$search_title%' or a.lvl2_name LIKE '%$search_title%' OR a.lvl1_name LIKE '%$search_title%' OR a.lvlmain_name LIKE '%$search_title%') group by a.product_id LIMIT $tart, $limit");

		 return $query->num_rows();

		

	}

	

	function retrieve_seller_data($limit,$start,$seller_id){

				

		$query = $this->db->query("SELECT a.business_name,a.business_desc,b.imag as catelog_img_url,b.product_id,b.name,b.mrp,b.sku,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,a.seller_id FROM seller_account_information a inner join cornjob_productsearch b ON a.seller_id=b.seller_id WHERE b.seller_id='$seller_id' AND b.prod_status = 'Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku ORDER BY b.product_id DESC  LIMIT ".$start.", ".$limit." ");

		$result = $query->result();

		//print_r($result);exit;

		return $result;

	}

	

	function retrieve_seller_badge($seller_id){

		$query = $this->db->query("SELECT a.seller_id,d.seller_badge_type FROM seller_account_information a inner join seller_badge d on a.seller_id=d.seller_id WHERE a.seller_id='$seller_id'");

		$result = $query->result();

		return $result;

	}

		

		

	function retrieve_all_seller_rating(){

		$query = $this->db->query("SELECT seller_id, COUNT( seller_id ) AS NO_OF_REVIEW, SUM( rating ) AS TOTAL_SUM_RATING FROM review_seller GROUP BY seller_id");

		if($query->num_rows() > 0){

			$result = $query->result();

			foreach($result as $row){

				$seller_id[] = $row->seller_id;

				$average_rating[] = $row->TOTAL_SUM_RATING/$row->NO_OF_REVIEW;

			}

			$seller_id_n_rating = array_combine($seller_id,$average_rating);

			return $seller_id_n_rating;

		}else{

			return false;

		}

	}

	

	function retrieve_shipping_fee($sku){

		$user_id = $this->session->userdata['session_data']['user_id'];

		$query = $this->db->query("SELECT seller_id FROM product_master WHERE sku='$sku'");

		$result = $query->result();

		$seller_id = $result[0]->seller_id;

		

		$query1 = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id'");

		$result1 = $query1->result();

		$shippment_type = $result1[0]->type;

		//below $shippment_flat_amount is true if shipment type is flat:

		$shippment_flat_amount = $result1[0]->amount;

		

		//program start for default shipment status///

		if($shippment_type == 'default'){

			//program start for getting user state id//

			$user_state_query = $this->db->query("SELECT b.state FROM user_address b INNER JOIN user a ON a.address_id=b.address_id WHERE a.user_id='$user_id'");

			$user_state_result = $user_state_query->result();

			$user_sate_id = $user_state_result[0]->state;

			//program start for getting user state id//

			

			//program start for seller's state wise shipment amount//

			foreach($result1 as $shipment_row){

				$local_sate_id[] = $shipment_row->state_id;

				$shping_amount[] = $shipment_row->amount;

			}

			$local_state_id_amount = array_combine($local_sate_id,$shping_amount);

			//return $local_state_id_amount[$user_sate_id];

			$national_shipping_amount = $local_state_id_amount[0];

			//program end for seller's state wise shipment amount//

			

			//program start for national shipment state id and amount//

			$query2 = $this->db->query("SELECT state_id FROM state");

			$result2 = $query2->result();

			foreach($result2 as $state_id_row){

				$all_state_id[] = $state_id_row->state_id;

			}

			$national_state_id = array_diff($all_state_id,$local_sate_id);

			$national_state_id_length = count($national_state_id);

			//$national_state_ids = array_fill(0,$national_state_id_length,0);			

			$national_state_id_amount = array_combine($national_state_id,array_fill(0,$national_state_id_length,$national_shipping_amount));

			$all_state_id_amount = ($local_state_id_amount + $national_state_id_amount);

			return $all_state_id_amount[$user_sate_id];

			//program start for national shipment state id and amount///

			//program end for default shipment status///

		}else if($shippment_type == 'flat'){

			return $shippment_flat_amount;

		}else if($shippment_type == 'free'){

			return 0;

		}	

	}

	

	function retrieve_shipping_fee_withount_login_n_address($sku){

		$query = $this->db->query("SELECT seller_id FROM product_master WHERE sku='$sku'");

		$result = $query->result();

		$seller_id = $result[0]->seller_id;

		

		//program start for retrieve seller national shipment amount///

		$query1 = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id' AND state_id=0");

		$result1 = $query1->result();

		$shippment_amount = $result1[0]->amount;

		//program start for retrieve seller national shipment amount///

		return $shippment_amount;

	}

	

	function retrieve_user_address_id(){

		$user_id = $this->session->userdata['session_data']['user_id'];

		$query = $this->db->query("SELECT address_id FROM user WHERE user_id='$user_id'");

		$result = $query->result();

		$address_id = $result[0]->address_id;

		return $address_id;

	}

	function select_prodmeta_info($product_id,$sku_id)

	{

		$meta_query=$this->db->query("SELECT * FROM product_meta_info WHERE product_id='$product_id' ");

		$rw_meta=$meta_query->row();

		if($rw_meta->meta_keywords!='')

		{

			return $rw_meta;	

		}else

		{

			$catgquery=$this->db->query("SELECT lvl2 FROM cornjob_productsearch WHERE sku='$sku_id' ");

			$rw_catg=$catgquery->row();

			

			$meta_catgquery=$this->db->query("SELECT page_title as meta_title,meta_keywords , meta_description as meta_desc FROM category_master WHERE category_id='$rw_catg->lvl2' ");

			$rw_metacatg=$meta_catgquery->row();

			return $rw_metacatg;

			

				

		}

	}

	

	function select_pagetitle($product_id)

	{

		$meta_query=$this->db->query("SELECT meta_title FROM product_meta_info WHERE product_id='$product_id' ");

		$rw_meta=$meta_query->row();

		

		return $rw_meta;	

		

	}

	function select_proddisplaystatus($product_id,$sku_id)

	{

		$query=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$product_id' AND sku='$sku_id' AND status='Enabled' AND prod_status='Active' AND seller_status='Active' ");

		return $query->num_rows();

	}

	

	function retrieve_same_product_different_seller($product_id,$sku){

		$query_clrsz=$this->db->query("SELECT * FROM cornjob_productsearch WHERE product_id='$product_id' AND sku='$sku' group by sku ");

		$rw_clrsz=$query_clrsz->row();

		$color=$rw_clrsz->color;

		$size=$rw_clrsz->size;

		

		$query_selectclrsz=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$product_id' AND color='$color' AND size='$size' group by sku ");

		

		$rw_selectclrsz=$query_selectclrsz->result_array();

		foreach($rw_selectclrsz as $res_selectclrsz)

		{

			$sku_arr[]="'".$res_selectclrsz['sku']."'";	

		}

			$sku_str=implode(',',$sku_arr);

		

		$query = $this->db->query("SELECT a.product_id,a.sku,a.seller_id,a.price,a.special_price,a.special_pric_from_dt,a.special_pric_to_dt,a.max_qty_allowed_in_shopng_cart,a.shipping_fee_amount,a.quantity,a.stock_availability,b.business_name ,d.name FROM product_master a 

		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 

		INNER JOIN product_general_info d ON a.product_id=d.product_id WHERE a.product_id='$product_id' AND a.approve_status='Active' AND a.status='Enabled' AND a.quantity>0 AND a.sku IN ($sku_str) AND a.sku NOT IN ('$sku') AND a.seller_id NOT IN (SELECT seller_id FROM product_master WHERE sku='$sku'  ) group by a.seller_id,a.product_id,a.sku");

		return $query;

	}

	

	function retrieve_same_productid_different_seller($product_id){

		$query = $this->db->query("SELECT a.product_id,a.sku,d.name FROM product_master a 

		 

		INNER JOIN product_general_info d ON a.product_id=d.product_id WHERE a.product_id='$product_id' AND a.approve_status='Active' AND a.status='Enabled' group by a.sku ");

		return $query;

	}

	

	function retrieve_indivisual_product_attr_headings($sku,$product_id){

		$query = $this->db->query("SELECT x.attribute_heading_id, x.attribute_heading_name, z.product_id,z.sku FROM attributes x INNER JOIN attribute_real y ON x.attribute_heading_id = y.attribute_heading_id INNER JOIN product_attribute_value z ON y.attribute_id = z.attr_id WHERE x.attribute_group_id = (SELECT a.attribute_group_id FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id = b.attr_id WHERE b.product_id ='$product_id' GROUP BY b.product_id ) AND z.product_id='$product_id' GROUP BY x.attribute_heading_id");

		$row = $query->num_rows();

		if($row == 0){

			//program start for getting seller product id//

			$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE a.master_product_id='$product_id' AND b.sku='$sku'");

			//condition for seller new product start here//

			if($sql->num_rows() > 0){

				$res = $sql->result();

				$seller_product_id = $res[0]->seller_product_id;

				//program end of getting seller product id//

				

				$query1 = $this->db->query("SELECT x.attribute_heading_id, x.attribute_heading_name, z.seller_product_id AS product_id, a.sku

				FROM attributes x

				INNER JOIN attribute_real y ON x.attribute_heading_id = y.attribute_heading_id

				INNER JOIN seller_product_attribute_value z ON y.attribute_id = z.attr_id

				INNER JOIN seller_product_general_info a ON a.seller_product_id = z.seller_product_id

				WHERE x.attribute_group_id = (

				SELECT a.attribute_group_id

				FROM attribute_real a

				INNER JOIN seller_product_attribute_value b ON a.attribute_id = b.attr_id

				WHERE b.seller_product_id =  '$seller_product_id'

				GROUP BY b.seller_product_id ) 

				AND z.seller_product_id =  '$seller_product_id'

				GROUP BY x.attribute_heading_id");

				return $query1;

			}

			//condition for seller new product end here//

			else

			//condition for seller exiting product start here//

			{

				$slq1 = $this->db->query("SELECT master_product_id FROM seller_product_master WHERE sku='$sku'");

				$res1 = $slq1->result();

				$mstr_product_id = $res1[0]->master_product_id;

				//echo $mstr_product_id;exit;

				

				//program start for getting same sku//

				$sql1 = $this->db->query("SELECT sku FROM product_master WHERE product_id='$product_id'");

				foreach($sql1->result() as $sku_row){

					$prdt_sku_arr[] = $sku_row->sku;

				}

				

				$sql2 = $this->db->query("SELECT DISTINCT sku FROM seller_product_attribute_value");

				foreach($sql2->result() as $sku_row){

					$attr_sku_arr[] = $sku_row->sku;

				}

				

				$attr_sku_arr = array_unique($attr_sku_arr);

				$find_sku = array_intersect($prdt_sku_arr,$attr_sku_arr);

				@$sngl_find_sku = $find_sku[0];

				//echo $sngl_find_sku;exit;

				//program end of getting same sku//

				

				$sql3 = $this->db->query("SELECT x.attribute_heading_id, x.attribute_heading_name, a.product_id , a.sku

				FROM attributes x

				INNER JOIN attribute_real y ON x.attribute_heading_id = y.attribute_heading_id

				INNER JOIN seller_product_attribute_value z ON y.attribute_id = z.attr_id

				INNER JOIN product_master a ON a.sku = z.sku

				WHERE x.attribute_group_id = (

				SELECT DISTINCT a.attribute_group_id

				FROM attribute_real a

				INNER JOIN seller_product_attribute_value b ON a.attribute_id = b.attr_id

				WHERE b.sku =  '$sngl_find_sku')

				AND z.sku =  '$sngl_find_sku'

				GROUP BY x.attribute_heading_id");

				return $sql3;

			}

			//condition for seller exiting product start here//

		}else{

			return $query;

		}

	}

	

	function getSellerBadge($sku_id){

		date_default_timezone_set('Asia/Calcutta');

		$dt =  date('Y-m-d');

		$query = $this->db->query("SELECT a.seller_badge_type

		FROM seller_badge a

		INNER JOIN product_master b ON a.seller_id = b.seller_id

		WHERE b.sku = '$sku_id' AND '$dt' BETWEEN a.from_date AND a.to_date");

		$row = $query->num_rows();

		

		if($row > 0){

			return $query->result();

		}

	}

	

	function related_prod($product_id){

	$query = $this->db->query("select a.product_id,a.related_product_id,b.price,b.special_price,b.mrp,b.special_pric_from_dt,b.special_pric_to_dt,c.name,d.imag from product_related a inner join product_master b on a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id inner join product_image d on c.product_id=d.product_id where a.product_id='$product_id' AND b.approve_status='Active' AND b.status='Enabled' group by a.product_id LIMIT 5 ");

	//print_r($query->num_rows());exit;

	return $query->result();

	}

	

	function retrieve_price_fltr_list($catg_id){

		$query = $this->db->query("SELECT MIN(final_price) AS MINIMUM_RS,MAX(final_price) AS MAXIMUM_RS FROM view_ative_product_final_price WHERE category_id='$catg_id'");

		if($query->num_rows() > 0){

			$result = $query->result();

			$min_rs = $result[0]->MINIMUM_RS;

			$max_rs = $result[0]->MAXIMUM_RS;

			

			//filter slab script start here//

			$slab_sql = $this->db->query("SELECT CONCAT_WS(  '-', first_slab, second_slab ) AS slab_rate 

FROM filter_price

WHERE id <= ( 

SELECT MIN( id ) 

FROM filter_price

WHERE second_slab >=  '$max_rs' ) 

AND id >= ( 

SELECT id

FROM filter_price

WHERE id = ( 

SELECT MAX( id ) 

FROM filter_price

WHERE first_slab <=  '$min_rs' ) )");

		return 	$slab_sql->result();

			//filter slab script end here//

		}else{

			return false;

		}

	}

	

	/*function retrieve_color_fltr_list($brand){

		$query = $this->db->query("SELECT DISTINCT color

FROM view_sku_brand_color

WHERE brand =  '$brand'");

		if($query->num_rows() > 0){

			return $query->result();

		}else{

			return false;

		}

	}*/

	

	

	function select_product_data_listfilter($catg_id,$last_segmt)

	{

		

		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrbhedname=array();

		$attrb_param=array();

		$limit = 50;

		$condition = " WHERE b.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			

			

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1=array();

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice' )

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))				

				{	

						$attrb_param[]=$arr1[0];				

						$attrbid_arr[]=strtok($arr1[0], '-');

						$attrbactualvalue_arr[]=str_replace('%20',' ',$arr1[1]);

					

				//$attrbhedname[] = str_replace('%20',' ',substr($arr1[0], strpos($arr1[0], "-") + 1));  

				

				}

				

			}

			

			$arr = array_combine($attr,$vale);

			

		}else{

			$arr = array();

		}		

		/*if(in_array('sortbyprice',$attrb_param)  || in_array('price',$attrb_param))

		{	$attrbid_arr=array();

			$attrbactualvalue_arr=array();

		}*/

		

		//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)

		{

			$attrb_brandvaluearr=array();

			$attrb_brandidarr=array();

			

			$otherattrbvalue_arr=array();

			$otherattrbid_arr=array();

			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)

			{

					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))

					{

							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung

							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];

							

					}

					else

					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 

							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

				

			}

			

			if(count($attrb_brandvaluearr)>0)

			{

			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)

				{

					$attrbrand_sid=$attrb_brandidarr[$keybrand];

					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);

					

					if($keybrand==0)

					{			

						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");					

						

						

						if($skuattrb_query->num_rows()==0)

						{		

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");			

						}					

						

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

							

					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{	

							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();

											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");

													

															

										if($skuattrb_query->num_rows()==0)

										{ 

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");					

										}

								

										

										if($skuattrb_query->num_rows()>0)	

										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								} 

									

								 

					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		

									

									

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				

									

								}

					else

					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  LIMIT $limit");						

									

							if($skuattrb_query->num_rows()==0)

							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");

							}

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									

						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{				

									

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();				

										

										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  LIMIT $limit ");									

										

										if($skuattrb_query->num_rows()==0)

										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");		

										}

										

										

																			

																

										if($skuattrb_query->num_rows()>0)	

										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								

								}

									

								

					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//

							

									$skuattrb_arrnew=array();

								

							

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

						

					} 

					

					

			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//

					

			} // other attribut check if condition else part start

			else

			{		

				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)

				{	

					

									

					$attrb_sid=$attrbid_arr[$attrbky];

					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

					

				//--------------------------- if attribute value count condition start-------------------------------------//					

						

						if($attrbky==0)

						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");						

							

							if($skuattrb_query->num_rows()==0)

							{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");		

							}

											

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else

						{

							

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND b.lvl2 IN ($catg_id) LIMIT $limit  ");

							

							

								if($skuattrb_query->num_rows()==0)

								{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");		

								}

								

											

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									$skuattrb_arrnew=array();

								

								

						}

									if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

							

					 

				//--------------------------- if attribute value count condition end-----------------------------------//

				

				

						

				} // $attrbactualvalue_arr for loop end 

				

			} // Other attribute check if condition end

					

		} // $attrbactualvalue_arr count check main if condition end

		//echo $condition;exit;

	

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

		

		

		

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

			$attrbidarrunique=array_unique($attrbid_arr);

			

		

		//echo $condition;exit;

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

			

		$attrb_idstrng=implode(',',$attrbid_arr);

		

			

		

		if(@$price_sortby)

		{ 			

		

				

				$query=$this->db->query("SELECT distinct b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku FROM  cornjob_productsearch b  $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND b.current_price!=0 group by b.product_id order by b.current_price $orderpricceby  LIMIT $limit ");

			

		}else{

			

			$query=$this->db->query("SELECT distinct b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku FROM  cornjob_productsearch b $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by b.product_id DESC LIMIT $limit ");

			

			

		}

		return $query;

	}

	

	

	function select_product_data_countfilter($catg_id,$last_segmt)

	{

		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrb_param=array();

		//$limit = 12;

		$condition = " WHERE b.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice')

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))				

				{	

						$attrb_param[]=$arr1[0];

					$attrbid_arr[]=strtok($arr1[0], '-');

					$attrbactualvalue_arr[]=str_replace('%20',' ',$arr1[1]); 

				

				}

				

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		/*if(in_array('sortbyprice',$attrb_param) || in_array('price',$attrb_param))

		{

			$attrbid_arr=array();

			$attrbactualvalue_arr=array();

		}*/

		

					//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)

		{

			$attrb_brandvaluearr=array();

			$attrb_brandidarr=array();

			

			$otherattrbvalue_arr=array();

			$otherattrbid_arr=array();

			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)

			{

					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))

					{

							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung

							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];

							

					}

					else

					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 

							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

				

			}

			

			if(count($attrb_brandvaluearr)>0)

			{

			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)

				{

					$attrbrand_sid=$attrb_brandidarr[$keybrand];

					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);

					

					if($keybrand==0)

					{			

						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");					

						

						

						if($skuattrb_query->num_rows()==0)

						{		

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");			

						}					

						

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

							

					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{	

							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();

											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");

													

															

										if($skuattrb_query->num_rows()==0)

										{ 

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");					

										}

								

										

										if($skuattrb_query->num_rows()>0)	

										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								} 

									

								 

					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		

									

									

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				

									

								}

					else

					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");						

									

							if($skuattrb_query->num_rows()==0)

							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");

							}

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									

						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{				

									

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();				

										

										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'   ");									

										

										if($skuattrb_query->num_rows()==0)

										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

										}

																	

																

										if($skuattrb_query->num_rows()>0)	

										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								

								}

									

								

					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//

							

									$skuattrb_arrnew=array();

								

							

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

						

					} 

					

					

			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//

					

			} // other attribut check if condition else part start

			else

			{		

				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)

				{	

					

									

					$attrb_sid=$attrbid_arr[$attrbky];

					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

					

				//--------------------------- if attribute value count condition start-------------------------------------//					

						

						if($attrbky==0)

						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");						

							

							if($skuattrb_query->num_rows()==0)

							{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

							}

											

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else

						{

							

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND b.lvl2 IN ($catg_id)  ");

							

							

								if($skuattrb_query->num_rows()==0)

								{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");		

								}

								

											

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									$skuattrb_arrnew=array();

								



								

						}

									if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

							

					 

				//--------------------------- if attribute value count condition end-----------------------------------//

				

				

						

				} // $attrbactualvalue_arr for loop end 

				

			} // Other attribute check if condition end

					

		} // $attrbactualvalue_arr count check main if condition end

		//echo $condition;exit;

	

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

		

		

		

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$orderpricceby = '';

			}

			

			//$ctr_attrbvalue=count($attrbactualvalue_arr);

			

		

		

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

			

		

		

		if(@$price_sortby)

		{ 	

				

				/*$query=$this->db->query("SELECT distinct b FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by a.current_price $orderpricceby ");*/

				

				$query=$this->db->query("SELECT distinct b.product_id,b.sku FROM  cornjob_productsearch b  $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND b.current_price!=0 group by b.product_id order by b.current_price $orderpricceby ");				

				

				

		}else{

			

			/*$query=$this->db->query("SELECT distinct b.product_id FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by b.product_id ");*/

			

			$query=$this->db->query("SELECT distinct b.product_id,b.sku FROM  cornjob_productsearch b $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id   ");

		

			

		}

		return $query->num_rows();	

	

	}

	

	

	

	function select_more_product_data_listfilter()

	{

		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrb_param=array();

		

		$limit = 12;

		$catg_id = $this->input->get('cat_id');

		//$catg_id = $this->uri->segment(4);

		

		$catg_id=str_replace('-',',',$catg_id);

		

		$tart = $this->input->get('from');

		//$tart = $this->uri->segment(3);

		

		$last_segmt = $this->input->get('lastseg');

		//$last_segmt = $this->uri->segment(5);

		

		

		$condition = " WHERE b.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice')

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))

				{

					$attrb_param[]=$arr1[0];

					$attrbid_arr[]=strtok($arr1[0], '-');

					$attrbactualvalue_arr[]=str_replace('%20',' ',$arr1[1]);

				

				//$attrbhedname[] = str_replace('%20',' ',substr($arr1[0], strpos($arr1[0], "-") + 1));  

				

				}

				

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}		

		

		

							//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)

		{

			$attrb_brandvaluearr=array();

			$attrb_brandidarr=array();

			

			$otherattrbvalue_arr=array();

			$otherattrbid_arr=array();

			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)

			{

					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))

					{

							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung

							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];

							

					}

					else

					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 

							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

				

			}

			

			if(count($attrb_brandvaluearr)>0)

			{ 

			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)

				{ 

					$attrbrand_sid=$attrb_brandidarr[$keybrand];

					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);

					

					if($keybrand==0)

					{			

						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");					

						

						

						if($skuattrb_query->num_rows()==0)

						{		

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");			

						}					

						

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

							

					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{	

							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();

											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");

													

															

										if($skuattrb_query->num_rows()==0)

										{ 

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");					

										}

								

										

										if($skuattrb_query->num_rows()>0)	

										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								} 

									

								 

					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		

									

									

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				

									

								}

					else

					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");						

									

							if($skuattrb_query->num_rows()==0)

							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");

							}

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									

						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{				

									

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();				

										

										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'   ");									

										

										if($skuattrb_query->num_rows()==0)

										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");		

										}

										

										

																			

																

										if($skuattrb_query->num_rows()>0)	

										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								

								}

									

								

					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//

							

									$skuattrb_arrnew=array();

								

							

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

						

					} 

					

					

			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//

					

			} // other attribut check if condition else part start

			else

			{		

				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)

				{	

					

									

					$attrb_sid=$attrbid_arr[$attrbky];

					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

					

				//--------------------------- if attribute value count condition start-------------------------------------//					

						

						if($attrbky==0)

						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");						

							

							if($skuattrb_query->num_rows()==0)

							{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

							}

											

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else

						{

							

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND b.lvl2 IN ($catg_id)  ");

							

							

								if($skuattrb_query->num_rows()==0)

								{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");		

								}

								

											

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									$skuattrb_arrnew=array();

								

								

						}

									if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

							

					 

				//--------------------------- if attribute value count condition end-----------------------------------//

				

				

						

				} // $attrbactualvalue_arr for loop end 

				

			} // Other attribute check if condition end

					

		} // $attrbactualvalue_arr count check main if condition end

		//echo $condition;exit;

	

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

				

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-')

		{

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

		

		

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

		//price sorting array end



		if(@$price_sortby)

		{ 

			$query=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND b.current_price!=0 group by b.product_id order by b.current_price $orderpricceby LIMIT $tart, $limit");

			

		}else

		{

		$query=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  $condition AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by rand() DESC LIMIT $tart, $limit");

		

		}

		

		return $query;

	}

	

	

		function select_category_product_data_listfilter($label_id,$last_segmt)

	{

		

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' AND  category_id!=''  ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		

		

		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrbhedname=array();

		$attrb_param=array();

		

		$limit = 50;

		$condition = " WHERE b.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = trim($arr1[0]);

				$vale[] = trim($arr1[1]);

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice')

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))

				{

					$attrb_param[]=$arr1[0];

					$attrbid_arr[]=strtok($arr1[0], '-');

					$attrbactualvalue_arr[]=str_replace('%20',' ',trim($arr1[1]));

				

				//$attrbhedname[] = str_replace('%20',' ',substr($arr1[0], strpos($arr1[0], "-") + 1));  

				

				}

				

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}		

		

		

		//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)

		{

			$attrb_brandvaluearr=array();

			$attrb_brandidarr=array();

			

			$otherattrbvalue_arr=array();

			$otherattrbid_arr=array();

			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)

			{

					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))

					{

							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung

							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];

							

					}

					else

					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 

							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

				

			}

			

			if(count($attrb_brandvaluearr)>0)

			{

			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)

				{

					$attrbrand_sid=$attrb_brandidarr[$keybrand];

					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);

					

					if($keybrand==0)

					{			

						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");					

						

						

						if($skuattrb_query->num_rows()==0)

						{		

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");			

						}					

						

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

							

					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{	

							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();

											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");

													

															

										if($skuattrb_query->num_rows()==0)

										{ 

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");					

										}

								

										

										if($skuattrb_query->num_rows()>0)	

										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								} 

									

								 

					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		

									

									

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				

									

								}

					else

					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  LIMIT $limit");						

									

							if($skuattrb_query->num_rows()==0)

							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");

							}

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									

						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{				

									

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();				

										

										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  LIMIT $limit ");									

										

										if($skuattrb_query->num_rows()==0)

										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");		

										}

										

										

																			

																

										if($skuattrb_query->num_rows()>0)	

										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								

								}

									

								

					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//

							

									$skuattrb_arrnew=array();

								

							

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

						

					} 

					

					

			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//

					

			} // other attribut check if condition else part start

			else

			{		

				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)

				{	

					

									

					$attrb_sid=$attrbid_arr[$attrbky];

					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

					

				//--------------------------- if attribute value count condition start-------------------------------------//					

						

						if($attrbky==0)

						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");						

							

							if($skuattrb_query->num_rows()==0)

							{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");		

							}

											

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else

						{

							

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND b.lvl2 IN ($catg_id) LIMIT $limit  ");

							

							

								if($skuattrb_query->num_rows()==0)

								{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' LIMIT $limit ");		

								}

								

											

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									$skuattrb_arrnew=array();

								

								

						}

									if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

							

					 

				//--------------------------- if attribute value count condition end-----------------------------------//

				

				

						

				} // $attrbactualvalue_arr for loop end 

				

			} // Other attribute check if condition end

					

		} // $attrbactualvalue_arr count check main if condition end

		//echo $condition;exit;

	

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

		

		

		

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

			$attrbidarrunique=array_unique($attrbid_arr);

			

		

		//echo $condition;exit;

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

			

		$attrb_idstrng=implode(',',$attrbid_arr);

		

			

		

		if(@$price_sortby)

		{ 			

		

				

				$query=$this->db->query("SELECT distinct b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku FROM  cornjob_productsearch b  $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND b.current_price!=0 group by b.product_id order by b.current_price $orderpricceby  LIMIT $limit ");

			

		}else{

			

			$query=$this->db->query("SELECT distinct b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku FROM  cornjob_productsearch b $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by b.product_id DESC LIMIT $limit ");

			

			

		}

		return $query;

		

		

		

	} // main function end

	

	function select_category_product_data_countfilter($label_id,$last_segmt)

	{

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' AND category_id!='' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}	

		$catg_id=implode(',',$arry_catgid);	

		

		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrb_param=array();

		//$limit = 12;

		$condition = " WHERE b.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice')

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))

				{

					$attrb_param[]=$arr1[0];

					$attrbid_arr[]=strtok($arr1[0], '-');

					$attrbactualvalue_arr[]=str_replace('%20',' ',$arr1[1]); 

				

				}

				

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}

		

		

					//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)

		{

			$attrb_brandvaluearr=array();

			$attrb_brandidarr=array();

			

			$otherattrbvalue_arr=array();

			$otherattrbid_arr=array();

			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)

			{

					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))

					{

							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung

							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];

							

					}

					else

					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 

							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

				

			}

			

			if(count($attrb_brandvaluearr)>0)

			{

			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)

				{

					$attrbrand_sid=$attrb_brandidarr[$keybrand];

					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);

					

					if($keybrand==0)

					{			

						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");					

						

						

						if($skuattrb_query->num_rows()==0)

						{		

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");			

						}					

						

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

							

					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{	

							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();

											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");

													

															

										if($skuattrb_query->num_rows()==0)

										{ 

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");					

										}

								

										

										if($skuattrb_query->num_rows()>0)	

										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								} 

									

								 

					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		

									

									

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				

									

								}

					else

					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");						

									

							if($skuattrb_query->num_rows()==0)

							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");

							}

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									

						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{				

									

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();				

										

										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'   ");									

										

										if($skuattrb_query->num_rows()==0)

										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

										}

																	

																

										if($skuattrb_query->num_rows()>0)	

										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								

								}

									

								

					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//

							

									$skuattrb_arrnew=array();

								

							

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

						

					} 

					

					

			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//

					

			} // other attribut check if condition else part start

			else

			{		

				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)

				{	

					

									

					$attrb_sid=$attrbid_arr[$attrbky];

					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

					

				//--------------------------- if attribute value count condition start-------------------------------------//					

						

						if($attrbky==0)

						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");						

							

							if($skuattrb_query->num_rows()==0)

							{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

							}

											

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else

						{

							

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND b.lvl2 IN ($catg_id)  ");

							

							

								if($skuattrb_query->num_rows()==0)

								{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");		

								}

								

											

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									$skuattrb_arrnew=array();

								

								

						}

									if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

							

					 

				//--------------------------- if attribute value count condition end-----------------------------------//

				

				

						

				} // $attrbactualvalue_arr for loop end 

				

			} // Other attribute check if condition end

					

		} // $attrbactualvalue_arr count check main if condition end

		//echo $condition;exit;

	

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

		

		

		

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$orderpricceby = '';

			}

			

			//$ctr_attrbvalue=count($attrbactualvalue_arr);

			

		

		

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

			

		

		

		if(@$price_sortby)

		{ 	

				

				/*$query=$this->db->query("SELECT distinct b FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by a.current_price $orderpricceby ");*/

				

				$query=$this->db->query("SELECT distinct b.product_id,b.sku FROM  cornjob_productsearch b  $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND b.current_price!=0 group by b.product_id order by b.current_price $orderpricceby ");				

				

				

		}else{

			

			/*$query=$this->db->query("SELECT distinct b.product_id FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by b.product_id ");*/

			

			$query=$this->db->query("SELECT distinct b.product_id,b.sku FROM  cornjob_productsearch b $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id   ");

		

			

		}

		return $query->num_rows();	

		

	

	}

	

	

	function select_more_categoryproduct_data_listfilter(){

		$limit = 12;

		$catg_id = $this->input->get('cat_id');

		

		$catg_menuqr=$this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$catg_id' ");

		$rw_catgmenu=$catg_menuqr->result();

		$arry_catgid=array();

		foreach($rw_catgmenu as $res_catgmenu)

		{

			array_push($arry_catgid,$res_catgmenu->category_id);	

		}

		

		$catg_id=implode(',',$arry_catgid);

		

			

		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrb_param=array();

		$limit = 12;

		//$catg_id = $this->input->get('cat_id');

		//$catg_id = $this->uri->segment(4);

		

		$catg_id=str_replace('-',',',$catg_id);

		

		$tart = $this->input->get('from');

		//$tart = $this->uri->segment(3);

		

		$last_segmt = $this->input->get('lastseg');

		//$last_segmt = $this->uri->segment(5);

		

		

		$condition = " WHERE b.lvl2 IN ($catg_id) ";

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice')

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))

				{

					$attrb_param[]=$arr1[0];

					$attrbid_arr[]=strtok($arr1[0], '-');

					$attrbactualvalue_arr[]=str_replace('%20',' ',$arr1[1]);

				

				//$attrbhedname[] = str_replace('%20',' ',substr($arr1[0], strpos($arr1[0], "-") + 1));  

				

				}

				

			}

			$arr = array_combine($attr,$vale);

		}else{

			$arr = array();

		}		

		

		

							//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)

		{

			$attrb_brandvaluearr=array();

			$attrb_brandidarr=array();

			

			$otherattrbvalue_arr=array();

			$otherattrbid_arr=array();

			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)

			{

					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))

					{

							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung

							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];

							

					}

					else

					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 

							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

				

			}

			

			if(count($attrb_brandvaluearr)>0)

			{ 

			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)

				{ 

					$attrbrand_sid=$attrb_brandidarr[$keybrand];

					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);

					

					if($keybrand==0)

					{			

						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");					

						

						

						if($skuattrb_query->num_rows()==0)

						{		

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");			

						}					

						

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

							

					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{	

							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();

											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");

													

															

										if($skuattrb_query->num_rows()==0)

										{ 

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");					

										}

								

										

										if($skuattrb_query->num_rows()>0)	

										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								} 

									

								 

					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		

									

									

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				

									

								}

					else

					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");						

									

							if($skuattrb_query->num_rows()==0)

							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");

							}

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									

						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)

								{				

									

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)

									{								

											$attrb_othersid=$otherattrbid_arr[$attrothrbky];

											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);

											

											$skuattrb_arrnew=array();				

										

										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'   ");									

										

										if($skuattrb_query->num_rows()==0)

										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");		

										}

										

										

																			

																

										if($skuattrb_query->num_rows()>0)	

										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)								

											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')

												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

												

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}

											

											

									} // other attribute forloop end

								

								}

									

								

					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//

							

									$skuattrb_arrnew=array();

								

							

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

						

					} 

					

					

			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//

					

			} // other attribut check if condition else part start

			else

			{		

				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)

				{	

					

									

					$attrb_sid=$attrbid_arr[$attrbky];

					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

					

				//--------------------------- if attribute value count condition start-------------------------------------//					

						

						if($attrbky==0)

						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");						

							

							if($skuattrb_query->num_rows()==0)

							{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

							}

											

							if($skuattrb_query->num_rows()>0)	

							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}

									

									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else

						{

							

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND b.lvl2 IN ($catg_id)  ");

							

							

								if($skuattrb_query->num_rows()==0)

								{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' ");		

								}

								

											

								if($skuattrb_query->num_rows()>0)	

								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)								

									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}

									

									$skuattrb_arrnew=array();

								

								

						}

									if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

							

					 

				//--------------------------- if attribute value count condition end-----------------------------------//

				

				

						

				} // $attrbactualvalue_arr for loop end 

				

			} // Other attribute check if condition end

					

		} // $attrbactualvalue_arr count check main if condition end

		//echo $condition;exit;

	

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

				

		

		if(array_key_exists('price',$arr)){

			$price_slab = $arr['price'];

		}else{

			$price_slab = 'NOT';

		}

		

		if($price_slab == 'NOT' || $price_slab == '-')

		{

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

		

		

		

		//price sorting array start

			if(array_key_exists('sortbyprice',$arr))

			{

				$price_sortby = $arr['sortbyprice'];

				if($price_sortby =='Low-To-High')

				{$orderpricceby='asc';}

				else if($price_sortby =='High-To-Low')

				{$orderpricceby='desc';}

			}			

			else

			{

				$price_sortby = '';

			}

		

		

		if($price_slab == 'NOT' || $price_slab == '-'){

			$condition .= '';

		}else{

			$price_arr = explode('-',$price_slab);

			$min_price = $price_arr[0];

			$max_price = $price_arr[1];

			$condition .=" AND b.current_price BETWEEN $min_price AND $max_price";

		}

		//price sorting array end



		if(@$price_sortby)

		{ 

			$query=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  $condition AND b.quantity>0 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' AND b.current_price!=0 group by b.product_id order by b.current_price $orderpricceby LIMIT $tart, $limit");

			

		}else

		{

		$query=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  $condition AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.product_id order by rand() DESC LIMIT $tart, $limit");

		

		}

		

		return $query;

		

		

		

	} //main function end

	

	

}

?>