<style>
.fltr {
    float: left;
    padding: 10px 0px;
    text-align: center;
    width: 32%;
    margin: 1px;
}
.fltr ul{
  display:block;
  list-style-type: none;
  text-align:center;
  
}
.fltr ul li{
	font-size: 14px;
    padding: 5px;
    width: 108px;
    margin: 2px auto 0px;
    height: 35px;
    background: #f7f7f7;
    color: #777;
    border: 2px solid #dedede;
    display: block;
  display: inline-block;
  color: white;
  font-family: sans-serif;
  font-weight: 800;
  position:relative;
         -webkit-user-select: none;
     -moz-user-select: none;    
     -ms-user-select: none;  
     user-select: none;
}
. fltr ul li:hover{
  background: #f9a1c6;
  color: #000;
}
.fltr ul li .dropdown{
  display:none;
  width: 100%;
  padding:0; margin:0;
  background: green;
  position: absolute;
  top: 45px;
  left:0;
}
.fltr ul li .dropdown li{
  width: 100%;
    display: block;
    padding: 10px 0px;
    margin: 0px;
    color: #0066c0;
    font-weight: normal;
    border: none;
    text-align: left;
    height: auto;
    font-size: 10px;
    border-bottom: 1px solid #ccc;
}
.fltr a{width: 101px; margin:2px;height: auto;}
#dd:checked ~ .dropdown{
  display:block;
  margin-top: -10px;
  z-index:9999999;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
  
}
.agile-products {
    max-height: 350px;
    height: 250px;
}
.agile-products img{
	height: 112px;
    max-width: 100%;
    margin: auto;
    text-align: center;
}
.products {
    padding: 0 0 14px 0;
}
</style>

<div class="filter">
<?php
      //remove brand parameter if brand is already in the url parameter program start here
		if(strpos($this->uri->segment(4),'price') !== false){
			$array = explode('&',$this->uri->segment(4));
			$param = array();
			foreach($array as $key=>$val){
				$arr1 = preg_split('/=/',$val);
				if($arr1[0] != 'price'){
					//$param[] = $arr1[0].'='.$arr1[1];
					array_push($param,$arr1[0].'='.$arr1[1]);
				}
			}
			
			//making parameter array to string
			if(!empty($param)){
				$strng = implode('&',$param);
			}else{
				$strng = 'NOT';
			}
		}
		//remove brand parameter if brand is already in the url parameter program end here
		else{
			$strng = $this->uri->segment(5);
		}
      ?>
<!---------------------------------------------------------------Start 26-06-2017-mamata short by menu----------------------------------------------------> 
<div class="filter">
                <div class="col-md-2 fltr"> <a href="#" onClick=""> Filters </a> </div>
                 <div class="col-md-2 fltr"> <a href="#" onClick=""><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-up.png" width="18"> Price
<!--<div><img src="<?php //echo base_url().'mobile_css_js/' ?>images/short-icon/price-down.png" width="18"> Price</div>-->
</a></div>
                 
                 <div class="col-md-2 fltr"> 
                 	<ul>
                          <li><label for="dd" style="color:#0066c0;">Sort By</label>
                            <input type="checkbox" id="dd" hidden>
                                <ul class="dropdown">
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-up.png" width="18"> Price Low to High</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/price-down.png" width="18"> Price High to Low</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/popularity.png" width="18"> Popularity</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/discount.png" width="18"> Discount</li>
                                  <li><img src="<?php echo base_url().'mobile_css_js/' ?>images/short-icon/whats-new.png" width="18"> What's New</li>
                                </ul>
                          </li>
                    </ul>
                    
                  </div>
               
               
               <div class="clearfix"> </div>
               </div>



<!---------------------------------------------------------------End 26-06-2017-mamata short by menu----------------------------------------------------> 




     
      
               <!--<div class="col-md-6 fltr"> <a href="#" onClick="showfilter()"> Filters </a> </div>-->
               <!--<div class="col-md-6 fltr">  
               <select class="form-select" onChange="sortby_price(this.value,'<?=$label_name;?>','<?=$label_id;?>','<?php if($this->uri->segment(4) != ''){ echo $strng;}else{ echo 'NOT';}?>')">
               <option value=''> Short By </option>
                <option value="Low-To-High" <?php /*?><?php if(@$arr1[1]=='Low-To-High') {echo "selected";}?><?php */?>> Price: Low To High </option>
               <option value="High-To-Low" <?php /*?><?php if(@$arr1[1]=='High-To-Low') {echo "selected";}?><?php */?>> Price: High To Low </option>
              <!-- <option> Featured </option>
               <option> Price </option>
               <option> Color </option>
               <option> Brand </option>-->
               <!--</select>-->
               
               <!--</div>-->
               <div class="clearfix"> </div>
               </div>

<div class="filterpanel">
               <div class="filters-head">
                  <div class="filter-result">
                  <h4>Refine Your Results</h4>
                   <div id="clearFilter" class="clear-all">Clear All</div>
                   </div>
                 <div class="fltrclose"> <a href="#" onClick="fltrclose()"> <img src="<?php echo base_url().'mobile_css_js/' ?>images/close.png" width="16" height="16" alt=""> </a> </div>
                 <div class="clearfix"></div>
                 </div>
         <div class="fltrtabs">
         <!-- Nav tabs -->
          <ul class="nav nav-tabs filter-tabs sideways">
            <li class="active"><a href="#tab1" data-toggle="tab"> Brand </a></li>
            <li><a href="#tab2" data-toggle="tab"> Capacity</a> </li>
            <li><a href="#tab3" data-toggle="tab"> Price</a> </li>
            <li><a href="#tab4" data-toggle="tab"> Type </a> </li>
            <li><a href="#tab5" data-toggle="tab"> Discount %  </a> </li>
            <li><a href="#tab6" data-toggle="tab"> Connectivity  </a> </li>
            <li><a href="#tab7" data-toggle="tab"> Customer Rating  </a> </li>
            <li><a href="#tab8" data-toggle="tab"> Color </a> </li>
            <li><a href="#tab9" data-toggle="tab"> Occasion  </a> </li>
          </ul>
      </div>

        <div class="fltr-cont">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
            <div class="single-bottom"> <label for="accessible"> <input type="radio" value="accessible" name="quality" id="accessible"> <span></span> accessible</label> </div>
            <div class="single-bottom"> <label for="party"> <input type="radio" value="party" name="quality" id="party"> <span></span> <party/label></div>
            <div class="single-bottom"> <label for="rock"> <input type="radio" value="rock"  name="quality" id="rock" checked> <span></span> Rock</label></div>
            <div class="single-bottom"> <label for="pop"> <input type="radio" value="pop" name="quality" id="pop"> <span></span>  Pop </label></div>
            <div class="single-bottom"> <label for="classical"> <input type="radio" value="classical"  name="quality" id="classical" checked> <span></span> classical</label>
            </div>
            
            </div>
            <div class="tab-pane" id="tab2">
            <div class="single-bottom">
			<input type="checkbox" id="brand" value="">
			<label for="brand"><span></span> HP(102)</label>
			</div>
            <div class="single-bottom">
			<input type="checkbox" id="brand2" value="">
			<label for="brand2"><span></span> Dell(182)</label>
            </div>
            <div class="single-bottom">
			<input type="checkbox" id="brand3" value="">
			<label for="brand3"><span></span> Lenovo(108) </label>
            </div>
            <div class="single-bottom">
			<input type="checkbox" id="brand4" value="">
			<label for="brand4"><span></span> Acer(42)</label>
            </div>
            <div class="single-bottom">
			<input type="checkbox" id="brand5" value="">
			<label for="brand5"><span></span> Apple(23)</label>
            </div>
            <div class="single-bottom">
			<input type="checkbox" id="brand6" value="">
			<label for="brand6"><span></span> Asus(82)</label>
            </div>
            
            
            </div>
            <div class="tab-pane" id="tab3">
            <div class="price-range">FROM :<br><input id="start_pric" type="text" placeholder="(Rs.)" name="start_pric"></div>
            <div class="price-range">TO :<br><input id="end_pric" type="text" placeholder="(Rs.)" name="end_pric"></div>
            <input class="btn-success" type="button" value="Search">

            </div>
            <div class="tab-pane" id="tab4">Settings Tab.</div>
            <div class="tab-pane" id="tab5">Home Tab.</div>
            <div class="tab-pane" id="tab6">Profile Tab.</div>
            <div class="tab-pane" id="tab7">Messages Tab.</div>
            <div class="tab-pane" id="tab8">Settings Tab.</div>
            <div class="tab-pane" id="tab9">Settings Tab.</div>
          </div>
        </div>

        <div class="clearfix"></div>
        
                  <div class="btn_form">
				  <a href="#"> <span class="apply"> Apply </span> </a>	
                  </div>
        
               </div>