<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $this->layout->title ?></title>
        <script>
            var base_url = '<?= APP_BASE ?>';
        </script>
        <?= $this->scripts_include->preJs($this->layout->layout) ?>
        <?= $this->scripts_include->includeCss($this->layout->layout) ?>        
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    </head>

    <body id="page-top">
        <?php
        if ($this->layout->headerFlag) :
            $this->load->view($this->layout->layoutsFolder . '/header');
        else :
            $this->load->view($this->layout->layoutsFolder . '/no_header');
        endif;
        ?>
        <?php $this->load->view($this->layout->layoutsFolder . '/l_side_bar'); ?>

        <div class="container-fluid p-0">  
            <?php
            if (GLOBAL_NOTICE) {
                echo '<div class="alert alert-warning alert-dismissible">
                               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <i class="icon fa fa-warning"></i> Alert!' . GLOBAL_NOTICE . '</div>';
            }
            ?>    
            <?= $content ?>
        </div>
        <!--Footer -->
        <?php
        if ($this->layout->footerFlag) {
            $this->load->view($this->layout->layoutsFolder . '/footer');
        } else {
            $this->load->view($this->layout->layoutsFolder . '/no_footer');
        }
        ?> 
        <!-- Footer -->
        <?= $this->scripts_include->includeJs($this->layout->layout) ?>
    </body>

</html>
