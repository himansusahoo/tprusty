<script>
var section_id=0;

function add_section()
{
	
	 section_id=section_id+1;
	$('#section_div').append('<fieldset id="fld_secion_'+section_id+'"><legend>Section '+section_id+'</legend><table><tr><td>Number Of Column</td><td><input type="number"></td></tr></table></fieldset>');
}
var j=1;
function add_columninfo()
{
	/*if(!$("#catid option:selected").length)
	{
		$("#show_error").text('! Please Select Menu Link');
		$("#catid").focus();
	 	$("#show_error").show();
		return false;	
	}*/
	if($('#section_type').val()=='')
	{
		$("#show_error").text('! Please Select Section Type');
		$("#section_type").focus();
	 	$("#show_error").show();
		return false;	
	}
	if($('#sectiondata_type').val()=='')
	{
		$("#show_error").text('! Please Select Section Data Type');
		$("#sectiondata_type").focus();
	 	$("#show_error").show();
		return false;	
	}
	
	if($('#section_status').val()=='')
	{
		$("#show_error").text('! Please Select Section Status');
		$("#section_status").focus();
	 	$("#show_error").show();
		return false;	
	}
	if($('#sectionbackg_clr').val()=='')
	{
		$("#show_error").text('! Please Select Section Background Color');
		$("#sectionbackg_clr").focus();
	 	$("#show_error").show();
		return false;	
	}
	
	var num_col=$('#col_num').val();
	if(num_col=='')
	{
		$("#show_error").text('! Please Select Number Of Column');
		$("#col_num").focus();
	 	$("#show_error").show();
	}
	else
	{
		//-------------------------Disable section Data start-----------------//
			$('#sectio_submit').css('display','block');			
			
			$('#lbl_section_type').text($('#section_type').val());
			$('#section_type').css('display', 'none');
			
			$('#lbl_sectiondata_type').text($('#sectiondata_type').val());
			$('#sectiondata_type').css('display', 'none');			
			
			$('#lbl_section_status').text($('#section_status').val());
			$('#section_status').css('display', 'none');
			
			$('#lbl_col_num').text($('#col_num').val());
			$('#col_num').css('display', 'none');		
			
			$('#lbl_slctimage_size').text($('#slctimage_size').val()+' Pixel');
			$('#slctimage_size').css('display', 'none');
			
			$('#add_sectioncolumninfo').attr('disabled', true);
			$('#add_sectioncolumninfo').css('background-color', '#EBEBE4');
		
		//-------------------------Disable section Data end--------------------//
			
		$('#columninfo_div').css('display','block');
		
		for (var i = 1; i <= num_col; i++) {
           $('#columninfo_div #fld_secion_'+i).remove();  
        }	
		
	if($('#section_type').val()!='Video' && $('#section_type').val()!='Product' && $('#section_type').val()!='Prodcts Vertical section' && $('#section_type').val()!='Rich Text Editor' && $('#section_type').val()!='Product Catalog')
		{
		 for (var i = 1; i <= num_col; i++) {
           $('#columninfo_div').append('<fieldset id="fld_secion_'+i+'"><legend style="background-color:#a3e4d7;">Column '+i+' &nbsp;</legend><table><tr><td>Column Background Color</td><td align="left"><input type="color" class="text2" name="clmn_bgcolor[]" id="clmn_bgcolor'+i+'" style="width:200px; height:40px;"></td></tr><tr><td>Column Status</td><td align="left"><select class="text2" name="clmn_sts[]" id="clmn_sts'+i+'" style="width:200px; height:40px;"><option value="active">Active</option><option value="inactive">Inactive</option></select></td></tr><tr><td>Column Type</td><td><select class="text2" name="clmn_type[]" id="clmn_type'+i+'" style="width:200px; height:40px;"><option value="">--select--</option><option value="url">URL</option><option value="sku">SKU</option></select></td></tr><tr><td style="width:20%;"> Memo </td><td><textarea class="text2" name="clmn_memo[]" id="clmn_memo'+i+'"></textarea></td></tr><tr><td colspan="2" align="center"><fieldset id="fld_culmn'+i+'" style="background-color:#a9dfbf;"><legend style="background-color:#9CF;">Image Upload With Link</legend><div class="alert" id="alrt'+i+'" style="display:none;"><span class="closebtn" style="display:none;">&times;</span><strong>!</strong></div><button style="float:right;" type="button" id="add_sectioncolumninfo" class="seller_buttons" onClick="add_image('+i+')" ><i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;ADD Image </button><table id="img_tbl'+i+'" class="table table-bordered table-hover" style="background-color:#FFF;"><tr style="background-color:#f5b041;"><th width="10%">Image</th><th width="5%">Link Type</th><th width="15%">SKU / URL</th><th width="5%">Image Status</th><th width="5%">From date</th><th width="5%">To date</th><th width="10%">Memo</th><th width="5%">Action</th></tr><tr id="tblrow_tbl'+i+j+'"><td><input type="file" style="width:192px;" id="imgInp'+i+j+'" name="userfile'+i+'[]'+'"  onChange="preview_img(this,'+i+','+j+')" ><img id="imgprvw'+i+j+'" src="#" alt="your image" style="width:95px;height:80px;display:none;" /></br><span id="removimage'+i+j+'" style="color:red;display:none;cursor:pointer;" onClick="img_remove('+i+','+j+')">Remove Image</span><fieldset id="imgelbl'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Image Label</legend><span class="textarea_val'+i+j+'" style="width:20%; float:right; margin-top: -52px;    padding: 16px; display: inline-block;"></span><textarea name="imglab_txtara'+i+'[]'+'" id="imglab_txtara'+i+j+'" class="imglab_txtara'+i+j+'" onKeyUp="onkeuup('+i+j+')" maxlength="8"  style="width:127px;" placeholder="Enter Image Label"></textarea></fieldset></td><td><select onChange="display_urlvisible('+i+','+j+')" style="width:80px;" class="text2" name="img_skuorurl'+i+'[]'+'" id="img_skuorurl'+i+j+'" style="width:80px; height:40px;"><option value="sku">SKU</option><option value="url">URL</option><option value="nolink">No Link</option></select></br></br><fieldset id="displayurlfldset'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Display URL</legend><textarea name="dispaly_url'+i+'[]'+'" id="dispaly_url'+i+j+'"  style="width:127px;" placeholder="Enter Display URL"></textarea></fieldset></br><fieldset id="sortbyinfo'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Sort By</legend><select style="width:150px; height:40px;" class="text2" name="sku_sortby'+i+'[]'+'" id="sku_sortby'+i+j+'"><option value="as_per_sku">As Per sku</option><option value="random">Random</option><option value="prc_asc">Price High To Low</option><option value="pric_dec">Price Low To High</option></select></fieldset></td><td><textarea id="imglinkkskuorurl'+i+j+'" name="imglinkkskuorurl'+i+'[]'+'" style="width:192px; height:80px;"></textarea><br><div style="font-weight:bold;text-align:center;" align="center">OR</div><br><input style="width:192px;" type="file" onChange="valid_csvfileextension(this,'+i+','+j+')" id="ExcelInp'+i+j+'" name="userfile_excel'+i+'[]'+'"></td><td><select class="text2" name="img_sts'+i+'[]'+'" id="img_sts'+i+j+'" style="width:80px;"><option value="active">Active</option><option value="inactive">Inactive</option></select></td><td><input type="date" id="from_dt'+i+j+'" style="width:150px;" name="from_dt'+i+'[]'+'"></td><td><input type="date" id="to_date'+i+j+'" name="to_date'+i+'[]'+'" style="width:150px;" ></td><td><textarea style="width:116px; height:80px;" name="img_memo'+i+'[]'+'" id="img_memo'+i+j+'" ></textarea></td><td><i style="color:#FF0000;cursor:pointer;" onClick="remove_imgtblrow('+i+','+j+')" class="fa fa-times" aria-hidden="true"></i></td></tr></table></fieldset></td></tr></table></fieldset>'); 
        }
		
	} // image sectio display if condtion end
	else
	{var i = 1;
		$('#columninfo_div').append('<fieldset id="fld_secion_'+i+'"><legend style="background-color:#a3e4d7;">Column '+i+' &nbsp;</legend><table><tr><td>Column Background Color</td><td align="left"><input type="color" class="text2" name="clmn_bgcolor[]" id="clmn_bgcolor'+i+'" style="width:200px; height:40px;"></td></tr><tr><td>Column Status</td><td align="left"><select class="text2" name="clmn_sts[]" id="clmn_sts'+i+'" style="width:200px; height:40px;"><option value="active">Active</option><option value="inactive">Inactive</option></select></td></tr><tr><td>Column Type</td><td><select class="text2" name="clmn_type[]" id="clmn_type'+i+'" style="width:200px; height:40px;"><option value="">--select--</option><option value="url">URL</option><option value="sku">SKU</option></select></td></tr><tr><td style="width:20%;"> Memo </td><td><textarea class="text2" name="clmn_memo[]" id="clmn_memo'+i+'"></textarea></td></tr><tr><td colspan="2" align="center"><fieldset id="fld_culmn'+i+'" style="background-color:#a9dfbf;"><legend style="background-color:#9CF;">Image Upload With Link</legend><div class="alert" id="alrt'+i+'" style="display:none;"><span class="closebtn" style="display:none;">&times;</span><strong>!</strong></div><button style="float:right;display:none;" type="button" id="add_sectioncolumninfo" class="seller_buttons" onClick="add_image('+i+')" ><i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;ADD Image </button><table id="img_tbl'+i+'" class="table table-bordered table-hover" style="background-color:#FFF;"><tr style="background-color:#f5b041;"><th width="10%">Image</th><th width="5%">Link Type</th><th width="15%">SKU / URL</th><th width="5%">Image Status</th><th width="5%">From date</th><th width="5%">To date</th><th width="10%">Memo</th><th width="5%">Action</th></tr><tr id="tblrow_tbl'+i+j+'"><td><input type="file" style="width:192px;" id="imgInp'+i+j+'" name="userfile'+i+'[]'+'"  onChange="preview_img(this,'+i+','+j+')" ><img id="imgprvw'+i+j+'" src="#" alt="your image" style="width:95px;height:80px;display:none;" /></br><span id="removimage'+i+j+'" style="color:red;display:none;cursor:pointer;" onClick="img_remove('+i+','+j+')">Remove Image</span><fieldset id="imgelbl'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Image Label</legend><span class="textarea_val'+i+j+'" style="width:20%; float:right; margin-top: -52px;    padding: 16px; display: inline-block;"></span><textarea name="imglab_txtara'+i+'[]'+'" id="imglab_txtara'+i+j+'" class="imglab_txtara'+i+j+'" onKeyUp="onkeuup('+i+j+')" maxlength="8"  style="width:127px;" placeholder="Enter Image Label"></textarea></fieldset></td><td><select onChange="display_urlvisible('+i+','+j+')" style="width:80px;" class="text2" name="img_skuorurl'+i+'[]'+'" id="img_skuorurl'+i+j+'" style="width:80px; height:40px;"><option value="sku">SKU</option><option value="url">URL</option><option value="nolink">No Link</option></select></br></br><fieldset id="displayurlfldset'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Display URL</legend><textarea name="dispaly_url'+i+'[]'+'" id="dispaly_url'+i+j+'"  style="width:127px;" placeholder="Enter Display URL"></textarea></fieldset></br><fieldset id="sortbyinfo'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Sort By</legend><select style="width:150px; height:40px;" class="text2" name="sku_sortby'+i+'[]'+'" id="sku_sortby'+i+j+'"><option value="as_per_sku">As Per sku</option><option value="random">Random</option><option value="prc_asc">Price High To Low</option><option value="pric_dec">Price Low To High</option></select></fieldset></td><td><textarea id="imglinkkskuorurl'+i+j+'" name="imglinkkskuorurl'+i+'[]'+'" style="width:192px; height:80px;"></textarea><br><div style="font-weight:bold;text-align:center;" align="center">OR</div><br><input onChange="valid_csvfileextension(this,'+i+','+j+')" type="file" style="width:192px;" id="ExcelInp'+i+j+'" name="userfile_excel'+i+'[]'+'"></td><td><select class="text2" name="img_sts'+i+'[]'+'" id="img_sts'+i+j+'" style="width:80px;"><option value="active">Active</option><option value="inactive">Inactive</option></select></td><td><input type="date" id="from_dt'+i+j+'" style="width:150px;" name="from_dt'+i+'[]'+'"></td><td><input type="date" id="to_date'+i+j+'" name="to_date'+i+'[]'+'" style="width:150px;" ></td><td><textarea style="width:116px; height:80px;" name="img_memo'+i+'[]'+'" id="img_memo'+i+j+'" ></textarea></td><td><i style="color:#FF0000;cursor:pointer;" onClick="remove_imgtblrow('+i+','+j+')" class="fa fa-times" aria-hidden="true"></i></td></tr></table></fieldset></td></tr></table></fieldset>');
	if($('#section_type').val()=='Rich Text Editor')
		{
			$('#columninfo_div').css('display','none');
			$('#richtexteditor_divid').css('display','block');
		}
		else
		{
			$('#columninfo_div').css('display','block');
			$('#richtexteditor_divid').css('display','none');
		}
	} 
			
	}	
}
</script>

<script>
function add_image(i)
{ j=j+1;
	$('#columninfo_div #fld_secion_'+i+' #fld_culmn'+i+' #img_tbl'+i+' ').append('<tr id="tblrow_tbl'+i+j+'"><td><input style="width:192px;" type="file" id="imgInp'+i+j+'" name="userfile'+i+'[]'+'"  onChange="preview_img(this,'+i+','+j+')" ><img id="imgprvw'+i+j+'" src="#" alt="your image" style="width:95px;height:80px;display:none;" /></br><span id="removimage'+i+j+'" style="color:red;display:none;cursor:pointer;" onClick="img_remove('+i+','+j+')">Remove Image</span><fieldset id="imgelbl'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Image Label</legend><span class="textarea_val'+i+j+'" style="width:20%; float:right; margin-top: -52px;    padding: 16px; display: inline-block;"></span><textarea name="imglab_txtara'+i+'[]'+'" id="imglab_txtara'+i+j+'" class="imglab_txtara'+i+j+'" onKeyUp="onkeuup('+i+j+')" maxlength="8" style="width:127px;" placeholder="Enter Image Label"></textarea></fieldset></td><td><select onChange="display_urlvisible('+i+','+j+')" style="width:80px;" class="text2" name="img_skuorurl'+i+'[]'+'" id="img_skuorurl'+i+j+'" style="width:80px; height:40px;"><option value="sku">SKU</option><option value="url">URL</option><option value="nolink">No Link</option></select></br></br><fieldset id="displayurlfldset'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Display URL</legend><textarea name="dispaly_url'+i+'[]'+'" id="dispaly_url'+i+j+'"  style="width:127px;" placeholder="Enter Display URL"></textarea></fieldset></br><fieldset id="sortbyinfo'+i+j+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Sort By</legend><select style="width:150px; height:40px;" class="text2" name="sku_sortby'+i+'[]'+'" id="sku_sortby'+i+j+'"><option value="as_per_sku">As Per sku</option><option value="random">Random</option><option value="prc_asc">Price High To Low</option><option value="pric_dec">Price Low To High</option></select></fieldset></td><td><textarea id="imglinkkskuorurl'+i+j+'" name="imglinkkskuorurl'+i+'[]'+'" style="width:192px; height:80px;"></textarea><br><div style="font-weight:bold;text-align:center;" align="center">OR</div><br><input onChange="valid_csvfileextension(this,'+i+','+j+')" style="width:192px;" type="file" id="ExcelInp'+i+j+'" name="userfile_excel'+i+'[]'+'"></td><td><select class="text2" name="img_sts'+i+'[]'+'" id="img_sts'+i+j+'" style="width:80px;"><option value="active">Active</option><option value="inactive">Inactive</option></select></td><td><input type="date" id="from_dt'+i+j+'" style="width:150px;" name="from_dt'+i+'[]'+'"></td><td><input type="date" id="to_date'+i+j+'" name="to_date'+i+'[]'+'" style="width:150px;" name="to_date"></td><td><textarea style="width:116px; height:80px;" name="img_memo'+i+'[]'+'" id="img_memo'+i+j+'" ></textarea></td><td><i style="color:#FF0000;cursor:pointer;" onClick="remove_imgtblrow('+i+','+j+')" class="fa fa-times" aria-hidden="true"></i></td></tr></table></fieldset></td></tr>');	
}

function remove_imgtblrow(i,j)
{
	var conf=confirm("Do You Want TO Delete Imagae Data ?");
	
	if(conf)
	{	
		$('#columninfo_div #fld_secion_'+i+' #fld_culmn'+i+' #img_tbl'+i+' #tblrow_tbl'+i+j+'').html('');
		$('#columninfo_div #fld_secion_'+i+' #fld_culmn'+i+' #img_tbl'+i+' #tblrow_tbl'+i+j+'').remove('');
		//$('#columninfo_div #fld_secion_'+i+' #fld_culmn'+i+' #img_tbl'+i+' #tblrow_tbl'+i+j+'').fadeOut(400, function(){remove()});
	}
			
}

function remove_culmn(i)
{
	$('#columninfo_div #fld_secion_'+i+' ').html('');
	$('#columninfo_div #fld_secion_'+i+' ').remove();
	//$('#columninfo_div #fld_secion_'+i+' ').fadeOut(400, function(){remove()});
}


</script>

<script>

function valid_csvfileextension(input,i,j)
{ //alert($('#ExcelInp'+i+j+'').val());return false;
	var ext = $('#ExcelInp'+i+j+'').val().split('.').pop().toLowerCase();
	//------check image or not start-----------------//
	if($.inArray(ext, ['csv']) == -1  ) 
	{
		
   	$('#alrt'+i).text('! Invalid CSV File. Please file with extension .csv i.e downloaded from template ');
		$('#alrt'+i).css('display','block');
		 $('html, body').animate({
        'scrollTop' : $('#fld_secion_'+i).position().top
    });	
	
		
		/*$('#removimage'+i+j+'').css('display','none');
		$('#imgprvw'+i+j+'').css('display','none');	*/
		$('#ExcelInp'+i+j+'').val('');
   
	return false;
	}
}

</script>

<script>
function preview_img(input,i,j)
{ 
	var ext = $('#imgInp'+i+j+'').val().split('.').pop().toLowerCase();
	//------check image or not start-----------------//
	if($.inArray(ext, ['png','jpg','jpeg','gif']) == -1) 
	{
		
   	$('#alrt'+i).text('! Invalid Image File. Please Upload Image file with extension .jpg / .jpeg / .png / .gif');
		$('#alrt'+i).css('display','block');
		 $('html, body').animate({
        'scrollTop' : $('#fld_secion_'+i).position().top
    });	
	
		
		$('#removimage'+i+j+'').css('display','none');
		$('#imgprvw'+i+j+'').css('display','none');	
		$('#imgInp'+i+j+'').val('');
   
	return false;
	}
	//------check image or not end-----------------//
	
	$('#removimage'+i+j+'').css('display','block');
	$('#imgprvw'+i+j+'').css('display','block');
 	$('#imgprvw'+i+j+'')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
	
var img = new Image();

 img.onload = function () {
        var width = this.width,
            height = this.height;           

       
		valid_imgdimensiion(width,height,i,j); //call function

    };
	 img.src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
		$('#alrt'+i).css('display','none');
}

function valid_imgdimensiion(width,height,i,j) {
    
	var imgdmns_defnd=$('#slctimage_size').val();	
	var image_dm=width+'x'+height;
	
	if(imgdmns_defnd!=image_dm)
	{	//alert('! Invalid Image. Required Size: '+imgdmns_defnd+' Pixel '  );
		$('#alrt'+i).text('! Invalid Image. Required Size: '+imgdmns_defnd+' Pixel ');
		$('#alrt'+i).css('display','block');
		 $('html, body').animate({
        'scrollTop' : $('#fld_secion_'+i).position().top
    });	
	
		
		$('#removimage'+i+j+'').css('display','none');
		$('#imgprvw'+i+j+'').css('display','none');	
		$('#imgInp'+i+j+'').val('');
		return false;
	}
	

}

function img_remove(i,j)
{
	$('#removimage'+i+j+'').css('display','none');
	$('#imgprvw'+i+j+'').css('display','none');	
	
	$('#imgInp'+i+j+'').val('');
}

</script>




<script>
function populate_sectiondatatype(sec_type)
{
	if(sec_type=='Rich Text Editor')
	{
		$("#sectiondata_type").html('');
		$('#sectiondata_type').append($("<option></option>").attr("value","Banner").text("Banner"));
		
		$("#section_status").html('');
		$('#section_status').append($("<option></option>").attr("value","").text("--select--"));
		$('#section_status').append($("<option></option>").attr("value","active").text("Active"));
		$('#section_status').append($("<option></option>").attr("value","inactive").text("Inactive"));
		
		$("#col_num").html('');
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
		
		$('#add_sectioncolumninfo').css('display','block');
		$('#lbl_slctimage_size').css('display','none');
		
		$('#div_screenshot').html('');
		$('#div_screenshot').css('display','block');
		
		$('#div_screenshot').append($("<img></img>").attr("src","<?php echo base_url() ?>/images/admin/mobile/mobile_catlog/Rich_texteditor.png"));
		$('#screeshotprocess_div').css('display','none');
		return false;
	}
	else
	{
			$('#div_imgsize').css('display','none');
			$('#div_screenshot').css('display','none');
			
			$("#section_lbltxtbox").html('');
			
			$("#sectiondata_type").html('');
			$('#sectiondata_type').append($("<option></option>").attr("value","").text("--select--"));
			
			$("#section_status").html('');
			$('#section_status').append($("<option></option>").attr("value","").text("--select--"));
			$('#section_status').append($("<option></option>").attr("value","active").text("Active"));
			$('#section_status').append($("<option></option>").attr("value","inactive").text("Inactive"));
			
			$("#col_num").html('');
			$('#col_num').append($("<option></option>").attr("value","").text("--select--"));
			
			$("#slctimage_size").html('');
			//$('#slctimage_size').append($("<option></option>").attr("value","").text("--select--"));
			
			$("#sec_memo").html('');
			
			if(sec_type=='Banner' || sec_type=='Slider' || sec_type=='Video' || sec_type=='Grouped Banner' || sec_type=='Featured Box')
			{
				$("#sectiondata_type option[value='Product']").remove();
				$("#sectiondata_type option[text='Product']").remove();
				
				$("#sectiondata_type option[value='Banner']").remove();
				$("#sectiondata_type option[text='Banner']").remove();
				
				$('#sectiondata_type').append($("<option></option>").attr("value","Banner").text("Banner"));
			}
			else if(sec_type=='Carousel')
			{
				$("#sectiondata_type option[value='Product']").remove();
				$("#sectiondata_type option[text='Product']").remove();
				
				$("#sectiondata_type option[value='Banner']").remove();
				$("#sectiondata_type option[text='Banner']").remove();
						
				$('#sectiondata_type').append($("<option></option>").attr("value","Banner").text("Banner"));
				
			}
			else if(sec_type=='Product' || sec_type=='Prodcts Vertical section' )
			{		
				$("#sectiondata_type option[value='Product']").remove();
				$("#sectiondata_type option[text='Product']").remove();			
				
				$("#sectiondata_type option[value='Banner']").remove();
				$("#sectiondata_type option[text='Banner']").remove();
				
				$('#sectiondata_type').append($("<option></option>").attr("value","Product").text("Product"));
				
			}
			
	}
}
function select_nofcolumn()
{
	if($('#section_type').val()=='Banner' && $('#sectiondata_type').val()=='Banner')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
		$('#col_num').append($("<option></option>").attr("value","2").text("2"));
	}
	
	if($('#section_type').val()=='Slider' && $('#sectiondata_type').val()=='Banner')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
				
	}
	
	if($('#section_type').val()=='Carousel' && $('#sectiondata_type').val()=='Banner')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
				
	}
	
	if($('#section_type').val()=='Video' && $('#sectiondata_type').val()=='Banner')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));				
	}
	
	if($('#section_type').val()=='Product' && $('#sectiondata_type').val()=='Product')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
				
	}
	
	if($('#section_type').val()=='Grouped Banner' && $('#sectiondata_type').val()=='Banner')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
				
	}
	
	if($('#section_type').val()=='Featured Box' && $('#sectiondata_type').val()=='Banner')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
				
	}
	
	if($('#section_type').val()=='Product Catalog' && $('#sectiondata_type').val()=='Product')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
				
	}
	
	if($('#section_type').val()=='Prodcts Vertical section' && $('#sectiondata_type').val()=='Product')
	{
		$("#col_num option[value='1']").remove();
		$("#col_num option[text='1']").remove();
		$("#col_num option[value='2']").remove();
		$("#col_num option[text='2']").remove();
		$("#col_num option[value='3']").remove();
		$("#col_num option[text='3']").remove();
		
		$('#col_num').append($("<option></option>").attr("value","1").text("1"));
	}	
}

function populate_screenshot(img_size)
{
	var sec_type=$('#section_type').val();
	var col_num=$('#col_num').val();
	var sec_datatype=$('#sectiondata_type').val();
	
	$("#div_screenshot").html('');
	$('#screeshotprocess_div').css('display','block');
	
	$.ajax({
		method:"POST",
		url:"<?php echo base_url(); ?>admin/Page_single_product/select_screeshot",
		data:{sec_type:sec_type,img_size:img_size,col_num:col_num},
		success:function(data){	
		
			$("#div_screenshot").html(data);							
			$('#div_screenshot').css('display','block');
			$('#screeshotprocess_div').css('display','none');
			
		}
	});
}
</script>
<script>
function select_imagesize()
{
	var clmn_count=$('#col_num').val();
	
	if(clmn_count=='')
	{		
		alert('Please Select Valid Number Of Columns');	
	}
	else
	{
		$('#process_div').css('display','block');
		$('#div_imgsize').css('display','none');
		$('#imgsize_tdid').css('display','none');
		$('#add_sectioncolumninfo').css('display','none');
		$('#columninfo_div').html('');
		var sec_type=$('#section_type').val();
		
		$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>admin/Page_single_product/select_imagesize",
			data:{sec_type:sec_type,clmn_count:clmn_count},
			success:function(data){			
				
				$("#div_imgsize").html(data);
				//$('#columninfo_div').html(' ');
				$('#div_imgsize').css('display','block');
				$('#imgsize_tdid').css('display','block');
				$('#add_sectioncolumninfo').css('display','block');
				$('#process_div').css('display','none');
				
				
			}
		});
	}
}
</script>


<script>
// Get all elements with class="closebtn"
var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
    // When someone clicks on a close button
    close[i].onclick = function(){

        // Get the parent of <span class="closebtn"> (<div class="alert">)
        var div = this.parentElement;

        // Set the opacity of div to 0 (transparent)
        div.style.opacity = "0";

        // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>

<script>
function valid_columndata()
{
	if($('#section_type').val()!='Video' && $('#section_type').val()!='Product' && $('#section_type').val()!='Prodcts Vertical section' && $('#section_type').val()!='Rich Text Editor')
	{
			var tot_column=$('#col_num').val();
			var count=0;
			
			var ctr_dispurl=0;
			
			for(var i=1; i<=tot_column; i++)
			{  		var imgfilebtn_ids = document.getElementsByName("userfile"+i+"[]");
						var imgbtn_count=imgfilebtn_ids.length;	
						
						for (var j=1; j<=imgbtn_count; j++) {
							if ($('#imgInp'+i+j+'').val() == '' ) 
							{
								count++;
							}
							
							if($('#img_skuorurl'+i+j+'').val() == 'sku' &&  $('#dispaly_url'+i+j+'').val() == '')
							{
								ctr_dispurl++;	
							}
						}
						
						
					var 	imglinktxtarea_ids = document.getElementsByName("imglinkkskuorurl"+i+"[]");				
					var 	imglinkexcel_ids = document.getElementsByName("userfile_excel"+i+"[]");
					var     imglinkcount=0;
					
					for (var j=1; j<=imgbtn_count; j++)
					{
					  if ($('#ExcelInp'+i+j+'').val() != ''  && $('#imglinkkskuorurl'+i+j+'').val() != '') 
					  {
						 imglinkcount++;
					  }
					}
			}
						
			if(count>0)
			{
				alert('Please Upload Image In All Image Section');
				return false;
			}
			
			if(imglinkcount>0)
			{
				alert('Please Use Textarea Or Upload Excel File For SKU Link, Not Both ');
				return false;
			}
			
			if(ctr_dispurl>0)
			{
				alert('Please Enter Display URL Where Link Type is SKU');
				return false;
			}
			
			
	}
}

function add_imagefor_editpage(i)
{ 
	var imgfilebtn_ids = document.getElementsByName("userfile"+i+"[]");
	var imgbtn_count=imgfilebtn_ids.length;			
			
	
	var j_edit=parseInt(imgbtn_count)+1;	
	$('#columninfo_div #fld_secion_'+i+' #fld_culmn'+i+' #img_tbl'+i+' ').append('<tr id="tblrow_tbl'+i+j_edit+'"><td><input type="hidden" name="imgsqlid_hidhdn'+i+'[]" id="imgsqlid_hidhdn'+i+j_edit+'" ><input type="hidden" name="oldimagename_hidhdn'+i+'[]" id="oldimagename_hidhdn'+i+j_edit+'" ><input style="width:192px;" type="file" id="imgInp'+i+j_edit+'" name="userfile'+i+'[]'+'"  onChange="preview_img(this,'+i+','+j_edit+')" ><img id="imgprvw'+i+j_edit+'" src="#" alt="your image" style="width:95px;height:80px;display:none;" /></br><span id="removimage'+i+j_edit+'" style="color:red;display:none;cursor:pointer;" onClick="img_remove('+i+','+j_edit+')">Remove Image</span><fieldset id="imgelbl'+i+j_edit+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Image Label</legend><span class="textarea_val'+i+j_edit+'" style="width:20%; float:right; margin-top: -52px;    padding: 16px; display: inline-block;"></span><textarea name="imglab_txtara'+i+'[]'+'" id="imglab_txtara'+i+j_edit+'" class="imglab_txtara'+i+j_edit+'" onKeyUp="onkeuup('+i+j_edit+')" maxlength="8" style="width:127px;" placeholder="Enter Image Label"></textarea></fieldset></td><td><select onChange="display_urlvisible('+i+','+j_edit+')" style="width:80px;" class="text2" name="img_skuorurl'+i+'[]'+'" id="img_skuorurl'+i+j_edit+'" style="width:80px; height:40px;"><option value="sku">SKU</option><option value="url">URL</option><option value="nolink">No Link</option></select></br></br><fieldset id="displayurlfldset'+i+j_edit+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Display URL</legend><textarea name="dispaly_url'+i+'[]'+'" id="dispaly_url'+i+j_edit+'"  style="width:127px;" placeholder="Enter Display URL"></textarea></fieldset></br><fieldset id="sortbyinfo'+i+j_edit+'"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Sort By</legend><select style="width:150px; height:40px;" class="text2" name="sku_sortby'+i+'[]'+'" id="sku_sortby'+i+j_edit+'"><option value="as_per_sku">As Per sku</option><option value="random">Random</option><option value="prc_asc">Price High To Low</option><option value="pric_dec">Price Low To High</option></select></fieldset></td><td><textarea style="width:192px; height:80px" id="imglinkkskuorurl'+i+j_edit+'" name="imglinkkskuorurl'+i+'[]'+'" style="width:116px; height:80px;"></textarea><br><div style="font-weight:bold;text-align:center;" align="center">OR</div><br><input onChange="valid_csvfileextension(this,'+i+','+j_edit+')" style="width:192px;" type="file" id="ExcelInp'+i+j_edit+'" name="userfile_excel'+i+'[]'+'"><input type="hidden" name="csvfile_hidhdn'+i+'[]'+'" id="csvfile_hidhdn'+i+j_edit+'" ></td><td><select class="text2" name="img_sts'+i+'[]" id="img_sts'+i+j_edit+'" style="width:80px;"><option value="active">Active</option><option value="inactive">Inactive</option></select></td><td><input type="hidden" name="fromdt_hidhdn'+i+'[]" id="fromdt_hidhdn'+i+j_edit+'"><input type="date" id="from_dt'+i+j_edit+'" style="width:150px;" name="from_dt'+i+'[]'+'"></td><td><input type="hidden" name="todt_hidhdn'+i+'[]" id="todt_hidhdn'+i+j_edit+'" ><input type="date" id="to_date'+i+j_edit+'" name="to_date'+i+'[]'+'" style="width:150px;" name="to_date"></td><td><textarea style="width:116px; height:80px;" name="img_memo'+i+'[]" id="img_memo'+i+j_edit+'" ></textarea></td><td><i style="color:#FF0000;cursor:pointer;" onClick="remove_imgtblrow('+i+','+j_edit+')" class="fa fa-times" aria-hidden="true"></i></td></tr></table></fieldset></td></tr>');
	
}
</script>

<script>
function display_urlvisible(i,j)
{
	if($('#img_skuorurl'+i+j+'').val()=='sku')
	{
		$('#displayurlfldset'+i+j+'').css('display','block');
		$('#sortbyinfo'+i+j+'').css('display','block');
		
		$('#ExcelInp'+i+j+'').css('display','block');
		$('#orExcelInp'+i+j+'').css('display','block');
	}
	else
	{
		$('#displayurlfldset'+i+j+'').css('display','none');
		$('#sortbyinfo'+i+j+'').css('display','none');
		
		$('#ExcelInp'+i+j+'').css('display','none');
		$('#orExcelInp'+i+j+'').css('display','none');
	}	
}
</script>
<script>
	function onkeuup(valuid){
	var text_max = 8;
	var text_length = $('.imglab_txtara'+valuid).val().length;
	//alert (text_length);
	var text_remaining = text_max - text_length;
	 $('.textarea_val'+valuid).html('8/'+text_remaining);
	}
</script>