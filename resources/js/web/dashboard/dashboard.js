$(function () {

    $('#entry-form').validate({
        rules: {
            title: {
                required: true
            },
            amount: {
                required: true,
                number: true,
                min: 0.01
            },
            category_id: {
                required: true
            },
            transaction_date: {
                required: true
            }
        },

        messages: {
            title: 'Please enter a title.',
            amount: {
                required: 'Please enter an amount.',
                min: 'Amount must be greater than 0.'
            },
            category_id: 'Please select a category.',
            transaction_date: 'Please select a date.'
        },

        errorElement: 'span',
        errorClass: 'validation-error',

        errorPlacement: function (error, element) {

            // Handle Select2
            if (element.hasClass('select2-category')) {
                error.insertAfter(element.next('.select2'));
            } else {
                error.insertAfter(element);
            }
        },

        highlight: function (element) {
            $(element).addClass('is-invalid');

            if ($(element).hasClass('select2-category')) {
                $(element).next('.select2')
                    .find('.select2-selection')
                    .addClass('is-invalid');
            }
        },

        unhighlight: function (element) {
            $(element).removeClass('is-invalid');

            if ($(element).hasClass('select2-category')) {
                $(element).next('.select2')
                    .find('.select2-selection')
                    .removeClass('is-invalid');
            }
        }
    });

    var $modal = $('#entry-modal');
    var $form = $('#entry-form');
    var $methodField = $('#entry-form-method');
    var $title = $('[data-modal-title]');
    var storeUrl = $form.data('store-url');

    function openModal() {
        $modal.addClass('is-open');
    }

    function closeModal() {
        $modal.removeClass('is-open');
    }

    function resetToCreate() {
        $title.text('Add entry');
        $form.attr('action', storeUrl);
        $methodField.val('POST');
        $form[0].reset();
    }

    $('[data-modal-open]').on('click', function () {
        var $btn = $(this);

        if ($btn.data('mode') === 'edit') {
            $title.text('Edit entry');
            $form.attr('action', $btn.data('action'));
            $methodField.val('PUT');

            $form.find('#title').val($btn.data('title'));

            $form.find('#category')
                .val($btn.data('category'))
                .trigger('change');

            $form.find('#amount').val($btn.data('amount'));
            $form.find('#transaction_date').val($btn.data('date'));
            $form.find('#description').val($btn.data('description'));

            $form.find('input[name="type"][value="' + $btn.data('type') + '"]')
                .prop('checked', true);
        } else {
            resetToCreate();
        }

        openModal();
    });

    $('[data-modal-close]').on('click', closeModal);

    $modal.on('click', function (e) {
        if (e.target === this) closeModal();
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    $(document).on('click', '[data-confirm-delete]', function (e) {
        e.preventDefault();

        const form = $(this).closest('form');

        Swal.fire({
            title: 'Delete Entry?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete Entry',
            cancelButtonText: 'Keep It',
            customClass: {
                popup: 'swal-paper',
                title: 'swal-paper__title',
                htmlContainer: 'swal-paper__text',
                confirmButton: 'swal-paper__confirm',
                cancelButton: 'swal-paper__cancel'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $('#category').select2({
        tags: true,
        placeholder: 'Select category',
        allowClear: true,
        width: '100%',
        createTag: function (params) {

            let term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            };
        }
    });

});