<?php
require_once('header.php');
?>
<script>
    function add_product(seller_id) {
        var base_url = "<?php echo base_url(); ?>";
        var controller = "admin/sellers/";
        window.location.href = base_url + controller + 'new_product_form_seller/' + seller_id;
    }
</script>
<div id="content">
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_sellers.php'; ?>
        </div>
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>
    <div class="main-content">
        <div class="exist_prod_new_list" align="left"><button type="button" onclick="window.location.href = '<?php echo base_url() . 'admin/Upload_bulk_existingproduct/bulk_existingproductupload_forseller/' . $seller_id ?>'" style='width:225px;'>Bulk Existing Products Upload &nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
            </button>  </div>


        <div class="exist_prod_new_list" align="right"><button type="button" onclick="window.location.href = '<?php echo base_url() . 'admin/upload_bulkproduct/bulkproductupload_forseller/' . $seller_id ?>'" style='width:205px;'>Bulk New Products Upload &nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
            </button>  </div>
        <div class="row content-header">
            <h3>Add New Product</h3>
        </div>
        <div class="search_prod">
            <h2><center>Go for existing product on <?= DOMAIN_NAME ?></center></h2>
            <?php
            $attributes = array('class' => 'search');
            echo form_open_multipart('admin/sellers/search_existing_product', $attributes);
            ?>
            <input type="text" name="search_title" id="search_title" placeholder="Paste Product URL Here.." >
            <input type="hidden" name="hidden_seller_id" value="<?= $seller_id ?>">
            <input type="submit" id="search_submit" class="srch-btn" value="Search">
            </form>
            <p><center>The product you want to create may already exist in <?= DOMAIN_NAME ?>. Search for it and add it directly to your listing.</center></p>

        </div>
        <div class="exist_prod">
            <h2><center>Your product does not exist on <?= DOMAIN_NAME ?>?</center></h2>
            <div class="exist_prod_new_list">
                <center><button type="button" onclick="add_product(<?= $seller_id ?>)">Create a new Product</button></center>
            </div>
            <p><center>NOTE: Please use "Add listings in bulk" for subcategories not available here.</center></p>
        </div>
    </div>
</div>




<?php
require_once('footer.php');
?>	