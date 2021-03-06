<?php

class Rbac {

    private $_session;
    private $_ci;

    public function __construct() {
        $this->_ci = & get_instance();
        $this->_session = $this->_ci->session->all_userdata();
        //pma($this->_ci->session->all_userdata(),1);
        //pma($this->_session['user_data']['role_codes'],1);       
    }

    /**
     * @param  : 
     * @desc   : used to check user is log-in status
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function is_login($return_flag = false) {
        if (isset($this->_session['user_data']['user_id'])) {
            return $this->_session['user_data']['user_id'];
        } else {
            if ($return_flag === TRUE) {
                return FALSE;
            } else {
                if ($this->_ci->layout->layout == 'admin_lte') {
                    redirect('admin-login');
                } else if (!strpos(current_url(), 'user-login')) {
                    redirect('user-login');
                }
            }
        }
    }

    /**
     * @param  : 
     * @desc   : use to check logged in user is admin or not
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function is_admin() {
        if ($this->is_login()) {
            if (in_array('ADMIN', $this->_session['user_data']['role_codes'])) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : use to check logged in user is admin or not
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function is_developer() {
        if ($this->is_login()) {
            if (in_array('DEVELOPER', $this->_session['user_data']['role_codes'])) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : used to fetch all assigned role id
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_role_ids() {
        if ($this->is_login()) {
            $role_ids = array_column($this->_session['user_data']['roles'], 'role_id');
            return $role_ids;
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : used to fetch all assigned role id
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_role_codes() {
        if ($this->is_login()) {
            $role_codes = $this->_session['user_data']['role_codes'];
            return $role_codes;
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : used to fetch user_id
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_id() {
        if (isset($this->_session['user_data']['user_id'])) {
            return $this->_session['user_data']['user_id'];
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : used to fetch user type
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_type() {
        if (isset($this->_session['user_data']['user_type'])) {
            return $this->_session['user_data']['user_type'];
        }
        return 0;
    }

    /**
     * @param  : String $module_code, String $action_code
     * @desc   : used to check user has permition or not
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function has_permission($module, $action = null) {
        if ($this->is_login()) {

            if ($this->is_developer()) {
                return 1;
            }
            $module = strtoupper($module);
            $action = $action;

            $permissions = $this->_session['user_data']['permissions'];
            $module_codes = $this->_session['user_data']['permission_modules'];
            //pma($module_codes,1);

            if ($module && $action) {
                if (in_array($module, $module_codes)) {
                    if ($action) {
                        $action_details = $permissions[$module]['actions'];
                        if (array_key_exists($action, $action_details) && isset($permissions[$module]['actions'][$action]['action_name'])) {
                            return TRUE;
                        }
                    }
                }
            } else if ($module) {
                if (in_array($module, $module_codes)) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    /**
     * @param  : String $module_code, String $action_code
     * @desc   : used to check user has permition or not
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function has_role($role_code) {
        if ($this->is_login() && in_array($role_code, $this->_session['user_data']['role_codes'])) {
            return true;
        }
        return false;
    }

    /**
     * @param  : 
     * @desc   :fetch user full name
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_email() {
        if (isset($this->_session['user_data']['email'])) {
            return $this->_session['user_data']['email'];
        }
        return '';
    }

    /**
     * @param  : 
     * @desc   :fetch user full name
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_name() {
        if (isset($this->_session['user_data']['first_name'])) {
            return $this->_session['user_data']['first_name'] . " " . $this->_session['user_data']['last_name'];
        }
        return '';
    }

    /**
     * @method: get_user_permission() 
     * @param: int $status int $user_id
     * @return:  boolean as per result
     * @desc: Function to enable/disable the user
     */
    public function get_user_permission($user_id = null) {
        if ($this->_session['user_data']['permissions'] || $this->is_developer()) {
            return $this->_session['user_data']['permissions'];
        } else {
            $this->_ci->session->set_flashdata('error', 'No permission assigned you to access the Dashboard,Please contact site Admin.');
            if ($this->_ci->layout->layout == 'admin_lte') {
                redirect('admin-login');
            } else if (!strpos(current_url(), 'user-login')) {
                redirect('user-login');
            }
        }
        return 0;
    }

    /**
     * @param  : NA
     * @desc   : generate top menu based on users permission
     * @return : string menu 
     * @author : himansu
     */
    public function show_user_menu_top() {
        $params = array('rbac_session' => $this->_session);
        $this->_ci->load->library('rbac_menu_lib', $params);
        $menu = $this->_ci->rbac_menu_lib->get_user_menus(" AND lower(menu_type)='l'");
        return $menu;
        //return $this->_ci->rbac_menu->show_menu();
    }

     /**
     * @param  : NA
     * @desc   : generate top menu based on users permission
     * @return : string menu 
     * @author : himansu
     */
    public function show_user_menu_left() {
        $params = array('rbac_session' => $this->_session);
        $this->_ci->load->library('rbac_menu_lib', $params);
        $menu = $this->_ci->rbac_menu_lib->get_user_menus(" AND lower(menu_type)='l'");
        return $menu;
    }

    /**
     * @param  : NA
     * @desc   : generate right menu based on users permission
     * @return : string menu 
     * @author : himansu
     */
    public function show_user_menu_right() {
        
    }

    public function tree_view($results, $parent_id, $sub_menu = false) {

        $tree = array();
        $counter = sizeof($results);
        $i = 0;
        foreach ($results as $ky => $rec) {
            if ($rec['parent'] == $parent_id) {
                if ($this->has_child($results, $rec['permission_id'])) {
                    $sub_menu = $this->tree_view($results, $rec['permission_id']);
                    $index = strtoupper($rec['code']) . '_' . $rec['action_id'];
                    $tree[$index] = $sub_menu;
                    $tree[$index][$index] = $rec;
                } else {
                    $index = strtoupper($rec['code']) . '_' . $rec['action_id'];
                    if (count($rec) > 1) {
                        $tree[] = $rec;
                    } else {
                        $tree[$index] = $rec;
                    }
                }
            }
        }
        return $tree;
    }

    public function tree_view2($results, $parent_id, $key_column, $parent_col, $sub_menu = false) {

        $tree = array();
        $counter = sizeof($results);
        $i = 0;
        foreach ($results as $ky => $rec) {
            if ($rec[$parent_col] == $parent_id) {
                if (isset($rec[$key_column]) && !isset($tree[$rec[$key_column]])) {
                    $tree[$rec[$key_column]] = $rec;
                }
                if (isset($rec[$key_column]) && $this->has_child($results, $rec[$key_column], $parent_col)) {
                    $sub_menu = $this->tree_view2($results, $rec[$key_column], $key_column, $parent_col);
                    if ($sub_menu) {
                        $cur_sub_menu = current($sub_menu);
                        if (isset($cur_sub_menu[$parent_col]) && !array_key_exists('children', $tree[$cur_sub_menu[$parent_col]])) {

                            $tree[$cur_sub_menu[$parent_col]]['children'] = array();
                            foreach ($sub_menu as $rec) {
                                $tree[$cur_sub_menu[$parent_col]]['children'][] = $rec;
                            }
                        }
                    }
                }
            }
        }

        return $tree;
    }

    public function has_child($results, $menu_id, $parent_col = 'parent') {
        $counter = sizeof($results);
        for ($i = 0; $i < $counter; $i++) {
            if ($results[$i][$parent_col] == $menu_id) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param  : 
     * @desc   : used to fetch app config item using xpath
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_app_config_item($xpath, $condition = "", $session = true) {
        if ($session) {
            $app_configs = $this->_session['user_data']['app_configs'];
        } else {
            $query = "SELECT * FROM app_configs where 1=1 $condition";
            $result = $this->_ci->db->query($query)->result_array();
            $app_configs = array();
            foreach ($result as $key => $rec) {
                $app_configs[strtolower($rec['category'])] = json_decode($rec['configs'], true);
            }
            //pma($app_configs,1);
        }

        // creating object of SimpleXMLElement
        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        //call by reference
        array_to_xml($app_configs, $xml_data);
        return $xml_data->xpath($xpath);
    }

    /**
     * @param  : 
     * @desc   : used to fetch heighest role from role code list based on role priority set in app config page
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_highest_role($role_code_array = array()) {
        $role_priority = $this->get_app_config_item('rbac/role_priority');
        if (isset($role_priority[0])) {
            $priority = array();
            foreach ($role_priority[0] as $key => $ele) {
                $priority[] = (string) $ele;
            }
            $highest_role = '';
            $index = 0;
            $swap = '';
            if (!$role_code_array) {
                $role_code_array = $this->get_role_codes();
            }
            foreach ($role_code_array as $role) {
                $index = array_search($role, $priority);
                if ($swap == '') {
                    $swap = $index;
                }
                if ($index == 0) {
                    $highest_role = $role;
                    break;
                } else if ($swap > $index) {
                    $swap = $index;
                    $highest_role = $priority[$index];
                } elseif ($swap < $index) {
                    $highest_role = $priority[$swap];
                } else {
                    $highest_role = $priority[$swap];
                }
            }
            return $highest_role;
        }
    }

    /**
     * 
     * @method
     * @param   
     * @desc    used to sort user role code as per the priority set
     * @return Array $sorted_roles
     * @author  HimansuS                  
     * @since   
     */
    public function sort_user_roles($role_codes) {
        $role_codes_copy = $role_codes;
        $sorted_code = array();
        foreach ($role_codes as $role_code) {
            $heighest_code = $this->get_highest_role($role_codes_copy);
            $sorted_code[] = $heighest_code;
            $index = array_search($heighest_code, $role_codes_copy);
            unset($role_codes_copy[$index]);
        }
        return $sorted_code;
    }

    public function get_role_desc($role_code) {
        if (isset($this->_session['user_data']['roles'])) {
            $roles = $this->_session['user_data']['roles'];
            foreach ($roles as $role) {
                if ($role['code'] == $role_code) {
                    return $role['name'];
                }
            }
        }
        return '';
    }

    public function get_profile_pic() {
        if (isset($this->_session['user_data']['profile_pic']) && $this->_session['user_data']['profile_pic'] != '') {
            return '/uploads/employee/profile_picture/' . $this->_session['user_data']['profile_pic'];
        }
        return '/images/user-icon.png';
    }

    public function set_profile_pic($profile_pic) {
        $this->_session['user_data']['profile_pic'] = $profile_pic;
        $this->_ci->session->set_userdata('user_data', $this->_session['user_data']);
    }

    public function get_admin_dashboard_url() {
        $redirect = '';
        $user_type = $this->get_user_type();
        switch ($user_type) {
            case 'developer':
                $redirect = 'developer-dashboard';
                break;
            case 'employee':
                $redirect = 'employee-dashboard';
                break;
            case 'admin':
                $redirect = 'admin-dashboard';
                break;
            case 'seller':
                $redirect = 'seller-dashboard';
                break;
        }
        return base_url($redirect);
    }

    public function get_admin_logout_url() {
        $redirect = '';
        $user_type = $this->get_user_type();
        switch ($user_type) {
            case 'seller':
                $redirect = 'seller-logout';
                break;
            default:
                $redirect = 'admin-logout';
                break;
        }
        return base_url($redirect);
    }

    public function temp_sub_menus($menu_name) {
        $menus = array(
            'admin_reports' => array(
                'order-reports' => 'Order Report',
                'return-order-reports' => 'Return Order Report',
                'sale-reports' => 'Sales Report',
                'seller-reports' => 'Seller Report',
                'product-reports' => 'Product Report',
                'seller-wise-top-selling-products' => 'Top Selling Product By Seller',
                'buyer-reports' => 'Buyer Report',
                'buyer-wallet-reports' => 'Buyer Wallet Report',
                'seller-payout-reports' => 'Seller Payout Report',
                'tax-reports' => 'Tax Report',
                'seller-profile-reports' => 'Seller Profile Report',
                'buyer-profile-reports' => 'Buyer Profile Report'
            )
        );
        if (array_key_exists($menu_name, $menus)) {
            return $menus[$menu_name];
        }
        return '';
    }

    public function grid_xpath_headers($xpath, $case = false) {
        $grid_headers = $this->get_app_config_item($xpath, '', false);

        $grid_headers = current(xml2array($grid_headers));
        $headerArr = $headerArr2 = array();

        switch ($case) {
            case 'string':
                $header = "";
                $indx = 0;
                if (is_array($grid_headers)) {
                    foreach ($grid_headers as $head) {
                        if (array_key_exists('order', $head) && count($head['order']) > 0) {
                            $headerArr[$head['order']] = $head['column'];
                        } else {
                            $headerArr2[] = $head['column'];
                        }
                    }
                    $headerArr = $this->manage_header_arr($headerArr, $headerArr2);
                    $header = implode(',', $headerArr);
                    $header = rtrim($header, ',');
                }

                break;
            case 'head':
                $header = $headerArr2 = array();
                if (is_array($grid_headers)) {
                    foreach ($grid_headers as $head) {
                        if (array_key_exists('order', $head) && count($head['order']) > 0) {
                            $headerArr[$head['order']] = $head;
                        } else {
                            $headerArr2[] = $head;
                        }
                    }
                    $headerArr = $this->manage_header_arr($headerArr, $headerArr2);
                    foreach ($headerArr as $head) {
                        $label = (isset($head['label']) ? ucfirst(str_replace('_', ' ', $head['label'])) : ucfirst(str_replace('_', ' ', $head['column'])));
                        $header[$head['column']] = $label;
                    }
                }


                break;
            default:
                $header = $headerArr2 = array();
                if (is_array($grid_headers)) {
                    foreach ($grid_headers as $head) {
                        if (array_key_exists('order', $head) && count($head['order']) > 0) {
                            $headerArr[$head['order']] = $head;
                        } else {
                            $headerArr2[] = $head;
                        }
                    }

                    $headerArr = $this->manage_header_arr($headerArr, $headerArr2);
                    
                    foreach ($headerArr as $head) {
                        if (array_key_exists('column', $head)) {
                            $label = (isset($head['label']) ? ucfirst(str_replace('_', ' ', $head['label'])) : ucfirst(str_replace('_', ' ', $head['column'])));
                            $header[] = array(
                                'db_column' => $head['column'],
                                'name' => $label,
                                'title' => $label,
                                'class_name' => $head['column'],
                                'orderable' => 'true',
                                'visible' => 'true',
                                'searchable' => 'true'
                            );
                        }
                    }
                }

                break;
        }

        return $header;
    }

    private function manage_header_arr($header1, $header2) {
        if (count($header1)) {
            ksort($header1);
            foreach ($header2 as $rec) {
                array_push($header1, $rec);
            }
            return $header1;
        } else {
            return $header2;
        }
    }

    public function get_seller_id() {
        if (array_key_exists('seller-session', $this->_session)) {
            return $this->_session['seller-session'];
        }
        return 0;
    }

}
