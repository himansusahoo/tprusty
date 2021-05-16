<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_user_roles
 * @desc    :
 * @author  : HimansuS
 * @created :10/08/2018
 */
class Rbac_user_roles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac_user_role');
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
     * @created:10/08/2018
     */
    public function index() {

        $this->breadcrumbs->push('index', '/rbac/rbac_user_roles/index');
        $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'js');
        $this->layout->navTitle = 'Rbac user role list';
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
                'db_column' => 'role_id',
                'name' => 'Role_id',
                'title' => 'Role_id',
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
            'btn_href' => base_url('rbac/rbac_user_roles/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac/rbac_user_roles/edit'),
            'btn_icon' => 'fa-edit',
            'btn_title' => 'edit record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );

        $grid_buttons[] = array(
            'btn_class' => 'btn-danger delete-record',
            'btn_href' => '#',
            'btn_icon' => 'fa-trash-alt',
            'btn_title' => 'delete record',
            'btn_separator' => '',
            'param' => array('$1'),
            'style' => '',
            'attr' => 'data-user_role_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->rbac_user_role->get_rbac_user_role_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('rbac/rbac_user_roles/create'),
                'btn_icon' => '',
                'btn_title' => 'Create',
                'btn_text' => 'Create',
                'btn_separator' => ' '
            ),
            array(
                'btn_class' => 'no_pad',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'Export to XLS',
                'btn_text' => '<img src="' . base_url("assets/images/excel_icon.png") . '" alt="XLS">',
                'btn_separator' => ' ',
                'attr' => 'id="export_table_xls"'
            ),
            array(
                'btn_class' => 'no_pad',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'Export to CSV',
                'btn_text' => '<img src="' . base_url("assets/images/csv_icon_sm.gif") . '" alt="CSV">',
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
                'dt_url' => base_url('rbac/rbac_user_roles/index'),
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
    }

    /**
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()) :
            $export_type = $this->input->post('export_type');
            $tableHeading = array('user_id' => 'user_id', 'role_id' => 'role_id',);
            $cols = 'user_id,role_id';
            $data = $this->rbac_user_role->get_rbac_user_role_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'rbac_user_roles';
            $file_name = 'rbac_user_roles' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
     * @created:10/08/2018
     */
    public function create() {
        $this->breadcrumbs->push('create', '/rbac/rbac_user_roles/create');

        $this->layout->navTitle = 'Rbac user role create';
        $data = array();
        if ($this->input->post()) :
            $config = array(
                array(
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'role_id',
                    'label' => 'role_id',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) :

                $data['data'] = $this->input->post();
                $result = $this->rbac_user_role->save($data['data']);

                if ($result >= 1) :
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/rbac/rbac_user_roles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['role_id_list'] = $this->rbac_user_role->get_rbac_roles_options('role_id', 'role_id');
        $data['user_id_list'] = $this->rbac_user_role->get_rbac_users_options('user_id', 'user_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param              : $user_role_id=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function edit($user_role_id = null) {
        $this->breadcrumbs->push('edit', '/rbac/rbac_user_roles/edit');

        $this->layout->navTitle = 'Rbac user role edit';
        $data = array();
        if ($this->input->post()) :
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'role_id',
                    'label' => 'role_id',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) :
                $result = $this->rbac_user_role->update($data['data']);
                if ($result >= 1) :
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/rbac/rbac_user_roles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $user_role_id = c_decode($user_role_id);
            $result = $this->rbac_user_role->get_rbac_user_role(null, array('user_role_id' => $user_role_id));
            if ($result) :
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['role_id_list'] = $this->rbac_user_role->get_rbac_roles_options('role_id', 'role_id');
        $data['user_id_list'] = $this->rbac_user_role->get_rbac_users_options('user_id', 'user_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param              : $user_role_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function view($user_role_id) {
        $this->breadcrumbs->push('view', '/rbac/rbac_user_roles/view');

        $data = array();
        if ($user_role_id) :
            $user_role_id = c_decode($user_role_id);

            $this->layout->navTitle = 'Rbac user role view';
            $result = $this->rbac_user_role->get_rbac_user_role(null, array('user_role_id' => $user_role_id), 1);
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
     * @created:10/08/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()) :
            $user_role_id = $this->input->post('user_role_id');
            if ($user_role_id) :
                $user_role_id = c_decode($user_role_id);

                $result = $this->rbac_user_role->delete($user_role_id);
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