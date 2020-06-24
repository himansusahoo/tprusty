<?php

/**
 * Delegated Class File
 * PHP Version 7.1
 * 
 * @category   Rbac
 * @package    Rbac
 * @subpackage Delegated_Roles
 * @class      Delegated_Roles
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>
 * @created    09/29/2018
 * @license    
 * @link       
 * @since   09/29/2018
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Delegated_Roles class
 *
 * The class holding delegated roles functionality
 *
 * @category Rbac
 * @package  Rbac
 * @author   HimansuS <himansu.php@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     
 */
class Delegated_roles extends MX_Controller {

    /**
     * @param    : NA
     * @desc     : initiate object
     * @return   : NA
     * @author   : HimansuS
     * @created:
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('delegated_role');
        
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
     * @created:09/29/2018
     */
    public function index() {

        $this->breadcrumbs->push('index', '/rbac/delegated_roles/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Delegated role list';
        $header = array(
            array(
                'db_column' => 'role_id',
                'name' => 'Role_id',
                'title' => 'Role_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'role_code',
                'name' => 'Role_code',
                'title' => 'Role_code',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'user_id',
                'name' => 'User_id',
                'title' => 'User_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'delegated_by',
                'name' => 'Delegated_by',
                'title' => 'Delegated_by',
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

        $grid_buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('rbac/delegated_roles/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac/delegated_roles/edit'),
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
            'attr' => 'data-delegated_role_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->delegated_role->get_delegated_role_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('rbac/delegated_roles/create'),
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
            'dt_markup' => true,
            'dt_id' => 'raw_cert_data_dt_table',
            'dt_header' => $header,
            'dt_ajax' => array(
                'dt_url' => base_url('rbac/delegated_roles/index'),
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
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()) :
            $export_type = $this->input->post('export_type');
            $tableHeading = array('role_id' => 'role_id', 'role_code' => 'role_code', 'user_id' => 'user_id', 'delegated_by' => 'delegated_by', 'created' => 'created', 'modified' => 'modified', 'status' => 'status',);
            $cols = 'role_id,role_code,user_id,delegated_by,created,modified,status';
            $data = $this->delegated_role->get_delegated_role_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'delegated_roles';
            $file_name = 'delegated_roles' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function create() {
        $this->breadcrumbs->push('create', '/rbac/delegated_roles/create');

        $this->layout->navTitle = 'Delegated role create';
        $data = array();
        if ($this->input->post()) :
            $config = array(
                array(
                    'field' => 'role_id',
                    'label' => 'role_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'role_code',
                    'label' => 'role_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'delegated_by',
                    'label' => 'delegated_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) :

                $data['data'] = $this->input->post();
                $result = $this->delegated_role->save($data['data']);

                if ($result >= 1) :
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/rbac/delegated_roles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['delegated_by_list'] = $this->delegated_role->get_rbac_users_options('user_id', 'user_id');
        $data['role_id_list'] = $this->delegated_role->get_rbac_roles_options('role_id', 'role_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param              : $delegated_role_id=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function edit($delegated_role_id = null) {
        $this->breadcrumbs->push('edit', '/rbac/delegated_roles/edit');

        $this->layout->navTitle = 'Delegated role edit';
        $data = array();
        if ($this->input->post()) :
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'role_id',
                    'label' => 'role_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'role_code',
                    'label' => 'role_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'delegated_by',
                    'label' => 'delegated_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) :
                $result = $this->delegated_role->update($data['data']);
                if ($result >= 1) :
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/rbac/delegated_roles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $delegated_role_id = c_decode($delegated_role_id);
            $result = $this->delegated_role->get_delegated_role(null, array('delegated_role_id' => $delegated_role_id));
            if ($result) :
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['delegated_by_list'] = $this->delegated_role->get_rbac_users_options('user_id', 'user_id');
        $data['role_id_list'] = $this->delegated_role->get_rbac_roles_options('role_id', 'role_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param              : $delegated_role_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function view($delegated_role_id) {
        $this->breadcrumbs->push('view', '/rbac/delegated_roles/view');

        $data = array();
        if ($delegated_role_id) :
            $delegated_role_id = c_decode($delegated_role_id);

            $this->layout->navTitle = 'Delegated role view';
            $result = $this->delegated_role->get_delegated_role(null, array('delegated_role_id' => $delegated_role_id), 1);
            if ($result) :
                $result = current($result);
            endif;

            $data['data'] = $result;
            $this->layout->data = $data;
            $this->layout->render();

        endif;
        return 0;
    }

    /**
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()) :
            $delegated_role_id = $this->input->post('delegated_role_id');
            if ($delegated_role_id) :
                $delegated_role_id = c_decode($delegated_role_id);

                $result = $this->delegated_role->delete($delegated_role_id);
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
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
        return 'Invalid request type.';
    }

}

?>