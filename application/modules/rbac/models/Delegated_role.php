<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Delegated_role
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Delegated_role extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('rbac_user');
        $this->load->model('rbac_role');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param              : $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function get_delegated_role_datatable($data = null, $export = null, $tableHeading = null, $columns = null)
    {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'delegated_role_id,role_id,role_code,user_id,delegated_by,created,modified,status';
        }

        /*
          Table:-    rbac_users
          Columns:-    user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status

          Table:-    rbac_roles
          Columns:-    role_id,name,code,status,created,modified,created_by,modified_by

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)->from('delegated_role t1');

        $this->datatables->unset_column("delegated_role_id");
        if (isset($data['button_set'])) :
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(delegated_role_id)', 1, 1);
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
     * @created:09/29/2018
     */
    public function get_delegated_role($columns = null, $conditions = null, $limit = null, $offset = null)
    {
        if (!$columns) {
            $columns = 'delegated_role_id,role_id,role_code,user_id,delegated_by,created,modified,status';
        }

        /*
          Table:-    rbac_users
          Columns:-    user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status

          Table:-    rbac_roles
          Columns:-    role_id,name,code,status,created,modified,created_by,modified_by

         */
        $this->db->select($columns)->from('delegated_role t1');

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
     * @created:09/29/2018
     */
    public function save($data)
    {
        if ($data) :
            $this->db->insert("delegated_role", $data);
            $delegated_role_id_inserted_id = $this->db->insert_id();

            if ($delegated_role_id_inserted_id) :
                return $delegated_role_id_inserted_id;
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
     * @created:09/29/2018
     */
    public function update($data)
    {
        if ($data) :
            $this->db->where("delegated_role_id", $data['delegated_role_id']);
            return $this->db->update('delegated_role', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * @param              : $delegated_role_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function delete($delegated_role_id)
    {
        if ($delegated_role_id) :
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('delegated_role', array('delegated_role_id' => $delegated_role_id));
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
     * @created:09/29/2018
     */
    public function get_options($columns, $index = null, $conditions = null)
    {
        if (!$columns) {
            $columns = 'delegated_role_id';
        }
        if (!$index) {
            $index = 'delegated_role_id';
        }
        $this->db->select("$columns,$index")->from('delegated_role t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select delegated role';
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
     * @created:09/29/2018
     */
    public function get_rbac_users_options($columns, $index = null, $conditions = null)
    {
        return $this->rbac_user->get_options($columns, $index, $conditions);
    }

    /**
     * @param              : $columns,$index=null, $conditions = null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function get_rbac_roles_options($columns, $index = null, $conditions = null)
    {
        return $this->rbac_role->get_options($columns, $index, $conditions);
    }

    public function record_count()
    {
        return $this->db->count_all('delegated_role');
    }

}

?>