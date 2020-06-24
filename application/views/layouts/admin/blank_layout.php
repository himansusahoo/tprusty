<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->layout->title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        echo $this->scripts_include->includeCss($this->layout->layout);
        echo $this->scripts_include->preJs($this->layout->layout);
        ?>
        <script>
            var base_url = '<?= APP_BASE ?>';
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">

        <?php
        if (GLOBAL_NOTICE) {
            echo '<br><div class="alert alert-warning alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <i class="icon fa fa-warning"></i> Alert!' . GLOBAL_NOTICE . '</div>';
        }
        ?>
        <!-- Main content -->
        <?php echo $content; ?>
        <script>
//            $(function () {
//                $('input').iCheck({
//                    checkboxClass: 'icheckbox_square-blue',
//                    radioClass: 'iradio_square-blue',
//                    increaseArea: '20%' // optional
//                });
//            });
        </script>
        <?= $this->scripts_include->includeJs($this->layout->layout) ?>
        <script src="<?= APP_BASE ?>js/admin.js"></script>
    </body>
</html>
