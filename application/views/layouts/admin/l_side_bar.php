<aside class="main-sidebar">
    <section class="sidebar">
        <div id="main_side_bar">
            <?php echo ($this->rbac->show_user_menu_top()) ?>
        </div>        
    </section>
</aside>
<script>
    $(document).ready(function () {
        
        $('#main_side_bar').slimscroll({
            height: '98%',
            color: '#fff',            
            size: '5px'
        });
        $('.set_rbac_select_menu').on('click', function (e) {
            e.preventDefault();
            var ids = $(this).attr('data-rbac_sel_menu');
            var menu_url = $(this).attr('href');
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
                window.location = menu_url;
            }, function (reason) {
                console.log('error', reason);
            });

        });
    });
</script>