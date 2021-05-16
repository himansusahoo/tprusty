<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_roles
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_roles extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_role');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_lte';
        $this->layout->layoutsFolder = 'layouts/admin_lte';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function index() {
        if ($this->rbac->has_permission('USER_ROLES', 'LIST')) {
            $this->breadcrumbs->push('index', base_url('rbac-roles-list'));
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'js');
            $this->layout->navTitle = 'Rbac role list';
            $header = array(
                array(
                    'db_column' => 'name',
                    'name' => 'Name',
                    'title' => 'Name',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'code',
                    'name' => 'Code',
                    'title' => 'Code',
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

            if ($this->rbac->has_permission('USER_ROLES', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-rbac-role'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('USER_ROLES', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('edit-rbac-role'),
                    'btn_icon' => 'fa-edit',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('USER_ROLES', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-trash-alt',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-role_id="$1"'
                );
            }
            $button_set = get_link_buttons($grid_buttons);
            $data['button_set'] = $button_set;

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->rbac_role->get_rbac_role_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_tool_btn = array();
            if ($this->rbac->has_permission('USER_ROLES', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-rbac-role'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
            }
            if ($this->rbac->has_permission('USER_ROLES', 'XLS_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'no_pad',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'Export to XLS',
                    'btn_text' => '<img src="' . base_url("assets/images/excel_icon.png") . '" alt="XLS">',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_xls"'
                );
            }
            if ($this->rbac->has_permission('USER_ROLES', 'CSV_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'no_pad',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'Export to CSV',
                    'btn_text' => '<img src="' . base_url("assets/images/csv_icon_sm.gif") . '" alt="CSV">',
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
                    'dt_url' => base_url('rbac-roles-list'),
                ),
                'custom_lengh_change' => false,
                'dt_dom' => array(
                    'top_buttons' => $dt_tool_btn,
                ),
                'options' => array(
                    'iDisplayLength' => 15
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
     * @created:09/29/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()) {

            if ($this->rbac->has_permission('USER_ROLES', 'XLS_EXPORT') || $this->rbac->has_permission('USER_ROLES', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('name' => 'name', 'code' => 'code', 'created_by' => 'created_by', 'modified_by' => 'modified_by', 'status' => 'status', 'created' => 'created', 'modified' => 'modified');
                $cols = 'name,code,created_by,modified_by,status,created,modified';
                $data = $this->rbac_role->get_rbac_role_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'rbac_roles';
                $file_name = 'rbac_roles' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
     * @created:09/29/2018
     */
    public function create() {
        if ($this->rbac->has_permission('USER_ROLES', 'CREATE')) {
            $this->breadcrumbs->push('create', base_url('create-rbac-role'));
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');
            $this->layout->navTitle = 'Rbac role create';
            $data = array();
            if ($this->input->post()) :
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'code',
                        'label' => 'code',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                if ($this->form_validation->run()) :
                    $db_data = array(
                        'name' => $this->input->post('name'),
                        'code' => $this->input->post('code'),
                        'created_by' => $this->rbac->get_user_id()
                    );
                    $result = $this->rbac_role->save($db_data);

                    if ($result >= 1) :
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect(base_url('rbac-roles-list'));
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
     * @param              : $role_id=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function edit($role_id = null) {
        if ($this->rbac->has_permission('USER_ROLES', 'EDIT')) {
            $this->breadcrumbs->push('edit', base_url('edit-rbac-role'));
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');

            $this->layout->navTitle = 'Rbac role edit';
            $data = array();
            if ($this->input->post()) :

                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'code',
                        'label' => 'code',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                if ($this->form_validation->run()) :
                    $db_data = array(
                        'name' => $this->input->post('name'),
                        'code' => $this->input->post('code'),
                        'created_by' => $this->rbac->get_user_id()
                    );

                    $result = $this->rbac_role->update($db_data);
                    if ($result >= 1) :
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect(base_url('rbac-roles-list'));
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $role_id = c_decode($role_id);
                $result = $this->rbac_role->get_rbac_role(null, array('role_id' => $role_id));
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
     * @param              : $role_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function view($role_id) {
        if ($this->rbac->has_permission('USER_ROLES', 'VIEW')) {
            $this->breadcrumbs->push('view', base_url('view-rbac-role'));

            $data = array();
            if ($role_id) :
                $role_id = c_decode($role_id);

                $this->layout->navTitle = 'Rbac role view';
                $result = $this->rbac_role->get_rbac_role(null, array('role_id' => $role_id), 1);
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
     * @created:09/29/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('USER_ROLES', 'DELETE')) {
                $role_id = $this->input->post('role_id');
                if ($role_id) :
                    $role_id = c_decode($role_id);

                    $result = $this->rbac_role->delete($role_id);
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
            }else {
                $this->layout->render(array('error' => '401'));
            }
        } else {
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
        return 'Invalid request type.';
    }

}

?>