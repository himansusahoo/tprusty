<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Corenjob_product_model extends CI_Model {

    function select_productdata() {
        //$qr_catg=$this->db->query("SELECT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `view_catinfo`");
//		$row_catg=$qr_catg->result();
//		$this->db->query("truncate temp_category");
//		foreach($row_catg as $res_catg)
//		{
//			$data_catg=array(
//				'lvl2'=>$res_catg->lvl2,
//				'lvl2_name'=>$res_catg->lvl2_name,
//				'lvl1'=>$res_catg->lvl1,
//				'lvl1_name'=>$res_catg->lvl1_name,
//				'lvlmain'=>$res_catg->lvlmain,
//				'lvlmain_name'=>$res_catg->lvlmain_name
//			);
//			$this->db->insert('temp_category',$data_catg);
//		}

        $query_productid = $this->db->query("select c.product_id,c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.product_id NOT IN (select product_id FROM cornjob_productsearch) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
		AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information) limit 100");

        //$query_productid=$this->db->query("select c.product_id,c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku NOT IN (select sku FROM cornjob_productsearch) AND c.seller_id!=0 AND d.seller_id IN (SELECT seller_id FROM seller_account_information)") ;

        $row_productid = $query_productid->result();
        $productid_array = array();
        foreach ($row_productid as $res_productid) {
            $sku = "'" . $res_productid->sku . "'";
            array_push($productid_array, $sku);
        }
        $productid_str = implode(',', $productid_array);

        $qr = $this->db->query("SELECT DISTINCT f.lvl2, f.lvl2_name, f.lvl1, f.lvl1_name, f.lvlmain, f.lvlmain_name, c.approve_status, c.sku, c.product_id, a.name, 
		CASE 
		WHEN c.special_price !=0 AND CURDATE() BETWEEN c.special_pric_from_dt AND c.special_pric_to_dt
		THEN c.special_price
		WHEN c.price !=0
		THEN c.price 
		ELSE c.mrp
		END FINAL_PRICE,
		b.catelog_img_url
		FROM product_general_info a
		INNER JOIN product_image b ON a.product_id = b.product_id
		INNER JOIN product_master c ON a.product_id = c.product_id
		INNER JOIN seller_account d ON d.seller_id = c.seller_id
		INNER JOIN product_category e ON e.product_id = c.product_id
		INNER JOIN temp_category f ON f.lvl2 = e.category_id
		WHERE c.sku IN ($productid_str) ");

        $row_prod = $qr->result();
        if (count($row_prod) > 0) {
            foreach ($row_prod as $res_prod) {
                $skr_arr[] = $res_prod->sku;
                $data = array(
                    'lvl2' => $res_prod->lvl2,
                    'lvl2_name' => $res_prod->lvl2_name,
                    'lvl1' => $res_prod->lvl1,
                    'lvl1_name' => $res_prod->lvl1_name,
                    'lvlmain' => $res_prod->lvlmain,
                    'lvlmain_name' => $res_prod->lvlmain_name,
                    'sku' => $res_prod->sku,
                    'product_id' => $res_prod->product_id,
                    'name' => $res_prod->name,
                    'imag' => $res_prod->catelog_img_url,
                    'current_price' => $res_prod->FINAL_PRICE,
                    'prod_status' => $res_prod->approve_status
                );
                $this->db->insert('cornjob_productsearch', $data);
            }

            //update filtering attribute data in cornjob_productsearch table
            $this->update_filtering_attribute_data($skr_arr);
        }//if condition end
    }

    function update_filtering_attribute_data($skr_arr) {
        foreach ($skr_arr as $k => $v) {
            $arr[] = "'" . $v . "'";
        }
        $sku_strng = implode(',', $arr);
        //update color attribute
        $this->db->query("UPDATE cornjob_productsearch SET color=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Color'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

        //update size attribute
        $this->db->query("UPDATE cornjob_productsearch SET size=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Size'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

        //update brand attribute
        $this->db->query("UPDATE cornjob_productsearch SET brand=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Brand'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

        //update sub size attribute
        $this->db->query("UPDATE cornjob_productsearch SET sub_size=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Sub size'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

        //update Occasion attribute
        $this->db->query("UPDATE cornjob_productsearch SET occasion=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Occasion'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

        //update Type attribute
        $this->db->query("UPDATE cornjob_productsearch SET type=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Type'
GROUP BY sku ) WHERE sku IN ($sku_strng)");
    }

    function update_inn_cornjob_product_data() {
        $query = $this->db->query("SELECT * FROM cornjob_product_update");
        $result = $query->result();
        foreach ($result as $row) {
            $product_id_arr[] = $row->product_id;
            $sku_arr[] = "'" . $row->sku . "'";
        }
        $product_id = implode(',', $product_id_arr);
        $sku = implode(',', $sku_arr);

        $sql = $this->db->query("SELECT DISTINCT f.lvl2, f.lvl2_name, f.lvl1, f.lvl1_name, f.lvlmain, f.lvlmain_name, c.sku, c.product_id, a.name, 
		CASE 
		WHEN c.special_price !=0 AND CURDATE() BETWEEN c.special_pric_from_dt AND c.special_pric_to_dt
		THEN c.special_price
		WHEN c.price !=0
		THEN c.price 
		ELSE c.mrp
		END FINAL_PRICE,
		b.catelog_img_url
		FROM product_general_info a
		INNER JOIN product_image b ON a.product_id = b.product_id
		INNER JOIN product_master c ON a.product_id = c.product_id
		INNER JOIN seller_account d ON d.seller_id = c.seller_id
		INNER JOIN product_category e ON e.product_id = c.product_id
		INNER JOIN temp_category f ON f.lvl2 = e.category_id
		WHERE c.product_id IN ($product_id) AND c.sku IN ($sku)
		group by c.product_id");

        $row_prod = $sql->result();
        if (count($row_prod) > 0) {
            foreach ($row_prod as $res_prod) {
                $skr_arr[] = $res_prod->sku;
                $data = array(
                    'lvl2' => $res_prod->lvl2,
                    'lvl2_name' => $res_prod->lvl2_name,
                    'lvl1' => $res_prod->lvl1,
                    'lvl1_name' => $res_prod->lvl1_name,
                    'lvlmain' => $res_prod->lvlmain,
                    'lvlmain_name' => $res_prod->lvlmain_name,
                    'sku' => $res_prod->sku,
                    'product_id' => $res_prod->product_id,
                    'name' => $res_prod->name,
                    'imag' => $res_prod->catelog_img_url,
                    'current_price' => $res_prod->FINAL_PRICE
                );
                $this->db->insert('cornjob_productsearch', $data);
            }

            //update filtering attribute data in cornjob_productsearch table
            $this->update_filtering_attribute_data($skr_arr);
        }//if condition end
    }

}
