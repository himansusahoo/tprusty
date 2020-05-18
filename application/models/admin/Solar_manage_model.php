<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solar_manage_model extends CI_Model {

    function solar_indexing_count() {
        if (@$_GET['indx_status'] == 'Completed') {
            $qr = $this->db->query("SELECT count(sql_id) as tot FROM solar_indexing   WHERE indexing_status='Completed' AND prod_process_status='Add' ");
        } else {
            $qr = $this->db->query("SELECT count(sql_id) as tot FROM solar_indexing  WHERE indexing_status='Pending' AND prod_process_status='Add' ");
        }
        //return $qr->num_rows();

        return $qr->row()->tot;
    }

    /* function select_solar_indexing($limit,$start)
      {

      $qr=$this->db->query("SELECT a.*,b.name,b.imag,b.sku FROM solar_indexing a
      INNER JOIN cornjob_productsearch b on a.sku=b.sku
      WHERE indexing_status='Pending' ORDER BY b.prod_search_sqlid DESC LIMIT ".$start.", ".$limit." ");

      return $qr;
      } */

    function select_solar_indexing($limit, $start) {
        if (@$_GET['indx_status'] == 'Completed') {
            $indx_sts = 'Completed';
        } else {
            $indx_sts = 'Pending';
        }
        //$query_prodid = $this->db->query("SELECT a.product_id FROM product_setting a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id  ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");

        $query_prodid = $this->db->query("SELECT b.product_id FROM solar_indexing a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id WHERE  (a.indexing_status='" . $indx_sts . "' ) AND a.prod_process_status='Add'  ORDER BY a.sql_id DESC LIMIT " . $start . ", " . $limit . "");

        if ($query_prodid->num_rows() > 0) {
            $row_prod_id = $query_prodid->result_array();

            $prod_arr = array();
            foreach ($row_prod_id as $res_prodid) {
                array_push($prod_arr, $res_prodid['product_id']);
            }
            $prodid_str = implode(',', $prod_arr);


            $query1 = $this->db->query("SELECT h.*,b.name,b.imag,b.sku
		FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
		INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
		INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
		INNER JOIN solar_indexing h on h.sku=b.sku
		WHERE a.product_id
		IN ($prodid_str) AND h.indexing_status='" . $indx_sts . "' AND h.prod_process_status='Add'
		GROUP BY b.sku  ORDER BY a.product_id DESC  ");

            if ($query1->num_rows() > 0) {
                return $query1;
            } else {
                $query2 = $this->db->query("SELECT h.*,b.name,c.sku,e.catelog_img_url
			FROM product_setting a
			INNER JOIN product_general_info b ON a.product_id = b.product_id
			INNER JOIN product_master c ON a.product_id = c.product_id
			INNER JOIN product_category d ON a.product_id = d.product_id
			INNER JOIN product_image e ON a.product_id = e.product_id
			INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
			INNER JOIN seller_account_information g ON c.seller_id = g.seller_id
			INNER JOIN solar_indexing h on h.sku=c.sku			
			WHERE a.product_id
			IN ($prodid_str) AND h.indexing_status='" . $indx_sts . "' AND h.prod_process_status='Add'
			GROUP BY c.sku ORDER BY a.product_id DESC ");

                return $query2;
            } //if condition end
        } else {
            return $query2 = false;
        }
    }

    function addsolr_indesing() {
        set_time_limit(0);
        $sku_ids = $this->input->post('prod_sku');
        $skuidsarr = array();

        foreach ($sku_ids as $ky => $val) {
            $skuidsarr[] = "'" . $val . "'";
        }

        $skuids_strg = implode(',', $skuidsarr);


        $query = $this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,a.lvlmain_name,a.brand,
                                 a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id,a.imag,a.mrp,a.price,a.special_price,
								 a.special_pric_from_dt,a.special_pric_to_dt,a.lvlmain,a.lvl1,a.lvl2,a.status,a.quantity,a.seller_status,a.prod_status 
								 FROM cornjob_productsearch a INNER JOIN solar_indexing b ON a.sku=b.sku  
								 WHERE b.indexing_status='Pending' and b.prod_process_status='Add' AND b.sku IN ($skuids_strg) group by a.sku");


        if (base_url() == 'https://www.moonboy.in/') {
            $solr_colection = SOLR_CORE_NAME;
        } else {
            $solr_colection = 'mycollection4_offline';
        }

        $ch = curl_init(SOLR_BASE_URL . "" . $solr_colection . "/update?wt=json&spellcheck=true&spellcheck.build=true&commit=true");

        foreach ($query->result_array() as $res_prod) {
            $search_txt = $res_prod['sku'];

            $skuid = $res_prod['sku'];

            $selr_id = $res_prod['seller_id'];
            $skuid = $res_prod['sku'];
            $qr_seller = $this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$selr_id' ");

            $seller_name = $qr_seller->row()->business_name;

            $qrattr_sku = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' GROUP BY attr_id ");
            $attrbchk_val = array();
            $attrb_combn = array();
            if ($qrattr_sku->num_rows() > 0) {
                foreach ($qrattr_sku->result_array() as $res_atrbfldlbl) {
                    $attrb_id = $res_atrbfldlbl['attr_id'];
                    $qr_attrbfld = $this->db->query("SELECT attribute_field_name FROM attribute_real WHERE attribute_id='$attrb_id' GROUP BY attribute_id ");

                    $attrbfld_nm = $qr_attrbfld->row()->attribute_field_name;
                    $attrbchk_val[] = "'" . str_replace("&", '', str_replace("'", '', $attrbfld_nm)) . "'";
                }

                $attrbchk_valstrng = implode(',', $attrbchk_val);
                $model_num = '';

                $qr_attrbfld = $this->db->query("SELECT distinct attrb_name,solr_filed_nm FROM solr_product_attribute  WHERE attrb_name IN ($attrbchk_valstrng) ");

                $arr_condition = '';

                $attrb_ky = array();
                $attrb_vl = array();
                $attrb_combn = array();

                if ($qr_attrbfld->num_rows() > 0) {
                    foreach ($qr_attrbfld->result_array() as $res_prodattarrfld) {
                        $attrb_realnfldame = trim($res_prodattarrfld['attrb_name']);

                        $qrattr_sku = $this->db->query("SELECT a.attr_value FROM seller_product_attribute_value a
															   INNER JOIN attribute_real b ON a.attr_id=b.attribute_id
															   WHERE a.sku='$skuid' AND b.attribute_field_name='$attrb_realnfldame' 
															   GROUP BY a.attr_id ");

                        $prod_actualattrbval = $qrattr_sku->row()->attr_value;
                        $attrb_ky[] = $res_prodattarrfld['solr_filed_nm'];
                        $attrb_vl[] = $prod_actualattrbval;
                    }
                }
                $attrb_combn = array_combine($attrb_ky, $attrb_vl);
            } // attribute check condition end

            $data = array();

            $data = array(
                "add" => array(
                    "doc" => array(
                        "Title" => stripslashes($res_prod['name']),
                        "Category_Lvl1" => stripslashes($res_prod['lvlmain_name']),
                        "Category_Lvl2" => stripslashes($res_prod['lvl1_name']),
                        "Category_Lvl3" => stripslashes($res_prod['lvl2_name']),
                        "Category_Lvl1_Id" => $res_prod['lvlmain'],
                        "Category_Lvl2_Id" => $res_prod['lvl1'],
                        "Category_Lvl3_Id" => $res_prod['lvl2'],
                        "Sku" => $res_prod['sku'],
                        "Product_Id" => $res_prod['product_id'],
                        "Seller_Name" => stripslashes($seller_name),
                        "Catalog_Image" => $res_prod['imag'],
                        "Mrp" => $res_prod['mrp'],
                        "Price" => $res_prod['price'],
                        "Special_Price" => $res_prod['special_price'],
                        "status" => $res_prod['status'],
                        "quantity" => $res_prod['quantity'],
                        "seller_status" => $res_prod['seller_status'],
                        "prod_status" => $res_prod['prod_status'],
                    ),
                    "commitWithin" => 1000,
                ),
            );

            if ($res_prod['special_pric_from_dt'] != '0000-00-00' && $res_prod['special_pric_to_dt'] != '0000-00-00') {

                $data['add']['doc']['Special_Price_From_Date'] = $res_prod['special_pric_from_dt'] . 'T00:00:00Z';
                $data['add']['doc']['Special_Price_To_Date'] = $res_prod['special_pric_to_dt'] . 'T00:00:00Z';
            }

            if (count($attrb_combn) > 0) {
                foreach ($attrb_combn as $ky => $vl) {
                    if ($vl != '') {
                        $data['add']['doc'][$ky] = stripslashes($vl);
                    }
                }
            }

            $data_string = json_encode($data);


            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
					
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec($ch);

            $data2 = json_decode($response, true);


            $dt = date('Y-m-d H:i:s');
            if ($data2['responseHeader']['status'] == 0) {


                $this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt',error_msg='' WHERE sku='$skuid' AND prod_process_status='Add' ");
            } else {
                $err_msg = str_replace("'", '', $data2['error']['msg']);
                $this->db->query("UPDATE solar_indexing SET indexing_status='Pending', error_msg='$err_msg' ,last_indexdtm='$dt' WHERE sku='$skuid' AND prod_process_status='Add' ");
            }
        }

        echo 'success';
        exit;
    }

    function solar_editprodindexing_count() {
        if (@$_GET['indx_status'] == 'Completed') {
            $qr = $this->db->query("SELECT sql_id FROM solar_indexing  WHERE (indexing_status='Completed' ) AND prod_process_status='Edit' GROUP BY sku ");
        } else {
            $qr = $this->db->query("SELECT sql_id FROM solar_indexing  WHERE (indexing_status='Pending' ) AND prod_process_status='Edit' GROUP BY sku ");
        }


        return $qr->num_rows();
    }

    function select_solar_editedindexing($limit, $start) {

        if (@$_GET['indx_status'] == 'Completed') {
            $indx_sts = 'Completed';
        } else {
            $indx_sts = 'Pending';
        }

        $query_prodid = $this->db->query("SELECT b.product_id FROM solar_indexing a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id WHERE  (a.indexing_status='" . $indx_sts . "' ) AND a.prod_process_status='Edit'  ORDER BY a.sql_id DESC LIMIT " . $start . ", " . $limit . "");
        $row_prod_id = $query_prodid->result_array();

        if ($query_prodid->num_rows() > 0) {
            $prod_arr = array();
            foreach ($row_prod_id as $res_prodid) {
                array_push($prod_arr, $res_prodid['product_id']);
            }
            $prodid_str = implode(',', $prod_arr);


            $query1 = $this->db->query("SELECT h.*,b.name,b.imag,b.sku
				FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
				INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
				INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
				INNER JOIN solar_indexing h on h.sku=b.sku
				WHERE a.product_id
				IN ($prodid_str) AND (h.indexing_status='" . $indx_sts . "' ) AND h.prod_process_status='Edit'
				GROUP BY b.sku  ORDER BY a.product_id DESC  ");

            if ($query1->num_rows() > 0) {
                return $query1;
            } else {
                $query2 = $this->db->query("SELECT h.*,b.name,c.sku,e.catelog_img_url
					FROM product_setting a
					INNER JOIN product_general_info b ON a.product_id = b.product_id
					INNER JOIN product_master c ON a.product_id = c.product_id
					INNER JOIN product_category d ON a.product_id = d.product_id
					INNER JOIN product_image e ON a.product_id = e.product_id
					INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
					INNER JOIN seller_account_information g ON c.seller_id = g.seller_id
					INNER JOIN solar_indexing h on h.sku=c.sku					
					WHERE a.product_id
					IN ($prodid_str) AND (h.indexing_status='" . $indx_sts . "' ) AND h.prod_process_status='Edit'
					GROUP BY c.sku ORDER BY a.product_id DESC ");

                return $query2;
            } //if condition end
        } else {
            return $query2 = false;
        }
    }

    function updatesolr_indesing() {


        set_time_limit(0);
        $sku_ids = $this->input->post('prod_sku');
        $skuidsarr = array();

        foreach ($sku_ids as $ky => $val) {
            $skuidsarr[] = "'" . $val . "'";
        }

        $skuids_strg = implode(',', $skuidsarr);


        $query = $this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,a.lvlmain_name,a.brand,
                                 a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id,a.imag,a.mrp,a.price,a.special_price,
								 a.special_pric_from_dt,a.special_pric_to_dt,a.lvlmain,a.lvl1,a.lvl2,a.status,a.quantity,a.seller_status,a.prod_status 
								 FROM cornjob_productsearch a INNER JOIN solar_indexing b ON a.sku=b.sku  
								 WHERE b.indexing_status='Pending' and b.prod_process_status='Edit' AND b.sku IN ($skuids_strg) group by a.sku");

        if (base_url() == 'https://www.moonboy.in/') {
            $solr_colection = SOLR_CORE_NAME;
        } else {
            $solr_colection = 'mycollection4_offline';
        }

        $ch = curl_init(SOLR_BASE_URL . $solr_colection . "/update?wt=json&spellcheck=true&spellcheck.build=true&commit=true");

        foreach ($query->result_array() as $res_prod) {

            //-------------------------index remove if exit start---------------------//

            $search_txt = $res_prod['sku'];
            $chslect = SOLR_BASE_URL . "" . $solr_colection . "/select?q=Sku:" . $search_txt . "&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";

            $curl2 = curl_init($chslect);
            curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($curl2);
            $data3 = json_decode($output, true);

            $skuid = $res_prod['sku'];

            if ($data3['response']['numFound'] > 0) {
                //$curl_dlt= SOLR_BASE_URL."".$solr_colection."/update?commit=true -H 'Content-Type: text/xml' --data-binary '<delete><Sku>".$skuid."</Sku></delete>'";	

                $curl_dlt = SOLR_BASE_URL . "" . $solr_colection . "/update?commit=true%20-H%20%27'Content-Type:%20text/xml%27%20--data-binary%20%27<delete><Sku>" . $skuid . "</Sku></delete>%27";

                $curl2 = curl_init($curl_dlt);
                curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($curl2);
                $data2 = json_decode($output, true);
            }

            //-------------------------index remove if exit end---------------------//			

            $selr_id = $res_prod['seller_id'];
            $skuid = $res_prod['sku'];
            $qr_seller = $this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$selr_id' ");

            $seller_name = $qr_seller->row()->business_name;

            $qrattr_sku = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' GROUP BY attr_id ");
            $attrbchk_val = array();
            $attrb_combn = array();

            if ($qrattr_sku->num_rows() > 0) {
                foreach ($qrattr_sku->result_array() as $res_atrbfldlbl) {
                    $attrb_id = $res_atrbfldlbl['attr_id'];
                    $qr_attrbfld = $this->db->query("SELECT attribute_field_name FROM attribute_real WHERE attribute_id='$attrb_id' GROUP BY attribute_id ");

                    $attrbfld_nm = $qr_attrbfld->row()->attribute_field_name;
                    $attrbchk_val[] = "'" . str_replace("&", '', str_replace("'", '', $attrbfld_nm)) . "'";
                }

                $attrbchk_valstrng = implode(',', $attrbchk_val);
                $model_num = '';

                $qr_attrbfld = $this->db->query("SELECT distinct attrb_name,solr_filed_nm FROM solr_product_attribute  WHERE attrb_name IN ($attrbchk_valstrng) ");

                $arr_condition = '';

                $attrb_ky = array();
                $attrb_vl = array();
                $attrb_combn = array();

                if ($qr_attrbfld->num_rows() > 0) {
                    foreach ($qr_attrbfld->result_array() as $res_prodattarrfld) {
                        $attrb_realnfldame = trim($res_prodattarrfld['attrb_name']);

                        $qrattr_sku = $this->db->query("SELECT a.attr_value FROM seller_product_attribute_value a
																   INNER JOIN attribute_real b ON a.attr_id=b.attribute_id
																   WHERE a.sku='$skuid' AND b.attribute_field_name='$attrb_realnfldame' 
																   GROUP BY a.attr_id ");

                        $prod_actualattrbval = $qrattr_sku->row()->attr_value;
                        $attrb_ky[] = $res_prodattarrfld['solr_filed_nm'];
                        $attrb_vl[] = $prod_actualattrbval;
                    }
                }
                $attrb_combn = array_combine($attrb_ky, $attrb_vl);
            } //attribute check condition end



            $data = array();

            $data = array(
                "add" => array(
                    "doc" => array(
                        "Title" => stripslashes($res_prod['name']),
                        "Category_Lvl1" => stripslashes($res_prod['lvlmain_name']),
                        "Category_Lvl2" => stripslashes($res_prod['lvl1_name']),
                        "Category_Lvl3" => stripslashes($res_prod['lvl2_name']),
                        "Category_Lvl1_Id" => $res_prod['lvlmain'],
                        "Category_Lvl2_Id" => $res_prod['lvl1'],
                        "Category_Lvl3_Id" => $res_prod['lvl2'],
                        "Sku" => $res_prod['sku'],
                        "Product_Id" => $res_prod['product_id'],
                        "Seller_Name" => stripslashes($seller_name),
                        "Catalog_Image" => $res_prod['imag'],
                        "Mrp" => $res_prod['mrp'],
                        "Price" => $res_prod['price'],
                        "Special_Price" => $res_prod['special_price'],
                        "status" => $res_prod['status'],
                        "quantity" => $res_prod['quantity'],
                        "seller_status" => $res_prod['seller_status'],
                        "prod_status" => $res_prod['prod_status'],
                    ),
                    "commitWithin" => 1000,
                ),
            );

            if ($res_prod['special_pric_from_dt'] != '0000-00-00' && $res_prod['special_pric_to_dt'] != '0000-00-00') {

                $data['add']['doc']['Special_Price_From_Date'] = $res_prod['special_pric_from_dt'] . 'T00:00:00Z';
                $data['add']['doc']['Special_Price_To_Date'] = $res_prod['special_pric_to_dt'] . 'T00:00:00Z';
            }

            if (count($attrb_combn) > 0) {
                foreach ($attrb_combn as $ky => $vl) {
                    if ($vl != '') {
                        $data['add']['doc'][$ky] = stripslashes($vl);
                    }
                }
            }


            $data_string = json_encode($data);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec($ch);

            $data3 = json_decode($response, true);


            $dt = date('Y-m-d H:i:s');
            if ($data3['responseHeader']['status'] == 0) {
                $this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt',error_msg='' WHERE sku='$skuid' AND prod_process_status='Edit' ");
            } else {
                $err_msg = str_replace("'", '', $data3['error']['msg']);
                $this->db->query("UPDATE solar_indexing SET indexing_status='Pending', error_msg='$err_msg',last_indexdtm='$dt' WHERE sku='$skuid' AND prod_process_status='Edit' ");
            }
        }

        echo 'success';
        exit;
    }

    function solar_deletedprodindexing_count() {
        if (@$_GET['indx_status'] == 'Completed') {
            $qr = $this->db->query("SELECT sql_id FROM solar_indexing  WHERE (indexing_status='Completed') AND prod_process_status='Delete' GROUP BY sku ");
        } else {
            $qr = $this->db->query("SELECT sql_id FROM solar_indexing WHERE (indexing_status='Pending') AND prod_process_status='Delete' GROUP BY sku ");
        }




        return $qr->num_rows();
    }

    function select_solar_deletedindexing($limit, $start) {
        if (@$_GET['indx_status'] == 'Completed') {
            $indx_sts = 'Completed';
        } else {
            $indx_sts = 'Pending';
        }

        $qr = $this->db->query("SELECT * FROM solar_indexing WHERE (indexing_status='" . $indx_sts . "') AND prod_process_status='Delete'   ORDER BY sql_id DESC LIMIT " . $start . ", " . $limit . "");


        return $qr;
    }

    function deletesolr_indesing() {
        set_time_limit(0);
        $sku_ids = $this->input->post('prod_sku');
        $skuidsarr = array();

        if (base_url() == 'https://www.moonboy.in/') {
            $solr_colection = SOLR_CORE_NAME;
        } else {
            $solr_colection = 'mycollection4_offline';
        }

        foreach ($sku_ids as $ky => $val) {

            //$curl_dlt= SOLR_BASE_URL."".$solr_colection."/update?commit=true -H 'Content-Type: text/xml' --data-binary '<delete><Sku>".$val."</Sku></delete>'";

            $curl_dlt = SOLR_BASE_URL . "" . $solr_colection . "/update?commit=true%20-H%20%27'Content-Type:%20text/xml%27%20--data-binary%20%27<delete><Sku>" . $val . "</Sku></delete>%27";


            $curl2 = curl_init($curl_dlt);
            curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($curl2);
            $data2 = json_decode($output, true);

            if ($data2['responseHeader']['status'] == 0) {
                $dt = date('Y-m-d H:i:s');
                $this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt' WHERE sku='$val' AND prod_process_status='Delete' ");
            }
        }

        echo 'success';
        exit;
    }

    function solr_search_log_count() {
        $query = $this->db->query("SELECT * FROM `solr_search_log`");

        return $query->num_rows();
    }

    function select_solr_search_log($limit, $start) {
        $query = $this->db->query("SELECT * FROM `solr_search_log` LIMIT " . $start . ", " . $limit . " ");

        return $query;
    }

    function dltsolr_logsingle() {
        $logsql_id = $this->input->post("logsql_id");
        $this->db->query("DELETE FROM solr_search_log WHERE logsql_id ='$logsql_id' ");
    }

    function dltselected_solr_log() {
        $logsql_id = $this->input->post("selected_catg_id");
        $logsql_id = implode(",", $logsql_id);
        //print_r($logsql_id);exit;
        $this->db->query("DELETE FROM solr_search_log WHERE logsql_id in ($logsql_id) ");
    }

}

?>