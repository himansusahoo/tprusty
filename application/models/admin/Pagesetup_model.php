<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagesetup_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->model('PHPExcel/Phpexcel_iofactory');
    }

    function select_imgsize() {
        $clmn_conunt = $this->input->post('clmn_count');

        $screeshot_clmnname = str_replace(' ', '_', $this->input->post('sec_type'));

        $qr = $this->db->query("SELECT * FROM pagedesign_imagesize WHERE display_type='mobile' AND page_nm='homepage' AND culumns_count='$clmn_conunt' AND " . $screeshot_clmnname . "!=''  ");

        return $qr;
    }

    function select_screenshotimage() {
        $sec_type = str_replace(' ', '_', $this->input->post('sec_type'));
        $img_size = $this->input->post('img_size');
        $col_num = $this->input->post('col_num');

        $qr = $this->db->query("SELECT " . $sec_type . " as srcshot_imgname FROM pagedesign_imagesize WHERE display_type='mobile' AND page_nm='homepage' AND culumns_count='$col_num' AND img_size='$img_size' ");

        return $qr;
    }

    function add_pagesectioninfo() {
        //$this->load->model('PHPExcel/Phpexcel_iofactory');

        $section_type = $this->input->post('section_type');
        $sec_label = $this->input->post('section_lbltxtbox');
        $sectiondata_type = $this->input->post('sectiondata_type');
        $section_status = $this->input->post('section_status');
        $sectionbackg_clr = $this->input->post('sectionbackg_clr');
        $col_num = $this->input->post('col_num');
        $sec_descrp = $this->input->post('richtxteditor_data');

        if ($this->input->post('slctimage_size')) {
            $slctimage_size = $this->input->post('slctimage_size');
        } else {
            $slctimage_size = '';
        }

        $sec_memo = $this->input->post('sec_memo');
        $dtm = date('y-m-d h:i:s');

        $qr_seciontbl = $this->db->query("SELECT max(Sec_id) as maxi_secid FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' ");

        if ($qr_seciontbl->num_rows() > 0) {
            $updated_secid = $qr_seciontbl->row()->maxi_secid + 1;
        } else {
            $updated_secid = 1;
        }


        $qr_secionorderby = $this->db->query("SELECT max(Order_by) as maxi_orderby FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' ");

        if ($qr_secionorderby->num_rows() > 0) {
            $updated_ordby = $qr_secionorderby->row()->maxi_orderby + 1;
        } else {
            $updated_ordby = 1;
        }

        $data_sectioninfo = array(
            'page_id' => '1',
            'page_name' => 'home',
            'Sec_id' => $updated_secid,
            'Order_by' => $updated_ordby,
            'nos_column' => $col_num,
            'bg_color' => $sectionbackg_clr,
            'dt_tm' => $dtm,
            'sec_type' => $section_type,
            'sec_type_data' => $sectiondata_type,
            'lst_updt_dt_tm' => $dtm,
            'memo' => $sec_memo,
            'Status' => $section_status,
            'image_size' => $slctimage_size,
            'sec_lbl' => $sec_label,
            'sec_descrp' => $sec_descrp
        );


        $this->db->insert('mobilesite_pagesectioninfo', $data_sectioninfo);

        //----------Data insert as number of column start--------//

        $clmnbg_colorarr = $this->input->post('clmn_bgcolor');
        $clmnadd_dttm = $dtm;
        $clmn_statuarr = $this->input->post('clmn_sts');
        $clmn_typearr = $this->input->post('clmn_type');
        $clmn_memoarr = $this->input->post('clmn_memo');
        $clmn_lstupdtdttm = $dtm;

        $i_img = 1;

        for ($i_clmn = 0; $i_clmn < $col_num; $i_clmn++) {

            $qr_clmnid = $this->db->query("SELECT max(clmn_id) as maxiclmn_id FROM mobilesite_columninfo 
											WHERE page_id='1' AND sec_id='$updated_secid'  ");
            if ($qr_clmnid->num_rows() > 0) {
                $updated_clmnid = $qr_clmnid->row()->maxiclmn_id + 1;
            } else {
                $updated_clmnid = 1;
            }

            $qr_clmnordby = $this->db->query("SELECT max(ordr_by) as maxiclmn_ordby FROM mobilesite_columninfo 
											WHERE page_id='1' AND sec_id='$updated_secid'  ");
            if ($qr_clmnid->num_rows() > 0) {
                $updated_ordby = $qr_clmnordby->row()->maxiclmn_ordby + 1;
            } else {
                $updated_ordby = 1;
            }

            $data_clminfo = array(
                'page_id' => '1',
                'sec_id' => $updated_secid,
                'clmn_id' => $updated_clmnid,
                'ordr_by' => $updated_ordby,
                'bg_color' => $clmnbg_colorarr[$i_clmn],
                'dt_tm' => $clmnadd_dttm,
                'clmn_status' => $clmn_statuarr[$i_clmn],
                'type' => $clmn_typearr[$i_clmn],
                'memo' => $clmn_memoarr[$i_clmn],
                'lst_updt_dt_tm' => $clmn_lstupdtdttm
            );

            $this->db->insert('mobilesite_columninfo', $data_clminfo);

            //--------  multiple image upload start------------//

            $img_skuorurl = $this->input->post('img_skuorurl' . $i_img . '');
            $imglinkkskuorurl = $this->input->post('imglinkkskuorurl' . $i_img . '');
            $img_sts = $this->input->post('img_sts' . $i_img . '');
            $from_dt = $this->input->post('from_dt' . $i_img . '');
            $to_date = $this->input->post('to_date' . $i_img . '');
            $img_memo = $this->input->post('img_memo' . $i_img . '');
            $dispaly_url = $this->input->post('dispaly_url' . $i_img . '');
            $sku_sortby = $this->input->post('sku_sortby' . $i_img . '');
            $imag_label = $this->input->post('imglab_txtara' . $i_img . '');
            //print_r($sku_sortby);exit;

            $fileCount = count($_FILES["userfile" . $i_img . ""]["name"]);

            $files = $_FILES;
            for ($s = 0; $s < $fileCount; $s++) {
                $img_filenm = $files["userfile" . $i_img . ""]['name'][$s];
                $ext = pathinfo($img_filenm, PATHINFO_EXTENSION);
                if ($ext == "gif") {
                    $dt_img1 = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
                    $img_rndname = strtolower(random_string('alnum', 15)) . $dt_img1 . '.gif';
                } else {
                    $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
                    $img_rndname = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';
                }
                $skulink_excelfile = '';

                $_FILES['userfile']['name'] = $files["userfile" . $i_img . ""]['name'][$s];
                $_FILES['userfile']['type'] = $files["userfile" . $i_img . ""]['type'][$s];
                $_FILES['userfile']['tmp_name'] = $files["userfile" . $i_img . ""]['tmp_name'][$s];
                $_FILES['userfile']['error'] = $files["userfile" . $i_img . ""]['error'][$s];
                $_FILES['userfile']['size'] = $files["userfile" . $i_img . ""]['size'][$s];

                $config = array();
                $config['upload_path'] = './images/pagedesign_image/';
                $config['allowed_types'] = 'jpeg|jpg|png|gif';
                $config['file_name'] = $img_rndname;
                //$config['max_size']      = '0';
                //$config['overwrite']     = FALSE;

                $this->upload->initialize($config);
                $this->upload->do_upload();
                /* if(!$this->upload->do_upload()){
                  echo $this->upload->display_errors();exit;
                  } */


                //------ image data upload other data like sku, memo insert start-----//

                $qr_clmnsqlid = $qr_clmnordby = $this->db->query("SELECT clmn_sqlid FROM mobilesite_columninfo 
											WHERE page_id='1' AND sec_id='$updated_secid' AND clmn_id='$updated_clmnid'  ");

                $clmn_sqlid = $qr_clmnsqlid->row()->clmn_sqlid;

                $sku_data = '';
                $url_data = '';

                if ($img_skuorurl[$s] == 'sku') {
                    if ($imglinkkskuorurl[$s] != '') {
                        $sku_data = $imglinkkskuorurl[$s];
                        $sku_data = serialize(explode(',', $sku_data));
                    }

                    //----------------------sku data collect from csv file start---------------------//
                    if ($files["userfile_excel" . $i_img . ""]['name'][$s] != '') {
                        //$this->load->model('PHPExcel/Phpexcel_iofactory');
                        $this->load->library('upload');
                        $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
                        $excel_rndname = strtolower(random_string('alnum', 15)) . $dt_img . '.csv';

                        $_FILES['userfile']['name'] = $files["userfile_excel" . $i_img . ""]['name'][$s];
                        $_FILES['userfile']['type'] = $files["userfile_excel" . $i_img . ""]['type'][$s];
                        $_FILES['userfile']['tmp_name'] = $files["userfile_excel" . $i_img . ""]['tmp_name'][$s];
                        $_FILES['userfile']['error'] = $files["userfile_excel" . $i_img . ""]['error'][$s];
                        $_FILES['userfile']['size'] = $files["userfile_excel" . $i_img . ""]['size'][$s];

                        $config = array();
                        $config['upload_path'] = './pagesetup_skuexcelfile/';
                        $config['allowed_types'] = 'csv';
                        $config['file_name'] = $excel_rndname;

                        $this->upload->initialize($config);
                        $this->upload->do_upload();

                        $skulink_excelfile = $excel_rndname;

                        $inputFileName = './pagesetup_skuexcelfile/' . $excel_rndname;

                        $inputFileType = Phpexcel_iofactory::identify($inputFileName);
                        $objReader = Phpexcel_iofactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);

                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel

                        $sku_excelarr = array();
                        for ($i = 2; $i <= $arrayCount; $i++) {

                            $sku_excelarr[] = trim($allDataInSheet[$i]['A']);
                            ;
                        }

                        $sku_data = serialize($sku_excelarr);
                    }

                    //----------------------sku data collect from csv file end-----------------------//
                }
                if ($img_skuorurl[$s] == 'url') {
                    $url_data = $imglinkkskuorurl[$s];
                }

                $imgdtm = $clmnadd_dttm;

                $ins_displayurl = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($dispaly_url[$s]))))))));
                //print_r ($sku_sortby);exit;
                $data_imginfo = array(
                    'clmn_sqlid' => $clmn_sqlid,
                    'clmn_id' => $updated_clmnid,
                    'imge_nm' => $img_rndname,
                    'sku' => $sku_data,
                    'URL' => $url_data,
                    'image_status' => $img_sts[$s],
                    'frm_dt_tm' => $from_dt[$s],
                    'to_dt_tm' => $to_date[$s],
                    'dt_tm' => $imgdtm,
                    'memo' => $img_memo[$s],
                    'lst_updt_dt_tm' => $imgdtm,
                    'skulink_excelfile' => $skulink_excelfile,
                    'display_url' => $ins_displayurl,
                    'sort_by_info' => $sku_sortby[$s],
                    'imag_label' => addslashes($imag_label[$s])
                );

                $this->db->insert('mobilesite_imageinfo', $data_imginfo);
                //------ image data upload other data like sku, memo insert end------//
            }
            //--------  multiple image for loop upload end------------//			
            $i_img++;
        }

        //----------Data insert as number of column end--------//
    }

    function update_pagesectioninfo() {


        $Sec_id = $this->input->post('secid_hdn');
        $section_type = $this->input->post('section_type');
        $section_label = $this->input->post('section_lbltxtbox');
        $sectiondata_type = $this->input->post('sectiondata_type');
        $section_status = $this->input->post('section_status');
        $sectionbackg_clr = $this->input->post('sectionbackg_clr');
        $col_num = $this->input->post('col_num');
        $slctimage_size = $this->input->post('slctimage_size');
        $sec_memo = $this->input->post('sec_memo');
        $dtm = date('y-m-d h:i:s');

        $sec_descrp = $this->input->post('richtxteditor_data');

        $sec_hdnbgclor = $this->input->post('sec_hdnbgcolor');
        $sec_brcolor_checked = $this->input->post('secclr_checked');

        if ($sec_brcolor_checked == 'color changed') {
            $final_secbgcolor = $sectionbackg_clr;
        } else {
            $final_secbgcolor = $sec_hdnbgclor;
        }


        $this->db->query("UPDATE mobilesite_pagesectioninfo SET 
								bg_color='$final_secbgcolor',
								sec_type='$section_type',
								sec_type_data='$sectiondata_type',
								lst_updt_dt_tm='$dtm',
								memo='$sec_memo',
								Status='$section_status',
								image_size='$slctimage_size',
								sec_lbl='$section_label',
								sec_descrp='$sec_descrp'
								WHERE page_id='1' AND page_name='home' AND Sec_id='$Sec_id'
								
								");


        //----------Data insert as number of column start--------//

        $clmnedit_sqlid = $this->input->post('clmn_sqlidhdn');
        $culmnedit_id = $this->input->post('clmn_idhdn');

        $clmnbg_colorarr = $this->input->post('clmn_bgcolor');
        $clmnadd_dttm = $dtm;
        $clmn_statuarr = $this->input->post('clmn_sts');
        $clmn_typearr = $this->input->post('clmn_type');
        $clmn_memoarr = $this->input->post('clmn_memo');
        $clmn_lstupdtdttm = $dtm;

        $clmnbg_colohdnrarr = $this->input->post('clmn_hdnbgcolor');
        $clmn_checkcolorchangearr = $this->input->post('clr_checked');

        $i_img = 1;

        for ($i_clmn = 0; $i_clmn < $col_num; $i_clmn++) {
            if ($clmn_checkcolorchangearr[$i_clmn] == 'color changed') {
                $final_clmncolor = $clmnbg_colorarr[$i_clmn];
            } else {
                $final_clmncolor = $clmnbg_colohdnrarr[$i_clmn];
            }



            $clmn_sqlid = $clmnedit_sqlid[$i_clmn];
            $clmnid = $culmnedit_id[$i_clmn];

            $bg_color = $final_clmncolor;
            $clmn_status = $clmn_statuarr[$i_clmn];
            $type = $clmn_typearr[$i_clmn];
            $memo = $clmn_memoarr[$i_clmn];
            $lst_updt_dt_tm = $clmn_lstupdtdttm;

            $this->db->query("UPDATE mobilesite_columninfo
								 SET bg_color='$bg_color',clmn_status='$clmn_status', type='$type', memo='$memo', lst_updt_dt_tm='$lst_updt_dt_tm' 
								 WHERE clmn_sqlid='$clmn_sqlid'  ");


            //--------  multiple image upload start------------//
            $imgsqlid_hdn = $this->input->post('imgsqlid_hidhdn' . $i_img . '');
            $old_imagename = $this->input->post('oldimagename_hidhdn' . $i_img . '');

            $img_skuorurl = $this->input->post('img_skuorurl' . $i_img . '');
            $imglinkkskuorurl = $this->input->post('imglinkkskuorurl' . $i_img . '');
            $img_sts = $this->input->post('img_sts' . $i_img . '');
            $from_dt = $this->input->post('from_dt' . $i_img . '');
            $to_date = $this->input->post('to_date' . $i_img . '');
            $img_memo = $this->input->post('img_memo' . $i_img . '');

            $oldcsvname = $this->input->post('csvfile_hidhdn' . $i_img . '');


            $fromdtm_hdn = $this->input->post('fromdt_hidhdn' . $i_img . '');
            $todtm_hdn = $this->input->post('todt_hidhdn' . $i_img . '');
            $sku_sortby = $this->input->post('sku_sortby' . $i_img . '');
            $dispaly_url = $this->input->post('dispaly_url' . $i_img . '');
            //print_r($sku_sortby);exit;
            $imag_label = $this->input->post('imglab_txtara' . $i_img . '');

            $fileCount = count($_FILES["userfile" . $i_img . ""]["name"]);

            $files = $_FILES;

            for ($s = 0; $s < count($imgsqlid_hdn); $s++) {
                $img_filenm = $files["userfile" . $i_img . ""]['name'][$s];
                $ext = pathinfo($img_filenm, PATHINFO_EXTENSION);
                if ($ext == "gif") {
                    $dt_img1 = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
                    $img_rndname = strtolower(random_string('alnum', 15)) . $dt_img1 . '.gif';
                } else {
                    $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
                    $img_rndname = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';
                }
                $skulink_excelfile = '';
                $img_sqlid = $imgsqlid_hdn[$s];
                if ($img_sqlid != '') {

                    if ($files["userfile" . $i_img . ""]['name'][$s] != '') {
                        $output_dir = "./images/pagedesign_image/";


                        $_FILES['userfile']['name'] = $files["userfile" . $i_img . ""]['name'][$s];
                        $_FILES['userfile']['type'] = $files["userfile" . $i_img . ""]['type'][$s];
                        $_FILES['userfile']['tmp_name'] = $files["userfile" . $i_img . ""]['tmp_name'][$s];
                        $_FILES['userfile']['error'] = $files["userfile" . $i_img . ""]['error'][$s];
                        $_FILES['userfile']['size'] = $files["userfile" . $i_img . ""]['size'][$s];

                        $config = array();
                        $config['upload_path'] = './images/pagedesign_image/';
                        $config['allowed_types'] = 'jpeg|jpg|png|gif';
                        $config['file_name'] = $img_rndname;
                        //$config['max_size']      = '0';
                        //$config['overwrite']     = FALSE;

                        $this->upload->initialize($config);
                        $this->upload->do_upload();
                        /* if(!$this->upload->do_upload()){
                          echo $this->upload->display_errors();exit;
                          } */

                        $filePath = $output_dir . $old_imagename[$s];
                        if (file_exists(trim($filePath))) {
                            unlink($filePath);
                        }
                    } else {
                        $img_rndname = $old_imagename[$s];
                    }

                    //------ image data upload other data like sku, memo insert start-----//

                    /* $qr_clmnsqlid=$qr_clmnordby=$this->db->query("SELECT clmn_sqlid FROM mobilesite_columninfo 
                      WHERE page_id='1' AND sec_id='$updated_secid' AND clmn_id='$updated_clmnid'  ");

                      $clmn_sqlid=$qr_clmnsqlid->row()->clmn_sqlid; */

                    $sku_data = '';
                    $url_data = '';

                    if ($img_skuorurl[$s] == 'sku') {
                        if ($imglinkkskuorurl[$s] != '') {
                            $sku_data = $imglinkkskuorurl[$s];
                            $sku_data = serialize(explode(',', $sku_data));
                        }

                        //----------------------sku data collect from csv file start---------------------//
                        if ($files["userfile_excel" . $i_img . ""]['name'][$s] != '') {
                            //$this->load->model('PHPExcel/Phpexcel_iofactory');
                            $this->load->library('upload');
                            $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
                            $excel_rndname = strtolower(random_string('alnum', 15)) . $dt_img . '.csv';

                            $_FILES['userfile']['name'] = $files["userfile_excel" . $i_img . ""]['name'][$s];
                            $_FILES['userfile']['type'] = $files["userfile_excel" . $i_img . ""]['type'][$s];
                            $_FILES['userfile']['tmp_name'] = $files["userfile_excel" . $i_img . ""]['tmp_name'][$s];
                            $_FILES['userfile']['error'] = $files["userfile_excel" . $i_img . ""]['error'][$s];
                            $_FILES['userfile']['size'] = $files["userfile_excel" . $i_img . ""]['size'][$s];

                            $config = array();
                            $config['upload_path'] = './pagesetup_skuexcelfile/';
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $excel_rndname;

                            $this->upload->initialize($config);
                            $this->upload->do_upload();

                            $skulink_excelfile = $excel_rndname;

                            $inputFileName = './pagesetup_skuexcelfile/' . $excel_rndname;

                            $inputFileType = Phpexcel_iofactory::identify($inputFileName);
                            $objReader = Phpexcel_iofactory::createReader($inputFileType);
                            $objPHPExcel = $objReader->load($inputFileName);

                            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel

                            $sku_excelarr = array();
                            for ($i = 2; $i <= $arrayCount; $i++) {

                                $sku_excelarr[] = trim($allDataInSheet[$i]['A']);
                                ;
                            }

                            $sku_data = serialize($sku_excelarr);
                        }


                        //----------------------sku data collect from csv file end-----------------------//
                    }
                    if ($img_skuorurl[$s] == 'url') {
                        $url_data = $imglinkkskuorurl[$s];
                    }

                    $imgdtm = $clmnadd_dttm;


                    $img_stsfnl = $img_sts[$s];

                    if ($from_dt[$s] != '') {
                        $fnl_fromdtm = $from_dt[$s];
                    } else {
                        $fnl_fromdtm = $fromdtm_hdn[$s];
                    }

                    if ($to_date[$s] != '') {
                        $fnl_todtm = $to_date[$s];
                    } else {
                        $fnl_todtm = $todtm_hdn[$s];
                    }

                    $img_memofnl = $img_memo[$s];
                    $imag_labelstr = addslashes($imag_label[$s]);

                    //$display_urlupdate=$dispaly_url[$s];
                    $sortby_final = $sku_sortby[$s];

                    $display_urlupdate = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($dispaly_url[$s]))))))));

                    if ($files["userfile_excel" . $i_img . ""]['name'][$s] == '' && $oldcsvname[$s] != '') {
                        $skulink_excelfile = $oldcsvname[$s];
                        $this->db->query("UPDATE mobilesite_imageinfo SET
												imge_nm='$img_rndname',												
												URL='$url_data',
												image_status='$img_stsfnl',
												frm_dt_tm='$fnl_fromdtm',
												to_dt_tm='$fnl_todtm',
												memo='$img_memofnl',
												lst_updt_dt_tm='$imgdtm',
												display_url='$display_urlupdate',
												sort_by_info='$sortby_final',
												imag_label='$imag_labelstr'
												WHERE img_sqlid='$img_sqlid'
												
												");
                    } else {
                        if ($oldcsvname[$s] != '') {
                            $output_dir = "./pagesetup_skuexcelfile/";
                            $filePath = $output_dir . $oldcsvname[$s];
                            if (file_exists(trim($filePath))) {
                                unlink($filePath);
                            }
                        }

                        $this->db->query("UPDATE mobilesite_imageinfo SET
														imge_nm='$img_rndname',
														sku='$sku_data',
														URL='$url_data',
														image_status='$img_stsfnl',
														frm_dt_tm='$fnl_fromdtm',
														to_dt_tm='$fnl_todtm',
														memo='$img_memofnl',
														lst_updt_dt_tm='$imgdtm',
														skulink_excelfile='$skulink_excelfile',
														display_url='$display_urlupdate',
														sort_by_info='$sortby_final',
														imag_label='$imag_labelstr'												
														WHERE img_sqlid='$img_sqlid'
														
													");
                    }
                } // if imgsqlid is in databse condition end
                else {

                    $_FILES['userfile']['name'] = $files["userfile" . $i_img . ""]['name'][$s];
                    $_FILES['userfile']['type'] = $files["userfile" . $i_img . ""]['type'][$s];
                    $_FILES['userfile']['tmp_name'] = $files["userfile" . $i_img . ""]['tmp_name'][$s];
                    $_FILES['userfile']['error'] = $files["userfile" . $i_img . ""]['error'][$s];
                    $_FILES['userfile']['size'] = $files["userfile" . $i_img . ""]['size'][$s];

                    $config = array();
                    $config['upload_path'] = './images/pagedesign_image/';
                    $config['allowed_types'] = 'jpeg|jpg|png|gif';
                    $config['file_name'] = $img_rndname;
                    //$config['max_size']      = '0';
                    //$config['overwrite']     = FALSE;

                    $this->upload->initialize($config);
                    $this->upload->do_upload();
                    /* if(!$this->upload->do_upload()){
                      echo $this->upload->display_errors();exit;
                      } */


                    //------ image data upload other data like sku, memo insert start-----//

                    /* $qr_clmnsqlid=$qr_clmnordby=$this->db->query("SELECT clmn_sqlid FROM mobilesite_columninfo 
                      WHERE page_id='1' AND sec_id='$Sec_id' AND clmn_id='$clmnid'  "); */

                    //$clmn_sqlid=$qr_clmnsqlid->row()->clmn_sqlid;



                    $sku_data = '';
                    $url_data = '';

                    if ($img_skuorurl[$s] == 'sku') {
                        if ($imglinkkskuorurl[$s] != '') {
                            $sku_data = $imglinkkskuorurl[$s];
                            $sku_data = serialize(explode(',', $sku_data));
                        }

                        //----------------------sku data collect from csv file start---------------------//
                        if ($files["userfile_excel" . $i_img . ""]['name'][$s] != '') {  //$this->load->model('PHPExcel/Phpexcel_iofactory');
                            $this->load->library('upload');
                            $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
                            $excel_rndname = strtolower(random_string('alnum', 15)) . $dt_img . '.csv';

                            $_FILES['userfile']['name'] = $files["userfile_excel" . $i_img . ""]['name'][$s];
                            $_FILES['userfile']['type'] = $files["userfile_excel" . $i_img . ""]['type'][$s];
                            $_FILES['userfile']['tmp_name'] = $files["userfile_excel" . $i_img . ""]['tmp_name'][$s];
                            $_FILES['userfile']['error'] = $files["userfile_excel" . $i_img . ""]['error'][$s];
                            $_FILES['userfile']['size'] = $files["userfile_excel" . $i_img . ""]['size'][$s];

                            $config = array();
                            $config['upload_path'] = './pagesetup_skuexcelfile/';
                            $config['allowed_types'] = 'csv';
                            $config['file_name'] = $excel_rndname;

                            $this->upload->initialize($config);
                            $this->upload->do_upload();

                            $skulink_excelfile = $excel_rndname;

                            $inputFileName = './pagesetup_skuexcelfile/' . $excel_rndname;

                            $inputFileType = Phpexcel_iofactory::identify($inputFileName);
                            $objReader = Phpexcel_iofactory::createReader($inputFileType);
                            $objPHPExcel = $objReader->load($inputFileName);

                            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel

                            $sku_excelarr = array();
                            for ($i = 2; $i <= $arrayCount; $i++) {

                                $sku_excelarr[] = trim($allDataInSheet[$i]['A']);
                                ;
                            }

                            $sku_data = serialize($sku_excelarr);
                        }


                        //----------------------sku data collect from csv file end-----------------------//
                    }
                    if ($img_skuorurl[$s] == 'url') {
                        $url_data = $imglinkkskuorurl[$s];
                    }

                    $imgdtm = $clmnadd_dttm;

                    $ins_displayurl = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($dispaly_url[$s]))))))));

                    $imag_labelstr = $imag_label[$s];

                    $data_imginfo = array(
                        'clmn_sqlid' => $clmn_sqlid,
                        'clmn_id' => $clmnid,
                        'imge_nm' => $img_rndname,
                        'sku' => $sku_data,
                        'URL' => $url_data,
                        'image_status' => $img_sts[$s],
                        'frm_dt_tm' => $from_dt[$s],
                        'to_dt_tm' => $to_date[$s],
                        'dt_tm' => $imgdtm,
                        'memo' => $img_memo[$s],
                        'lst_updt_dt_tm' => $imgdtm,
                        'skulink_excelfile' => $skulink_excelfile,
                        'display_url' => $ins_displayurl,
                        'sort_by_info' => $sku_sortby[$s],
                        'imag_label' => addslashes($imag_labelstr)
                    );

                    $this->db->insert('mobilesite_imageinfo', $data_imginfo);
                } // if image row not in mobilesite_imageinfo table
                //$this->db->insert('mobilesite_imageinfo',$data_imginfo);
                //------ image data upload other data like sku, memo insert end------//
            }
            //--------  multiple image for loop upload end------------//			
            $i_img++;
        }

        //----------Data insert as number of column end--------//
    }

    function remove_imageinfo() {
        $img_sqlid = $this->input->post('img_sqlid');
        $this->db->query("DELETE FROM mobilesite_imageinfo WHERE img_sqlid='$img_sqlid' ");
    }

    function remove_csvinfo() {
        $img_sqlid = $this->input->post('img_sqlid');
        $csvfilename = $this->input->post('cvsfilenm');

        $output_dir = "./pagesetup_skuexcelfile/";
        $filePath = $output_dir . csvfilename;
        if (file_exists(trim($filePath))) {
            unlink($filePath);
        }


        $this->db->query("UPDATE mobilesite_imageinfo SET skulink_excelfile='',sku='' WHERE img_sqlid='$img_sqlid' ");
    }

    function section_dataof_mobilehomepage() {
        $qr_section = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' ORDER BY Order_by ");
        return $qr_section;
    }

    function hompagesortby_section_movetop() {
        $sec_sqlid = $this->uri->segment(4);

        $sql_sel_data = $this->db->query("SELECT MIN(Order_by)Order_by FROM mobilesite_pagesectioninfo WHERE page_id='1'");
        $exit_data = $sql_sel_data->row()->Order_by;

        $order_byprevsec = $exit_data - 1;

        $this->db->query("UPDATE mobilesite_pagesectioninfo SET Order_by='$order_byprevsec' WHERE pgsection_sqlid='$sec_sqlid' ");
    }

    function hompagesortby_section_movedown() {
        $sec_sqlid = $this->uri->segment(4);

        $sql_sel_data = $this->db->query("SELECT MAX(Order_by) Order_by FROM mobilesite_pagesectioninfo WHERE page_id='1'");
        $exit_data = $sql_sel_data->row()->Order_by;

        $order_byprevsec = $exit_data + 1;

        $this->db->query("UPDATE mobilesite_pagesectioninfo SET Order_by='$order_byprevsec' WHERE pgsection_sqlid='$sec_sqlid' ");
    }

    function homepagesectionsorby_up() {
        $sec_sqlid = $this->uri->segment(4);

        $qr_section = $this->db->query("SELECT Order_by FROM mobilesite_pagesectioninfo WHERE pgsection_sqlid='$sec_sqlid' ");

        $orderby = $qr_section->row()->Order_by;

        $order_byprevsec = $orderby - 1;

        $qr_sectionperv = $this->db->query("SELECT pgsection_sqlid FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Order_by='$order_byprevsec' ");

        $secsqlid_prev = $qr_sectionperv->row()->pgsection_sqlid;


        $this->db->query("UPDATE mobilesite_pagesectioninfo SET Order_by='$order_byprevsec' WHERE pgsection_sqlid='$sec_sqlid' ");

        $this->db->query("UPDATE mobilesite_pagesectioninfo SET Order_by='$orderby' WHERE pgsection_sqlid='$secsqlid_prev' ");
    }

    function homepagesectionsorby_down() {
        $sec_sqlid = $this->uri->segment(4);

        $qr_section = $this->db->query("SELECT Order_by FROM mobilesite_pagesectioninfo WHERE pgsection_sqlid='$sec_sqlid' ");

        $orderby = $qr_section->row()->Order_by;

        $order_bynextsec = $orderby + 1;

        $qr_sectionnext = $this->db->query("SELECT pgsection_sqlid FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Order_by='$order_bynextsec' ");

        $secsqlid_next = $qr_sectionnext->row()->pgsection_sqlid;


        $this->db->query("UPDATE mobilesite_pagesectioninfo SET Order_by='$order_bynextsec' WHERE pgsection_sqlid='$sec_sqlid' ");

        $this->db->query("UPDATE mobilesite_pagesectioninfo SET Order_by='$orderby' WHERE pgsection_sqlid='$secsqlid_next' ");
    }

    function homepage_sectioneditedpage() {
        $sec_sqlid = $this->uri->segment(4);
        $qr_section = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE  pgsection_sqlid='$sec_sqlid' ");

        return $qr_section;
    }

    function delete_mobilehomepage_section() {
        $output_dir = "./images/pagedesign_image/";
        $sec_sqlid = $this->uri->segment(4);

        $qr_sec = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE pgsection_sqlid='$sec_sqlid' ");

        if ($qr_sec->num_rows() > 0) {
            $page_id = $qr_sec->row()->page_id;
            $page_name = $qr_sec->row()->page_name;
            $Sec_id = $qr_sec->row()->Sec_id;

            $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='$page_id' AND sec_id='$Sec_id' ");

            if ($qr_clmn->num_rows() > 0) {
                foreach ($qr_clmn->result_array() as $res_clmn) {
                    $clmn_sqlid = $res_clmn['clmn_sqlid'];

                    $qr_img = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' ");
                    foreach ($qr_img->result_array() as $res_img) {
                        $filePath = $output_dir . $res_img['imge_nm'];
                        if (file_exists(trim($filePath))) {
                            unlink($filePath);
                        }
                    }

                    $this->db->query("DELETE FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' ");
                }
            }

            $this->db->query("DELETE FROM mobilesite_columninfo WHERE page_id='$page_id' AND sec_id='$Sec_id' ");

            $this->db->query("DELETE FROM mobilesite_pagesectioninfo WHERE pgsection_sqlid='$sec_sqlid' ");
        }
    }

    function changesection_status() {
        $secsql_ids = $this->input->post('secsql_id');
        $sec_status = $this->input->post('secstatus');

        $secsql_ids_string = implode(',', $secsql_ids);

        $this->db->query("UPDATE mobilesite_pagesectioninfo SET Status='$sec_status' WHERE pgsection_sqlid IN ($secsql_ids_string) ");
    }

}

?>