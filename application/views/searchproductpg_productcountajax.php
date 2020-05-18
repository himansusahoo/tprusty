<div style="font-weight:bold; font-size:16px; float:left">

<?php if($this->session->userdata('sugstword')){ ?>
Showing Results For:&nbsp;<span style="color:#390;"><?=str_replace("%20"," ",$this->session->userdata('sugstword'));?></span>,
&nbsp;Search Instead For: &nbsp;<span style="color:#F90;"><?=str_replace("%20"," ",$this->input->post('search_data'));?></span>.
<?php }else{ ?>
Showing Results For:<span style="color:#390;"> <?=str_replace("%20"," ",$this->input->post('search_data'));?></span>
<?php }  ?>
</div>

Total <?=$no_of_product;?> products 