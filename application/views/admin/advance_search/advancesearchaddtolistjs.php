<script>
function addtolist_slrorcatgwithattrb()
{
	
	var selecttype_slrorcatg=$('#slr_ctagattrb').val();
	
	if(selecttype_slrorcatg=='seller_op')
	{
		var slrsreach_name=$('#slrsreach_name').val();
		
		var slrsreach_name_str=slrsreach_name.replace(/ /g,"_");
		
		slrsreach_name_str=slrsreach_name_str.replace(/,/g,"_");
		slrsreach_name_str=slrsreach_name_str.replace(/&/g,"_");
		slrsreach_name_str=slrsreach_name_str.replace(/\//g,"_");
		slrsreach_name_str=slrsreach_name_str.replace(/\'/g,"_");
		slrsreach_name_str=slrsreach_name_str.replace(/;/g,"_");
		slrsreach_name_str=slrsreach_name_str.replace(/\(/g,"_");
		slrsreach_name_str=slrsreach_name_str.replace(/\)/g,"_");
		
		
						
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
								 //$('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 				 
								 
								 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice' id='"+slrsreach_name_str+"' ><span>"+slrsreach_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeslrname("+'"'+slrsreach_name+'"'+ ","+'"'+slrsreach_name_str+'"'+");' ></a></li>")); 
								 
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
								var catg_name=$.trim($('#catgnm option:selected').html());
								
								var catg_id=$('#catgnm').val();
								
								var catg_name_str=$.trim(catg_name).replace(/ /g,"_");
								catg_name_str=catg_name_str.replace(/,/g,"_");
								catg_name_str=catg_name_str.replace(/&/g,"_");
								catg_name_str=catg_name_str.replace(/\//g,"_");
								catg_name_str=catg_name_str.replace(/\'/g,"_");
								catg_name_str=catg_name_str.replace(/;/g,"_");
								catg_name_str=catg_name_str.replace(/\(/g,"_");
								catg_name_str=catg_name_str.replace(/\)/g,"_");
								
								
									if (!$('#slr_nmsrchfinl option:contains('+ slrsreach_name +')').length) {
										
									
									
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field .default').val('');	
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field').remove();
									
										 $('#slr_nmsrchfinl').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinlhidn').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 //$('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 	
										 
										 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice' id='"+slrsreach_name_str+"' ><span>"+slrsreach_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeslrname("+'"'+slrsreach_name+'"'+ ","+'"'+slrsreach_name_str+'"'+");' ></a></li>")); 
										 
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
										 
										 //$('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
										 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+catg_name_str+"' ><span>"+catg_name+"</span><a class='search-choice-close' data-option-array-index='1' onClick='removecategoryname("+'"'+catg_name_str+'"'+","+'"'+catg_id+'"'+ ");' ></a></li>")); 
										
									
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
								
								var catg_name_str=$.trim(catg_name).replace(/ /g,"_");
								catg_name_str=catg_name_str.replace(/,/g,"_");
								catg_name_str=catg_name_str.replace(/&/g,"_");
								catg_name_str=catg_name_str.replace(/\//g,"_");
								catg_name_str=catg_name_str.replace(/'/g,"_");
								catg_name_str=catg_name_str.replace(/;/g,"_");
								catg_name_str=catg_name_str.replace(/\(/g,"_");
								catg_name_str=catg_name_str.replace(/\)/g,"_");
								
								
								var attrb_name=$('#attrb_name option:selected').html();
								
								
								var attrb_namemodf=$.trim(attrb_name).replace(/ /g,"_");
								attrb_namemodf=attrb_namemodf.replace(/,/g,"_");
								attrb_namemodf=attrb_namemodf.replace(/&/g,"_");
								attrb_namemodf=attrb_namemodf.replace(/\//g,"_");
								attrb_namemodf=attrb_namemodf.replace(/'/g,"_");
								attrb_namemodf=attrb_namemodf.replace(/;/g,"_");
								attrb_namemodf=attrb_namemodf.replace(/\(/g,"_");
								attrb_namemodf=attrb_namemodf.replace(/\)/g,"_");
								
								var attrb_grpid=$('#attrb_name').val();
								
								var catg_id=$('#catgnm').val();
								
									if (!$('#slr_nmsrchfinl option:contains('+ slrsreach_name +')').length) {			
									
									
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field .default').val('');	
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field').remove();
									
										 $('#slr_nmsrchfinl').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinlhidn').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 //$('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 
										 
										 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice' id='"+slrsreach_name_str+"' ><span>"+slrsreach_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeslrname("+'"'+slrsreach_name+'"'+ ","+'"'+slrsreach_name_str+'"'+");' ></a></li>")); 	
										 
								  }
								  
								  if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
								  {					
								
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
									
										 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
										 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
										 
										 //$('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
										$('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+catg_name_str+"' ><span>"+catg_name+"</span><a class='search-choice-close' data-option-array-index='2' onClick='removecategoryname("+'"'+catg_name_str+'"'+","+'"'+catg_id+'"'+ ");' ></a></li>"));  
										
									
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
									
										 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
										 
										 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
										 
										 
										 //$('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
										 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+attrb_namemodf+"' ><span>"+attrb_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeonlyattrbgroup("+'"'+attrb_grpid+'"'+ ","+'"'+attrb_namemodf+'"'+");' ></a></li>")); 
										
									
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
				
				var catg_name_str=$.trim(catg_name).replace(/ /g,"_");
				catg_name_str=catg_name_str.replace(/,/g,"_");
				catg_name_str=catg_name_str.replace(/&/g,"_");
				catg_name_str=catg_name_str.replace(/\//g,"_");
				catg_name_str=catg_name_str.replace(/'/g,"_");
				catg_name_str=catg_name_str.replace(/;/g,"_");
				catg_name_str=catg_name_str.replace(/\(/g,"_");
				catg_name_str=catg_name_str.replace(/\)/g,"_");
				
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
					var all_attrbfldconcatemodf="";
					
					$.each( attrb_fiedlname, function( key, value ) {
					 // alert( key + ": " + value );
					 	
						var attrb_actualfnlvalue="";
						var attrb_actualfnlvaluemodf="";
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{attrb_actualfnlvalue = attrb_actualfnlvalue +'<span style="border:.5px solid; border-radius:5px;">'+ attrbvalue +'</span>       ';attrb_actualfnlvaluemodf=attrb_actualfnlvaluemodf+'_'+$.trim(attrbvalue);}
									
							});
						
						});
						
						
						all_attrbfldconcate = all_attrbfldconcate + '<span style="background-color:#9CF;font-weight:bold; ">'+  value   + ': '+'</span>'
						+ '<span style="color:#90F; ">'+ attrb_actualfnlvalue + '</span>'+'<br><br>';
						
						all_attrbfldconcatemodf=all_attrbfldconcatemodf+'_'+$.trim(attrb_actualfnlvaluemodf);
					});
					
					attrb_namemodf=attrb_name+'_'+all_attrbfldconcatemodf;
					attrb_name='<span style="font-weight:bold;font-size:17px;">'+attrb_name+'</span>' + ':<br><hr>' + all_attrbfldconcate ;
					
				    
					
					var attrb_namemodf=$.trim(attrb_namemodf).replace(/ /g,"_");
						attrb_namemodf=attrb_namemodf.replace(/,/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/&/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\//g,"_");
						attrb_namemodf=attrb_namemodf.replace(/'/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/;/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\(/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\)/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\:/g,"_");
					
			//--------------------------------- attribute id  entry in hidden filed start------------------------------------//
					var attrb_idarr = [];
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrbactual_id, function( key1, attrbid ) {
					
					 		$.each( attrb_headingnamewithattrbid, function( key2, attrbidheadinnm ) {
									
									if(attrbidheadinnm.includes(value) && attrbidheadinnm.includes(attrbid))
									{
										$('#hdnattrb_ids').append($("<option selected='selected'></option>").attr("value",attrbid).text(attrbid));
										
										attrb_idarr.push(attrbid);
									}
									
							});
						
						});										
						
					});								 	
					
					var attrb_idarrstring=attrb_idarr.join("_");
			//--------------------------------- attribute id entry in hidden filed end------------------------------------//
			
			
			//--------------------------------- attribute id  entry value hidden filed start------------------------------------//
					
					var attrab_valuearr = [];
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{
										$('#hdnattrb_values').append($("<option selected='selected'></option>").attr("value",attrbvalue).text(attrbvalue));
										
										attrab_valuearr.push(attrbvalue);
									
									}
									
							});
						
						});										
						
					});								 	
					
					var attrab_valuearrstring=attrab_valuearr.join("_");
					
			//--------------------------------- attribute value entry in hidden filed end------------------------------------//
						
								
								
								
									if (!$('#slr_nmsrchfinl option:contains('+ slrsreach_name +')').length) {			
									
									
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field .default').val('');	
										$('#slr_nmsrchfinl_chosen .chosen-choices .search-field').remove();
									
										 $('#slr_nmsrchfinl').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 $('#slr_nmsrchfinlhidn').append($("<option selected='selected'></option>").attr("value",slrsreach_name).text(slrsreach_name));
										 //$('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrsreach_name+"</span></li>")); 	
										 
										 $('#slr_nmsrchfinl_chosen .chosen-choices').append($("<li class='search-choice' id='"+slrsreach_name_str+"' ><span>"+slrsreach_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeslrname("+'"'+slrsreach_name+'"'+ ","+'"'+slrsreach_name_str+'"'+");' ></a></li>")); 
										 
								  }
								  
								  if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
								  {					
								
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
										$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
									
										 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
										 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
										 
										 //$('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
										 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+catg_name_str+"' ><span>"+catg_name+"</span><a class='search-choice-close' data-option-array-index='1' onClick='removecategoryname("+'"'+catg_name_str+'"'+","+'"'+catg_id+'"'+ ");' ></a></li>")); 

										
									
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
									
										 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
										 
										 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
										 
										 //$('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
										 
										 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+attrb_namemodf+"' ><span>"+attrb_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeattrbname("+'"'+attrb_grpid+'"'+","+'"'+attrb_namemodf+'"'+","+'"'+attrb_idarrstring+'"'+","+'"'+attrab_valuearrstring+'"'+");' ></a></li>")); 
										
									
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
						
						var catg_name_str=$.trim(catg_name).replace(/ /g,"_");
						catg_name_str=catg_name_str.replace(/,/g,"_");
						catg_name_str=catg_name_str.replace(/&/g,"_");
						catg_name_str=catg_name_str.replace(/\//g,"_");
						catg_name_str=catg_name_str.replace(/'/g,"_");
						catg_name_str=catg_name_str.replace(/;/g,"_");
						catg_name_str=catg_name_str.replace(/\(/g,"_");
						catg_name_str=catg_name_str.replace(/\)/g,"_");
								
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
								 
								 //$('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
								 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+catg_name_str+"' ><span>"+catg_name+"</span><a class='search-choice-close' data-option-array-index='1' onClick='removecategoryname("+'"'+catg_name_str+'"'+","+'"'+catg_id+'"'+ ");' ></a></li>")); 

								
							
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
						var catg_name_str=$.trim(catg_name).replace(/ /g,"_");
						catg_name_str=catg_name_str.replace(/,/g,"_");
						catg_name_str=catg_name_str.replace(/&/g,"_");
						catg_name_str=catg_name_str.replace(/\//g,"_");
						catg_name_str=catg_name_str.replace(/'/g,"_");
						catg_name_str=catg_name_str.replace(/;/g,"_");
						catg_name_str=catg_name_str.replace(/\(/g,"_");
						catg_name_str=catg_name_str.replace(/\)/g,"_");
						
						
						
						var attrb_name=$('#allattrb_name option:selected').html();						
						
						var attrb_namemodf=$.trim(attrb_name).replace(/ /g,"_");
						attrb_namemodf=attrb_namemodf.replace(/,/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/&/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\//g,"_");
						attrb_namemodf=attrb_namemodf.replace(/'/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/;/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\(/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\)/g,"_");
						
						
						var attrb_grpid=$('#allattrb_name').val();
						
						var catg_id=$('#allcatg_name').val();
						
							
						  
						  if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
						  {					
						
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
							
								 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
								 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
								 
								 //$('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
								 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+catg_name_str+"' ><span>"+catg_name+"</span><a class='search-choice-close' data-option-array-index='1' onClick='removecategoryname("+'"'+catg_name_str+'"'+","+'"'+catg_id+'"'+ ");' ></a></li>")); 

								
							
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
							
								 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));		 
								 
								 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
								 
								 //$('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
								 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+attrb_namemodf+"' ><span>"+attrb_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeonlyattrbgroup("+'"'+attrb_grpid+'"'+ ","+'"'+attrb_namemodf+'"'+");' ></a></li>")); 

								
							
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
				
				var catg_name_str=$.trim(catg_name).replace(/ /g,"_");
				catg_name_str=catg_name_str.replace(/,/g,"_");
				catg_name_str=catg_name_str.replace(/&/g,"_");
				catg_name_str=catg_name_str.replace(/\//g,"_");
				catg_name_str=catg_name_str.replace(/'/g,"_");
				catg_name_str=catg_name_str.replace(/;/g,"_");
				catg_name_str=catg_name_str.replace(/\(/g,"_");
				catg_name_str=catg_name_str.replace(/\)/g,"_");
				
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
					var all_attrbfldconcatemodf="";
					
					$.each( attrb_fiedlname, function( key, value ) {
					 // alert( key + ": " + value );
					 	
						var attrb_actualfnlvalue="";
						var attrb_actualfnlvaluemodf="";
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{attrb_actualfnlvalue = attrb_actualfnlvalue +'<span style="border:.5px solid; border-radius:5px;">'+ attrbvalue +'</span>       ';attrb_actualfnlvaluemodf=attrb_actualfnlvaluemodf+'_'+$.trim(attrbvalue);}
									
							});
						
						});
						
						
						all_attrbfldconcate = all_attrbfldconcate + '<span style="background-color:#9CF;font-weight:bold; ">'+  value   + ': '+'</span>'
						+ '<span style="color:#90F; ">'+ attrb_actualfnlvalue + '</span>'+'<br><br>';
						all_attrbfldconcatemodf=all_attrbfldconcatemodf+'_'+$.trim(attrb_actualfnlvaluemodf);
						
						
					});
					
					attrb_namemodf=attrb_name+'_'+all_attrbfldconcatemodf;
					attrb_name='<span style="font-weight:bold;font-size:17px;">'+attrb_name+'</span>' + ':<br><hr>' + all_attrbfldconcate ;
					
					
					var attrb_namemodf=$.trim(attrb_namemodf).replace(/ /g,"_");
						attrb_namemodf=attrb_namemodf.replace(/,/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/&/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\//g,"_");
						attrb_namemodf=attrb_namemodf.replace(/'/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/;/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\(/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\)/g,"_");
						attrb_namemodf=attrb_namemodf.replace(/\:/g,"_");
										
					//--------------------------------- attribute id  entry in hidden filed start------------------------------------//
					var attrb_idarr = [];
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrbactual_id, function( key1, attrbid ) {
					
					 		$.each( attrb_headingnamewithattrbid, function( key2, attrbidheadinnm ) {
									
									if(attrbidheadinnm.includes(value) && attrbidheadinnm.includes(attrbid))
									{
										$('#hdnattrb_ids').append($("<option selected='selected'></option>").attr("value",attrbid).text(attrbid));
										
										attrb_idarr.push(attrbid);
									}
									
							});
						
						});										
						
					});								 	
					
					var attrb_idarrstring=attrb_idarr.join("_");
			//--------------------------------- attribute id entry in hidden filed end------------------------------------//
			
			
			//--------------------------------- attribute id  entry value hidden filed start------------------------------------//
					var attrab_valuearr = [];
					
					$.each( attrb_fiedlname, function( key, value ) {				
						
						$.each( attrb_actualvalue, function( key1, attrbvalue ) {
					
					 		$.each( attrb_headingname, function( key2, attrbheadinnm ) {
									
									if(attrbheadinnm.includes(value) && attrbheadinnm.includes(attrbvalue))
									{
										$('#hdnattrb_values').append($("<option selected='selected'></option>").attr("value",attrbvalue).text(attrbvalue));
										
										attrab_valuearr.push(attrbvalue);
									}
									
							});
						
						});										
						
					});								 	
					
					var attrab_valuearrstring=attrab_valuearr.join("_");
			//--------------------------------- attribute value entry in hidden filed end------------------------------------//
					
					
					
					
					
					
					if (!$('#catg_nmsrchfnl option:contains('+ catg_name +')').length)
						  {					
						
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field .default').val('');	
								$('#catg_nmsrchfnl_chosen .chosen-choices .search-field').remove();
							
								 $('#catg_nmsrchfnl').append($("<option selected='selected'></option>").attr("value",catg_name).text(catg_name));
								 $('#catg_nmsrchfnlhdn').append($("<option selected='selected'></option>").attr("value",catg_id).text(catg_name));
								 
								 //$('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+catg_name+"</span></li>")); 				 
								 $('#catg_nmsrchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+catg_name_str+"' ><span>"+catg_name+"</span><a class='search-choice-close' data-option-array-index='5' onClick='removecategoryname("+'"'+catg_name_str+'"'+","+'"'+catg_id+'"'+ ");' ></a></li>")); 

								
							
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
							
								 $('#attrb_srchfnl').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
								 
								 $('#hdnattrb_groupids').append($("<option selected='selected'></option>").attr("value",attrb_grpid).text(attrb_grpid));
								 
								 //$('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+attrb_name+"</span></li>")); 				 
								 $('#attrb_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+attrb_namemodf+"' ><span>"+attrb_name+"</span><a class='search-choice-close' data-option-array-index='0' onClick='removeattrbname("+'"'+attrb_grpid+'"'+","+'"'+attrb_namemodf+'"'+","+'"'+attrb_idarrstring+'"'+","+'"'+attrab_valuearrstring+'"'+");' ></a></li>")); 
								
							
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
	
	
	var prod_dtmstringmodf=$.trim(prod_dtmstring).replace(/ /g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/,/g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/&/g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/\//g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/'/g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/;/g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/\(/g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/\)/g,"_");
	prod_dtmstringmodf=prod_dtmstringmodf.replace(/\:/g,"_");
	
		
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
				 
				 
				 
				 //$('#prodadmodfdate_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+prod_dtmstring+"</span></li>")); 				 
				 $('#prodadmodfdate_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+prod_dtmstringmodf+"' ><span>"+prod_dtmstring+"</span><a class='search-choice-close' data-option-array-index='3' onClick='removeprodaddmodfdate("+'"'+prod_dtmstring+'"'+ ","+'"'+prod_dtmstringmodf+'"'+ ","+'"'+addormodfdate_type+'"'+ ","+'"'+from_dtm+'"'+ ","+'"'+to_dtm+'"'+");' ></a></li>")); 

			
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
	var prod_namskustringmodf=$.trim(prod_namskustring).replace(/ /g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/,/g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/&/g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/\//g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/'/g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/;/g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/\(/g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/\)/g,"_");
	prod_namskustringmodf=prod_namskustringmodf.replace(/\:/g,"_");
	
		
		
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
				 
				 
				 //$('#prodnmsku_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+prod_namskustring+"</span></li>")); 				 				
				 $('#prodnmsku_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+prod_namskustringmodf+"' ><span>"+prod_namskustring+"</span><a class='search-choice-close' data-option-array-index='3' onClick='removeprodnamsku("+'"'+prod_namskustring+'"'+ ","+'"'+prod_namskustringmodf+'"'+ ","+'"'+pronameorsku_type+'"'+ ","+'"'+prodnamorsku+'"'+");' ></a></li>")); 

				 
			
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
		
	var prod_prcdisstringmodf=$.trim(prod_prcdisstring).replace(/ /g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/,/g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/&/g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/\//g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/'/g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/;/g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/\(/g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/\)/g,"_");
	prod_prcdisstringmodf=prod_prcdisstringmodf.replace(/\:/g,"_");
		

		
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
				 
				 
				 //$('#pricedsi_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+prod_prcdisstring+"</span></li>")); 				 
				 
				$('#pricedsi_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+prod_prcdisstringmodf+"' ><span>"+prod_prcdisstring+"</span><a class='search-choice-close' data-option-array-index='3' onClick='removeprodpricedis("+'"'+prod_prcdisstring+'"'+ ","+'"'+prod_prcdisstringmodf+'"'+ ","+'"'+priceordisount_type+'"'+ ","+'"'+from_price+'"'+ ","+'"'+to_price+'"'+");' ></a></li>")); 	
			
			
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
		
	var slrbuyerrating_stringmodf=$.trim(slrbuyerrating_string).replace(/ /g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/,/g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/&/g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/\//g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/'/g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/;/g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/\(/g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/\)/g,"_");
	slrbuyerrating_stringmodf=slrbuyerrating_stringmodf.replace(/\:/g,"_");
			

		
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
			
			
			//$('#slrbuyerrating_srchfnl_chosen .chosen-choices').append($("<li class='search-choice'><span>"+slrbuyerrating_string+"</span></li>")); 				 
			$('#slrbuyerrating_srchfnl_chosen .chosen-choices').append($("<li class='search-choice' id='"+slrbuyerrating_stringmodf+"' ><span>"+slrbuyerrating_string+"</span><a class='search-choice-close' data-option-array-index='3' onClick='removesellerprodrating("+'"'+slrbuyerrating_string+'"'+ ","+'"'+slrbuyerrating_stringmodf+'"'+ ","+'"'+slrbuyerrating_type+'"'+ ","+'"'+from_rating+'"'+ ","+'"'+to_rating+'"'+");' ></a></li>")); 	
				 
			
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

function removeslrname(slrnm,slrnm_str)
{ //alert(slrnm);
	$("#slr_nmsrchfinl option[value='"+slrnm+"']").remove();
	$("#slr_nmsrchfinl option[text='"+slrnm+"']").remove();
	
	$("#slr_nmsrchfinlhidn option[value='"+slrnm+"']").remove();
	$("#slr_nmsrchfinlhidn option[text='"+slrnm+"']").remove();
			
	
	$('#slr_nmsrchfinl_chosen .chosen-choices #'+slrnm_str+'').remove();
	
	
	$('#slr_nmsrchfinl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
									 
	
}

function removecategoryname(catgnm_str,catgid)
{
	/*alert(catgnm);
	alert(catgnm_str);
	alert(catgid);*/
	var catgnm=$("#catg_nmsrchfnlhdn option[value='"+catgid+"']").text();
	
	//alert(catgnm);
	
	/* commented due to category remove problem
	 $("#catg_nmsrchfnl option[value='"+catgnm+"']").remove();
	$("#catg_nmsrchfnl option[text='"+catgnm+"']").remove();*/
	
	$("#catg_nmsrchfnlhdn option[value='"+catgid+"']").remove();
	//$("#catg_nmsrchfnlhdn option[text='"+catgnm+"']").remove();
			
	
	$('#catg_nmsrchfnl_chosen .chosen-choices #'+catgnm_str+'').remove();
	
	
	$('#catg_nmsrchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));	
}

function removeprodnamsku(prodnameskustring,prodnameskustringmodf,prodnmskutype,prodnamskuvalue)
{ 
	$("#prodnmsku_srchfnl option[value='"+prodnameskustring+"']").remove();
	$("#prodnmsku_srchfnl option[text='"+prodnameskustring+"']").remove();
	
	$("#hdnprodnmsku_tyefilter option[value='"+prodnmskutype+"']").remove();
	$("#hdnprodnmsku_tyefilter option[text='"+prodnmskutype+"']").remove();
	
	$("#hdnprodnmsku_datafilter option[value='"+prodnamskuvalue+"']").remove();
	$("#hdnprodnmsku_datafilter option[text='"+prodnamskuvalue+"']").remove();
			
	
	$('#prodnmsku_srchfnl_chosen .chosen-choices #'+prodnameskustringmodf+'').remove();
	
	
	$('#prodnmsku_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));	
}


function removeprodaddmodfdate(prod_dtmstring,prod_dtmstringmodf,addormodfdate_type,from_dtm,to_dtm)
{
	
	$("#prodadmodfdate_srchfnl option[value='"+prod_dtmstring+"']").remove();
	$("#prodadmodfdate_srchfnl option[text='"+prod_dtmstring+"']").remove();
	
	$("#hdndate_filtertype option[value='"+addormodfdate_type+"']").remove();
	$("#hdndate_filtertype option[text='"+addormodfdate_type+"']").remove();
	
	$("#hdndate_fromfilter option[value='"+from_dtm+"']").remove();
	$("#hdndate_fromfilter option[text='"+from_dtm+"']").remove();
	
	$("#hdndate_tofilter option[value='"+to_dtm+"']").remove();
	$("#hdndate_tofilter option[text='"+to_dtm+"']").remove();
		
			
	
	$('#prodadmodfdate_srchfnl_chosen .chosen-choices #'+prod_dtmstringmodf+'').remove();
	
	
	$('#prodadmodfdate_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
		
}


function removeprodpricedis(prod_prcdisstring,prod_prcdisstringmodf,priceordisount_type,from_price,to_price)
{
	
	$("#pricedsi_srchfnl option[value='"+prod_prcdisstring+"']").remove();
	$("#pricedsi_srchfnl option[text='"+prod_prcdisstring+"']").remove();
	
	$("#hdnpricedsi_type option[value='"+priceordisount_type+"']").remove();
	$("#hdndate_filtertype option[text='"+priceordisount_type+"']").remove();
	
	$("#hdnpricedsi_from option[value='"+from_price+"']").remove();
	$("#hdnpricedsi_from option[text='"+from_price+"']").remove();
	
	$("#hdnpricedsi_to option[value='"+to_price+"']").remove();
	$("#hdnpricedsi_to option[text='"+to_price+"']").remove();
		
			
	
	$('#pricedsi_srchfnl_chosen .chosen-choices #'+prod_prcdisstringmodf+'').remove();
	
	
	$('#pricedsi_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
		
		
}


function removesellerprodrating(slrbuyerrating_string,slrbuyerrating_stringmodf,slrbuyerrating_type,from_rating,to_rating)
{
	$("#slrbuyerrating_srchfnl option[value='"+slrbuyerrating_string+"']").remove();
	$("#slrbuyerrating_srchfnl option[text='"+slrbuyerrating_string+"']").remove();
	
	$("#hdnslrbuyerrating_type option[value='"+slrbuyerrating_type+"']").remove();
	$("#hdnslrbuyerrating_type option[text='"+slrbuyerrating_type+"']").remove();
	
	$("#hdnslrbuyerrating_from option[value='"+from_rating+"']").remove();
	$("#hdnslrbuyerrating_from option[text='"+from_rating+"']").remove();
	
	$("#hdnslrbuyerrating_to option[value='"+to_rating+"']").remove();
	$("#hdnslrbuyerrating_to option[text='"+to_rating+"']").remove();
		
			
	
	$('#slrbuyerrating_srchfnl_chosen .chosen-choices #'+slrbuyerrating_stringmodf+'').remove();
	
	
	$('#slrbuyerrating_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));
			
}


function removeonlyattrbgroup(attrb_grpid,attrb_namemodf)
{
	$("#attrb_srchfnl option[value='"+attrb_grpid+"']").remove();
	$("#attrb_srchfnl option[text='"+attrb_grpid+"']").remove();
	
	$("#hdnattrb_groupids option[value='"+attrb_grpid+"']").remove();
	$("#hdnattrb_groupids option[value='"+attrb_grpid+"']").remove();
	
	
	$('#attrb_srchfnl_chosen .chosen-choices #'+attrb_namemodf+'').remove();
	
	
	$('#attrb_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));		
}


function removeattrbname(attrb_grpid,attrb_namemodf,attrb_idarrstring,attrab_valuearrstring)
{
	var attrb_idarr = attrb_idarrstring.split('_');
	var attrab_valuearr = attrab_valuearrstring.split('_');
	
	$("#attrb_srchfnl option[value='"+attrb_grpid+"']").remove();
	$("#attrb_srchfnl option[text='"+attrb_grpid+"']").remove();
	
	$("#hdnattrb_groupids option[value='"+attrb_grpid+"']").remove();
	$("#hdnattrb_groupids option[text='"+attrb_grpid+"']").remove();
	
	
	$.each( attrb_idarr, function( attrbid_key, attrbid_value ) {
									
	$("#hdnattrb_ids option[value='"+attrbid_value+"']").remove();
	$("#hdnattrb_ids option[text='"+attrbid_value+"']").remove();								
									
	});
	
	$.each( attrab_valuearr, function( attrbval_key, attrbval_value ) {
									
	$("#hdnattrb_values option[value='"+attrbval_value+"']").remove();
	$("#hdnattrb_values option[text='"+attrbval_value+"']").remove();								
									
	});
	
	/*$("#hdnslrbuyerrating_type option[text='"+slrbuyerrating_type+"']").remove();
	
	$("#hdnslrbuyerrating_from option[value='"+from_rating+"']").remove();
	$("#hdnslrbuyerrating_from option[text='"+from_rating+"']").remove();
	
	$("#hdnslrbuyerrating_to option[value='"+to_rating+"']").remove();
	$("#hdnslrbuyerrating_to option[text='"+to_rating+"']").remove();
		*/
			
	
	$('#attrb_srchfnl_chosen .chosen-choices #'+attrb_namemodf+'').remove();
	
	
	$('#attrb_srchfnl_chosen .chosen-choices').append($('<li class="search-field"><input value="" class="default" autocomplete="off" style="width: 157px;" tabindex="4" type="text"></li>'));	
}

</script>


