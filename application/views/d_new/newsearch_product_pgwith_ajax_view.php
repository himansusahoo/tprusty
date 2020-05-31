<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">

        <?php
        $search_title = trim(str_replace(' ', '%20', $this->uri->segment(3)));
        $curl_strng = SOLR_BASE_URL . "mycollection2_offline/select?indent=on&q=" . $search_title . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=1&start=0";


        $curl2 = curl_init($curl_strng);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl2);
        $product_data_sco = json_decode($output, true);
        //echo '<pre>';print_r($product_data_sco);exit;
        if ($product_data_sco['response']['numFound'] == 0) {
            $sugword = $product_data_sco['spellcheck']['collations'][1];

            $this->load->library('session');

            $this->session->set_userdata('sugstword', $sugword);

            $searchsuggst_txt = trim(str_replace(' ', '%20', $sugword));
            //echo $searchsuggst_txt;exit;
            $curl_strng = SOLR_BASE_URL . "mycollection2_offline/select?indent=on&q=" . $searchsuggst_txt . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=50&start=0";


            $curl3 = curl_init($curl_strng);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            $output3 = curl_exec($curl3);
            $product_data_sco = json_decode($output3, true);
        }
        ?>
        <?php
        //echo '<pre>';print_r($product_data_sco);exit;
        $cnt = count($product_data_sco['facet_counts']['facet_fields']['Category_Lvl3']);
        if ($cnt == 2) {
            $Category_Lvl3 = array();
            for ($i_arr = 0; $i_arr < $cnt; $i_arr += 2) {
                $Category_Lvl3[] = $product_data_sco['facet_counts']['facet_fields']['Category_Lvl3'][$i_arr];
            }
            $category_lvl3 = implode(",", $Category_Lvl3);
            ?>
            <meta name="Description" content="<?php echo ucfirst(DOMAIN_NAME) . ':' . str_replace("%20", " ", $this->uri->segment(3)) . ',' . $category_lvl3; ?>">
            <meta name="Keywords" content="<?php echo str_replace("%20", " ", $this->uri->segment(3)) . ',' . $category_lvl3 . ',' . ucfirst(DOMAIN_NAME); ?>" />
            <title><?php echo ucfirst(DOMAIN_NAME) . ':' . str_replace("%20", " ", $this->uri->segment(3) . '-' . $category_lvl3); ?></title>
        <?php } else { ?>
            <meta name="Description" content="<?php echo ucfirst(DOMAIN_NAME) . ':' . str_replace("%20", " ", $this->uri->segment(3)); ?>">
            <meta name="Keywords" content="<?php echo str_replace("%20", " ", $this->uri->segment(3)) . ',' . ucfirst(DOMAIN_NAME); ?>" />
            <title><?php echo ucfirst(DOMAIN_NAME) . ':' . str_replace("%20", " ", $this->uri->segment(3)); ?></title>
        <?php } ?>

        <link rel="canonical" href="<?php echo base_url() . 'demo/search-by/' . $this->uri->segment(3); ?>"/>

        <?php
        include "header.php";
        ?><!------ Start Content ------>

        <style>
            /* carousel */
            .media-carousel 
            {
                margin-bottom: 0;
                padding: 0 40px 0px 40px;
            }
            /* Previous button  */
            .media-carousel .carousel-control.left 
            {

                background-image: none;
                background: none;
                border: 4px solid #FFFFFF;
                border-radius: 23px 23px 23px 23px;
                height: 35px;
                width: 35px;
                margin-top: 8px;
                color: #000;
                padding-top: 0;
                font-size: 31px;
                line-height: 23px;
                text-shadow: none;

            }
            /* Next button  */
            .media-carousel .carousel-control.right 
            {

                background-image: none;
                background: none;
                border: 4px solid #FFFFFF;
                border-radius: 23px 23px 23px 23px;
                height: 35px;
                width: 35px;
                margin-top: 8px;
                color: #000;
                padding-top: 0;
                font-size: 31px;
                line-height: 23px;
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

            .thumbnail{ margin-bottom:0;}

            .title:after, .title:before {
                display: inline-block;
                height: 3px;
                content: " ";
                text-shadow: none;
                background-color: #ed2541;
                width: 290px;
            }
            .form-control {
                padding: 6px 2px;
            }
            /*.content_box{ border:1px solid #f2f2f2;}*/
            .content_box h6 {
                color: #fff;
                z-index: 1;
                position: absolute;
                top: -5px;
                left: 2%;
                font-size: .8em;
            }

            .discount-off:before {
                content: '';
                width: 0;
                height: 0;
                border-top: 60px solid #0280e1;
                border-right: 60px solid transparent;
                position: absolute;
                top: 0;
                left: 0;
                -webkit-transition: .5s all;
                -moz-transition: .5s all;
                -o-transition: .5s all;
                -ms-transition: .5s all;
                transition: .5s all;
            }
            .content_box h5{
                margin:0;
                text-align:center; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;
            }
            .content_box h5 a {
                color: #0280e1;
                font-weight: normal;
                font-size: 15px;
                margin:0;
                font-family: Calibri,Arial,Helvetica,sans-serif;
            }
            .price-through{
                margin-bottom:10px;
            }
            .price-recent{
                display: inline-block;font-size: 16px;font-weight: 500; color: #212121;
            }
            .original-price{
                text-decoration: line-through; display: inline-block; margin-left: 8px;font-size: 14px; color: #878787;
            }
            .off-price{
                display: inline-block;
                margin-left: 8px;
                color: #388e3c;
                font-size: 13px;
                letter-spacing: -0.2px;
                font-weight: 500;
            }
            .out-of-stock{
                width: 100%;
                font-size: 16px;
                margin: 0 auto;
                border-radius: 2px;
                background-color: #fff;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .12);
                text-align: center;
                padding: 10px 15px;
                text-transform: uppercase;
                pointer-events: none;
                position: absolute;
                left: 50%;
                -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
                top:50%;
            }
            .out-of-stock span{color: #ff6161; line-height:1;}
            .row1 {
                height: 110px;
            }
            .jspPane {
                padding: 3px!important; 
            }
            .btn-go {
                background-color: #6bb700;
                color: #fff;
                font-size: 13px;
                padding: 4px 10px;
                float: none;
                border: 0;
                margin: 10px 0px;
                text-align: center;
            }
            .rst_spn {
                cursor: pointer;
                display: inline-block;
                font-size: 12px;
                background-color: #ececec;
                box-shadow: 0 2px 4px 0 rgba(255, 255, 255, .5);
                border-radius: 3px;
                margin: 2px 4px;
                overflow: hidden;
                transition: background-color 0.1s;
                max-width: 200px;
                padding: 8px;

            }
            .rst_spn:hover{ text-decoration:line-through;}

            .filter-form h4 {
                margin-top: 10px;
                padding: 12px;
                color: #333;
                /* border-bottom: 1px solid #f0f0f0; */
                margin-bottom: 0;
                font-weight: bold;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.3px;
                font-family: Roboto, Arial, sans-serif;
            }
            .f_sidebar {
                border: none;
                margin-bottom: 20px;
            }
            .KG9X1F ._2Wy-am {
                font-weight: bold;
                font-size: 16px;
                margin-top: 8px;
                display: inline-block;
                font-family: Roboto, Arial, sans-serif;
                letter-spacing: 0;
            }
            .dropdown_left {
                float: left;
                width: 100%;
            }
            .C5rIv_ {
                display: inline-block;
                margin-left: 10px;
                color: #878787;
                font-size: 12px;
                font-family: Roboto, Arial, sans-serif;
                letter-spacing: 0;
            }
            .catlg {
                height: auto !important;
            }
            .grid1_of_4:hover{box-shadow: 0 3px 16px 0 rgba(0, 0, 0, .11);
            }
            /* End carousel */
            div#more-brand{
                position: absolute;
                color: black;
                display: none;
                display: block;
                height: 245px;
                width: 868px;
                border: 1px solid #CCC;
                z-index: 999;
                margin: -86px 24px 20px 144px;
                background: #fff;
                overflow-x: scroll;
                white-space: nowrap;
                border-radius: 2px;
                display: flex;
                flex-wrap: wrap;
                flex-direction: column;
            }
            #more-close {
                float:right;
                display:inline-block;
                padding:2px 5px;

            }
            .alfa{
                letter-spacing: 2px;
                font-size: 12px;
                padding: 18px 22px 0;
                color: #888;
            }
            .padd{
                padding: 18px 22px 0;
            }
            .column-more{
                float: left;
                width: 100%;
                height: 176px;
                white-space: nowrap;
                display: flex;
                flex-wrap: wrap;
                flex-direction: column;
            }
            .column-more2{
                float: left;
                height: 176px;
                width: 125px;
                white-space: nowrap;
                display: flex;
                flex-wrap: wrap;
                flex-direction: column;
            }
            .column-more label.checkbox{ width:125px;}

            .mtree-skin-selector {
                text-align: center;
                background: #EEE;
                padding: 10px 0 15px;
            }

            .mtree-skin-selector li {
                display: inline-block;
                float: none;
            }

            .mtree-skin-selector button {
                padding: 5px 10px;
                margin-bottom: 1px;
                background: #BBB;
            }

            .mtree-skin-selector button:hover { background: #999; }

            .mtree-skin-selector button.active {
                background: #999;
                font-weight: bold;
            }

            .mtree-skin-selector button.csl.active { background: #FFC000; }
            .top-list{
                background: #f5f5f5;
                padding: 10px;
                -moz-box-shadow: 0 0 5px #888;
                -webkit-box-shadow: 0 0 5px#888;
                box-shadow: 0 0 5px #888;
                margin-bottom: 21px;

            }
            a.button.act {
                background: #0066c0;
                padding: 12px 7px 2px;
                color: #fff;
                border-radius: 6px;
            }
            i.fa.fa-list {
                font-size: 25px;
                margin-right:5px;
            }
            i.fa.fa-th-large{font-size: 25px;}
            .short-by{
                width: 15px;
                height: 17px;
                display: inline-block;
                position: relative;
                top: -2px;
                margin-right: 7px;
                background:url(image/shortby.png) no-repeat;
                background-size: 250px auto;
                background-position: -114px -152px !important;
            }
            .shortby-link{
                display: inline-block;
                text-decoration: none;
                color: #353535;
                line-height: 25px;
                -webkit-transition: all .3s ease-in-out;
                -moz-transition: all .3s ease-in-out;
                -ms-transition: all .3s ease-in-out;
                -o-transition: all .3s ease-in-out;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                text-align: center;
            }
            i.ali {
                vertical-align: 4px;
                font-weight: bold;
                color: #0066c0;
                font-size: 18px;
            }
            span.sp {
                vertical-align: 6px;
                font-size: 13px;
                /* font-weight: bold; */
                color: #333;
                margin-left: -1px;
            }
            .listing-title {
                font-weight: 500;
                font-size: 18px;
                display: block;
                cursor: pointer;
                color: #2874f0;
                margin-bottom: 14px;
            }
            .listing-sub-title {
                font-weight: bold;
                display: inline-block;
                margin-right: 14px;

            }
            .rateit .rateit-range {
                position: relative;
                display: -moz-inline-box;
                display: inline-block;
                background:url(image/star.gif);
                height: 16px;
                outline: none;
            }
            .listing-ul{
                margin-top: 5px;
                color: #212121;
                line-height: 22px;
                display: table;
            }
            .listing-ul-li{
                display: table-row;
                padding-right: 8px;
                color: #212121;
                line-height: 25px;
            }
            .discount {
                border-radius: 50%;
                width: 50px;
                height: 50px;
                text-align: center;
                background: #ed2541;
                border: 1px solid #ed2541;
                color: #fff;
                font-weight: bold;
                margin-left: 40px;
                float: left;
                margin-top: 50px;
            }
            .discount p {
                font-size: 13px;
                line-height: 17px;
                letter-spacing: 1px;
                text-align: center;
            }
            .payment-mode ul li {
                display: block;
                float: none;
                padding: 8px 1px;
                font-size: 12px;
                color: #989898;
            }
            .payment-mode ul li span {
                background-color: #989898;
                color: #fff;
                padding-left: 2px;
                font-size: 12px;
                margin-right: 3px;
            }
            a#act2 {
                padding: 12px 1px 3px 5px;
            }

            .liner-shadow {
                position: relative;
                overflow: hidden;
                /* width: 38%; */
                /* margin-right: 18px; */
            }
            .liner-shadow:before {
                content: "";
                position: absolute;
                z-index: 1;
                width: 10px;
                /* top: 2%; */
                height: 100%;
                right: -11px;
                border-radius: 5px / 100px;
                box-shadow: 0 0 7px rgba(0,0,0,0.6);
                display:none;
            }	
            .search-bold{
                font-size:15px; font-weight:bold; width: 125px; color:#333;
            }
            li.has-sub ul li label {
                margin-left: 31px;
            }
        </style>

        <link href="<?php echo base_url() ?>new_css/css/mtree.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>new_css/css/search-left-3rdsection-menu.css" />
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>new_js/js/search-left-3rdsection-menu.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.js"></script>
        <script>
            function menuvisibility(val) {
                //alert(val);
                if (val == 'menu1') {

                    //alert('Menu1');
                    document.getElementById('menu1').style.display = "block";
                    document.getElementById('menu2').style.display = "none";
                    //$("#act1").toggleClass("act"); 
                    $("#act1").addClass("act");
                    $("#act2").removeClass('act');
                    $('div.list_view_morebtn').removeAttr('id');
                    $('div.grid_view_morebtn').attr("id", "view_more_dv");



                }
                if (val == 'menu2') {
                    //alert('Menu2');
                    document.getElementById('menu2').style.display = "block";
                    document.getElementById('menu1').style.display = "none";
                    //$("#act2").toggleClass("act"); 
                    $("#act1").removeClass("act");
                    $("#act2").addClass('act');
                    $('div.grid_view_morebtn').removeAttr('id');
                    $('div.list_view_morebtn').attr("id", "view_more_dv");


                }
            }
        </script>

        <script language="JavaScript">
            function setVisibility(id, visibility) {
                document.getElementById(id).style.display = visibility;
            }
        </script>
        <script>
            function scrollWin(x, y) {
                window.scrollBy(x, y);
            }
        </script>
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

            function ShowMoreData(result_no) {
                //alert("sdf");return false;

                //var title ="<?php //echo $_GET['search'];       ?>";
                var title = "<?php echo $this->uri->segment(3); ?>";
                //alert(title);
                var numItems = parseInt($('.grid1_of_4').length);
                //alert(numItems);
                if (numItems + 50 > result_no)
                {
                    var shownumItems = result_no;
                } else {
                    var shownumItems = numItems + 50;
                }
                document.getElementById("content").innerHTML = shownumItems;
                var result_no = parseInt(result_no);
                //alert(result_no);
                $.ajax({
                    url: '<?php echo base_url(); ?>Product_description_search/show_more_search_product_data',
                    method: 'get',
                    data: {from: numItems, title: title},
                    beforeSend: function () {
                        $('.view_mor').hide();
                        $('#lodr_img').show();
                        $('.list_view_lodr_img').show();
                    },
                    complete: function () {
                        $('#lodr_img').hide();
                        $('.list_view_lodr_img').hide();
                        $('.view_mor').show();

                    },
                    success: function (result) {
                        //alert(result);
                        var $holdermore = $('<div/>').html(result);
                        //$('.grids_of_4').append(result);
                        //$('.grids_of_4').append(result);
                        $('.grids_of_4').append($('#htmlmore1', $holdermore).html());
                        $('.grids_of_4list').append($('#htmlmore2', $holdermore).html());
                        $('#scrol_tracktxtbox').val('wait to scroll');
                        if (numItems == result_no) {
                            $('.view_mor').hide();
                            $('#view_more_dv').html('<span>No more product available!</span>');
                        }
                    }
                });
            }


        </script>

        <script>

            function loadfirstproductsearchajax() {

                //var srch_data ="<?php //echo $_GET['search'];       ?>";
                var srch_data = "<?php echo $this->uri->segment(3); ?>";

                //$("#viewmorebtns_loader").css('display','block');
                $.ajax({
                    url: '<?php echo base_url() . 'Product_description_search/search_firstproductloadajax' ?>',
                    method: "post",
                    data: {search_data: srch_data},
                    success: function (data) {
                        //alert(data);
                        var $holder = $('<div/>').html(data);
                        $("#firstproduct_loader").css('display', 'none');
                        //$("#ajaxprodload_divid").html(data);
                        $('#ajaxprodload_divid').html($('#html1', $holder).html());
                        $('#ajaxprodload_dividlist').html($('#html2', $holder).html());
                        // var $holder = $('<div/>').html(responseHtml);
                        //$('#coupon').html($('#coupon', $holder).html());
                    }
                });
            }

            $(document).ready(function () {
                loadfirstproductsearchajax();
                $("#act1").addClass('act');               
            });

            function loadajax() {

                var srch_data = "<?php echo $this->uri->segment(3); ?>";
                //alert(srch_data);return false;
                //$("#catg_loader").css('display','block');
                $.ajax({
                    url: '<?php echo base_url() . 'Product_description_search/product_searchcategory_ajax' ?>',
                    method: "post",
                    data: {search_data: srch_data},
                    success: function (data) {
                        $("#catg_loader").css('display', 'none');
                        $("#product_catgdiv").html(data);

                    }
                });
            }
           
            $(document).ready(function () {
                setTimeout(function () {
                    //loadproductcountajax();
                }, 10000); // milliseconds
            });

            function loadviewmorebuttonajax() {

                //var srch_data ="<?php //echo $_GET['search'];       ?>";
                var srch_data = "<?php echo $this->uri->segment(3); ?>";

                //$("#viewmorebtns_loader").css('display','block');
                $.ajax({
                    url: '<?php echo base_url() . 'Product_description_search/product_searchvewmorebtn_ajax' ?>',
                    method: "post",
                    data: {search_data: srch_data},
                    success: function (data) {
                        //$("#viewmorebtns_loader").css('display','none');
                        $("#view_more_dv").html(data);

                    }
                });
            }


            $(document).ready(function () {
                setTimeout(function () {
                    loadviewmorebuttonajax();
                }, 10000); // milliseconds
            });

        </script>
    <div class="container" style="width: 100%; margin-top: 58px; padding: 0; background:#f3f3f3; padding:5px;">
        <div class="sujit_test"></div>
        <div class="row" style="margin-top:10px;">
            <!--------------------------------- Start of Filter bar------------------------------------------------------------------------------------------>

            <div class="col-md-3 filter" style="width:250px; padding: 0;position: relative;background: #fff;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); margin-left:16px;">
                <div style="width:50%; float:left; padding: 10px; text-align:left;"><h4 style="margin:10px 0 0 0;">Filter</h4></div>
                <div style="width:50%; float:right; padding: 10px; text-align:right"><h6 style="color:blue;">Clear All</h6></div>
                <div style="clear:both;"></div>
                <div style="width:100%; height:auto; margin:5px 0 10px 0;">
                    <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
                    <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
                    <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
                    <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
                    <span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
                </div>
                <div style="clear:both"></div>

                <!-- Price filtering section start-->
                <div class="f_sidebar" style="background:#fff;">
                    <section class="filter-form" style="margin: -12px 10px 10px;border: 1px solid #ececec;">
                        <h4 style="background:#ececec; padding:10px 20px; margin-top: 0px; font-size:15px;">Price</h4>
                        <div class="row1 scroll-pane" style="overflow: hidden; padding: 0px; width:100%;">
                            <div class="jspContainer" style="width:100%; height: 110px;">
                                <div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 100%;">
                                    <div class="col-sm-12">
                                        <div class="jspPane" style="padding: 0px; top: 0px; left: 0px;"><div class="col col-4">
                                                <div class="price-range"> FROM : <br> <input type="text" name="start_pric" id="start_pric" placeholder="(Rs.)"> </div>
                                                <div class="price-range"> TO :  <br> <input type="text" name="end_pric" id="end_pric" placeholder="(Rs.)"> </div>
                                                <div style="width:100%; margin:auto; text-align:center;">
                                                    <input class="btn-go hvr-sweep-to-right" type="button" value="Search" onclick="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Price filtering section end-->

                <!-- Type filtering section Start-->
                <div id='search-left'>
                    <ul>
                        <li><a href='http://google.com'><span>Home</span></a></li>
                        <li><a href='http://google.com'><span>Products</span></a>
                            <ul >
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> Apple  
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> HTC
                                    </label>
                                    <a  href="#1" onclick="setVisibility('more-brand', 'inline');" ;>195 More</a>

                                    <div style="display:none;" id="more-brand">
                                        <div class="row" style="background:#f2f2f2; padding:2px 0; margin:0;">
                                            <div class="col-lg-2 padd">Brand</div>
                                            <div class="col-lg-3 padd"><input type="text" placeholder="Search Brand" class="_2rhM-s"></div>
                                            <div class="col-lg-6 alfa" ># A B C D E F G H I J K L M N O P Q R S T U V W X Y Z</div>
                                            <div class="col-lg-1 padd"><a id="more-close" href="#" onclick="setVisibility('more-brand', 'none');";>x</a></div>
                                        </div>
                                        <ul class="aco" style="padding:10px;">
                                            <li class="column-more">
                                                <h5 class="search-bold">Popular</h5>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>

                                                <h5 class="search-bold">A</h5>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>

                                                <h5 class="search-bold">B</h5>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>

                                                <h5 class="search-bold">C</h5>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> Apple  
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="" name="" value="" onchange="">
                                                    <i></i> HTC
                                                </label>
                                            </li>
                                        </ul>
                                    </div>

                                </li>

                            </ul>
                        </li>
                        <li><a href='#'><span>Color</span></a>
                            <ul>
                                <li>

                                    <label class="checkbox">
                                        <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> Apple  
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> HTC
                                    </label>

                                </li>
                            </ul>
                        </li>
                        <li><a href='#'><span>Color</span></a>
                            <ul>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> Apple  
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" id="" name="" value="" onchange="">
                                        <i></i> HTC
                                    </label>  
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Type filtering section end-->        
                <div class="clearfix"></div>
                <!-------Nested accordian start---------->  
                <ul class="mtree transit">

                    <li><a href="#">Mobile</a>
                        <ul>
                            <li><a href="#">Smart Phone</a>
                                <ul>
                                    <li><a href="#">Brand</a>
                                        <ul>
                                            <li><a href="#"><input type="checkbox" id="" name="" value="" onchange="">Apple</a></li>
                                            <li><a href="#"><input type="checkbox" id="" name="" value="" onchange="">HTC</a>                                               
                                            </li>
                                            <li><a href="#"><input type="checkbox" id="" name="" value="" onchange="">Lousiana</a></li>
                                            <li><a href="#"><input type="checkbox" id="" name="" value="" onchange="">Texas</a></li>
                                            <li><a href="#"><input type="checkbox" id="" name="" value="" onchange="">Nevada</a></li>
                                            <li><a href="#"><input type="checkbox" id="" name="" value="" onchange="">Montana</a></li>
                                            <li><a href="#"><input type="checkbox" id="" name="" value="" onchange="">Virginia</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">Feature Phones</a>
                                <ul>
                                    <li><a href="#">Mexico</a></li>
                                    <li><a href="#">Honduras</a></li>
                                    <li><a href="#">Guatemala</a></li>
                                </ul>
                            </li>
                            <li><a href="#">4g Phones</a>
                                <ul>
                                    <li><a href="#">Brazil</a></li>
                                    <li><a href="#">Argentina</a></li>
                                    <li><a href="#">Uruguay</a></li>
                                    <li><a href="#">Chile</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li><a href="#">Electronics</a>
                        <ul>
                            <li><a href="#">Computers & Accessories</a>
                                <ul>
                                    <li><a href="#">Brand</a>
                                        <ul>
                                            <li><a href="#">Laptops</a></li>
                                            <li><a href="#">Computer Components</a>                                               
                                            </li>
                                            <li><a href="#">Softwares</a></li>
                                            <li><a href="#">Texas</a></li>
                                            <li><a href="#">Nevada</a></li>
                                            <li><a href="#">Montana</a></li>
                                            <li><a href="#">Virginia</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">Home Appliances</a>
                                <ul>
                                    <li><a href="#">Mexico</a></li>
                                    <li><a href="#">Honduras</a></li>
                                    <li><a href="#">Guatemala</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Kitchen Appliances</a>
                                <ul>
                                    <li><a href="#">Brazil</a></li>
                                    <li><a href="#">Argentina</a></li>
                                    <li><a href="#">Uruguay</a></li>
                                    <li><a href="#">Chile</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>
                <!-------Nested accordian end---------->

            </div>
            <!--------------------------------- End of Filter bar------------------------------------------------------------------------------------------>
            <div class="col-md-9" style="width:80%; background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); float:right;">
                <div style="width:1000%;">
                    <a href="<?= APP_BASE ?>" style="color:#878787; font-size:12px;">Home > </a>
                    <a href="<?php echo base_url() . 'demo/search-by/' . $this->uri->segment(3); ?>" style="color:#878787; font-size:12px;">Search > </a>
                    <a href="<?php echo base_url() . 'demo/search-by/' . $this->uri->segment(3); ?>" style="color:#878787; font-size:12px;"><?php echo ucwords($product_data_sco['responseHeader']['params']['q']); ?> </a>
                </div>


                <div style="clear:both;"></div>

                <div style="width:70%; float:left;">
                    <div class="KG9X1F">
                        <h2 class="_2Wy-am"><?php echo ucwords($product_data_sco['responseHeader']['params']['q']); ?></h2>
                        <div class="C5rIv_">
                            <span><!-- react-text: 19571 -->(Showing 1 – <samp id="content">50</samp> products of <?php echo $product_data_sco['response']['numFound']; ?> products)<!-- /react-text --></span>
                        </div>
                    </div>
                </div>

                <div style="width:30%; float:right; text-align:right;">
                    <div class="dropdown_left">
                        <div class="ac" align="right" style="margin-right:19px; margin-bottom:10px;">
                            <a class="button" data-rel="#content-a" id="act1" href="#" onclick="menuvisibility('menu1');">
                                <i class="fa fa-th-large" aria-hidden="true"></i></a>&nbsp;&nbsp;
                            <a class="button" data-rel="#content-a" id="act2" href="#" onclick="menuvisibility('menu2');">
                                <i class="fa fa-list" aria-hidden="true"></i></a>           
                            <a href="#" id="act3"><i class="fa fa-sort-amount-desc ali"  aria-hidden="true"></i> <span class="sp">Sort</span></a>  
                        </div>
                    </div>
                </div>
                <div id="menu1">            
                    <div class="w_content">
                        <div class="catlog">
                            <div class="clearfix"> </div>
                        </div>
                        <!-- grids_of_4 -->
                        <div class="grids_of_4" id="ajaxprodload_divid">

                            <!-- display ajax data sujit-->
                            <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url() . 'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>


                        </div>
                        <!-- end grids_of_4 -->

                        <div class="clearfix"></div>
                        <div id="view_more_dv" class="grid_view_morebtn" >
                            <img src="<?= APP_BASE ?>images/loader.gif" id="lodr_img" class="grid_view_lodr_img" style="display:none;">
                            <input style="display:none;" type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">
                        </div>

                    </div>
                </div>

                <div id="menu2" style="display:none;">
                    <div class="w_content">
                        <div class="catlog">
                            <div class="clearfix"> </div>
                        </div>
                        <!-- grids_of_4 -->
                        <div class="grids_of_4list" id="ajaxprodload_dividlist">
                            <!-- display ajax data sujit-->
                            <div id="firstproduct_loader" align="center" style="vertical-align:middle; padding-top:100px;"><img src="<?php echo base_url() . 'images/fbloading.gif' ?>" style="width:20px; height:20px;" /><br>Loading...</div>


                        </div>
                        <!-- end grids_of_4 -->

                        <div class="clearfix"></div>
                        <div id="view_more_dv" class="list_view_morebtn" >
                            <img src="<?= APP_BASE ?>images/loader.gif" id="lodr_img" class="list_view_lodr_img" style="display:none;">
                            <input style="display:none;" type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="clearfix">&nbsp;</div>



    <?php include "footer.php" ?> 


    <script>
        function addWishlistFunction(product_id, sku) {

            $.ajax({
                url: '<?php echo base_url(); ?>user/add_wishlist',
                method: 'post',
                data: {product_id: product_id, sku: sku},
                success: function (result) {

                    if (result == 'success') {
                        alert('successfully added');
                    }
                    if (result == 'exists') {
                        window.location.href = '<?php echo base_url(); ?>wish-list';
                    }
                }
            });
        }
    </script> 

    <script>
        function getFiltercat_id(cat_id, curnt_url, sl) {
            var checked = $('#cat_checkbox' + sl).is(':checked');
            if (checked) {
                //alert(curnt_url+cat_id);
                $.ajax({
                    url: '<?php echo base_url(); ?>product_description/filtered',
                    method: 'post',
                    data: {category_id: cat_id},
                });
            } else {
                //alert(curnt_url+'-'+cat_id);
            }
        }
    </script>

    <script>
        function thirdBrandFilter(brand, cat_name, cat_id) {
            window.location.href = '<?php echo base_url(); ?>product_description/filteredbrand/' + cat_name.replace(" ", "-") + '/' + cat_id + '/' + 'brnd&' + brand;
        }

        function thirdPriceFilter(price_slab, cat_name, cat_id) {
            window.location.href = '<?php echo base_url(); ?>product_description/filteredprice/' + cat_name.replace(" ", "-") + '/' + cat_id + '/' + 'prce&' + price_slab;
        }

        function thirdMultiFilter(price_brnd, cat_id, cat_name, val) {
            window.location.href = '<?php echo base_url(); ?>product_description/multifilter/' + cat_name.replace(" ", "-") + '/' + cat_id + '/' + price_brnd + '/' + val;
        }
    </script>


    <script>
        function redirectCategoryPage(category_id, cat_name) {
            //window.location.href='<?php //echo base_url();     ?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+category_id;

            window.location.href = '<?php echo base_url(); ?>' + cat_name.replace(" ", "-");
        }


        function imgError(image) {
            image.onerror = "";
            image.src = "<?php echo base_url(); ?>images/product_img/prdct-no-img.png";
            return true;
        }
    </script>

    <style>
        .vertical-alignment-helper {
            display:table;
            height: 100%;
            width: 100%;
            pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
        }
        .vertical-align-center {
            /* To center vertically */
            display: table-cell;
            vertical-align: middle;
            pointer-events:none;
        }
        .modal-content {
            /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
            width:850px;
            height:inherit;
            /* To center horizontally */
            margin: 0 auto;
            pointer-events: all;
            z-index: 10000001 !important;
        }
        .modal-header { min-height: 15px; padding: 10px; border-bottom: none;}
        /*.modal-body{padding: 10px 10px 10px 35px;}*/

        .quick_view_img img{width: auto !important; height: auto !important;}
        .quick_view_img{width:500px; height:500px;}
        .quick_view_data{height:500px; width:300px;}

        .banner2 img{width:450px !important; height:450px !important;}
        .light-box-product-details{padding: 10px;}

        #lodr_img{ width:80px; height:80px; display:none;}
        #view_more_dv{text-align:center;}
        .grid_view_lodr_img{ width:80px; height:80px; display:none;}
    </style>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/velocity/0.2.1/jquery.velocity.min.js'></script> 
    <script src="<?php echo base_url() ?>new_js/js/mtree.js"></script> 
    <script>
        $(document).ready(function () {
            var mtree = $('ul.mtree');

            // Skin selector for demo
            mtree.wrap('<div class=mtree-demo></div>');
            var skins = ['bubba', 'skinny', 'transit', 'jet', 'nix'];
            mtree.addClass(skins[0]);
            $('body').prepend('<div class="mtree-skin-selector"><ul class="button-group radius"></ul></div>');
            var s = $('.mtree-skin-selector');
            $.each(skins, function (index, val) {
                s.find('ul').append('<li><button class="small skin">' + val + '</button></li>');
            });
            s.find('ul').append('<li><button class="small csl active">Close Same Level</button></li>');
            s.find('button.skin').each(function (index) {
                $(this).on('click.mtree-skin-selector', function () {
                    s.find('button.skin.active').removeClass('active');
                    $(this).addClass('active');
                    mtree.removeClass(skins.join(' ')).addClass(skins[index]);
                });
            })
            s.find('button:first').addClass('active');
            s.find('.csl').on('click.mtree-close-same-level', function () {
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>