<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjobinser_modelfor_sellerproductapproval extends CI_Model {

    function select_productdata() {
        $this->cronjobsearch_skuprodid_insert();
        $this->category_update();
        $this->cronjobsearch_prodnameimage_update();
        $this->other_data_update_cronjobproductsearch();
        $this->cronjobsearch_priceqntstatus_update();
        $this->cronjobsearch_sellerstatus_update();
    }

// select_productdata() function end

    function select_productdata1() {
        $qr_catg = $this->db->query("SELECT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `view_catinfo`");

        $row_catg = $qr_catg->result();
        $this->db->query("truncate temp_category");


        foreach ($row_catg as $res_catg) {
            $data_catg = array(
                'lvl2' => $res_catg->lvl2,
                'lvl2_name' => $res_catg->lvl2_name,
                'lvl1' => $res_catg->lvl1,
                'lvl1_name' => $res_catg->lvl1_name,
                'lvlmain' => $res_catg->lvlmain,
                'lvlmain_name' => $res_catg->lvlmain_name
            );
            $this->db->insert('temp_category', $data_catg);
        }
    }

//==================================================STEP : 1 START category insert=========================================================================================//
    //$qr_catg=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `temp_category`");
//				$row_catg=$qr_catg->result();
//				
//				foreach($row_catg as $res_catg)
//				{
//					$data_catg=array(
//						'lvl2'=>$res_catg->lvl2,
//						'lvl2_name'=>$res_catg->lvl2_name,
//						'lvl1'=>$res_catg->lvl1,
//						'lvl1_name'=>$res_catg->lvl1_name,
//						'lvlmain'=>$res_catg->lvlmain,
//						'lvlmain_name'=>$res_catg->lvlmain_name
//					);
//					$this->db->insert('cornjob_productsearch',$data_catg);
//				} 
//==================================================STEP : 1 END========================================================================================//
//==================================================STEP : 2 START product_id, sku insert=========================================================================================//
    //$query_productid=$this->db->query("select c.product_id,c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku NOT IN 			                                      (select sku FROM cornjob_productsearch) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
//		                                AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information) limit 1000") ;	
//				
//		$row_productid=$query_productid->result();
//		
//		$prod_sku_array=array();
//		foreach($row_productid as $res_productid)
//		{
//			$sku = "'".$res_productid->sku."'";
//			array_push($prod_sku_array,$sku);	
//			
//		}
//		$sku_str=implode(',',$prod_sku_array);	
//		
//		
//		$qr=$this->db->query("SELECT DISTINCT f.lvl2, f.lvl2_name, f.lvl1, f.lvl1_name, f.lvlmain, f.lvlmain_name, c.sku, c.product_id,c.approve_status,c.seller_id				
//FROM product_master c
//INNER JOIN product_category e ON e.product_id = c.product_id
//INNER JOIN temp_category f ON f.lvl2 = e.category_id WHERE c.sku IN ($sku_str)
//LIMIT 1000 ");
//		
//		$row_prod=$qr->result();
//		if(count($row_prod)>0)
//		{
//			foreach($row_prod as $res_prod)
//			{
//				$skr_arr[] = $res_prod->sku;
//				$data=array(
//					'lvl2'=>$res_prod->lvl2,
//					'lvl2_name'=>$res_prod->lvl2_name,
//					'lvl1'=>$res_prod->lvl1,
//					'lvl1_name'=>$res_prod->lvl1_name,
//					'lvlmain'=>$res_prod->lvlmain,
//					'lvlmain_name'=>$res_prod->lvlmain_name,
//					'sku'=>$res_prod->sku,
//					'product_id'=>$res_prod->product_id,
//					'prod_status'=>$res_prod->approve_status,					
//					'seller_id'=>$res_prod->seller_id
//					
//				);
//				$this->db->insert('cornjob_productsearch', $data);
//			}
//		}
//==================================================STEP : 2 END========================================================================================//
//==============================================STEP : 3 START prod_name, image insert==================================================================================//
    // $query_productid=$this->db->query("select c.product_id FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.product_id IN 			                                      (select product_id FROM cornjob_productsearch) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
//		                                AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information) limit 1000") ;	
//				
//		$row_productid=$query_productid->result();
//		
//		$prod_id_array=array();
//		foreach($row_productid as $res_productid)
//		{
//			$sku = $res_productid->product_id;
//			array_push($prod_id_array,$sku);
//			
//		
//			
//		}
//		$prodid_str=implode(',',$prod_id_array);
//		
//		
//		
//		$qr=$this->db->query("SELECT a.product_id, a.name,b.catelog_img_url
//FROM product_general_info a
//INNER JOIN product_image b ON a.product_id = b.product_id
//WHERE a.product_id IN ($prodid_str)
//LIMIT 1000 ");
//		
//		$row_prod=$qr->result();
//		if(count($row_prod)>0)
//		{
//			foreach($row_prod as $res_prod)
//			{
//				
//				//$data=array('name'=>$res_prod->name,'imag'=>$res_prod->catelog_img_url);
////				$this->db->where('product_id','$res_prod->product_id');
////				$this->db->update('cornjob_productsearch',$data);
//				
//				//$prod_name=mysqli_real_escape_string($res_prod->name);
//				
//				$prod_name=addslashes($res_prod->name);
//				$this->db->query("UPDATE cornjob_productsearch SET name='$prod_name' , imag='$res_prod->catelog_img_url' WHERE product_id='$res_prod->product_id' AND product_id!=0 ");
//			}
//		}
//==================================================STEP : 3 END========================================================================================//
//==================================================STEP : 4 START prod_name, image insert=========================================================================================//
    //$query_productid=$this->db->query("select c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.product_id NOT IN 			                                      (select product_id FROM cornjob_productsearch) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
//		                                AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information) limit 1000") ;	
//				
//		$row_productid=$query_productid->result();
//		if(count($row_productid)>0)
//			$prod_sku_array=array();
//			foreach($row_productid as $res_productid)
//			{
//				
//					$skr_arr[] = $res_productid->sku;
//				
//			}
//		
//		
//		$this->update_filtering_attribute_data($skr_arr);
//==================================================STEP : 4 END========================================================================================//
//}
    function update_filtering_attribute_data($skr_arr) {
        foreach ($skr_arr as $k => $v) {
            $arr[] = "'" . $v . "'";
        }
        $sku_strng = implode(',', $arr);
        //update color attribute
        $this->db->query("UPDATE cornjob_productsearch SET color=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku IN ($sku_strng)
AND view_attrbute_filter_data.attribute_field_name='Color'
GROUP BY sku ) WHERE sku IN ($sku_strng)");





        // color code by santanu start

        $this->db->query("UPDATE cornjob_productsearch SET color=( SELECT clr_name
FROM color_attr
WHERE sku_id=cornjob_productsearch.sku
GROUP BY sku_id ) WHERE sku IN ($sku_strng)");

        // clolr code by santanu end
        //update size attribute
        $this->db->query("UPDATE cornjob_productsearch SET size=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku IN ($sku_strng)
AND view_attrbute_filter_data.attribute_field_name='Size'
GROUP BY sku ) WHERE sku IN ($sku_strng)");


// size code by santanu start

        $this->db->query("UPDATE cornjob_productsearch SET size=( SELECT m_size_name
FROM size_attr
WHERE sku IN ($sku_strng)
GROUP BY sku_id ) WHERE sku IN ($sku_strng)");

        // size code by santanu end
        //update brand attribute
        $this->db->query("UPDATE cornjob_productsearch SET brand=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku IN ($sku_strng)
AND view_attrbute_filter_data.attribute_field_name='Brand'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

        //update sub size attribute
        $this->db->query("UPDATE cornjob_productsearch SET sub_size=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku IN ($sku_strng)
AND view_attrbute_filter_data.attribute_field_name='Sub size'
GROUP BY sku ) WHERE sku IN ($sku_strng)");


// subsize code by santanu start

        $this->db->query("UPDATE cornjob_productsearch SET sub_size=( SELECT s_size_name
FROM size_attr
WHERE sku IN ($sku_strng)
GROUP BY sku_id ) WHERE sku IN ($sku_strng)");

        // subsize code by santanu end
        //update Occasion attribute
        $this->db->query("UPDATE cornjob_productsearch SET occasion=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku IN ($sku_strng)
AND view_attrbute_filter_data.attribute_field_name='Occasion'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

        //update Type attribute
        $this->db->query("UPDATE cornjob_productsearch SET type=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku IN ($sku_strng)
AND view_attrbute_filter_data.attribute_field_name='Type'
GROUP BY sku ) WHERE sku IN ($sku_strng)");
    }

    function temp_category_insert() {
        $qr_catg = $this->db->query("SELECT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `view_catinfo` ");
        $row_catg = $qr_catg->result();
        $this->db->query("truncate temp_category");

        foreach ($row_catg as $res_catg) {
            $data_catg = array(
                'lvl2' => $res_catg->lvl2,
                'lvl2_name' => $res_catg->lvl2_name,
                'lvl1' => $res_catg->lvl1,
                'lvl1_name' => $res_catg->lvl1_name,
                'lvlmain' => $res_catg->lvlmain,
                'lvlmain_name' => $res_catg->lvlmain_name
            );
            $this->db->insert('temp_category', $data_catg);
        }
    }

    function category_insertinto_cornjob_productsearch() {
        $qr_catg = $this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `temp_category`");
        $row_catg = $qr_catg->result();

        foreach ($row_catg as $res_catg) {
            $data_catg = array(
                'lvl2' => $res_catg->lvl2,
                'lvl2_name' => $res_catg->lvl2_name,
                'lvl1' => $res_catg->lvl1,
                'lvl1_name' => $res_catg->lvl1_name,
                'lvlmain' => $res_catg->lvlmain,
                'lvlmain_name' => $res_catg->lvlmain_name
            );
            $this->db->insert('cornjob_productsearch', $data_catg);
        }
    }

    function cronjobsearch_skuprodid_insert() {

        $query_productid = $this->db->query("select c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku NOT IN (select sku FROM cornjob_productsearch WHERE sku!='') AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'                          AND (d.status =  'Active' OR d.status =  'Pending')  AND d.seller_id IN (SELECT seller_id FROM seller_account_information)");

        $row_productid = $query_productid->result();
        if (count($row_productid) > 0) {
            $prod_sku_array = array();
            foreach ($row_productid as $res_productid) {
                $sku = "'" . $res_productid->sku . "'";
                array_push($prod_sku_array, $sku);
            }
            $sku_str = implode(',', $prod_sku_array);


            $qr = $this->db->query("SELECT c.sku, c.product_id,c.approve_status,c.seller_id,		
				CASE 
				WHEN c.special_price !=0 AND CURDATE() BETWEEN c.special_pric_from_dt AND c.special_pric_to_dt
				THEN c.special_price
				WHEN c.price !=0
				THEN c.price 
				ELSE c.mrp
				END FINAL_PRICE				
		FROM product_master c WHERE c.sku IN ($sku_str) ");

            $row_prod = $qr->result();
            if (count($row_prod) > 0) {
                foreach ($row_prod as $res_prod) {
                    //$skr_arr[] = $res_prod->sku;
                    $data = array(
                        'sku' => $res_prod->sku,
                        'product_id' => $res_prod->product_id,
                        'prod_status' => $res_prod->approve_status,
                        'current_price' => $res_prod->FINAL_PRICE,
                        'seller_id' => $res_prod->seller_id
                    );
                    $this->db->insert('cornjob_productsearch', $data);
                }
            }
        }
    }

    function category_update() {
        $qr = $this->db->query("SELECT DISTINCT f.lvl2, f.lvl2_name, f.lvl1, f.lvl1_name, f.lvlmain, f.lvlmain_name,c.product_id				
FROM cornjob_productsearch c
INNER JOIN product_category e ON e.product_id = c.product_id
INNER JOIN temp_category f ON f.lvl2 = e.category_id WHERE  c.lvl2=0 AND c.product_id!=0 ");

        $row_prod = $qr->result();

        foreach ($row_prod as $res_prod) {

            $lvl2_name = addslashes($res_prod->lvl2_name);
            $lvl1_name = addslashes($res_prod->lvl1_name);
            $lvlmain_name = addslashes($res_prod->lvlmain_name);

            $this->db->query("update cornjob_productsearch set lvl2='$res_prod->lvl2', lvl2_name='$lvl2_name', lvl1='$res_prod->lvl1', lvl1_name='$lvl1_name', lvlmain='$res_prod->lvlmain', lvlmain_name='$lvlmain_name'  WHERE product_id='$res_prod->product_id' ");
        }
    }

    function cronjobsearch_prodnameimage_update() {


        $qr = $this->db->query("SELECT c.product_id, a.name,b.catelog_img_url
			FROM cornjob_productsearch c INNER JOIN
			product_general_info a ON a.product_id=c.product_id
			INNER JOIN product_image b ON c.product_id = b.product_id  WHERE c.product_id!=0 AND c.name='' AND c.imag='' ");

        $row_prod = $qr->result();
        if (count($row_prod) > 0) {
            foreach ($row_prod as $res_prod) {

                $prod_name = addslashes($res_prod->name);
                $this->db->query("UPDATE cornjob_productsearch SET name='$prod_name' , imag='$res_prod->catelog_img_url' WHERE product_id='$res_prod->product_id'  ");
            }
        }
    }

    function other_data_update_cronjobproductsearch() {

        $query_productid = $this->db->query("select sku FROM cornjob_productsearch WHERE sku!='' AND product_id!=0 AND brand='' ");

        $row_productid = $query_productid->result();
        if (count($row_productid) > 0)
            $prod_sku_array = array();
        foreach ($row_productid as $res_productid) {

            $skr_arr[] = $res_productid->sku;
        }


        $this->update_filtering_attribute_data($skr_arr);
    }

    function cronjobsearch_priceqntstatus_update() {

        $query_productid = $this->db->query("select c.sku	FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku IN (select sku FROM cornjob_productsearch WHERE sku!='' AND mrp=0 ) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled' AND (d.status =  'Active' OR d.status =  'Pending') AND d.seller_id IN (SELECT seller_id FROM seller_account_information)");

        $row_productid = $query_productid->result();
        if (count($row_productid) > 0) {
            $prod_sku_array = array();
            foreach ($row_productid as $res_productid) {
                $sku = "'" . $res_productid->sku . "'";
                array_push($prod_sku_array, $sku);
            }
            $sku_str = implode(',', $prod_sku_array);


            $qr = $this->db->query("SELECT c.sku, c.mrp,c.price,c.special_price,c.special_pric_from_dt,c.special_pric_to_dt, c.status, c.quantity FROM product_master c WHERE c.sku IN ($sku_str) ");

            $row_prod = $qr->result();
            if (count($row_prod) > 0) {
                foreach ($row_prod as $res_prod) {
                    //$skr_arr[] = $res_prod->sku;
                    //$data=array(					
//							'mrp'=>$res_prod->mrp,
//							'price'=>$res_prod->price,
//							'special_price'=>$res_prod->special_price,
//							'special_pric_from_dt'=>$res_prod->special_pric_from_dt,					
//							'special_pric_to_dt'=>$res_prod->special_pric_to_dt,
//							'status'=>$res_prod->status,
//							'quantity'=>$res_prod->quantity
//							
//						);

                    $this->db->query("update cornjob_productsearch set mrp='$res_prod->mrp', price='$res_prod->price', special_price='$res_prod->special_price', special_pric_from_dt='$res_prod->special_pric_from_dt', special_pric_to_dt='$res_prod->special_pric_to_dt', status='$res_prod->status', quantity='$res_prod->quantity'  WHERE sku = '$res_prod->sku' ");
                }
            }
        }
    }

    function cronjobsearch_sellerstatus_update() {

        $query_productid = $this->db->query("select c.sku	FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku IN (select sku FROM cornjob_productsearch WHERE sku!='' AND seller_status='Pending' ) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled' AND (d.status =  'Active' OR d.status =  'Pending') AND d.seller_id IN (SELECT seller_id FROM seller_account_information)");

        $row_productid = $query_productid->result();
        if (count($row_productid) > 0) {
            $prod_sku_array = array();
            foreach ($row_productid as $res_productid) {
                $sku = "'" . $res_productid->sku . "'";
                array_push($prod_sku_array, $sku);
            }
            $sku_str = implode(',', $prod_sku_array);


            $qr = $this->db->query("SELECT c.sku,d.status FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id  WHERE c.sku IN ($sku_str) ");

            $row_prod = $qr->result();

            if (count($row_prod) > 0) {
                foreach ($row_prod as $res_prod) {
                    $this->db->query("update cornjob_productsearch set seller_status='$res_prod->status'  WHERE sku = '$res_prod->sku' ");
                }
            }
        }
    }

    function update_cornjob_singleproduct_info($product_id, $product_sku) {

        $this->update_cronjobsearch_price_status($product_sku);
        $this->update_cronjobsearch_prodnameimage_update($product_id, $product_sku);
        $this->update_other_data_cronjobproductsearch($product_sku);


        $this->db->query("DELETE FROM cornjob_product_update WHERE sku='$product_sku' ");
    }

    function update_cronjobsearch_price_status($sku_id) {


        $qr = $this->db->query("SELECT c.sku, c.product_id,c.approve_status,c.seller_id,c.mrp,c.price,c.special_price,c.special_pric_from_dt,c.special_pric_to_dt, c.status, c.quantity,		
				CASE 
				WHEN c.special_price !=0 AND CURDATE() BETWEEN c.special_pric_from_dt AND c.special_pric_to_dt
				THEN c.special_price
				WHEN c.price !=0
				THEN c.price 
				ELSE c.mrp
				END FINAL_PRICE				
		FROM product_master c WHERE c.sku = '$sku_id' ");

        $row_prod = $qr->row();
        if ($qr->num_rows() > 0) {

            $this->db->query("update cornjob_productsearch SET 
				prod_status='$row_prod->approve_status', 
				current_price='$row_prod->FINAL_PRICE', 
				mrp='$row_prod->mrp',
				price='$row_prod->price',
				special_price='$row_prod->special_price',
				special_pric_from_dt='$row_prod->special_pric_from_dt',
				special_pric_to_dt='$row_prod->special_pric_to_dt',
				status='$row_prod->status',			
				quantity='$row_prod->quantity'
				WHERE sku='$sku_id' ");
        }
    }

    function update_cronjobsearch_prodnameimage_update($productid, $sku_id) {


        $qr = $this->db->query("SELECT a.product_id, a.name,b.catelog_img_url	FROM product_general_info a INNER JOIN product_image b ON a.product_id = b.product_id  WHERE a.product_id='$productid' ");

        $row_prod = $qr->row();
        if ($qr->num_rows() > 0) {
            $prod_name = addslashes($row_prod->name);
            $this->db->query("UPDATE cornjob_productsearch SET name='$prod_name' , imag='$row_prod->catelog_img_url' WHERE product_id='$productid'   ");
        }
    }

    function update_other_data_cronjobproductsearch($sku) {


        $prod_sku_array = array();


        $skr_arr[] = $sku;

        $this->update_filtering_attribute_data($skr_arr);
    }

    //----------------------------bulck update product info-----------------------------------------------

    function update_cornjob_product_info() {
        $qr_select = $this->db->query("SELECT * FROM  `cornjob_productsearch` WHERE sku IN (SELECT sku FROM cornjob_product_update)");
        $row = $qr_select->result();
        if (count($row) > 0) {
            foreach ($row as $res_prodinfo) {
                $this->update_cronjobsearch_price_status($res_prodinfo->sku);
                $this->update_cronjobsearch_prodnameimage_update($res_prodinfo->product_id);
                $this->update_other_data_cronjobproductsearch($res_prodinfo->sku);
            }

            $this->db->query("truncate cornjob_product_update");
        } // if condition end
    }

    function update_prodapprove_status($status, $sku_ids) {
        $skuid_arr = explode(',', $sku_ids);

        foreach ($skuid_arr as $key => $val) {
            if ($status == 'Active') {
                $this->db->query("UPDATE cornjob_productsearch SET prod_status='Active' WHERE sku='$val' ");
            } else {
                $this->db->query("UPDATE cornjob_productsearch SET prod_status='Inactive' WHERE sku='$val' ");
            }
        }
    }

    function update_existingprodapprove_status($status, $prod_ids) {
        if ($status == 'Active') {
            $this->db->query("UPDATE cornjob_productsearch SET prod_status='Active' WHERE product_id IN ($prod_ids) ");
        } else {
            $this->db->query("UPDATE cornjob_productsearch SET prod_status='Inactive' WHERE product_id IN ($prod_ids) ");
        }
    }

    function update_singleprodapprove_status($status, $sku) {
        if ($status == 'Active') {
            $this->db->query("UPDATE cornjob_productsearch SET prod_status='Active' WHERE sku= '$sku' ");
        } else {
            $this->db->query("UPDATE cornjob_productsearch SET prod_status='Inactive' WHERE sku= '$sku' ");
        }
    }

    function update_sellerstatus($seller_id, $status) {
        $this->db->query("UPDATE cornjob_productsearch SET seller_status='$status' WHERE seller_id= '$seller_id' ");
    }

    //------------------------------------bulck update product info----------------------------------------
    //-----------------------------------------------category update by cronjob start-----------------------------------------------------

    function cronjob_categoryupdate() {
        $qr = $this->db->query("SELECT DISTINCT f.lvl2, f.lvl2_name, f.lvl1, f.lvl1_name, f.lvlmain, f.lvlmain_name,c.product_id				
			FROM cornjob_productsearch c
			INNER JOIN product_category e ON e.product_id = c.product_id
			INNER JOIN temp_category f ON f.lvl2 = e.category_id WHERE  c.lvl2=0 AND c.product_id!=0 ");

        $row_prod = $qr->result();
        if ($qr->num_rows() > 0) {
            foreach ($row_prod as $res_prod) {
                $lvl2_name = addslashes($res_prod->lvl2_name);
                $lvl1_name = addslashes($res_prod->lvl1_name);
                $lvlmain_name = addslashes($res_prod->lvlmain_name);

                $this->db->query("update cornjob_productsearch set lvl2='$res_prod->lvl2', lvl2_name='$lvl2_name', lvl1='$res_prod->lvl1', lvl1_name='$lvl1_name', lvlmain='$res_prod->lvlmain', lvlmain_name='$lvlmain_name'  WHERE product_id='$res_prod->product_id' ");
            }
        }
    }

    //-----------------------------------------------category update by cronjob end-----------------------------------------------------

    function update_cornjob_singleproduct_datainfo($product_id, $product_sku) {

        $this->update_cronjobsearch_price_status($product_sku);
        $this->update_cronjobsearch_prodnameimage_update($product_id, $product_sku);
        //$this->update_other_data_cronjobproductsearch($product_sku);


        $this->db->query("DELETE FROM cornjob_product_update WHERE sku='$product_sku' ");
    }

    function update_capramrom_attrubute() {

        $sql = $this->db->query("SELECT * FROM attribute_real WHERE
										(attribute_field_name='Capacity' OR  attribute_field_name='RAM' OR  attribute_field_name='ROM')");

        $rw_sql = $sql->result();


        // collecting single prodt attribute value with sku start
        foreach ($rw_sql as $res_product_attrbinfo) {
            $query_capcityattrb = $this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id'  "); // sku is in this table

            if ($query_capcityattrb->num_rows() == 0) {
                $query_capcityattrb = $this->db->query("SELECT attr_value,attr_id,sku FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id'  "); // sku is in this table
            }

            if ($query_capcityattrb->num_rows() != 0) {

                $row_capacityramromattrb = $query_capcityattrb->row();
                $capacityramrom_val = $row_capacityramromattrb->attr_value;
                $skuid = $row_capacityramromattrb->sku;
            }

            if ($res_product_attrbinfo->attribute_field_name == 'Capacity') {

                $this->db->query("UPDATE cornjob_productsearch SET Capacity='$capacityramrom_val' WHERE sku='$skuid' ");
            } // if condition end for Capacity 

            if ($res_product_attrbinfo->attribute_field_name == 'RAM') {

                $this->db->query("UPDATE cornjob_productsearch SET RAM='$capacityramrom_val' WHERE sku='$skuid' ");
            } // if condition end for RAM

            if ($res_product_attrbinfo->attribute_field_name == 'ROM') {

                $this->db->query("UPDATE cornjob_productsearch SET ROM='$capacityramrom_val' WHERE sku='$skuid' ");
            } // if condition end for ROM
        } // for loop condition end
        // collecting single prodt attribute value with sku end
    }

    function update_single_capramrom_attrubute($sku_ids) {
        $skids_arr = explode(',', $sku_ids);
        $sku_rearray = array();
        foreach ($skids_arr as $key_skiidarr => $val_skiidarr) {
            $skiid_value = "'" . $val_skiidarr . "'";
            array_push($sku_rearray, $skiid_value);
        }
        $skuid_rearray_str = implode(',', $sku_rearray);
        $quey_productidids = $this->db->query("SELECT product_id FROM cornjob_productsearch WHERE sku IN ($skuid_rearray_str) ");
        $rw_productidids = $quey_productidids->result_array();

        $prodid_arr = array();
        foreach ($rw_productidids as $res_productidids) {
            array_push($prodid_arr, $res_productidids['product_id']);
        }

        //$prodid_arr=explode(',',$prod_ids);

        $i = 0;

        foreach ($prodid_arr as $keyprodid => $valprodid) {
            $query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$valprodid'");

            if ($query->num_rows() > 0) {
                $attr_group_id_res = $query->result();
                $attr_group_id = $attr_group_id_res[0]->attribut_set;


                $sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND
										(attribute_field_name='Capacity' OR  attribute_field_name='RAM' OR  attribute_field_name='ROM')");

                if ($sql->num_rows() > 0) {
                    $rw_sql = $sql->result();


                    // collecting single prodt attribute value with sku start
                    foreach ($rw_sql as $res_product_attrbinfo) {
                        $query_capcityattrb = $this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id'  "); // sku is in this table

                        if ($query_capcityattrb->num_rows() == 0) {
                            $query_capcityattrb = $this->db->query("SELECT attr_value,attr_id,sku FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id'  "); // sku is in this table
                        }

                        if ($query_capcityattrb->num_rows() != 0) {

                            $row_capacityramromattrb = $query_capcityattrb->row();
                            $capacityramrom_val = $row_capacityramromattrb->attr_value;
                            $skuid = $row_capacityramromattrb->sku;
                        }

                        if ($res_product_attrbinfo->attribute_field_name == 'Capacity') {

                            $this->db->query("UPDATE cornjob_productsearch SET Capacity='$capacityramrom_val' WHERE sku='$skuid' ");
                        } // if condition end for Capacity 

                        if ($res_product_attrbinfo->attribute_field_name == 'RAM') {

                            $this->db->query("UPDATE cornjob_productsearch SET RAM='$capacityramrom_val' WHERE sku='$skuid' ");
                        } // if condition end for RAM

                        if ($res_product_attrbinfo->attribute_field_name == 'ROM') {

                            $this->db->query("UPDATE cornjob_productsearch SET ROM='$capacityramrom_val' WHERE sku='$skuid' ");
                        } // if condition end for ROM
                    } // for loop condition end
                } // if attribute_real table data not available condtion end
            } // if product_setting table data not available  condition end
            // collecting single prodt attribute value with sku end
            $i++;
        } // main prodid array loop end
    }

}

// class end
?>