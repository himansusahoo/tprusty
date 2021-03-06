<?php ?>
<?php
$form_attribute = array(
    "name" => "search_filters",
    "id" => "search_filters",
    "method" => "POST",
    "class" => "form-inline",
    "style" => "display:unset;"
);
$form_action = '#';
echo form_open($form_action, $form_attribute);
?>
<div class="row-fluid">
    <div class="card card-warning card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold hand" data-card-widget="collapse">Filters</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>                   
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display:block;">
            <div class="row">
                <div class="col-3">
                    <?php
                    $minYear = $dates->minY;
                    $minMonth = $dates->minM;
                    $maxYear = $dates->maxY;
                    $maxMonth = $dates->maxM;
                    $tempMinY = $minYear;
                    $years = array(
                        '0' => 'Year'
                    );
                    for (; $tempMinY <= $maxYear; $tempMinY++) {
                        $years[$tempMinY] = $tempMinY;
                    }
                    $attribute = array(
                        "name" => "order_from_year",
                        "id" => "order_from_year",
                        "class" => "form-control",
                        "style"=>"width:100%"
                    );
                    echo form_dropdown('order_from_year', $years, '0', $attribute);
                    ?>
                </div>
                <div class="col-3">
                     <?php
                    $attribute = array(
                        "name" => "order_from_month",
                        "id" => "order_from_month",
                        "class" => "form-control",
                        "style" => 'width:100%; display:none;'
                    );
                    $month = array(
                        '0' => 'Month',
                        '1' => 'January',
                        '2' => 'February',
                        '3' => 'March',
                        '4' => 'April',
                        '5' => 'May',
                        '6' => 'June',
                        '7' => 'July',
                        '8' => 'August',
                        '9' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December'
                    );
                    echo form_dropdown('order_from_month', $month, '', $attribute);
                    ?>
                </div>
                <div class="col-3">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat float-left" id="download_report">Download</a>
                </div>
            </div>
        </div>
    </div>    

</div>
<?php echo form_close() ?>
<script type="text/javascript">
    var minY = '<?= $minYear ?>';
    var maxY = '<?= $maxYear ?>';
    var minM = '<?= $minMonth ?>';
    var maxM = '<?= $maxMonth ?>';
    var years =<?= json_encode($years) ?>;
    $(function ($) {
        $('#download_report').hide();
        var months = {
            1: 'January',
            2: 'February',
            3: 'March',
            4: 'April',
            5: 'May',
            6: 'June',
            7: 'July',
            8: 'August',
            9: 'September',
            10: 'October',
            11: 'November',
            12: 'December'
        };
        $(document).on('change', '#order_from_year', function () {
            var selectedYear = $(this).val();

            if (selectedYear == 0) {
                $('#order_from_month').hide();
            } else {
                $('#order_from_month option:gt(0)').remove();

                if (selectedYear == minY) {
                    minM = parseInt(minM);
                    for (var month in months) {
                        if (month >= minM) {
                            $('#order_from_month').append($("<option></option>").attr("value", month).text(months[month]));
                        }
                    }
                } else if (selectedYear == maxY) {
                    maxM = parseInt(maxM);
                    for (var month in months) {
                        if (month <= maxM) {
                            $('#order_from_month').append($("<option></option>").attr("value", month).text(months[month]));
                        }
                    }
                } else {
                    for (var month in months) {
                        $('#order_from_month').append($("<option></option>").attr("value", month).text(months[month]));
                    }
                }
                $('#order_from_month').show();
            }
        });

        $(document).on('change', '#order_from_month', function () {
            var month = $(this).val();
            if (month != 0) {
                $('#download_report').show();
            } else {
                $('#download_report').hide();
            }

        });

        $(document).on('click', '#download_report', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                export_type: 'csv',
                custom_search: custom_search_filter()
            };
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('export-seller-gst-reports') ?>",
                data: param,
                dataType: 'json',
                error: function (error) {
                    $('#loading').css('display', 'none');
                    //throw an error to set the job role of the current row.
                    var errorMsg = {
                        'type': 'default',
                        'title': "Error",
                        'message': "There is some error to download the report, Please contact site admin.",
                    };
                    myApp.modal.alert(errorMsg);
                }
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });
    });
    function custom_search_filter() {
        var filter = {};
        var from_year = $('#order_from_year').val();
        var from_month = $('#order_from_month').val();

        if (from_year != "0") {
            filter['from_year'] = $('#order_from_year').val();
        }
        if (from_month != "0") {
            filter['from_month'] = $('#order_from_month').val();
        }
        return filter;
    }
</script>