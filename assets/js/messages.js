
var myApp = myApp || {};

myApp.CommonMethod = {
    log_flag: false,
    name: '',
    pageUrl: window.location,
    tempBaseUrl: base_url,
    getBaseUrl: function () {
        if (this.tempBaseUrl)
            return this.tempBaseUrl;
        return this.pageUrl.protocol + "//" + this.pageUrl.host + "/" + this.pageUrl.pathname.split('/')[1];
    },
    getController: function () {
        return this.pageUrl.pathname.split('/')[2];
    },
    getMethod: function () {
        return (this.pageUrl.pathname.split('/')[3]) ? this.pageUrl.pathname.split('/')[3] : 'index';
    },
    getAlert: function (msg) {
        alert(msg);
    },
    checkAll: function (eleObj, itemClass) {
        eleObj.on('click', function () {
            $(':checkbox.' + itemClass).prop('checked', this.checked);
        });
    },
    app_log: function (key, value) {
        if (this.log_flag) {
            console.log(key, value);
        }
    },
    ucFirst: function (string) {
        if (typeof string != 'undefined' && string.trim().length > 0) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        return '';
    },
     getContainerHeight: function (configs) {
        var navBar = $('.navbar-section').outerHeight();
        if (!navBar) {
            navBar = -11;
        }
        var heightCalc = {
            winH: window.innerHeight,
            headerH: $('.header-section').outerHeight(),
            footerH: $('.footer-section').outerHeight(),
            navBar: navBar,
            //breadCumb:$('.content-header').outerHeight(),            
            adjustment: 41,
            gridHeight: 300
        };
        var substractVal = (heightCalc.headerH + heightCalc.footerH + heightCalc.navBar);
        if (configs.filterBoxH == true) {
            substractVal += heightCalc.filterBoxH;
        }
        if (configs.breadCumb == true) {
            substractVal += heightCalc.breadCumb;
        }
        if (configs.adjustment > 0) {
            substractVal += configs.adjustment;
        } else {
            substractVal += heightCalc.adjustment;
        }
        //console.log('heightCalc', heightCalc);
        heightCalc.gridHeight = heightCalc.winH - substractVal;
        return heightCalc.gridHeight;
    },
}//end sub namespace 
myApp.CommonVar = {
    stype: 'primary',
    stitle: 'Success',
    smesage: 'Record successfully saved!',
    etype: 'danger',
    etitle: 'Error',
    emesage: 'Record can not be saved!'
};
myApp.modal = {
    alert_class: {default: '', primary: 'bg-primary', info: 'bg-info', warning: 'bg-warning', success: 'bg-success', danger: 'bg-danger'},
    alert: function (params) {
        if (typeof params.type != 'undefined' && params.type != '') {
            var alertClass = this.alert_class[params.type];
            $('#app_modal_msg_box .modal-header').addClass(alertClass);
            $('#app_modal_msg_box .modal-title').html(params.title);
            $('#app_modal_msg_box .modal-body').html(params.message);
            $('#app_modal_msg_box').modal('show');
        }
    }
};

myApp.Ajax = {
    baseUrl: myApp.CommonMethod.getBaseUrl(),
    controller: myApp.CommonMethod.getController(),
    method: myApp.CommonMethod.getMethod(),
    post_data: '',
    sub_path: '',
    customUrl: '',
    form_method: 'POST',
    data_type: 'JSON',
    reloadMe: 0,
    dataTableRef: null,
    result: null,
    unDefinedCallBack: function () {

    },
    makeUrl: function () {
        var url = '';
        if (!this.customUrl) {
            if (this.baseUrl) {
                url = this.baseUrl;
            }
            if (this.sub_path) {
                url += this.sub_path + '/';
            }
            if (this.controller) {
                url += this.controller + '/';
            }
            if (this.method) {
                url += this.method;
            }
        } else {
            url = this.customUrl;
        }
        return url;
    },

    /**
     * @method: genericAjax() 
     * @param: eleObj,method, callBack, callBackParam,extra_code
     * @return:  NA
     * @desc: generic function for all ajax operation
     */
    genericAjax: function (eleObj, method, callBack, callBackParam, extra_code) {

        jQuery('#loading').css('display', 'block');

        if (!callBack) {
            callBack = this.unDefinedCallBack;
        }
        if (!callBackParam) {
            callBackParam = 0;
        }
        jQuery.ajax({
            type: this.form_method,
            url: this.makeUrl(),
            data: this.post_data,
            datatype: this.data_type,
            success: function (result) {
                myApp.Ajax.result = result;
                if (eleObj && method) {
                    //console.log(eleObj, method);
                    var code = 'eleObj.' + method + '(result)';
                    eval(code);
                }
            },
            failure: function (result) {
                myApp.Ajax.result = result;
            }
        }).done(function () {
            callBack(callBackParam)
            jQuery('#loading').css('display', 'none');
        });
    }

};
// sub namespace for validations
myApp.RegEx = {}
//prompt the modal alert useing call back function 
function pop_up_message(param) {
    myApp.modal.alert(param);
}
function message_toggle() {
    var data = JSON.parse(myApp.Ajax.result);
    if (data) {
        var param = {
            type: (data.type) ? data.type : myApp.CommonVar.stype,
            title: (data.title) ? data.title : myApp.CommonVar.stitle,
            message: (data.message) ? data.message : myApp.CommonVar.smesage,
        }
    }
    myApp.modal.alert(param);
}
