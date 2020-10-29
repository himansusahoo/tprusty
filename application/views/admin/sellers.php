<?php
require_once('header.php');
?>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<style>
    .Zebra_DatePicker_Icon{
        Left:82px !important;
        top:6px !important;
    }
    .Zebra_DatePicker{ z-index:999999 !important;}
</style>
<div id="content">
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_sellers.php'; ?>
        </div>
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>  <!-- @end top-bar  -->
    <div class="main-content">
        <div class="row content-header">
            <h4>Seller</h4>
            <div class="a-center">
                <?php
                if ($this->session->flashdata('seller_approve')):echo $this->session->flashdata('seller_approve');
                endif;
                ?>
            </div>           
        </div>
        <div class="row mb10">
            <div class="error_msg a-center"></div>           
        </div>        
        <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url() . 'images/loading1.gif' ?>" /></div>
        <div class="col-md-6 pagination">
            <p><?php
                if (isset($links)) {
                    echo '<li>' . $links . '</li>';
                }
                ?></p>
        </div>

        <form action="<?php echo base_url() . 'admin/sellers/filter_sellers_data' ?>" method="post" >
            <div  class="col-md-6 left">
                <table class="multi_action">
                    <tr>

                        <td>
                            <div class="right">

                                <input type="submit" class="all_buttons" value="Search" id="search"  />
                                <input type="reset" class="all_buttons" value="Reset Filter" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="clearfix"> </div>

            <div>
                <table class="table table-bordered">
                    <tr>
                        <?php if ($name1) { ?>
                            <td colspan="11">Filtered Data  as  Seller Name:- <?php echo $name1; ?> 
                            </td>
                        <?php } else if ($phone) {
                            ?>
                            <td colspan="11">Filtered Data  as  Phone:- <?php echo $phone; ?> 
                            </td>
                        <?php } else if ($state) {
                            ?>
                            <td colspan="11">Filtered Data  as  State:-<?php echo $state; ?> 
                            </td>
                        <?php } else if ($seller_from && $seller_to) {
                            ?>
                            <td colspan="11">Filtered Data  as  Seller Id:- <?php echo $seller_from; ?> to <?php echo $seller_to; ?>
                            </td>
                        <?php } else if ($reg_date_from && $reg_date_to) {
                            ?>
                            <td colspan="11">Filtered Data  as  Registration Date Form:- <?php echo $reg_date_from; ?> To <?php echo $reg_date_to; ?>
                            </td>
                        <?php } else if ($city) {
                            ?>
                            <td colspan="11">Filtered Data  as  City:-<?php echo $city; ?> 
                            </td>
                        <?php } else if ($email) {
                            ?>
                            <td colspan="11">Filtered Data  as  email:-<?php echo $email; ?> 
                            </td>
                        <?php } else if ($seller_status) {
                            ?>
                            <td colspan="11">Filtered Data  as  Seller Status:-<?php echo $seller_status; ?> 
                            </td>
                        <?php } else if ($approval_from && $approval_to) {
                            ?>
                            <td colspan="11">Filtered Data  as  Approval Date Form:- <?php echo $approval_from; ?> To <?php echo $approval_to; ?>
                            </td>
                        <?php } ?>
                    </tr>
                    <tr class="table_th">
                        <th class="a-center" width="1%"><input type="checkbox" onClick="toggle(this)" /></th>
                        <th width="5%">Seller UNIQUE ID</th>
                        <th width="5%">Business Name</th>
                        <th width="10%">Phone</th>
                        <th width="10%">Registration Date</th>
                        <th width="10%">State</th>
                        <th width="10%">City</th>
                        <th width="10%">Seller Email Address</th>
                        <th width="10%">Approval Date</th>
                        <th width="5%">Status</th>
                        <th width="38%">Action</th>
                    </tr>
                    <tr class="filter_tr">
                        <td>
                        </td>
                        <td>
                            <input type="text" name="seller_id" value="">
                        </td>
                        <td>
                            <input type="text" name="name1" value="">
                        </td>
                        <td>
                            <input type="text" name="phone" value="">
                        </td>
                        <td>
                            <div>
                                <span class="label" style="color:#000;">From:</span>
                                <input type="text" name="regdate_from" value="" id="datepicker-example7-start">
                            </div>
                            <div>	
                                <span class="label" style="color:#000;">To:</span>
                                <input type="text" name="regdate_to" value="" id="datepicker-example7-end">
                            </div>
                        </td>
                        <td>
                            <input type="text" name="state" value="">
                        </td>
                        <td>
                            <input type="text" name="city" value="">
                        </td>
                        <td>
                            <input type="text" name="email" value="">
                        </td>
                        <td>
                            <div>
                                <span class="label" style="color:#000;">From:</span>
                                <input type="text" name="approval_from" value="" id="datepicker-example7-start1">
                            </div>
                            <div>	
                                <span class="label" style="color:#000;">To:</span>
                                <input type="text" name="approval_to" value="" id="datepicker-example7-end1">
                            </div>
                        </td>
                        <td>
                            <select name="seller_status">
                                <option value=""></option>
                                <option value="Pending">Pending</option>
                                <option value="Active">Active</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>

                    <?php
                    if ($sellers) {
                        foreach ($sellers as $row):
                            //var_dump($sellers);
                            //script start for registration process not completed seller condition.
                            $slr_sql = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$row->seller_id'");
                            $slr_sql_row = $slr_sql->num_rows();
                            if ($slr_sql_row < 1) {
                                ?>
                                <tr style="color:#FF3737;">
                                    <td class="a-center"><input type="checkbox" name="seller_id" value="<?= $row->seller_id ?>"></td>
                                    <td><?= $row->seller_uidcode . $row->seller_uid; ?></td>
                                    <td></td>
                                    <td><?= $row->mobile ?></td>
                                    <td><?php
                                        $date = $row->register_date;
                                        echo $datee = strstr($date, ' ', true);
                                        ?></td>
                                    <td><?= $row->seller_state ?></td>
                                    <td><?= $row->seller_city ?></td>
                                    <td><?= $row->email ?></td>
                                    <td><?php
                                        $h = $row->approval_date;
                                        echo $hh = strstr($h, ' ', true);
                                        ?></td>
                                    <td id="seller_id"><?= $row->status ?></td>
                                    <td>
                                        <a href='<?php echo base_url() . 'admin/sellers/seller_details/' . $row->seller_id; ?>' title="View Seller Details"> <i style="font-size:20px;" class="fa fa-eye"></i> </a>
                                                                           <!--<a href="<?//php echo base_url().'admin/sellers/addnew_product_for_seller/'.$row->seller_id; ?>" title="Add New Product"><i style="font-size:20px;" class="fa fa-plus-square"></i></a>-->
                                        <select onchange="getVal(this.value, <?= $row->seller_id ?>, '<?= $row->email ?>')">
                                            <option value="">--Status--</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Active">Active</option>
                                            <option value="Suspended">Suspended</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                        <br/><span style="font-size:10px;">Incomplete Registration</span>

                                    </td>
                                </tr>
                                <?php
                            } else { // End of registration process not completed seller condition.
                                $slr_res = $slr_sql->row();
                                ?>
                                <tr>
                                    <td class="a-center"><input type="checkbox" name="seller_id" value="<?= $row->seller_id ?>"></td>
                                    <td><?= $row->seller_uidcode . $row->seller_uid; ?></td>
                                    <td><?= $slr_res->business_name; ?></td>
                                    <td><?= $row->mobile ?></td>
                                    <td><?php
                            $date = $row->register_date;
                            echo $datee = strstr($date, ' ', true);
                            ?></td>
                                    <td><?= $row->seller_state ?></td>
                                    <td><?= $row->seller_city ?></td>
                                    <td><?= $row->email ?></td>
                                    <td><?php
                            $h = $row->approval_date;
                            echo $hh = strstr($h, ' ', true);
                            ?></td>
                                    <td id="seller_id"><?= $row->status ?></td>
                                    <td>
                                        <a href='<?php echo base_url() . 'admin/sellers/seller_details/' . $row->seller_id; ?>' title="View Seller Details"> <i style="font-size:20px;" class="fa fa-eye"></i> </a>                                        
                                        <select onchange="getVal(this.value, <?= $row->seller_id ?>, '<?= $row->email ?>')">
                                            <option value="">--Status--</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Active">Active</option>
                                            <option value="Suspended">Suspended</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>

                                    </td>
                                </tr>
                                <?php
                            }
                        endforeach;
                    } else {
                        ?>
                        <tr>
                            <td class="a-center" colspan="11">No records found!</td>
                        </tr>
    <?php
}
?>
                </table>
            </div>
        </form>
        <div class="pagination">
            <p><?php
if (isset($links)) {
    echo '<li>' . $links . '</li>';
}
?></p>
        </div>
    </div>  <!-- @end #main-content -->
</div><!-- @end #content -->

<script language="JavaScript">
    function toggle(source) {
        checkboxes = document.getElementsByName('seller_id');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    function getVal(val, seller_id, email) {
        var base_url = "<?php echo base_url(); ?>";
        var controller = "admin/sellers/";
        var m = confirm("Are you sure to change the status ?");
        if (m) {
            $("#loader_div").css('display', 'block');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/sellers/change_seller_status",
                data: {val: val, seller_id: seller_id, email: email},
                success: function (data) {
                    window.location.reload(true);
                    $("#loader_div").css('display', 'none');
                }
            });
        }
    }

    function doAction() {
        var base_url = "<?php echo base_url(); ?>";
        var action_val = $("select[name='action'] option:selected").val();
    }

// Category filter
    function searchSeller() {
        var base_url = "<?php echo base_url(); ?>";
        var controller = "admin/sellers/";
        var category_search_input = $("input[name='category_search_input']").val();
        if (category_search_input == "") {
            $("input[name='category_search_input']").focus().css('border', '1px solid red');
            $(".error_msg").show().text('Please enter category name.');
            return false;
        } else {
            window.location.href = base_url + controller + "seller_search/" + category_search_input;
        }
    }
</script>
<?php
require_once('footer.php');
?>					