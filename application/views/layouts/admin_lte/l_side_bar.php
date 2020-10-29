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
            <?php echo ($this->rbac->show_user_menu_top()) ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>    