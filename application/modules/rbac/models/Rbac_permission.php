<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_permission
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_permission extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rbac/rbac_action');
        $this->load->model('rbac/rbac_module');
    }

     /**
      * @param              : $columns=null,$conditions=null,$limit=null,$offset=null
      * @desc               :
      * @return             :
      * @author             :
      * @created:05/17/2018
      */
    public function get_rbac_permission($columns = null, $conditions = null, $limit = null, $offset = null)
    {
        if (!$columns) {
            $columns = 't1.permission_id,rm.module_id,ra.action_id,t1.status,t1.created,t1.modified'
                    . ',rm.name module_name,rm.code module_code,ra.name action_name,ra.code action_code';
        }

        /*
          Table:-    rbac_actions
          Columns:-    action_id,name,status,created,modified,code

          Table:-    rbac_modules
          Columns:-    module_id,name,code,status,created,modified

         */
        /* $this->db->select($columns)->from('rbac_permissions t1')
          ->join('rbac_modules rm','rm.module_id=t1.module_id','LEFT')
          ->join('rbac_actions ra','ra.action_id=t1.action_id','LEFT')
          ->order_by('t1.module_id','asc')
          ->order_by('ra.name','dsc'); */
        $this->db->select($columns)->from('rbac_modules rm')
            ->join('rbac_permissions t1', 'rm.module_id=t1.module_id', 'LEFT')
            ->join('rbac_actions ra', 'ra.action_id=t1.action_id', 'LEFT')
            ->where('trim(rm.name)!=', '')
            ->where('trim(rm.code)!=', '')
            ->order_by('rm.name', 'asc')
            ->order_by('ra.name', 'dsc');
            
        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        endif;
        if ($limit > 0) :
            $this->db->limit($limit, $offset);

        endif;
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }    

    /**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:05/17/2018
     */
    public function get_options($columns, $index = null, $conditions = null,$blank_list=true)
    {
        if (!$columns) {
            $columns = 'permission_id';
        }
        if (!$index) {
            $index = 'permission_id';
        }
        $this->db->select("$columns,$index")->from('rbac_permissions t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        if($blank_list) {
            $list[''] = 'Select rbac permissions';
        }
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    /**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:05/17/2018
     */
    public function get_rbac_actions_options($columns, $index = null, $conditions = null)
    {
        return $this->rbac_action->get_options($columns, $index, $conditions);
    }

    /**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:05/17/2018
     */
    public function get_rbac_modules_options($columns, $index = null, $conditions = null)
    {
        return $this->rbac_module->get_options($columns, $index, $conditions);
    }

    

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _save_module_actions($new_module_actions)
    {
        if ($new_module_actions) {
            return $this->db->insert_batch('rbac_permissions', $new_module_actions);
        }
    }

    /**
     * @param
     * @return
     * @desc   get existing module permissions
     * @author
     */
    private function _get_existing_module_perms($columns = '*', $cond = "")
    {
        $query = "SELECT $columns FROM rbac_permissions WHERE 1=1 $cond";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:05/17/2018
     */
    public function get_perm_options($columns = null, $index = null, $conditions = null)
    {
        if (!$columns) {
            $columns = 'rm.name module_name,ra.name action_name,';
        }
        if (!$index) {
            $index = 'permission_id';
        }
        $this->db->select("$columns,$index")
            ->from('rbac_permissions rp')
            ->join('rbac_modules rm', 'rm.module_id=rp.module_id','LEFT')
            ->join('rbac_actions ra', 'ra.action_id=rp.action_id','LEFT');
        
        $this->db->where('rm.module_id=rp.module_id')
        ->where('ra.action_id=rp.action_id')
        ->where('lower(rp.status)','active')
        ->order_by('module_name','ASC')
        ->order_by('action_name','ASC');
        
        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);
            endforeach;
        endif;
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        //pma($result,1);
        $list = array();
        $list[''] = 'Select permissions';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val['module_name'] . '-' . $val['action_name'];
        endforeach;
        return $list;
    }

    /**
     * @param
     * @return
     * @desc   save module permissions
     * @author
     */
    public function save_module_permissions($form_data)
    {
        //get all existing module permissions
        $existing_perms = $this->_get_existing_module_perms("module_id,action_id");
        $new_perms = array();
        //find out new permissions
        $new_perms = array_filter(
            $form_data, function ($array2Element) use ($existing_perms) {
                foreach ($existing_perms as $array1Element) {
                    if ($array1Element['module_id'] == $array2Element['module_id'] && $array1Element['action_id'] == $array2Element['action_id']) {
                        return false;
                    }
                }
                return true;
            }
        );

        //find common permissions to update
        $common_perms = array_filter(
            $form_data, function ($array2Element) use ($existing_perms) {
                foreach ($existing_perms as $array1Element) {
                    if ($array1Element['module_id'] == $array2Element['module_id'] && $array1Element['action_id'] == $array2Element['action_id']) {
                        return true;
                    }
                }
                return false;
            }
        );

        //find perm to delete
        $merge_perm = array_merge($new_perms, $common_perms);
        $del_perms = array_filter(
            $existing_perms, function ($array2Element) use ($merge_perm) {
                foreach ($merge_perm as $array1Element) {
                    if ($array1Element['module_id'] == $array2Element['module_id'] && $array1Element['action_id'] == $array2Element['action_id']) {
                        return false;
                    }
                }
                return true;
            }
        );

        $this->db->trans_begin();
        //save new permissions
        $this->_save_module_actions($new_perms);
        //update permissions
        foreach ($common_perms as $perm) {
            $data = array(
                'status' => 'active',
                'modified' => date('Y-m-d H:i:s')
            );
            $this->db->update('rbac_permissions', $data, array('module_id' => $perm['module_id'], 'action_id' => $perm['action_id']));
        }
        //inactive permissions
        foreach ($del_perms as $perm) {
            $data = array(
                'status' => 'inactive',
                'modified' => date('Y-m-d H:i:s')
            );
            $this->db->update('rbac_permissions', $data, array('module_id' => $perm['module_id'], 'action_id' => $perm['action_id']));
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}

?>
