<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Manage_staff
 * @desc    :
 * @author  : HimansuS
 * @created :10/08/2018
 */
class Manage_employee extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac/rbac_role');
    }

    /**
     * @param              : $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function get_staff_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        $login_user_id = $this->rbac->get_user_id();
        if (!$columns) {
            $columns = 'user_id,first_name,last_name,login_id,email,login_status,mobile'
                    . ',mobile_verified,email_verified,status';
        }
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)
                ->from('rbac_users t1')
                ->where('user_type', 'employee')
                ->where('user_id !=', $login_user_id);

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
     * @param              : $data
     * @desc               : save staff profile data
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function save($data) {
        if ($data) :
            $this->db->trans_begin();
            $staff_user_data = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                //'login_id' => $data['login_id'],
                'email' => $data['email'],
                'password' => md5($data['password']),
                'mobile' => $data['mobile'],
                'user_type' => 'employee',
                'created_by' => $data['created_by'],
                'status' => 'active'
            );
            $this->db->insert("rbac_users", $staff_user_data);
            $user_id_inserted_id = $this->db->insert_id();
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $user_id_inserted_id;
            }
        endif;
        return 'Unable to store the data, please try again later!';
    }

    /**
     * @param              : $user_id
     * @desc               : delete staff
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
     * @param              : $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function get_staff_data($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 't1.user_id,t1.first_name,t1.last_name,t1.login_id,t1.email,t1.password,t1.login_status
                ,t1.mobile,t1.mobile_verified,t1.email_verified,t1.created,t1.modified,t1.created_by
                ,t1.modified_by,t1.status
                ,concat(t2.first_name,t2.last_name) created_by_name
                ,concat(t3.first_name,t3.last_name) modified_by_name
                ,t1.profile_pic';
        }
        $this->db->select($columns, false)->from('rbac_users t1')
                ->join('rbac_users t2', 't2.user_id=t1.created_by', 'LEFT')
                ->join('rbac_users t3', 't3.user_id=t1.modified_by', 'LEFT')
                ->where('t1.user_type !=', 'student');

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
     * @desc               : update staff data
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function update($data) {
        if ($data) :
            $this->db->trans_begin();
            if ($data['user_id']) {
                $staff_user_data = array(
                    'user_id' => $data['user_id'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'modified' => $data['modified'],
                    'modified_by' => $data['modified_by'],
                    'status' => $data['status']
                );
                $this->db->where('user_id', $data['user_id']);
                $this->db->update("rbac_users", $staff_user_data);
                //user role update
                $this->user_role_update($data['user_id'], $data['employee_roles']);
            } else {
                //invalid data to update
                return false;
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        endif;
    }

    /**
     * @param  : string $condition
     * @desc   : used to check duplicacy of user column
     * @return : number 0/count value
     * @author : HimansuS
     * @created:
     */
    public function check_duplicate($condition) {
        $query = "select count(user_id) count_rec from rbac_users where 1=1 $condition";
        $result = $this->db->query($query)->row();
        return $result->count_rec;
    }

    /**
     * @param  : 
     * @desc   : used to fetch users assigned roles
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_roles($user_id, $columns = 'rur.role_id') {
        //fetch existing user roles
        $query = "select $columns from rbac_user_roles rur 
                left join rbac_roles rr on rr.role_id=rur.role_id
                where rur.user_id=$user_id";
        $user_roles = $this->db->query($query)->result_array();
        return $user_roles;
    }

    /**
     * @param  : 
     * @desc   : used to update user roles
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function user_role_update($user_id, $selected_user_roles) {
        $user_roles = $this->get_user_roles($user_id);
        $user_roles = flattenArray($user_roles);
        if ($selected_user_roles) {
            $selected_user_roles = explode(',', $selected_user_roles);
            $new_roles = array_diff($selected_user_roles, $user_roles);
            $removed_roles = array_diff($user_roles, $selected_user_roles);
        }
        //insert new role to user
        if ($new_roles) {
            $new_role_data = array();
            foreach ($new_roles as $role_id) {
                $new_role_data[] = array(
                    'user_id' => $user_id,
                    'role_id' => $role_id
                );
            }
            $query = $this->db->insert_batch('rbac_user_roles', $new_role_data);
        }
        //remove assigned role if not selected from dorpdown
        if ($removed_roles) {
            $removed_roles = implode(',', $removed_roles);
            $query = "Delete from rbac_user_roles where user_id=$user_id and role_id in($removed_roles)";
            $this->db->query($query);
        }
    }

    /**
     * @param              : $data
     * @desc               : update staff data
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function update_emp_password($condition, $new_password) {
        if ($condition) :
            $this->db->trans_begin();
            if (isset($condition['user_id']) && isset($condition['password'])) {
                foreach ($condition as $key => $val) {
                    $this->db->where($key, $val);
                }
                $staff_user_data = array(
                    'password' => md5($new_password)
                );
                $this->db->update("rbac_users", $staff_user_data);
            } else {
                //invalid data to update
                return false;
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        endif;
    }

    /**
     * 
     * @method
     * @param   
     * @desc   used to update employee profile picture
     * @return 
     * @author  HimansuS                  
     * @since   
     */
    public function update_profile_picture($picture_name, $user_id) {
        $this->db->trans_begin();
        $this->db->where('user_id', $user_id);
        $this->db->update("rbac_users", $picture_name);
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @name 
     * @param 
     * @desc 
     * @return 
     */
    public function feed_rbac_user($data, $roleCode) {
        $userId = $this->save($data);
        if ($userId >= 1) {
            $condition = array('code' => $roleCode);
            $role = $this->rbac_role->get_rbac_role(null, $condition);
            if ($role) {
                $role = current($role);
                $this->user_role_update($userId, $role['role_id']);
            }
        }
    }
    
    public function match_user_password($password){
        $password=md5($password);
        $query="SELECT COUNT(*) as match_password FROM rbac_users WHERE password=?";
        $result=$this->db->query($query,array($password))->row();
        if($result){
            return $result->match_password;
        }
        return 0;        
    }

}
