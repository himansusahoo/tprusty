<?php

/**
 * @param
 * @return
 * @desc
 * @author
 */
require_once APPPATH . "/third_party/PHPExcel.php";

class Excel_utility {

    public function __construct() {
        $this->_excel = new PHPExcel();
        $this->_set_active_sheet();
    }

    private $_configs = array();
    private $_row_indx = 0;
    private $_header_indx = 0;
    private $_last_column = '';
    private $_freeze_column = '';
    private $_auto_filter_flag = false;
    private $_freeze_column_flag = false;
    private $_excel;
    private $_active_sheet;
    private $_data_validation = false;

    private function _validate_options($config) {
        $flag = FALSE;
        if (is_array($config)) {
            if (isset($config['db_data']) && is_array($config['db_data']) && isset($config['header_rows']) && is_array($config['header_rows']) && isset($config['body_column']) && is_array($config['body_column'])) {
                $flag = TRUE;
                $this->_set_config($config);
            }
        }
        return $flag;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_config($config) {
        $this->_configs = $config;
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_active_sheet() {
        $this->_active_sheet = $this->_excel->getActiveSheet();
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _create_header() {
        if (is_array($this->_configs['header_rows'])) {
            $header = $this->_configs['header_rows'];

            foreach ($this->_configs['header_rows'] as $rows) {
                $this->_row_indx++;
                //start creating rows                
                $xcol = '';
                foreach ($rows as $col_indx => $cols) {
                    if ($xcol == '') {
                        $xcol = 'A';
                    } else {
                        $xcol++;
                    }
                    if (is_array($cols)) {

                        //merge cells
                        $range_cols = $xcol;
                        //merge cells
                        if (isset($cols['colspan'])) {
                            //this odd loop required to increate the xls char column increment
                            for ($lp = 1; $lp < $cols['colspan']; $lp++) {
                                ++$range_cols;
                            }
                            $this->_active_sheet->mergeCells($xcol . $this->_row_indx . ':' . $range_cols . $this->_row_indx);
                        }

                        if (array_key_exists('xls_header', $cols)) {
                            $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, strip_tags($cols['xls_header']));
                            //make header text bold                                
                            $this->_active_sheet->getStyle($xcol . $this->_row_indx . ':' . $xcol . $this->_row_indx)->getFont()->setBold(true);
                        } else {
                            if (isset($cols['title']) && isset($cols['value'])) {
                                $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, strip_tags($cols['title']));
                                $this->_active_sheet->SetCellValue(++$range_cols . $this->_row_indx, strip_tags($cols['value']));
                                //make header text bold                                
                                $this->_active_sheet->getStyle($xcol . $this->_row_indx . ':' . $xcol . $this->_row_indx)->getFont()->setBold(true);
                            } else if (isset($cols['title']) && (!isset($cols['value']) || $cols['value'] == '')) {
                                //set autofilter

                                if (isset($cols['track_auto_filter']) && $cols['track_auto_filter']) {
                                    $this->_auto_filter_flag = true;
                                }
                                $this->_header_indx = $this->_row_indx;
                                //set freeze column
                                if (isset($cols['freeze_column']) && $cols['freeze_column'] && !$this->_freeze_column) {
                                    $this->_freeze_column_flag = true;
                                    $this->_freeze_column = $xcol . ($this->_row_indx + 1);
                                }

                                $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, strip_tags($cols['title']));
                                //set column autowidth                               
                                $this->_active_sheet->getColumnDimension($xcol)->setAutoSize(true);
                                //make header text bold                                
                                $this->_active_sheet->getStyle('A' . $this->_row_indx . ':' . $xcol . $this->_row_indx)->getFont()->setBold(true);
                            }
                        }
                        $xcol = $range_cols;
                    }
                }
                //set for auto filter purpose
                $this->_last_column = $xcol;
                $this->_set_header_style();
            }
        }

        return $this;
    }

    private function _set_style_array() {
        
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_header_style() {
        $cellRange = 'A' . $this->_header_indx . ":" . $this->_last_column . $this->_header_indx;

        $style_overlay = array(
            'font' => array(
                'color' => array('rgb' => '000000')
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'CCCCFF')
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $this->_active_sheet->getStyle($cellRange)->applyFromArray($style_overlay);
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_auto_filter() {
        if ($this->_auto_filter_flag) {
            $cellRange = 'A' . $this->_header_indx . ":" . $this->_last_column . $this->_header_indx;
            $this->_active_sheet->setAutoFilter($cellRange);
        }
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_freeze_column() {
        if ($this->_freeze_column_flag) {
            $this->_active_sheet->freezePane($this->_freeze_column);
        }
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _create_body() {

        $this->_row_indx++;
        //pma($this->_configs['db_data'],1);
        foreach ($this->_configs['db_data'] as $data_row) {
            $xcol = '';
            foreach ($this->_configs['body_column'] as $col_indx => $cols) {
                if ($xcol == '') {
                    $xcol = 'A';
                } else {
                    $xcol++;
                }
                $range_cols = $xcol;
                //merge cells
                if (isset($cols['colspan'])) {
                    //this odd loop required to increate the xls char column increment
                    for ($lp = 0; $lp < $cols['colspan']; $lp++) {
                        ++$range_cols;
                    }
                    $this->_active_sheet->mergeCells($xcol . $this->_row_indx . ':' . $range_cols . $this->_row_indx);
                }

                if (array_key_exists($cols['db_column'], $data_row)) {
                    //$active_sheet->setCellValueByColumnAndRow($xcol, $this->_row_indx, $data_row[$cols['db_column']]);
                    //app_log('CUSTOM', 'APP', $xcol . $this->_row_indx . $cols['db_column'] . '=' . $data_row[$cols['db_column']]);
                    $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, $data_row[$cols['db_column']]);
                }
                $xcol = $range_cols;
            }
            $this->_row_indx++;
        }

        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_worksheet_name() {
        if (isset($this->_configs['worksheet_name'])) {
            $this->_active_sheet->setTitle($this->_configs['worksheet_name']);
        }
        return $this;
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _set_data_validation() {
//        sample code for validaation array
//        $data_validation=array(
//            'column_name/column_range'=>array(
//                'allow_blank_flag'=>'',
//                'show_input_message_flag'=>'',
//                'show_error_message_flag'=>'',
//                'show_dropdown_flag'=>'',
//                'error_popup_title_message'=>'',
//                'error_popup_body_message'=>'',
//                'tooltip_title_message'=>'',
//                'tooltip_body_message'=>'',
//                'formula_data'=>'',
//                'range_flag'=>''
//            )
//        );

        if (isset($this->_configs['data_validation']) && is_array($this->_configs['data_validation']) && count($this->_configs['data_validation']) > 0) {
            $objValidation = $this->_active_sheet->getDataValidation();
            $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $loop = 1;
            foreach ($this->_configs['data_validation'] as $column => $options) {

                if (isset($options['allow_blank_flag']) && $options['allow_blank_flag'] != '') {
                    $objValidation->setAllowBlank($options['allow_blank_flag']);
                }
                if (isset($options['show_input_message_flag']) && $options['show_input_message_flag'] != '') {
                    $objValidation->setShowInputMessage($options['show_input_message_flag']);
                }
                if (isset($options['show_error_message_flag']) && $options['show_error_message_flag'] != '') {
                    $objValidation->setShowErrorMessage($options['show_error_message_flag']);
                }
                if (isset($options['show_dropdown_flag']) && $options['show_dropdown_flag'] != '') {
                    $objValidation->setShowDropDown($options['show_dropdown_flag']);
                }
                if (isset($options['error_popup_title_message']) && $options['error_popup_title_message'] != '') {
                    $objValidation->setErrorTitle($options['error_popup_title_message']);
                }
                if (isset($options['error_popup_body_message']) && $options['error_popup_body_message'] != '') {
                    $objValidation->setError($options['error_popup_body_message']);
                }
                if (isset($options['tooltip_title_message']) && $options['tooltip_title_message'] != '') {
                    $objValidation->setPromptTitle($options['tooltip_title_message']);
                }
                if (isset($options['tooltip_body_message']) && $options['tooltip_body_message'] != '') {
                    $objValidation->setPrompt($options['tooltip_body_message']);
                }
                if (isset($options['formula_data']) && $options['formula_data'] != '') {
                    $objValidation->setFormula1($options['formula_data']);//data fromat should be like "'data1,data2,data3'"
                }
                $this->_active_sheet->setDataValidation("$column", $objValidation);
            }
        }
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function download_excel($config, $type = 'xls') {
        if ($this->_validate_options($config)) {
            $this->_create_header()
                    ->_create_body()
                    ->_set_auto_filter()
                    ->_set_data_validation()
                    ->_set_freeze_column()
                    ->_set_worksheet_name()
                    ->_download($type);
        } else {
            return FALSE;
        }
    }

    /**
     * @param
     * @return
     * @desc used to save the excel file
     * @author
     */
    public function save_excel() {
        if ($this->_validate_options($config)) {
            return $this->_create_header()
                            ->_create_body()
                            ->_set_auto_filter()
                            ->_set_freeze_column()
                            ->_set_header_style()
                            ->_write_file();
        } else {
            return FALSE;
        }
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _download($type) {

        $file_name = 'test_xls.xlsx';
        if (isset($this->_configs['file_name'])) {
            $file_name = $this->_configs['file_name'];
        }

        switch ($type) {
            case 'csv':
                $objWriter = PHPExcel_IOFactory::createWriter($this->_excel, 'CSV');
                ob_end_clean();
                ob_start();
                $objWriter->save("php://output");
                $xlsData = ob_get_contents();
                break;
            case 'xls':
                $objWriter = PHPExcel_IOFactory::createWriter($this->_excel, 'Excel2007');
                ob_end_clean();
                ob_start();
                $objWriter->save("php://output");
                $xlsData = ob_get_contents();
                break;
            default:
                $objWriter = PHPExcel_IOFactory::createWriter($this->_excel, 'Excel2007');
                ob_end_clean();
                ob_start();
                $objWriter->save("php://output");
                $xlsData = ob_get_contents();
        }
        ob_end_clean();
        $response = array(
            'op' => 'ok',
            'file' => "data:application/octet-stream;base64," . base64_encode($xlsData),
            'file_name' => $file_name
        );
        echo json_encode($response);
        exit();
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _write_file($full_filename) {
        if (isset($this->_configs['file_name']) && $this->_configs['file_name'] != '') {
            header('Pragma: ');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $full_filename . '"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit();
        }
        return false;
    }

}
