jQuery.validator.addMethod("letters_space_only", function (value, element) {
    return this.optional(element) || /^[a-z," "]+$/i.test(value);
}, "Letters and spaces are only allowed");
jQuery.validator.addMethod("letter_number_only", function (value, element) {
    return this.optional(element) || /^[a-z0-9," "]+$/i.test(value);
}, "Letters,number and spaces are only allowed");
jQuery.validator.addMethod("alphanumeric", function (value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
}, "Letters, numbers, and underscores only please");
jQuery.validator.addMethod("mobile_no", function (value, element) {
    return this.optional(element) || /^\d{10}$/.test(value);
}, "Please enter valid mobile number.");
jQuery.validator.addMethod("letter_number_nospace", function (value, element) {
    return this.optional(element) || /^[a-z0-9]+$/i.test(value);
}, "Letters,number are only allowed");

jQuery.validator.addMethod("password", function (value, element) {
    return this.optional(element) ||  /^[a-z0-9A-Z@!#$%^&*]+$/i.test(value);
}, "Letters,number and @!#$%^& are only allowed");