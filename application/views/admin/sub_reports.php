<ul class="top-menu">

    <?php
    if ($this->rbac->has_role('ADMIN')) {
        $menus = $this->rbac->temp_sub_menus('admin_reports');
        foreach ($menus as $uri => $menu) {
            ?>
            <li class="<?= ($this->uri->segment(1) == $uri) ? "selected" : '' ?>">
                <a href="<?php echo base_url($uri); ?>"><?= $menu ?></a>
            </li>
            <?php
        }
    } else {
        $user_role_id = $this->session->userdata('logged_userrole_id');
        $main_query = $this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Reports' ");
        $row = $main_query->row();
        $main_tab_id = $row->main_tab_id;

        $sub_query = $this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
        foreach ($sub_query->result() as $rs) {
            ?>
            <li>
                <?php if ($rs->sub_tab_name == 'order_report') { ?>
                    <a href="<?php echo base_url(); ?>admin/report">Order Report</a>
                <?php } ?>
                <?php if ($rs->sub_tab_name == 'return_order_report') { ?>
                    <a href="<?php echo base_url(); ?>admin/report/return_order_report">Return Order Report</a>
                <?php } ?>
            </li>
            <?php
        }
    }
    ?> 

</ul>