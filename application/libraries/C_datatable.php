<?php

//reference site:-http://legacy.datatables.net/usage/columns

class C_datatable
{

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_initiate_dt_configs();
    }

    //hold CI object
    private $_ci;
    private $_dt_id = '';
    private $_dt_obj = '';
    //all datatable options
    private $_dt_options = array();
    //hold initial dt config
    private $_dt_configs = array();
    //datatable code
    private $_dt_code = '';
    //markup
    private $_markup = '';
    //script
    private $_after_dt_script = '';
    //javascript code
    private $_script_template = '<script type="text/javascript">
                    $(document).ready(function(){
                        "__js_script_code__"
                    });                
                </script>';

    /**
     * Datatable Constructor
     */
    private $_dt_constructor = '
        "__dt_object__" = $(\'#"__dt_selector__"\').DataTable({
            "__dt_options__"
        }); ';

    /**
     * Datatable sleep
     */
    private $_dt_sleep = '
        setTimeout(function () {
            "__dt_codes__"
        }, "__dt_interval__");';
    /*     * ****Datatable Constructor***** */

    /**
     * Call backs
     */
    //fnCreatedRow
    private $_callbacks_template = array(
        'fnCreatedRow' => '"fnCreatedRow": function (nRow, aData, iDataIndex) {
            "__replace_callback_code__"
        }',
        'fnDrawCallback' => '"fnDrawCallback": function (oSettings) {
            "__replace_callback_code__"
        }',
        'fnInitComplete' => '"fnInitComplete": function (settings, json) {
            "__replace_callback_code__"
        }',
        'fnRowCallback' => '"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            "__replace_callback_code__"
        }',
        'fnServerData' => '"fnServerData": function (sSource, aoData, fnCallback, oSettings) {
            "__replace_callback_code__"
        }',
        'fnServerParams' => '"fnServerParams": function (aoData) {
            "__replace_callback_code__"
        }',
        'drawCallback' => '"drawCallback": function (settings) {
            "__replace_callback_code__"
        }'
    );

    /**
     * End Call backs
     */

    /**
     * Buttons
     */
    //default buttons
    private $_buttons = array(
        'text' => 'My button',
        'className' => 'btn btn-primary',
        'action' => 'function (e, dt, node, config) {
		alert(\'Button activated\');
	}'
    );
    private $_dom_buttons = '';

    /**
     * End Buttons
     */
    //default dom declaration. <"col-md-3" B>
    //top row- length change button hold filter
    //buttom row- length change blank div pagination
    private $_dom = '<<"row-fluid no-pad" 
                <"col-md-2 no-pad" l>                
                <"col-md-10 no-pad" 
                    <"col-md-12 no-pad"                            
                        <"pull-right" f>
                        <"dt_button pull-right">
                    >
                >
            ><t>
            <"row-fluid no-pad marginT10"
                <"col-md-2 no-pad" l>                
                <"col-md-10 no-pad" 
                    <"col-md-12 no-pad"                            
                        <"pull-right" p>
                        <"dt_buttom_info pull-right">
                    >
                >
            >';
    private $_loading_markup = '';

    private function _set_loading_markup()
    {
        if ($this->_dt_configs['show_loading'])
        {
            $this->_loading_markup = "<div class='loading-box' id='" . $this->_dt_id . "_loading' style='display: none;'>
                                        <p class='h1'><i class='fa fa-refresh fa-spin text-aqua'></i></p>
                                    </div>";
        }
    }

    private function _set_commin_js_vars()
    {
        $this->_dt_id = $this->_dt_configs['dt_id'];
        $this->_dt_obj = $this->_dt_configs['dt_id'] . '_obj';
    }

    //initiate datatable default options
    private function _initiate_dt_options()
    {
        //all datatable options
        $this->_dt_options = array(
            'columns' => array(),
            'bPaginate' => 'true',
            'bAutoWidth' => 'false',
            'bDeferRender' => 'true',
            'bFilter' => 'false',
            'bLengthChange' => 'true',
            'bInfo' => 'false',
            'bSort' => 'true',
            'bSortClasses' => 'false',
            'bProcessing' => 'true',
            'bServerSide' => 'true',
            'scrollY' => false,
            'sScrollX' => false,
            'bScrollCollapse' => false,
            'bSortCellsTop' => 'true',
            'iDisplayLength' => 15,
            'iDisplayStart' => 0,
            'sScrollXInner' => false,
            'searching' => 'true',
            'lengthMenu' => array(15, 30, 60, 100),
            //'destroy'=> 'true',
            'order' => array(
                array(
                    'column' => 0,
                    'order' => 'asc'
                )
            ),
            'dom' => $this->_dom,
            'language' => array(
                'sZeroRecords' => "<div class='text-center'>" . $this->_ci->lang->line('DT_NO_RESULT_FOUND') . "</div>",
                'sEmptyTable' => "<div class='text-center'>" . $this->_ci->lang->line('DT_NO_RESULT_FOUND') . "</div>",
                'sProcessing' => "<div class='text-center'>" . $this->_ci->lang->line('DT_LOADING') . "</div>",
                'sLengthMenu' => $this->_ci->lang->line("DT_SHOW") . " _MENU_ " . $this->_ci->lang->line("DT_ENTRY"),
                //"sSearch" => $this->_ci->lang->line("DT_SEARCH"),
                "search" => "_INPUT_",
                "searchPlaceholder" => "Search",//$this->_ci->lang->line("DT_SEARCH"),                
                'oPaginate' => array(
                    'sFirst' => $this->_ci->lang->line("DT_FIRST"),
                    'sPrevious' => $this->_ci->lang->line("DT_PREV"),
                    'sNext' => $this->_ci->lang->line("DT_NEXT"),
                    'sLast' => $this->_ci->lang->line("DT_LAST")
                )
            )
        );
    }

    //prepare default configs
    private function _initiate_dt_configs()
    {
        $this->_initiate_dt_options();
        $this->_dt_configs = array(
            'dt_id' => 'custom_table',
            'dt_class' => 'table table-sm table-striped table-bordered',
            'dt_attr' => 'cellpadding="0" cellpadding="0"',
            /*
             * dt_header=>
             * array(
             *      'db_column'=> 'CUID',
             *      'title'=> "name",
             *      'className'=> 'filter_grid_name',
             *      'orderable'=> false,
             *      'visible'=> true,
             *      'targets'=> column_index,
             *      //data is optional
             *      data: function (item) {
             *          return '<a href="#" data-filter-id="' + item.FILTER_ID + '" class="rev_orange_link load_table_filter">' + item.FILTER_TITLE + '</a>';
             *      }
             * )
             */
            'dt_header' => array(),
            /**
             * prepare header that will display before the
             * actual header.
             * dt_extra_header=>array(
              'markup'=>array(
             *      'title'=> "name",
             *      'className'=> 'filter_grid_name',
             *      'colspan=>"2",      
             *      )
             * )
             */
            'dt_extra_header' => array('markup' => ''), //to populate colspan extra header
            'custom_lengh_change' => false,
            'dt_post_data' => '',
            'dt_ajax' => array(
                'dt_url' => '',
                'dt_request_type' => 'POST',
                'dt_response_type' => 'JSON',
                'dt_param' => 'function(d) {
                                return $.extend({}, d, {
                                    "__dt_ajax_post_data__"
                                });
                            }',
                'before_send' => '',
                'complete' => ''
            ),
            'options' => $this->_dt_options,
            'callbacks' => false,
            'show_loading' => true,
            'dt_sleep' => false
        );
    }

    //get array index value
    private function _get_dt_config_value($key)
    {

        if (array_key_exists($key, $this->_dt_configs))
        {
            return $this->_dt_configs[$key];
        }
        return '';
    }

    //get call back template
    private function _get_callback_template($template)
    {
        if (array_key_exists($template, $this->_callbacks_template))
        {
            return $this->_callbacks_template[$template];
        }
        return false;
    }

    //prepare datatable options
    private function _prepare_dt_options($config)
    {
        //merge custom configs
        $this->_dt_configs = assoc_array_merge($this->_dt_configs, $config);
        //pma($this->_dt_configs, 1);
        $this->_set_commin_js_vars();
        $this->_set_dt_dom();
        $this->_set_dt_columns();
        $this->_set_dt_ajax();
        return $this;
    }

    //prepare datatable colum defination
    private function _set_dt_columns()
    {
        $columns = '';
        if (isset($this->_dt_configs['dt_header']) && is_array($this->_dt_configs['dt_header']))
        {
            $columns .= '[';
            foreach ($this->_dt_configs['dt_header'] as $indx => $cols)
            {

                $title = (isset($cols['title'])) ? $cols['title'] : '';
                $name = (isset($cols['name'])) ? $cols['name'] : $cols['db_column'];
                $class_name = (isset($cols['class_name'])) ? $cols['class_name'] : '';
                $orderable = (isset($cols['orderable'])) ? $cols['orderable'] : '';
                $targets = (isset($cols['targets'])) ? $cols['targets'] : $indx;
                $searchable = (isset($cols['searchable'])) ? $cols['searchable'] : 'false';


                $columns .= '{';
                $columns .= 'title:"' . $title . '",';
                $columns .= 'name:"' . $name . '",';
                $columns .= 'className:"' . $class_name . '",';
                $columns .= 'orderable:' . $orderable . ',';
                $columns .= 'targets:"' . $targets . '",';
                $columns .= 'searchable:' . $searchable . ',';

                if (isset($cols['render']))
                {
                    $columns .= 'render:' . $cols['render'] . ',';
                }

                if (isset($cols['data']))
                {
                    $columns .= 'data:' . $cols['data'] . '';
                    //$columns.='data:function (item) {return \'<a href="#" data-filter-id="\' + item.FILTER_ID + \'" class="rev_orange_link load_table_filter">\' + item.FILTER_TITLE + \'</a>\';}';
                } else
                {
                    //$columns.='data:function(item) {
                    //                return item.' . $cols['db_column'] . ';
                    //               }';
                }
                $columns .= '},';
            }
            $columns = substr($columns, 0, -1);
            $columns .= ']';
            $this->_dt_configs['options']['columns'] = $columns;
        }
    }

    //prepare dt_dom
    private function _prepare_dt_dom($dt_dom)
    {
        if (is_array($dt_dom))
        {
            if ((!isset($dt_dom['top_dom']) || !$dt_dom['top_dom']) && (!isset($dt_dom['buttom_dom']) || !$dt_dom['buttom_dom']))
            {
                return '';
            }

            $dom = '<';
            if (isset($dt_dom['top_dom']) && $dt_dom['top_dom'])
            {
                $dom .= '<"row-fluid no-pad"';
                //set length change
                if (isset($dt_dom['top_length_change']) && $dt_dom['top_length_change'])
                {
                    $dom .= ' <"dt-length-change col-md-2 no-pad" l>';
                } else
                {
                    $dom .= ' <"dt-length-change col-md-2 no-pad">';
                }
                $dom .= ' <"col-md-10 no-pad" <"col-md-12 no-pad"';

                //set top filter
                if (isset($dt_dom['top_pagination']) && $dt_dom['top_pagination'])
                {
                    $dom .= ' <"pull-right pagination_holder" p>';
                }
                //set top filter
                if (isset($dt_dom['top_filter']) && $dt_dom['top_filter'])
                {
                    $dom .= ' <"pull-left" f>';
                }

                //set top buttons
                if (isset($dt_dom['top_buttons']) && $dt_dom['top_buttons'])
                {
                    $dom .= ' <"' . $this->_dt_id . '_dt_button pull-right marginR5">';
                    $this->_dom_buttons = $dt_dom['top_buttons'];
                }

                $dom .= '>><t>';
            }

            if (isset($dt_dom['buttom_dom']) && ($dt_dom['buttom_dom']===true || $dt_dom['buttom_dom']===TRUE))
            {
                //set buttom options
                $dom .= ' <"row-fluid no-pad marginT10"';
                //set length change
                if (isset($dt_dom['buttom_length_change']) && ($dt_dom['buttom_length_change']===true || $dt_dom['buttom_length_change']===TRUE))
                {
                    $dom .= ' <"col-md-2 no-pad" l>';
                } else
                {
                    $dom .= ' <"col-md-2 no-pad">';
                }
                $dom .= ' <"col-md-10 no-pad" <"col-md-12 no-pad"';

                //set top filter
                if (isset($dt_dom['buttom_pagination']) && ($dt_dom['buttom_pagination']===true || $dt_dom['buttom_pagination']===TRUE))
                {
                    $dom .= ' <"pull-right" p>';
                }
                //set top filter
                if (isset($dt_dom['buttom_filter']) && ($dt_dom['buttom_filter']===true || $dt_dom['buttom_filter']===TRUE))
                {
                    $dom .= ' <"pull-right" f>';
                }
                //set top buttons
                if (isset($dt_dom['buttom_info']))
                {
                    $dom .= ' <"dt_buttom_info pull-right">';
                }

                $dom .= '>>';
            }

            $dom .= '>'; //end dom            

            $dt_dom = $dom;
        }
        return $dt_dom;
    }

    //set datatable dom
    private function _set_dt_dom()
    {
        $dt_dom = $this->_get_dt_config_value('dt_dom');
        if ($dt_dom)
        {
            $this->_dt_configs['options']['dom'] = $this->_prepare_dt_dom($dt_dom);
        } else
        {
            if (isset($this->_dt_configs['options']['dom']))
            {
                $this->_dt_configs['options']['dom'] = str_replace(array("\n", "\r"), '', $this->_dt_configs['options']['dom']);
            }
        }
    }

    private function _set_dt_buttons()
    {
        $append_buttons = '';
        if ($this->_dom_buttons)
        {
            $append_buttons = 'if ($.fn.DataTable.isDataTable($(\'#' . $this->_dt_id . '\'))) {
                        if (typeof ' . $this->_dt_obj . ' != \'undefined\') {
                            $(".' . $this->_dt_id . '_dt_button").append(\'' . $this->_dom_buttons . '\');
                        }
                    }' . PHP_EOL;
        }
        return $append_buttons;
    }

    //prepare dt ajax
    private function _set_dt_ajax()
    {
        if (isset($this->_dt_configs['dt_ajax']))
        {

            $this->_dt_configs['dt_ajax']['dt_param'] = preg_replace('/\"__dt_ajax_post_data__\"/', $this->_dt_configs['dt_post_data'], $this->_dt_configs['dt_ajax']['dt_param']);
            //set loading option 
            $show_loading = $hide_loading = '';
            if ($this->_dt_configs['show_loading'] == true)
            {
                $show_loading = 'jQuery("#' . $this->_dt_id . '_loading").css("display", "block");';
                $hide_loading = 'jQuery("#' . $this->_dt_id . '_loading").css("display", "none");';
            }

            $ajax = '{';
            $ajax .= '"beforeSend":function(){' . $show_loading . PHP_EOL . $this->_dt_configs['dt_ajax']['before_send'] . '},';
            $ajax .= '"complete":function(){' . $hide_loading . PHP_EOL . $this->_dt_configs['dt_ajax']['complete'] . '},';
            if (!isset($this->_dt_configs['dt_ajax']['async']))
            {
                $this->_dt_configs['dt_ajax']['async'] = 'true';
            }
            $ajax .= '"async":"' . $this->_dt_configs['dt_ajax']['async'] . '",';
            $ajax .= '"url":"' . $this->_dt_configs['dt_ajax']['dt_url'] . '",';
            $ajax .= '"type":"' . $this->_dt_configs['dt_ajax']['dt_request_type'] . '",';
            $ajax .= '"dataType":"' . $this->_dt_configs['dt_ajax']['dt_response_type'] . '",';
            $ajax .= '"data":' . $this->_dt_configs['dt_ajax']['dt_param'];
            $ajax .= '}';
            $this->_dt_configs['options']['ajax'] = $ajax;
            //$this->_dt_configs['options']['sAjaxSource'] = $this->_dt_configs['dt_ajax']['dt_url'];
            //$this->_dt_configs['options']['sServerMethod'] ='POST';
        }
    }

    //prepare dt code from dt options and also apply dt callbacks
    private function _prepare_dt_code()
    {
        $this->_dt_code = '';
        foreach ($this->_dt_configs['options'] as $opt => $val)
        {
            if (is_array($val))
            {
                if ($opt == 'order')
                {
                    if (is_array($val))
                    {
                        $order = '';
                        foreach ($val as $col_order)
                        {
                            $order .= '[' . $col_order['column'] . ',"' . $col_order['order'] . '"],';
                        }
                        $order = substr($order, 0, strlen($order) - 1);
                        $order = '"order":[' . $order . ']';
                        $this->_dt_code .= $order . ",";
                    }
                } else
                {
                    $this->_dt_code .= "'$opt':" . json_encode($val) . ",";
                }
            } else
            {
                $char = substr($val, 0, 1);
                if (in_array($char, array('{', '[')))
                {
                    $this->_dt_code .= "'$opt':" . "$val,";
                } else
                {
                    if ($val == 'true' || $val == 'false' || is_int($val))
                    {
                        $this->_dt_code .= "'$opt':" . "$val,";
                    } else
                    {
                        $this->_dt_code .= "'$opt':" . "'$val',";
                    }
                }
            }
        }
        $this->_applay_callbacks();
        //pma($this->_dt_code,1);
        return $this;
    }

    //Applay datatable callback methods
    private function _applay_callbacks()
    {
        if (is_array($this->_dt_configs['callbacks']))
        {
            foreach ($this->_dt_configs['callbacks'] as $callback_name => $code)
            {
                $template = $this->_get_callback_template($callback_name);
                if ($template)
                {
                    switch ($callback_name)
                    {
                        case 'fnCreatedRow':

                        case 'fnDrawCallback':

                        case 'fnInitComplete':

                        case 'fnRowCallback':

                        case 'fnServerData':

                        case 'drawCallback':

                        case 'fnServerParams':
                            $this->_dt_code .= preg_replace('/\"__replace_callback_code__\"/', $code, $template);
                            break;
                        default:
                            break;
                    }
                }
            }
        }
    }

    //prepare html table markup
    private function _set_table_markup()
    {
        $table_markup = $this->_get_dt_config_value('dt_markup');
        $table = $table_markup;
        if ($table_markup == TRUE || $table_markup == true || $table_markup == 1)
        {
            $table = '<table ';
            $table .= ' id="' . $this->_dt_id . '"';
            $table .= ' class="' . $this->_get_dt_config_value('dt_class') . '"';
            $table .= $this->_get_dt_config_value('dt_attr');
            $table .= '>';
            $table .= '</table>';
        }
        $this->_dt_configs['dt_markup'] = $table;
        $this->_dt_code = $table . $this->_dt_code;
        return $this;
    }

    private function _set_custom_datalength_change()
    {
        if ($this->_dt_configs['custom_lengh_change'])
        {
            $markup = 'var ' . $this->_dt_id . '_inlie_form_length_change = \'<div class="dataTables_length custom_dataTables_length"><label>\'
                    + \'<span>' . $this->_ci->lang->line("DT_ITEM_PAGE") . '</span>\'
                    + \'<div>\'
                    + \' <div class="input-group input-group-sm" style="max-width:80px;">\'
                    + \'  <input class="form-control ' . $this->_dt_id . '_length_change_number" min="1" type="text" value="' . $this->_dt_configs['options']['iDisplayLength'] . '" style="min-width:43px;">\'
                    + \'      <span class="input-group-btn">\'
                    + \'        <button type="button" class="btn btn-default btn-flat ' . $this->_dt_id . '_length_change_form_button btn-wrapper" style="padding:0px 7px;">' . $this->_ci->lang->line("DT_GO") . '</button>\'
                    + \'      </span>\'
                    + \' </div>\'
                    + \'</div>\'
                    + \'</label></div>\';' . PHP_EOL;
            //All button markup
            $markup .= 'var ' . $this->_dt_id . '_inlie_form_length_change_all = \'<button type="button" class="btn btn-default btn-sm btn_length_change_all ' . $this->_dt_id . '_length_change_form_button_all btn-wrapper">' . $this->_ci->lang->line("DT_All") . '</button>\';' . PHP_EOL;

            $append_markup = 'if ($.fn.DataTable.isDataTable($(\'#' . $this->_dt_id . '\'))) {
                        if (typeof ' . $this->_dt_obj . ' != \'undefined\') {
                            $(".custom_length_box").append(' . $this->_dt_id . '_inlie_form_length_change);
                            $(".custom_length_box_all").append(' . $this->_dt_id . '_inlie_form_length_change_all);
                        }
                    }' . PHP_EOL;
            $js_opt_code = '$(document).on("click", ".' . $this->_dt_id . '_length_change_form_button", function () {
                                var jump_number = parseInt($(this).closest("div").find("input.' . $this->_dt_id . '_length_change_number").val(), 10);
                                if (!isNaN(jump_number)) {
                                    ' . $this->_dt_obj . '.page.len(jump_number).draw();
                                }
                            }).on("input", ".' . $this->_dt_id . '_length_change_number", function () {
                                var inp_val = parseInt($(this).val(), 10);
                                if (isNaN(inp_val)) {
                                    $(this).val(\'\');
                                } else {
                                    if (inp_val > parseInt($(this).attr("max"), 10)) {
                                        $(this).val(parseInt($(this).attr("max"), 10));
                                    } else {
                                        if (inp_val < parseInt($(this).attr("min"), 10)) {
                                            $(this).val(parseInt($(this).attr("min"), 10));
                                        }
                                    }
                                }
                            });
                            //block alphabet input in goto input box
                            $(document).on(\'keydown\', \'.' . $this->_dt_id . '_length_change_number\', function (event) {
                                // Allow only backspace and delete
                                if (event.keyCode == 46 || event.keyCode == 8) {
                                    // let it happen, don\'t do anything
                                } else if (event.keyCode == 13) {
                                    $(this).closest(\'div.input-group\').find(\'.' . $this->_dt_id . '_length_change_form_button\').trigger(\'click\');
                                } else {
                                    // Ensure that it is a number and stop the keypress
                                    if (event.keyCode < 48 || event.keyCode > 57) {
                                        event.preventDefault();
                                    }
                                }
                            });' . PHP_EOL;
            //all button code 
            $js_opt_code .= '$(document).on("click", ".' . $this->_dt_id . '_length_change_form_button_all", function () {
                                ' . $this->_dt_obj . '.page.len(-1).draw();                                
                             });';
            return $markup . $append_markup . $js_opt_code;
        }
        return '';
    }

    //prepare extra dt header
    private function _prepare_dt_extra_header()
    {

        $extra_header = $this->_dt_configs['dt_extra_header'];

        if (is_string($extra_header) && strlen(trim($extra_header) > 1))
        {
            //TODO::now showing error if we pass string
            $this->_after_dt_script = '';
            $this->_after_dt_script .= $this->_dt_configs['dt_extra_header'];
        } else if (is_array($extra_header) && count($extra_header) > 0)
        {
            $markup = '';
            $dt_head = $this->_dt_configs['dt_extra_header'];
            if (isset($dt_head['markup']))
            {
                if (is_string($dt_head['markup']))
                {
                    $markup = $dt_head['markup'];
                } else if (is_array($dt_head['markup']))
                {
                    foreach ($dt_head['markup'] as $rows)
                    {
                        $markup .= '<tr>';
                        foreach ($rows as $ths)
                        {
                            $markup .= '<th ';
                            $text = '';
                            foreach ($ths as $att => $val)
                            {
                                if ($att == 'title')
                                {
                                    $text = $val;
                                } else
                                {
                                    $markup .= $att . "='" . $val . "' ";
                                }
                            }
                            $markup .= '>';
                            $markup .= $text;
                            $markup .= '</th>';
                        }
                        $markup .= '</tr>';
                    }
                }
            }
            //pma($markup,1);
            $this->_after_dt_script .= 'var ' . $this->_dt_id . '_extra_head="' . $markup . '"; ';
            $this->_after_dt_script .= "$('." . $this->_dt_id . "_table_cont').find('div.dataTables_scrollHeadInner').find('table').find('thead').prepend(" . $this->_dt_id . "_extra_head);";
            //$this->_after_dt_script.="$('." . $this->_dt_id . "').DataTable().clear()";
        }
        return $this->_after_dt_script;
    }

    //Applay datatable method
    private function _applay_datatable()
    {
        //selector place
        $datatable = preg_replace('/\"__dt_selector__\"/', $this->_dt_id, $this->_dt_constructor);
        //object place
        $datatable = preg_replace('/\"__dt_object__\"/', 'var ' . $this->_dt_obj, $datatable);
        //code place
        $this->_dt_code = preg_replace('/\"__dt_options__\"/', $this->_dt_code, $datatable);
        //pma($this->_dt_code, 1);
        return $this;
    }

//Applay datatable method
    private function _applay_sleep()
    {
        if ($this->_dt_configs['dt_sleep'] > -1)
        {
            //applay interval 
            $datatable = preg_replace('/\"__dt_codes__\"/', $this->_dt_code, $this->_dt_sleep);
            $this->_dt_code = preg_replace('/\"__dt_interval__\"/', $this->_dt_configs['dt_sleep'], $datatable);
        }
        return $this;
    }

    //applay extra code after dt function
    private function _applay_extra_code()
    {
        $this->_dt_code .= $this->_prepare_dt_extra_header();
        if (isset($this->_dt_configs['extra_js_code']))
        {
            $this->_dt_code .= $this->_dt_configs['extra_js_code'];
        }
        $this->_dt_code .= $this->_set_custom_datalength_change();
        $this->_dt_code .= $this->_set_dt_buttons();
        $this->_dt_code .= ' window.win_' . $this->_dt_obj . '=' . $this->_dt_obj . ';';
        $this->_dt_code .=" $('.dataTables_filter input').addClass('search_box_dt_cls');";
        $this->_dt_code .=" $('.dataTables_length select').addClass('chosen-dt-length-select');";
        $this->_dt_code .="$('.chosen-dt-length-select').chosen({allow_single_deselect: true,disable_search:true,width:50});";        
        return $this;
    }

    //Applay script tag
    private function _applay_script()
    {
        //code place
        $this->_dt_code = preg_replace('/\"__js_script_code__\"/', $this->_dt_code, $this->_script_template);
        //pma($this->_dt_code,1);
        return $this;
    }

    //generate datatable
    public function generate_grid($config)
    {
        //pma($config,1);
        $this
                ->_reset()
                ->_prepare_dt_options($config)
                ->_prepare_dt_code()
                ->_applay_datatable()
                ->_applay_extra_code()
                ->_applay_sleep()
                ->_applay_script()
                ->_set_table_markup()
                ->_set_loading_markup();
        //return $this->_dt_code;
        return '<div class="' . $this->_dt_id . '_table_cont">' . $this->_loading_markup . $this->_dt_code . '</div>';
    }

    /**
     * @param  : 
     * @desc   : reset all variable in case of multi calling of generate_grid()
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _reset()
    {
        $this->_initiate_dt_configs();
        $this->_after_dt_script = $this->_dt_code = $this->_loading_markup = $this->_dt_id = '';
        return $this;
    }

}
