<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>

<script>
   var acc = document.getElementsByClassName("first-accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
    </script>

