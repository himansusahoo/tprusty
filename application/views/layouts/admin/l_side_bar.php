<aside class="main-sidebar">
    <section class="sidebar">
        <?php echo ($this->rbac->show_user_menu_top()) ?>        
    </section>
</aside>
<script>
    $(document).ready(function () {
        $('.set_rbac_select_menu').on('click', function (e) {
            e.preventDefault();
            var ids = $(this).attr('data-rbac_sel_menu');
            var menu_url=$(this).attr('href');
            var menu_promise = new Promise(function (resolve, reject) {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('rbac/rbac_users/set_selected_lmenu') ?>",
                    data: {
                        "menu_ids": ids
                    },
                    dataType: 'json',
                    success: function (data) {
                        resolve(data);
                    },
                    error: function (reason) {
                        reject(reason);
                    }
                });
            });
            menu_promise.then(function (resolve) {                
                window.location=menu_url;
            }, function (reason) {
                console.log('error', reason);                
            });
            
        });
    });
</script>