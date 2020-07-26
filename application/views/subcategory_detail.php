<?php include "header.php"; ?>

<meta name="Description" content="<?php echo $data3->meta_description; ?>">
<meta name="Keywords" content="<?php echo $data3->meta_keywords; ?>"/>

<meta name="author" content="">
<title><?php echo $data3->page_title; ?></title>
<link rel="canonical" href="<?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2); ?>"/>
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

    .col-md-1{ height:100px;}
    #news-container1
    {
        width: 100%; 
        margin: auto;
        background-color: #e95546;
        height: 356px !important;
    }



    #news-container1 ul li{
        height:auto !important;
        border-bottom: 1px dotted #fff;
    }

    #news-container1 ul li a  { 
        width: 100%;
        height: 40px;
        line-height: 25px;
        display: block;
        text-align: center;
        margin: 7px auto;
        font-size: 17px;
        overflow: hidden;
        font-family: 'Microsoft Yahei';
        color: #fff;
    }
    #news-container1 ul li p {
        height: 55px;
        line-height: 18px;
        overflow: hidden;
        font-size: 14px;
        color: #fff;
        padding: 0 5px;
        text-align:center;

    }

    /*****************************news tixker repeat start************************************/


    #news-container2
    {
        width: 100%; 
        margin: auto;
        background-color: #e95546;
        height: 356px !important;
    }



    #news-container2 ul li{
        height:auto !important;
        border-bottom: 1px dotted #fff;
    }

    #news-container2 ul li a  { 
        width: 100%;
        height: 40px;
        line-height: 25px;
        display: block;
        text-align: center;
        margin: 7px auto;
        font-size: 17px;
        overflow: hidden;
        font-family: 'Microsoft Yahei';
        color: #fff;
    }
    #news-container2 ul li p {
        height: 55px;
        line-height: 18px;
        overflow: hidden;
        font-size: 14px;
        color: #fff;
        padding: 0 5px;
        text-align:center;

    }

</style>
<script type="text/javascript" src="<?php echo base_url(); ?>new_js/js/jquery.vticker-min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#news-container1').vTicker({
            speed: 500,
            pause: 3000,
            animation: 'fade',
            mousePause: false,
            showItems: 3
        });
    });

    $(function () {
        $('#news-container2').vTicker({
            speed: 500,
            pause: 3000,
            animation: 'fade',
            mousePause: false,
            showItems: 3
        });
    });

    $(function () {
        $('#news-container3').vTicker({
            speed: 500,
            pause: 3000,
            animation: 'fade',
            mousePause: false,
            showItems: 3
        });
    });
</script>
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
                                                
        <?php /* ?><?php
          $sl=0;
          foreach($brand_name->result() as $res){
          $sl++;
          ?><?php */ ?>
                                                <label class="radio"><input type="radio" name="radio" onClick="window.location.href='<?php echo base_url() . $res->url_displayname ?>'">
                                                        <i></i><?php /* ?><?php echo $res->label_name; ?><?php */ ?>
                                                </label>
        <?php /* ?><?php }?><?php */ ?>
                                                
                                        </div>
                                </div>
                        </section>
                </div>
        </div>-->
        <!-------------------------------------------- 1st Section End --------------------------------------------->
        <div class="col-md-9" style="width:100%; background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);float:right;">

            <!-------------------------------------------- 2nd Section Start ------------------------------------------>
            <?php if ($product_image != "") { ?>
                <div class="row catagory-row">
                    <?php
                    foreach ($product_image->result() as $rw) {
                        $dsply_img = $rw->imag;
                        $catgIdmenu = $rw->category_id;
                        $qr_dispurl = $this->db->query("SELECT distinct url_displayname FROM category_menu_desktop 
							WHERE (category_id='$catgIdmenu' OR category_id LIKE '$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu' ) ");
                        $url_disp = $qr_dispurl->row()->url_displayname;
                        ?>
                        <div class="grid1_of_4">
                            <div class="content_box">

                                <div class="view view-fifth">
                                    <a href="<?php echo base_url() . $url_disp; ?>">
                                        <?php if (empty($dsply_img)) { ?>
                                            <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>images/product_img/<?= $rw->imag; ?>" alt="">
                                        <?php } ?></a>  
                                </div>	
                                <a href="<?php echo base_url() . $url_disp; ?> ">
                                    <h1 class="btn-bg product-catgry-name"> <?= $rw->category_name; ?></h1>
                                </a>
                            </div>
                        </div>

                        <?php /* ?><div class="col-lg-3" style="margin:0px 0px 20px 0">
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

                          </div><?php */ ?>
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
                    <?php if ($query->num_rows() > 0) { ?>
                        <div  style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;">
                            <?php echo stripslashes($query->row()->catg_description); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-------------------------------------------- 2nd Section End -------------------------------------------->

            <?php
            if ($sec_info != false) {
                if ($sec_info->num_rows() > 0) {
                    $cur_dtm = date('y-m-d h:i:s');
                    $jsortwo = 31;
                    $jsor = 1;
                    $tiny = 1;
                    $carasolbrabd = 41;
                    $jsorsingle = 51;
                    $nnews = 1;
                    foreach ($sec_info->result_array() as $res_secdata) {
                        ?>

                        <!------------------------------------------------ 3rd Section Start ----------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '69x69') {
                            $sec_id = $res_secdata['Sec_id'];
                            ?>
                            <script>
                                $(document).ready(function () {
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
                                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' 
										AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn->num_rows() > 0) {
                                                    $image_track = array();
                                                    foreach ($qr_clmn->result_array() as $res_clmn_four) {
                                                        $clmn_sqlid1 = $res_clmn_four['clmn_sqlid'];
                                                        $qr_act_imginfo1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' 
											AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm')
											OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC");
                                                        $image_all_count = $qr_act_imginfo1->num_rows();
                                                        $qr_act_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' 
											AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') 
											OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC LIMIT 12 ");
                                                        $image_count = $qr_act_imginfo->num_rows();
                                                        ?>
                                                        <div class="item  active">
                                                            <div class="row">
                                                                <?php
                                                                foreach ($qr_act_imginfo->result_array() as $res_imgdata_active) {
                                                                    ?>
                                                                    <?php if ($res_imgdata_active['sku'] != '') { ?>
                                                                        <div class="col-md-1">
                                                                            <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>; cursor: pointer;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" 
                                                                                     onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata_active['display_url'] . '/' . $res_imgdata_active['img_sqlid'] ?>'"  alt="Image" />
                                                                                     <?= stripslashes($res_imgdata_active['imag_label']) ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata_active['URL'] != '') { ?>
                                                                        <div class="col-md-1">
                                                                            <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>; cursor: pointer;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" 
                                                                                     onClick="window.location.href = '<?php echo $res_imgdata_active['URL']; ?>'"  alt="Image"/>
                                                                                     <?= stripslashes($res_imgdata_active['imag_label']) ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata_active['URL'] == '' && $res_imgdata_active['sku'] == '') { ?>
                                                                        <div class="col-md-1">
                                                                            <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>; cursor: pointer;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" alt="Image">
                                                                                <?= stripslashes($res_imgdata_active['imag_label']) ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } //active foreach condition end  ?>
                                                            </div>
                                                        </div>
                                                    <?php } // Main if condition end  ?>
                                                    <?php
                                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                                        $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' 
										AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' 
										OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC LIMIT 12,$image_all_count ");
                                                        $image_count = $qr_imginfo->num_rows();
                                                        $row = $qr_imginfo->result_array();
                                                        foreach (array_chunk($row, 12) as $rw) {
                                                            ?>
                                                            <div class="item">
                                                                <div class="row">
                                                                    <?php
                                                                    foreach ($rw as $res_imgdata) {
                                                                        ?>
                                                                        <?php if ($res_imgdata['sku'] != '') { ?>
                                                                            <div class="col-md-1">
                                                                                <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>; cursor: pointer;">
                                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" 
                                                                                         onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'"  alt="Image" />
                                                                                         <?= stripslashes($res_imgdata['imag_label']) ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <?php if ($res_imgdata['URL'] != '') { ?>
                                                                            <div class="col-md-1">
                                                                                <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>; cursor: pointer;">
                                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" 
                                                                                         onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'"  alt="Image"/>
                                                                                         <?= stripslashes($res_imgdata['imag_label']) ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                            <div class="col-md-1">
                                                                                <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>; cursor: pointer;">
                                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" alt="Image">
                                                                                    <?= stripslashes($res_imgdata['imag_label']) ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                <?php } // Main foreach condition end   ?>
                                            </div>
                                            <?php if ($image_all_count > 12) { ?>
                                                <a data-slide="prev" href="#media-<?php echo $sec_id; ?>" class="left carousel-control">‹</a>
                                                <a data-slide="next" href="#media-<?php echo $sec_id; ?>" class="right carousel-control">›</a>
                                            <?php } ?>
                                        </div>                          
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!----------------------------------------------- 3rd Section End ------------------------------------------------------>

                        <!----------------------------------------------- 4th Section Start ---------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Slider' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '1350x365') {
                            ?>
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' 
						ORDER BY ordr_by DESC ");
                            if ($qr_clmn->num_rows() > 0) {
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                    $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND 
											image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00'
											OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?>
                                    <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                    <?php } else { ?>
                                        <div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
                                            <h3 class="title"> <span><?= $res_secdata['sec_lbl'] ?></span> </h3>
                                        </div>
                                    <?php } ?>
                                    <div class="banner">
                                        <div id="myCarousel-<?php echo $sec_id; ?>" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php
                                                $i_slide = 0;
                                                foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                    ?>
                                                    <li data-target="#myCarousel-<?php echo $sec_id; ?>" data-slide-to="<?= $i_slide ?>" <?php if ($i_slide == '0') { ?> class="active" <?php } ?>></li>
                                                    <?php
                                                    $i_slide++;
                                                }
                                                ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php
                                                $j_slide = 0;
                                                foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                    ?>
                                                    <?php if ($res_imgdata['sku'] != '') { ?>
                                                        <div <?php if ($j_slide == '0') { ?>class="item active" <?php } else { ?> class="item" <?php } ?>>
                                                            <img alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;"  width="" height="" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" /> 
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($res_imgdata['URL'] != '') { ?>
                                                        <div <?php if ($j_slide == '0') { ?>class="item active" <?php } else { ?> class="item" <?php } ?>>
                                                            <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" style="cursor: pointer;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  width="" height="" /> 
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($res_imgdata['sku'] == '' && $res_imgdata['URL'] == '') { ?> 
                                                        <div <?php if ($j_slide == '0') { ?>class="item active" <?php } else { ?> class="item" <?php } ?>>
                                                            <img alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;"  width="" height="" /> 
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    $j_slide++;
                                                }
                                                ?>
                                            </div>
                                            <a class="left carousel-control" href="#myCarousel-<?php echo $sec_id; ?>" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
                                            <a class="right carousel-control" href="#myCarousel-<?php echo $sec_id; ?>" data-slide="next"><span class="fa fa-chevron-right"></span></a> 
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>
                        <!---------------------------------------------------- 4th Section End --------------------------------------------------------->

                        <!---------------------------------------------------- 5th Section Start ------------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Slider' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '3' && $res_secdata['image_size'] == '450x261') {
                            ?>
                            <div class="row" style="padding:0; margin-bottom:5px; margin-top:5px;">
                                <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                <?php } else { ?>
                                    <div style="width:100%; margin:auto; text-align:center; color:#000; padding:5px 0;">
                                        <h3 class="title"> <span> <?= $res_secdata['sec_lbl'] ?> </span></h3>
                                    </div>
                                <?php } ?>
                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                        $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?>
                                        <div class="col-lg-4" style="padding-right:0; padding-left:0;">
                                            <div style="width:98%; margin:auto;">
                                                <div id="jssor_<?= $jsor ?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:450px;height:261px;overflow:hidden;visibility:hidden;">
                                                    <!-- Loading Screen -->
                                                    <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:<?= $res_clmn['bg_color']; ?>">
                                                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
                                                    </div>
                                                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:450px;height:261px;overflow:hidden;">
                                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                                                            <?php if ($res_imgdata['sku'] != '') { ?>
                                                                <div>
                                                                    <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" />
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($res_imgdata['URL'] != '') { ?>
                                                                <div>
                                                                    <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" data-u="image" style="cursor: pointer;" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                <div>
                                                                    <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" />
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
                                                    </div>
                                                    <!-- Bullet Navigator -->
                                                    <?php if ($image_count > 1) { ?>
                                                        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                                            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- Arrow Navigator -->
                                                    <?php if ($image_count > 1) { ?>
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

                                                <script type="text/javascript">jssor_<?= $jsor ?>_slider_init();</script>
                                            </div>

                                        </div>
                                        <?php
                                        $jsor++;
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <!-------------------------------------------- 5th Section End -------------------------------------------->

                        <!-------------------------------------------- 6th Section Start ------------------------------------------>
                        <?php
                        if ($res_secdata['sec_type'] == 'Product' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                            ?>
                            <div class="best-seller">
                                <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                <?php } else { ?>
                                    <h3 class="title"> <span><?= $res_secdata['sec_lbl'] ?></span> </h3>
                                <?php } ?>
                                <div id="slider<?php echo $tiny; ?>">
                                    <a class="buttons prev" href="#">&#60;</a>
                                    <div class="viewport">
                                        <?php
                                        $sec_id = $res_secdata['Sec_id'];
                                        $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                        if ($qr_clmn->num_rows() > 0) {
                                            foreach ($qr_clmn->result_array() as $res_clmn) {
                                                $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                                $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' 
											AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') 
											OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                $image_count = $qr_imginfo->num_rows();
                                                ?>
                                                <ul class="overview best-selr-prdct">
                                                    <?php
                                                    foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                        $prod_skuarr = unserialize($res_imgdata['sku']);
                                                        $prod_skuarr_modf = array();
                                                        foreach ($prod_skuarr as $skuky => $skuval) {
                                                            $prod_skuarr_modf[] = "'" . $skuval . "'";
                                                        }
                                                        $prod_skustr = implode(',', $prod_skuarr_modf);
                                                        $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
                                                        if ($query_prod->num_rows() > 0) {
                                                            foreach ($query_prod->result_array() as $rw) {
                                                                $cdate = date('Y-m-d');
                                                                $special_price_from_dt = $rw['special_pric_from_dt'];
                                                                $special_price_to_dt = $rw['special_pric_to_dt'];
                                                                $dsply_img = $rw['catelog_img_url'];
                                                                ?>
                                                                <li>
                                                                    <div class="view view-fifth">
                                                                        <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" style="cursor: pointer;" title="<?= $rw['name'] ?>" >
                                                                            <?php if (empty($dsply_img)) { ?>
                                                                                <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" width="184" height="154" alt="<?= $rw['name'] ?>">
                                                                            <?php } else { ?>
                                                                                <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img ?>"  alt="<?= $rw['name'] ?>">
                                                                            <?php } ?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="wish-list">
                                                                        <a href="#" class="link-wishlist wish_spn"  data-toggle="tooltip" title="Add To Wishlist" data-placement="right" onClick="">
                                                                            <i class="fa fa-heart"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="best-slr-data">
                                                                        <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" title="<?= $rw['name'] ?>"><?php
                                                                            if (strlen($rw['name']) > 20) {
                                                                                echo substr($rw['name'], 0, 20) . '...';
                                                                            } else {
                                                                                echo $rw['name'];
                                                                            }
                                                                            ?></a>

                                                                        <div class="price-box">
                                                                            <?php
                                                                            if ($rw['special_price'] != 0) {
                                                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                                    ?>
                                                                                    <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;&nbsp;
                                                                                    <?php if ($rw['price'] != 0) { ?>
                                                                                        <span class="regular-price"> Rs. <?= $rw['price']; ?> </span> &nbsp;&nbsp;
                                                                                    <?php } ?>
                                                                                    <span class="price"> Rs. <?= $rw['special_price']; ?> </span>
                                                                                <?php } else { ?>
                                                                                    <?php if ($rw['price'] != 0) { ?>
                                                                                        <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;&nbsp;
                                                                                        <span class="price"> Rs. <?= $rw['price']; ?> </span> &nbsp;&nbsp;
                                                                                    <?php } else { ?>
                                                                                        <span class="price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;&nbsp;
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <?php if ($rw['price'] != 0) { ?>
                                                                                    <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;&nbsp;
                                                                                    <span class="price"> Rs. <?= $rw['price']; ?> </span> &nbsp;&nbsp;
                                                                                <?php } else { ?>
                                                                                    <span class="price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;&nbsp;
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </div>   
                                                                    </div>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php } ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <a class="buttons next" href="#">&#62;</a>	
                                </div>
                            </div>
                            <?php
                            $tiny++;
                        }
                        ?>
                        <!-------------------------------------------- 6th Section End ------------------------------------------->
                        <!-------------------------------------------- 7th Section Start------------------------------------------>
                        <?php
                        if ($res_secdata['sec_type'] == 'Slider' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '2' && $res_secdata['image_size'] == '668x296') {
                            ?>
                            <div class="row" style="margin-bottom:5px; margin:auto;">
                                <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                <?php } else { ?>
                                    <div style="width:100%; margin:auto; text-align:center; color:#000; padding:5px 0;">
                                        <h3 class="title"> <span><?= $res_secdata['sec_lbl'] ?></span> </h3>
                                    </div>
                                <?php } ?>
                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' 
						AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                        $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?>
                                        <div class="col-lg-6" style="padding:0; margin:auto;">
                                            <div style="width:99%; margin:auto;">
                                                <div id="jssor_<?= $jsortwo ?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:668px;height:296px;overflow:hidden;visibility:hidden; float:right;">
                                                    <!-- Loading Screen -->
                                                    <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
                                                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
                                                    </div>
                                                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:668px;height:296px;overflow:hidden;">
                                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                                            <?php if ($res_imgdata['sku'] != '') { ?>
                                                                <div>
                                                                    <img data-u="image" style="cursor: pointer;" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" />
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($res_imgdata['URL'] != '') { ?>
                                                                <div>
                                                                    <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" data-u="image" style="cursor: pointer;" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                <div>
                                                                    <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" />
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
                                                    </div>
                                                    <!-- Bullet Navigator -->
                                                    <?php if ($image_count > 1) { ?>
                                                        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                                            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- Arrow Navigator -->
                                                    <?php if ($image_count > 1) { ?>
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
                                                <script type="text/javascript">jssor_<?= $jsortwo ?>_slider_init();</script>
                                            </div>
                                        </div>
                                        <?php
                                        $jsortwo++;
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <!------------------------------------------------- 7th Section End-------------------------------------->


                        <!-------------------------------------------- 8th Section Start-------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '140x100') {
                            ?>
                            <?php if ($res_secdata['sec_lbl'] == '') { ?>
                            <?php } else { ?>
                                <div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
                                    <h2 style="float:left; margin-left:15px;"><?= $res_secdata['sec_lbl'] ?></h2>
                                </div>
                            <?php } ?>
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                            if ($qr_clmn->num_rows() > 0) {
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                    $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?>
                                    <div style="width:98%; margin:auto; padding:10px;">
                                        <div id="jssor_<?php echo $carasolbrabd; ?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;visibility:hidden; border:1px solid #ccc;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
                                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;">
                                                <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                                                    <?php if ($res_imgdata['sku'] != '') { ?>
                                                        <div>
                                                            <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;" />
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($res_imgdata['URL'] != '') { ?>
                                                        <div>
                                                            <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" />
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                        <div>
                                                            <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" />
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                                <a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
                                            </div>
                                        </div>
                                        <script type="text/javascript">jssor_<?php echo $carasolbrabd; ?>_slider_init();</script> 
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            $carasolbrabd++;
                        }
                        ?>
                        <!-------------------------------------------------8th Section End-------------------------------------------------->			


                        <!-------------------------------------------------Section 9th Condition Start---------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Slider with Product Carousel' && $res_secdata['sec_type_data'] == 'Banner With Product' && $res_secdata['nos_column'] == '2' && $res_secdata['image_size'] == '400x260') {
                            $sec_id = $res_secdata['Sec_id'];
                            ?>

                            <div class="container-fluid">
                                <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                    <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                    <?php } else { ?>
                                        <h3>
                                            <span class="new-arivl"> <?= $res_secdata['sec_lbl'] ?> </span>
                                            <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                        </h3>
                                    <?php } ?>
                                    <div style="clear:both;"></div>
                                    <?php
                                    $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                            $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>
                                            <div class="col-lg-4" style=" margin-top:20px;">
                                                <div class="left-banner">
                                                    <div id="jssor_<?= $jsorsingle ?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:400px;height:260px;overflow:hidden;visibility:hidden;">
                                                        <!-- Loading Screen -->
                                                        <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
                                                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/double-tail-spin.svg" />
                                                        </div>
                                                        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:400px;height:260px;overflow:hidden;">
                                                            <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                                                <?php if ($res_imgdata['sku'] != '') { ?>
                                                                    <div>
                                                                        <img data-u="image"  src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" style="border: 1px solid #ccc !important; border-radius: 6px !important; padding:10px;cursor: pointer;" />
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata['URL'] != '') { ?>
                                                                    <div>
                                                                        <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="border: 1px solid #ccc !important; border-radius: 6px !important; padding:10px; cursor:pointer;"/>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                    <div>
                                                                        <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="border: 1px solid #ccc !important; border-radius: 6px !important; padding:10px; cursor:pointer;"/>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>

                                                            <a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
                                                        </div>
                                                        <!-- Bullet Navigator -->
                                                        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                                            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                                                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <!-- Arrow Navigator -->
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
                                                    </div>
                                                </div> 
                                                <script type="text/javascript">jssor_<?= $jsorsingle ?>_slider_init();</script>
                                            </div>
                                            <?php
                                            $jsorsingle++;
                                        }
                                    }
                                    ?>

                                    <div class="col-lg-8 right-banner" style=" margin-top:20px;">
                                        <div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner">
                                                <?php
                                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn->num_rows() > 0) {
                                                    foreach ($qr_clmn->result_array() as $res_six_clmn) {
                                                        $clmn_six_sqlid = $res_six_clmn['clmn_sqlid'];

                                                        $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_six_sqlid' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                        $image_count = $qr_imginfo->num_rows();
                                                        ?>
                                                        <div class="item active">
                                                            <div class="row">
                                                                <?php
                                                                foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                                    $prod_skuarr = unserialize($res_imgdata['sku']);
                                                                    $prod_skuarr_modf = array();
                                                                    foreach ($prod_skuarr as $skuky => $skuval) {
                                                                        $prod_skuarr_modf[] = "'" . $skuval . "'";
                                                                    }
                                                                    $prod_skustr = implode(',', $prod_skuarr_modf);


                                                                    $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3 ");

                                                                    /* $query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY name ORDER BY `prod_search_sqlid` DESC LIMIT 3  "); */


                                                                    if ($query_prod->num_rows() > 0) {
                                                                        foreach ($query_prod->result_array() as $rw) {
                                                                            $cdate = date('Y-m-d');
                                                                            $special_price_from_dt = $rw['special_pric_from_dt'];
                                                                            $special_price_to_dt = $rw['special_pric_to_dt'];
                                                                            $dsply_img = $rw['catelog_img_url'];
                                                                            ?>
                                                                            <div class="col-sm-4">
                                                                                <div class="col-item" style="background:none!important;">
                                                                                    <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                                                                        <a style="cursor: pointer;" href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" >
                                                                                            <?php if (empty($dsply_img)) { ?>
                                                                                                <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                            <?php } else { ?>
                                                                                                <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img ?>"  alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                            <?php } ?>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="wish-list" style="right: 23px;">
                                                                                        <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                                                                            <i class="fa fa-heart"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="best-slr-data" style="padding: 0px 5px;">      
                                                                                        <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" title="<?php echo $rw['name']; ?>"><?php
                                                                                            if (strlen($rw['name']) > 20) {
                                                                                                echo substr($rw['name'], 0, 20) . '...';
                                                                                            } else {
                                                                                                echo $rw['name'];
                                                                                            }
                                                                                            ?></a>
                                                                                        <div class="price-box">
                                                                                            <?php
                                                                                            if ($rw['special_price'] != 0) {
                                                                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                                                    ?>
                                                                                                    <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php if ($rw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $rw['price']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                    <span class="price"> Rs. <?= $rw['special_price']; ?> </span>
                                                                                                <?php } else { ?>
                                                                                                    <?php if ($rw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                        <span class="price"> Rs. <?= $rw['price']; ?> </span> &nbsp;
                                                                                                    <?php } else { ?>
                                                                                                        <span class="price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                <?php } ?>
                                                                                            <?php } else { ?>
                                                                                                <?php if ($rw['price'] != 0) { ?>
                                                                                                    <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                    <span class="price"> Rs. <?= $rw['price']; ?> </span> &nbsp;
                                                                                                <?php } else { ?>
                                                                                                    <span class="price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                <?php } ?>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                                        $clmn_sqlid1 = $res_clmn['clmn_sqlid'];
                                                        $image_imfo_all = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                        $image_all_count = $image_imfo_all->num_rows();

                                                        foreach ($image_imfo_all->result_array() as $res_allimgdata) {
                                                            $prod_allskuarr = unserialize($res_allimgdata['sku']);
                                                            $prod_all_skuarr_modf = array();
                                                            foreach ($prod_allskuarr as $allskuky => $allskuval) {
                                                                $prod_all_skuarr_modf[] = "'" . $allskuval . "'";
                                                            }
                                                            $prod_allskustr = implode(',', $prod_all_skuarr_modf);


                                                            $query_all_prod_alds = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
                                                            $image_all_count_alldata = $query_all_prod_alds->num_rows();

                                                            $query_all_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3,$image_all_count_alldata");


                                                            /* $query_all_prod_alds = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY name ORDER BY `prod_search_sqlid` DESC LIMIT 10  ");
                                                              $image_all_count_alldata=$query_all_prod_alds->num_rows();

                                                              $query_all_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY name ORDER BY `prod_search_sqlid` DESC LIMIT 3,$image_all_count_alldata  "); */


                                                            $image_count_allproduct = $query_all_prod->num_rows();
                                                            $row_product = $query_all_prod->result_array();
                                                            foreach (array_chunk($row_product, 3) as $row_all_product) {
                                                                ?>
                                                                <div class="item">
                                                                    <div class="row">
                                                                        <?php
                                                                        foreach ($row_all_product as $allrw) {

                                                                            $ccdate = date('Y-m-d');
                                                                            $special_all_price_from_dt = $allrw['special_pric_from_dt'];
                                                                            $special_all_price_to_dt = $allrw['special_pric_to_dt'];
                                                                            $dsply_all_img = $allrw['catelog_img_url'];
                                                                            ?>
                                                                            <div class="col-sm-4">
                                                                                <div class="col-item" style="background:none!important;">
                                                                                    <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                                                                        <a style="cursor: pointer;" href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($allrw['name'])))) . '/' . $allrw['product_id'] . '/' . $allrw['sku'] ?>" >
                                                                                            <?php if (empty($dsply_all_img)) { ?>
                                                                                                <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
                                                                                            <?php } else { ?>
                                                                                                <img src="<?php echo base_url() . 'images/product_img/' . $dsply_all_img ?>"  alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
                                                                                            <?php } ?>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="wish-list" style="right: 23px;">
                                                                                        <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                                                                            <i class="fa fa-heart"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="best-slr-data" style="padding: 0px 5px;">      
                                                                                        <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($allrw['name'])))) . '/' . $allrw['product_id'] . '/' . $allrw['sku'] ?>" title="<?php $allrw['name']; ?>"><?php
                                                                                            if (strlen($allrw['name']) > 20) {
                                                                                                echo substr($allrw['name'], 0, 20) . '...';
                                                                                            } else {
                                                                                                echo $allrw['name'];
                                                                                            }
                                                                                            ?></a>
                                                                                        <div class="price-box">
                                                                                            <?php
                                                                                            if ($allrw['special_price'] != 0) {
                                                                                                if ($cdate >= $special_all_price_from_dt && $cdate <= $special_all_price_to_dt) {
                                                                                                    ?>
                                                                                                    <span class="regular-price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php if ($allrw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $allrw['price']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                    <span class="price"> Rs. <?= $allrw['special_price']; ?> </span>
                                                                                                <?php } else { ?>
                                                                                                    <?php if ($allrw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                        <span class="price"> Rs. <?= $allrw['price']; ?> </span> &nbsp;
                                                                                                    <?php } else { ?>
                                                                                                        <span class="price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                <?php } ?>
                                                                                            <?php } else { ?>
                                                                                                <?php if ($allrw['price'] != 0) { ?>
                                                                                                    <span class="regular-price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                    <span class="price"> Rs. <?= $allrw['price']; ?> </span> &nbsp;
                                                                                                <?php } else { ?>
                                                                                                    <span class="price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                <?php } ?>
                                                                                            <?php } ?>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    <?php } ?>
                                                <?php } ?>


                                                <?php //}  ?>
                                            </div>
                                            <a class="left carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                            <a class="right carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                        <!-------------------------------------------------Section 9th Condition End-------------------------------------------------->

                        <!-------------------------------------------------Section 10th Condition Start-------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Video with Product Carousel' && $res_secdata['sec_type_data'] == 'Video With Product' && $res_secdata['nos_column'] == '2' && $res_secdata['image_size'] == '100x200') {
                            $sec_id = $res_secdata['Sec_id'];
                            ?>
                            <div class="container-fluid">
                                <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                    <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                    <?php } else { ?>
                                        <h3>
                                            <span class="new-arivl"><?= $res_secdata['sec_lbl'] ?></span>
                                            <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                        </h3>
                                    <?php } ?>
                                    <div style="clear:both;"></div>       
                                    <?php
                                    $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                            $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>
                                            <div class="col-lg-4" style=" margin-top:20px;">
                                                <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                                    <?php $url = str_replace('=', '', strrchr($res_imgdata['URL'], "=")); ?>
                                                    <iframe width="100%" height="260" style="border:1px solid #ccc; padding:10px;" src="https://www.youtube.com/embed/<?= $url ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php } ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="col-lg-8 right-banner" style=" margin-top:20px;">
                                        <div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner">
                                                <?php
                                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn->num_rows() > 0) {
                                                    foreach ($qr_clmn->result_array() as $res_six_clmn) {
                                                        $clmn_six_sqlid = $res_six_clmn['clmn_sqlid'];

                                                        $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_six_sqlid' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                        $image_count = $qr_imginfo->num_rows();
                                                        ?>
                                                        <div class="item active">
                                                            <div class="row">
                                                                <?php
                                                                foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                                    $prod_skuarr = unserialize($res_imgdata['sku']);
                                                                    $prod_skuarr_modf = array();
                                                                    foreach ($prod_skuarr as $skuky => $skuval) {
                                                                        $prod_skuarr_modf[] = "'" . $skuval . "'";
                                                                    }
                                                                    $prod_skustr = implode(',', $prod_skuarr_modf);


                                                                    $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3 ");

                                                                    if ($query_prod->num_rows() > 0) {
                                                                        foreach ($query_prod->result_array() as $rw) {
                                                                            $cdate = date('Y-m-d');
                                                                            $special_price_from_dt = $rw['special_pric_from_dt'];
                                                                            $special_price_to_dt = $rw['special_pric_to_dt'];
                                                                            $dsply_img = $rw['catelog_img_url'];
                                                                            ?>
                                                                            <div class="col-sm-4">
                                                                                <div class="col-item" style="background:none!important;">
                                                                                    <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                                                                        <a style="cursor: pointer;" href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" >
                                                                                            <?php if (empty($dsply_img)) { ?>
                                                                                                <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                            <?php } else { ?>
                                                                                                <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img ?>"  alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                            <?php } ?>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="wish-list" style="right: 23px;">
                                                                                        <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                                                                            <i class="fa fa-heart"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="best-slr-data" style="padding: 0px 5px;">      
                                                                                        <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" title="<?php echo $rw['name']; ?>"><?php
                                                                                            if (strlen($rw['name']) > 20) {
                                                                                                echo substr($rw['name'], 0, 20) . '...';
                                                                                            } else {
                                                                                                echo $rw['name'];
                                                                                            }
                                                                                            ?></a>
                                                                                        <div class="price-box">
                                                                                            <?php
                                                                                            if ($rw['special_price'] != 0) {
                                                                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                                                    ?>
                                                                                                    <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php if ($rw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $rw['price']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                    <span class="price"> Rs. <?= $rw['special_price']; ?> </span>
                                                                                                <?php } else { ?>
                                                                                                    <?php if ($rw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                        <span class="price"> Rs. <?= $rw['price']; ?> </span> &nbsp;
                                                                                                    <?php } else { ?>
                                                                                                        <span class="price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                <?php } ?>
                                                                                            <?php } else { ?>
                                                                                                <?php if ($rw['price'] != 0) { ?>
                                                                                                    <span class="regular-price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                    <span class="price"> Rs. <?= $rw['price']; ?> </span> &nbsp;
                                                                                                <?php } else { ?>
                                                                                                    <span class="price"> Rs. <?= $rw['mrp']; ?> </span> &nbsp;
                                                                                                <?php } ?>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                                        $clmn_sqlid1 = $res_clmn['clmn_sqlid'];
                                                        $image_imfo_all = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                        $image_all_count = $image_imfo_all->num_rows();

                                                        foreach ($image_imfo_all->result_array() as $res_allimgdata) {
                                                            $prod_allskuarr = unserialize($res_allimgdata['sku']);
                                                            $prod_all_skuarr_modf = array();
                                                            foreach ($prod_allskuarr as $allskuky => $allskuval) {
                                                                $prod_all_skuarr_modf[] = "'" . $allskuval . "'";
                                                            }
                                                            $prod_allskustr = implode(',', $prod_all_skuarr_modf);

                                                            $query_all_prod_alds = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");
                                                            $image_all_count_alldata = $query_all_prod_alds->num_rows();

                                                            $query_all_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_allskustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 3,$image_all_count_alldata");

                                                            $image_count_allproduct = $query_all_prod->num_rows();
                                                            $row_product = $query_all_prod->result_array();
                                                            foreach (array_chunk($row_product, 3) as $row_all_product) {
                                                                ?>
                                                                <div class="item">
                                                                    <div class="row">
                                                                        <?php
                                                                        foreach ($row_all_product as $allrw) {

                                                                            $ccdate = date('Y-m-d');
                                                                            $special_all_price_from_dt = $allrw['special_pric_from_dt'];
                                                                            $special_all_price_to_dt = $allrw['special_pric_to_dt'];
                                                                            $dsply_all_img = $allrw['catelog_img_url'];
                                                                            ?>
                                                                            <div class="col-sm-4">
                                                                                <div class="col-item" style="background:none!important;">
                                                                                    <div class="view view-fifth" style="width:260px; padding: 10px 10px 0px 10px;">
                                                                                        <a style="cursor: pointer;" href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($allrw['name'])))) . '/' . $allrw['product_id'] . '/' . $allrw['sku'] ?>" >
                                                                                            <?php if (empty($dsply_all_img)) { ?>
                                                                                                <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
                                                                                            <?php } else { ?>
                                                                                                <img src="<?php echo base_url() . 'images/product_img/' . $dsply_all_img ?>"  alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
                                                                                            <?php } ?>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="wish-list" style="right: 23px;">
                                                                                        <a href="#" class="link-wishlist wish_spn" data-toggle="tooltip" title="Add To Wishlist" data-placement="right">
                                                                                            <i class="fa fa-heart"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="best-slr-data" style="padding: 0px 5px;">      
                                                                                        <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($allrw['name'])))) . '/' . $allrw['product_id'] . '/' . $allrw['sku'] ?>" title="<?php $allrw['name']; ?>"><?php
                                                                                            if (strlen($allrw['name']) > 20) {
                                                                                                echo substr($allrw['name'], 0, 20) . '...';
                                                                                            } else {
                                                                                                echo $allrw['name'];
                                                                                            }
                                                                                            ?></a>
                                                                                        <div class="price-box">
                                                                                            <?php
                                                                                            if ($allrw['special_price'] != 0) {
                                                                                                if ($cdate >= $special_all_price_from_dt && $cdate <= $special_all_price_to_dt) {
                                                                                                    ?>
                                                                                                    <span class="regular-price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php if ($allrw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $allrw['price']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                    <span class="price"> Rs. <?= $allrw['special_price']; ?> </span>
                                                                                                <?php } else { ?>
                                                                                                    <?php if ($allrw['price'] != 0) { ?>
                                                                                                        <span class="regular-price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                        <span class="price"> Rs. <?= $allrw['price']; ?> </span> &nbsp;
                                                                                                    <?php } else { ?>
                                                                                                        <span class="price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                    <?php } ?>
                                                                                                <?php } ?>
                                                                                            <?php } else { ?>
                                                                                                <?php if ($allrw['price'] != 0) { ?>
                                                                                                    <span class="regular-price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                    <span class="price"> Rs. <?= $allrw['price']; ?> </span> &nbsp;
                                                                                                <?php } else { ?>
                                                                                                    <span class="price"> Rs. <?= $allrw['mrp']; ?> </span> &nbsp;
                                                                                                <?php } ?>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php //}  ?>
                                            </div>
                                            <a class="left carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                            <a class="right carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-------------------------------------------------Section 10th Condition End-------------------------------------------------->
                        <div style="clear:both;"></div>
                        <!-------------------------------------------------Section 11th Condition Start-------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Vertical Carousal With Thin Banner' && $res_secdata['sec_type_data'] == 'Carousal With Banner' && $res_secdata['nos_column'] == '2' && $res_secdata['image_size'] == 'size1_640x115_size2_644x58') {
                            $sec_id = $res_secdata['Sec_id'];
                            ?>
                            <div class="container-fluid">
                                <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                    <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                    <?php } else { ?>
                                        <h3>
                                            <span class="new-arivl"><?= $res_secdata['sec_lbl'] ?></span>
                                            <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                        </h3>
                                    <?php } ?>
                                    <div style="clear:both;"></div>
                                    <?php
                                    $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                            $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>
                                            <div class="col-lg-6" style=" padding-left:0; margin-top:5px;">
                                                <div id="news-container<?= $nnews ?>">
                                                    <ul>
                                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                                            <li>
                                                                <?php if ($res_imgdata['sku'] != '') { ?>
                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" width="100%;" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;">
                                                                <?php } ?>
                                                                <?php if ($res_imgdata['URL'] != '') { ?>
                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'"  style="cursor: pointer;"/>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;">
                                                                <?php } ?>
                                                            </li> 
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php
                                            $nnews++;
                                        }
                                    }
                                    ?>
                                    <?php
                                    $qr_clmn1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn1->num_rows() > 0) {
                                        foreach ($qr_clmn1->result_array() as $res_clmn1) {
                                            $clmn_sqlid1 = $res_clmn1['clmn_sqlid'];
                                            $qr_imginfo1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count1 = $qr_imginfo1->num_rows();
                                            ?>
                                            <div class="col-lg-6 tickering-right-banner">
                                                <ul>
                                                    <?php foreach ($qr_imginfo1->result_array() as $res_imgdata1) { ?>
                                                        <li>
                                                            <?php if ($res_imgdata1['sku'] != '') { ?>
                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata1['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata1['display_url'] . '/' . $res_imgdata1['img_sqlid'] ?>'" style="cursor: pointer;">
                                                            <?php } ?>
                                                            <?php if ($res_imgdata1['URL'] != '') { ?>
                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata1['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata1['URL']; ?>'"  style="cursor: pointer;"/>
                                                            <?php } ?>
                                                            <?php if ($res_imgdata1['URL'] == '' && $res_imgdata1['sku'] == '') { ?>
                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata1['imge_nm']; ?>" style="cursor: pointer;">
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!-------------------------------------------------Section 11th Condition End-------------------------------------------------->

                        <!-------------------------------------------------Section 12th Condition Start-------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Slider With Add Banner' && $res_secdata['sec_type_data'] == 'Slider With Banner' && $res_secdata['nos_column'] == '2' && $res_secdata['image_size'] == 'size1_1053x324_size2_187x126') {
                            $sec_id = $res_secdata['Sec_id'];
                            ?>
                            <div class="container-fluid">
                                <div class="row" style=" padding:10px; margin:20px 0; background:<?= $res_secdata['bg_color']; ?>">
                                    <div class="col-lg-10">
                                        <div id="tabbed-Carousel" class="carousel slide" data-ride="carousel">
                                            <!-- Wrapper for slides -->

                                            <div class="carousel-inner">
                                                <?php
                                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn->num_rows() > 0) {
                                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                                        $clmn_sqlid_all = $res_clmn['clmn_sqlid'];
                                                        $qr_imginfo_all = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_all' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                                                        $image_count_all = $qr_imginfo_all->num_rows();

                                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                                        $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1 ");
                                                        $image_count = $qr_imginfo->num_rows();
                                                        ?>
                                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                                            <div class="item active">
                                                                <?php if ($res_imgdata['sku'] != '') { ?>
                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;">
                                                                <?php } ?>
                                                                <?php if ($res_imgdata['URL'] != '') { ?>
                                                                    <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;"/>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                    <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" />
                                                                <?php } ?>
                                                            </div><!-- End Item -->
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                                <?php
                                                $qr_clmn_item = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn_item->num_rows() > 0) {
                                                    foreach ($qr_clmn_item->result_array() as $res_clmn_item) {

                                                        $clmn_sqlid_item = $res_clmn_item['clmn_sqlid'];
                                                        $qr_imginfo_item = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_item' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1,$image_count_all ");
                                                        $image_count_item = $qr_imginfo_item->num_rows();

                                                        //print_r($image_count_item);
                                                        ?>
                                                        <?php foreach ($qr_imginfo_item->result_array() as $res_imgdata_item) { ?>
                                                            <div class="item">
                                                                <?php if ($res_imgdata_item['sku'] != '') { ?>
                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_item['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata_item['display_url'] . '/' . $res_imgdata_item['img_sqlid'] ?>'" style="cursor: pointer;">
                                                                <?php } ?>
                                                                <?php if ($res_imgdata_item['URL'] != '') { ?>
                                                                    <img onClick="window.location.href = '<?php echo $res_imgdata_item['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_item['imge_nm']; ?>" style="cursor: pointer;"/>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata_item['URL'] == '' && $res_imgdata_item['sku'] == '') { ?>
                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_item['imge_nm']; ?>">
                                                                <?php } ?>
                                                            </div><!-- End Item -->
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div><!-- End Carousel Inner -->
                                            <ul class="nav nav-pills nav-justified" style="width:100%!important;">
                                                <?php
                                                $qr_clmn1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn1->num_rows() > 0) {
                                                    foreach ($qr_clmn1->result_array() as $res_clmn1) {
                                                        $clmn_sqlid_all1 = $res_clmn1['clmn_sqlid'];
                                                        $qr_imginfo_all1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_all1' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC ");
                                                        $image_count_all1 = $qr_imginfo_all1->num_rows();

                                                        $clmn_sqlid1 = $res_clmn1['clmn_sqlid'];
                                                        $qr_imginfo1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1 ");
                                                        $image_count1 = $qr_imginfo1->num_rows();
                                                        ?>
                                                        <?php foreach ($qr_imginfo1->result_array() as $res_imgdata1) { ?>
                                                            <li data-target="#tabbed-Carousel" data-slide-to="0" class="active">
                                                                <a href="#" style="padding:18px 25px;"><?php echo $res_imgdata1['memo']; ?></a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                $qr_clmn_item1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn_item1->num_rows() > 0) {
                                                    foreach ($qr_clmn_item1->result_array() as $res_clmn_item1) {

                                                        $clmn_sqlid_item1 = $res_clmn_item['clmn_sqlid'];
                                                        $qr_imginfo_item1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid_item1' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 1,$image_count_all1 ");
                                                        $image_count_item1 = $qr_imginfo_item1->num_rows();
                                                        $i = 1;
                                                        ?>
                                                        <?php foreach ($qr_imginfo_item1->result_array() as $res_imgdata_item1) { ?>
                                                            <li data-target="#tabbed-Carousel" data-slide-to="<?php echo $i; ?>">
                                                                <a href="#" style="padding:18px 25px;"><?php echo $res_imgdata_item1['memo']; ?></a>
                                                            </li>
                                                            <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div><!-- End Carousel -->
                                    </div>
                                    <?php
                                    $qr_clmn1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn1->num_rows() > 0) {
                                        foreach ($qr_clmn1->result_array() as $res_clmn1) {
                                            $clmn_sqlid1 = $res_clmn1['clmn_sqlid'];
                                            $qr_imginfo1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count1 = $qr_imginfo1->num_rows();
                                            ?>
                                            <div class="col-lg-2">
                                                <div class="latest_offers">
                                                    <input type="hidden" class="right_xtra_banner" data-id="4520" blkname="Plat" position="2">
                                                    <ul id="4520">
                                                        <?php foreach ($qr_imginfo1->result_array() as $res_imgdata1) { ?>
                                                            <li>
                                                                <a>
                                                                    <?php if ($res_imgdata1['sku'] != '') { ?>
                                                                        <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata1['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata1['display_url'] . '/' . $res_imgdata1['img_sqlid'] ?>'" alt="" style="cursor: pointer;">
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata1['URL'] != '') { ?>
                                                                        <img onClick="window.location.href = '<?php echo $res_imgdata1['URL']; ?>'" data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata1['imge_nm']; ?>" style="cursor: pointer;"/>
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata1['URL'] == '' && $res_imgdata1['sku'] == '') { ?>
                                                                        <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata1['imge_nm']; ?>" style="cursor: pointer;" />
                                                                    <?php } ?>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!-------------------------------------------------Section 12th Condition End-------------------------------------------------->
                        <!-------------------------------------------------Section 13th Condition Start-------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Product Grid View' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                            $sec_id = $res_secdata['Sec_id'];
                            ?>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">				
                                        <?php
                                        $sec_id = $res_secdata['Sec_id'];
                                        $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                        if ($qr_clmn->num_rows() > 0) {
                                            foreach ($qr_clmn->result_array() as $res_clmn) {
                                                $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                                $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                $image_count = $qr_imginfo->num_rows();
                                                ?>					

                                                <ul>
                                                    <?php
                                                    foreach ($qr_imginfo->result_array() as $res_imgdata) {

                                                        $prod_skuarr = unserialize($res_imgdata['sku']);
                                                        $prod_skuarr_modf = array();
                                                        foreach ($prod_skuarr as $skuky => $skuval) {
                                                            $prod_skuarr_modf[] = "'" . $skuval . "'";
                                                        }

                                                        $prod_skustr = implode(',', $prod_skuarr_modf);

                                                        $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid ");

                                                        if ($query_prod->num_rows() > 0) {
                                                            foreach ($query_prod->result_array() as $rw) {
                                                                $cdate = date('Y-m-d');
                                                                $special_price_from_dt = $rw['special_pric_from_dt'];
                                                                $special_price_to_dt = $rw['special_pric_to_dt'];
                                                                $dsply_img = $rw['catelog_img_url'];
                                                                ?>
                                                                <li>
                                                                    <div class="menu-link-product-held"> 
                                                                        <div class="pad-res">
                                                                            <div class="today-deal-left">
                                                                                <a style="cursor: pointer;" href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                                    <?php if (empty($dsply_img)) { ?>
                                                                                        <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                    <?php } else { ?>
                                                                                        <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img ?>"  alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                    <?php } ?>
                                                                                </a>
                                                                            </div>
                                                                            <div class="today-deal-right">
                                                                                <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';"><a style="cursor: pointer;" href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>"><?php echo $rw['name']; ?></a></h4>
                                                                                <p style="margin-left:0px;">
                                                                                    <?php
                                                                                    if ($rw['special_price'] != 0) {
                                                                                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                                            ?>
                                                                                            <span style="color:#999; text-decoration:line-through">
                                                                                                <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                                                                </i> &nbsp; <?= $rw['mrp']; ?>
                                                                                            </span>&nbsp;&nbsp;
                                                                                            <?php if ($rw['price'] != 0) { ?>
                                                                                                <span style="color:#999 !important;  text-decoration:line-through">
                                                                                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?= $rw['price']; ?> </span> &nbsp;&nbsp;
                                                                                            <?php } ?>
                                                                                            <span style="color:#079107 !important;  font-weight:bold;">
                                                                                                <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                                                                </i>&nbsp; <?= $rw['special_price']; ?>
                                                                                            </span> &nbsp;&nbsp;
                                                                                        <?php } else { ?>
                                                                                            <?php if ($rw['price'] != 0) { ?>
                                                                                                <span style="color:#999; text-decoration:line-through">
                                                                                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                                                                    </i> &nbsp; <?= $rw['mrp']; ?>
                                                                                                </span>&nbsp;&nbsp;
                                                                                                <span style="color:#079107 !important;  font-weight:bold;">
                                                                                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?= $rw['price']; ?> </span> &nbsp;&nbsp;
                                                                                            <?php } else { ?>
                                                                                                <span style="color:#999; text-decoration:line-through">
                                                                                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                                                                    </i> &nbsp; <?= $rw['mrp']; ?>
                                                                                                </span>&nbsp;&nbsp;
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    <?php } else { ?>
                                                                                        <?php if ($rw['price'] != 0) { ?>
                                                                                            <span style="color:#999; text-decoration:line-through">
                                                                                                <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                                                                </i> &nbsp; <?= $rw['mrp']; ?>
                                                                                            </span>&nbsp;&nbsp;
                                                                                            <span style="color:#079107 !important;  font-weight:bold;">
                                                                                                <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; <?= $rw['price']; ?> </span> &nbsp;&nbsp;
                                                                                        <?php } else { ?>
                                                                                            <span style="color:#999; text-decoration:line-through">
                                                                                                <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                                                                </i> &nbsp; <?= $rw['mrp']; ?>
                                                                                            </span>&nbsp;&nbsp;
                                                                                        <?php } ?>
                                                                                    <?php } ?>
                                                                                </p>
                                                                            </div>
                                                                            <div style="clear:both;"></div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    <?php } ?>
                                                </ul>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-------------------------------------------------Section 13th Condition End-------------------------------------------------->

                        <!-------------------------------------------------Section 14th Condition Start------------------------------------------------>
                        <?php
                        if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '4' && $res_secdata['image_size'] == '333x210') {
                            ?>
                            <div class="container-fluid" style="padding:0;">
                                <div class="row" style="margin-right: 0px; margin-left: 15px;">
                                    <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                    <?php } else { ?>
                                        <h3>
                                            <span class="new-arivl"> <?php echo $res_secdata['sec_lbl']; ?> </span>
                                            <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                        </h3>
                                    <?php } ?>
                                </div>
                                <div class="container-fluid" style="padding:0;">

                                    <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                        <?php
                                        $sec_id = $res_secdata['Sec_id'];
                                        $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
                                        if ($qr_clmn->num_rows() > 0) {
                                            foreach ($qr_clmn->result_array() as $res_clmn) {
                                                $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                                $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND 
									image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                $image_count = $qr_imginfo->num_rows();
                                                ?>
                                                <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                                    <?php if ($res_imgdata['sku'] != '') { ?>
                                                        <div class="col images_1_of_3">
                                                            <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;" >
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($res_imgdata['URL'] != '') { ?>
                                                        <div class="col images_1_of_3">
                                                            <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" >
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                        <div class="col images_1_of_3">
                                                            <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;" >
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                        <!-------------------------------------------------Section 14th Condition End---------------------------------------------------->

                        <!-------------------------------------------------Section 15th Condition Start-------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '266x164') {

                            $sec_id = $res_secdata['Sec_id'];
                            ?>
                            <div class="container-fluid" style="padding:0;">
                                <div class="row" style="margin:5px 0;">
                                    <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                    <?php } else { ?>
                                        <div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
                                            <h3 class="title"> <span><?php echo $res_secdata['sec_lbl']; ?></span> </h3>
                                        </div>
                                    <?php } ?>

                                    <div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <?php
                                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
                                            if ($qr_clmn->num_rows() > 0) {
                                                foreach ($qr_clmn->result_array() as $res_clmn_four) {
                                                    $clmn_sqlid1 = $res_clmn_four['clmn_sqlid'];
                                                    $qr_act_imginfo1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid");
                                                    $image_all_count = $qr_act_imginfo1->num_rows();

                                                    $qr_act_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 5 ");
                                                    $image_count = $qr_act_imginfo->num_rows();
                                                    ?>
                                                    <div class="item active">
                                                        <div class="row" style="margin:auto;" >
                                                            <?php
                                                            foreach ($qr_act_imginfo->result_array() as $res_imgdata_active) {
                                                                ?>
                                                                <?php if ($res_imgdata_active['sku'] != '') { ?>
                                                                    <div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
                                                                        <div class="col-item" style="background:<?= $res_secdata['bg_color']; ?>;">
                                                                            <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata_active['display_url'] . '/' . $res_imgdata_active['img_sqlid'] ?>'" alt="" style="cursor: pointer;">
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata_active['URL'] != '') { ?>
                                                                    <div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
                                                                        <div class="col-item" style="background:<?= $res_secdata['bg_color']; ?>;">
                                                                            <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata_active['URL']; ?>'" alt="" style="cursor: pointer;">
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata_active['URL'] == '' && $res_imgdata_active['sku'] == '') { ?>
                                                                    <div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
                                                                        <div class="col-item" style="background:<?= $res_secdata['bg_color']; ?>;">
                                                                            <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" alt="" style="cursor: pointer;">
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                                    $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 5,$image_all_count ");
                                                    $image_count = $qr_imginfo->num_rows();
                                                    $row = $qr_imginfo->result_array();
                                                    //print_r($image_count);
                                                    foreach (array_chunk($row, 5) as $rw) {
                                                        ?> 
                                                        <div class="item">
                                                            <div class="row" style="margin:auto;">
                                                                <?php
                                                                foreach ($rw as $res_imgdata) {
                                                                    ?>
                                                                    <?php if ($res_imgdata['sku'] != '') { ?>
                                                                        <div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
                                                                            <div class="col-item" style="background:<?= $res_secdata['bg_color']; ?>;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" alt="" style="cursor: pointer;">
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata['URL'] != '') { ?>
                                                                        <div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
                                                                            <div class="col-item" style="background:<?= $res_secdata['bg_color']; ?>;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" alt="" style="cursor: pointer;">
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                        <div class="col-sm-3" style="width:20%; padding:0 2px; height:166px;">
                                                                            <div class="col-item" style="background:<?= $res_secdata['bg_color']; ?>;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" alt="" style="cursor: pointer;">
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <?php } ?>
                                        </div>
                                        <?php if ($image_all_count > 5) { ?>
                                            <a class="left carousel-control" style="padding-top: 5%; margin-left: 5px;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                            <a class="right carousel-control" style="padding-top: 5%; margin-right: 21px;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>	
                        <?php } ?>
                        <!-------------------------------------------------Section 15th Condition End-------------------------------------------------->
                        <!-------------------------------------------------Section 16th Condition End-------------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Rich Text Editor' && $res_secdata['sec_type_data'] == 'Banner') {

                            $sec_id = $res_secdata['Sec_id'];
                            ?>
                            <div class="container-fluid">
                                <div class="col-lg-12" style="background:#f5f5f5; padding:10px;">
                                    <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                    <?php } else { ?>
                                        <h5><strong><?= $res_secdata['sec_lbl'] ?></strong></h5>
                                    <?php } ?>
                                    <p><?= $res_secdata['sec_descrp'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                        <!-------------------------------------------------Section 16th Condition End-------------------------------------------------->
                        <?php
                    }
                }
                ?>
            <?php } ?>

        </div>
    </div>
</div>
<?php include "footer.php"; ?>
