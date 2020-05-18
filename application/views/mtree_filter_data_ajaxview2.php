<style>
.multi-dropdown {
  width: 95%;
  max-width: 360px;
  margin: 0px auto 0px;
  background: #ECECEC;
  /*-webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;*/
  border: 1px solid #ccc;
}

.multi-dropdown .link {
  cursor: pointer;
  display: block;
  padding: 5px 0px 5px 12px;
    color: #333;
    font-size: 13px;
    font-weight: normal;
  border-bottom: 1px solid #CCC !important;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
  background: url(<?php echo base_url();?>new_css/css/menu_images/icon_plus.png) 91% center no-repeat;
}
.link-after {
	cursor: pointer;
  display: block;
  padding: 5px 0px 5px 12px;
    color: #333;
    font-size: 13px;
    font-weight: normal;
  border-bottom: 1px solid #CCC !important;
  position: relative;
  background: url(<?php echo base_url();?>new_css/css/menu_images/icon_minus.png) 91% center no-repeat;
}


.multi-dropdown li:last-child .link { border-bottom: 0; }

/*.multi-dropdown li i {
  position: absolute;
  top: 8px;
  left: 12px;
  font-size: 18px;
  color: #595959;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.multi-dropdown li i.fa-chevron-down {
      right: 24px;
    left: auto;
    font-size: 10px
}

.multi-dropdown li.open .link { color: #b63b4d; }

.multi-dropdown li.open i { color: #b63b4d; }

.multi-dropdown li.open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}*/

/**
 * Submenu
 -----------------------------*/
.multi-dropdown-submenu {
  display: none;
  background: #444359;
  font-size: 14px;
}

.multi-dropdown-submenu li { border-bottom: 1px solid #4b4a5e; }

.multi-dropdown-submenu a {
  display: block;
  text-decoration: none;
  color: #d9d9d9;
  padding: 12px;
  padding-left: 42px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}

.multi-dropdown-submenu a:hover {
  background: #b63b4d;
  color: #333;
}
.single-bottom label { 
display: block; 
position:relative; 
font-size: 13px; 
color: #000; 
font-weight:bold;
padding-left:30px;
margin-bottom:10px;
 }
.single-bottom label:hover{color: #fff; }
.single-bottom input[type="checkbox"] {  display: none;}
.single-bottom input[type="checkbox"]+label span:first-child {
	width:16px; 
	height:16px; 
	display: inline-block; 
	border: 2px solid #333; 
	position: absolute; 
	left: 0; top: 0px;
}
.single-bottom input[type="checkbox"]+label span:hover {
	border: 2px solid #333; 
}
.single-bottom input[type="checkbox"]:checked+label span:first-child:before { content: ""; background: url(<?php echo base_url();?>mobile_css_js/images/mark1.png) no-repeat; position: absolute; left:2px; top:0px;  font-size: 10px; width:13px; height:13px; }
.single-bottom [type="radio"] {display:none;}
/* the basic, unchecked style */
.single-bottom [type="radio"] + span:before { content: ''; display:inline-block; width:20px; height:20px; border-radius: 50px; border: 2px solid #fff; box-shadow: 0 0 0 3px #ccc;margin-right:10px; transition: 0.5s ease all; position: absolute; top:4px; left:0;}
/* the checked style using the :checked pseudo class */
.single-bottom [type="radio"]:checked + span:before { background: #067AB4; box-shadow: 0 0 0 3px #ccc;}

</style>


<?php
		  if(@$filter_dataid['facet_counts']['facet_fields']){
          $arrbrand=array_keys($filter_dataid['facet_counts']['facet_fields']);
		  $cnt_brand=count($arrbrand);
		  if($cnt_brand>0){
		  ?>

		<ul id="<?php echo 'multi-dropdown'.$mtree2id; ?>" class="multi-dropdown">

		<?php
			for($i_arrbrand=0; $i_arrbrand<$cnt_brand; $i_arrbrand++ ) {
				if(count(@$filter_dataid['facet_counts']['facet_fields'][$arrbrand[$i_arrbrand]])>0){
	 		?>


  <li>
    <div class="link" onclick="click_ul_lifilter('nocatlvl','<?php echo $mtree2id.$i_arrbrand; ?>')"><?php echo str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand]);?><!--<i class="fa fa-chevron-down"></i>--></div>
    <ul class="multi-dropdown-submenu">
    <?php
			//print_r($filter_dataid['facet_counts']['facet_fields']);
			$cnt=count($filter_dataid['facet_counts']['facet_fields'][$attribute]);
			for($i=0,$j=1; $i<$cnt-1; $i+=2,$j+=2 ) {
            ?> 
      <li class="<?php echo str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand]);?>" id="<?php echo 'labelid'.$mtree2id.$i_arrbrand.$i;?>">
          <a href="#" style="padding:8px 5px 1px;">
               <div class="single-bottom" title="Apple">
                    <input type="checkbox" onClick="<?php if(str_replace('_',' ',$attribute=$arrbrand[$i_arrbrand])=='Brand'){?>arrck2();<?php }?>filter_dataajax('<?php echo $mtree2id.$i_arrbrand.$i ?>')" id="<?php echo 'filter_productId'.$mtree2id.$i_arrbrand.$i ?>" name="filter_productId[]" value="<?php echo $id.'|'.$attribute.'|'.$filter_dataid['facet_counts']['facet_fields'][$attribute][$i] ?>">
                    <label for="<?php echo 'filter_productId'.$mtree2id.$i_arrbrand.$i ?>"><span></span> 
					<?php echo ucwords($filter_dataid['facet_counts']['facet_fields'][$attribute][$i])?>
                    <span id="<?php echo 'spanpcountid'.$mtree2id.$i_arrbrand.$i;?>"> <?php echo '('.$filter_dataid['facet_counts']['facet_fields'][$attribute][$j].')'?> 
                    </span>
                    </label>
               </div>
          </a>
       </li>
       <input style="display:none;" type="text" value="<?php echo $filter_dataid['responseHeader']['params']['useParams'].':'.$attribute.':'.$filter_dataid['facet_counts']['facet_fields'][$attribute][$i];?>" name="2cktextbox[]" id="" class="" /><input style="display:none;" type="text" value="<?php echo $mtree2id.$i_arrbrand.$i;?>" name="2cktextboxid[]" id="" class="" /><input style="display:none;" type="text" value="<?php echo $filter_dataid['facet_counts']['facet_fields'][$attribute][$j];?>" name="2datacount[]" id="" class="" />
       <?php }?>
       
    </ul>
  </li>
  
  
  <?php }}?>
  <?php 
  //$query=$this->db->query("SELECT category_id FROM product_filtersetup WHERE category_id='$category_id' ");
  //if($query->num_rows()>0){
	  
	  $qry=$this->db->query("SELECT url_displayname FROM category_menu_desktop WHERE category_id in($category_id) limit 1;");
	  $url=$qry->row()->url_displayname;
  ?>
  <a href="<?php echo base_url().$url;?>" style="text-align:center; font-size:13px; color:#ee7c1f;">More Attributes</a>
  <?php //}?>
</ul>

<?php }}?>


<script>
$(function() {
	var mtree2id='<?php echo $mtree2id; ?>';
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.multi-dropdown-submenu ').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#multi-dropdown'+mtree2id), false);
});

$('.multi-dropdown li div').click(function() {
    $(this).toggleClass('link-after link');
});


</script>          