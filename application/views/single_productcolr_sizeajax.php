<?php 
		$query_curclolr=$this->db->query("SELECT color, size,lvl2,Capacity,RAM,ROM,seller_status,product_id FROM cornjob_productsearch WHERE sku='$data_sku' group by sku ");
		
		$curnt_color=$query_curclolr->row()->color;
		$curnt_size=$query_curclolr->row()->size;
		$cur_capacity=$query_curclolr->row()->Capacity;
		$cur_ram=$query_curclolr->row()->RAM;
		$cur_rom=$query_curclolr->row()->ROM;					
		$cur_lvl2=$query_curclolr->row()->lvl2;
		
		if($curnt_color!=''){
			$cur_productid=$query_curclolr->row()->product_id;
			
			$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND size='$curnt_size' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
			if($query_extngskugrp->num_rows()<=1)
			{
				$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by color ");
			}
			$rw_extngskugrp=$query_extngskugrp->result_array();
	?>
	<div class="row">
  	<div class="col-lg-12">
    <?php if(count($rw_extngskugrp)>0){ ?>
    <span style="display:inline-block; float:left; margin-right:20px; margin-top:6px;"><strong>Color:</strong></span>
		<?php } ?>
    	<ul class="color-checkbox-ul" style="min-height: 40px; margin-top: 0; margin-bottom: 0;">
			<?php 
			foreach($rw_extngskugrp as $res_extngsku)
				{
					$sku_ext=$res_extngsku['sku'];
					$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
					$rw_extngsku=$query_extngsku->result();
					$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name))))); 
					if($rw_extngsku[0]->color!='')
						{
			?>
			<li class="color-checkbox-ul-list">
				<?php
					if($rw_extngsku[0]->color==$curnt_color)
						{
							$sku_select=$data_sku;
						}
					else
						{
							$sku_select=$rw_extngsku[0]->sku;
						}
				?>
				<input type="checkbox" value="<?php echo $rw_extngsku[0]->color; ?>" name="attr_colr" id='attr_colr' <?php if($curnt_color==$rw_extngsku[0]->color){echo "checked='checked'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" />
				<label onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" for="checkboxInput" class='<?php if($rw_extngsku[0]->quantity=0 || $rw_extngsku[0]->quantity=='' || ($curnt_size!=$rw_extngsku[0]->size && $curnt_color!=$rw_extngsku[0]->color) ){echo "not-available";} ?> <?php if($rw_extngsku[0]->color=='Multicolor'){ echo "multicolor";}?>' style="width:30px; height:30px; background:<?php if($rw_extngsku[0]->color!='Multicolor'){ echo $rw_extngsku[0]->color;}?>;"  title="<?=$rw_extngsku[0]->color;?>"></label>
			</li>
			<?php } }?>
		</ul>
    </div>
	</div>
	<?php }?>
	<div style="clear:both;"></div>
  <?php 
	if($curnt_size!=''){
		$cur_productid=$query_curclolr->row()->product_id;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND color='$curnt_color' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");
		if($query_extngsku->num_rows()<=1)
			{
				$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by size ");
			}
			$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
  <?php if(count($rw_extngskugrp)>0){ ?>
    <span class="single-product-size"><strong>Size:</strong></span>
    <?php } ?>
		<ul class="single-product-size-ul">
			<?php
				foreach($rw_extngsku as $res_extngsku)
				{
					$sku_ext=$res_extngsku['sku'];
					$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
					$rw_extngsku=$query_extngsku->result();
					$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
					if($rw_extngsku[0]->size!='')
				{
			?>
        	<li class="single-product-size-ul-li">
				<?php
					if($rw_extngsku[0]->size==$curnt_size)
						{
							$sku_select=$data_sku;
						}
					else
						{
							$sku_select=$rw_extngsku[0]->sku;
						}
				?>
                
                <?php if($rw_extngsku[0]->quantity=0 || $rw_extngsku[0]->quantity=='' || ($curnt_color!=$rw_extngsku[0]->color && $curnt_size!=$rw_extngsku[0]->size) ){  ?>
                <a <?php if($rw_extngsku[0]->size==$curnt_size){echo " class='disabl'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" style="cursor: pointer;"><?php echo $rw_extngsku[0]->size; ?></a>
            <?php }else{ ?>    
                
            	<a <?php if($rw_extngsku[0]->size==$curnt_size){echo " class='size-active'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$sku_select; ?>'" style="cursor: pointer; <?php if($rw_extngsku[0]->size==$curnt_size){echo " background-color:#0C3;";} ?>"><?php echo $rw_extngsku[0]->size; ?></a>
                
                <?php } ?>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
	<?php 
	if($cur_capacity!=''){
		$cur_productid=$query_curclolr->row()->product_id;;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by Capacity ");
		$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
    <span class="single-product-size"><strong>Capacity:</strong></span>
		<ul class="single-product-size-ul">
			<?php
				foreach($rw_extngsku as $res_extngsku)
					{
						$sku_ext=$res_extngsku['sku'];
						$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
						$rw_extngsku=$query_extngsku->result();
						$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name))))); 
					if($rw_extngsku[0]->Capacity!='')
						{
			?>
        	<li class="single-product-size-ul-li">
				<?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?>  
				
                <a <?php {echo " class='disabl'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;"><?=$rw_extngsku[0]->Capacity;?></a>
                
				<?php }else{ ?>
            	<a <?php if($rw_extngsku[0]->Capacity==$cur_capacity) {echo " class='size-active'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;<?php if($rw_extngsku[0]->Capacity==$cur_capacity) {echo " background-color:#0C3;";} ?> "><?=$rw_extngsku[0]->Capacity;?></a>
                <?php } ?>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
  
	<?php 
	if($cur_ram!=''){
		$cur_productid=$query_curclolr->row()->product_id;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by RAM ");
		
		$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
    <span class="single-product-size"><strong>RAM:</strong></span>
		<ul class="single-product-size-ul">
			<?php
				foreach($rw_extngsku as $res_extngsku)
					{
						$sku_ext=$res_extngsku['sku'];
						$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
						$rw_extngsku=$query_extngsku->result();
						$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
					if($rw_extngsku[0]->RAM!='')
						{
			?>
        	<li class="single-product-size-ul-li">
				<?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?>
				<a <?php echo " class='disabl'"; ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;"><?=$rw_extngsku[0]->RAM;?></a>
				<?php }else{ ?> 
            	<a <?php if($rw_extngsku[0]->RAM==$cur_ram){echo " class='size-active'";} ?>  onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer; <?php if($rw_extngsku[0]->RAM==$cur_ram){echo " background-color:#0C3;";} ?>"><?=$rw_extngsku[0]->RAM;?></a>
                
                <?php } ?>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
  
  <?php 
	if($cur_rom!=''){
		$cur_productid=$query_curclolr->row()->product_id;
		$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by ROM ");
		$rw_extngsku=$query_extngsku->result_array();
	?>
  <div class="row">
  <div class="col-lg-12">
    <span class="single-product-size"><strong>ROM:</strong></span>
		<ul class="single-product-size-ul">
			<?php
			foreach($rw_extngsku as $res_extngsku)
				{
					$sku_ext=$res_extngsku['sku'];
					$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' AND prod_status='Active' AND status='Enabled' AND seller_status='Active' group by sku ");
					$rw_extngsku=$query_extngsku->result();
					$prod_nm=preg_replace('#\'#',"-",preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name)))));
				if($rw_extngsku[0]->ROM!='')
				{
			?>
        	<li class="single-product-size-ul-li">
				<?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?>
				
                <a <?php echo " class='disabl'"; ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;"><?=$rw_extngsku[0]->ROM;?></a>
                
				<?php }else{ ?> 
            	<a <?php if($rw_extngsku[0]->ROM==$cur_rom){echo " class='size-active'";} ?> onClick="window.location.href='<?php echo base_url().$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" style="cursor: pointer;<?php if($rw_extngsku[0]->ROM==$cur_rom){echo " background-color:#0C3;";} ?>"><?=$rw_extngsku[0]->ROM;?></a>
                
                <?php } ?>
            </li>
			<?php				
					}	
				}
			?>
        </ul>
    </div>
  </div>
  <?php } ?>
  