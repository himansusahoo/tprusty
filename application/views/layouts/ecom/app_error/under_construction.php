<style>     
    .img_div {        
        background-attachment: local;
        background-image: url("images/under_construction.jpg");
        background-repeat: no-repeat;
        background-size: 70% 100%;
        background-position: center;
    }    
</style>
<div class="col-sm-12 text-center">
    <div class="img_div"></div>
</div>
<script>
    $(document).ready(function () {
        function set_img_height() {
            var headerH = $('.header').height();
            var footerH = $('.footer').height();
            var navTitleH = $('.breadcrumb').height();
            var docH = $(document).height();
            var margin = 80;
            if (docH > 560) {
                margin = 100;
            }
            var searchH = docH - (footerH + headerH + navTitleH + margin);
            $('.img_div').css('height', searchH);
            console.log('docH', docH);
        }
        set_img_height();

        $(window).resize(function () {
            set_img_height();
        });
    });
</script>