<?php

/**
 * App_route Class File
 * PHP Version 7.2.9
 * 
 * @category   App_routes
 * @package    App_routes
 * @subpackage App_route
 * @class      App_route
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   08/25/2019
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * App_route Class
 * 
 * @category   App_routes
 * @package    App_routes
 * @class      App_route
 * @desc    
 * @author     HimansuS                  
 * @since   08/25/2019
 */
class App_route extends CI_Model {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function __construct() {
        parent::__construct();


        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_app_route_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function get_app_route_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'id,module,slug,path,status';
        }

        /*
         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('app_routes t1');

        $this->datatables->unset_column("id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_app_route Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function get_app_route($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'id,module,slug,path,status,created,modified,created_by,modified_by';
        }

        /*
         */
        $this->db->select($columns)->from('app_routes t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        endif;
        if ($limit > 0):
            $this->db->limit($limit, $offset);

        endif;
        $result = $this->db->get()->result_array();

        return $result;
    }

    /**
     * Save Method
     * 
     * @param   $data
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function save($data) {
        if ($data):
            $this->db->insert("app_routes", $data);
            $id_inserted_id = $this->db->insert_id();

            if ($id_inserted_id):
                return $id_inserted_id;
            endif;
            return 'No data found to store!';
        endif;
        return 'Unable to store the data, please try again later!';
    }

    /**
     * Update Method
     * 
     * @param   $data
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function update($data) {
        if ($data):
            $this->db->where("id", $data['id']);
            return $this->db->update('app_routes', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function delete($id) {
        if ($id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('app_routes', array('id' => $id));
            if ($this->db->trans_status() === FALSE) {
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
     * Get_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   08/25/2019
     */
    public function get_options($columns, $index = null, $conditions = null) {
        if (!$columns) {
            $columns = 'id';
        }
        if (!$index) {
            $index = 'id';
        }
        $this->db->select("$columns,$index")->from('app_routes t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select app routes';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count() {
        return $this->db->count_all('app_routes');
    }

}

?>