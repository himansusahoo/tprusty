(function ($) {

    var matched, browser;

    jQuery.uaMatch = function (ua) {
        ua = ua.toLowerCase();

        var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
                /(webkit)[ \/]([\w.]+)/.exec(ua) ||
                /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
                /(msie) ([\w.]+)/.exec(ua) ||
                ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
                [];

        return {
            browser: match[ 1 ] || "",
            version: match[ 2 ] || "0"
        };
    };

    matched = jQuery.uaMatch(navigator.userAgent);
    browser = {};

    if (matched.browser) {
        browser[ matched.browser ] = true;
        browser.version = matched.version;
    }

// Chrome is Webkit, but Webkit is also Safari.
    if (browser.chrome) {
        browser.webkit = true;
    } else if (browser.webkit) {
        browser.safari = true;
    }

    jQuery.browser = browser;
    //APP CODE   

    $('#admin_login_submit').on('click', function (e) {
        e.preventDefault();

        $("#admin_login").validate({
            rules: {
                user_email: {
                    required: true,
                    email: true
                },
                user_pass: "required"
            },
            messages: {
                user_email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid emial address"
                },
                user_pass: "Please enter your password",
            },
            errorLabelContainer: $("#login_error")
        });
        if ($("#admin_login").valid()) {
            $("#admin_login").submit();
        }
    });


    $('#rbac_create_users_submit').on('click', function (e) {
        e.preventDefault();

        $("#rbac_create_users").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: "required",
                re_password: {
                    equalTo: "#password"
                },
                mobile: "required",
                roles: "required",
                status: "required",
            },
            messages: {
                user_email: {
                    required: "Please enter email address",
                    email: "Please enter a valid emial address"
                },
                password: "Please enter password",
                re_password: 'Password do match',
                mobile: "Please enter mobile number",
                roles: "Please select roles for user",
                status: "Please user status",
            }
        });
        if ($("#rbac_create_users").valid()) {
            $("#rbac_create_users").submit();
        }
    });

//APP CODE
    //enable tooltip
    $('[data-toggle="tooltip"]').tooltip()

    $('#default_modal').on('click', function () {
        var params = {
            'type': 'default',
            'title': 'Default Modal Box',
            'message': 'You are in default modal box!'
        }
        myApp.modal.alert(params);
    });

    $('#primary_modal').on('click', function () {
        var params = {
            'type': 'primary',
            'title': 'Primary Modal Box',
            'message': 'You are in primary modal box!'
        }
        myApp.modal.alert(params);
    });

    $('#info_modal').on('click', function () {
        var params = {
            'type': 'info',
            'title': 'Info Modal Box',
            'message': 'You are in info modal box!'
        }
        myApp.modal.alert(params);
    });

    $('#warnging_modal').on('click', function () {
        var params = {
            'type': 'warning',
            'title': 'Warning Modal Box',
            'message': 'You are in warning modal box!'
        }
        myApp.modal.alert(params);
    });

    $('#denger_modal').on('click', function () {
        var params = {
            'type': 'danger',
            'title': 'Danger Modal Box',
            'message': 'You are in danger modal box!'
        }
        myApp.modal.alert(params);
    });

    $('#success_modal').on('click', function () {
        var params = {
            'type': 'success',
            'title': 'Success Modal Box',
            'message': 'You are in success modal box!'
        }
        myApp.modal.alert(params);
    });
    $('.post-your-comment').on('click', function () {
        console.log('called');
        var params = {
            'type': 'success',
            'title': 'Success Modal Box',
            'message': 'You are in success modal box!'
        }
        myApp.modal.alert(params);
    });
    $(document).on('click', '.todo_dev', function () {
        var params = {
            'type': 'default',
            'title': 'Comming Soon <span class="fa fa-smile-o"></span> !',
            'message': 'Feature will be available very soon!'
        }
        myApp.modal.alert(params);
    });
    $(document).on('click', '.toggle-password', function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    
})(jQuery);