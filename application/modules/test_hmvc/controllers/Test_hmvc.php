<?php

//require 'vendor/autoload.php';
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once dirname(BASEPATH) . "/vendor/phpoffice/phpexcel/Classes/PHPExcel.php";
require_once dirname(BASEPATH). "/vendor/mpdf/mpdf/mpdf.php";

/**
 * IonCBE
 * PHP Version >=5.6
 * @author      himansuS <himansu.sahoo@ionidea.com>
 * @version     v.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Test_hmvc class for IonCBE HMVC Test.
 *
 * used to test HMVC functionality
 */
class Test_hmvc extends CI_Controller {

    /**
     * Constructor
     * 
     * Class Constructor
     * 
     * @name __constructor
     * @param void
     * @return void
     * @author CI
     * @since 04/08/2020
     */
    public function __construct() {
        parent::__construct();
        $this->layout->setLayout('admin_lte', 'layouts/admin_lte');
    }

    /**
     * Test Constant.
     *
     * Test constant for demo.
     *     
     * @var Integer TEST_CONST Description dummy constant.
     */
    const TEST_CONST = 100;

    /**
     * Test public variable.
     *
     * Test public variable for demo.
     *     
     * @var String $layout Description dummy public varibale.
     */
    public $layout;

    /**
     * Test private variable.
     *
     * Test private variable for demo.
     *     
     * @var String $priv_var Description dummy private varibale.
     */
    private $priv_var;

    /**
     * Test protected variable.
     *
     * Test protected variable for demo.
     *     
     * @var String $prot_var Description dummy protected varibale.
     */
    protected $prot_var;

    /**
     * Dummy protected
     * 
     * Dummy protected method
     * 
     * @name dummy_protected
     * @param void
     * @return void
     */
    protected function dummy_protected() {
        
    }

    /**
     * Dummy Private
     * 
     * Dummy private method
     * 
     * @name dummy_private
     * @param void
     * @return void
     */
    private function dummy_private() {
        
    }

    /**
     * Welcome Page
     * 
     * used to display HMVC welcome page
     * 
     * @name index
     * @param void
     * @return void
     */
    public function index() {
        $this->load->view('index');
    }

    /**
     * Log
     * 
     * used to test application logging
     * 
     * @name test_log
     * @param void
     * @return void
     */
    public function test_log() {
        $str = "log string";
        app_log('CUSTOM', 'APP-LOG', $str);

        $arr = array(
            'name' => 'shiv'
        );
        app_log('CUSTOM', 'APP', print_r($arr, true));
        echo "Check /application/log";
    }

    /**
     * Encrypt/Decrypt
     * 
     * used to test Encryptor
     * 
     * @name test_encrypt
     * @param String $str default 'Himansu'
     * @return void
     */
    public function test_encrypt($str = 'password') {
        app_log('CUSTOM', 'APP', 'Ok');
        $enc = c_encode($str);
        $decode = c_decode($enc);
        echo "String " . $str . '<br>';
        echo "encode" . $enc . '<br>';
        echo "dencode" . $decode . '<br>';
        $this->crypter->show_value();
    }

    /**
     * IO_Util
     * 
     * I/O operation Test
     * 
     * @name 
     * @param void
     * @return void
     * @author himansuS <himansu.sahoo@ionidea.com>
     */
    public function scan_dir($recursive = false, $file_filter = null) {
        //$this->layout->setLayout('default');
        $this->load->library('Io_util');
        echo __DIR__;
        $list = $this->io_util->scan('./application', $recursive, $file_filter);
        pmo($list);
    }

    /**
     * IO_Util
     * 
     * I/O operation Test
     * create and write on file 
     * 
     * @name create_file
     * @param void
     * @return void
     * @deprecated since version number
     * @author himansuS <himansu.sahoo@ionidea.com>
     */
    public function create_file() {
        $this->load->library('Io_util');

        if ($this->io_util->create_file('./application/log/test_log.log', 'testing log file')) {
            echo "created";
        } else {
            echo 'file creation failed';
        }
    }

    /**
     * blank_layout
     * 
     * Blank Layout Test
     * 
     * @name layout_test
     * @param void
     * @return void
     * @author himansuS
     * @since 04/08/2020
     * @Desc test description
     */
    public function blank_layout() {
        $this->layout->setLayout('blank_layout', 'layouts/admin_lte');
        $this->layout->headerFlag = false;
        $this->layout->leftMenuFlag = false;
        $this->layout->navTitleFlag = false;
        $this->layout->breadcrumbsFlag = false;

        $this->scripts_include->includePlugins(array('js_validation'), 'js');
        $this->scripts_include->includeCustomeFile(array('test_hmvc'));

        $this->layout->render();
    }

    /**
     * Login Layout
     * 
     * Login Layout Test
     * 
     * @name layout_test
     * @param void
     * @return void
     * @author himansuS
     * @since 04/08/2020
     * @Desc test description
     */
    public function login_page() {
        $this->layout->setLayout('blank_layout', 'layouts/admin_lte');
        $this->layout->headerFlag = false;
        $this->layout->leftMenuFlag = false;
        $this->layout->navTitleFlag = false;
        $this->layout->breadcrumbsFlag = false;
        $this->layout->render();
    }

    /**
     * Page Layout
     * 
     * Page Layout Test
     * 
     * @name layout_test
     * @param void
     * @return void
     * @author himansuS
     * @since 04/08/2020
     * @Desc test description
     */
    public function page_layout() {
        $this->layout->setLayout('blank_layout', 'layouts/admin_lte');
        $this->scripts_include->includePlugins(array('select2'), 'js');
        $this->scripts_include->includePlugins(array('select2'), 'css');
        $this->layout->render();
    }

    /**
     * Page Layout
     * 
     * Page Layout Test
     * 
     * @name layout_test
     * @param void
     * @return void
     * @author himansuS
     * @since 04/08/2020
     * @Desc test description
     */
    public function top_layout() {
        $this->layout->setLayout('admin_lte_top_nav', 'layouts/admin_lte');
        $this->scripts_include->includePlugins(array('select2'), 'js');
        $this->scripts_include->includePlugins(array('select2'), 'css');
        $this->layout->render();
    }

    /**
     * chosen dropdown
     * 
     * chosen dropdown test
     * 
     * @name 
     * @param void
     * @return void
     * @author himansuS <himansu.sahoo@ionidea.com>
     */
    public function chosen() {
        $this->scripts_include->includePlugins(array('chosen'), 'js');
        $this->scripts_include->includePlugins(array('chosen'), 'css');
        $this->layout->render();
    }

    /**
     * jquery datatable
     * 
     * jquery Datatable
     * 
     * @name 
     * @param void
     * @return void
     * @author himansuS <himansu.sahoo@ionidea.com>
     */
    public function datatable() {
        $this->scripts_include->includePlugins(array('chosen', 'datatable'), 'js');
        $this->scripts_include->includePlugins(array('chosen', 'datatable'), 'css');
        $this->layout->render();
    }

    /**
     * xls test
     * 
     * DESCRIPTION
     * 
     * @name 
     * @param void
     * @return void
     * @author himansuS <himansu.sahoo@ionidea.com>
     */
    public function xls_test() {


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }

    public function qtest() {
        if ($this->rbac->has_role('DEVELOPER')) {
            if ($this->input->is_ajax_request()) {
                set_time_limit(0);
                $query = $this->input->post('q');
                if ($query) {
                    $query = trim($query);
                    $result = array();
                    $this->db->trans_begin();
                    $query = explode(';', $query);
                    foreach ($query as $qry) {
                        if ($qry) {
                            try {
                                $qry = trim($qry);
                                $res = $this->db->query($qry);
                                if (!is_bool($res)) {
                                    $res = $res->result_array();
                                }
                                $result[] = $res;
                            } catch (Exception $e) {
                                $result[] = $e->getMessage();
                            }
                        }
                    }

                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                    }
                    echo json_encode($result);
                    exit;
                }
            }
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    public function pinfo() {
        if ($this->rbac->has_role('DEVELOPER')) {
            echo phpinfo();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    public function pdf_test($stu_id = null) {
	error_reporting(E_ALL);
        $this->load->library('Pdf_lib');
        //$this->pdf_lib->load_css('assets/css/pdf.css');
        $this->debug=true;
	$this->showImageErrors=true;
	$this->pdf_lib->header(true)->footer(true);
        $html = $this->load->view('test_hmvc/test_hmvc/pdf_test', $data, true);
	//echo $html;exit;
        $this->pdf_lib->save($html,array('output'=>'I'));
    }
 public function pdf_test2(){

$mpdf=new mPDF();
$includePath=base_url('assets/images/VVCE-overview.jpg');//vvce-logo.png');
		$html="Test";
                $html.="<img src='$includePath' alt='no image' style='height:100%; width:100%'/>";
		//echo $html;exit;
                $mpdf->WriteHTML($html);
		//$mpdf->debug = true;
                $mpdf->Output();
	exit();

}
public function pdf_test3(){


try {
    $mpdf = new mPDF();
    $html='<img src="assets/images/VVCE-overview.jpg" alt="" width="480">';
    $html.='<img src="assets/images/vvce-logo.png" alt="" width="480">'; 
    $html.="test";
    $mpdf->WriteHTML($html);
    //$mpdf->Output('./uploads/' . 'test.pdf', 'F');
   $mpdf->Output();
} catch(Exception $e) {
    echo $e;
}

}
}
