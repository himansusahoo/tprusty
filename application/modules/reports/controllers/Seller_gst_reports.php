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
     * @since   08/25/2019
     */
    public function __construct() {
        parent::__construct();
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
        $this->load->model('report');
    }

    /**
     * @param  : 
     * @desc   : fetch employee list
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function index() {
        if ($this->rbac->has_permission('REPORTS', 'SELLER_GST_REPO')) {
            $this->breadcrumbs->push('Reports', 'all-reports');
            $this->breadcrumbs->push('seller-gst-reports', base_url('seller-gst-reports'));
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'js');
            $this->layout->navTitle = 'Seller GST Reports';
            $this->layout->title = 'Seller GST Reports';
            $header = array(
                array(
                    'db_column' => 'first_name',
                    'name' => 'First_name',
                    'title' => 'First name',
                    'class_name' => 'first_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'last_name',
                    'name' => 'Last_name',
                    'title' => 'Last name',
                    'class_name' => 'last_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'login_id',
                    'name' => 'Login_id',
                    'title' => 'Login id',
                    'class_name' => 'login_id',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'email',
                    'name' => 'Email',
                    'title' => 'Email',
                    'class_name' => 'email',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'login_status',
                    'name' => 'Login_status',
                    'title' => 'Login status',
                    'class_name' => 'login_status',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'mobile',
                    'name' => 'Mobile',
                    'title' => 'Mobile',
                    'class_name' => 'mobile',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'mobile_verified',
                    'name' => 'Mobile_verified',
                    'title' => 'Mobile verified',
                    'class_name' => 'mobile_verified',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'email_verified',
                    'name' => 'email_verified',
                    'title' => 'Email verified',
                    'class_name' => 'email_verified',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'status',
                    'name' => 'Status',
                    'title' => 'Status',
                    'class_name' => 'status',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                )
            );
            $data = array();

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->report->get_seller_gst_report_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_tool_btn = array();
            if ($this->rbac->has_permission('STAFF_USERS', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-employee-profile'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
            }
            if ($this->rbac->has_permission('STAFF_USERS', 'XLS_EXPORT')) {
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
            if ($this->rbac->has_permission('STAFF_USERS', 'CSV_EXPORT')) {
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
                'dt_id' => 'raw_cert_data_dt_table',
                'dt_header' => $header,
                'dt_ajax' => array(
                    'dt_url' => base_url('seller-gst-reports'),
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
            );
            $data['data'] = array('config' => $config);
            $this->layout->render($data);
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param              : 
     * @desc               :used to export grid data
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('STAFF_USERS', 'XLS_EXPORT') || $this->rbac->has_permission('STAFF_USERS', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('first_name' => 'first_name', 'last_name' => 'last_name', 'login_id' => 'login_id', 'email' => 'email', 'login_status' => 'login_status', 'mobile' => 'mobile', 'mobile_verified' => 'mobile_verified', 'email_verified' => 'email_verified', 'status' => 'status',);

                $data = $this->report->get_staff_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'employee profiles';
                $file_name = 'employee_profiles' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
    }

}
