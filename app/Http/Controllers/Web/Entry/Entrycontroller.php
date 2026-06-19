<?php

namespace App\Http\Controllers\Web\Entry;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Entry\AddEntryRequest;
use App\Http\Requests\Web\Entry\EditEntryRequest;
use App\Http\Requests\Web\Entry\EntryIndexRequest;
use App\Models\Category;
use App\Models\Entry;
use App\Repositories\Web\Entry\EntryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EntryController extends Controller
{
    public function __construct(
        protected EntryRepositoryInterface $entryRepository
    ) {}

    public function index(EntryIndexRequest $request): View
    {
        $perPage = 10;

        $entries = $this->entryRepository
            ->getUserEntries(Auth::id(), $perPage);

        $totalIncome = $entries->getCollection()
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = $entries->getCollection()
            ->where('type', 'expense')
            ->sum('amount');

        return view('web.home.index', [
            'entries'      => $entries,
            'categories'   => Category::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(),
            'totalIncome'  => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance'      => $totalIncome - $totalExpense,
        ]);
    }

    public function store(AddEntryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $this->entryRepository->create($data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Entry added successfully.');
    }

    public function update(EditEntryRequest $request, Entry $entry): RedirectResponse {

        $this->authorizeEntry($entry);

        $this->entryRepository->update(
            $entry,
            $request->validated()
        );

        return redirect()
            ->route('dashboard', [
                'page' => $request->integer('page', 1),
            ])
            ->with('success', 'Entry updated successfully.');
    }

    public function destroy(Entry $entry, Request $request): RedirectResponse {

        $this->authorizeEntry($entry);

        $this->entryRepository->delete($entry);

        return redirect()
            ->route('dashboard', [
                'page' => $request->integer('page', 1),
            ])
            ->with('success', 'Entry deleted successfully.');
    }

    private function authorizeEntry(Entry $entry): void
    {
        abort_unless(
            $entry->user_id === Auth::id(),
            403,
            'Unauthorized action.'
        );
    }
}