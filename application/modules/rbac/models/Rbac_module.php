<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_module
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_module extends CI_Model
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
    public function get_rbac_module_datatable($data = null, $export = null, $tableHeading = null, $columns = null)
    {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'module_id,name,code,status';
        }

        /*
         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)->from('rbac_modules t1');

        $this->datatables->unset_column("module_id");
        if (isset($data['button_set'])) :
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(module_id)', 1, 1);
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
    public function get_rbac_module($columns = null, $conditions = null, $limit = null, $offset = null)
    {
        if (!$columns) {
            $columns = 'module_id,name,code,status,created,modified';
        }

        /*
         */
        $this->db->select($columns)->from('rbac_modules t1');

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
            $this->db->insert("rbac_modules", $data);
            $module_id_inserted_id = $this->db->insert_id();

            if ($module_id_inserted_id) :
                return $module_id_inserted_id;
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
            $this->db->where("module_id", $data['module_id']);
            return $this->db->update('rbac_modules', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * @param              : $module_id
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function delete($module_id)
    {
        if ($module_id) :
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('rbac_permissions', array('module_id' => $module_id));
            $this->db->delete('rbac_modules', array('module_id' => $module_id));
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
            $columns = 'module_id';
        }
        if (!$index) {
            $index = 'module_id';
        }
        $this->db->select("$columns,$index")->from('rbac_modules t1');

        if ($conditions && is_array($conditions)) :
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select rbac modules';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count()
    {
        return $this->db->count_all('rbac_modules');
    }

}

?>