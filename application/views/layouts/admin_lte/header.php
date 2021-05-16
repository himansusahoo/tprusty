<nav class="main-header navbar navbar-expand navbar-white navbar-light">               
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>        
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">      
        <?php
        if ($this->rbac->is_login()):
            $user_profile_pic = $this->rbac->get_profile_pic();
            ?>

            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url($user_profile_pic) ?>" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline"><?= $this->rbac->get_user_name() ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="<?= base_url($user_profile_pic) ?>" class="img-circle elevation-2" alt="User Image">
                        <p><?= $this->rbac->get_user_email() ?></p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="<?= base_url('my-profile') ?>" class="btn btn-default btn-flat">Profile</a>
                        <a href="<?= $this->rbac->get_admin_logout_url() ?>" class="btn btn-default btn-flat float-right">Sign out</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>