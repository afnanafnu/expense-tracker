<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserIndexRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\User\ToggleAdminRequest;
use App\Models\User;
use App\Repositories\Admin\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepo
    ) {}

    public function index(UserIndexRequest $request): View
    {
        $users = $this->userRepo->getUsers($request->validated('search'));

        return view('admin.users.index', [
            'users'  => $users,
            'search' => $request->validated('search'),
        ]);
    }


    public function data(UserIndexRequest $request)
    {
        $query = $this->userRepo->query();

        return DataTables::of($query)
            ->addColumn('entries', fn($user) => $user->entries_count ?? 0)

            ->addColumn('role_badge', function ($user) {
                return '<span class="admin-badge">'
                    . ucfirst($user->role) .
                    '</span>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d M Y, h:i A');
            })
            ->addColumn('actions', function ($user) {
                return '
                    <a href="javascript:void(0)"
                        class="icon-btn icon-btn--edit"
                        data-edit-user
                        data-id="'.$user->id.'"
                        data-name="'.$user->name.'"
                        data-email="'.$user->email.'"
                        data-role="'.$user->role.'"
                        data-update-url="'.route('admin.users.update', $user->id).'">
                        Edit
                    </a>

                    <button class="icon-btn icon-btn--danger"
                        data-delete-id="'.$user->id.'">
                        Delete
                    </button>
                ';
            })
            ->rawColumns(['role_badge', 'actions'])
            ->make(true);
    }

    public function toggleAdmin(ToggleAdminRequest $request, User $user): RedirectResponse
    {
        abort_if($user->id === Auth::id(), 403, 'You cannot change your own admin status.');

        $user = $this->userRepo->toggleAdmin($user);

        $status = $user->role === 'admin'
            ? 'granted admin access to'
            : 'revoked admin access from';

        return redirect()
            ->route('admin.users.index')
            ->with('success', "You {$status} {$user->name}.");
    }

    public function update(UpdateUserRequest $request, int $user)
    {
        $this->userRepo->update(
            $user,
            $request->validated()
        );

        return redirect()
            ->back()
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->id === Auth::id(), 403, 'You cannot delete yourself.');

        $name = $user->name;

        $this->userRepo->delete($user);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "{$name} has been deleted.");
    }
}
