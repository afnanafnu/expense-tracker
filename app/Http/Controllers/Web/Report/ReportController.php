<?php

namespace App\Http\Controllers\Web\Report;

use App\Models\Entry;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Web\Report\ReportRepositoryInterface;

class ReportController extends Controller
{
    public function __construct(
        private ReportRepositoryInterface $reportRepo
    ) {}

    public function index(): View
    {
        return view('web.reports.index');
    }

    public function monthlyCategory(Request $request)
    {
        $userId = Auth::id();
        $now = now();

        $month = (int) $request->get('month', $now->month);
        $year  = (int) $request->get('year', $now->year);

        $data = $this->reportRepo->expensesByCategory($userId, $year, $month);

        return response()->json([
            'data'  => $data,
            'total' => $data->sum('total'),
        ]);
    }

    public function averageDaily(Request $request)
    {

        $userId = Auth::id();
        $now = now();

        $month = (int) $request->get('month', $now->month);
        $year  = (int) $request->get('year', $now->year);

        $daily = $this->reportRepo->dailyTotals($userId, $year, $month);

        $days = $daily->count();

        return response()->json([
            'daily' => $daily,
            'avg'   => $days > 0 ? $daily->sum('total') / $days : 0,
            'max'   => $daily->max('total') ?? 0,
        ]);
    }

    public function userCategory()
    {
        $userId = Auth::id();

        $data = $this->reportRepo->allTimeCategoryTotals($userId);

        return response()->json([
            'data'  => $data,
            'total' => $data->sum('total'),
        ]);
    }

    public function exportExcel(Request $request)
    {
        $userId = Auth::id();
        $month  = (int) $request->get('month', now()->month);
        $year   = (int) $request->get('year', now()->year);

        $entries = $this->reportRepo->exportEntries($userId, $year, $month);

        $fileName = "expense-report-$month-$year.csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($entries) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Date', 'Title', 'Category', 'Amount']);

            foreach ($entries as $entry) {
                fputcsv($file, [
                    $entry->transaction_date->format('Y-m-d'),
                    $entry->title,
                    $entry->category?->name ?? 'Uncategorised',
                    $entry->amount,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $userId = Auth::id();
        $month  = (int) $request->get('month', now()->month);
        $year   = (int) $request->get('year', now()->year);

        $entries = $this->reportRepo->exportEntries($userId, $year, $month);

        $pdf = Pdf::loadView('web.reports.pdf', [
            'entries' => $entries,
            'month'   => $month,
            'year'    => $year
        ]);

        return $pdf->download("expense-report-$month-$year.pdf");
    }
}
