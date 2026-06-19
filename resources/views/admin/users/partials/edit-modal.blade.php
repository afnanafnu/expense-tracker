<div class="modal" id="user-edit-modal" style="display:none;">

    <div class="modal__overlay" data-modal-close></div>

    <div class="modal__panel">

        <div class="modal__head">
            <h2 class="modal__title">Edit User</h2>
            <button type="button" class="modal__close" data-modal-close>&times;</button>
        </div>

        <form method="POST" id="editUserForm">
            @csrf
            @method('PUT')

            <input type="hidden" name="user_id" id="edit_user_id">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" id="edit_name" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit_email" class="form-control">
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" id="edit_role" class="form-control">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="modal__footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>

    </div>

</div>