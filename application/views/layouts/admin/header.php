<?php ?>
<header class="main-header">
    <!-- Logo -->
    <span class="logo no-pad">                 
        <a href="<?= $this->rbac->get_admin_dashboard_url()?>" class="logo no-pad" title="<?=$this->layout->title?>">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>D</b>B</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Dashboard</b></span>
        </a>        
    </span>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">

        <div class="navbar-header">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>  
<!--            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="true">
                <i class="fa fa-bars"></i>
            </button>-->
        </div>
        
        <div class="navbar-collapse pull-left collapse" id="navbar-collapse" aria-expanded="true" >
<!--            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>           -->
        </div>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">            
                <?php
                if ($this->rbac->is_login()):
                    $user_profile_pic = $this->rbac->get_profile_pic();
                    ?>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown">
                            <img src="<?= base_url() . $user_profile_pic ?>" class="user-image" alt=""> 
                            <span class="hidden-xs"><?= $this->rbac->get_user_email() ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <img src="<?= base_url() . $user_profile_pic ?>" class="img-circle" alt="">                            
                                <p>      
                                    <?= $this->rbac->get_user_name() ?>
                                    <small></small>
                                </p>
                            </li>
                            <!-- Menu Body -->                        
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= base_url('my-profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= base_url('employee-logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
                </li>
            </ul>
        </div>
    </nav>   

</header>