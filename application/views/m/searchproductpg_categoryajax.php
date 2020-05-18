

                            <?php
							$sl=0;
							
					if($product_data->num_rows() > 0){
					  foreach($catg_ids->result() as $cat_row){
						  $fltr_cat_id[] = $cat_row->category_id;
					  }
					  $uniq_arr = array_unique($fltr_cat_id);
					 
					  if(!empty($uniq_arr)){
							foreach($uniq_arr as $val){
							
							$sql = $this->db->query("SELECT * FROM category_menu_mobile WHERE (category_id='$val' OR category_id LIKE '%$val,%' OR category_id LIKE ',%$val,%' OR category_id LIKE ',%$val%') AND order_by!=0 AND is_active='Yes'");
							//$sql = $this->db->query("SELECT distinct lvl1,lvl1_name FROM view_catinfo WHERE lvl2='$val'");
							foreach($sql->result() as $cat_name_rw){
							$sl++;
							?>								                               
                                <li onClick="redirectCategoryPage('<?=$cat_name_rw->url_displayname; ?>')" style="cursor:pointer;;" >
								<a href="#"><?php echo stripslashes($cat_name_rw->label_name); ?></a>
                                </li>
                                <?php } } }}?>
                               