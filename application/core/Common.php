<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Commonn place to define all generic/common methods
 */
if (!function_exists('found_rows')) {

    /**
     * @param	NA
     * @return	int $count
     * @desc        count the no of rows, fetched by last database query
     */
    function found_rows() {
        $CI = & get_instance();
        $res = $CI->db->query('SELECT FOUND_ROWS() AS count')->result_array();
        return $res[0]['count'];
    }

}

if (!function_exists('flattenArray')) {

    /**
     * @method: flattenArray
     * @param	array	$array	Array to be flattened
     * @return	array	Flattened array
     * @desc Convert a multi-dimensional array to a simple 1-dimensional array
     * @note in case of useing $callback, used only single parameterisez callable functions
     * @TODO Need to make support recursive
     */
    function flattenArray($array, $callback = null, $group_function = null, $check_blank = null) {
        if (!is_array($array)) {
            return (array) $array;
        }

        $arrayValues = array();
        foreach ($array as $value) {
            if (is_array($value)) {
                foreach ($value as $val) {
                    if (is_array($val)) {
                        foreach ($val as $v) {
                            if ($check_blank) {
                                if ($v)
                                    $arrayValues[] = is_fun_callable($callback, $v);
                            }else {
                                $arrayValues[] = is_fun_callable($callback, $v);
                            }
                        }
                    } else {
                        if ($check_blank) {
                            if ($val)
                                $arrayValues[] = is_fun_callable($callback, $val);
                        }else {
                            $arrayValues[] = is_fun_callable($callback, $val);
                        }
                    }
                }
            } else {
                if ($check_blank) {
                    if ($value)
                        $arrayValues[] = is_fun_callable($callback, $value);
                }else {
                    $arrayValues[] = is_fun_callable($callback, $value);
                }
            }
        }
        if ($group_function) {
            return is_fun_callable($group_function, $arrayValues);
        }
        return $arrayValues;
    }

}

if (!function_exists('is_fun_callable')) {

    /**
     * @method: is_fun_callable
     * @param	string/array core function/user defined function/array of both type function
     * @return	formated value
     * @desc format as per the call back function passed
     */
    function is_fun_callable($callable_fun, $value) {

        if (is_callable($callable_fun)) {
            return $callable_fun($value);
        } else if (is_array($callable_fun)) {
            $res = $value;
            foreach ($callable_fun as $fun) {
                if (is_callable($fun)) {
                    $res = $fun($res);
                }
            }
            return $res;
        }
        return $value;
    }

}

if (!function_exists('pma')) {

    /**
     * @method: is_fun_callable
     * @param	string/array core function/user defined function/array of both type function
     * @return	formated value
     * @desc format as per the call back function passed
     */
    function pma($arr_val, $exit_flag = 0) {
        echo '<pre>';
        if (is_array($arr_val)) {
            print_r($arr_val);
        } else if (is_object($arr_val)) {
            var_dump($arr_val);
        } else {
            echo $arr_val;
        }
        echo '</pre>';
        if ($exit_flag) {
            exit('Exited here..');
        }
    }

}


/**
 * Declare the global methods and variable, which are be visible through out the application
 */
/**
 * Builds a file path with the appropriate directory separator.
 * @param string $segments,... unlimited number of path segments
 * @return string Path

  function file_build_path(...$segments) {
  return join(DIRECTORY_SEPARATOR, $segments);
  } */
if (!function_exists('app_log')) {

    /**
     * Error Logging Interface
     *
     * We use this as a simple mechanism to access the logging
     * class and send messages to be logged.
     *
     * @param	string	the error level: 'db' or 'smis'
     * @param	string	the error category
     * @desc	log script logs into file
     */
    function app_log($level, $category, $format /* , ... */) {
        static $_log;
        if (C_DEBUG != '0' && DEBUG_SCRIPT != '0' && CUSTOM_APP_LOG !== '0') {
            //get the called args
            $args = func_get_args();
            //pop off the 2 knowns
            array_shift($args);
            array_shift($args);

            if (CUSTOM_APP_LOG === 1 || strpos($category, CUSTOM_APP_LOG) === 0) {
                if ($_log === NULL) {
                    // references cannot be directly assigned to static variables, so we use an array
                    $_log[0] = & load_class('Log', 'core');
                }
                $message = vsprintf($format, $args);
                $_log[0]->write_log($level, $message);
            }
        }
    }

}

if (!function_exists('query_log')) {

    /**
     * Error Logging Interface
     *
     * We use this as a simple mechanism to access the logging
     * class and send messages to be logged.
     *
     * @param	string	the error level: 'db'     
     * @desc	log mysql queries in to log file
     */
    function query_log($level = 'db') {
        if (C_DEBUG != '0') {
            static $_log;
            if ($_log === NULL) {
                // references cannot be directly assigned to static variables, so we use an array
                $_log[0] = & load_class('Log', 'core');
            }
            $CI = & get_instance();
            // Get execution time of all the queries executed by controller
            $times = $CI->db->query_times;
            foreach ($CI->db->queries as $key => $query) {
                $sql = $query . " \n Execution Time:" . $times[$key];
                $_log[0]->write_log($level, $sql);
            }
        }
    }

}

if (!function_exists('c_encode')) {

    /**
     * @method: c_encode
     * @param	value to be encoded
     * @return	encoded string
     * @desc Encodes the given value
     */
    function c_encode($value) {
        $CI = & get_instance();
        return str_replace('/', '~', $CI->c_encrypt->c_encode($value));
    }

}

if (!function_exists('c_decode')) {

    /**
     * @method: c_decode
     * @param	string to be decoded
     * @return	decoded value
     * @desc Decodes the given string
     */
    function c_decode($value) {
        $CI = & get_instance();
        $value = str_replace('~', '/', $value);
        return $CI->c_encrypt->c_decode($value);
    }

}

if (!function_exists('pma')) {

    /**
     * @method: pma
     * @param	string/array core function/user defined function/array of both type function
     * @return	formated value
     * @desc format as per the call back function passed
     */
    function pma($arr_val, $exit_flag = 0) {
        echo '<pre>';
        if (is_array($arr_val)) {
            print_r($arr_val);
        } else if (is_object($arr_val)) {
            var_dump($arr_val);
        } else {
            echo $arr_val;
        }
        echo '</pre>';
        if ($exit_flag) {
            exit('Exited here..');
        }
    }

}

if (!function_exists('generate_table')) {

    /**
     * @method: generate_table()
     * @param: 	string $attr,array $head,array $data  
     * @desc : generate html table
     */
    function generate_table($attr = null, $head = NUll, $data) {
        $tbl = "";
        $tbl.="<table $attr border='1'>";

        if (is_array($head)) {
            $tbl.="<tr>";
            foreach ($head as $header) {
                $tbl.="<th>$header</th>";
            }
            $tbl.="</tr>";
        }
        foreach ($data as $row) {
            $tbl.="<tr>";
            foreach ($row as $col) {
                $tbl.="<td>$col</td>";
            }
            $tbl.="</tr>";
        }
        $tbl.="</table>";
        return $tbl;
    }

}

if (!function_exists('language_list')) {

    function language_list($type = null) {
        $CI = & get_instance();
        $list = array('english' => 'english', 'french' => 'français');
        $user_lang = '';
        $user_lang = ($CI->session->userdata('user_language')) ? $CI->session->userdata('user_language') : $CI->config->item('language');

        if ($type) {
            $bx = '<li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-language"></i>                        
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">' . $CI->lang->line('select_your_lang') . '</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">';
            foreach ($list as $ky => $val) {
                $selected = '';
                if ($user_lang == $ky) {
                    $selected = 'style="background-color:#e1e3e9"';
                }
                $bx.='<li ' . $selected . '><!-- start message -->
                                    <a href="#" lang_val=' . $ky . ' class="lang_box">
                                        <div class="pull-left">
                                            <i class="fa fa-language"></i>                                            
                                        </div>
                                        <h4>' . $val . '</h4>                                        
                                    </a>
                                </li>';
            }
            $bx.='</ul>
                        </li>                        
                    </ul>
                </li>';
        } else {
            $bx = '<select style="width:120px;" class="form-control" id="lang_box" name="lang_box">';
            array_unshift($list, $CI->lang->line('select_your_lang'));
            foreach ($list as $ky => $val) {
                $selected = '';
                if ($CI->config->item('language') == $ky) {
                    $selected = 'selected="selected"';
                }
                $bx.='<option value="' . $ky . '" ' . $selected . ' >' . $val . '</option>';
            }
            $bx.='</select>';
        }
        return $bx;
    }

}

if (!function_exists('flattenArray')) {

    /**
     * @method: flattenArray
     * @param	array	$array	Array to be flattened
     * @return	array	Flattened array
     * @desc Convert a multi-dimensional array to a simple 1-dimensional array
     */
    function flattenArray($array) {
        if (!is_array($array)) {
            return (array) $array;
        }

        $arrayValues = array();
        foreach ($array as $value) {
            if (is_array($value)) {
                foreach ($value as $val) {
                    if (is_array($val)) {
                        foreach ($val as $v) {
                            $arrayValues[] = $v;
                        }
                    } else {
                        $arrayValues[] = $val;
                    }
                }
            } else {
                $arrayValues[] = $value;
            }
        }

        return $arrayValues;
    }

}

if (!function_exists('get_csv_heading')) {

    /**
     * @param string $file - full path of file including file name
     * @return array of headings
     * @desc return csv file heading - first line of file is treated as heading
     * @author
     */
    function get_csv_heading($file, $delimeter, $seek_line = null) {
        $f = fopen("$file", "r");
        $ln = 0;
        if ($seek_line > 0) {
            for ($i = 1; $i <= $seek_line; $i++) {
                $csv_heading = fgets($f);
            }
        }
        $csv_heading = fgets($f);
        fclose($f);

        $csv_heading = str_replace('"', "", trim(strtolower($csv_heading)));
        $csv_heading = explode($delimeter, $csv_heading);
        $csv_columns = array();
        foreach ($csv_heading as $column) {
            if ($column) {
                $csv_columns[] = $column;
            }
        }
        return str_replace(' ', '_', $csv_columns);
    }

}

if (!function_exists('create_file')) {

    /**
     * @param <p>string $file_name - full path of file including file name</p>
     * @param <p>string $content: content of file</p>     
     * @return array of headings
     * @desc return csv file heading - first line of file is treated as heading
     * @author
     */
    function create_file($file_name, $content, $permission = "w") {
        $ctl_file = fopen("$file_name", $permission);
        fwrite($ctl_file, $content);
        fclose($ctl_file);
        chmod($file_name, 0777);
    }

}

if (!function_exists('force_download')) {

    /**
     * @method: force_download()
     * @param: 	$fileName,$fileExt,$fileSize   
     * @desc : force the browser to download the data
     */
    function force_download($fileName, $fileExt, $fileSize = NULL) {
        //Required for IE, otherwise Content-disposition is ignored
        if (ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');

        switch ($fileExt) {
            case "pdf": $ctype = "application/pdf";
                break;
            case "exe": $ctype = "application/octet-stream";
                break;
            case "zip": $ctype = "application/zip";
                break;
            case "doc": $ctype = "application/msword";
                break;
            case "xls": $ctype = "application/vnd.ms-excel";
                break;
            case "xlsx": $ctype = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                break;
            case "ppt": $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif": $ctype = "image/gif";
                break;
            case "png": $ctype = "image/png";
                break;
            case "jpe": case "jpeg":
            case "jpg": $ctype = "image/jpg";
                break;
            case "txt": $ctype = "text/plain";
                break;
            case "mp3": $ctype = "audio/mpeg";
                break;
            case "wav": $ctype = "audio/x-wav";
                break;
            case "mpg": case "mpeg":
            case "mpe": $ctype = "video/mpeg";
                break;
            case "mov": $ctype = "video/quicktime";
                break;
            case "avi": $ctype = "video/x-msvideo";
                break;
            case "txt": $ctype = "text/plain";
                break;
            default: $ctype = "application/force-download";
        }
        ob_clean_all();
        header("Pragma: public");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header('Content-Encoding: identity');
        header("Content-Type: $ctype");
        header("Content-Disposition: attachment; filename=" . $fileName . ";");
        header("Content-Transfer-Encoding: binary");
        if ($fileSize != NULL)
            header("Content-Length: " . $fileSize);
    }

}

if (!function_exists('export_data')) {

    /**
     * @method: export_data()
     * @param: 	  
     * @desc : export the dat as different format
     */
    function export_data($data, $export_type = 'csv', $fileName = 'export', $columns = null, $heading = null, $options = null) {
        $CI = & get_instance();
        switch ($export_type) {
            case "pdf":
                if (!is_array($data)) {
                    return false;
                }
                $fileName.='.pdf';
                $CI->load->library('cezpdf');
                $CI->load->helper('pdf');
                prep_pdf(); // creates the footer for the document we are creating.
                $CI->cezpdf->ezTable($data, $columns, $heading, array('width' => 550));
                force_download($fileName, 'pdf');
                echo $CI->cezpdf->ezOutput();
                break;
            case "xls":
                if (!is_array($data)) {
                    return false;
                }
                $fileName.='.xls';
                $tblHeading = $columns;
                if (!is_array($columns)) {
                    $tblHeading = get_array_columns($data);
                }

                $dataTbl = generate_table(null, $tblHeading, $data);
                force_download($fileName, 'xls');
                echo $dataTbl;
                exit;
                break;
            case "csv":
                if (!is_array($data)) {
                    return false;
                }
                $fileName.='.csv';
                force_download($fileName, 'csv');
                $tblHeading = $columns;
                if (!is_array($columns)) {
                    $tblHeading = get_array_columns($data);
                }
                array_unshift($data, $tblHeading);
                $data = array_to_csv($data);
                echo $data;
                exit();
                break;
        }
    }

}

if (!function_exists('ob_clean_all')) {

    /**
     * @method: ob_clean_all()
     * @param: 	NA  
     * @desc : Clean the output buffer
     */
    function ob_clean_all() {
        $ob_active = ob_get_length() !== FALSE;
        while ($ob_active) {
            ob_end_clean();
            $ob_active = ob_get_length() !== FALSE;
        }
        return FALSE;
    }

}

if (!function_exists('array_to_csv')) {

    /**
     * @method: array_to_csv()
     * @param:     array 
     * @desc : convert an array to css format string
     */
    function array_to_csv(array $fields, $delimiter = ',', $enclosure = '"', $encloseAll = false, $nullToMysqlNull = false) {
        $delimiter_esc = preg_quote($delimiter, '/');
        $enclosure_esc = preg_quote($enclosure, '/');

        $outputString = "";
        foreach ($fields as $tempFields) {
            $output = array();
            foreach ($tempFields as $field) {
                if ($field === null && $nullToMysqlNull) {
                    $output[] = 'NULL';
                    continue;
                }

                // Enclose fields containing $delimiter, $enclosure or whitespace
                if ($encloseAll || preg_match("/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field)) {
                    $field = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure;
                }
                $output[] = $field . " ";
            }
            $outputString .= implode($delimiter, $output) . "\r\n";
        }
        return $outputString;
    }

}

if (!function_exists('get_link_buttons')) {

    function get_link_buttons($attributes) {
        /* $attribute=array(
          'btn_class'=>'btn-default',
          'btn_href'=>'#',
          'btn_icon'=>'fa-remove',
          'btn_title'=>'remove record',
          'btn_separator'=>'',
          'param' => array('$1'),
          'style'=>'css string'
          'attr'=>'attribute string'
          ); */
        $btn = '';

        if (is_array($attributes)) {
            foreach ($attributes as $attribute) {
                $style = '';
                if (isset($attribute['style'])) {
                    $style = ' style="' . $attribute['style'] . '"';
                }
                $param = '';
                if (isset($attribute['param'])) {
                    $param = '/' . implode('/', $attribute['param']);
                }
                $href = '#';
                if ($attribute['btn_href'] != '#') {
                    $href = $attribute['btn_href'] . $param;
                }
                $attr = '';
                if (isset($attribute['attr'])) {
                    $attr = $attribute['attr'];
                }

                $btn.='<a class="btn ' . $attribute["btn_class"] . ' btn-xs" ' . $attr . ' href="' . $href . '"'
                        . ' title="' . $attribute["btn_title"] . '" data-toggle="tooltip" data-placement="top"'
                        . $style . '>';

                if (isset($attribute["btn_icon"])) {
                    $btn.='<i class="fa ' . $attribute["btn_icon"] . '"></i>';
                }
                if (isset($attribute["btn_text"])) {
                    $btn.=$attribute["btn_text"];
                }

                $btn.='</a>' . $attribute["btn_separator"];
            }
        }

        return $btn;
    }

}

if (!function_exists('generate_gird')) {

    /**
     * @method: get_link_buttons()
     * @param: 	array $buttons 
     * @desc : generate buttons for data table
     */
    function generate_gird($cust_config = null, $id = 'example') {

        $scriptS = '<script type="text/javascript">';
        $docS = '$(document).ready(function() {';

        /*         * *******************************
         * 1. Pass 3rd param as false in select() to active search functionality
         * 2. Set table_tools as false to off the export functionality
         * 3. for header span use "column_span" index set up with given formatted array
         *  
         * */
        $gridConfig = array(
            'table' => array(
                'id' => $id,
                'template' => array('table_open' => '<table id="' . $id . '" width ="100%" border="1" cellpadding="0" cellspacing="0" class="display table table-striped table-bordered ">'),
                'columns' => array(),
                //'columns_span'=>array(array('colspan'=>2,'data'=>'column_name')),
                'columns_width' => array(),
                'auto_comp_input' => false
            ),
            'grid' => array(
                'filter' => 'true',
                'cfilter' => true, //true/false to show/hide the column filter
                'cfilter_pos' => 'top', //set any other value to set filter in buttom
                'cfilter_columns' => array(), //ex: array(column-1,'',column-3);
                'global_filter' => true,
                'server_side' => 'true',
                'ajax_source' => 'tests/datatable',
                'paginate' => 'true',
                'paginate_type' => "full_numbers",
                'info' => FALSE,
                'processing' => 'true',
                'sort' => 'true',
                'sort_columns' => 'all', //all for all columns or specify array of columns as in same sequence of columns
                'auto_width' => 'false',
                'show_entries' => '[10,20,30,40,50]',
                'show_hide_entries' => true,
                'columns_alignment' => array(),
                'callback_function' => null
            ),
            'table_tools' => array()/* sample code: array('pdf' => array(
                  'url' => '/tests/datatable2/pdf'
                  )
                  ) */
        );

        if (is_array($cust_config)) {
            $gridConfig['grid'] = array_merge($gridConfig['grid'], $cust_config['grid']);
            $gridConfig['table'] = array_merge($gridConfig['table'], $cust_config['table']);

            if (array_key_exists('table_tools', $cust_config))
                if (is_array($cust_config['table_tools'])) {

                    $gridConfig['table_tools'] = array_merge($gridConfig['table_tools'], $cust_config['table_tools']);
                }
        }

        $grid = array();
        $table_id = $gridConfig['table']['id'];

        $grid['cfilter'] = '$("#' . $table_id . ' tfoot th").each(function() {
            var indx = $(this).index();            
            var title = $("#' . $table_id . ' tfoot th").eq($(this).index()).text();
            var head = $("#' . $table_id . ' thead th").eq($(this).index()).text();
            if (title == head && title!="") {
                $(this).html("<span class=\"filter_column filter_text\"><input type=\"text\" style=\"width:100%;\" placeholder=\"Search \" + title + \"\" /></span>");
            }

        })';

        $grid['applay_cfilter'] = '// Apply the search
        table.columns().every(function() {
            var that = this;

            $("input", this.footer()).on("keyup", function() {
                that
                        .search(this.value)
                        .draw();
            });
        });';

        $grid['cfilter_pos'] = '$("#' . $table_id . ' tfoot tr th").css("border","none");$("#' . $table_id . ' tfoot tr th").addClass("no-pad"); $("#' . $table_id . ' tfoot tr").insertAfter($("#' . $table_id . ' thead"));';
        $grid['show_hide_entries'] = '$("#' . $table_id . '_length").css("display","none");';

        $grid['table_tools'] = array(
            'pdf' => '{
                        "sExtends": "text",
                        "sButtonText": "<img src=\"' . base_url("/images/pdf_icon.gif") . '\" data-toggle=\"tooltip\" data-original-title=\"export as pdf\" title=\"\"/>",
                        "sButtonClass": "btn btn-xs",
                        "fnClick": function(nButton, oConfig, oFlash) {
                            window.location = myApp.CommonMethod.getBaseUrl() + "' . @$gridConfig['table_tools']['pdf']['url'] . '";
                        }
                    }',
            'xls' => '{
                        "sExtends": "text",
                        "sButtonText": "<img src=\"' . base_url("/images/excel_icon.png") . '\" data-toggle=\"tooltip\" data-original-title=\"export as excel\" title=\"\"/>",
                        "sButtonClass": "btn btn-xs",
                        "fnClick": function(nButton, oConfig, oFlash) {
                            window.location = myApp.CommonMethod.getBaseUrl() + "' . @$gridConfig['table_tools']['xls']['url'] . '";
                        }                        
                    }',
            'csv' => '{
                        "sExtends": "text",
                        "sButtonText": "<img src=\"' . base_url("/images/csv_icon_sm.gif") . '\" data-toggle=\"tooltip\" data-original-title=\"export as csv\" title=\"\" />",
                        "sButtonClass": "btn btn-xs",
                        "fnClick": function(nButton, oConfig, oFlash) {
                            window.location = myApp.CommonMethod.getBaseUrl() + "' . @$gridConfig['table_tools']['csv']['url'] . '";
                        }                        
                    }'
        );

        $tableTools = $col_definition = $sortColumns = '';
        //set column defination columnDefs
        if (is_array($gridConfig['table']['columns'])) {
            $col_definition.='"columnDefs": [';
            $cnt = 0;
            foreach ($gridConfig['table']['columns'] as $ckey => $cval) {
                if (isset($gridConfig['table']['columns_width'][$cnt])) {
                    $sWidth_val = $gridConfig['table']['columns_width'][$cnt];
                } else {
                    $sWidth_val = "auto";
                }
                if (isset($gridConfig['grid']['columns_alignment'][$cnt])) {
                    $className = $gridConfig['grid']['columns_alignment'][$cnt];
                } else {
                    $className = "null";
                }
                $col_definition.='{ "name": "' . $cval . '","targets":' . $cnt++ . ',"sWidth": "' . $sWidth_val . '",className: "' . $className . '"},';
            }
            $col_definition = rtrim($col_definition, ',');
            $col_definition.= '],';
        }

        //Set sort columns
        if ($gridConfig['grid']['sort_columns'] != 'all') {
            if (is_array($gridConfig['grid']['sort_columns'])) {
                $sortColumns.='"aoColumns": [';
                foreach ($gridConfig['table']['columns_alias'] as $ky => $col) {
                    if (array_key_exists($ky, $gridConfig['grid']['sort_columns'])) {

                        if ($gridConfig['grid']['sort_columns'][$ky] == $col) {
                            $sortColumns.='null,';
                        } else {
                            $sortColumns.='{"bSortable":false},';
                        }
                    } else {
                        $sortColumns.='{"bSortable":false},';
                    }
                }
                $sortColumns = substr($sortColumns, 0, strlen($sortColumns) - 1);
                $sortColumns.='],';
            }
        }

        //set table export options

        if (is_array($gridConfig['table_tools'])) {
            $tableTools = ' "tableTools": {"aButtons": [';
            foreach ($gridConfig['table_tools'] as $key => $tools) {
                $tableTools.=$grid['table_tools'][$key] . ',';
            }
            //remove extra comma
            $tableTools = rtrim($tableTools, ',');

            $tableTools.=']},';
        }
        $docE = '}); ';
        $scriptE = '</script>';
        $order_str = '[';
        if (isset($gridConfig['grid']['column_order'])) {
            foreach ($gridConfig['grid']['column_order'] as $key => $val) {
                $order_str.='[' . $key . ',"' . $val . '"]';
            }
        }
        $order_str.=']';

        $dTable = 'var table = $("#' . $gridConfig['table']['id'] . '").DataTable({
            initComplete: function() {                
                this.api().columns(".select_box_filter").every(function() {
                    var column = this;
                    var select = $("<select class=\"grid_search_select_box\"><option value=\"\">Search</option></select>")
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                        );
                                val = $(this).val();
                                console.log("val", val);
                                column
                                .search(val ? val : "", true, false)
                                .draw();
                            });
                    var optionsList = fetch_type_options();
                    select.append(optionsList);
                });
                
            },
            responsive: true,
            "bServerSide":' . $gridConfig['grid']['server_side'] . ',
            "sAjaxSource":"' . base_url() . $gridConfig['grid']['ajax_source'] . '",
            "sServerMethod": "POST",
            "bPaginate":"' . $gridConfig['grid']['paginate'] . '",
            "sPaginationType":"simple_numbers",            
            "bFilter":"' . $gridConfig['grid']['global_filter'] . '",
            "bInfo":"' . $gridConfig['grid']['info'] . '",
            "bProcessing":"' . $gridConfig['grid']['processing'] . '",
            "bSort":"' . $gridConfig['grid']['sort'] . '",
            "autoWidth":"' . $gridConfig['grid']['auto_width'] . '",
            "order": ' . $order_str . ',
            "aLengthMenu":' . $gridConfig['grid']['show_entries'] . ',            
            ' . $col_definition .
                $sortColumns . '
            "dom": "T<\"clear\">lfrtip",' .
                $tableTools . '
            "buttons": [
            {
                text: \'My button\',
                action: function ( e, dt, node, config ) {
                    alert( \'Button activated\' );
                }
            }
            ],
            "fnDrawCallback": function() {                    
                    ' . $gridConfig['grid']['callback_function'] . ';
                },
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                    $(nRow).attr("id", "row_"+iDataIndex); 
                }
            });';
        $dTablePos = '';
        if ($gridConfig['grid']['cfilter']) {
            $dTablePos.= $grid['cfilter'] . $grid['applay_cfilter'];
            if ($gridConfig['grid']['cfilter_pos'] == 'top') {
                $dTablePos.= $grid['cfilter_pos'];
            }
        }
        $jquery = '';
        $hideDataTools = '';
        //script for auto-complete-input pop-up
        if ($gridConfig['table']['auto_comp_input']) {
            //if(array_key_exists('hidden_input',$gridConfig['table']['auto_comp_input'])){
            if (@$gridConfig['table']['auto_comp_input']['hidden_input'] != '') {
                $jquery.="$('#" . $id . "').on('click', 'tr', function () {
                                var rowIndex =  $(this).text();
                                var theIndex = $('tr').first().children().filter(function () {
                                    return ($(this).text() == '" . $gridConfig['table']['auto_comp_input']['col_name'] . "');
                                }).index();
                                theIndex=parseInt(theIndex)+1;
                                var td_val=$(this).children(':nth-child('+theIndex+')').text();                                
                                $('#" . $gridConfig['table']['auto_comp_input']['hidden_input'] . "').val(td_val);
                                $('#" . $gridConfig['table']['auto_comp_input']['modal_id'] . "').modal('hide');
                            });";
            }
        }

        if ($tableTools == '') {
            //hide default generated export buttons
            $jquery = '$(".DTTT_container").css("display","none");';
        }

        if ($gridConfig['grid']['show_hide_entries']) {
            //hide default generated export buttons
            $jquery.= $grid['show_hide_entries'];
        }
        //Databale script end here.

        $jquery.='myApp.Ajax.dataTableRef=table;';

        echo $scriptS . $docS . $dTable . $dTablePos;
        echo $jquery . $docE . $scriptE;

        $CI = & get_instance();
        $CI->load->library('table');
        $CI->table->set_template($gridConfig['table']['template']);

        if (array_key_exists('columns_span', $gridConfig['table'])) {
            $CI->table->set_heading_col_span($gridConfig['table']['columns_span']);
        }

        if (array_key_exists('columns_alias', $gridConfig['table'])) {
            $CI->table->set_heading($gridConfig['table']['columns_alias']);
        } else {
            $CI->table->set_heading($gridConfig['table']['columns']);
        }
        $tfoot = array();

        if ($gridConfig['grid']['cfilter'] && is_array($gridConfig['grid']['cfilter_columns'])) {
            $CI->table->set_tfoot($gridConfig['grid']['cfilter_columns']);
        }
        echo $CI->table->generate();
    }

}

if (!function_exists('site_down')) {

    function site_down() {
        $CI = & get_instance();
        $ses_data = $CI->session->userdata('user_data');
        if ($ses_data && isset($ses_data['roles'])) {
            if (!in_array('ADMIN', $ses_data['role_codes'])) {
                $CI->session->sess_destroy();
                $_error = & load_class('Exceptions', 'core');
                $heading = "Site is down!";
                echo $_error->show_error($heading, '', 'error_sitedown', 200);
                exit;
            }
        } else {
            $url = $CI->uri->uri_string();
            if ($url !== 'admin_users/sign_in/sitedown' && $url !== 'users/log_out') {
                $_error = & load_class('Exceptions', 'core');
                $heading = "Site is down!";
                echo $_error->show_error($heading, '', 'error_sitedown', 200);
                exit;
            }
        }
    }

}

if (!function_exists('max_inner_array')) {

    function max_inner_array($arraylist, $count_flag = false) {
        $largeArraySize = 0;
        $max_value = 0;
        foreach ($arraylist as $array) {
            if (count($array) > $largeArraySize) {
                $largeArraySize = $max_value = count($array);
                $largeArray = $array;
            }
        }
        if ($count_flag) {
            return $max_value;
        }
        return $largeArray;
    }

}

if (!function_exists('in_array_r')) {

    function in_array_r($needle, $haystack) {
        $found = false;
        foreach ($haystack as $item) {
            if ($item === $needle) {
                $found = true;
                break;
            } elseif (is_array($item)) {
                $found = in_array_r($needle, $item);
                if ($found) {
                    break;
                }
            }
        }
        return $found;
    }

}

if (!function_exists('array_to_xls')) {

    /**
     * @method convert_xls_to_csv
     * @param	&$array, $offset
     * @return	
     * @desc delte the given column of an array
     */
    function array_to_xls($file_path, $file_name, $sheet_title, $data) {
        require_once APPPATH . "/third_party/PHPExcel.php";
        require_once APPPATH . "/third_party/PHPExcel/IOFactory.php";
        ob_clean();
        $objPHPExcel = new PHPExcel();
        // Fill worksheet from values in array
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');
        $objPHPExcel->getActiveSheet()->setTitle($sheet_title);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file_path . $file_name);
        chmod("$file_path" . "$file_name", 0777);
        return true;
    }

}

if (!function_exists('convert_to_time')) {

    /**
     * @method <p>convert_to_time</p>
     * @param	<p>string $timezone, $time= date('Y-m-d H:i:s')
     * @return	<p>string $convertedtime</p>
     * @desc delte the given column of an array
     */
    function convert_to_time($time, $timezone = null) {
        if (!$timezone) {
            $timezone = date_default_timezone_get();
        }
        $selectedtime = date("Y-m-d H:i:s", strtotime($time));
        $date = new DateTime($selectedtime, new DateTimeZone($timezone));
        $date->setTimezone(new DateTimeZone('GMT'));
        $convertedtime = strtotime($date->format('Y-m-d H:i:s'));
        return $convertedtime;
    }

}

if (!function_exists('array_key_val_check')) {

    /**
     * @param <p></p>
     * @return <p></p>
     * @desc <p>Used to compare two arrays key and value</p>
     * @author <p></p>
     */
    function array_key_val_check($array1, $array2) {
        if ($array1 === $array2) {
            return 0;
        }
        return ($array1 > $array2) ? 1 : -1;
    }

}

if (!function_exists('create_dropdown_options')) {

    /**
     * @param array $data : whole data array
     * @param string $key_col : data array index name which will treated as options key
     * @param string $val_col : data array index name which will treated as options value text
     * @param boolean $option_tag_flag: determines retured data should be in option tag or array
     * @param string $selected_val : the value which should display as selected option
     * @param string $selected_by : determines selected logic baseed on key or value
     * @return
     * @desc : used to return only options part of dropdown
     * @author
     */
    function create_dropdown_options($data, $key_col, $val_col, $option_tag_flag = TRUE, $selected_val = '', $selected_by = 'v', $attributes = '', $chosen_flag = FALSE) {
        $opt = "";
        if ($option_tag_flag) {
            foreach ($data as $key => $val) {
                $selected = '';
                if ($selected_by === 'k') {
                    if ($val[$key_col] == $selected_val) {
                        $selected = " selected='selected' ";
                    }
                } else {
                    if ($val[$val_col] == $selected_val) {
                        $selected = " selected='selected' ";
                    }
                }
                $opt.="<option $selected $attributes value='$val[$key_col]'>" . $val[$val_col] . "</option>";
            }
        } else {
            //chosen dropdwon required a blank value option so it is.
            if ($chosen_flag) {
                $opt[''] = '';
            }
            foreach ($data as $key => $val) {
                $opt[$val[$key_col]] = $val[$val_col];
            }
        }
        return $opt;
    }

}

if (!function_exists('get_user_status_list')) {

    function get_user_status_list() {
        $status_list = array(
            '' => 'Select status',
            'active' => 'Active',
            'inactive' => 'In-active',
        );
        return $status_list;
    }

}

if (!function_exists('validate_auth')) {

    function validate_auth() {
        $CI = & get_instance();
        $method_name = $CI->router->fetch_method();
        //pma($method_name,1);
        if (!$method_name = 'sign_in') {
            if (!$CI->rbac->has_permission('RBAC_ACTION', 'view')) {
                redirect(base_url('/users/sign_in'));
            }
        }

        //$CI->layout->render(array('error' => '401'));
        //pma($CI->layout,1);
        //EXIT;
    }

}

if (!function_exists('tree_on_key_column')) {

    function tree_on_key_column($data, $key_col) {
        $key_col_val = $prev_key_col_val = '';
        $result = array();
        foreach ($data as $rec) {
            if (is_array($rec)) {
                $key_col_val = $rec[$key_col];
                if ($key_col_val != $prev_key_col_val) {
                    $prev_key_col_val = $key_col_val;
                    $result[$key_col_val] = array(
                        'module_id' => $rec['module_id'],
                        'module_name' => $rec['module_name'],
                        'module_code' => $rec['module_code'],
                        'actions' => array()
                    );
                }
                $result[$key_col_val]['actions'][$rec['action_code']] = array(
                    'permission_id' => $rec['permission_id'],
                    'action_id' => $rec['action_id'],
                    'action_name' => $rec['action_name'],
                    'action_code' => $rec['action_code'],
                );
            }
        }
        return $result;
    }

}

if (!function_exists('assoc_array_merge')) {

    /**
     * @param
     * @return
     * @desc used to merge two associative array
     * @author
     */
    function assoc_array_merge($array1, $array2) {
        $merged = array();
        foreach ($array1 as $key => $val) {
            if (array_key_exists($key, $array2)) {
                if (is_array($val)) {
                    $merged[$key] = array_merge($val, $array2[$key]);
                } else {
                    $merged[$key] = $array2[$key];
                }
            } else {
                $merged[$key] = $val;
            }
        }
        //add the new array2 keys to array1
        $diff_keys = array_diff_key($array2, $array1);
        foreach ($diff_keys as $key => $val) {
            $merged[$key] = $array2[$key];
        }
        return $merged;
    }

}

if (!function_exists('create_dir')) {

    /**
     * @param <p>string $dir_name - full path of directory</p>
     * @param <p>string $permission: 0777</p>
     * @return array of headings
     * @desc used to create directory
     * @author
     */
    function create_dir($dir_name, $permission = "0777") {
        if (is_dir($dir_name) === TRUE) {
            return TRUE;
        } else {
            return mkdir($dir_name, $permission, true);
        }
    }

}

if (!function_exists('tree_array')) {

    /**
     * @param  : array $flat- data array
     * @param  : string $pidKey- parent key column name
     * @param  : string $idKey- primary key column name
     * @desc   : populate tree view form menu array
     * @return : array $tree - tree view array
     * @author : HimansuS
     * @created:
     */
    function tree_array($flat, $pidKey, $idKey = null) {
        $tree = array();
        $grouped = array();
        foreach ($flat as $sub) {
            $grouped[$sub[$pidKey]][] = $sub;
        }
        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if (isset($grouped[$id])) {
                    $sibling['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }

            return $siblings;
        };
        $tree = $fnBuilder($grouped[0]);
        return $tree;
    }

}

if (!function_exists('array_to_xml')) {

    function array_to_xml($data, &$xml_data) {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item' . $key; //dealing with <0/>..<n/> issues
            }
            if (is_array($value)) {
                $subnode = $xml_data->addChild($key);
                array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

}

if (!function_exists('xml2array')) {

    /**
     * function xml2array
     *
     * This function is part of the PHP manual.
     *
     * The PHP manual text and comments are covered by the Creative Commons 
     * Attribution 3.0 License, copyright (c) the PHP Documentation Group
     *
     * @author  k dot antczak at livedata dot pl
     * @date    2011-04-22 06:08 UTC
     * @link    http://www.php.net/manual/en/ref.simplexml.php#103617
     * @license http://www.php.net/license/index.php#doc-lic
     * @license http://creativecommons.org/licenses/by/3.0/
     * @license CC-BY-3.0 <http://spdx.org/licenses/CC-BY-3.0>
     */
    function xml2array($xmlObject, $out = array()) {
        foreach ((array) $xmlObject as $index => $node)
            $out[$index] = ( is_object($node) ) ? xml2array($node) : $node;

        return $out;
    }

}

if (!function_exists('flat_array_tree')) {

    /**
     * flat_array_tree
     *
     * Convert flat array in to tree array
     *
     * @param  : array $flatArray- data array
     * @param  : string $pidKey- parent key column name
     * @param  : array $parentColumns- columns to consider for parent array
     * @desc   : populate tree view form menu array
     * @return : array $tree - tree view array
     * @example:<p>
     * $flat_array=array(
      [0] => Array
      (
      [module_id] => 10
      [module_name] => app routes
      [module_code] => APP_ROUTES
      [module_status] => active
      [module_created] => 2019-08-26 00:34:10
      [module_modified] =>
      [action_id] => 1
      [action_name] => creat
      [action_code] => CREATE
      [action_status] => active
      [action_created] => 2018-10-25 17:38:32
      [action_modified] =>
      )
     * )
     * flat_array_tree($flat_array,'module_id',array('module_id','module_name'))
     * </p>
     * @author himansuS <himansu.sahoo@ionidea.com>
     */
    function flat_array_tree($flatArray, $pidKey, $cidKey, $parentColumns = '') {
        $tree = array();
        $grouped = array();
        $parentColumnsFlag = true;
        foreach ($flatArray as $sub) {
            $grouped[$sub[$pidKey]][] = $sub;
        }
        /*
          $parentColumns = array(
          'module_id', 'module_name', 'module_code', 'module_status', 'module_created', 'module_modified'
          );
         */
        //set all columns as parent column filter, if not set
        if ($parentColumns == '') {
            $current = current($flatArray);
            $parentColumns = array_keys($current);
            $parentColumnsFlag = false;
        }
        $parentColumns = array_flip($parentColumns);

        foreach ($grouped as $pid => $rec) {
            $tree[$pid] = generate_clield($rec, $pid, $cidKey, $parentColumns, $parentColumnsFlag);
        }
        return $tree;
    }

}
if (!function_exists('generate_clield')) {

    /**
     * tree_array
     *
     * Convert array in to tree array
     *
     * @param  : array $flat- data array
     * @param  : string $pidKey- parent key column name
     * @param  : string $c_id- children key column name
     * @param  : string $idKey- primary key column name
     * @desc   : populate tree view form menu array
     * @return : array $tree - tree view array
     * @author himansuS <himansu.sahoo@ionidea.com>
     */
    function generate_clield($flat, $pid, $c_id, $parentColumns, $parentColumnsFlag = false) {
        $tree = array();
        $parentDataFlag = 1;
        foreach ($flat as $key => $rec) {
            if ($parentDataFlag) {
                foreach ($parentColumns as $key => $column) {
                    if (array_key_exists($key, $rec)) {
                        $tree[$key] = $rec[$key];
                    }
                }
                $parentDataFlag = 0;
            }
            if ($parentColumnsFlag) {
                $rec = array_diff_key($rec, $parentColumns);
            }

            $tree['children'][$rec[$c_id]] = $rec;
        }
        return $tree;
    }

}
