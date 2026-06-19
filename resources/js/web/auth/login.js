$(document).ready(function () {

    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },

        messages: {
            email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.'
            },
            password: {
                required: 'Please enter your password.',
                minlength: 'Password must be at least 6 characters.'
            }
        },

        errorElement: 'span',
        errorClass: 'validation-error',

        errorPlacement: function (error, element) {
            error.appendTo(element.closest('.auth__field'));
        },

        highlight: function (element) {
            $(element).addClass('is-invalid');
        },

        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }

    });

});