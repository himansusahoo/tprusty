<ul class="dashboard-menu">
	<a href="<?php echo base_url(); ?>admin/Page_setup"><li <?php if($this->uri->segment(2)=='Page_setup'){ echo 'class="selected"';} ?>>Mobile Home Page Setup </li></a>
    <a href="<?php echo base_url(); ?>admin/Page_category"><li <?php if($this->uri->segment(2)=='Page_category'){ echo 'class="selected"';}?>>Mobile Category Page Setup </li></a>
    <a href="<?php echo base_url(); ?>admin/Page_catlog"><li <?php if($this->uri->segment(2)=='Page_catlog'){ echo 'class="selected"';}?>>Mobile Catlog Page Setup </li></a>
    <a href="<?php echo base_url(); ?>admin/Page_single_product"><li <?php if($this->uri->segment(2)=='Page_single_product'){ echo 'class="selected"';}?>>Mobile Single Product Page Setup </li></a>
	<a href="<?php echo base_url(); ?>admin/Page_search"><li <?php if($this->uri->segment(2)=='Page_search'){ echo 'class="selected"';}?>>Mobile Search Page Setup </li></a>
</ul>


 