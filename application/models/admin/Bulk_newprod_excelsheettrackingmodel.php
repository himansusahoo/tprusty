<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_newprod_excelsheettrackingmodel extends CI_Model {

    function bulknewprod_excelfiletracking() {
        //$qr=$this->db->query("SELECT upload_dtime,gen_dt FROM bulkprod_templatelog WHERE status='Expired' group by date(upload_dtime) order by blk_tempid DESC ");



        /* $qr=$this->db->query("SELECT upload_dtime,gen_dt FROM bulkprod_templatelog WHERE status='Expired' AND (date(upload_dtime)>='2016-12-20' AND date(upload_dtime)<='2017-01-20') group by date(upload_dtime) order by date(upload_dtime) DESC "); */


        $dt = $date = date('Y-m-d');

        $qr = $this->db->query("SELECT upload_dtime,gen_dt FROM bulkprod_templatelog WHERE status='Expired' AND (date(upload_dtime)>='2016-12-20' AND date(upload_dtime)<='$dt') group by date(upload_dtime) order by date(upload_dtime) DESC ");


        return $qr;
    }

    function bulknewprod_excelfilereuploadstop() {
        $this->db->query("UPDATE bulkprod_templatelog SET reupload_processstatus='not process' WHERE reupload_processstatus='process' ");
    }

}

?>