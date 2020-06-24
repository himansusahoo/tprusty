<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_action
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_action extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param              : $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function get_rbac_action_datatable($data = null, $export = null, $tableHeading = null, $columns = null)
    {
        $this->load->library('datatables');
        if (!$columns) {
            //$columns = 'action_id,name,code,status,created,modified';
            $columns = 'action_id,name,code,status';
        }

        /*
         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)->from('rbac_actions t1');

        $this->datatables->unset_column("action_id");
        $this->datatables->unset_column("status");
        if (isset($data['button_set'])) :
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(action_id)', 1, 1);
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
    public function get_rbac_action($columns = null, $conditions = null, $limit = null, $offset = null)
    {
        if (!$columns) {
            $columns = 'action_id,name,status,created,modified,code';
        }

        /*
         */
        $this->db->select($columns)->from('rbac_actions t1');

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
            $this->db->insert("rbac_actions", $data);
            $action_id_inserted_id = $this->db->insert_id();

            if ($action_id_inserted_id) :
                return $action_id_inserted_id;
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
            $this->db->where("action_id", $data['action_id']);
            return $this->db->update('rbac_actions', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * @param              : $action_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function delete($action_id)
    {
        if ($action_id) :
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('rbac_actions', array('action_id' => $action_id));
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
            $columns = 'action_id';
        }
        if (!$index) {
            $index = 'action_id';
        }
        $this->db->select("$columns,$index")->from('rbac_actions t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select rbac actions';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count()
    {
        return $this->db->count_all('rbac_actions');
    }

}

?>