<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_role_permission
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_role_permission extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac/rbac_permission');
        $this->load->model('rbac/rbac_role');
    }

    /**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function get_rbac_permissions_options($columns, $index = null, $conditions = null, $blank_list = false) {
        return $this->rbac_permission->get_options($columns, $index, $conditions, $blank_list);
    }

    /**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function get_rbac_roles_options($columns, $index = null, $conditions = null) {
        return $this->rbac_role->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('rbac_role_permissions');
    }

    /**
     * @param
     * @return
     * @desc   get permissions list
     * @author
     */
    public function get_rbac_permissions($columns = null, $conditions = null, $limit = null, $offset = null) {
        return $this->rbac_permission->get_rbac_permission($columns, $conditions, $limit, $offset);
    }

    /**
     * @param
     * @return
     * @desc   get existing module permissions
     * @author
     */
    private function _get_existing_role_perms($columns = '*', $cond = "") {
        $query = "SELECT $columns FROM rbac_role_permissions WHERE 1=1 $cond";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * @param
     * @return
     * @desc   save role permissions
     * @author
     */
    public function save_role_permissions($postData, $existingRolePerms) {
        $this->db->trans_begin();
        $roleId=$postData['role_id'];
        //get all existing module permissions
        $newPerms = $commonPerms = $deletePerms = $merges = $saveNewPerms=array();
        
        foreach ($postData['permission'] as $moduleId => $permIds) {
            foreach ($permIds as $permId) {
                if (array_key_exists('children', $existingRolePerms) && array_key_exists($permId, $existingRolePerms['children'])) {
                    $commonPerms[] = $permId;
                } else {
                    $newPerms[] = $permId;
                    $saveNewPerms[]=array(
                        'role_id'=>$roleId,
                        'permission_id'=>$permId,
                        'status'=>'active'
                    );
                }
            }
        }
        //merge new and common to find out the delted perms
        if (array_key_exists('children', $existingRolePerms)) {
            $merges = array_merge($newPerms, $commonPerms);
            $existPermIds = array_keys($existingRolePerms['children']);
            $deletePerms = array_diff($existPermIds, $merges);
        }
        if ($newPerms) {            
            $this->_save_role_permissions($saveNewPerms);
        }
        if ($deletePerms) {
            foreach ($deletePerms as $perm) {
                $data = array(
                    'status' => 'inactive',
                    'modified' => date('Y-m-d H:i:s')
                );
                $this->db->delete('rbac_role_permissions', array('permission_id' => $perm, 'role_id' => $postData['role_id']));
            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _save_role_permissions($new_role_permissions) {
        if ($new_role_permissions) {
            return $this->db->insert_batch('rbac_role_permissions', $new_role_permissions);
        }
    }

    /**
     * @param  : $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc   :
     * @return :
     * @author :
     * @created:11/22/2016
     */
    public function get_rbac_role_permission_lib($columns = null, $conditions = null, $admin_flag = false, $tree_flag = true) {
        if (!$columns) {
            //$columns = ',rp.permission_id,rp.module_id,rp.action_id,rp.position,rp.parent,rp.menu_name,rp.menu_header';
            //$columns = ',rp.permission_id,rp.module_id,rp.action_id,rp.order,rp.parent,rp.menu_name,rp.menu_header'
            //. ',rp.url,rp.header_class,rp.menu_class,rp.menu_type,rp.status';
            $columns = ',rp.permission_id,rp.module_id,rp.action_id'
                    . ',rp.status';
            $columns .= ',rm.name as "module_name",rm.code module_code';
            $columns .= ',ra.name as "action_name",ra.code action_code ';
        }

        /*
          Table:-	rbac_permissions
          Columns:-	permission_id,module_id,action_id
          Table:-	rbac_roles
          Columns:-	role_id,name,code
         * rbac_permissions_bak16may18

         */
        if ($admin_flag) {
            $this->db->select($columns)->from('rbac_permissions rp')
                    ->join('rbac_modules rm', 'rm.module_id=rp.module_id')
                    ->join('rbac_actions ra', 'ra.action_id=rp.action_id')
                    ->group_by('rp.permission_id')
                    ->order_by('rp.module_id,rp.action_id');
        } else {
            if (!$columns) {
                $columns .= 'rrp.role_permission_id,rrp.role_id,rrp.permission_id';
            }
            $this->db->select($columns)->from('rbac_role_permissions rrp')
                    ->join('rbac_permissions rp', 'rp.permission_id=rrp.permission_id')
                    ->join('rbac_modules rm', 'rm.module_id=rp.module_id')
                    ->join('rbac_actions ra', 'ra.action_id=rp.action_id')
                    ->group_by('rp.permission_id')
                    ->order_by('rp.module_id,rp.action_id');
        }

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;

        elseif ($conditions):
            $this->db->where($conditions);
        endif;

        $result = $this->db->get()->result_array();
        if ($tree_flag) {
            $result = tree_on_key_column($result, 'module_code');
        }
        return $result;
    }

    public function get_rbac_permission($conditions='') {
        $query = "SELECT 
            rp.permission_id,rp.status perm_status,rp.created perm_created,rp.modified perm_modified
            ,ma.*
            FROM rbac_permissions rp
            LEFT JOIN module_actions_vw ma on ma.module_id=rp.module_id and ma.action_id=rp.action_id
            LEFT JOIN rbac_role_permissions rrp on rrp.permission_id=rp.permission_id
            WHERE rp.status='active' 
            and ma.action_status='active' 
            and ma.module_status='active' $conditions";
        $result = $this->db->query($query)->result_array();
        //pmo($query,1);
        return $result;
    }

    /**
     * @param  : $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc   :
     * @return :
     * @author :
     * @created:11/22/2016
     */
    public function get_rbac_role_permission($columns = null, $conditions = null) {
        if (!$columns) {
            $columns = 'rp.role_permission_id,rp.role_id,rp.permission_id,rp.status,rp.created,rp.modified';
        }

        /*
          Table:-	rbac_permissions
          Columns:-	permission_id,module_id,action_id
          Table:-	rbac_roles
          Columns:-	role_id,name,code
         * rbac_permissions_bak16may18

         */
        $this->db->select($columns)->from('rbac_role_permissions rp');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;

        elseif (is_string($conditions)):
            $this->db->where($conditions);
        endif;
        $result = $this->db->get()->result_array();
        return $result;
    }

}

?>