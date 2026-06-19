$(document).ready(function () {

    $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        dom: '<"admin-dt-top"lf>t<"admin-dt-bottom"ip>',  // add this
        language: {
            search: '',
            searchPlaceholder: 'Search users...',
            lengthMenu: '_MENU_ entries per page',
        },
        ajax: '/admin/users/data',

        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'entries', orderable: false },
            { data: 'created_at' },
            { data: 'role_badge', orderable: false, searchable: false },
            { data: 'actions', orderable: false, searchable: false },
        ]
    });

    $(document).on('click', '[data-edit-user]', function () {

        $('#edit_user_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_email').val($(this).data('email'));
        $('#edit_role').val($(this).data('role'));

        $('#editUserForm').attr('action', $(this).data('update-url'));

        $('#user-edit-modal')
            .css('display', 'flex')
            .addClass('show');
    });

    $(document).on('click', '[data-modal-close]', function () {
        $('#user-edit-modal').removeClass('show');
    });

    $(document).on('click', '[data-delete-id]', function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let id = $(this).data('delete-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This user will be permanently deleted!",
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

            if (result.isConfirmed) {

                $.ajax({
                    url: '/admin/users/' + id,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                    },
                    success: function () {

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'User has been deleted.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-paper',
                                title: 'swal-paper__title',
                                htmlContainer: 'swal-paper__text',
                                confirmButton: 'swal-paper__confirm',
                                cancelButton: 'swal-paper__cancel'
                            },
                        });

                        // IMPORTANT FIX 🔥
                        if ($.fn.DataTable.isDataTable('#usersTable')) {
                            $('#usersTable').DataTable().ajax.reload(null, false);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);

                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong.',
                            icon: 'error',
                            customClass: {
                                popup: 'swal-paper',
                                title: 'swal-paper__title',
                                htmlContainer: 'swal-paper__text',
                                confirmButton: 'swal-paper__confirm',
                                cancelButton: 'swal-paper__cancel'
                            },
                        });
                    }
                });

            }

        });
    });
});