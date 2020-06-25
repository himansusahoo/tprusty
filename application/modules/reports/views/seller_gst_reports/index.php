<?php ?>
<style type="text/css">
    table{table-layout: fixed;}
    .first_name{width:100px !important;}
    .last_name{width:100px !important;}
    .login_id{width:100px !important;}
    .email{width:150px !important;}
    .login_status{width:100px !important;}
    .mobile{width:100px !important;}
    .mobile_verified{width:120px !important;}
    .email_verified{width:100px !important;}
    .status{width:100px !important;}
    .Action{width:100px !important;}
</style>
<div class="row-fluid">
    <div class="col-sm-12 no_pad table-responsive">
        <?php
        $this->load->library('c_datatable');
        $dt_data = $this->c_datatable->generate_grid($config);
        echo $dt_data;
        ?>
    </div>
</div>
<script type="text/javascript">
    $(function ($) {

//export raw data as excel 

        $(document).on('click', '#export_table_xls', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'xlsx'
            };
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('export-seller-gst-reports') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });
//export raw data as csv 

        $(document).on('click', '#export_table_csv', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'csv'
            };
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('export-seller-gst-reports') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });

    });
</script>