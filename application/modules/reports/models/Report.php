<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Model {

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
    public function get_seller_gst_report_datatable($columns = '*', $condition = null, $export = null, $tableHeading = null) {
        $this->load->library('datatables');
        //pma($condition);
        $login_user_id = $this->rbac->get_user_id();

        $this->datatables->select('distinct SQL_CALC_FOUND_ROWS ' . $columns, false, false)
                ->from('order_info_vw_materialized iv');       
        
        if ($this->rbac->is_admin() || $this->rbac->is_developer() || $this->rbac->has_role('ADMIN_STAFF')) {
            //No action required
        }elseif($this->rbac->has_role('SELLER')){                
            $this->datatables->where('seller_id', $this->rbac->get_seller_id());
        }
            
        
        if (is_array($condition) && array_key_exists('custom_search', $condition)) {

            $condition = $condition['custom_search'];
            if (is_array($condition)) {
                foreach ($condition as $col => $val) {
                    if ($val) {
                        $this->datatables->where($col, $val);
                    }
                }
            }elseif(is_string($condition) && $condition!=''){
                 $this->datatables->where($condition);
            }            
        }

        //$this->datatables->unset_column("user_id");
        if ($export) :
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    public function get_min_max_date() {
        $query = "
                SELECT min_date,max_date
                ,YEAR(min_date) minY
                ,MONTH(min_date) minM
                ,MONTH(min_date) minD
                ,YEAR(max_date) maxY
                ,MONTH(max_date) maxM
                ,MONTH(max_date) maxD
                FROM(
                    SELECT min(date_of_order) min_date,max(date_of_order) max_date 
                    from order_info_vw_materialized
                    limit 1
                )a
                ";
        $result = $this->db->query($query)->row();
        //pma($result,1);
        return $result;
    }
    
    public function get_seller_option_list($condition=""){
        $query="SELECT distinct seller_id,business_name from order_info_vw_materialized where 1=1 $condition";
        $result=$this->db->query($query)->result_array();
        $options=array(
            '0'=>''
        );
        foreach ($result as $rec){
            $options[$rec['seller_id']]=$rec['business_name'];
        }
        return $options;
    }

}
