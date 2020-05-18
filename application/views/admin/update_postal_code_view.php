<?php
require_once('header.php');
?>

<div id="content">
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_config.php'; ?>
        </div>
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>
    <br>
    <br>    
    <!-- Lightbox link start here-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/progressbar/css/style.css">
    <style>
        #process_div{display:none; text-align:center;}
    </style> 
    <!--<link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>-->
    <!--<script src="<?php //echo base_url();  ?>colorbox/jquery.min.js"></script>
    <script src="<?php //echo base_url();  ?>colorbox/jquery.colorbox.js"></script>-->
    <script>
        //$(document).ready(function(){
  //          $(".inline").colorbox({inline:true, width:"50%",height:"50%"});
  //      });
    </script>
    <!-- Lightbox link end here-->

    <script>
        function dwln_bulkprodtemplate(selr_id)
        {
            //var subcatgid=$('#subcategory_id').val();

            var subcatgid = $('input[name="subcategory_id"]:checked').map(function (_, el) {
                return $(el).val();
            }).get();

            var subcategoryid = document.getElementsByName("subcategory_id");
            var subcategoryid_count = subcategoryid.length;
            var count = 0;
            for (var i = 0; i < subcategoryid_count; i++) {
                if (subcategoryid[i].checked === true) {
                    count++;
                }
            }
            if (count == 0) {
                $("#show_error").text('Please Select Atleast One Category');
                $("#show_error").show();
                return false;
            }
            var attrb_id = $('#attribute_set').val();
            if (attrb_id == '')
            {
                $("#show_error").text('Please Select Atleast One Attribute Set');
                $("#show_error").show();
                return false;
            } else {
                window.location.href = '<?php echo base_url() .'admin/Bulkproduct_edit/bulk_producteditemplate/' ?>' + subcatgid + '/' + attrb_id + '/' + selr_id;

            }
        }

        function select_attrbset(catg_id, seler_id)
        {
            $('#attrbcatgloader').css('display', 'block');
            $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>admin/Bulkproduct_edit/select_sellerid",
                data: {catg_id: catg_id, seler_id: seler_id},
                success: function (data) {

                    $("#attrb_ascatgwise").html(data);
                    $('#attrbcatgloader').css('display', 'none');


                }
            });
        }

    </script>

    <div class="main-content" style="padding:40px 10px;">   


        <!----------------------------------------------Category Listing Start----------------------------->
        <!-- collapsibleCheckboxTree -->
        <script type="text/javascript" src="<?php echo base_url() . 'js/jquery.collapsibleCheckboxTree.js' ?>"></script>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                $('ul#example').collapsibleCheckboxTree();
            });
        </script>


        <div style="text-align:center; color:#F00; font-weight:bold;" >
            <?php
            $qr = $this->db->query("SELECT postalpincode_edit FROM  product_process_status WHERE status_id=1");
            $rw = $qr->row();
            if ($rw->postalpincode_edit == 'process') {
                echo "! Please wait Bulk Product Edit is under process.....";
                //redirect('admin/super_admin/home');
                ?><br><img src="<?php echo base_url() . 'images/loading1.gif' ?>" />
            <?php } ?>
        </div>
        <?php if ($rw->postalpincode_edit == 'not process') { ?>        

            <div id="show_error" align="center" style="color:#F00; display:none;" > </div> 


            <!---------------------------------------------Category Listing End-------------------------------->

            <!-- @start #right-content -->

            <div class="right-cont" style="width:100%;">
                <div id="show_error" align="center" style="color:#F00;"> </div>
                <div class="form_view">
                    <h3>

                        Download & Upload Poastal Code

                    </h3>
                    <br>
                    <table>                               
                        <tr>    

    <!--<td>Attribute Set Type <sup>*</sup> </td>-->
                            <td colspan="2">

                                <?php /* ?> <select class="seller_input" id="attribute_set" name="attribute_set" >
                                  <option value="">--Choose Attribute--</option>
                                  <?php
                                  $edit_attrbsetarr=explode(',',$edit_attrbset);
                                  $attribute = $attrbset->result_array();
                                  if($attribute) :
                                  foreach($attribute as $row) :
                                  if(in_array($row['attribute_group_id'],$edit_attrbsetarr)){
                                  ?>
                                  <option value="<?php echo $row['attribute_group_id']; ?>"><?php echo $row['attribute_group_name']; ?></option>
                                  <?php
                                  }
                                  endforeach;
                                  endif;
                                  ?>
                                  </select><?php */ ?>
                                &nbsp;&nbsp;&nbsp; 

                                <span id="attrb_ascatgwise"> </span>

                                <button id="product_submit" class="seller_buttons" >

                                  
                                <a id="product_submit" class='seller_buttons' onClick="file_uploadivdisplay()" style="cursor:pointer;" >
                                    <i class="fa fa-upload" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Upload Template 
                                </a>
                                <span style="display:none; color:#F00;" id="attrbcatgloader">! Please Wait Attribute Set is Populating...<img src="<?php echo base_url() . 'images/progress.gif' ?>"></span>

                            </td>
                        </tr>

                    </table>
                    </br>
                </div>


                <!---------------------------------------file upload div start---------------------------------------->
                <div id="file_uploaddiv" align="center" class="alert alert-info alert-dismissable" style="display:none; background-color:#CCC;">

                    <!--------------------------progress bar code start-------------------------->
                   
                    <div class="clearfix"> &nbsp; </div>   		
                    <!--------------------------progress bar code end-----------------------------> 

                    <h4 class="title sn">Upload File </h4> 
                    <form action="" method="post" id="myForm" enctype="multipart/form-data">
                    <table class="edit_address_form">
                        <tr>
                            <td colspan="2">
                                <div id="exlshow_error" align="center" style="color:#F00; display:none;" > </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Select a file to upload </td>
                            <td>
                                
                                <input type="file" class="text" size="32px" id="userfile" name="userfile" ></td>
                        </tr>

                        <tr>

                            <td colspan='2' align="center">
                                <div id="process_div"> <img src="<?php echo base_url() . 'images/loading1.gif' ?>" /></div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan='2' align="right"> 

                                <input type="button" value="Upload" id="exl_upload" name="exl_upload" onClick="upload_excelfile()" style="background-color:#0C6;"> 
                                <!-- <input type="submit" value="Upload" id="exl_upload" name="exl_upload"  style="background-color:#0C6;" onClick="return excelValidate()">-->
                                <input type="button" value="Cancel" id="exl_uploadcancel" name="exl_uploadcancel" style="background-color:#FCF;">
                            </td>
                        </tr>

                    </table>
                    </form>

                    <div id="excelrec_statisdiv" style="display:none"></div>

                </div>    

                <!----------------------------------------file upload div end------------------------------------------>



            </div>
        <?php } // bulk product edit status condtion end ?>				
    </div>
</div>
<div class="clearfix"> </div>
<!-- @end #right-content -->         


</div>  <!-------div content main end tag-------->                  
</div>  <!-------div content end tag-------->       
<!--- light box div start here --->
<?php /* ?><div style="display:none">
  <div id="inline_content_add_cur_fld" style="padding:10px; background:#fff;">
  <div class="edit_address_dv">
  <h4 class="title sn">Upload File </h4>
  <div class="col-md-12">
  <?php
  $attributes = array('class' => 'cmxform', 'id' => 'myForm', 'method' => 'POST' );
  echo form_open_multipart('admin/Upload_bulkproduct/upload_prodexcel', $attributes);
  ?>
  <table class="edit_address_form">
  <tr>
  <td colspan="2">
  <div id="exlshow_error" align="center" style="color:#F00; display:none;" > </div>
  </td>
  </tr>
  <tr>
  <td>Select a file to upload </td>
  <td>
  <input type="hidden" value='<?=$seller_id?>' name='hdntxt_sellerid' id='hdntxt_sellerid'>
  <input  type="file" class="text" size="32px" id="userfile" name="userfile" ></td>
  </tr>

  <tr>

  <td colspan='2' align="center">
  <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" />
  </div>
  </td>
  </tr>

  <tr>
  <td colspan='2' align="right">

  <!--<input type="button" value="Upload" id="exl_upload" name="exl_upload" onClick="upload_excelfile()" style="background-color:#0C6;"> -->
  <input type="submit" value="Upload" id="exl_upload" name="exl_upload"  style="background-color:#0C6;" onClick="return excelValidate()">
  <input type="button" value="Cancel" id="exl_uploadcancel" name="exl_uploadcancel" style="background-color:#FCF;">
  </td>
  </tr>

  </table>
  <?php echo form_close(); ?>

  <div id="excelrec_statisdiv" style="display:none"></div>
  </div>

  </div>
  </div>
  </div><?php */ ?>
<!--- light box div end here ---> 

<script>

    function file_uploadivdisplay()
    {
        $('#file_uploaddiv').css('display', 'block');


    }

    function upload_excelfile()
    {

        var formData = new FormData($("#myForm")[0]);
        var userfl = $("input[name='userfile']").val();
        var ext = userfl.substring(userfl.lastIndexOf('.') + 1);

        $("#excelrec_statisdiv").css('display', 'none');


        if (userfl == '')
        {
            $("#excelrec_statisdiv").css('display', 'none');
            $("#exlshow_error").text('Please Select One File To Upload');
            $("#exlshow_error").show();
            return false;
        } else if (ext != "xls") {

            $("#excelrec_statisdiv").css('display', 'none');
            $("#exlshow_error").text('Invalid File Type, Please Select Excel(.xls) File');
            $("#exlshow_error").show();
            return false;
        } else if (ext == "xls" && userfl != '')
        {
            $('#process_div').css('display', 'block');
            $.ajax({
                url: '<?php echo base_url() . 'admin/update_postal_code_cnt/upload_postal_code_excel' ?>',
                type: 'POST',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    $("input[name='userfile']").val('');
                    $("#exlshow_error").text('');
                    $("#excelrec_statisdiv").css('display', 'block');
                    $("#excelrec_statisdiv").html(data);
                    $('#process_div').css('display', 'none');
                }
            });
        }

    }


    function confirm_tosaveproduct(fileuploadid, confsts)
    {
        $('#process_div').css('display', 'block');
        $("#excelrec_statisdiv").css('display', 'none');
        $("#exlshow_error").css('display', 'none');
        $.ajax({
            method: "POST",
            url: "<?php echo base_url(); ?>admin/Bulkproduct_update/upload_afterconfirmprodexcel_editedprod",
            data: {fileuploadid: fileuploadid, confsts: confsts},
            success: function (data) {

                $("#excelrec_statisdiv").html(data);
                $('#process_div').css('display', 'none');
                $("#excelrec_statisdiv").css('display', 'block');

            }
        });

    }

</script>  

<script>
    function excelValidate() {
        var file_name = $("input[name='userfile']").val();

        var ext = file_name.substring(file_name.lastIndexOf('.') + 1);
        if (file_name == '') {
            alert('Please select an excel file to upload');
            return false;
        } else if (ext != "xlsx" && ext != "xls") {
            alert('Invalid file extension');
            return false;
        }
    }
</script>   


<?php
require_once('footer.php');
?>	