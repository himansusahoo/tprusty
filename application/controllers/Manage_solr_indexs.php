<?php

class Manage_solr_indexs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));        
		$this->load->database();
        $this->load->library('session');
        $this->load->model('Manage_solr_index');
    }

    public function index() {
        $data=$this->Manage_solr_index->get_all_solr_index();
        pma($data,1);
    }

    /**
     * @param  : 
     * @desc   : used to create newly added product indexes
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function manage_solr_index() {
        $this->Manage_solr_index->manage_index();
    }
    /**
     * @param  : 
     * @desc   : delete all solr index
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function delete_all_index() {
        $this->Manage_solr_index->delete_all_index();
    }

}
