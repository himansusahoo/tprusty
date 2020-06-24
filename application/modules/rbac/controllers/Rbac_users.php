<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_users
 * @desc    :
 * @author  : HimansuS
 * @created :10/08/2018
 */
class Rbac_users extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_user');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function index() {
        if ($this->rbac->has_permission('USERS', 'LIST')) {
            $this->breadcrumbs->push('index', '/rbac/rbac_users/index');
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'js');
            $this->layout->navTitle = 'Rbac user list';
            $this->layout->title = 'Rbac user list';
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
                    'db_column' => 'password',
                    'name' => 'Password',
                    'title' => 'Password',
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
                    'db_column' => 'created',
                    'name' => 'Created',
                    'title' => 'Created',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'modified',
                    'name' => 'Modified',
                    'title' => 'Modified',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'created_by',
                    'name' => 'Created_by',
                    'title' => 'Created_by',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'modified_by',
                    'name' => 'Modified_by',
                    'title' => 'Modified_by',
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
            if ($this->rbac->has_permission('USERS', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('rbac/rbac_users/view'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('USERS', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('rbac/rbac_users/edit'),
                    'btn_icon' => 'fa-pencil',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('USERS', 'DELETE')) {
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
                $returned_list = $this->rbac_user->get_rbac_user_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_tool_btn = array();
            if ($this->rbac->has_permission('USERS', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('rbac/rbac_users/create'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
            }
            if ($this->rbac->has_permission('USERS', 'XLS_EXPORT')) {
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
            if ($this->rbac->has_permission('USERS', 'CSV_EXPORT')) {
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
                    'dt_url' => base_url('rbac/rbac_users/index'),
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
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('USERS', 'XLS_EXPORT') || $this->rbac->has_permission('USERS', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('first_name' => 'first_name', 'last_name' => 'last_name', 'login_id' => 'login_id', 'email' => 'email', 'password' => 'password', 'login_status' => 'login_status', 'mobile' => 'mobile', 'mobile_verified' => 'mobile_verified', 'email_verified' => 'email_verified', 'created' => 'created', 'modified' => 'modified', 'created_by' => 'created_by', 'modified_by' => 'modified_by', 'status' => 'status',);
                $cols = 'first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status';
                $data = $this->rbac_user->get_rbac_user_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'rbac_users';
                $file_name = 'rbac_users' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
        if ($this->rbac->has_permission('USERS', 'CREATE')) {
            $this->breadcrumbs->push('create', '/rbac/rbac_users/create');

            $this->layout->navTitle = 'Rbac user create';
            $data = array();
            if ($this->input->post()) :
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
                        'field' => 'login_id',
                        'label' => 'login_id',
                        'rules' => 'required'
                    ),
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

                    $data['data'] = $this->input->post();
                    unset($data['data']['re-password']);
                    $result = $this->rbac_user->save($data['data']);

                    if ($result >= 1) :
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect('/rbac/rbac_users');
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
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function edit($user_id = null) {
        if ($this->rbac->has_permission('USERS', 'EDIT')) {
            $this->breadcrumbs->push('edit', '/rbac/rbac_users/edit');

            $this->layout->navTitle = 'Rbac user edit';
            $data = array();
            if ($this->input->post()) :
                $data['data'] = $this->input->post();
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
                        'field' => 'login_id',
                        'label' => 'login_id',
                        'rules' => 'required'
                    ),
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
                        'field' => 'login_status',
                        'label' => 'login_status',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'mobile',
                        'label' => 'mobile',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'mobile_verified',
                        'label' => 'mobile_verified',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'email_verified',
                        'label' => 'email_verified',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()) :
                    $result = $this->rbac_user->update($data['data']);
                    if ($result >= 1) :
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('/rbac/rbac_users');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $user_id = c_decode($user_id);
                $result = $this->rbac_user->get_rbac_user(null, array('user_id' => $user_id));
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
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function view($user_id) {
        if ($this->rbac->has_permission('USERS', 'VIEW')) {
            $this->breadcrumbs->push('view', '/rbac/rbac_users/view');
            $data = array();
            if ($user_id) :
                $user_id = c_decode($user_id);

                $this->layout->navTitle = 'Rbac user view';
                $result = $this->rbac_user->get_rbac_user(null, array('user_id' => $user_id), 1);
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
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('USERS', 'DELETE')) {
                $user_id = $this->input->post('user_id');
                if ($user_id) :
                    $user_id = c_decode($user_id);

                    $result = $this->rbac_user->delete($user_id);
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

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function set_selected_lmenu() {
        if ($this->input->is_ajax_request()) {
            $menu_ids = $this->input->post('menu_ids');
            if ($menu_ids) {
                $menu_ids = explode("_", $menu_ids);
                $menu_ids = array_unique($menu_ids);
                $this->session->set_userdata('selected_left_menu', $menu_ids);
                
                echo json_encode(array('status'=>'success'));
            } else {
                echo json_encode(array('status'=>'menu set error'));
            }
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }    
   
}

?>