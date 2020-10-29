<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MX_Controller {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function __construct() {
        parent::__construct();

        //$this->load->model('app_route');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_lte';
        $this->layout->layoutsFolder = 'layouts/admin_lte';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Index Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function index() {

        $this->breadcrumbs->push('Reports', 'all-reports');
        $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'js');
        $this->layout->navTitle = 'Reports';
        $this->layout->title = 'Reports';
        $this->layout->render();
    }

    public function gen_table() {

        //table header
        $dt_header = array(
            array(
                'db_column' => 'first_name',
                'title' => 'First Name',
                'class_name' => 'dt_first_name',
                'orderable' => 'false',
                'visible' => 'true'
            ), array(
                'db_column' => 'last_name',
                'title' => 'Last Name',
                'class_name' => 'dt_last_name',
                'orderable' => 'false',
                'visible' => 'true'
            ),
            array(
                'db_column' => 'email',
                'title' => 'Email',
                'class_name' => 'dt_email',
                'orderable' => 'false',
                'visible' => 'true'
            ),
            array(
                'db_column' => 'mobile',
                'title' => 'Mobile',
                'class_name' => 'dt_mobile',
                'orderable' => 'false',
                'visible' => 'true'
            ),
            array(
                'db_column' => 'user_type',
                'title' => 'User Type',
                'class_name' => 'dt_usertype',
                'orderable' => 'false',
                'visible' => 'true'
            )
        );

        $config = array(
            'dt_markup' => TRUE,
            'dt_id' => 'raw_cert_data_dt_table',
            'dt_header' => $dt_header,
            //'dt_extra_header' => $dt_extra_head,
            //'dt_post_data' => 'filters',
            'dt_ajax' => array(
                'dt_url' => 'employee-list'
            ),
            'custom_lengh_change' => true,
            'dt_dom' => '<<"row " <"col-md-3 no_rpad" <"col-sm-10 custom_length_box no_pad "><"col-sm-2 custom_length_box_all no_pad ">><"col-md-9 no-pad " <"col-md-12 no-pad" <" marginR20" f>>>><t><"row marginT10" <"col-md-12 no-pad" <"col-md-12 no-pad" <"page-jump pull-right col-sm-6" <"pull-right marginL20" p>>>>>',
            'options' => array(
                'iDisplayLength' => '5'
            )
        );

        $this->load->library('sdp_datatable');
        $dt_data = $this->mb_datatable->generate_grid($config);
        echo json_encode(array("status" => 'success', 'data' => $dt_data));
        exit;
    }

}
