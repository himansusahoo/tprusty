<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_gst_reports extends CI_Controller {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS     
     */
    public function __construct() {
        parent::__construct();
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
        $this->load->model('report');
        $this->_highestRoleCode = $this->rbac->get_highest_role();
    }

    private $_highestRoleCode = '';

    /**
     * @param  : 
     * @desc   : fetch GST report data list
     * @return : void
     * @author : HimansuS
     */
    public function index() {
        if ($this->rbac->has_permission('REPORTS', 'SELLER_GST_REPO')) {
            $this->breadcrumbs->push('Reports', 'all-reports');
            $this->breadcrumbs->push('seller-gst-reports', base_url('seller-gst-reports'));
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen', 'promise'), 'js');
            $this->layout->navTitle = 'Seller GST Reports';
            $this->layout->title = 'Seller GST Reports';

            $data = array(
                'data' => array()
            );

            $data['data']['dates'] = $this->report->get_min_max_date();
            $data['data']['seller_list'] = $this->report->get_seller_option_list();
            if ($this->rbac->is_admin() || $this->rbac->is_developer() || $this->rbac->has_role('ADMIN_STAFF')) {
                //No action required
            } else {
                $data['view'] = 'seller_gst_reports/seller_gst_report';
            }
            $this->layout->render($data);
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @name seller_gst_grid
     * @param void
     * @desc used to prepare grid configs
     * @return void
     */
    public function seller_gst_grid_data() {
        if ($this->input->is_ajax_request()) {
            //return tables columns as string
            $columns = $this->rbac->grid_xpath_headers('reports/seller_gst_report/' . strtolower($this->_highestRoleCode), 'string');
            $condition = $this->input->post();
            $returned_list = $this->report->get_seller_gst_report_datatable(strtolower($columns), $condition);
            echo $returned_list;
            exit();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @name seller_gst_grid
     * @param void
     * @desc used to prepare grid configs
     * @return void
     */
    public function seller_gst_grid_config() {
        if ($this->input->is_ajax_request()) {
            $header = $this->rbac->grid_xpath_headers('reports/seller_gst_report/' . strtolower($this->_highestRoleCode));

            $dt_tool_btn = array();

            if ($this->rbac->has_permission('REPORTS', 'XLS_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-warning',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'XLS',
                    'btn_text' => '<span class="fa fa-file-excel-o"></span> Excel',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_xls"'
                );
            }
            if ($this->rbac->has_permission('REPORTS', 'CSV_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'CSV',
                    'btn_text' => '<span class="fa fa-file-text-o"></span> CSV',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_csv"'
                );
            }

            $dt_tool_btn = get_link_buttons($dt_tool_btn);

            $config = array(
                'dt_markup' => true,
                'dt_id' => 'seller_gst_data_grid',
                'dt_header' => $header,
                'dt_ajax' => array(
                    'dt_url' => base_url('seller-gst-reports-data'),
                //'dt_param' => '{custom_search:{first_name:"himansu"}}'
                ),
                'custom_lengh_change' => false,
                'dt_dom' => array(
                    'top_dom' => true,
                    'top_length_change' => true,
                    'top_filter' => true,
                    'top_buttons' => $dt_tool_btn,
                    'top_pagination' => true,
                    'buttom_dom' => true,
                    'buttom_length_change' => true,
                    'buttom_pagination' => true
                ),
                'order' => array(
                    array(
                        'column' => 'DATE(date_of_order)',
                        'order' => 'asc'
                    )
                )
            );

            $condition = $this->input->post();
            if (is_array($condition) && array_key_exists('custom_search', $condition)) {
                $filterCondition = array(
                    'custom_search' => $this->_prepare_condition($condition)
                );
                $config['dt_ajax']['dt_param'] = json_encode($filterCondition);
            }
            $this->load->library('c_datatable');
            $dt_data = $this->c_datatable->generate_grid($config);
            echo $dt_data;
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param              : void
     * @desc               :used to export grid data
     * @return             :download grid data
     * @author             :HimansuS
     */
    public function export_grid_data() {

        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('REPORTS', 'XLS_EXPORT') || $this->rbac->has_permission('REPORTS', 'CSV_EXPORT')) {
                $postData = $this->input->post();
                $export_type = $postData['export_type'];
                unset($postData['export_type']);
                $condition = array(
                    'custom_search' => $this->_prepare_condition($postData)
                );
                $tableHeading = $this->rbac->grid_xpath_headers('reports/seller_gst_report/' . strtolower($this->_highestRoleCode), 'head');
                $columns = strtolower($this->rbac->grid_xpath_headers('reports/seller_gst_report/' . strtolower($this->_highestRoleCode), 'string'));

                //add single code on the value so that it will display properly in excel
                $columns = str_replace(array('order_id', 'tracking_no'), array('concat("\'",order_id) as order_id', 'concat("\'",tracking_no) as tracking_no'), $columns);

                $data = $this->report->get_seller_gst_report_datatable($columns, $condition, true, $tableHeading);

                $head_cols = $body_col_map = array();
                $date = array(
                    array(
                        'title' => 'Date of Export Report',
                        'value' => date('d-m-Y')
                    )
                );
                foreach ($tableHeading as $db_col => $col) {
                    $head_cols[] = array(
                        'title' => ucfirst($col),
                        'track_auto_filter' => 1
                    );
                    $body_col_map[] = array('db_column' => $db_col);
                }
                $header = array($date, $head_cols);
                $worksheet_name = 'Seller GST Report';
                $file_name = 'seller_gst_repo_' . date('d_m_Y_H_i_s') . '.' . $export_type;
                $config = array(
                    'db_data' => $data['aaData'],
                    'header_rows' => $header,
                    'body_column' => $body_col_map,
                    'worksheet_name' => $worksheet_name,
                    'file_name' => $file_name,
                    'download' => true
                );

                $this->load->library('excel_utility');
                $this->excel_utility->download_excel($config, $export_type);
                ob_end_flush();
                exit;
            } else {
                $this->layout->render(array('error' => '401'));
            }
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @name _prepare_condition
     * @param Array $condition
     * @desc used to prepare filter condition string
     * @return String $condition
     * @author HimansuS
     */
    private function _prepare_condition($condition) {
        //date condition for from and to date
        $custom_search = "";
        if (is_array($condition) && array_key_exists('custom_search', $condition)) {
            if (array_key_exists('from_year', $condition['custom_search']) && array_key_exists('from_month', $condition['custom_search']) && array_key_exists('to_year', $condition['custom_search']) && array_key_exists('to_month', $condition['custom_search'])
            ) {
                $toDate = $condition['custom_search']['to_year'] . '-' . $condition['custom_search']['to_month'] . '-01';
                $lastToDate = date("t", strtotime("$toDate"));

                $fromDate = $condition['custom_search']['from_year'] . '-' . $condition['custom_search']['from_month'] . '-' . '01';
                $toDate = $condition['custom_search']['to_year'] . '-' . $condition['custom_search']['to_month'] . '-' . $lastToDate;
                unset($condition['custom_search']['to_year'], $condition['custom_search']['to_month'], $condition['custom_search']['from_year'], $condition['custom_search']['from_month']);
                $custom_search = "DATE_FORMAT(date_of_order,'%Y-%m') between DATE_FORMAT('$fromDate','%Y-%m') and DATE_FORMAT('$toDate','%Y-%m')";
            } else if (array_key_exists('from_year', $condition['custom_search']) && array_key_exists('from_month', $condition['custom_search'])) {
                $fromDate = $condition['custom_search']['from_year'] . '-' . $condition['custom_search']['from_month'] . '-' . '01';
                $custom_search = "DATE_FORMAT(date_of_order,'%Y-%m')=DATE_FORMAT('$fromDate','%Y-%m')";
            } else if (array_key_exists('from_year', $condition['custom_search'])) {
                $fromDate = $condition['custom_search']['from_year'] . '-' . $condition['custom_search']['from_month'] . '-' . '01';
                $custom_search = "DATE_FORMAT(date_of_order,'%Y')=DATE_FORMAT('$fromDate','%Y')";
            }
            if (array_key_exists('seller_id', $condition['custom_search'])) {
                if ($custom_search != '') {
                    $custom_search.=' AND seller_id=' . $condition['custom_search']['seller_id'];
                } else {
                    $custom_search = ' seller_id=' . $condition['custom_search']['seller_id'];
                }
            }
        }
        return $custom_search;
    }

}
