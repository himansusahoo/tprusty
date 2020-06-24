<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <!-- Head BEGIN -->
    <head>
        <meta charset="utf-8">
        <title><?= $this->layout->title ?></title>

        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta content="Metronic Shop UI description" name="description">
        <meta content="Metronic Shop UI keywords" name="keywords">
        <meta content="keenthemes" name="author">

        <meta property="og:site_name" content="-CUSTOMER VALUE-">
        <meta property="og:title" content="-CUSTOMER VALUE-">
        <meta property="og:description" content="-CUSTOMER VALUE-">
        <meta property="og:type" content="website">
        <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
        <meta property="og:url" content="-CUSTOMER VALUE-">

        <link rel="shortcut icon" href="favicon.ico">
        <script>
            var base_url = '<?= APP_BASE ?>';
        </script>
        <!-- Fonts START -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
        <!-- Fonts END -->
        <?= $this->scripts_include->preJs($this->layout->layout) ?>
        <?= $this->scripts_include->includeCss($this->layout->layout) ?>  
        <script>
            $(document).ready(function () {
                var docH = $(document).height();
                var preHeaderH = $('.pre-header').height();
                var headerH = $('.header').height();
                var footerH = $('.footer').height();
                var mainH = 64;
                var totMinus = (preHeaderH + headerH + footerH + mainH);
                mainH = docH - totMinus;
                $('.main').height(mainH);
            });
        </script>
        <!-- Theme styles END -->
    </head>
    <!-- Head END -->

    <!-- Body BEGIN -->
    <body class="corporate">
        <?php
        if ($this->layout->headerFlag) :
            $this->load->view($this->layout->layoutsFolder . '/header');
        else :
            $this->load->view($this->layout->layoutsFolder . '/no_header');
        endif;

        if ($this->layout->navSlider):
            $this->load->view($this->layout->layoutsFolder . '/header_slider');
        endif;
        ?>        

        <div class="main" style="min-height: 416px !important;">
            <div class="container">
                <?php
                $this->load->view($this->layout->layoutsFolder . '/popups');
                if ($this->layout->breadcrumbsFlag) {
                    echo '<div class="pull-right">' . $this->breadcrumbs->show() . '</div>';
                }
                ?>
                <?php
                if (GLOBAL_NOTICE) {
                    echo '<div class="alert alert-warning alert-dismissible">
                               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <i class="icon fa fa-warning"></i> Alert!' . GLOBAL_NOTICE . '</div>';
                }
                echo $content;
                ?>  

            </div>
        </div>

        <?php
        if ($this->layout->siteMap) {
            $this->load->view($this->layout->layoutsFolder . '/pre_footer');
        }
        if ($this->layout->footerFlag) {
            $this->load->view($this->layout->layoutsFolder . '/footer');
        }
        ?> 

        <!-- Load javascripts at bottom, this will reduce page load time -->
        <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
        <!--[if lt IE 9]>
        <script src="/<?= APP_BASE ?>assets/layouts/ecom/theme/assets/layouts/ecom/theme/<?= APP_BASE ?>assets/layouts/ecom/theme/assets/plugins/respond.min.js"></script>
        <![endif]-->

        <!-- Footer -->
        <?= $this->scripts_include->includeJs($this->layout->layout) ?>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                Layout.init();
                Layout.initOWL();
                Layout.initTwitter();
                Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
                Layout.initNavScrolling();                
            });
        </script>
        <!-- END PAGE LEVEL JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>