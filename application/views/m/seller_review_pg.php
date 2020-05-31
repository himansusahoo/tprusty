<?php
include "header.php";
$this->db->cache_on();
?>
<title><?php echo uc_first(DOMAIN_NAME) . ': Seller Profile :' . $seller_data[0]->business_name; ?></title>
<link rel="canonical" href="<?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) ?>"/>
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
    }.prduct-sl-1st{
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
    .product-sl-image-held img {
        max-width: 100%;
        height: auto;
        max-height: 95px;
    }
    .best-deals {
        width: 98%;
        padding: 10px;
        margin: auto;
        border: 3px solid #ed2541 !important;
        height: 230px;
    }

    .best-deals ul{
        margin:auto;
    }
    .best-deals ul li{
        width:45%; float:left; margin:5px;
        list-style:none;
    }
    .featured-phones-held {
        width: 98%;
        padding: 10px;
        margin: auto;
        border: 3px solid #f2f2f2 !important;
        height: 445px;
        overflow-y:scroll;
    }
    .featured-phones-held ul{margin:auto;}
    .featured-phones-held ul li{
        width:45%; float:left; margin:5px 5px 16px 5px;
        list-style:none;height: 235px;
    }
    .featured-phones-sl-image-held{
        text-align:center; width:100%; margin:auto;
    }
    .featured-phones-held img {
        max-width: 100%;
        height: auto;
        max-height: 150px;
    }
    .best-deals-end{
        width:100%; 
        color:#555; font-size:13px; text-align:right;
    }
    .best-deals-heading{
        width:98%; background:#ed2541 !important; color:#fff; height:35px; margin:auto;
    }
    .ad-info h5 {
        text-align: center;
    }
    .featured-phones-heading{
        width:98%; color:#333; height:25px; margin:20px auto 0px;    text-align: left;
        font-family: /*"Adobe Song Std L"*/ /*Pristina*/ /*Perpetua*/ /*"Tekton Pro"*/ /*"Adobe Arabic"*/ "Adobe Song Std L" /*"Poor Richard"*/;
    }
</style>
<div class="wrap">
    <!--products-->
    <div class="info-products">

        <div class="info-inner">

            <!-------------------------------Seller Rivew Start---------------------------------------------->
            <?php
            $seller_review_row = $seller_review_data->num_rows();
            if ($seller_review_row > 0) {
                ////script start for avarage rating/////////
                $rating = array();
                foreach ($seller_review_data->result() as $val) {
                    $rating[] = $val->rating;
                }
                $total_sum_of_rating = array_sum($rating);
                $average_rating = ceil($total_sum_of_rating / $seller_review_row);
                ////script end for avarage rating/////////

                $slr_data = $seller_review_data->result();
                $seller_business = $slr_data[0]->business_name;
                $seller_desc = $slr_data[0]->business_desc;
                $seller_id = $slr_data[0]->seller_id;
                //print_r($seller_id);exit;
                ?>               
                <h3> <?= $seller_business; ?> </h3>

                <ul class="star">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($average_rating == $i) {
                            ?>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>                    	
                        <?php } else { ?>
                            <li> <i class="fa fa-star-o" aria-hidden="true"></i> </li>                        
                            <?php
                        }
                    }
                    ?>
    <!--<li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>-->
                    <li class="review"> | &nbsp; <?= $seller_review_row; ?> reviews </li>
                    <li><?= $seller_desc; ?></li>

                    <?php
                    $query = $this->db->query("select sum(quantity) as quantity_count from  ordered_product_from_addtocart where seller_id='$seller_id' and product_order_status='Delivered'");
                    $row = $query->result();
                    $c = $row['0']->quantity_count;
                    if ($c <= 99) {
                        echo "<li> <strong> Less than 100 Products sold </strong> </li> ";
                    } else if ($c > 99 && $c <= 199) {
                        echo "<li> <strong> More than 100 Products sold </strong> </li> ";
                    } else if ($c > 199 && $c <= 499) {
                        echo "<li> <strong> More than 200 Products sold </strong> </li> ";
                    } else {
                        echo "<li> <strong> More than 500 Products sold </strong> </li> ";
                    }
                    ?>

                    <li>
                        <?php
                        foreach ($seller_badge as $val) {
                            $badge = $val->seller_badge_type;
                            if ($badge) {
                                $badge_array = explode(',', $badge);
                                ?>

                                <?php
                                if (in_array('Moonboy Fulfilled', $badge_array)) {
                                    ?>
                                    <img src="<?php echo base_url() ?>images/moon-fulfilled.png" >
                                    <?php
                                }
                                if (in_array('Fast Shipping', $badge_array)) {
                                    ?>
                                    <img src="<?php echo base_url() ?>images/fast-delivery.png">								
                                    <?php
                                }
                                if (in_array('Star Seller', $badge_array)) {
                                    ?>
                                    <img src="<?php echo base_url() ?>images/star-seller.png">								
                                <?php }
                                ?><?php
                            }
                        }
                        ?></li>



                </ul>


                <ul class="inner-nav">
                    <li> <a href="#"> Product From This Seller </a></li>
                    <li> <a href="#"> Reviews </a></li>
                </ul>
            <?php } else { ?>

                <h3><?= $seller_data[0]->business_name; ?></h3>
                <ul class="star">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        ?>                                        	

                        <li> <i class="fa fa-star-o" aria-hidden="true"></i> </li>                        
                    <?php } ?> 


                            <!--<li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>-->
                    <li class="review"> | &nbsp; <?= $seller_review_row; ?> reviews </li>
                </ul>


                <ul class="inner-nav">
                    <li> <a href="#"> Product From This Seller </a></li>
                    <li> <a href="#"> Reviews </a></li>

                    <li><?= $seller_data[0]->business_desc; ?></li>

                    <?php
                    $seller_id = $seller_data[0]->seller_id;
                    //print_r($seller_id);exit;
                    $query = $this->db->query("select sum(quantity) as quantity_count from  ordered_product_from_addtocart where seller_id='$seller_id' and product_order_status='Delivered'");
                    $row = $query->result();
                    $c = $row['0']->quantity_count;
                    if ($c <= 99) {
                        echo "<li> <strong> Less than 100 Products sold </strong> </li> ";
                    } else if ($c > 99 && $c <= 199) {
                        echo "<li> <strong> More than 100 Products sold </strong> </li> ";
                    } else if ($c > 199 && $c <= 499) {
                        echo "<li> <strong> More than 200 Products sold </strong> </li> ";
                    } else {
                        echo "<li> <strong> More than 500 Products sold </strong> </li> ";
                    }
                    ?>
                    <?php //echo $row['0']->quantity_count;   ?>

                    <li>
                        <?php
                        foreach ($seller_badge as $val) {
                            $badge = $val->seller_badge_type;
                            if ($badge) {
                                $badge_array = explode(',', $badge);
                                ?>

                                <?php
                                if (in_array('Moonboy Fulfilled', $badge_array)) {
                                    ?>
                                    <img src="<?php echo base_url() ?>images/moon-fulfilled.png" >
                                    <?php
                                }
                                if (in_array('Fast Shipping', $badge_array)) {
                                    ?>
                                    <img src="<?php echo base_url() ?>images/fast-delivery.png">								
                                    <?php
                                }
                                if (in_array('Star Seller', $badge_array)) {
                                    ?>
                                    <img src="<?php echo base_url() ?>images/star-seller.png">								
                                <?php }
                                ?><?php
                            }
                        }
                        ?></li>




                </ul>


            <?php } ?> 
            <!--------------------------------Seller Review End--------------------------------------->

            <h3 class="tittle">View Products</h3>
            <div class="products" style="padding:0px;">	 
                <div class="container">
                    <div class="col-md-12 product-w3ls-right">			
                        <div class="products-row" id="prod_rwdiv">
                            <?php
                            foreach ($seller_data as $val) {
                                //$seller_badge = $val->seller_badge_type;
                                //$badge_array = explode(',', $seller_badge);

                                $extimg_sku = $val->sku;
                                $qr_slrprodimg = $this->db->query("select b.catelog_img_url  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$extimg_sku' ");
                                if ($qr_slrprodimg->num_rows() > 0) {
                                    $image = $qr_slrprodimg->row()->catelog_img_url;
                                } else {
                                    $image = $val->catelog_img_url;
                                }

                                //$image=$val->catelog_img_url;
                                //$skuid=$val->sku;
                                // echo $val->name;exit;
                                $image_arr = explode(',', $image);
                                $cdate = date('Y-m-d');
                                $special_price_from_dt = $val->special_pric_from_dt;
                                $special_price_to_dt = $val->special_pric_to_dt;
                                $dsply_img = $image;
                                if ($val->product_id != '' && $val->sku != '' && $image != '') {
                                    ?>

                                    <div class="col-md-3 product-grids"> 
                                        <div class="agile-products" style="max-height: 350px; min-height: 250px;">
                                            <?php
                                            $cur_prodprice = 0;
                                            $cursplprc_foroff = 0;
                                            if ($val->special_price != 0) {
                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                    $cur_prodprice = $val['special_price'];
                                                    $cursplprc_foroff = $val['special_price'];
                                                }
                                            }
                                            if ($val->price != 0 && $val->special_price == 0) {
                                                $cur_prodprice = $val->price;
                                            }

                                            if ($val->price == 0 && $cursplprc_foroff == 0) {
                                                $cur_prodprice = $val->mrp;
                                            }

                                            $percen_curprc = ((100 / $val->mrp) * $cur_prodprice);

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
                                                       href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($val->name)))) . '/' . $val->product_id . '/' . $val->sku ?>">
                                                        <img style="height: 112px; max-width: 100%; margin: auto;text-align: center;" src="<?php echo base_url(); ?>images/product_img/prdct-no-img.png"  alt="<?= $val->name; ?>"></a>
                                                <?php } else { ?>
                                                    <a style="margin:auto; text-align:center;" 
                                                       href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($val->name)))) . '/' . $val->product_id . '/' . $val->sku ?>">
                                                        <img style="height: 112px;max-width: 100%;margin: auto;text-align: center;" src="<?php echo base_url(); ?>images/product_img/<?= $image; ?>" onerror="imgError(this);"  alt="<?= $val->name; ?>">
                                                    </a>                       
                                                <?php } ?>
                                            </div>
                                            <div class="agile-product-text" >              
                                                <h5 style="text-align:left; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;"><a href="<?php echo base_url() . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($val->name)))) . '/' . $val->product_id . '/' . $val->sku ?>">
                                                        <?php
                                                        if (strlen($val->name) > 40) {
                                                            echo substr($val->name, 0, 40) . '...';
                                                        } else {
                                                            echo $val->name;
                                                        }
                                                        ?>
                                                    </a></h5> 
                                                <!--<h6><del>$200</del> $100</h6>-->


                                                <!-----------------------------------Produc price start---------------------------->

                                                <?php
                                                if ($val->special_price != 0) {
                                                    if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                        $cur_splprc = $val->special_price;
                                                        ?>                               
                                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                            <?= $val->mrp; ?> </span>
                                                        &nbsp;&nbsp;

                                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                            <?= $val->price; ?> </span>&nbsp;&nbsp;
                                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                            <?= ceil($val->special_price) ?> </span>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                                <?php if ($val->price != 0 && $cur_splprc == 0) { ?>
                                                    <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                        <?= $val->mrp; ?> </span>
                                                <?php } ?>
                                                <?php if ($val->price == 0 && $cur_splprc == 0) { ?>
                                                    <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                        <?= $val->mrp; ?> </span>
                                                <?php } ?>
                                                &nbsp;&nbsp;


                                                <?php
                                                if ($val->special_price == 0 && $val->price > 0) {
                                                    ?>                               
                                                    <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
                                                        <?= ceil($val->price) ?> </span>
                                                <?php } ?>
                                                <!-----------------------------------Product Price End----------------------------->
                                            </div>
                                        </div> 
                                    </div><?php
                                }
                            }
                            ?>
                        </div></div></div></div>




            <div class="clearfix"> </div>
            <div class="pagination">
                <p><?php
                    if (isset($links)) {
                        echo '<li>' . $links . '</li>';
                    }
                    ?></p>
            </div>
            <div class="clearfix"> &nbsp; </div>

            <!----------------------Seller Review Description Start----------------------->

            <h4>REVIEWS & RATINGS</h4><hr/>

            <?php if ($seller_review_row > 0) { ?>

                <table width="100%" class="table-striped">
                    <?php
                    $sl = 0;
                    foreach ($seller_review_data->result() as $review_row) {
                        $sl++;
                        ?>
                        <tr>
                            <td width="20%">
                                <ul class="star">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($average_rating == $i) {
                                            ?>
                                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>                    	
                                        <?php } else { ?>
                                            <li> <i class="fa fa-star-o" aria-hidden="true"></i> </li>                        
                                            <?php
                                        }
                                    }
                                    ?>
        <!--<li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>-->
                                    <li class="review"> | &nbsp; <?= $seller_review_row; ?> reviews </li>
                                </ul>
                                <div class="rateit" data-rateit-backingfld="#backing<?= $sl; ?>c<?= $sl; ?>" data-rateit-min="0"></div>

                                <?php
                                $date = $review_row->added_date;
                                $dt = new DateTime($date);
                                ?>
                                <h4> <span style="color:#5d9b05;"> <?= $review_row->fname; ?> </span> <span class="rev_date">on <?= $dt->format('Y-m-d'); ?> </span></h4>
                            </td>
                            <td width="80%"> <h4> <?= $review_row->title; ?> </h4>
                                <p> <?= $review_row->content; ?> </p></td>

                        </tr>

                    <?php } ?>
                </table>


            <?php } else { ?>

                <table width="100%" class="table-striped">
                    <tr height="20px"><td colspan="5">No Reviews.</td></tr>
                </table>
            <?php } ?>
            <!----------------------Seller Review Description End-------------------------->      




        </div>
        <!--//item-->

    </div>


    <?php include "footer.php"; ?>