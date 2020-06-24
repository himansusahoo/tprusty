<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->layout->title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= $this->scripts_include->preJs($this->layout->layout) ?>
        <?= $this->scripts_include->includeCss($this->layout->layout) ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            var base_url = '<?= APP_BASE ?>';
        </script>        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper" style="overflow-y:hidden !important;">
            <?php
            if ($this->layout->headerFlag) :
                $this->load->view($this->layout->layoutsFolder . '/header');
            else :
                $this->load->view($this->layout->layoutsFolder . '/no_header');
            endif;
            ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view($this->layout->layoutsFolder . '/l_side_bar'); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" id="layout_content_wrapper" style="height:500px; overflow-y: scroll;overflow-x:hidden;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php
                    if ($this->layout->navTitleFlag) {
                        echo '<h1>' . $this->layout->navTitle . '</h1>';
                    }
                    if ($this->layout->breadcrumbsFlag) {
                        if (!$this->layout->navTitleFlag || $this->layout->navTitle == '') {
                            echo '<h1>&nbsp;</h1>';
                        }
                        echo $this->breadcrumbs->show();
                    }
                    ?>
                </section>
                <section class="content-message">                   
                    <div class="row-fluid">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="col-sm-12 marginB5">
                                <span class="label label-success"><?= $this->session->flashdata('success'); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')): ?> 
                            <div class="col-sm-12 marginB5">
                                <span class="label label-danger"><?= $this->session->flashdata('error'); ?></span>                    
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('warning')): ?> 
                            <div class="col-sm-12 marginB5">
                                <span class="label label-danger"><?= $this->session->flashdata('warning'); ?></span>                    
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('info')): ?> 
                            <div class="col-sm-12 marginB5">
                                <span class="label label-danger"><?= $this->session->flashdata('info'); ?></span>                    
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
                <!--Main content -->
                <section class = "content">
                    <?php
                    if (GLOBAL_NOTICE) {
                        echo '<div class="alert alert-warning alert-dismissible">
                               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <i class="icon fa fa-warning"></i> Alert!' . GLOBAL_NOTICE . '</div>';
                    }
                    ?>
                    <?php $this->load->view($this->layout->layoutsFolder . '/popups'); ?>
                    <?= $content ?>
                </section>
                <!--/.content -->
            </div>
            <!--/.content-wrapper -->
            <!--Footer -->
            <?php
            if ($this->layout->footerFlag) {
                $this->load->view($this->layout->layoutsFolder . '/footer');
            } else {
                $this->load->view($this->layout->layoutsFolder . '/no_footer');
            }
            ?> 
            <!-- Footer -->
            <!-- Control Sidebar -->
            <?php $this->load->view($this->layout->layoutsFolder . '/r_side_bar'); ?>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <!--<div class="control-sidebar-bg"></div>-->
        </div>        
        <!-- ./wrapper -->
        <?= $this->scripts_include->includeJs($this->layout->layout) ?>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
    </body>
</html>
