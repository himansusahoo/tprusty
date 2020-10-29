<?php
echo get_loading_template('execute_form_loading');
?>
<div class="row">
    <div class="col">
        <textarea id="q" rows="100" cols="50" class="form-control" style="height:200px; padding: 0px !important; text-indent: 0px;">
    
        </textarea>

    </div>
</div>
<div class="row">
    <div class="col">
        <button id="execute" class="btn btn-primary float-right">Execute</button>    
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card direct-chat direct-chat-primary collapsed-card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">Result</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">      
                <pre>
                <div class="col result_body"></div>
                </pre>
            </div>            
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#execute').on('click', function () {
            var query = $('#q').val();
            console.log(query);
            $.ajax({
                type: "POST",
                url: base_url + 'test_hmvc/qtest',
                data: {q: query},
                beforeSend: function () {
                    $('#execute_form_loading').show();
                },
                success: function (data) {
                    $('#execute_form_loading').hide();
                    var sdata = JSON.parse(data);
                    var sdata = JSON.stringify(sdata, null, "\t");
                    $('.result_body').html(sdata);
                },
                error: function (error) {
                    $('#execute_form_loading').hide();
                    reject(error);
                }
            });
        });

    });
</script>
