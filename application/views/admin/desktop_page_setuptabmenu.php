<ul class="dashboard-menu">
	<a href="<?php echo base_url(); ?>admin/Desktop_page_setup"><li <?php if($this->uri->segment(2)=='Desktop_page_setup'){ echo 'class="selected"';} ?>>Desktop Home Page Setup </li></a>
    <a href="<?php echo base_url(); ?>admin/Desktop_page_category"><li <?php if($this->uri->segment(2)=='Desktop_page_category'){ echo 'class="selected"';}?>>Desktop Category Page Setup </li></a>
	<a href="<?php echo base_url(); ?>admin/Desktop_page_catlog"><li <?php if($this->uri->segment(2)=='Desktop_page_catlog'){ echo 'class="selected"';}?>>Desktop Catlog Page Setup </li></a>
    <a href="<?php echo base_url(); ?>admin/Desktop_page_single_product"><li <?php if($this->uri->segment(2)=='Desktop_page_single_product'){ echo 'class="selected"';}?>>Desktop Single Product Page Setup </li></a>
	<a href="<?php echo base_url(); ?>admin/Desktop_page_search"><li <?php if($this->uri->segment(2)=='Desktop_page_search'){ echo 'class="selected"';}?>>Desktop Search Page Setup </li></a>
</ul>


 