<?php include "header.php"; ?>
<style>
.jspHorizontalBar {
    display: none;
}
.jspTrack {
    display: none;
}

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
.row1 {
    height: 175px;
	
}
.trend-state {
    height: 45px;
    padding: 13px 0;
    text-align: center;
	background:#e3e3e3;
    -webkit-transition: all .3s ease-out;
    -moz-transition: all .3s ease-out;
    -ms-transition: all .3s ease-out;
    -o-transition: all .3s ease-out;
    transition: all .3s ease-out;
}
.trend-state .heading {
    padding: 0;
    margin-bottom: 5px;
    font-size: 14px;
    
    color: #333;
    text-overflow: ellipsis;
    -webkit-line-clamp: 1;
    overflow: hidden;
    -webkit-box-orient: vertical;
    max-height: 15px;
    white-space: nowrap;
    width: 80%;
    margin: 0 auto 10px;
    height: 21px;
	font-weight:bold;
}
.trend-state .item-count {
    font-size: 14px;
    color: #999;
}
.catagory-row{
	margin-top:10px; 
	margin-bottom:20px;
}
.catagory-col{
	width:100%;
	margin:auto;
	border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 1px 35px 0 rgba(0,0,0,0.1);
    background: #fff;
    -webkit-transition: all .3s ease-out;
    -moz-transition: all .3s ease-out;
    -ms-transition: all .3s ease-out;
    -o-transition: all .3s ease-out;
    transition: all .3s ease-out;	
}
.catagory-col-img-held{
	width:100%;
	 margin:auto; 
	 text-align:center;
	 height: 240px;
	     padding: 7px 0px;
	 /*background:linear-gradient(to left, #3a6186 , #89253e);*/
}
.catagory-col-img-held img{
	width: auto; 
	height: auto;  
	max-height: 100%; 
	max-width: 100%; 
	margin: auto;
}
.content_box {
    position: relative;
    box-shadow: 0 1px 35px 0 rgba(0,0,0,0.1);
    border-radius: 5px;
}
.product-catgry-name {
    font-size: 17px;
    margin: 0px;
    line-height: inherit;
    /* height: 50px; */
    padding: 10px 0;
    text-align: center;
    border-radius: 0 0 5px 5px;
    color: #333;
    font-weight: bold;
}
.view-fifth {
    margin: auto;
}
.grid1_of_4 {
   width: 23%;
   margin: 1%
}
.catagory-row {
    margin-top: 0px;
    margin-bottom: 0px;
}
</style>
<div style="clear:both;"></div> 
<!----------------------------------------Body Section start------------------------------------------------------> 
<div class="container" style="width: 100%; margin-top: 58px; padding: 0; background:#f3f3f3; padding:5px;">
	<div style="clear:both;"></div>
	<div class="row" style="margin-top:10px;">
		<!-------------------------------------------- 1st Section Start ------------------------------------------>
		<!--<div class="col-md-3 filter" style="width:250px; padding-right: 0;">
			<div class="f_sidebar" style="position: relative; background: #fff;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); ">
				<section class="filter-form">
				<h4>Categories</h4>
					<div class="row1" >
						<div class="col col-4">
							
							<?php /*?><?php
								$sl=0;
								foreach($brand_name->result() as $res){ 
								$sl++;
							?><?php */?>
							<label class="radio"><input type="radio" name="radio" onClick="window.location.href='<?php echo base_url().$res->url_displayname ?>'">
								<i></i><?php /*?><?php echo $res->label_name; ?><?php */?>
							</label>
							<?php /*?><?php }?><?php */?>
							
						</div>
					</div>
				</section>
			</div>
		</div>-->
		<!-------------------------------------------- 1st Section End ------------------------------------------>
		<div class="col-md-9" style="width:100%; background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);float:right;">
		
			<!-------------------------------------------- 2nd Section Start ------------------------------------------>
			<?php if($product_image!=""){ ?>
            <div class="row catagory-row">
            	<?php  
					foreach($product_image->result() as $rw ) {
						$dsply_img = $rw->imag;
						$catgIdmenu=$rw->category_id;
						$qr_dispurl=$this->db->query("SELECT distinct url_displayname FROM category_menu_desktop 
							WHERE (category_id='$catgIdmenu' OR category_id LIKE '$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu' ) ");
						$url_disp=$qr_dispurl->row()->url_displayname;
				?>
                <div class="grid1_of_4">
                    <div class="content_box">
                    
                        <div class="view view-fifth">
                            <a href="<?php echo base_url().$url_disp; ?>">
							<?php if(empty($dsply_img)){?>
                            <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="">
							<?php } else {?>
							<img src="<?php echo base_url();?>images/product_img/<?=$rw->imag;?>" alt="">
						<?php } ?></a>  
                       </div>	
							<a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rw->category_name)))))  ?> ">
                    <h1 class="btn-bg product-catgry-name"> <?=$rw->category_name; ?></h1>
                    </a>
                 </div>
                 
			</div>
                
				<?php /*?><div class="col-lg-3" style="margin:0px 0px 20px 0">
                    <div class="catagory-col">
						<a href="<?php echo base_url().$url_disp; ?>">
						
                        <div class="catagory-col-img-held">
						<?php if(empty($dsply_img)){?>
                            <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="">
							<?php } else {?>
							<img src="<?php echo base_url();?>images/product_img/<?=str_replace('catalog_','',$rw->imag);?>" alt="">
						<?php } ?>
                        </div>
						
                        <div class="trend-state">
							<a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rw->category_name)))))  ?> ">
                            <h5 class="heading"><?=$rw->category_name; ?></h5>
                            <span class="item-count"></span>
							</a>
                        </div>
						</a>
                    </div>
					
                </div><?php */?>
				<?php } ?>
            </div>
			<?php } ?>
			<!-------------------------------------------- 2nd Section End -------------------------------------------->
			
			<!-------------------------------------------- 2nd Section End -------------------------------------------->
			<?php
				$query = $this->db->query("SELECT catg_description FROM category_master WHERE category_id='$cat_id' ");
			?>
			<div class="row">
            	<div class="col-lg-12" style="width:98%;" >
			<?php if($query->num_rows()>0) { ?>
				<div  style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;">
					<?php echo  stripslashes($query->row()->catg_description); ?>
				</div>
                </div>
			</div>
				<?php } ?>
			<!-------------------------------------------- 2nd Section End -------------------------------------------->
			
			<?php
			if($sec_info!=false)
			{
				if($sec_info->num_rows()>0)
					{ 
						$cur_dtm=date('y-m-d h:i:s');
						$jsortwo=31;
						$jsor=1;
						$tiny=1;
						$carasolbrabd=41;
						foreach($sec_info->result_array() as $res_secdata)
						{			
			?>
			
			<!-------------------------------------------- 3rd Section Start ------------------------------------------>
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
			<div class="first-thumbnail-banner">
				<div class='row'>
					<div class='col-md-12' style="background:#fff; padding:10px;">
					  <div class="carousel slide media-carousel" id="media-<?php echo $sec_id; ?>">
						<div class="carousel-inner">
						<?php 
							$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' 
										AND clmn_status='active' ORDER BY ordr_by DESC  ");
							if($qr_clmn->num_rows()>0)
								{
								$image_track=array();
								foreach($qr_clmn->result_array() as $res_clmn_four)
									{
										$clmn_sqlid1=$res_clmn_four['clmn_sqlid']; 
										$qr_act_imginfo1=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' 
											AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm')
											OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid");
										$image_all_count=$qr_act_imginfo1->num_rows();						
										$qr_act_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' 
											AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') 
											OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 12 ");
										$image_count=$qr_act_imginfo->num_rows();
						?>
						<div class="item  active">
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
								<?php } //active foreach condition end ?>
							</div>
						</div>
						<?php } // Main if condition end ?>
						<?php 
							foreach($qr_clmn->result_array() as $res_clmn)
								{
									$clmn_sqlid=$res_clmn['clmn_sqlid'];
									$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' 
										AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' 
										OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 12,$image_all_count ");
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
						
						<?php } // Main foreach condition end ?>
						</div>
						<?php if($image_all_count>12){ ?>
						<a data-slide="prev" href="#media-<?php echo $sec_id; ?>" class="left carousel-control">‹</a>
						<a data-slide="next" href="#media-<?php echo $sec_id; ?>" class="right carousel-control">›</a>
						<?php } ?>
					  </div>                          
					</div>
				</div>
			</div>
			<?php } ?>
			<!-------------------------------------------- 3rd Section End ------------------------------------------>
			
			<!-------------------------------------------- 4th Section Start ------------------------------------------>
			<?php 
				if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='1300x400')
					{
			?>
			<?php 
				$sec_id=$res_secdata['Sec_id'];
				$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' 
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
				<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
			</div>
			<div class="banner">
				<div id="myCarousel-<?php echo $sec_id;?>" class="carousel slide" data-ride="carousel">
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
						<?php $j_slide++; }?>
					</div>
					<a class="left carousel-control" href="#myCarousel-<?php echo $sec_id;?>" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
					<a class="right carousel-control" href="#myCarousel-<?php echo $sec_id;?>" data-slide="next"><span class="fa fa-chevron-right"></span></a> 
				</div>
			</div>
				<?php } } ?>
			<?php } ?>
			<!-------------------------------------------- 4th Section End ------------------------------------------>
			
			<!-------------------------------------------- 5th Section End ------------------------------------------>
			<?php 
				if($res_secdata['sec_type']=='Slider'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='3' && $res_secdata['image_size']=='960x515')
					{
			?>
			<div class="row" style="padding:10px 0; background:#fff;">
			<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
				<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
			</div>
			<?php 
				$sec_id=$res_secdata['Sec_id'];
				$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' 
					AND clmn_status='active' ORDER BY ordr_by DESC  ");
				if($qr_clmn->num_rows()>0)
					{   
					   foreach($qr_clmn->result_array() as $res_clmn)
					   {
							$clmn_sqlid=$res_clmn['clmn_sqlid'];
							$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' 
								AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') 
								OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
							$image_count=$qr_imginfo->num_rows();
			?>
			<div class="col-lg-4" style="border-right:5px solid #ccc;">
				<div style="width:98%; margin:auto;">
					<div id="jssor_<?=$jsor?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:350px;overflow:hidden;visibility:hidden;">
						<div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:<?=$res_clmn['bg_color'];?>;">
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
							<?php } //Foreach end?>
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
			</div>
			<?php } ?>			
			<!-------------------------------------------- 5th Section End ------------------------------------------>
			
			<!-------------------------------------------- 6th Section Start ------------------------------------------>
			<?php
				if($res_secdata['sec_type']=='Product'  && $res_secdata['sec_type_data']=='Product' && $res_secdata['nos_column']=='1' )
					{
			?>
			<div class="best-seller">
				<h3 class="title"> <span><?=$res_secdata['sec_lbl']?></span> </h3>
				<div id="slider<?php echo $tiny;?>">
					<a class="buttons prev" href="#">&#60;</a>
					<div class="viewport">
						<?php
							$sec_id=$res_secdata['Sec_id'];                 
							$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
							if($qr_clmn->num_rows()>0)
								{
								foreach($qr_clmn->result_array() as $res_clmn)
									{
										$clmn_sqlid=$res_clmn['clmn_sqlid'];
										$qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' 
											AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') 
											OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
										$image_count=$qr_imginfo->num_rows();
						?>
						<ul class="overview best-selr-prdct">
							<?php 
								foreach($qr_imginfo->result_array() as $res_imgdata){
									$prod_skuarr=unserialize($res_imgdata['sku']);
									$prod_skuarr_modf=array();
									foreach($prod_skuarr as $skuky=>$skuval)
										{
											$prod_skuarr_modf[]="'".$skuval."'";
										}
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
									<a href="#" class="link-wishlist wish_spn"  data-toggle="tooltip" title="Add To Wishlist" data-placement="right" onClick="">
										<i class="fa fa-heart"></i>
									</a>
								</div>
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
							<?php } } ?>
						</ul>
							<?php } ?>
						<?php }  }?>
					</div>
					<a class="buttons next" href="#">&#62;</a>	
				</div>
			</div>
			<?php $tiny++;} ?>
			<!-------------------------------------------- 6th Section End ------------------------------------------>
			
			<!-------------------------------------------- 7th Section End ------------------------------------------>
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
					$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' 
						AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
							<?php } ?>
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
			</div>
			<?php } ?>
			<!-------------------------------------------- 7th Section End ------------------------------------------>
			
			<!-------------------------------------------- 8th Section Start-------------------------------------------------->
			<?php 
				if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='140x100')
					{
			?>
			<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
				<h2 style="float:left; margin-left:15px;">sdgdfgdfh<?=$res_secdata['sec_lbl']?></h2>
			</div>
			<?php 
			$sec_id=$res_secdata['Sec_id'];
			$qr_clmn=$this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
			   if($qr_clmn->num_rows()>0)
			   {
				   foreach($qr_clmn->result_array() as $res_clmn)
				   {
					   $clmn_sqlid=$res_clmn['clmn_sqlid'];
					   $qr_imginfo=$this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
					   $image_count=$qr_imginfo->num_rows();
			?>
			<div style="width:98%; margin:auto; padding:10px;">
				<div id="jssor_<?php echo $carasolbrabd; ?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;visibility:hidden; border:1px solid #ccc;">
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
					<script type="text/javascript">jssor_<?php echo $carasolbrabd; ?>_slider_init();</script> 
			</div>
			<?php  }  }?>
			<?php $carasolbrabd++;} ?>
			<!-------------------------------------------------8th Section End-------------------------------------------------->			
			<?php 
					} 
				}
			?>
			<?php } ?>
			
		</div>
	</div>
    
    <?php /* ?><div style="clear:both;"></div>
		<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
			<h2 style="float:left; margin-left:15px;">Top Brands</h2>
		</div>
	<div style="width:98%; margin:auto; padding:10px;">
		<div id="jssor_6" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;visibility:hidden; border:1px solid #ccc;">
			<!-- Loading Screen -->
			<div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
				<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;">
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/android.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/bitly.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/blogger.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/dnn.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/drupal.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/facebook.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/google.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/ibm.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/ios.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/joomla.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/linkedin.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/mac.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/pinterest.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/samsung.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/twitter.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/windows.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/wordpress.jpg" />
					</div>
					<div>
						<img data-u="image" src="<?php echo base_url();?>img/youtube.jpg" />
					</div>
					<a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
				</div>
			</div>
		<script type="text/javascript">jssor_6_slider_init();</script> 
	</div><?php */ ?>
</div>
<div class="container-fluid">
      <div class="row" style="width:100%; padding:0; margin:auto;">
        <div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
			<h2 style="float:left; margin-left:15px;">Know Moonboy a little more</h2>
        </div>
      </div>
      <div class="col-lg-12" style="background:#f5f5f5; padding:10px;">
		<?php 
		$qr=$this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='2' AND page_name='category' AND Status='active' AND sec_type='Rich Text Editor' ");
		 
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

<?php include "footer.php"; ?>
