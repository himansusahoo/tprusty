<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_user
 * @desc    :
 * @author  : HimansuS
 * @created :10/08/2018
 */
class Rbac_user extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param              : $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function get_rbac_user_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'user_id,first_name,last_name,login_id,email,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status';
        }

        /*
         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)->from('rbac_users t1');

        $this->datatables->unset_column("user_id");
        if (isset($data['button_set'])) :
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(user_id)', 1, 1);
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
    public function get_rbac_user($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status';
        }

        /*
         */
        $this->db->select($columns)->from('rbac_users t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        elseif (is_string($conditions)):
            $this->db->where($conditions);
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
            $this->db->insert("rbac_users", $data);
            $user_id_inserted_id = $this->db->insert_id();

            if ($user_id_inserted_id) :
                return $user_id_inserted_id;
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
            $this->db->where("user_id", $data['user_id']);
            return $this->db->update('rbac_users', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * @param              : $user_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function delete($user_id) {
        if ($user_id) :
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('rbac_users', array('user_id' => $user_id));
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
            $columns = 'user_id';
        }
        if (!$index) {
            $index = 'user_id';
        }
        $this->db->select("$columns,$index")->from('rbac_users t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);
            endforeach;
        elseif (is_string($conditions)):
            $this->db->where($conditions);
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select rbac users';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count() {
        return $this->db->count_all('rbac_users');
    }

    /**
     * @param  : 
     * @desc   :fetch app configs
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_app_configs($condition = "") {
        $query = "select * from app_configs where 1=1 $condition order by category asc";
        $result = $this->db->query($query)->result_array();
        $configs = $app_config = array();
        if ($result) {
            foreach ($result as $rec) {
                $configs[$rec['category']] = $rec;
            }
            foreach ($configs as $cat => $rec) {
                $app_config[strtolower($cat)] = json_decode($rec['configs'], true);
            }
        }
        //pma($app_config, 1);
        return $app_config;
    }

    /**
     * @param  : string $column=null,array $condition=null
     * @desc   : get all the user detail
     * @return : user detail array
     * @author : himansu
     */
    public function get_user_detail($column = null, $condition = null) {
        if (!$column) {
            $column = 'ru.user_id,ru.mobile,ru.password,ru.email,ru.login_status,ru.status,ru.created,'
                    . 'ru.modified ,ru.created_by ,ru.modified_by,ru.email,ru.first_name,ru.last_name,profile_pic,ru.user_type ';
        }
        $this->db->select($column)->from('rbac_users ru');

        if (is_array($condition)) {
            foreach ($condition as $col => $val) {
                $this->db->where($col, "$val");
            }
        } else if (is_string($condition)) {
            $this->db->where($condition);
        }
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        if ($result) {

            //get user roles
            $result = $result[0];
            $condition = array('ur.user_id' => $result['user_id']);
            $role_detail = $this->_get_user_roles(null, $condition);
            $result['roles'] = array();
            $result['role_codes'] = array();
            if ($role_detail) {
                $result['roles'] = $role_detail;
                $role_code = array_column($role_detail, 'code');
                $result['role_codes'] = $role_code;
            }

            return $result;
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    private function _get_user_roles($column = null, $condition) {
        if (!$column) {
            $column = ',ur.user_role_id,ur.role_id';
            $column.=',r.name,r.code';
        }
        $this->db->select($column)->from('rbac_user_roles ur')
                ->join('rbac_roles r', 'r.role_id=ur.role_id');

        if ($condition) {
            foreach ($condition as $col => $val) {
                $this->db->where($col, "$val");
            }
        }
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        if ($result) {
            return $result;
        }
        return 0;
    }

}

?>