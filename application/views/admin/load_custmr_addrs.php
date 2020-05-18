<h3>Addresses</h3>
<?php
foreach($result as $row_addrss){
?>
<div class="multi_address_dv_inn">
    <strong><?=$row_addrss->full_name; ?></strong><br>
    <span><?=$row_addrss->address; ?></span><br>
    <span><?=$row_addrss->city.'-'.$row_addrss->pin_code; ?></span>,
    <span><?=$row_addrss->state_name.','.$row_addrss->country; ?></span><br>
    <span>Ph : <?=$row_addrss->phone; ?></span><br><br>
</div>
<?php } ?>

<style>
.multi_address_dv_inn {
  border-bottom: 1px dashed #ccc;
  margin-bottom: 10px;
  margin-left: 20px;
  width: 35%;
}
</style>