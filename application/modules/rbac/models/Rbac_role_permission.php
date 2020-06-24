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
     * @param              : $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function get_rbac_role_permission($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 't1.role_permission_id,t1.role_id,t1.permission_id,t1.status,t1.created,t1.modified';
            $columns .=',rr.name role_name,rr.code role_code';
            $columns .=',rm.name module_name,rm.code module_code';
            $columns .=',ra.name action_name,ra.code action_code';
        }

        /*
          Table:-    rbac_permissions
          Columns:-    permission_id,module_id,action_id,status,created,modified

          Table:-    rbac_roles
          Columns:-    role_id,name,code,status,created,modified,created_by,modified_by

         */
        $this->db->select($columns)->from('rbac_role_permissions t1')
                ->join('rbac_roles rr', 'rr.role_id=t1.role_id', 'left')
                ->join('rbac_permissions rp', 'rp.permission_id=t1.permission_id', 'left')
                ->join('rbac_modules rm', 'rm.module_id=rp.module_id', 'left')
                ->join('rbac_actions ra', 'ra.action_id=rp.action_id', 'left');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        elseif (is_string($conditions)):
            $this->db->where($conditions);
        endif;
        $this->db->order_by('rr.name', 'asc');
        $this->db->order_by('rm.name', 'asc');
        $this->db->order_by('ra.name', 'asc');
        if ($limit > 0) :
            $this->db->limit($limit, $offset);

        endif;
        $result = $this->db->get()->result_array();

        return $result;
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
    public function save_role_permissions($form_data) {
         //eleminate permission id 0
        $valid_form_data = array_filter($form_data, function($form_data_ele) {
            if ($form_data_ele['permission_id']) {
                return true;
            }
            return false;
        });
        $role_id = array_column($valid_form_data, 'role_id');
        $role_id = array_unique($role_id);
        $this->db->trans_begin();
        foreach ($role_id as $rid) {
            //get all existing module permissions
            $existing_perms = $this->_get_existing_role_perms("permission_id,role_id,role_permission_id", "AND status='active' and role_id=$rid");
            $new_perms = array();
            //find out new permissions
            $new_perms = array_filter($valid_form_data, function ($array2Element) use ($existing_perms) {
                if ($array2Element['permission_id'] != '' || $array2Element['role_id'] != '') {
                    foreach ($existing_perms as $array1Element) {
                        if ($array1Element['permission_id'] == $array2Element['permission_id'] && $array1Element['role_id'] == $array2Element['role_id']) {
                            return false;
                        }
                    }
                    return true;
                } else {
                    return true;
                }
            }
            );
//            echo 'new perms';
//            pma($new_perms);
            //find common permissions to update
            $common_perms = array_filter($valid_form_data, function ($array2Element) use ($existing_perms) {
                foreach ($existing_perms as $array1Element) {
                    if ($array1Element['permission_id'] == $array2Element['permission_id'] && $array1Element['role_id'] == $array2Element['role_id']) {
                        return true;
                    }
                }
                return false;
            }
            );
//            echo 'common perms';
//            pma($common_perms);
            //find perm to delete
            $merge_perm = array_merge($new_perms, $common_perms);
            $del_perms = array_filter($existing_perms, function ($array2Element) use ($merge_perm) {
                foreach ($merge_perm as $array1Element) {
                    if ($array1Element['permission_id'] == $array2Element['permission_id'] && $array1Element['role_id'] == $array2Element['role_id']) {
                        return false;
                    }
                }
                return true;
            }
            );
//            echo 'del perms';
//            pma($del_perms);
            //save new permissions
            $this->_save_role_permissions($new_perms);
            //update permissions
            //        foreach ($common_perms as $perm) {
            //            $data = array(
            //                'status' => 'active',
            //                'modified' => date('Y-m-d H:i:s')
            //            );
            //            $this->db->update('rbac_role_permissions', $data, array('role_id' => $perm['role_id'], 'permission_id' => $perm['permission_id']));
            //        }
            //inactive permissions
            foreach ($del_perms as $perm) {
                $data = array(
                    'status' => 'inactive',
                    'modified' => date('Y-m-d H:i:s')
                );
                $this->db->update('rbac_role_permissions', $data, array('role_permission_id' => $perm['role_permission_id']));
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

}

?>