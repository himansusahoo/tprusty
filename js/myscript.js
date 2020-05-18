///////Product form validation start here/////////
function ValidProduct_edit_form(){
	//var product_attr_set = $('#attribute_set').val();
	var name = $('#prdt_name').val();
	var description = $('#prdt_desc').val();
	var short_description = $('#prdt_short_desc').val();
	var sku = $('#prdt_sku').val();
	var weight = $('#prdt_weight').val();
	var shipping_typ = $('#shipping_typ').val();
	var default_shipng_fee = $('#default_shipng_fee').val();
	var sts = $('#prdt_sts').val();
	//var shipping_fee_type = $('input[name=shippingfee]:checked').val();
	var mrp = parseFloat($('#mrp').val());
	var price = parseFloat($('#price').val());
	var special_price = parseFloat($('#special_price').val());
	var spcil_price_from_date = $('#datepicker-example7-start1').val();
	var spcil_price_to_date = $('#datepicker-example7-end1').val();
	//var tax_class = $('#tax_cls').val();
	var vat_cst = $('#vat_cst').val();
	/*var local_shiping_fee = $('#local_shipng_fee').val();
	var zonal_shiping_fee = $('#zonal_shipng_fee').val();
	var national_shiping_fee = $('#national_shipng_fee').val();*/
	//var photo = $('#files').val();
	var photo = $('.ajax-file-upload-container').text();
	var photo_count = $("img#uploadImgID").length;
	var quantity = $('#qty').val();
	
	var prev_photo_count = $('.prdct-thumb-img img').length;
	////start script for getting shipping fee value /////
	/*if($("input[name='shippingfee']").is(':checked')) {
   		var shipping_fee_type = $('input[name="shippingfee"]:checked').val(); 	
	}else{
		var shipping_fee_type = '';
	}
	
	var flat_shipping_fee = $('#flat_shipng_fee').val();*/
	////start script for getting shipping fee value /////
	
	///////category validation start////////
	/*var subcategoryid = document.getElementsByName("subcategory_id");
	var subcategoryid_count = subcategoryid.length;
	
	var count = 0;
	for (var i=0; i<subcategoryid_count; i++) {
		if(subcategoryid[i].checked === true) {
			count++;
		}
	}*/
	///////category validation end////////
	
	/*if(product_attr_set == ''){
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Product attribute is required.');		
		$('#attribute_set').css('border-color','red');
		
		$('.form_view').find('#tab1').addClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').addClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		return false;
	}else if(count == 0){
		$('.form_view').find('#tab1').addClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').addClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#files').css('border','none');
		$('#qty').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Category is required.');
		return false;
	}else */if(name == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Name field is required.cbgdfgdfgd');
		$('#prdt_name').css('border-color','red');
		$('#prdt_name').focus();
		return false;
	}else if(description == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Description field is required.');
		$('#prdt_desc').css('border-color','red');
		$('#prdt_desc').focus();
		return false;
	}else if(short_description == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Short description field is required.');
		$('#prdt_short_desc').css('border-color','red');
		$('#prdt_short_desc').focus();
		return false;
	}else if(sku == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('SKU field is required.');
		$('#prdt_sku').css('border-color','red');
		$('#prdt_sku').focus();
		return false;
	}else if(sts == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Status field is required.');
		$('#prdt_sts').css('border-color','red');
		return false;
	}else if(mrp == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('MRP field is required.');
		$('#mrp').focus();
		$('#mrp').css('border-color','red');
		return false;
	}else if(isNaN(mrp)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid MRP amount.');
		$('#mrp').select();
		$('#mrp').css('border-color','red');
		return false;
	}/*else if(price == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Price field is required.');
		$('#price').focus();
		$('#price').css('border-color','red');
		return false;
	}*/else if(isNaN(price)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid price amount.');
		$('#price').select();
		$('#price').css('border-color','red');
		return false;
	}else if(isNaN(special_price)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid special price amount.');
		$('#special_price').select();
		$('#special_price').css('border-color','red');
		return false;
	}else if(special_price > mrp){
		//alert(special_price);return false;
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price should be less than MRP.');
		$('#special_price').select();
		$('#special_price').css('border-color','red');
		return false;
	}else if(special_price != "" && spcil_price_from_date == ""){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price from date is requirded.');
		$('#datepicker-example7-start1').css('border-color','red');
		return false;
	}else if(special_price != "" && spcil_price_to_date == ""){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price to date is requirded.');
		$('#datepicker-example7-end1').css('border-color','red');
		return false;
	}else if(vat_cst == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('VAT / CST field is required.');
		$('#vat_cst').css('border-color','red');
		return false;
	}else if(isNaN(vat_cst)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid Amount.');
		$('#vat_cst').css('border-color','red');
		$('#vat_cst').select();
		return false;
	}else if(weight == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Weight field is required.');
		$('#prdt_weight').css('border-color','red');
		$('#prdt_weight').focus();
		return false;
	}else if(isNaN(weight)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid weight amount.');
		$('#prdt_weight').css('border-color','red');
		$('#prdt_weight').select();
		return false;
	}/*else if(shipping_typ == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Shipping type is required.');
		$('#shipping_typ').css('border-color','red');
		$('#shipping_typ').focus();
		return false;
	}else if(shipping_typ == 'Default' && default_shipng_fee == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#shipping_typ').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Shipping fee is required.');
		$('#default_shipng_fee').css('border-color','red');
		$('#default_shipng_fee').focus();
		return false;
	}else if(shipping_typ == 'Default' && isNaN(default_shipng_fee)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#shipping_typ').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid shipping amount.');
		$('#default_shipng_fee').css('border-color','red');
		$('#default_shipng_fee').select();
		return false;
	}else if(shipping_typ == 'Default' && default_shipng_fee > 60){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#shipping_typ').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Minimum shipping amount should be Rs. 60');
		$('#default_shipng_fee').css('border-color','red');
		$('#default_shipng_fee').select();
		return false;
	}else if(quantity == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
		$('#files').css('border','none');
		$('#default_shipng_fee').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Quantity field is required.');
		$('#qty').focus();
		$('#qty').css('border-color','red');
		return false;
	}*/else if(photo_count == 0 && prev_photo_count == 0 && photo == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').addClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').addClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
		$('#default_shipng_fee').css('border-color','#ccc');
		$('#qty').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Product image is required.');
		$('#files').css('border','1px solid red');
		return false;
	}else if(photo_count+prev_photo_count > 6){
		//else if(photo_count < 1 || photo_count > 5){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').addClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').addClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
		$('#default_shipng_fee').css('border-color','#ccc');
				
		$("#files").val('');
		$("img#uploadImgID").remove();
		$('.valid_msg_dv').show().text('Please Upload required no of Images.');
		$('#files').css('border','1px solid red');
		return false;
	}
}
///////Product form validation end here/////////

///////Product Price Information form validation start here/////////
function validPriceinfo(){
	var price = $('#price').val();
	var tax_cls = $('#tax_cls').val();
	if(price == ''){
		$('.valid_msg_dv').text('Price field is required.');
		$('#price').css('border-color','red');
		$('#price').focus();
		return false;
	}else if(isNaN(price)){
		$('.valid_msg_dv').text('Invalid price amount.');
		$('#price').css('border-color','red');
		$('#price').select();
		return false;
	}else if(tax_cls == ''){
		$("#price").css('border-color','#ccc');
		$('.valid_msg_dv').text('Tax class is required.');
		$('#tax_cls').css('border-color','red');
		return false;
	}
}
///////Product Price Information form validation end here/////////


///////Approved exiting product validation start here/////////
function Valid_existing_approved_product_edit_form(){
	//var product_attr_set = $('#attribute_set').val();
	var sku = $('#prdt_sku').val();
	var weight = $('#prdt_weight').val();
	var shipping_typ = $('#shipping_typ').val();
	var default_shipng_fee = $('#default_shipng_fee').val();
	var sts = $('#prdt_sts').val();
	//var shipping_fee_type = $('input[name=shippingfee]:checked').val();
	var mrp = $('#mrp').val();
	var price = $('#price').val();
	var special_price = $('#special_price').val();
	var spcil_price_from_date = $('#datepicker-example7-start1').val();
	var spcil_price_to_date = $('#datepicker-example7-end1').val();
	//var tax_class = $('#tax_cls').val();
	var vat_cst = $('#vat_cst').val();
	var quantity = $('#qty').val();
	
	if(sku == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('SKU field is required.');
		$('#prdt_sku').css('border-color','red');
		$('#prdt_sku').focus();
		return false;
	}else if(sts == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Status field is required.');
		$('#prdt_sts').css('border-color','red');
		return false;
	}else if(mrp == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('MRP field is required.');
		$('#mrp').focus();
		$('#mrp').css('border-color','red');
		return false;
	}else if(isNaN(mrp)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid MRP amount.');
		$('#mrp').select();
		$('#mrp').css('border-color','red');
		return false;
	}else if(isNaN(price)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid price amount.');
		$('#price').select();
		$('#price').css('border-color','red');
		return false;
	}else if(isNaN(special_price)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid special price amount.');
		$('#special_price').select();
		$('#special_price').css('border-color','red');
		return false;
	}else if(Integer.parseInt(special_price) > Integer.parseInt(mrp)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price should be less than MRP.');
		$('#special_price').select();
		$('#special_price').css('border-color','red');
		return false;
	}else if(special_price != "" && spcil_price_from_date == ""){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price from date is requirded.');
		$('#datepicker-example7-start1').css('border-color','red');
		return false;
	}else if(special_price != "" && spcil_price_to_date == ""){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price to date is requirded.');
		$('#datepicker-example7-end1').css('border-color','red');
		return false;
	}else if(vat_cst == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('VAT / CST field is required.');
		$('#vat_cst').css('border-color','red');
		return false;
	}else if(isNaN(vat_cst)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid Amount.');
		$('#vat_cst').css('border-color','red');
		$('#vat_cst').select();
		return false;
	}else if(weight == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Weight field is required.');
		$('#prdt_weight').css('border-color','red');
		$('#prdt_weight').focus();
		return false;
	}else if(isNaN(weight)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#vat_cst').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid weight amount.');
		$('#prdt_weight').css('border-color','red');
		$('#prdt_weight').select();
		return false;
	}
}
///////Approved exiting product validation end here/////////