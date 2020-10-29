<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->layout->title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            var base_url = '<?= APP_BASE ?>';
        </script> 
        <?php
        $this->scripts_include->includeCss($this->layout->layout)
                ->preJs($this->layout->layout)
                ->includeCustomJsTop()
                ->includeCustomCssTop()
        ?> 
    </head>
    <body class="hold-transition sidebar-mini layout-navbar-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php
            if ($this->layout->headerFlag) :
                $this->load->view($this->layout->layoutsFolder . '/header');
            else :
                $this->load->view($this->layout->layoutsFolder . '/no_header');
            endif;
            ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php $this->load->view($this->layout->layoutsFolder . '/l_side_bar'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php if ($this->layout->navTitleFlag || $this->layout->navTitle) : ?>
                    <section class="content-header" style="padding: 5px .3rem !important;">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= '<h4>' . $this->layout->navTitle . '</h4>' ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php
                                    if ($this->layout->breadcrumbsFlag) {
                                        echo $this->breadcrumbs->show();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                <?php endif; ?>   

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                if (GLOBAL_NOTICE) {
                                    echo '<div class="alert alert-warning alert-dismissible">
                               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <i class="icon fa fa-warning"></i> Alert!' . GLOBAL_NOTICE . '</div>';
                                }
                                ?>
                                <div class="modal fade" tabindex="-1" role="dialog" id="app_modal_msg_box">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title ">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Modal body text goes here.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php
            if ($this->layout->footerFlag) {
                $this->load->view($this->layout->layoutsFolder . '/footer');
            } else {
                $this->load->view($this->layout->layoutsFolder . '/no_footer');
            }
            ?>
            <!-- Control Sidebar -->
            <?php $this->load->view($this->layout->layoutsFolder . '/r_side_bar'); ?>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <?php
        $this->scripts_include->includeJs($this->layout->layout)
                ->includeCustomJsButtom()
                ->includeCustomCssButtom()
                ->includeGenericJsButtom();
        ?>
    </body>
</html>
