<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include "header.php";
        $this->db->cache_on();
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
        <meta name="Description" content="<?php echo @$data->meta_desc; ?>">
        <meta name="Keywords" content="<?php echo @$data->meta_keywords; ?>" />
        <link rel="canonical" href="<?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) ?>"/>
        <title>
            <?php
            if ($page_title->meta_title != '') {
                echo @$page_title->meta_title;
            } else {
                $curpricequery = $this->db->query("SELECT name, current_price,lvl2,lvl1 FROM cornjob_productsearch WHERE sku='$data_sku' ");
                $rw_curprice = $curpricequery->row();
                echo "Buy Online " . $rw_curprice->name . '@Rs.' . number_format($rw_curprice->current_price, 0, ".", ",");
            }
            ?>
        </title>
        <script src="<?php echo base_url(); ?>new_js/js/jquery.js"  ></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />

        <script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"  ></script>
        <script>
            $(document).ready(function () {
                $(".inline").colorbox({inline: true, width: "25%", height: "447px"});
                $(".inline2").colorbox({inline: true, width: "35%"});
            });
        </script>
        <style>
            .single_grid {
                margin-top: 94px;
            }
            .simpleLens-container {
                padding-top:0;
            }
            .simpleLens-thumbnails-container a {
                width: 70px;
                margin:0;

            }
            .simpleLens-container{
                display: table;
                position: relative;
            }

            .simpleLens-big-image-container {
                display: table-cell;
                text-align: center;
                position:relative;
                height: 300px;
                width: 350px;
                vertical-align:middle;
            }

            .simpleLens-lens-image {
                height: auto !important;
                width: 350px;
                display: inline-block;
                text-align: center;
                margin:0;
                box-shadow:none;
                float:none;
                position:relative;
            }
            .item img {
                width: 100%;

            }
            .simpleLens-mouse-cursor{
                background-color:#CCC;
                opacity:0.2;
                filter: alpha(opacity = 20);
                position:absolute;
                top:0;
                left:0;
                border:1px solid #999;
                box-shadow:0 0 2px 2px #999;
                cursor:none;
            }

            .simpleLens-lens-element {
                background-color: #FFFFFF;
                box-shadow: 0 0 2px 2px #8E8E8E;
                height: 450px;
                left: 105%;
                overflow: hidden;
                position: absolute;
                top: 0;
                width: 750px;
                z-index: 9999;
                text-align: center;
            }

            .simpleLens-lens-element img{
                position:relative;
                top:50px;
                left:0;
                width:auto !important;
                max-width:none !important;
            }
            .discount {
                border: 1px solid #ed2541;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                float: left;
                padding: 5px;
                text-align: center;
                font-weight:bold;
            }
            .price3{
                font-size: 14px;
                font-weight: bold;
                color:#000;
            }
            .price2{
                font-size: 14px;
                font-weight: bold;
            }
            .single-prod-detail{
                height:100px;
                overflow-y:scroll;
                margin:10px 0;
                border:1px solid #FFAEC9;
            }
            /*check box coloring*/
            .color-checkbox-ul{

                margin-top:10px;
                min-height:80px;
                max-height:120px;
            }
            .color-checkbox-ul input[type=checkbox] {
                display:none;
            }

            .color-checkbox-ul label {
                margin-left: 0px !important;
                cursor: pointer;
                border: 1px solid #999;
            }
            .color-checkbox-ul-list{float:left; margin-right:2px!important;}
            .color-checkbox-ul input[type=checkbox] + label:after
            {
                height:30px;
                width:30px;
            }
            .color-checkbox-ul input[type=checkbox]:checked + label:after
            {
                content: '\2713';
                text-align: center;
                position: absolute;
                margin-top: 4px;
                color: #fff;
                font-size: 20px;

            }
            .single-product-size{
                display: inline-block;
                float: left;
                margin-top: 3px;
                width: 8.8%;
            }
            .single-product-size-ul{
                float:left; width:90%;
            }
            .single-product-size-ul-li{
                float: left;
                margin-right: 10px;
            }

            .single-product-size-ul-li a{
                color:#000;
                text-align:center;
                font-size:16px;
                padding: 5px 10px;
                border: 2px solid #090;
                float: left;

            }
            .size-active{
                background-color:#090;
                color:#fff !important;
            }
            .disabl{
                background-color:#dfdfe3;
                border:2px solid #dfdfe3!important;
                color:#b5b5b8!important;
                text-align:center!important;
                font-size:16px!important;
                padding: 5px 10px!important;
            }

            .desc1 {
                display: block;
                float: left;
                width: 100%;
            }
            .price_single{
                border-top:1px solid #e7e7e7;
                border-bottom:none;
                margin:10px 0px 0px;
                padding:10px 0;
            }
            .by-btn-big{
                background-color: #fb8928;
                margin-left: 15px;
            }
            .add-to-cart {
                padding: 10px 54px;
            }
            .social-ul-li {
                float: left;
                margin-right: 10px;
            }
            .right-button-helder{
                width:80%; 
                margin:15px auto auto;
                text-align: center;
            }
            .right-button-ul{
                width:65%; 
                margin:10px auto;
            }
            .right-button-first-p{
                font-size: 14px;  
                font-weight: bold;  
                width: 88%; 
                margin: 15px auto auto;	
            }
            .return-refund-held{
                font-size: 14px;  
                font-weight: bold;  
                margin: 25px auto auto; 
                height: 40px;
            }
            .return-refunt-strong{
                font-size:18px; 
                font-weight:bold; 
                margin:10px 20px auto auto; 
                float:left;
            }
            .refund-guaranty-back{
                float:left; background:#eef9ff; padding:5px;
            }
            .refunt-guaranty-strong{
                font-size:20px; font-weight:bold;
            }
            .check-availablity{
                float:left; width:70%; margin-top: -25px;
            }
            .left-long-text{
                font-size: 16px;
                font-weight: bold;
                width: 100%;
                padding: 31px 0px 45px;
            }
            h3.tittle:before {
                content: "";
                width: 20%;
                background: #FCB314;
                height: 2px;
                position: absolute;
                left: 10px;
                top: 12px;
            }
            h3.tittle:after {
                content: "";
                width: 20%;
                background: #FCB314;
                height: 2px;
                position: absolute;
                right: 10px;
                top: 12px;
            }
            h3.tittle, h3.tittle.two {
                font-size: 1em;
                position: relative;
                text-align: center;
                margin-bottom: 1em;
                font-weight: 600;
            }
            .xyz{
                display: block;
                margin-left: 0;
                color: #111;
                float: left;
                margin-right: 25px;
                line-height: 116px;
                vertical-align: middle;
                margin-top: 14px!important;
            }

            .a-ordered-list.a-horizontal:before, .a-unordered-list.a-horizontal:before, ol.a-horizontal:before, ul.a-horizontal:before{ display: table;
                                                                                                                                        content: "";
                                                                                                                                        line-height: 0;
                                                                                                                                        font-size: 0;
            }
            .a-align-center {
                vertical-align: middle!important;
                float: left;
                margin: 10px;
            }
            .a-list-item {
                color: #111;
            }
            .a-section:last-child {
                margin-bottom: 0;
            }
            .a-section {
                margin-bottom: 22px;
                width:150px;
                height:150px;
            }
            .a-section img{
                width:150px;
                height:auto;
                max-height:180px;
            }
            .sims-fbt-image {
                vertical-align: middle;
            }

            .a-size-large {
                font-size: 21px!important;
                line-height: 6.3!important;
                text-rendering: optimizeLegibility;
            }
            .a-color-tertiary {
                color: #767676!important;
            }
            .sims-fbt-price-box {
                padding-right: 10px;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .media-carousel 
            {
                margin-bottom: 0;
                padding: 0 40px 0px 40px;
            }
            /* Previous button  */
            .media-carousel .carousel-control.left 
            {

                background-image: none;
                background: #eeeff2;
                border: 2px solid #ccc;
                /* border-radius: 50%; */
                height: 30px;
                width: 30px;
                margin-top: 76px;
                color: #333;
                padding-top: 0;
                font-size: 31px;
                line-height: 21px;
                text-shadow: none;

            }
            /* Next button  */
            .media-carousel .carousel-control.right 
            {

                background-image: none;
                background: #eeeff2;
                border: 2px solid #ccc;
                /* border-radius: 50%; */
                height: 30px;
                width: 30px;
                margin-top: 76px;
                color: #333;
                padding-top: 0;
                font-size: 31px;
                line-height: 21px;
                text-shadow: none;
            }
            /* Changes the position of the indicators */
            .media-carousel .carousel-indicators 
            {
                right: 50%;
                top: auto;
                bottom: 0px;
                margin-right: -19px;
            }
            /* Changes the colour of the indicators */
            .media-carousel .carousel-indicators li 
            {
                background: #c0c0c0;
            }
            .media-carousel .carousel-indicators .active 
            {
                background: #333333;
            }


            .multiple-sl{ margin-bottom:0; border:none;}


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

            .right-banner {
                border:none !important;
                background: #fff!important;
                background-image: none !important;
                background-image: none;
                background-repeat: repeat-x !important;
            }
        </style>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tinycarousel.js"   ></script>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                $('#slider1').tinycarousel({interval: true});
                $('#slider2').tinycarousel({interval: true});
                $('#slider3').tinycarousel({interval: true});
            });

        </script>
        <link href="<?php echo base_url(); ?>new_css/css/single-prod-accordian.css" rel="stylesheet">
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

        <?php
        $this->db->cache_on();

        if ($this->session->userdata('addtocarttemp_session_id') == "") {
            $dtm = str_replace(" ", "-", date('Y-m-d H:i:s'));
            $addtocarttemp_session_id = random_string('alnum', 16) . $dtm;
            $this->session->set_userdata('addtocarttemp_session_id', $addtocarttemp_session_id);

            $data = array();
            $this->session->set_userdata('addtocarttemp', $data);
            $arr_sku = array();
            $this->session->set_userdata('addtocart_sku', $arr_sku);
        }
        ?>

        <link href="<?php echo base_url(); ?>new_css/css/single-prod-accordian.css" rel="stylesheet"> 
        <!--------------for multiple tickkering------------------------->

        <script>
            function selesct_prodas_size(prod_nm, prod_id, prod_sku)
            {
                //window.location.href="<?php //echo base_url().'product_description/product_detail/';       ?>" + prod_nm + '/' + prod_id + '/' + prod_sku;

                window.location.href = "<?php echo base_url() ?>" + prod_nm + '/' + prod_id + '/' + prod_sku;
            }

        </script>
        <script>
            function logintobuynow(l, s, p)
            {
                document.getElementById("ltbn_id").checked = true;
                var lbn_prod_name = l;
                var lbn_product_id = s;
                var lbn_sku_id = p;
                if (document.getElementById("ltbn_id").checked)
                {
                    logintobuysku = document.getElementById("ltbn_id").value;
                }

                $.ajax({
                    url: '<?php echo base_url(); ?>Product_description/logintobuynowaddtocart_temp',
                    method: 'post',
                    data: {lbn_prod_name: lbn_prod_name, lbn_product_id: lbn_product_id, lbn_sku_id: lbn_sku_id, ltbn_id: logintobuysku},
                    success: function (data)
                    {


                    }
                })
            }

        </script>

    </head>
    <body>

        <div style="clear:both;"></div>
        <!----------------------------------------Body Section start------------------------------------------------------> 




        <div class="container" style="width: 100%; padding:5px; margin-top:60px;">
            <div class="row" style="background:#fff;">
                <?php $rec = explode(',', $product_data->imag); ?>
                <?php
                $this->db->cache_on();
                $query = $this->db->query("select * from product_general_info where product_id='$product_data->product_id'");
                $recd1 = $query->row();
                ?>
                <?php
                $this->db->cache_on();
                $curpricequery = $this->db->query("SELECT lvl2,lvl2_name,lvl1,color FROM cornjob_productsearch WHERE sku='$data_sku' GROUP BY sku ");
                $bredcum_sku = $this->uri->segment(3);
                $lvl2_bredcum = $rw_curprice = $curpricequery->row()->lvl2;
                $lvl1_bredcum = $rw_curprice = $curpricequery->row()->lvl1;

                $prodcatgnm_forgoogle = $curpricequery->row()->lvl2_name;
                $prodcolor_forgoogle = $curpricequery->row()->color;

                $bredsrch_string = $lvl2_bredcum . ',' . $lvl1_bredcum;
                $bredcumarr = array();
                $secondlvl_bredcummenu = '';
                $thirddlvl_bredcummenu = '';

                $qr_bredcum = $this->db->query("SELECT * FROM category_menu_desktop WHERE ((category_id LIKE '%,$lvl2_bredcum,%' OR category_id LIKE '$lvl2_bredcum,%' OR category_id LIKE '%,$lvl2_bredcum' OR category_id='$lvl2_bredcum')) ");

                foreach ($qr_bredcum->result_array() as $res_bredcum) {
                    $array_ctgsrch = explode(',', $res_bredcum['category_id']);
                    if (in_array($lvl2_bredcum, $array_ctgsrch)) {
                        $thirddlvl_bredcummenu = $res_bredcum['url_displayname'];
                        $thirddlvl_bredcummenudisplay = $res_bredcum['label_name'];

                        $parent_2ndllvlmenu = $res_bredcum['parent_id'];
                    }
                }
                $qr_scndlvlbredcum = $this->db->query("SELECT * FROM category_menu_desktop WHERE dskmenu_lbl_id='$parent_2ndllvlmenu' ");
                $secondlvl_bredcummenu = $qr_scndlvlbredcum->row()->url_displayname;
                $secondlvl_bredcummenudisplay = $qr_scndlvlbredcum->row()->label_name;
                ?> 
                <div class="col-md-8">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url() ?>">Home</a></li>
                        <li><a href="<?php echo base_url() . 'category/' . $secondlvl_bredcummenu ?>"><?= $secondlvl_bredcummenudisplay ?></a></li>
                        <li><a href="<?php echo base_url() . $thirddlvl_bredcummenu ?>"><?= $thirddlvl_bredcummenudisplay ?></a></li>
                        <li class="active"><a href="<?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) ?>"><?php
                                if (strlen($recd1->name) > 25) {
                                    echo substr($recd1->name, 0, 25) . '...';
                                } else {
                                    echo $recd1->name;
                                }
                                ?> </a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p style="padding: 24px 5px; font-size: 16px; color: #999;"><i class="fa fa-exchange"></i> 100% Replacement/ Return Guarantee<sup>*</sup></p>

                </div>
            </div>

            <div class="row" style="background:#fff;">
                <!------image upload by bulk process check start----->               

                <div class="col-md-5">
                    <div class="simpleLens-gallery-container" id="demo-1">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="simpleLens-thumbnails-container">
                                    <?php
                                    $rec = explode(',', $product_data->imag);
                                    foreach ($rec as $val) {
                                        ?>
                                        <a href="#" class="simpleLens-thumbnail-wrapper"
                                           data-lens-image="<?php echo base_url() . 'images/product_img/' . $val; ?>  "
                                           data-big-image="<?php echo base_url() . 'images/product_img/' . $val; ?>">
                                            <img src="<?php echo base_url() . 'images/product_img/' . $val; ?>" alt="<?php echo $recd1->name; ?>">
                                        </a>
                                    <?php } ?>
                                </div>

                            </div>
                            <div class="col-lg-9">
                                <div class="simpleLens-container">
                                    <div class="simpleLens-big-image-container">
                                        <a class="simpleLens-lens-image" data-lens-image="<?php echo base_url() . 'images/product_img/' . $rec[0]; ?>">
                                            <img  src="<?php echo base_url() . 'images/product_img/' . $rec[0]; ?>" alt=" <?php echo $recd1->name; ?>" class="simpleLens-big-image">
                                        </a>
                                        <?php $pord_firstiamgeforgoogle = base_url() . 'images/product_img/' . $rec[0]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!------image upload by bulk process check end----->  
                <div class="col-md-7" >
                    <div class="desc1">
                        <h1 class="single_prdct_title"><?php
                            $prodnm_forgoogle = $recd1->name;
                            echo $recd1->name;
                            ?> </h1>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="rate_review">
                                    <?php
                                    $number_review = $review_result->num_rows();
                                    if ($number_review != 0) {
                                        $rating = array();
                                        foreach ($review_result->result() as $val) {
                                            $rating[] = $val->rating;
                                        }
                                        $total_sum_of_rating = array_sum($rating);
                                        $average_rating = ceil($total_sum_of_rating / $number_review);
                                    } else {
                                        $average_rating = 0;
                                    }
                                    ?>
                                    <div class="stars">
                                        <select id="backing4c" name="product_rating" disabled="" style="display: none;">
                                            <option value="1" <?php
                                            if ($average_rating == 1) {
                                                echo 'selected';
                                            }
                                            ?>>Bad</option>
                                            <option value="2" <?php
                                            if ($average_rating == 2) {
                                                echo 'selected';
                                            }
                                            ?>>OK</option>
                                            <option value="3" <?php
                                            if ($average_rating == 3) {
                                                echo 'selected';
                                            }
                                            ?>>Great</option>
                                            <option value="4" <?php
                                            if ($average_rating == 4) {
                                                echo 'selected';
                                            }
                                            ?>>Excellent</option>
                                            <option value="5" <?php
                                            if ($average_rating == 5) {
                                                echo 'selected';
                                            }
                                            ?>>Excellent1</option>
                                        </select>
                                        <div class="rateit" data-rateit-backingfld="#backing4c" data-rateit-min="0">
                                            <button id="rateit-reset-2" type="button" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-2" style="display: none;"></button>
                                        </div> 
                                    </div>
                                    <div class="single-prdct-rvw"> | &nbsp; &nbsp; <?= $number_review; ?> reviews </div>
                                    <div class="clearfix"> </div>
                                </div>	
                            </div>
                            <div class="col-lg-4" style="text-align:left">
                                <span><strong>Product Id - <?php echo $product_data->product_id; ?></strong></span>
                            </div>
                        </div>

                        <div style="clear:both;"></div>

                        <!-----------------------------------Price Section---------------------------------------->   

                        <div class="row price_single">
                            <?php
                            $this->db->cache_on();
                            $query = $this->db->query("select * from product_master where sku='$data_sku' ");
                            $recd = $query->row();
                            $cdate = date('Y-m-d');
                            $special_price_from_dt = $recd->special_pric_from_dt;
                            $special_price_to_dt = $recd->special_pric_to_dt;
                            ?>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-8" style="padding-right:0;">
                                        <div class="prc">
                                            <?php
                                            $curnt_price = 0;
                                            if ($recd->special_price != 0) {
                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                    $curnt_price = $recd->special_price;
                                                    ?>
                                                    <ul style="margin:0; padding:0;">
                                                        <li class="regular-price" style="font-size: 17px;"> MRP - Rs. <?= ceil($recd->mrp); ?></li>
                                                        <?php if ($recd->price != 0) { ?>
                                                            <li class="price2" style="font-size: 17px;"> Sell Price - Rs. <?= ceil($recd->price); ?></li>
                                                        <?php } ?>
                                                        <li class="price3" style="font-size: 17px;"> Special Price - Rs. <?= ceil($recd->special_price); ?></li>
                                                    </ul>
                                                <?php } else { ?>
                                                    <ul style="margin:0; padding:0;">
                                                        <?php
                                                        if ($recd->price != 0) {
                                                            $curnt_price = $recd->price;
                                                            ?>
                                                            <li class="regular-price" style="font-size: 17px;"> MRP - Rs. <?= ceil($recd->mrp); ?></li>
                                                            <li class="price2" style="font-size: 17px;"> Sell Price - Rs. <?= ceil($recd->price); ?></li>
                                                            <?php
                                                        } else {
                                                            $curnt_price = $recd->mrp;
                                                            ?>
                                                            <li class="price3" style="font-size: 17px;"> MRP - Rs. <?= ceil($recd->mrp); ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <ul style="margin:0; padding:0;">
                                                    <?php
                                                    if ($recd->price != 0) {
                                                        $curnt_price = $recd->price;
                                                        ?>
                                                        <li class="regular-price" style="font-size: 17px;"> MRP - Rs. <?= ceil($recd->mrp); ?></li>
                                                        <li class="price2" style="font-size: 17px;"> Sell Price - Rs. <?= ceil($recd->price); ?></li>
                                                        <?php
                                                    } else {
                                                        $curnt_price = $recd->mrp;
                                                        ?>
                                                        <li class="price3" style="font-size: 17px;"> MRP - Rs. <?= ceil($recd->mrp); ?></li>
                                                    <?php } ?>
                                                </ul>	
                                            <?php } ?>

                                            <?php
                                            $this->db->cache_on();
                                            $query = $this->db->query("select a.business_name,a.seller_id,b.shipping_fee_amount,b.status,b.approve_status from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'");
                                            $ct = $query->num_rows();
                                            $rew = $query->row();
                                            ?>
                                            <?php if ($rew->shipping_fee_amount == 0) { ?>
                                                <div class="shipng_spn" style="font-size: 17px;margin-bottom: 5px;">(Shipping charges free) &nbsp;</div>
                                            <?php } else { ?>
                                                <div class="shipng_spn" style="font-size: 17px;margin-bottom: 5px;">Shipping fee &nbsp;Rs. <?= $rew->shipping_fee_amount; ?></div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $this->db->cache_on();
                                        $query = $this->db->query("select a.business_name,a.seller_id,b.quantity,b.stock_availability,a.display_name,b.max_qty_allowed_in_shopng_cart,b.status,b.approve_status from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'");

                                        $ct = $query->num_rows();
                                        $rew = $query->row();

                                        $stock_status = '';

                                        if ($rew->quantity > 0) {
                                            $stock_status = 'in stock';
                                        } else {
                                            $stock_status = 'out of stock';
                                        }

                                        $max_quantity = $rew->max_qty_allowed_in_shopng_cart;
                                        if ($rew->quantity == 0)
                                            ; {
                                            ?> 
                                            <?php
                                        }
                                        ?>

                                        <?php
                                        $this->db->cache_on();
                                        $qr1 = $this->db->query("SELECT c.dispatch_days FROM seller_account a INNER JOIN state b ON a.seller_state = b.state INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id WHERE a.seller_id ='$rew->seller_id'");
                                        $ct1 = $qr1->num_rows();
                                        $res = $qr1->row();
                                        if ($ct1 > 0) {
                                            ?>   
                                            <p style="color: #999;font-size:17px;line-height:17px; margin-bottom:5px;"> Delivered By : 4 - 6 Days </p>
                                        <?php } else { ?>
                                            <p style="color: #999;font-size:17px;line-height:17px; margin-bottom:5px;"> Delivered By : 10 - 12 Days </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-4" style="padding-left:0; text-align:left;">
                                        <?php
                                        $this->db->cache_on();
                                        $query = $this->db->query("select * from product_master where sku='$data_sku' ");
                                        foreach ($query->result_array() as $rw) {
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
                                        <?php } ?>
                                        <?php if ($percen_off > 0) { ?>
                                            <div class="discount"><?= $percen_off ?>% <br> OFF </div>
                                        <?php } ?>
                                    </div>
                                    <div style="clear:both;"></div>
                                    <div class="sold-by" style="margin-top:0px; font-size:17px; ">
                                        <div class="row">
                                            <!----------------------------add to wishlist start---------------->

                                            <ul class="add-to" style="margin-bottom:3px;margin-left: 30px;">
                                                <li>
                                                    <?php if ($this->session->userdata('session_data')) { ?>
                                                        <a class="link-wishlist" href="#" onClick="addWishlistFunction('<?= $product_data->product_id; ?>', '<?= $data_sku; ?>')"><i class="fa fa-heart"></i>Add to Wishlist &nbsp;&nbsp;</a> &nbsp;&nbsp;
                                                    <?php } else { ?>
                                                        <a class="link-wishlist inline cboxElement" href="#inline_content" onClick="addWishlistFunction_temp('<?= $product_data->product_id; ?>', '<?= $data_sku; ?>')"><i class="fa fa-heart"></i>Add to Wishlist &nbsp;&nbsp;</a> &nbsp;&nbsp;
                                                    <?php } ?>
                                                    <span id="ajxtst"></span>
                                                </li>                  
                                            </ul>

                                            <!----------------------------add to wishlist end---------------->
                                            <div class="col-lg-3" style="padding-right:0;padding-left: 28px;">Sold by -</div>
                                            <div class="col-lg-9" style="text-align:left; padding-left:0;">
                                                <a href="<?php echo base_url(); ?>sellers/<?= base64_encode($rew->seller_id); ?>" id="goslr" style="cursor:pointer !important; color:#6bb700;text-transform: capitalize;" target="_blank"><?php
                                                    if ($ct != 0) {
                                                        echo " " . $rew->business_name;
                                                    } else {
                                                        echo " ".COMPANY;
                                                    }
                                                    ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-prod-detail item-no">
                                    <ul class="shtr-desc">
                                        <?php
                                        if ($recd1->short_desc) {
                                            $data = $recd1->short_desc;
                                            $short_desc = unserialize($data);
                                            foreach ($short_desc as $value) {
                                                if ($value != '') {
                                                    ?>
                                                    <li><?= $value ?></li>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul>
                                        <li style="float:left; margin-right:10px;"><span style="height:50px; width:50px; background:green"></span></li>
                                    </ul>

                                </div>
                            </div>  
                        </div> 
                        <!--COLOUR SIZE DIV START-->
                        <div id="corlsize_attrbdivid">

                        </div>
                        <div class="clearfix"> &nbsp; </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5">
                    <div class="right-button-helder">
                        <?php
                        $this->db->cache_on();
                        $query_curclolr = $this->db->query("SELECT seller_status FROM cornjob_productsearch WHERE sku='$data_sku' group by sku ");
                        if (@$this->session->userdata['session_data']['user_id'] != "") {
                            if ($rew->quantity == 0 || $rew->status == 'Disabled' || $rew->approve_status == 'Inactive' || $query_curclolr->row()->seller_status != 'Active') {
                                ?>
                                <button type="button" style="background-color:#CCC;" title="Add to Cart" id="1" onclick="#" class="hvr-sweep-to-right add-to-cart" disabled="disabled" >Add to Cart</button>
                                <a style="background-color:#CCC;" class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart disabled">Buy Now</a>
                                <b style="color:#900; font-size:18px;">
                                    <?php
                                    if ($rew->quantity == 0 || $rew->status == 'Disabled' || $rew->approve_status == 'Inactive' || $query_curclolr->row()->seller_status != 'Active') {
                                        if ($rew->quantity == 0 || $rew->status == 'Disabled') {
                                            if ($rew->quantity == 0) {
                                                echo "Out of Stock";
                                            } else {
                                                echo "Product  has been Temporarily Discontinued";
                                            }
                                        } else {
                                            echo "Product has been Discontinued";
                                        }
                                    }
                                    ?></b>
                                <?php } else { ?>
                                <?php if ($vertual_inventory_data <= 0) { ?>
                                    <button style="background-color:#CCC;" type="button" title="Add to Cart" id="2" onClick="alert('This product is out of stock.');" class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>
                                    <a style="background-color:#CCC;" class="button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="alert('This product is out of stock.');">Buy Now</a>
                                <?php } else { ?>
                                    <button  type="button" title="Add to Cart" id="3" onClick="goAddtoCart('<?= preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(" ", "-", str_replace("'", "", strtolower($recd1->name))))); ?>', '<?= $product_data->product_id; ?>', '<?= $data_sku; ?>')" class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>
                                    <a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="goAddtoCartBuyNow('<?= preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace("'", "", str_replace(" ", "-", strtolower($recd1->name))))); ?>', '<?= $product_data->product_id; ?>', '<?= $data_sku; ?>')">Buy Now</a>
                                    <?php
                                }
                            }
                            ?>
                        <?php } else if ($rew->quantity == 0 || $rew->status == 'Disabled' || $rew->approve_status == 'Inactive' || $query_curclolr->row()->seller_status != 'Active') { ?>
                            <button style="background-color:#CCC;" type="button" title="Add to Cart" id="4" onclick="#" class="hvr-sweep-to-right add-to-cart" disabled="disabled" >Add to Cart</button>
                            <a style="background-color:#CCC;" class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart disabled">Buy Now</a>
                            <b style="color:#900; font-size:18px;">
                                <?php
                                if ($rew->quantity == 0 || $rew->status == 'Disabled' || $rew->approve_status == 'Inactive' || $query_curclolr->row()->seller_status != 'Active') {

                                    if ($rew->quantity == 0 || $rew->status == 'Disabled') {
                                        if ($rew->quantity == 0) {
                                            echo "Out of Stock";
                                        } else {
                                            echo "Product  has been Temporarily Discontinued";
                                        }
                                    } else {
                                        echo "Product has been Discontinued";
                                    }
                                }
                                ?></b>
                            <?php } else { ?>
                            <?php if ($vertual_inventory_data <= 0) { ?>
                                <button style="background-color:#CCC;" type="button" title="Add to Cart" id="5" onClick="alert('This product is out of stock.');" class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>
                                <a style="background-color:#CCC;" class="button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="alert('This product is out of stock.');">Buy Now</a>
                            <?php } else { ?>
                                <button type="button" title="Add to Cart" id="6" onClick="window.location.href = '<?php echo base_url() . 'product_description/addtocart_temp/' . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace("'", "", str_replace(" ", "-", strtolower($recd1->name))))) . '/' . $product_data->product_id . '/' . $data_sku ?>'" class="hvr-sweep-to-right add-to-cart">Add to Cart</button>

                                <input type="checkbox" name="ltbn_name" value="<?php echo $data_sku ?>" id="ltbn_id" style="display:none;">
                                <a class="inline button by-btn-big by_btn cboxElement hvr-sweep-to-right add-to-cart" onClick="logintobuynow('<?php echo preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace("'", "", str_replace(" ", "-", strtolower($recd1->name))))); ?>', '<?php echo $product_data->product_id; ?>', '<?php echo $data_sku ?>')" href="#inline_content">Buy Now</a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul  class="right-button-ul">
                                <div class="addthis_native_toolbox"></div>
                            </ul>
                            <div style="clear:both"></div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="check-availablity">
                        <h4 class="title-sml"> Check Availability </h4>
                        <input type="text" placeholder="Enter Your Pincode" name="pin" id="pin" class="pncd">
                        <button type="button" class="btn1 btn-primary1 hvr-sweep-to-right" onClick="valid_pin(<?= $cur_prodprice ?>)" style="cursor:pointer;"> <span>Check </span></button>
                        <div id="valid_msg1"  style="font-weight:bold; color:red;"></div>
                        <div id="pin-msg" style=" display:none; font-weight:bold; color:#093;"> Product is available at your location. </div>
                        <div id="pin_msg_cod" style=" display:none; font-weight:bold; color:#90F; float:left;"> COD is also available. </div>
                        <div id="codchrg_spn"  style="font-weight:bold; color:#900; float:right;"></div>
                    </div>
                </div>
            </div>
            <div style="clear:both"></div>
            <div class="row" style="width:98%; margin:auto; border-bottom:2px solid #333;">
                <div class="col-lg-3" style="padding-right:0;">
                    <div class="return-refund-held">
                <!--<strong class="return-refunt-strong">Return & Refund<sup>*</sup></strong>-->
                        <span class="refund-guaranty-back">
                            <strong class="refunt-guaranty-strong"> 
                                <img src="<?php echo base_url(); ?>images/buyer-protection.png" style="width:24px; height:25px;">
                                100% <span style="color:#5ac0fc; vertical-align: middle;">BUYER PROTECTION</span>
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-9" style="padding-left:0;">
                    <p class="left-long-text">This item is Eligible For Return/ Replacement <sup>*</sup>, Know More about the <a href="<?php echo base_url() . 'return-policy' ?>">Return Policy.</a></p>
                </div>
            </div>  

            <div class="row" style="width:98%; margin:auto;">
                <div class="col-lg-12">
                    <h3>Short Description </h3>
                    <ul> 
                        <li style="text-align:justify;"><?php
                        $proddescrp_forgoogle = stripslashes($recd1->description);
                        echo str_replace('\\', '', $recd1->description);
                        ?></li>

                    </ul>

                </div>
            </div>

            <div style="clear:both;"></div>
            <div id="singleprod_attrb_divid"></div>

            <div style="clear:both;"></div>
        </div>

        <hr style="border-top: 1px solid #CCC!important;margin: 0;">

        <div style="clear:both;"></div>

        <div style="clear:both;"></div>

        <!-------------------------------------------- Backend Section Start -------------------------------------------->
        <?php
        $this->db->cache_off();
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

                        <div class="first-thumbnail-banner" style="margin:0; padding:0!important;">
                            <div class='row'>
                                <div class='col-md-12' style="background:#fff; padding:10px 10px 0 10px;">
                                    <div class="carousel slide media-carousel" id="media-<?php echo $sec_id; ?>">
                                        <div class="carousel-inner">
                                            <?php
                                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' 
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
                                                    <div class="item  active" style="background:none;">
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
                                                            <?php } //active foreach condition end    ?>
                                                        </div>
                                                    </div>
                                                <?php } // Main if condition end    ?>
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

                                            <?php } // Main foreach condition end      ?>
                                        </div>
                                        <?php if ($image_all_count > 12) { ?>
                                            <a data-slide="prev" href="#media-<?php echo $sec_id; ?>" class="left carousel-control" style="margin-top:35px;margin-left: 8px;">‹</a>
                                            <a data-slide="next" href="#media-<?php echo $sec_id; ?>" class="right carousel-control" style="margin-top:35px; margin-right:8px;">›</a>
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
                        $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' 
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
                                    <div style="width:100%; margin:auto; text-align:center; color:#000; padding:0;">
                                        <h3 class="title"> <span><?= $res_secdata['sec_lbl'] ?></span> </h3>
                                    </div>
                                <?php } ?>
                                <div class="banner" style="margin:auto;">
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
                                                    <div <?php if ($j_slide == '0') { ?>class="item active" style="background:none;" <?php } else { ?> class="item" <?php } ?>>
                                                        <img alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;"  width="" height="" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" /> 
                                                    </div>
                                                <?php } ?>
                                                <?php if ($res_imgdata['URL'] != '') { ?>
                                                    <div <?php if ($j_slide == '0') { ?>class="item active" style="background:none;" <?php } else { ?> class="item" <?php } ?>>
                                                        <img onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" style="cursor: pointer;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>"  width="" height="" /> 
                                                    </div>
                                                <?php } ?>
                                                <?php if ($res_imgdata['sku'] == '' && $res_imgdata['URL'] == '') { ?> 
                                                    <div <?php if ($j_slide == '0') { ?>class="item active" style="background:none;" <?php } else { ?> class="item" <?php } ?>>
                                                        <img alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;"  width="" height="" /> 
                                                    </div>
                                                <?php } ?>
                                                <?php
                                                $j_slide++;
                                            }
                                            ?>
                                        </div>
                                        <a style="top: 160px;" class="left carousel-control" href="#myCarousel-<?php echo $sec_id; ?>" data-slide="prev"><span class="fa fa-chevron-left"></span></a>
                                        <a style="top: 160px;" class="right carousel-control" style="margin-right: 22px;" href="#myCarousel-<?php echo $sec_id; ?>" data-slide="next"><span class="fa fa-chevron-right"></span></a> 
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
                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                        <?php } ?>
                    </div>
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
                                    $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                <div style="width:100%; margin:0 auto auto; text-align:center; color:#000; padding:5px 0;">
                                    <h3 class="title"> <span><?= $res_secdata['sec_lbl'] ?></span> </h3>
                                </div>
                            <?php } ?>
                            <?php
                            $sec_id = $res_secdata['Sec_id'];
                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' 
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
                        $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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

                        <div class="row" style="margin:auto;">
                            <?php if ($res_secdata['sec_lbl'] == '') { ?>
                            <?php } else { ?>
                                <h3 style="margin-top:0!important;"> 
                                    <span class="new-arivl"> <?= $res_secdata['sec_lbl'] ?> </span>
                                    <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                </h3>
                            <?php } ?>
                            <div style="clear:both;"></div>
                            <?php
                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                            if ($qr_clmn->num_rows() > 0) {
                                foreach ($qr_clmn->result_array() as $res_clmn) {
                                    $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                    $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                    $image_count = $qr_imginfo->num_rows();
                                    ?>
                                    <div class="col-lg-4" style=" margin-top:5px;">
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

                            <div class="col-lg-8 right-banner" style=" margin-top:5px;">
                                <div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php
                                        $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                        if ($qr_clmn->num_rows() > 0) {
                                            foreach ($qr_clmn->result_array() as $res_six_clmn) {
                                                $clmn_six_sqlid = $res_six_clmn['clmn_sqlid'];

                                                $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_six_sqlid' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                $image_count = $qr_imginfo->num_rows();
                                                ?>
                                                <div class="item active" style="background:none;">
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
                                                                                        <img style="width: auto !important;" src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                    <?php } else { ?>
                                                                                        <img style="width: auto !important;" src="<?php echo base_url() . 'images/product_img/' . $dsply_img ?>"  alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
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
                                                                                        <img style="width: auto !important;" src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
                                                                                    <?php } else { ?>
                                                                                        <img style="width: auto !important;" src="<?php echo base_url() . 'images/product_img/' . $dsply_all_img ?>"  alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
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


                                        <?php //}      ?>
                                    </div>
                                    <a class="left carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                    <a class="right carousel-control" style="padding-top: 10%;" href="#carousel-example<?php echo $sec_id; ?>" data-slide="next"><i class="fa fa-chevron-right"></i></a>
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
                                    <h3 style="margin-top:0!important;">
                                        <span class="new-arivl"><?= $res_secdata['sec_lbl'] ?></span>
                                        <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                    </h3>
                                <?php } ?>
                                <div style="clear:both;"></div>       
                                <?php
                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                if ($qr_clmn->num_rows() > 0) {
                                    foreach ($qr_clmn->result_array() as $res_clmn) {
                                        $clmn_sqlid = $res_clmn['clmn_sqlid'];
                                        $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND clmn_id='1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                        $image_count = $qr_imginfo->num_rows();
                                        ?>
                                        <div class="col-lg-4" style=" margin-top:5px;">
                                            <?php foreach ($qr_imginfo->result_array() as $res_imgdata) { ?>
                                                <?php $url = str_replace('=', '', strrchr($res_imgdata['URL'], "=")); ?>
                                                <iframe width="100%" height="260" style="border:1px solid #ccc; padding:10px;" src="https://www.youtube.com/embed/<?= $url ?>" frameborder="0" allowfullscreen></iframe>
                                            <?php } ?>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <div class="col-lg-8 right-banner" style=" margin-top:5px;">
                                    <div id="carousel-example<?php echo $sec_id; ?>" class="carousel slide hidden-xs" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <?php
                                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
                                            if ($qr_clmn->num_rows() > 0) {
                                                foreach ($qr_clmn->result_array() as $res_six_clmn) {
                                                    $clmn_six_sqlid = $res_six_clmn['clmn_sqlid'];

                                                    $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_six_sqlid' AND clmn_id='2' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC  ");
                                                    $image_count = $qr_imginfo->num_rows();
                                                    ?>
                                                    <div class="item active" style="background:none;">
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
                                                                                            <img style="width: auto !important;" src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
                                                                                        <?php } else { ?>
                                                                                            <img style="width: auto !important;" src="<?php echo base_url() . 'images/product_img/' . $dsply_img ?>"  alt="<?= $rw['name'] ?>" title="<?= $rw['name'] ?>">
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
                                                                                            <img style="width: auto !important;" src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png" alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
                                                                                        <?php } else { ?>
                                                                                            <img style="width: auto !important;" src="<?php echo base_url() . 'images/product_img/' . $dsply_all_img ?>"  alt="<?= $allrw['name'] ?>" title="<?= $allrw['name'] ?>">
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
                                            <?php //}    ?>
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
                            <div class="row" style="margin-right: 0px; margin-left: 0px;margin-bottom: 5px;">
                                <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                <?php } else { ?>
                                    <h3 style="margin-top:0!important;">
                                        <span class="new-arivl"><?= $res_secdata['sec_lbl'] ?></span>
                                        <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                    </h3>
                                <?php } ?>
                                <div style="clear:both;"></div>
                                <?php
                                $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                $qr_clmn1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                            <div class="row" style=" padding:10px; margin:0px 0 5px ; background:<?= $res_secdata['bg_color']; ?>">
                                <div class="col-lg-10">
                                    <div id="tabbed-Carousel" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->

                                        <div class="carousel-inner">
                                            <?php
                                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                                        <div class="item active" style="background:none;">
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
                                            $qr_clmn_item = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                            $qr_clmn1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                            $qr_clmn_item1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='1' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                $qr_clmn1 = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND clmn_id='2' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                    <!------------------------------------------------- Section 12th Condition End ---------------------------------------------------->
                    <!------------------------------------------------- Section 13th Condition Start -------------------------------------------------->
                    <?php
                    if ($res_secdata['sec_type'] == 'Product Grid View' && $res_secdata['sec_type_data'] == 'Product' && $res_secdata['nos_column'] == '1') {
                        $sec_id = $res_secdata['Sec_id'];
                        ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">				
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");
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
                                    <h3 style="margin-top:0;">
                                        <span class="new-arivl"> <?php echo $res_secdata['sec_lbl']; ?> </span>
                                        <!--<button type="button" class="btn btn-danger right" style="background:#ed2541">&nbsp; View All &nbsp;</button>-->
                                    </h3>
                                <?php } ?>
                            </div>
                            <div class="container-fluid" style="padding:0;">

                                <div class="row" style="margin-right: 0px; margin-left: 0px;">
                                    <?php
                                    $sec_id = $res_secdata['Sec_id'];
                                    $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
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
                                        $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC ");
                                        if ($qr_clmn->num_rows() > 0) {
                                            foreach ($qr_clmn->result_array() as $res_clmn_four) {
                                                $clmn_sqlid1 = $res_clmn_four['clmn_sqlid'];
                                                $qr_act_imginfo1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid");
                                                $image_all_count = $qr_act_imginfo1->num_rows();

                                                $qr_act_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 5 ");
                                                $image_count = $qr_act_imginfo->num_rows();
                                                ?>
                                                <div class="item active" style="background:none;">
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

                    <!------------------------------------------------- Section 16th Condition Start ---------------------------------------------->
                    <?php
                    if ($res_secdata['sec_type'] == 'Sponsored Product' && $res_secdata['sec_type_data'] == 'Banner' && $res_secdata['nos_column'] == '1' && $res_secdata['image_size'] == '175x175') {
                        $sec_id = $res_secdata['Sec_id'];
                        ?>
                        <hr style="border-top: 1px solid #CCC!important;margin: 0;">
                        <div style="clear:both;"></div>
                        <div class="row" style="width:98%; margin:auto;">
                            <div class="col-lg-6">
                                <?php if ($res_secdata['sec_lbl'] == '') { ?>
                                <?php } else { ?>
                                    <h2 style="color: #C60!important; font-size: 16px!important; font-family: verdana,arial,helvetica,sans-serif!important; font-weight: 700;line-height: 1.3;margin-top: 10px;"><?= $res_secdata['sec_lbl'] ?><span style="color:#0066c0;">(What's this?)</span></h2>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6">
                                    <!--<p style="float:right; font-weight:bold;margin-top: 10px;">Page 1 of 5</p>-->
                            </div>
                        </div>
                        <div class="first-multiple-banner">
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class="carousel slide media-carousel" id="media<?php echo $sec_id; ?>">
                                        <div class="carousel-inner">
                                            <?php
                                            $qr_clmn = $this->db->query("SELECT * FROM desktopsite_columninfo WHERE page_id='4' AND sec_id='$sec_id' AND clmn_status='active' ORDER BY ordr_by DESC  ");

                                            if ($qr_clmn->num_rows() > 0) {
                                                foreach ($qr_clmn->result_array() as $res_clmn_four) {
                                                    $clmn_sqlid1 = $res_clmn_four['clmn_sqlid'];
                                                    $qr_act_imginfo1 = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid");
                                                    $image_all_count = $qr_act_imginfo1->num_rows();

                                                    $qr_act_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid1' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 6 ");
                                                    $image_count = $qr_act_imginfo->num_rows();
                                                    ?>
                                                    <div class="item  active" style="background:none;">
                                                        <div class="row">
                                                            <?php
                                                            foreach ($qr_act_imginfo->result_array() as $res_imgdata_active) {
                                                                ?>
                                                                <?php if ($res_imgdata_active['sku'] != '') { ?>
                                                                    <div class="col-md-2">
                                                                        <a class="multiple-sl">
                                                                            <img style="height:187px;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata_active['display_url'] . '/' . $res_imgdata_active['img_sqlid'] ?>'" style="cursor: pointer;">
                                                                        </a>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($res_imgdata_active['URL'] != '') { ?>
                                                                    <div class="col-md-2">
                                                                        <a class="multiple-sl">
                                                                            <img style="height:187px;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata_active['URL']; ?>'" style="cursor: pointer;">
                                                                        </a>
                                                                    </div>	
                                                                <?php } ?>
                                                                <?php if ($res_imgdata_active['URL'] == '' && $res_imgdata_active['sku'] == '') { ?>
                                                                    <div class="col-md-2">
                                                                        <a class="multiple-sl">
                                                                            <img style="height:187px;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata_active['imge_nm']; ?>" style="cursor: pointer;">
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
                                                    $qr_imginfo = $this->db->query("SELECT * FROM desktopsite_imageinfo WHERE clmn_sqlid='$clmn_sqlid' AND image_status='active' AND ((frm_dt_tm<='$cur_dtm' AND to_dt_tm>='$cur_dtm') OR (frm_dt_tm='0000-00-00 00:00:00' OR to_dt_tm='0000-00-00 00:00:00')) ORDER BY img_sqlid DESC LIMIT 12,$image_all_count ");
                                                    $image_count = $qr_imginfo->num_rows();
                                                    $row = $qr_imginfo->result_array();
                                                    foreach (array_chunk($row, 6) as $rw) {
                                                        ?>
                                                        <div class="item">
                                                            <div class="row">
                                                                <?php
                                                                foreach ($rw as $res_imgdata) {
                                                                    ?>
                                                                    <?php if ($res_imgdata['sku'] != '') { ?>
                                                                        <div class="col-md-2">
                                                                            <a class="multiple-sl">
                                                                                <img style="height:187px;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onclick="window.location.href = '<?php echo base_url() . 'offers/' . $res_imgdata['display_url'] . '/' . $res_imgdata['img_sqlid'] ?>'" style="cursor: pointer;">
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata['URL'] != '') { ?>
                                                                        <div class="col-md-2">
                                                                            <a class="multiple-sl">
                                                                                <img style="height:187px;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" onClick="window.location.href = '<?php echo $res_imgdata['URL']; ?>'" style="cursor: pointer;">
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if ($res_imgdata['URL'] == '' && $res_imgdata['sku'] == '') { ?>
                                                                        <div class="col-md-2">
                                                                            <a class="multiple-sl">
                                                                                <img style="height:187px;" alt="" src="<?php echo base_url() . 'images/pagedesign_image/' . $res_imgdata['imge_nm']; ?>" style="cursor: pointer;">
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
                                            <?php } ?>
                                        </div>
                                        <a data-slide="prev" href="#media<?php echo $sec_id; ?>" class="left carousel-control">‹</a>
                                        <a data-slide="next" href="#media<?php echo $sec_id; ?>" class="right carousel-control">›</a>
                                    </div>                          
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!------------------------------------------------- Section 16th Condition End ---------------------------------------------------->
                    <!------------------------------------------------- Section 17th Condition End ---------------------------------------------------->
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
                    <!------------------------------------------------- Section 17th Condition End ---------------------------------------------------->
                    <?php
                }
            }
            ?>
        <?php } ?>
        <!-------------------------------------------- Backend Section Section End -------------------------------------------->





        <div style="clear:both;"></div>

        <?php include "footer.php" ?>

        <a href="#" id="back-to-top" title="Back to top" class="show">↑</a>

    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>new_js/js/jquery.simpleGallery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>new_js/js/jquery.simpleLens.js"></script>

    <script>
                                                $(document).ready(function () {
                                                    $('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
                                                        loading_image: 'demo/images/loading.gif'
                                                    });

                                                    $('#demo-1 .simpleLens-big-image').simpleLens({
                                                        loading_image: 'demo/images/loading.gif'
                                                    });
                                                });
    </script>
    <script>
        $(document).ready(function () {
            var mrp = parseFloat($('#mrp_spn').text());
            var final_price = parseFloat($('#finl_spn').text());
            var percnt = parseFloat((final_price / mrp) * 100);
            var discount_percent = Math.round(100 - percnt);
            if (isNaN(discount_percent)) {
                $('#discount_spn').hide();
            } else {
                $('#discount_spn').html(discount_percent + '%<br>OFF');
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            var no_of_mor_slr = $('.no_slr_spn').text();
            if (no_of_mor_slr > 0) {
                $('.more_seller_spn').text('From - ' + no_of_mor_slr + ' Other Sellers ');
            }
            if (no_of_mor_slr == 1) {
                $('.more_seller_spn').text('From - ' + no_of_mor_slr + ' Other Seller');
            }
        })
    </script>

    <script>
        $(document).ready(function () {
            $('.attr_hd_no').hide();
            var attr_hd_no = $('.attr_hd_no').text();
            for ($i = 1; $i <= attr_hd_no; $i++) {
                if ($('.qw' + $i).next().hasClass("attr_tbl") == false) {
                    $('.qw' + $i).hide();
                }
            }
        });
    </script>

    <script>
        function goAddtoCart(prdt_name, prdt_id, sku) {
            var attr_clr = $('#attr_color').val();
            var attr_size = $('#attr_size').val();

            var attr_parm = '';
            if (attr_size) {
                if (attr_clr) {
                    attr_parm += '/size=' + attr_size.replace(' ', '-') + '&' + 'color=' + attr_clr.replace(' ', '-');
                } else {
                    attr_parm += '/size=' + attr_size.replace(' ', '-');
                }
            } else if (attr_clr) {
                if (attr_size) {
                    attr_parm += '/size=' + attr_size.replace(' ', '-') + '&' + 'color=' + attr_clr.replace(' ', '-');
                } else {
                    attr_parm += '/color=' + attr_clr.replace(' ', '-');
                }
            }
            window.location.href = '<?php echo base_url(); ?>product_description/addtocart/' + prdt_name + '/' + prdt_id + '/' + sku + attr_parm;
        }
    </script>

    <script>
        function goAddtoCartBuyNow(prdt_name, prdt_id, sku) {
            var attr_clr = $('#attr_color').val();
            var attr_size = $('#attr_size').val();

            var attr_parm = '';
            if (attr_size) {
                if (attr_clr) {
                    attr_parm += '/size=' + attr_size.replace(' ', '-') + '&' + 'color=' + attr_clr.replace(' ', '-');
                } else {
                    attr_parm += '/size=' + attr_size.replace(' ', '-');
                }
            } else if (attr_clr) {
                if (attr_size) {
                    attr_parm += '/size=' + attr_size.replace(' ', '-') + '&' + 'color=' + attr_clr.replace(' ', '-');
                } else {
                    attr_parm += '/color=' + attr_clr.replace(' ', '-');
                }
            }
            window.location.href = '<?php echo base_url(); ?>product_description/addtocart_buynow/' + prdt_name + '/' + prdt_id + '/' + sku + attr_parm;
        }
    </script>

    <script>
        function StoreInSession(pid, sku, pname) {
            $('.by_btn').css('background-color', '#ccc');
            $.ajax({
                url: '<?php echo base_url(); ?>product_description/set_buynow_session',
                method: 'post',
                data: {pid: pid, sku_id: sku, pname: pname},
                success: function (result) {

                    if (result == 'success') {
                        window.location.href = '?restart';
                    }
                }
            });
        }
        $(document).ready(function () {
            if (window.location.search.indexOf('restart') > -1) {
                setTimeout(function () {
                    $('.inline').trigger('click');
                }, 500);
            }
            ;
        });
    </script>



    <script>
        function valid_pin(curprice) {
            var pin = document.getElementById('pin').value;

            var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (pin == "") {
                $('#valid_msg1').show().text('Please enter your Pin Number!');
                return false;
                pin.focus();

            }
            else if (isNaN(pin)) {
                $('#valid_msg1').show().text('Enter a valid Pin Number');
                return false;
                pin.focus();

            }
            else if (pin.length != 6) {
                $('#valid_msg1').show().text('Enter a 6-digit Pin Number');
                return false;
                pin.focus();

            }

            else if (pin.length == 6)
            {

                $.ajax({
                    method: "POST",
                    url: "<?php echo base_url(); ?>Mycart/pincode_check",
                    data: {pincode: pin},
                    success: function (data) {
                        //$("#ss").html(data);
                        if (data == 'COD') {
                            //$('#pin-msg').text('Product is available at your location with COD');
                            $('#pin-msg').show();
                            $('#pin_msg_cod').show();
                            $('#valid_msg1').hide();

                            codcharge_chk(curprice);

                        }
                        else
                        {
                            //$('#pin-msg').text('Product is available at your location');
                            $('#pin-msg').show();
                            $('#pin_msg_cod').hide();
                            $('#valid_msg1').hide();
                            $('#codchrg_spn').hide();
                        }

                    }
                });

            }

        }
        function codcharge_chk(curprice)
        {
            var pin = document.getElementById('pin').value;
            var prodid =<?= $this->uri->segment(2); ?>

            $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>Mycart/prodcod_chargesapply",
                data: {pincode: pin, prodid: prodid, curprice: curprice},
                success: function (data) {
                    if (data) {
                        //$('#pin-msg').show();
                        $('#codchrg_spn').html(data);
                        $('#codchrg_spn').show();
                        $('#valid_msg1').hide();
                    }
                    else
                    {
                        //$('#pin-msg').show();
                        //$('#pin_msg_cod').hide();
                        $('#codchrg_spn').hide();
                        $('#valid_msg1').hide();
                    }

                }
            });

        }
    </script>


    <script>

        function load_colorsizeajax() {


            var prod_skuclrsize = "<?php echo $this->uri->segment(3); ?>";

            //$("#viewmorebtns_loader").css('display','block');
            $.ajax({
                url: '<?php echo base_url() . 'Product_description/singlepord_colorsizeajax' ?>',
                method: "post",
                data: {prod_skuclrsize: prod_skuclrsize},
                success: function (data) {
                    //$("#firstproduct_loader").css('display','none');
                    $("#corlsize_attrbdivid").html(data);

                }
            });
        }

        function populate_productattribute() {

            var prod_idajx = "<?php echo $this->uri->segment(2); ?>";
            var prod_skuclrsize = "<?php echo $this->uri->segment(3); ?>";

            $.ajax({
                url: '<?php echo base_url() . 'Product_description/singlepord_attributeajax' ?>',
                method: "post",
                data: {prod_idajx: prod_idajx, prod_skuclrsize: prod_skuclrsize},
                success: function (data) {

                    $("#singleprod_attrb_divid").html(data);

                }
            });
        }


        $(document).ready(function () {
            load_colorsizeajax();

            populate_productattribute();


        });
    </script>
    <script>
        function addWishlistFunction(product_id, sku) {
            $.ajax({
                url: '<?php echo base_url(); ?>user/add_wishlist',
                method: 'post',
                data: {product_id: product_id, sku: sku},
                success: function (result) {
                    //alert(result);
                    if (result == 'success') {
                        //alert('successfully added');
                        window.location.reload(true);
                    }
                    if (result == 'exists') {
                        window.location.href = '<?php echo base_url(); ?>wish-list';
                    }
                }
            });
        }

        function addWishlistFunction_temp(product_id, sku)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>user/add_wishlist_temp',
                method: 'post',
                data: {product_id: product_id, sku: sku},
                success: function (result) {
                    //alert(result);
                    if (result == 'success') {
                        //alert('successfully added');
                        //window.location.reload(true);
                    }
                    if (result == 'exists') {
                        window.location.href = '<?php echo base_url(); ?>wish-list';
                    }
                }
            });
        }

    </script>

    <?php require_once('schema_org_googleautosearch.php'); ?>

    <link href="<?php echo base_url(); ?>rateit/src/rateit.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>rateit/src/jquery.rateit.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>new_js/js/single-prod-accordian.js"></script>    
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57921268b212b919"></script>
</body>
</html>