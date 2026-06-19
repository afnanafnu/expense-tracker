$(function () {

    $('#registerForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },

            email: {
                required: true,
                email: true
            },

            password: {
                required: true,
                minlength: 6
            },

            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },

        messages: {
            name: {
                required: 'Please enter your full name.',
                minlength: 'Name must be at least 3 characters.'
            },

            email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.'
            },

            password: {
                required: 'Please enter a password.',
                minlength: 'Password must be at least 6 characters.'
            },

            password_confirmation: {
                required: 'Please confirm your password.',
                equalTo: 'Passwords do not match.'
            }
        },

        errorElement: 'span',
        errorClass: 'validation-error',

        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },

        highlight: function (element) {
            $(element).addClass('is-invalid');
        },

        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });

});