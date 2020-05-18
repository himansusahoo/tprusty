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
    function flattenArray($array, $callback = null,$group_function=null,$check_blank=null) {
        if (!is_array($array)) {
            return (array) $array;
        }

        $arrayValues = array();
        foreach ($array as $value) {
            if (is_array($value)) {
                foreach ($value as $val) {
                    if (is_array($val)) {
                        foreach ($val as $v) {  
                            if($check_blank){
                                if($v)
                                    $arrayValues[] = is_fun_callable($callback,$v);
                            }else{
                                $arrayValues[] = is_fun_callable($callback,$v);
                            }                                
                        }
                    } else {
                        if($check_blank){
                            if($val)
                                $arrayValues[] = is_fun_callable($callback,$val);
                        }else{
                            $arrayValues[] = is_fun_callable($callback,$val);
                        }
                    }
                }
            } else {
                if($check_blank){
                    if($value)
                        $arrayValues[] = is_fun_callable($callback,$value);
                }else{
                    $arrayValues[] = is_fun_callable($callback,$value);
                }
            }
        }
        if($group_function){
            return is_fun_callable($group_function,$arrayValues);        
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
                if(is_callable($fun)){
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
    function pma($arr_val,$exit_flag=0) {
       echo '<pre>';
        if(is_array($arr_val)){
            print_r($arr_val);
        }else{
            echo $arr_val;
        }
       echo '</pre>';
       if($exit_flag){
           exit('Exited here..');
       }
    }

}