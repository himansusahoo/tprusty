<?php /*?><div class="category" style="margin:10px 0px;">
                <ul class="cssmenu">
                  <li class="has-sub"><a href="#"> My Stuff </a>
                  <ul>
                  <li> <a href="<?php echo base_url().'user/orders'; ?>"> My Order</a></li>
                  <li> <a href="<?php echo base_url(); ?>review-rating"> My Reviwes & Ratings </a></li>
                  <li> <a href="<?php echo base_url(); ?>wish-list"> My Wishlist</a></li>
                  <li> <a href="<?php echo base_url(); ?>my_wallet"> My Wallet </a></li>
                  <li> <a href="<?php echo base_url(); ?>gift-voucher"> Gift Voucher</a></li>
                 </ul>
                 </li>
                 <li class="has-sub"><a href="#"> Settings </a>
                  <ul>
                  <li> <a href="<?php echo base_url().'user/profile' ?>"> Personal Information </a></li>
                  <li> <a href="<?php echo base_url().'user/change_password' ?>"> Change Password </a></li>
                  <li> <a href="#"> Deactivate Account </a></li>               
                 </ul>
                 </li>
               </ul> 
               </div><?php */?>
 <style>
 
 <style>

.accordion {
  border: 1px solid white;
  padding: 0 10px;
  margin: 0 auto;
  list-style: none outside;
}

.accordion > * + * { border-top: 1px solid white; }

.accordion-item-hd {
  display: block;
  position: relative;
  cursor: pointer;
  font-size: 16px;
  display: block;
font-size: 16px;
font-family: 'SegoeUI-SemiBold';
padding: 10px;text-decoration: none;
color: #0066c0;
}

.accordion-item-input:checked ~ .accordion-item-bd {
  max-height: 1000px;
  padding-top: 15px;
  margin-bottom: 15px;
  -webkit-transition: max-height 1s ease-in, margin .3s ease-in, padding .3s ease-in;
  transition: max-height 1s ease-in, margin .3s ease-in, padding .3s ease-in;
}

.accordion-item-input:checked ~ .accordion-item-hd > .accordion-item-hd-cta {
  -webkit-transform: rotate(0);
  -ms-transform: rotate(0);
  transform: rotate(0);
}

.accordion-item-hd-cta {
  display: block;
  width: 30px;
  position: absolute;
  top: calc(50% - 6px );
  /*minus half font-size*/
  right: 0;
  pointer-events: none;
  -webkit-transition: -webkit-transform .3s ease;
  transition: transform .3s ease;
  -webkit-transform: rotate(-180deg);
  -ms-transform: rotate(-180deg);
  transform: rotate(-180deg);
  text-align: center;
  font-size: 12px;
  line-height: 1;
}

.accordion-item-bd {
  max-height: 0;
  margin-bottom: 0;
  overflow: hidden;
  -webkit-transition: max-height .15s ease-out, margin-bottom .3s ease-out, padding .3s ease-out;
  transition: max-height .15s ease-out, margin-bottom .3s ease-out, padding .3s ease-out;
  background: #eee;
  
}

.accordion-item-input {
  clip: rect(0 0 0 0);
  width: 1px;
  height: 1px;
  margin: -1;
  overflow: hidden;
  position: absolute;
  left: -9999px;
}
.accordion-item{
background-color: #f8f8f8;
    display: block;
    border-bottom: 1px dashed #ccc;	
}
.sub{     display: block;
    font-size: 16px;
    font-family: 'SegoeUI-SemiBold';
    padding: 10px;
    text-decoration: none;
    color: #333 !important;
    border-bottom: 1px solid #de9800;}
.sub a{ color:#333!important;}	
	

 </style>              
               
 <ul class="accordion css-accordion" style="margin-bottom:10px;">
  <li class="accordion-item">
    <input class="accordion-item-input" type="checkbox" name="accordion" id="item1" />
    <label for="item1" class="accordion-item-hd">My Stuff<span class="accordion-item-hd-cta">&#9650;</span></label>
    <div class="accordion-item-bd">
    <ul>
		<li class="sub"> <a href="<?php echo base_url().'user/orders'; ?>"> My Order</a></li>
		<li class="sub"> <a href="<?php echo base_url(); ?>review-rating"> My Reviwes & Ratings </a></li>
		<li class="sub"> <a href="<?php echo base_url(); ?>wish-list"> My Wishlist</a></li>
		<li class="sub"> <a href="<?php echo base_url(); ?>my_wallet"> My Wallet </a></li>
		<li class="sub"> <a href="<?php echo base_url(); ?>gift-voucher"> Gift Voucher</a></li>
	</ul>
    </div>
  </li>
  <li class="accordion-item">
    <input class="accordion-item-input" type="checkbox" name="accordion" id="item2" />
    <label for="item2" class="accordion-item-hd">Settings<span class="accordion-item-hd-cta">&#9650;</span></label>
    <div class="accordion-item-bd">
    	<ul>
                  <li class="sub"> <a href="<?php echo base_url().'user/profile' ?>"> Personal Information </a></li>
                  <li class="sub"> <a href="<?php echo base_url().'user/change_password' ?>"> Change Password </a></li>
                  <li class="sub"> <a href="#"> Deactivate Account </a></li>               
                 </ul>
     </div>
  </li>
  
</ul>


              