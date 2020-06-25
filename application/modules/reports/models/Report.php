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
    public function get_seller_gst_report_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        $login_user_id = $this->rbac->get_user_id();
        if (!$columns) {
            $columns = 'user_id,first_name,last_name,login_id,email,login_status,mobile'
                    . ',mobile_verified,email_verified,status';
        }
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, false, false)
                ->from('rbac_users t1')
                //->where('user_type', 'employee')
                ->where('user_id !=', $login_user_id);

        $this->datatables->unset_column("user_id");        
        if ($export) :
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

}
