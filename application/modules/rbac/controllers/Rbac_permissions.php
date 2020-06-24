<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_permissions
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_permissions extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac_permission');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function index() {
        redirect(base_url('rbac-module-permissions'));
    }

    /**
     * @param
     * @return
     * @desc   used to assign action to module
     * @author
     */
    public function module_permissions() {
        if ($this->rbac->has_permission('MANAGE_PERMISSIONS', 'ASSIGN_MODULE_PERMISSIONS')) {
            $this->layout->navTitle = 'Module Permissions';
            $data = array();
            $module_options = $this->rbac_permission->get_rbac_modules_options('name');
            $module_options = array_slice($module_options, 1, null, true);
            $module_codes = $this->rbac_permission->get_rbac_modules_options('code');
            $module_codes = array_slice($module_codes, 1, null, true);

            $action_options = $this->rbac_permission->get_rbac_actions_options('name');
            $action_options = array_slice($action_options, 1, null, true);
            $action_codes = $this->rbac_permission->get_rbac_actions_options('code');
            $action_codes = array_slice($action_codes, 1);

            $conditions = array('t1.status' => 'active');
            $existing_perms = $this->rbac_permission->get_rbac_permission(null, $conditions);
            //pma($existing_perms);
            $existing_perms = tree_on_key_column($existing_perms, 'module_id');

            $data = array(
                'criteria' => array(),
                'module_options' => $module_options,
                'action_options' => $action_options,
                'module_codes_json' => json_encode($module_codes),
                'action_codes_json' => json_encode($action_codes),
                'existing_perms' => $existing_perms
            );
            if ($this->input->post()) {
                $permissions = $this->input->post();
                $perms = array();

                foreach ($permissions['permission'] as $perm) {
                    if (isset($perm['action_id'])) {
                        foreach ($perm['action_id'] as $action_id) {
                            $perms[] = array(
                                'module_id' => $perm['module_id'],
                                'action_id' => $action_id
                            );
                        }
                    }
                }

                if ($this->rbac_permission->save_module_permissions($perms)) {
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('rbac-module-permissions');
                } else {
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                }
            }
            $this->layout->data = $data;
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

}

?>