<?php include 'header.php';
$this->db->cache_on();
?>
<meta name="Description" content="<?php echo $data1->meta_description; ?>">
<meta name="Keywords" content="<?php echo $data1->meta_keywords; ?>"/>

<meta name="author" content="">
<title><?php echo $data1->page_title; ?></title>
<link rel="canonical" href="<?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2); ?>"/>
<!-------------------------------------category extra header code start-------------------------->

<script src="<?php echo base_url() ?>mobile_css_js/new/js/jquery.tinycarousel.js"></script>

<script>
    $(document).ready(function () {
        var mySelect = $('#first-disabled2');

        $('#special').on('click', function () {
            mySelect.find('option:selected').prop('disabled', true);
            mySelect.selectpicker('refresh');
        });

        $('#special2').on('click', function () {
            mySelect.find('option:disabled').prop('disabled', false);
            mySelect.selectpicker('refresh');
        });

        $('#basic2').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });
    });
</script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
<!--<script src="<?php //echo base_url()  ?>mobile_css_js/new/js/jquery-1.11.1.min.js"></script>-->
<script src="<?php echo base_url() ?>mobile_css_js/new/js/js/jquery.tinycarousel.js"></script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#slider1').tinycarousel();
    });
</script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#slider01').tinycarousel();
    });
</script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#slider4').tinycarousel({interval: true});
        $('#slider2').tinycarousel();
        $('#slider3').tinycarousel({interval: true});
    });

</script>

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
        height: 175px;
        width: 46%;
        float: left;
        border: 1px solid #f5f5f5;
        margin: 5px;
    }
    .panel-body ul li a {
        margin-top: 0px; 
        width: 100%;
        margin-left:0;
        padding-top: 5px;
    }
    .panel-body ul {
        width: 100%;
    }
    .ad-info h5 {
        text-align: center;
        line-height: 16px;
        width:100%;
        overflow:visible;
    }
    .product-sl-image-held img {
        max-width: 100%;
        /*    height: auto;
        */    max-height: 112px;
    }
    @media only screen and (width:375px) and (height:667px){ 
        .product-sl-image-held img {
            max-width: 100%;
            height: 120px;
            max-height: 120px;
        }
    }
</style>        

<script>

    $(window).load(function () {
        $(document).ready(function () {
            $('#catg_link')[0].click();
        });
    });

</script>   



<!-------------------------------------category extra header code end----------------------------->
<div class="wrap">
<?php if ($product_image->num_rows() > 0) { ?>
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="left-sidebar">
                        <h2>Category</h2>

                        <div class="panel-group category-products" id="accordian">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-target="#mens">
                                                <!--<span class="badge pull-right"><i onclick="myFunction(this)" class="fa fa-plus"></i></span>-->
                                            Category
                                        </a>
                                    </h4>
                                </div>
                                <div id="mens" class="collapse in">
                                    <div class="panel-body">

                                        <ul>
                                            <?php
                                            $catg_urlsegmnt = $this->uri->segment(2);
                                            $qr_lblid = $this->db->query("SELECT dskmenu_lbl_id FROM category_menu_mobile WHERE url_displayname='$catg_urlsegmnt' ");
                                            $menusql_ldlid = $qr_lblid->row()->dskmenu_lbl_id;

                                            foreach ($product_image->result() as $rw) {  //$image_arr=explode(',',$rw->catelog_img_url); 
                                                $dsply_img = $rw->imag;
                                                $catgIdmenu = $rw->category_id;
                                                $qr_dispurl = $this->db->query("SELECT distinct url_displayname,label_name FROM category_menu_mobile WHERE (category_id='$catgIdmenu' OR category_id LIKE '$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu,%' OR category_id LIKE '%,$catgIdmenu' ) AND parent_id='$menusql_ldlid' ");

                                                $url_disp = $qr_dispurl->row()->url_displayname;
                                                ?>


                                                <li>
                                                    <div class="product-sl-image-held">
                                                        <a href="<?php echo base_url() . $url_disp ?>">
                                                            <?php /* ?><a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rw->category_name)))))  ?> "><?php */ ?>
                                                            <?php if (empty($dsply_img)) { ?>
                                                                <img src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" >
        <?php } else { ?>
                                                                <img src="<?php echo base_url(); ?>images/product_img/<?= $rw->imag; ?>" >                                          

        <?php } ?>
                                                        </a>   
                                                    </div>
        <?php /* ?> <a href="<?php echo base_url().preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rw->category_name)))))  ?> "><?php */ ?>
                                                    <a href="<?php echo base_url() . $url_disp ?>">
                                                        <div class="ad-info">
                                                            <h5><?= $qr_dispurl->row()->label_name; ?></h5>
                                                        </div>
                                                    </a> 
                                                </li>	 									

    <?php } ?> </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    <?php } ?>
    <?php
    $this->db->cache_off();
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
                                    $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
            <?php if ($image_all_count > 4) { ?>
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
              $qr_clmn=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
              if($qr_clmn->num_rows()>0)
              {
              foreach($qr_clmn->result_array() as $res_clmn)
              {
              $clmn_sqlid=$res_clmn['clmn_sqlid'];

              $qr_imginfo=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
              $image_count=$qr_imginfo->num_rows();
              ?>
              <div id="slider1">
              <a class="buttons prev" href="#">&#60;</a>
              <div class="viewport">
              <ul class="overview">
              <?php if($qr_imginfo->num_rows()>0)
              { foreach($qr_imginfo->result_array() as $res_imgdata){
              ?>
              <?php if($res_imgdata['sku']!=''){ ?>
              <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>"/></li>
              <?php } ?>
              <?php if($res_imgdata['URL']!=''){ ?>
              <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" onClick="window.location.href='<?php echo $res_imgdata['URL']; ?>'"/></li>
              <?php } ?>
              <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){ ?>
              <li><img src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'];?>" /></li>
              <?php } ?>
              <?php } } ?>
              </ul>
              </div>
              <a class="buttons next" href="#">&#62;</a>
              </div>
              <?php } } }?><?php */ ?>

            <!---------------------------------------------------section 1st condition end--------------------------------------------->

            <!---------------------------------------------------section 2nd condition start--------------------------------------------->
            <?php if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '600x259') {
                ?> 
                <?php
                $sec_id = $res_secdata['Sec_id'];
                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                if ($qr_clmn->num_rows() > 0) {
                    foreach ($qr_clmn->result_array() as $res_clmn) {
                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                        $image_count = $qr_imginfo->num_rows();
                        ?>
                        <div class="left-sidebar"><h2><?= $res_secdata['sec_lbl'] ?></h2></div>
                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                            <?php if ($res_imgdata['sku'] != '') { ?>  
                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"">
                            <?php } ?>

                            <?php if ($res_imgdata['URL'] != '') { ?>                                                     
                                <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"><?php } ?>                            
                        <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>                                
                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  style="margin-bottom:6px; padding:3px; border:1px solid #BBB; width:100%"><?php } ?>

                        <?php } ?>

                    <?php
                    }
                }
            }
            ?>

            <!---------------------------------------------------section 2nd condition end--------------------------------------------->


            <!---------------------------------------------------section 3rd condition start--------------------------------------------->
            <?php if ($res_secdata['sec_type'] == 'Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '370x48') {
                ?> 
                <?php
                $sec_id = $res_secdata['Sec_id'];
                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                if ($qr_clmn->num_rows() > 0) {
                    foreach ($qr_clmn->result_array() as $res_clmn) {
                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                        $image_count = $qr_imginfo->num_rows();
                        ?>
                        <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                            <?php if ($res_imgdata['sku'] != '') { ?>  
                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="padding:3px; border:1px solid #BBB; width:100%">
                            <?php } ?>

                            <?php if ($res_imgdata['URL'] != '') { ?>                                                     
                                <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  style="padding:3px; border:1px solid #BBB; width:100%"><?php } ?>                            
                            <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>                                
                                <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  style="padding:3px; border:1px solid #BBB; width:100%"><?php } ?>
                        <?php } ?>

                <?php
                }
            }
        }
        ?>

            <!---------------------------------------------------section 3rd condition end--------------------------------------------->

            <!---------------------------------------------------section 4th condition start--------------------------------------------->
        <?php if ($res_secdata['sec_type'] == 'Featured Box' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '200x83') {
            ?>
                <div class="top-brands">
                    <div class="container">


                        <h3><?= $res_secdata['sec_lbl'] ?></h3>

                        <?php
                        $sec_id = $res_secdata['Sec_id'];
                        $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");

                        if ($qr_clmn->num_rows() > 0) {
                            foreach ($qr_clmn->result_array() as $res_clmn) {
                                $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                                $image_count = $qr_imginfo->num_rows();
                                ?>

                                <ul id="flexiselDemo11">
                                    <li>
                                        <?php
                                        foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                            $img_link = "#";
                                            if ($res_imgdata['URL'] != '') {
                                                $img_link = $res_imgdata['URL'];
                                            }
                                            ?>   

                                            <img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" class="img-responsive" onClick="window.location.href = '<?php echo $img_link; ?>'"/>                        


                                <?php }
                            }
                            ?>
                                </li>

                            </ul>

                <?php } ?> 
                    </div></div>
            <?php } ?>

            <!---------------------------------------------------section 4th condition end--------------------------------------------->

            <!---------------------------------------------------section 5th condition start--------------------------------------------->
                            <?php if ($res_secdata['sec_type'] == 'Carousel' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '106x161') {
                                ?><div style="background:#e2dddd;">  
                    <div id="slider01">
                        <a class="buttons prev" href="#">&#60;</a>
                        <div class="viewport">
                            <ul class="overview">
                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
                                if ($qr_clmn->num_rows() > 0) {
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                        $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?>

                                        <?php
                                        if ($qr_imginfo->num_rows() > 0) {
                                            foreach ($qr_imginfo->result_array() as $res_imgdata) {
                                                ?>
                                                <?php if ($res_imgdata['sku'] != '') { ?>
                                                    <li><img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"/></li>
                                                <?php } ?>
                                                <?php if ($res_imgdata['URL'] != '') { ?>
                                                    <li><img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'"/></li>
                            <?php } ?>
                                                <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                    <li><img src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" /></li>
                                                <?php } ?>
                        <?php }
                    }
                    ?>


                    <?php }
                }
                ?>

                            </ul>
                        </div>
                        <a class="buttons next" href="#">&#62;</a>
                    </div></div>
        <?php } ?>
            <!---------------------------------------------------section 5th condition end------------------------------------------------->

            <!---------------------------------------------------section 6th condition start------------------------------------------------->

        <?php if ($res_secdata['sec_type'] == 'Slider' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '770x394') {
            ?>

                <div id="jssor_10" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
                    <!-- Loading Screen -->
                    <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                        <div style="position:absolute;display:block;background:url('<?php echo base_url() ?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;    width:100%;height:100%;"></div>
                    </div>
                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height: 300px;overflow:hidden;"> 
                        <?php
                        $sec_id = $res_secdata['Sec_id'];
                        $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                        if ($qr_clmn->num_rows() > 0) {
                            foreach ($qr_clmn->result_array() as $res_clmn) {
                                $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                $image_count = $qr_imginfo->num_rows();
                                ?>  

                                <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                        <?php if ($res_imgdata['sku'] != '') { ?>
                                        <div>
                                            <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
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

                    <?php } // image for loop end   ?>
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
                <script type="text/javascript">jssor_10_slider_init();</script>

        <?php } ?> 

            <!---------------------------------------------------section 6th condition end------------------------------------------------->

            <!---------------------------------------------------section 7th condition start------------------------------------------------->
        <?php if ($res_secdata['sec_type'] == 'Slider' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '1000x244') {
            ?>

                <div id="jssor_12" style="position:relative;margin:0 auto;top:0px;left:0px;width:1024px;height:244px;overflow:hidden;">
                    <!-- Loading Screen -->
                    <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                        <div style="position:absolute;display:block;background:url('<?php echo base_url() ?>mobile_css_js/new/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                    </div>
                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1024px;height:244px;overflow:hidden;"> 
                        <?php
                        $sec_id = $res_secdata['Sec_id'];
                        $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                        if ($qr_clmn->num_rows() > 0) {
                            foreach ($qr_clmn->result_array() as $res_clmn) {
                                $clmn_sqlid = $res_clmn['clmn_sqlid'];

                                $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                $image_count = $qr_imginfo->num_rows();
                                ?>  

                                <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>

                        <?php if ($res_imgdata['sku'] != '') { ?>
                                        <div>
                                            <img data-u="image" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" />
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

                    <?php } // image for loop end   ?>
                    <?php
                } // column for loop end
            }// column num_rows condition end
            ?>



                        <!-- <a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
                            <a data-u="any" href="#" style="display:none">js slider</a>-->
                    </div>
                    <!-- Bullet Navigator -->
                    <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                        <!-- bullet navigator item prototype -->
                        <div data-u="prototype" style="width:16px;height:16px;"></div>
                    </div>
                    <!-- Arrow Navigator -->
                    <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;background-position: -25px -37px;" data-autocenter="2"></span>
                    <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;background-position: -70px -37px;" data-autocenter="2"></span>
                </div>
                <script type="text/javascript">jssor_12_slider_init();</script>

        <?php } ?>

            <!---------------------------------------------------section 7th condition end------------------------------------------------->

            <!---------------------------------------------------section 8th condition start------------------------------------------------->
                            <?php if ($res_secdata['sec_type'] == 'Product' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                                ?>

                <div style="background:#fff; padding-top:10px;">  
                    <div id="slider02">
                        <a class="buttons prev" href="#">&lt;</a>
                        <div class="viewport" style="width:2000px !important;">
                            <ul class="overview" >

                                <?php
                                $sec_id = $res_secdata['Sec_id'];
                                $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
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
                                                    $image_arr = explode(',', $rw['catelog_img_url']);
                                                    //$taxdecimal = $rw->tax_rate_percentage/100;
                                                    //tax amount for product price
                                                    //$tax_amount = $rw->price*$taxdecimal;
                                                    //tax amount for product special price
                                                    //$tax_amount_special = $rw->special_price*$taxdecimal;
                                                    $quantity = $rw['quantity'];
                                                    //$quantity=$rw->quantity;

                                                    $cur_prodprice = 0;
                                                    if ($rw['special_price'] != 0) {
                                                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                            $cur_prodprice = $rw['special_price'];
                                                        }
                                                    }
                                                    if ($rw['price'] != 0 && $rw['special_price'] == 0) {
                                                        $cur_prodprice = $rw['price'];
                                                    } else {
                                                        $cur_prodprice = $rw['mrp'];
                                                    }

                                                    $percen_curprc = ((100 / $rw['mrp']) * $cur_prodprice);

                                                    $percen_off = 100 - round($percen_curprc);
                                                    $cur_splprc = 0;
                                                    ?>
                                                    <li>
                                                        <div class="prduct-sl-1st">
                                                            <?php //if($percen_off>0){ ?> 
                                                            <span class="product-sl-off"><?= $percen_off ?>% off </span>
                                <?php //}  ?>

                                                            <?php
                                                            if ($rw['special_price'] != 0) {
                                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                    $cur_splprc = $rw['special_price'];
                                                                    ?> 
                                                                    <span class="product-sl-right">
                                                                        <span class="poduct-sl-pre"> Rs.<?= $rw['mrp'] ?></span> 
                                                                        <span class="product-sl-main-price">Rs.<?= $rw['special_price'] ?></span>
                                                                    </span>
                                                                <?php }
                                                            }
                                                            ?>

                                <?php if ($rw['price'] != 0 && $cur_splprc == 0) { ?>
                                                                <span class="product-sl-right">
                                                                    <span class="poduct-sl-pre"> Rs.<?= $rw['mrp'] ?></span> 
                                                                    <span class="product-sl-main-price">Rs.<?= $rw['price'] ?></span>
                                                                </span>

                                <?php } ?>

                                                            <?php if ($rw['price'] == 0 && $cur_splprc == 0) { ?>
                                                                <span class="product-sl-right">                               
                                                                    <span class="product-sl-main-price">Rs.<?= $rw['mrp'] ?></span>
                                                                </span>
                                <?php } ?>

                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="product-sl-image-held">

                                <?php if (empty($dsply_img)) { ?>

                                                                <a style="margin:auto; text-align:center;" 
                                                                   href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                    <img  src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" >
                                                                </a>

                                <?php } else { ?>

                                                                <a style="margin:auto; text-align:center;" 
                                                                   href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                                                    <img  src="<?php echo base_url(); ?>images/product_img/<?= $image_arr[0]; ?>">
                                                                </a>

                                <?php } ?>

                                                            <div class="ad-info">
                                                                <h5><a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>">
                                <?php
                                if (strlen($rw['name']) > 10) {
                                    echo substr($rw['name'], 0, 10) . '...';
                                } else {
                                    echo $rw['name'];
                                }
                                ?>
                                                                    </a></h5>

                                                                <span onClick="window.location.href = '<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($rw['name'])))) . '/' . $rw['product_id'] . '/' . $rw['sku'] ?>'">
                                                                    Add to Cart
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </li>
                            <?php
                            } // product data loop end
                        } // product num_rows() condition end 
                        ?>


                    <?php } // image for loop end   ?>
                    <?php
                } // column for loop end
            }// column num_rows condition end
            ?>

                            </ul>
                        </div>
                        <a class="buttons next" href="#">&gt;</a>
                    </div></div>
            <?php } ?>
            <!---------------------------------------------------section 8th condition end------------------------------------------------->

            <!---------------------------------------------------section 9th condition start------------------------------------------------->

        <?php if ($res_secdata['sec_type'] == 'Grouped Banner' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '600x259') {
            ?>
            <?php
            $sec_id = $res_secdata['Sec_id'];
            $qr_clmn = $this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC");
            if ($qr_clmn->num_rows() > 0) {
                foreach ($qr_clmn->result_array() as $res_clmn) {
                    $clmn_sqlid = $res_clmn['clmn_sqlid'];

                    $qr_imginfo = $this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC");
                    $image_count = $qr_imginfo->num_rows();
                    ?>
                        <div class="container">

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
                            <?php }
                        }
                        ?>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<h3>Banner</h3>-->

                    <?php }
                }
                ?>
                </div>
        <?php } ?>
            <!---------------------------------------------------section 9th condition end------------------------------------------------->


    <?php }
}$this->db->cache_on();
?>
<?php
$qr = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='2' AND page_name='category' AND Status='active' AND sec_type='Rich Text Editor' ");

if ($qr->num_rows() > 0) {
    foreach ($qr->result_array() as $res_secdata) {
        ?>

            <strong><b><?= $res_secdata['sec_lbl'] ?> :</b></strong>
            </br>
            <p style="text-align:justify;"><?= $res_secdata['sec_descrp'] ?></p>
    <?php }
}
?>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $('#slider2').tinycarousel();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function ()
        {
            $('#slider02').tinycarousel();
        });
    </script>


<?php
//$cat_id = $this->uri->segment(4);

$query = $this->db->query("SELECT catg_description FROM category_master WHERE category_id='$cat_id' ");

if ($query->num_rows() > 0) {
    ?>
        <div class="col-md-12">
            <div  style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;">
    <?php
    echo stripslashes($query->row()->catg_description);
    ?>
            </div>
        </div>
<?php } ?>             
</div>

</div>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = '<?= CHAT_APP_URL ?>';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->  

<?php include "footer.php"; ?>

<!----------------------------------------------category extra footer code start-------------------------------->


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

</script>
<script type="text/javascript" src="<?php echo base_url() ?>mobile_css_js/new/js/jquery.flexisel.js"></script>

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


<script type="text/javascript">
    $(window).load(function () {
        $("#flexiselDemo3").flexisel({
            visibleItems: 1,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 5000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint: 480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint: 640,
                    visibleItems: 1
                },
                tablet: {
                    changePoint: 768,
                    visibleItems: 1
                }
            }
        });

    });
</script>


<!----------------------------------------------category extra footer code end----------------------------------->    
