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
class Manage_staff extends CI_Model {

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
    public function get_staff_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'user_id,first_name,last_name,login_id,email,login_status,mobile'
                    . ',mobile_verified,email_verified,status';
        }
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)
                ->from('rbac_users t1')
                ->where('user_type', 'employee');

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
                'password' => c_encode($data['password']),
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
                return true;
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
            $columns = 'user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status';
        }
        $this->db->select($columns)->from('rbac_users t1')
                ->where('user_type', 'employee');

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
            $this->db->where("user_id", $data['user_id']);
            return $this->db->update('rbac_users', $data);
        endif;
        return 'Unable to update the data, please try again later!';
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

}
