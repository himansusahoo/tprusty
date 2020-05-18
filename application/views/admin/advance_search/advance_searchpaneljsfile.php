<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker8').datetimepicker();
        $('#datetimepicker9').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker8").on("dp.change", function (e) {
            $('#datetimepicker9').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker9").on("dp.change", function (e) {
            $('#datetimepicker8').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker10').datetimepicker();
        $('#datetimepicker11').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker10").on("dp.change", function (e) {
            $('#datetimepicker11').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker11").on("dp.change", function (e) {
            $('#datetimepicker10').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<script>

function disp_catgattrb(displayoption)
{
	if(displayoption=='seller_op')
	{
		
		
		$('#slrsreach_name').css('display','block');
		$('#retirve_catg').css('display','block');
			
		$('#category_div').css('display','none');
		$('#attrbpopulate_div').css('display','none');
		
	}
	else if(displayoption=='category_op')
	{
		$('#category_div').css('display','none');
		$('#attrbpopulate_div').css('display','none');	
		
		$('#slrsreach_name').css('display','none');	
		$('#slrsreach_name').val('');
		$('#retirve_catg').css('display','none');
		
	$('#process_div_catg').css('display','block');
		
		var catg='';

		$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/select_allcategory",
					data:{catg:catg},
					success:function(data){			
						
						$("#category_div").html(data);
						$('#category_div').css('display','block');
						$('#process_div_catg').css('display','none');
						
						
					}
				});
	}
		
}


function populate_attribiuteas_catg(catgid)
{
	$('#attrbpopulate_div').css('display','none');
	$('#process_div_attarb').css('display','block');
	
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/selectattrb_as_category",
					data:{catgid:catgid},
					success:function(data){			
						
						$("#attrbpopulate_div").html(data);
						$('#attrbpopulate_div').css('display','block');
						$('#process_div_attarb').css('display','none');
						
						
					}
				});	

}
</script>


<script>
$(document).ready(function(){
	
	$("#slrsreach_name").keyup(function(){
		
		var slr_nam=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/catalog/autofill_seller' ?>',
			method:'post',
			data:{slr_nam:slr_nam},
			success:function(data)
			{
				if(slr_nam){
					$("#slr_nm_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#slr_nm_dv ul").html("");
					//HideLoder1();
					$('#slr_nm_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})


function getslrname(val){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#slrsreach_name').val(res);
	$('#slrsreach_name').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>
 <script>
 $(document).ready(function(){
$(document).keyup(function(event){
        if(event.which === 27){
            $('#slr_nm_dv').css('display','none');
			
        }
    });
	
	
	
});

</script>


<!--- Zebra_Datepicker link end here ---->

<script>

function populetslr_catgattrb()
{  
    var slr_name=$('#slrsreach_name').val();
	
	$('#category_div').css('display','none');
	
	//$('#retirve_catg').css('display','none');
	
  if(slr_name!=''){
	  
	$('#process_div_catg').css('display','block');
	
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/selectcategory_as_seller",
					data:{slr_name:slr_name},
					success:function(data){			
						
						$("#category_div").html(data);
						$('#category_div').css('display','block');
						$('#process_div_catg').css('display','none');
						
						
					}
				});	
  }
  else
  {alert('Enter Seller Name');}
		
		
}

function populate_attribute(catgid)
{
	var slr_name=$('#slrsreach_name').val();
	
	$('#attrbpopulate_div').css('display','none');
	$('#process_div_attarb').css('display','block');
	
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/selectattrb_as_seller",
					data:{slr_name:slr_name,catgid:catgid},
					success:function(data){			
						
						$("#attrbpopulate_div").html(data);
						$('#attrbpopulate_div').css('display','block');
						$('#process_div_attarb').css('display','none');
						
						
					}
				});	
}

</script>

<script>
function select_subattrb(attrbgroup_id)
{
	// var subcatgid=$('#catgnm').val();
		
	
	var attrb_id=attrbgroup_id;	
	
	
	$('#loader_div').css('display','block');
	$('#filter_slabdiv').css('display','none');
	$("#show_error").hide();
	//$("#show_errorattrb").hide();
	var subcategory_id=$('#catgnm').val();
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Super_admin/showall_attributeforadvancesearch",
					data:{attrbgroup_id:attrbgroup_id,subcategory_id:subcategory_id},
					success:function(data){			
						
						$("#filter_slabdiv").html(data);
						$('#filter_slabdiv').css('display','block');
						
						$('#loader_div').css('display','none');
						
						
					}
				});	
}

function select_allsubattrb(attrbgroup_id)
{
	var attrb_id=attrbgroup_id;	
	
	
	$('#loader_div').css('display','block');
	$('#filter_slabdiv').css('display','none');
	$("#show_error").hide();
	//$("#show_errorattrb").hide();
	var subcategory_id=$('#allcatg_name').val();
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Super_admin/show_allattributefieldname",
					data:{attrbgroup_id:attrbgroup_id,subcategory_id:subcategory_id},
					success:function(data){			
						
						$("#filter_slabdiv").html(data);
						$('#filter_slabdiv').css('display','block');
						
						$('#loader_div').css('display','none');
						
						
					}
				});		
	
}


</script>

<script>

function attrubute_valuepopulate(attrb_id,tdid,attrb_headingname)
{
	
	if(document.getElementById('attrbfld_chkbox'+tdid).checked== true)	
	{return false;}
	else
	{
		$('#attrbfld_chkbox'+tdid).attr('checked', true);
	
		var subcategory_id=$('#catgnm').val();
		var slr_name=$('#slrsreach_name').val();
		
		
		
		$('#process_div_attarbactualvalue'+tdid).css('display','block');
		
		$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/advance_search/show_attributeactualvalue",
						data:{subcategory_id:subcategory_id,attrb_id:attrb_id,attrb_headingname:attrb_headingname,slr_name:slr_name,tdid:tdid},
						success:function(data){			
							
							$("#attribute_valuedivid"+tdid).html(data);
							$('#attribute_valuedivid'+tdid).css('display','block');
							
							$('#process_div_attarbactualvalue'+tdid).css('display','none');
							
							
						}
					});	
	}
				
	
		
}


function allattrubute_valuepopulate(attrb_id,tdid,attrb_headingname)
{
	
	
	
	if(document.getElementById('attrbfld_chkbox'+tdid).checked== true)	
	{return false;}
	else
	{
			$('#attrbfld_chkbox'+tdid).attr('checked', true);
			var subcategory_id=$('#allcatg_name').val();
			var slr_name='';	
			
			$('#process_div_attarbactualvalue'+tdid).css('display','block');
			
			$.ajax({
							method:"POST",
							url:"<?php echo base_url(); ?>admin/advance_search/show_attributeactualvalue",
							data:{subcategory_id:subcategory_id,attrb_id:attrb_id,attrb_headingname:attrb_headingname,slr_name:slr_name,tdid:tdid},
							success:function(data){			
								
								$("#attribute_valuedivid"+tdid).html(data);
								$('#attribute_valuedivid'+tdid).css('display','block');
								
								$('#process_div_attarbactualvalue'+tdid).css('display','none');
								
								
							}
						});
	}
}
</script>

<script>

function checked_attrbactualvaluecheckbox(attrb_sqlid,attrfieldtd_id)
{
		if(document.getElementById('attbactval'+attrb_sqlid).checked== true)
		{
			
			document.getElementById('attbactval_hdn'+attrb_sqlid).checked= 'checked';
			document.getElementById('attbheadingname_hdn'+attrb_sqlid).checked= 'checked';
			document.getElementById('attbidwithheadingname_hdn'+attrb_sqlid).checked= 'checked';
			
			
		}
		else if(document.getElementById('attbactval'+attrb_sqlid).checked== false)
		{
			
			
			document.getElementById('attbactval_hdn'+attrb_sqlid).checked= '';
			document.getElementById('attbheadingname_hdn'+attrb_sqlid).checked= '';
			document.getElementById('attbidwithheadingname_hdn'+attrb_sqlid).checked= '';
		}
		
		
		
		var attrb_value = document.getElementsByName("attbactval[]");
		var attrbvalue_count=attrb_value.length;
					
		var count=0;
		for (var i=0; i<attrbvalue_count; i++) {
			if (attrb_value[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count>0)
		{document.getElementById('attrbfldselected_chkbox'+attrfieldtd_id).checked= 'checked';}	
		else
		{document.getElementById('attrbfldselected_chkbox'+attrfieldtd_id).checked= '';}
}

</script>

<script>

function valid_allselectbox()
{
	
	/*var hdnslr_nam=$('#slr_nmsrchfinlhidn').val();
	var hdncatg_name=$('#catg_nmsrchfnlhdn').val();
	var hdnprod_addmodf=$('#prodadmodfdate_srchfnl').val();
	var hdnprodnmsku_srchfnl=$('#prodnmsku_srchfnl').val();	
	var hdnpricedsi_srchfnl=$('#pricedsi_srchfnl').val();	
	var hdnslrbuyerrating_srchfnl=$('#slrbuyerrating_srchfnl').val();
	
	
	if(hdnslr_nam!='')
	{alert('data is');}
	else
	{alert('no data');}
	return false;*/
	
	
					
}
</script>

<script>

function slr_nmsrchfinlreset()
{
	
	$("#slr_nmsrchfinl option").remove();
	$("#slr_nmsrchfinlhidn option").remove();
	
	$('#slr_nmsrchfinl_chosen .chosen-choices .search-choice').remove();
		
	$('#slr_nmsrchfinl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
	
	
		
}


function catg_nmsrchfnl_resetbtnreset()
{
	$("#catg_nmsrchfnl option").remove();
	$("#catg_nmsrchfnlhdn option").remove();
	
	$('#catg_nmsrchfnl_chosen .chosen-choices .search-choice').remove();
		
	$('#catg_nmsrchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
		
}

function attrbsrchfnl_reset()
{
	
	$("#attrb_srchfnl option").remove();
	
	$("#hdnattrb_groupids option").remove();
	$("#hdnattrb_ids option").remove();
	$("#hdnattrb_values option").remove();
	
	
	$('#attrb_srchfnl_chosen .chosen-choices .search-choice').remove();
		
	$('#attrb_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
		
}

function prodadmodfdate_srchfnlreset()
{
	$("#prodadmodfdate_srchfnl option").remove();
	$("#hdndate_filtertype option").remove();
	$("#hdndate_fromfilter option").remove();
	$("#hdndate_tofilter option").remove();
	
	$('#prodadmodfdate_srchfnl_chosen .chosen-choices .search-choice').remove();
		
	$('#prodadmodfdate_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));	
}

function prodadmodfdate_srchfnlreset()
{
	$("#prodadmodfdate_srchfnl option").remove();
	$("#hdndate_filtertype option").remove();
	$("#hdndate_fromfilter option").remove();
	$("#hdndate_tofilter option").remove();
	
	$('#prodadmodfdate_srchfnl_chosen .chosen-choices .search-choice').remove();
		
	$('#prodadmodfdate_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));	
}

function prodnmsku_srchfnlreset()
{ 
	$("#prodnmsku_srchfnl option").remove();
	$("#hdnprodnmsku_tyefilter option").remove();
	$("#hdnprodnmsku_datafilter option").remove();
	
	
	$('#prodnmsku_srchfnl_chosen .chosen-choices .search-choice').remove();
		
	$('#prodnmsku_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));		
}


function pricedsi_srchfnl_reset()
{
	$("#pricedsi_srchfnl option").remove();
	$("#hdnpricedsi_type option").remove();
	$("#hdnpricedsi_from option").remove();
	$("#hdnpricedsi_to option").remove();
	
	$('#pricedsi_srchfnl_chosen .chosen-choices .search-choice').remove();	
	
	$('#pricedsi_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));		
}


function slrbuyerrating_srchfnlreset()
{
	$("#slrbuyerrating_srchfnl option").remove();
	$("#hdnslrbuyerrating_type option").remove();
	$("#hdnslrbuyerrating_from option").remove();
	$("#hdnslrbuyerrating_to option").remove();
	
	$('#slrbuyerrating_srchfnl_chosen .chosen-choices .search-choice').remove();	
	
	$('#slrbuyerrating_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
	
		
}

</script>





