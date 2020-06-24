<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_menu
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_menu extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function get_menu_data($columns = null, $conditions = null, $admin_flag = false) {
        if (!$columns) {
            //$columns = ',rp.permission_id,rp.module_id,rp.action_id,rp.position,rp.parent,rp.menu_name,rp.menu_header';
            $columns = ',rp.permission_id,rp.module_id,rp.action_id';
            $columns .= ',rm.name as "module_name",rm.code "module_code"';
            $columns .= ',ra.name as "action_name",ra.code "action_code"';
            $columns .= ',m.menu_id id,m.name "text",m.menu_order,m.parent prnt,m.icon_class,m.menu_class,m.attribute';
            $columns .= ',m.permission_id,m.url,m.menu_type';
        }

        /*
          Table:-	rbac_permissions
          Columns:-	permission_id,module_id,action_id
          Table:-	rbac_roles
          Columns:-	role_id,name,code

         */

        if ($admin_flag) {
            $this->db->select($columns)->from('rbac_menu m')
                    ->join('rbac_permissions rp', 'rp.permission_id=m.permission_id', 'LEFT')
                    ->join('rbac_modules rm', 'rm.module_id=rp.module_id', 'LEFT')
                    ->join('rbac_actions ra', 'ra.action_id=rp.action_id', 'LEFT')
                    ->order_by('m.menu_order');
            //->where("rp.menu_name<>","")
            //->group_by('rp.permission_id')
        } else {
            if (!$columns) {
                $columns .= 'rrp.role_permission_id id,rrp.role_id,rrp.permission_id';
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
        //pma($this->db->last_query(),1);        
        return $result;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function update_menu_parent($data) {
        $id = $data['id'];
        $parent = ($data['parent']) ? $data['parent'] : 0;
        $order = ($data['position']) ? $data['position'] + 1 : 0;
        if ($id) {
            $query = "UPDATE rbac_permissions SET `parent`=$parent, `order`=$order WHERE PERMISSION_ID='$id'";
            $this->db->query($query);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function save_menu_details($post_data, $default_flag = false) {
        $this->db->trans_begin();
        if ($default_flag) {
            $data = array(
                'name' => (isset($post_data['menu_name']) && $post_data['menu_name'] != '') ? $post_data['menu_name'] : 'new_node',
                'menu_order' => $post_data['menu_order'],
                'parent' => $post_data['parent'],
                'menu_type' => 'l',
                'status' => 'inactive'
            );
            if ($post_data['parent'] == 0) {
                $data['menu_order'] = $this->_get_root_menu_order();
                $data['name'] = 'new_node_' . $data['menu_order'];
            }
            $this->db->insert('rbac_menu', $data);
            $last_id = $this->db->insert_id();
        } else {
            $data = array(
                'name' => (isset($post_data['menu_name']) && $post_data['menu_name'] != '') ? $post_data['menu_name'] : $post_data['menu_text'],
                'menu_order' => $post_data['menu_order'],
                'parent' => $post_data['parent'],
                'icon_class' => $post_data['icon_class'],
                'menu_class' => $post_data['menu_class'],
                'attribute' => $post_data['menu_attr'],
                'permission_id' => $post_data['permission'],
                'url' => $post_data['url'],
                'menu_type' => $post_data['menu_type'],
                'status' => 'Active'
            );

            if ($post_data['menu_id']) {
                $this->db->where('menu_id', $post_data['menu_id']);
                $this->db->update('rbac_menu', $data);
                $last_id = true;
            } else {
                $this->db->insert('rbac_menu', $data);
                $last_id = $this->db->insert_id();
            }
        }

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            return $last_id;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    /**
     * @method 
     * @param
     * @desc
     * @author
     * @date
     */
    public function delete_menu($post_data) {
        if (isset($post_data['node_id']) && $post_data['node_id']) {
            $this->db->trans_begin();
            //delete childrens
            $this->db->where('parent', $post_data['node_id']);
            $this->db->delete('rbac_menu');
            //delete parents
            $this->db->where('menu_id', $post_data['node_id']);
            $this->db->delete('rbac_menu');
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
        }
        return false;
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _get_root_menu_order() {
        $query = "SELECT MAX(menu_order) MAX_ORDER FROM rbac_menu WHERE parent=0";
        $res = $this->db->query($query)->row();
        $order = 1;
        if ($res->MAX_ORDER) {
            $order+=$res->MAX_ORDER;
        }
        return $order;
    }

}

?>