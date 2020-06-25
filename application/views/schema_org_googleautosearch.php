<?php
$material_forgoogle = '';
$sku_forgoogle = $this->uri->segment(3);

$query_forgoogle = $this->db->query("SELECT a.*,b.attribute_field_name FROM seller_product_attribute_value a
										INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
										WHERE a.sku='$sku_forgoogle' GROUP BY a.attr_value ");
$result=$query_forgoogle->result_array();
$material_forgoogle='';
foreach ($result as $prod){
    if(array_key_exists('attribute_field_name', $prod) && strpos($prod['attribute_field_name'], 'material')){
        $material_forgoogle = $prod['attr_value'];
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