<?php

class App_config extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get_chart_config Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/15/2018
     */
    public function get_app_config($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'config_id,name,category,configs'
                    . ',created,created_by,modified,modified_by';
        }
        $this->db->select($columns)->from('app_configs t1');

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
     * @param  : 
     * @desc   : used to save the application config
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function save_config($data) {
        if ($data):
            $this->db->trans_begin();
            $result = 0;
            if (isset($data['app_configs_category'])) {
                $category = $data['app_configs_category'];
                $query = "SELECT config_id FROM app_configs WHERE lower(category)=lower('$category')";
                $result = $this->db->query($query)->row();
                if ($result) {
                    //update config
                    $record = array(
                        'configs' => json_encode($data['app_configs']),
                        'modified' => date('Y-m-d H:i:s'),
                        'modified_by' => $this->rbac->get_user_id()
                    );
                    $this->db->where('config_id', $result->config_id);
                    $this->db->update("app_configs", $record);
                } else {
                    //create config
                    $record = array(
                        'name' => $data['app_configs_category'],
                        'category' => $data['app_configs_category'],
                        'configs' => json_encode($data['app_configs']),
                        'created_by' => $this->rbac->get_user_id()
                    );
                    $this->db->insert("app_configs", $record);
                }
            } else {
                return false;
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        endif;
        return false;
    }

    /**
     * @param  : 
     * @desc   : fetched role list excluding DEVELOPER & ADMIN
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_role_code_list() {
        $query = "SELECT CODE FROM rbac_roles where 
               created_by in (
                select user_id from rbac_user_roles rur
                left join rbac_roles rr on rr.role_id=rur.role_id
                where rr.code in('ADMIN','DEVELOPER')
               )
               and code not in('ADMIN','DEVELOPER')";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

}
