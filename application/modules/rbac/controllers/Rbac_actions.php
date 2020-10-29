<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_actions
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_actions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac_action');
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
        if ($this->rbac->has_permission('MANAGE_ACTIONS', 'LIST')) {
            $this->breadcrumbs->push('index', base_url('rbac-actions-list'));
            $this->scripts_include->includePlugins(array('chosen', 'datatable'), 'css');
            $this->scripts_include->includePlugins(array('chosen', 'datatable'), 'js');
            $this->layout->navTitle = 'Rbac action list';
            //$this->layout->title = 'Rbac action list';
            
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
                    'db_column' => 'module_name',
                    'name' => 'Module',
                    'title' => 'Module',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                )
            );
            $data = $grid_buttons = array();
            $button_flag = false;

            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-rbac-action'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = true;
            }
            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('edit-rbac-action'),
                    'btn_icon' => 'fa-edit',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = true;
            }

            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-trash-alt',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-action_id="$1"'
                );
                $button_flag = true;
            }
            if ($button_flag) {
                $button_set = get_link_buttons($grid_buttons);
                $data['button_set'] = $button_set;
                $action_column = array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'false'
                );
                array_push($header, $action_column);
            }

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->rbac_action->get_rbac_action_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_button_flag = false;
            $dt_tool_btn = array();
            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-rbac-action'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
                $dt_button_flag = true;
            }
            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'XLS_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'no_pad',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'Export to XLS',
                    'btn_text' => '<img src="' . base_url("assets/images/excel_icon.png") . '" alt="XLS">',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_xls"'
                );
                $dt_button_flag = true;
            }
            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'CSV_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'no_pad',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'Export to CSV',
                    'btn_text' => '<img src="' . base_url("assets/images/csv_icon_sm.gif") . '" alt="CSV">',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_csv"'
                );
                $dt_button_flag = true;
            }

            if ($dt_button_flag) {
                $dt_tool_btn = get_link_buttons($dt_tool_btn);
            }

            $config = array(
                'dt_markup' => true,
                'dt_id' => 'raw_cert_data_dt_table',
                'dt_header' => $header,
                'dt_ajax' => array(
                    'dt_url' => base_url('rbac-actions-list'),
                ),
                'custom_lengh_change' => false,
                'dt_dom' => array(
                    'top_buttons' => $dt_tool_btn
                ),
                'options' => array(
                    'iDisplayLength' => 15
                )
            );
            //pma($config,1);
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
            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_ACTIONS', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('name' => 'name', 'code' => 'code', 'status' => 'status','module_name'=>'module_name', 'created' => 'created', 'modified' => 'modified');
                $cols = 'name,code,status,module_name,created,modified';
                $data = $this->rbac_action->get_rbac_action_datatable(null, true, $tableHeading,$cols);
                
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
                $worksheet_name = 'rbac_actions';
                $file_name = 'rbac_actions' . date('d_m_Y_H_i_s') . '.' . $export_type;
                $config = array(
                    'db_data' => $data['aaData'],
                    'header_rows' => $header,
                    'body_column' => $body_col_map,
                    'worksheet_name' => $worksheet_name,
                    'file_name' => $file_name,
                    'download' => true
                );
                //pmo($config,1);
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
        if ($this->rbac->has_permission('MANAGE_ACTIONS', 'CREATE')) {
            $this->breadcrumbs->push('create', base_url('create-rbac-action'));

            $this->scripts_include->includePlugins(array('select2'), 'css');
            $this->scripts_include->includePlugins(array('select2', 'jq_validation'), 'js');

            $this->layout->navTitle = 'Rbac action create';

            $moduleList = $this->rbac_action->get_module_options('name');
            $data = array(
                'module_list' => $moduleList
            );
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
                        'rules' => 'required|callback_check_code_exists'
                    )
                );
                $this->form_validation->set_rules($config);
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $dbData = $this->input->post();
                $data['data'] = $dbData;
                if ($this->form_validation->run()) :


                    if (!$dbData['module_id']) {
                        unset($dbData['module_id']);
                    }

                    $result = $this->rbac_action->save($data['data']);

                    if ($result >= 1) :
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect('rbac-actions-list');
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
     * @param              : $action_id=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function edit($action_id = null) {
        if ($this->rbac->has_permission('MANAGE_ACTIONS', 'EDIT')) {
            $this->breadcrumbs->push('edit', base_url('edit-rbac-action'));
            $this->layout->navTitle = 'Rbac action edit';
            
            $this->scripts_include->includePlugins(array('select2'), 'css');
            $this->scripts_include->includePlugins(array('select2', 'jq_validation'), 'js');
            
            $moduleList = $this->rbac_action->get_module_options('name');
            $data = array(
                'module_list' => $moduleList
            );
            if ($this->input->post()) :
                $data['data'] = $this->input->post();
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
                    $result = $this->rbac_action->update($data['data']);
                    if ($result >= 1) :
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('rbac-actions-list');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $action_id = c_decode($action_id);
                $result = $this->rbac_action->get_rbac_action(null, array('action_id' => $action_id));
                //pmo($result, 1);
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
     * @param              : $action_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function view($action_id) {
        if ($this->rbac->has_permission('MANAGE_ACTIONS', 'VIEW')) {
            $this->breadcrumbs->push('view', base_url('view-rbac-action'));
            $data = array();
            if ($action_id) :
                $action_id = c_decode($action_id);

                $this->layout->navTitle = 'Rbac action view';
                $result = $this->rbac_action->get_rbac_action(null, array('action_id' => $action_id), 1);
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
            if ($this->rbac->has_permission('MANAGE_ACTIONS', 'DELETE')) {
                $action_id = $this->input->post('action_id');
                if ($action_id) :
                    $action_id = c_decode($action_id);

                    $result = $this->rbac_action->delete($action_id);
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
    }

    public function check_code_exists($code) {
        $result = $this->rbac_action->isActionCodeExist(trim($code));
        if ($result) {
            $this->form_validation->set_message('check_code_exists', 'Duplicate code, please try another.');
            return false;
        }
        return true;
    }

}

?>