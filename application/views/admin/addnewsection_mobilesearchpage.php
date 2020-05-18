<?php
require_once('header.php');
?>
<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}
.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>
<style>
.alert {
    opacity: 1;
    transition: opacity 0.6s; /* 600ms to fade out */
}
</style>
<script type="text/javascript" src="<?php echo base_url().'asset/ckeditor/ckeditor.js' ?>"></script>

			<div id="content">  
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                <?php require_once('pagedesign_setup/mobile_searchpage_addsectionjs.php'); ?>
                	<?php
					$attributes = array('onSubmit' => 'return valid_columndata()');
					echo form_open_multipart('admin/Page_search/add_pagesectiondata',$attributes);
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><h4><b>Add New Section Of Mobile Search Page</b></h4><div id="ssmessg"><?= $this->session->flashdata('succss_msg'); ?></div></div>
						<div class="col-md-4 show_report">
                        
                         <button type="button" id="section_submit" class='all_buttons' style="background-color:#C03;float:right; font-weight:bold; height:32px; width:72px;" onClick="window.location.href='<?php echo base_url().'admin/Page_search/addnewsection_formobilehomepage' ?>'" >
                        <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset </button>
                        &nbsp;&nbsp;
							<button  type="submit" id="sectio_submit" class='all_buttons' style="background-color:#093; font-weight:bold;height:32px; width:72px;display:none" >
                           
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Save </button>
                            
                       
                        
						</div>
					</div>
                    <div id="show_error" align="center" style="color:#F00;display:none;"> </div>
                    
					<div class="form_view">
						<h3>Add New Section Of Mobile Search Page</h3>
							<div width="100%">
                            		 <!----------------------Main table start------------------------>
                            <table>
                            <tr>
                            <td>
                           	 	<!--------------------------------------------section table start------------------------------------------>
                            	<table>						
								<tr>
									<td> Section type <sup>*</sup> </td>
									<td>
                                    <label id="lbl_section_type" style="font-size:18px;"> </label>
                                    	<select name="section_type" id="section_type" class="text2" onChange="populate_sectiondatatype(this.value)">
                                        	<option value=''>---select---</option>
                                            <option value="Banner">Banner</option>
                                            <option value="Slider">Slider</option>
                                            <option value="Grouped Banner">Grouped Banner</option>
                                            <option value="Product">Product</option>
                                            <option value="Featured Box">Featured Box</option>
                                            <option value="Prodcts Vertical section">Products Vertical section</option>
                                            <option value="Rich Text Editor">Rich Text Editor</option>
                                        </select>
                                    </td>
								</tr>
                                
                                
                                <tr>
									<td>Section Labelling  </td>
									<td>
                                     <!--<span id="lbl_sectionbackg_clr" style="font-size:18px;"> </span>-->
                                    <input type="text" class="text2" name="section_lbltxtbox" id="section_lbltxtbox" ></td>
								</tr>

                                <tr>
									<td> Section Data type <sup>*</sup> </td>
									<td>
                                     <label id="lbl_sectiondata_type" style="font-size:18px;"> </label>
                                    	<select name="sectiondata_type" id="sectiondata_type" class="text2" onChange="select_nofcolumn(this.value)" >
                                        	<option value=''>---select---</option>
                                        	<!--<option value="Banner">Banner</option>
                                            <option value="Product">Product</option>-->
                                            
                                        </select>
                                    </td>
								</tr>
                                 <tr>
									<td> Section Status <sup>*</sup> </td>
									<td>
                                     <label id="lbl_section_status" style="font-size:18px;"> </label>
                                    	<select name="section_status" id="section_status" class="text2">
                                        	<option value=''>---select---</option>
                                        	<option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            
                                        </select>
                                    </td>
								</tr>
                                <tr>
									<td>Section Background Color <sup>*</sup> </td>
									<td>
                                     <!--<span id="lbl_sectionbackg_clr" style="font-size:18px;"> </span>-->
                                    <input type="color" class="text2" name="sectionbackg_clr" id="sectionbackg_clr" style="height:50px;" ></td>
								</tr>
                                 
                                
                                <tr>
									<td style="width:20%;"> Number Of Column <sup>*</sup> </td>
									<td><!--<input type="number" min='1' step='1' max='3' class="text2" name="col_num" id="col_num">-->
                                     <label id="lbl_col_num" style="font-size:18px;"> </label>
                                    <select name="col_num" id="col_num" class="text2" onChange="select_imagesize()">
                                        	<option value=''>---select---</option>
                                        	<!--<option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>-->
                                        </select>
                                    &nbsp;&nbsp;
                                   
                                    </td>
								</tr>
                                
                                <tr>
                                <td style="width:37%;display:none;" id="imgsize_tdid"> Image Size <sup>*</sup> </td>
                                <td>
                                 <label id="lbl_slctimage_size" style="font-size:18px;"> </label>
                                <div id="process_div" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Loading Image Size... </div><div id="div_imgsize"></div></td>
                                </tr>
                                <tr>
									<td style="width:20%;"> Memo </td>
									<td>
                                    <textarea class="text2" name="sec_memo" id="sec_memo"></textarea>
                                   
                                    
                                   </td>
								</tr>
                                
                                <tr>
                                
                                <td style="width:20%;" colspan="2" align="center"><button type="button" style="display:none;" id="add_sectioncolumninfo" class='seller_buttons' onClick='add_columninfo()' ><i class="fa fa-plus-square" aria-hidden="true"></i> &nbsp;ADD Column </button></td>
                                
                                </tr>
                                <tr>
                                <td colspan="2">
                                <a href="#" class="seller_buttons" onclick="download_xslx()" ><i class="fa fa-download" aria-hidden="true" style="color:#FFF;"></i>  Download Template</a>
                                </td>
                                </tr>
								
							</table>
                            	<!------------------------------------------section table end------------------------------------------------>
                            </td>
                            <td>
                             <div id="screeshotprocess_div" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Loading Image... </div><div id="div_imgsize"></div>
                             <div id="div_screenshot" align="center">
                             
                             </div>
                            </td>
                            </tr>
                            </table>
                            		 <!----------------------Main table start------------------------>
                            </div>
                            <div id="columninfo_div" style="background-color:#099;display:none;" align="center">
                            
                            </div>
                            
                                 <div id="richtexteditor_divid" style="display:none;">   
                                    <textarea rows="7" name="richtxteditor_data" id="richtxteditor_data" class="text"></textarea>
									<script type="text/javascript">
                                        CKEDITOR.replace('richtxteditor_data');
                                    </script>
                                 </div>   
									<!--<button type="button">WYSIWYG Editor</button> -->
								
                            
					</div>
                    <?php echo form_close(); ?>
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->
        


<link rel="stylesheet" href="<?php echo base_url();?>jquery_date_picker/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="<?php echo base_url();?>jquery_date_picker/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script>
 $(function() {
       $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  });

  $(function() {
	$( "#datepicker" ).datepicker();
  });
</script>
<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}

function download_xslx(){	
window.location.href='<?php echo base_url().'excel_downloaded/product_skuids.csv' ?>';
}
</script>
<?php
require_once('footer.php');
?>	