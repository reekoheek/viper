(function ($) {
    'use strict';

    $($('input')[0]).focus();

    $('form').validate({
        errorElement: 'span',      // default input error message container
        errorClass: 'help-block',  // default input error message class
        focusInvalid: false,       // do not focus the last invalid input
        rules: {
            username: {
                required: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            twitter: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 7
            },
            password_confirmation: {
                equalTo: 'input[name=password]'
            }
        },
        highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
})(window.$);
