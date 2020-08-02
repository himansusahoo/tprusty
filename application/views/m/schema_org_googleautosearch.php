<?php
$material_forgoogle = '';
$sku_forgoogle = $this->uri->segment(3);
$query = "SELECT a.*,b.attribute_field_name 
        FROM seller_product_attribute_value a
        INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
        WHERE a.sku='$sku_forgoogle' 
        GROUP BY a.attr_value ";
$query_forgoogle = $this->db->query($query)->result_array();
foreach ($query_forgoogle as $res_master) {
    if (strpos($res_master['attribute_field_name'], 'material')) {
        $material_forgoogle = $res_mater['attr_value'];
    }
}
?>
<script type="application/ld+json">
    {
    "@context": "http://schema.org",
    "@type": "IndividualProduct",
    "offers": {
    "@type": "Offer",
    "name": "<?php echo $prodnm_forgoogle; ?>",
    "description": "<?php echo $proddescrp_forgoogle; ?>",
    "image": "<?php echo $pord_firstiamgeforgoogle; ?>",
    <?php if ($prodcolor_forgoogle != '') { ?>"color": "<?php echo $prodcolor_forgoogle ?>", <?php } ?>
    <?php if ($material_forgoogle != '') { ?>"material": "<?php echo $material_forgoogle ?>", <?php } ?>
    "category": "<?php echo $prodcatgnm_forgoogle; ?>",
    "availability": "<?php echo $stock_status; ?>",
    "price": "<?php echo number_format($curnt_price, 2); ?>",
    "priceCurrency": "INR"
    }
    }
</script>