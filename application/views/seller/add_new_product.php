<?php
require_once('header.php');
$this->load->helper('string');

if($this->session->userdata('seller_session_id')==""){
	$dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
	$session_slr_id = random_string('alnum', 16).$dtm;
	$this->session->set_userdata('seller_session_id',$session_slr_id);
}
?>

<link href="<?php echo base_url();?>css/admin/uploadfile.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src ="<?php echo base_url();?>js/countries.js"></script>

<!--- Zebra_Datepicker link start here ---->
<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
<!--<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<!--- Zebra_Datepicker link end here ---->
<style>
.Zebra_DatePicker_Icon{left: 250px !important; top: 3px !important;}
</style>

<!-- collapsibleCheckboxTree -->
<script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree.js' ?>"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$('ul#example').collapsibleCheckboxTree();
});
</script>

<!---Image uploading Script Start here --->
<script src="<?php echo base_url();?>js/img_uplod_script/jquery.uploadfile1.min.js"></script>

<script>
$(document).ready(function()
{
$("#uploadfile").uploadFile({
url: "<?php echo base_url();?>seller/catalog/upload_product_tmp_image",
dragDrop: true,
fileName: "userfile",
returnType: "json",
showDelete: true,
//showDownload:true,
statusBarWidth:600,
dragdropWidth:600,
showPreview:true,
previewHeight: "100px",
previewWidth: "100px",

maxFileCount:5,
//maxFileSize:100*1024,
maxFileSize:100*500,
//minFileSize:500*500,

deleteCallback: function (data, pd) {
    for (var i = 0; i < data.length; i++) {
        $.post("<?php echo base_url();?>seller/catalog/delete_product_tmp_image", {op: "delete",name: data[i]},
            function (resp,textStatus, jqXHR){
                //Show Message
				//alert(name);
                alert("File Deleted");
            });
    }
    pd.statusbar.hide(); //You choice.
},
//image download not mandatory
downloadCallback:function(filename,pd)
	{
		location.href="<?php echo base_url();?>admin/catalog/download_product_tmp_image?filename="+filename;
	}
});
});
</script>
<!---Image uploading Script end here --->


<script>
	function valid_product_form(){ 
		//Line for SKU valid characters
		var re = /^[A-Za-z0-9_-]*$/
		
		var attribute_set = $(".form_content select[name='attribute_set'] option:selected").val(); 
		
		var subcategoryid = document.getElementsByName("subcategory_id"); 
		var subcategoryid_count = subcategoryid.length; 
		var count = 0;
		for (var i=0; i<subcategoryid_count; i++) {
			if (subcategoryid[i].checked === true) {
				count++;
			}
		}
		
		var name = $(".form_content input[name='name']").val();
		var sku = $(".form_content input[name='sku']").val();
		var description = $(".form_content textarea[name='description']").val();
		var prodt_highlt = $("#seller_prodt_highlit1").val();
		var status = $(".form_content select[name='status'] option:selected").val();
		var price = parseFloat($(".form_content input[name='price']").val());
		var selling_price = $(".form_content input[name='selling_price']").val();
		var special_price = $(".form_content input[name='special_price']").val();
		var special_price_fr_date = $(".form_content input[name='price_from_date']").val();
		var special_price_to_date = $(".form_content input[name='price_to_date']").val();
		//var tax_class = $(".form_content select[name='tax_class'] option:selected").val();
		var vat_cst = $(".form_content input[name='vat_cst']").val();
		var weight = $(".form_content input[name='weight']").val();
		var shipping_typ = $('#shipping_typ').val(); 
		var default_shipng_fee = $('#default_shipng_fee').val();
		var quantity = $(".form_content input[name='qty']").val();
		//var images = $(".form_content input[name='userfile[]']").val(); 
		//var image_count = $("img#uploadImgID").length;
		var images = $('.ajax-file-upload-container').text();
		
		/*if (!re.test(sku)) {
			alert('Invalid SKU'); return false;
		}*/
		
		if(attribute_set == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').addClass('in').removeAttr("style");
			
			$(".form_content select[name='attribute_set']").css('border-color', 'red');
			$(".req_product_attr").show();
			return false;
		}else if(count==0){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').addClass('in').removeAttr("style");
			
			$(".req_category").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			return false;
		}else if(name == ''){ 
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseOne').addClass('in').removeAttr("style");
			
			$(".form_content input[name='name']").css('border-color', 'red');
			$(".form_content input[name='name']").focus();
			$(".req_name").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			return false;
		}else if(sku == ''){
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseOne').addClass('in').removeAttr("style");
			
			$(".form_content input[name='sku']").css('border-color', 'red');
			$(".form_content input[name='sku']").focus();
			$(".req_sku").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			return false;
		}else if(!re.test(sku)){
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseOne').addClass('in').removeAttr("style");
			
			$(".form_content input[name='sku']").css('border-color', 'red');
			$(".form_content input[name='sku']").select();
			$(".req_sku").show().text('Special characters are not allowed in SKU.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			return false;
		}else if(description == ''){
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseOne').addClass('in').removeAttr("style");
			
			$(".form_content textarea[name='description']").css('border-color', 'red');
			$(".form_content textarea[name='description']").focus();
			$(".req_desc").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			return false;
		}else if(prodt_highlt == ""){
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseOne').addClass('in').removeAttr("style");
			
			$("#seller_prodt_highlit1").css('border-color', 'red');
			$("#seller_prodt_highlit1").focus();
			$(".req_short_desc").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			return false;
		}else if(status == ''){
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseOne').addClass('in').removeAttr("style");
			
			$(".form_content select[name='status']").css('border-color', 'red');
			$(".form_content select[name='status']").focus();
			$(".req_status").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			return false;
		}else if(price == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='price']").css('border-color', 'red');
			$(".form_content input[name='price']").focus();
			$(".req_price").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			return false;
		}else if(isNaN(price)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='price']").css('border-color', 'red');
			$(".form_content input[name='price']").select().focus();
			$(".req_price").show().text('Price should be an Integer value.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			return false;
		}else if(isNaN(special_price)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='special_price']").css('border-color', 'red');
			$(".form_content input[name='special_price']").select().focus();
			$(".req_splprice").show().text('Special Price should be an Integer value.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			return false;
		}else if(parseFloat(price) < parseFloat(special_price)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='special_price']").css('border-color', 'red');
			$(".form_content input[name='special_price']").select().focus();
			$(".req_splprice").show().text('Special Price should be less than MRP.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			return false;
		}else if(special_price != "" && special_price_fr_date == ""){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='special_price_fr_date']").css('border-color', 'red');
			$(".req_splprice_fr_dt").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide()
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			return false;
		}else if(special_price != "" && special_price_to_date == ""){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='special_price_to_date']").css('border-color', 'red');
			$(".req_splprice_to_dt").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			return false;
		}else if(isNaN(selling_price)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='selling_price']").css('border-color', 'red');
			$(".form_content input[name='selling_price']").select().focus();
			$(".req_selprice").show().text('Special Price should be an Integer value.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			return false;
		}else if(parseFloat(price) < parseFloat(selling_price)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='selling_price']").css('border-color', 'red');
			$(".form_content input[name='selling_price']").select().focus();
			$(".req_selprice").show().text('Selling Price should be less than MRP.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			return false;
		}else if(quantity == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='qty']").css('border-color', 'red');
			$(".form_content input[name='qty']").focus();
			$(".req_quantity").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			return false;
		}else if(isNaN(quantity)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='qty']").css('border-color', 'red');
			$(".form_content input[name='qty']").select();
			$(".req_quantity").show().text('Quantity should be an Integer value.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']")
			('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			return false;
		}else if(vat_cst == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content select[name='tax_class']").css('border-color', 'red');
			$(".form_content select[name='tax_class']").focus();
			$(".req_tax_class").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			return false;
		}else if(isNaN(vat_cst)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content select[name='tax_class']").css('border-color', 'red');
			$(".form_content select[name='tax_class']").focus();
			$(".req_tax_class").text('Invalid amount');
			$(".req_tax_class").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			return false;
		}else if(weight == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='weight']").css('border-color', 'red');
			$(".form_content input[name='weight']").focus();
			$(".req_weight").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			return false;
		}else if(isNaN(weight)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$(".form_content input[name='weight']").css('border-color', 'red');
			$(".form_content input[name='weight']").select().focus();
			$(".req_weight").show().text('Weight should be an Integer value in gram.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			return false;
		}else if(shipping_typ == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$('#shipping_typ').css('border-color', 'red');
			$(".req_visibility").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			$(".form_content input[name='weight']").css('border-color', '#ccc');
			$(".req_weight").hide();
			return false;
		}else if(shipping_typ == 'Default' && default_shipng_fee == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$('#default_shipng_fee').css('border-color', 'red');
			$('#default_shipng_fee').focus();
			$(".req_flat_fee").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			$(".form_content input[name='weight']").css('border-color', '#ccc');
			$(".req_weight").hide();
			$('#shipping_typ').css('border-color', '#ccc');
			$(".req_visibility").hide();
			return false;
		}else if(shipping_typ == 'Default' && isNaN(default_shipng_fee)){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$('#default_shipng_fee').css('border-color', 'red');
			$('#default_shipng_fee').select().focus();
			$(".req_flat_fee").show().text('Invalid shipping amount.');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			$(".form_content input[name='weight']").css('border-color', '#ccc');
			$(".req_weight").hide();
			$('#shipping_typ').css('border-color', '#ccc');
			$(".req_visibility").hide();
			return false;
		}/*else if(shipping_typ == 'Default' && default_shipng_fee > 60){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseThree').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseTwo').addClass('in').removeAttr("style");
			
			$('#default_shipng_fee').css('border-color', 'red');
			$('#default_shipng_fee').select().focus();
			$(".req_flat_fee").show().text('Minimum shipping amount should be Rs. 60');
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			$(".form_content input[name='weight']").css('border-color', '#ccc');
			$(".req_weight").hide();
			$('#shipping_typ').css('border-color', '#ccc');
			$(".req_visibility").hide();
			$('#default_shipng_fee').css('border-color', '#ccc');
			$(".req_flat_fee").hide();
			return false;
		}*/else if(images == ''){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseThree').addClass('in').removeAttr("style");
			
			$(".req_files").show();
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='special_price']").css('border-color', '#ccc');
			$(".req_splprice").hide();
			$(".form_content input[name='special_price_fr_date']").css('border-color', '#ccc');
			$(".req_splprice_fr_dt").hide();
			$(".form_content input[name='special_price_to_date']").css('border-color', '#ccc');
			$(".req_splprice_to_dt").hide();
			$(".form_content input[name='selling_price']").css('border-color', '#ccc');
			$(".req_selprice").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			$(".form_content input[name='weight']").css('border-color', '#ccc');
			$(".req_weight").hide();
			$('#shipping_typ').css('border-color', '#ccc');
			$(".req_visibility").hide();
			$('#default_shipng_fee').css('border-color', '#ccc');
			$(".req_flat_fee").hide();
			return false;
		}/*else if(image_count < 1 || image_count > 5){
			$('.form_content').find('#collapseOne').removeClass('in');
			$('.form_content').find('#collapseTwo').removeClass('in');
			$('.form_content').find('#collapseFour').removeClass('in');
			$('.form_content').find('#collapseFive').removeClass('in');
			$('.form_content').find('#collapseSix').removeClass('in');
			$('.form_content').find('#collapseSeven').removeClass('in');
			$('.form_content').find('#collapseThree').addClass('in').removeAttr("style");
			
			$("#files").val('');
			$("img#uploadImgID").remove();
			$(".req_files").show().text("Please upload required no of Images");
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$(".req_category").hide();
			$(".form_content input[name='name']").css('border-color', '#ccc');
			$(".req_name").hide();
			$(".form_content input[name='sku']").css('border-color', '#ccc');
			$(".req_sku").hide();
			$(".form_content textarea[name='description']").css('border-color', '#ccc');
			$(".req_desc").hide();
			$("#seller_prodt_highlit1").css('border-color', '#ccc');
			$(".req_short_desc").hide();
			$(".form_content select[name='status']").css('border-color', '#ccc');
			$(".req_status").hide();
			$(".form_content input[name='price']").css('border-color', '#ccc');
			$(".req_price").hide();
			$(".form_content input[name='qty']").css('border-color', '#ccc');
			$(".req_quantity").hide();
			$(".form_content select[name='tax_class']").css('border-color', '#ccc');
			$(".req_tax_class").hide();
			$(".form_content input[name='weight']").css('border-color', '#ccc');
			$(".req_weight").hide();
			$('#shipping_typ').css('border-color', '#ccc');
			$(".req_visibility").hide();
			$('#default_shipng_fee').css('border-color', '#ccc');
			$(".req_flat_fee").hide();
			return false;
		}*/
		//document.getElementById('files').value='';
		
	}
	
</script>
<script>
function checkSku(sku){
	var sku_len = sku.length;
	var sku_non_spc_len = sku.replace(/\s/g, '').length;
	if(sku_len != sku_non_spc_len){
		$(".form_content input[name='sku']").css('border-color', 'red');
		$(".form_content input[name='sku']").select().focus();
		$(".req_sku").show().text('SKU must not contain space.');
		$(".req_category").show();
		$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
		$(".req_product_attr").hide();
		$(".req_category").hide();
		$(".form_content input[name='name']").css('border-color', '#ccc');
		$(".req_name").hide();
		return false;
	}else{
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/catalog";
		$.ajax({
			url : base_url+controller+'/check_sku',
			type : 'POST',
			data : {sku:sku},
			success:function(result){
				if(result == 'exist'){
					$('.form_content').find('#collapseTwo').removeClass('in');
					$('.form_content').find('#collapseThree').removeClass('in');
					$('.form_content').find('#collapseFour').removeClass('in');
					$('.form_content').find('#collapseFive').removeClass('in');
					$('.form_content').find('#collapseSix').removeClass('in');
					$('.form_content').find('#collapseSeven').removeClass('in');
					$('.form_content').find('#collapseOne').addClass('in').removeAttr("style");
					
					$(".form_content input[name='sku']").css('border-color', 'red');
					$(".form_content input[name='sku']").select().focus();
					$(".req_sku").show().text('SKU should be unique.');
					$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
					$(".req_product_attr").hide();
					$(".req_category").hide();
					$(".form_content input[name='name']").css('border-color', '#ccc');
					$(".req_name").hide();
					return false;
				}else{
					$(".req_sku").hide();
					$(".form_content input[name='sku']").css('border-color','#ccc');
					return true;
				}
			}
		});
	}
}


function image_psuh()
{
	
	 var img_arr = document.getElementsByName("files[]");
		var img_arr_count=img_arr.length;
		
		var count=0;
		for (var i=0; i<img_arr_count; i++) {
			
		document.getElementById('files123').push=document.getElementById('files').files;
				
			
}


</script>

			<div id="content">  
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php'; ?>
					</div>
					

					<?php require_once('header_session.php'); ?>
				</div> 
				
				<!-- On 31 <?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) : 
				?>
					<div style="padding-top:60px; margin:0px 50px;">
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>
				<?php endif; ?>
				-->

				<div class="main-content">
					<?php require_once('common.php');  ?>
<?php if(isset($error)) : ?>
<h4 class="validation_error a-center"><?php echo $error; ?></h4>

<?php
endif;

$attributes = array('class' => 'cmxform', 'id' => 'myForm', 'method' => 'POST');
echo form_open_multipart('seller/catalog/save_new_product', $attributes);
?>
					<div class="bs-example form_content">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="product_attr_heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
										<div class="panel-heading">
											<h4 class="panel-title">Create Product Settings </h4>
										</div>
									</a>
								</div>
								<div id="collapseSeven" class="panel-collapse collapse in">
									<div class="panel-body">
										<table id="albums" style="width:100%;" cellspacing="0px">
											<tr>
												<td>Attribute Set <sup>*</sup></td>
												<td>
													<!--<select class="seller_input" name="attribute_set" onChange="ShowAttrHeadings(this.value)">-->
                                                    <select class="chosen-select" id="attribute_set" name="attribute_set" tabindex="4" onChange="ShowAttrHeadings()">
														<option value="">--Choose Attribute--</option>
													<?php if($attribute) :
														foreach($attribute as $row) : 
													?>
														<option value="<?php echo $row->attribute_group_id; ?>"><?php echo $row->attribute_group_name; ?></option>
													<?php endforeach;
														endif;
													?>
													</select>
                                                    <!--<input type="button" value="Go" id="go_btn" onClick="ShowAttrHeadings()">-->
                                                    <img src="<?php echo base_url();?>/images/progress.gif" id="attr_lodr">
													<div class="req_product_attr">This is a required field.</div>
												</td>
											</tr>
											<tr>
												<td colspan="2" id="attr_flds_td">
													
												</td>
											</tr>
											<!--<tr>
												<td>Product Type</td>
												<td>
													<select class="seller_input" name="product_type">
														<option value="">--Select Product Type--</option>
														<option value="simple product">Simple Product</option>
														<option value="grouped">Grouped Product</option>
													</select>
													<div class="req_product_type">This is a required field.</div>
												</td>
											</tr>-->
										
										
										<!--   Added on 27/11 -->
										<tr>
												<td>Select Category <sup>*</sup> :</td>
												<td>
										<div class="req_category">Please select a category.</div>
										<div class="left"> 
											<!--<ul id="example">
												<li id="category_li">
													<input id="subcategory_id"  type="radio" name="subcategory_id" value="" />dnfgdh
													<ul>
														<li>
															<input id="subcategory_id" type="radio" name="subcategory_id" value="" />Party Supplies
														</li>
													</ul>
												</li>
											</ul>-->
											<ul id="example">
<?php foreach($categories as $category){ ?>
												<li id="category_li">
													<!--<input id="subcategory_id" type="radio" name="subcategory_id" value="<?php// echo $category->category_name; ?>" disabled />--><?php echo $category->category_name; ?>
													<!--<ul>
<?php //foreach($subcategories as $subcategory):?>													
														<li>
															<input id="subcategory_id" type="radio" name="subcategory_id" value="" /><?php //echo $subcategory->category_name; ?>
														</li>
<?php //endforeach; ?>
													</ul>
												</li>
<?php //endforeach; ?>
											</ul>-->
											<ul>

      <?php $qr=$this->db->query("select * from category_indexing where parent_id='$category->category_id' "); 

	  	$ct=$qr->num_rows();
		
	  	if($ct>0){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs->category_id; ?>" />-->
				
		 <?php echo	$rs->category_name;?>
         
         <ul>
         <!--level-3-->
          <?php $qr1=$this->db->query("select * from category_indexing where parent_id='$rs->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct1=$qr1->num_rows();
		
	  	if($ct1>0){ ?>
        
        <?php 
			foreach($qr1->result() as $rs1){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs1->category_id; ?>" />
				
		 <?php echo	$rs1->category_name;?>
         
         
         <ul>
         <!--level-4-->
          <?php $qr2=$this->db->query("select * from category_indexing where parent_id='$rs1->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct2=$qr2->num_rows();
		
	  	if($ct2>0){ ?>
        
        <?php 
			foreach($qr2->result() as $rs2){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs2->category_id; ?>" />
				
		 <?php echo	$rs2->category_name;?>
         
         
         <ul>
         <!--level-5-->
          <?php $qr3=$this->db->query("select * from category_indexing where parent_id='$rs2->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct3=$qr3->num_rows();
		
	  	if($ct3>0){ ?>
        
        <?php 
			foreach($qr3->result() as $rs3){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs3->category_id; ?>" />
				
		 <?php echo	$rs3->category_name;?>
         
                 
         <ul>
         <!--level-6-->
          <?php $qr4=$this->db->query("select * from category_indexing where parent_id='$rs3->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct4=$qr4->num_rows();
		
	  	if($ct4>0){ ?>
        
        <?php 
			foreach($qr4->result() as $rs4){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs4->category_id; ?>" />
				
		 <?php echo	$rs4->category_name;?>
         
                 
          <ul>
         <!--level-7-->
          <?php $qr5=$this->db->query("select * from category_indexing where parent_id='$rs4->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct5=$qr5->num_rows();
		
	  	if($ct5>0){ ?>
        
        <?php 
			foreach($qr5->result() as $rs5){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs5->category_id; ?>" />
				
		 <?php echo	$rs5->category_name;?>
         
         
         <ul>
         <!--level-8-->
          <?php $qr6=$this->db->query("select * from category_indexing where parent_id='$rs5->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct6=$qr6->num_rows();
		
	  	if($ct6>0){ ?>
        
        <?php 
			foreach($qr6->result() as $rs6){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs6->category_id; ?>" />
				
		 <?php echo	$rs6->category_name;?>
         
          <ul>
         <!--level-9-->
          <?php $qr7=$this->db->query("select * from category_indexing where parent_id='$rs6->category_id'"); 
	  	//$rw=$qr->result();
	  	$ct7=$qr7->num_rows();
		
	  	if($ct7>0){ ?>
        
        <?php 
			foreach($qr7->result() as $rs7){?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs7->category_id; ?>" />
				
		 <?php echo	$rs7->category_name;?>
         
            <ul>
         <!--level-10-->
          <?php $qr8=$this->db->query("select * from category_indexing where parent_id='$rs7->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct8=$qr8->num_rows();
		
	  	if($ct8>0){ ?>
        
        <?php 
			foreach($qr8->result() as $rs8){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs8->category_id; ?>" />
				
		 <?php echo	$rs8->category_name;?>
         
                      
        </li> <?php } ?>  <?php } ?> </ul>              
                      
        </li> <?php } ?>  <?php } ?> </ul>
         
                      
        </li> <?php } ?>  <?php } ?> </ul>       
                      
        </li> <?php } ?>  <?php } ?> </ul>
         
                             
        </li> <?php } ?>  <?php } ?> </ul>
         
         
         
             
        </li> <?php } ?>  <?php } ?> </ul>
         
         
         
             
        </li> <?php } ?>  <?php } ?> </ul>
        
        
                 
        </li> <?php } ?>  <?php } ?> </ul>
              
         
        </li> <?php } ?>  <?php } ?> </ul>
     </li>
        <?php } ?>
  </ul>
  
  
										</div></td>
										</tr>
										</table>
										<!--   Added on 27/11 -->
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="product_attr_heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
										<div class="panel-heading">
											<h4 class="panel-title">General</h4>
										</div>
									</a>
								</div>
								<div id="collapseOne" class="panel-collapse collapse">
									<div class="panel-body">
										<table id="albums" style="width:100%;" cellspacing="0px">
											<tr>
												<td width="10%">Name <sup>*</sup> : </td>
												<td>
													<input type="text" name="name" class="seller_input">
													<div class="req_name">This is a required field.</div>
												</td>
												<td width="10%">SKU <sup>*</sup> <div class="wrapper"><i class="fa fa-question-circle"></i><div class="tooltip"> Only A-Za-z0-9_-   characters are allowed.</div></div> : </td>
												<td>
													<input type="text" name="sku" class="seller_input"  onBlur="checkSku(this.value)">
													<div class="req_sku">This is a required field.</div>
												</td>
											</tr>
											<tr>
												<td width="10%">Description <sup>*</sup> : </td>
												<td>
													<textarea name="description" rows="5" class="seller_input"></textarea>
													<div class="req_desc">This is a required field.</div>
												</td>
												<td width="10%">product highlights <sup>*</sup> : </td>
												<td>
													<input type="text" class="seller_input" id="seller_prodt_highlit1" name="seller_prodt_highlit[]" maxlength="30" placeholder="product highlights"><br><br>
													<input type="text" class="seller_input" name="seller_prodt_highlit[]" maxlength="30" placeholder="product highlights"><br><br>
													<input type="text" class="seller_input" name="seller_prodt_highlit[]" maxlength="30" placeholder="product highlights"><br><br>
													<input type="text" class="seller_input" name="seller_prodt_highlit[]" maxlength="30" placeholder="product highlights"><br><br>
													<input type="text" class="seller_input" name="seller_prodt_highlit[]" maxlength="30" placeholder="product highlights">
													<div class="req_short_desc">This is a required field.</div>
												</td>
											</tr>
											<tr>
												
												<td> Status <sup>*</sup> :  </td>
												<td> 
													<select class="seller_input" name="status">
														<option selected="selected" value="">-- Please Select --</option>
														<option value="Enabled">Enabled</option>
														<option value="Disabled">Disabled</option>
													</select>
													<div class="req_status">This is a required field.</div>
												</td>
											</tr>
											<tr>
												<td>Set Product as New from Date : </td>
												<td><input name="product_from_date" class="seller_input" id="datepicker-example7-start"></td>
												<td>Set Product as New to Date : </td>
												<td><input name="product_to_date" class="seller_input" id="datepicker-example7-end"></td>
											</tr>
											<tr>
												<td> Country of Manufacture : </td>
												<td> 
													<select class="seller_input" id="country2" name="country2"></select>
													<script language="javascript">
														populateCountries("country2");
													</script>
												</td>
												<td> Is Featured </td>
												<td> 
													<select class="seller_input" name="featured">
														<option value="Yes"> Yes </option>
														<option value="No" selected="selected"> No </option>
													</select>
												</td>
											</tr>
											<tr>
												<!--<td> Visibility <sup>*</sup> : </td>
												<td> 
													<select class="seller_input" name="visibility">
														<option value="">-- Please Select --</option>
														<option value="Not Visible Individually">Not Visible Individually</option>
														<option value="Catalog">Catalog</option>
														<option value="Search">Search</option>
														<option selected="selected" value="Catalog, Search">Catalog, Search</option>
													</select>
													<div class="req_visibility">This is a required field.</div>
												</td>-->
												
											</tr>
										</table>
										<!--<div class="right"><button type="button" class="seller_buttons" id="collapseOne_next"> Next </button></div>-->
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="product_attr_heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
										<div class="panel-heading">
											<h4 class="panel-title">Product Price</h4>
										</div>
									</a>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse">
									<div class="panel-body">
										<table id="albums" style="width:100%;"  cellspacing="0px">
											<tr>
												<td width="10%">MRP <sup>*</sup> : </td>
												<td>
													<input type="text" name="price" id="mrp_price" class="seller_input">
													<label>[INR]</label>
													<div class="req_price">This is a required field.</div>
												</td>
												<td>Special Price : </td>
												<td>
													<input type="text" name="special_price" id="spl_price" class="seller_input">
													<label>[INR]</label>
													<div class="req_splprice">This is a required field.</div>
												</td>
											</tr>
											<tr>
												<td>Special Price From Date : </td>
												<td>
													<input name="price_from_date" id="datepicker-example15-start" class="seller_input" type="text">
													<div class="req_splprice_fr_dt">This is a required field.</div>
												</td>
												
												<td>Special Price To Date : </td>
												<td>
													<input name="price_to_date" id="datepicker-example15-end" class="seller_input" type="text">
													<div class="req_splprice_to_dt">This is a required field.</div>
												</td>
											</tr>
											<tr>
												<td>Selling Price : </td>
												<td>
													<input type="text" name="selling_price" id="selng_price" class="seller_input">
													<label>[INR]</label>
													<div class="req_selprice">This is a required field.</div>
												</td>
												<td width="10%">Quantity <sup>*</sup> : </td>
												<td>
													<input type="text" name="qty" class="seller_input">
													<div class="req_quantity">This is a required field.</div>
												</td>
											</tr>
											<tr>
												<?php /*?><td> Tax Class <sup>*</sup> : </td>
												<td> 
													<select class="seller_input" name="tax_class">
														<option selected="selected" value="">-- Please Select --</option>
<?php if($tax_classes) :
		foreach($tax_classes as $row) :
?>
														<option value="<?=$row->tax_id?>"><?=$row->tri_name?></option>
<?php
		endforeach;
	endif;
?>
													</select>
													<div class="req_tax_class">This is a required field.</div>
												</td><?php */?>
                                                
                                                
                                                <td> GST <sup>*</sup> : </td>
												<td> 
													<input type="text" name="vat_cst" class="seller_input">&nbsp;%
													<div class="req_tax_class">This is a required field.</div>
                                                    <!--<div id="tx_amt_dv"></div>-->
												</td>
                                                
												<td>Weight (in grams) <sup>*</sup> : </td>
												<td>
													<input type="text" name="weight" onFocus="removeDefaultShipping()" id="prdt_weight" class="seller_input">
													<div class="req_weight">This is a required field.</div>
												</td>
											</tr>
											
											<!-- On 26/10/15
											<tr>
												<td> Shipping Fee <sup>*</sup></td>
												<td>
													<input type="radio" name="shippingfee" value="free"> Free &nbsp;&nbsp; 
													<input type="radio" name="shippingfee" value="flat"> Flat
												</td>
												<td colspan="3">
													<div id="shipping_fee_dv">Local : <input type="text" class="text dt" name="local_shipng_fee" id="local_shipng_fee">[INR] &nbsp;&nbsp;&nbsp;&nbsp;<div class="req_local_shipng_fee">This is a required field.</div> Zonal : <input type="text" class="text dt" name="zonal_shipng_fee" id="zonal_shipng_fee">[INR]&nbsp;&nbsp;&nbsp;&nbsp;<div class="req_zonal_shipng_fee">This is a required field.</div> National : <input type="text" class="text dt" name="national_shipng_fee" id="national_shipng_fee">[INR]<div class="req_national_shipng_fee">This is a required field.</div></div>
													<div id="flat_fee">Set Amount : 
														<input type="text" class="text dt" name="flat_shipng_fee" id="flat_shipng_fee">[INR]
														<div class="req_flat_fee">This is a required field.</div>
													</div>
												</td>
											</tr>-->
											<tr>
												<td> Shipping Fee <sup>*</sup></td>
												<td>
													<select name="shipping_typ" id="shipping_typ" class="seller_input" onChange="showshippingAmount(this.value)">
														<option value="">Choose shipping type</option>
														<option value="Free">Free</option>
														<option value="Default">Default</option>
													</select>
													<div class="req_visibility">This is a required field.</div>
												</td>
												<td colspan="2">
													<div id="default_fee"><span>Set Amount : </span>
														<input type="text" class="seller_input" onKeyUp="calculateshippingCost(this.value)" name="default_shipng_fee" id="default_shipng_fee" onBlur="CheckVal(this.value)"><label>[INR] (per Kg.)</label> &nbsp;&nbsp;&nbsp;
														<div class="req_flat_fee">This is a required field.</div>
														<span id="shpng_spn"></span>
													</div>
													<input type="hidden" id="hidden_shipping_fee" name="hidden_shipping_fee">
												</td>
											</tr>	
											
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="product_attr_heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
										<div class="panel-heading">
											<h4 class="panel-title">Product Images</h4>
										</div>
									</a>
								</div>
								<div id="collapseThree" class="panel-collapse collapse">
									<div class="panel-body">
										<div>
											<div class="product_image">
												<!--<img src="<?php// echo base_url();?>images/Tulips.jpg" width="500" height="400" alt="">-->
												<div class="">
													<p>Image</p>
													<!--<input type="file" name="product_img[]" multiple></br>-->
                                                    
													<!--<input type="file" id="files" name="userfile[]"  onChange="image_psuh(this.value)" multiple /> <br>
                                                    
                                                 <span style="display:none;"> <input type="file" id="files123" name="userfile[]" multiple /> </span>
                                                   
													<input type="reset" class="all_buttons" value="Reset" onClick="reset_images()">-->
                                                    
                                                    <div id="uploadfile">Upload</div>
                                                    
													<div class="req_files">This is a required field.</div>
													<!--<input type="submit" name="submit" class="seller_buttons" value="Upload image">-->
													<!--<div id="image_show"></div>-->
													
													Image Guidelines for upload<br>
													<ul>
														<li> Maximum images supported :- 5 </li>
														<li> Minimum images requirded :- 1 </li>
														<li> First Image is Default Image. </li>
														<li> Maximum images size :- 1MB </li>
														<li> Minimum Image Resolution :- 500 X 500 </li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default" style="display:none;">
								<div class="product_attr_heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
										<div class="panel-heading">
											<h4 class="panel-title">Product Meta Information(SEO)</h4>
										</div>
									</a>
								</div>
								<div id="collapseFour" class="panel-collapse collapse">
									<div class="panel-body">
										<table id="albums" style="width:100%;"  cellspacing="0px">
											<tr>
												<td width="10%">Meta Title : </td>
												<td>
													<input type="text" name="meta_title" class="seller_input">
												</td>
												<td width="10%">Meta Keyword : <br>
													(Multiple key words should be separated by cumma)
												</td>
												<td>
													<textarea name="meta_keyword" rows="5" class="seller_input"></textarea>
												</td>
											</tr>
											<tr>
												<td>Meta Description : </td>
												<td><textarea name="meta_description" rows="5" class="seller_input"></textarea></td>
												<td></td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<!-- On 26/10/15
							<div class="panel panel-default">
								<div class="product_attr_heading">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
										<div class="panel-heading">
											<h4 class="panel-title">Product Inventory</h4>
										</div>
									</a>
								</div>
								<div id="collapseFive" class="panel-collapse collapse">
									<div class="panel-body">
										<table id="albums" style="width:100%;"  cellspacing="0px">
											<tr>
												<td width="10%">Quantity <sup>*</sup> : </td>
												<td>
													<input type="text" name="qty" class="seller_input">
													<div class="req_quantity">This is a required field.</div>
												</td>
												
												<td width="10%">Maximum Qty Allowed in Shopping Cart : </td>
												<td>
													<input type="text" name="max_qty_allowed" class="seller_input">
												</td>
											</tr>
											<tr>
												<td width="10%">Enable Qty Increments : </td>
												<td> 
													<select class="seller_input" name="qty_increment">
														<option value="yes"> Yes </option>
														<option value="no" selected="selected"> No </option>
													</select>
												</td>
												<td>Stock Availability: </td>
												<td> 
													<select class="seller_input" name="stock_avail">
														<option selected="selected" value="">-- Please Select --</option>
														<option value="In Stock">In Stock</option>
														<option value="Out of Stock">Out of Stock</option>
													</select>
												</td>-->
											<!--27/11
											</tr>
										</table>
										<!--<div class="right"><button type="button" class="seller_buttons" id="collapseFive_next"> Next </button></div>-->
									<!--27/11
									</div>
								</div>
							</div>-->
							
						</div>
					</div>
					<div class="right">
						<!--<input type="button" class="seller_buttons" value="Save Draft" /> -->
						<input type="submit" class="seller_buttons" id="product_submit" value="Submit" onClick="return valid_product_form()">
					</div>
					</form>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<script>
	/*$(document).ready(function(){
		$("input:radio[name=shippingfee]").click(function(){
			$('#shipping_fee_dv').hide();
			var val = $(this).val();
			if(val == 'flat'){
				$('#flat_fee').show();
			}else{
				$('#flat_fee').hide();
			}
		});
	});*/
</script>
<script>
	function showshippingAmount(shipping_typ){
		if(shipping_typ == 'Free'){
			$('#default_fee').hide();
			/*$('#flat_fee').hide();*/
		}else if(shipping_typ == 'Default'){
			$('#flat_fee').hide();
			$('#default_fee').show();
		}
	}
	
	function calculateshippingCost(amount){
		var product_weight_in_gm = $('#prdt_weight').val();
		var product_weight_in_kg = product_weight_in_gm/1000;
		var product_rounded_weight = Math.ceil(product_weight_in_kg);
		
		//allowed maximum shipping fee amount//
		var max_shipping_fee = product_rounded_weight*60;
		
		var input_shipping_fee = $('#default_shipng_fee').val();
	
		//var product_shipping_fee = Math.ceil(product_weight_in_kg*amount);
			
		if(input_shipping_fee > max_shipping_fee){
			alert('Your Maximum shipping amount Allowed  : Rs. '+ max_shipping_fee);
			$('#default_shipng_fee').val('');
			return false;
		}else{
			var shipping_amt = input_shipping_fee;
		}
		
		$('#shpng_spn').text('Shipping fee : Rs.'+ shipping_amt);
		$('#hidden_shipping_fee').val(shipping_amt);
	}
	
	
	function CheckVal(val){
		var input_shipping_fee_ten = (val/10);
		if(Number.isInteger(input_shipping_fee_ten) === false){
			alert('Shipping fee amount should be multiple with 10');
			$('#default_shipng_fee').val('');
			return false;
		}
	}
</script>	


<script>
/*function ShowAttrHeadings(attr_group_id){
	$.ajax({
		url:'<?php// echo base_url(); ?>seller/attribute/show_attr_headings',
		method:'post',
		data:{group_id:attr_group_id},
		success:function(result){
			$(".form_content select[name='attribute_set']").css('border-color', '#ccc');
			$(".req_product_attr").hide();
			$('#attr_flds_td').fadeIn();
			$('#attr_flds_td').html(result);
		}
	});
}*/

///show attr heading script start here///
function ShowAttrHeadings(){
	var attr_group_id = $('#attribute_set').val();
	if(attr_group_id == ''){
		alert('Please select the attribute set.');
		return false;
	}else{
		/*$('#go_btn').attr('disabled', true);
		$('#go_btn').css('cursor','no-drop');
		$('#go_btn').val('wait..');*/
		$('#attr_flds_td').hide();
		$('#attr_lodr').show();
		$.ajax({
			url:'<?php echo base_url(); ?>admin/attribute/show_attr_headings',
			method:'post',
			data:{group_id:attr_group_id},
			success:function(result){
				$('#attr_flds_td').fadeIn();
				$('#attr_flds_td').html(result);
				/*$('#go_btn').attr('disabled', false);
				$('#go_btn').css('cursor','pointer');
				$('#go_btn').val('Go');*/
				$('#attr_lodr').hide();
				$('#attr_flds_td').show();
			}
		});
	}
}
///show attr heading script end here///



function reset_images(){
	//var h = $("img#uploadImgID").length; //alert(h); return false;
    $("img#uploadImgID").remove();
}


/*function calculateTaxAmount(val){
	var mrp = $('#mrp_price').val();
	var selling_price = $('#selng_price').val();
	var spl_price = $('#spl_price').val();
	
	if(spl_price != ''){
		var final_price = spl_price;
	}else{
		if(selling_price != ''){
			var final_price = selling_price;
		}else{
			var final_price = mrp;
		}
	}
	
	$('#tx_amt_dv').show();
	$('#tx_amt_dv').text(final_price);
}*/

function removeDefaultShipping(){
	$('#default_shipng_fee').val('');
	$('#shpng_spn').text('Shipping fee : Rs.'+ 0);
	$('#hidden_shipping_fee').val(0);
}
</script>	

<style>
.wrapper{background: #ececec; font-family: "Gill Sans", Impact, sans-serif; position: relative; text-align: center; width: 0px; float: right; right: 55px; cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}

.wrapper .tooltip{ background: #1496bb; bottom: 100%; color: #fff; display: block; left: -130px; margin-bottom: 8px; opacity: 0; padding: 10px; pointer-events: none; position: absolute; width: 275px;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {bottom: -20px; content: " "; display: block; height: 20px; left: 0; position: absolute; width: 100%;}  

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after { border-left: solid transparent 10px; border-right: solid transparent 10px; border-top: solid #1496bb 10px; bottom: -10px; content: " "; height: 0; left: 50%; margin-left: -13px; position: absolute; width: 0;}
  
.wrapper:hover .tooltip {opacity: 1; pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip { display: none;}

.lte8 .wrapper:hover .tooltip { display: block;}
</style>	
<!------ Start Content ------>

<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>


<?php
require_once('footer.php');
?>		