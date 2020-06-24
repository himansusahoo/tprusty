<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_user_role
 * @desc    :
 * @author  : HimansuS
 * @created :10/08/2018
 */
class Rbac_user_role extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac_role');
        $this->load->model('rbac_user');
    }

/**
     * @param              : $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */

    public function get_rbac_user_role_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'user_role_id,user_id,role_id';
        }

        /*
          Table:-    rbac_roles
          Columns:-    role_id,name,code,status,created,modified,created_by,modified_by

          Table:-    rbac_users
          Columns:-    user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)->from('rbac_user_roles t1');

        $this->datatables->unset_column("user_role_id");
        if (isset($data['button_set'])) :
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(user_role_id)', 1, 1);
        endif;
        if ($export) :
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

/**
     * @param              : $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */

    public function get_rbac_user_role($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'user_role_id,user_id,role_id';
        }

        /*
          Table:-    rbac_roles
          Columns:-    role_id,name,code,status,created,modified,created_by,modified_by

          Table:-    rbac_users
          Columns:-    user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status

         */
        $this->db->select($columns)->from('rbac_user_roles t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        endif;
        if ($limit > 0) :
            $this->db->limit($limit, $offset);

        endif;
        $result = $this->db->get()->result_array();

        return $result;
    }

/**
     * @param              : $data
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */

    public function save($data) {
        if ($data) :
            $this->db->insert("rbac_user_roles", $data);
            $user_role_id_inserted_id = $this->db->insert_id();

            if ($user_role_id_inserted_id) :
                return $user_role_id_inserted_id;
            endif;
            return 'No data found to store!';
        endif;
        return 'Unable to store the data, please try again later!';
    }

/**
     * @param              : $data
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */

    public function update($data) {
        if ($data) :
            $this->db->where("user_role_id", $data['user_role_id']);
            return $this->db->update('rbac_user_roles', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

/**
     * @param              : $user_role_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */

    public function delete($user_role_id) {
        if ($user_role_id) :
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('rbac_user_roles', array('user_role_id' => $user_role_id));
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }

        endif;
        return 'No data found to delete!';
    }

/**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */

    public function get_options($columns, $index = null, $conditions = null) {
        if (!$columns) {
            $columns = 'user_role_id';
        }
        if (!$index) {
            $index = 'user_role_id';
        }
        $this->db->select("$columns,$index")->from('rbac_user_roles t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select rbac user roles';
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
     * @created:10/08/2018
     */

    public function get_rbac_roles_options($columns, $index = null, $conditions = null) {
        return $this->rbac_role->get_options($columns, $index, $conditions);
    }

/**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */

    public function get_rbac_users_options($columns, $index = null, $conditions = null) {
        return $this->rbac_user->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('rbac_user_roles');
    }

}

?>