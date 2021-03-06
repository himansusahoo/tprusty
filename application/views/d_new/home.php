<?php 
include "header.php";
?>
<style>
    .thumbnail {
    margin-bottom: 0;
    text-align: center;
}
.product-title{
	font-size: 15px;
    font-weight: bold;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
	text-align: center;
	font-family: Roboto, Arial, sans-serif;
    letter-spacing: 0;
}
.price{
	font-size:15px!important;
}
.carousel-control {
    padding-top: 13%;
    width: 1%;
}
.col-md-1{ height:100px;}
    </style>
<div style="clear:both;"></div> 
<!----------------------------------------Body Section start------------------------------------------------------> 
 <div class="container" style="width: 100%; margin-top: 58px; padding: 0;">
 <?php
 	if($sec_info->num_rows()>0)
	{ $cur_dtm=date('y-m-d h:i:s');
	$jsortwo=31;
	$jsor=1;
	foreach($sec_info->result_array() as $res_secdata)
	{
?>
	<!-------------------------------------------------Section 1st Condition Start-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='150x150')
			{
				$sec_id=$res_secdata['Sec_id'];
	?>
	<script>
    	$(document).ready(function() {
		  $('#media-<?php echo $sec_id; ?>').carousel({
			pause: true,
			interval: false,
		  });
		});
    </script>
	<div class="first-thumbnail-banner" style="background-color: <?=$res_secdata['bg_color'];?>">
	<div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide media-carousel" id="media-<?php echo $sec_id; ?>" >
        <div class="carousel-inner">
        <?php 
			
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' 
										AND clmn_status='active' ORDER BY ordr_by DESC  ");
			 if($qr_clmn->num_rows()>0)
                   {
						$image_track=array();
                       foreach($qr_clmn->result_array() as $res_clmn_four)
                       {
                           $clmn_sqlid1=$res_clmn_four['clmn_sqlid']; 
                           $qr_act_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid");
						   $image_all_count=$qr_act_imginfo1->num_rows();
						   // print_r($image_all_count);exit;
                           $qr_act_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 12 ");
                         	$image_count=$qr_act_imginfo->num_rows();
			?>
          <div class="item active">
            <div class="row">
				<?php
					foreach($qr_act_imginfo->result_array() as $res_imgdata_active){
				?>
				<?php if($res_imgdata_active['sku']!=''){ ?>
                  <div class="col-md-1">
                    <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" 
                      	onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata_active['img_sqlid'] ?>'"  alt="Image" />
						<?=stripslashes($res_imgdata_active['imag_label'])?>
                    </a>
                  </div>
                  <?php } ?>
                  <?php if($res_imgdata_active['URL']!=''){ ?>
				  <div class="col-md-1">
					<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
						<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" 
                        onClick="window.location.href='<?php echo $res_imgdata_active['URL']; ?>'"  alt="Image"/>
						<?=stripslashes($res_imgdata_active['imag_label'])?>
					</a>
				  </div>				 
				<?php } ?>
                <?php if($res_imgdata_active['URL']=='' && $res_imgdata_active['sku']==''){ ?>
                <div class="col-md-1">
                	<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata_active['imge_nm'];?>" alt="Image">
						<?=stripslashes($res_imgdata_active['imag_label'])?>
                    </a>
                </div>	
                <?php } ?>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <?php 
		  	foreach($qr_clmn->result_array() as $res_clmn)
				{
					$clmn_sqlid=$res_clmn['clmn_sqlid'];
					$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' 
						AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 12,$image_all_count ");
				 $image_count=$qr_imginfo->num_rows();
				 $row=$qr_imginfo->result_array();				 
				 foreach(array_chunk($row,12) as $rw){
		  ?> 
          <div class="item">
            <div class="row">
            <?php 
				foreach($rw as $res_imgdata){
			?>
            	<?php if($res_imgdata['sku']!=''){ ?>
                  <div class="col-md-1">
                    <a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
                      	onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'"  alt="Image" />
						<?=stripslashes($res_imgdata['imag_label'])?>
                    </a>
                  </div>
                  <?php } ?>
                  <?php if($res_imgdata['URL']!=''){ ?>
				  <div class="col-md-1">
					<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
						<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" 
                        onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"  alt="Image"/>
						<?=stripslashes($res_imgdata['imag_label'])?>
					</a>
				  </div>				 
				<?php } ?>
                <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                <div class="col-md-1">
                	<a class="thumbnail" style="background-color: <?=$res_secdata['bg_color'];?>;">
                    	<img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" alt="Image">
						<?=stripslashes($res_imgdata['imag_label'])?>
                    </a>
                </div>	
                <?php } ?>
            <?php } ?>
            </div>
          </div>
          <?php } } ?>
          <?php } ?>
        </div>
        <?php if($image_all_count>12){ ?>
        <a data-slide="prev" href="#media-<?php echo $sec_id; ?>" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media-<?php echo $sec_id; ?>" class="right carousel-control">›</a>
        <?php }?>
      </div>                          
    </div>
  </div> 
 </div>
 <?php } ?>
	<!-------------------------------------------------Section 1st Condition Start-------------------------------------------------->
	
	<!-------------------------------------------------Section 2nd Condition Start-------------------------------------------------->
	
	<?php 
	    if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='1300x400')
		 {
	?>
		<?php 
			$sec_id=$res_secdata['Sec_id'];
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' 
								ORDER BY ordr_by DESC ");
                   if($qr_clmn->num_rows()>0)
                   {
					   foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];
                           $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND 
									image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00'
									OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
		
		?>
		<div class="banner">
			<div id="myCarousel-<?php echo $sec_id;?>" class="carousel slide" data-ride="carousel"> 
				<!-- Indicators -->  
			  <ol class="carousel-indicators">
				<?php $i_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>
				<li data-target="#myCarousel-<?php echo $sec_id;?>" data-slide-to="<?=$i_slide?>" <?php if($i_slide=='0'){ ?> class="active" <?php } ?>></li>
				<?php $i_slide++; } ?>
			  </ol>
			  <div class="carousel-inner">
				<?php $j_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>
				
				<?php if($res_imgdata['sku']!=''){ ?>
				<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
					<img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" /> 
				</div>
				<?php } ?>
				
				<?php if($res_imgdata['URL']!=''){ ?>
				<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
					<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
				</div>
				<?php } ?>
				
				<?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?> 
				<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
					<img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
				</div>                                
				<?php } ?>
				
				<?php $j_slide++; } ?>
			  </div>
				<a class="left carousel-control" href="#myCarousel-<?php echo $sec_id;?>" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
				<a class="right carousel-control" href="#myCarousel-<?php echo $sec_id;?>" data-slide="next"><span class="fa fa-chevron-right"></span></a> 
			</div>
		</div>
		<?php } }?>
	<?php } ?>
	<!-------------------------------------------------Section 2nd Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 3rd Condition Start-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='3' && $res_secdata['image_size']=='960x515')
			{
	?>
	<div class="row" style="padding:0;">
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
			<h3 class="title"> <span> <?=$res_secdata['sec_lbl']?> </span> </h3>
		</div>
	<?php 
	   $sec_id=$res_secdata['Sec_id'];                 
		$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
		   if($qr_clmn->num_rows()>0)
		   {   
			   foreach($qr_clmn->result_array() as $res_clmn)
			   {
				   $clmn_sqlid=$res_clmn['clmn_sqlid'];
				   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
				   $image_count=$qr_imginfo->num_rows();
	?>
    <div class="col-lg-4" style="border-right:5px solid #ccc;">
	<div style="width:98%; margin:auto;">
    <div id="jssor_<?=$jsor?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:350px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:<?=$res_clmn['bg_color'];?>">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:350px;overflow:hidden;">
            <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
			
			<?php if($res_imgdata['sku']!=''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']!=''){ ?>
			<div>
				<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
			</div>
			<?php } ?>
			<?php }?>
            <a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
        </div>
        <!-- Bullet Navigator -->
		<?php if($image_count>1){ ?>
        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
		<?php } ?>
        <!-- Arrow Navigator -->
		<?php if($image_count>1){ ?>
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
		<?php } ?>
    </div>
	
    <script type="text/javascript">jssor_<?=$jsor?>_slider_init();</script>
    </div>
	
    </div>
	<?php $jsor++; } } ?>
	<?php } ?>
	</div>
	<!-------------------------------------------------Section 3rd Condition End-------------------------------------------------->

	<!-------------------------------------------------Section 4rd Condition Start-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Product'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
			{
	?>
	<div class="best-seller">
    <h3 class="title"><span><?=$res_secdata['sec_lbl']?></span> </h3>
		<div id="slider1">
        <a class="buttons prev" href="#">&#60;</a>
			<div class="viewport">
				<?php
					$sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
				?>				
				<ul class="overview best-selr-prdct">
				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ 

					$prod_skuarr=unserialize($res_imgdata['sku']);
					$prod_skuarr_modf=array();
					foreach($prod_skuarr as $skuky=>$skuval)
					{$prod_skuarr_modf[]="'".$skuval."'";}
					
					 $prod_skustr=implode(',',$prod_skuarr_modf);
					
					
					$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
					if($query_prod->num_rows()>0)
					{
						foreach($query_prod->result_array() as $rw)
						{
							$cdate = date('Y-m-d');
							$special_price_from_dt = $rw['special_pric_from_dt'];
							$special_price_to_dt = $rw['special_pric_to_dt'];								
							$dsply_img = $rw['catelog_img_url'];														
							//$quantity=$rw->quantity;
				?>
					<li>
						<div class="view view-fifth">
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
							<?php if(empty($dsply_img)) {?>
								<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" width="184" height="154" alt="<?=$rw['name']?>">
							<?php } else {?>
								<img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"  alt="<?=$rw['name']?>">
							<?php }?>
							</a>
						</div>
						<div class="wish-list">
							<a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
							<i class="fa fa-heart"></i></a>
						</div>
						<!--<div class="product-title">T-Shirt</div>-->
						<div class="best-slr-data">      
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="wallet"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a>
							<div class="price-box">
								<?php
									if($rw['special_price'] !=0){
										if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
								?>
								<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
								<?php if($rw['price'] !=0){?>
									<span class="regular-price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
								<?php }?>
									<span class="price"> Rs. <?=$rw['special_price'];?> </span>
								<?php } else { ?>
									<?php if($rw['price'] !=0){ ?>
										<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
										<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
									<?php } else {?>
										<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<?php }?>
								<?php } ?>
								<?php } else { ?>
									<?php if($rw['price'] !=0){?>
										<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
										<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
									<?php }else{?>
											<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<?php }?>
								<?php } ?>
							</div>
						</div>
					</li>
					<?php } }?>
				</ul>
				
				<?php } ?>
				<?php } } ?>
			</div>
			<a class="buttons next" href="#">&#62;</a>	
		</div>
    </div>
	<?php }?>
	<!-------------------------------------------------Section 4rd Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 5th Condition Start-------------------------------------------------->
	<?php
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='2' && $res_secdata['image_size']=='1312x704')
			{
	?>
	
	<div class="row">
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
        </div>
		<?php
		   $sec_id=$res_secdata['Sec_id'];                 
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {   
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
		?>
	<div class="col-lg-6" style="border-right:5px solid #ccc">
    <div style="width:98%; margin:auto;">
    <div id="jssor_<?=$jsortwo?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:500px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:500px;overflow:hidden;">
            <?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
			
			<?php if($res_imgdata['sku']!=''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']!=''){ ?>
			<div>
				<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
			</div>
			<?php } ?>
			<?php }?>
            
            <a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
        </div>
        <!-- Bullet Navigator -->
		<?php if($image_count>1){ ?>
        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
		<?php } ?>
        <!-- Arrow Navigator -->
		<?php if($image_count>1){ ?>
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
		<?php } ?>
    </div>
    <script type="text/javascript">jssor_<?=$jsortwo?>_slider_init();</script>
    </div>    	
    </div>
	<?php $jsortwo++; } } ?>
	<?php }?>
   </div>
	<!-------------------------------------------------Section 5th Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 6th Condition End-------------------------------------------------->
	<?php 
		if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='1300x385')
		 {
	?>
	<?php 
			$sec_id=$res_secdata['Sec_id'];
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' 
								ORDER BY ordr_by DESC ");
                   if($qr_clmn->num_rows()>0)
                   {
					   foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];
                           $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND 
									image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00'
									OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
		
		?>
	<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h3 class="title"><span><?=$res_secdata['sec_lbl']?> </span> </h3>
        </div>
        
	<div id="carousel-example-generic<?php echo $sec_id; ?>" class="carousel slide" data-ride="carousel">
	 <!--Indicators -->
	  <ol class="carousel-indicators">
		<?php $i_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>
		<li data-target="#carousel-example-generic<?php echo $sec_id; ?>" data-slide-to="<?=$i_slide?>" <?php if($i_slide=='0'){ ?> class="active" <?php } ?>></li>
		<?php $i_slide++; } ?>
	  </ol>

	  <!--Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
		<?php $j_slide=0; foreach($qr_imginfo->result_array() as $res_imgdata){  ?>
		<?php if($res_imgdata['sku']!=''){ ?>
		<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
			<a href="#">
				<img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" /> 
			</a>
		</div>
		<?php } ?>
		<?php if($res_imgdata['URL']!=''){ ?>
		<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
			<a href="#">
			<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
			</a>
		</div>
		<?php } ?>
		
		<?php if($res_imgdata['sku']=='' && $res_imgdata['URL']==''){ ?> 
		<div <?php if($j_slide=='0'){ ?>class="item active" <?php }else{ ?> class="item" <?php } ?>>
			<a href="#">
			<img alt="" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"  width="" height="" /> 
			</a>
		</div>
		<?php } ?>
		
		<?php $j_slide++; } ?>
		
	  </div> <!-- Wrapper for slides -->
		<a class="left carousel-control" href="#carousel-example-generic<?php echo $sec_id; ?>" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
		<a class="right carousel-control" href="#carousel-example-generic<?php echo $sec_id; ?>" data-slide="next"><span class="fa fa-chevron-right"></span></a>
	</div>
	<?php } }?>
	<?php } ?>
	<!-------------------------------------------------Section 6th Condition End-------------------------------------------------->
	
		<!-------------------------------------------------Section 7th Condition Start-------------------------------------------------->
	<?php
		if($res_secdata['sec_type']=='New Arrivals'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
			{
	?>
	<div class="best-seller">
    <h3 class="title"><span><?=$res_secdata['sec_lbl']?></span> </h3>
		<div id="slider2">
        <a class="buttons prev" href="#">&#60;</a>
			<div class="viewport">
				<?php
					$sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid']; 
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
				?>				
				<ul class="overview best-selr-prdct">
				<?php foreach($qr_imginfo->result_array() as $res_imgdata){ 
                       	
					$prod_skuarr=unserialize($res_imgdata['sku']);
					$prod_skuarr_modf=array();
					foreach($prod_skuarr as $skuky=>$skuval)
					{$prod_skuarr_modf[]="'".$skuval."'";}
					
					 $prod_skustr=implode(',',$prod_skuarr_modf);
					
					
					/*$query_prod=$this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");*/
					
					$query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY name ORDER BY `prod_search_sqlid` DESC LIMIT 10  ");
					if($query_prod->num_rows()>0)
					{
						foreach($query_prod->result_array() as $rw)
						{
							$cdate = date('Y-m-d');
							$special_price_from_dt = $rw['special_pric_from_dt'];
							$special_price_to_dt = $rw['special_pric_to_dt'];								
							$dsply_img = $rw['catelog_img_url'];														
							//$quantity=$rw->quantity;
				?>
					<li>
						<div class="view view-fifth">
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
							<?php if(empty($dsply_img)) {?>
								<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" width="184" height="154" alt="<?=$rw['name']?>">
							<?php } else {?>
								<img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"  alt="<?=$rw['name']?>">
							<?php }?>
							</a>
						</div>
						<div class="wish-list">
							<a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
							<i class="fa fa-heart"></i></a>
						</div>
						<!--<div class="product-title">T-Shirt</div>-->
						<div class="best-slr-data">      
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="wallet"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a>
							<div class="price-box">
								<?php
									if($rw['special_price'] !=0){
										if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
								?>
								<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
								<?php if($rw['price'] !=0){?>
									<span class="regular-price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
								<?php }?>
									<span class="price"> Rs. <?=$rw['special_price'];?> </span>
								<?php } else { ?>
									<?php if($rw['price'] !=0){ ?>
										<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
										<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
									<?php } else {?>
										<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<?php }?>
								<?php } ?>
								<?php } else { ?>
									<?php if($rw['price'] !=0){?>
										<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
										<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
									<?php }else{?>
											<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<?php }?>
								<?php } ?>
							</div>
						</div>
					</li>
					<?php } }?>
				</ul>
				
				<?php } ?>
				<?php } } ?>
			</div>
			<a class="buttons next" href="#">&#62;</a>	
		</div>
    </div>
	<?php }?>
	<!-------------------------------------------------Section 7th Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 8th Condition Start-------------------------------------------------->
	<?php
		if($res_secdata['sec_type']=='Trending Products'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
			{   
	?>
	<div class="best-seller">
    <h3 class="title"><span><?=$res_secdata['sec_lbl']?></span> </h3>
		<div id="slider3">
        <a class="buttons prev" href="#">&#60;</a>
			<div class="viewport">
				<?php
					$sec_id=$res_secdata['Sec_id'];                 
                  $qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                   if($qr_clmn->num_rows()>0)
                   {
                       foreach($qr_clmn->result_array() as $res_clmn)
                       {
                           $clmn_sqlid=$res_clmn['clmn_sqlid'];
                           
                           $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                           $image_count=$qr_imginfo->num_rows();
				?>				
				<ul class="overview best-selr-prdct">
				<?php foreach($qr_imginfo->result_array() as $res_imgdata){
                       	
					$pord_viewqr=$this->db->query("SELECT sku FROM product_viewcount GROUP BY sku ORDER BY prodview_count desc LIMIT 5");
						 $pordviewctr=array();
						 
						 foreach($pord_viewqr->result_array() as $res_prodview)
						 {$pordviewctr[]="'".$res_prodview['sku']."'";}
						 $pordviewctr_string=implode(',',$pordviewctr);
						 
						 if($pord_viewqr->num_rows()>0)
						{ $query_prod = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND sku IN ($pordviewctr_string) GROUP BY sku   ");
						}else
						{
						
						 $query_prod = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY sku ORDER BY cronprod_viewcount desc LIMIT 5  ");
						 
						}
					if($query_prod->num_rows()>0)
					{
						foreach($query_prod->result_array() as $rw)
						{
							$cdate = date('Y-m-d');
							$special_price_from_dt = $rw['special_pric_from_dt'];
							$special_price_to_dt = $rw['special_pric_to_dt'];								
							$dsply_img = $rw['catelog_img_url'];														
							//$quantity=$rw->quantity;
				?>
					<li>
						<div class="view view-fifth">
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" >
							<?php if(empty($dsply_img)) {?>
								<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" width="184" height="154" alt="<?=$rw['name']?>">
							<?php } else {?>
								<img src="<?php echo base_url().'images/product_img/'.$dsply_img?>"  alt="<?=$rw['name']?>">
							<?php }?>
							</a>
						</div>
						<div class="wish-list">
							<a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
							<i class="fa fa-heart"></i></a>
						</div>
						<!--<div class="product-title">T-Shirt</div>-->
						<div class="best-slr-data">      
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>" title="wallet"><?php if(strlen($rw['name']) > 20){ echo substr($rw['name'],0,20).'...';}else{ echo $rw['name'];}?></a>
							<div class="price-box">
								<?php
									if($rw['special_price'] !=0){
										if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
								?>
								<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
								<?php if($rw['price'] !=0){?>
									<span class="regular-price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
								<?php }?>
									<span class="price"> Rs. <?=$rw['special_price'];?> </span>
								<?php } else { ?>
									<?php if($rw['price'] !=0){ ?>
										<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
										<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
									<?php } else {?>
										<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<?php }?>
								<?php } ?>
								<?php } else { ?>
									<?php if($rw['price'] !=0){?>
										<span class="regular-price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
										<span class="price"> Rs. <?=$rw['price'];?> </span> &nbsp;&nbsp;
									<?php }else{?>
											<span class="price"> Rs. <?=$rw['mrp'];?> </span> &nbsp;&nbsp;
									<?php }?>
								<?php } ?>
							</div>
						</div>
					</li>
					<?php } }?>
				</ul>
				
				<?php } ?>
				<?php } } ?>
			</div>
			<a class="buttons next" href="#">&#62;</a>	
		</div>
    </div>
	<?php }?>
	<!-------------------------------------------------Section 8th Condition End-------------------------------------------------->
	
	<!-------------------------------------------------Section 10th Condition End-------------------------------------------------->	
	<?php 
		if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='140x100')
			{
	?>
	<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h2 style="float:left; margin-left:15px;"><?=$res_secdata['sec_lbl']?></h2>
        </div>
		<?php 
		$sec_id=$res_secdata['Sec_id'];
		$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
		   if($qr_clmn->num_rows()>0)
		   {
			   foreach($qr_clmn->result_array() as $res_clmn)
			   {
				   $clmn_sqlid=$res_clmn['clmn_sqlid'];
				   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
				   $image_count=$qr_imginfo->num_rows();
		?>
	<div style="width:98%; margin:auto; padding:10px;">
		<div id="jssor_41" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;visibility:hidden; border:1px solid #ccc;">
			<!-- Loading Screen -->
			<div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
			<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;">
			<?php foreach($qr_imginfo->result_array() as $res_imgdata){ ?>
			
			<?php if($res_imgdata['sku']!=''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']!=''){ ?>
			<div>
				<img onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
			</div>
			<?php } ?>
			<?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
			<div>
				<img data-u="image" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
			</div>
			<?php } ?>
			<?php }?>
			<a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
			</div>
		</div>
			<script type="text/javascript">jssor_41_slider_init();</script> 
	</div>
		<?php  }  }?>
	<?php } ?>
	<!-------------------------------------------------Section 10th Condition End-------------------------------------------------->
    
<?php } } ?>
</div>

<div class="container-fluid">
      <div class="row" style="width:100%; padding:0; margin:auto;">
            <div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h2 style="float:left; margin-left:15px;">Know <?=COMPANY?> a little more</h2>
        </div>
      </div>
       <div class="col-lg-12" style="background:#f5f5f5; padding:10px;">
	  <?php 
		$qr=$this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Status='active' AND sec_type='Rich Text Editor' ");
		 
		if($qr->num_rows()>0)
		{ 
			foreach($qr->result_array() as $res_secdata)
			{		  
		?>
      <h5><strong><?=$res_secdata['sec_lbl']?></strong></h5>
		<p><?=$res_secdata['sec_descrp']?></p> 
		<?php } }?> 
      </div>
  </div>
</div>

<?php include "footer.php" ?>
<script>
function addWishlistFunction(product_id,sku){
	/*var succ_dv = '#wiss_succs'+sl;
	$(succ_dv).show();
	$(succ_dv).text('process...');*/
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist',
		method:'post',
		data:{product_id:product_id,sku:sku},
		success:function(result){
			
			if(result=='success'){
				alert('successfully added');
				window.location.reload(true);
			}
			if(result=='exists'){
				window.location.href='<?php echo base_url(); ?>wish-list';
			}
		}
	});
}


function addWishlistFunction_temp(product_id,sku)
{
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist_temp',
		method:'post',
		data:{product_id:product_id,sku:sku},
		success:function(result){
			
			if(result=='success'){
				alert('successfully added');
				window.location.reload(true);
			}
			if(result=='exists'){
				window.location.href='<?php echo base_url(); ?>wish-list';
			}
		}
	});	
}

</script>