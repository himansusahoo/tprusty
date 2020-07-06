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
        $('#login_error').html('');
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

//APP CODE
})(jQuery);