<script>
function addtolist_slrorcatgwithattrb()
{
	
	var selecttype_slrorcatg=$('#slr_ctagattrb').val();
	
	if(selecttype_slrorcatg=='seller_op')
	{
		var slrsreach_name=$('#slrsreach_name').val();
						
		var attrb_value = document.getElementsByName("attbactval[]");
		var attrbvalue_count=attrb_value.length;
					
		var count=0;
		for (var i=0; i<attrbvalue_count; i++) {
			if (attrb_value[i].checked === true) 
			{
				count++;
			}
		}
					
		if(count==0)
		{				
						
						
						if(slrsreach_name!='' && !$('#catgnm').length && !$('#attrb_name').length && !$('.attbactval').length)
						{
								if ($('#slr_nmsrchfinl option:contains('+ slrsreach_name +')').length) {
									
									//alert('Data Already Added in the List');
									$('#addedtolistmsg').css('display','block');
									$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');
									
								}
								else{
								
								$('#slr_nmsrchfinl_chosen .chosen-choices .search-field .default').val('');	
								$('#slr_nmsrchfinl_chosen .chosen-choices .search-field').remove();
							
								 $('#slr_nmsrchfinl').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
								 
								 $('#slr_nmsrchfinlhidn').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
								 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 				 
								 
								 //$('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span><a class='search-choice-close' data-option-array-index='0'></a></li>")); 
								 
								 //$('#slr_nmsrchfinl_chosen .chosen-drop .chosen-results').append($("<li class='result-selected' style='' data-option-array-index='0'>"+slrsreach_name+"</li>")); 
								 
							
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');
								}
								return false;
								
						}
						
						if(slrsreach_name!='' && $('#catgnm').val()!='' && $('#attrb_name').val()=='' )
						{
								//var catg_id= $('#catgnm').val();
								var catg_name=$('#catgnm option:selected').html();
								var catg_id=$('#catgnm').val();
								
								
									if (!$('#slr_nmsrchfinl option:contains('+ slrsreach_name +')').length) {
										
									
									
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field .default').val('');	
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field').remove();
									
										 $('#slr_nmsrchfinl').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinlhidn').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 	
										 
								  }
								  
								  if ($('#catg_nmsrchfnl option:contains('+ catg_name +')').length) {
										
										//alert('Data Already Added in the List');
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');
										
										
									}else{
								
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
									
										 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
										 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
										 
										 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
										 
										
									
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');	
									}
									
									return false;
								
						}
						
						
						
						if(slrsreach_name!='' && $('#catgnm').val()!='' && $('#attrb_name').val()!='' )
						{
								
								var catg_name=$('#catgnm option:selected').html();
								var attrb_name=$('#attrb_name option:selected').html();
								var attrb_grpid=$('#attrb_name').val();
								
								var catg_id=$('#catgnm').val();
								
									if (!$('#slr_nmsrchfinl option:contains('+ slrsreach_name +')').length) {			
									
									
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field .default').val('');	
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field').remove();
									
										 $('#slr_nmsrchfinl').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinlhidn').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 	
										 
								  }
								  
								  if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
								  {					
								
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
									
										 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
										 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
										 
										 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
										 
										
									
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');	
									}
									
									
									
									 if ($('#attrb_srchfnl option:contains('+ attrb_name +')').length) {
										
										//alert('Data Already Added in the List');
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');
										
										
									}else{
								
										$('#attrb_srchfnl_chosen .chosen-choices .search-field .default').val('');	
										$('#attrb_srchfnl_chosen .chosen-choices .search-field').remove();
									
										 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_name).text(attrb_name));
										 
										 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
										 
										 
										 
										 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
										 
										
									
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');	
									}
								
						}
						return false;
						
		} //if atribute not selected condition end
		else
		{
			
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
				
				var catg_name=$('#catgnm option:selected').html();
				var attrb_name=$('#attrb_name option:selected').html();
				var attrb_grpid=$('#attrb_name').val();
				
				var catg_id=$('#catgnm').val();
				
				var attrbfield_value = document.getElementsByName("attrbfldselected_chkbox[]");
				var attrbfieldvalue_count=attrbfield_value.length;
				var textvalue="";	
				var count=0;
				for (var i=0; i<attrbfieldvalue_count; i++)
				{
					if (attrbfield_value[i].checked === true) 
					{
						//textvalue= attrbfield_value[i].val();
						//var imgs = $('input[type="checkbox"][name="attrbfld_chkbox[]"]').map(function() { return this.value; }).get();
						//alert(imgs);
						count++;
					}
				}
				
				
				if(count>0)
				{	var attrb_fiedlname = $('input[type="checkbox"][name="attrbfldselected_chkbox[]"]:checked').map(function() { return this.value; }).get();
				
					var attrb_actualvalue = $('input[type="checkbox"][name="attbactval[]"]:checked').map(function() { return this.value; }).get();
					
					var attrb_headingname = $('input[type="checkbox"][name="attbheadingname_hdn[]"]:checked').map(function() { return this.value; }).get();
					
					var attrbactual_id=$('input[type="checkbox"][name="attbactval_hdn[]"]:checked').map(function() { return this.value; }).get();
					
					var attrb_headingnamewithattrbid = $('input[type="checkbox"][name="attbidwithheadingname_hdn[]"]:checked').map(function() { return this.value; }).get();
					
					var all_attrbfldconcate="";
					
					$.each( attrb_fiedlname, function( key, value ) {
					 // alert( key + ": " + value );
					 	
						var attrb_actualfnlvalue="";
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{attrb_actualfnlvalue = attrb_actualfnlvalue +'<span style="border:.5px solid; border-radius:5px;">'+ attrbvalue +'</span>       ';}
									
							});
						
						});
						
						
						all_attrbfldconcate = all_attrbfldconcate + '<span style="background-color:#9CF;font-weight:bold; ">'+  value   + ': '+'</span>'
						+ '<span style="color:#90F; ">'+ attrb_actualfnlvalue + '</span>'+'<br><br>';
						
						
					});
					
					
					attrb_name='<span style="font-weight:bold;font-size:17px;">'+attrb_name+'</span>' + ':<br><hr>' + all_attrbfldconcate ;
					
				    
			//--------------------------------- attribute id  entry in hidden filed start------------------------------------//
					
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrbactual_id, function( key1, attrbid ) {
					
					 		$.each( attrb_headingnamewithattrbid, function( key2, attrbidheadinnm ) {
									
									if(attrbidheadinnm.includes(value) && attrbidheadinnm.includes(attrbid))
									{
										$('#hdnattrb_ids').append($("<option selected='selected'></option>").attr("value",attrbid).text(attrbid));
									}
									
							});
						
						});										
						
					});								 	
					
			//--------------------------------- attribute id entry in hidden filed end------------------------------------//
			
			
			//--------------------------------- attribute id  entry value hidden filed start------------------------------------//
					
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{
										$('#hdnattrb_values').append($("<option selected='selected'></option>").attr("value",attrbvalue).text(attrbvalue));
									}
									
							});
						
						});										
						
					});								 	
					
			//--------------------------------- attribute value entry in hidden filed end------------------------------------//
						
								
								
								
									if (!$('#slr_nmsrchfinl option:contains('+ slrsreach_name +')').length) {			
									
									
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field .default').val('');	
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field').remove();
									
										 $('#slr_nmsrchfinl').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinlhidn').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 	
										 
								  }
								  
								  if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
								  {					
								
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
									
										 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
										 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
										 
										 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
										 
										
									
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');	
									}
									
									
									
									 if ($('#attrb_srchfnl option:contains('+ attrb_name +')').length) {
										
										//alert('Data Already Added in the List');
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');
										
										
									}else{
								
										$('#attrb_srchfnl_chosen .chosen-choices .search-field .default').val('');	
										$('#attrb_srchfnl_chosen .chosen-choices .search-field').remove();
									
										 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_name).text(attrb_name));
										 
										 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
										 
										 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
										 
										
									
										$('#addedtolistmsg').css('display','block');			
										$('html, body').animate({
											scrollTop: $(document).height()
												 }, 'slow');	
									}
								
						
		
		
				} // if count greater than zero condition end
		
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//	
			
			
				
		
		}  //if atribute selected condition end
						
							
	} // if select type is seller condition is true
	
	//---------------------------------------- Selection Type is Category start------------------------------------------------//
	else
	{ 		
			//*************************************************************************************
		var attrb_value = document.getElementsByName("attbactval[]");
		var attrbvalue_count=attrb_value.length;
					
		var count=0;
		for (var i=0; i<attrbvalue_count; i++) {
			if (attrb_value[i].checked === true) 
			{
				count++;
			}
		}
					
		if(count==0)
		{
			
			//*************************************************************************************
		
		
				if($('#allcatg_name').val()!='' && $('#allattrb_name').val()=='' )
				{
						//var catg_id= $('#catgnm').val();
						var catg_name=$('#allcatg_name option:selected').html();		
						var catg_id=$('#allcatg_name').val();
							
						  
						  if ($('#catg_nmsrchfnl option:contains('+ catg_name +')').length) {
								
								//alert('Data Already Added in the List');
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');
								
								
							}else{
						
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
							
								 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
								 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
								 
								 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
								 
								
							
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');	
							}
							
							return false;
						
				}
				
				
				
				if( $('#allcatg_name').val()!='' && $('#allattrb_name').val()!='' )
				{
						
						var catg_name=$('#allcatg_name option:selected').html();
						var attrb_name=$('#allattrb_name option:selected').html();
						var attrb_grpid=$('#allattrb_name').val();
						
						var catg_id=$('#allcatg_name').val();
						
							
						  
						  if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
						  {					
						
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
							
								 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
								 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
								 
								 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
								 
								
							
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');	
							}
							
							
							
							 if ($('#attrb_srchfnl option:contains('+ attrb_name +')').length) {
								
								//alert('Data Already Added in the List');
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');
								
								
							}else{
						
								$('#attrb_srchfnl_chosen .chosen-choices .search-field .default').val('');	
								$('#attrb_srchfnl_chosen .chosen-choices .search-field').remove();
							
								 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_name).text(attrb_name));		 
								 
								 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
								 
								 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
								 
								
							
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');	
							}
						
						}
						return false;
		
		} // if count is zero condition true end
		else
		{
		  //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//	
				
				var catg_name=$('#allcatg_name option:selected').html();
				var attrb_name=$('#allattrb_name option:selected').html();
				var attrb_grpid=$('#allattrb_name').val();
				
				var catg_id=$('#allcatg_name').val();			
				
				
				var attrbfield_value = document.getElementsByName("attrbfldselected_chkbox[]");
				var attrbfieldvalue_count=attrbfield_value.length;
				var textvalue="";	
				var count=0;
				for (var i=0; i<attrbfieldvalue_count; i++)
				{
					if (attrbfield_value[i].checked === true) 
					{
						//textvalue= attrbfield_value[i].val();
						//var imgs = $('input[type="checkbox"][name="attrbfld_chkbox[]"]').map(function() { return this.value; }).get();
						//alert(imgs);
						count++;
					}
				}
				
				
				if(count>0)
				{	var attrb_fiedlname = $('input[type="checkbox"][name="attrbfldselected_chkbox[]"]:checked').map(function() { return this.value; }).get();
				
					var attrb_actualvalue = $('input[type="checkbox"][name="attbactval[]"]:checked').map(function() { return this.value; }).get();
					
					var attrb_headingname = $('input[type="checkbox"][name="attbheadingname_hdn[]"]:checked').map(function() { return this.value; }).get();
					
					var attrbactual_id=$('input[type="checkbox"][name="attbactval_hdn[]"]:checked').map(function() { return this.value; }).get();
					
					var attrb_headingnamewithattrbid = $('input[type="checkbox"][name="attbidwithheadingname_hdn[]"]:checked').map(function() { return this.value; }).get();
					
					
					
					var all_attrbfldconcate="";
					
					$.each( attrb_fiedlname, function( key, value ) {
					 // alert( key + ": " + value );
					 	
						var attrb_actualfnlvalue="";
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{attrb_actualfnlvalue = attrb_actualfnlvalue +'<span style="border:.5px solid; border-radius:5px;">'+ attrbvalue +'</span>       ';}
									
							});
						
						});
						
						
						all_attrbfldconcate = all_attrbfldconcate + '<span style="background-color:#9CF;font-weight:bold; ">'+  value   + ': '+'</span>'
						+ '<span style="color:#90F; ">'+ attrb_actualfnlvalue + '</span>'+'<br><br>';
						
						
					});
					
					
					attrb_name='<span style="font-weight:bold;font-size:17px;">'+attrb_name+'</span>' + ':<br><hr>' + all_attrbfldconcate ;
					
					
					
					//--------------------------------- attribute id  entry in hidden filed start------------------------------------//
					
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrbactual_id, function( key1, attrbid ) {
					
					 		$.each( attrb_headingnamewithattrbid, function( key2, attrbidheadinnm ) {
									
									if(attrbidheadinnm.includes(value) && attrbidheadinnm.includes(attrbid))
									{
										$('#hdnattrb_ids').append($("<option selected='selected'></option>").attr("value",attrbid).text(attrbid));
									}
									
							});
						
						});										
						
					});								 	
					
			//--------------------------------- attribute id entry in hidden filed end------------------------------------//
			
			
			//--------------------------------- attribute id  entry value hidden filed start------------------------------------//
					
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{
										$('#hdnattrb_values').append($("<option selected='selected'></option>").attr("value",attrbvalue).text(attrbvalue));
									}
									
							});
						
						});										
						
					});								 	
					
			//--------------------------------- attribute value entry in hidden filed end------------------------------------//
					
					
					
					
					
					
					if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
						  {					
						
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
							
								 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
								 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
								 
								 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
								 
								
							
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');	
							}
							
							
							
							 if ($('#attrb_srchfnl option:contains('+ attrb_name +')').length) {
								
								//alert('Data Already Added in the List');
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');
								
								
							}else{
						
								$('#attrb_srchfnl_chosen .chosen-choices .search-field .default').val('');	
								$('#attrb_srchfnl_chosen .chosen-choices .search-field').remove();
							
								 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_name).text(attrb_name));
								 
								 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
								 
								 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
								 
								
							
								$('#addedtolistmsg').css('display','block');			
								$('html, body').animate({
									scrollTop: $(document).height()
										 }, 'slow');	
							}
					
					
					return false;
				}
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
				
		}
			
	}
		//---------------------------------------- Selection Type is Category end------------------------------------------------//
		
	
	
	
}


</script>

<script>

function addtolist_prodaddormodfdate()
{ 
	var from_dtm=$('#datepicker-example7-start').val();
	var to_dtm=$('#datepicker-example7-end').val();
	var addormodfdate_type=$('#addormodfdate').val();
	
	
	var prod_dtmstring=addormodfdate_type+": "+from_dtm + " To " + to_dtm;
		
		// filter_slabdiv
		
		
		
		if(from_dtm!='' & to_dtm!='' && addormodfdate_type!='')
		{
				if ($('#prodadmodfdate_srchfnl option:contains('+ prod_dtmstring +')').length) {
					
					alert('Data Already Added in the List');
					$('#addedtolistmsg').css('display','none');
					$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
   					
				}
				else{
				
				$('#prodadmodfdate_srchfnl_chosen .chosen-choices .search-field .default').val('');	
				$('#prodadmodfdate_srchfnl_chosen .chosen-choices .search-field').remove();
			
				 $('#prodadmodfdate_srchfnl').append($("<option selected='selected'></option>").attr("value",prod_dtmstring).text(prod_dtmstring));
				 
				 $('#hdndate_filtertype').append($("<option selected='selected'></option>").attr("value",addormodfdate_type).text(addormodfdate_type));
				 $('#hdndate_fromfilter').append($("<option selected='selected'></option>").attr("value",from_dtm).text(from_dtm));
				 $('#hdndate_tofilter').append($("<option selected='selected'></option>").attr("value",to_dtm).text(to_dtm));
				 
				 
				 
				 $('#prodadmodfdate_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+prod_dtmstring+"</span></li>")); 				 
				 
			
				$('#addedtolistmsg').css('display','block');			
				$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
				}
				return false;
				
		}
		else
		{
			alert('Please Enter Product Add/Modified From & To Date');return false;	
		}
				
}

</script>


<script>
function addtolist_prodnameorsku()
{
	
	 
	var prodnamorsku=$('#prod_nameskutxtbox').val();
	
	var pronameorsku_type=$('#pronameorsku').val();
	
	
	var prod_namskustring=pronameorsku_type+": "+prodnamorsku;
		
		// filter_slabdiv
		
		
		
		if(prodnamorsku!='' && pronameorsku_type!='')
		{
				if ($('#prodadmodfdate_srchfnl option:contains('+ prod_namskustring +')').length) {
					
					alert('Data Already Added in the List');
					$('#addedtolistmsg').css('display','none');
					$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
   					
				}
				else{
				
				$('#prodnmsku_srchfnl_chosen .chosen-choices .search-field .default').val('');	
				$('#prodnmsku_srchfnl_chosen .chosen-choices .search-field').remove();
			
				 $('#prodnmsku_srchfnl').append($("<option selected='selected'></option>").attr("value",prod_namskustring).text(prod_namskustring));
				 
				 
				 $('#hdnprodnmsku_tyefilter').append($("<option selected='selected'></option>").attr("value",pronameorsku_type).text(pronameorsku_type));
				 $('#hdnprodnmsku_datafilter').append($("<option selected='selected'></option>").attr("value",prodnamorsku).text(prodnamorsku));
				 
				 
				 $('#prodnmsku_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+prod_namskustring+"</span></li>")); 				 
				 
			
				$('#addedtolistmsg').css('display','block');			
				$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
				}
				return false;
				
		}
		else
		{
			alert('Please Enter Product Name/SKU');return false;	
		}
				

}




function addtolist_prodpriceordisc()
{
	 
	var from_price=$('#prcordisfrom_txtbox').val();
	var to_price=$('#prcordisto_txtbox').val();
	var priceordisount_type=$('#prodprc_dis').val();
	
	
	var prod_prcdisstring=priceordisount_type+": "+from_price + " To " + to_price;
		
		

		
		if(from_price!='' & to_price!='' && priceordisount_type!='')
		{
				if ($('#pricedsi_srchfnl option:contains('+ prod_prcdisstring +')').length) {
					
					alert('Data Already Added in the List');
					$('#addedtolistmsg').css('display','none');
					$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
   					
				}
				else{
				
				$('#pricedsi_srchfnl_chosen .chosen-choices .search-field .default').val('');	
				$('#pricedsi_srchfnl_chosen .chosen-choices .search-field').remove();
			
				 $('#pricedsi_srchfnl').append($("<option selected='selected'></option>").attr("value",prod_prcdisstring).text(prod_prcdisstring));
				 
				 $('#hdnpricedsi_type').append($("<option selected='selected'></option>").attr("value",priceordisount_type).text(priceordisount_type));
				 $('#hdnpricedsi_from').append($("<option selected='selected'></option>").attr("value",from_price).text(from_price));
				 $('#hdnpricedsi_to').append($("<option selected='selected'></option>").attr("value",to_price).text(to_price));
				 
				 
				 $('#pricedsi_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+prod_prcdisstring+"</span></li>")); 				 
				 
			
				$('#addedtolistmsg').css('display','block');			
				$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
				}
				return false;
				
		}
		else
		{
			alert('Please Enter Product Price/Discount From & To Value ');return false;	
		}
				

		
}


function addtolist_slrorbuyerrating()
{
	
	 
	var from_rating=$('#fromrating_txtbox').val();
	var to_rating=$('#torating_txtbox').val();
	var slrbuyerrating_type=$('#sellerorbuyer_rating').val();
	
	
	var slrbuyerrating_string=slrbuyerrating_type+": "+from_rating + " To " + to_rating;
		
		

		
		if(from_rating!='' & to_rating!='' && slrbuyerrating_type!='')
		{
				if ($('#slrbuyerrating_srchfnl option:contains('+ slrbuyerrating_string +')').length) {
					
					alert('Data Already Added in the List');
					$('#addedtolistmsg').css('display','none');
					$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
   					
				}
				else{
				
				$('#slrbuyerrating_srchfnl_chosen .chosen-choices .search-field .default').val('');	
				$('#slrbuyerrating_srchfnl_chosen .chosen-choices .search-field').remove();
			
			$('#slrbuyerrating_srchfnl').append($("<option selected='selected'></option>").attr("value",slrbuyerrating_string).text(slrbuyerrating_string));
			
			$('#hdnslrbuyerrating_type').append($("<option selected='selected'></option>").attr("value",slrbuyerrating_type).text(slrbuyerrating_type));
			$('#hdnslrbuyerrating_from').append($("<option selected='selected'></option>").attr("value",from_rating).text(from_rating));
			$('#hdnslrbuyerrating_to').append($("<option selected='selected'></option>").attr("value",to_rating).text(to_rating));
			
			
			$('#slrbuyerrating_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrbuyerrating_string+"</span></li>")); 				 
				 
			
				$('#addedtolistmsg').css('display','block');			
				$('html, body').animate({
        			scrollTop: $(document).height()
   						 }, 'slow');
				}
				return false;
				
		}
		else
		{
			alert('Please Enter Seller/Buyer Rating From & To Value ');return false;	
		}
				

		
	
}

</script>


