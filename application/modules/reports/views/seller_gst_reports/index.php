<?php
$form_attribute = array(
    "name" => "search_filters",
    "id" => "search_filters",
    "method" => "POST"
);
$form_action = '#';
echo form_open($form_action, $form_attribute);
?>
<div class="row-fluid">
    <div class="box box-info collapsed-box">
        <div class="box-header with-border" data-widget="collapse">
            <h3 class="box-title">Filters</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: none;">            

            <div class="form-group col-sm-3">
                <label for="order_to_year" class="col-sm-4 col-form-label">Seller</label>
                <div class="col-sm-8">
                    <?php
                    $attribute = array(
                        "name" => "seller_id",
                        "id" => "seller_id"                        
                    );
                    echo form_dropdown('seller_id', $seller_list, '', $attribute);
                    ?>
                </div>                
            </div>
            <div class="form-group col-sm-3">
                <label for="gstin" class="col-sm-4 col-form-label">GSTIN</label>
                <div class="col-sm-8">
                    <?php
                    $attribute = array(
                        "name" => "gstin",
                        "id" => "gstin",
                        "class" => "form-control",                        
                        "type" => "text",
                        "value" => ""
                    );
                    echo form_input($attribute);
                    ?>
                </div>                
            </div>

            <div class="form-group col-sm-3">
                <label for="order_from_year" class="col-sm-4 col-form-label no_rpad">From Date</label>
                <div class="col-sm-4">
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
                    );
                    echo form_dropdown('order_from_year', $years, '0', $attribute);
                    ?>
                </div>
                <div class="col-sm-4">
                    <?php
                    $attribute = array(
                        "name" => "order_from_month",
                        "id" => "order_from_month",
                        "class" => "form-control",
                        "style" => 'display:none'
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
            </div>
            <div class="form-group col-sm-3" id="to_date_filter"  style = 'display:none'>
                <label for="order_to_year" class="col-sm-4 col-form-label">To Date</label>
                <div class="col-sm-4">
                    <?php
                    $attribute = array(
                        "name" => "order_to_year",
                        "id" => "order_to_year",
                        "class" => "form-control"
                    );
                    echo form_dropdown('order_to_year', $years, '0', $attribute);
                    ?>
                </div>
                <div class="col-sm-4">
                    <?php
                    $attribute = array(
                        "name" => "order_to_month",
                        "id" => "order_to_month",
                        "class" => "form-control",
                        "style" => 'display:none'
                    );
                    echo form_dropdown('order_to_month', $month, '0', $attribute);
                    ?>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix" style="display: none;">
            <span><a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right" id="search_report">Search</a></span>
            <spa><a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right marginR10" id="clear_search">Clear</a></span>
        </div>
        <!-- /.box-footer -->
    </div>
</div>
<?php echo form_close()?>
<div class="row-fluid">
    <div class="col-sm-12 no_pad table-responsive" id="dyna_datatable"></div>
</div>
<script type="text/javascript">

    $(function ($) {

        $("#seller_id").chosen({
            no_results_text: "Oops, nothing found!",
            placeholder_text_single:"Select Seller",
            inherit_select_classes:true,
            width: '100%'
        });

        function get_dynamic_dt(param) {

            var promise = new Promise(function (resolve, reject) {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('seller-gst-report-grid') ?>",
                    data: param,
                    dataType: 'html',
                    success: function (data) {
                        resolve(data);
                    },
                    error: function (reason) {
                        reject(reason);
                    }
                });
            });
            promise.then(function (resolve) {
                $('#dyna_datatable').html(resolve);
            }, function (reason) {
                console.log('error', reason);

            });
        }
        //export raw data as excel 
        get_dynamic_dt();
        $(document).on('click', '#export_table_xls', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'xlsx',
                custom_search: custom_search_filter()
            };
            console.log('param', param);
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
        //export raw data as csv 

        $(document).on('click', '#export_table_csv', function (e) {
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
        // get_dynamic_dt();
        $('#search_report').on('click', function (e) {
            e.preventDefault();
            var param = {
                custom_search: custom_search_filter()
            };
            get_dynamic_dt(param);
        });

        $('#clear_search').on('click', function (e) {
            e.preventDefault();
            $('#search_filters')[0].reset();

            get_dynamic_dt();
        });

        var minY = '<?= $minYear ?>';
        var maxY = '<?= $maxYear ?>';
        var minM = '<?= $minMonth ?>';
        var maxM = '<?= $maxMonth ?>';
        
        var maxLastM=maxM-1;
        if(maxM==1 || maxM==01){
            maxLastM=12;
        }
        
        var years =<?= json_encode($years) ?>;

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
                $('#order_to_year option').remove();
                for (var yr in years) {
                    if (years[yr] >= selectedYear) {
                        $('#order_to_year').append($("<option></option>").attr("value", yr).text(years[yr]));
                    }
                }
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
            $('#to_date_filter').hide();
            var month = $(this).val();
            if (month != 0) {
                $('#to_date_filter').show();
            }

        });

        $(document).on('change', '#order_to_year', function () {
            var selectedYear = $(this).val();

            if (selectedYear == 0) {
                $('#order_to_month').hide();
            } else {
                $('#order_to_month option:gt(0)').remove();
                var fromYear = $('#order_from_year').val();
                var fromMonth = $('#order_from_month').val();
                if (parseInt(fromYear) == parseInt(selectedYear)) {
                    console.log(parseInt(fromYear),' == ',parseInt(selectedYear));
                    var fromMinM = parseInt(fromMonth);
                    var fromMaxM = parseInt($('#order_from_month option:last-child').val());
                    console.log('month >= minM',fromMinM ,'>=', fromMaxM);
                    for (var month in months) {
                        console.log('month',month);
                        if (month >= fromMinM && month <= fromMaxM) {
                            $('#order_to_month').append($("<option></option>").attr("value", month).text(months[month]));
                        }
                    }
                }
                else if (selectedYear == minY) {
                    console.log('selectedYear == minY',selectedYear ,'==', minY);
                    minM = parseInt(minM);
                    for (var month in months) {
                        if (month >= minM) {
                            $('#order_to_month').append($("<option></option>").attr("value", month).text(months[month]));
                        }
                    }
                } else if (selectedYear == maxY) {
                    console.log('selectedYear == maxY',selectedYear ,'==', maxY);
                    maxM = parseInt(maxM);
                    for (var month in months) {
                        if (month < maxM) {
                            $('#order_to_month').append($("<option></option>").attr("value", month).text(months[month]));
                        }
                    }
                } else {
                    console.log('else');
                    for (var month in months) {
                        $('#order_to_month').append($("<option></option>").attr("value", month).text(months[month]));
                    }
                }
                $('#order_to_month').show();
            }
        });

        function custom_search_filter() {
            var filter = {};
            var seller_id = $('#seller_id').val();
            var gstin = $('#gstin').val();
            var from_year = $('#order_from_year').val();
            var from_month = $('#order_from_month').val();
            var to_year = $('#order_to_year').val();
            var to_month = $('#order_to_month').val();

            if (seller_id != '' && seller_id != '0') {
                filter['seller_id'] = $('#seller_id').val();
            }
            if (gstin != '' && gstin != '0') {
                filter['gstin'] = $('#gstin').val();
            }
            if (from_year != "0") {
                filter['from_year'] = $('#order_from_year').val();
            }
            if (from_month != "0") {
                filter['from_month'] = $('#order_from_month').val();
            }
            if (to_year != "0") {
                filter['to_year'] = $('#order_to_year').val();
            }
            if (to_month != "0") {
                filter['to_month'] = $('#order_to_month').val();
            }
            return filter;
        }

    });
</script>