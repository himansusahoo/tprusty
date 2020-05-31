<?php include 'header.php'; ?>   

<div class="wrap" >	
    <div class="details-grid">
        <div class="details-shade">


            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active"> <a href="<?= APP_BASE ?>product_description/product_addtocart/34/223">  <img alt="" src="<?php echo base_url() ?>mobile_css_js/images/banner1.jpg"  width="" height="" /> </a>  </div>
                    <div class="item"> <a href="<?= APP_BASE ?>product_description/product_addtocart/34/85"> <img alt="" src="<?php echo base_url() ?>mobile_css_js/images/banner2.jpg"  width="" height="" /> </a> </div>
                    <div class="item"> <a href="<?= APP_BASE ?>product_description/product_addtocart/34/148"> <img alt="" src="<?php echo base_url() ?>mobile_css_js/images/banner3.jpg"  width="" height="" /> </a> </div>
                    <div class="item"> <a href="<?= APP_BASE ?>product_description/product_addtocart/34/82"> <img alt="" src="<?php echo base_url() ?>mobile_css_js/images/banner4.jpg"  width="" height="" /> </a> </div>
                    <div class="item"> <a href="<?= APP_BASE ?>product_description/product_addtocart/34/225"> <img alt="" src="<?php echo base_url() ?>mobile_css_js/images/banner5.jpg"  width="" height="" /> </a> </div>


                </div> <!-- Wrapper for slides -->
            </div>

        </div>
    </div>

    <div>
        <a  href="<?php echo base_url() . 'Product_description/product_search?search=valentine' ?>"><img style="width:176px;height:32px;float:left;" src="<?php echo base_url() . 'images/valentine_2017-02-02.gif' ?>"></a>

        <a  href="#"><img style="width:176px;height:32px;float:right;" src="<?php echo base_url() . 'images/mobile_republic_deal.jpg' ?>"></a>


    </div>                
    <!----------------------------------- BEST Seller Start--------------------------------------->
    <?php if ($product_result->num_rows() != 0) { ?>
        <div class="goals" id="sales">

            <div class="welcome" id="about">
                <h2 class="tittle">BEST SALES</h2>
                <?php
                foreach ($product_result->result() as $product) {
                    $cdate = date('Y-m-d');
                    $special_price_from_dt = $product->special_pric_from_dt;
                    $special_price_to_dt = $product->special_pric_to_dt;

                    $cur_price = $product->mrp;
                    if ($product->price != 0) {
                        $cur_price = $product->price;
                    }

                    if ($product->special_price != 0) {
                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                            $cur_price = $product->special_price;
                        }
                    }
                    ?>
                    <div class="col-sm-6 banner-bottom">
                        <a href="<?php echo base_url() . 'product_description/product_detail/' . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($product->name)))) . '/' . $product->product_id . '/' . $product->sku ?>" >
                            <div class="banner-top-in at">
                                <div class="product-thumb">
                                    <?php
                                    $file = base_url() . 'images/product_img/' . $product->catelog_img_url;
                                    if (empty($product->catelog_img_url)) {
                                        ?>
                                        <img src="<?php echo base_url() ?>images/product_img/prdct-no-img.png" alt="<?= $product->name; ?>">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>images/product_img/<?= $product->catelog_img_url; ?>" alt="<?= $product->name; ?>" class="wow fadeInDown">

                                    <?php } ?>
                                </div>
                            </div>
                            <div class="cart-at grid_1">

                                <div class="off">
                                    <p><?= substr($product->name, 0, 30) . '...'; ?></p>                                      											

                                    <!--<div class="cut-price">Rs. 800.00</div>&nbsp;
                                      <div class="cut-price">Rs. 566.00</div> 
                                      <div class="item_add"><span class="item_price">Rs. 300</span></div> 
                                                                        </div>-->

                                    <!----------------------- Price section start--------------------->

                                    <?php
                                    if ($product->special_price != 0) {
                                        if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                            ?>

                                            <div class="cut-price"> Rs. <?= ceil($product->mrp); ?> </div>

                                            <?php if ($product->price != 0) { ?>
                                                <div class="cut-price"> Rs. <?= ceil($product->price); ?> </div> 
                                            <?php } ?>

                                            <div class="item_add"><span class="item_price"> Rs. <?= ceil($product->special_price); ?> </span></div>
                                            <!---Special price exists condition end here --->
                                        <?php } else { ?>

                                            <?php if ($product->price != 0) { ?>
                                                <div class="cut-price"> Rs. <?= ceil($product->mrp); ?> </div> 
                                                <div class="item_add"><span class="item_price">Rs. <?= ceil($product->price); ?> </span></div> 
                                            <?php } else { ?>
                                                <div class="item_add"><span class="item_price"> Rs. <?= ceil($product->mrp); ?> </span></div> 
                                            <?php } ?>

                                        <?php } //End of date condition   ?>

                                    <?php } else { ?>

                                        <?php if ($product->price != 0) { ?>
                                            <div class="cut-price"> Rs. <?= ceil($product->mrp); ?> </div>
                                            <div class="item_add"><span class="item_price"> Rs. <?= ceil($product->price); ?> </span></div> 
                                        <?php } else { ?>
                                            <div class="item_add"><span class="item_price">  Rs. <?= ceil($product->mrp); ?> </span></div> 
                                        <?php } ?>

                                    <?php } ?>


                                    <!----------------------- Price section end--------------------->
                                </div>                                      

                            </div>
                            <div class="clearfix"> </div>
                        </a>
                    </div>
                <?php } ?>


                <div class="clearfix"> </div>

            </div>

        </div><?php } ?>
    <!----------------------------------- BEST Seller END--------------------------------------->
    <div class="parker" id="service">

        <!--Vertical Tab--><?php if ($new_product_result->num_rows() != 0) { ?>
            <div class="categories-section main-grid-border" id="latest">
                <div class="inner-products">
                    <h3 class="tittle two">New Arrivals</h3>
                    <div class="category-list">
                        <div id="parentVerticalTab">
                            <ul class="resp-tabs-list hor_1">
                                <?php
                                $prodinfo_nmresult = $new_product_result->result();
                                $catnm = array();
                                $catgid = array();
                                foreach ($prodinfo_nmresult as $res_catg) {
                                    array_push($catnm, $res_catg->lvl2_name);
                                    array_push($catgid, $res_catg->lvl2);
                                }
                                $unique_catgnm = array_unique($catnm);
                                $unquie_catgid = array_unique($catgid);
                                ?>
                                <?php foreach ($unique_catgnm as $keycatgnm => $valcatgnm) { ?>
                                    <li><?php echo $valcatgnm; ?></li>

                                <?php } ?>	

                            </ul>
                            <div class="resp-tabs-container hor_1">
            <!--<span class="active total" style="display:block;" data-toggle="modal" data-target="#myModal"><strong>All Products</strong> (Select your Product)</span>-->
                                <?php foreach ($unquie_catgid as $keycatgid => $valcatgid) { ?>					
                                    <div>
                                        <div class="prdct-category">
                                            <?php
                                            foreach ($prodinfo_nmresult as $product) {
                                                if ($product->lvl2 == $valcatgid) {
                                                    ?><a href="<?php echo base_url() . 'product_description/product_detail/' . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(" ", "-", strtolower($product->name)))) . '/' . $product->product_id . '/' . $product->sku ?>" title="wallet"> 
                                                        <div class="img-top">
                                                            <div class="product-thumb">

                                                                <?php
                                                                $file = base_url() . 'images/product_img/' . $product->catelog_img_url;
                                                                if (empty($product->catelog_img_url)) {
                                                                    ?>
                                                                    <img src="<?php echo base_url() ?>images/product_img/prdct-no-img.png" alt="<?= $product->name; ?>">
                                                                <?php } else { ?>
                                                                    <img src="<?php echo base_url(); ?>images/product_img/<?= $product->catelog_img_url; ?>" alt="<?= $product->name; ?>" class="wow fadeInDown">
                                                                <?php } ?>
                                                            </div>
                                                            <!--<div class="tab_desc">
                                                                     
                                                                            <div class="agency ">
                                                                            <div class="agency-left">
                                                                                    <h6 class="jean">
                                                            <?= substr($product->name, 0, 8) . '...'; ?>
                            
                            </h6>
                                                                                    <span class="item_price">
                                                            <?php
                                                            $cur_price = $product->mrp;
                                                            if ($product->price != 0) {
                                                                $cur_price = $product->price;
                                                            }

                                                            if ($product->special_price != 0) {
                                                                if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                                    $cur_price = $product->special_price;
                                                                }
                                                            }

                                                            echo "Rs." . number_format(ceil($cur_price), 0, ".", ",");
                                                            ?>
                            </span>
                                                                                    <div class="clearfix"> </div>
                                                                            </div>
                                                                            
                                                                     </div>
                                                              </div>-->
                                                            <div class="col-in">
                                                                <p>New</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?><div class="clearfix"></div>


                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--Plug-in Initialisation-->

        <!-- //Categories -->
    </div>
    <!--products-main-->
    <?php
    if ($product_result_for_scroll1 != '') {
        if ($product_result_for_scroll1->num_rows() != 0) {
            ?>

            <div class="products" id="product">

                <!--products-->
                <div class="content">
                    <div class="content-top">
                        <h3 class="tittle two">Recently viewed Items</h3>
                        <div class="pink">
                            <!-- requried-jsfiles-for owl -->
                            <link href="<?php echo base_url() . 'mobile_css_js/' ?>css/owl.carousel.css" rel="stylesheet">
                            <script src="<?php echo base_url() . 'mobile_css_js/' ?>js/owl.carousel.js"></script>
                            <script>
                                $(document).ready(function () {
                                    $("#owl-demo").owlCarousel({
                                        items: 0,
                                        lazyLoad: true,
                                        autoPlay: true,
                                        pagination: false,
                                    });
                                });
                            </script>
                            <!-- //requried-jsfiles-for owl -->
                            <div id="owl-demo" class="owl-carousel text-center">


                                <div class="item">
                                    <div class="box-in">
                                        <div class="grid_box">		
                                            <?php foreach ($product_result_for_scroll1->result() as $presult) { ?>
                                                <div class="product-thumb">
                                                    <a href="<?php echo base_url() . 'product_description/product_detail/' . preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($product->name)))) . '/' . $presult->product_id . '/' . $presult->sku ?>" >

                                                        <?php
                                                        $file = base_url() . 'images/product_img/' . $presult->catelog_img_url;
                                                        if (empty($presult->catelog_img_url)) {
                                                            ?>
                                                            <img src="<?php echo base_url() ?>images/product_img/prdct-no-img.png"  alt="<?= $product->name; ?>">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>images/product_img/<?= $presult->catelog_img_url; ?>" alt="<?= $product->name; ?>"  class="wow fadeInDown">
                                                        <?php } ?>

                                                        <!--<h4> Product Name </h4>-->
                                                    </a> 	 </div>
                                            <?php } //foreach loop end    ?>
                                        </div>

                                        <!--<div class="grid_1">
                                                <a href="#" class="cup item_add"><span class=" item_price" >150 $ <i class="fa fa-shopping-cart"></i> </span></a>					
                                        </div>-->
                                    </div>
                                </div>


                                <div class="clearfix"> </div>
                            </div>

                        </div>
                        <!--//products-->	
                    </div>
                </div>
                <!--//products-main-->



            </div>
            <?php
        }
    }
    ?> 

    <?php /* ?> <?php   $rows1 = $sub3_box1_info->num_rows();
      if($rows1 > 0){
      foreach($sub3_box1_info->result() as $row){ ?>
      <a href="<?php echo base_url().'product_description/product_addtocart/'.$row->image_id.'/'.$row->category_id ?>">
      <div class="ftr-banner">  <!--<img src="<?php //echo base_url().'mobile_css_js/' ?>images/banner-ftr.jpg" width="645" height="283" alt="" class="img-responsive">-->

      <img src="<?php echo './images/subpage3/'.$row->image_name;?>" width="645" height="283" alt="" class="img-responsive" />

      </div> </a><?php } }?><?php */ ?>

    <div class="ftr-banner">  <a href="<?= APP_BASE ?>product_description/product_addtocart/6/225" > <img src="<?php echo base_url() . 'mobile_css_js/' ?>images/banner-ftr.jpg" width="645" height="283" alt="" class="img-responsive"> </a> </div>

    <div class="newsletter">
        <h2 class="text-center"> Newsletter </h2>
        <h6 class="text-center"> Join Us Now to Get all news and special Offers </h6>

        <div class="nswltr" >
            <input type="email" class="newsletter-input" value="" placeholder="Enter Your Email Address" name="email"  autocorrect="off" autocapitalize="off"> 
            <select class="choose-gender">
                <option> --Select Gender-- </option>
                <option> Male </option>
                <option> Female </option>
            </select>
            <button type="submit" class="newsletter-submit" name="subscribe" id="Subscribe"> Subscribe </button> 
            <div class="clearfix"></div>

        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>     


<?php include 'footer.php'; ?>  

