<?php
require_once("header.php");
?>		

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url() . 'asset/ckeditor/ckeditor.js' ?>"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script type="text/javascript" src="<?php echo base_url() . 'js/jquery.collapsibleCheckboxTree.js' ?>"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $('ul#example').collapsibleCheckboxTree();
    });

</script>

<script>

    function valid()
    {
        var subcategoryid = document.getElementsByName("subcategory_id");
        var subcategoryid_count = subcategoryid.length;

        var count = 0;
        for (var i = 0; i < subcategoryid_count; i++) {
            if (subcategoryid[i].checked === true)
            {
                count++;
            }
        }

        if (count == 0)
        {
            document.getElementById('show_error').innerHTML = "Select any category from directory list structure";
            return false
        }
        if ($('#category_name').val() == '')
        {

            $('.form_view').find('#tab1').addClass('in active');
            $('.form_view').find('#tab2').removeClass('in active');
            $('.form_view').find('#tab3').removeClass('in active');
            $('.form_view').find('#tab4').removeClass('in active');
            $('.tabs-horiz').find('#li_tab1').addClass('active');
            $('.tabs-horiz').find('#li_tab2').removeClass('active');
            $('.tabs-horiz').find('#li_tab3').removeClass('active');
            $('.tabs-horiz').find('#li_tab4').removeClass('active');
            document.getElementById('show_error').innerHTML = "Enter Category Name";
            $('#category_name').css('border', '1px solid red');
            document.getElementById('category_name').focus();
            return false;

        }

        if ($('#active_status').val() == '')
        {
            $('.form_view').find('#tab1').addClass('in active');
            $('.form_view').find('#tab2').removeClass('in active');
            $('.form_view').find('#tab3').removeClass('in active');
            $('.form_view').find('#tab4').removeClass('in active');


            $('.tabs-horiz').find('#li_tab1').addClass('active');
            $('.tabs-horiz').find('#li_tab2').removeClass('active');
            $('.tabs-horiz').find('#li_tab3').removeClass('active');
            $('.tabs-horiz').find('#li_tab4').removeClass('active');

            document.getElementById('show_error').innerHTML = "Select Active Status";
            $('#active_status').css('border', '1px solid red');
            document.getElementById('active_status').focus();
            return false;
        }

        if ($('#incld_navmenu_status').val() == '')
        {

            $('.form_view').find('#tab1').addClass('in active');
            $('.form_view').find('#tab2').removeClass('in active');
            $('.form_view').find('#tab3').removeClass('in active');
            $('.form_view').find('#tab4').removeClass('in active');


            $('.tabs-horiz').find('#li_tab1').addClass('active');
            $('.tabs-horiz').find('#li_tab2').removeClass('active');
            $('.tabs-horiz').find('#li_tab3').removeClass('active');
            $('.tabs-horiz').find('#li_tab4').removeClass('active');

            document.getElementById('show_error').innerHTML = "Select Include Navigation Menu";
            $('#incld_navmenu_status').css('border', '1px solid red');
            document.getElementById('incld_navmenu_status').focus();
            return false;

        }



        if ($('#avl_prod_list_order').val() == '')
        {
            $('.form_view').find('#tab2').addClass('in active');
            $('.form_view').find('#tab1').removeClass('in active');
            $('.form_view').find('#tab3').removeClass('in active');
            $('.form_view').find('#tab4').removeClass('in active');


            $('.tabs-horiz').find('#li_tab2').addClass('active');
            $('.tabs-horiz').find('#li_tab1').removeClass('active');
            $('.tabs-horiz').find('#li_tab3').removeClass('active');
            $('.tabs-horiz').find('#li_tab4').removeClass('active');

            document.getElementById('show_error').innerHTML = "Select Available Product Listing Sort by";
            $('#avl_prod_list_order').css('border', '1px solid red');
            document.getElementById('avl_prod_list_order').focus();
            return false;
        }

        if ($('#def_prod_list_sortby').val() == '')
        {

            $('.form_view').find('#tab2').addClass('in active');
            $('.form_view').find('#tab1').removeClass('in active');
            $('.form_view').find('#tab3').removeClass('in active');
            $('.form_view').find('#tab4').removeClass('in active');


            $('.tabs-horiz').find('#li_tab2').addClass('active');
            $('.tabs-horiz').find('#li_tab1').removeClass('active');
            $('.tabs-horiz').find('#li_tab3').removeClass('active');
            $('.tabs-horiz').find('#li_tab4').removeClass('active');

            document.getElementById('show_error').innerHTML = "Select Default Product Listing Sort By";
            $('#def_prod_list_sortby').css('border', '1px solid red');
            document.getElementById('def_prod_list_sortby').focus();
            return false;

        }



    }


</script>

<script>
    $(function () {
        $("#datepicker_from").datepicker();
    });

    $(function () {
        $("#datepicker_to").datepicker();
    });


</script>        



<div id="content">    
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_catalog.php'; ?>
        </div>
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>  <!-- @end top-bar  -->
    <div class="main-content">


        <?php if (@$data == true) { ?><div align="center" style="color:#0C6"> <?php echo $data ?> </div> <?php } ?>

        <form id="save_catgory_form" method="post" action="<?php echo base_url('admin/catalog/save_subcategory') ?>">

            <div class="row content-header">
                <div class="col-md-8"> <b> Subcategory Information</b></div>
                <div class="col-md-4 show_report">
                    <input  type="submit" class="all_buttons" value="Save Category" onClick="return valid()"/>
                    <input type="reset" class="all_buttons" value="Reset" />
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- @start left-sidebar --> 
            <div class="left-sidebar">
                <input type="button" value="Add Root Category"  class="btns" onClick="window.location.href = '<?php echo base_url(); ?>admin/catalog/manage_category'" />
                <input type="button" value="Add Subcategory"  class="btns" onClick="window.location.href = '<?php echo base_url() . 'admin/catalog/reset_for_add_subcategory/' . $catg_info->category_id; ?>'" />  
                <ul id="example">
                    <?php foreach ($data2->result() as $rows) { ?> <!--level-1 --> 
                        <li id="category_li">
                            <input id="subcategory_id"  type="radio" name="subcategory_id" value="<?php echo $rows->category_id; ?> " onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rows->category_id; ?>'" <?php
                            if ($rows->category_id == $catg_info->category_id) {
                                echo "checked";
                            }
                            ?>   />
                                   <?php echo $rows->category_name; ?>
                            <ul >
                                <?php
                                $qr = $this->db->query("select * from category_indexing where parent_id='$rows->category_id' ");
                                //$rw=$qr->result();
                                $ct = $qr->num_rows();

                                if ($ct > 0) {
                                    ?>

                                    <?php foreach ($qr->result() as $rs) { ?> <!--level-2 -->
                                        <li>		
                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs->category_id; ?>"  onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs->category_id; ?>'" <?php
                                            if ($rs->category_id == $catg_info->category_id) {
                                                echo "checked";
                                            }
                                            ?> />

                                            <?php echo $rs->category_name; ?>

                                            <ul>
                                                <!--level-3-->
                                                <?php
                                                $qr1 = $this->db->query("select * from category_indexing where parent_id='$rs->category_id' ");
                                                //$rw=$qr->result();
                                                $ct1 = $qr1->num_rows();

                                                if ($ct1 > 0) {
                                                    ?>

                                                    <?php foreach ($qr1->result() as $rs1) { ?>
                                                        <li>		
                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs1->category_id; ?>"  onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs1->category_id; ?>'" <?php
                                                            if ($rs1->category_id == $catg_info->category_id) {
                                                                echo "checked";
                                                            }
                                                            ?> />

                                                            <?php echo $rs1->category_name; ?>
                                                            <ul>
                                                                <!--level-4-->
                                                                <?php
                                                                $qr2 = $this->db->query("select * from category_indexing where parent_id='$rs1->category_id' ");
                                                                $ct2 = $qr2->num_rows();

                                                                if ($ct2 > 0) {
                                                                    ?>

                                                                    <?php foreach ($qr2->result() as $rs2) { ?>
                                                                        <li>		
                                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs2->category_id; ?>"  onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs2->category_id; ?>'" <?php
                                                                            if ($rs2->category_id == $catg_info->category_id) {
                                                                                echo "checked";
                                                                            }
                                                                            ?>/>

                                                                            <?php echo $rs2->category_name; ?>


                                                                            <ul>
                                                                                <!--level-5-->
                                                                                <?php
                                                                                $qr3 = $this->db->query("select * from category_indexing where parent_id='$rs2->category_id' ");
                                                                                //$rw=$qr->result();
                                                                                $ct3 = $qr3->num_rows();

                                                                                if ($ct3 > 0) {
                                                                                    ?>

                                                                                    <?php foreach ($qr3->result() as $rs3) { ?>
                                                                                        <li>		
                                                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs3->category_id; ?>"   onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs3->category_id; ?>'" <?php
                                                                                            if ($rs3->category_id == $catg_info->category_id) {
                                                                                                echo "checked";
                                                                                            }
                                                                                            ?> />

                                                                                            <?php echo $rs3->category_name; ?>


                                                                                            <ul>
                                                                                                <!--level-6-->
                                                                                                <?php
                                                                                                $qr4 = $this->db->query("select * from category_indexing where parent_id='$rs3->category_id' ");
                                                                                                //$rw=$qr->result();
                                                                                                $ct4 = $qr4->num_rows();

                                                                                                if ($ct4 > 0) {
                                                                                                    ?>

                                                                                                    <?php foreach ($qr4->result() as $rs4) { ?>
                                                                                                        <li>		
                                                                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs4->category_id; ?>"   onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs4->category_id; ?>'" <?php
                                                                                                            if ($rs4->category_id == $catg_info->category_id) {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                            ?> />

                                                                                                            <?php echo $rs4->category_name; ?>


                                                                                                            <ul>
                                                                                                                <!--level-7-->
                                                                                                                <?php
                                                                                                                $qr5 = $this->db->query("select * from category_indexing where parent_id='$rs4->category_id' ");
                                                                                                                //$rw=$qr->result();
                                                                                                                $ct5 = $qr5->num_rows();

                                                                                                                if ($ct5 > 0) {
                                                                                                                    ?>

                                                                                                                    <?php foreach ($qr5->result() as $rs5) { ?>
                                                                                                                        <li>		
                                                                                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs5->category_id; ?>"  onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs5->category_id; ?>'" <?php
                                                                                                                            if ($rs5->category_id == $catg_info->category_id) {
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                            ?> />

                                                                                                                            <?php echo $rs5->category_name; ?>


                                                                                                                            <ul>
                                                                                                                                <!--level-8-->
                                                                                                                                <?php
                                                                                                                                $qr6 = $this->db->query("select * from category_indexing where parent_id='$rs5->category_id' ");
                                                                                                                                //$rw=$qr->result();
                                                                                                                                $ct6 = $qr6->num_rows();

                                                                                                                                if ($ct6 > 0) {
                                                                                                                                    ?>

                                                                                                                                    <?php foreach ($qr6->result() as $rs6) { ?>
                                                                                                                                        <li>		
                                                                                                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs6->category_id; ?>"  onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs6->category_id; ?>'" <?php
                                                                                                                                            if ($rs6->category_id == $catg_info->category_id) {
                                                                                                                                                echo "checked";
                                                                                                                                            }
                                                                                                                                            ?>  />

                                                                                                                                            <?php echo $rs6->category_name; ?>


                                                                                                                                            <ul>
                                                                                                                                                <!--level-9-->
                                                                                                                                                <?php
                                                                                                                                                $qr7 = $this->db->query("select * from category_indexing where parent_id='$rs6->category_id' ");
                                                                                                                                                //$rw=$qr->result();
                                                                                                                                                $ct7 = $qr7->num_rows();

                                                                                                                                                if ($ct7 > 0) {
                                                                                                                                                    ?>

                                                                                                                                                    <?php foreach ($qr7->result() as $rs7) { ?>
                                                                                                                                                        <li>		
                                                                                                                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs7->category_id; ?>"  onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs7->category_id; ?>'" <?php
                                                                                                                                                            if ($rs7->category_id == $catg_info->category_id) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            }
                                                                                                                                                            ?>  />

                                                                                                                                                            <?php echo $rs7->category_name; ?>

                                                                                                                                                            <ul>
                                                                                                                                                                <!--level-10-->
                                                                                                                                                                <?php
                                                                                                                                                                $qr8 = $this->db->query("select * from category_indexing where parent_id='$rs7->category_id' ");

                                                                                                                                                                $ct8 = $qr8->num_rows();

                                                                                                                                                                if ($ct8 > 0) {
                                                                                                                                                                    ?>

                                                                                                                                                                    <?php foreach ($qr8->result() as $rs8) { ?>
                                                                                                                                                                        <li>		
                                                                                                                                                                            <input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs8->category_id; ?>" onChange="window.location.href = '<?php echo base_url(); ?>admin/catalog/add_subcategory/<?php echo $rs8->category_id; ?>'" <?php
                                                                                                                                                                            if ($rs8->category_id == $catg_info->category_id) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            }
                                                                                                                                                                            ?> />

                                                                                                                                                                            <?php echo $rs8->category_name; ?>
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
            </div>            

            <div class="right-cont">
                <div id="show_error" align="center" style="color:#F00;"> </div>

                <ul class="nav nav-tabs tabs-horiz">
                    <li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">General Information</a></li>
                    <li id="li_tab2"><a data-toggle="tab" href="#tab2">Display Settings</a></li>
                    <li id="li_tab3"><a data-toggle="tab" href="#tab3">Custom Design</a></li>
                </ul>
                <div class="tab-content form_view">

                    <div id="tab1" class="tab-pane fade in active">
                        <h3> General Information </h3>
                        <table>
                            <tr>
                                <td style="width:20%;">Name*</td>
                                <td>  <input type="hidden" id="category_id" name="category_id"  > <input type="text" id="category_name" name="category_name" class="text"  > </td>
                            </tr>
                            <tr>
                                <td> Is Active* </td>
                                <td> 
                                    <select id="active_status" name="active_status" class="text2" >
                                        <option value="">--select--</option>
                                        <option value="yes"  > Yes </option>
                                        <option value="no"  > No </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Description </td>
                                <td> 
                                    <textarea rows="7" name="catg_description" class="text"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('catg_description');
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td> Page Title </td>
                                <td> <input type="text" name="page_title" class="text"  ></td>
                            </tr>
                            <tr>
                                <td> Meta Keywords </td>
                                <td> 
                                    <textarea rows="7" class="text" name="meta_keyword" >  </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td> Meta Description </td>
                                <td> 
                                    <textarea rows="7" class="text" name="meta_descrp" > </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td> Include in Navigation Menu* </td>
                                <td> 
                                    <select id="incld_navmenu_status" class="text2" name="incld_navmenu_status" >
                                        <option value="">--select--</option>
                                        <option value="yes"  > Yes </option>
                                        <option value="no"  > No </option>
                                    </select>
                                </td>
                            </tr>
                        </table>                       
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <h3> Display Settings </h3>                        
                        <table>
                            <tr>
                                <td style="width:20%;"> Display Mode </td>
                                <td> 
                                    <select class="text2" name="display_mode" id="display_mode" >
                                        <option value="">--select--</option>
                                        <option value="Products only"   > Products only </option>
                                        <option value="Static block only"  > Static block only </option>
                                        <option value="Static block and Products only"    > Static block and Products only </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> CMS Block </td>
                                <td> 
                                    <select class="text2" name="cms_block" >

                                        <option value=""> Please select a static block.. </option>
                                        <option value="Footer links" > Footer links </option>
                                        <option value="Footer links Company" > Footer links Company </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Is Anchor </td>
                                <td> 
                                    <select class="text2" name="anchor_status" >
                                        <option value="">--select--</option>
                                        <option value="yes" > Yes </option>
                                        <option value="no"  > No </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Available Product Listing Sort by* </td>
                                <td> 
                                    <select name="avl_prod_list_order" id="avl_prod_list_order"   class="text2" >
                                        <option value="">--select--</option>
                                        <option value="Best Value" > Best Value </option>
                                        <option value="Name" > Name </option>
                                        <option value="Price" > Price </option>
                                    </select>                                   
                                </td>
                            </tr>
                            <tr>
                                <td>Default Product Listing Sort By*</td>
                                <td>
                                    <select class="text2" id="def_prod_list_sortby" name="def_prod_list_sortby" >
                                        <option value="">--select--</option>
                                        <option value="Best Value" > Best Value </option>
                                        <option value="Name" > Name </option>
                                        <option value="Price"  > Price </option>
                                    </select>                                   
                                </td>
                            </tr>
                            <tr>
                                <td>Layered Navigation Price Step</td>
                                <td>
                                    <input type="text" name="navigation_price"  class="text2" >                                    
                                </td>
                            </tr>
                        </table>                      
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <h3>Custom Design</h3>

                        <table>
                            <tr>
                                <td style="width:20%;"> Use Parent Category Settings </td>
                                <td> 
                                    <select class="text2" name="parent_catg_stg_status" >
                                        <option value="">--select--</option>
                                        <option value="yes" > Yes </option>
                                        <option value="no" > No </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Apply To Products </td>
                                <td> 
                                    <select class="text2" name="apply_to_product_status" >
                                        <option value="">--select--</option>
                                        <option value="yes" > Yes </option>
                                        <option value="no"  > No </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Custom Design </td>
                                <td> 
                                    <select class="text2" name="custom_design" >

                                        <option value="">-- Please Select --</option>
                                        <optgroup label="base">
                                            <option value="default" >default</option>
                                        </optgroup>
                                        <optgroup label="default">
                                            <option value="blank" >blank</option>
                                            <option value="default"  >default</option>
                                            <option value="iPhone"  >iPhone</option>
                                            <option value="modern"  >modern</option>
                                        </optgroup>
                                        <optgroup label="<?= COMPANY ?>">
                                            <option value="default" >default</option>
                                        </optgroup>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Active From</td>
                                <td><input class="text2" name="date_from" id="datepicker_from"   /></td>
                            </tr>
                            <tr>
                                <td>Active To</td>
                                <td><input class="text2"  name="date_to" id="datepicker_to"  /></td>
                            </tr>
                            <tr>
                                <td>Page Layout</td>
                                <td>
                                    <select class="text2" name="page_layout" >
                                        <option value="">--select--</option>
                                        <option value="No layout updates"   >No layout updates</option>
                                        <option value="Empty"   >Empty</option>
                                        <option value="column" >1 column</option>
                                        <option value="columns with left bar"   >2 columns with left bar</option>
                                        <option value="columns with right bar"   >2 columns with right bar</option>
                                        <option value="columns"   >3 columns</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Custom Layout Update </td>
                                <td> 
                                    <textarea name="custom_layout_update" rows="7" class="text" >  </textarea>
                                </td>
                            </tr>
                        </table>

                    </div></form>                    
                </div>
            </div> 
            <div class="clearfix"> </div>            
    </div>  
</div>
<?php
require_once('footer.php');
?>	