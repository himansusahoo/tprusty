<?php

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac/rbac_user');
        $this->load->model('rbac/rbac_role_permission');
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
        //echo $this->db->last_query();
        //pma($result,1);
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

    /**
     * @param  : 
     * @desc   :fetch app configs
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_app_configs() {
        $query = "select * from app_configs order by category asc";
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

}
