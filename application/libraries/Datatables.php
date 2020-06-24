<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Ignited Datatables
 *
 * This is a wrapper class/library based on the native Datatables server-side implementation by Allan Jardine
 * found at http://datatables.net/examples/data_sources/server_side.html for CodeIgniter
 *
 * @package    CodeIgniter
 * @subpackage libraries
 * @category   library
 * @version    0.7
 * @author     Vincent Bambico <metal.conspiracy@gmail.com>
 *             Yusuf Ozdemir <yusuf@ozdemir.be>
 * @link       http://codeigniter.com/forums/viewthread/160896/
 */
class Datatables {

    /**
     * Global container variables for chained argument results
     *
     */
    protected $ci;
    protected $size = array();
    protected $add_custom_column = array();
    protected $aaData_pos = array();
    protected $table;
    protected $distinct;
    protected $group_by;
    protected $select = array();
    protected $joins = array();
    protected $columns = array();
    protected $where = array();
    protected $filter = array();
    protected $add_columns = array();
    protected $edit_columns = array();
    protected $unset_columns = array();
    protected $custom_search;

    /**
     * Copies an instance of CI
     */
    public function __construct() {
        $this->ci = & get_instance();
    }

    /**
     * If you establish multiple databases in config/database.php this will allow you to
     * set the database (other than $active_group) - more info: http://codeigniter.com/forums/viewthread/145901/#712942
     */
    public function set_database($db_name) {
        $db_data = $this->ci->load->database($db_name, TRUE);
        $this->ci->db = $db_data;
    }

    /**
     * Generates the SELECT portion of the query
     *
     * @param string $columns
     * @param bool $backtick_protect
     * @param bool $external_search added to check whether custom search is neccessary
     * @return mixed
     */
    public function select($columns, $backtick_protect = TRUE, $external_search = FALSE) {
        $count = 0;
        foreach ($this->explode(',', $columns) as $val) {
            if ($count == 0) {
                $val = trim($val, 'SQL_CALC_FOUND_ROWS ');
                $count = 1;
            }
            $column = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
            $this->columns[] = trim(trim($column, '"'));
            $this->select[$column] = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', $val));
        }

        $this->custom_search = $external_search;
        $this->ci->db->select($columns, $backtick_protect);
        return $this;
    }

    public function cquery($query, $external_search = FALSE) {
        $count = 0;
        if ($count == 0) {
            $val = trim($query, 'SQL_CALC_FOUND_ROWS ');
            $count = 1;
        }

        $this->custom_search = $external_search;
        $this->ci->db->query($columns);
        return $this;
    }

    /**
     * Generates the DISTINCT portion of the query
     *
     * @param string $column
     * @return mixed
     */
    public function distinct($column) {
        $this->distinct = $column;
        $this->ci->db->distinct($column);
        return $this;
    }

    /**
     * Generates the GROUP_BY portion of the query
     *
     * @param string $column
     * @return mixed
     */
    public function group_by($column) {
        $this->group_by = $column;
        $this->ci->db->group_by($column);
        return $this;
    }

    /**
     * Generates the ORDER_BY portion of the query
     *
     * @param string $column
     * @return mixed
     * Used in run period listing.
     */
    public function order_by($column, $order) {
        $this->order_by = $column;
        $this->ci->db->order_by($column, $order);
        return $this;
    }

    /**
     * Generates the FROM portion of the query
     *
     * @param string $table
     * @return mixed
     */
    public function from($table) {
        $this->table = $table;
        $this->ci->db->from($table);
        return $this;
    }

    /**
     * Generates the JOIN portion of the query
     *
     * @param string $table
     * @param string $fk
     * @param string $type
     * @return mixed
     */
    public function join($table, $fk, $type = NULL) {
        $this->joins[] = array($table, $fk, $type);
        $this->ci->db->join($table, $fk, $type);
        return $this;
    }

    /**
     * Generates the WHERE portion of the query
     *
     * @param mixed $key_condition
     * @param string $val
     * @param bool $backtick_protect
     * @return mixed
     */
    public function where($key_condition, $val = NULL, $backtick_protect = TRUE, $string_condition = null) {
        if ($string_condition) {
            $this->ci->db->where($string_condition);
        } else {
            $this->where[] = array($key_condition, $val, $backtick_protect);
            $this->ci->db->where($key_condition, $val, $backtick_protect);
        }

        return $this;
    }

    /**
     * Generates the WHERE portion of the query
     *
     * @param mixed $key_condition
     * @param string $val
     * @param bool $backtick_protect
     * @return mixed
     */
    public function or_where($key_condition, $val = NULL, $backtick_protect = TRUE) {
        $this->where[] = array($key_condition, $val, $backtick_protect);
        $this->ci->db->or_where($key_condition, $val, $backtick_protect);
        return $this;
    }

    /**
     * Generates the WHERE portion of the query
     *
     * @param mixed $key_condition
     * @param string $val
     * @param string $wildcard
     * @param bool $backtick_protect
     * @return mixed
     */
    public function like($key_condition, $val = NULL, $wildcard = 'both', $backtick_protect = TRUE) {
        $this->where[] = array($key_condition, $val, $backtick_protect);
        /* Removed $this->ci->db->like($key_condition, $val, $backtick_protect); and added
          $this->ci->db->like($key_condition, $val,$wildcard); wildcard was not added by default plugin.
          wildcard will add % to the value of the like clause by default it will add %% to the value
         */
        $this->ci->db->like($key_condition, $val, $wildcard);
        return $this;
    }

    /**
     * Generates the WHERE portion of the query
     *
     * @param mixed $key_condition
     * @param string $val
     * @param bool $backtick_protect
     * @return mixed
     */
    public function filter($key_condition, $val = NULL, $backtick_protect = TRUE) {
        $this->filter[] = array($key_condition, $val, $backtick_protect);
        return $this;
    }

    /**
     * Sets additional column variables for adding custom columns
     *
     * @param string $column
     * @param string $content
     * @param string $match_replacement
     * @return mixed
     */
    public function add_column($column, $content, $match_replacement = NULL, $pos = -1, $array_size = -1) {
        $this->add_columns[$column] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
        $this->size[] = $array_size;
        $this->aaData_pos[] = $pos;
        $this->add_custom_column[] = $column;
        return $this;
    }

    /**
     * Sets additional column variables for editing columns
     *
     * @param string $column
     * @param string $content
     * @param string $match_replacement
     * @return mixed
     */
    public function edit_column($column, $content, $match_replacement) {
        $this->edit_columns[$column][] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
        return $this;
    }

    /**
     * Unset column
     *
     * @param string $column
     * @return mixed
     */
    public function unset_column($column) {
        $this->unset_columns[] = $column;
        return $this;
    }

    /**
     * Builds all the necessary query segments and performs the main query based on results set from chained statements
     *
     * @param string charset
     * @return string
     */
    public function generate($charset = 'UTF-8') {
        $this->get_paging();
        $this->get_ordering();
        $this->get_filtering();
        return $this->produce_output($charset);
    }

    public function generate_query($charset = 'UTF-8') {
        $this->get_paging();
        $this->get_ordering();
        $this->get_filtering();
        return $this->produce_output($charset);
    }

    public function generate_export($export) {
        $this->get_filtering($export);
        return $this->produce_assoc_output();
    }

    /**
     * Generates the LIMIT portion of the query
     *
     * @return mixed
     */
    protected function get_paging() {
        
        $iStart = $this->ci->input->post('iDisplayStart');
        if($iStart==''){
            $iStart = $this->ci->input->post('start');
        }
        $iStart=(int)$iStart;
        $iLength = $this->ci->input->post('iDisplayLength');        
        if($iLength==''){
            $iLength = $this->ci->input->post('length');
        }
        $iLength=(int)$iLength;
        //$this->ci->db->limit(($iLength != '' && $iLength != '-1') ? $iLength : 100, ($iStart)? $iStart : 0);
        //Modified for displaying all rows in Grouping lists for projects and users
        if ($iLength != '' && $iLength != '-1') {
            $this->ci->db->limit(($iLength != '' && $iLength != '-1') ? $iLength : 100, ($iStart) ? $iStart : 0);
        }
    }

    /**
     * Generates the ORDER BY portion of the query
     *
     * @return mixed
     */
    protected function get_ordering() {
        if ($this->check_mDataprop())
            $mColArray = $this->get_mDataprop();
        elseif ($this->ci->input->post('sColumns'))
            $mColArray = explode(',', $this->ci->input->post('sColumns'));
        else
            $mColArray = $this->columns;

        $mColArray = array_values(array_diff($mColArray, $this->unset_columns));
        $columns = array_values(array_diff($this->columns, $this->unset_columns));

        if (!empty($this->add_custom_column)) {
            $i = 0;
            foreach ($this->add_custom_column as $newcolumn) {
                array_splice($mColArray, -1, 0, $newcolumn);
                $i++;
            }
        }
        if ($this->ci->input->post('iSortingCols')) {
            for ($i = 0; $i < intval($this->ci->input->post('iSortingCols')); $i++) {
                if (isset($mColArray[intval($this->ci->input->post('iSortCol_' . $i))]) && in_array($mColArray[intval($this->ci->input->post('iSortCol_' . $i))], $columns) && $this->ci->input->post('bSortable_' . intval($this->ci->input->post('iSortCol_' . $i))) == 'true') {
                    $this->ci->db->order_by($mColArray[intval($this->ci->input->post('iSortCol_' . $i))], $this->ci->input->post('sSortDir_' . $i));
                }
            }
        } else if ($this->ci->input->post('order')) {
            $order = $this->ci->input->post('order');
            foreach ($order as $ord) {
                if (is_numeric($ord['column'])) {
                    $ord['column']+=1;
                }
                $this->ci->db->order_by($ord['column'], $ord['dir']);
            }
        }
    }

    /**
     * Generates the LIKE portion of the query
     *
     * @return mixed
     * @Note:1. Make the alias name and column name same for filter working
     * @Note:2. Use "as"  keyword for last alias name ex- CAST(costpool_startdate as DATE) as "costpool_startdate"
     * @Note:3. Alias name should be in double quote. '"'
     */
    protected function get_filtering($export = null) {
        if ($this->check_mDataprop()) {
            $mColArray = $this->get_mDataprop();
        } elseif ($this->ci->input->post('sColumns')) {
            $mColArray = explode(',', $this->ci->input->post('sColumns'));
        } else {
            $mColArray = $this->columns;
        }
        //set post value in session for filtered data export
        if (!$export) {
            $dtPostData = $this->ci->input->post();
            $this->ci->session->set_userdata('dtPostData', json_encode($dtPostData));
        } else if ($export) {
            $_POST = json_decode($this->ci->session->userdata('dtPostData'), true);
        }

        $sWhere = '';
        $sSearch = '';

        /* Added to check whether custom search is required */
        if (!$this->custom_search) {
            /*
             * commented below like because of it doesnot add escape string on '_' and '%'
             * as it is used in filtering it should be escaped. 
             */
            //$sSearch = $this->ci->db->escape_like_str($this->ci->input->post('sSearch'));
            $sSearch = $this->ci->db->escape_str($this->ci->input->post('sSearch'));
        }
        //to make compatible with latest datatable which is having "search" attribute himansu@26sep18
        $sSearch = $this->ci->db->escape_str($this->ci->input->post('sSearch'));
        if (!$sSearch) {
            $sSearch = $this->ci->db->escape_str($this->ci->input->post('search'));
            $sSearch = (isset($sSearch['value'])) ? $sSearch['value'] : '';
        }

        $mColArray = array_values(array_diff($mColArray, $this->unset_columns));
        $columns = array_values(array_diff($this->columns, $this->unset_columns));

        if ($sSearch != '') {
            $post_cols = $this->ci->input->post('columns');
            for ($i = 0; $i < count($mColArray); $i++) {
                if ($this->ci->input->post('bSearchable_' . $i) == 'true' || (isset($post_cols[$i]['orderable']) && $post_cols[$i]['searchable'] == true)) {
                    if ((in_array(trim($mColArray[$i]), $columns))) {
                        if (in_array($mColArray[$i], $this->select)) {
                            $sWhere .= $this->select[$mColArray[$i]] . " LIKE '%" . trim($sSearch) . "%' OR ";
                        } else if (array_key_exists('"' . $mColArray[$i] . '"', $this->select)) {
                            $sWhere .= $mColArray[$i] . " LIKE '%" . trim($sSearch) . "%' OR ";
                        }
                    }
                }
            }
        }

        $sWhere = substr_replace($sWhere, '', -3);

        if ($sWhere != '') {
            $this->ci->db->where('(' . $sWhere . ')');
        }

        for ($i = 0; $i < intval($this->ci->input->post('iColumns')); $i++) {
            if (isset($_POST['sSearch_' . $i]) && $this->ci->input->post('sSearch_' . $i) != '' && in_array($mColArray[$i], $columns)) {
                $miSearch = explode(',', $this->ci->input->post('sSearch_' . $i));

                foreach ($miSearch as $val) {
                    if (preg_match("/(<=|>=|=|<|>)(\s*)(.+)/i", trim($val), $matches)) {
                        if (in_array($mColArray[$i], $this->select)) {
                            $this->ci->db->where($this->select[$mColArray[$i]] . ' ' . $matches[1], $matches[3]);
                        } else if (array_key_exists('"' . $mColArray[$i] . '"', $this->select)) {
                            $this->ci->db->where($mColArray[$i] . ' ' . $matches[1], $matches[3]);
                        }
                    } else {
                        if (in_array($mColArray[$i], $this->select)) {
                            $this->ci->db->where($this->select[$mColArray[$i]] . ' LIKE', '%' . $val . '%');
                        } else if (array_key_exists('"' . $mColArray[$i] . '"', $this->select)) {
                            $this->ci->db->where($mColArray[$i] . ' LIKE', '%' . $val . '%');
                        }
                    }
                }
            }
        }

        foreach ($this->filter as $val) {
            $this->ci->db->where($val[0], $val[1], $val[2]);
        }
    }

    /**
     * Compiles the select statement based on the other functions called and runs the query
     *
     * @return mixed
     */
    protected function get_display_result() {
        $data = $this->ci->db->get();
        //pma($this->ci->db->last_query(),1);        
        return $data;
    }

    /**
     * Builds a JSON encoded string data
     *
     * @param string charset
     * @return string
     */
    protected function produce_output($charset) {
        $aaData = array();
        $rResult = $this->get_display_result();
        $iTotal = $this->get_total_results();
        $iFilteredTotal = $this->get_total_results(TRUE);
        foreach ($rResult->result_array() as $row_key => $row_val) {
            $aaData[$row_key] = ($this->check_mDataprop()) ? $row_val : array_values($row_val);

            foreach ($this->add_columns as $field => $val)
                if ($this->check_mDataprop())
                    $aaData[$row_key][$field] = $this->exec_replace($val, $aaData[$row_key]);
                else
                    $aaData[$row_key][] = $this->exec_replace($val, $aaData[$row_key]);

            foreach ($this->edit_columns as $modkey => $modval)
                foreach ($modval as $val)
                    $aaData[$row_key][($this->check_mDataprop()) ? $modkey : array_search($modkey, $this->columns)] = $this->exec_replace($val, $aaData[$row_key]);

            $aaData[$row_key] = array_diff_key($aaData[$row_key], ($this->check_mDataprop()) ? $this->unset_columns : array_intersect($this->columns, $this->unset_columns));

            if (!$this->check_mDataprop())
                $aaData[$row_key] = array_values($aaData[$row_key]);
        }

        $sColumns = array_diff($this->columns, $this->unset_columns);
        $sColumns = array_merge_recursive($sColumns, array_keys($this->add_columns));
        if (!empty($this->size) && !empty($this->aaData_pos)) {
            for ($i = 0; $i < count($this->size); $i++) {
                foreach ($aaData as $aaData_key => $aaData_value) {
                    $temp_data = $aaData[$aaData_key][$this->size[$i]];
                    unset($aaData[$aaData_key][$this->size[$i]]);
                    array_splice($aaData[$aaData_key], $this->aaData_pos[$i], 0, $temp_data);
                }
            }
        }
        $sOutput = array
            (
            'sEcho' => intval($this->ci->input->post('sEcho')),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => $aaData,
            'sColumns' => implode(',', $sColumns)
        );

        if (strtolower($charset) == 'utf-8')
            return json_encode($sOutput);
        else
            return $this->jsonify($sOutput);
    }

    /**
     * Get the number of rows returned for currently executed query
     * @return integer
     */
    protected function num_rows() {
        $query = 'SELECT FOUND_ROWS() as num_rows';
        $result = $this->ci->db->query($query);
        $row = $result->result_array();
        return $row[0]['num_rows'];
    }

    /**
     * Get result count
     *
     * @return integer
     */
    protected function get_total_results($filtering = FALSE) {
        if ($filtering)
            $this->get_filtering();

        foreach ($this->joins as $val)
            $this->ci->db->join($val[0], $val[1], $val[2]);

        foreach ($this->where as $val)
            $this->ci->db->where($val[0], $val[1], $val[2]);

        /* Removed $this->ci->db->count_all_results($this->table) because this 
          would yield all the rows when group_concat is applied
          Added $this->num_rows() */
        return $this->num_rows();
    }

    /**
     * Runs callback functions and makes replacements
     *
     * @param mixed $custom_val
     * @param mixed $row_data
     * @return string $custom_val['content']
     */
    protected function exec_replace($custom_val, $row_data) {
        $replace_string = '';

        if (isset($custom_val['replacement']) && is_array($custom_val['replacement'])) {
            foreach ($custom_val['replacement'] as $key => $val) {
                $sval = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($val));

                if (preg_match('/(\w+)\((.*)\)/i', $val, $matches) && function_exists($matches[1])) {
                    $func = $matches[1];
                    $args = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[,]+/", $matches[2], 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                    foreach ($args as $args_key => $args_val) {
                        $args_val = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($args_val));
                        $args[$args_key] = (in_array($args_val, $this->columns)) ? ($row_data[($this->check_mDataprop()) ? $args_val : array_search($args_val, $this->columns)]) : $args_val;
                    }

                    $replace_string = call_user_func_array($func, $args);
                } elseif (in_array($sval, $this->columns))
                    $replace_string = $row_data[($this->check_mDataprop()) ? $sval : array_search($sval, $this->columns)];
                else
                    $replace_string = $sval;

                $custom_val['content'] = str_ireplace('$' . ($key + 1), $replace_string, $custom_val['content']);
            }
        }

        return $custom_val['content'];
    }

    /**
     * Check mDataprop
     *
     * @return bool
     */
    protected function check_mDataprop() {
        if (!$this->ci->input->post('mDataProp_0'))
            return FALSE;

        for ($i = 0; $i < intval($this->ci->input->post('iColumns')); $i++)
            if (!is_numeric($this->ci->input->post('mDataProp_' . $i)))
                return TRUE;

        return FALSE;
    }

    /**
     * Get mDataprop order
     *
     * @return mixed
     */
    protected function get_mDataprop() {
        $mDataProp = array();

        for ($i = 0; $i < intval($this->ci->input->post('iColumns')); $i++)
            $mDataProp[] = $this->ci->input->post('mDataProp_' . $i);

        return $mDataProp;
    }

    /**
     * Return the difference of open and close characters
     *
     * @param string $str
     * @param string $open
     * @param string $close
     * @return string $retval
     */
    protected function balanceChars($str, $open, $close) {
        $openCount = substr_count($str, $open);
        $closeCount = substr_count($str, $close);
        $retval = $openCount - $closeCount;
        return $retval;
    }

    /**
     * Explode, but ignore delimiter until closing characters are found
     *
     * @param string $delimiter
     * @param string $str
     * @param string $open
     * @param string $close
     * @return mixed $retval
     */
    protected function explode($delimiter, $str, $open = '(', $close = ')') {
        $retval = array();
        $hold = array();
        $balance = 0;
        $parts = explode($delimiter, $str);

        foreach ($parts as $part) {
            $hold[] = $part;
            $balance += $this->balanceChars($part, $open, $close);

            if ($balance < 1) {
                $retval[] = implode($delimiter, $hold);
                $hold = array();
                $balance = 0;
            }
        }

        if (count($hold) > 0)
            $retval[] = implode($delimiter, $hold);

        return $retval;
    }

    /**
     * Workaround for json_encode's UTF-8 encoding if a different charset needs to be used
     *
     * @param mixed result
     * @return string
     */
    protected function jsonify($result = FALSE) {
        if (is_null($result))
            return 'null';

        if ($result === FALSE)
            return 'false';

        if ($result === TRUE)
            return 'true';

        if (is_scalar($result)) {
            if (is_float($result))
                return floatval(str_replace(',', '.', strval($result)));

            if (is_string($result)) {
                static $jsonReplaces = array(array('\\', '/', '\n', '\t', '\r', '\b', '\f', '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $result) . '"';
            } else
                return $result;
        }

        $isList = TRUE;

        for ($i = 0, reset($result); $i < count($result); $i++, next($result)) {
            if (key($result) !== $i) {
                $isList = FALSE;
                break;
            }
        }

        $json = array();

        if ($isList) {
            foreach ($result as $value)
                $json[] = $this->jsonify($value);

            return '[' . join(',', $json) . ']';
        } else {
            foreach ($result as $key => $value)
                $json[] = $this->jsonify($key) . ':' . $this->jsonify($value);

            return '{' . join(',', $json) . '}';
        }
    }

    /**
     * @return mysql data as associative array
     */
    public function produce_assoc_output() {
        $aaData = array();
        $rResult = $this->get_display_result();
        $iTotal = $this->get_total_results();
        $iFilteredTotal = $this->get_total_results(TRUE);

        foreach ($rResult->result_array() as $row_key => $row_val) {
            $aaData[$row_key] = $row_val;
            $flip = array_flip($this->unset_columns);
            $aaData[$row_key] = array_diff_key($aaData[$row_key], $flip);
        }
        $sColumns = array_diff($this->columns, $this->unset_columns);
        $sColumns = array_merge_recursive($sColumns, array_keys($this->add_columns));

        $sOutput = array
            (
            'sEcho' => intval($this->ci->input->post('sEcho')),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => $aaData,
            'sColumns' => implode(',', $sColumns)
        );

        return $sOutput;
    }

}

/* End of file Datatables.php */
/* Location: ./application/libraries/Datatables.php */
