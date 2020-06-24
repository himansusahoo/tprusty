<?php

/**
 * Rbac_custom_permissions Class File
 * PHP Version 7.1.1
 * 
 * @category   rbac
 * @package    rbac
 * @subpackage Rbac_custom_permissions
 * @class      Rbac_custom_permissions
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/13/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Rbac_custom_permissions Class
 * 
 * @category   rbac
 * @package    rbac
 * @class      Rbac_custom_permissions
 * @desc    
 * @author     HimansuS                  
 * @since   10/13/2018
 */
class Rbac_custom_permissions extends MX_Controller {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/13/2018
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_custom_permission');
        
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
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
     * @since   10/13/2018
     */
    public function index() {

        $this->breadcrumbs->push('index', '/rbac/rbac_custom_permissions/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Rbac custom permission list';
        $this->layout->title = 'Rbac custom permission list';
        $header = array(
            array(
                'db_column' => 'user_id',
                'name' => 'User_id',
                'title' => 'User_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'permission_id',
                'name' => 'Permission_id',
                'title' => 'Permission_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'assigned_by',
                'name' => 'Assigned_by',
                'title' => 'Assigned_by',
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

        $grid_buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('rbac/rbac_custom_permissions/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac/rbac_custom_permissions/edit'),
            'btn_icon' => 'fa-pencil',
            'btn_title' => 'edit record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );

        $grid_buttons[] = array(
            'btn_class' => 'btn-danger delete-record',
            'btn_href' => '#',
            'btn_icon' => 'fa-remove',
            'btn_title' => 'delete record',
            'btn_separator' => '',
            'param' => array('$1'),
            'style' => '',
            'attr' => 'data-custom_permission_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->rbac_custom_permission->get_rbac_custom_permission_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('rbac/rbac_custom_permissions/create'),
                'btn_icon' => '',
                'btn_title' => 'Create',
                'btn_text' => 'Create',
                'btn_separator' => ' '
            ),
            array(
                'btn_class' => 'btn-warning',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'XLS',
                'btn_text' => '<span class="fa fa-file-excel-o"></span> Excel',
                'btn_separator' => ' ',
                'attr' => 'id="export_table_xls"'
            ),
            array(
                'btn_class' => 'btn-info',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'CSV',
                'btn_text' => '<span class="fa fa-file-text-o"></span> CSV',
                'btn_separator' => ' ',
                'attr' => 'id="export_table_csv"'
            )
        );
        $dt_tool_btn = get_link_buttons($dt_tool_btn);

        $config = array(
            'dt_markup' => TRUE,
            'dt_id' => 'raw_cert_data_dt_table',
            'dt_header' => $header,
            'dt_ajax' => array(
                'dt_url' => base_url('rbac/rbac_custom_permissions/index'),
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
    }

    /**
     * Export_grid_data Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/13/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()):
            $export_type = $this->input->post('export_type');
            $tableHeading = array('user_id' => 'user_id', 'permission_id' => 'permission_id', 'assigned_by' => 'assigned_by', 'status' => 'status', 'created' => 'created', 'modified' => 'modified',);
            $cols = 'user_id,permission_id,assigned_by,status,created,modified';
            $data = $this->rbac_custom_permission->get_rbac_custom_permission_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'rbac_custom_permissions';
            $file_name = 'rbac_custom_permissions' . date('d_m_Y_H_i_s') . '.' . $export_type;
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

        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
    }

    /**
     * Create Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/13/2018
     */
    public function create() {
        $this->breadcrumbs->push('create', '/rbac/rbac_custom_permissions/create');

        $this->layout->navTitle = 'Rbac custom permission create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'permission_id',
                    'label' => 'permission_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'assigned_by',
                    'label' => 'assigned_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->rbac_custom_permission->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/rbac/rbac_custom_permissions');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['assigned_by_list'] = $this->rbac_custom_permission->get_rbac_users_options('user_id', 'user_id');
        $data['permission_id_list'] = $this->rbac_custom_permission->get_rbac_permissions_options('permission_id', 'permission_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * Edit Method
     * 
     * @param   $custom_permission_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/13/2018
     */
    public function edit($custom_permission_id = null) {
        $this->breadcrumbs->push('edit', '/rbac/rbac_custom_permissions/edit');

        $this->layout->navTitle = 'Rbac custom permission edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'permission_id',
                    'label' => 'permission_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'assigned_by',
                    'label' => 'assigned_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):
                $result = $this->rbac_custom_permission->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/rbac/rbac_custom_permissions');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $custom_permission_id = c_decode($custom_permission_id);
            $result = $this->rbac_custom_permission->get_rbac_custom_permission(null, array('custom_permission_id' => $custom_permission_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['assigned_by_list'] = $this->rbac_custom_permission->get_rbac_users_options('user_id', 'user_id');
        $data['permission_id_list'] = $this->rbac_custom_permission->get_rbac_permissions_options('permission_id', 'permission_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * View Method
     * 
     * @param   $custom_permission_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/13/2018
     */
    public function view($custom_permission_id) {
        $this->breadcrumbs->push('view', '/rbac/rbac_custom_permissions/view');

        $data = array();
        if ($custom_permission_id):
            $custom_permission_id = c_decode($custom_permission_id);

            $this->layout->navTitle = 'Rbac custom permission view';
            $result = $this->rbac_custom_permission->get_rbac_custom_permission(null, array('custom_permission_id' => $custom_permission_id), 1);
            if ($result):
                $result = current($result);
            endif;

            $data['data'] = $result;
            $this->layout->data = $data;
            $this->layout->render();

        endif;
        return 0;
    }

    /**
     * Delete Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/13/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            $custom_permission_id = $this->input->post('custom_permission_id');
            if ($custom_permission_id):
                $custom_permission_id = c_decode($custom_permission_id);

                $result = $this->rbac_custom_permission->delete($custom_permission_id);
                if ($result):
                    echo 1;
                    exit();
                else:
                    echo 'Data deletion error !';
                    exit();
                endif;
            endif;
            echo 'No data found to delete';
            exit();
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
        return 'Invalid request type.';
    }

}

?>