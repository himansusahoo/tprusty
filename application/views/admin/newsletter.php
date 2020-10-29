<?php
require_once('header.php');
?>


<script>

    $(document).ready(function () {
        $('#searchdiv2').css('display', 'none');
        $("#search-text").keyup(function () {
            $('#searchdiv2').css('display', 'block');
            var n = $('#search-text').val();

            $.ajax({
                url: '<?php echo base_url() . 'admin/newsletter/search_subscriber' ?>',
                method: 'post',
                data: {name1: n},
                success: function (data, status)
                {
                    if ($('#search-text').val() != "")
                    {
                        $("#searchdiv2 ul").html(data);
                    } else
                    {
                        $("#searchdiv2 ul").html("");
                        $('#searchdiv2').css('display', 'none');
                    }
                }
            });
        });
    });
</script>
<script>
    function delete_excel_files() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/newsletter/doDeleteExcelFiles',
            method: 'post',
            success: function (result) {
                if (result == "success") {
                    window.location.reload(true);
                }
            }
        });
    }
</script>

<div id="content">    
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_newsletter.php'; ?>
        </div>
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>  <!-- @end top-bar  -->
    <div class="main-content">
        <div class="row content-header">
            <div class=""><h4>Newsletter</h4></div>
            <div class="a-center"><?php
                if ($this->session->flashdata('download_msg')):echo $this->session->flashdata('download_msg');
                endif;
                ?></div>
        </div>
        <div class="search2">
            <?php /* ?><form action="" enctype="multipart/form-data" method="post"><?php */ ?>
            <?php echo form_open_multipart(''); ?>
            <input type="text" placeholder="Search User" id="search-text" name="search" /> 
            <div id="searchdiv2"><ul>        </ul></div>
            <input class="search-btn2" value="Search" type="submit" id="btn-search">
            </form>
        </div>
        <div>
            <?php if (file_exists(FCPATH . "excel_downloaded/newsletter.xls")) { ?>
                <!--<button class="seller_buttons right" onClick="delete_excel_files()">Delete Excel File</button>-->
                <a href="<?php echo base_url() . 'excel_downloaded/newsletter.xls'; ?>"><button type="button" class="seller_buttons right mr10" onClick="delete_excel_files()" >Download Excel File</button></a>
            <?php } ?>
            <button type="button" class="seller_buttons right mr10" onClick="window.location.href = '<?php echo base_url() . 'admin/export_excelfile/newsletter_excelfile' ?>'">Export to Excel</button>
        </div>
        <div>
            <table class="table table-bordered">
                <tr class="table_th">
                    <th width="10%">Subscriber User ID</th>
                    <th width="10%">Subscriber User Email</th>
                    <th width="10%">Subscriber User Gender</th>
                    <th width="10%">User Subscription Date</th>
                    <th width="10%">User Subscription Status</th>
                </tr>
                <?php foreach ($subscriber as $row) { ?>
                    <tr>
                        <td><?= $row->user_id; ?></td>
                        <td><?= strip_tags($row->user_email_id); ?></td>
                        <td><?= $row->user_gender; ?></td>
                        <td><?= $row->user_reg_date; ?></td>
                        <td><?= $row->scb_status; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>  <!-- @end #main-content -->
</div><!-- @end #content -->

<?php
require_once('footer.php');
?>					