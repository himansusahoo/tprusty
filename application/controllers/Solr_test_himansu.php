<?php

//require_once APPPATH . "/third_party/php_solr/bootstrap.php";
//himansu_core
define('SOLR_BASE_URL_TEST', "http://moonboy.in:8984/solr/");
//define('SOLR_COLLECTION_TEST', "himansu_core/");
define('SOLR_COLLECTION_TEST', "moonboy_solr/");

//define('SOLR_BASE_URL', "http://moonboy.in:8983/solr/himansu_core/");

class Solr_test_himansu extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function solr_test() {
        $options = array
            (
            'hostname' => SOLR_SERVER_HOSTNAME,
            'login' => SOLR_SERVER_USERNAME,
            'password' => SOLR_SERVER_PASSWORD,
            'port' => SOLR_SERVER_PORT,
        );

        $client = new SolrClient($options);

        $doc = new SolrInputDocument();

        $doc->addField('id', 334455);
        $doc->addField('cat', 'Software');
        $doc->addField('cat', 'Lucene');

        $updateResponse = $client->addDocument($doc);
        pma($updateResponse, 1);
        print_r($updateResponse->getResponse());
    }

//http://moonboy.in:8983/solr/himansu_core/select?indent=on&q=*:*&wt=json
    public function solr_con_test() {
        $curl = curl_init(SOLR_BASE_URL_TEST . SOLR_COLLECTION_TEST . "admin/ping/?wt=json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $data = json_decode($output, true);
        echo "Ping Status : " . $data["status"] . PHP_EOL;
        exit;
    }

    public function get_solr_data($search_text = 'LINU') {
        if ($search_text) {
            $solr_colection = SOLR_CORE_NAME;
            //$curl_init = curl_init(SOLR_BASE_URL . $solr_colection . "/update?wt=json&spellcheck=true&spellcheck.build=true&commit=true");
            //$curl_query = SOLR_BASE_URL . "" . $solr_colection . "/select?q=sku:" . $search_text . "&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";
            $curl_query = SOLR_BASE_URL_TEST . SOLR_COLLECTION_TEST . "select?indent=on&q=*:*&wt=json";
            $curl_init = curl_init($curl_query);
            curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($curl_init);
            $data = json_decode($output, true);
            pma($data, 1);
        } else {
            echo "Pass search string in url";
        }
    }

    public function add_solr_doc() {
        $ch = curl_init(SOLR_BASE_URL_TEST . SOLR_COLLECTION_TEST . "update?wt=json&spellcheck=true&spellcheck.build=true");
        $data = array(
            "add" => array(
                "doc" => array(
                    "Sku" => 's1',
                    "Title" => 's1 title'
                ),
                "commitWithin" => 1000,
            ),
        );

        /* $data = Array
          (
          'add' => Array
          (
          'doc' => Array
          (
          'Title' => 'Dhanu Fashion Latest Design Blue Color Printed Saree With Blouse Piece TTT',
          'Category_Lvl1' => 'Women\'s Fashion',
          'Category_Lvl2' => 'Ethnic Wear',
          'Category_Lvl3' => 'Saree',
          'Category_Lvl1_Id' => 4,
          'Category_Lvl2_Id' => 32,
          'Category_Lvl3_Id' => 223,
          'Sku' => 'TFLE-1199-SGN002HIMA',
          'Product_Id' => 4702,
          'Seller_Name' => 'Dhanu Fashion',
          'Catalog_Image' => 'catalog_bg7varxmqbhtvky20181127211955.jpg',
          'Mrp' => 2249,
          'Price' => 799,
          'Special_Price' => 0,
          'status' => 'Enabled',
          'quantity' => 500,
          'seller_status' => 'Active',
          'prod_status' => 'Active',
          'Brand' => 'Dhanu Fashion',
          'Color' => 'Blue',
          'Weight' => '500 Grams',
          'Suitable_For' => 'Women',
          'Type' => 'Saree',
          'Width' => '3CM',
          'Occasion' => 'Festival, Party-Wear, Wedding, Ceremony',
          ),
          'commitWithin' => 1000
          )
          ); */
        $data_string = json_encode($data);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        pma($response, 1);
    }

    public function del_solr_doc() {

        $ch = SOLR_BASE_URL_TEST . SOLR_COLLECTION_TEST . "update?commit=true&stream.body=<delete><query>Sku:s1</query></delete>";

        $curl2 = curl_init($ch);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl2);
        //$response = json_decode($response, true);
        pma($response, 1);
    }

    public function del_all_solr_doc() {

        $ch = SOLR_BASE_URL_TEST . SOLR_COLLECTION_TEST . "update?commit=true&stream.body=<delete><query>*:*</query></delete>";

        $curl2 = curl_init($ch);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl2);
        //$response = json_decode($response, true);
        pma($response, 1);
    }

}
