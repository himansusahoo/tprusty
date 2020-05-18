

 <div class="col col-4 scroll-pane">
                  <?php
				  
				  
				  if($catg_ids->num_rows() > 0){
					  foreach($catg_ids->result() as $cat_row){
						  $fltr_cat_id[] = $cat_row->category_id;
						 
					  }
					  $uniq_arr = array_unique($fltr_cat_id);
					  //print_r($uniq_arr);
					  if(!empty($uniq_arr)){
					  	foreach($uniq_arr as $val){
							$sql = $this->db->query("SELECT * FROM category_menu_desktop WHERE (category_id='$val' OR category_id LIKE '%$val,%' OR category_id LIKE ',%$val,%' OR category_id LIKE ',%$val%') AND order_by!=0 AND is_active='Yes' ");
							//$sql = $this->db->query("SELECT distinct lvl1,lvl1_name FROM view_catinfo WHERE lvl2='$val'");
							foreach($sql->result() as $cat_name_rw){
				  ?>
                  		<!--<p><?//=$cat_name_rw->category_name;?></p>-->
                        
                        <label class="radio"><input type="radio" name="radio" onClick="redirectCategoryPage('<?=$cat_name_rw->category_id;?>','<?= $cat_name_rw->url_displayname; ?>')"><i></i><?php echo stripslashes($cat_name_rw->label_name); ?></label>
                        
                  <?php
							}
						}
						} // End of not empty arry condition
				  } // End of if condition
				  ?>
                  </div>