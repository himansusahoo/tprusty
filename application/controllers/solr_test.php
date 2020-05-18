<?php

class Solr_test extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function solr_connect() {
        $curl = curl_init(SOLR_BASE_URL .SOLR_CORE_NAME. "/admin/ping/?wt=json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $data = json_decode($output, true);
        echo "Ping Status : " . $data["status"] . PHP_EOL;
    }

    public function get_solr_data($search_text = 'LINU') {
        if ($search_text) {
            $solr_colection = SOLR_CORE_NAME;
            //$curl_init = curl_init(SOLR_BASE_URL . $solr_colection . "/update?wt=json&spellcheck=true&spellcheck.build=true&commit=true");
            //$curl_query = SOLR_BASE_URL . "" . $solr_colection . "/select?q=sku:" . $search_text . "&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";
            $curl_query = SOLR_BASE_URL.$solr_colection."/select?sku=KPYG-395-shree-72&wt=json";
            $curl_init = curl_init($curl_query);
            curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($curl_init);
            $data = json_decode($output, true);            
        } else {
            echo "Pass search string in url";
        }
    }

}
