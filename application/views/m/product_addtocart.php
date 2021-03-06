<?php
include 'header.php';
$this->db->cache_on();

$label_name = $this->uri->segment(1);
$qr_lblid = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
if ($qr_lblid->num_rows() > 0) {
    $dskcatgid_id = $qr_lblid->row()->category_id;
    $mobilelbl_menu_id = $qr_lblid->row()->dskmenu_lbl_id;
}


@$catgstr_urlpass = str_replace(',', '-', @$dskcatgid_id);
?>
<meta name="Description" content="<?php echo @$data1->meta_description; ?>">
<meta name="Keywords" content="<?php echo @$data1->meta_keywords; ?>" />

<link rel="canonical" href="<?php echo base_url() . $label_name; ?>"/>

<title><?php echo @$data1->page_title; ?></title>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<style>
    button.first-accordion {
        background-color: #f5f5f5;
        color: #444;
        cursor: pointer;
        padding: 7px 10px;
        width: 100%;
        border: 1px solid #ddd;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
        border-radius: 3px;
        margin-bottom: 5px;
    }

    button.first-accordion.active, button.first-accordion:hover {
        background-color: #f5f5;
    }

    button.first-accordion:after {
        content: '\02C7';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
        padding: 0px 10px;
        border: 1px solid #afadad;
        font-size: 42px;
        height: 34px;
        width: 34px;
        line-height: 56px;
        /* background: #ccc; */
        text-align: center;
        padding: 0px;

    }

    button.first-accordion.active:after {
        content: "\02C6";
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
        padding: 0px 10px;
        border: 1px solid #afadad;
        font-size: 42px;
        height: 34px;
        width: 34px;
        line-height: 56px;
        /* background: #ccc; */
        text-align: center;
        padding: 0px;
    }

    div.panel {
        /*padding: 0 15px*/;
        background-color: white;
        max-height: 0;
        transition: max-height 0.2s ease-out;
        margin-bottom: 0!important;
        width: 100%;
        overflow-y: scroll;
    }
    div.panel ul li {
        list-style: none; 
    }
    .catagory-banner {
        float: left;
        width: 50%;
        /*    border-right: 1px solid #B9B9B9;
        */    /* height: 160px; */
        padding:10px;
        /*   border-bottom: 1px solid #B9B9B9;
        */}
    .catagory-banner img {
        width: 95%;
        float:left;
        margin-right: 15px;
    }
    .category-products .panel {
        max-height: 2000px!important;
    }
    .brands-name {
        border: 1px solid #F7F7F0;
        padding-bottom: 0px;
        padding-top: 0px;
        width: 48%;
        float: left;
        margin-left: 6;
        margin-right: 6px;
        margin-bottom: 6px;
        height: 244px;
    }
    #slider02 .viewport {
        height: 265px;
        overflow: hidden;
        position: relative;
    }
    .prduct-sl-1st{
        width:100%; padding:0; height:30px;
    }
    .product-sl-off{
        width: 25%;
        text-align: center;
        background: rgba(89, 194, 175, 0.79);
        color: #fff; 
        font-weight: bold; 
        letter-spacing: 1px; 
        line-height: 18px;
        padding: 1px;
        display: inline-block;	
    }	
    .product-sl-right{
        float:right; width:65%; text-align:right;
    }
    .poduct-sl-pre{
        text-decoration: line-through;
        display: inline-block;
        color: #8B8B8B;
        font-size: 10px;
    }
    .product-sl-main-price{
        color: #900;
        display: inline-block;
        font-size: 14px;
        text-align: right;
    }
    .product-sl-image-held{
        text-align:center; width:100%; margin:auto;
    }
    #slider02 .overview li {
        border: none;
    }
    #slider02 .viewport {
        height: 195px;
        /* overflow: hidden; */
        /* position: relative; */
        width: 268px;
        margin: auto auto auto -25px;
    }
    #slider1 .viewport {
        height: 79px;
        overflow: hidden;
        position: relative;
    }
    #slider01 .viewport {
        height: 165px;
        overflow: hidden;
        position: relative;
        width: 237px;
    }
    .brands-name img {
        width: 100%;
        margin: auto;
        height: auto;
        max-height: 170px;
    }.panel-body ul li {
        height: 150px;
        width: 46%;
        float: left;
        border: 1px solid #f5f5f5;
        margin: 5px;
    }
    .product-sl-image-held img {
        max-width: 100%;
        /*    height: auto;
        */    max-height: 95px;
    }

    .discount {
        /* border: 1px solid #ed2541; */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        text-align: center;
        /*position: absolute;
        margin-top: -80px;*/
        background: #ed2541;
        border: 1px solid #ed2541;
        color: #fff;
        font-weight: bold;
        margin-right: 46px;
        margin-top: -10px;
    }
    .discount p{
        font-size: 13px;line-height: 14px;
        letter-spacing: 1px;
    }
    .pad-res {
        margin-bottom: 13px;
        /* margin-top: 15px; */
        border-bottom: 1px solid #ccc;
        background: #fff;
        padding: 5px;
    }
    i.fa.fa-list {
        font-size: 25px;
    }
    i.fa.fa-th-large{font-size: 25px;}
    a.button.act {
        background: #0066c0;
        padding: 11px 7px 2px;
        color: #fff;
    }
    .a-row {
        width: 100%;
    }
    .a-row:after, .a-row:before {
        display: table;
        content: "";
        line-height: 0;
        font-size: 0;
    }
    .a-color-price {
        color: #CC1C39!important;
    }
    .a-size-medium {
        font-size: 1.9rem!important;
        line-height: 2.5rem!important;
        text-rendering: auto;
    }
    .a-text-bold {
        font-weight: 700!important;
    }
    .a-letter-space {
        display: inline-block;
        width: .4em;
    }
    .a-size-mini {
        font-size: 1.2rem!important;
        line-height: 1.5rem!important;
    }
    .a-color-secondary {
        color: #6C7778!important;
    }
    .a-text-strike {
        text-decoration: line-through!important;
    }
    .a-letter-space {
        display: inline-block;
        width: .4em;
    }
    .a-row:after {
        clear: both;
    }
</style>  



<link rel="canonical" href="<?php echo base_url() . $label_name; ?>"/>
<script>
    function ShowMoreSingleData(result_no, cat_id, lastseg) {
        var numItems = parseInt($('.singleproduct-grids').length);
        var result_no = parseInt(result_no);
        //alert(lastseg);return false;
        $.ajax({
            url: '<?php echo base_url(); ?>product_description/show_more_single_catalog_data',
            method: 'get',
            data: {from: numItems, cat_id: cat_id, lastseg: lastseg},
            beforeSend: function () {
                $('.view_mor').hide();
                $('#lodr_sec_img').show();
            },
            complete: function () {
                $('#lodr_sec_img').hide();
                $('.view_mor').show();
            },
            success: function (result) {
                $('.singleproducts-row').append(result);
                $('#scrol_secmenu_tracktxtbox').val('wait to scroll');
                if (numItems == result_no) {
                    $('.view_mor').hide();
                    $('#view_more_secnd_dv').html('<span>No more product available!</span>');
                }
            }
        });
    }

    function ShowMoreData(result_no, cat_id, lastseg) {
        var numItems = parseInt($('.product-grids').length);
        var result_no = parseInt(result_no);
        //alert(lastseg);return false;
        $.ajax({
            url: '<?php echo base_url(); ?>product_description/show_more_catalog_data',
            method: 'get',
            data: {from: numItems, cat_id: cat_id, lastseg: lastseg},
            beforeSend: function () {
                $('.view_mor').hide();
                $('#lodr_img').show();
            },
            complete: function () {
                $('#lodr_img').hide();
                $('.view_mor').show();
            },
            success: function (result) {
                $('.products-row').append(result);
                $('#scrol_tracktxtbox').val('wait to scroll');
                if (numItems == result_no) {
                    $('.view_mor').hide();
                    $('#view_more_dv').html('<span>No more product available!</span>');
                }
            }
        });
    }

    function sortby_price(sortbyprice, catgnm, cat_id, lastseg)
    {
        window.onload = $('#limg').css('display', 'block');

        if (lastseg == 'NOT') {
            window.location.href = '<?php echo base_url(); ?>filterby/' + catgnm.replace(" ", "-") + '/' + cat_id + '/' + 'sortbyprice=' + sortbyprice;
        } else {
            window.location.href = '<?php echo base_url(); ?>filterby/' + catgnm.replace(" ", "-") + '/' + cat_id + '/' + lastseg + '&sortbyprice=' + sortbyprice;
        }
    }
</script>
<script>
    function menuvisibility(val) {
        //alert(val);
        if (val == 'menu1') {

            //alert('Menu1');
            document.getElementById('menu1').style.display = "block";
            document.getElementById('menu2').style.display = "none";
            //$("#act1").toggleClass("act"); 
            $("#act1").removeClass("act");
            $("#act2").addClass('act');
        }
        if (val == 'menu2') {
            //alert('Menu2');
            document.getElementById('menu2').style.display = "block";
            document.getElementById('menu1').style.display = "none";
            //$("#act2").toggleClass("act"); 
            $("#act2").removeClass("act");
            $("#act1").addClass('act');
        }
    }
</script>


<div class="wrap" >
    <!--products-->
    <div class="info-products">

        <div class="info-inner">


            <!-- Filter Panel -->
            <?php include "catalog_filter_menu.php"; ?>  
            <!--Filter Panel -->

            <!---------------------------------------------------------------Sction info Start----------------------------------------->


            <?php
            $this->db->cache_off();
            if ($sec_info != false) {
                if ($sec_info->num_rows() > 0) {
                    $cur_dtm = date('y-m-d h:i:s');
                    foreach ($sec_info->result_array() as $res_secdata) {
                        ?>

                        <!---------------------------------------------------section 1st condition start--------------------------------------------->
                        <?php if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '53x52') {
                            ?>
                            <div class="container" style="padding:0!important;">
                                <div class="col-md-12" style="padding:0!important;">
                                    <div class="well" style="background-color: <?= $res_secdata['bg_color']; ?>">
                                        <div id="myCarousel" class="carousel slide">
                                            <div class="carousel-inner">

                                                <?php
                                                $sec_id = $res_secdata['Sec_id'];
                                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                                if ($qr_clmn->num_rows() > 0) {
                                                    $image_track = array();
                                                    foreach ($qr_clmn->result_array() as $res_clmn_four) {
                                                        $clmn_sqlid1 = $res_clmn_four['clmn_sqlid'];

                                                        $qr_act_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC ");
                                                        $image_all_count = $qr_act_imginfo->num_rows();

                                                        $qr_act_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC LIMIT 4 ");
                                                        $image_count = $qr_act_imginfo->num_rows();
                                                        ?>                    
                                                        <!-- Carousel items -->
                                                        <div class="item active">
                                                            <div class="row" style="margin: auto;">
                                                                <?php
                                                                foreach ($qr_act_imginfo->result_array() as $res_imgdata_active) {
                                                                    ?>
                                                                    <?php if ($res_imgdata_active['sku'] != '') { ?>
                                                                        <div class="col-sm-3">
                                                                            <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata_active['img_sqlid'] ?>'"  alt="Image" class="img-responsive" />
                                                                                <?= stripslashes($res_imgdata_active['imag_label']) ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php if ($res_imgdata_active['URL'] != '') { ?>
                                                                        <div class="col-sm-3">
                                                                            <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata_active['URL']; ?>'"  alt="Image" class="img-responsive"/>
                                                                                <?= stripslashes($res_imgdata_active['imag_label']) ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php if ($res_imgdata_active['URL'] == '' && $res_imgdata_active['sku'] == '') { ?>
                                                                        <div class="col-sm-3">
                                                                            <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" alt="Image" class="img-responsive">
                                                                                <?= stripslashes($res_imgdata_active['imag_label']) ?>
                                                                            </a>

                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>                       
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid ASC LIMIT 4,$image_all_count  ");
                                                        $image_count = $qr_imginfo->num_rows();
                                                        $row = $qr_imginfo->result_array();
                                                        $img_count = $image_count / 4;
                                                        $ceiled = ceil($img_count);
                                                        ?>
                                                        <?php
                                                        //for($i=1;$i<$ceiled;$i++) {
                                                        foreach (array_chunk($row, 4) as $rw) {
                                                            ?>

                                                            <div class="item">
                                                                <div class="row" style="margin: auto;">
                                                                    <?php
                                                                    foreach ($rw as $res_imgdata) {
                                                                        ?>
                                                                        <?php if ($res_imgdata['sku'] != '') { ?>
                                                                            <div class="col-sm-3">
                                                                                <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>;">
                                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'"  alt="Image" class="img-responsive" />
                                                                                    <?= stripslashes($res_imgdata['imag_label']) ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>

                                                                        <?php if ($res_imgdata['URL'] != '') { ?>
                                                                            <div class="col-sm-3">
                                                                                <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>;">
                                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'"  alt="Image" class="img-responsive"/>
                                                                                    <?= stripslashes($res_imgdata['imag_label']) ?>
                                                                                </a>                            
                                                                            </div>
                                                                        <?php } ?>

                                                                        <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                            <div class="col-sm-3">
                                                                                <a class="thumbnail" style="background-color: <?= $res_secdata['bg_color']; ?>;">
                                                                                    <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" alt="Image" class="img-responsive">
                                                                                    <?= stripslashes($res_imgdata['imag_label']) ?>
                                                                                </a>

                                                                            </div>
                                                                        <?php } ?>

                                                                    <?php } ?>

                                                                </div>                       
                                                            </div>

                                                        <?php } //} ?>


                                                        <?php
                                                    } // column for loop end
                                                }// column num_rows condition end
                                                ?>

                                                <!--/carousel-inner--> </div>
                                            <?php if ($image_all_count > 4) { ?>		<!--/carousel-inner--> 
                                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>

                                                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                                            <?php } ?> 
                                        </div>
                                        <!--/myCarousel-->
                                    </div>
                                    <!--/well-->
                                </div>
                            </div>		

                        <?php } // section 1st condition end  ?>
                        <!---------------------------------------------------section 1st condition end--------------------------------------------->



                        <!---------------------------------------------------section 1st condition start--------------------------------------------->	

                        <?php /* ?><?php if($res_secdata['sec_type']=='Carousel'  && $res_secdata['sec_type_data']=='Banner' && $res_secdata['nos_column']=='1' && $res_secdata['image_size']=='53x52')
                          {?>

                          <?php
                          $sec_id=$res_secdata['Sec_id'];
                          $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                          if($qr_clmn->num_rows()>0)
                          {
                          foreach($qr_clmn->result_array() as $res_clmn)
                          {
                          $clmn_sqlid=$res_clmn['clmn_sqlid'];

                          $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                          $image_count=$qr_imginfo->num_rows();
                          ?>

                          <div style="background:<?=$res_clmn['bg_color']?>; ">

                          <section class="regular slider" style="height:105px;">
                          <!-- <div>
                          <img src="<?=APP_BASE?>images/pagedesign_image/ghig24zimtntqv920170601142745.jpg">
                          <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">1st Image</p>
                          </div>-->

                          <!------------------------------------->

                          <?php if($qr_imginfo->num_rows()>0)
                          { foreach($qr_imginfo->result_array() as $res_imgdata){

                          ?>
                          <?php if($res_imgdata['sku']!=''){ ?>
                          <div>
                          <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onclick="window.location.href='<?php echo base_url().'offers/'.$res_imgdata['display_url'].'/'.$res_imgdata['img_sqlid'] ?>'" />
                          <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
                          <?=stripslashes($res_imgdata['imag_label'])?>
                          </p>
                          </div>
                          <?php } ?>

                          <?php if($res_imgdata['URL']!=''){ ?>
                          <div>
                          <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"/>
                          <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
                          <?=stripslashes($res_imgdata['imag_label'])?>
                          </p>
                          </div>
                          <?php } ?>

                          <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
                          <div>
                          <img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" />
                          <p style="font-size:13px; color:#333; text-align:center;padding-bottom: 5px;">
                          <?=stripslashes($res_imgdata['imag_label'])?>
                          </p>
                          </div>
                          <?php } ?>


                          <?php
                          } // image for loop end
                          } // image num_rows condition end ?>

                          </section>




                          </div>


                          <?php
                          } // column for loop end
                          }// column num_rows condition end



                          } // section 1st condition end ?><?php */ ?>
                        <!---------------------------------------------------section 1st condition end--------------------------------------------->


                        <!---------------------------------------------------section 9th condition start------------------------------------------------->

                        <?php if ($res_secdata['sec_type'] == 'Grouped Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '600x259') {
                            ?> 
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
                            if ($qr_clmn->num_rows() > 0) {
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                    $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?>
                                    <div class="container">
                                        <!--<h3>Banner</h3>-->
                                        <div class="panel-group category-products" id="accordian">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">

                                                    <h4 class="panel-title" style="text-align:center;">
                                                        <a data-toggle="collapse">
                                                            <?= $res_secdata['sec_lbl'] ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="mens" class="collapse in">
                                                    <div class="panel-body" style="min-height: auto;">
                                                        <ul>
                                                            <?php
                                                            if ($qr_imginfo->num_rows() > 0) {
                                                                foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                                    ?>
                                                                    <li style="height:auto">
                                                                        <div class="brands_products">
                                                                            <div class="brands-name" style="width:100%; height:auto;">
                                                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                                                                                                                                <!--<script>
                                                                                                                                                var acc = document.getElementsByClassName("first-accordion");
                                                                                                                                                var i;

                                                                                                                                                for (i = 0; i < acc.length; i++) {
                                                                                                                                                acc[i].onclick = function() {
                                                                                                                                                this.classList.toggle("active");
                                                                                                                                                var panel = this.nextElementSibling;
                                                                                                                                                if (panel.style.maxHeight){
                                                                                                                                                panel.style.maxHeight = null;
                                                                                                                                                } else {
                                                                                                                                                panel.style.maxHeight = panel.scrollHeight + "px";
                                                                                                                                                } 
                                                                                                                                                }
                                                                                                                                                }
                                                                                                                                                </script>-->


                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        <?php } ?>
                        <!---------------------------------------------------section 9th condition end-------------------------------------------------> 
                        <!---------------------------------------------------section 2nd condition start--------------------------------------------->

                        <?php
                        if ($res_secdata['sec_type'] == 'Slider' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '770x394') {
                            ?>
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                            if ($qr_clmn->num_rows() > 0) {
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                    $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?>


                                    <div class="details-grid">
                                        <div class="details-shade">
                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                <ol class="carousel-indicators">
                                                    <?php
                                                    $i_slide = 0;
                                                    foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                        ?>  
                                                        <li data-target="#carousel-example-generic" data-slide-to="<?= $i_slide ?>" <?php if ($i_slide == '0') { ?> class="active" <?php } ?> ></li>                                  
                                                        <?php
                                                        $i_slide++;
                                                    }
                                                    ?>
                                                </ol>
                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                    <?php
                                                    $j_slide = 0;
                                                    foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                        ?> 

                                                        <?php if ($res_imgdata['sku'] != '') { ?>
                                                            <div <?php if ($j_slide == '0') { ?>class="item active" <?php } else { ?> class="item" <?php } ?>>
                                                                <a href="#">
                                                                    <img alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  width="" height="" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" /> 
                                                                </a></div>
                                                        <?php } ?>

                                                        <?php if ($res_imgdata['URL'] != '') { ?>
                                                            <div <?php if ($j_slide == '0') { ?>class="item active" <?php } else { ?> class="item" <?php } ?>>
                                                                <a href="#">
                                                                    <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  width="" height="" /> </a>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if ($res_imgdata['sku'] == '' && $res_imgdata['URL'] == '') { ?> 
                                                            <div <?php if ($j_slide == '0') { ?>class="item active" <?php } else { ?> class="item" <?php } ?>>
                                                                <a href="#">
                                                                    <img alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  width="" height="" /> 
                                                                </a>
                                                            </div>                                
                                                        <?php } ?> 
                                                        <?php
                                                        $j_slide++;
                                                    }
                                                    ?>
                                                </div> <!-- Wrapper for slides -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--------slider start end ----->    


                                    <?php
                                } // column for loop end
                            }// column num_rows condition end
                        }  // section 2nd condition end 
                        ?> 
                        <!---------------------------------------------------section 2nd condition end----------------------------------------------->


                        <!---------------------------------------------------section 3rd condition start--------------------------------------------->

                        <?php if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '350x72') {
                            ?>
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                            if ($qr_clmn->num_rows() > 0) {
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                    $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?>




                                    <div style="margin-top:1px;">
                                        <div id="jssor_4" style="position:relative;margin:0 auto;top:0px;left:0px;width:1024px;height:80px;overflow:hidden;visibility:hidden;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:<?= $res_clmn['bg_color'] ?>;">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('<?php echo base_url() ?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1024px;height: 80px;overflow:hidden;">
                                                <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>                             
                                                    <div>

                                                        <?php if ($res_imgdata['sku'] != '') { ?>
                                                            <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" />
                                                        <?php } ?>

                                                        <?php if ($res_imgdata['URL'] != '') { ?>
                                                            <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                        <?php } ?>
                                                        <?php if ($res_imgdata['URL'] == '' && $res_imgdata['URL'] == '') { ?>
                                                            <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>   

                                                <!--<a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>-->
                                                <a data-u="any" href="#" style="display:none">js slider</a>
                                            </div>
                                            <!-- Bullet Navigator -->
                                            <?php if ($image_count > 1) { ?>
                                                <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                                                    <!-- bullet navigator item prototype -->
                                                    <div data-u="prototype" style="width:16px;height:16px;"></div>
                                                </div>
                                            <?php } ?>
                                            <!-- Arrow Navigator -->
                                            <?php if ($image_count > 1) { ?>
                                                <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                                <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                            <?php } ?>
                                        </div>
                                        <script type="text/javascript">jssor_4_slider_init();</script>
                                    </div>

                                    <?php
                                } // column for loop end
                            }// column num_rows condition end
                        }  // section 3rd condition end 
                        ?> 

                        <!---------------------------------------------------section 3rd condition end----------------------------------------------->


                        <!---------------------------------------------------section 4th condition start----------------------------------------------->
                        <?php
                        if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '3' && $res_secdata['image_size'] == '119x84') {
                            ?>                   
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        $jsor = 1;
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                            $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>
                                            <div class="col-xs-4 col-sm-4 col-md-4 " >
                                                <div id="jssor_<?= $jsor ?>" style="position:relative;margin:0 auto;top:0px;left:0px;width:110px;height:84px;overflow:hidden;visibility:hidden;">                     <!-- Loading Screen -->
                                                    <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:<?= $res_clmn['bg_color']; ?>">
                                                        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                        <div style="position:absolute;display:block;background:url('<?php echo base_url() ?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                                    </div>
                                                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:100px;height:80px;overflow:hidden;">

                                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                                                            <div>
                                                                <?php if ($res_imgdata['sku'] != '') { ?>
                                                                    <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" />
                                                                <?php } ?>

                                                                <?php if ($res_imgdata['URL'] != '') { ?>
                                                                    <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                                <?php } ?>
                                                                <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>                                        
                                                                    <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                                <?php } ?>

                                                            </div>   
                                                            <!--<div class="clearfix"></div> --> 
                                                        <?php } ?>

                                                    </div>
                                                    <!-- Bullet Navigator -->
                                                    <?php if ($image_count > 1) { ?>
                                                        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                                                            <!-- bullet navigator item prototype -->
                                                            <div data-u="prototype" style="width:16px;height:16px;"></div>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- Arrow Navigator -->
                                                    <?php if ($image_count > 1) { ?>
                                                        <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                                        <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                                    <?php } ?>
                                                </div>
                                                <script type="text/javascript">jssor_<?= $jsor ?>_slider_init();</script>

                                            </div>
                                            <?php
                                            $jsor++;
                                        } // column for loop end
                                    }// column num_rows condition end
                                    ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>		
                        <?php } // section 4th condition end ?>       

                        <!---------------------------------------------------section 4th condition end------------------------------------------------->

                        <!---------------------------------------------------section 5th condition start------------------------------------------------->

                        <?php if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '770x394') {
                            ?>

                            <div id="jssor_9" style="position:relative;margin:0 auto;top:1px;left:0px;width:1024px;height:500px;overflow:hidden;visibility:hidden;">

                                <!-- Loading Screen -->
                                <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 5px; left: 0px; width: 100%; height: 100%;"></div>
                                    <div style="position:absolute;display:block;background:url('<?php echo base_url() ?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                </div>
                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1024px;height: 500px;overflow:hidden;"> 
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                            $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>  

                                            <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                                                <?php if ($res_imgdata['sku'] != '') { ?>
                                                    <div>
                                                        <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" />
                                                    </div>
                                                <?php } ?>

                                                <?php if ($res_imgdata['URL'] != '') { ?>
                                                    <div>
                                                        <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                    </div>
                                                <?php } ?>

                                                <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>                             	
                                                    <div>
                                                        <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
                                                    </div>                              
                                                <?php } ?>

                                            <?php } // image for loop end    ?>
                                            <?php
                                        } // column for loop end
                                    }// column num_rows condition end
                                    ?>


                                    <!-- <a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>-->
                                    <a data-u="any" href="#" style="display:none">js slider</a>
                                </div>
                                <!-- Bullet Navigator -->
                                <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                                    <!-- bullet navigator item prototype -->
                                    <div data-u="prototype" style="width:16px;height:16px;"></div>
                                </div>
                                <!-- Arrow Navigator -->
                                <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
                            </div>
                            <script type="text/javascript">jssor_9_slider_init();</script>

                        <?php }  // section 5th condition end    ?> 


                        <!---------------------------------------------------section 5th condition end------------------------------------------------->


                        <!---------------------------------------------------section 6th condition start------------------------------------------------->
                        <?php if ($res_secdata['sec_type'] == 'Video' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1') {
                            ?>
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                            if ($qr_clmn->num_rows() > 0) {
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                    $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?>  

                                    <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                        <!-----------video------------->
                                        <div class="left-sidebar"> <h2><?= $res_secdata['sec_lbl'] ?></h2></div>
                                        <?php $url = str_replace('=', '', strrchr($res_imgdata['URL'], "=")); ?>
                                        <iframe style="padding:4px; margin-top:4px;" width="100%" height="200" src="https://www.youtube.com/embed/<?= $url ?>" frameborder="0" allowfullscreen></iframe>
                                        <!------------video--------------->	


                                    <?php } // image for loop end    ?>
                                    <?php
                                } // column for loop end
                            }// column num_rows condition end
                            ?>


                        <?php } // section 6th end  ?>
                        <!---------------------------------------------------section 6th condition end------------------------------------------------->


                        <!---------------------------------------------------section 7th condition start------------------------------------------------->

                        <?php if ($res_secdata['sec_type'] == 'Product' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                            ?>

                            <div class="left-sidebar"><h2><?= $res_secdata['sec_lbl'] ?></h2></div>
                            <div class="slider autoplay" style="width:100%; margin:auto;">


                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?>  

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
                                                    //$quantity=$rw->quantity;
                                                    ?>



                                                    <div class="multiple" style="border:1px solid #ccc;">

                                                        <?php
                                                        if ($rw['special_price'] != 0) {
                                                            if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                ?>                               
                                                                <div class="price"> <i class="fa fa-inr" aria-hidden="true"></i> <?= ceil($rw['special_price']) ?> </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($rw['special_price'] == 0 && $rw['price'] > 0) {
                                                            ?>                               
                                                            <div class="price"> <i class="fa fa-inr" aria-hidden="true"></i> <?= ceil($rw['price']) ?> </div>
                                                        <?php } ?>

                                                        <div class="view view-fifth">    
                                                            <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" >
                                                                <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img ?>"   class="wow flipInY grow"  alt="<?= $rw['name'] ?>">

                                                            </a>
                                                        </div>

                                                        <div class="wish-list"> 
                                                            <a class="link-wishlist wish_spn" onClick="" href="#"  data-toggle="tooltip" title="Add To Wishlist"  ><i class="fa fa-heart"></i></a>
                                                        </div>

                                                        <div class="best-slr-data">
                                                            <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>" title="wallet"><?php
                                                                if (strlen($rw['name']) > 20) {
                                                                    echo substr($rw['name'], 0, 20) . '...';
                                                                } else {
                                                                    echo $rw['name'];
                                                                }
                                                                ?></a> 
                                                            <!-- price calculation div start here --><br>
                                                            <div class="price-box">
                                                                <?php
                                                                if ($rw['special_price'] != 0) {
                                                                    if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                        ?>                               
                                                                        <span class="regular-price" style="color:#CCC; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?= $rw['mrp']; ?> </span><br>

                                                                        <span class="regular-price" style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?= $rw['price']; ?> </span><br>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                                <?php if ($rw['price'] != 0 && $rw['special_price'] == 0) { ?>
                                                                    <span class="regular-price" style="color:#CCC; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true"></i> <?= $rw['mrp']; ?> </span>
                                                                <?php } ?>
                                                                <?php if ($rw['price'] == 0 && $rw['special_price'] == 0) { ?>
                                                                    <span class="regular-price" > <i class="fa fa-inr" aria-hidden="true"></i> <?= $rw['mrp']; ?> </span>
                                                                <?php } ?>

                                                            </div>
                                                            <!-- price calculation div end here --></div>	

                                                    </div><!----jhfkjfdk-->


                                                    <?php
                                                } // product data loop end
                                            } // product num_rows() condition end 
                                            ?>


                                        <?php } // image for loop end   ?>
                                        <?php
                                    } // column for loop end
                                }// column num_rows condition end
                                ?>

                            </div>






                        <?php } // 7th section condition end   ?>

                        <!---------------------------------------------------section 7th condition end------------------------------------------------->

                        <!---------------------------------------------------section 8th condition start------------------------------------------------->

                        <?php if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '2' && $res_secdata['image_size'] == '600x259') {
                            ?>
                            <div class="clearfix"></div>  
                            <div style="background:#fff; height:80px; padding-top:4px;">

                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    $clmn_div = 1;
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?>  

                                        <!---------two banner------------->           

                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                                            <?php if ($res_imgdata['sku'] != '') { ?>  
                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"
                                                     <?php if ($clmn_div == 1) { ?>  style="float:left; width:50%; margin-right:1px;"<?php } else { ?>style="float:left; width:49.6%" <?php } ?> onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'">          
                                                 <?php } ?>

                                            <?php if ($res_imgdata['URL'] != '') { ?>                                                     
                                                <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  <?php if ($clmn_div == 1) { ?>  style="float:left; width:50%; margin-right:1px;"<?php } else { ?>style="float:left; width:49.6%" <?php } ?>>                            
                                            <?php } ?>

                                            <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>                                
                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  <?php if ($clmn_div == 1) { ?>  style="float:left; width:50%; margin-right:1px;"<?php } else { ?>style="float:left; width:49.6%" <?php } ?>>                   
                                            <?php } ?>

                                        <?php } // image for loop end  ?>

                                        <!---------two banner-------------->


                                        <?php
                                        $clmn_div++;
                                    } // column for loop end
                                }// column num_rows condition end
                                ?> 
                            </div>
                        <?php } // section 8 condition end  ?>


                        <!---------------------------------------------------section 8th condition end------------------------------------------------>



                        <!---------------------------------------------------feature box section 9th condition start------------------------------------------------>
                        <?php if ($res_secdata['sec_type'] == 'Featured Box' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '140x142') {
                            ?>
                            <div class="single-product">

                                <div class="single-product1">
                                <span class="fash_left"><h4><?= $res_secdata['sec_lbl'] ?></h4></span><!--<span class="fash_right" ><a href="#"><!--View More</a></span>-->
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                            $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>            

                                            <?php
                                            foreach ($qr_imginfo->result_array() as $res_imgdata) {

                                                $img_link = "#";
                                                if ($res_imgdata['URL'] != '') {
                                                    $img_link = $res_imgdata['URL'];
                                                }
                                                if ($res_imgdata['sku'] != '') {
                                                    $img_link = base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'];
                                                }
                                                ?>           
                                                <div class="inn-single">


                                                    <div  class="pro-1"><img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onClick="window.location.href = '<?php echo $img_link; ?>'"  /></div> 
                                                </div>
                                            <?php } // image for loop end   ?>
                                            <div style="clear:both"></div>
                                            <?php
                                        } // column for loop end
                                    }// column num_rows condition end
                                    ?> 

                                </div>

                            </div>
                        <?php } // section 9 condition end  ?>

                        <!---------------------------------------------------feature box section 9th condition end------------------------------------------------>

                        <!---------------------------------------------------Prodcts Vertical section 10th condition start----------------------------->
                        <?php if ($res_secdata['sec_type'] == 'Prodcts Vertical section' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                            ?>
                            <div class="fandt">	
                                <div class=" features">
                                    <?php /* ?><h3><?=$res_secdata['sec_lbl']?> <a href="#" class="btn btn-primary right"> More</a></h3><?php */ ?>
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                            $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>

                                            <?php foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                ?>
                                                <h3><?= $res_secdata['sec_lbl'] ?> <a href="<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>" class="btn btn-primary right"> More</a></h3>
                                                <?php
                                                $prod_skuarr = unserialize($res_imgdata['sku']);
                                                $prod_skuarr_modf = array();
                                                foreach ($prod_skuarr as $skuky => $skuval) {
                                                    $prod_skuarr_modf[] = "'" . $skuval . "'";
                                                }

                                                $prod_skustr = implode(',', $prod_skuarr_modf);


                                                $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid LIMIT 3 ");
                                                if ($query_prod->num_rows() > 0) {
                                                    foreach ($query_prod->result_array() as $rw) {
                                                        $cdate = date('Y-m-d');
                                                        $special_price_from_dt = $rw['special_pric_from_dt'];
                                                        $special_price_to_dt = $rw['special_pric_to_dt'];
                                                        $dsply_img = $rw['catelog_img_url'];
                                                        ?>                         

                                                        <div class="support">
                                                            <div class="today-deal-left">
                                                                <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                    <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img; ?>" />
                                                                </a>
                                                            </div>
                                                            <div class="today-deal-right">
                                                                <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href = '<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>'"><?= $rw['name'] ?></h4>
                                                                <p style="margin-left:0px;">
                                                                    <?php
                                                                    if ($rw['special_price'] != 0) {
                                                                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                            ?>                               
                                                                            <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['mrp']; ?> </span>
                                                                            &nbsp;&nbsp;

                                                                            <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['price']; ?> </span>&nbsp;&nbsp;
                                                                            <span style="color:#079107 !important;  font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= ceil($rw['special_price']) ?> </span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <?php if ($rw['price'] != 0 && $rw['special_price'] == 0) { ?>
                                                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= $rw['mrp']; ?> </span>
                                                                    <?php } ?>
                                                                    <?php if ($rw['price'] == 0 && $rw['special_price'] == 0) { ?>
                                                                        <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= $rw['mrp']; ?> </span>
                                                                    <?php } ?>
                                                                    &nbsp;&nbsp;


                                                                    <?php
                                                                    if ($rw['special_price'] == 0 && $rw['price'] > 0) {
                                                                        ?>                               
                                                                        <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= ceil($rw['price']) ?> </span>
                                                                    <?php } ?>

                                                                </p>
                                                            </div>

                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            <?php } // image for loop end    ?>

                                            <?php
                                        } // column for loop end
                                    }// column num_rows condition end
                                    ?> 
                                </div>

                                <div class="clearfix"></div>
                            </div> 

                        <?php } // section 10th condition end ?>

                        <!---------------------------------------------------Prodcts Vertical section 10th condition end------------------------------------------------>

                        <!---------------------------------------------------feature box section 11th condition start------------------------------------------------>
                        <?php if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '3' && $res_secdata['image_size'] == '245x168') {
                            ?>
                            <div class="left-sidebar"><h2><?= $res_secdata['sec_lbl'] ?> </h2></div>
                            <div style="height:85px; background:#fff;">
                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    $clmn_div = 1;
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?> 

                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>


                                            <?php if ($res_imgdata['sku'] != '') { ?> 
                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="margin-right:2px; padding:2px; border:1px solid #BBB; width:32.7%; float:left" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'">
                                            <?php } ?>

                                            <?php if ($res_imgdata['URL'] != '') { ?> 
                                                <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="margin-right:2px; padding:2px; border:1px solid #BBB; width:32.7%; float:left">
                                            <?php } ?>

                                            <?php if ($res_imgdata['sku'] == '' && $res_imgdata['URL'] == '') { ?>  
                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="margin-right:2px; padding:2px; border:1px solid #BBB; width:32.7%; float:left">
                                            <?php } ?>

                                        <?php } // image for loop end  ?>

                                        <?php
                                    } // column for loop end
                                }// column num_rows condition end
                                ?> 
                            </div>
                        <?php } // section 11th condition end  ?> 

                        <!---------------------------------------------------feature box section 11th condition end------------------------------------------------>  


                        <!---------------------------------------------------feature box section 12th condition start------------------------------------------------>
                        <?php if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && ($res_secdata['image_size'] == '1000x244' || $res_secdata['image_size'] == '600x259')) {
                            ?><div>
                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    $clmn_div = 1;
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00'))  ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?> 

                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>


                                            <?php if ($res_imgdata['sku'] != '') { ?>                                
                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="width: 100%;margin: 1px 0px;" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'">
                                            <?php } ?>

                                            <?php if ($res_imgdata['URL'] != '') { ?> 
                                                <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="width: 100%;margin: 1px 0px;">
                                            <?php } ?>

                                            <?php if ($res_imgdata['sku'] == '' && $res_imgdata['URL'] == '') { ?>  
                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="width: 100%;margin: 1px 0px;">
                                            <?php } ?>


                                        <?php } // image for loop end  ?>

                                        <?php
                                    } // column for loop end
                                }// column num_rows condition end
                                ?> 
                            </div>

                        <?php } // section 12th condition end  ?> 
                        <!---------------------------------------------------feature box section 12th condition end-------------------------------------------------->


                        <!---------------------------------------------------feature box section 13th condition start------------------------------------------------>
                        <?php if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '350x35') {
                            ?><div class="thin">
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                            if ($qr_clmn->num_rows() > 0) {
                                $clmn_div = 1;
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                    $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00'))  ORDER BY img_sqlid DESC  ");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?> 

                                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>


                                            <?php if ($res_imgdata['sku'] != '') { ?>                                
                                                <a href="#"><img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="width: 100%;margin: 1px 0px;" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" >
                                                </a>
                                            <?php } ?>

                                            <?php if ($res_imgdata['URL'] != '') { ?> 
                                                <a href="#"><img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="width: 100%;margin: 1px 0px;"></a>
                                            <?php } ?>

                                            <?php if ($res_imgdata['sku'] == '' && $res_imgdata['URL'] == '') { ?>  
                                                <a href="#"><img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="width: 100%;margin: 1px 0px;"></a>
                                            <?php } ?>


                                        <?php } // image for loop end   ?>

                                        <?php
                                    } // column for loop end
                                }// column num_rows condition end
                                ?> 
                            </div>

                        <?php } // section 12th condition end  ?> 
                        <!---------------------------------------------------feature box section 13th condition end-------------------------------------------------->

                        <!---------------------------------------------------New Arrival section 14th condition start----------------------------->
                        <?php if ($res_secdata['sec_type'] == 'New Arrivals' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                            ?>
                            <hr>
                            <div class="fandt">	
                                <div class=" features">
                                    <h3><?= $res_secdata['sec_lbl'] ?> <!--<a href="#" class="btn btn-primary right"> More</a>--></h3>
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                            $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>

                                            <?php
                                            foreach ($qr_imginfo->result_array() as $res_imgdata) {


                                                $query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY lvl2 ORDER BY `prod_search_sqlid` DESC LIMIT 10  ");
                                                if ($query_prod->num_rows() > 0) {
                                                    foreach ($query_prod->result_array() as $rw) {
                                                        $cdate = date('Y-m-d');
                                                        $special_price_from_dt = $rw['special_pric_from_dt'];
                                                        $special_price_to_dt = $rw['special_pric_to_dt'];
                                                        $dsply_img = $rw['catelog_img_url'];
                                                        ?>                         

                                                        <div class="support">                   

                                                            <div class="today-deal-left">
                                                                <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                    <img  src="<?php echo base_url() . 'images/product_img/' . $dsply_img; ?>" >
                                                                </a>
                                                            </div>


                                                            <div class="today-deal-right">

                                                                <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href = '<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>'"><?= $rw['name'] ?></h4>
                                                                <p style="padding:10px;">
                                                                    <?php
                                                                    if ($rw['special_price'] != 0) {
                                                                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                            ?>                               
                                                                            <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['mrp']; ?> </span>
                                                                            &nbsp;&nbsp;

                                                                            <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['price']; ?> </span>&nbsp;&nbsp;
                                                                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= ceil($rw['special_price']) ?> </span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <?php if ($rw['price'] != 0 && $rw['special_price'] == 0) { ?>
                                                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= $rw['mrp']; ?> </span>
                                                                    <?php } ?>
                                                                    <?php if ($rw['price'] == 0 && $rw['special_price'] == 0) { ?>
                                                                        <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= $rw['mrp']; ?> </span>
                                                                    <?php } ?>
                                                                    &nbsp;&nbsp;


                                                                    <?php
                                                                    if ($rw['special_price'] == 0 && $rw['price'] > 0) {
                                                                        ?>                               
                                                                        <span style="color:#079107!important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= ceil($rw['price']) ?> </span>
                                                                    <?php } ?>

                                                                </p>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            <?php } // image for loop end   ?>

                                            <?php
                                        } // column for loop end
                                    }// column num_rows condition end
                                    ?> 
                                </div>

                                <div class="clearfix"></div>
                            </div> 

                        <?php } // section 10th condition end   ?>

                        <!---------------------------------------------------New Arrival section 14th condition end------------------------------------------------>



                        <!---------------------------------------------------Trending Products 15th condition start----------------------------->
                        <?php if ($res_secdata['sec_type'] == 'Trending Products' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                            ?>
                            <hr>
                            <div class="fandt">	
                                <div class=" features">
                                    <h3><?= $res_secdata['sec_lbl'] ?> <!--<a href="#" class="btn btn-primary right"> More</a>--></h3>
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                    if ($qr_clmn->num_rows() > 0) {
                                        foreach ($qr_clmn->result_array() as $res_clmn) {
                                            $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                            $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                            $image_count = $qr_imginfo->num_rows();
                                            ?>

                                            <?php
                                            foreach ($qr_imginfo->result_array() as $res_imgdata) {


                                                /* $query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active' AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY lvl2 ORDER BY `prod_search_sqlid` DESC LIMIT 10  "); */

                                                $pord_viewqr = $this->db->query("SELECT sku FROM product_viewcount GROUP BY sku ORDER BY prodview_count desc LIMIT 5");
                                                $pordviewctr = array();

                                                foreach ($pord_viewqr->result_array() as $res_prodview) {
                                                    $pordviewctr[] = "'" . $res_prodview['sku'] . "'";
                                                }
                                                $pordviewctr_string = implode(',', $pordviewctr);

                                                if ($pord_viewqr->num_rows() > 0) {
                                                    $query_prod = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND sku IN ($pordviewctr_string) GROUP BY sku   ");
                                                } else {

                                                    $query_prod = $this->db->query("SELECT product_id,name,sku,price,special_price,special_pric_from_dt,special_pric_to_dt,mrp,imag as catelog_img_url,quantity FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) GROUP BY sku ORDER BY cronprod_viewcount desc LIMIT 5  ");
                                                }


                                                if ($query_prod->num_rows() > 0) {
                                                    foreach ($query_prod->result_array() as $rw) {
                                                        $cdate = date('Y-m-d');
                                                        $special_price_from_dt = $rw['special_pric_from_dt'];
                                                        $special_price_to_dt = $rw['special_pric_to_dt'];
                                                        $dsply_img = $rw['catelog_img_url'];
                                                        ?>                         

                                                        <div class="support">
                                                            <div class="today-deal-left">
                                                                <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                    <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img; ?>"  >
                                                                </a>
                                                            </div>
                                                            <div class="today-deal-right">

                                                                <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href = '<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>'"><?= $rw['name'] ?></h4>
                                                                <p style="padding:10px;">
                                                                    <?php
                                                                    if ($rw['special_price'] != 0) {
                                                                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                            ?>                               
                                                                            <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['mrp']; ?> </span>
                                                                            &nbsp;&nbsp;

                                                                            <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['price']; ?> </span>&nbsp;&nbsp;
                                                                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= ceil($rw['special_price']) ?> </span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <?php if ($rw['price'] != 0 && $rw['special_price'] == 0) { ?>
                                                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= $rw['mrp']; ?> </span>
                                                                    <?php } ?>
                                                                    <?php if ($rw['price'] == 0 && $rw['special_price'] == 0) { ?>
                                                                        <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= $rw['mrp']; ?> </span>
                                                                    <?php } ?>
                                                                    &nbsp;&nbsp;


                                                                    <?php
                                                                    if ($rw['special_price'] == 0 && $rw['price'] > 0) {
                                                                        ?>                               
                                                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                            <?= ceil($rw['price']) ?> </span>
                                                                    <?php } ?>

                                                                </p>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            <?php } // image for loop end    ?>

                                            <?php
                                        } // column for loop end
                                    }// column num_rows condition end
                                    ?> 
                                </div>

                                <div class="clearfix"></div>
                            </div> 

                        <?php } // section 15th condition end   ?>

                        <!---------------------------------------------------Trending Products section 15th condition end--------------------------------->


                        <!---------------------------------------------------Recently viewed Items section 14th condition start----------------------------->

                        <?php
                        $prod_skustr = get_cookie('prodid', TRUE);
                        if ($prod_skustr != '') {
                            if ($res_secdata['sec_type'] == 'Recently Viewed Items' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                                ?>
                                <hr>
                                <div class="fandt">	
                                    <div class=" features">
                                        <h3><?= $res_secdata['sec_lbl'] ?> <!--<a href="#" class="btn btn-primary right"> More</a>--></h3>
                                        <?php
                                        $sec_id = $res_secdata['Sec_id'];
                                        $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                        if ($qr_clmn->num_rows() > 0) {
                                            foreach ($qr_clmn->result_array() as $res_clmn) {
                                                $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                                $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                $image_count = $qr_imginfo->num_rows();
                                                ?>

                                                <?php
                                                foreach ($qr_imginfo->result_array() as $res_imgdata) {

                                                    $modf_prod_skustr = implode(',', array_unique(explode(',', $prod_skustr)));
                                                    $query_prod = $this->db->query("SELECT * , imag as catelog_img_url FROM cornjob_productsearch WHERE prod_status='Active'  AND seller_status='Active' AND status='Enabled' AND (quantity > 0) AND product_id IN ($modf_prod_skustr) GROUP BY product_id LIMIT 5  ");
                                                    if ($query_prod->num_rows() > 0) {
                                                        foreach ($query_prod->result_array() as $rw) {
                                                            $cdate = date('Y-m-d');
                                                            $special_price_from_dt = $rw['special_pric_from_dt'];
                                                            $special_price_to_dt = $rw['special_pric_to_dt'];
                                                            $dsply_img = $rw['catelog_img_url'];
                                                            ?>                         

                                                            <div class="support">
                                                                <div class="today-deal-left">
                                                                    <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">  
                                                                        <img src="<?php echo base_url() . 'images/product_img/' . $dsply_img; ?>" >
                                                                    </a>
                                                                </div>
                                                                <div class="today-deal-right">

                                                                    <h4 style="text-align:left; margin-left:0; font-family: 'SegoeUI';" onclick="window.location.href = '<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>'"><?= $rw['name'] ?></h4>
                                                                    <p style="padding:10px;">
                                                                        <?php
                                                                        if ($rw['special_price'] != 0) {
                                                                            if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                                ?>                               
                                                                                <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                    <?= $rw['mrp']; ?> </span>
                                                                                &nbsp;&nbsp;

                                                                                <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                    <?= $rw['price']; ?> </span>&nbsp;&nbsp;
                                                                                <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                    <?= ceil($rw['special_price']) ?> </span>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>

                                                                        <?php if ($rw['price'] != 0 && $rw['special_price'] == 0) { ?>
                                                                            <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['mrp']; ?> </span>
                                                                        <?php } ?>
                                                                        <?php if ($rw['price'] == 0 && $rw['special_price'] == 0) { ?>
                                                                            <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= $rw['mrp']; ?> </span>
                                                                        <?php } ?>
                                                                        &nbsp;&nbsp;


                                                                        <?php
                                                                        if ($rw['special_price'] == 0 && $rw['price'] > 0) {
                                                                            ?>                               
                                                                            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                                                <?= ceil($rw['price']) ?> </span>
                                                                        <?php } ?>

                                                                    </p>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>

                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                <?php } // image for loop end   ?>

                                                <?php
                                            } // column for loop end
                                        }// column num_rows condition end
                                        ?> 
                                    </div>

                                    <div class="clearfix"></div>
                                </div> 

                                <?php
                            } // section 16th condition end 
                        } //cookie condition check end
                        ?>


                        <!----------------------------------------------- 2column Banner Start------------------------------------------------->
                        <?php if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '2' && $res_secdata['image_size'] == '208x300') {
                            ?>
                            <div style="background:#fff; height:95px;">
                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='3' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    $clmn_div = 1;
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?> 

                                        <?php
                                        $img_arr = array();
                                        $img_arr_ctr = 0;
                                        foreach ($qr_imginfo->result_array() as $res_imgdataarr) {
                                            $img_arr[] = $res_imgdataarr['imge_nm'];
                                        }
                                        $img_arrnew = array();
                                        foreach ($img_arr as $ky_img => $vl_img) {
                                            if ($ky_img + 1 == $img_arr_ctr || $ky_img == 0) {
                                                $img_arrnew[] = $img_arr[$ky_img];
                                            }
                                            $img_arr_ctr++;
                                        }


                                        foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                            ?>


                                            <?php if ($res_imgdata['sku'] != '') { ?> 


                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" 
                                                <?php
                                                if (in_array($res_imgdata['imge_nm'], $img_arrnew)) {
                                                    echo "style='float:left; width:49%; margin-right:4px;'";
                                                } else {
                                                    echo "style='float:left; width:49%'";
                                                }
                                                ?>  
                                                     onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'">


                                                                                                                                                                                                <!-- <img src="images/left-banner.jpg"  style="float:left; width:49%; margin-right:4px;">
                                                                                                                                                                                                 <img src="images/right.jpg"  style="float:left; width:49%">-->

                                            <?php } ?>

                                            <?php if ($res_imgdata['URL'] != '') { ?> 
                                                <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" 
                                                     src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" 
                                                     <?php
                                                     if (in_array($res_imgdata['imge_nm'], $img_arrnew)) {
                                                         echo "style='float:left; width:49%; margin-right:4px;'";
                                                     } else {
                                                         echo "style='float:left; width:49%'";
                                                     }
                                                     ?>  >
                                                 <?php } ?>

                                            <?php if ($res_imgdata['sku'] == '' && $res_imgdata['URL'] == '') { ?>  
                                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" 
                                                <?php
                                                if (in_array($res_imgdata['imge_nm'], $img_arrnew)) {
                                                    echo "style='float:left; width:49%; margin-right:4px;'";
                                                } else {
                                                    echo "style='float:left; width:49%'";
                                                }
                                                ?>  >
                                                 <?php } ?>

                                        <?php } // image for loop end  ?>

                                        <?php
                                    } // column for loop end
                                }// column num_rows condition end
                                ?> 
                            </div>
                        <?php } // section 11th condition end   ?> 



                        <!------------------------------------------Product Catalog Start ------------------------------------------>

                        <?php /* ?>  <div id="menu2">
                          <?php if($res_secdata['sec_type']=='Product Catalog'  && $res_secdata['sec_type_data']=='Product' )
                          {} ?>
                          </div><?php */ ?>
                        <!-------------------------------------------Product Second Catalog Start--------------------------------------------->

                        <?php
                    } // main foreach end 
                } // section  num_rows condition end
            }

            $this->db->cache_on();
            ?> 

            <!---------------------------------------Product Catalog start----------------------------------------------> 

            <h3 class="tittle">View Products</h3>
            <div align="right" style="margin-right:19px; margin-bottom:10px;">
                <a class="button" data-rel="#content-a" id="act1"  href="#" onclick="menuvisibility('menu2');">
                    <i class="fa fa-th-large" aria-hidden="true"></i>
                </a>&nbsp;&nbsp;
                <a class="button" data-rel="#content-a" id="act2" href="#" onclick="menuvisibility('menu1');">
                    <i class="fa fa-list" aria-hidden="true"></i>
                </a>
            </div>
            <div id="menu1" style="display:none;">
                <div class="singleproducts-row">
                    <?php
                    if ($product_data != false) {
                        $row = $product_data->num_rows();
                        $sl = 0;
                        //print_r($row);exit;
                        if ($row > 0) {
                            foreach ($product_data->result_array() as $rw) {
                                $sl++;
                                $cdate = date('Y-m-d');
                                $special_price_from_dt = $rw['special_pric_from_dt'];
                                $special_price_to_dt = $rw['special_pric_to_dt'];

                                $dsply_img = $rw['catelog_img_url'];
                                $image_arr = explode(',', $rw['catelog_img_url']);
                                //$taxdecimal = $rw->tax_rate_percentage/100;
                                //tax amount for product price
                                //$tax_amount = $rw->price*$taxdecimal;
                                //tax amount for product special price
                                //$tax_amount_special = $rw->special_price*$taxdecimal;
                                $quantity = $rw['quantity'];
                                ?>
                                <div class="pad-res singleproduct-grids">
                                    <div class="today-deal-left">
                                        <?php if (empty($dsply_img)) { ?>
                                            <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $rw['name']; ?>"/>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                <img src="<?php echo base_url(); ?>images/product_img/<?= $image_arr[0]; ?>" alt="<?= $rw['name']; ?>"/>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div class="today-deal-right">
                                        <h5 style="text-align:left; margin-left:0; margin-bottom:8px; font-size:18px; font-family: 'SegoeUI';">
                                            <a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>"><?php
                                                if (strlen($rw['name']) > 30) {
                                                    echo substr($rw['name'], 0, 30) . '...';
                                                } else {
                                                    echo $rw['name'];
                                                }
                                                ?>
                                            </a>
                                        </h5>
                                        <p style="margin-left:0px; float:left; display:inline-block;">
                                            <?php
                                            $cur_splprc = 0;
                                            if ($rw['special_price'] != 0) {
                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                    $cur_splprc = $rw['special_price'];
                                                    ?>
                                                    <span style="color:#999; text-decoration:line-through">
                                                        <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                        </i>&nbsp; <?= $rw['mrp']; ?>
                                                    </span>&nbsp;&nbsp;
                                                    <span style="color:#F90;text-decoration:line-through">
                                                        <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                        </i>&nbsp; <?= $rw['price']; ?>
                                                    </span>&nbsp;&nbsp;
                                                    <span style="color:#079107 !important;  font-weight:bold;">
                                                        <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                        </i>&nbsp; <?= ceil($rw['special_price']) ?>
                                                    </span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php if ($rw['price'] != 0 && $cur_splprc == 0) { ?>
                                                <span style="color:#999; text-decoration:line-through">
                                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                    </i>&nbsp; <?= $rw['mrp']; ?>
                                                </span>&nbsp;&nbsp;
                                            <?php } ?>
                                            <?php if ($rw['price'] == 0 && $cur_splprc == 0) { ?>
                                                <span style="color:#079107 !important;  font-weight:bold;">
                                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                    </i>&nbsp; <?= $rw['mrp']; ?>
                                                </span>
                                            <?php } ?>
                                            <?php if ($cur_splprc == 0 && $rw['price'] > 0) { ?>
                                                <span style="color:#079107 !important;  font-weight:bold;">
                                                    <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
                                                    </i>&nbsp; <?= ceil($rw['price']) ?>
                                                </span>
                                            <?php } ?>
                                            <?php
                                            $cur_prodprice = 0;
                                            $cursplprc_foroff = 0;
                                            if ($rw['special_price'] != 0) {
                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                    $cur_prodprice = $rw['special_price'];
                                                    $cursplprc_foroff = $rw['special_price'];
                                                }
                                            }
                                            if ($rw['price'] != 0 && $rw['special_price'] == 0) {
                                                $cur_prodprice = $rw['price'];
                                            }

                                            if ($rw['price'] == 0 && $cursplprc_foroff == 0) {
                                                $cur_prodprice = $rw['mrp'];
                                            }

                                            $percen_curprc = ((100 / $rw['mrp']) * $cur_prodprice);

                                            $percen_off = 100 - round($percen_curprc);
                                            ?>
                                            <span style="display:inline-block;">
                                                <?php if ($percen_off > 0) { ?>
                                                    <div class="discount">
                                                        <p> <?= $percen_off ?>% off </p>
                                                    </div>
                                                <?php } ?>
                                            </span>
                                        </p>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <br>
                <div id="view_more_secnd_dv" align="center">
                    <img src="<?php echo base_url(); ?>images/loader.gif" id="lodr_sec_img" style="display:none;" width="24px" />
                    <?php if ($no_of_product > $sl) { ?>
                        <input style="display:none;" type="button" class="btn-sign-in" id="sec_viewmore_prodbtnid"  value="View more" name="button" onClick="ShowMoreSingleData('<?= $no_of_product; ?>', '<?= $catgstr_urlpass ?>', '<?php
                        if ($this->uri->segment(4) != '') {
                            echo $this->uri->segment(4);
                        } else {
                            echo 'NOT';
                        }
                        ?>')">
                        <input type="hidden" name="scrol_secmenu_tracktxtbox" id="scrol_secmenu_tracktxtbox" value="wait to scroll" />
                    <?php } ?>
                </div>
            </div>

            <div id="menu2">
                <div class="products" style="padding:0px;">	 
                    <div class="container">
                        <div class="col-md-12 product-w3ls-right">			
                            <div class="products-row" id="prod_rwdiv">
                                <?php
                                if ($product_data != false) {
                                    $row = $product_data->num_rows();
                                    $sl = 0;
                                    //print_r($row);exit;
                                    if ($row > 0) {
                                        foreach ($product_data->result_array() as $rw) {
                                            $sl++;
                                            $cdate = date('Y-m-d');
                                            $special_price_from_dt = $rw['special_pric_from_dt'];
                                            $special_price_to_dt = $rw['special_pric_to_dt'];

                                            $dsply_img = $rw['catelog_img_url'];
                                            $image_arr = explode(',', $rw['catelog_img_url']);
                                            //$taxdecimal = $rw->tax_rate_percentage/100;
                                            //tax amount for product price
                                            //$tax_amount = $rw->price*$taxdecimal;
                                            //tax amount for product special price
                                            //$tax_amount_special = $rw->special_price*$taxdecimal;
                                            $quantity = $rw['quantity'];
                                            ?>

                                            <div class="col-md-3 product-grids"> 
                                                <div class="agile-products" style="max-height: 350px; min-height: 250px; padding:5px;">
                                                    <?php
                                                    $cur_prodprice = 0;
                                                    $cursplprc_foroff = 0;
                                                    if ($rw['special_price'] != 0) {
                                                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                            $cur_prodprice = $rw['special_price'];
                                                            $cursplprc_foroff = $rw['special_price'];
                                                        }
                                                    }
                                                    if ($rw['price'] != 0 && $rw['special_price'] == 0) {
                                                        $cur_prodprice = $rw['price'];
                                                    }

                                                    if ($rw['price'] == 0 && $cursplprc_foroff == 0) {
                                                        $cur_prodprice = $rw['mrp'];
                                                    }

                                                    $percen_curprc = ((100 / $rw['mrp']) * $cur_prodprice);

                                                    $percen_off = 100 - round($percen_curprc);

                                                    $cur_splprc = 0;
                                                    ?>                            
                                                    <?php if ($percen_off > 0) { ?> 
                                                        <div class="new-tag">
                                                            <!--<h6>20%<br>Off</h6>-->                           
                                                            <h6><?= $percen_off ?>%<br>Off</h6>                            
                                                        </div>
                                                    <?php } ?>


                                                    <div style="margin:auto; width:100%; text-align:center; ">
                                                        <?php if (empty($dsply_img)) { ?>
                                                            <a style="margin:auto; text-align:center;" 
                                                               href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                <img style="height: 112px; max-width: 100%; margin: auto;text-align: center;" src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png"  alt="<?= $rw['name']; ?>"></a>
                                                        <?php } else { ?>
                                                            <a style="margin:auto; text-align:center;" 
                                                               href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                <img style="height: 112px;max-width: 100%;margin: auto;text-align: center;" src="<?php echo base_url(); ?>images/product_img/<?= $image_arr[0]; ?>" onerror="imgError(this);"  alt="<?= $rw['name']; ?>">
                                                            </a>                       
                                                        <?php } ?>
                                                    </div>
                                                    <div class="agile-product-text" >              
                                                        <h5 style="text-align:left; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;"><a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                <?php
                                                                if (strlen($rw['name']) > 30) {
                                                                    echo substr($rw['name'], 0, 30) . '...';
                                                                } else {
                                                                    echo $rw['name'];
                                                                }
                                                                ?>
                                                            </a></h5> 
                                                        <!--<h6><del>$200</del> $100</h6>-->

                                                        <!-----------------------------------Produc price start---------------------------->

                                                        <?php
                                                        if ($rw['special_price'] != 0) {
                                                            if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                $cur_splprc = $rw['special_price'];
                                                                ?> 
                                                                <!--<div class="a-row">
                                                                    <span class="a-size-medium a-color-price a-text-bold">₹6,555</span>
                                                                    <span class="a-letter-space"></span>
                                                                    <span class="a-size-mini a-color-secondary a-text-strike">₹8,8052</span>
                                                                    <span class="a-letter-space"></span>
                                                                    <span class="a-size-mini a-color-price">Save</span>
                                                                    <span class="a-letter-space"></span>
                                                                    <span class="a-size-mini a-color-price">₹2,310</span>
                                                               </div>-->                                                                 
                                                                <span style="color:#999; text-decoration:line-through;margin-right: 10px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i> &nbsp;<?= $rw['mrp']; ?> </span>
                                                                <span style="color:#F90;text-decoration:line-through;margin-right: 10px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i> &nbsp;<?= $rw['price']; ?> </span>
                                                                <span style="color:#079107 !important; margin-right: 10px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i> &nbsp;<?= ceil($rw['special_price']) ?> </span>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <?php if ($rw['price'] != 0 && $cur_splprc == 0) { ?>
                                                            <span style="color:#999; text-decoration:line-through;margin-right: 10px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i> &nbsp;<?= $rw['mrp']; ?> </span>
                                                        <?php } ?>
                                                        <?php if ($rw['price'] == 0 && $cur_splprc == 0) { ?>
                                                            <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i> &nbsp;<?= $rw['mrp']; ?> </span>
                                                        <?php } ?>

                                                        <?php
                                                        if ($rw['special_price'] == 0 && $rw['price'] > 0) {
                                                            ?>                               
                                                            <span style="color:#079107 !important; margin-right: 10px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i> &nbsp;<?= ceil($rw['price']) ?> </span>
                                                        <?php } ?>
                                                        <!-----------------------------------Product Price End----------------------------->

                                                        <!--	<form action="#" method="post">-->
                                                                        <!--<input type="hidden" name="cmd" value="_cart" />
                                                                        <input type="hidden" name="add" value="1" /> 
                                                                        <input type="hidden" name="w3ls_item" value="Audio speaker" /> 
                                                                        <input type="hidden" name="amount" value="100.00" /> -->
                                                        <?php /* ?><button type="addtocart_prod"  class="w3ls-cart pw3ls-cart" onclick="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                                                          <i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button><?php */ ?>
                                                        <!--</form> -->

                                                    </div>
                                                </div> 
                                            </div>

                                            <?php
                                        }
                                    }
                                }
                                ?>    
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <!--<div  class="col-md-3 product-grids">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> Previous</button>
                   </div>
          <div  class="col-md-8 product-grids" align="right">
               <button type="submit" class="btn btn-primary">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
          </div>-->
                    </div>
                </div>
                <br>
                <div id="view_more_dv" align="center">
                    <img src="<?php echo base_url(); ?>images/loader.gif" id="lodr_img" style="display:none;" width="24px" />
                    <?php if ($no_of_product > $sl) { ?>
                        <input style="display:none;" type="button" class="btn-sign-in" id="viewmore_prodbtnid"  value="View more" name="button" onClick="ShowMoreData('<?= $no_of_product; ?>', '<?= $catgstr_urlpass ?>', '<?php
                        if ($this->uri->segment(4) != '') {
                            echo $this->uri->segment(4);
                        } else {
                            echo 'NOT';
                        }
                        ?>')">
                        <input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
                    <?php } ?>
                </div>
            </div>
            <!---------------------------------------Product Catalog end------------------------------------------------->  




            <!------------------------------------------Product Catalog Start ------------------------------------------>



            <!-- #endregion Jssor Slider End -->  




            <div class="clearfix"></div>
            <!------------------------------footer start-------------------------------->
            <style>.carousel-control {
                    padding-top:6%;
                    width:5%;
                }
                .thumbnail {
                    display: inline-block!important;
                    padding: 4px;
                    margin-bottom: 4px;
                    line-height:1;

                    border: none;
                    border-radius: 4px;
                    -webkit-transition: border .2s ease-in-out;
                    -o-transition: border .2s ease-in-out;
                    transition: border .2s ease-in-out;
                    float: left;
                    width: 25%!important;
                    color: #000 !important;
                    font-weight: normal;
                    font-size:12px;
                    text-align:center;
                }
                .carousel-control.right {
                    background-image: none!important;
                }
                .carousel-control.left {
                    background-image: none!important;
                }
                .well {
                    padding: 0px!important;
                    margin-bottom:0px!important;

                }
            </style>  
            <script>
                $(document).ready(function () {
                    $('#myCarousel').carousel({
                        interval: 10000
                    })

                    $('#myCarousel').on('slid.bs.carousel', function () {
                        //alert("slid");
                    });


                });
                $(window).load(function () {
                    //alert("hii");
                    $("#act1").addClass('act');
                });
            </script>

            <footer class="site-footer">
                <div class="container-fluid">
                    <?php
                    $qr = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='3' AND page_name='catalog' AND Status='active' AND sec_type='Rich Text Editor' ");
                    $arr_meniid = array();
                    if ($qr->num_rows() > 0) {
                        foreach ($qr->result_array() as $res_secdata) {
                            $arr_meniid = array();
                            $arr_meniid = unserialize($res_secdata['menu_id']);
                            if (in_array($mobilelbl_menu_id, $arr_meniid)) {
                                ?>

                                <strong><b><?= $res_secdata['sec_lbl'] ?> :</b></strong>
                                </br>
                                <p style="text-align:justify;"><?= $res_secdata['sec_descrp'] ?></p>

                                <?php
                            }
                        }
                    }
                    ?>
                </div>        
                <div class="clearfix"> </div>
                <br>


                <!--------------------------------------------------------------Section Info End------------------------------------------->



                </div>
                </div>

                <br>
                <div style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;margin:auto!important; padding:10px">
                    <p>
                        <?php echo stripslashes(@$single_desc->catg_description); ?>
                    </p></div>      
        </div>

        <?php include "footer.php"; ?>      
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.js"></script>

        <script>
                var lastScrollTop = 0;
                $(window).scroll(function (event) {
                    var st = $(this).scrollTop();
                    if (st > lastScrollTop)
                    {

                        if ($('#view_more_dv').visible(true) && $('#scrol_tracktxtbox').val() != '')
                        {
                            $('#viewmore_prodbtnid')[0].click();
                            $('#scrol_tracktxtbox').val('');
                            //alert('test'); 
                        }



                    } else {
                        // upscroll code
                    }
                    lastScrollTop = st;

                });


        </script>   
        <script>
            var lastScrollTop1 = 0;
            $(window).scroll(function (event) {
                var st1 = $(this).scrollTop();
                if (st1 > lastScrollTop1)
                {
                    if ($('#view_more_secnd_dv').visible(true) && $('#scrol_secmenu_tracktxtbox').val() != '')
                    {
                        $('#sec_viewmore_prodbtnid')[0].click();
                        $('#scrol_secmenu_tracktxtbox').val('');
                        //alert('test'); 
                    }
                } else {
                    // upscroll code
                }
                lastScrollTop1 = st1;
            });
        </script>