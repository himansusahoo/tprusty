<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
<div class="vertical-alignment-helper">
			  <div class="modal-dialog vertical-align-center">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  </div>
				  <div class="modal-body">
					<div class="banner2 col-md-6">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
							<li data-target="#carousel-example-generic" data-slide-to="3"></li>
							<li data-target="#carousel-example-generic" data-slide-to="4"></li>
						  </ol>
							<div class="carousel-inner" role="listbox">
<?php
	$image_arr = explode(',', $rw->imag); 
?>
								<div class="item active">							
									<img  src="<?php echo base_url().'images/product_img/'.$image_arr[0]; ?>" class="" width="450" height="450" alt=""/>
								</div>
								<div class="item">
									<img  src="<?php echo base_url().'images/product_img/'.$image_arr[1]; ?>" class="" width="450" height="450" alt=""/>
								</div>
							</div>
						</div> <div class="clearfix"></div>
						<!-- Controls -->
						  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
					</div>
                    
					<div class="col-md-6">
						<div class="light-box-product-details">
							<h2 class="single_prdct_title"><?=$rw->name?></h2>
							
							<!--- price calculation div start here --->
							<div class="price-box">
							<!---Special price exists condition start here --->
							<?php
							if($rw->special_price !=0){
								if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
							?>
							
							<span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
							
							<?php if($rw->price != 0){?>
							<span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
							<?php }?>
							
							<span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
							<!---Special price exists condition end here --->
							<?php }else{ ?>
							
							<?php if($rw->price != 0){?>
							<span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
							<span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
							<?php }else{?>
							<span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
							<?php }?>
							
							<?php } //End of date condition ?>
							
							<?php }else{ ?>
							
							<?php if($rw->price != 0){?>
							<span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
							<span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
							<?php }else{?>
							<span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
							<?php }?>
							
							<?php } ?>
							</div>
							<!--- price calculation div end here --->
							<!--<button type="button" title="Add to Cart" onClick="window.location.href='<?//php echo base_url().'product_description/addtocart/'.str_replace(" ","-",strtolower($rw->name)).'/'.$rw->product_id.'/'.$rw->sku; ?>' " class="btn btn-primary" >Add to Cart</button>--> 
							<div>
								<ul>
									<?php if($rw->short_desc){
										$data = $rw->short_desc;
										$description = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $data);
									$short_desc = unserialize($description);
										foreach($short_desc as $value){
										?>
											<li><?=$value?></li>
										<?php
										}
									}
									?>
								</ul>
							</div>
							
						</div>
					</div>
                    
					<div class="clearfix"></div>
				  </div>
				</div>
			  </div>
			</div>
            </div>