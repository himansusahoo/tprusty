<?php require_once('header.php') ?>

<link rel="stylesheet" href="<?php echo base_url() ?>mobile_css_js/new/css/font-awesome.min.css"> 
<link href="<?php echo base_url() ?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>mobile_css_js/new/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url() ?>mobile_css_js/new/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>mobile_css_js/new/js/bootstrap.min.js"></script><!-- requried-jsfiles-for owl -->
<style>
    .wrap {
        position: relative;
        margin-top: 50px;
    }
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
        padding: 0 15px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        margin-bottom: 0!important;
    }
    div.panel ul li {
        list-style: none; 
    }
    .top-accordian{
        background-color: #f2f2f2;
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
        margin-bottom: 6px;
    }
    .search_big1 {
        height: 50px;
        width: 100%;
    }
    .search_big1 input[type="search"] {
        width: 90%;
    }
    .search_big1 .search{
        position: absolute;
        margin-top: 5px;
        margin-right: 14px;
        height: 42px;
    }
    .brands-name {
        border: 1px solid #ccc;
        width: 45.9%;
        margin: 2%;
    }
    .pro-1 img {
        width: 25%;
        float:left;
        margin-right: 15px;
    }
    .pro-1 p{ margin-top:15px;}
    .pro-1 {
        float: left;
        width: 47%;
        border: 1px solid #B9B9B9;
        height: 80px;
        max-height: 120px; 
        padding: 1px 4px 2px 10px;
        border-bottom: 1px solid #B9B9B9;
        margin: 1%;
    }
    .brands-held{
        width:100%; 
        margin:auto; 
        padding:5px;
    }
    .brands_products ul{ background:#e3e3e3; padding:0!important;}
    .brands_products ul li{
        padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc;
    }
    .brands_products ul li a{font-size:17px; text-decoration:none; color:#000;}
    .accordion {
        width: 100%;
        margin: 0px auto 0px;
        background: #FFF;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        background: #f2f2f2;
    }

    .accordion .link {
        cursor: pointer;
        display: block;
        padding: 15px 15px 15px 42px;
        color: #4D4D4D;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 2px;
        background: #e3e3e3;
        border: 1px solid #CCC;
        position: relative;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    .accordion li:last-child .link { border-bottom: 0; }

    .accordion li i {
        position: absolute;
        top: 16px;
        left: 12px;
        font-size: 18px;
        color: #595959;
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    .accordion li i.fa-chevron-down {
        right: 12px;
        left: auto;
        font-size: 16px;
    }

    .accordion li.open .link { color: #b63b4d; }

    .accordion li.open i { color: #b63b4d; }

    .accordion li.open i.fa-chevron-down {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    /**
     * Submenu
     -----------------------------*/


    .submenu {
        display: none;
        font-size: 14px;
    }

    .submenu li {
        border-bottom: 1px solid #4b4a5e;background: #444359;
    }

    .submenu a {
        display: block;
        text-decoration: none;
        color: #d9d9d9;
        padding: 12px;
        padding-left: 42px;
        -webkit-transition: all 0.25s ease;
        -o-transition: all 0.25s ease;
        transition: all 0.25s ease;
    }
    .submenu ul li a:hover{background:#F39;}



    .lifestyle-submenu {
        display: none;
        font-size: 14px;
    }
    <!--.lifestyle-submenu li:nth-child(3){background:#fff;}-->
    .lifestyle-submenu li { /*border-bottom: 1px solid #e3e3e3;*/background: #fff; }

    .lifestyle-submenu a {
        display: block;
        text-decoration: none;
        color: #000;
        padding: 12px;
        padding-left: 42px;
        -webkit-transition: all 0.25s ease;
        -o-transition: all 0.25s ease;
        transition: all 0.25s ease;
    }
    .lifestyle-submenu ul li a:hover{background: #f5cba7; padding:5px 0;}
    .menu-link-product-held{
        float: left;
        width: 47%;
        border: 1px solid #B9B9B9;
        height: 80px;
        max-height: 120px;
        padding: 1px 4px 2px 10px;
        border-bottom: 1px solid #B9B9B9;
        margin: 1%;
    }
    .menu-link-product-held-left{
        width: 30%;float: left;padding: 5px;text-align: center;
    }
    .menu-link-product-held-left img{height: auto !important; max-width: 100%;  max-height: 60px;}
    .menu-link-product-held-right{width: 70%; float: right;  padding: 5px; text-align: left;}
    @media only screen and (min-width:0px) and (max-width:320px){
        .menu-link-product-held-right p {
            padding: 8px 0 0 0;
        }
    }
    @media only screen and (min-width:321px) and (max-width:360px){
        .menu-link-product-held-right p {
            padding: 12px 0 0 0;
        }
    }
    @media only screen and (min-width:361px) and (max-width:375px){
        .menu-link-product-held-right p {
            padding: 14px 0 0 0;
        }
    }
</style>



<div class="wrap">       


    <!------------single banner------> 
    <div style="padding-top:60px;">                
        <div class="left-sidebar">	           
            <!------------- toogle start------------>
            <?php $qrs = $this->db->query("select * from category_menu_mobile where parent_id=0 AND order_by!=0 AND is_active='Yes' order by order_by "); ?>
            <!--------------------------------- product Box Start here------------------------------------>
            <?php
            foreach ($qrs->result() as $rw) {


                $q_arrow = $this->db->query("select * from category_menu_mobile where parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                if ($rw->label_name == 'Life Style') {
                    ?>
                    <!--------------------------------- product list Child-menu start here------------------------------------>

                    <button class="first-accordion">
                        <?php if ($rw->menu_image != '') { ?> <img src="<?php echo base_url() . 'images/admin/mobile/mobile_menu/' . $rw->menu_image; ?>" class="sbdCategoryIcon"> <?php } ?>
                        <span class="menu-head"><?= $rw->label_name ?> </span>
                    </button>
                    <div class="panel">
                        <ul id="accordion" class="accordion" style="border:1px solid #ccc;">
                            <?php
                            foreach ($q_arrow->result() as $res_arrow) {

                                $qr = $this->db->query("select * from category_menu_mobile where parent_id='$res_arrow->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                ?>     
                                <!-----lifestyle menu------------------------->
                                <li>
                                    <div class="link"> 
                                        <?php if ($res_arrow->menu_image != '') { ?>  <img src="<?php echo base_url() . 'images/admin/mobile/mobile_menu/' . $res_arrow->menu_image; ?>" class="sbdCategoryIcon" height="28" width="28"> <?php } ?><?= $res_arrow->label_name ?>
                                        <i class="fa fa-chevron-down"></i></div>
                                    <ul class="lifestyle-submenu">
                                        <?php foreach ($qr->result() as $rs) { ?>
                                            <li>
                                                <!---- This is for image box ---------->
                                                <?php if ($rs->menu_image != '') { ?>
                                                    <div class="pro-1" onclick="window.location.href = '<?php echo base_url() . 'category/' . $rs->url_displayname ?>'">                   
                                                        <img src="<?php echo base_url() . 'images/admin/mobile/mobile_menu/' . $rs->menu_image; ?>" >
                                                        <p><strong><?= $rs->label_name ?></strong></p>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <!---- This is for end image box ---------->

                                                    <!---- This is for listing ---------->
                                                    <div class="brands_products" style="clear: both;">
                                                        <ul>
                                                            <li style="padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc; background: #fef9e7;">
                                                                <a style=" font-size:14px; padding:0;" href="<?php echo base_url() . 'category/' . $rs->url_displayname ?>"><?= $rs->label_name ?></a>
                                                            </li>                
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                <?php } ?>
                                                <!---- This is for listing ---------->            
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>

                            <?php } // for loop end 
                            ?>  </ul>  </div>   
                    <!--------------------------------- product list Child-menu End here------------------------------------>

                    <?php
                } // if condition is life style
                else {
                    ?>    	
                    <button class="first-accordion">
                    <?php if ($rw->menu_image != '') { ?>  <img src="<?php echo base_url() . 'images/admin/mobile/mobile_menu/' . $rw->menu_image; ?>" class="sbdCategoryIcon">
                        <?php } ?>
                        <span class="menu-head"><?php echo $rw->label_name; ?> </span>
                    </button>
                    <div class="panel">
                        <ul>
        <?php
        foreach ($q_arrow->result() as $res_arrow) {
            if ($res_arrow->menu_image != '') {
                ?>               
                                    <li>
                                        <div class="inn-single" onclick="window.location.href = '<?php echo base_url() . 'category/' . $res_arrow->url_displayname ?>'"> 

                                            <div class="menu-link-product-held"> 
                                                <div class="menu-link-product-held-left">
                                                    <img src="<?php echo base_url() . 'images/admin/mobile/mobile_menu/' . $res_arrow->menu_image; ?>" onclick="window.location.href = '#'">
                                                </div> 
                                                <div class="menu-link-product-held-right">
                                                    <p><strong><?= $res_arrow->label_name ?></strong></p>
                                                </div>                 

                                            </div>
                                        </div>
                                    </li>
            <?php } else { ?>

                                    <div class="brands_products" style="clear: both;">
                                        <ul>              
                                            <li style="padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc;">
                                                <a style=" font-size:14px;" href="<?php echo base_url() . 'category/' . $res_arrow->url_displayname ?>"><?= $res_arrow->label_name ?></a>
                                            </li>                
                                        </ul>

                                        <div class="clearfix"></div>
                                    </div>



            <?php
            } // if image not avaliable condition end
        }
        ?>
                        </ul>
                    </div>

                    <?php
                }
            } // if category not life style end
            ?>

            <script>
                var acc = document.getElementsByClassName("first-accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].onclick = function () {
                        this.classList.toggle("active");
                        var panel = this.nextElementSibling;
                        if (panel.style.maxHeight) {
                            panel.style.maxHeight = null;
                        } else {
                            panel.style.maxHeight = panel.scrollHeight + "120px";
                        }
                    }
                }
            </script>	

            <footer class="site-footer">

                <div class="container-fluid">        
                    <div class="clearfix"> </div>         

                    <div class="copy-right">
                        <span class="site-footer-copyright"><?= COPY_RIGHT_YEAR ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
</div>
<script>
    $(function () {
        var Accordion = function (el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.link');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }

        Accordion.prototype.dropdown = function (e) {
            var $el = e.data.el;
            $this = $(this),
                    $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            }
            ;
            if (!e.data.multiple) {
                $el.find('.lifestyle-submenu').not($next).slideUp().parent().removeClass('open');
            }
            ;
        }

        var accordion = new Accordion($('#accordion'), false);
    });

</script>
<script src="<?php echo base_url() ?>mobile_css_js/new/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url() ?>mobile_css_js/new/js/scripts.js"></script>
</body>
</html>