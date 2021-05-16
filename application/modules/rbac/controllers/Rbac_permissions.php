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
class Rbac_permissions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac_permission');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_lte';
        $this->layout->layoutsFolder = 'layouts/admin_lte';
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
            $module_actions = $this->rbac_permission->getModuleActions();            
            $parentColumnFilter = array(
                'module_id', 'module_name', 'module_code', 'module_status', 'module_created', 'module_modified'
            );
            $data['tree'] = flat_array_tree($module_actions, 'module_id','action_id',$parentColumnFilter);
            
            //fetch existing permissions
            $conditions = array('t1.status' => 'active');
            $existing_perms = $this->rbac_permission->get_rbac_permission(null, $conditions);
            //pmo($existing_perms);
            $data['existing_perms']= flat_array_tree($existing_perms, 'module_id','action_id',$parentColumnFilter);
            
            //pmo($data['existing_perms'],1);
            if ($this->input->post()) {
                $permissions = $this->input->post();
                $perms = array();
                $condition="";
                foreach ($permissions as $perm) {
                    if (isset($perm['action_id'])) {
                        foreach ($perm['action_id'] as $action_id) {
                            if($condition==''){
                                $condition=" module_id='".$perm['module_id']."'";
                            }
                            $perms[] = array(
                                'module_id' => $perm['module_id'],
                                'action_id' => $action_id
                            );
                        }
                    }
                }
                $condition=" and ".$condition;
                if ($this->rbac_permission->save_module_permissions($perms,$condition)) {
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('rbac-module-permissions');
                } else {
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                }
            }
            //pmo($data,1);
            $this->layout->data = $data;
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

}

?>