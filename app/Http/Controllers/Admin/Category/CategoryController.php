<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryIndexRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepo
    ) {}

    public function index(CategoryIndexRequest $request): View
    {
        return view('admin.categories.index');
    }

    public function data(CategoryIndexRequest $request)
    {
        $query = $this->categoryRepo->query();

        return DataTables::of($query)

            ->editColumn('is_active', function ($category) {
                return $category->is_active
                    ? '<span class="status-badge status-badge--success">Active</span>'
                    : '<span class="status-badge status-badge--danger">Inactive</span>';
            })

            ->editColumn('created_at', function ($category) {
                return $category->created_at->format('d M Y');
            })

            ->addColumn('actions', function ($category) {
                return '
                <a href="javascript:void(0)"
                    class="icon-btn icon-btn--edit"
                    data-edit-category
                    data-id="'.$category->id.'"
                    data-name="'.$category->name.'"
                    data-active="'.$category->is_active.'"
                    data-update-url="'.route('admin.categories.update', $category->id).'">
                    Edit
                </a>

            <button
                class="icon-btn icon-btn--danger"
                data-delete-id="' . $category->id . '">
                Delete
            </button>
        ';
            })

            ->rawColumns(['is_active', 'actions'])
            ->make(true);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $this->categoryRepo->create($data);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(UpdateCategoryRequest $request, int $category): RedirectResponse
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $this->categoryRepo->update($category, $data);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryRepo->delete($category);

        return back()->with('success', 'Category deleted successfully.');
    }
}
