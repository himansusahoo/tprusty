<?php ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
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
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <!--            <li class="header">MAIN NAVIGATION</li>-->
            <li class="active treeview">                    
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>RBAC</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_actions"><i class="fa fa-circle-o text-aqua text-aqua"></i> Actions</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_modules"><i class="fa fa-circle-o text-aqua"></i> Modules</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_permissions/create"><i class="fa fa-circle-o text-aqua"></i> Permissions</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_roles"><i class="fa fa-circle-o text-aqua"></i> Roles</a></li>                    
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_role_permissions/manage_permissions/1"><i class="fa fa-circle-o text-aqua"></i> Assign Permissions</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_users"><i class="fa fa-circle-o text-aqua"></i> Users</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_user_roles"><i class="fa fa-circle-o text-aqua"></i> User Roles</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_custom_permissions"><i class="fa fa-circle-o text-aqua"></i> Custom Permissions</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="<?= APP_BASE ?>cruds">
                    <i class="fa fa-gears"></i> <span>CRUD</span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?= APP_BASE ?>admin/file_upload"><i class="fa fa-circle-o text-aqua text-aqua"></i> Upload</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>admin/modal"><i class="fa fa-circle-o text-aqua text-aqua"></i> Modal</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>admin/tooltip"><i class="fa fa-circle-o text-aqua text-aqua"></i> Tooltip</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>admin/alert"><i class="fa fa-circle-o text-aqua text-aqua"></i> Alert</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_permissions/permissions"><i class="fa fa-circle-o text-aqua text-aqua"></i> Permissions</a></li>
                    <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_permissions/manage_menu"><i class="fa fa-circle-o text-aqua text-aqua"></i> Manage menu</a></li>                    
                    <li class="active"><a href="<?= APP_BASE ?>users/log_out"><i class="fa fa-circle-o text-aqua text-aqua"></i> Logout</a></li>
                 </ul>
            </li>
        </ul>
        <?php //$this->rbac->show_user_menu_left();?>
    </section>
    <!-- /.sidebar -->
</aside>
