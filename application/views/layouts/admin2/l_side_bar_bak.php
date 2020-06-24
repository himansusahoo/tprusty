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
                <p><?= ucfirst($this->session->user['role_name'])?></p>
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
        <?PHP if ($this->rbac->is_login()): ?>
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
                        <?php if ($this->rbac->has_permission('RBAC_ACTION')): ?>
                            <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_actions"><i class="fa fa-circle-o text-aqua text-aqua"></i> Actions</a></li>
                        <?php endif; ?>
                        <?php if ($this->rbac->has_permission('RBAC_MODULE')): ?>
                            <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_modules"><i class="fa fa-circle-o text-aqua"></i> Modules</a></li>
                        <?php endif; ?>
                        <?php if ($this->rbac->has_permission('RBAC_PERMISSION')): ?>
                            <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_permissions"><i class="fa fa-circle-o text-aqua"></i> Permissions</a></li>
                        <?php endif; ?>
                        <?php if ($this->rbac->has_permission('RBAC_ROLE')): ?>
                            <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_roles"><i class="fa fa-circle-o text-aqua"></i> Roles</a></li>
                        <?php endif; ?>
                        <?php if ($this->rbac->has_permission('RBAC_ROLE_PERMISSION')): ?>
                            <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_role_permissions"><i class="fa fa-circle-o text-aqua"></i> Assign Permissions</a></li>                    
                        <?php endif; ?>
                        <?php if ($this->rbac->has_permission('RBAC_USER')): ?>
                            <li class="active"><a href="<?= APP_BASE ?>rbac/rbac_users"><i class="fa fa-circle-o text-aqua"></i> Users</a></li>   
                        <?php endif; ?>
                    </ul>
                </li>
                <?php if ($this->rbac->is_admin()): ?>
                    <li class="active treeview">
                        <a href="<?= APP_BASE ?>cruds">
                            <i class="fa fa-gears"></i> <span>CRUD</span>
                        </a>
                         <ul class="treeview-menu">
                            <li class="active"><a href="<?= APP_BASE ?>admin/file_upload"><i class="fa fa-circle-o text-aqua text-aqua"></i> Upload</a></li>
                         </ul>
                    </li>                

                <?php endif; ?>
            </ul>
        <?php endif;?>        
    </section>
    <!-- /.sidebar -->
</aside>