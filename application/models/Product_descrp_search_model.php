<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_descrp_search_model extends CI_Model {

    function view_product_descrp() {

        $qr = $this->db->query("select * from pages where page_name='single_product' ");

        $row = $qr->row();

        return $row;
    }

    function select_firstproductajax_search($search_title) {
        //----------------------------- solr search start------------------------------//

        set_time_limit(0);

        $search_title = trim(str_replace(' ', '%20', $search_title));

        //$search_txt=trim(str_replace('%20','%20AND%20',$search_title));


        $curl_strng = SOLR_BASE_URL . "mycollection2_offline/select?indent=on&q=" . $search_title . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=50&start=0";


        $curl2 = curl_init($curl_strng);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl2);
        $data2 = json_decode($output, true);
        //echo '<pre>';print_r($data2);exit;
        if ($data2['response']['numFound'] == 0) {

            $sugword = $data2['spellcheck']['collations'][1];

            

            $this->session->set_userdata('sugstword', $sugword);

            $searchsuggst_txt = trim(str_replace(' ', '%20', $sugword));

            $curl_strng = SOLR_BASE_URL . "mycollection2_offline/select?indent=on&q=" . $searchsuggst_txt . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=50&start=0";


            $curl3 = curl_init($curl_strng);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            $output3 = curl_exec($curl3);
            $data3 = json_decode($output3, true);

            $qr2 = $data3;

            $sku_ids = array();

            for ($i_arr = 0; $i_arr < count($data3['response']['docs']); $i_arr++) {
                //$sku_ids[]="'".$data3['response']['docs'][$i_arr]['Sku'][0]."'";
                $sku_ids[] = "'" . $data3['response']['docs'][$i_arr]['Sku'] . "'";
            }

            //sujit solr_search_log fun start
            $solar_responsedata = 0;
            $this->solr_search_log($solar_responsedata, $search_title, $data3);
            //sujit solr_search_log fun end

            $this->session->unset_userdata('prodcount_solr');
            $this->session->set_userdata('prodcount_solr', $data3['response']['numFound']);
        } else {
            $qr2 = $data2;
            $sku_ids = array();

            for ($i_arr = 0; $i_arr < count($data2['response']['docs']); $i_arr++) {
                //$sku_ids[]="'".$data2['response']['docs'][$i_arr]['Sku'][0]."'";
                $sku_ids[] = "'" . $data2['response']['docs'][$i_arr]['Sku'] . "'";
            }

            $solar_responsedata = 1;
            $this->solr_search_log($solar_responsedata, $search_title, $data2);

            
            $this->session->unset_userdata('prodcount_solr');
            $this->session->set_userdata('prodcount_solr', $data2['response']['numFound']);
        }

        $skuids_strng = implode(',', $sku_ids);
        //$qr2=$this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE  a.sku IN ($skuids_strng)  group by a.sku ");

        return $qr2;

        //----------------------------- solr search end------------------------------//
    }

    function solr_search_log($solar_responsedata, $search_txt, $data) {
        //----------------------------- solr search log start------------------------------//
        //echo $solar_responsedata;exit;
        if (@$this->session->userdata['session_data']['user_id']) {
            $user_id = @$this->session->userdata['session_data']['user_id'];
            $query = $this->db->query("select email from user where user_id='$user_id'  ");
            $user_email_id = $query->row()->email;
        } else {
            $user_email_id = '';
        }
        if ($this->agent->is_mobile()) {
            $user_device_type = 'mobile';
        } else {
            $user_device_type = "desktop";
        }

        $user_ip = $this->input->ip_address();
        //echo $user_ip;exit;
        $user_region = 'user_region';
        $user_device_os = $this->agent->platform();

        $query_string = trim(str_replace('%20', ' ', $search_txt));

        if ($solar_responsedata == 0) {
            $solar_response = 'no';
        } else {
            $solar_response = 'yes';
        }

        //echo '<pre>';print_r($data);exit;
        //Category_Lvl3 srart
        $cntt = count($data['facet_counts']['facet_fields']['Category_Lvl3']);
        if ($cntt > 60) {
            $cnt = 60;
        } else {
            $cnt = $cntt;
        }

        $Category_Lvl3 = array();
        $Category_Lvl3cnt = array();
        for ($i_arr = 0, $j_arr = 1; $i_arr < $cnt, $j_arr < $cnt; $i_arr += 2, $j_arr += 2) {
            $Category_Lvl3[] = '"' . $data['facet_counts']['facet_fields']['Category_Lvl3'][$i_arr] . '"';
            $Category_Lvl3cnt[] = $data['facet_counts']['facet_fields']['Category_Lvl3'][$j_arr];
        }
        $category_lvl3 = implode(",", $Category_Lvl3);
        $category_lvl3_count = implode(",", $Category_Lvl3cnt);
        //Category_Lvl3 end
        //Category_Lvl2 srart
        $Category_Lvl2 = array();
        $Category_Lvl2cnt = array();
        $cntLvl2 = count($data['facet_counts']['facet_fields']['Category_Lvl2']);
        for ($i_arr = 0, $j_arr = 1; $i_arr < $cntLvl2, $j_arr < $cntLvl2; $i_arr += 2, $j_arr += 2) {
            $Category_Lvl2[] = '"' . $data['facet_counts']['facet_fields']['Category_Lvl2'][$i_arr] . '"';
            $Category_Lvl2cnt[] = $data['facet_counts']['facet_fields']['Category_Lvl2'][$j_arr];
        }
        $category_lvl2 = implode(",", $Category_Lvl2);
        $category_lvl2_count = implode(",", $Category_Lvl2cnt);
        //Category_Lvl2 end
        //Category_Lvl1 srart
        $Category_Lvl1 = array();
        $Category_Lvl1cnt = array();
        $cntLvl1 = count($data['facet_counts']['facet_fields']['Category_Lvl1']);
        for ($i_arr = 0, $j_arr = 1; $i_arr < $cntLvl1, $j_arr < $cntLvl1; $i_arr += 2, $j_arr += 2) {
            $Category_Lvl1[] = '"' . $data['facet_counts']['facet_fields']['Category_Lvl1'][$i_arr] . '"';
            $Category_Lvl1cnt[] = $data['facet_counts']['facet_fields']['Category_Lvl1'][$j_arr];
        }
        $category_lvl1 = implode(",", $Category_Lvl1);
        $category_lvl1_count = implode(",", $Category_Lvl1cnt);
        //Category_Lvl1 end

        $search_sku = array();
        $search_title = array();
        for ($i_arr = 0; $i_arr < 30; $i_arr++) {
            $search_sku[] = $data['response']['docs'][$i_arr]['Sku'];
            $search_title[] = '"' . $data['response']['docs'][$i_arr]['Title'] . '"';
        }
        $search_sku = implode(",", $search_sku);
        $sku_count = $data['response']['numFound'];
        $search_title = implode(",", $search_title);


        $data = array(
            'user_email_id' => $user_email_id,
            'user_device_type' => $user_device_type,
            'user_ip' => $user_ip,
            'user_device_os' => $user_device_os,
            'query_string' => $query_string,
            'category_lvl1' => $category_lvl1,
            'category_lvl1_count' => $category_lvl1_count,
            'category_lvl2' => $category_lvl2,
            'category_lvl2_count' => $category_lvl2_count,
            'category_lvl3' => $category_lvl3,
            'category_lvl3_count' => $category_lvl3_count,
            'search_sku' => $search_sku,
            'sku_count' => $sku_count,
            'search_title' => $search_title,
            'solar_response' => $solar_response
        );
        $qr = $this->db->insert('solr_search_log', $data);


        //----------------------------- solr search log end------------------------------//
    }

    function select_more_product_search_data($search_title) {
        //echo '<pre>';print_r($_REQUEST);exit;
        $tart = $this->input->get('from');
        $limit = 50;

        set_time_limit(0);

        $search_title = trim(str_replace(' ', '%20', $search_title));

        $curl_strng = SOLR_BASE_URL . "mycollection2_offline/select?indent=on&q=" . $search_title . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=" . $limit . "&start=" . $tart . "";


        $curl2 = curl_init($curl_strng);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl2);
        $data2 = json_decode($output, true);

        if ($data2['response']['numFound'] == 0) {
            $sugword = $data2['spellcheck']['collations'][1];

            $searchsuggst_txt = trim(str_replace(' ', '%20', $sugword));
            $curl_strng = SOLR_BASE_URL . "mycollection2_offline/select?indent=on&q=" . $searchsuggst_txt . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=" . $limit . "&start=" . $tart . "";

            $curl3 = curl_init($curl_strng);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            $output3 = curl_exec($curl3);
            $data3 = json_decode($output3, true);
            $qr2 = $data3;
            //$sku_ids=array();
            //for($i_arr=0; $i_arr<count($data3['response']['docs']); $i_arr++ )
            //{
            //$sku_ids[]="'".$data3['response']['docs'][$i_arr]['Sku']."'";	
            //}			
        } else {
            /* $sku_ids=array();

              for($i_arr=0; $i_arr<count($data2['response']['docs']); $i_arr++ )
              {
              $sku_ids[]="'".$data2['response']['docs'][$i_arr]['Sku']."'";
              } */

            $qr2 = $data2;
        }

        //$skuids_strng=implode(',',$sku_ids);
        //$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id    from cornjob_productsearch a WHERE  a.sku IN ($skuids_strng)  group by a.sku ");

        return $qr2;

        //----------------------------- solr search end------------------------------//
        //----------------------------- product search as serach keyword end------------------------------//
    }

    function select_product_searchfirstcount($search_title) {
        //----------------------------- solr search start------------------------------//

        set_time_limit(0);

        $search_title = trim(str_replace(' ', '%20', $search_title));


        //$search_txt=trim(str_replace('%20','%20AND%20',$search_title));

        $curl_strng = SOLR_BASE_URL . SOLR_CORE_NAME . "/select?indent=on&q=" . $search_title . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=1&start=0";


        $curl2 = curl_init($curl_strng);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl2);
        $data2 = json_decode($output, true);

        if ($data2['response']['numFound'] == 0) {
            $sugword = $data2['spellcheck']['collations'][1];

            $searchsuggst_txt = trim(str_replace(' ', '%20', $sugword));

            $curl_strng = SOLR_BASE_URL . SOLR_CORE_NAME . "/select?indent=on&q=" . $searchsuggst_txt . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=1&start=0";


            $curl3 = curl_init($curl_strng);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            $output3 = curl_exec($curl3);
            $data3 = json_decode($output3, true);

            $sku_ids = array();

            for ($i_arr = 0; $i_arr < count($data3['response']['docs']); $i_arr++) {
                //$sku_ids[]="'".$data3['response']['docs'][$i_arr]['Sku'][0]."'";
                $sku_ids[] = "'" . $data3['response']['docs'][$i_arr]['Sku'] . "'";
            }
        } else {
            $sku_ids = array();

            for ($i_arr = 0; $i_arr < count($data2['response']['docs']); $i_arr++) {
                //$sku_ids[]="'".$data2['response']['docs'][$i_arr]['Sku'][0]."'";
                $sku_ids[] = "'" . $data2['response']['docs'][$i_arr]['Sku'] . "'";
            }
        }

        $skuids_strng = implode(',', $sku_ids);
        $qr2 = $this->db->query("select a.sku,a.product_id  from cornjob_productsearch a WHERE  a.sku IN ($skuids_strng)  group by a.sku order by a.product_id DESC LIMIT 1");

        return $qr2;



        //----------------------------- solr search end------------------------------//
    }

}

?>