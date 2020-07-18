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
class Rbac_role_permissions extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_role_permission');
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
            $role_options = array_slice($role_options, 1, null, true);
            $role_codes = $this->rbac_role_permission->get_rbac_roles_options('code', null, $condition);
            $role_codes = array_slice($role_codes, 1, null, true);

            if ($this->rbac->has_role('DEVELOPER')) {
                $condition = array('t1.status' => 'active');
                $permission_masters_all = $this->rbac_role_permission->get_rbac_permissions(null, $condition);
            } else {
                $user_role_ids = $this->rbac->get_role_ids();
                $user_role_ids = implode(",", $user_role_ids);
                $condition = "t1.status='active' AND t1.role_id IN($user_role_ids)";
                $permission_masters_all = $this->rbac_role_permission->get_rbac_role_permission(null, $condition);
            }

            $conditions = array('t1.status' => 'active');
            $existing_role_permissions = $this->rbac_role_permission->get_rbac_role_permission(null, $conditions);            
            $action_options = $action_codes = $existing_perms = array();
            $data = array(
                'role_options' => $role_options,
                'permission_master_all' => $permission_masters_all,
                'existing_role_permissions' => $existing_role_permissions
            );
            
            if ($this->input->post()) {
                $permissions = $this->input->post();
                if(array_key_exists('permission',$permissions)){                    
                    $perms = array();    
                    foreach ($permissions['permission'] as $role_id => $perm) {    
                        foreach ($perm as $perm_id) {
                            $perms[] = array(
                                'role_id' => $role_id,
                                'permission_id' => $perm_id
                            );
                        }
                    }
                  
                    if ($this->rbac_role_permission->save_role_permissions($perms)) {
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect(base_url('rbac-role-permissions'));
                    } else {
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    }
                }else{
                    if(isset($permissions['permission_role_id'])){
                        //delete all the role permissions
                        $this->rbac_role_permission->delete_all_role_perms($permissions['permission_role_id']);
                    }else {
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    }                    
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