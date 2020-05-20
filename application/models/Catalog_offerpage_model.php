<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog_offerpage_model extends CI_Model {

    function offerproduct_categoryname() {

        $img_sqlid = $this->uri->segment(3);

        $qr_sku = $this->db->query("SELECT sku FROM mobilesite_imageinfo WHERE img_sqlid='$img_sqlid' ");


        $label_name = $this->uri->segment(2);
        $catg_menuqr = $this->db->query("SELECT dskmenu_lbl_id FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
        $lbl_id = $catg_menuqr->row()->dskmenu_lbl_id;
        $catg_menuqr = $this->db->query("SELECT category_id FROM category_menu_mobile WHERE parent_id='$lbl_id'  AND category_id!='' ");

        $rw_catgmenu = $catg_menuqr->result();

        $arry_catgid = array();

        foreach ($rw_catgmenu as $res_catgmenu) {
            array_push($arry_catgid, $res_catgmenu->category_id);
        }



        $catg_id = implode(',', $arry_catgid);


        /* $qr=$this->db->query("select * from category_menu_mobile where category_id IN ($catg_id) AND dskmenu_lbl_id!='$label_id' AND parent_id='$label_id' AND order_by!=0 AND is_active='Yes' order by order_by "); */

        $qr = $this->db->query("select imag ,lvl2 as category_id,lvl2_name as category_name from cornjob_productsearch  WHERE lvl2 IN ($catg_id) AND product_id!=0 AND quantity>0 AND prod_status='Active' AND status='Enabled' AND seller_status='Active' AND imag!='' group by lvl2 ORDER BY product_id DESC  ");


        return $qr;
    }

}
?>>