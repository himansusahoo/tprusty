<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Manage_staffs
 * @desc    :
 * @author  : HimansuS
 * @created :10/08/2018
 */
class Manage_staffs extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('manage_staff');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }
    /**
     * @param  : 
     * @desc   : redirect to employee list page
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function index(){
        redirect(base_url('employee-list'));
    }
    /**
     * @param  : 
     * @desc   : fetch employee list
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function staff_list() {
        if ($this->rbac->has_permission('STAFF_USERS', 'LIST')) {
            $this->breadcrumbs->push('index', base_url('employee-list'));
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
            $this->layout->navTitle = 'Employee list';
            $this->layout->title = 'Employee list';
            $header = array(
                array(
                    'db_column' => 'first_name',
                    'name' => 'First_name',
                    'title' => 'First_name',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'last_name',
                    'name' => 'Last_name',
                    'title' => 'Last_name',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'login_id',
                    'name' => 'Login_id',
                    'title' => 'Login_id',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'email',
                    'name' => 'Email',
                    'title' => 'Email',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'login_status',
                    'name' => 'Login_status',
                    'title' => 'Login_status',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'mobile',
                    'name' => 'Mobile',
                    'title' => 'Mobile',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'mobile_verified',
                    'name' => 'Mobile_verified',
                    'title' => 'Mobile_verified',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'email_verified',
                    'name' => 'email_verified',
                    'title' => 'email_verified',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'status',
                    'name' => 'Status',
                    'title' => 'Status',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'false'
                )
            );
            $data = $grid_buttons = array();
            if ($this->rbac->has_permission('STAFF_USERS', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-employee-profile'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('STAFF_USERS', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('edit-employee-profile'),
                    'btn_icon' => 'fa-pencil',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('STAFF_USERS', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-remove',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-user_id="$1"'
                );
            }

            $button_set = get_link_buttons($grid_buttons);
            $data['button_set'] = $button_set;

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->manage_staff->get_staff_datatable($data);
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
                    'dt_url' => base_url('employee-list'),
                ),
                'custom_lengh_change' => false,
                'dt_dom' => array(
                    'top_dom' => true,
                    'top_length_change' => true,
                    'top_filter' => true,
                    'top_buttons' => $dt_tool_btn,
                    'top_pagination' => true,
                    'buttom_dom' => true,
                    'buttom_length_change' => FALSE,
                    'buttom_pagination' => true
                )
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
                $tableHeading = array('first_name' => 'first_name', 'last_name' => 'last_name', 'login_id' => 'login_id', 'email' => 'email','login_status' => 'login_status', 'mobile' => 'mobile', 'mobile_verified' => 'mobile_verified', 'email_verified' => 'email_verified','status' => 'status',);
                
                $data = $this->manage_staff->get_staff_datatable(null, true, $tableHeading);
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
    
    /**
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function create() {
        if ($this->rbac->has_permission('STAFF_USERS', 'CREATE')) {
            $this->breadcrumbs->push('create', base_url('create-employee-profile'));
            $this->layout->navTitle = 'Add new employee';
            $this->layout->title = 'Add new employee';
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');
            $user_id=  $this->rbac->get_user_id();
            $data = array();
            if ($this->input->post()) :
                $data['data'] = $post_data = $this->input->post();
                $config = array(
                    array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'last_name',
                        'label' => 'last_name',
                        'rules' => 'required'
                    ),
//                    array(
//                        'field' => 'login_id',
//                        'label' => 'login_id',
//                        'rules' => 'required'
//                    ),
                    array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'password',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'mobile',
                        'label' => 'mobile',
                        'rules' => 'required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run()) :
                    $post_data['created_by'] = $user_id;                                  
                    unset($data['data']['re_password'],$post_data['submit']);
                    $result = $this->manage_staff->save($post_data);                    
                    if ($result):
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect(base_url('employee-list'));
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            endif;
            $this->layout->data = $data;
            $this->layout->render();
        }else {
            $this->layout->render(array('error' => '401'));
        }
    }
    
     /**
     * @param              : $user_id=null
     * @desc               : edit employee profile
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function edit($user_id = null) {
        if ($this->rbac->has_permission('STAFF_USERS', 'EDIT')) {
            $this->breadcrumbs->push('edit', base_url('edit-employee-profile'));
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');
            $this->layout->navTitle = 'Edit employee profile';
            $this->layout->title = 'Edit employee profile';
            $data = array();
            if ($this->input->post()) :
                $data['data'] = $post_data=$this->input->post();
                $config = array(
                    array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'last_name',
                        'label' => 'last_name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'mobile',
                        'label' => 'mobile',
                        'rules' => 'required'
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()) :
                    $condition = " AND user_id!='" . $post_data['user_id'] . "'AND replace(lower(email),' ','')=replace(lower('" . $post_data['email'] . "'),' ','')";
                    if (!$this->manage_staff->check_duplicate($condition)) :
                        $result = $this->manage_staff->update($data['data']);
                        if ($result >= 1):
                            $this->session->set_flashdata('success', 'Record successfully updated!');
                            redirect('employee-list');
                        else:
                            $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                        endif;
                    else:
                        $this->session->set_flashdata('error', 'Email id is already exists, Please try another!');
                    endif;                    
                    
                endif;
            else:
                $user_id = c_decode($user_id);
                $result = $this->manage_staff->get_staff_data(null, array('user_id' => $user_id));
                if ($result) :
                    $result = current($result);
                endif;
                $data['data'] = $result;
            endif;
            $this->layout->data = $data;
            $this->layout->render();
        }else {
            $this->layout->render(array('error' => '401'));
        }
    }
    /**
     * @param              : $user_id
     * @desc               : view employee profile
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function view($user_id) {
        if ($this->rbac->has_permission('STAFF_USERS', 'VIEW')) {
            $this->breadcrumbs->push('view', base_url('view-employee-profile'));
            $this->layout->navTitle = 'Employee profile view';
            $this->layout->title = 'Employee profile view';
            $data = array();
            if ($user_id) :
                $user_id = c_decode($user_id);                
                $result = $this->manage_staff->get_staff_data(null, array('user_id' => $user_id), 1);
                if ($result) :
                    $result = current($result);
                endif;

                $data['data'] = $result;
                $this->layout->data = $data;
                $this->layout->render();

            endif;
            return 0;
        }else {
            $this->layout->render(array('error' => '401'));
        }
    }
    /**
     * @param              : 
     * @desc               : delete a employee
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('STAFF_USERS', 'DELETE')) {
                $user_id = $this->input->post('user_id');
                if ($user_id) :
                    $user_id = c_decode($user_id);
                    $result = $this->manage_staff->delete($user_id);
                    if ($result) :
                        echo 1;
                        exit();
                    else:
                        echo 'Data deletion error !';
                        exit();
                    endif;
                endif;
                echo 'No data found to delete';
                exit();
            } else {
                $this->layout->render(array('error' => '401'));
            }
        } else {
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
        return 'Invalid request type.';
    }
    
    
}
