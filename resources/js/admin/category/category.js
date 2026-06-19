$(document).ready(function () {

    const table = $('#categoriesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/categories/data',

        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'slug', name: 'slug' },
            { data: 'is_active', name: 'is_active' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    /*
    |--------------------------------------------------------------------------
    | Add Category
    |--------------------------------------------------------------------------
    */
    $(document).on('click', '[data-add-category]', function () {

        $('#category-create-modal')
            .css('display', 'flex')
            .addClass('show');
    });

    /*
    |--------------------------------------------------------------------------
    | Edit Category
    |--------------------------------------------------------------------------
    */
    $(document).on('click', '[data-edit-category]', function () {

        $('#edit_category_id').val($(this).data('id'));
        $('#edit_category_name').val($(this).data('name'));
        $('#edit_category_status').val($(this).data('active'));

        $('#editCategoryForm').attr(
            'action',
            $(this).data('update-url')
        );

        $('#category-edit-modal')
            .css('display', 'flex')
            .addClass('show');
    });

    /*
    |--------------------------------------------------------------------------
    | Close Modals
    |--------------------------------------------------------------------------
    */
    $(document).on('click', '[data-modal-close]', function () {

        $('.modal')
            .removeClass('show')
            .hide();
    });

    /*
    |--------------------------------------------------------------------------
    | Delete Category
    |--------------------------------------------------------------------------
    */
    $(document).on('click', '[data-delete-id]', function () {

        let id = $(this).data('delete-id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This category will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                popup: 'swal-paper',
                title: 'swal-paper__title',
                htmlContainer: 'swal-paper__text',
                confirmButton: 'swal-paper__confirm',
                cancelButton: 'swal-paper__cancel'
            },
            buttonsStyling: false
        }).then((result) => {

            if (!result.isConfirmed) {
                return;
            }

            $.ajax({
                url: '/admin/categories/' + id,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },

                success: function () {

                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Category deleted successfully.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-paper',
                            title: 'swal-paper__title',
                            htmlContainer: 'swal-paper__text'
                        }
                    });

                    table.ajax.reload(null, false);
                },

                error: function (xhr) {

                    console.log(xhr.responseText);

                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete category.',
                        icon: 'error',
                        customClass: {
                            popup: 'swal-paper',
                            title: 'swal-paper__title',
                            htmlContainer: 'swal-paper__text'
                        }
                    });
                }
            });
        });
    });

});