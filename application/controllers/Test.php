<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->database();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        //$this->load->helper(array('solariumphp/library/solarium/Autoloader', 'file'));
        //$this->load->library('email');
        //$this->load->library('session');
        //$this->load->library('upload');
        //$this->load->library('encrypt');
        //$this->load->library('javascript');
        //$this->load->library('pagination');
        //$this->load->helper('string');
        //$this->load->helper('cookie');
        //$this->load->library('user_agent');
        //$this->load->model('Product_descrp_model');
        //$this->load->model('Mycart_model');
        //$this->load->library('breadcrumbs');
        //$this->load->model('Admin_model');
    }

    function index() {
        echo phpinfo();
        exit;
    }

    function update_desktopmenuas_categorydisplay() {
        $qr = $this->db->query("SELECT * FROM `category_menu_desktop` WHERE `parent_id` in (select `dskmenu_lbl_id` from `category_menu_desktop` WHERE `parent_id`=0) ");

        foreach ($qr->result_array() as $res_catg) {
            $dsklblid = $res_catg['dskmenu_lbl_id'];
            $this->db->query("UPDATE category_menu_desktop SET view_type='category' WHERE dskmenu_lbl_id='$dsklblid' ");
        }

        echo "Finish";
        exit;
    }

    function solr_test() {
        /*
          $ch = curl_init(SOLR_BASE_URL."mycollection1/update?wt=json");

          $data = array(
          "add" => array(
          "doc" => array(
          "sku"   => "HW2212",
          "title" => "Hello World 2"
          ),
          "commitWithin" => 1000,
          ),
          );
          $data_string = json_encode($data);

          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_POST, TRUE);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

          $response = curl_exec($ch);

          $data2 = json_decode($response, true);

          print_r( $data2);
         */

        /* if  (in_array  ('curl', get_loaded_extensions())) {



          echo "CURL is available on your web server";



          }  else {

          echo "CURL is not available on your web server";

          }
         */ $curl = curl_init(SOLR_BASE_URL . "mycollection2_online/admin/ping/?wt=json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $data = json_decode($output, true);
        echo "Ping Status : " . $data["status"] . PHP_EOL;






        exit;
    }

    function remove_allindex() {
        $curl_strng = SOLR_BASE_URL . "mycollection2_online/update?stream.body=<delete><query>*:*</query></delete>&commit=true";
        $curl2 = curl_init($curl_strng);
        $output = curl_exec($curl2);
        $data2 = json_decode($output, true);

        echo $data2 . PHP_EOL;
    }

    function delete_collection() {

        $curl_strng = SOLR_BASE_URL . "admin/collections?action=DELETE&name=mycollection1_online";
        $curl2 = curl_init($curl_strng);
        $output = curl_exec($curl2);
        $data2 = json_decode($output, true);

        echo $data2 . PHP_EOL;
    }

    function add_prodindex() {
        set_time_limit(0);
        $query = $this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,lvlmain_name from cornjob_productsearch a  WHERE a.quantity>0 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND a.product_id>0  group by a.sku  ");

        $ch = curl_init(SOLR_BASE_URL . "mycollection1/update?wt=json&spellcheck=true&spellcheck.build=true");

        foreach ($query->result_array() as $res_prod) {
            $data = array();

            $data = array(
                "add" => array(
                    "doc" => array(
                        "product_id" => $res_prod['product_id'],
                        "name" => $res_prod['name'],
                        "sku" => $res_prod['sku'],
                        "lvl2_name" => $res_prod['lvl2_name'],
                        "lvl1_name" => $res_prod['lvl1_name'],
                        "lvlmain_name" => $res_prod['lvlmain_name'],
                    ),
                    "commitWithin" => 1000,
                ),
            );
            $data_string = json_encode($data);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            $response = curl_exec($ch);

            $data2 = json_decode($response, true);
            //echo $res_prod['sku']."----- ";
//			print_r( $data2);
//			echo "<br><br>================<br><br>";

            $skuid = $res_prod['sku'];
            $this->db->query("UPDATE solar_indexing SET indexing_status='Completed' WHERE sku='$skuid' ");
        }
    }

    function search_data() {
        $search_txt = "mobile";



        //$curl_strng = SOLR_BASE_URL."mycollection1/select?indent=on&q=lvl2_name:".$search_txt."&wt=json&spellcheck=true&spellcheck.build=true&defType=edismax";
        //$curl_strng = SOLR_BASE_URL."mycollection1/select?q=lvl2_name:".$search_txt."&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";

        $curl_strng = SOLR_BASE_URL . "mycollection1/spell?q=SAMSUnG%20Mobl%20FCS%20Printed&wt=php&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";

        //$curl_strng=SOLR_BASE_URL."mycollection1/select?indent=on&q=*:*&rows=1000&start=0&wt=json";



        $curl2 = curl_init($curl_strng);
        $output = curl_exec($curl2);
        $data2 = json_decode($output, true);

        echo $data2 . PHP_EOL;
    }

    function clear_allcachefl() {
        //$this->db->cache_on();

        $this->db->cache_delete_all();


        //$this->db->cache_off();
    }

    function update_indexstatus() {
        $qr = $this->db->query("SELECT sku FROM solar_indexing WHERE indexing_status='Pending' ");

        foreach ($qr->result_array() as $res_solr) {
            $search_txt = $res_solr['sku'];
            $ch = SOLR_BASE_URL . "mycollection1/select?q=sku:" . $search_txt . "&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";



            $curl2 = curl_init($ch);
            curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($curl2);
            $data2 = json_decode($output, true);


            $skuid = $res_solr['sku'];

            if ($data2['response']['numFound'] == 1) {
                $this->db->query("UPDATE solar_indexing SET indexing_status='Completed' WHERE sku='$skuid' ");
            }

            if ($data2['response']['numFound'] > 1) {

                $curl_dlt = SOLR_BASE_URL . "mycollection1/update?commit=true -H 'Content-Type: text/xml' --data-binary '<delete><sku>" . $skuid . "</sku></delete>'";


                $curl3 = curl_init($curl_dlt);
                curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($curl3);
                $data3 = json_decode($output, true);

                if ($data3['responseHeader']['status'] == 0) {
                    $this->db->query("UPDATE solar_indexing SET indexing_status='Pending' WHERE sku='$skuid' ");
                }
            }
        }
    }

    /* function addsolr_indesing()	
      {
      set_time_limit(0);


      $query=$this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,lvlmain_name,a.brand,
      a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id FROM cornjob_productsearch a
      INNER JOIN solar_indexing b ON a.sku=b.sku
      WHERE b.indexing_status='Pending' group by a.sku  ");

      $ch = curl_init(SOLR_BASE_URL."mycollection1/update?wt=json&spellcheck=true&spellcheck.build=true");

      foreach($query->result_array() as $res_prod)
      {
      $search_txt=$res_prod['sku'];

      $ch2= SOLR_BASE_URL."mycollection1/select?q=sku:".$search_txt."&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";


      $curl2 = curl_init($ch2);
      curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
      $output = curl_exec($curl2);
      $data1 = json_decode($output, true);


      $skuid=$res_prod['sku'];

      if($data1['response']['numFound']>0)

      {$this->db->query("UPDATE solar_indexing SET indexing_status='Completed' WHERE sku='$skuid' ");}

      else
      {


      $selr_id=$res_prod['seller_id'];
      $skuid=$res_prod['sku'];
      $qr_seller=$this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$selr_id' ");

      $seller_name=$qr_seller->row()->business_name;

      $qrattr_sku=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' ");
      $model_num='';
      foreach($qrattr_sku->result_array() as $res_attribte)
      { $attrb_id=$res_attribte['attr_id'];
      $qr_attrbfld=$this->db->query("SELECT attribute_field_name FROM attribute_real
      WHERE attribute_id='$attrb_id' AND
      (attribute_field_name LIKE '%Model%'
      OR attribute_field_name LIKE '%Model  Number%'
      OR attribute_field_name LIKE '%Model ID%'
      OR attribute_field_name LIKE '%Model Name%'
      OR attribute_field_name LIKE '%Model No%'
      OR attribute_field_name LIKE '%Model Number%'
      OR attribute_field_name LIKE '%Model Series%'
      OR attribute_field_name LIKE '%Model Series Name%'
      OR attribute_field_name LIKE '%Vehicle Model%'
      ) ");
      if($qr_attrbfld->num_rows()>0)
      {
      $model_num=	$res_attribte['attr_value'];
      }

      }


      $data=array();

      $data = array(
      "add" => array(
      "doc" => array(
      "product_id"   => $res_prod['product_id'],
      "name" => $res_prod['name'],
      "sku" => $res_prod['sku'],
      "lvl2_name" => $res_prod['lvl2_name'],
      "lvl1_name" => $res_prod['lvl1_name'],
      "lvlmain_name" => $res_prod['lvlmain_name'],
      "brand"=>$res_prod['brand'],
      "color"=>$res_prod['color'],
      "Capacity"=>$res_prod['Capacity'],
      "RAM"=>$res_prod['RAM'],
      "ROM"=>$res_prod['ROM'],
      "seller_name"=>$seller_name,
      "model_number"=>$model_num

      ),
      "commitWithin" => 1000,
      ),
      );
      $data_string = json_encode($data);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

      $response = curl_exec($ch);

      $data2 = json_decode($response, true);



      if($data2['responseHeader']['status']==0)

      {$this->db->query("UPDATE solar_indexing SET indexing_status='Completed' WHERE sku='$skuid' ");	}


      } // sku check else conditions end
      }



      } */

    function addsolr_indesing() {
        /* set_time_limit(0);		

          if(base_url()=='https://www.moonboy.in/')
          {$solr_colection='mycollection2_online';}
          else
          {
          $solr_colection='mycollection2_online';
          }
          $query=$this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,a.lvlmain_name,a.brand,
          a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id,a.imag,a.mrp,a.price,a.special_price,
          a.special_pric_from_dt,a.special_pric_to_dt,a.lvlmain,a.lvl1,a.lvl2,a.status,a.quantity,a.seller_status,a.prod_status
          FROM cornjob_productsearch a
          INNER JOIN solar_indexing b ON a.sku=b.sku
          WHERE b.indexing_status='Pending' and b.prod_process_status='Add' group by a.sku");

          $ch = curl_init(SOLR_BASE_URL."".$solr_colection."/update?wt=json&spellcheck=true&spellcheck.build=true");

          foreach($query->result_array() as $res_prod)
          {
          $search_txt=$res_prod['sku'];



          $selr_id=$res_prod['seller_id'];
          $skuid=$res_prod['sku'];
          $qr_seller=$this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$selr_id' ");

          $seller_name=$qr_seller->row()->business_name;

          $qrattr_sku=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' GROUP BY attr_id ");
          $attrb_combn=array();
          if($qrattr_sku->num_rows()>0)
          {
          $attrbchk_val=array();

          foreach($qrattr_sku->result_array() as $res_atrbfldlbl)
          {	$attrb_id=$res_atrbfldlbl['attr_id'];
          $qr_attrbfld=$this->db->query("SELECT attribute_field_name FROM attribute_real WHERE attribute_id='$attrb_id' GROUP BY attribute_id ");

          $attrbfld_nm=$qr_attrbfld->row()->attribute_field_name;
          $attrbchk_val[]="'".str_replace("&",'',str_replace("'",'',$attrbfld_nm))."'";
          }

          $attrbchk_valstrng=implode(',',$attrbchk_val);
          $model_num='';

          $qr_attrbfld=$this->db->query("SELECT distinct attrb_name,solr_filed_nm FROM solr_product_attribute  WHERE attrb_name IN ($attrbchk_valstrng) ");

          $arr_condition='';

          $attrb_ky=array();
          $attrb_vl=array();
          $attrb_combn=array();

          if($qr_attrbfld->num_rows()>0)
          {
          foreach($qr_attrbfld->result_array() as $res_prodattarrfld)
          {
          $attrb_realnfldame=trim($res_prodattarrfld['attrb_name']);

          $qrattr_sku=$this->db->query("SELECT a.attr_value FROM seller_product_attribute_value a
          INNER JOIN attribute_real b ON a.attr_id=b.attribute_id
          WHERE a.sku='$skuid' AND b.attribute_field_name='$attrb_realnfldame'
          GROUP BY a.attr_id ");

          $prod_actualattrbval=$qrattr_sku->row()->attr_value;
          $attrb_ky[]=$res_prodattarrfld['solr_filed_nm'];
          $attrb_vl[]=$prod_actualattrbval;

          }
          }
          $attrb_combn=array_combine($attrb_ky,$attrb_vl);
          }
          $data=array();

          $data = array(
          "add" => array(
          "doc" => array(
          "Title" => $res_prod['name'],
          "Category_Lvl1" => $res_prod['lvlmain_name'],
          "Category_Lvl2" => $res_prod['lvl1_name'],
          "Category_Lvl3" => $res_prod['lvl2_name'],
          "Category_Lvl1_Id"=>$res_prod['lvlmain'],
          "Category_Lvl2_Id"=>$res_prod['lvl1'],
          "Category_Lvl3_Id"=>$res_prod['lvl2'],
          "Sku" => $res_prod['sku'],
          "Product_Id"   => $res_prod['product_id'],
          "Seller_Name"=>$seller_name,
          "Catalog_Image"=>$res_prod['imag'],
          "Mrp"=>$res_prod['mrp'],
          "Price"=>$res_prod['price'],
          "Special_Price"=>$res_prod['special_price'],
          "status"=>$res_prod['status'],
          "quantity"=>$res_prod['quantity'],
          "seller_status"=>$res_prod['seller_status'],
          "prod_status"=>$res_prod['prod_status'],

          ),
          "commitWithin" => 1000,
          ),
          );

          if($res_prod['special_pric_from_dt']!='0000-00-00' && $res_prod['special_pric_to_dt']!='0000-00-00')
          {

          $data['add']['doc']['Special_Price_From_Date']=$res_prod['special_pric_from_dt'].'T00:00:00Z';
          $data['add']['doc']['Special_Price_To_Date']=$res_prod['special_pric_to_dt'].'T00:00:00Z';

          }

          if(count($attrb_combn)>0)
          {	foreach($attrb_combn as $ky=>$vl)
          {
          if($vl!='')
          {$data['add']['doc'][$ky]=$vl;}

          }
          }


          $data_string = json_encode($data);

          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_POST, TRUE);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

          $response = curl_exec($ch);

          $data2 = json_decode($response, true);

          //print_r($data2);

          //echo "<br><br>";
          $dt = date('Y-m-d H:i:s');
          if($data2['responseHeader']['status']==0)
          {$this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt' WHERE sku='$skuid' AND prod_process_status='Add' ");	}
          else
          {	echo $err_msg=str_replace("'",'',$data2['error']['msg']);
          $this->db->query("UPDATE solar_indexing SET error_msg='$err_msg',last_indexdtm='$dt' WHERE sku='$skuid' AND prod_process_status='Add' ");
          }



          }

         */
    }

    function addsolr_indesingofflinetest() {

        set_time_limit(0);

        if (base_url() == 'https://www.moonboy.in/') {
            $solr_colection = 'mycollection2_online';
        } else {
            $solr_colection = 'mycollection2_online';
        }
        $query = $this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,a.lvlmain_name,a.brand,
                                 a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id,a.imag,a.mrp,a.price,a.special_price,
								 a.special_pric_from_dt,a.special_pric_to_dt,a.lvlmain,a.lvl1,a.lvl2,a.status,a.quantity,a.seller_status,a.prod_status 
								 FROM cornjob_productsearch a
								 INNER JOIN solar_indexing b ON a.sku=b.sku  
								 group by a.sku LIMIT 5000");

        $ch = curl_init(SOLR_BASE_URL . "" . $solr_colection . "/update?wt=json&spellcheck=true&spellcheck.build=true&commit=true");

        foreach ($query->result_array() as $res_prod) {
            $search_txt = $res_prod['sku'];



            $selr_id = $res_prod['seller_id'];
            $skuid = $res_prod['sku'];
            $qr_seller = $this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$selr_id' ");

            $seller_name = $qr_seller->row()->business_name;

            $qrattr_sku = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' GROUP BY attr_id ");
            $attrb_combn = array();
            if ($qrattr_sku->num_rows() > 0) {
                $attrbchk_val = array();

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
            }
            $data = array();

            $data = array(
                "add" => array(
                    "doc" => array(
                        "Title" => $res_prod['name'],
                        "Category_Lvl1" => $res_prod['lvlmain_name'],
                        "Category_Lvl2" => $res_prod['lvl1_name'],
                        "Category_Lvl3" => $res_prod['lvl2_name'],
                        "Category_Lvl1_Id" => $res_prod['lvlmain'],
                        "Category_Lvl2_Id" => $res_prod['lvl1'],
                        "Category_Lvl3_Id" => $res_prod['lvl2'],
                        "Sku" => $res_prod['sku'],
                        "Product_Id" => $res_prod['product_id'],
                        "Seller_Name" => $seller_name,
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
                        $data['add']['doc'][$ky] = $vl;
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

            //print_r($data2);
            //echo "<br><br>";
            $dt = date('Y-m-d H:i:s');
            if ($data2['responseHeader']['status'] == 0) {
                $this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt' WHERE sku='$skuid' AND prod_process_status='Add' ");
            } else {
                echo $err_msg = str_replace("'", '', $data2['error']['msg']);
                $this->db->query("UPDATE solar_indexing SET indexing_status='Pending', error_msg='$err_msg',last_indexdtm='$dt' WHERE sku='$skuid' AND prod_process_status='Add' ");
            }
        }
    }

    public function my_test() {
        echo phpinfo();
    }

    public function solr_del_indx() {
        $skuid = 'KPYG-395-shree-726';
        $solr_colection = 'mycollection2_online';
        $host = "http://moonboy.in:8983/solr/";
        $curl_url = $host . $solr_colection . "/update?wt=json&spellcheck=true&spellcheck.build=true&commit=true";
        $ch = curl_init($curl_url);

        pma($curl_url);
        $data_string = '{"add":{"doc":{"Title":"Shreenathji Enterprise Designer Lehenga Choli For Women","Category_Lvl1":"Women\'s Fashion","Category_Lvl2":"Ethnic Wear","Category_Lvl3":"Lehenga Choli","Category_Lvl1_Id":"4","Category_Lvl2_Id":"32","Category_Lvl3_Id":"1012","Sku":"KPYG-395-shree-726","Product_Id":"2601","Seller_Name":"SHREENATHJI ENTERPRISE","Catalog_Image":"catalog_jiigfwytkcze7jo20180129141957.jpg","Mrp":"2191","Price":"1327","Special_Price":"0","status":"Enabled","quantity":"12","seller_status":"Active","prod_status":"Active","Brand":"Shreenathji Enterprise","Color":"Green","Size":"Free","Weight":"400 Grams","Suitable_For":"Girls & Women","Type":"Lehenga Choli","Occasion":"Wedding, Festivals, Party"},"commitWithin":1000}}';
        $data_string = json_decode($data_string, true);
        $data_string = json_encode($data_string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);


        $response = curl_exec($ch);
        pma($response, 1);
        $data3 = json_decode($response, true);
        pma($data3, 1);
    }

}

?>
