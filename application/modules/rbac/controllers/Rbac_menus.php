<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_menus
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_menus extends MX_Controller {

    public function __construct() {
        parent::__construct();        
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
        $this->load->model('rbac_menu');
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function index() {
        $this->scripts_include->includePlugins(array('jstree', 'promise'), 'js');
        $this->scripts_include->includePlugins(array('jstree'), 'css');
        $this->layout->render();
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_tree_data() {
        $column = "rp.permission_id id,rp.order,rp.parent prnt,
                case when length(rp.menu_name)>1 then rp.menu_name else concat(rm.name,'-',ra.name) end text,rp.menu_header,rm.code,rp.action_id";
        $column = null;
        $permission_list = $this->rbac_menu->get_menu_data($column, null, true);

        if ($permission_list) {
            $permission_list = $this->rbac->tree_view2($permission_list, 0, 'id', 'prnt', true);
        }
        //pma($permission_list,1);
        echo json_encode(array_values($permission_list));
        exit;
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_menu_details_form() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('rbac/rbac_permission');
            $menu_id = $this->input->post('id');
            $menu = $this->rbac_menu->get_menu_data(null, array('menu_id' => $menu_id), true);
            $permission_id_list = $this->rbac_permission->get_perm_options(null, null, null);
            //pma($permission_id_list,1);
            $this->layout->data = array(
                'permission_id_list' => $permission_id_list,
                'menu_details' => $menu[0],
                'menu_types' => array(
                    'l' => 'Left',
                    'r' => 'Right',
                    't' => 'Top',
                    'o' => 'Other',
                )
            );
            //pma($menu,1);
            $view = $this->layout->render(array('view' => 'rbac/rbac_menus/menu_details_form'), true);
            echo $view;
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function update_parent_and_order() {
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            $this->rbac_menu->update_menu_parent($data);
            exit;
        }
    }

    /**
     * @method 
     * @param
     * @desc
     * @author
     * @date
     */
    public function save_menu_details() {
        if ($this->input->is_ajax_request()) {
            $post_data = $this->input->post('menu_data');

            if ($this->rbac_menu->save_menu_details($post_data)) {
                echo json_encode(array('status' => 'success', 'title' => 'success', 'message' => 'Menu saved successfully.'));
            } else {
                echo json_encode(array('status' => 'error', 'title' => 'error', 'message' => 'Thre is some critical error, please try again.'));
            }
        } else {
            echo "invalid request type";
        }
    }

    /**
     * @method 
     * @param
     * @desc
     * @author
     * @date
     */
    public function create_dummy_menu() {
        if ($this->input->is_ajax_request()) {
            $post_data = $this->input->post();
            $insert_id = $this->rbac_menu->save_menu_details($post_data, true);
            if ($insert_id) {
                echo json_encode(array('status' => 'success', 'message' => 'Menu created successfully.', 'new_node' => $insert_id));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Thre is some critical error, please try again.'));
            }
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @method 
     * @param
     * @desc
     * @author
     * @date
     */
    public function delete_menu() {
        if ($this->input->is_ajax_request()) {
            $post_data = $this->input->post();
            if ($this->rbac_menu->delete_menu($post_data)) {
                echo json_encode(array('status' => 'success', 'message' => 'Menu deleted successfully.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Thre is some critical error, please try again.'));
            }
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

}

?>