<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="<?php echo $result->meta_descrp; ?>" content="">
        <meta name="<?php echo $result->meta_keyword; ?>" content="" />

        <meta name="author" content="">
        <title><?php echo $result->title; ?></title>

        <?php include "header.php" ?>

        <!------ Start Content ------>

    <div class="main-content">
        <?= $result->content ?>
    </div>

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

</body>

</html>