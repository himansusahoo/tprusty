<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkporductupload_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->model('PHPExcel/Phpexcel_iofactory');
    }

    function select_catgnm($catg_id) {
        $qr = $this->db->query("SELECT category_name FROM category_indexing WHERE category_id='$catg_id' ");

        return $qr->row()->category_name;
    }

    function getattributeset($attr_menuwise='') {
        $att_id_string = explode(',', $attr_menuwise);
        //print_r($att_id_string);exit;
        $query = $this->db->query("SELECT * FROM attribute_group WHERE cate_attributelink!='' ");
        $att_array = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $cate_attribute) {
                $arr_attlink = unserialize($cate_attribute['cate_attributelink']);
                //print_r($arr_attlink);exit;
                if (in_array($attr_menuwise, $arr_attlink)) {
                    $att_array[] = $cate_attribute['attribute_group_id'];
                    //print_r($att_array);exit;
                }
                //else{echo "hii";exit;}
            }
            if (count($att_array) > 0) {
                $att_id_string1 = implode(',', $att_array);
                $query1 = $this->db->query("SELECT * FROM attribute_group WHERE attribute_group_id IN ($att_id_string1)");
                $row = $query1->num_rows();
                //echo $row; exit;
                return $query1;
            }
        } else {
            echo '1';
            exit;
        }
    }

    /* function getattributeset()
      {
      $query = $this->db->query("SELECT * FROM attribute_group");
      return $query;
      } */

    function insert_excelsheetlog($cur_dt, $exl_filename, $seller_id, $attr_group_id, $catg_id) {
        $data = array(
            'excelfile_name' => $exl_filename,
            'gen_dt' => $cur_dt,
            'seller_id' => $seller_id,
            'attribute_set' => $attr_group_id,
            'category_id' => $catg_id
        );

        $this->db->insert('bulkprod_templatelog', $data);
    }

    function get_seller_product_id($table, $field) {
        $query = $this->db->query("SELECT MAX($field) AS `maxid` FROM " . $table);
        $maxId = $query->row()->maxid;
        $id = $maxId + 1;
        return $id;
    }

    function get_maximum_id($table, $field) {
        $query = $this->db->query("SELECT MAX($field) AS `maxid` FROM " . $table);
        $maxId = $query->row()->maxid;
        $id = $maxId + 1;
        return $id;
    }

    function validbeforeinsert_bulkupload($excl_filename) {
        set_time_limit(0);
        $rowsdata = array();

        $seller_id = $this->input->post('hdntxt_sellerid');
        $attrbset_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' AND status='Active' ");


        //if($excl_filename==$dbsexcel_filename)
        if ($attrbset_query->num_rows() > 0) {

            $attrbset_res = $attrbset_query->row();
            $dbsexcel_filename = $attrbset_res->excelfile_name;


            $inputFileName = './bulkproduct_excel/' . $excl_filename;

            $inputFileType = Phpexcel_iofactory::identify($inputFileName);
            $objReader = Phpexcel_iofactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);

            //$objPHPExcel = Phpexcel_iofactory::load($inputFileName);


            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel
            //echo $arrayCount; exit;
            $valid_rows = 0;
            $invalid_rows = 0;

            for ($i = 3; $i <= $arrayCount; $i++) {


                //---------------------------------------Seller Product  Data Insert Start--------------------------------------------------------- 		


                $valid_sku = trim($allDataInSheet[$i]['D']);
                $valid_prodname = trim($allDataInSheet[$i]['E']);
                $valid_proddecrp = trim($allDataInSheet[$i]['F']);
                $valid_mrp = trim($allDataInSheet[$i]['G']);
                $valid_sellingprice = trim($allDataInSheet[$i]['H']);
                $valid_quantity = trim($allDataInSheet[$i]['L']);
                $valid_tax = trim($allDataInSheet[$i]['M']);
                $valid_weight = trim($allDataInSheet[$i]['N']);

                $valid_imageurl1 = trim($allDataInSheet[$i]['O']);
                $valid_imageurl2 = trim($allDataInSheet[$i]['P']);
                $valid_imageurl3 = trim($allDataInSheet[$i]['Q']);
                $valid_imageurl4 = trim($allDataInSheet[$i]['R']);
                $valid_imageurl5 = trim($allDataInSheet[$i]['S']);

                if ($valid_imageurl1 == '' && $valid_imageurl2 == '' && $valid_imageurl3 == '' && $valid_imageurl4 == '' && $valid_imageurl5 == '') {
                    $valid_imagecell = '';
                } else {
                    $valid_imagecell = "Image URL Exist in any one cell";
                }


                $valid_shipfeetype = trim($allDataInSheet[$i]['T']);
                $valid_shipfeeamount = trim($allDataInSheet[$i]['U']);
                $valid_status = trim($allDataInSheet[$i]['V']);

                $valid_prodhlght1 = trim($allDataInSheet[$i]['W']);
                $valid_prodhlght2 = trim($allDataInSheet[$i]['X']);
                $valid_prodhlght3 = trim($allDataInSheet[$i]['Y']);
                $valid_prodhlght4 = trim($allDataInSheet[$i]['Z']);
                $valid_prodhlght5 = trim($allDataInSheet[$i]['AA']);

                if ($valid_prodhlght1 == '' && $valid_prodhlght2 == '' && $valid_prodhlght3 == '' && $valid_prodhlght4 == '' && $valid_prodhlght5 == '') {
                    $valid_prodhlighcell = '';
                } else {
                    $valid_prodhlighcell = "Product Highlight Exist in any one cell";
                }

                //$valid_rows=0;
                //$invalid_reows=0;

                if ($valid_sku == '' || $valid_prodname == '' || $valid_proddecrp == '' || $valid_mrp == '' || $valid_sellingprice == '' || $valid_quantity == '' || $valid_tax == '' || $valid_weight == '' || $valid_imagecell == '' || $valid_shipfeetype == '' || $valid_shipfeeamount == '' || $valid_status == '' || $valid_prodhlighcell == '') {
                    $invalid_rows = $invalid_rows + 1;
                } else {
                    $valid_rows = $valid_rows + 1;
                }
            } // main for loop end

            $records_array[] = $invalid_rows;
            $records_array[] = $valid_rows;

            return $records_array;
        }
        //---------------------------------checking of validation of excel sheet field end-----------------------------				
        else {
            $records_array[] = "File has expired";

            return $records_array;
        }
    }

    function manual_uploadbulkprodmultiseller() {
        $sellerid_arr = array('330');

        foreach ($sellerid_arr as $keysellerid => $valsellerid) {
            $query_excelflname = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE seller_id='$valsellerid' AND downlaod_parentid='0' AND status='Active' AND blk_tempid='369'  ");

            foreach ($query_excelflname->result_array() as $res_excelflname) {
                //echo $res_excelflname['excelfile_name'].','.$res_excelflname['blk_tempid'];echo '<br>';

                $this->manualvalidwithinsert_bulkupload($res_excelflname['excelfile_name'], $valsellerid);
                $this->insert_bulkuploadafterconf($res_excelflname['blk_tempid']);
            }
        } // sellerid foreach end 
    }

    function manualvalidwithinsert_bulkupload($excl_filename, $valsellerid) {
        set_time_limit(0);

        $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        $rowsdata = array();

        
        $dt = date('Y-m-d H:i:s');

        $parent_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' AND status='Active' AND downlaod_parentid > 0 ");

        if ($parent_query->num_rows() > 0) {
            $rw_parentfileid = $parent_query->row();
            $parent_downlaodfileid = $rw_parentfileid->downlaod_parentid;

            if ($parent_downlaodfileid > 0) {
                $parent_filenamequery = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE blk_tempid='$parent_downlaodfileid' AND (status='Expired' OR  status='Active' )");
                //$excl_filename=$rw_parentfileid->excelfile_name; 
                //$this->db->query("UPDATE bulkprod_templatelog SET status='Active' WHERE  blk_tempid='$parent_downlaodfileid'");
                $masteruploadprod_uid = $parent_filenamequery->row()->blk_tempid;
                $this->db->query("DELETE FROM  bulkproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND qc_status='Failed' ");

                $this->db->query("DELETE FROM  bulkproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND (upload_status='Pending' OR upload_status='Failed') ");
            }
        } else {
            $parent_downlaodfileid = 0;
            //$excl_filename=$excl_filename;	
        }

        $maximumupload_id = $this->get_maximum_id('bulkprod_templatelog', 'upload_id');

        if ($parent_downlaodfileid > 0) {

            $upload_sequenceid = $parent_downlaodfileid;
        } else {
            $upload_sequenceid = 0;
        }
        $upload_dtime = $dt;



        //$seller_id=$this->input->post('hdntxt_sellerid');
        $seller_id = $valsellerid;
        $attrbset_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' AND seller_id='$seller_id' AND status='Active' ");



        if ($attrbset_query->num_rows() == 0) {
            $excl_filename = $excl_filename;

            $output_dir = "./bulkproduct_excel/";
            $filePath = $output_dir . $excl_filename;
            unlink($filePath);
            echo "<span style='text-align:center; color:#F00' > <img src=" . base_url() . 'images/error.png' . ">Invalid File </span>";
            exit;
        }

        if ($attrbset_query->num_rows() > 0) {

            $attrbset_res = $attrbset_query->row();
            $dbsexcel_filename = $excl_filename;

            if ($parent_downlaodfileid > 0) {
                $uploadprod_uid = $masteruploadprod_uid;
            } else {
                $uploadprod_uid = $attrbset_query->row()->blk_tempid;
            }
            $this->db->query("UPDATE bulkprod_templatelog SET upload_id='$maximumupload_id', upload_sequenceid='$upload_sequenceid', upload_dtime='$upload_dtime' WHERE  blk_tempid='$attrbset_res->blk_tempid' ");

            $inputFileName = './bulkproduct_excel/' . $excl_filename;

            $inputFileType = Phpexcel_iofactory::identify($inputFileName);
            $objReader = Phpexcel_iofactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);

            //$objPHPExcel = Phpexcel_iofactory::load($inputFileName);


            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel
            //echo $arrayCount; exit;
            $valid_rows = 0;
            $invalid_rows = 0;

            //$seller_id=$this->input->post('hdntxt_sellerid');
            $attrbset_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' ");
            $attrbset_res = $attrbset_query->row();

            $attrbset_id = $attrbset_res->attribute_set;
            $category_id = $attrbset_res->category_id;

            // attribute id & value list start

            $attr_heading_result = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attrbset_id'");

            $attr_fld_name = array();
            $attr_id = array();

            foreach ($attr_heading_result->result_array() as $attr_heading_row) {

                $attr_hedingid = $attr_heading_row['attribute_heading_id'];

                $query_attrbreal = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_hedingid ");
                $field_result = $query_attrbreal->result_array();

                foreach ($field_result as $attr_fld_row) {
                    $attr_fld_name[] = $attr_fld_row['attribute_field_name'];
                    $attr_id[] = $attr_fld_row['attribute_id'];
                } // attribute field name inner forloop end
            }

            // attribute heading name inner forloop end
            // attribute id & value list end
            //Dynamically access of column address from excel sheet  start

            $attrb_countforexlcoulmn = count($attr_id) + 1;
            $attrb_exlcoulmnname = array();
            $sheet = $objPHPExcel->getSheet(0);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $highestColumn++;
            $c = 31;
            $row = '2';

            for ($col = 1; $col != $attrb_countforexlcoulmn; $col++) {

                $cell = $sheet->getCellByColumnAndRow($c, $row);
                $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
                $attrb_exlcoulmnname[] = $cell->getColumn();
                // echo $cell->getColumn().'<br>';
                $c++;
            }

            //Dynamically access of column address from excel sheet  end

            $sl = 1;
            $qcfailed_resason = array();
            for ($i = 3; $i <= $arrayCount; $i++) {

                $newattr_id = array();
                $newattr_value = array();
                $newattr_fld_name = array();
                $attr_id_n_value = array();
                $attr_id_n_value_length = 0;
                $attr_value = array();
                $qcfailed_resason = array();
                $data_prodinfo = array();


                //---------------------------------------Seller Product  Data Insert Start--------------------------------------------------------- 		

                if (trim($allDataInSheet[$i]['D']) != '') {
                    $moonboy_slno = "MB" . $uploadprod_uid . $sl;
                    $valid_sku = trim($allDataInSheet[$i]['D']);
                    $valid_prodname = trim($allDataInSheet[$i]['E']);
                    $valid_proddecrp = trim($allDataInSheet[$i]['F']);
                    $valid_mrp = trim($allDataInSheet[$i]['G']);
                    $valid_sellingprice = trim($allDataInSheet[$i]['H']);
                    $valid_quantity = trim($allDataInSheet[$i]['L']);
                    $valid_tax = trim($allDataInSheet[$i]['M']);
                    $valid_weight = trim($allDataInSheet[$i]['N']);

                    $valid_imageurl1 = trim($allDataInSheet[$i]['O']);
                    $valid_imageurl2 = trim($allDataInSheet[$i]['P']);
                    $valid_imageurl3 = trim($allDataInSheet[$i]['Q']);
                    $valid_imageurl4 = trim($allDataInSheet[$i]['R']);
                    $valid_imageurl5 = trim($allDataInSheet[$i]['S']);



                    $valid_shipfeetype = trim($allDataInSheet[$i]['T']);
                    $valid_shipfeeamount = trim($allDataInSheet[$i]['U']);
                    $valid_status = trim($allDataInSheet[$i]['V']);

                    $valid_prodhlght1 = trim($allDataInSheet[$i]['W']);
                    $valid_prodhlght2 = trim($allDataInSheet[$i]['X']);
                    $valid_prodhlght3 = trim($allDataInSheet[$i]['Y']);
                    $valid_prodhlght4 = trim($allDataInSheet[$i]['Z']);
                    $valid_prodhlght5 = trim($allDataInSheet[$i]['AA']);

                    $valid_specialprice = trim($allDataInSheet[$i]['I']);
                    $valid_specialprc_fromdate = trim($allDataInSheet[$i]['J']);
                    $valid_specialprice_todate = trim($allDataInSheet[$i]['K']);

                    $valid_countrymfg = trim($allDataInSheet[$i]['AB']);
                    $valid_metatitle = trim($allDataInSheet[$i]['AC']);
                    $valid_metakeyword = trim($allDataInSheet[$i]['AD']);
                    $valid_metadescrp = trim($allDataInSheet[$i]['AE']);

                    if ($valid_sku == '') {
                        array_push($qcfailed_resason, "SKU Blank");
                    }

                    if ($valid_prodname == '') {
                        array_push($qcfailed_resason, "Product Name Blank");
                    }

                    if ($valid_proddecrp == '') {
                        array_push($qcfailed_resason, "Decription Blank");
                    }

                    if ($valid_mrp == '') {
                        array_push($qcfailed_resason, "MRP Blank");
                    }

                    /* if($valid_mrp!='')
                      {
                      //$mrp_vald=var_dump($valid_mrp !== (int)$valid_mrp);
                      if($valid_mrp !== (int)$valid_mrp)
                      {array_push($qcfailed_resason,"Invalid MRP");}

                      if($valid_sellingprice!='' && $valid_sellingprice>$valid_mrp)
                      {array_push($qcfailed_resason,"Selling Price is greater than MRP");}

                      } */

                    if ($valid_sellingprice == '') {
                        array_push($qcfailed_resason, "Selling Price Blank");
                    }

                    /* if($valid_sellingprice!='')
                      {
                      //$sel_pricevld=var_dump($valid_sellingprice !== (int)$valid_sellingprice);
                      if($valid_sellingprice !== (int)$valid_sellingprice)
                      {array_push($qcfailed_resason,"Invalid Selling Price");}

                      if($valid_specialprice!='' && $valid_specialprice>$valid_sellingprice)
                      {array_push($qcfailed_resason,"Special Price is greater than Selling Price");}


                      } */
                    $date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
                    $tm_arr = array();
                    $tm_arrreverse = array();
                    $tm_arrreverse_strg = "";
                    if ($valid_specialprc_fromdate != '') {
                        //$splprice_frdtcreate=date_create($valid_specialprc_fromdate,timezone_open("Asia/Kolkata"));
                        //$splprice_fr_dt=date_format($splprice_frdtcreate,'y-d-m');

                        $tm_arr = explode('-', $valid_specialprc_fromdate);
                        $tm_arrreverse = array_reverse($tm_arr);
                        $tm_arrreverse_strg = implode('-', $tm_arrreverse);

                        $splprice_frdtcreate = date_create($tm_arrreverse_strg, timezone_open("Asia/Kolkata"));
                        $splprice_fr_dt = date_format($splprice_frdtcreate, 'Y-d-m');


                        if (!preg_match($date_regex, $splprice_fr_dt)) { //to check the date
                            //$value=$valid_specialprc_fromdate->getFormattedValue();
                            array_push($qcfailed_resason, "Special price from date is invalid");
                            $splprice_fromdatestatus = "wrong";
                        } else {
                            $splprice_fromdatestatus = "ok";
                        }
                    } else {
                        $splprice_fromdatestatus = '';
                    }

                    $tm_arr1 = array();
                    $tm_arrreverse1 = array();
                    $tm_arrreverse_strg1 = "";
                    if ($valid_specialprice_todate != '') {
                        $tm_arr1 = explode('-', $valid_specialprice_todate);
                        $tm_arrreverse1 = array_reverse($tm_arr);
                        $tm_arrreverse_strg1 = implode('-', $tm_arrreverse1);

                        $splprice_todtcreate = date_create($tm_arrreverse_strg1);
                        $splprice_to_dt = date_format($splprice_todtcreate, 'Y-m-d');

                        if (!preg_match($date_regex, $splprice_to_dt)) { //to check the date
                            //$value=$valid_specialprice_todate->getFormattedValue();
                            array_push($qcfailed_resason, "Special price to date is invalid");
                            $splprice_toatestatus = "wrong";
                        } else {
                            $splprice_toatestatus = "ok";
                        }
                    } else {
                        $splprice_fromdatestatus = '';
                    }

                    if ($valid_specialprice != '' & $splprice_fromdatestatus == "ok" && $splprice_toatestatus == "ok") {
                        //$special_pricevld=var_dump($valid_specialprice !== (int)$valid_specialprice);
                        /* if($valid_specialprice !== (int)$valid_specialprice)
                          {array_push($qcfailed_resason,"Invalid Special Price");} */

                        if ($splprice_fr_dt > $splprice_to_dt) {
                            array_push($qcfailed_resason, "Special Date Range is invalid");
                        }
                    }

                    if ($valid_quantity == '') {
                        array_push($qcfailed_resason, "Quantity Blank");
                    }

                    /* if($valid_quantity!='')
                      {//$qnt_vald=var_dump($valid_quantity !== (int)$valid_quantity);
                      if($valid_quantity !== (int)$valid_quantity)
                      {array_push($qcfailed_resason,"Invalid Quantity Value");}
                      } */

                    if ($valid_tax == '') {
                        array_push($qcfailed_resason, "VAT/CST Blank");
                    }

                    /* if($valid_tax!='')
                      {
                      //$tax_vald=var_dump($valid_tax !== (int)$valid_tax);
                      if($valid_tax !== (int)$valid_tax)
                      {array_push($qcfailed_resason,"Invalid Tax Value");}
                      } */

                    if ($valid_weight == '') {
                        array_push($qcfailed_resason, "Wight Blank");
                    }

                    /* if($valid_weight!='')
                      {
                      //$weight_vald=var_dump($valid_weight !== (int)$valid_weight);
                      if($valid_weight !== (int)$valid_weight)
                      {array_push($qcfailed_resason,"Invalid Weight Value");}
                      } */

                    if ($valid_prodhlght1 == '' && $valid_prodhlght2 == '' && $valid_prodhlght3 == '' && $valid_prodhlght4 == '' && $valid_prodhlght5 == '') { //$valid_prodhlighcell='';
                        array_push($qcfailed_resason, "Product Highlights Blank");
                    }
                    //else
                    //{$valid_prodhlighcell="Product Highlight Exist in any one cell"; }


                    if ($valid_imageurl1 == '' && $valid_imageurl2 == '' && $valid_imageurl3 == '' && $valid_imageurl4 == '' && $valid_imageurl5 == '') {
                        $valid_imagecell = '';
                        array_push($qcfailed_resason, "Image URL Blank");
                    }
                    //else
                    //			{$valid_imagecell="Image URL Exist in any one cell";}
                    //$valid_rows=0;
                    //$invalid_reows=0;
                    //
					//					if($valid_sku=='' || $valid_prodname=='' || $valid_proddecrp=='' || $valid_mrp=='' || $valid_sellingprice=='' || $valid_quantity=='' || $valid_tax=='' || $valid_weight=='' || $valid_imagecell=='' || $valid_shipfeetype=='' || $valid_shipfeeamount=='' || $valid_status=='' || $valid_prodhlighcell=='')

                    if (count($qcfailed_resason) > 0) {
                        $invalid_rows = $invalid_rows + 1;
                        $qc_status = "Failed";
                    } else {
                        $qc_status = "Passed";
                        $valid_rows = $valid_rows + 1;
                    }



                    //----------------------------------------------Data Insert in bulkproductupload_log start---------------------------------------//

                    foreach ($attrb_exlcoulmnname as $katrb => $vattrbval) {

                        $attr_value[] = trim($allDataInSheet[$i][$vattrbval]);
                    }

                    $ctr_attrid = count($attr_id);
                    $incrattb = 0;

                    foreach ($attr_value as $keyattvl => $valattrvalue) {
                        if ($valattrvalue != '' && $incrattb < $ctr_attrid) {
                            $newattr_id[] = $attr_id[$incrattb];
                            $newattr_value[] = $valattrvalue;
                            $newattr_fld_name[] = $attr_fld_name[$incrattb];
                        }
                        $incrattb++;
                    }

                    $attr_id_n_value = array_combine($newattr_id, $newattr_value);

                    $attrid_n_valueserialz = serialize($attr_id_n_value);

                    //----------------------------------------------Data Insert in bulkproductupload_log end---------------------------------------//
                    $prodqc_status = '';
                    if (count($qcfailed_resason) > 0) {
                        $prodqc_status = serialize($qcfailed_resason);
                    } else {
                        $prodqc_status = '';
                    }

                    //if($valid_sku=='' && $valid_prodname=='' && $valid_proddecrp=='' && $valid_mrp=='' && $valid_sellingprice=='' && $valid_specialprice=='' && $valid_specialprc_fromdate=='' && $valid_specialprice_todate=='' && $valid_quantity=='' && $valid_tax=='' && $valid_weight=='' && $valid_imageurl1=='' && $valid_imageurl2=='' && $valid_imageurl3=='' && $valid_imageurl4=='' && $valid_imageurl5=='' && $valid_shipfeetype=='' && $valid_shipfeeamount=''&& $valid_status=='' &&  $valid_prodhlght1=='' && $valid_prodhlght2=='' && $valid_prodhlght3=='' && $valid_prodhlght4=='' && $valid_prodhlght5=='' && $valid_countrymfg=='' && $valid_metatitle=='' && $valid_metakeyword=='' && $valid_metadescrp=='')
//										{}
                    //else
                    //{
                    $data_prodinfo = array(
                        'uploadprod_uid' => $uploadprod_uid,
                        'moonboy_slno' => $moonboy_slno,
                        'qc_status' => $qc_status,
                        'qc_failedreason' => $prodqc_status,
                        'sku' => $valid_sku,
                        'prod_name' => $valid_prodname,
                        'descrp' => $valid_proddecrp,
                        'mrp' => $valid_mrp,
                        'sell_price' => $valid_sellingprice,
                        'special_price' => $valid_specialprice,
                        'splprice_fromdt' => $valid_specialprc_fromdate,
                        'splprice_todate' => $valid_specialprice_todate,
                        'quantity' => $valid_quantity,
                        'vat_cst' => $valid_tax,
                        'weight' => $valid_weight,
                        'image_url1' => $valid_imageurl1,
                        'image_url2' => $valid_imageurl2,
                        'image_url3' => $valid_imageurl3,
                        'image_url4' => $valid_imageurl4,
                        'image_url5' => $valid_imageurl5,
                        'shipfee_type' => $valid_shipfeetype,
                        'shipfee_amount' => $valid_shipfeeamount,
                        'status' => $valid_status,
                        'prod_highlt1' => $valid_prodhlght1,
                        'prod_highlt2' => $valid_prodhlght2,
                        'prod_highlt3' => $valid_prodhlght3,
                        'prod_highlt4' => $valid_prodhlght4,
                        'prod_highlt5' => $valid_prodhlght5,
                        'country_mafg' => $valid_countrymfg,
                        'meta_title' => $valid_metatitle,
                        'meta_keyword' => $valid_metakeyword,
                        'meta_descrp' => $valid_metadescrp,
                        'attrb_groupuid' => $attrbset_id,
                        'attrb_valueandid' => $attrid_n_valueserialz,
                        'upload_dtime' => $dt,
                        'upload_status' => 'Pending'
                    );

                    $this->db->insert('bulkproductupload_log', $data_prodinfo);
                    //}
                    $sl++;
                }
            } // main for loop end
            //$records_array[]=$invalid_rows;
            //$records_array[]=$valid_rows;
            //return 	$records_array;
            //echo $invalid_rows." "; echo  $sl;exit;

            /* if(($sl-1)==$invalid_rows)
              {
              $this->db->query("DELETE FROM bulkproductupload_log WHERE uploadprod_uid='$uploadprod_uid' ");

              $excl_filename=$excl_filename;

              $output_dir = "./bulkproduct_excel/";
              $filePath = $output_dir.$excl_filename;
              unlink($filePath);
              } */


            return $uploadprod_uid;
        }
        //---------------------------------checking of validation of excel sheet field end-----------------------------				
        else {

            //$records_array[]="File has expired";
            $file_staus = "Invalid File";

            // return $records_array;

            return $file_staus;
        }
    }

    function validwithinsert_bulkupload($excl_filename) {
        set_time_limit(0);
        //$this->db->trans_start();
        $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        $rowsdata = array();

        
        $dt = date('Y-m-d H:i:s');
        $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        $parent_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' AND status='Active' AND downlaod_parentid > 0 ");

        if ($parent_query->num_rows() > 0) {
            $rw_parentfileid = $parent_query->row();
            $parent_downlaodfileid = $rw_parentfileid->downlaod_parentid;

            if ($parent_downlaodfileid > 0) {
                $parent_filenamequery = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE blk_tempid='$parent_downlaodfileid' AND (status='Expired' OR  status='Active' )");
                //$excl_filename=$rw_parentfileid->excelfile_name; 
                //$this->db->query("UPDATE bulkprod_templatelog SET status='Active' WHERE  blk_tempid='$parent_downlaodfileid'");
                $masteruploadprod_uid = $parent_filenamequery->row()->blk_tempid;
                $this->db->query("DELETE FROM  bulkproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND qc_status='Failed' ");

                $this->db->query("DELETE FROM  bulkproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND (upload_status='Pending' OR upload_status='Failed') ");
            }
        } else {
            $parent_downlaodfileid = 0;
            //$excl_filename=$excl_filename;	
        }

        $maximumupload_id = $this->get_maximum_id('bulkprod_templatelog', 'upload_id');

        if ($parent_downlaodfileid > 0) {

            $upload_sequenceid = $parent_downlaodfileid;
        } else {
            $upload_sequenceid = 0;
        }
        $upload_dtime = $dt;



        $seller_id = $this->input->post('hdntxt_sellerid');

        $attrbset_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' AND seller_id='$seller_id' AND status='Active' ");



        if ($attrbset_query->num_rows() == 0) {
            $excl_filename = $excl_filename;

            $output_dir = "./bulkproduct_excel/";
            $filePath = $output_dir . $excl_filename;
            unlink($filePath);
            echo "<span style='text-align:center; color:#F00' > <img src=" . base_url() . 'images/error.png' . ">Invalid File </span>";
            exit;
        }

        if ($attrbset_query->num_rows() > 0) {

            $attrbset_res = $attrbset_query->row();
            $dbsexcel_filename = $excl_filename;

            if ($parent_downlaodfileid > 0) {
                $uploadprod_uid = $masteruploadprod_uid;
            } else {
                $uploadprod_uid = $attrbset_query->row()->blk_tempid;
            }
            $this->db->query("UPDATE bulkprod_templatelog SET upload_id='$maximumupload_id', upload_sequenceid='$upload_sequenceid', upload_dtime='$upload_dtime' WHERE  blk_tempid='$attrbset_res->blk_tempid' ");

            $inputFileName = './bulkproduct_excel/' . $excl_filename;

            $inputFileType = Phpexcel_iofactory::identify($inputFileName);
            $objReader = Phpexcel_iofactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);

            //$objPHPExcel = Phpexcel_iofactory::load($inputFileName);


            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel
            //echo $arrayCount; exit;
            $valid_rows = 0;
            $invalid_rows = 0;

            //$seller_id=$this->input->post('hdntxt_sellerid');
            $attrbset_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' ");
            $attrbset_res = $attrbset_query->row();

            $attrbset_id = $attrbset_res->attribute_set;
            $category_id = $attrbset_res->category_id;

            // attribute id & value list start

            $attr_heading_result = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attrbset_id'");

            $attr_fld_name = array();
            $attr_id = array();

            foreach ($attr_heading_result->result_array() as $attr_heading_row) {

                $attr_hedingid = $attr_heading_row['attribute_heading_id'];

                $query_attrbreal = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_hedingid ");
                $field_result = $query_attrbreal->result_array();

                foreach ($field_result as $attr_fld_row) {
                    $attr_fld_name[] = $attr_fld_row['attribute_field_name'];
                    $attr_id[] = $attr_fld_row['attribute_id'];
                } // attribute field name inner forloop end
            }

            // attribute heading name inner forloop end
            // attribute id & value list end
            //Dynamically access of column address from excel sheet  start

            $attrb_countforexlcoulmn = count($attr_id) + 1;
            $attrb_exlcoulmnname = array();
            $sheet = $objPHPExcel->getSheet(0);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $highestColumn++;
            $c = 31;
            $row = '2';

            for ($col = 1; $col != $attrb_countforexlcoulmn; $col++) {

                $cell = $sheet->getCellByColumnAndRow($c, $row);
                $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
                $attrb_exlcoulmnname[] = $cell->getColumn();
                // echo $cell->getColumn().'<br>';
                $c++;
            }

            //Dynamically access of column address from excel sheet  end

            $sl = 1;
            $qcfailed_resason = array();
            for ($i = 3; $i <= $arrayCount; $i++) {

                $newattr_id = array();
                $newattr_value = array();
                $newattr_fld_name = array();
                $attr_id_n_value = array();
                $attr_id_n_value_length = 0;
                $attr_value = array();
                $qcfailed_resason = array();
                $data_prodinfo = array();


                //---------------------------------------Seller Product  Data Insert Start--------------------------------------------------------- 		

                if (trim($allDataInSheet[$i]['D']) != '') {
                    $moonboy_slno = "MB" . $uploadprod_uid . $sl;
                    $valid_sku = trim($allDataInSheet[$i]['D']);
                    $valid_prodname = trim($allDataInSheet[$i]['E']);
                    $valid_proddecrp = trim($allDataInSheet[$i]['F']);
                    $valid_mrp = trim($allDataInSheet[$i]['G']);
                    $valid_sellingprice = trim($allDataInSheet[$i]['H']);
                    $valid_quantity = trim($allDataInSheet[$i]['L']);
                    $valid_tax = trim($allDataInSheet[$i]['M']);
                    $valid_weight = trim($allDataInSheet[$i]['N']);

                    $valid_imageurl1 = trim($allDataInSheet[$i]['O']);
                    $valid_imageurl2 = trim($allDataInSheet[$i]['P']);
                    $valid_imageurl3 = trim($allDataInSheet[$i]['Q']);
                    $valid_imageurl4 = trim($allDataInSheet[$i]['R']);
                    $valid_imageurl5 = trim($allDataInSheet[$i]['S']);



                    $valid_shipfeetype = trim($allDataInSheet[$i]['T']);
                    $valid_shipfeeamount = trim($allDataInSheet[$i]['U']);
                    $valid_status = trim($allDataInSheet[$i]['V']);

                    $valid_prodhlght1 = trim($allDataInSheet[$i]['W']);
                    $valid_prodhlght2 = trim($allDataInSheet[$i]['X']);
                    $valid_prodhlght3 = trim($allDataInSheet[$i]['Y']);
                    $valid_prodhlght4 = trim($allDataInSheet[$i]['Z']);
                    $valid_prodhlght5 = trim($allDataInSheet[$i]['AA']);

                    $valid_specialprice = trim($allDataInSheet[$i]['I']);
                    $valid_specialprc_fromdate = trim($allDataInSheet[$i]['J']);
                    $valid_specialprice_todate = trim($allDataInSheet[$i]['K']);

                    $valid_countrymfg = trim($allDataInSheet[$i]['AB']);
                    $valid_metatitle = trim($allDataInSheet[$i]['AC']);
                    $valid_metakeyword = trim($allDataInSheet[$i]['AD']);
                    $valid_metadescrp = trim($allDataInSheet[$i]['AE']);

                    if ($valid_sku == '') {
                        array_push($qcfailed_resason, "SKU Blank");
                    }

                    if ($valid_prodname == '') {
                        array_push($qcfailed_resason, "Product Name Blank");
                    }

                    if ($valid_proddecrp == '') {
                        array_push($qcfailed_resason, "Decription Blank");
                    }

                    if ($valid_mrp == '') {
                        array_push($qcfailed_resason, "MRP Blank");
                    }

                    /* if($valid_mrp!='')
                      {
                      //$mrp_vald=var_dump($valid_mrp !== (int)$valid_mrp);
                      if($valid_mrp !== (int)$valid_mrp)
                      {array_push($qcfailed_resason,"Invalid MRP");}

                      if($valid_sellingprice!='' && $valid_sellingprice>$valid_mrp)
                      {array_push($qcfailed_resason,"Selling Price is greater than MRP");}

                      } */

                    if ($valid_sellingprice == '') {
                        array_push($qcfailed_resason, "Selling Price Blank");
                    }

                    /* if($valid_sellingprice!='')
                      {
                      //$sel_pricevld=var_dump($valid_sellingprice !== (int)$valid_sellingprice);
                      if($valid_sellingprice !== (int)$valid_sellingprice)
                      {array_push($qcfailed_resason,"Invalid Selling Price");}

                      if($valid_specialprice!='' && $valid_specialprice>$valid_sellingprice)
                      {array_push($qcfailed_resason,"Special Price is greater than Selling Price");}


                      } */
                    $date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
                    $tm_arr = array();
                    $tm_arrreverse = array();
                    $tm_arrreverse_strg = "";
                    if ($valid_specialprc_fromdate != '') {


                        /* $tm_arr=explode('-',$valid_specialprc_fromdate);
                          $tm_arrreverse=array_reverse($tm_arr);
                          $tm_arrreverse_strg=implode('-',$tm_arrreverse);

                          $splprice_frdtcreate=date_create($tm_arrreverse_strg,timezone_open("Asia/Kolkata"));
                          $splprice_fr_dt=date_format($splprice_frdtcreate,'Y-d-m'); */


                        if (!preg_match($date_regex, $valid_specialprc_fromdate)) { //to check the date
                            //$value=$valid_specialprc_fromdate->getFormattedValue();
                            array_push($qcfailed_resason, "Special price from date is invalid");
                            $splprice_fromdatestatus = "wrong";
                        } else {
                            $splprice_fromdatestatus = "ok";
                        }
                    } else {
                        $splprice_fromdatestatus = '';
                    }

                    $tm_arr1 = array();
                    $tm_arrreverse1 = array();
                    $tm_arrreverse_strg1 = "";
                    if ($valid_specialprice_todate != '') {
                        /* $tm_arr1=explode('-',$valid_specialprice_todate);
                          $tm_arrreverse1=array_reverse($tm_arr);
                          $tm_arrreverse_strg1=implode('-',$tm_arrreverse1);

                          $splprice_todtcreate=date_create($tm_arrreverse_strg1);
                          $splprice_to_dt=date_format($splprice_todtcreate,'Y-m-d'); */

                        if (!preg_match($date_regex, $valid_specialprice_todate)) { //to check the date
                            //$value=$valid_specialprice_todate->getFormattedValue();
                            array_push($qcfailed_resason, "Special price to date is invalid");
                            $splprice_toatestatus = "wrong";
                        } else {
                            $splprice_toatestatus = "ok";
                        }
                    } else {
                        $splprice_fromdatestatus = '';
                    }

                    if ($valid_specialprice != '' & $splprice_fromdatestatus == "ok" && $splprice_toatestatus == "ok") {
                        //$special_pricevld=var_dump($valid_specialprice !== (int)$valid_specialprice);
                        /* if($valid_specialprice !== (int)$valid_specialprice)
                          {array_push($qcfailed_resason,"Invalid Special Price");} */

                        /* if($splprice_fr_dt > $splprice_to_dt)
                          {array_push($qcfailed_resason,"Special Date Range is invalid");} */
                    }

                    if ($valid_quantity == '') {
                        array_push($qcfailed_resason, "Quantity Blank");
                    }

                    /* if($valid_quantity!='')
                      {//$qnt_vald=var_dump($valid_quantity !== (int)$valid_quantity);
                      if($valid_quantity !== (int)$valid_quantity)
                      {array_push($qcfailed_resason,"Invalid Quantity Value");}
                      } */

                    if ($valid_tax == '') {
                        array_push($qcfailed_resason, "VAT/CST Blank");
                    }

                    /* if($valid_tax!='')
                      {
                      //$tax_vald=var_dump($valid_tax !== (int)$valid_tax);
                      if($valid_tax !== (int)$valid_tax)
                      {array_push($qcfailed_resason,"Invalid Tax Value");}
                      } */

                    if ($valid_weight == '') {
                        array_push($qcfailed_resason, "Wight Blank");
                    }

                    /* if($valid_weight!='')
                      {
                      //$weight_vald=var_dump($valid_weight !== (int)$valid_weight);
                      if($valid_weight !== (int)$valid_weight)
                      {array_push($qcfailed_resason,"Invalid Weight Value");}
                      } */

                    if ($valid_prodhlght1 == '' && $valid_prodhlght2 == '' && $valid_prodhlght3 == '' && $valid_prodhlght4 == '' && $valid_prodhlght5 == '') { //$valid_prodhlighcell='';
                        array_push($qcfailed_resason, "Product Highlights Blank");
                    }
                    //else
                    //{$valid_prodhlighcell="Product Highlight Exist in any one cell"; }


                    if ($valid_imageurl1 == '' && $valid_imageurl2 == '' && $valid_imageurl3 == '' && $valid_imageurl4 == '' && $valid_imageurl5 == '') {
                        $valid_imagecell = '';
                        array_push($qcfailed_resason, "Image URL Blank");
                    }
                    //else
                    //			{$valid_imagecell="Image URL Exist in any one cell";}
                    //$valid_rows=0;
                    //$invalid_reows=0;
                    //
					//					if($valid_sku=='' || $valid_prodname=='' || $valid_proddecrp=='' || $valid_mrp=='' || $valid_sellingprice=='' || $valid_quantity=='' || $valid_tax=='' || $valid_weight=='' || $valid_imagecell=='' || $valid_shipfeetype=='' || $valid_shipfeeamount=='' || $valid_status=='' || $valid_prodhlighcell=='')

                    if (count($qcfailed_resason) > 0) {
                        $invalid_rows = $invalid_rows + 1;
                        $qc_status = "Failed";
                    } else {
                        $qc_status = "Passed";
                        $valid_rows = $valid_rows + 1;
                    }



                    //----------------------------------------------Data Insert in bulkproductupload_log start---------------------------------------//

                    foreach ($attrb_exlcoulmnname as $katrb => $vattrbval) {

                        $attr_value[] = trim($allDataInSheet[$i][$vattrbval]);
                    }

                    $ctr_attrid = count($attr_id);
                    $incrattb = 0;

                    foreach ($attr_value as $keyattvl => $valattrvalue) {
                        if ($valattrvalue != '' && $incrattb < $ctr_attrid) {
                            $newattr_id[] = $attr_id[$incrattb];
                            $newattr_value[] = $valattrvalue;
                            $newattr_fld_name[] = $attr_fld_name[$incrattb];
                        }
                        $incrattb++;
                    }

                    $attr_id_n_value = array_combine($newattr_id, $newattr_value);

                    $attrid_n_valueserialz = serialize($attr_id_n_value);

                    //----------------------------------------------Data Insert in bulkproductupload_log end---------------------------------------//
                    $prodqc_status = '';
                    if (count($qcfailed_resason) > 0) {
                        $prodqc_status = serialize($qcfailed_resason);
                    } else {
                        $prodqc_status = '';
                    }

                    //if($valid_sku=='' && $valid_prodname=='' && $valid_proddecrp=='' && $valid_mrp=='' && $valid_sellingprice=='' && $valid_specialprice=='' && $valid_specialprc_fromdate=='' && $valid_specialprice_todate=='' && $valid_quantity=='' && $valid_tax=='' && $valid_weight=='' && $valid_imageurl1=='' && $valid_imageurl2=='' && $valid_imageurl3=='' && $valid_imageurl4=='' && $valid_imageurl5=='' && $valid_shipfeetype=='' && $valid_shipfeeamount=''&& $valid_status=='' &&  $valid_prodhlght1=='' && $valid_prodhlght2=='' && $valid_prodhlght3=='' && $valid_prodhlght4=='' && $valid_prodhlght5=='' && $valid_countrymfg=='' && $valid_metatitle=='' && $valid_metakeyword=='' && $valid_metadescrp=='')
//										{}
                    //else
                    //{
                    $data_prodinfo = array(
                        'uploadprod_uid' => $uploadprod_uid,
                        'moonboy_slno' => $moonboy_slno,
                        'qc_status' => $qc_status,
                        'qc_failedreason' => $prodqc_status,
                        'sku' => $valid_sku,
                        'prod_name' => $valid_prodname,
                        'descrp' => $valid_proddecrp,
                        'mrp' => $valid_mrp,
                        'sell_price' => $valid_sellingprice,
                        'special_price' => $valid_specialprice,
                        'splprice_fromdt' => $valid_specialprc_fromdate,
                        'splprice_todate' => $valid_specialprice_todate,
                        'quantity' => $valid_quantity,
                        'vat_cst' => $valid_tax,
                        'weight' => $valid_weight,
                        'image_url1' => $valid_imageurl1,
                        'image_url2' => $valid_imageurl2,
                        'image_url3' => $valid_imageurl3,
                        'image_url4' => $valid_imageurl4,
                        'image_url5' => $valid_imageurl5,
                        'shipfee_type' => $valid_shipfeetype,
                        'shipfee_amount' => $valid_shipfeeamount,
                        'status' => $valid_status,
                        'prod_highlt1' => $valid_prodhlght1,
                        'prod_highlt2' => $valid_prodhlght2,
                        'prod_highlt3' => $valid_prodhlght3,
                        'prod_highlt4' => $valid_prodhlght4,
                        'prod_highlt5' => $valid_prodhlght5,
                        'country_mafg' => $valid_countrymfg,
                        'meta_title' => $valid_metatitle,
                        'meta_keyword' => $valid_metakeyword,
                        'meta_descrp' => $valid_metadescrp,
                        'attrb_groupuid' => $attrbset_id,
                        'attrb_valueandid' => $attrid_n_valueserialz,
                        'upload_dtime' => $dt,
                        'upload_status' => 'Pending'
                    );

                    $this->db->insert('bulkproductupload_log', $data_prodinfo);
                    //}
                    $sl++;
                }
            } // main for loop end
            //$records_array[]=$invalid_rows;
            //$records_array[]=$valid_rows;
            //return 	$records_array;
            //echo $invalid_rows." "; echo  $sl;exit;

            /* if(($sl-1)==$invalid_rows)
              {
              $this->db->query("DELETE FROM bulkproductupload_log WHERE uploadprod_uid='$uploadprod_uid' ");

              $excl_filename=$excl_filename;

              $output_dir = "./bulkproduct_excel/";
              $filePath = $output_dir.$excl_filename;
              unlink($filePath);
              } */
            //$this->db->trans_complete();
            return $uploadprod_uid;
        }
        //---------------------------------checking of validation of excel sheet field end-----------------------------				
        else {
            //$records_array[]="File has expired";
            $file_staus = "Invalid File";

            // return $records_array;
            //$this->db->trans_complete();
            return $file_staus;
        }
    }

    function insert_bulkuploadafterconf($excelfiluploadid) {
        set_time_limit(0);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        //$this->db->trans_start();
        $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        
        $dt = date('Y-m-d H:i:s');

        $qr_filetempdata = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE blk_tempid='$excelfiluploadid' ");
        $res_filetempdata = $qr_filetempdata->row();
        $seller_id = $res_filetempdata->seller_id;
        $attrbset_id = $res_filetempdata->attribute_set;
        $category_id = $res_filetempdata->category_id;



        // attribute id & value list start

        $attr_heading_result = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attrbset_id'");

        $attr_fld_name = array();
        $attr_id = array();

        foreach ($attr_heading_result->result_array() as $attr_heading_row) {

            $attr_hedingid = $attr_heading_row['attribute_heading_id'];

            $query_attrbreal = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_hedingid ");
            $field_result = $query_attrbreal->result_array();

            foreach ($field_result as $attr_fld_row) {
                $attr_fld_name[] = $attr_fld_row['attribute_field_name'];
                $attr_id[] = $attr_fld_row['attribute_id'];
            } // attribute field name inner forloop end
        }

        // attribute heading name inner forloop end
        // attribute id & value list end




        $qr_filedata = $this->db->query("SELECT * FROM bulkproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND qc_status='Passed' AND upload_status='Pending'  ");
        $res_filedata = $qr_filedata->result_array();



        //--------------------------------Main forloop Product Data insert start-------------------------
        foreach ($res_filedata as $rw_filedata) {
            $image = '';
            $imag = array();
            $product_categoy_data = array();
            $product_inventory_data = array();
            $product_meta_data = array();
            $product_price_data = array();
            $product_general_data = array();
            $product_setting_data = array();
            $image_data = array();
            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
            $seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id');
            //----------------sku generate start----------------
            $chars = 4;
            $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rand_letter = substr(str_shuffle($letters), 0, $chars);
            $sku1 = str_replace(' ', '-', $rw_filedata['sku']);
            $sku = $rand_letter . '-' . $seller_id . '-' . $sku1;
            //----------------sku generate end----------------	

            $product_setting_data = array(
                'seller_product_id' => $seller_product_id,
                'seller_id' => $seller_id,
                'attribute_set' => $attrbset_id,
                    //'product_type' => $this->input->post('product_type'),
            );
            $this->db->insert('seller_product_setting', $product_setting_data);

            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

            $prod_hlights = array();

            if ($rw_filedata['prod_highlt1'] != '') {
                $prod_hlights[] = $rw_filedata['prod_highlt1'];
            }

            if ($rw_filedata['prod_highlt2'] != '') {
                $prod_hlights[] = $rw_filedata['prod_highlt2'];
            }

            if ($rw_filedata['prod_highlt3'] != '') {
                $prod_hlights[] = $rw_filedata['prod_highlt3'];
            }

            if ($rw_filedata['prod_highlt4'] != '') {
                $prod_hlights[] = $rw_filedata['prod_highlt4'];
            }

            if ($rw_filedata['prod_highlt5']) {
                $prod_hlights[] = $rw_filedata['prod_highlt5'];
            }


            $product_general_data = array(
                'seller_product_id' => $seller_product_id,
                'name' => $rw_filedata['prod_name'],
                'sku' => $sku,
                'description' => $rw_filedata['descrp'],
                'short_desc' => serialize($prod_hlights),
                'weight' => $rw_filedata['weight'],
                'status' => $rw_filedata['status'],
                //'product_fr_dt' =>$product_fr_dt,
                //'product_to_dt' =>$product_to_dt,
                //'visibility' => $this->input->post('visibility'),
                'manufacture_country' => $rw_filedata['country_mafg'],
                    //'featured' => ' ',
            );

            $this->db->insert('seller_product_general_info', $product_general_data);

            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

            if ($rw_filedata['special_price'] > 0) {
                /* $tm_arr=explode('-',$rw_filedata['splprice_fromdt']);
                  $tm_arrreverse=array_reverse($tm_arr);
                  $tm_arrreverse_strg=implode('-',$tm_arrreverse);

                  $splprice_frdtcreate=date_create($tm_arrreverse_strg);
                  $splprice_from_dt=date_format($splprice_frdtcreate,'Y-m-d'); */

                $splprice_from_dt = $rw_filedata['splprice_fromdt'];



                /* $tm_arr1=explode('-',$rw_filedata['splprice_todate']);
                  $tm_arrreverse1=array_reverse($tm_arr1);
                  $tm_arrreverse_strg1=implode('-',$tm_arrreverse1);

                  $splprice_todtcreate=date_create($tm_arrreverse_strg1);
                  $splprice_to_dt=date_format($splprice_todtcreate,'Y-m-d'); */

                $splprice_to_dt = $rw_filedata['splprice_todate'];
            } else {
                $splprice_from_dt = '0000-00-00';
                $splprice_to_dt = '0000-00-00';
            }


            $shipping_fee_type = $rw_filedata['shipfee_type'];
            if ($shipping_fee_type == 'Free') {
                $shipping_fee = 0;
                $shipping_fee_amount = 0;
            } else {

                $wt_inkg = $rw_filedata['weight'] / 1000;
                $shipping_fee = round($rw_filedata['shipfee_amount'] * $wt_inkg);
                $shipping_fee_amount = $rw_filedata['shipfee_amount'];
            }


            $product_price_data = array(
                'seller_product_id' => $seller_product_id,
                'mrp' => $rw_filedata['mrp'],
                'special_price' => $rw_filedata['special_price'],
                'price' => $rw_filedata['sell_price'],
                'price_fr_dt' => $splprice_from_dt,
                'price_to_dt' => $splprice_to_dt,
                'tax_amount' => $rw_filedata['vat_cst'],
                'shipping_fee' => $shipping_fee,
                'shipping_fee_amount' => $shipping_fee_amount,
            );
            $this->db->insert('seller_product_price_info', $product_price_data);

            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

            $product_meta_data = array(
                'seller_product_id' => $seller_product_id,
                'meta_title' => $rw_filedata['meta_title'],
                'meta_keyword' => $rw_filedata['meta_keyword'],
                'meta_description' => $rw_filedata['meta_descrp']
            );
            $this->db->insert('seller_product_meta_info', $product_meta_data);

            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
            $product_inventory_data = array(
                'seller_product_id' => $seller_product_id,
                'quantity' => $rw_filedata['quantity'],
                    //'max_quantity' => $this->input->post('max_qty_allowed'),
                    //'qty_increment' => $this->input->post('qty_increment'),
                    //'stock_avail' => $this->input->post('stock_avail'),
            );
            $this->db->insert('seller_product_inventory_info', $product_inventory_data);

            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
            $product_categoy_data = array(
                'seller_product_id' => $seller_product_id,
                'category' => $category_id,
            );
            $this->db->insert('seller_product_category', $product_categoy_data);



            //---------------------------------------------attribute insert code start---------------------------------------
            //$attr_fld_name[]=$attr_fld_row['attribute_field_name'];
//				$attr_id[]=$attr_fld_row['attribute_id'];
            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

            $newattr_fld_name = array();
            $attrbid_ky = array();
            $newattr_value = array();
            $newattr_id = array();

            $attr_id_n_value = unserialize($rw_filedata['attrb_valueandid']);

            foreach ($attr_id_n_value as $attrbidkey => $attrbvalue) {
                $attrbid_ky[] = $attrbidkey;
                $newattr_value[] = $attrbvalue;
                $newattr_id[] = $attrbidkey;
            }

            for ($attri = 0; $attri < count($attr_id); $attri++) {
                foreach ($attr_id_n_value as $attrbidskey => $attrbsvalues) {
                    if ($attrbidskey == $attr_id[$attri]) {
                        $newattr_fld_name[] = $attr_fld_name[$attri];
                    }
                }
            }

            //$attr_id_n_value = array_combine($newattr_id,$newattr_value);

            $attr_id_n_value_length = count($attr_id_n_value);

            for ($atr = 0; $atr < $attr_id_n_value_length; $atr++) {
                /* $attr_value = $attr_value[$i];
                  if($attr_value == ''){
                  $attr_value = NULL;
                  }else{
                  $attr_value = $attr_value;
                  } */
                $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
                if ($newattr_fld_name[$atr] == 'Size') {
                    if ($newattr_value[$atr] != '') {
                        $sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
                        $sz_row = $sz_sql->row();
                        $sz_id = $sz_row->size_id;
                        $product_sz_attr_data = array(
                            'sku_id' => $sku,
                            'm_size_id' => $sz_id,
                            'm_size_name' => $newattr_value[$atr]
                        );
                        $this->db->insert('size_attr', $product_sz_attr_data);
                    }
                }

                //progrm for sub size attribute
                $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

                if ($newattr_fld_name[$atr] == 'Size Type') {
                    if ($attr_value[$atr] != '') {
                        $sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
                        $sb_sz_row = $sb_sz_sql->row();
                        $sb_sz_id = $sb_sz_row->size_id;
                        $product_sb_sz_attr_data = array(
                            'sku_id' => $sku,
                            's_size_id' => $sb_sz_id,
                            's_size_name' => $newattr_value[$atr]
                        );

                        //program start for checking if sku is exits or not in size_attr table and insert or update
                        $sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sku'");
                        if ($sq->num_rows() > 0) {
                            $product_sb_sz_attr_data1 = array(
                                's_size_id' => $sb_sz_id,
                                's_size_name' => $newattr_value[$atr]
                            );
                            $this->db->where('sku_id', $sku);
                            $this->db->update('size_attr', $product_sb_sz_attr_data1);
                        } else {
                            $this->db->insert('size_attr', $product_sb_sz_attr_data);
                        }
                        //program end of checking if sku is exits or not in size_attr table and insert or update
                    }
                }
                $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

                if ($newattr_fld_name[$atr] == 'Color') {
                    if ($newattr_value[$atr] != '') {
                        $clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$newattr_value[$atr]'");
                        if ($clor_sql->num_rows() > 0) {
                            $clor_row = $clor_sql->row();
                            $clor_id = $clor_row->color_id;
                            $product_color_attr_data = array(
                                'sku_id' => $sku,
                                'color_id' => $clor_id,
                                'clr_name' => $newattr_value[$atr]
                            );
                            $this->db->insert('color_attr', $product_color_attr_data);
                        }
                    }
                }
                $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

                $product_attr_data = array(
                    'seller_product_id' => $seller_product_id,
                    'sku' => $sku,
                    'attr_id' => $newattr_id[$atr],
                    'attr_value' => $newattr_value[$atr],
                );
                $newattr_id[$atr];
                $newattr_value[$atr];

                $this->db->insert('seller_product_attribute_value', $product_attr_data);
            }

            //---------------------------------------------attribute insert code end---------------------------------------	
            //------------------------image upload  start---------------------------------------------------------------------
            //--------------------------------image upload for imageURL1 start------------------------------------	
            //$this->load->helper('download');
            $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

            if ($rw_filedata['image_url1'] != '') {
                error_reporting(0);
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';

                if (preg_match('/dropbox/', $rw_filedata['image_url1'])) {
                    $image_url = trim(str_replace("?dl=0", "?dl=1", $rw_filedata['image_url1']));
                } else {
                    $image_url = trim($rw_filedata['image_url1']);
                }

                $img = file_get_contents(trim($image_url));

                //force_download($img, $img);				
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();


                //$newwidth4 = '190';				
//				$newheight4 = '190';
                $newwidth4 = $width;
                $newheight4 = $height;
                $thumb4 = imagecreatetruecolor($newwidth4, $newheight4);
                imagecopyresized($thumb4, $im, 0, 0, 0, 0, $newwidth4, $newheight4, $width, $height);
                imagejpeg($thumb4, './images/product_img/catalog_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb4);

                if ($newwidth4 > $newheight4) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/catalog_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 190;
                    $configi['height'] = 190;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/catalog_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 190;
                    $configi['height'] = 190;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();


                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL1 end------------------------------------
            //--------------------------------image upload for imageURL2 start------------------------------------		
            if ($rw_filedata['image_url2'] != '') {
                error_reporting(0);
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';

                if (preg_match('/dropbox/', $rw_filedata['image_url2'])) {
                    $image_url = trim(str_replace("?dl=0", "?dl=1", $rw_filedata['image_url2']));
                } else {
                    $image_url = trim($rw_filedata['image_url2']);
                }

                $img = file_get_contents($image_url);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();


                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL2 end------------------------------------
            //--------------------------------image upload for imageURL3 start------------------------------------		
            if ($rw_filedata['image_url3'] != '') {
                error_reporting(0);
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';

                if (preg_match('/dropbox/', $rw_filedata['image_url3'])) {
                    $image_url = trim(str_replace("?dl=0", "?dl=1", $rw_filedata['image_url3']));
                } else {
                    $image_url = trim($rw_filedata['image_url3']);
                }

                $img = file_get_contents($image_url);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL3 end------------------------------------
            //--------------------------------image upload for imageURL4 start------------------------------------		
            if ($rw_filedata['image_url4'] != '') {
                error_reporting(0);
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';

                if (preg_match('/dropbox/', $rw_filedata['image_url4'])) {
                    $image_url = trim(str_replace("?dl=0", "?dl=1", $rw_filedata['image_url4']));
                } else {
                    $image_url = trim($rw_filedata['image_url4']);
                }

                $img = file_get_contents($image_url);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();





                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL4 end------------------------------------
            //--------------------------------image upload for imageURL5 start------------------------------------		
            if ($rw_filedata['image_url5'] != '') {
                error_reporting(0);
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';

                if (preg_match('/dropbox/', $rw_filedata['image_url5'])) {
                    $image_url = trim(str_replace("?dl=0", "?dl=1", $rw_filedata['image_url5']));
                } else {
                    $image_url = trim($rw_filedata['image_url5']);
                }

                $img = file_get_contents($image_url);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();




                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();




                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL5 end------------------------------------		 
            //------------------------image upload  end-----------------------------------------------------------------------


            $image = implode(',', $imag);
            $image_data = array(
                'seller_product_id' => $seller_product_id,
                'image' => $image,
                'catelog_img_url' => 'catalog_' . $imag[0]
            );
            $this->db->insert('seller_product_image', $image_data);
            //program end of retrieve image from temp_imge table and insert in product_imag table//

            $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

            $uplodprd_id = $rw_filedata['uploadprod_sqlid'];
            $this->db->query("UPDATE bulkproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', new_sku='$sku' ,
		seller_productid='$seller_product_id' WHERE uploadprod_sqlid='$uplodprd_id' ");
        }
        //--------------------------------Main forloop Product Data insert end-------------------------
        $maxupload_id = $this->get_maximum_id('bulkprod_templatelog', 'upload_id');

        $this->db->query("UPDATE bulkprod_templatelog SET status='Expired', upload_id='$maxupload_id' WHERE blk_tempid='$excelfiluploadid' AND  status='Active' ");


        $this->db->query("UPDATE bulkprod_templatelog SET status='Expired' WHERE downlaod_parentid='$excelfiluploadid' ");

        //$this->db->trans_complete();
    }

    function delete_bulkuploadaproduct($excelfiluploadid) {
        $flnm_qr = $this->db->query("SELECT excelfile_name FROM bulkprod_templatelog WHERE blk_tempid='$excelfiluploadid'");
        $rw_filename = $flnm_qr->row();

        $excl_filename = $rw_filename->excelfile_name;

        $output_dir = "./bulkproduct_excel/";
        $filePath = $output_dir . $excl_filename;
        unlink($filePath);

        $this->db->query("DELETE FROM bulkproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND upload_status='Pending' ");

        //$this->db->query("DELETE FROM bulkprod_templatelog WHERE blk_tempid='$excelfiluploadid' ");
    }

    function insert_bulkupload($excl_filename) {
        set_time_limit(0);

        $inputFileName = './bulkproduct_excel/' . $excl_filename;

        $inputFileType = Phpexcel_iofactory::identify($inputFileName);
        $objReader = Phpexcel_iofactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        //$objPHPExcel = Phpexcel_iofactory::load($inputFileName);


        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel

        $count = 1;
        $count1 = 0;

        $seller_id = $this->input->post('hdntxt_sellerid');
        $attrbset_query = $this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' ");
        $attrbset_res = $attrbset_query->row();

        $attrbset_id = $attrbset_res->attribute_set;
        $category_id = $attrbset_res->category_id;

        // attribute id & value list start

        $attr_heading_result = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attrbset_id'");

        $attr_fld_name = array();
        $attr_id = array();

        foreach ($attr_heading_result->result_array() as $attr_heading_row) {

            $attr_hedingid = $attr_heading_row['attribute_heading_id'];

            $query_attrbreal = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_hedingid ");
            $field_result = $query_attrbreal->result_array();

            foreach ($field_result as $attr_fld_row) {
                $attr_fld_name[] = $attr_fld_row['attribute_field_name'];
                $attr_id[] = $attr_fld_row['attribute_id'];
            } // attribute field name inner forloop end
        }

        // attribute heading name inner forloop end
        // attribute id & value list end
        //Dynamically access of column address from excel sheet  start

        $attrb_countforexlcoulmn = count($attr_id) + 1;
        $attrb_exlcoulmnname = array();
        $sheet = $objPHPExcel->getSheet(0);

        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumn++;
        $c = 31;
        $row = '2';
        //for ($row = 2; $row <=4; $row++){ 
        for ($col = 1; $col != $attrb_countforexlcoulmn; $col++) {

            $cell = $sheet->getCellByColumnAndRow($c, $row);
            $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
            $attrb_exlcoulmnname[] = $cell->getColumn();
            // echo $cell->getColumn().'<br>';
            $c++;
        }
        //}
        //exit;
        //Dynamically access of column address from excel sheet  end
        //echo $arrayCount; exit;
        for ($i = 3; $i <= $arrayCount; $i++) {


            //------------------------------------validation of product insert start-------------------------------------------
            //$valid_sku=trim($allDataInSheet[$i]['D']);
//			$valid_prodname=trim($allDataInSheet[$i]['E']);
//			$valid_proddecrp=trim($allDataInSheet[$i]['F']);
//			$valid_mrp=trim($allDataInSheet[$i]['G']);
//			$valid_sellingprice=trim($allDataInSheet[$i]['H']);
//			$valid_quantity=trim($allDataInSheet[$i]['L']);
//			$valid_tax=trim($allDataInSheet[$i]['M']);
//			$valid_weight=trim($allDataInSheet[$i]['N']);
//			
//			$valid_imageurl1=trim($allDataInSheet[$i]['O']);
//			$valid_imageurl2=trim($allDataInSheet[$i]['P']);
//			$valid_imageurl3=trim($allDataInSheet[$i]['Q']);
//			$valid_imageurl4=trim($allDataInSheet[$i]['R']);
//			$valid_imageurl5=trim($allDataInSheet[$i]['S']);
//			
//			if($valid_imageurl1=='' && $valid_imageurl2=='' &&  $valid_imageurl3=='' && $valid_imageurl4=='' && $valid_imageurl5=='' )
//			{$valid_imagecell='';}
//			else
//			{$valid_imagecell="Image URL Exist in any one cell";}
//			
//			
//			$valid_shipfeetype=trim($allDataInSheet[$i]['T']);
//			$valid_shipfeeamount=trim($allDataInSheet[$i]['U']);
//			$valid_status=trim($allDataInSheet[$i]['V']);
//			
//			$valid_prodhlght1=trim($allDataInSheet[$i]['W']);
//			$valid_prodhlght2=trim($allDataInSheet[$i]['X']);
//			$valid_prodhlght3=trim($allDataInSheet[$i]['Y']);
//			$valid_prodhlght4=trim($allDataInSheet[$i]['Z']);
//			$valid_prodhlght5=trim($allDataInSheet[$i]['AA']);
//			
//			if($valid_prodhlght1=='' && $valid_prodhlght2=='' &&  $valid_prodhlght3=='' && $valid_prodhlght4=='' && $valid_prodhlght5=='')
//			{$valid_prodhlighcell='';}
//			else
//			{$valid_prodhlighcell="Product Highlight Exist in any one cell";}
//			
//			//$valid_rows=0;
//			//$invalid_reows=0;
//			
//					if($valid_sku=='' || $valid_prodname=='' || $valid_proddecrp=='' || $valid_mrp=='' || $valid_sellingprice=='' || $valid_quantity=='' || $valid_tax=='' || $valid_weight=='' || $valid_imagecell=='' || $valid_shipfeetype=='' || $valid_shipfeeamount=='' || $valid_status=='' || $valid_prodhlighcell=='')
//			{
            //-------------------------------------validation of product insert end---------------------------------------------

            $newattr_id = array();
            $newattr_value = array();
            $newattr_fld_name = array();
            $attr_id_n_value = array();
            $attr_id_n_value_length = 0;
            //---------------------------------------Seller Product  Data Insert Start--------------------------------------------------------- 		

            $seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id');

            //----------------sku generate start----------------
            $chars = 4;
            $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rand_letter = substr(str_shuffle($letters), 0, $chars);
            $sku1 = str_replace(' ', '-', trim($allDataInSheet[$i]['D']));
            $sku = $rand_letter . '-' . $seller_id . '-' . $sku1;
            //----------------sku generate end----------------	

            $product_setting_data = array(
                'seller_product_id' => $seller_product_id,
                'seller_id' => $seller_id,
                'attribute_set' => $attrbset_id,
                    //'product_type' => $this->input->post('product_type'),
            );
            $this->db->insert('seller_product_setting', $product_setting_data);

            //$product_fr_dtcreate=date_create(trim($allDataInSheet[$i]['F']));		
            //product_fr_dt=date_format($product_fr_dtcreate,'Y-m-d');

            $product_fr_dt = "0000-00-000";

            //$product_to_dtcreate=date_create(trim($allDataInSheet[$i]['G']));
//		$product_to_dt=date_format($product_to_dtcreate,'Y-m-d');

            $product_to_dt = "0000-00-000";

            $prod_hlights = array();
            if (trim($allDataInSheet[$i]['W']) != '') {
                $prod_hlights[] = trim($allDataInSheet[$i]['W']);
            }

            if (trim($allDataInSheet[$i]['X']) != '') {
                $prod_hlights[] = trim($allDataInSheet[$i]['X']);
            }

            if (trim($allDataInSheet[$i]['Y']) != '') {
                $prod_hlights[] = trim($allDataInSheet[$i]['Y']);
            }

            if (trim($allDataInSheet[$i]['Z']) != '') {
                $prod_hlights[] = trim($allDataInSheet[$i]['Z']);
            }

            if (trim($allDataInSheet[$i]['AA'])) {
                $prod_hlights[] = trim($allDataInSheet[$i]['AA']);
            }


            $product_general_data = array(
                'seller_product_id' => $seller_product_id,
                'name' => trim($allDataInSheet[$i]['E']),
                'sku' => $sku,
                'description' => trim($allDataInSheet[$i]['F']),
                'short_desc' => serialize($prod_hlights),
                'weight' => trim($allDataInSheet[$i]['N']),
                'status' => trim($allDataInSheet[$i]['V']),
                'product_fr_dt' => $product_fr_dt,
                'product_to_dt' => $product_to_dt,
                //'visibility' => $this->input->post('visibility'),
                'manufacture_country' => trim($allDataInSheet[$i]['AB']),
                    //'featured' => ' ',
            );


            $this->db->insert('seller_product_general_info', $product_general_data);

            $price_fr_dt_create = date_create(trim($allDataInSheet[$i]['J']));
            $price_fr_dt = date_format($price_fr_dt_create, 'Y-m-d');

            $price_to_dt_create = date_create(trim($allDataInSheet[$i]['K']));
            $price_to_dt = date_format($price_to_dt_create, 'Y-m-d');

            $shipping_fee_type = trim($allDataInSheet[$i]['T']);
            if ($shipping_fee_type == 'Free') {
                $shipping_fee = 0;
                $shipping_fee_amount = 0;
            } else {
                $shipping_fee = $shipping_fee_type;
                $shipping_fee_amount = trim($allDataInSheet[$i]['U']);
            }


            $product_price_data = array(
                'seller_product_id' => $seller_product_id,
                'mrp' => trim($allDataInSheet[$i]['G']),
                'special_price' => trim($allDataInSheet[$i]['I']),
                'price' => trim($allDataInSheet[$i]['H']),
                'price_fr_dt' => $price_fr_dt,
                'price_to_dt' => $price_to_dt,
                'tax_amount' => trim($allDataInSheet[$i]['M']),
                'shipping_fee' => $shipping_fee,
                'shipping_fee_amount' => $shipping_fee_amount,
            );
            $this->db->insert('seller_product_price_info', $product_price_data);

            $product_meta_data = array(
                'seller_product_id' => $seller_product_id,
                'meta_title' => trim($allDataInSheet[$i]['AC']),
                'meta_keyword' => trim($allDataInSheet[$i]['AD']),
                'meta_description' => trim($allDataInSheet[$i]['AE'])
            );
            $this->db->insert('seller_product_meta_info', $product_meta_data);


            $product_inventory_data = array(
                'seller_product_id' => $seller_product_id,
                'quantity' => trim($allDataInSheet[$i]['L']),
                    //'max_quantity' => $this->input->post('max_qty_allowed'),
                    //'qty_increment' => $this->input->post('qty_increment'),
                    //'stock_avail' => $this->input->post('stock_avail'),
            );
            $this->db->insert('seller_product_inventory_info', $product_inventory_data);

            $product_categoy_data = array(
                'seller_product_id' => $seller_product_id,
                'category' => $category_id,
            );
            $this->db->insert('seller_product_category', $product_categoy_data);

            foreach ($attrb_exlcoulmnname as $katrb => $vattrbval) {
                //if(trim($allDataInSheet[$i][$vattrbval])=='')
//			{$attr_value[]=" ";}
//			else
                //{
                $attr_value[] = trim($allDataInSheet[$i][$vattrbval]);
                //}	
            }

            $ctr_attrid = count($attr_id);
            $incrattb = 0;

            foreach ($attr_value as $keyattvl => $valattrvalue) {
                if ($valattrvalue != '' && $incrattb < $ctr_attrid) {
                    $newattr_id[] = $attr_id[$incrattb];
                    $newattr_value[] = $valattrvalue;
                    $newattr_fld_name[] = $attr_fld_name[$incrattb];
                }
                $incrattb++;
            }

            //---------------------------------------------attribute insert code start---------------------------------------


            $attr_id_n_value = array_combine($newattr_id, $newattr_value);

            $attr_id_n_value_length = count($attr_id_n_value);

            for ($atr = 0; $atr < $attr_id_n_value_length; $atr++) {
                /* $attr_value = $attr_value[$i];
                  if($attr_value == ''){
                  $attr_value = NULL;
                  }else{
                  $attr_value = $attr_value;
                  } */

                if ($newattr_fld_name[$atr] == 'Size') {
                    if ($newattr_value[$atr] != '') {
                        $sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
                        $sz_row = $sz_sql->row();
                        $sz_id = $sz_row->size_id;
                        $product_sz_attr_data = array(
                            'sku_id' => $sku,
                            'm_size_id' => $sz_id,
                            'm_size_name' => $newattr_value[$atr]
                        );
                        $this->db->insert('size_attr', $product_sz_attr_data);
                    }
                }

                //progrm for sub size attribute
                if ($newattr_fld_name[$atr] == 'Size Type') {
                    if ($attr_value[$atr] != '') {
                        $sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
                        $sb_sz_row = $sb_sz_sql->row();
                        $sb_sz_id = $sb_sz_row->size_id;
                        $product_sb_sz_attr_data = array(
                            'sku_id' => $sku,
                            's_size_id' => $sb_sz_id,
                            's_size_name' => $newattr_value[$atr]
                        );

                        //program start for checking if sku is exits or not in size_attr table and insert or update
                        $sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sku'");
                        if ($sq->num_rows() > 0) {
                            $product_sb_sz_attr_data1 = array(
                                's_size_id' => $sb_sz_id,
                                's_size_name' => $newattr_value[$atr]
                            );
                            $this->db->where('sku_id', $sku);
                            $this->db->update('size_attr', $product_sb_sz_attr_data1);
                        } else {
                            $this->db->insert('size_attr', $product_sb_sz_attr_data);
                        }
                        //program end of checking if sku is exits or not in size_attr table and insert or update
                    }
                }

                if ($newattr_fld_name[$atr] == 'Color') {
                    if ($newattr_value[$atr] != '') {
                        $clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$newattr_value[$atr]'");
                        $clor_row = $clor_sql->row();
                        $clor_id = $clor_row->color_id;
                        $product_color_attr_data = array(
                            'sku_id' => $sku,
                            'color_id' => $clor_id,
                            'clr_name' => $newattr_value[$atr]
                        );
                        $this->db->insert('color_attr', $product_color_attr_data);
                    }
                }

                $product_attr_data = array(
                    'seller_product_id' => $seller_product_id,
                    'sku' => $sku,
                    'attr_id' => $newattr_id[$atr],
                    'attr_value' => $newattr_value[$atr],
                );
                $newattr_id[$atr];
                $newattr_value[$atr];

                $this->db->insert('seller_product_attribute_value', $product_attr_data);
            }

            //---------------------------------------------attribute insert code end---------------------------------------	
            //program start for retrieve image from temp_imge table and insert in product_imag table//
            //$query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id='$seller_id' AND session_id='$sesson_seller_id'");
//		foreach($query->result() as $img_row){
//			$imag[] = $img_row->imag;
//		}
//		$image = implode(',',$imag);
            //------------------------image upload  start---------------------------------------------------------------------
            $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
            //--------------------------------image upload for imageURL1 start------------------------------------		
            if ($allDataInSheet[$i]['O'] != '') {
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . $i . '.jpg';

                $img = file_get_contents($allDataInSheet[$i]['O']);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();


                //$newwidth4 = '190';				
//				$newheight4 = '190';
                $newwidth4 = $width;
                $newheight4 = $height;
                $thumb4 = imagecreatetruecolor($newwidth4, $newheight4);
                imagecopyresized($thumb4, $im, 0, 0, 0, 0, $newwidth4, $newheight4, $width, $height);
                imagejpeg($thumb4, './images/product_img/catalog_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb4);

                if ($newwidth4 > $newheight4) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/catalog_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 190;
                    $configi['height'] = 190;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/catalog_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 190;
                    $configi['height'] = 190;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();


                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL1 end------------------------------------
            //--------------------------------image upload for imageURL2 start------------------------------------		
            if ($allDataInSheet[$i]['P'] != '') {
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . $i . '.jpg';

                $img = file_get_contents($allDataInSheet[$i]['P']);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();


                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL2 end------------------------------------
            //--------------------------------image upload for imageURL3 start------------------------------------		
            if ($allDataInSheet[$i]['Q'] != '') {
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . $i . '.jpg';

                $img = file_get_contents($allDataInSheet[$i]['Q']);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL3 end------------------------------------
            //--------------------------------image upload for imageURL4 start------------------------------------		
            if ($allDataInSheet[$i]['R'] != '') {
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . $i . '.jpg';

                $img = file_get_contents($allDataInSheet[$i]['R']);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();





                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL4 end------------------------------------
            //--------------------------------image upload for imageURL5 start------------------------------------		
            if ($allDataInSheet[$i]['S'] != '') {
                //$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
                //$strpos_afterlastslash=$last_postslash;
                //$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
                //$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
                $random_imaghename = strtolower(random_string('alnum', 15)) . $dt_img . $i . '.jpg';

                $img = file_get_contents($allDataInSheet[$i]['S']);
                $im = imagecreatefromstring($img);

                $width = imagesx($im);
                $height = imagesy($im);

                $newwidth1 = $width;
                $newheight1 = $height;
                $thumb1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                imagejpeg($thumb1, './images/product_img/original_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb1);



                //$newwidth2 = '2000';				
//				$newheight2 = '2000';	
                $newwidth2 = $width;
                $newheight2 = $height;
                $thumb2 = imagecreatetruecolor($newwidth2, $newheight2);
                imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);
                imagejpeg($thumb2, './images/product_img/2000x2000_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb2);

                if ($newwidth2 > $newheight2) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/2000x2000_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 2000;
                    $configi['height'] = 2000;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();



                //$newwidth3 = '500';				
//				$newheight3 = '500';
                $newwidth3 = $width;
                $newheight3 = $height;
                $thumb3 = imagecreatetruecolor($newwidth3, $newheight3);
                imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);
                imagejpeg($thumb3, './images/product_img/' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb3);

                if ($newwidth3 > $newheight3) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 500;
                    $configi['height'] = 500;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }

                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();




                //$newwidth5 = '80';				
//				$newheight5 = '80';
                $newwidth5 = $width;
                $newheight5 = $height;
                $thumb5 = imagecreatetruecolor($newwidth5, $newheight5);
                imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);
                imagejpeg($thumb5, './images/product_img/thumbnil_' . $random_imaghename); //save image as jpg				
                imagedestroy($thumb5);


                if ($newwidth5 > $newheight5) {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    $config['master_dim'] = 'width';
                    //$config['master_dim'] = 'height';
                } else {
                    $configi['image_library'] = 'gd2';
                    $configi['source_image'] = './images/product_img/thumbnil_' . $random_imaghename;
                    $config['maintain_ratio'] = TRUE;
                    $configi['width'] = 80;
                    $configi['height'] = 80;
                    //$config['master_dim'] = 'width';
                    $config['master_dim'] = 'height';
                }
                $imag[] = $random_imaghename;
                $this->load->library('image_lib');
                $this->image_lib->initialize($configi);
                $success_resize = $this->image_lib->resize();
                $this->image_lib->clear();

                imagedestroy($im);
            }
            //--------------------------------image upload for imageURL5 end------------------------------------		 
            //------------------------image upload  end-----------------------------------------------------------------------


            $image = implode(',', $imag);
            $image_data = array(
                'seller_product_id' => $seller_product_id,
                'image' => $image,
                'catelog_img_url' => 'catalog_' . $imag[0]
            );
            $this->db->insert('seller_product_image', $image_data);
            //program end of retrieve image from temp_imge table and insert in product_imag table//
            //program start for delete image from temp_img table//
            //$this->db->where('session_id',$sesson_seller_id);
//		$this->db->where('seller_id',$seller_id);
//		$this->db->delete('temp_product_img');
            //program end of delete image from temp_img table//	
            //---------------------------------------Seller Product  Data Insert End---------------------------------------------------------
            //} // end of validation of compulsory column in excel file
        } // main for loop end

        $this->db->query("UPDATE bulkprod_templatelog SET status='Expired' WHERE excelfile_name='$excl_filename' AND  status='Active' ");
    }

    function insert_new_product($seller_id) {
        $sesson_seller_id = $this->session->userdata('seller_session_id'); //not required
        $seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id'); // done
        $chars = 4;
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand_letter = substr(str_shuffle($letters), 0, $chars);
        $sku1 = str_replace(' ', '-', $this->input->post('sku'));
        $sku = $rand_letter . '-' . $seller_id . '-' . $sku1;

        $product_setting_data = array(
            'seller_product_id' => $seller_product_id,
            'seller_id' => $seller_id,
            'attribute_set' => $this->input->post('attribute_set'),
                //'product_type' => $this->input->post('product_type'),
        );
        $this->db->insert('seller_product_setting', $product_setting_data);

        $product_general_data = array(
            'seller_product_id' => $seller_product_id,
            'name' => $this->input->post('name'),
            'sku' => $sku,
            'description' => $this->input->post('description'),
            'short_desc' => serialize($this->input->post('seller_prodt_highlit[]')),
            'weight' => $this->input->post('weight'),
            'status' => $this->input->post('status'),
            'product_fr_dt' => $this->input->post('product_from_date'),
            'product_to_dt' => $this->input->post('product_to_date'),
            //'visibility' => $this->input->post('visibility'),
            'manufacture_country' => $this->input->post('country2'),
            'featured' => $this->input->post('featured'),
        );
        $this->db->insert('seller_product_general_info', $product_general_data);

        /* On 26/10/15
          $shipping_fee_type = $this->input->post('shippingfee');
          if($shipping_fee_type == ''){
          $shipping_fee = $this->input->post('local_shipng_fee').','.$this->input->post('zonal_shipng_fee').','.$this->input->post('national_shipng_fee');
          }else if($shipping_fee_type == 'flat'){
          $shipping_fee = $this->input->post('flat_shipng_fee');
          }else{
          $shipping_fee = $this->input->post('shippingfee');
          }
         */
        $shipping_fee_type = $this->input->post('shipping_typ');
        if ($shipping_fee_type == 'Free') {
            $shipping_fee = 0;
            $shipping_fee_amount = 0;
        } else {
            $shipping_fee = $this->input->post('default_shipng_fee');
            $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
        }

        $product_price_data = array(
            'seller_product_id' => $seller_product_id,
            'mrp' => $this->input->post('price'),
            'special_price' => $this->input->post('special_price'),
            'price' => $this->input->post('selling_price'),
            'price_fr_dt' => $this->input->post('price_from_date'),
            'price_to_dt' => $this->input->post('price_to_date'),
            'tax_amount' => $this->input->post('vat_cst'),
            'shipping_fee' => $shipping_fee,
            'shipping_fee_amount' => $shipping_fee_amount,
        );
        $this->db->insert('seller_product_price_info', $product_price_data);

        /* $img_list = implode(",", $arr_image);
          $product_image_data = array(
          'seller_product_id' => $seller_product_id,
          'image' => $img_list,
          );
          $this->db->insert('seller_product_image', $product_image_data); */

        $product_meta_data = array(
            'seller_product_id' => $seller_product_id,
            'meta_title' => $this->input->post('meta_title'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'meta_description' => $this->input->post('meta_description'),
        );
        $this->db->insert('seller_product_meta_info', $product_meta_data);


        $product_inventory_data = array(
            'seller_product_id' => $seller_product_id,
            'quantity' => $this->input->post('qty'),
                //'max_quantity' => $this->input->post('max_qty_allowed'),
                //'qty_increment' => $this->input->post('qty_increment'),
                //'stock_avail' => $this->input->post('stock_avail'),
        );
        $this->db->insert('seller_product_inventory_info', $product_inventory_data);

        $product_categoy_data = array(
            'seller_product_id' => $seller_product_id,
            'category' => $this->input->post('subcategory_id'),
        );
        $this->db->insert('seller_product_category', $product_categoy_data);

        //-----------------------------------Attribute program start here-------------------------------------------------------//

        $attr_id = $this->input->post('hidden_attr_id');
        $attr_fld_name = $this->input->post('attr_fld_nm');
        $attr_value = $this->input->post('attr_value');
        $attr_id_n_value = array_combine($attr_id, $attr_value);
        $attr_id_n_value_length = count($attr_id_n_value);

        for ($i = 0; $i < $attr_id_n_value_length; $i++) {
            /* $attr_value = $attr_value[$i];
              if($attr_value == ''){
              $attr_value = NULL;
              }else{
              $attr_value = $attr_value;
              } */

            if ($attr_fld_name[$i] == 'Size') {
                if ($attr_value[$i] != '') {
                    $sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$attr_value[$i]'");
                    $sz_row = $sz_sql->row();
                    $sz_id = $sz_row->size_id;
                    $product_sz_attr_data = array(
                        'sku_id' => $sku,
                        'm_size_id' => $sz_id,
                        'm_size_name' => $attr_value[$i]
                    );
                    $this->db->insert('size_attr', $product_sz_attr_data);
                }
            }

            //progrm for sub size attribute
            if ($attr_fld_name[$i] == 'Size Type') {
                if ($attr_value[$i] != '') {
                    $sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$attr_value[$i]'");
                    $sb_sz_row = $sb_sz_sql->row();
                    $sb_sz_id = $sb_sz_row->size_id;
                    $product_sb_sz_attr_data = array(
                        'sku_id' => $sku,
                        's_size_id' => $sb_sz_id,
                        's_size_name' => $attr_value[$i]
                    );

                    //program start for checking if sku is exits or not in size_attr table and insert or update
                    $sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sku'");
                    if ($sq->num_rows() > 0) {
                        $product_sb_sz_attr_data1 = array(
                            's_size_id' => $sb_sz_id,
                            's_size_name' => $attr_value[$i]
                        );
                        $this->db->where('sku_id', $sku);
                        $this->db->update('size_attr', $product_sb_sz_attr_data1);
                    } else {
                        $this->db->insert('size_attr', $product_sb_sz_attr_data);
                    }
                    //program end of checking if sku is exits or not in size_attr table and insert or update
                }
            }

            if ($attr_fld_name[$i] == 'Color') {
                if ($attr_value[$i] != '') {
                    $clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$attr_value[$i]'");
                    $clor_row = $clor_sql->row();
                    $clor_id = $clor_row->color_id;
                    $product_color_attr_data = array(
                        'sku_id' => $sku,
                        'color_id' => $clor_id,
                        'clr_name' => $attr_value[$i]
                    );
                    $this->db->insert('color_attr', $product_color_attr_data);
                }
            }

            $product_attr_data = array(
                'seller_product_id' => $seller_product_id,
                'sku' => $sku,
                'attr_id' => $attr_id[$i],
                'attr_value' => $attr_value[$i],
            );

            $this->db->insert('seller_product_attribute_value', $product_attr_data);
        }
        //Attribute program end here//
        //program start for retrieve image from temp_imge table and insert in product_imag table//
        $query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id='$seller_id' AND session_id='$sesson_seller_id'");
        foreach ($query->result() as $img_row) {
            $imag[] = $img_row->imag;
        }
        $image = implode(',', $imag);
        $image_data = array(
            'seller_product_id' => $seller_product_id,
            'image' => $image,
            'catelog_img_url' => 'catalog_' . $imag[0]
        );
        $this->db->insert('seller_product_image', $image_data);
        //program end of retrieve image from temp_imge table and insert in product_imag table//
        //program start for delete image from temp_img table//
        $this->db->where('session_id', $sesson_seller_id);
        $this->db->where('seller_id', $seller_id);
        $this->db->delete('temp_product_img');
        //program end of delete image from temp_img table//	
        return true;
    }

}

?>