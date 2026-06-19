<div class="modal" id="category-create-modal" style="display:none;">

    <div class="modal__overlay" data-modal-close></div>

    <div class="modal__panel">

        <div class="modal__head">
            <h2 class="modal__title">Add Category</h2>
            <button type="button" class="modal__close" data-modal-close>&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="modal__footer">
                <button type="submit" class="btn btn-primary">
                    Create Category
                </button>
            </div>

        </form>

    </div>

</div>