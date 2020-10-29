<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_role_permissions
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_role_permissions extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_role_permission');
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
        redirect(base_url('rbac-role-permissions'));
    }

    /**
     * @param
     * @return
     * @desc   used to assign action to module
     * @author
     */
    public function role_permissions() {
        if ($this->rbac->has_permission('MANAGE_PERMISSIONS', 'ASSIGN_ROLE_PERMISSIONS')) {
            $this->layout->navTitle = 'Role Permissions';
            $data = array();
            $user_id = $this->rbac->get_user_id();
            $condition = array('created_by' => $user_id);
            $role_options = $this->rbac_role_permission->get_rbac_roles_options('name', null, $condition);
            $data['role_options'] = array_slice($role_options, 1, null, true);

            if ($this->rbac->has_role('DEVELOPER')) {
                $allPermissions = $this->rbac_role_permission->get_rbac_permission();
            } else {
                $user_role_ids = $this->rbac->get_role_ids();
                $user_role_ids = implode(",", $user_role_ids);
                $condition = " AND rrp.role_id IN($user_role_ids)";                         
                $allPermissions = $this->rbac_role_permission->get_rbac_permission($condition);
            }
            //pmo($allPermissions,1);
            //parent array columns
            $parentColumns = array('module_id', 'module_name', 'module_code', 'module_status', 'module_created', 'module_modified');
            $data['all_permissions'] = flat_array_tree($allPermissions, 'module_id', 'action_id', $parentColumns);

            $conditions = array('rp.status' => 'active');
            $existing_role_permissions = $this->rbac_role_permission->get_rbac_role_permission(null, $conditions);
            $parentColumns = array('role_id');
            $data['existing_role_permissions'] = flat_array_tree($existing_role_permissions, 'role_id', 'permission_id', $parentColumns);

            $postData = $this->input->post();
            
            if ($postData) {
                $sendExistingPerms = array();
                if (array_key_exists($postData['role_id'], $data['existing_role_permissions'])) {
                    $sendExistingPerms = $data['existing_role_permissions'][$postData['role_id']];
                }
                if ($this->rbac_role_permission->save_role_permissions($postData, $sendExistingPerms)) :
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('rbac-role-permissions');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            }
            //pmo($data);
            $this->layout->data = $data;
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

}

?>