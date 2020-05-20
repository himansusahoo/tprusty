<?php

class Manage_solr_index extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param  : 
     * @desc   : used to create and update solr index
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function manage_index() {
        set_time_limit(0);
        //fetch newly added products
        $condition = " AND b.indexing_status='Pending' AND b.prod_process_status='Add' AND lower(a.seller_status)='active' AND lower(a.status)='enabled'";
        //$condition = " AND b.indexing_status='Completed' AND b.prod_process_status='Add'";

        $new_prod_data = $this->_get_index_data_mysql($condition);
        //pma($new_prod_data);
        $operation = 'Add';
        $chunk = 25;
        if (count($new_prod_data) > $chunk) {
            $chunk_prod_data = array_chunk($new_prod_data, $chunk);
            foreach ($chunk_prod_data as $chunks) {
                $this->_process_add_update_index($chunks, $operation);
                sleep(5);
            }
        } else {
            $this->_process_add_update_index($new_prod_data, $operation);
        }

        //fetch only editd products
        $condition = " AND b.indexing_status='Pending' AND b.prod_process_status='Edit' AND lower(a.seller_status)='active' AND lower(a.status)='enabled'";
        //$condition = " AND b.indexing_status='Completed' AND b.prod_process_status='Edit'";
        $edited_prod_data = $this->_get_index_data_mysql($condition);
        //pma($edited_prod_data);
        $operation = 'Edit';
        if (count($edited_prod_data) > $chunk) {
            $chunk_edit_data = array_chunk($edited_prod_data, $chunk);
            foreach ($chunk_edit_data as $chunks) {
                $this->_process_add_update_index($chunks, $operation);
                sleep(5);
            }
        } else {
            $this->_process_add_update_index($edited_prod_data, $operation);
        }

        //manage delted product index        
        $condition = " AND indexing_status='Pending' AND prod_process_status='Delete'";
        //$condition = " AND indexing_status='Completed' AND prod_process_status='Delete'";
        $operation = 'Delete';
        $deleted_prod_data = $this->_get_index_data_mysql($condition, $operation);
        //pma($deleted_prod_data);
        if (count($deleted_prod_data) > $chunk) {
            $chunk_delete_data = array_chunk($deleted_prod_data, $chunk);
            foreach ($chunk_delete_data as $chunks) {
                $this->_process_deleted_prod_index($chunks, $operation);
                sleep(5);
            }
        } else {
            $this->_process_deleted_prod_index($deleted_prod_data, $operation);
        }
    }

    /**
     * @param  : 
     * @desc   : process and prepare data to create solr index
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function _process_add_update_index($db_data, $operation) {

        if (count($db_data) > 0) {
            $data = array(
                "add" => array(
                    "doc" => array(),
                    "commitWithin" => 300,
                ),
            );
            $counter = 0;
            foreach ($db_data as $keys => $res_prod) {
                $data['add']['doc'] = array(
                    "Title" => stripslashes($res_prod['name']),
                    "Category_Lvl1" => stripslashes($res_prod['lvlmain_name']),
                    "Category_Lvl2" => stripslashes($res_prod['lvl1_name']),
                    "Category_Lvl3" => stripslashes($res_prod['lvl2_name']),
                    "Category_Lvl1_Id" => $res_prod['lvlmain'],
                    "Category_Lvl2_Id" => $res_prod['lvl1'],
                    "Category_Lvl3_Id" => $res_prod['lvl2'],
                    "Sku" => $res_prod['sku'],
                    "Product_Id" => $res_prod['product_id'],
                    "Seller_Name" => stripslashes($res_prod['business_name']),
                    "Catalog_Image" => $res_prod['imag'],
                    "Mrp" => $res_prod['mrp'],
                    "Price" => $res_prod['price'],
                    "Special_Price" => $res_prod['special_price'],
                    "status" => $res_prod['status'],
                    "quantity" => $res_prod['quantity'],
                    "seller_status" => $res_prod['seller_status'],
                    "prod_status" => $res_prod['prod_status'],
                );
                //fetch seller product attribute
                $skuid = $res_prod['sku'];
                $query = "SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' GROUP BY attr_id";
                $qrattr_sku = $this->db->query($query)->result_array();
                $attrb_combn = array();
                if (count($qrattr_sku) > 0) {
                    foreach ($qrattr_sku as $res_atrbfldlbl) {
                        $attrb_id = $res_atrbfldlbl['attr_id'];
                        $query = "SELECT attribute_field_name FROM attribute_real WHERE attribute_id='$attrb_id' GROUP BY attribute_id ";
                        $result = $this->db->query($query)->row();
                        $attrbchk_val[] = "'" . str_replace("&", '', str_replace("'", '', $result->attribute_field_name)) . "'";
                    }

                    $attrbchk_valstrng = implode(',', $attrbchk_val);
                    $model_num = '';
                    $query = "SELECT distinct attrb_name,solr_filed_nm FROM solr_product_attribute  WHERE attrb_name IN ($attrbchk_valstrng)";
                    $qr_attrbfld = $this->db->query($query)->result_array();

                    $arr_condition = '';

                    $attrb_ky = array();
                    $attrb_vl = array();
                    $attrb_combn = array();

                    if (count($qr_attrbfld) > 0) {
                        foreach ($qr_attrbfld as $res_prodattarrfld) {
                            $attrb_realnfldame = trim($res_prodattarrfld['attrb_name']);
                            $query = "SELECT a.attr_value 
                                FROM seller_product_attribute_value a
                                LEFT JOIN attribute_real b ON a.attr_id=b.attribute_id
                                WHERE a.sku='$skuid'
                                AND b.attribute_field_name='$attrb_realnfldame' 
                                GROUP BY a.attr_id";
                            $qrattr_sku = $this->db->query($query)->row();
                            if (isset($qrattr_sku->attr_value)) {
                                $attrb_vl[] = $qrattr_sku->attr_value;
                            }
                            $attrb_ky[] = $res_prodattarrfld['solr_filed_nm'];
                        }
                    }
                    if (is_array($attrb_ky) && is_array($attrb_vl) && count($attrb_ky) == count($attrb_vl)) {
                        $attrb_combn = array_combine($attrb_ky, $attrb_vl);
                    } else {
                        // if some elements dont exists, "add" them...
                        if (count($attrb_ky) != count($attrb_vl)) {
                            foreach ($attrb_ky as $key => $value) {
                                if (!isset($attrb_vl[$key])) {
                                    $attrb_vl[$key] = '';
                                }
                            }
                        }
                        $attrb_combn = array_combine($attrb_ky, $attrb_vl);
                    }
                } // attribute check condition end

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
                if ($operation == 'Edit' && isset($res_prod['sku']) && $res_prod['sku'] != '') {
                    $sku = $res_prod['sku'];
                    $solr_cond = "Sku:$sku";
                    $this->_delete_one_solr_index($solr_cond);
                }
                $this->_create_index($data, $operation);
                $counter++;
                //pma($data);
                //pma("$counter index $operation",1);
            }//main loop
            //pma("$counter index $operation");
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _process_deleted_prod_index($result, $operation) {
        $loop = 1;
        foreach ($result as $key => $res_prod) {
            $sku = $res_prod['sku'];
            $solr_cond = "Sku:$sku";
            $this->_delete_one_solr_index($solr_cond, $sku);
            $loop++;
        }
        //pma("$loop index deleted.");
    }

    /**
     * @param  : 
     * @desc   : create new index in solr
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _create_index($data, $prod_proc_sts = 'Add') {
        if (isset($data['add']['doc']) && count($data['add']['doc']) > 0) {
            global $create_curl;
            if (!$create_curl) {
                $create_curl = curl_init(SOLR_BASE_URL . SOLR_CORE_NAME . "/update?wt=json&spellcheck=true&spellcheck.build=true");
            }

            $data_string = json_encode($data);
            curl_setopt($create_curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($create_curl, CURLOPT_POST, TRUE);
            curl_setopt($create_curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($create_curl, CURLOPT_POSTFIELDS, $data_string);
            $response = curl_exec($create_curl);
            $data2 = json_decode($response, true);
            $skuid = $data['add']['doc']['Sku'];
            $error_msg = (isset($data2['error']['msg']) && $data2['error']['msg'] != '') ? $data2['error']['msg'] : '';
            $this->_update_index_status($data2['responseHeader']['status'], $skuid, $prod_proc_sts, $error_msg);
        }
    }

    /**
     * @param  : 
     * @desc   :fetch index data from mysql as per the indexing_status= and prod_process_status;
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _get_index_data_mysql($condition, $operation_type = '') {
        if ($operation_type == 'Delete') {
            $query = "select sku from solar_indexing where 1=1 $condition";
            //pma($query);
        } else {
            $query = "select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,a.lvlmain_name,a.brand,
                a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id,a.imag,a.mrp,a.price,a.special_price,
                a.special_pric_from_dt,a.special_pric_to_dt,a.lvlmain,a.lvl1,a.lvl2,a.status,a.quantity,a.seller_status,a.prod_status,
                sai.business_name
                FROM cornjob_productsearch a 
                LEFT JOIN solar_indexing b ON a.sku=b.sku  
                LEFT JOIN seller_account_information sai on sai.seller_id=a.seller_id
                WHERE 1=1
                $condition                                     
                group by a.sku
				limit 25
                ";
            //pma($query);
        }

        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * @param  : 
     * @desc   :delete all solr index at one go
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function delete_all_index() {
        $curl_url = SOLR_BASE_URL . SOLR_CORE_NAME . "/update?commit=true&stream.body=<delete><query>*:*</query></delete>";
        $curl = curl_init($curl_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        var_dump($response);
    }

    /**
     * @param  : 
     * @desc   : fetch all solr indexs
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_all_solr_index() {
        $curl_query = SOLR_BASE_URL . SOLR_CORE_NAME . "/select?indent=on&q=*:*&wt=json";
        $curl_init = curl_init($curl_query);
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl_init);
        $data = json_decode($output, true);
        return $data;
    }

    /**
     * @param  : 
     * @desc   : delete one single solr index
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _delete_one_solr_index($condition, $sku) {
        $curl_query = SOLR_BASE_URL . SOLR_CORE_NAME . "update?commit=true&stream.body=<delete><query>$condition</query></delete>";
        $curl_init = curl_init($curl_query);
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl_init);
        $response = json_decode($response, true);
        $error_msg = (isset($response['error']['msg']) && $response['error']['msg'] != '') ? $response['error']['msg'] : '';
        if ($error_msg == '') {
            $status = 0;
        }
        $this->_update_index_status($status, $sku, 'Delete', $error_msg);
    }

    /**
     * @param  : 
     * @desc   :update solr index add/edit/delete status in mysql db
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _update_index_status($status, $skuid, $prod_proc_sts, $err_msg) {
        $today = date('Y-m-d H:i:s');
        if ($status == 0) {
            $this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$today',error_msg='' WHERE sku='$skuid' AND prod_process_status='$prod_proc_sts' ");
        } else {
            $err_msg = str_replace("'", '', $data2['error']['msg']);
            $this->db->query("UPDATE solar_indexing SET indexing_status='Pending', error_msg='$err_msg' ,last_indexdtm='$today' WHERE sku='$skuid' AND prod_process_status='$prod_proc_sts' ");
        }
    }

}
