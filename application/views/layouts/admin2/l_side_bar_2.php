<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= APP_BASE ?>layout/admin/dist/img/avatar5.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= ucfirst($this->session->user['role_name']) ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>        
        <?php
        $menus = $this->rbac->show_user_menu_left();
        $menu_str = '';
        if ($menus) {
            $header_active_flag = false;
            $menu_active_flag = false;

            $menu_str = '<ul class="sidebar-menu">';
            if ($menus && is_array($menus)) {
                foreach ($menus as $module => $menu) {
                    //when menu does not any chield-menu
                    if (!isset($menu[$module])) {
                        $temp_menu = $menu;
                        $menu = array();
                        $menu[$module] = $temp_menu;
                    }
                    $header_class = ($menu[$module]['header_class']) ? $menu[$module]['header_class'] : 'fa-dashboard';

                    $active_header = '';
                    if (!$header_active_flag) {
                        //do active the clicked menu header
                        $c_url = current_url();
                        $m_urls = array_column($menu, 'url');

                        foreach ($m_urls as $urls) {
                            $url = APP_BASE . $urls;
                            if ($url == $c_url) {
                                $active_header = 'active';
                                $header_active_flag = TRUE;
                            }
                        }
                    }
                    $menu_str.='<li class="treeview ' . $active_header . '">';
                    $menu_str.='<a href="#">
                                    <i class="fa ' . $header_class . '"></i> <span>' . $menu[$module]['menu_header'] . '</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>';
                    $menu_str.='<ul class="treeview-menu">';
                    $c_url = current_url();
                    foreach ($menu as $m) {
                        //do active the clicked menu
                        $active_sm = '';
                        if (!$menu_active_flag) {
                            $m_url = APP_BASE . $m['url'];
                            if ($m_url == $c_url) {
                                $active_sm = 'active';
                            }
                        }

                        $name = ($m['menu_name']) ? $m['menu_name'] : $m['name'];
                        $menu_str.='<li class="' . $active_sm . '"><a href="' . $m_url . '">'
                                . '<i class="fa fa-circle-o ' . $m['menu_class'] . '">'
                                . '</i> ' . $name . '</a></li>';
                    }
                    $menu_str.='</ul>';
                    $menu_str.='</li>';
                }
            }

            $menu_str.='</ul>';
        }
        echo $menu_str;
        ?>
    </section>
</aside>
