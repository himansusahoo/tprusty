<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $this->rbac->get_admin_dashboard_url() ?>" class="brand-link elevation-4">
        <img src="<?= base_url('images/supports.png')?>"
             alt="Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">      
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            $currentRoutes = explode('/', $this->uri->uri_string());
            $currentRoutes = current($currentRoutes);
            echo $this->rbac->show_user_menu_left();
            
            $sub_menus = array(
                'edit-admission-form' => 'admission-form-list',
                'view-admission-form' => 'admission-form-list'
            );
            if(array_key_exists($currentRoutes,$sub_menus)){
                $currentRoutes=$sub_menus['edit-admission-form'];
            }
            ?>
            <span class="menu_routes" style="color:white; display: none;"><?= $currentRoutes ?></span>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>    
<script>
    $(document).ready(function () {
        //logic to highlighted the selected left menu
        var menu_routes = $('.menu_routes').text();
        var chieldEle = $('.select_menu').attr('data-parent-menu');
        if (chieldEle) {
            menu_routes = chieldEle;
        }

        select_menu();
        function select_menu() {
            $('.sub_nav_link').each(function () {
                var url = $(this).attr('data-routes');
                //console.log(url,menu_routes);
                if (menu_routes == url) {
                    $(this).addClass('active');
                    var list = $(this).closest('ul.nav-treeview').closest('li');
                    list.addClass('menu-open');
                    if (list.closest('ul.nav-treeview').parent('li').hasClass('has-treeview')) {
                        var superMenu = list.closest('ul.nav-treeview').parent('li');
                        superMenu.addClass('menu-open');
                        superMenu.find('a.main_nav_link').addClass('active');
                    }
                    list.find('a.main_nav_link:first').addClass('active');
                }
            });
        }

    });
</script>